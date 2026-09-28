// Marketing pages keep their visual components; identity and writes belong to the Worker.
if (typeof window.rachiApp === 'function') {
  const original = window.rachiApp;
  window.rachiApp = function() {
    const app = original();

    app.restoreUserSession = async function() {
      try {
        const d = { user: await window.RachiSession.session() };
        if (d && d.user) {
          const u = d.user;
          const sName = u.nome || u.name || 'Utilizador';
          const initials = sName.trim().split(/\s+/).filter(Boolean).map(n => n[0]).join('').slice(0, 2).toUpperCase() || 'U';
          this.currentUser = {
            ...u,
            nome: sName,
            name: sName,
            avatar: initials,
            has_matricula: !!u.has_matricula,
            tipo: u.tipo || 'cliente'
          };
          this.loginModal = false;
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.currentUser = null;
          localStorage.removeItem('rachi_user_session');
        }
      } catch (e) {}
    };

    app.submitUnifiedLogin = async function() {
      this.authLoading = true;
      this.authError = '';
      try {
        const email = (this.authForm?.email || '').trim();
        const password = this.authForm?.password || '';
        if (!email || !password) {
          RachiToast.warning('Por favor, preencha o e-mail e a palavra-passe.');
          return;
        }

        const u = await window.RachiSession.login(email, password);
        const sName = u.nome || u.name || 'Utilizador';
        const initials = sName.trim().split(/\s+/).filter(Boolean).map(n => n[0]).join('').slice(0, 2).toUpperCase() || 'U';
        const userObj = {
          ...u,
          nome: sName,
          name: sName,
          avatar: initials,
          has_matricula: !!u.has_matricula,
          tipo: u.tipo || 'cliente'
        };

        this.currentUser = userObj;


        // PERMANECER NA PÁGINA INICIAL (INDEX) E FECHAR O MODAL DE LOGIN:
        this.loginModal = false;
        this.currentView = 'public';
        this.currentTab = 'home';

        // Apresentar toast/notificação de boas-vindas na própria tela
        if (typeof this.showLoginToast === 'function') {
          this.showLoginToast(
            'Autenticado com Sucesso!',
            `Bem-vindo(a), ${sName}! Sessão iniciada com sucesso.`,
            'success',
            4500
          );
        }

        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      } catch (e) {
        RachiToast.error(e.message || 'Erro ao realizar login.');
      } finally {
        this.authLoading = false;
      }
    };

    app.quickFillAuth = function(type) {
      this.authError = '';
      if (!this.authForm) this.authForm = { email: '', password: '' };
      if (type === 'admin' || type === 'aluno_matriculado') {
        this.authForm.email = 'casimirogundja@outlook.com';
        this.authForm.password = 'Admin@2026';
      } else if (type === 'cliente_sem_matricula' || type === 'cliente') {
        this.authForm.email = 'cliente@empresa.ao';
        this.authForm.password = 'Cliente@2026';
      } else if (type === 'funcionario' || type === 'aluno') {
        this.authForm.email = 'pedro@email.com';
        this.authForm.password = '123456';
      }
    };

    app.submitRegister = function() { location.href = '/registro'; };
    app.openAdminDashboard = function() { location.href = '/admin-dashboard'; };

    app.logout = function() { return window.RachiSession.logout(); };

    const init = app.init;
    app.init = function() {
      init?.call(this);
    };

    return app;
  };
}

document.addEventListener('submit', async event => {
  const form = event.target;
  if (!(form instanceof HTMLFormElement)) return;
  const url = new URL(form.action || location.href);
  if (url.origin !== location.origin || form.method.toLowerCase() !== 'post') return;
  event.preventDefault();
  const button = form.querySelector('button[type=submit],button:not([type])');
  if (button) button.disabled = true;
  try {
    const r = await fetch(url.pathname, {
      method: 'POST',
      headers: { Accept: 'application/json', 'Content-Type': 'application/json' },
      body: JSON.stringify(Object.fromEntries(new FormData(form)))
    });
    const data = await r.json();
    if (r.status === 401) { location.href = '/login'; return; }
    if (!r.ok) throw Error(data.message || 'Não foi possível enviar.');
    form.reset();
  } catch (error) {
    RachiToast.error(error.message);
  } finally {
    if (button) button.disabled = false;
  }
});
