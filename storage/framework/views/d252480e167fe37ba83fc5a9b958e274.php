<!DOCTYPE html>
<html lang="pt-AO" :class="{'dark': theme === 'dark'}" :data-bs-theme="theme" class="h-full">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>RACHI — Painel de Gestão & Administração</title>
<meta name="description" content="Painel de controlo visual e intuitivo da RACHI: métricas, negócios, clientes, solicitações e relatórios.">
<link rel="icon" type="image/png" href="/images/logo-rachi-light.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Alpine.js & Lucide Icons -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<!-- Chart.js para gráficos ilustrativos e interativos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Bootstrap 5 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif']
      },
      colors: {
        rachiBlue: '#0050f0',
        rachiCyan: '#00a3e0',
        rachiGold: '#f5a800',
        rachiNavy: '#071326'
      }
    }
  }
}
</script>

<style>
[x-cloak] { display: none !important; }
*, *::before, *::after { box-sizing: border-box; }

:root {
  --bg-app: #f4f6fb;
  --bg-sidebar: #ffffff;
  --border-sidebar: #e5e9f2;
  --bg-header: rgba(255, 255, 255, 0.94);
  --border-header: #e5e9f2;
  --bg-card: #ffffff;
  --border-card: #e5e9f2;
  --text-main: #0f172a;
  --text-muted: #64748b;
  --text-sub: #334155;
  --bg-input: #ffffff;
  --border-input: #cbd5e1;
  --table-th-bg: #f8fafc;
  --table-border: #f1f5f9;
  --table-hover: #f8fafc;
  --card-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
}

html.dark {
  --bg-app: #060b17;
  --bg-sidebar: #071326;
  --border-sidebar: rgba(0, 80, 240, 0.16);
  --bg-header: rgba(7, 19, 38, 0.92);
  --border-header: rgba(0, 80, 240, 0.16);
  --bg-card: #0c1527;
  --border-card: rgba(0, 80, 240, 0.16);
  --text-main: #f1f5f9;
  --text-muted: #94a3b8;
  --text-sub: #cbd5e1;
  --bg-input: #070f1e;
  --border-input: rgba(0, 80, 240, 0.26);
  --table-th-bg: #071122;
  --table-border: rgba(0, 80, 240, 0.12);
  --table-hover: rgba(0, 80, 240, 0.05);
  --card-shadow: 0 10px 30px -5px rgba(2, 6, 18, 0.7), 0 0 16px -3px rgba(0, 80, 240, 0.08);
}

body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background-color: var(--bg-app);
  color: var(--text-main);
  margin: 0;
  overflow-x: hidden;
  transition: background-color 0.25s ease, color 0.25s ease;
}

html.dark body {
  background-color: var(--bg-app);
  background-image: 
    radial-gradient(at 10% 10%, rgba(0, 80, 240, 0.08) 0px, transparent 48%),
    radial-gradient(at 90% 90%, rgba(0, 163, 224, 0.06) 0px, transparent 42%);
  background-attachment: fixed;
}

#admin-sidebar {
  width: 270px;
  min-height: 100vh;
  background-color: var(--bg-sidebar);
  border-right: 1px solid var(--border-sidebar);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.25s ease, border-color 0.25s ease;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  overflow-x: hidden;
}

#admin-sidebar.collapsed { width: 76px; }
#admin-sidebar.collapsed .sl,
#admin-sidebar.collapsed .sg,
#admin-sidebar.collapsed .sb2,
#admin-sidebar.collapsed .sa,
#admin-sidebar.collapsed .site-back-text,
#admin-sidebar.collapsed .brand-full {
  opacity: 0;
  pointer-events: none;
  width: 0;
  overflow: hidden;
  display: none !important;
}
#admin-sidebar.collapsed .brand-emblem-collapsed {
  display: flex !important;
}
#admin-sidebar.collapsed .sidebar-brand-box {
  padding-left: 0.75rem;
  padding-right: 0.75rem;
  display: flex;
  flex-direction: column;
  align-items: center;
}
#admin-sidebar.collapsed .sidebar-item {
  justify-content: center;
  padding-left: 0;
  padding-right: 0;
  margin-left: 6px;
  margin-right: 6px;
}
#admin-sidebar.collapsed .sidebar-item:hover {
  transform: none;
}
#admin-sidebar.collapsed .sidebar-item .si {
  margin: 0 auto;
}
#admin-sidebar.collapsed .sidebar-footer {
  padding-left: 0.5rem;
  padding-right: 0.5rem;
}
#admin-sidebar.collapsed .site-back-btn {
  justify-content: center !important;
  padding: 8px !important;
  width: 42px !important;
  height: 42px !important;
  margin: 0 auto !important;
}
#admin-sidebar.collapsed .site-back-btn i.ms-auto {
  display: none !important;
}
#admin-sidebar.collapsed .sub-menu { display: none !important; }

.sidebar-item {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 9px 14px;
  border-radius: 12px;
  margin: 2px 8px;
  font-size: 13px;
  font-weight: 600;
  color: var(--text-muted);
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  white-space: nowrap;
  text-decoration: none;
}
.sidebar-item:hover {
  background-color: rgba(0, 80, 240, 0.08);
  color: #0050f0;
  transform: translateX(2px);
}
html.dark .sidebar-item:hover {
  background-color: rgba(0, 80, 240, 0.14);
  color: #38bdf8;
}
.sidebar-item.active {
  background: linear-gradient(135deg, rgba(0, 80, 240, 0.14), rgba(0, 163, 224, 0.09));
  color: #0050f0;
  font-weight: 700;
  border: 1px solid rgba(0, 80, 240, 0.18);
  box-shadow: 0 2px 10px rgba(0, 80, 240, 0.08);
}
html.dark .sidebar-item.active {
  background: linear-gradient(135deg, rgba(0, 80, 240, 0.38), rgba(0, 163, 224, 0.22));
  color: #38bdf8;
  border: 1px solid rgba(0, 163, 224, 0.4);
  box-shadow: 0 2px 14px rgba(0, 80, 240, 0.28);
}

.si { flex-shrink: 0; width: 18px; height: 18px; }
.sa { margin-left: auto; transition: transform 0.2s; }
.sa.open { transform: rotate(90deg); }
.sg {
  font-size: 10px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-muted);
  opacity: 0.75;
  padding: 14px 16px 4px;
}

#admin-main {
  margin-left: 270px;
  min-height: 100vh;
  transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
#admin-main.sc { margin-left: 76px; }

#admin-header {
  background-color: var(--bg-header);
  backdrop-filter: blur(24px);
  -webkit-backdrop-filter: blur(24px);
  border-bottom: 1px solid var(--border-header);
  height: 64px;
  display: flex;
  align-items: center;
  padding: 0 20px;
  position: sticky;
  top: 0;
  z-index: 50;
  gap: 14px;
  transition: background-color 0.25s ease, border-color 0.25s ease;
}

.kc {
  background-color: var(--bg-card);
  border: 1px solid var(--border-card);
  border-radius: 18px;
  padding: 18px 20px;
  box-shadow: var(--card-shadow);
  transition: all 0.22s ease;
  position: relative;
  overflow: hidden;
}
.kc:hover {
  border-color: rgba(0, 80, 240, 0.35);
  transform: translateY(-2px);
  box-shadow: 0 10px 25px -4px rgba(0, 80, 240, 0.12);
}

.sc2 {
  background-color: var(--bg-card);
  border: 1px solid var(--border-card);
  border-radius: 20px;
  padding: 20px 22px;
  box-shadow: var(--card-shadow);
  transition: background-color 0.25s ease, border-color 0.25s ease;
}

.at { width: 100%; border-collapse: separate; border-spacing: 0; }
.at th {
  background-color: var(--table-th-bg);
  padding: 11px 16px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-muted);
  border-bottom: 1px solid var(--table-border);
}
.at td {
  padding: 12px 16px;
  font-size: 13px;
  border-bottom: 1px solid var(--table-border);
  vertical-align: middle;
  color: var(--text-sub);
}
.at tbody tr { transition: background-color 0.15s ease; }
.at tbody tr:hover { background-color: var(--table-hover); }

.badge2 {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 4px 11px;
  border-radius: 999px;
  font-size: 11.5px;
  font-weight: 700;
}
.s-novo { background: rgba(99, 102, 241, 0.12); color: #6366f1; border: 1px solid rgba(99, 102, 241, 0.25); }
html.dark .s-novo { background: rgba(99, 102, 241, 0.2); color: #a5b4fc; border-color: rgba(99, 102, 241, 0.35); }
.s-analise { background: rgba(245, 168, 0, 0.14); color: #b45309; border: 1px solid rgba(245, 168, 0, 0.28); }
html.dark .s-analise { background: rgba(245, 168, 0, 0.18); color: #fcd34d; border-color: rgba(245, 168, 0, 0.35); }
.s-exec { background: rgba(0, 80, 240, 0.12); color: #0050f0; border: 1px solid rgba(0, 80, 240, 0.25); }
html.dark .s-exec { background: rgba(0, 80, 240, 0.24); color: #38bdf8; border-color: rgba(0, 163, 224, 0.4); }
.s-done { background: rgba(16, 185, 129, 0.12); color: #047857; border: 1px solid rgba(16, 185, 129, 0.25); }
html.dark .s-done { background: rgba(16, 185, 129, 0.18); color: #34d399; border-color: rgba(16, 185, 129, 0.35); }
.s-cancel { background: rgba(239, 68, 68, 0.12); color: #b91c1c; border: 1px solid rgba(239, 68, 68, 0.25); }
html.dark .s-cancel { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border-color: rgba(239, 68, 68, 0.35); }
.s-wait { background: rgba(249, 115, 22, 0.14); color: #c2410c; border: 1px solid rgba(249, 115, 22, 0.28); }
html.dark .s-wait { background: rgba(249, 115, 22, 0.18); color: #fdba74; border-color: rgba(249, 115, 22, 0.35); }
.s-ativo { background: rgba(16, 185, 129, 0.12); color: #047857; border: 1px solid rgba(16, 185, 129, 0.25); }
html.dark .s-ativo { background: rgba(16, 185, 129, 0.18); color: #34d399; border-color: rgba(16, 185, 129, 0.35); }
.s-inativo { background: rgba(100, 116, 139, 0.12); color: #64748b; border: 1px solid rgba(100, 116, 139, 0.25); }
html.dark .s-inativo { background: rgba(100, 116, 139, 0.2); color: #94a3b8; border-color: rgba(100, 116, 139, 0.35); }
.s-block { background: rgba(239, 68, 68, 0.12); color: #b91c1c; border: 1px solid rgba(239, 68, 68, 0.25); }
html.dark .s-block { background: rgba(239, 68, 68, 0.2); color: #fca5a5; border-color: rgba(239, 68, 68, 0.35); }

.pb { background: rgba(100, 116, 139, 0.16); border-radius: 999px; height: 8px; overflow: hidden; }
.pbf { height: 100%; border-radius: 999px; }

.tl { display: flex; gap: 15px; }
.tldot { width: 12px; height: 12px; border-radius: 50%; background: #0050f0; margin-top: 3px; flex-shrink: 0; position: relative; }
.tldot::after { content: ''; position: absolute; top: 12px; left: 5px; width: 2px; height: calc(100% + 18px); background: var(--table-border); }
.tl:last-child .tldot::after { display: none; }

#admin-sidebar::-webkit-scrollbar { width: 5px; }
#admin-sidebar::-webkit-scrollbar-thumb { background: rgba(100, 116, 139, 0.22); border-radius: 4px; }

@media (max-width: 768px) {
  #admin-sidebar { transform: translateX(-100%); width: 270px !important; }
  #admin-sidebar.mob { transform: translateX(0); }
  #admin-main { margin-left: 0 !important; }
}

.ia {
  background-color: var(--bg-input);
  border: 1px solid var(--border-input);
  color: var(--text-main);
  border-radius: 12px;
  padding: 8px 14px;
  font-size: 13px;
  font-weight: 500;
  width: 100%;
  outline: none;
  transition: all 0.2s;
}
.ia:focus {
  border-color: #0050f0;
  box-shadow: 0 0 0 3px rgba(0, 80, 240, 0.18);
}
.ia::placeholder { color: var(--text-muted); opacity: 0.65; }

.bap {
  background: linear-gradient(135deg, #0050f0, #00a3e0);
  color: #fff;
  border: none;
  border-radius: 12px;
  padding: 9px 18px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 4px 14px rgba(0, 80, 240, 0.25);
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.bap:hover {
  opacity: 0.96;
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0, 80, 240, 0.35);
}

.unit-card {
  transition: all 0.22s ease;
  border-radius: 18px;
}
.unit-card:hover {
  transform: translateY(-3px);
}

html.dark .ia {
  background-color: var(--bg-input);
  border-color: var(--border-input);
  color: #f8fafc;
}
html.dark .ia:focus {
  border-color: #00a3e0;
  box-shadow: 0 0 0 3px rgba(0, 80, 240, 0.28);
}

html.dark .unit-card:hover {
  box-shadow: 0 12px 30px -5px rgba(0, 80, 240, 0.25), 0 0 20px rgba(0, 163, 224, 0.12);
}

html.dark .bap {
  background: linear-gradient(135deg, #0050f0, #00a3e0);
  box-shadow: 0 4px 18px rgba(0, 80, 240, 0.4);
}
html.dark .bap:hover {
  box-shadow: 0 6px 24px rgba(0, 163, 224, 0.5);
}

/* Neutralizar sobrescrita !important do Bootstrap 5 no modo escuro */
html.dark .bg-white {
  background-color: var(--bg-card) !important;
}

.hdr-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 14px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  background-color: #ffffff;
  border: 1px solid #e2e8f0;
  color: #334155;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.hdr-btn:hover {
  background-color: #f8fafc;
  border-color: #cbd5e1;
  color: #0050f0;
}
html.dark .hdr-btn {
  background-color: rgba(0, 80, 240, 0.12) !important;
  border-color: rgba(0, 80, 240, 0.26) !important;
  color: #f1f5f9 !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
}
html.dark .hdr-btn:hover {
  background-color: rgba(0, 80, 240, 0.22) !important;
  border-color: rgba(0, 163, 224, 0.45) !important;
  color: #38bdf8 !important;
}

.hdr-icon-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 38px;
  height: 38px;
  border-radius: 12px;
  cursor: pointer;
  position: relative;
  transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  background-color: #ffffff;
  border: 1px solid #e2e8f0;
  color: #475569;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.hdr-icon-btn:hover {
  background-color: #f8fafc;
  border-color: #cbd5e1;
  color: #0050f0;
}
html.dark .hdr-icon-btn {
  background-color: rgba(0, 80, 240, 0.12) !important;
  border-color: rgba(0, 80, 240, 0.26) !important;
  color: #cbd5e1 !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2) !important;
}
html.dark .hdr-icon-btn:hover {
  background-color: rgba(0, 80, 240, 0.22) !important;
  border-color: rgba(0, 163, 224, 0.45) !important;
  color: #38bdf8 !important;
}

.custom-role-scroll::-webkit-scrollbar { width: 4px; }
.custom-role-scroll::-webkit-scrollbar-thumb { background: rgba(148, 163, 184, 0.3); border-radius: 4px; }

a { text-decoration: none !important; }
</style>
</head>
<body x-data="adminApp()">

<!-- SIDEBAR -->
<aside id="admin-sidebar" :class="{'collapsed': sidebarCollapsed, 'mob': mobileMenuOpen}">
  <!-- Brand & Return to Site -->
  <div class="sidebar-brand-box p-4 border-b border-slate-200/80 dark:border-white/5 space-y-3">
    <div class="flex items-center justify-between min-h-[42px]">
      <a href="/admin-dashboard" class="flex items-center transition group overflow-hidden" title="RACHI - Gestão Inteligente">
        <!-- Logo Oficial RACHI (Expandido: Dark & Light) -->
        <div class="brand-full flex items-center">
          <img src="/images/logo-rachi-light.png" 
               alt="RACHI" 
               class="h-9 w-auto max-w-[185px] object-contain hidden dark:block transition duration-200 group-hover:scale-[1.02]"
               onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'">
          <img src="/images/logo-rachi-dark.png" 
               alt="RACHI" 
               class="h-9 w-auto max-w-[185px] object-contain block dark:hidden transition duration-200 group-hover:scale-[1.02]"
               onerror="this.onerror=null; this.src='/images/logo-rachi.png'">
        </div>
        <!-- Emblema Oficial RACHI (Recolhido / Collapsed) -->
        <div class="brand-emblem-collapsed hidden w-10 h-10 rounded-xl overflow-hidden items-center justify-start shrink-0 p-1 mx-auto bg-slate-100 dark:bg-white/5 border border-slate-200/80 dark:border-white/10 shadow-sm" title="RACHI">
          <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 max-w-none hidden dark:block" style="width: 72px; object-fit: cover; object-position: 0% 50%;">
          <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-8 max-w-none block dark:hidden" style="width: 72px; object-fit: cover; object-position: 0% 50%;">
        </div>
      </a>
    </div>

    <!-- BOTÃO PROMINENTE PARA RETORNAR AO SITE PRINCIPAL -->
    <a href="/" 
       class="site-back-btn w-full flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 dark:text-blue-300 dark:bg-blue-500/10 dark:hover:bg-blue-500/20 border border-blue-200/80 dark:border-blue-500/20 transition group shadow-sm"
       title="Voltar ao Site RACHI">
      <i data-lucide="arrow-left" class="w-4 h-4 flex-shrink-0 group-hover:-translate-x-1 transition duration-200"></i>
      <span class="site-back-text">Voltar ao Site RACHI</span>
      <i data-lucide="external-link" class="w-3.5 h-3.5 ms-auto opacity-70 site-back-text"></i>
    </a>
  </div>

  <!-- NAVIGATION -->
  <nav class="flex-1 py-3 space-y-0.5">
    <div class="sg">Controlo Geral</div>
    <div @click="setPage('dashboard')" :class="currentPage==='dashboard'?'active':''" class="sidebar-item" title="Visão Geral">
      <i data-lucide="layout-dashboard" class="si"></i>
      <span class="sl">Visão Geral</span>
    </div>

    <div class="sg">Administração</div>
    <div @click="setPage('usuarios')" :class="currentPage==='usuarios'?'active':''" class="sidebar-item" title="Perfis">
      <i data-lucide="users" class="si"></i>
      <span class="sl">Perfis</span>
      <span class="sb2 badge bg-blue-600 text-white text-[10px] px-2 rounded-full ms-auto font-bold">12</span>
    </div>
    <div @click="setPage('clientes')" :class="currentPage==='clientes'?'active':''" class="sidebar-item">
      <i data-lucide="building-2" class="si"></i>
      <span class="sl">Base de Clientes</span>
    </div>
    <div @click="setPage('solicitacoes')" :class="currentPage==='solicitacoes'?'active':''" class="sidebar-item">
      <i data-lucide="clipboard-list" class="si"></i>
      <span class="sl">Solicitações & Ordens</span>
      <span class="sb2 badge bg-amber-500 text-slate-950 font-bold text-[10px] px-2 rounded-full ms-auto" x-text="allRequests.length"></span>
    </div>

    <div class="sg">Unidades</div>
    <div>
      <div @click="toggleMenu('academy')" :class="currentPage.startsWith('academy')?'active':''" class="sidebar-item">
        <img src="/images/areas/rachi-academy.png" alt="RACHI Academy" class="w-5 h-5 object-contain shrink-0">
        <span class="sl">RACHI Academy</span>
        <i data-lucide="chevron-right" class="sa sl w-4 h-4 flex-shrink-0" :class="openMenus.academy?'open':''"></i>
      </div>
      <div class="sub-menu pl-2" x-show="openMenus.academy">
        <div @click="setPage('academy-cursos')" :class="currentPage==='academy-cursos'?'active':''" class="sidebar-item pl-10"><span class="sl">Cursos & Trilhas</span></div>
        <div @click="setPage('academy-alunos')" :class="currentPage==='academy-alunos'?'active':''" class="sidebar-item pl-10 flex items-center justify-between">
          <span class="sl">Alunos Matriculados</span>
          <span x-show="pendingEnrollmentsCount > 0" class="badge bg-amber-500 text-slate-950 font-bold text-[10px] px-2 py-0.5 rounded-full ms-auto animate-pulse" x-text="pendingEnrollmentsCount"></span>
        </div>
        <div @click="setPage('academy-matriculas')" :class="currentPage==='academy-matriculas'?'active':''" class="sidebar-item pl-10 flex items-center justify-between">
          <span class="sl">Inscrições & Turmas</span>
        </div>
      </div>
    </div>

    <div>
      <div @click="toggleMenu('loja')" :class="currentPage.startsWith('loja')?'active':''" class="sidebar-item">
        <img src="/images/areas/rachi-tec.png" alt="RACHI Tec" class="w-5 h-5 object-contain shrink-0">
        <span class="sl">RACHI Tec</span>
        <i data-lucide="chevron-right" class="sa sl w-4 h-4 flex-shrink-0" :class="openMenus.loja?'open':''"></i>
      </div>
      <div class="sub-menu pl-2" x-show="openMenus.loja">
        <div @click="setPage('loja-produtos')" :class="currentPage==='loja-produtos'?'active':''" class="sidebar-item pl-10"><span class="sl">Catálogo de Produtos</span></div>
        <div @click="setPage('loja-pedidos')" :class="currentPage==='loja-pedidos'?'active':''" class="sidebar-item pl-10"><span class="sl">Pedidos de Venda</span></div>
        <div @click="setPage('loja-estoque')" :class="currentPage==='loja-estoque'?'active':''" class="sidebar-item pl-10"><span class="sl">Controlo de Estoque</span></div>
      </div>
    </div>

    <div>
      <div @click="toggleMenu('rh')" :class="currentPage.startsWith('rh')?'active':''" class="sidebar-item">
        <img src="/images/areas/rachi-human-capital.png" alt="RACHI Human Capital" class="w-5 h-5 object-contain shrink-0">
        <span class="sl">RACHI Human Capital</span>
        <i data-lucide="chevron-right" class="sa sl w-4 h-4 flex-shrink-0" :class="openMenus.rh?'open':''"></i>
      </div>
      <div class="sub-menu pl-2" x-show="openMenus.rh">
        <div @click="setPage('rh-vagas')" :class="currentPage==='rh-vagas'?'active':''" class="sidebar-item pl-10"><span class="sl">Vagas Corporativas</span></div>
        <div @click="setPage('rh-candidatos')" :class="currentPage==='rh-candidatos'?'active':''" class="sidebar-item pl-10"><span class="sl">Banco de Talentos</span></div>
      </div>
    </div>

    <div>
      <div @click="toggleMenu('grafica')" :class="currentPage.startsWith('grafica')?'active':''" class="sidebar-item">
        <img src="/images/areas/rachi-print.png" alt="RACHI Print" class="w-5 h-5 object-contain shrink-0">
        <span class="sl">RACHI Print</span>
        <i data-lucide="chevron-right" class="sa sl w-4 h-4 flex-shrink-0" :class="openMenus.grafica?'open':''"></i>
      </div>
      <div class="sub-menu pl-2" x-show="openMenus.grafica">
        <div @click="setPage('grafica-produtos')" :class="currentPage==='grafica-produtos'?'active':''" class="sidebar-item pl-10"><span class="sl">Serviços Gráficos</span></div>
        <div @click="setPage('grafica-orcamentos')" :class="currentPage==='grafica-orcamentos'?'active':''" class="sidebar-item pl-10"><span class="sl">Orçamentos & Produção</span></div>
      </div>
    </div>

    <div class="sg">Performance</div>
    <div @click="setPage('financeiro')" :class="currentPage==='financeiro'?'active':''" class="sidebar-item">
      <i data-lucide="banknote" class="si"></i>
      <span class="sl">Finanças & Receitas</span>
    </div>
    <div @click="setPage('relatorios')" :class="currentPage==='relatorios'?'active':''" class="sidebar-item">
      <i data-lucide="bar-chart-3" class="si"></i>
      <span class="sl">Relatórios & Exportação</span>
    </div>

    <div class="sg">Configurações</div>
    <div @click="setPage('notificacoes')" :class="currentPage==='notificacoes'?'active':''" class="sidebar-item">
      <i data-lucide="bell" class="si"></i>
      <span class="sl">Notificações</span>
      <span class="sb2 badge bg-rose-500 text-white text-[10px] px-2 rounded-full ms-auto font-bold">5</span>
    </div>
    <div @click="setPage('configuracoes')" :class="currentPage==='configuracoes'?'active':''" class="sidebar-item">
      <i data-lucide="settings" class="si"></i>
      <span class="sl">Definições do Sistema</span>
    </div>
  </nav>

  <!-- Sidebar Footer: Logout -->
  <div class="sidebar-footer border-t border-slate-200/80 dark:border-white/5 p-2.5 bg-slate-50/50 dark:bg-white/[0.02]">
    <div class="sidebar-item hover:bg-rose-50 dark:hover:bg-rose-500/10 text-rose-600 dark:text-rose-400 group transition-colors" @click="logout()" title="Encerrar Sessão">
      <i data-lucide="log-out" class="si text-rose-500 group-hover:scale-110 transition-transform"></i>
      <span class="sl text-rose-600 dark:text-rose-400 text-xs font-bold">Encerrar Sessão</span>
    </div>
  </div>
</aside>

<div x-show="mobileMenuOpen" @click="mobileMenuOpen=false" class="fixed inset-0 bg-black/60 z-[99] md:hidden" x-cloak></div>

<!-- MAIN CONTENT -->
<div id="admin-main" :class="{'sc': sidebarCollapsed}">
  <header id="admin-header">
    <button @click="mobileMenuOpen=!mobileMenuOpen" class="md:hidden p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-600 dark:text-slate-400">
      <i data-lucide="menu" class="w-5 h-5"></i>
    </button>
    <button @click="sidebarCollapsed=!sidebarCollapsed" class="hidden md:flex p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-600 dark:text-slate-400 transition">
      <i data-lucide="panel-left-close" x-show="!sidebarCollapsed" class="w-5 h-5"></i>
      <i data-lucide="panel-left-open" x-show="sidebarCollapsed" x-cloak class="w-5 h-5"></i>
    </button>

    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm shrink-0">
      <span class="text-slate-400 dark:text-slate-500 font-semibold">Portal Executivo</span>
      <span class="text-slate-300 dark:text-slate-600 font-bold">/</span>
      <span class="font-extrabold text-slate-900 dark:text-white" x-text="pageTitle"></span>
    </div>

    <!-- SEARCH CENTRALIZADO E ESPAÇOSO -->
    <div class="flex-1 max-w-md mx-auto hidden md:block px-4">
      <div class="relative w-full">
        <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
        <input type="text" placeholder="Pesquisar pedidos, clientes, cursos..." class="ia pl-10 w-full py-2 text-xs">
      </div>
    </div>

    <div class="flex-1 md:hidden"></div>

    <!-- AÇÕES DO CABEÇALHO -->
    <div class="flex items-center gap-2.5">
      <!-- BOTÃO TOGGLE DARK/LIGHT MODE -->
      <button @click="toggleTheme()" 
              class="hdr-btn"
              :title="theme==='dark'?'Modo Claro':'Modo Escuro'">
        <i data-lucide="sun" class="w-4 h-4 text-amber-400" x-show="theme==='dark'"></i>
        <i data-lucide="moon" class="w-4 h-4 text-blue-500" x-show="theme==='light'"></i>
        <span class="text-xs font-bold hidden sm:inline" x-text="theme==='dark'?'Modo Claro':'Modo Escuro'"></span>
      </button>

      <!-- NOTIFICAÇÕES -->
      <button @click="setPage('notificacoes')" class="hdr-icon-btn" title="Notificações do Sistema">
        <i data-lucide="bell" class="w-4 h-4"></i>
        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full animate-ping"></span>
        <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full"></span>
      </button>

      <!-- PERFIL DO USUÁRIO -->
      <div class="flex items-center gap-2.5 pl-2.5 border-l border-slate-200 dark:border-blue-500/20">
        <div class="w-9 h-9 rounded-2xl bg-gradient-to-br from-[#0050f0] to-[#00a3e0] flex items-center justify-center text-white text-xs font-black shadow-md shadow-blue-500/25 shrink-0" x-text="adminUser.initials"></div>
        <div class="hidden sm:block">
          <div class="text-xs font-extrabold text-slate-900 dark:text-white" x-text="adminUser.nome"></div>
          <div class="text-[10px] text-blue-600 dark:text-[#38bdf8] font-bold uppercase tracking-wider">Super Administrador</div>
        </div>
      </div>
    </div>
  </header>

  <main class="p-4 sm:p-6 lg:p-7 max-w-[1520px] mx-auto space-y-6">

    <!-- DASHBOARD GERAL / HOME -->
    <section x-show="currentPage==='dashboard'" x-cloak class="space-y-6">

      <!-- BANNER DE BOAS-VINDAS ILUSTRATIVO & AMIGÁVEL -->
      <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-800 text-white p-6 sm:p-7 shadow-xl shadow-blue-500/15">
        <!-- Detalhes de arte e reflexos no fundo -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        <div class="absolute right-32 -top-10 w-48 h-48 rounded-full bg-cyan-400/20 blur-xl pointer-events-none"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div class="space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/15 backdrop-blur-md text-xs font-bold uppercase tracking-wider text-cyan-200 border border-white/20">
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Sistema Operacional 100% Online
            </div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white" style="font-family:Outfit">
              Olá, <span x-text="adminUser.nome"></span>! 👋
            </h1>
            <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
              Bem-vindo ao centro integrado da RACHI. Você tem <strong class="text-white underline decoration-amber-400 decoration-2"><span x-text="allRequests.length"></span> solicitações</strong> na Central e <strong class="text-white underline decoration-emerald-400 decoration-2">154 pedidos</strong> em processamento hoje.
            </p>
          </div>

          <div class="flex flex-wrap sm:flex-nowrap items-center gap-3">
            <button @click="setPage('solicitacoes')" class="px-5 py-3 rounded-2xl bg-white text-blue-700 hover:bg-blue-50 font-extrabold text-xs shadow-lg transition transform hover:-translate-y-0.5 flex items-center gap-2">
              <i data-lucide="clipboard-check" class="w-4 h-4 text-blue-600"></i>
              Revisar Solicitações
            </button>
            <a href="/" class="px-5 py-3 rounded-2xl bg-white/15 hover:bg-white/25 text-white font-extrabold text-xs backdrop-blur-md border border-white/25 transition transform hover:-translate-y-0.5 flex items-center gap-2">
              <i data-lucide="globe" class="w-4 h-4"></i>
              Abrir Site RACHI
            </a>
          </div>
        </div>
      </div>

      <!-- UNIDADES DA RACHI (CARDS ILUSTRATIVOS E AMIGÁVEIS) -->
      <div>
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
            <i data-lucide="grid" class="w-4 h-4 text-blue-600"></i> Unidades RACHI
          </h2>
          <span class="text-xs text-slate-500 font-semibold">Acesso rápido aos módulos</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
          <!-- 1. ACADEMY -->
          <div @click="setPage('academy-cursos')" class="kc unit-card cursor-pointer group border-t-4 border-t-indigo-500">
            <div class="flex items-start justify-between mb-3.5">
              <div class="w-16 h-16 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/90 dark:border-white/15 p-2 shadow-sm flex items-center justify-center group-hover:scale-105 group-hover:shadow-md transition-all duration-200">
                <img src="/images/areas/rachi-academy.png" alt="RACHI Academy" class="h-12 w-auto max-w-full object-contain drop-shadow-sm">
              </div>
              <span class="badge2 s-ativo">Ativo</span>
            </div>
            <div class="font-extrabold text-base text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition" style="font-family:Outfit">
              RACHI Academy
            </div>
            <p class="text-xs text-slate-500 mt-1">Capacitação, Cursos & Ensino Executivo</p>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
              <span class="font-bold text-slate-700 dark:text-slate-300">24 Cursos • 342 Alunos</span>
              <i data-lucide="arrow-right" class="w-4 h-4 text-indigo-500 group-hover:translate-x-1 transition"></i>
            </div>
          </div>

          <!-- 2. TEC -->
          <div @click="setPage('loja-produtos')" class="kc unit-card cursor-pointer group border-t-4 border-t-sky-500">
            <div class="flex items-start justify-between mb-3.5">
              <div class="w-16 h-16 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/90 dark:border-white/15 p-2 shadow-sm flex items-center justify-center group-hover:scale-105 group-hover:shadow-md transition-all duration-200">
                <img src="/images/areas/rachi-tec.png" alt="RACHI Tec" class="h-12 w-auto max-w-full object-contain drop-shadow-sm">
              </div>
              <span class="badge2 s-exec">Loja Aberta</span>
            </div>
            <div class="font-extrabold text-base text-slate-900 dark:text-white group-hover:text-sky-600 dark:group-hover:text-sky-400 transition" style="font-family:Outfit">
              RACHI Tec
            </div>
            <p class="text-xs text-slate-500 mt-1">Hardware, Notebooks & TI Corporativa</p>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
              <span class="font-bold text-slate-700 dark:text-slate-300">186 Itens • 154 Pedidos</span>
              <i data-lucide="arrow-right" class="w-4 h-4 text-sky-500 group-hover:translate-x-1 transition"></i>
            </div>
          </div>

          <!-- 3. HUMAN CAPITAL -->
          <div @click="setPage('rh-vagas')" class="kc unit-card cursor-pointer group border-t-4 border-t-emerald-500">
            <div class="flex items-start justify-between mb-3.5">
              <div class="w-16 h-16 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/90 dark:border-white/15 p-2 shadow-sm flex items-center justify-center group-hover:scale-105 group-hover:shadow-md transition-all duration-200">
                <img src="/images/areas/rachi-human-capital.png" alt="RACHI Human Capital" class="h-12 w-auto max-w-full object-contain drop-shadow-sm">
              </div>
              <span class="badge2 s-done">14 Vagas</span>
            </div>
            <div class="font-extrabold text-base text-slate-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition" style="font-family:Outfit">
              RACHI Human Capital
            </div>
            <p class="text-xs text-slate-500 mt-1">Recrutamento, Gestão de Pessoas & RH</p>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
              <span class="font-bold text-slate-700 dark:text-slate-300">89 Candidatos Ativos</span>
              <i data-lucide="arrow-right" class="w-4 h-4 text-emerald-500 group-hover:translate-x-1 transition"></i>
            </div>
          </div>

          <!-- 4. PRINT -->
          <div @click="setPage('grafica-produtos')" class="kc unit-card cursor-pointer group border-t-4 border-t-amber-500">
            <div class="flex items-start justify-between mb-3.5">
              <div class="w-16 h-16 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/90 dark:border-white/15 p-2 shadow-sm flex items-center justify-center group-hover:scale-105 group-hover:shadow-md transition-all duration-200">
                <img src="/images/areas/rachi-print.png" alt="RACHI Print" class="h-12 w-auto max-w-full object-contain drop-shadow-sm">
              </div>
              <span class="badge2 s-analise">38 Produções</span>
            </div>
            <div class="font-extrabold text-base text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition" style="font-family:Outfit">
              RACHI Print
            </div>
            <p class="text-xs text-slate-500 mt-1">Gráfica Rápida, Cartões, Banners & Brindes</p>
            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-xs">
              <span class="font-bold text-slate-700 dark:text-slate-300">22 Catálogos • AOA 8.09k</span>
              <i data-lucide="arrow-right" class="w-4 h-4 text-amber-500 group-hover:translate-x-1 transition"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- KPIS EXECUTIVOS COM ÍCONES E TENDÊNCIAS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <template x-for="kpi in kpis" :key="kpi.label">
          <div class="kc">
            <div class="flex items-center justify-between mb-3">
              <div class="w-12 h-12 rounded-2xl flex items-center justify-center shadow-sm" :class="kpi.iconBg">
                <i :data-lucide="kpi.icon" :class="kpi.iconColor" class="w-5 h-5"></i>
              </div>
              <span class="text-xs font-extrabold px-2.5 py-1 rounded-full flex items-center gap-1" 
                    :class="kpi.trend>0 ? 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20' : 'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 border border-rose-200 dark:border-rose-500/20'">
                <i :data-lucide="kpi.trend>0 ? 'trending-up' : 'trending-down'" class="w-3.5 h-3.5"></i>
                <span x-text="(kpi.trend>0?'+':'')+kpi.trend+'%'"></span>
              </span>
            </div>
            <div class="text-2xl lg:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="kpi.value"></div>
            <div class="text-xs font-semibold text-slate-500 dark:text-slate-400 mt-1" x-text="kpi.label"></div>
          </div>
        </template>
      </div>

      <!-- SEÇÃO VISUAL: GRÁFICO INTERATIVO & STATUS DAS SOLICITAÇÕES -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- GRÁFICO INTERATIVO DE FATURAMENTO / ATIVIDADE -->
        <div class="sc2 lg:col-span-2">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-4 mb-4 border-b border-slate-100 dark:border-white/5 gap-2">
            <div>
              <h3 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
                <i data-lucide="line-chart" class="w-4 h-4 text-blue-600"></i> Desempenho e Faturamento Mensal (AOA)
              </h3>
              <p class="text-xs text-slate-500 mt-0.5">Evolução de receitas consolidadas das 4 unidades em 2026</p>
            </div>
            <div class="flex items-center gap-1.5 bg-slate-100 dark:bg-white/5 p-1 rounded-xl text-xs font-bold">
              <span class="px-2.5 py-1 rounded-lg bg-white dark:bg-slate-800 text-blue-600 dark:text-blue-400 shadow-sm">2026</span>
              <span class="px-2.5 py-1 text-slate-500">Semestral</span>
            </div>
          </div>

          <div class="relative h-64 sm:h-72 w-full">
            <canvas id="revenueChart"></canvas>
          </div>
        </div>

        <!-- GRÁFICO DE PIZZA / DISTRIBUIÇÃO DAS SOLICITAÇÕES -->
        <div class="sc2 flex flex-col justify-between">
          <div>
            <h3 class="text-base font-extrabold text-slate-900 dark:text-white mb-1 flex items-center gap-2">
              <i data-lucide="pie-chart" class="w-4 h-4 text-amber-500"></i> Distribuição por Serviço
            </h3>
            <p class="text-xs text-slate-500 mb-4">Volume de pedidos e demandas por setor</p>
            <div class="relative h-44 w-full flex items-center justify-center">
              <canvas id="distributionChart"></canvas>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-white/5">
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-white/5 text-center">
              <div class="text-[10px] text-slate-500 font-bold uppercase">Academy</div>
              <div class="text-sm font-black text-indigo-600 dark:text-indigo-400">32 reqs</div>
            </div>
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-white/5 text-center">
              <div class="text-[10px] text-slate-500 font-bold uppercase">Loja / Tec</div>
              <div class="text-sm font-black text-sky-600 dark:text-sky-400">24 reqs</div>
            </div>
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-white/5 text-center">
              <div class="text-[10px] text-slate-500 font-bold uppercase">RH Capital</div>
              <div class="text-sm font-black text-emerald-600 dark:text-emerald-400">18 reqs</div>
            </div>
            <div class="p-2 rounded-xl bg-slate-50 dark:bg-white/5 text-center">
              <div class="text-[10px] text-slate-500 font-bold uppercase">Print</div>
              <div class="text-sm font-black text-amber-500">12 reqs</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ÚLTIMAS SOLICITAÇÕES COM TABELA MODERNA E BADGES COLORIDAS -->
      <div class="sc2 p-0 overflow-hidden">
        <div class="p-5 sm:p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 dark:border-white/5">
          <div>
            <h3 class="text-base font-extrabold text-slate-900 dark:text-white flex items-center gap-2">
              <i data-lucide="clock" class="w-4 h-4 text-blue-600"></i> Últimas Solicitações em Atendimento
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Acompanhamento dos clientes e status das ordens</p>
          </div>
          <button @click="setPage('solicitacoes')" class="bap text-xs py-2 px-4 shadow-none">
            Ver Todas as Solicitações <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
          </button>
        </div>

        <div class="overflow-x-auto">
          <table class="at">
            <thead>
              <tr>
                <th>Protocolo</th>
                <th>Cliente / Empresa</th>
                <th>Unidade</th>
                <th>Data</th>
                <th>Estado</th>
                <th>Responsável</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              <template x-for="req in allRequests.slice(0,5)" :key="req.id">
                <tr>
                  <td>
                    <span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-300 border border-blue-200 dark:border-blue-500/20" x-text="'#'+req.id"></span>
                  </td>
                  <td>
                    <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="req.cliente"></div>
                    <div class="text-xs text-slate-500 font-medium" x-text="req.empresa"></div>
                  </td>
                  <td>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300" x-text="req.servico"></span>
                  </td>
                  <td class="text-slate-500 text-xs font-medium" x-text="req.data"></td>
                  <td>
                    <span class="badge2" :class="req.sc">
                      <span class="w-1.5 h-1.5 rounded-full" :class="req.dot || 'bg-blue-500'"></span>
                      <span x-text="req.status"></span>
                    </span>
                  </td>
                  <td class="text-slate-700 dark:text-slate-300 text-xs font-semibold" x-text="req.responsavel"></td>
                  <td>
                    <button @click="openReq(req)" class="text-xs text-blue-600 dark:text-blue-400 font-bold px-3 py-1.5 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-500/10 transition border border-transparent hover:border-blue-200">
                      Abrir Detalhes
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- USUARIOS DO SISTEMA -->
    <section x-show="currentPage==='usuarios'" x-cloak class="space-y-6">
      <!-- HEADER -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-black bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20">
              <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
              <span>Segurança & Controlo de Acessos</span>
            </span>
          </div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão de Perfis</h1>
          <p class="text-slate-500 text-sm mt-0.5">Gestão de perfis, permissões, formadores, clientes e utilizadores do ecossistema.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="refreshUsers()" :disabled="isRefreshingUsers"
            class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition flex items-center gap-2 cursor-pointer border border-slate-200 dark:border-white/10">
            <i data-lucide="refresh-cw" class="w-3.5 h-3.5" :class="isRefreshingUsers ? 'animate-spin' : ''"></i>
            <span class="hidden sm:inline">Atualizar</span>
          </button>
          <button @click="openCreateUserModal()" class="bap flex items-center gap-2 cursor-pointer">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Adicionar Utilizador</span>
          </button>
        </div>
      </div>

      <!-- KPIS RAPIDOS -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <div class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="users" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.total"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Total de Contas</div>
          </div>
        </div>

        <div class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="shield" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.admins"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Admins & Gestores</div>
          </div>
        </div>

        <div class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="briefcase" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.staff"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Equipa & Instrutores</div>
          </div>
        </div>

        <div class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="graduation-cap" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.clients"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Alunos & Clientes</div>
          </div>
        </div>

        <div class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="user-x" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.blocked"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Bloqueados</div>
          </div>
        </div>

        <div @click="userFilterStatus = userFilterStatus === 'deleted' ? 'all' : 'deleted'"
          class="sc2 p-3.5 sm:p-4 rounded-2xl flex items-center gap-3 cursor-pointer transition hover:opacity-80"
          :class="userFilterStatus === 'deleted' ? 'ring-2 ring-slate-400/50' : ''">
          <div class="w-10 h-10 rounded-xl bg-slate-500/10 text-slate-500 dark:text-slate-400 flex items-center justify-center font-black shrink-0">
            <i data-lucide="trash-2" class="w-5 h-5"></i>
          </div>
          <div class="min-w-0">
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStats.deleted"></div>
            <div class="text-[11px] font-semibold text-slate-400 truncate">Eliminados</div>
          </div>
        </div>
      </div>

      <!-- FILTROS E BUSCA -->
      <div class="sc2 p-3 sm:p-3.5 rounded-2xl">
        <div class="flex flex-col md:flex-row items-center justify-between gap-2.5">
          <div class="relative flex-1 w-full">
            <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"></i>
            <input type="text" x-model="userSearch" placeholder="Pesquisar por nome, e-mail, telefone..."
              class="w-full pl-10 pr-9 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-hidden focus:border-[#0050f0]">
            <button x-show="userSearch" @click="userSearch = ''" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
              <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
          </div>

          <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 w-full md:w-auto">
            <select x-model="userFilterRole" class="ia w-full sm:w-auto text-xs py-2">
              <option value="all">Todos os Perfis / Cargos</option>
              <template x-for="r in rolesList" :key="r.id">
                <option :value="r.slug" x-text="r.name"></option>
              </template>
            </select>

            <select x-model="userFilterStatus" class="ia w-full sm:w-auto text-xs py-2">
              <option value="all">Todos os Status</option>
              <option value="active">Apenas Ativos</option>
              <option value="blocked">Apenas Bloqueados</option>
              <option value="deleted">Ver Eliminados</option>
            </select>
          </div>
        </div>
      </div>

      <!-- TABELA DE UTILIZADORES -->
      <div class="sc2 p-0">
        <div class="overflow-x-auto min-h-[380px] pb-6">
          <table class="at">
            <thead>
              <tr>
                <th>Utilizador</th>
                <th>Perfil de Acesso</th>
                <th>Estado</th>
                <th>Último Acesso</th>
                <th>Permissões / Módulos</th>
                <th class="text-right pr-6">Ações Rápidas</th>
              </tr>
            </thead>
            <tbody>
              <template x-for="(u, userIndex) in filteredUsers" :key="u.id">
                <tr class="transition" :class="u.is_deleted ? 'opacity-50 bg-slate-50/80 dark:bg-white/[0.01]' : 'hover:bg-slate-50/60 dark:hover:bg-white/[0.02]'">
                  <!-- UTILIZADOR -->
                  <td>
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-white text-xs font-black shadow-sm shrink-0" :class="u.av" x-text="u.ini"></div>
                      <div class="min-w-0">
                        <div class="font-bold text-sm flex items-center gap-2" :class="u.is_deleted ? 'text-slate-400 dark:text-slate-500 line-through' : 'text-slate-900 dark:text-white'">
                          <span x-text="u.nome" class="truncate"></span>
                          <template x-if="!u.is_deleted && (u.id === 1 || u.email === 'admin@rachi.ao' || u.email === 'casimirogundja@outlook.com')">
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-black bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">Master</span>
                          </template>
                          <template x-if="u.is_deleted">
                            <span class="px-1.5 py-0.5 rounded text-[9px] font-black bg-slate-200/80 dark:bg-white/10 text-slate-500 dark:text-slate-400 border border-slate-300/50 dark:border-white/10 no-underline" style="text-decoration:none">Eliminado</span>
                          </template>
                        </div>
                        <div class="text-xs font-medium truncate" :class="u.is_deleted ? 'text-slate-400 dark:text-slate-500' : 'text-slate-500'" x-text="u.email"></div>
                        <template x-if="u.is_deleted && u.deleted_at">
                          <div class="text-[10px] text-rose-400 font-medium mt-0.5 flex items-center gap-1">
                            <i data-lucide="trash-2" class="w-2.5 h-2.5"></i>
                            <span x-text="'Eliminado em ' + u.deleted_at"></span>
                          </div>
                        </template>
                        <template x-if="!u.is_deleted && u.telefone">
                          <div class="text-[11px] text-slate-400 font-mono mt-0.5 flex items-center gap-1">
                            <i data-lucide="phone" class="w-2.5 h-2.5"></i>
                            <span x-text="u.telefone"></span>
                          </div>
                        </template>
                      </div>
                    </div>
                  </td>

                  <!-- PERFIL DE ACESSO -->
                  <td class="relative">
                    <template x-if="!u.is_deleted">
                      <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left w-full max-w-[210px]">
                        <button type="button" 
                          @click="open = !open; $nextTick(() => { if (window.lucide) lucide.createIcons(); })"
                          class="w-full flex items-center justify-between gap-2 px-3 py-2 rounded-xl text-xs font-bold transition-all border shadow-2xs hover:shadow-xs group cursor-pointer"
                          :class="open ? 'bg-blue-50/80 dark:bg-blue-500/15 border-blue-500 text-blue-700 dark:text-blue-300 ring-2 ring-blue-500/20' : (u.tc + ' border-transparent hover:border-slate-300 dark:hover:border-white/20')">
                          <div class="flex items-center gap-2 truncate">
                            <span class="w-2 h-2 rounded-full shrink-0" :class="getRoleMeta(u.role_id).dot"></span>
                            <span class="truncate" x-text="u.tipo"></span>
                          </div>
                          <i data-lucide="chevron-down" class="w-3.5 h-3.5 shrink-0 transition-transform duration-200 opacity-60 group-hover:opacity-100" :class="open ? 'rotate-180 opacity-100' : ''"></i>
                        </button>
                        <div x-show="open" 
                          x-transition:enter="transition ease-out duration-150"
                          x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                          x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                          x-transition:leave="transition ease-in duration-100"
                          x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                          x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                          :class="userIndex >= (filteredUsers.length - 2) ? 'bottom-full mb-1.5' : 'top-full mt-1.5'"
                          class="absolute left-0 w-64 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-2xl p-1.5 z-50 overflow-hidden"
                          style="display: none;">
                          <div class="px-2.5 py-1.5 mb-1 border-b border-slate-100 dark:border-white/5 flex items-center justify-between">
                            <span class="text-[10px] font-black uppercase tracking-wider text-slate-400">Atribuir Perfil</span>
                            <span class="text-[10px] text-blue-500 font-bold" x-text="rolesList.length + ' opções'"></span>
                          </div>
                          <div class="space-y-0.5 max-h-60 overflow-y-auto pr-0.5 custom-role-scroll">
                            <template x-for="r in rolesList" :key="r.id">
                              <button type="button" 
                                @click="quickChangeRoleDirect(u, r.id); open = false; $nextTick(() => { if (window.lucide) lucide.createIcons(); });"
                                class="w-full flex items-center justify-between px-2.5 py-2 rounded-xl text-left text-xs transition-all duration-150 cursor-pointer group"
                                :class="u.role_id == r.id ? 'bg-blue-500/10 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300 font-black' : 'hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-300 font-semibold'">
                                <div class="flex items-center gap-2.5 min-w-0">
                                  <span class="w-2 h-2 rounded-full shrink-0" :class="getRoleMeta(r.id).dot"></span>
                                  <span class="truncate" x-text="r.name"></span>
                                </div>
                                <template x-if="u.role_id == r.id">
                                  <i data-lucide="check" class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400 shrink-0"></i>
                                </template>
                              </button>
                            </template>
                          </div>
                        </div>
                      </div>
                    </template>
                    <template x-if="u.is_deleted">
                      <span class="text-xs text-slate-400 italic px-3">—</span>
                    </template>
                  </td>

                  <!-- ESTADO -->
                  <td>
                    <template x-if="u.is_deleted">
                      <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400">
                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                        <span>Eliminado</span>
                      </span>
                    </template>
                    <template x-if="!u.is_deleted">
                      <button @click="toggleUserStatus(u)" title="Clique para alternar status do utilizador"
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black cursor-pointer transition"
                        :class="u.status === 'Ativo' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/20' : 'bg-rose-500/10 text-rose-600 dark:text-rose-400 hover:bg-rose-500/20'">
                        <span class="w-1.5 h-1.5 rounded-full" :class="u.status === 'Ativo' ? 'bg-emerald-500' : 'bg-rose-500'"></span>
                        <span x-text="u.status"></span>
                      </button>
                    </template>
                  </td>

                  <!-- ULTIMO ACESSO -->
                  <td>
                    <div class="text-xs font-medium whitespace-nowrap" :class="u.is_deleted ? 'text-slate-400 dark:text-slate-500' : 'text-slate-600 dark:text-slate-400'" x-text="u.ua"></div>
                    <div class="text-[10px] text-slate-400 mt-0.5" x-text="'Desde ' + (u.created_at || '2026')"></div>
                  </td>

                  <!-- PERMISSOES / MODULOS -->
                  <td>
                    <template x-if="!u.is_deleted">
                      <div class="flex flex-wrap gap-1 max-w-[200px]">
                        <template x-for="m in u.mod" :key="m">
                          <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 whitespace-nowrap" x-text="m"></span>
                        </template>
                      </div>
                    </template>
                    <template x-if="u.is_deleted">
                      <span class="text-xs text-slate-300 dark:text-slate-600 italic">—</span>
                    </template>
                  </td>

                  <!-- ACOES -->
                  <td class="text-right pr-6">
                    <div class="flex items-center justify-end gap-1">
                      <!-- Ver Detalhes -->
                      <button @click="openUserProfileModal(u)"
                        class="p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/10 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-white transition cursor-pointer"
                        title="Ver Perfil Completo">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                      </button>

                      <template x-if="!u.is_deleted">
                        <span class="flex items-center gap-1">
                          <!-- Editar -->
                          <button @click="openEditUserModal(u)"
                            class="p-2 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-500/10 text-blue-600 dark:text-blue-400 transition cursor-pointer"
                            title="Editar Informações & Perfil">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                          </button>

                          <!-- Bloquear / Desbloquear -->
                          <button @click="toggleUserStatus(u)"
                            class="p-2 rounded-xl transition cursor-pointer"
                            :class="u.status === 'Ativo' ? 'hover:bg-amber-50 dark:hover:bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'hover:bg-emerald-50 dark:hover:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400'"
                            :title="u.status === 'Ativo' ? 'Bloquear Acesso' : 'Desbloquear Acesso'">
                            <i :data-lucide="u.status === 'Ativo' ? 'lock' : 'unlock'" class="w-4 h-4"></i>
                          </button>

                          <!-- Redefinir Senha -->
                          <button @click="openResetPasswordModal(u)"
                            class="p-2 rounded-xl hover:bg-indigo-50 dark:hover:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 transition cursor-pointer"
                            title="Redefinir Palavra-passe">
                            <i data-lucide="key" class="w-4 h-4"></i>
                          </button>

                          <!-- Excluir (se não for master) -->
                          <template x-if="u.id !== 1 && u.email !== 'admin@rachi.ao' && u.email !== 'casimirogundja@outlook.com'">
                            <button @click="confirmDeleteUser(u)"
                              class="p-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10 text-rose-600 dark:text-rose-400 transition cursor-pointer"
                              title="Excluir Utilizador">
                              <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                          </template>
                        </span>
                      </template>
                    </div>
                  </td>
                </tr>
              </template>

              <!-- ESTADO VAZIO -->
              <tr x-show="filteredUsers.length === 0">
                <td colspan="6" class="text-center py-12">
                  <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i data-lucide="users" class="w-6 h-6"></i>
                  </div>
                  <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum utilizador encontrado</h4>
                  <p class="text-xs text-slate-500 mt-1">Nenhum resultado corresponde aos critérios de pesquisa ou filtros selecionados.</p>
                  <button @click="userSearch = ''; userFilterRole = 'all'; userFilterStatus = 'all';"
                    class="mt-3 px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/10 text-xs font-bold text-slate-700 dark:text-white hover:bg-slate-200 transition cursor-pointer">
                    Limpar Filtros
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- RODAPÉ RESUMO DA TABELA -->
        <div class="px-5 py-3 border-t border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500 dark:text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
          <div class="flex items-center gap-1.5">
            <span>A apresentar</span>
            <span class="font-bold text-slate-800 dark:text-slate-200" x-text="filteredUsers.length"></span>
            <span>de</span>
            <span class="font-bold text-slate-800 dark:text-slate-200" x-text="users.length"></span>
            <span>utilizadores</span>
          </div>
          <div class="flex items-center gap-1.5 text-[11px] text-slate-400">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
            <span>Sincronizado em tempo real</span>
          </div>
        </div>
      </div>
    </section>

    <!-- CLIENTES -->
    <section x-show="currentPage==='clientes'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Base de Clientes & Parceiros</h1>
          <p class="text-slate-500 text-sm mt-0.5">Empresas e particulares com histórico de contratação de serviços.</p>
        </div>
        <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Registar Cliente</button>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">1.248</div><div class="text-xs text-slate-500 mt-1 font-bold">Total Clientes</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">892</div><div class="text-xs text-slate-500 mt-1 font-bold">Ativos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">156</div><div class="text-xs text-slate-500 mt-1 font-bold">Pendentes</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">47</div><div class="text-xs text-slate-500 mt-1 font-bold">Contas Empresa</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Nome</th><th>Segmento</th><th>Telefone</th><th>Ordens</th><th>Estado</th><th>Cliente Desde</th></tr></thead>
            <tbody>
              <template x-for="c in clients" :key="c.id">
                <tr>
                  <td><div class="font-bold text-slate-900 dark:text-white text-sm" x-text="c.nome"></div><div class="text-xs text-slate-500" x-text="c.email"></div></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="c.tipo"></td>
                  <td class="text-slate-700 dark:text-slate-300 font-mono text-xs font-bold" x-text="c.tel"></td>
                  <td><span class="font-extrabold text-slate-900 dark:text-white" x-text="c.tr"></span><span class="text-xs text-slate-500 ml-1">pedidos</span></td>
                  <td><span class="badge2" :class="'s-'+c.sk" x-text="c.status"></span></td>
                  <td class="text-slate-500 text-xs font-medium" x-text="c.desde"></td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- CENTRAL DE SOLICITAÇÕES DETALHADA -->
    <section x-show="currentPage==='solicitacoes'" x-cloak>
      <template x-if="selectedRequest">
        <div class="space-y-6">
          <div class="flex items-center gap-3">
            <button @click="selectedRequest=null" class="p-2.5 rounded-2xl bg-white dark:bg-white/5 hover:bg-slate-100 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10 shadow-sm transition">
              <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </button>
            <div>
              <h1 class="text-2xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="'Solicitação #' + selectedRequest.id"></h1>
              <div class="flex items-center gap-2 mt-1">
                <span class="badge2" :class="selectedRequest.sc" x-text="selectedRequest.status"></span>
                <span class="text-xs text-slate-500 font-semibold" x-text="selectedRequest.servico + ' • ' + selectedRequest.data"></span>
              </div>
            </div>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="space-y-5 lg:col-span-2">
              <div class="sc2">
                <h3 class="text-base font-extrabold text-slate-900 dark:text-white mb-4">Informações do Pedido</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                  <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/5"><div class="text-xs text-slate-500 mb-1 font-semibold">Cliente Solicitante</div><div class="font-extrabold text-slate-900 dark:text-white" x-text="selectedRequest.cliente"></div></div>
                  <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/5"><div class="text-xs text-slate-500 mb-1 font-semibold">Empresa / Razão Social</div><div class="font-extrabold text-slate-900 dark:text-white" x-text="selectedRequest.empresa"></div></div>
                  <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/5"><div class="text-xs text-slate-500 mb-1 font-semibold">Unidade de Negócio</div><div class="font-extrabold text-slate-900 dark:text-white" x-text="selectedRequest.servico"></div></div>
                  <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/5"><div class="text-xs text-slate-500 mb-1 font-semibold">Técnico / Responsável</div><div class="font-extrabold text-slate-900 dark:text-white" x-text="selectedRequest.responsavel"></div></div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-100 dark:border-white/5">
                  <div class="text-xs text-slate-500 font-bold mb-2">Escopo da Demanda</div>
                  <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed p-3.5 rounded-xl bg-slate-50 dark:bg-white/5" x-text="selectedRequest.descricao"></p>
                </div>
              </div>

              <div class="sc2">
                <h3 class="text-base font-extrabold text-slate-900 dark:text-white mb-4">Atualizar Etapa do Fluxo</h3>
                <div class="flex flex-wrap gap-2.5">
                  <template x-for="s in wfStatuses" :key="s.key">
                    <button @click="updReqStatus(selectedRequest,s)" 
                            class="px-4 py-2 rounded-xl text-xs font-bold border transition shadow-sm" 
                            :class="selectedRequest.status===s.label?'border-blue-600 bg-blue-600 text-white shadow-md shadow-blue-500/25':'border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 bg-white dark:bg-white/5 hover:border-blue-400'" 
                            x-text="s.label"></button>
                  </template>
                </div>
              </div>

              <div class="sc2">
                <div class="flex items-center justify-between gap-3 mb-4">
                  <div>
                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Conversa com o cliente</h3>
                    <p class="text-xs text-slate-500 mt-1">As respostas ficam registadas no histórico desta solicitação.</p>
                  </div>
                  <button type="button" @click="refreshAdminRequests(true)" class="px-3 py-2 rounded-xl bg-slate-100 dark:bg-white/5 text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10">
                    Atualizar
                  </button>
                </div>
                <div class="space-y-3 max-h-96 overflow-y-auto mb-4 pr-1">
                  <template x-for="message in (selectedRequest.messages || [])" :key="message.id">
                    <div class="flex" :class="message.is_staff ? 'justify-end' : 'justify-start'">
                      <div class="max-w-[90%] rounded-2xl px-4 py-3 border" :class="message.is_staff ? 'bg-blue-50 border-blue-200 dark:bg-blue-500/10 dark:border-blue-500/20' : 'bg-slate-50 border-slate-200 dark:bg-white/5 dark:border-white/10'">
                        <div class="flex items-center justify-between gap-4 text-[11px] text-slate-500 mb-1">
                          <span class="font-bold" x-text="message.nome"></span>
                          <span x-text="message.data"></span>
                        </div>
                        <p class="text-sm text-slate-800 dark:text-slate-200 whitespace-pre-wrap break-words" x-text="message.message"></p>
                      </div>
                    </div>
                  </template>
                  <p x-show="!selectedRequest.messages || selectedRequest.messages.length === 0" class="text-sm text-slate-400 italic">Ainda não há mensagens nesta conversa.</p>
                </div>
                <form @submit.prevent="sendAdminReply()" class="space-y-2">
                  <textarea x-model="adminReplyDraft" required maxlength="2000" rows="3" placeholder="Escreva a resposta para o cliente..." class="ia resize-y min-h-20 text-sm"></textarea>
                  <div class="flex justify-end">
                    <button type="submit" :disabled="isSendingAdminReply || !adminReplyDraft.trim()" class="bap px-4 py-2 text-xs font-bold flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                      <i data-lucide="send" class="w-4 h-4"></i>
                      <span x-text="isSendingAdminReply ? 'A enviar...' : 'Enviar resposta'"></span>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <div class="sc2">
              <h3 class="text-base font-extrabold text-slate-900 dark:text-white mb-4">Histórico & Prazos</h3>
              <div class="space-y-4">
                <template x-for="(ev,idx) in selectedRequest.timeline" :key="idx">
                  <div class="tl">
                    <div class="tldot" :class="ev.dot"></div>
                    <div>
                      <div class="text-xs text-slate-500 font-bold" x-text="ev.data"></div>
                      <div class="text-sm font-semibold text-slate-800 dark:text-slate-200 mt-0.5" x-text="ev.desc"></div>
                    </div>
                  </div>
                </template>
              </div>
              <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5 space-y-2">
                <textarea placeholder="Adicionar nota técnica interna..." class="ia resize-none h-20 text-xs"></textarea>
                <button class="bap w-full justify-center text-xs">Salvar Nota Interna</button>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template x-if="!selectedRequest">
        <div class="space-y-6">
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
              <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Central de Solicitações & Ordens</h1>
              <p class="text-slate-500 text-sm mt-0.5">Gestão ponta a ponta dos atendimentos de todas as 4 unidades.</p>
            </div>
            <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Nova Ordem</button>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
            <template x-for="s in wfStatuses" :key="s.key">
              <div @click="reqFilterStatus = (reqFilterStatus === s.label ? 'Todos' : s.label)"
                   class="kc text-center py-3.5 cursor-pointer transition transform hover:-translate-y-0.5 hover:shadow-md select-none"
                   :class="reqFilterStatus === s.label ? 'ring-2 ring-blue-500 bg-blue-50/70 dark:bg-blue-500/15' : ''"
                   :title="'Filtrar por ' + s.label">
                <div class="text-xl font-black" :class="s.color" x-text="getStatusCount(s.key)"></div>
                <div class="text-[11px] text-slate-500 mt-1 font-bold" x-text="s.label"></div>
              </div>
            </template>
          </div>

          <div class="sc2 py-4">
            <div class="flex flex-wrap items-center gap-3">
              <button type="button" @click="refreshAdminRequests(true)" class="bap text-xs"><i data-lucide="refresh-cw" class="w-4 h-4"></i> Atualizar</button>
              <input type="text" x-model="reqFilterSearch" placeholder="Filtrar por protocolo, cliente ou termo..." class="ia flex-1 min-w-44">
              <select x-model="reqFilterUnit" class="ia w-auto">
                <option value="Todas">Todas as unidades</option>
                <option value="RACHI Academy">RACHI Academy</option>
                <option value="RACHI Tec">RACHI Tec</option>
                <option value="RACHI Human Capital">RACHI Human Capital</option>
                <option value="RACHI Print">RACHI Print</option>
              </select>
              <select x-model="reqFilterStatus" class="ia w-auto">
                <option value="Todos">Todos os estados</option>
                <option value="Novo">Novo</option>
                <option value="Em Análise">Em Análise</option>
                <option value="Orçamento">Orçamento</option>
                <option value="Ag. Cliente">Ag. Cliente</option>
                <option value="Em Execução">Em Execução</option>
                <option value="Concluído">Concluído</option>
                <option value="Cancelado">Cancelado</option>
              </select>
              <button x-show="reqFilterSearch || reqFilterUnit !== 'Todas' || reqFilterStatus !== 'Todos'" 
                      @click="reqFilterSearch = ''; reqFilterUnit = 'Todas'; reqFilterStatus = 'Todos'" 
                      class="px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-100 transition" 
                      title="Limpar filtros">
                Limpar Filtros
              </button>
            </div>
            <div class="mt-2 text-[11px] text-slate-400 font-medium px-1 flex items-center justify-between">
              <span>Exibindo <strong class="text-slate-700 dark:text-slate-200" x-text="filteredRequests.length"></strong> de <strong class="text-slate-700 dark:text-slate-200" x-text="allRequests.length"></strong> solicitações</span>
              <span x-show="reqFilterStatus !== 'Todos'" class="text-blue-600 dark:text-blue-400 font-bold" x-text="'Filtrado por: ' + reqFilterStatus"></span>
            </div>
          </div>

          <div class="sc2 p-0 overflow-hidden">
            <div class="overflow-x-auto">
              <table class="at">
                <thead><tr><th>Protocolo</th><th>Cliente</th><th>Unidade</th><th>Descrição</th><th>Data</th><th>Estado</th><th>Responsável</th><th></th></tr></thead>
                <tbody>
                  <template x-for="req in filteredRequests" :key="req.id">
                    <tr>
                      <td><span class="font-mono font-bold text-xs px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-300 border border-blue-200 dark:border-blue-500/20" x-text="'#'+req.id"></span></td>
                      <td>
                        <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="req.cliente"></div>
                        <div class="text-xs text-slate-500" x-text="req.empresa"></div>
                      </td>
                      <td><span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300" x-text="req.servico"></span></td>
                      <td class="text-slate-500 text-xs font-medium" style="max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap" x-text="req.descricao"></td>
                      <td class="text-slate-500 text-xs font-medium" x-text="req.data"></td>
                      <td><span class="badge2" :class="req.sc" x-text="req.status"></span></td>
                      <td class="text-slate-700 dark:text-slate-300 text-xs font-semibold" x-text="req.responsavel"></td>
                      <td><button @click="openReq(req)" class="text-xs text-blue-600 dark:text-blue-400 font-extrabold px-3 py-1.5 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-500/10">Abrir</button></td>
                    </tr>
                  </template>
                  <tr x-show="filteredRequests.length === 0">
                    <td colspan="8" class="text-center py-10 text-slate-400 text-xs italic">
                      Nenhuma solicitação encontrada com os filtros selecionados.
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </template>
    </section>

    <!-- MÓDULOS DE SUB-PÁGINAS (ACADEMY, LOJA, RH, PRINT, FINANÇAS, CONFIGURAÇÕES) -->
    <!-- ACADEMY -->
    <section x-show="currentPage==='academy-cursos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-academy.png" alt="RACHI Academy" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Academy — Cursos & Certificações</h1>
            <p class="text-slate-500 text-sm mt-0.5">Gestão do catálogo de formações presenciais e online em Angola.</p>
          </div>
        </div>
        <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Criar Novo Curso</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">24</div><div class="text-xs text-slate-500 mt-1 font-bold">Cursos no Catálogo</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">18</div><div class="text-xs text-slate-500 mt-1 font-bold">Turmas Ativas</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">342</div><div class="text-xs text-slate-500 mt-1 font-bold">Matrículas Totais</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">89</div><div class="text-xs text-slate-500 mt-1 font-bold">Diplomas Emitidos</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Título da Formação</th><th>Trilha</th><th>Formador</th><th>Inscritos</th><th>Carga</th><th>Preço</th><th>Aproveitamento</th><th>Status</th></tr></thead>
            <tbody>
              <template x-for="c in aCourses" :key="c.id">
                <tr>
                  <td><div class="font-bold text-slate-900 dark:text-white text-sm" x-text="c.titulo"></div><div class="text-xs text-slate-500" x-text="c.modulos+' módulos de aula'"></div></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="c.cat"></td>
                  <td class="text-slate-700 dark:text-slate-300 text-sm font-semibold" x-text="c.prof"></td>
                  <td class="font-black text-slate-900 dark:text-white" x-text="c.alunos"></td>
                  <td class="text-slate-500 text-xs font-medium" x-text="c.dur"></td>
                  <td class="text-emerald-600 dark:text-emerald-400 font-extrabold text-sm" x-text="c.preco"></td>
                  <td>
                    <div class="flex items-center gap-2">
                      <div class="pb flex-1" style="min-width:60px"><div class="pbf bg-indigo-500" :style="'width:'+c.taxa+'%'"></div></div>
                      <span class="text-xs text-slate-500 font-bold" x-text="c.taxa+'%'"></span>
                    </div>
                  </td>
                  <td><span class="badge2" :class="c.status==='Ativo'?'s-ativo':'s-inativo'" x-text="c.status"></span></td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- ACADEMY: ALUNOS MATRICULADOS & RECEBIMENTO DE SOLICITAÇÕES -->
    <section x-show="currentPage==='academy-alunos' || currentPage==='academy-matriculas'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <div class="flex items-center gap-2">
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">🎓 RACHI Academy — Alunos & Solicitações de Matrícula</h1>
            <span x-show="pendingEnrollmentsCount > 0" class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-500/20 text-amber-600 dark:text-amber-400 border border-amber-500/30 flex items-center gap-1 animate-pulse">
              <span class="w-2 h-2 rounded-full bg-amber-500"></span>
              <span x-text="pendingEnrollmentsCount + ' pendente(s)'"></span>
            </span>
          </div>
          <p class="text-slate-500 text-sm mt-0.5">Recebimento em tempo real de pré-matrículas pelo formulário do site e gestão de criação de alunos.</p>
        </div>
        <div class="flex items-center gap-2">
          <button type="button" @click="refreshEnrollments()" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 dark:hover:bg-white/15 text-slate-700 dark:text-slate-200 text-xs font-bold flex items-center gap-1.5 transition cursor-pointer" title="Atualizar dados">
            <i data-lucide="refresh-cw" class="w-3.5 h-3.5" :class="isRefreshing ? 'animate-spin' : ''"></i>
            <span>Atualizar</span>
          </button>
          <button type="button" @click="showCreateStudentModal = true" class="bap flex items-center gap-1.5">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Matricular Aluno</span>
          </button>
        </div>
      </div>

      <!-- KPIs Rápidos -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center">
          <div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="academyEnrollments.length"></div>
          <div class="text-xs text-slate-500 mt-1 font-bold">Total de Inscrições</div>
        </div>
        <div class="kc text-center border-2 border-amber-500/30 bg-amber-500/[0.03]">
          <div class="text-3xl font-black text-amber-500" style="font-family:Outfit" x-text="pendingEnrollmentsCount"></div>
          <div class="text-xs text-amber-600 dark:text-amber-400 mt-1 font-bold">Solicitações Pendentes</div>
        </div>
        <div class="kc text-center border-2 border-emerald-500/30 bg-emerald-500/[0.03]">
          <div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="activeEnrollmentsCount"></div>
          <div class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 font-bold">Alunos Ativos / Matriculados</div>
        </div>
        <div class="kc text-center">
          <div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit" x-text="coursesList.length"></div>
          <div class="text-xs text-slate-500 mt-1 font-bold">Cursos no Catálogo</div>
        </div>
      </div>

      <!-- Barra de Filtros e Busca -->
      <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3 bg-white dark:bg-[#0d1627] p-3 rounded-2xl border border-slate-200 dark:border-white/10 shadow-xs">
        <div class="flex flex-wrap items-center gap-1.5">
          <button type="button" @click="enrollmentFilter = 'all'"
            :class="enrollmentFilter === 'all' ? 'bg-[#0050f0] text-white shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
            class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer">
            Todas (<span x-text="academyEnrollments.length"></span>)
          </button>
          <button type="button" @click="enrollmentFilter = 'pending'"
            :class="enrollmentFilter === 'pending' ? 'bg-amber-500 text-slate-950 font-black shadow-xs' : 'bg-amber-500/10 text-amber-600 dark:text-amber-400 hover:bg-amber-500/20'"
            class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span>
            Pendentes (<span x-text="pendingEnrollmentsCount"></span>)
          </button>
          <button type="button" @click="enrollmentFilter = 'active'"
            :class="enrollmentFilter === 'active' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
            class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer">
            Aprovados / Ativos (<span x-text="activeEnrollmentsCount"></span>)
          </button>
          <button type="button" @click="enrollmentFilter = 'cancelled'"
            :class="enrollmentFilter === 'cancelled' ? 'bg-rose-600 text-white shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-white/10'"
            class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer">
            Cancelados
          </button>
        </div>

        <div class="relative min-w-[260px]">
          <input type="text" x-model="enrollmentSearch" placeholder="Buscar por aluno, email, telefone ou curso..."
            class="w-full pl-9 pr-3.5 py-1.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
        </div>
      </div>

      <!-- Tabela de Solicitações e Alunos -->
      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead>
              <tr>
                <th>Código</th>
                <th>Candidato / Aluno</th>
                <th>Contacto (WhatsApp)</th>
                <th>Formação Solicitada</th>
                <th>Data da Inscrição</th>
                <th>Status</th>
                <th class="text-right">Ações de Gestão</th>
              </tr>
            </thead>
            <tbody>
              <template x-for="item in filteredEnrollments" :key="item.id">
                <tr class="hover:bg-slate-50/50 dark:hover:bg-white/[0.02] transition-colors">
                  <!-- Código -->
                  <td class="font-mono text-xs font-bold text-slate-500 dark:text-slate-400" x-text="item.codigo"></td>

                  <!-- Aluno / Candidato -->
                  <td>
                    <div class="flex items-center gap-2.5">
                      <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#0050f0] to-[#00a3e0] text-white font-bold text-xs flex items-center justify-center shrink-0"
                        x-text="item.nome ? item.nome.substring(0, 2).toUpperCase() : 'AL'"></div>
                      <div>
                        <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="item.nome"></div>
                        <div class="text-[11px] text-slate-500" x-text="item.email"></div>
                      </div>
                    </div>
                  </td>

                  <!-- WhatsApp -->
                  <td>
                    <a :href="'https://wa.me/' + (item.telefone || '').replace(/[^0-9]/g, '')" target="_blank"
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-semibold transition"
                      title="Conversar no WhatsApp">
                      <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                      <span x-text="item.telefone || 'Sem número'"></span>
                    </a>
                  </td>

                  <!-- Curso -->
                  <td>
                    <div class="font-bold text-xs text-slate-900 dark:text-white max-w-[220px] truncate" x-text="item.curso"></div>
                    <a :href="'/academy/cursos/' + item.curso_slug" target="_blank" class="text-[10px] text-[#0050f0] dark:text-[#00a3e0] hover:underline flex items-center gap-0.5">
                      <span>Ver página do curso</span>
                      <i data-lucide="external-link" class="w-2.5 h-2.5"></i>
                    </a>
                  </td>

                  <!-- Data -->
                  <td class="text-xs text-slate-500 whitespace-nowrap" x-text="item.data"></td>

                  <!-- Status -->
                  <td>
                    <span x-show="item.status === 'pending'" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-500/15 text-amber-700 dark:text-amber-400 border border-amber-500/30">
                      <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-ping"></span>
                      Pendente
                    </span>
                    <span x-show="item.status === 'active'" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-500/15 text-emerald-700 dark:text-emerald-400 border border-emerald-500/30">
                      <i data-lucide="check" class="w-3 h-3"></i>
                      Aluno Ativo
                    </span>
                    <span x-show="item.status === 'cancelled'" class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-500/15 text-rose-700 dark:text-rose-400 border border-rose-500/30">
                      Cancelado
                    </span>
                  </td>

                  <!-- Ações -->
                  <td class="text-right">
                    <div class="inline-flex items-center gap-1.5 justify-end">
                      <!-- Se pendente: botão Aprovar -->
                      <button x-show="item.status === 'pending'" type="button" @click="approveEnrollment(item)"
                        class="px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition flex items-center gap-1 shadow-sm cursor-pointer"
                        title="Aprovar matrícula e criar acesso do aluno">
                        <i data-lucide="check-circle" class="w-3.5 h-3.5"></i>
                        <span>Aprovar Matrícula</span>
                      </button>

                      <!-- Se pendente: botão Rejeitar -->
                      <button x-show="item.status === 'pending'" type="button" @click="rejectEnrollment(item)"
                        class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-rose-100 text-slate-500 hover:text-rose-600 dark:bg-white/5 dark:hover:bg-rose-500/20 text-xs font-medium transition cursor-pointer"
                        title="Recusar solicitação">
                        <i data-lucide="x" class="w-3.5 h-3.5"></i>
                      </button>

                      <!-- Se ativo: Ver Acesso / Credenciais -->
                      <button x-show="item.status === 'active'" type="button" @click="selectedEnrollmentDetail = item"
                        class="px-3 py-1.5 rounded-xl bg-[#0050f0]/10 hover:bg-[#0050f0]/20 text-[#0050f0] dark:text-[#00a3e0] text-xs font-bold transition flex items-center gap-1 cursor-pointer">
                        <i data-lucide="key" class="w-3.5 h-3.5"></i>
                        <span>Ver Acesso</span>
                      </button>

                      <!-- Excluir Registo de Matrícula -->
                      <button type="button" @click="deleteEnrollment(item)"
                        class="p-1.5 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                        title="Excluir matrícula">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>

              <!-- Mensagem de Lista Vazia -->
              <tr x-show="filteredEnrollments.length === 0">
                <td colspan="7" class="text-center py-10 text-slate-400">
                  <div class="flex flex-col items-center justify-center gap-2">
                    <i data-lucide="inbox" class="w-8 h-8 opacity-40"></i>
                    <p class="text-sm font-medium">Nenhuma solicitação ou aluno encontrado para este filtro.</p>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- RODAPÉ RESUMO DA TABELA ACADEMY -->
        <div class="px-5 py-3 border-t border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500 dark:text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
          <div class="flex items-center gap-1.5">
            <span>A apresentar</span>
            <span class="font-bold text-slate-800 dark:text-slate-200" x-text="filteredEnrollments.length"></span>
            <span>de</span>
            <span class="font-bold text-slate-800 dark:text-slate-200" x-text="academyEnrollments.length"></span>
            <span>inscrições</span>
          </div>
          <div class="flex items-center gap-1.5 text-[11px] text-slate-400">
            <i data-lucide="graduation-cap" class="w-3.5 h-3.5 text-blue-500"></i>
            <span>RACHI Academy</span>
          </div>
        </div>
      </div>
    </section>

    <!-- LOJA PRODUTOS -->
    <section x-show="currentPage==='loja-produtos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-tec.png" alt="RACHI Tec" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Tec — Catálogo de Produtos</h1>
            <p class="text-slate-500 text-sm mt-0.5">Equipamentos, computadores, consumíveis e suprimentos de TI.</p>
          </div>
        </div>
        <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Adicionar Produto</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">186</div><div class="text-xs text-slate-500 mt-1 font-bold">Total Produtos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">154</div><div class="text-xs text-slate-500 mt-1 font-bold">Vendas do Mês</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">12</div><div class="text-xs text-slate-500 mt-1 font-bold">Estoque Crítico</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">20.5M</div><div class="text-xs text-slate-500 mt-1 font-bold">Receita (AOA)</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Item</th><th>SKU</th><th>Categoria</th><th>Valor Unitário</th><th>Estoque</th><th>Saídas</th><th>Status</th></tr></thead>
            <tbody>
              <template x-for="p in sProducts" :key="p.id">
                <tr>
                  <td><div class="font-bold text-slate-900 dark:text-white text-sm" x-text="p.nome"></div><div class="text-xs text-slate-500" x-text="p.marca"></div></td>
                  <td class="font-mono text-slate-500 text-xs font-bold" x-text="p.sku"></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="p.cat"></td>
                  <td class="text-emerald-600 dark:text-emerald-400 font-extrabold" x-text="p.preco"></td>
                  <td><span class="font-bold" :class="p.est<10?'text-rose-600 dark:text-rose-400':'text-slate-900 dark:text-white'" x-text="p.est"></span><span class="text-xs text-slate-500 ml-1">unidades</span></td>
                  <td class="text-slate-700 dark:text-slate-300 font-bold" x-text="p.vendas"></td>
                  <td><span class="badge2" :class="p.status==='Ativo'?'s-ativo':'s-inativo'" x-text="p.status"></span></td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- RH VAGAS -->
    <section x-show="currentPage==='rh-vagas'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-human-capital.png" alt="RACHI Human Capital" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Human Capital — Vagas & Recrutamento</h1>
            <p class="text-slate-500 text-sm mt-0.5">Processos de atração, seleção e consultoria de recursos humanos.</p>
          </div>
        </div>
        <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Publicar Vaga</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">14</div><div class="text-xs text-slate-500 mt-1 font-bold">Vagas Abertas</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">89</div><div class="text-xs text-slate-500 mt-1 font-bold">Candidatos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">23</div><div class="text-xs text-slate-500 mt-1 font-bold">Em Entrevista</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">8</div><div class="text-xs text-slate-500 mt-1 font-bold">Contratados</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Posição</th><th>Cliente Contratante</th><th>Local</th><th>Modelo</th><th>Faixa Salarial</th><th>Candidatos</th><th>Prazo</th><th>Status</th></tr></thead>
            <tbody>
              <template x-for="v in rhJobs" :key="v.id">
                <tr>
                  <td><div class="font-bold text-slate-900 dark:text-white" x-text="v.cargo"></div><div class="text-xs text-slate-500" x-text="v.req"></div></td>
                  <td class="text-slate-700 dark:text-slate-300 font-semibold" x-text="v.empresa"></td>
                  <td class="text-slate-500 text-xs" x-text="v.local"></td>
                  <td><span class="text-xs px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-400 font-bold" x-text="v.mod"></span></td>
                  <td class="text-emerald-600 dark:text-emerald-400 font-extrabold text-sm" x-text="v.sal"></td>
                  <td class="font-black text-slate-900 dark:text-white" x-text="v.cands"></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="v.prazo"></td>
                  <td><span class="badge2" :class="v.status==='Aberta'?'s-ativo':'s-inativo'" x-text="v.status"></span></td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- GRÁFICA PRODUTOS -->
    <section x-show="currentPage==='grafica-produtos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-print.png" alt="RACHI Print" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Print — Gestão da Produção Gráfica</h1>
            <p class="text-slate-500 text-sm mt-0.5">Controlo de tiragens, acabamentos, prazos e entregas gráficas.</p>
          </div>
        </div>
        <button class="bap"><i data-lucide="plus" class="w-4 h-4"></i> Novo Pedido Gráfico</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">22</div><div class="text-xs text-slate-500 mt-1 font-bold">Formatos Disponíveis</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">38</div><div class="text-xs text-slate-500 mt-1 font-bold">Em Tiragem</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-yellow-500" style="font-family:Outfit">15</div><div class="text-xs text-slate-500 mt-1 font-bold">Orçamentos Emitidos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">8.09M</div><div class="text-xs text-slate-500 mt-1 font-bold">Receita (AOA)</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Serviço / Produto</th><th>Especificação</th><th>Tamanho</th><th>Tiragem Mínima</th><th>Preço</th><th>Prazo</th><th>Status</th></tr></thead>
            <tbody>
              <template x-for="g in gProducts" :key="g.id">
                <tr>
                  <td><div class="font-bold text-slate-900 dark:text-white" x-text="g.nome"></div><div class="text-xs text-slate-500" x-text="g.desc"></div></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="g.mat"></td>
                  <td class="text-slate-500 text-xs font-mono font-bold" x-text="g.tam"></td>
                  <td class="text-slate-700 dark:text-slate-300 font-bold" x-text="g.qtm+' un.'"></td>
                  <td class="text-emerald-600 dark:text-emerald-400 font-extrabold" x-text="g.preco"></td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="g.prazo"></td>
                  <td><span class="badge2" :class="g.status==='Ativo'?'s-ativo':'s-inativo'" x-text="g.status"></span></td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- FINANCEIRO -->
    <section x-show="currentPage==='financeiro'" x-cloak class="space-y-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">💰 Gestão Financeira Consolidada</h1>
        <p class="text-slate-500 text-sm mt-0.5">Fluxo de caixa, recebimentos por unidade de negócio e saldos.</p>
      </div>

      <div class="sc2 bg-gradient-to-r from-blue-700 via-blue-600 to-indigo-800 text-white border-blue-500/30 shadow-xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <div class="text-xs text-cyan-200 font-extrabold uppercase tracking-widest mb-1.5">Faturamento Total do Mês (Setembro/2026)</div>
            <div class="text-4xl md:text-5xl font-black text-white" style="font-family:Outfit">AOA 45.890.000</div>
            <div class="text-sm text-emerald-300 font-bold flex items-center gap-1.5 mt-2">
              <i data-lucide="trending-up" class="w-4 h-4"></i> +12.4% acima da meta estabelecida
            </div>
          </div>
          <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-md flex items-center justify-center flex-shrink-0">
            <i data-lucide="wallet" class="text-cyan-200 w-8 h-8"></i>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <template x-for="f in finMods" :key="f.label">
          <div class="kc">
            <div class="flex items-center gap-2 mb-2">
              <span class="text-xl" x-text="f.icon"></span>
              <span class="text-xs font-bold text-slate-600 dark:text-slate-400" x-text="f.label"></span>
            </div>
            <div class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="'AOA '+f.value"></div>
            <div class="mt-3">
              <div class="pb"><div class="pbf" :class="f.bc" :style="'width:'+f.pct+'%'"></div></div>
              <div class="text-[11px] text-slate-500 font-bold mt-1.5" x-text="f.pct+'% da receita'"></div>
            </div>
          </div>
        </template>
      </div>

      <div class="sc2">
        <h3 class="text-base font-extrabold text-slate-900 dark:text-white mb-4">Últimas Transações Registadas</h3>
        <div class="space-y-3">
          <template x-for="t in txs" :key="t.id">
            <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-100 dark:border-white/5">
              <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-white dark:bg-white/10 flex items-center justify-center text-xl shadow-sm" x-text="t.icon"></div>
                <div>
                  <div class="text-sm font-bold text-slate-900 dark:text-white" x-text="t.desc"></div>
                  <div class="text-xs text-slate-500 font-medium" x-text="t.cli + ' • ' + t.data"></div>
                </div>
              </div>
              <div class="text-right">
                <div class="font-black text-sm" style="font-family:Outfit" :class="t.tipo==='entrada'?'text-emerald-600 dark:text-emerald-400':'text-rose-600 dark:text-rose-400'" x-text="(t.tipo==='entrada'?'+ ':'-')+' AOA '+t.valor"></div>
                <div class="text-[10px] text-slate-500 font-bold uppercase" x-text="t.mod"></div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </section>

    <!-- RELATÓRIOS -->
    <section x-show="currentPage==='relatorios'" x-cloak class="space-y-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">📈 Central de Relatórios Executivos</h1>
        <p class="text-slate-500 text-sm mt-0.5">Exportação instantânea de dados em Excel, CSV e PDF por unidade.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <template x-for="r in reports" :key="r.label">
          <div class="sc2 hover:border-blue-500/50 transition cursor-pointer group">
            <div class="flex items-start justify-between">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl shadow-sm" :class="r.bg" x-text="r.icon"></div>
                <div>
                  <div class="font-extrabold text-slate-900 dark:text-white text-base" x-text="r.label"></div>
                  <div class="text-xs text-slate-500 font-medium mt-0.5" x-text="r.desc"></div>
                </div>
              </div>
              <i data-lucide="arrow-right" class="text-slate-400 group-hover:text-blue-500 transition w-4 h-4 mt-1"></i>
            </div>
            <div class="flex gap-2 mt-5 pt-3.5 border-t border-slate-100 dark:border-white/5">
              <button class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-700 dark:text-slate-300 hover:text-blue-600 transition font-bold">Excel (.xlsx)</button>
              <button class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-700 dark:text-slate-300 hover:text-blue-600 transition font-bold">CSV</button>
              <button class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-700 dark:text-slate-300 hover:text-rose-600 transition font-bold">PDF</button>
            </div>
          </div>
        </template>
      </div>
    </section>

    <!-- NOTIFICAÇÕES -->
    <section x-show="currentPage==='notificacoes'" x-cloak class="space-y-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">🔔 Centro de Notificações</h1>
        <p class="text-slate-500 text-sm mt-0.5">Alertas de clientes, novos pedidos, estoques e tarefas pendentes.</p>
      </div>
      <div class="sc2 space-y-3.5">
        <template x-for="(n,idx) in notifs" :key="idx">
          <div class="flex items-start gap-4 p-4 rounded-2xl transition" 
               :class="n.lida ? 'opacity-55 bg-slate-50/50 dark:bg-white/[0.02]' : 'bg-blue-50/70 border border-blue-200/80 dark:bg-blue-500/5 dark:border-blue-500/20'">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 shadow-sm" :class="n.ib" x-text="n.icon"></div>
            <div class="flex-1 min-w-0">
              <div class="flex items-center gap-2">
                <span class="text-sm font-extrabold text-slate-900 dark:text-white" x-text="n.titulo"></span>
                <span x-show="!n.lida" class="w-2 h-2 bg-blue-600 rounded-full"></span>
              </div>
              <div class="text-xs text-slate-600 dark:text-slate-400 mt-1 font-medium leading-relaxed" x-text="n.msg"></div>
              <div class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5 font-bold" x-text="n.data"></div>
            </div>
            <button @click="n.lida=true" x-show="!n.lida" class="text-xs text-blue-600 dark:text-blue-400 font-bold px-3 py-1.5 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-500/10 flex-shrink-0 transition">
              Marcar lida
            </button>
          </div>
        </template>
      </div>
    </section>

    <!-- CONFIGURAÇÕES -->
    <section x-show="currentPage==='configuracoes'" x-cloak class="space-y-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">⚙️ Parâmetros & Configurações</h1>
        <p class="text-slate-500 text-sm mt-0.5">Dados institucionais, preferências de aparência e segurança.</p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="sc2 space-y-4">
          <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Dados da Organização</h3>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">Razão Social</label><input type="text" value="RACHI — Soluções Inteligentes Lda." class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">NIF / Identificação Fiscal</label><input type="text" value="5417000000" class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">E-mail Corporativo</label><input type="email" value="geral@rachi.ao" class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">Telefone Principal</label><input type="text" value="+244 923 000 000" class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">Endereço Principal</label><input type="text" value="Luanda, Angola" class="ia"></div>
          <button class="bap w-full justify-center mt-2">Gravar Alterações</button>
        </div>

        <div class="sc2 space-y-5">
          <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Aparência do Painel</h3>
          <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/80 dark:border-white/5">
            <div>
              <div class="text-sm font-extrabold text-slate-900 dark:text-white">Tema Visual</div>
              <div class="text-xs text-slate-500 mt-0.5" x-text="theme==='light'?'Atualmente no Modo Claro (Branco amigável)':'Atualmente no Modo Escuro (Dark luxo)'"></div>
            </div>
            <button @click="toggleTheme()" class="px-4 py-2 text-xs font-extrabold rounded-xl border border-slate-300 dark:border-white/10 bg-white dark:bg-slate-800 text-slate-800 dark:text-white shadow-sm flex items-center gap-2">
              <i data-lucide="sun" class="w-4 h-4 text-amber-500" x-show="theme==='dark'"></i>
              <i data-lucide="moon" class="w-4 h-4 text-blue-600" x-show="theme==='light'"></i>
              <span x-text="theme==='light'?'Ativar Dark':'Ativar Claro'"></span>
            </button>
          </div>

          <hr class="border-slate-200 dark:border-white/5">
          <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Segurança & Conexões</h3>
          <div class="flex items-center justify-between py-1">
            <div><div class="text-sm font-bold text-slate-900 dark:text-white">Registo de Auditoria</div><div class="text-xs text-slate-500">Registar todas as ações e alterações</div></div>
            <div class="w-11 h-6 bg-blue-600 rounded-full relative cursor-pointer"><div class="w-5 h-5 bg-white rounded-full absolute right-0.5 top-0.5 shadow"></div></div>
          </div>
          <div class="flex items-center justify-between py-1">
            <div><div class="text-sm font-bold text-slate-900 dark:text-white">Notificações Push / SMS</div><div class="text-xs text-slate-500">Alertas urgentes para novas solicitações</div></div>
            <div class="w-11 h-6 bg-blue-600 rounded-full relative cursor-pointer"><div class="w-5 h-5 bg-white rounded-full absolute right-0.5 top-0.5 shadow"></div></div>
          </div>
        </div>
      </div>
    </section>

    <!-- EM DESENVOLVIMENTO -->
    <section x-show="['academy-alunos','academy-matriculas','loja-pedidos','loja-estoque','rh-candidatos','grafica-orcamentos'].includes(currentPage)" x-cloak>
      <div class="sc2 text-center py-20">
        <div class="text-5xl mb-4">🚀</div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white mb-2" style="font-family:Outfit" x-text="pageTitle"></h2>
        <p class="text-slate-500 text-sm max-w-md mx-auto">Este submódulo está ativo e conectado em sincronia direta com os registros da base de dados.</p>
        <button @click="setPage('dashboard')" class="bap mt-5 inline-flex items-center gap-2">
          <i data-lucide="arrow-left" class="w-4 h-4"></i> Voltar à Visão Geral
        </button>
      </div>
    </section>

    <!-- MODAL 1: MATRICULAR ALUNO MANUALMENTE -->
    <div x-show="showCreateStudentModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="closeCreateStudentModal()" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] to-[#00a3e0]"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div>
            <h3 class="text-lg font-black text-slate-900 dark:text-white" style="font-family:Outfit">Matricular Novo Aluno</h3>
            <p class="text-xs text-slate-500">Pesquise um utilizador existente ou preencha os dados para criar um novo aluno.</p>
          </div>
          <button @click="closeCreateStudentModal()" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="saveNewStudent()" class="space-y-3.5">
          <div class="p-3 rounded-2xl bg-blue-50/70 dark:bg-blue-500/5 border border-blue-100 dark:border-blue-500/20 space-y-2">
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Pesquisar utilizador cadastrado</label>
            <div class="relative">
              <input type="search" x-model="academyUserSearch" :disabled="!!newStudentForm.user_id" placeholder="Nome ou e-mail do perfil"
                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0] disabled:opacity-60">
              <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
            </div>
            <div x-show="!newStudentForm.user_id && academyUserSearch.trim().length >= 2" x-cloak class="max-h-40 overflow-y-auto rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0d1627]">
              <template x-for="user in matchingAcademyUsers" :key="user.id">
                <button type="button" @click="selectRegisteredAcademyUser(user)" class="w-full text-left px-3 py-2.5 border-b last:border-b-0 border-slate-100 dark:border-white/5 hover:bg-blue-50 dark:hover:bg-white/5 transition">
                  <span class="block text-xs font-bold text-slate-800 dark:text-white" x-text="user.nome"></span>
                  <span class="block text-[11px] text-slate-500" x-text="user.email + (user.telefone ? ' · ' + user.telefone : '')"></span>
                </button>
              </template>
              <p x-show="matchingAcademyUsers.length === 0" class="px-3 py-3 text-xs text-slate-500">Nenhum utilizador disponível encontrado.</p>
            </div>
            <div x-show="newStudentForm.user_id" x-cloak class="flex items-center justify-between gap-2 text-xs text-emerald-700 dark:text-emerald-300">
              <span class="font-semibold">Perfil selecionado: <span x-text="selectedAcademyUser?.nome"></span></span>
              <button type="button" @click="clearRegisteredAcademyUser()" class="font-bold underline">Remover</button>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nome Completo *</label>
            <input type="text" x-model="newStudentForm.name" :readonly="!!newStudentForm.user_id" required placeholder="Nome do aluno"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">E-mail *</label>
            <input type="email" x-model="newStudentForm.email" :readonly="!!newStudentForm.user_id" required placeholder="aluno@email.com"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Telefone / WhatsApp *</label>
            <input type="tel" x-model="newStudentForm.phone" required placeholder="+244 923 000 000"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Formação / Curso *</label>
            <select x-model="newStudentForm.course_id" required
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
              <option value="">Selecione o curso...</option>
              <template x-for="c in coursesList" :key="c.id">
                <option :value="c.id" x-text="c.name"></option>
              </template>
            </select>
          </div>
          <p x-show="selectedAcademyUserAlreadyEnrolled" x-cloak class="text-xs font-semibold text-amber-600 dark:text-amber-400">
            Este utilizador já está matriculado neste curso.
          </p>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Status da Matrícula</label>
            <select x-model="newStudentForm.status"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
              <option value="active">Ativo (Acesso Liberado Imediatamente)</option>
              <option value="pending">Pendente (Aguardando Confirmação)</option>
            </select>
          </div>

          <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="closeCreateStudentModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
              Cancelar
            </button>
            <button type="submit" :disabled="selectedAcademyUserAlreadyEnrolled" class="bap px-5 py-2 text-xs font-bold flex items-center gap-1.5 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
              <i data-lucide="check" class="w-4 h-4"></i>
              <span>Confirmar Matrícula</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 2: DETALHES DA MATRÍCULA E CREDENCIAIS DO ALUNO -->
    <div x-show="selectedEnrollmentDetail" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="selectedEnrollmentDetail = null" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 to-[#00a3e0]"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div>
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 mb-1">
              Aluno Oficial da Academy
            </span>
            <h3 class="text-lg font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="selectedEnrollmentDetail?.nome"></h3>
          </div>
          <button @click="selectedEnrollmentDetail = null" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <div class="space-y-3 text-xs">
          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Código de Matrícula:</span>
            <span class="font-mono font-bold text-slate-900 dark:text-white text-sm" x-text="selectedEnrollmentDetail?.codigo"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Curso Matriculado:</span>
            <span class="font-bold text-slate-900 dark:text-white text-right max-w-[240px] truncate" x-text="selectedEnrollmentDetail?.curso"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">E-mail de Acesso:</span>
            <span class="font-bold text-slate-900 dark:text-white" x-text="selectedEnrollmentDetail?.email"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Senha Padrão / Temporária:</span>
            <span class="font-mono font-bold text-[#0050f0] dark:text-[#00a3e0] bg-blue-500/10 px-2 py-0.5 rounded">123456</span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Portal do Aluno:</span>
            <a href="/academy/login" target="_blank" class="font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline flex items-center gap-1">
              <span>Abrir Login (/academy/login)</span>
              <i data-lucide="external-link" class="w-3 h-3"></i>
            </a>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
          <a :href="'https://wa.me/' + (selectedEnrollmentDetail?.telefone || '').replace(/[^0-9]/g, '')" target="_blank"
            class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center gap-1.5 transition">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            <span>Contactar no WhatsApp</span>
          </a>
          <button @click="selectedEnrollmentDetail = null" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
            Fechar
          </button>
        </div>
      </div>
    </div>

    <!-- MODAL 3: ADICIONAR NOVO UTILIZADOR -->
    <div x-show="showCreateUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreateUserModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] to-[#00a3e0]"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div>
            <h3 class="text-lg font-black text-slate-900 dark:text-white" style="font-family:Outfit">Adicionar Novo Utilizador</h3>
            <p class="text-xs text-slate-500">Cadastre um utilizador e defina suas credenciais e perfil de acesso.</p>
          </div>
          <button @click="showCreateUserModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="saveUser()" class="space-y-3.5">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nome Completo *</label>
            <input type="text" x-model="userForm.nome" required placeholder="Ex: Manuel António Domingos"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">E-mail *</label>
              <input type="email" x-model="userForm.email" required placeholder="utilizador@rachi.ao"
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Telefone / WhatsApp</label>
              <input type="tel" x-model="userForm.telefone" placeholder="+244 923 000 000"
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Perfil / Cargo *</label>
              <select x-model="userForm.role_id" required
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
                <template x-for="r in rolesList" :key="r.id">
                  <option :value="r.id" x-text="r.name"></option>
                </template>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Estado da Conta</label>
              <select x-model="userForm.status"
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
                <option value="active">Ativo (Acesso Liberado)</option>
                <option value="blocked">Bloqueado</option>
                <option value="inactive">Inativo</option>
              </select>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-1">
              <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Palavra-passe Inicial</label>
              <button type="button" @click="generateUserPassword()" class="text-[11px] font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline cursor-pointer">
                Gerar Segura
              </button>
            </div>
            <div class="relative">
              <input type="text" x-model="userForm.password" placeholder="Mínimo 6 caracteres (padrão: 123456)"
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs font-mono text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
            </div>
          </div>

          <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreateUserModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
              Cancelar
            </button>
            <button type="submit" class="bap px-5 py-2 text-xs font-bold flex items-center gap-1.5 cursor-pointer">
              <i data-lucide="check" class="w-4 h-4"></i>
              <span>Criar Utilizador</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 4: EDITAR UTILIZADOR & ALTERAR PERFIL -->
    <div x-show="showEditUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showEditUserModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-500 to-[#0050f0]"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div>
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">Edição de Conta</span>
            <h3 class="text-lg font-black text-slate-900 dark:text-white mt-1" style="font-family:Outfit" x-text="'Editar: ' + (selectedUser?.nome || 'Utilizador')"></h3>
          </div>
          <button @click="showEditUserModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="updateUser()" class="space-y-3.5">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nome Completo *</label>
            <input type="text" x-model="userForm.nome" required
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">E-mail *</label>
              <input type="email" x-model="userForm.email" required
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Telefone / WhatsApp</label>
              <input type="tel" x-model="userForm.telefone" placeholder="+244 923 000 000"
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Perfil / Cargo *</label>
              <select x-model="userForm.role_id" required
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
                <template x-for="r in rolesList" :key="r.id">
                  <option :value="r.id" x-text="r.name"></option>
                </template>
              </select>
            </div>

            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Estado da Conta *</label>
              <select x-model="userForm.status" required
                class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-[#070f1e] border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
                <option value="active">Ativo (Permitir acesso)</option>
                <option value="blocked">Bloqueado (Acesso revogado)</option>
                <option value="inactive">Inativo</option>
              </select>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-1">
              <label class="text-xs font-bold text-slate-700 dark:text-slate-300">Nova Palavra-passe (Opcional)</label>
              <button type="button" @click="generateUserPassword()" class="text-[11px] font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline cursor-pointer">
                Gerar Nova
              </button>
            </div>
            <input type="text" x-model="userForm.password" placeholder="Deixe vazio para manter a palavra-passe atual"
              class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs font-mono text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0]">
          </div>

          <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showEditUserModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
              Cancelar
            </button>
            <button type="submit" class="bap px-5 py-2 text-xs font-bold flex items-center gap-1.5 cursor-pointer">
              <i data-lucide="check" class="w-4 h-4"></i>
              <span>Gravar Alterações</span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 5: VER PERFIL COMPLETO -->
    <div x-show="showUserProfileModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showUserProfileModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] to-purple-600"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white text-sm font-black shadow-md"
              :class="selectedUser?.av || 'bg-blue-600'" x-text="selectedUser?.ini || 'US'"></div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="selectedUser?.nome"></h3>
              <span class="text-[11px] font-bold px-2 py-0.5 rounded-lg" :class="selectedUser?.tc" x-text="selectedUser?.tipo"></span>
            </div>
          </div>
          <button @click="showUserProfileModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <div class="space-y-3 text-xs">
          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">E-mail:</span>
            <span class="font-bold text-slate-900 dark:text-white" x-text="selectedUser?.email"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Telefone / Contacto:</span>
            <span class="font-mono font-bold text-slate-900 dark:text-white" x-text="selectedUser?.telefone || 'Não informado'"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Estado do Acesso:</span>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-black"
              :class="selectedUser?.status === 'Ativo' ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400' : 'bg-rose-500/10 text-rose-600 dark:text-rose-400'">
              <span class="w-1.5 h-1.5 rounded-full" :class="selectedUser?.status === 'Ativo' ? 'bg-emerald-500' : 'bg-rose-500'"></span>
              <span x-text="selectedUser?.status"></span>
            </span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5 flex items-center justify-between">
            <span class="text-slate-500 font-semibold">Último Login:</span>
            <span class="font-medium text-slate-700 dark:text-slate-300" x-text="selectedUser?.ua"></span>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/5 border border-slate-200/60 dark:border-white/5">
            <span class="text-slate-500 font-semibold block mb-1.5">Módulos & Permissões Atribuídas:</span>
            <div class="flex flex-wrap gap-1.5">
              <template x-for="m in (selectedUser?.mod || [])" :key="m">
                <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20" x-text="m"></span>
              </template>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 dark:border-white/10 flex flex-wrap items-center justify-between gap-2">
          <div class="flex items-center gap-2">
            <button @click="showUserProfileModal = false; openEditUserModal(selectedUser)"
              class="px-3.5 py-2 rounded-xl bg-blue-50 hover:bg-blue-100 dark:bg-blue-500/10 dark:hover:bg-blue-500/20 text-blue-600 dark:text-blue-400 font-bold text-xs flex items-center gap-1.5 transition cursor-pointer">
              <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
              <span>Editar</span>
            </button>
            <button @click="showUserProfileModal = false; openResetPasswordModal(selectedUser)"
              class="px-3.5 py-2 rounded-xl bg-indigo-50 hover:bg-indigo-100 dark:bg-indigo-500/10 dark:hover:bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 font-bold text-xs flex items-center gap-1.5 transition cursor-pointer">
              <i data-lucide="key" class="w-3.5 h-3.5"></i>
              <span>Nova Senha</span>
            </button>
          </div>
          <button @click="showUserProfileModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
            Fechar
          </button>
        </div>
      </div>
    </div>

    <!-- MODAL 6: REDEFINIR PALAVRA-PASSE -->
    <div x-show="showResetPassModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showResetPassModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-md bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-indigo-500 to-purple-600"></div>
        
        <div class="flex items-center justify-between pb-3 mb-4 border-b border-slate-100 dark:border-white/10">
          <div>
            <h3 class="text-lg font-black text-slate-900 dark:text-white" style="font-family:Outfit">Redefinir Palavra-passe</h3>
            <p class="text-xs text-slate-500" x-text="'Gerar nova credencial para ' + (resetPassData.user?.nome || '')"></p>
          </div>
          <button @click="showResetPassModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <div class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Nova Palavra-passe Gerada</label>
            <div class="flex gap-2">
              <input type="text" x-model="resetPassData.newPassword"
                class="flex-1 px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-sm font-mono font-bold text-[#0050f0] dark:text-[#00a3e0] focus:outline-hidden">
              <button type="button" @click="resetPassData.newPassword = 'Rachi@' + Math.floor(1000 + Math.random() * 9000) + '!'"
                class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-xs font-bold text-slate-700 dark:text-white transition cursor-pointer"
                title="Gerar outra senha">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
              </button>
              <button type="button" @click="copyResetPassword()"
                class="px-3 py-2 rounded-xl bg-blue-500/10 hover:bg-blue-500/20 text-[#0050f0] dark:text-[#00a3e0] text-xs font-bold transition cursor-pointer"
                :title="resetPassData.copied ? 'Copiado!' : 'Copiar senha'">
                <i :data-lucide="resetPassData.copied ? 'check' : 'copy'" class="w-4 h-4"></i>
              </button>
            </div>
            <template x-if="resetPassData.copied">
              <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold mt-1">Palavra-passe copiada para a área de transferência!</p>
            </template>
          </div>

          <template x-if="resetPassData.user?.telefone">
            <div class="p-3 rounded-2xl bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-500/20 text-xs">
              <div class="font-bold text-emerald-800 dark:text-emerald-300 mb-1 flex items-center gap-1.5">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Enviar Directamente ao Utilizador</span>
              </div>
              <p class="text-[11px] text-emerald-700 dark:text-emerald-400 mb-2">Envie a nova palavra-passe com 1 clique para o WhatsApp do utilizador.</p>
              <a :href="'https://wa.me/' + (resetPassData.user?.telefone || '').replace(/[^0-9]/g, '') + '?text=' + encodeURIComponent('Olá ' + resetPassData.user?.nome + ', a sua nova palavra-passe de acesso ao sistema RACHI é: ' + resetPassData.newPassword)"
                target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition">
                <i data-lucide="send" class="w-3.5 h-3.5"></i>
                <span>Enviar pelo WhatsApp</span>
              </a>
            </div>
          </template>

          <div class="pt-3 flex items-center justify-end gap-2 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showResetPassModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
              Cancelar
            </button>
            <button type="button" @click="confirmResetPassword()" class="bap px-5 py-2 text-xs font-bold flex items-center gap-1.5 cursor-pointer">
              <i data-lucide="check" class="w-4 h-4"></i>
              <span>Confirmar Redefinição</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL 7: CONFIRMAR EXCLUSÃO DE UTILIZADOR -->
    <div x-show="showDeleteUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showDeleteUserModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-md bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-rose-500 to-red-600"></div>
        
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
          </div>
          <div>
            <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Excluir Utilizador</h3>
            <p class="text-xs text-slate-500">Esta ação é irreversível.</p>
          </div>
        </div>

        <p class="text-xs text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
          Tem certeza de que deseja excluir permanentemente o utilizador
          <strong class="text-slate-900 dark:text-white" x-text="userToDelete?.nome"></strong>
          (<span class="font-mono text-slate-500" x-text="userToDelete?.email"></span>)?
          Todos os acessos e permissões desta conta serão revogados.
        </p>

        <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100 dark:border-white/10">
          <button type="button" @click="showDeleteUserModal = false"
            class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
            Cancelar
          </button>
          <button type="button" @click="executeDeleteUser()"
            class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-500 text-white text-xs font-bold transition flex items-center gap-1.5 cursor-pointer">
            <i data-lucide="trash-2" class="w-4 h-4"></i>
            <span>Sim, Excluir Utilizador</span>
          </button>
        </div>
      </div>
    </div>

    <!-- MODAL 8: SELEÇÃO MODERNA DE PERFIL DE ACESSO -->
    <div x-show="showQuickRoleModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showQuickRoleModal = false" class="fixed inset-0 bg-slate-950/75 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-[#0050f0]/30 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <!-- Barra de destaque degradê -->
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#0070f3] to-[#00a3e0]"></div>
        
        <!-- Cabeçalho -->
        <div class="flex items-start justify-between pb-4 mb-4 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 shadow-xs">
              <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Alterar Perfil de Acesso</h3>
              <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                Defina o nível de permissões e módulos de sistema para <strong class="text-slate-800 dark:text-slate-200 font-bold" x-text="quickRoleUser?.nome || ''"></strong>
              </p>
            </div>
          </div>
          <button @click="showQuickRoleModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer transition">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <!-- Banner com Perfil Atual -->
        <div class="mb-4 px-4 py-2.5 rounded-2xl bg-slate-50 dark:bg-white/[0.03] border border-slate-200/70 dark:border-white/5 flex items-center justify-between">
          <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 font-medium">
            <i data-lucide="user-check" class="w-4 h-4 text-blue-500"></i>
            <span>Perfil selecionado atualmente:</span>
          </div>
          <span class="text-xs font-bold px-3 py-1 rounded-xl shadow-2xs" :class="quickRoleUser?.tc" x-text="quickRoleUser?.tipo"></span>
        </div>

        <!-- Grid de Cards de Perfis (2 colunas, moderno, espaçoso, sem scrollbar feia) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[62vh] overflow-y-auto pr-1">
          <template x-for="r in rolesList" :key="r.id">
            <button type="button" @click="quickChangeRole(r.id)"
              class="group relative p-3.5 rounded-2xl border text-left transition-all duration-200 cursor-pointer flex flex-col justify-between"
              :class="quickRoleUser?.role_id == r.id 
                ? 'bg-blue-500/10 border-blue-500/50 dark:bg-blue-500/15 ring-2 ring-blue-500/40 shadow-sm' 
                : 'bg-slate-50/70 hover:bg-slate-100/90 dark:bg-white/[0.03] dark:hover:bg-white/[0.07] border-slate-200/80 dark:border-white/10 hover:border-blue-400/40 hover:shadow-xs'">
              <div>
                <div class="flex items-center justify-between gap-2 mb-1.5">
                  <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center shrink-0 transition"
                      :class="quickRoleUser?.role_id == r.id ? 'bg-blue-500 text-white' : 'bg-slate-200/80 dark:bg-white/10 text-slate-600 dark:text-slate-300 group-hover:bg-blue-500/10 group-hover:text-blue-500'">
                      <i data-lucide="shield" class="w-3.5 h-3.5"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-900 dark:text-white" x-text="r.name"></span>
                  </div>

                  <template x-if="quickRoleUser?.role_id == r.id">
                    <span class="inline-flex items-center gap-1 text-[10px] font-black uppercase tracking-wider text-blue-600 dark:text-blue-400 bg-blue-500/15 px-2 py-0.5 rounded-md">
                      <i data-lucide="check" class="w-3 h-3"></i> Ativo
                    </span>
                  </template>
                </div>

                <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2" 
                   x-text="r.description || ('Nível de acesso ' + r.slug)"></p>
              </div>

              <div class="mt-3 pt-2.5 border-t border-slate-100 dark:border-white/5 flex items-center justify-between text-[10px]">
                <span class="font-mono uppercase text-[9px] px-1.5 py-0.5 rounded bg-slate-200/60 dark:bg-white/5 text-slate-500 dark:text-slate-400" x-text="r.slug"></span>
                <span class="font-semibold flex items-center gap-1 transition"
                  :class="quickRoleUser?.role_id == r.id ? 'text-blue-600 dark:text-blue-400' : 'text-slate-400 group-hover:text-blue-500'">
                  <span x-text="quickRoleUser?.role_id == r.id ? 'Perfil Ativo' : 'Atribuir Perfil'"></span>
                  <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </span>
              </div>
            </button>
          </template>
        </div>

        <!-- Rodapé do Modal -->
        <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
          <p class="text-xs text-slate-400 dark:text-slate-500 flex items-center gap-1.5">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-blue-500"></i>
            <span>1 clique atribui o perfil instantaneamente.</span>
          </p>
          <button type="button" @click="showQuickRoleModal = false" class="px-5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 dark:hover:bg-white/15 text-slate-700 dark:text-white text-xs font-bold transition cursor-pointer">
            Fechar
          </button>
        </div>
      </div>
    </div>

    <!-- TOAST ALERTS FLUTUANTES (FEEDBACK VISUAL PARA TODAS AS AÇÕES) -->
    <div class="fixed top-5 right-5 z-[999999] flex flex-col gap-2.5 max-w-sm w-full pointer-events-none px-4 sm:px-0" x-cloak>
      <template x-for="al in alerts" :key="al.id">
        <div class="pointer-events-auto w-full rounded-2xl p-4 shadow-2xl border backdrop-blur-xl transition-all duration-300 transform translate-y-0 relative overflow-hidden"
             :class="{
               'bg-white dark:bg-[#0c1527] border-emerald-500/40 text-slate-800 dark:text-white shadow-emerald-500/10': al.type === 'success',
               'bg-white dark:bg-[#0c1527] border-rose-500/40 text-slate-800 dark:text-white shadow-rose-500/10': al.type === 'error' || al.type === 'danger',
               'bg-white dark:bg-[#0c1527] border-amber-500/40 text-slate-800 dark:text-white shadow-amber-500/10': al.type === 'warning',
               'bg-white dark:bg-[#0c1527] border-blue-500/40 text-slate-800 dark:text-white shadow-blue-500/10': al.type === 'info'
             }">
          <!-- Barra decorativa no topo -->
          <div class="absolute top-0 left-0 right-0 h-1"
               :class="{
                 'bg-gradient-to-r from-emerald-500 to-teal-400': al.type === 'success',
                 'bg-gradient-to-r from-rose-500 to-red-600': al.type === 'error' || al.type === 'danger',
                 'bg-gradient-to-r from-amber-500 to-yellow-400': al.type === 'warning',
                 'bg-gradient-to-r from-blue-500 to-cyan-400': al.type === 'info'
               }"></div>

          <div class="flex items-start gap-3">
            <!-- Ícone dinâmico -->
            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 mt-0.5"
                 :class="{
                   'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400': al.type === 'success',
                   'bg-rose-500/15 text-rose-600 dark:text-rose-400': al.type === 'error' || al.type === 'danger',
                   'bg-amber-500/15 text-amber-600 dark:text-amber-400': al.type === 'warning',
                   'bg-blue-500/15 text-blue-600 dark:text-blue-400': al.type === 'info'
                 }">
              <template x-if="al.type === 'success'">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
              </template>
              <template x-if="al.type === 'error' || al.type === 'danger'">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
              </template>
              <template x-if="al.type === 'warning'">
                <i data-lucide="alert-triangle" class="w-5 h-5"></i>
              </template>
              <template x-if="al.type === 'info'">
                <i data-lucide="info" class="w-5 h-5"></i>
              </template>
            </div>

            <!-- Conteúdo do Alerta -->
            <div class="flex-1 min-w-0 pr-2">
              <h4 class="text-xs font-black tracking-tight" style="font-family:Outfit" x-text="al.title"></h4>
              <p class="text-[11px] text-slate-500 dark:text-slate-300 mt-0.5 leading-snug break-words" x-text="al.message"></p>
            </div>

            <!-- Botão Fechar -->
            <button type="button" @click="closeAlert(al.id)" class="text-slate-400 hover:text-slate-600 dark:hover:text-white p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition shrink-0 cursor-pointer">
              <i data-lucide="x" class="w-3.5 h-3.5"></i>
            </button>
          </div>
        </div>
      </template>
    </div>

  </main>
</div>

<!-- SCRIPTS E LÓGICA ALPINE.JS + CHART.JS -->
<script>
let revChartInstance = null;
let distChartInstance = null;

function renderCharts(theme) {
  const isDark = theme === 'dark';
  const textColor = isDark ? '#94a3b8' : '#64748b';
  const gridColor = isDark ? 'rgba(255, 255, 255, 0.06)' : 'rgba(0, 0, 0, 0.05)';

  // 1. Gráfico de Faturamento (Área)
  const ctxRev = document.getElementById('revenueChart');
  if (ctxRev) {
    if (revChartInstance) revChartInstance.destroy();
    revChartInstance = new Chart(ctxRev, {
      type: 'line',
      data: {
        labels: ['Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set'],
        datasets: [
          {
            label: 'Receita 2026 (Milhões AOA)',
            data: [28.4, 32.1, 35.8, 38.2, 40.8, 45.89],
            borderColor: '#0050f0',
            backgroundColor: isDark ? 'rgba(0, 80, 240, 0.25)' : 'rgba(0, 80, 240, 0.12)',
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointBackgroundColor: '#00a3e0',
            pointBorderColor: '#ffffff',
            pointRadius: 5,
            pointHoverRadius: 7
          },
          {
            label: 'Meta Prevista (Milhões AOA)',
            data: [25.0, 30.0, 33.0, 36.0, 39.0, 42.0],
            borderColor: isDark ? '#475569' : '#cbd5e1',
            borderDash: [5, 5],
            fill: false,
            tension: 0.4,
            borderWidth: 2,
            pointRadius: 0
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            labels: { color: textColor, font: { family: 'Plus Jakarta Sans', weight: '600', size: 11 } }
          },
          tooltip: {
            backgroundColor: isDark ? '#1e293b' : '#0f172a',
            titleFont: { family: 'Outfit', weight: '700' },
            bodyFont: { family: 'Plus Jakarta Sans' },
            padding: 12,
            cornerRadius: 12
          }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: textColor, font: { family: 'Plus Jakarta Sans', weight: '600' } }
          },
          y: {
            grid: { color: gridColor },
            ticks: { color: textColor, font: { family: 'Plus Jakarta Sans' }, callback: val => 'AOA ' + val + 'M' }
          }
        }
      }
    });
  }

  // 2. Gráfico de Pizza / Donut (Distribuição)
  const ctxDist = document.getElementById('distributionChart');
  if (ctxDist) {
    if (distChartInstance) distChartInstance.destroy();
    distChartInstance = new Chart(ctxDist, {
      type: 'doughnut',
      data: {
        labels: ['Academy', 'Loja/Tec', 'Human Capital', 'Print'],
        datasets: [{
          data: [32, 24, 18, 12],
          backgroundColor: ['#6366f1', '#0ea5e9', '#10b981', '#f59e0b'],
          borderWidth: isDark ? 2 : 3,
          borderColor: isDark ? '#131728' : '#ffffff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false },
          tooltip: {
            backgroundColor: isDark ? '#1e293b' : '#0f172a',
            titleFont: { family: 'Outfit', weight: '700' },
            bodyFont: { family: 'Plus Jakarta Sans' },
            padding: 10,
            cornerRadius: 10
          }
        },
        cutout: '72%'
      }
    });
  }
}

function adminApp() {
  return {
    currentPage: 'dashboard',
    sidebarCollapsed: false,
    mobileMenuOpen: false,
    selectedRequest: null,
    // Tema padrão é 'light' (Branco/Claro elegante)
    theme: localStorage.getItem('rachi_admin_theme') || 'light',
    openMenus: { academy: false, loja: false, rh: false, grafica: false },
    adminUser: {
      nome: <?php echo json_encode(auth()->user()?->name ?? 'Super Administrador RACHI'); ?>,
      email: <?php echo json_encode(auth()->user()?->email ?? 'admin@rachi.ao'); ?>,
      initials: '<?php echo e(auth()->check() && auth()->user()->name ? strtoupper(mb_substr(auth()->user()->name, 0, 2)) : 'SA'); ?>'
    },
    academyEnrollments: <?php echo json_encode($academyEnrollments ?? [], 15, 512) ?>,
    coursesList: <?php echo json_encode($coursesList ?? [], 15, 512) ?>,
    users: <?php echo json_encode($systemUsers ?? [], 15, 512) ?>,
    rolesList: <?php echo json_encode($systemRoles ?? [], 15, 512) ?>,
    userSearch: '',
    userFilterRole: 'all',
    userFilterStatus: 'all',
    isRefreshingUsers: false,
    showCreateUserModal: false,
    showEditUserModal: false,
    showUserProfileModal: false,
    showResetPassModal: false,
    showDeleteUserModal: false,
    showQuickRoleModal: false,
    selectedUser: null,
    userToDelete: null,
    quickRoleUser: null,
    resetPassData: { user: null, newPassword: '', copied: false },
    alerts: [],
    adminReplyDraft: '',
    isSendingAdminReply: false,

    showAlert(type = 'success', title = 'Sucesso', message = '', duration = 4500) {
      const id = Date.now() + Math.random();
      this.alerts.push({ id, type, title, message });
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      if (duration > 0) {
        setTimeout(() => { this.closeAlert(id); }, duration);
      }
    },

    closeAlert(id) {
      const idx = this.alerts.findIndex(a => a.id === id);
      if (idx !== -1) {
        this.alerts.splice(idx, 1);
      }
    },

    userForm: {
      id: null,
      nome: '',
      email: '',
      telefone: '',
      role_id: 1,
      status: 'active',
      password: ''
    },

    getRoleMeta(id) {
      const map = {
        1: { name: 'Super Admin', dot: 'bg-amber-500' },
        2: { name: 'Admin', dot: 'bg-blue-500' },
        3: { name: 'Gestor', dot: 'bg-cyan-500' },
        4: { name: 'Funcionário', dot: 'bg-purple-500' },
        5: { name: 'Atendente', dot: 'bg-emerald-500' },
        6: { name: 'Cliente', dot: 'bg-slate-400' },
        7: { name: 'Aluno', dot: 'bg-sky-500' },
        8: { name: 'Instrutor', dot: 'bg-indigo-500' },
        9: { name: 'Especialista RH', dot: 'bg-orange-500' }
      };
      return map[id] || { name: 'Utilizador', dot: 'bg-blue-500' };
    },

    get userStats() {
      const all = this.users || [];
      const active = all.filter(u => !u.is_deleted);
      return {
        total: active.length,
        admins: active.filter(u => ['super_admin', 'admin', 'manager'].includes(u.role_slug) || (u.tipo && u.tipo.includes('Admin'))).length,
        staff: active.filter(u => ['employee', 'instructor', 'rh_specialist', 'attendant'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Funcionário') || u.tipo.includes('Instrutor') || u.tipo.includes('Especialista')))).length,
        clients: active.filter(u => ['customer', 'student'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Aluno') || u.tipo.includes('Cliente')))).length,
        blocked: active.filter(u => u.raw_status === 'blocked' || u.status === 'Bloqueado').length,
        deleted: all.filter(u => u.is_deleted).length
      };
    },

    get filteredUsers() {
      let list = this.users || [];
      if (this.userFilterRole !== 'all') {
        list = list.filter(u => u.role_slug === this.userFilterRole || u.role_id == this.userFilterRole);
      }
      if (this.userFilterStatus !== 'all') {
        list = list.filter(u => {
          if (this.userFilterStatus === 'active') return !u.is_deleted && (u.status === 'Ativo' || u.raw_status === 'active');
          if (this.userFilterStatus === 'blocked') return !u.is_deleted && (u.status === 'Bloqueado' || u.raw_status === 'blocked');
          if (this.userFilterStatus === 'deleted') return u.is_deleted === true;
          return true;
        });
      }
      if (this.userSearch && this.userSearch.trim()) {
        const q = this.userSearch.toLowerCase().trim();
        list = list.filter(u =>
          (u.nome && u.nome.toLowerCase().includes(q)) ||
          (u.email && u.email.toLowerCase().includes(q)) ||
          (u.telefone && u.telefone.toLowerCase().includes(q)) ||
          (u.tipo && u.tipo.toLowerCase().includes(q))
        );
      }
      return list;
    },

    enrollmentFilter: 'all',
    enrollmentSearch: '',
    academyUserSearch: '',
    selectedAcademyUser: null,
    showCreateStudentModal: false,
    selectedEnrollmentDetail: null,
    isRefreshing: false,
    newStudentForm: {
      user_id: '',
      name: '',
      email: '',
      phone: '',
      course_id: '',
      status: 'active'
    },

    get pendingEnrollmentsCount() {
      return (this.academyEnrollments || []).filter(e => e.status === 'pending').length;
    },

    get activeEnrollmentsCount() {
      return (this.academyEnrollments || []).filter(e => e.status === 'active').length;
    },

    get filteredEnrollments() {
      let list = this.academyEnrollments || [];
      if (this.enrollmentFilter !== 'all') {
        list = list.filter(e => e.status === this.enrollmentFilter);
      }
      if (this.enrollmentSearch && this.enrollmentSearch.trim()) {
        const q = this.enrollmentSearch.toLowerCase().trim();
        list = list.filter(e => 
          (e.nome && e.nome.toLowerCase().includes(q)) ||
          (e.email && e.email.toLowerCase().includes(q)) ||
          (e.telefone && e.telefone.toLowerCase().includes(q)) ||
          (e.curso && e.curso.toLowerCase().includes(q)) ||
          (e.codigo && e.codigo.toLowerCase().includes(q))
        );
      }
      return list;
    },

    get matchingAcademyUsers() {
      const query = (this.academyUserSearch || '').trim().toLowerCase();
      if (query.length < 2) return [];
      return (this.users || [])
        .filter(user => !user.is_deleted && user.raw_status !== 'deleted')
        .filter(user => {
          const alreadyEnrolled = (this.academyEnrollments || []).some(enrollment =>
            String(enrollment.user_id || '') === String(user.id) &&
            String(enrollment.course_id || '') === String(this.newStudentForm.course_id) &&
            enrollment.status !== 'cancelled'
          );
          const searchable = `${user.nome || ''} ${user.email || ''} ${user.telefone || ''}`.toLowerCase();
          return !alreadyEnrolled && searchable.includes(query);
        })
        .slice(0, 8);
    },

    get selectedAcademyUserAlreadyEnrolled() {
      if (!this.newStudentForm.user_id || !this.newStudentForm.course_id) return false;
      return (this.academyEnrollments || []).some(enrollment =>
        String(enrollment.user_id || '') === String(this.newStudentForm.user_id) &&
        String(enrollment.course_id || '') === String(this.newStudentForm.course_id) &&
        enrollment.status !== 'cancelled'
      );
    },

    selectRegisteredAcademyUser(user) {
      this.selectedAcademyUser = user;
      this.newStudentForm.user_id = user.id;
      this.newStudentForm.name = user.nome || '';
      this.newStudentForm.email = user.email || '';
      this.newStudentForm.phone = user.telefone || '';
      this.academyUserSearch = '';
    },

    closeCreateStudentModal() {
      this.showCreateStudentModal = false;
      this.selectedAcademyUser = null;
      this.academyUserSearch = '';
      this.newStudentForm = { user_id: '', name: '', email: '', phone: '', course_id: '', status: 'active' };
    },

    clearRegisteredAcademyUser() {
      this.selectedAcademyUser = null;
      this.newStudentForm.user_id = '';
      this.newStudentForm.name = '';
      this.newStudentForm.email = '';
      this.newStudentForm.phone = '';
    },

    async approveEnrollment(item) {
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/academy/enrollments/' + item.id + '/status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ status: 'active' })
        });
        const data = await res.json();
        if (data.success) {
          item.status = 'active';
          if (window.lucide) this.$nextTick(() => lucide.createIcons());
          this.notifs.unshift({
            icon: '🎓',
            ib: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400',
            titulo: 'Matrícula Aprovada',
            msg: `O aluno ${item.nome} foi aprovado e ativado no curso ${item.curso}.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Matrícula Aprovada', `A matrícula de ${item.nome} foi confirmada e o acesso ativado!`);
        } else {
          this.showAlert('error', 'Falha na Aprovação', data.message || 'Não foi possível aprovar a matrícula.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro no Servidor', 'Erro ao aprovar matrícula do aluno.');
      }
    },

    async rejectEnrollment(item) {
      if (!confirm('Deseja realmente recusar / cancelar esta solicitação de matrícula?')) return;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/academy/enrollments/' + item.id + '/status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ status: 'cancelled' })
        });
        const data = await res.json();
        if (data.success) {
          item.status = 'cancelled';
          if (window.lucide) this.$nextTick(() => lucide.createIcons());
          this.showAlert('warning', 'Matrícula Cancelada', `A solicitação de ${item.nome} foi cancelada com sucesso.`);
        } else {
          this.showAlert('error', 'Erro ao Cancelar', data.message || 'Não foi possível cancelar.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro no Servidor', 'Erro ao cancelar inscrição.');
      }
    },

    async deleteEnrollment(item) {
      if (!confirm(`Deseja realmente excluir a matrícula de ${item.nome}?`)) return;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/academy/enrollments/' + item.id + '/delete', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          }
        });
        const data = await res.json();
        if (data.success) {
          this.academyEnrollments = this.academyEnrollments.filter(e => e.id !== item.id);
          if (window.lucide) this.$nextTick(() => lucide.createIcons());
          this.showAlert('success', 'Matrícula Excluída', data.message || `A matrícula de ${item.nome} foi excluída com sucesso.`);
        } else {
          this.showAlert('error', 'Falha ao Excluir', data.message || 'Não foi possível excluir a matrícula.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro no Servidor', 'Erro ao excluir matrícula.');
      }
    },

    async saveNewStudent() {
      if (this.selectedAcademyUserAlreadyEnrolled) {
        this.showAlert('warning', 'Utilizador já matriculado', 'Este utilizador já está matriculado neste curso.');
        return;
      }
      if (!this.newStudentForm.name || !this.newStudentForm.email || !this.newStudentForm.phone || !this.newStudentForm.course_id) {
        this.showAlert('warning', 'Campos Obrigatórios', 'Por favor, preencha todos os campos obrigatórios da matrícula.');
        return;
      }
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/academy/enrollments/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify(this.newStudentForm)
        });
        const data = await res.json();
        if (data.success && data.enrollment) {
          this.academyEnrollments.unshift(data.enrollment);
          this.showCreateStudentModal = false;
          const studentName = data.enrollment.nome;
          this.newStudentForm = { user_id: '', name: '', email: '', phone: '', course_id: '', status: 'active' };
          this.selectedAcademyUser = null;
          this.academyUserSearch = '';
          if (window.lucide) this.$nextTick(() => lucide.createIcons());
          this.notifs.unshift({
            icon: '🎓',
            ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
            titulo: 'Novo Aluno Matriculado',
            msg: `${studentName} matriculado manualmente com sucesso.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Matrícula Realizada', `O aluno ${studentName} foi matriculado com sucesso!`);
        } else {
          this.showAlert('error', 'Falha na Matrícula', data.message || 'Não foi possível cadastrar a matrícula.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro no Servidor', 'Erro de comunicação ao matricular aluno.');
      }
    },

    async refreshEnrollments() {
      this.isRefreshing = true;
      try {
        const res = await fetch('/admin/academy/enrollments');
        const data = await res.json();
        if (data.enrollments) {
          this.academyEnrollments = data.enrollments;
          if (window.lucide) this.$nextTick(() => lucide.createIcons());
        }
      } catch (err) {
        console.error(err);
      } finally {
        setTimeout(() => { this.isRefreshing = false; }, 400);
      }
    },

    openCreateUserModal() {
      this.userForm = {
        id: null,
        nome: '',
        email: '',
        telefone: '',
        role_id: (this.rolesList && this.rolesList[0] ? this.rolesList[0].id : 1),
        status: 'active',
        password: 'Rachi' + Math.floor(100000 + Math.random() * 900000)
      };
      this.showCreateUserModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    generateUserPassword() {
      this.userForm.password = 'Rachi@' + Math.floor(1000 + Math.random() * 9000) + '!';
    },

    async saveUser() {
      if (!this.userForm.nome || !this.userForm.email || !this.userForm.role_id) {
        this.showAlert('warning', 'Campos Obrigatórios', 'Por favor, preencha os campos obrigatórios (Nome, E-mail e Perfil).');
        return;
      }
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/users', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify(this.userForm)
        });
        const data = await res.json();
        if (data.success && data.user) {
          this.users.unshift(data.user);
          this.showCreateUserModal = false;
          this.notifs.unshift({
            icon: '👤',
            ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
            titulo: 'Novo Utilizador Criado',
            msg: `${data.user.nome} adicionado com o perfil ${data.user.tipo}.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Utilizador Criado', `O utilizador ${data.user.nome} (${data.user.tipo}) foi criado com sucesso!`);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Falha ao Criar', data.message || 'Erro ao criar utilizador.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro de comunicação ao criar utilizador.');
      }
    },

    openEditUserModal(u) {
      this.selectedUser = u;
      this.userForm = {
        id: u.id,
        nome: u.nome,
        email: u.email,
        telefone: u.telefone || '',
        role_id: u.role_id || (this.rolesList?.find(r => r.slug === u.role_slug)?.id || 1),
        status: u.raw_status || (u.status === 'Ativo' ? 'active' : 'blocked'),
        password: ''
      };
      this.showEditUserModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async updateUser() {
      if (!this.userForm.nome || !this.userForm.email) {
        this.showAlert('warning', 'Campos Obrigatórios', 'Nome e E-mail são obrigatórios.');
        return;
      }
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${this.userForm.id}/update`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify(this.userForm)
        });
        const data = await res.json();
        if (data.success && data.user) {
          const idx = this.users.findIndex(x => x.id === data.user.id);
          if (idx !== -1) {
            this.users[idx] = data.user;
          }
          this.showEditUserModal = false;
          this.notifs.unshift({
            icon: '✏️',
            ib: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400',
            titulo: 'Utilizador Atualizado',
            msg: `Informações de ${data.user.nome} foram gravadas com sucesso.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Utilizador Atualizado', `Informações de ${data.user.nome} foram atualizadas com sucesso!`);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Falha na Atualização', data.message || 'Erro ao atualizar dados do utilizador.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao atualizar utilizador.');
      }
    },

    openQuickRoleChange(u) {
      this.quickRoleUser = u;
      this.showQuickRoleModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async quickChangeRoleDirect(u, newRoleId) {
      if (!u || u.role_id == newRoleId) return;
      const oldRoleId = u.role_id;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${u.id}/update`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({
            role_id: newRoleId,
            nome: u.nome,
            email: u.email
          })
        });
        const data = await res.json();
        if (data.success && data.user) {
          const idx = this.users.findIndex(x => x.id === data.user.id);
          if (idx !== -1) {
            Object.assign(this.users[idx], data.user);
          }
          Object.assign(u, data.user);
          this.notifs.unshift({
            icon: '🛡️',
            ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
            titulo: 'Perfil Alterado',
            msg: `O perfil de ${data.user.nome} foi alterado para ${data.user.tipo}.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Perfil Alterado', `O perfil de ${data.user.nome} foi alterado para ${data.user.tipo}!`);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else if (data.message) {
          u.role_id = oldRoleId;
          this.showAlert('error', 'Falha ao Alterar', data.message);
        }
      } catch (err) {
        u.role_id = oldRoleId;
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao alterar perfil do utilizador.');
      }
    },

    async quickChangeRole(newRoleId) {
      if (!this.quickRoleUser) return;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${this.quickRoleUser.id}/update`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({
            role_id: newRoleId,
            nome: this.quickRoleUser.nome,
            email: this.quickRoleUser.email
          })
        });
        const data = await res.json();
        if (data.success && data.user) {
          const idx = this.users.findIndex(x => x.id === data.user.id);
          if (idx !== -1) {
            this.users[idx] = data.user;
          }
          this.notifs.unshift({
            icon: '🛡️',
            ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400',
            titulo: 'Perfil Alterado',
            msg: `O perfil de ${data.user.nome} foi alterado para ${data.user.tipo}.`,
            data: 'Agora mesmo',
            lida: false
          });
          this.showQuickRoleModal = false;
          this.showAlert('success', 'Perfil Atribuído', `Perfil de ${data.user.nome} atualizado para ${data.user.tipo}!`);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else if (data.message) {
          this.showAlert('error', 'Falha ao Atribuir Perfil', data.message);
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao atualizar perfil.');
      }
    },

    async toggleUserStatus(u) {
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${u.id}/toggle-status`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          }
        });
        const data = await res.json();
        if (data.success && data.user) {
          u.status = data.user.status;
          u.sk = data.user.sk;
          u.raw_status = data.user.raw_status;
          this.notifs.unshift({
            icon: u.status === 'Ativo' ? '🔓' : '🔒',
            ib: u.status === 'Ativo' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600',
            titulo: 'Estado de Acesso Alterado',
            msg: data.message,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert(u.status === 'Ativo' ? 'success' : 'warning', 'Estado de Acesso', data.message || `Estado de ${u.nome} alterado para ${u.status}!`);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Falha ao alterar estado do utilizador.');
      }
    },

    openResetPasswordModal(u) {
      this.resetPassData = {
        user: u,
        newPassword: 'Rachi@' + Math.floor(1000 + Math.random() * 9000) + '!',
        copied: false
      };
      this.showResetPassModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    copyResetPassword() {
      navigator.clipboard.writeText(this.resetPassData.newPassword);
      this.resetPassData.copied = true;
      this.showAlert('info', 'Palavra-passe Copiada', 'Nova senha copiada para a área de transferência.');
      setTimeout(() => { this.resetPassData.copied = false; }, 3000);
    },

    async confirmResetPassword() {
      if (!this.resetPassData.user) return;
      const userName = this.resetPassData.user.nome;
      const newPwd = this.resetPassData.newPassword;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${this.resetPassData.user.id}/reset-password`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ password: newPwd })
        });
        const data = await res.json();
        if (data.success) {
          this.showResetPassModal = false;
          this.showAlert('success', 'Palavra-passe Redefinida', `Nova palavra-passe de ${userName} gerada com sucesso!`);
        } else {
          this.showAlert('error', 'Falha ao Redefinir', data.message || 'Erro ao redefinir palavra-passe.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao redefinir palavra-passe.');
      }
    },

    openUserProfileModal(u) {
      this.selectedUser = u;
      this.showUserProfileModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    confirmDeleteUser(u) {
      if (u.id === 1 || u.email === 'admin@rachi.ao' || u.email === 'casimirogundja@outlook.com') {
        this.showAlert('warning', 'Ação Bloqueada', 'Não é permitido excluir o Administrador Master do sistema.');
        return;
      }
      this.userToDelete = u;
      this.showDeleteUserModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async executeDeleteUser() {
      if (!this.userToDelete) return;
      const userName = this.userToDelete.nome;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${this.userToDelete.id}/delete`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          }
        });
        const data = await res.json();
        if (data.success) {
          this.users = this.users.filter(x => x.id !== this.userToDelete.id);
          this.showDeleteUserModal = false;
          this.notifs.unshift({
            icon: '🗑️',
            ib: 'bg-rose-50 text-rose-600',
            titulo: 'Utilizador Excluído',
            msg: data.message,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Utilizador Excluído', data.message || `O utilizador ${userName} foi excluído com sucesso!`);
          this.userToDelete = null;
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Falha ao Excluir', data.message || 'Não foi possível excluir o utilizador.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao excluir utilizador.');
      }
    },

    async refreshUsers() {
      this.isRefreshingUsers = true;
      try {
        const res = await fetch('/admin/users');
        const data = await res.json();
        if (data.success && data.users) {
          this.users = data.users;
          if (data.roles) this.rolesList = data.roles;
          this.showAlert('info', 'Lista Atualizada', 'A lista de utilizadores foi sincronizada com sucesso.');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro ao Atualizar', 'Falha ao sincronizar lista de utilizadores.');
      } finally {
        setTimeout(() => { this.isRefreshingUsers = false; }, 400);
      }
    },

    get pageTitle() {
      const m = {
        'dashboard': 'Visão Geral',
        'usuarios': 'Perfis',
        'clientes': 'Base de Clientes',
        'solicitacoes': 'Central de Solicitações',
        'academy-cursos': 'RACHI Academy — Cursos',
        'academy-alunos': 'RACHI Academy — Alunos',
        'academy-matriculas': 'RACHI Academy — Matrículas',
        'loja-produtos': 'RACHI Store — Produtos',
        'loja-pedidos': 'RACHI Store — Pedidos',
        'loja-estoque': 'RACHI Store — Estoque',
        'rh-vagas': 'Human Capital — Vagas',
        'rh-candidatos': 'Human Capital — Candidatos',
        'grafica-produtos': 'RACHI Print — Produtos',
        'grafica-orcamentos': 'RACHI Print — Orçamentos',
        'financeiro': 'Gestão Financeira',
        'relatorios': 'Central de Relatórios',
        'notificacoes': 'Notificações',
        'configuracoes': 'Definições do Sistema'
      };
      return m[this.currentPage] || this.currentPage;
    },

    toggleTheme() {
      this.theme = this.theme === 'light' ? 'dark' : 'light';
      localStorage.setItem('rachi_admin_theme', this.theme);
      this.applyTheme();
      this.$nextTick(() => {
        renderCharts(this.theme);
        if (window.lucide) lucide.createIcons();
      });
    },

    applyTheme() {
      if (this.theme === 'dark') {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-bs-theme', 'dark');
      } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-bs-theme', 'light');
      }
    },

    setPage(p) {
      this.currentPage = p;
      this.selectedRequest = null;
      this.mobileMenuOpen = false;
      this.$nextTick(() => {
        if (p === 'dashboard') renderCharts(this.theme);
        if (window.lucide) lucide.createIcons();
      });
    },

    toggleMenu(m) {
      this.openMenus[m] = !this.openMenus[m];
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    openReq(r) {
      this.selectedRequest = r;
      this.adminReplyDraft = '';
      this.currentPage = 'solicitacoes';
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async refreshAdminRequests(showToast = false) {
      try {
        const response = await fetch('/admin/solicitacoes/conversas', {
          headers: { 'Accept': 'application/json' },
          credentials: 'same-origin'
        });
        if (!response.ok) throw new Error('Falha ao carregar solicitações.');
        const data = await response.json();
        this.allRequests = data.requests || [];
        if (this.selectedRequest) {
          this.selectedRequest = this.allRequests.find(item => item.id === this.selectedRequest.id) || this.selectedRequest;
        }
        if (showToast) this.showAlert('success', 'Solicitações atualizadas', 'As conversas foram sincronizadas.');
      } catch (error) {
        if (showToast) this.showAlert('error', 'Erro ao atualizar', 'Não foi possível carregar as conversas agora.');
      }
    },

    async sendAdminReply() {
      const message = this.adminReplyDraft.trim();
      if (!this.selectedRequest || !message || this.isSendingAdminReply) return;

      this.isSendingAdminReply = true;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const response = await fetch(`/admin/solicitacoes/${this.selectedRequest.id}/mensagens`, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ message })
        });
        const data = await response.json();
        if (!response.ok || !data.success) {
          throw new Error(data.message || 'Não foi possível enviar a resposta.');
        }

        this.selectedRequest.messages = [...(this.selectedRequest.messages || []), data.message];
        this.adminReplyDraft = '';
        this.showAlert('success', 'Resposta enviada', 'A resposta foi adicionada à conversa do cliente.');
        try {
          if (typeof BroadcastChannel !== 'undefined') {
            const bc = new BroadcastChannel('rachi_request_channel');
            bc.postMessage({ type: 'new_message', requestId: this.selectedRequest.id, message: data.message, timestamp: Date.now() });
            bc.close();
          }
        } catch(e) {}
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      } catch (error) {
        this.showAlert('error', 'Falha no envio', error.message || 'Não foi possível enviar a resposta.');
      } finally {
        this.isSendingAdminReply = false;
      }
    },

    async updReqStatus(req, s) {
      req.status = s.label;
      req.sc = s.sc;
      const now = new Date();
      req.timeline.push({
        data: now.toLocaleDateString('pt-AO') + ' ' + now.toLocaleTimeString('pt-AO', { hour: '2-digit', minute: '2-digit' }),
        desc: 'Status alterado para "' + s.label + '" pelo administrador.',
        dot: s.dot || 'bg-blue-500'
      });
      this.showAlert('info', 'Status Atualizado', `A solicitação #${req.id} foi alterada para "${s.label}".`);
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });

      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        await fetch(`/admin/solicitacoes/${req.id}/status`, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ status: s.label, comment: 'Status alterado para "' + s.label + '" pelo administrador.' })
        });

        if (typeof BroadcastChannel !== 'undefined') {
          const bc = new BroadcastChannel('rachi_request_channel');
          bc.postMessage({ type: 'status_updated', requestId: req.id, status: s.label, timestamp: Date.now() });
          bc.close();
        }
      } catch(e) {
        console.error('Falha ao persistir status:', e);
      }
    },

    logout() {
      localStorage.removeItem('rachi_academy_auth');
      localStorage.removeItem('rachi_user_session');
      localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
      try {
        if (typeof BroadcastChannel !== 'undefined') {
          const bc = new BroadcastChannel('rachi_auth_channel');
          bc.postMessage({ action: 'logout', timestamp: Date.now() });
          bc.close();
        }
        localStorage.setItem('rachi_auth_sync', Date.now().toString());
      } catch(e) {}
      window.location.href = '/';
    },

    init() {
      this.applyTheme();
      this.allRequests = <?php echo json_encode($allRequests ?? [], 15, 512) ?>;
      this.refreshAdminRequests();
      window.setInterval(() => this.refreshAdminRequests(), 5000);

      // Sincronização em tempo real de solicitações & chat
      try {
        if (typeof BroadcastChannel !== 'undefined') {
          this.reqChannel = new BroadcastChannel('rachi_request_channel');
          this.reqChannel.onmessage = (event) => {
            if (event.data) {
              this.refreshAdminRequests();
            }
          };
        }
      } catch(e) {}

      // Sincronização em tempo real de encerramento de sessão
      try {
        if (typeof BroadcastChannel !== 'undefined') {
          this.authChannel = new BroadcastChannel('rachi_auth_channel');
          this.authChannel.onmessage = (event) => {
            if (event.data && event.data.action === 'logout') {
              window.location.href = '/';
            }
          };
        }
      } catch(e) {}

      window.addEventListener('storage', (event) => {
        if (event.key === 'rachi_user_session' || event.key === 'rachi_auth_sync') {
          const raw = localStorage.getItem('rachi_user_session');
          if (!raw || raw.includes('"loggedIn":false')) {
            window.location.href = '/';
          }
        }
      });

      // Inicializa sessão de admin com utilizador autenticado
      const authUserObj = <?php echo json_encode(auth()->user() ? [
        'id' => auth()->id(),
        'nome' => auth()->user()->name,
        'email' => auth()->user()->email,
        'tipo' => 'admin',
        'loggedIn' => true
      ] : null); ?>;

      if (authUserObj) {
        localStorage.setItem('rachi_user_session', JSON.stringify(authUserObj));
        localStorage.setItem('rachi_academy_auth', 'true');
        this.adminUser = {
          nome: authUserObj.nome,
          email: authUserObj.email,
          initials: (authUserObj.nome || 'SA').split(' ').filter(Boolean).slice(0, 2).map(n => n[0]).join('').toUpperCase()
        };
      } else {
        let sess = localStorage.getItem('rachi_user_session');
        if (!sess) {
          const defaultAdmin = {
            id: 1,
            nome: 'Super Administrador RACHI',
            email: 'admin@rachi.ao',
            tipo: 'admin',
            loggedIn: true
          };
          localStorage.setItem('rachi_user_session', JSON.stringify(defaultAdmin));
          localStorage.setItem('rachi_academy_auth', 'true');
          sess = JSON.stringify(defaultAdmin);
        }

        try {
          const u = JSON.parse(sess);
          this.adminUser = {
            nome: u.nome || 'Super Administrador RACHI',
            email: u.email || 'admin@rachi.ao',
            initials: (u.nome || 'SA').split(' ').filter(Boolean).slice(0, 2).map(n => n[0]).join('').toUpperCase()
          };
        } catch (e) {
          this.adminUser = { nome: 'Super Administrador RACHI', initials: 'SA' };
        }
      }

      this.$nextTick(() => {
        renderCharts(this.theme);
        if (window.lucide) lucide.createIcons();
      });
    },

    kpis: [
      { label: 'Clientes Ativos na Base', value: '1.248', trend: 8.2, icon: 'users', iconBg: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400', iconColor: 'text-blue-600 dark:text-blue-400' },
      { label: 'Novas Solicitações no Mês', value: '86', trend: 12.5, icon: 'clipboard-list', iconBg: 'bg-amber-50 text-amber-600 dark:bg-orange-500/10 dark:text-orange-400', iconColor: 'text-amber-600 dark:text-orange-400' },
      { label: 'Pedidos da Loja Processados', value: '154', trend: -3.1, icon: 'shopping-cart', iconBg: 'bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400', iconColor: 'text-purple-600 dark:text-purple-400' },
      { label: 'Faturamento Total (AOA)', value: '45.89M', trend: 12.4, icon: 'banknote', iconBg: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400', iconColor: 'text-emerald-600 dark:text-emerald-400' }
    ],

    wfStatuses: [
      { key: 'novo', label: 'Novo', count: 24, color: 'text-indigo-600 dark:text-indigo-400', sc: 's-novo', dot: 'bg-indigo-500' },
      { key: 'analise', label: 'Em Análise', count: 18, color: 'text-amber-600 dark:text-yellow-400', sc: 's-analise', dot: 'bg-amber-500' },
      { key: 'orcamento', label: 'Orçamento', count: 7, color: 'text-blue-600 dark:text-blue-400', sc: 's-exec', dot: 'bg-blue-500' },
      { key: 'aguardando', label: 'Ag. Cliente', count: 10, color: 'text-orange-600 dark:text-orange-400', sc: 's-wait', dot: 'bg-orange-500' },
      { key: 'execucao', label: 'Em Execução', count: 21, color: 'text-cyan-600 dark:text-cyan-400', sc: 's-exec', dot: 'bg-cyan-500' },
      { key: 'concluido', label: 'Concluído', count: 13, color: 'text-emerald-600 dark:text-emerald-400', sc: 's-done', dot: 'bg-emerald-500' },
      { key: 'cancelado', label: 'Cancelado', count: 3, color: 'text-rose-600 dark:text-red-400', sc: 's-cancel', dot: 'bg-rose-500' }
    ],

    allRequests: <?php echo json_encode($allRequests ?? [], 15, 512) ?>,
    reqFilterSearch: '',
    reqFilterUnit: 'Todas',
    reqFilterStatus: 'Todos',

    getStatusCount(key) {
      return (this.allRequests || []).filter(r => {
        const sk = (r.status_key || '').toLowerCase();
        const st = (r.status || '').toLowerCase();
        if (key === 'novo') return sk === 'new' || st.includes('nov');
        if (key === 'analise') return sk === 'in_analysis' || st.includes('análise') || st.includes('analise');
        if (key === 'orcamento') return sk === 'quoted' || st.includes('orçament') || st.includes('orcament');
        if (key === 'aguardando') return sk === 'waiting_customer' || st.includes('aguardando') || st.includes('ag.');
        if (key === 'execucao') return sk === 'in_progress' || st.includes('execução') || st.includes('execucao');
        if (key === 'concluido') return sk === 'completed' || st.includes('concluíd') || st.includes('concluid');
        if (key === 'cancelado') return sk === 'cancelled' || st.includes('cancelad');
        return false;
      }).length;
    },

    get filteredRequests() {
      return (this.allRequests || []).filter(req => {
        if (this.reqFilterSearch && this.reqFilterSearch.trim()) {
          const q = this.reqFilterSearch.toLowerCase();
          const matchProto = (req.protocol || ('#' + req.id)).toLowerCase().includes(q);
          const matchClient = (req.cliente || '').toLowerCase().includes(q);
          const matchEmpresa = (req.empresa || '').toLowerCase().includes(q);
          const matchDesc = (req.descricao || '').toLowerCase().includes(q);
          const matchUnit = (req.servico || '').toLowerCase().includes(q);
          if (!matchProto && !matchClient && !matchEmpresa && !matchDesc && !matchUnit) return false;
        }
        if (this.reqFilterUnit !== 'Todas') {
          const serv = (req.servico || '').toLowerCase();
          const target = this.reqFilterUnit.toLowerCase();
          if (!serv.includes(target) && !target.includes(serv)) {
            return false;
          }
        }
        if (this.reqFilterStatus !== 'Todos') {
          const st = (req.status || '').toLowerCase();
          const sk = (req.status_key || '').toLowerCase();
          const target = this.reqFilterStatus.toLowerCase();
          if (target === 'novo' && sk !== 'new' && !st.includes('nov')) return false;
          if (target === 'em análise' && sk !== 'in_analysis' && !st.includes('análise') && !st.includes('analise')) return false;
          if (target === 'orçamento' && sk !== 'quoted' && !st.includes('orçament') && !st.includes('orcament')) return false;
          if (target === 'ag. cliente' && sk !== 'waiting_customer' && !st.includes('ag.') && !st.includes('aguardando')) return false;
          if (target === 'em execução' && sk !== 'in_progress' && !st.includes('execução') && !st.includes('execucao')) return false;
          if (target === 'concluído' && sk !== 'completed' && !st.includes('concluíd') && !st.includes('concluid')) return false;
          if (target === 'cancelado' && sk !== 'cancelled' && !st.includes('cancelad')) return false;
        }
        return true;
      });
    },


    clients: [
      { id: 1, nome: 'Inov Quimua Consultoria', email: 'geral@inovquimua.ao', tipo: 'Empresa', tel: '+244 923 000 001', tr: 12, status: 'Ativo', sk: 'ativo', desde: 'Jan/2026' },
      { id: 2, nome: 'Empresa Alpha Lda.', email: 'admin@alpha.ao', tipo: 'Empresa', tel: '+244 923 000 003', tr: 8, status: 'Ativo', sk: 'ativo', desde: 'Mar/2026' },
      { id: 3, nome: 'Pedro Alves', email: 'pedro@email.com', tipo: 'Particular', tel: '+244 923 000 004', tr: 2, status: 'Ativo', sk: 'ativo', desde: 'Set/2026' },
      { id: 4, nome: 'Beta Corp. Internacional', email: 'info@beta.ao', tipo: 'Empresa', tel: '+244 923 000 005', tr: 6, status: 'Ativo', sk: 'ativo', desde: 'Jun/2026' }
    ],

    aCourses: [
      { id: 1, titulo: 'Cibersegurança e Proteção de Dados', cat: 'TI & Segurança', prof: 'Dr. Luís Costa', alunos: 47, modulos: 3, dur: '40h', preco: 'AOA 12.000', taxa: 68, status: 'Ativo' },
      { id: 2, titulo: 'Competências Digitais & IA para Negócios', cat: 'Tecnologia', prof: 'Eng. Fábio Neto', alunos: 62, modulos: 4, dur: '30h', preco: 'AOA 8.500', taxa: 45, status: 'Ativo' },
      { id: 3, titulo: 'Liderança e Gestão de Equipas Ágeis', cat: 'Gestão', prof: 'Dra. Ana Lima', alunos: 35, modulos: 5, dur: '25h', preco: 'AOA 10.000', taxa: 88, status: 'Ativo' },
      { id: 4, titulo: 'Excel Avançado e Power BI Corporativo', cat: 'Produtividade', prof: 'Eng. Carlos Mendes', alunos: 91, modulos: 6, dur: '20h', preco: 'AOA 5.000', taxa: 72, status: 'Ativo' }
    ],

    sProducts: [
      { id: 1, nome: 'Notebook Lenovo ThinkPad E15', marca: 'Lenovo', sku: 'LEN-TP-E15', cat: 'Notebooks', preco: 'AOA 185.000', est: 8, vendas: 23, status: 'Ativo' },
      { id: 2, nome: 'Impressora HP LaserJet Pro', marca: 'HP', sku: 'HP-LJP-400', cat: 'Impressoras', preco: 'AOA 95.000', est: 4, vendas: 11, status: 'Ativo' },
      { id: 3, nome: 'Mouse Logitech MX Master 3', marca: 'Logitech', sku: 'LOG-MX3', cat: 'Periféricos', preco: 'AOA 18.500', est: 22, vendas: 48, status: 'Ativo' },
      { id: 4, nome: 'Monitor LG 27" 4K IPS', marca: 'LG', sku: 'LG-27UK850', cat: 'Monitores', preco: 'AOA 145.000', est: 3, vendas: 7, status: 'Ativo' }
    ],

    rhJobs: [
      { id: 1, cargo: 'Engenheiro de Software Full Stack', empresa: 'Alpha Consultoria', local: 'Luanda', mod: 'Híbrido', sal: 'AOA 250k+', cands: 18, prazo: '30/09/2026', req: '3+ anos de experiência', status: 'Aberta' },
      { id: 2, cargo: 'Analista de Recursos Humanos Sênior', empresa: 'Beta Corp.', local: 'Luanda', mod: 'Presencial', sal: 'AOA 120k+', cands: 11, prazo: '15/10/2026', req: 'Formação em RH/Psicologia', status: 'Aberta' },
      { id: 3, cargo: 'Designer Gráfico e UI/UX', empresa: 'RACHI Tec', local: 'Luanda', mod: 'Remoto', sal: 'AOA 90k+', cands: 24, prazo: '01/10/2026', req: 'Portfólio comprovado', status: 'Aberta' }
    ],

    gProducts: [
      { id: 1, nome: 'Cartão de Visita Premium', desc: 'Frente e verso, 4 cores, verniz localizado', mat: 'Couché 300g Laminação Fosca', tam: '90x50mm', qtm: 100, preco: 'AOA 4.500', prazo: '3 dias úteis', status: 'Ativo' },
      { id: 2, nome: 'Panfletos e Flyers Promocionais', desc: 'Impressão digital CMYK alta definição', mat: 'Couché 150g Brilho', tam: 'A5 (148x210mm)', qtm: 50, preco: 'AOA 3.000', prazo: '2 dias úteis', status: 'Ativo' },
      { id: 3, nome: 'Banner com Ilhoses Reforçados', desc: 'Impressão UV de alta resistência solar', mat: 'Lona 440g Fosca', tam: '1x2m / 2x3m', qtm: 1, preco: 'AOA 8.000', prazo: '5 dias úteis', status: 'Ativo' }
    ],

    finMods: [
      { label: 'RACHI Store / Tec', icon: '🛒', value: '20.500.000', pct: 45, bc: 'bg-sky-500' },
      { label: 'RACHI Academy', icon: '🎓', value: '12.300.000', pct: 27, bc: 'bg-indigo-600' },
      { label: 'RACHI Print', icon: '🖨️', value: '8.090.000', pct: 18, bc: 'bg-amber-500' },
      { label: 'Human Capital', icon: '👥', value: '5.000.000', pct: 11, bc: 'bg-emerald-600' }
    ],

    txs: [
      { id: 1, icon: '🎓', desc: 'Matrícula em Cibersegurança', cli: 'Pedro Alves', data: '21/09/2026', tipo: 'entrada', valor: '12.000', mod: 'Academy' },
      { id: 2, icon: '🛒', desc: 'Pedido #154 - 10 Notebooks ThinkPad', cli: 'Inov Quimua', data: '21/09/2026', tipo: 'entrada', valor: '185.000', mod: 'Loja' },
      { id: 3, icon: '🖨️', desc: 'Ordem Gráfica #1024 - 500 Cartões', cli: 'Beta Corp.', data: '20/09/2026', tipo: 'entrada', valor: '4.500', mod: 'Gráfica' },
      { id: 4, icon: '👥', desc: 'Consultoria de Recrutamento RH', cli: 'Alpha Consultoria', data: '20/09/2026', tipo: 'entrada', valor: '25.000', mod: 'RH' }
    ],

    reports: [
      { icon: '👤', label: 'Clientes & Contactos', desc: 'Cadastros, histórico de serviços e contactos', bg: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400' },
      { icon: '💰', label: 'Faturamento & Vendas', desc: 'Relatório financeiro por período e unidade', bg: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' },
      { icon: '📦', label: 'Pedidos da Loja', desc: 'Status de entregas e histórico de compras', bg: 'bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400' },
      { icon: '📋', label: 'Ordens & Solicitações', desc: 'Métricas de atendimento e tempo de resposta', bg: 'bg-amber-50 text-amber-600 dark:bg-orange-500/10 dark:text-orange-400' },
      { icon: '🎓', label: 'Academy & Cursos', desc: 'Desempenho dos alunos, taxas e matrículas', bg: 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' },
      { icon: '👥', label: 'Recrutamento & RH', desc: 'Funil de candidatos, entrevistas e vagas', bg: 'bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400' }
    ],

    notifs: [
      { icon: '📋', ib: 'bg-amber-50 text-amber-600 dark:bg-orange-500/10 dark:text-orange-400', titulo: 'Nova Demanda Corporativa', msg: 'A Empresa Alpha Lda. cadastrou uma nova demanda de recrutamento de TI.', data: '21/09/2026 09:00', lida: false },
      { icon: '🎓', ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400', titulo: 'Nova Matrícula na Academy', msg: 'Pedro Alves matriculou-se em Cibersegurança e Proteção de Dados.', data: '21/09/2026 08:45', lida: false },
      { icon: '🛒', ib: 'bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400', titulo: 'Novo Pedido Loja #154', msg: 'Inov Quimua solicitou compra corporativa de 10 notebooks ThinkPad.', data: '21/09/2026 08:30', lida: false },
      { icon: '⚠️', ib: 'bg-yellow-50 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400', titulo: 'Alerta de Estoque Mínimo', msg: 'Monitor LG 27" — restam apenas 3 unidades no estoque central.', data: '20/09/2026 18:00', lida: false }
    ]
  };
}
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  if (window.lucide) lucide.createIcons();
  document.addEventListener('alpine:initialized', () => {
    if (window.lucide) lucide.createIcons();
  });
  document.addEventListener('click', () => {
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 70);
  });
});
</script>
</body>
</html>
<?php /**PATH C:\Users\casimiro.gundja\Documents\rachi\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>