const capitalServices = {
  'cedencia-temporaria': 'Cedência temporária de trabalhadores',
  'constituicao-legalizacao-empresas': 'Constituição e legalização de empresas',
  'consultoria-recursos-humanos': 'Consultoria em recursos humanos',
  'organizacao-contabilidade': 'Organização de contabilidade',
  'registo-inss': 'Registo no INSS',
  'regularizacao-documental': 'Regularização documental empresarial',
};

export async function receiveCapitalRequest(c, helpers) {
  const {body, text, email, limit, randomToken, digest, fail} = helpers;
  const input = await body(c);
  const data = {
    nome:text(input, 'nome'), telefone:text(input, 'telefone', 40),
    email:input.email ? email(input) : '', empresa:text(input, 'empresa', 255, false),
    servico:text(input, 'servico'), service_slug:text(input, 'service_slug', 100, false),
    plano:text(input, 'plano', 255, false), detalhes:text(input, 'detalhes', 3000, false),
  };
  const digits = data.telefone.replace(/\D/g, '');
  if (digits.length < 6 || digits.length > 15) return fail(422, 'Indique um contacto telefónico válido.');
  if (data.service_slug && !Object.hasOwn(capitalServices, data.service_slug)) return fail(422, 'Serviço Human Capital inválido.');
  const title = capitalServices[data.service_slug] || data.servico;
  const address = data.email || `capital-${(await digest(digits)).slice(0,24)}@contact.rachi.invalid`;
  await limit(c, 'capital-request', 20);
  const db = c.get('db');
  const result = await db.transaction(async () => {
    const unit = await db.one("SELECT id FROM business_units WHERE slug='capital'");
    if (!unit) return fail(503, 'Human Capital indisponível.');
    await db.query('SELECT pg_advisory_xact_lock(hashtext($1))', [address]);
    let account = await db.one('SELECT id FROM users WHERE lower(email)=$1 AND deleted_at IS NULL', [address]);
    if (!account) {
      const role = await db.one("SELECT id FROM roles WHERE slug='customer'");
      if (!role) return fail(503, 'Registo de clientes indisponível.');
      account = await db.one(`INSERT INTO users(name,email,phone,password,role_id,status,created_at,updated_at)
        VALUES($1,$2,$3,extensions.crypt($4,extensions.gen_salt('bf',12)),$5,'active',now(),now()) RETURNING id`, [data.nome, address, data.telefone, randomToken(), role.id]);
    }
    let customer = await db.one('SELECT id FROM customers WHERE user_id=$1 AND deleted_at IS NULL', [account.id]);
    if (!customer) customer = await db.one(`INSERT INTO customers(user_id,type,company_name,trade_name,phone,whatsapp,status,created_at,updated_at)
      VALUES($1,$2,$3,$4,$5,$5,'active',now(),now()) RETURNING id`, [account.id, data.empresa ? 'company' : 'individual', data.empresa || null, data.empresa || data.nome, data.telefone]);
    const service = data.service_slug ? await db.one('SELECT id FROM services WHERE business_unit_id=$1 AND slug=$2 AND deleted_at IS NULL', [unit.id, data.service_slug]) : null;
    const sequence = await db.one("SELECT nextval(pg_get_serial_sequence('service_requests','id')) id");
    const protocol = `SOL-${new Date().getUTCFullYear()}-${String(sequence.id).padStart(6, '0')}`;
    const description = [
      `Serviço: ${title}`, `Solicitante: ${data.nome}`, data.empresa && `Empresa: ${data.empresa}`,
      `Telefone / WhatsApp: ${data.telefone}`, data.email && `E-mail: ${data.email}`,
      data.plano && `Plano / Opção: ${data.plano}`, data.detalhes && `Detalhes da solicitação:\n${data.detalhes}`,
    ].filter(Boolean).join('\n');
    await db.query(`INSERT INTO service_requests(id,protocol,customer_id,business_unit_id,service_id,title,description,priority,status,requested_date,created_at,updated_at)
      VALUES($1,$2,$3,$4,$5,$6,$7,'normal','new',CURRENT_DATE,now(),now())`, [sequence.id, protocol, customer.id, unit.id, service?.id || null, ('Human Capital: ' + title).slice(0,255), description]);
    await db.query(`INSERT INTO service_request_status_histories(service_request_id,user_id,old_status,new_status,comment,created_at)
      VALUES($1,$2,NULL,'new',$3,now())`, [sequence.id, account.id, 'Solicitação enviada pelo site Human Capital: ' + title]);
    return {protocol, request_id:sequence.id};
  });
  return c.json({success:true, ...result, message:'Solicitação registada. A nossa equipa entrará em contacto.'});
}
