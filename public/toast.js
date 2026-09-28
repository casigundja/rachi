(() => {
  if (window.RachiToast) return;
  const titles = { warning: 'Atenção', error: 'Não foi possível concluir', success: 'Sucesso', info: 'Informação' };
  const icons = { warning: '!', error: '!', success: '✓', info: 'i' };
  let region;
  function show(message, { type = 'warning', title, duration = 6000, actions = [], onDismiss } = {}) {
    if (!message) return;
    if (!titles[type]) type = 'info';
    if (!document.body) {
      document.addEventListener('DOMContentLoaded', () => show(message, { type, title, duration, actions, onDismiss }), { once: true });
      return;
    }
    if (!region) {
      region = document.createElement('section');
      region.className = 'rachi-toasts';
      region.setAttribute('aria-label', 'Notificações');
      document.body.append(region);
    }
    const text = String(message);
    if (!actions.length && [...region.children].some(item => item.dataset.message === text && item.dataset.type === type)) return;
    while (region.children.length >= 4) region.firstElementChild.dismiss();
    const item = document.createElement('div');
    item.className = 'rachi-toast';
    item.dataset.type = type;
    item.dataset.message = text;
    item.setAttribute('role', type === 'error' || type === 'warning' ? 'alert' : 'status');
    item.setAttribute('aria-atomic', 'true');
    const icon = document.createElement('span');
    icon.className = 'rachi-toast-icon';
    icon.setAttribute('aria-hidden', 'true');
    icon.textContent = icons[type];
    const content = document.createElement('div');
    content.className = 'rachi-toast-content';
    const heading = document.createElement('strong');
    heading.textContent = title || titles[type];
    const detail = document.createElement('p');
    detail.textContent = text;
    content.append(heading, detail);
    const close = document.createElement('button');
    close.type = 'button';
    close.className = 'rachi-toast-close';
    close.setAttribute('aria-label', 'Fechar notificação');
    close.textContent = '×';
    let timer, started, remaining = Math.max(6000, Number(duration) || 6000);
    let dismissed = false, paused = true;
    const dismiss = () => { if (dismissed) return; dismissed = true; clearTimeout(timer); item.remove(); onDismiss?.(); };
    const pause = () => { if (paused) return; paused = true; clearTimeout(timer); remaining -= Date.now() - started; };
    const resume = () => { if (!paused) return; paused = false; started = Date.now(); timer = setTimeout(dismiss, Math.max(0, remaining)); };
    if (actions.length) {
      const controls = document.createElement('div'); controls.className = 'rachi-toast-actions';
      for (const action of actions) {
        const button = document.createElement('button'); button.type = 'button'; button.textContent = action.label;
        button.addEventListener('click', () => { action.run(); dismiss(); }); controls.append(button);
      }
      content.append(controls);
    }
    item.dismiss = dismiss;
    close.addEventListener('click', dismiss);
    item.addEventListener('mouseenter', pause);
    item.addEventListener('mouseleave', () => { if (!item.contains(document.activeElement)) resume(); });
    item.addEventListener('focusin', pause);
    item.addEventListener('focusout', () => { if (!item.matches(':hover')) resume(); });
    item.addEventListener('keydown', event => { if (event.key === 'Escape') dismiss(); });
    item.append(icon, content, close);
    region.append(item);
    resume();
    return dismiss;
  }
  window.RachiToast = {
    show,
    confirm(message) { return new Promise(resolve => show(message, { type: 'warning', title: 'Confirmar ação', duration: 10000, onDismiss: () => resolve(false), actions: [{ label: 'Confirmar', run: () => resolve(true) }, { label: 'Cancelar', run: () => resolve(false) }] })); },
    ...Object.fromEntries(Object.keys(titles).map(type => [type, (message, options = {}) => show(message, { ...options, type })]))
  };
  const approvedForms = new WeakSet();
  document.addEventListener('invalid', event => {
    event.preventDefault();
    window.RachiToast.warning(event.target.validationMessage || 'Verifique os campos obrigatórios.');
  }, true);
  document.addEventListener('submit', async event => {
    const form = event.target, submitter = event.submitter, message = submitter?.dataset.confirm || form.dataset.confirm;
    if (!message || approvedForms.delete(form)) return;
    event.preventDefault(); event.stopImmediatePropagation();
    if (await window.RachiToast.confirm(message)) { approvedForms.add(form); form.requestSubmit(submitter); }
  }, true);
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-rachi-flash]').forEach(node => {
      show(node.textContent.trim(), { type: node.dataset.rachiFlash });
      node.remove();
    });
  });
})();
