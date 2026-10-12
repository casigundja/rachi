export async function receivePrintQuote(c, helpers) {
  const { body, text, email, limit, randomToken, fail } = helpers;
  const input = await body(c);
  const data = {
    name: text(input, 'name'), email: email(input), phone: text(input, 'phone', 40),
    produto: text(input, 'produto'), empresa: text(input, 'empresa', 255, false),
    linha: text(input, 'linha', 255, false), service_slug: text(input, 'service_slug', 100, false),
    quantidade: text(input, 'quantidade', 100, false), prazo: text(input, 'prazo', 100, false) || 'padrao',
    message: text(input, 'message', 3000, false),
  };
  await limit(c, 'print-quote', 20);
  const db = c.get('db');
  const result = await db.transaction(async () => {
    const unit = await db.one("SELECT id FROM business_units WHERE slug='print'");
    if (!unit) return fail(503, 'RACHI Print indisponível.');
    // Serialize submissions for the same email without changing existing accounts.
    await db.query('SELECT pg_advisory_xact_lock(hashtext($1))', [data.email]);
    let account = await db.one('SELECT id FROM users WHERE lower(email)=$1 AND deleted_at IS NULL', [data.email]);
    if (!account) {
      const role = await db.one("SELECT id FROM roles WHERE slug='customer'");
      if (!role) return fail(503, 'Registo de clientes indisponível.');
      account = await db.one(`INSERT INTO users(name,email,phone,password,role_id,status,created_at,updated_at)
        VALUES($1,$2,$3,extensions.crypt($4,extensions.gen_salt('bf',12)),$5,'active',now(),now()) RETURNING id`,
        [data.name, data.email, data.phone, randomToken(), role.id]);
    }
    let customer = await db.one('SELECT id FROM customers WHERE user_id=$1 AND deleted_at IS NULL', [account.id]);
    if (!customer) {
      customer = await db.one(`INSERT INTO customers(user_id,type,company_name,trade_name,phone,whatsapp,status,created_at,updated_at)
        VALUES($1,$2,$3,$4,$5,$5,'active',now(),now()) RETURNING id`,
        [account.id, data.empresa ? 'company' : 'individual', data.empresa || null, data.empresa || data.name, data.phone]);
    }
    const service = data.service_slug ? await db.one('SELECT id FROM services WHERE business_unit_id=$1 AND slug=$2 AND deleted_at IS NULL', [unit.id, data.service_slug]) : null;
    const sequence = await db.one("SELECT nextval(pg_get_serial_sequence('service_requests','id')) id");
    const protocol = `SOL-${new Date().getUTCFullYear()}-${String(sequence.id).padStart(6, '0')}`;
    const urgent = ['urgente', 'urgencia', 'alta'].includes(data.prazo.toLowerCase());
    const deadlines = {padrao:'Prazo Normal (3 a 5 dias úteis)', urgente:'Urgência Expresso (24h a 48h úteis)', programado:'Entrega Programada (Evento futuro)'};
    const description = [
      `📦 Produto: ${data.produto}`, data.linha && `🏷️ Linha Gráfica: ${data.linha}`,
      `👤 Solicitante: ${data.name}`, data.empresa && `🏢 Empresa: ${data.empresa}`,
      `📞 Telefone / WhatsApp: ${data.phone}`, `✉️ Email: ${data.email}`,
      data.quantidade && `🔢 Quantidade Estimada: ${data.quantidade}`,
      `⏱️ Prazo Desejado: ${deadlines[data.prazo] || data.prazo}`,
      data.message && `📝 Especificações & Detalhes:\n${data.message}`,
    ].filter(Boolean).join('\n');
    await db.query(`INSERT INTO service_requests(id,protocol,customer_id,business_unit_id,service_id,title,description,priority,status,requested_date,estimated_date,created_at,updated_at)
      VALUES($1,$2,$3,$4,$5,$6,$7,$8,'new',CURRENT_DATE,CURRENT_DATE+$9::integer,now(),now())`,
      [sequence.id, protocol, customer.id, unit.id, service?.id || null, ('Cotação Gráfica: ' + data.produto).slice(0,255), description, urgent ? 'urgent' : 'normal', urgent ? 2 : 5]);
    await db.query(`INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at)
      VALUES($1,$2,NULL,'new',$3,now())`, [sequence.id, account.id, `Solicitação de cotação enviada pelo catálogo online (${data.produto})`]);
    return {protocol, request_id:sequence.id};
  });
  return c.json({success:true, ...result, produto:data.produto, message:`Solicitação de cotação registada com sucesso! O seu número de protocolo é ${result.protocol}.`});
}
