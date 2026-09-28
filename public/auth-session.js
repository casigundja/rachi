// The cookie and backend are the only authority for identity and permissions.
(() => {
  if (window.RachiSession) return;
  const nativeFetch = window.fetch.bind(window);
  let current, pending, revision = 0, lastEvent, navigating = false;
  
  const channel = typeof BroadcastChannel === 'function' ? new BroadcastChannel('rachi_session') : null;
  const authChannel = typeof BroadcastChannel === 'function' ? new BroadcastChannel('rachi_auth_channel') : null;

  const clearLegacy = () => {
    try {
      for (const key of ['rachi_user_session', 'rachi_academy_auth', 'rachi_registered_users']) {
        localStorage.removeItem(key);
      }
      localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
    } catch {}
  };

  function publish(action = null) {
    const act = action || (current ? 'login' : 'logout');
    const event = { id: crypto.randomUUID(), action: act, timestamp: Date.now() };
    
    try { channel?.postMessage(event); } catch {}
    try { authChannel?.postMessage({ action: act, timestamp: Date.now() }); } catch {}
    try {
      localStorage.setItem('rachi_session_event', JSON.stringify(event));
      localStorage.setItem('rachi_auth_sync', Date.now().toString());
    } catch {}
  }

  function invalidate() {
    revision++;
    pending = null;
  }

  async function session() {
    if (pending) return pending;
    const version = revision;
    const request = nativeFetch('/api/session', { credentials: 'same-origin', cache: 'no-store', headers: { Accept: 'application/json' } })
      .then(async response => {
        if (!response.ok) throw Error('Não foi possível verificar a sessão.');
        const data = await response.json();
        if (version !== revision) return session();
        current = data.user || null;
        return current;
      }).finally(() => { if (pending === request) pending = null; });
    pending = request;
    return request;
  }

  async function synchronize(external = false) {
    const previous = current;
    try {
      const next = await session();
      if (!navigating && ((external && previous === undefined) || (previous !== undefined && JSON.stringify(previous) !== JSON.stringify(next)))) {
        navigating = true;
        const isProtected = ['/admin', '/portal', '/aluno'].some(p => location.pathname.startsWith(p));
        if (!next && isProtected) {
          location.replace('/login');
        } else {
          location.reload();
        }
      }
    } catch { /* A network failure is not a successful logout. */ }
  }

  window.fetch = async (input, options) => {
    const url = new URL(input instanceof Request ? input.url : input, location.href);
    const method = options?.method || (input instanceof Request ? input.method : 'GET');
    if (url.origin === location.origin && !['GET', 'HEAD', 'OPTIONS'].includes(method.toUpperCase())) {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
      if (csrf) {
        const headers = new Headers(options?.headers || (input instanceof Request ? input.headers : undefined));
        headers.set('X-CSRF-TOKEN', csrf);
        options = { ...options, headers };
      }
    }
    const response = await nativeFetch(input, options);
    if (url.origin === location.origin && method.toUpperCase() === 'POST' && response.ok && ['/login', '/registro', '/logout'].includes(url.pathname)) {
      invalidate();
      if (url.pathname === '/logout') {
        current = null;
        clearLegacy();
        publish('logout');
      } else {
        try { await session(); } catch {}
        publish('login');
      }
    }
    return response;
  };

  window.RachiSession = {
    session,
    async login(email, password) {
      const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
      const response = await fetch('/login', {
        method: 'POST',
        headers: { Accept: 'application/json', 'Content-Type': 'application/json', ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}) },
        body: JSON.stringify({ email, password }),
        credentials: 'same-origin'
      });
      const data = await response.json();
      if (!response.ok || !data.success) throw Error(data.message || 'Credenciais incorretas.');
      const meta = document.querySelector('meta[name="csrf-token"]');
      if (meta && data.csrf_token) meta.content = data.csrf_token;
      invalidate();
      const s = await session();
      publish('login');
      return s;
    },
    async logout() {
      try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
        await fetch('/logout', {
          method: 'POST',
          headers: { Accept: 'application/json', ...(csrf ? { 'X-CSRF-TOKEN': csrf } : {}) },
          credentials: 'same-origin'
        });
      } catch (error) {}
      
      current = null;
      clearLegacy();
      publish('logout');
      invalidate();

      const isProtected = ['/admin', '/portal', '/aluno'].some(p => location.pathname.startsWith(p));
      if (isProtected) {
        location.replace('/login');
      } else {
        location.reload();
      }
    }
  };

  function receive(event) {
    if (!event) return;
    if (event.id && event.id === lastEvent) return;
    if (event.id) lastEvent = event.id;
    invalidate();
    synchronize(true);
  }

  channel?.addEventListener('message', event => receive(event.data));
  authChannel?.addEventListener('message', event => receive(event.data));

  addEventListener('storage', event => {
    if (['rachi_session_event', 'rachi_auth_sync', 'rachi_user_session'].includes(event.key)) {
      invalidate();
      synchronize(true);
    }
  });

  addEventListener('pageshow', () => synchronize());
  addEventListener('focus', () => synchronize());
  document.addEventListener('visibilitychange', () => { if (!document.hidden) synchronize(); });
  setInterval(() => { if (!document.hidden) synchronize(); }, 15000);

  document.addEventListener('submit', event => {
    const form = event.target;
    if (form instanceof HTMLFormElement && (form.dataset.api === '/logout' || new URL(form.action, location.href).pathname === '/logout')) {
      event.preventDefault();
      event.stopImmediatePropagation();
      window.RachiSession.logout();
    }
  }, true);
})();
