<!DOCTYPE html>
<html lang="pt-AO" :class="{'dark': theme === 'dark'}" :data-bs-theme="theme" class="h-full">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="">
<title>RACHI — Painel de Gestão & Administração</title>
<meta name="description" content="Painel de controlo visual e intuitivo da RACHI: métricas, negócios, clientes, solicitações e relatórios.">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="shortcut icon" href="/favicon.ico">
<link rel="manifest" href="/site.webmanifest">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/toast.css">
<script src="/toast.js"></script>
<script src="/auth-session.js"></script>
<link rel="stylesheet" href="/worker-marketing.css?v=20261030-2">

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
  height: 100vh;
  max-height: 100vh;
  background-color: var(--bg-sidebar);
  border-right: 1px solid var(--border-sidebar);
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), width 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.25s ease, border-color 0.25s ease;
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

#admin-sidebar nav {
  flex: 1 1 auto;
  min-height: 0;
  overflow-y: auto;
  overflow-x: hidden;
  overscroll-behavior: contain;
}

#admin-sidebar.collapsed { 
  width: 76px; 
}
#admin-sidebar.collapsed nav { 
  overflow-y: auto;
  overflow-x: hidden;
}
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
  position: relative !important;
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
  position: relative !important;
  justify-content: center !important;
  padding: 8px !important;
  width: 42px !important;
  height: 42px !important;
  margin: 0 auto !important;
}
#admin-sidebar.collapsed .site-back-btn i.ms-auto {
  display: none !important;
}
#admin-sidebar.collapsed .sub-menu,
#admin-sidebar.collapsed .sidebar-sub-menu { display: none !important; }

/* Legendas flutuantes profissionais para o Sidebar Recolhido (Tooltips instantâneos) */
#admin-sidebar.collapsed [data-legend] {
  position: relative !important;
}

#admin-sidebar.collapsed [data-legend]::after {
  content: attr(data-legend);
  position: absolute;
  left: calc(100% + 14px);
  top: 50%;
  transform: translateY(-50%) translateX(-6px);
  background: #ffffff;
  color: #0f172a;
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.01em;
  white-space: nowrap;
  pointer-events: none;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.15s cubic-bezier(0.16, 1, 0.3, 1), transform 0.15s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.15s ease;
  z-index: 999999;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12), 0 2px 6px rgba(0, 0, 0, 0.06);
  border: 1px solid #e2e8f0;
}

#admin-sidebar.collapsed [data-legend]::before {
  content: '';
  position: absolute;
  left: calc(100% + 8px);
  top: 50%;
  transform: translateY(-50%);
  border-width: 5px 6px 5px 0;
  border-style: solid;
  border-color: transparent #ffffff transparent transparent;
  pointer-events: none;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.15s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.15s ease;
  z-index: 999999;
}

html.dark #admin-sidebar.collapsed [data-legend]::after {
  background: #0d1a30;
  color: #f8fafc;
  border-color: rgba(0, 80, 240, 0.28);
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.55), 0 0 12px rgba(0, 80, 240, 0.2);
}

html.dark #admin-sidebar.collapsed [data-legend]::before {
  border-color: transparent #0d1a30 transparent transparent;
}

#admin-sidebar.collapsed [data-legend]:hover::after {
  opacity: 1;
  visibility: visible;
  transform: translateY(-50%) translateX(0);
}

#admin-sidebar.collapsed [data-legend]:hover::before {
  opacity: 1;
  visibility: visible;
}

.sidebar-sub-menu {
  margin-left: 28px;
  padding-left: 10px;
  border-left: 2px solid var(--border-sidebar);
  margin-top: 3px;
  margin-bottom: 6px;
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.sidebar-sub-item {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 6px 11px;
  border-radius: 10px;
  font-size: 12px;
  font-weight: 600;
  color: var(--text-muted);
  cursor: pointer;
  transition: all 0.18s ease;
  white-space: nowrap;
  text-decoration: none;
}
.sidebar-sub-item:hover {
  color: #0050f0;
  background-color: rgba(0, 80, 240, 0.06);
  transform: translateX(2px);
}
html.dark .sidebar-sub-item:hover {
  color: #38bdf8;
  background-color: rgba(0, 80, 240, 0.12);
}
.sidebar-sub-item.active {
  color: #0050f0;
  font-weight: 700;
  background-color: rgba(0, 80, 240, 0.1);
  box-shadow: 0 1px 4px rgba(0, 80, 240, 0.05);
}
html.dark .sidebar-sub-item.active {
  color: #38bdf8;
  background-color: rgba(0, 80, 240, 0.22);
  box-shadow: 0 1px 6px rgba(0, 80, 240, 0.15);
}
.sidebar-sub-dot {
  width: 5px;
  height: 5px;
  border-radius: 9999px;
  background-color: #cbd5e1;
  transition: all 0.2s ease;
  flex-shrink: 0;
}
html.dark .sidebar-sub-dot {
  background-color: rgba(255, 255, 255, 0.25);
}
.sidebar-sub-item:hover .sidebar-sub-dot {
  background-color: #0050f0;
  transform: scale(1.2);
}
html.dark .sidebar-sub-item:hover .sidebar-sub-dot {
  background-color: #38bdf8;
}
.sidebar-sub-item.active .sidebar-sub-dot {
  background-color: #0050f0;
  box-shadow: 0 0 0 3px rgba(0, 80, 240, 0.25);
  transform: scale(1.3);
}
html.dark .sidebar-sub-item.active .sidebar-sub-dot {
  background-color: #38bdf8;
  box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.3);
}

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

/* BARRA DE ROLAGEM ULTRA-FINA, DISCRETA E ELEGANTE PARA O MENU LATERAL */
.sidebar-nav, #admin-sidebar nav, #admin-sidebar {
  scrollbar-width: thin;
  scrollbar-color: rgba(148, 163, 184, 0.25) transparent;
  overscroll-behavior: contain;
}
.sidebar-nav::-webkit-scrollbar, #admin-sidebar nav::-webkit-scrollbar, #admin-sidebar::-webkit-scrollbar {
  width: 4px;
  height: 4px;
}
.sidebar-nav::-webkit-scrollbar-track, #admin-sidebar nav::-webkit-scrollbar-track, #admin-sidebar::-webkit-scrollbar-track {
  background: transparent;
}
.sidebar-nav::-webkit-scrollbar-thumb, #admin-sidebar nav::-webkit-scrollbar-thumb, #admin-sidebar::-webkit-scrollbar-thumb {
  background: rgba(100, 116, 139, 0.18);
  border-radius: 9999px;
  transition: background 0.2s ease;
}
.sidebar-nav:hover::-webkit-scrollbar-thumb, #admin-sidebar nav:hover::-webkit-scrollbar-thumb, #admin-sidebar:hover::-webkit-scrollbar-thumb {
  background: rgba(100, 116, 139, 0.38);
}
html.dark .sidebar-nav, html.dark #admin-sidebar nav, html.dark #admin-sidebar {
  scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
}
html.dark .sidebar-nav::-webkit-scrollbar-thumb, html.dark #admin-sidebar nav::-webkit-scrollbar-thumb, html.dark #admin-sidebar::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.12);
}
html.dark .sidebar-nav:hover::-webkit-scrollbar-thumb, html.dark #admin-sidebar nav:hover::-webkit-scrollbar-thumb, html.dark #admin-sidebar:hover::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.25);
}

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

/* ==========================================================================
   GUNDJATECH REPLICA SYSTEM — EXECUTIVE TOKENS, ACCORDIONS, CHARTS & CARDS
   ========================================================================== */
.gt-acc > summary {
  list-style: none;
  cursor: pointer;
  user-select: none;
}
.gt-acc > summary::-webkit-details-marker {
  display: none;
}
.gt-acc .gt-acc-close {
  display: none;
}
.gt-acc[open] > summary .gt-acc-open {
  display: none;
}
.gt-acc[open] > summary .gt-acc-close {
  display: inline;
}

.gtb-card {
  background: var(--bg-card);
  border: 1px solid var(--border-card);
  border-radius: 18px;
  position: relative;
  overflow: hidden;
  box-shadow: var(--card-shadow);
  transition: all 0.22s ease;
}
.gtb-card:hover {
  border-color: rgba(255, 165, 37, 0.35);
  box-shadow: 0 10px 25px -4px rgba(0, 80, 240, 0.12);
}
html.dark .gtb-card:hover {
  border-color: rgba(255, 165, 37, 0.45);
  box-shadow: 0 14px 30px -4px rgba(0, 0, 0, 0.65);
}

.gtb-icon-box {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: rgba(255, 165, 37, 0.12);
  border: 1px solid rgba(255, 165, 37, 0.25);
  color: #FFA525;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.gtb-icon-box.is-blue {
  background: rgba(0, 80, 240, 0.12);
  border-color: rgba(0, 80, 240, 0.25);
  color: #0050f0;
}
html.dark .gtb-icon-box.is-blue {
  color: #38bdf8;
}
.gtb-icon-box.is-petrol {
  background: rgba(16, 185, 129, 0.12);
  border-color: rgba(16, 185, 129, 0.25);
  color: #10b981;
}
html.dark .gtb-icon-box.is-petrol {
  color: #6ee7b7;
}
.gtb-icon-box.is-purple {
  background: rgba(168, 85, 247, 0.12);
  border-color: rgba(168, 85, 247, 0.25);
  color: #a855f7;
}

.gt-req-pill-neutral {
  display: inline-flex;
  align-items: center;
  padding: 3px 9px;
  border-radius: 7px;
  font-size: 10.5px;
  font-weight: 800;
  letter-spacing: 0.04em;
  background: rgba(140, 149, 170, 0.12);
  border: 1px solid rgba(140, 149, 170, 0.25);
  color: #475569;
}
html.dark .gt-req-pill-neutral {
  background: rgba(255, 255, 255, 0.06);
  border-color: rgba(255, 255, 255, 0.12);
  color: #e2e8f0;
}

.gtb-ctrl-btn {
  height: 32px;
  padding: 0 12px;
  border-radius: 10px;
  background: transparent;
  border: 1px solid rgba(140, 149, 170, 0.25);
  font-size: 12px;
  font-weight: 700;
  color: inherit;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.15s ease;
}
.gtb-ctrl-btn:hover {
  background: rgba(255, 165, 37, 0.08);
  border-color: #FFA525;
  color: #FFA525;
}

.gtb-promo-card {
  margin: 10px;
  padding: 12px 14px;
  border-radius: 14px;
  background: linear-gradient(135deg, rgba(7, 19, 38, 0.95), rgba(0, 80, 240, 0.2));
  border: 1px solid rgba(255, 165, 37, 0.28);
  display: flex;
  flex-direction: column;
  gap: 8px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
}
#admin-sidebar.collapsed .gtb-promo-card {
  display: none !important;
}
.gtb-promo-btn {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 6px 10px;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.08);
  color: #ffffff;
  font-size: 11px;
  font-weight: 800;
  text-decoration: none;
  transition: background 0.15s ease;
}
.gtb-promo-btn:hover {
  background: rgba(255, 165, 37, 0.2);
  color: #FFA525;
}

.gtb-paired-chart {
  position: relative;
  height: 182px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  padding-left: 48px;
  padding-bottom: 24px;
}
.gtb-grid-line {
  position: relative;
  width: 100%;
  border-bottom: 1px dashed rgba(140, 149, 170, 0.2);
  height: 0;
}
html.dark .gtb-grid-line {
  border-bottom-color: rgba(255, 255, 255, 0.08);
}
.gtb-grid-line span {
  position: absolute;
  left: -48px;
  top: -7px;
  font-size: 10.5px;
  color: #8C95AA;
  font-weight: 600;
}
.gtb-bars-overlay {
  position: absolute;
  left: 52px;
  right: 8px;
  bottom: 26px;
  top: 8px;
  display: grid;
  grid-template-columns: repeat(12, minmax(0, 1fr));
  align-items: end;
  gap: 8px;
}
.gtb-pair-group {
  height: 100%;
  display: flex;
  align-items: flex-end;
  justify-content: center;
  gap: 3px;
  position: relative;
}
.gtb-bar-a {
  width: 10px;
  border-radius: 4px 4px 1px 1px;
  background: linear-gradient(180deg, #FFE68A 0%, #FFA525 55%, #DD8F20 100%);
  box-shadow: 0 4px 14px rgba(255, 165, 37, 0.26), inset 0 1px 1px rgba(255, 255, 255, 0.55);
  transition: height 0.3s ease, filter 0.2s ease, transform 0.2s ease;
}
.gtb-bar-b {
  width: 10px;
  border-radius: 4px 4px 1px 1px;
  background: linear-gradient(180deg, #38BDF8 0%, #0050f0 60%, #071326 100%);
  box-shadow: 0 4px 14px rgba(0, 80, 240, 0.34), inset 0 1px 1px rgba(255, 255, 255, 0.4);
  transition: height 0.3s ease, filter 0.2s ease, transform 0.2s ease;
}
.gtb-pair-group:hover .gtb-bar-a,
.gtb-pair-group:hover .gtb-bar-b {
  filter: brightness(1.18);
  transform: translateY(-2px);
}
.gtb-month-lbl {
  position: absolute;
  bottom: -22px;
  font-size: 10.5px;
  font-weight: 600;
  color: #8C95AA;
}
.gtb-pair-group.is-highlight .gtb-month-lbl {
  color: #FFA525;
  font-weight: 800;
}

a { text-decoration: none !important; }

/* ==========================================================================
   PANZE SAAS STUDIO TOKENS (REFERENCIA VISUAL EXCLUSIVA)
   ========================================================================== */
.panze-menu-active {
  background: linear-gradient(135deg, rgba(0, 80, 240, 0.12) 0%, rgba(0, 163, 224, 0.08) 100%) !important;
  color: #0050f0 !important;
  border: 1px solid rgba(0, 80, 240, 0.28) !important;
  border-radius: 14px !important;
  font-weight: 700 !important;
  box-shadow: 0 2px 10px rgba(0, 80, 240, 0.08) !important;
}
html.dark .panze-menu-active {
  background: linear-gradient(135deg, rgba(0, 80, 240, 0.22) 0%, rgba(0, 163, 224, 0.15) 100%) !important;
  color: #38bdf8 !important;
  border-color: rgba(0, 80, 240, 0.4) !important;
  box-shadow: 0 2px 14px rgba(0, 80, 240, 0.22) !important;
}

.panze-overview-banner {
  position: relative;
  border-radius: 24px;
  padding: 24px 28px;
  overflow: hidden;
  border: 1px solid rgba(216, 180, 254, 0.5);
  background: linear-gradient(125deg, #e9ddff 0%, #d4e8ff 45%, #c8f5ff 85%, #dcf9ff 100%);
}
html.dark .panze-overview-banner {
  border-color: rgba(168, 85, 247, 0.25);
  background: linear-gradient(125deg, rgba(58, 40, 105, 0.75) 0%, rgba(20, 55, 100, 0.75) 45%, rgba(15, 65, 85, 0.75) 85%);
}

.panze-stat-pill {
  background: rgba(255, 255, 255, 0.75);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.9);
  border-radius: 18px;
  padding: 16px 18px;
  transition: all 0.2s ease;
}
.panze-stat-pill:hover {
  background: rgba(255, 255, 255, 0.95);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px -4px rgba(15, 23, 42, 0.08);
}
html.dark .panze-stat-pill {
  background: rgba(15, 23, 42, 0.65);
  border-color: rgba(255, 255, 255, 0.1);
}
html.dark .panze-stat-pill:hover {
  background: rgba(15, 23, 42, 0.85);
  box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.5);
}

.panze-op-card {
  background: #ffffff;
  border-radius: 20px;
  border: 1px solid #eef2f6;
  padding: 20px 22px;
  box-shadow: 0 2px 10px rgba(15, 23, 42, 0.02);
  transition: all 0.2s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.panze-op-card:hover {
  border-color: #cbd5e1;
  transform: translateY(-2px);
  box-shadow: 0 8px 24px -4px rgba(15, 23, 42, 0.06);
}
html.dark .panze-op-card {
  background: #0f172a;
  border-color: rgba(255, 255, 255, 0.08);
}
html.dark .panze-op-card:hover {
  border-color: rgba(255, 255, 255, 0.18);
  box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.5);
}

.panze-bar-col {
  display: flex;
  flex-direction: column-reverse;
  align-items: center;
  gap: 5px;
  height: 180px;
  justify-content: flex-start;
  position: relative;
  cursor: pointer;
}
.panze-capsule {
  width: 9px;
  border-radius: 9999px;
  transition: all 0.25s ease;
}
.panze-capsule:hover {
  filter: brightness(1.2);
  transform: scaleX(1.3);
}
.panze-capsule.cap-green {
  background: #00d68f;
  box-shadow: 0 2px 8px rgba(0, 214, 143, 0.3);
}
.panze-capsule.cap-purple {
  background: #8b5cf6;
  box-shadow: 0 2px 8px rgba(139, 92, 246, 0.3);
}
.panze-capsule.cap-orange {
  background: #f97316;
  box-shadow: 0 2px 8px rgba(249, 115, 22, 0.3);
}

.panze-hdr-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 14px;
  border-radius: 14px;
  background: #ffffff;
  border: 1px solid #e2e8f0;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
  transition: all 0.15s ease;
}
html.dark .panze-hdr-pill {
  background: #0f172a;
  border-color: rgba(255, 255, 255, 0.1);
}

</style>
</head>
<body x-data="adminApp()">

<!-- SIDEBAR -->
<aside id="admin-sidebar" :class="{'collapsed': sidebarCollapsed, 'mob': mobileMenuOpen}">
  <!-- Brand -->
  <div class="sidebar-brand-box shrink-0 px-3.5 py-4 border-b border-slate-200/80 dark:border-white/5 flex items-center" :class="{'justify-center': sidebarCollapsed, 'justify-start': !sidebarCollapsed}">
    <div class="flex items-center min-h-[40px] w-full" :class="{'justify-center': sidebarCollapsed, 'justify-start': !sidebarCollapsed}">
      <a href="/admin-dashboard" class="flex items-center transition group overflow-hidden" title="RACHI - Gestão Inteligente">
        <!-- Logo Oficial RACHI (Expandido: Dark & Light) -->
        <div class="brand-full flex items-center">
          <img src="/images/logo-rachi-light.png" 
               alt="RACHI" 
               class="h-8 w-auto max-w-[170px] object-contain hidden dark:block transition duration-200 group-hover:scale-[1.02]"
               onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'">
          <img src="/images/logo-rachi-dark.png" 
               alt="RACHI" 
               class="h-8 w-auto max-w-[170px] object-contain block dark:hidden transition duration-200 group-hover:scale-[1.02]"
               onerror="this.onerror=null; this.src='/images/logo-rachi.png'">
        </div>
        <!-- Emblema Oficial RACHI (Recolhido / Collapsed) -->
        <div class="brand-emblem-collapsed hidden w-9 h-9 rounded-xl items-center justify-center shrink-0 p-1 mx-auto bg-slate-100 dark:bg-white/5 border border-slate-200/80 dark:border-white/10 shadow-sm" title="RACHI">
          <img src="/images/rachi-symbol-logo-rachi-light.png" 
               alt="RACHI" 
               class="w-6 h-6 object-contain hidden dark:block drop-shadow-xs transition duration-200 group-hover:scale-105"
               onerror="this.onerror=null; this.src='/images/rachi-symbol.svg'">
          <img src="/images/rachi-symbol-logo-rachi-dark.png" 
               alt="RACHI" 
               class="w-6 h-6 object-contain block dark:hidden drop-shadow-xs transition duration-200 group-hover:scale-105"
               onerror="this.onerror=null; this.src='/images/rachi-symbol.svg'">
        </div>
      </a>
    </div>
  </div>

  <!-- NAVIGATION -->
  <nav class="sidebar-nav flex-1 py-3 space-y-1 overflow-y-auto">
    <div class="sg">MENU</div>
    <!-- Dashboard (Visão Geral - Active Item no Modelo Panze) -->
    <div @click="setPage('dashboard')" :class="currentPage==='dashboard'?'panze-menu-active':'text-slate-600 dark:text-slate-400 hover:text-slate-900'" class="sidebar-item" data-legend="Dashboard" title="Dashboard">
      <i data-lucide="layout-grid" class="si"></i>
      <span class="sl font-bold">Dashboard</span>
    </div>

    <div class="sg mt-2">ATENDIMENTO &amp; IA</div>
    <!-- Chat ao Vivo (Central de Atendimento Omnichannel - Print 3) -->
    <div @click="setPage('messenger')" :class="currentPage==='messenger'?'panze-menu-active':'text-slate-600 dark:text-slate-400 hover:text-slate-900'" class="sidebar-item" data-legend="Chat ao Vivo" title="Central de Atendimento & Live Chat">
      <i data-lucide="message-square" class="si"></i>
      <span class="sl font-semibold">Chat ao Vivo</span>
      <span class="sb2 badge bg-blue-100 text-[#0050f0] dark:bg-blue-950/60 dark:text-blue-300 text-[10px] px-2 py-0.5 rounded-full ms-auto font-bold" x-text="unreadMessengerCount">3</span>
    </div>

    <!-- Agente IA (CRM & Piloto Automático - Print 3) -->
    <div @click="setPage('agente-ia')" :class="currentPage==='agente-ia'?'panze-menu-active':'text-slate-600 dark:text-slate-400 hover:text-slate-900'" class="sidebar-item" data-legend="Agente IA (CRM)" title="Agente IA (CRM) & Piloto Automático">
      <i data-lucide="zap" class="si text-[#f5a800]"></i>
      <span class="sl font-semibold">Agente IA (CRM)</span>
      <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse ms-auto" title="Piloto Automático Ativo"></span>
    </div>

    <div class="sg mt-2">OPERAÇÕES &amp; SERVIÇOS</div>
    <!-- Clientes -->
    <div @click="setPage('clientes')" :class="currentPage==='clientes'?'active':''" class="sidebar-item" data-legend="Clientes" title="Clientes">
      <i data-lucide="users" class="si"></i>
      <span class="sl">Clientes</span>
      <span class="sb2 badge bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 text-[10px] px-2 py-0.5 rounded-full ms-auto font-semibold" x-text="totalClientsCount"></span>
    </div>

    <!-- Solicitações (Expansível com Árvore) -->
    <div>
      <div @click="toggleMenu('tickets')" 
        :class="openMenus.tickets ? 'text-purple-600 dark:text-purple-400 font-bold' : (currentPage==='solicitacoes' ? 'active' : '')" 
        class="sidebar-item"
        data-legend="Solicitações">
        <i data-lucide="ticket" class="si"></i>
        <span class="sl">Solicitações</span>
        <i data-lucide="chevron-right" class="sa sl w-4 h-4 flex-shrink-0 transition-transform" :class="openMenus.tickets?'rotate-90':''"></i>
      </div>
      <div class="sidebar-sub-menu" x-show="openMenus.tickets" x-transition>
        <div @click="setPage('solicitacoes')" class="sidebar-sub-item" :class="currentPage==='solicitacoes'?'active':''">
          <span class="sidebar-sub-dot"></span>
          <span class="sl">Central de Demandas</span>
        </div>
        <div @click="setPage('solicitacoes'); reqFilterStatus='Nova'" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span>
          <span class="sl">Novas / Triagem</span>
        </div>
        <div @click="setPage('solicitacoes'); reqFilterStatus='Em Execução'" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span>
          <span class="sl">Em Andamento</span>
        </div>
        <div @click="setPage('solicitacoes'); reqFilterStatus='Concluída'" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span>
          <span class="sl">Concluídas</span>
        </div>
      </div>
    </div>

    <!-- Projetos -->
    <div @click="setPage('projetos')" :class="currentPage==='projetos'?'active':''" class="sidebar-item" data-legend="Projetos" title="Projetos">
      <i data-lucide="folder-kanban" class="si"></i>
      <span class="sl">Projetos</span>
      <span class="sb2 badge bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 text-[10px] px-2 py-0.5 rounded-full ms-auto font-bold">12</span>
    </div>

    <div class="sg mt-2">ADMINISTRAÇÃO &amp; GESTÃO</div>
    <!-- Financeiro -->
    <div @click="setPage('financeiro')" :class="currentPage==='financeiro'?'active':''" class="sidebar-item" data-legend="Financeiro" title="Financeiro">
      <i data-lucide="wallet" class="si"></i>
      <span class="sl">Financeiro</span>
    </div>

    <!-- Relatórios -->
    <div @click="setPage('relatorios')" :class="currentPage==='relatorios'?'active':''" class="sidebar-item" data-legend="Relatórios" title="Relatórios">
      <i data-lucide="bar-chart-2" class="si"></i>
      <span class="sl">Relatórios</span>
    </div>

    <!-- Equipe e Usuários -->
    <div @click="setPage('usuarios')" :class="currentPage==='usuarios'?'active':''" class="sidebar-item" data-legend="Equipe e Usuários" title="Equipe e Usuários">
      <i data-lucide="user-check" class="si"></i>
      <span class="sl">Equipe e Usuários</span>
      <span class="sb2 badge bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 text-[10px] px-2 py-0.5 rounded-full ms-auto font-semibold" x-text="users.length || 10"></span>
    </div>

    <!-- Configurações -->
    <div @click="setPage('configuracoes')" :class="currentPage==='configuracoes'?'active':''" class="sidebar-item" data-legend="Configurações" title="Configurações">
      <i data-lucide="settings" class="si"></i>
      <span class="sl">Configurações</span>
    </div>

    <div class="sg mt-2">UNIDADES RACHI</div>
    <!-- RACHI Academy -->
    <div>
      <div @click="toggleMenu('academy')" :class="currentPage.startsWith('academy') ? 'text-blue-600 font-bold' : ''" class="sidebar-item" data-legend="RACHI Academy">
        <img src="/images/areas/rachi-academy.png" alt="RACHI Academy" class="w-4 h-4 object-contain shrink-0">
        <span class="sl">RACHI Academy</span>
        <i data-lucide="chevron-right" class="sa sl w-3.5 h-3.5" :class="openMenus.academy?'open':''"></i>
      </div>
      <div class="sidebar-sub-menu" x-show="openMenus.academy" x-transition>
        <div @click="setPage('academy-cursos')" :class="currentPage==='academy-cursos'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Cursos</span>
        </div>
        <div @click="setPage('academy-alunos')" :class="currentPage==='academy-alunos'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Alunos</span>
        </div>
      </div>
    </div>

    <!-- RACHI Human Capital -->
    <div>
      <div @click="toggleMenu('rh')" :class="currentPage.startsWith('rh') ? 'text-emerald-600 font-bold' : ''" class="sidebar-item" data-legend="RACHI Human Capital">
        <img src="/images/areas/rachi-human-capital.png" alt="RACHI Human Capital" class="w-4 h-4 object-contain shrink-0">
        <span class="sl">RACHI Human Capital</span>
        <i data-lucide="chevron-right" class="sa sl w-3.5 h-3.5" :class="openMenus.rh?'open':''"></i>
      </div>
      <div class="sidebar-sub-menu" x-show="openMenus.rh" x-transition>
        <div @click="setPage('rh-solicitacoes')" :class="currentPage==='rh-solicitacoes'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Solicitações RH</span>
        </div>
        <div @click="setPage('rh-vagas')" :class="currentPage==='rh-vagas'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Vagas</span>
        </div>
      </div>
    </div>

    <!-- RACHI Print -->
    <div>
      <div @click="toggleMenu('grafica')" :class="currentPage.startsWith('grafica') ? 'text-amber-600 font-bold' : ''" class="sidebar-item" data-legend="RACHI Print">
        <img src="/images/areas/rachi-print.png" alt="RACHI Print" class="w-4 h-4 object-contain shrink-0">
        <span class="sl">RACHI Print</span>
        <i data-lucide="chevron-right" class="sa sl w-3.5 h-3.5" :class="openMenus.grafica?'open':''"></i>
      </div>
      <div class="sidebar-sub-menu" x-show="openMenus.grafica" x-transition>
        <div @click="setPage('grafica-produtos')" :class="currentPage==='grafica-produtos'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Produtos Gráficos</span>
        </div>
        <div @click="setPage('grafica-orcamentos')" :class="currentPage==='grafica-orcamentos'?'active':''" class="sidebar-sub-item">
          <span class="sidebar-sub-dot"></span><span class="sl">Solicitações de Cotação</span>
        </div>
      </div>
    </div>
  </nav>


  <!-- Sidebar Footer: Toggle & Logout -->
  <div class="sidebar-footer shrink-0 border-t border-slate-200/80 dark:border-white/5 p-2 bg-slate-50/50 dark:bg-white/[0.02] space-y-1">
    <!-- Botão de Expandir / Recolher no Rodapé do Sidebar -->
    <div class="sidebar-item cursor-pointer text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white transition"
         @click="sidebarCollapsed = !sidebarCollapsed"
         :data-legend="sidebarCollapsed ? 'Expandir Menu' : 'Recolher Menu'"
         :title="sidebarCollapsed ? 'Expandir Menu' : 'Recolher Menu'">
      <i x-show="!sidebarCollapsed" data-lucide="panel-left-close" class="si"></i>
      <i x-show="sidebarCollapsed" data-lucide="panel-left-open" class="si" style="display: none;"></i>
      <span class="sl" x-text="sidebarCollapsed ? 'Expandir Menu' : 'Recolher Menu'">Recolher Menu</span>
    </div>

    <div class="sidebar-item hover:bg-rose-50 dark:hover:bg-rose-500/10 text-rose-600 dark:text-rose-400 group transition-colors cursor-pointer" 
         @click="logout()" 
         data-legend="Encerrar Sessão"
         title="Encerrar Sessão">
      <i data-lucide="log-out" class="si text-rose-500 group-hover:scale-110 transition-transform"></i>
      <span class="sl text-rose-600 dark:text-rose-400 text-xs font-bold">Encerrar Sessão</span>
    </div>
  </div>
</aside>

<div x-show="mobileMenuOpen" @click="mobileMenuOpen=false" class="fixed inset-0 bg-black/60 z-[99] md:hidden" x-cloak></div>

<!-- MAIN CONTENT -->
<div id="admin-main" :class="{'sc': sidebarCollapsed}">
  <header id="admin-header" class="px-5 py-3.5 border-b border-slate-100 dark:border-white/5 flex items-center justify-between gap-4 flex-wrap">
    <div class="flex items-center gap-3">
      <button @click="mobileMenuOpen=!mobileMenuOpen" class="md:hidden p-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 text-slate-600 dark:text-slate-400 cursor-pointer">
        <i data-lucide="menu" class="w-5 h-5"></i>
      </button>

      <div>
        <h1 class="text-base sm:text-lg font-black text-slate-900 dark:text-white leading-tight" style="font-family:Outfit">
          Bom dia, <span x-text="adminUser.nome.split(' ')[0] || 'John'">John</span>
        </h1>
        <p class="text-[11px] sm:text-xs text-slate-400 font-medium">
          Aqui estão as atualizações mais recentes do sistema
        </p>
      </div>
    </div>

    <!-- HORIZONTAL COMPACT CARDS & PILLS (MODELO REFERENCIA) -->
    <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
      <!-- Botão Voltar ao Site (Pílula Elegante no Header) -->
      <a href="/" 
         class="panze-hdr-pill !no-underline hover:border-blue-300 dark:hover:border-blue-500/40 hover:bg-blue-50/60 dark:hover:bg-blue-500/10 text-blue-700 dark:text-blue-300 transition group shadow-2xs" 
         title="Voltar ao Site Principal da RACHI">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400 group-hover:-translate-x-0.5 transition-transform"></i>
        <span class="text-[11px] font-bold">Voltar ao Site</span>
        <i data-lucide="external-link" class="w-3 h-3 opacity-60 text-blue-600 dark:text-blue-400"></i>
      </a>

      <!-- 1. Cron run / Sincronização -->
      <div class="panze-hdr-pill cursor-pointer hover:border-slate-300 dark:hover:border-white/20" @click="refreshSync()" title="Executar sincronização">
        <button class="w-6 h-6 rounded-full bg-slate-50 dark:bg-white/5 flex items-center justify-center text-slate-500 hover:text-purple-600 transition" :class="isSyncing ? 'animate-spin text-purple-600' : ''">
          <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
        </button>
        <div class="leading-none text-left">
          <div class="text-[11px] font-bold text-slate-900 dark:text-white">Cron run</div>
          <div class="text-[9.5px] text-slate-400 mt-0.5" x-text="syncTimeText">Just now •</div>
        </div>
      </div>

      <!-- 2. Sort By / Período -->
      <div class="panze-hdr-pill cursor-pointer">
        <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5 text-slate-400"></i>
        <div class="text-[11px] leading-none">
          <span class="text-slate-400 text-[10px]">Sort By</span>
          <select aria-label="Filtrar período" class="bg-transparent border-0 text-[11px] font-bold text-slate-800 dark:text-white focus:outline-none cursor-pointer block p-0">
            <option value="all">All-Time</option>
            <option value="30">Últimos 30 dias</option>
            <option value="7">Últimos 7 dias</option>
          </select>
        </div>
      </div>

      <!-- 3. Quick Action Icons -->
      <div class="panze-hdr-pill !py-1.5 !px-2.5 gap-2">
        <button @click="setPage('relatorios')" class="w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 hover:text-slate-800 transition" title="Histórico">
          <i data-lucide="clock" class="w-3.5 h-3.5"></i>
        </button>
        <button @click="setPage('solicitacoes')" class="w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 hover:text-slate-800 transition" title="Tarefas e Pedidos">
          <i data-lucide="check-square" class="w-3.5 h-3.5"></i>
        </button>
        <button @click="setPage('servicos')" class="w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 hover:text-slate-800 transition" title="Serviços & Catálogo">
          <i data-lucide="layers" class="w-3.5 h-3.5"></i>
        </button>
        <button @click="setPage('notificacoes')" class="w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 hover:text-purple-600 transition relative" title="Notificações">
          <i data-lucide="bell" class="w-3.5 h-3.5"></i>
          <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-rose-500 rounded-full animate-ping"></span>
          <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
        </button>
        <!-- Toggle Light/Dark Mode -->
        <button @click="toggleTheme()" class="w-7 h-7 rounded-lg hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-500 transition" title="Alternar Modo Claro / Escuro">
          <i data-lucide="sun" class="w-3.5 h-3.5 text-amber-500" x-show="theme==='dark'"></i>
          <i data-lucide="moon" class="w-3.5 h-3.5 text-blue-600" x-show="theme==='light'"></i>
        </button>
      </div>

      <!-- 4. User Profile Card -->
      <div class="panze-hdr-pill !py-1 !pl-1.5 !pr-3.5 gap-2.5 cursor-pointer" @click="setPage('usuarios')" title="Perfil do Administrador">
        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-purple-600 to-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">
          SA
        </div>
        <div class="text-left leading-tight hidden sm:block">
          <div class="text-xs font-bold text-slate-900 dark:text-white" x-text="adminUser.nome || 'Super Administrador'">John Smith</div>
          <div class="text-[10px] text-purple-600 dark:text-purple-400 font-semibold">@admin</div>
        </div>
      </div>
    </div>
  </header>

  <main class="p-4 sm:p-6 lg:p-7 max-w-[1520px] mx-auto space-y-6">

    <!-- DASHBOARD GERAL / HOME (MODELO FIDEDIGNO REFERENCIA VISUAL) -->
    <section x-show="currentPage==='dashboard'" x-cloak class="space-y-6">

      <!-- QUICK OVERVIEW BANNER COM GRADIENTE SUAVE E STATS EM PÍLULAS -->
      <div class="panze-overview-banner shadow-xs">
        <!-- Floating Ambient Glow Orbs -->
        <div class="absolute -top-16 -right-16 w-80 h-80 rounded-full bg-cyan-300/40 dark:bg-cyan-600/20 blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 -translate-y-1/2 w-96 h-48 rounded-full bg-blue-300/35 dark:bg-blue-600/15 blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-16 left-12 w-64 h-64 rounded-full bg-purple-300/35 dark:bg-purple-600/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10">
          <div class="mb-5">
            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight" style="font-family:Outfit">
              Visão Geral
            </h2>
            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 font-medium mt-0.5">
              Acompanhe os principais indicadores da Rachi em tempo real.
            </p>
          </div>

          <!-- 5 STAT CARDS EM PÍLULAS FROSTED GLASS -->
          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5">
            <!-- 1. Total de Clientes -->
            <div @click="setPage('clientes')" class="panze-stat-pill cursor-pointer group" title="Ver Clientes">
              <div class="flex items-baseline gap-1.5 flex-wrap">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white group-hover:text-purple-600 transition-colors" style="font-family:Outfit">232</span>
                <span class="text-[10.5px] font-bold text-slate-500 dark:text-slate-400">(12 Novos)</span>
              </div>
              <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 mt-2 block">Total de Clientes</span>
            </div>

            <!-- 2. Serviços no Catálogo -->
            <div @click="setPage('servicos')" class="panze-stat-pill cursor-pointer group" title="Ver Catálogo de Serviços">
              <div class="flex items-baseline gap-1.5 flex-wrap">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white group-hover:text-blue-600 transition-colors" style="font-family:Outfit">87</span>
                <span class="text-[10.5px] font-bold text-slate-500 dark:text-slate-400">(5 Novos)</span>
              </div>
              <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 mt-2 block">Serviços no Catálogo</span>
            </div>

            <!-- 3. Cotações & Propostas -->
            <div @click="setPage('grafica-orcamentos')" class="panze-stat-pill cursor-pointer group" title="Ver Cotações">
              <div class="flex items-baseline gap-1.5 flex-wrap">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white group-hover:text-cyan-600 transition-colors" style="font-family:Outfit">22</span>
                <span class="text-[10.5px] font-bold text-slate-500 dark:text-slate-400">(2 Recentes)</span>
              </div>
              <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 mt-2 block">Cotações & Propostas</span>
            </div>

            <!-- 4. Solicitações Recebidas -->
            <div @click="setPage('solicitacoes')" class="panze-stat-pill cursor-pointer group" title="Ver Solicitações">
              <div class="flex items-baseline gap-1.5 flex-wrap">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white group-hover:text-emerald-600 transition-colors" style="font-family:Outfit">18</span>
                <span class="text-[10.5px] font-bold text-slate-500 dark:text-slate-400">(6 Recentes)</span>
              </div>
              <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 mt-2 block">Solicitações Recebidas</span>
            </div>

            <!-- 5. Projetos em Andamento -->
            <div @click="setPage('projetos')" class="panze-stat-pill cursor-pointer group col-span-2 sm:col-span-1" title="Ver Projetos">
              <div class="flex items-baseline gap-1.5 flex-wrap">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white group-hover:text-amber-500 transition-colors" style="font-family:Outfit">3.8k</span>
                <span class="text-[10.5px] font-bold text-slate-500 dark:text-slate-400">(1237 Novos)</span>
              </div>
              <span class="text-xs font-semibold text-slate-600 dark:text-slate-300 mt-2 block">Projetos em Andamento</span>
            </div>
          </div>
        </div>
      </div>

      <!-- MIDDLE ROW: GRÁFICO 1 (SOLICITAÇÕES POR CLIENTE) + 4 OPERATIONAL CARDS GRID 2x2 -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- GRÁFICO 1: Solicitações por Cliente (Donut Chart) -->
        <div class="lg:col-span-5 rounded-[24px] bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 sm:p-6 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">
              Solicitações por Cliente
            </h3>
            <span class="text-xs font-semibold text-slate-400">Atividade Geral</span>
          </div>

          <div class="flex flex-col sm:flex-row items-center justify-between gap-6 my-auto">
            <!-- SVG Donut Chart Segmented -->
            <div class="relative w-40 h-40 shrink-0 flex items-center justify-center">
              <svg viewBox="0 0 160 160" class="w-full h-full -rotate-90">
                <!-- Segment 1: Cyan (GundjaTech) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#00e5ff" stroke-width="20" stroke-dasharray="75 364" stroke-dashoffset="0" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
                <!-- Segment 2: Royal Blue (Cotech) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#3b82f6" stroke-width="20" stroke-dasharray="65 364" stroke-dashoffset="-85" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
                <!-- Segment 3: Purple (Rachi Tech) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#8b5cf6" stroke-width="20" stroke-dasharray="55 364" stroke-dashoffset="-160" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
                <!-- Segment 4: Magenta/Pink (Laurinita) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#ec4899" stroke-width="20" stroke-dasharray="45 364" stroke-dashoffset="-225" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
                <!-- Segment 5: Lime (Inst. Saber) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#10b981" stroke-width="20" stroke-dasharray="40 364" stroke-dashoffset="-280" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
                <!-- Segment 6: Amber (BFA) -->
                <circle cx="80" cy="80" r="58" fill="none" stroke="#f59e0b" stroke-width="20" stroke-dasharray="35 364" stroke-dashoffset="-330" stroke-linecap="round" class="hover:opacity-85 transition-opacity cursor-pointer"></circle>
              </svg>
              <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                <span class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">100%</span>
                <span class="text-[9.5px] font-bold text-slate-400 uppercase tracking-wider">Atendidos</span>
              </div>
            </div>

            <!-- Legend 2 columns -->
            <div class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-xs w-full">
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#00e5ff] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="GundjaTech">GundjaTech</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#f59e0b] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="Laurinita Ltda">Laurinita Ltda</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#3b82f6] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="Cotech Contabilidade">Cotech Contab.</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="Instituto Saber">Inst. Saber</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#8b5cf6] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="Rachi Tech">Rachi Tech</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-[#ec4899] shrink-0"></span>
                <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" title="BFA Angola">BFA Angola</span>
              </div>
            </div>
          </div>
        </div>

        <!-- 4 OPERATIONAL CARDS GRID 2x2 -->
        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Card 1: Total de Solicitações -->
          <div @click="setPage('solicitacoes')" class="panze-op-card cursor-pointer group" title="Ver Todas as Solicitações">
            <div>
              <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-2">
                  <span class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">265</span>
                  <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40 px-2 py-0.5 rounded-full flex items-center gap-0.5">
                    4% ↑
                  </span>
                </div>
              </div>
              <h4 class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-2">
                Total de Solicitações
              </h4>
            </div>
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 dark:border-white/5">
              <span class="text-[11px] font-medium text-slate-400">Atividade em tempo real</span>
              <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs shadow-xs group-hover:scale-110 transition-transform">
                <i data-lucide="check" class="w-3.5 h-3.5"></i>
              </span>
            </div>
          </div>

          <!-- Card 2: Solicitações Pendentes -->
          <div @click="setPage('solicitacoes')" class="panze-op-card cursor-pointer group" title="Ver Solicitações Pendentes">
            <div>
              <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-2">
                  <span class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">256</span>
                  <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40 px-2 py-0.5 rounded-full flex items-center gap-0.5">
                    4% ↑
                  </span>
                </div>
              </div>
              <h4 class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-2">
                Solicitações Pendentes
              </h4>
            </div>
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 dark:border-white/5">
              <span class="text-[11px] font-medium text-slate-400">Aguardando triagem</span>
              <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs shadow-xs group-hover:scale-110 transition-transform">
                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
              </span>
            </div>
          </div>

          <!-- Card 3: Solicitações em Andamento -->
          <div @click="setPage('solicitacoes')" class="panze-op-card cursor-pointer group" title="Ver Solicitações em Andamento">
            <div>
              <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-2">
                  <span class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">43</span>
                  <span class="text-[11px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/10 px-2 py-0.5 rounded-full flex items-center gap-0.5">
                    0% ↑
                  </span>
                </div>
              </div>
              <h4 class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-2">
                Em Andamento / Execução
              </h4>
            </div>
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 dark:border-white/5">
              <span class="text-[11px] font-medium text-slate-400">Equipe técnica ativa</span>
              <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs shadow-xs group-hover:scale-110 transition-transform">
                <i data-lucide="play" class="w-3.5 h-3.5"></i>
              </span>
            </div>
          </div>

          <!-- Card 4: Solicitações Concluídas -->
          <div @click="setPage('solicitacoes')" class="panze-op-card cursor-pointer group" title="Ver Solicitações Concluídas">
            <div>
              <div class="flex items-center justify-between">
                <div class="flex items-baseline gap-2">
                  <span class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">12</span>
                  <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/40 px-2 py-0.5 rounded-full flex items-center gap-0.5">
                    0% ↑
                  </span>
                </div>
              </div>
              <h4 class="text-xs sm:text-sm font-semibold text-slate-700 dark:text-slate-300 mt-2">
                Solicitações Concluídas
              </h4>
            </div>
            <div class="flex items-center justify-between mt-4 pt-3 border-t border-slate-100 dark:border-white/5">
              <span class="text-[11px] font-medium text-slate-400">Finalizadas com sucesso</span>
              <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center text-xs shadow-xs group-hover:scale-110 transition-transform">
                <i data-lucide="check-check" class="w-3.5 h-3.5"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- LOWER MIDDLE ROW: GRÁFICO 2 (BARRAS EM CÁPSULAS 12 MESES) + GRÁFICO 3 (RADIAL NOTCHED RING) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
        <!-- GRÁFICO 2: Solicitações ao Longo do Tempo (Stacked Capsule Bars) -->
        <div class="lg:col-span-7 rounded-[24px] bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 sm:p-6 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">
              Solicitações ao Longo do Tempo
            </h3>
            <span class="text-xs font-semibold text-slate-400">Evolução Mensal</span>
          </div>

          <!-- Stacked Capsule Bars 12 Months -->
          <div class="grid grid-cols-12 gap-2 sm:gap-4 items-end px-2 pt-4 pb-2 border-b border-slate-100 dark:border-white/5">
            <!-- Jul -->
            <div class="panze-bar-col" title="Julho">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Jul</span>
              <div class="panze-capsule cap-green" style="height: 38px;"></div>
              <div class="panze-capsule cap-purple" style="height: 22px;"></div>
              <div class="panze-capsule cap-orange" style="height: 48px;"></div>
            </div>
            <!-- Aug -->
            <div class="panze-bar-col" title="Agosto">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Aug</span>
              <div class="panze-capsule cap-green" style="height: 44px;"></div>
              <div class="panze-capsule cap-purple" style="height: 35px;"></div>
              <div class="panze-capsule cap-orange" style="height: 52px;"></div>
            </div>
            <!-- Sep -->
            <div class="panze-bar-col" title="Setembro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Sep</span>
              <div class="panze-capsule cap-green" style="height: 52px;"></div>
              <div class="panze-capsule cap-purple" style="height: 28px;"></div>
              <div class="panze-capsule cap-orange" style="height: 60px;"></div>
            </div>
            <!-- Oct -->
            <div class="panze-bar-col" title="Outubro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Oct</span>
              <div class="panze-capsule cap-green" style="height: 65px;"></div>
              <div class="panze-capsule cap-purple" style="height: 40px;"></div>
              <div class="panze-capsule cap-orange" style="height: 30px;"></div>
            </div>
            <!-- Nov -->
            <div class="panze-bar-col" title="Novembro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Nov</span>
              <div class="panze-capsule cap-green" style="height: 30px;"></div>
              <div class="panze-capsule cap-purple" style="height: 18px;"></div>
              <div class="panze-capsule cap-orange" style="height: 38px;"></div>
            </div>
            <!-- Dec -->
            <div class="panze-bar-col" title="Dezembro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Dec</span>
              <div class="panze-capsule cap-green" style="height: 48px;"></div>
              <div class="panze-capsule cap-purple" style="height: 32px;"></div>
              <div class="panze-capsule cap-orange" style="height: 55px;"></div>
            </div>
            <!-- Jan -->
            <div class="panze-bar-col" title="Janeiro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Jan</span>
              <div class="panze-capsule cap-green" style="height: 36px;"></div>
              <div class="panze-capsule cap-purple" style="height: 24px;"></div>
              <div class="panze-capsule cap-orange" style="height: 42px;"></div>
            </div>
            <!-- Feb -->
            <div class="panze-bar-col" title="Fevereiro">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Feb</span>
              <div class="panze-capsule cap-green" style="height: 56px;"></div>
              <div class="panze-capsule cap-purple" style="height: 29px;"></div>
              <div class="panze-capsule cap-orange" style="height: 45px;"></div>
            </div>
            <!-- Mar -->
            <div class="panze-bar-col" title="Março">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Mar</span>
              <div class="panze-capsule cap-green" style="height: 42px;"></div>
              <div class="panze-capsule cap-purple" style="height: 36px;"></div>
              <div class="panze-capsule cap-orange" style="height: 58px;"></div>
            </div>
            <!-- Apr -->
            <div class="panze-bar-col" title="Abril">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Apr</span>
              <div class="panze-capsule cap-green" style="height: 60px;"></div>
              <div class="panze-capsule cap-purple" style="height: 22px;"></div>
              <div class="panze-capsule cap-orange" style="height: 35px;"></div>
            </div>
            <!-- May -->
            <div class="panze-bar-col" title="Maio">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">May</span>
              <div class="panze-capsule cap-green" style="height: 50px;"></div>
              <div class="panze-capsule cap-purple" style="height: 30px;"></div>
              <div class="panze-capsule cap-orange" style="height: 48px;"></div>
            </div>
            <!-- Jun -->
            <div class="panze-bar-col" title="Junho">
              <span class="text-[10px] font-semibold text-slate-400 mt-2">Jun</span>
              <div class="panze-capsule cap-green" style="height: 45px;"></div>
              <div class="panze-capsule cap-purple" style="height: 28px;"></div>
              <div class="panze-capsule cap-orange" style="height: 62px;"></div>
            </div>
          </div>

          <!-- Bottom Legend -->
          <div class="flex items-center justify-between flex-wrap gap-4 pt-4 text-xs">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-[#00d68f]"></span>
              <span class="font-bold text-slate-900 dark:text-white">234</span>
              <span class="text-slate-500 dark:text-slate-400">Total Recebidas</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-[#8b5cf6]"></span>
              <span class="font-bold text-slate-900 dark:text-white">16</span>
              <span class="text-slate-500 dark:text-slate-400">Em Andamento</span>
            </div>
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full bg-[#f97316]"></span>
              <span class="font-bold text-slate-900 dark:text-white">43</span>
              <span class="text-slate-500 dark:text-slate-400">Concluídas</span>
            </div>
          </div>
        </div>

        <!-- GRÁFICO 3: Solicitações por Categoria (Radial Segmented Ring) -->
        <div class="lg:col-span-5 rounded-[24px] bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 sm:p-6 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">
              Solicitações por Categoria
            </h3>
            <span class="text-xs font-semibold text-slate-400">Distribuição</span>
          </div>

          <div class="flex flex-col sm:flex-row items-center justify-between gap-6 my-auto">
            <!-- Radial Notched Ring Chart (28 Rounded Notches) -->
            <div class="relative w-44 h-44 shrink-0 flex items-center justify-center">
              <svg viewBox="0 0 200 200" class="w-full h-full">
                <g transform="translate(100, 100)">
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#f97316" transform="rotate(0)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#ea580c" transform="rotate(13)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#f97316" transform="rotate(26)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#fb923c" transform="rotate(39)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#fdba74" transform="rotate(52)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#fed7aa" transform="rotate(65)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#fbcfe8" transform="rotate(78)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#f472b6" transform="rotate(91)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#e879f9" transform="rotate(104)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#d946ef" transform="rotate(117)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#c026d3" transform="rotate(130)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#a855f7" transform="rotate(143)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#9333ea" transform="rotate(156)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#7e22ce" transform="rotate(169)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#6b21a8" transform="rotate(182)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#581c87" transform="rotate(195)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#4338ca" transform="rotate(208)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#3b82f6" transform="rotate(221)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#0284c7" transform="rotate(234)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#06b6d4" transform="rotate(247)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#00e5ff" transform="rotate(260)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#14b8a6" transform="rotate(273)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#10b981" transform="rotate(286)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#22c55e" transform="rotate(299)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#4ade80" transform="rotate(312)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#84cc16" transform="rotate(325)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#eab308" transform="rotate(338)"/>
                  <rect x="-3" y="-80" width="6" height="18" rx="3" fill="#f59e0b" transform="rotate(351)"/>
                </g>
              </svg>
              <!-- Center Metric -->
              <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                <span class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">40</span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Tickets</span>
              </div>
            </div>

            <!-- Right Legend with Change Metrics -->
            <div class="space-y-3.5 text-xs w-full">
              <div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#f97316] shrink-0"></span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Criação de Sites</span>
                  </div>
                  <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400">↑ 44.75%</span>
                </div>
                <div class="text-[10px] text-slate-400 pl-4.5">Portais, landing pages e e-commerce</div>
              </div>

              <div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#8b5cf6] shrink-0"></span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Gestão de Domínios</span>
                  </div>
                  <span class="text-[11px] font-bold text-rose-500">↓ 46.27%</span>
                </div>
                <div class="text-[10px] text-slate-400 pl-4.5">DNS, registros e renovações</div>
              </div>

              <div>
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] shrink-0"></span>
                    <span class="font-bold text-slate-800 dark:text-slate-200">Tráfego Pago & Ads</span>
                  </div>
                  <span class="text-[11px] font-bold text-emerald-600 dark:text-emerald-400">↑ 25%</span>
                </div>
                <div class="text-[10px] text-slate-400 pl-4.5">Meta Ads, Google Ads e campanhas</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- BOTTOM ROW: CENTRAL DE SOLICITAÇÕES RECENTES (TABELA RECENT PUBLICATIONS) -->
      <div class="rounded-[24px] bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <!-- Table Header & Actions -->
        <div class="p-5 sm:p-6 border-b border-slate-100 dark:border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h3 class="text-base font-bold text-slate-900 dark:text-white tracking-tight">
              Solicitações Recentes
            </h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
              Últimas publicações e pedidos gerados pelos clientes na plataforma.
            </p>
          </div>

          <div class="flex items-center gap-2.5">
            <button @click="setPage('relatorios')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-white/5 hover:bg-slate-50 text-slate-700 dark:text-slate-200 text-xs font-bold transition shadow-2xs cursor-pointer" title="Exportar tabela">
              <i data-lucide="download" class="w-3.5 h-3.5 text-slate-500"></i>
              <span>Exportar</span>
            </button>

            <div class="inline-flex items-center rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-white/5 px-2.5 py-1 text-xs font-semibold text-slate-700 dark:text-slate-300">
              <span class="text-slate-400 mr-1.5">Período:</span>
              <select class="bg-transparent border-0 text-xs font-bold text-slate-800 dark:text-white focus:outline-none cursor-pointer">
                <option value="all">Todo o período</option>
                <option value="30">Últimos 30 dias</option>
                <option value="7">Últimos 7 dias</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Filter and Search Bar -->
        <div class="p-4 bg-slate-50/60 dark:bg-white/[0.02] border-b border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-3">
          <!-- Filter Tabs -->
          <div class="flex items-center gap-1.5 overflow-x-auto w-full sm:w-auto pb-1 sm:pb-0">
            <button @click="reqFilterStatus = 'all'" :class="reqFilterStatus==='all' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-white/5 hover:bg-slate-100'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer shrink-0">
              Todas (<span x-text="allRequests.length">14</span>)
            </button>
            <button @click="reqFilterStatus = 'Nova'" :class="reqFilterStatus==='Nova' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-white/5 hover:bg-slate-100'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer shrink-0">
              Pendentes
            </button>
            <button @click="reqFilterStatus = 'Em Execução'" :class="reqFilterStatus==='Em Execução' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-white/5 hover:bg-slate-100'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer shrink-0">
              Em Andamento
            </button>
            <button @click="reqFilterStatus = 'Concluída'" :class="reqFilterStatus==='Concluída' ? 'bg-purple-600 text-white shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200/80 dark:border-white/5 hover:bg-slate-100'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition cursor-pointer shrink-0">
              Concluídas
            </button>
          </div>

          <!-- Search Input -->
          <div class="relative w-full sm:w-72">
            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" x-model="reqSearch" placeholder="Filtrar por protocolo, cliente ou serviço..." class="w-full pl-9 pr-3 py-1.5 rounded-xl text-xs bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 text-slate-900 dark:text-white focus:outline-none focus:border-purple-500">
          </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 dark:bg-white/[0.02] text-slate-400 uppercase tracking-wider text-[10.5px] border-b border-slate-100 dark:border-white/5">
              <tr>
                <th class="py-3 px-4 font-bold">Ticket ID</th>
                <th class="py-3 px-4 font-bold">Cliente</th>
                <th class="py-3 px-4 font-bold">E-mail</th>
                <th class="py-3 px-4 font-bold">Serviço / Demanda</th>
                <th class="py-3 px-4 font-bold">Criado em</th>
                <th class="py-3 px-4 font-bold">Responsável</th>
                <th class="py-3 px-4 font-bold text-center">Status</th>
                <th class="py-3 px-4 font-bold text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="r in paginatedRequests" :key="r.id">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-white/[0.02] transition-colors group">
                  <td class="py-3.5 px-4 font-mono font-bold text-purple-600 dark:text-purple-400 whitespace-nowrap" x-text="r.protocol || ('#TKT-'+r.id)"></td>
                  <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white whitespace-nowrap" x-text="r.cliente || r.empresa || 'Cliente'"></td>
                  <td class="py-3.5 px-4 text-slate-500 dark:text-slate-400 whitespace-nowrap" x-text="r.email || (r.cliente ? r.cliente.toLowerCase().replace(/\s+/g,'')+ '@cliente.ao' : 'contato@cliente.ao')"></td>
                  <td class="py-3.5 px-4 max-w-xs truncate text-slate-700 dark:text-slate-300 font-medium" x-text="r.title || r.servico || 'Solicitação de Serviço'"></td>
                  <td class="py-3.5 px-4 text-slate-500 dark:text-slate-400 whitespace-nowrap" x-text="r.data || '24/11/2026'"></td>
                  <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300 whitespace-nowrap font-medium" x-text="r.responsavel || 'Casimiro Gundja'"></td>
                  <td class="py-3.5 px-4 text-center whitespace-nowrap">
                    <span class="px-2.5 py-1 rounded-full text-[10.5px] font-bold uppercase tracking-wider inline-flex items-center gap-1"
                          :class="r.status === 'Concluída' ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/40' : (r.status === 'Nova' ? 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200 dark:border-amber-800/40' : 'bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200 dark:border-blue-800/40')"
                          x-text="r.status || 'Nova'"></span>
                  </td>
                  <td class="py-3.5 px-4 text-right whitespace-nowrap">
                    <div class="flex items-center justify-end gap-1.5">
                      <button @click="openReq(r)" class="p-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 text-slate-600 dark:text-slate-300 transition" title="Ver detalhes">
                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                      </button>
                      <button @click="openReq(r)" class="p-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 text-blue-600 dark:text-blue-400 transition" title="Gerenciar">
                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>

        <!-- Table Footer / Pagination -->
        <div class="p-4 bg-slate-50/40 dark:bg-white/[0.01] border-t border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-slate-500">
          <span>Mostrando <strong>1 a 6</strong> de <strong x-text="allRequests.length">14</strong> solicitações</span>
          <div class="flex items-center gap-1">
            <button class="px-2.5 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-white text-slate-600 dark:text-slate-300 font-bold transition">Anterior</button>
            <button class="px-2.5 py-1 rounded-lg bg-purple-600 text-white font-bold shadow-2xs">1</button>
            <button class="px-2.5 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-white text-slate-600 dark:text-slate-300 font-bold transition">2</button>
            <button class="px-2.5 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-white text-slate-600 dark:text-slate-300 font-bold transition">Próxima</button>
          </div>
        </div>
      </div>

    </section>

    <!-- =====================================================================
         MESSENGER: CENTRAL UNIFICADA DE CHAT AO VIVO DO SITE & WHATSAPP (PRINT 1)
         ===================================================================== -->
    <section x-show="currentPage==='messenger'" x-cloak class="space-y-4">
      <!-- ABAS SUPERIORES DE ATENDIMENTO & ATALHOS GLOBAIS (PRINT 1) -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 rounded-2xl p-3 sm:px-5 shadow-xs">
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 text-xs scrollbar-none">
          <button @click="messengerFilter = 'all'" :class="messengerFilter === 'all' ? 'bg-[#0050f0] text-white font-bold shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-slate-200/70 dark:border-white/5 hover:bg-slate-200/70'" class="px-3 py-1.5 rounded-xl font-semibold transition shrink-0 cursor-pointer flex items-center gap-1.5">
            <span>Todas</span>
            <span class="px-1.5 py-0.2 rounded-full bg-black/15 text-[10px]" x-text="conversations.length"></span>
          </button>
          <button @click="messengerFilter = 'open'" :class="messengerFilter === 'open' ? 'bg-[#f5a800] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-slate-200/70 dark:border-white/5 hover:bg-slate-200/70'" class="px-3 py-1.5 rounded-xl font-semibold transition shrink-0 cursor-pointer flex items-center gap-1.5">
            <span>Abertas</span>
            <span class="px-1.5 py-0.2 rounded-full bg-black/15 text-[10px]" x-text="conversations.filter(c => c.status !== 'closed').length"></span>
          </button>
          <button @click="messengerFilter = 'waiting_human'" :class="messengerFilter === 'waiting_human' ? 'bg-[#f5a800] text-slate-950 font-bold shadow-xs' : 'bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-500/20 hover:bg-amber-500/20'" class="px-3 py-1.5 rounded-xl font-bold transition shrink-0 flex items-center gap-1.5 cursor-pointer">
            <span class="w-1.5 h-1.5 rounded-full bg-[#f5a800] animate-ping"></span>
            <span>Aguardando Humano</span>
            <span class="px-1.5 py-0.2 rounded-full bg-amber-500/20 text-[10px]" x-text="waitingHumanCount"></span>
          </button>
          <button @click="messengerFilter = 'closed'" :class="messengerFilter === 'closed' ? 'bg-[#0050f0] text-white font-bold shadow-xs' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-slate-200/70 dark:border-white/5 hover:bg-slate-200/70'" class="px-3 py-1.5 rounded-xl font-semibold transition shrink-0 cursor-pointer flex items-center gap-1.5">
            <span>Encerradas</span>
            <span class="px-1.5 py-0.2 rounded-full bg-black/15 text-[10px]">0</span>
          </button>
        </div>
        <div class="flex items-center gap-2 shrink-0">
          <a href="https://web.whatsapp.com" target="_blank" rel="noopener" class="border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 text-slate-700 dark:text-slate-200 font-semibold px-3 py-1.5 rounded-xl text-xs flex items-center gap-1.5 shadow-2xs transition">
            <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-500"></i>
            <span>Canais WhatsApp</span>
          </a>
          <button @click="setPage('agente-ia')" type="button" class="bg-[#0050f0] hover:bg-[#0040d0] text-white font-bold px-3.5 py-1.5 rounded-xl text-xs flex items-center gap-1.5 shadow-xs transition cursor-pointer">
            <i data-lucide="zap" class="w-3.5 h-3.5 text-[#38bdf8]"></i>
            <span>Configurar Agente IA &gt;</span>
          </button>
        </div>
      </div>

      <!-- MAIN OMNICHANNEL MESSENGER PANEL (2-COLUMN: INBOX LIST + ACTIVE CHAT WINDOW) -->
      <div class="rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-sm overflow-hidden flex flex-col md:flex-row h-[calc(100vh-220px)] min-h-[640px]">
        
        <!-- COLUNA ESQUERDA: LISTA DE CONVERSAS (LARGURA FIXA MODERNA) -->
        <div class="w-full md:w-[350px] lg:w-[380px] shrink-0 border-r border-slate-200/70 dark:border-white/5 flex flex-col bg-slate-50/50 dark:bg-[#071326]/60">
          
          <!-- CABEÇALHO DO INBOX (PRINT 1) -->
          <div class="p-3.5 border-b border-slate-200/70 dark:border-white/5 flex items-center justify-between gap-2 bg-white/70 dark:bg-[#0c1527]/70 backdrop-blur-xs">
            <div class="flex items-center gap-2">
              <span class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider">INBOX DE ATENDIMENTO</span>
              <span class="px-1.5 py-0.5 rounded-full bg-slate-200/80 dark:bg-white/10 text-[10.5px] font-bold text-slate-700 dark:text-slate-300" x-text="filteredConversations.length"></span>
            </div>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
              Ao vivo
            </span>
          </div>

          <!-- BUSCA & FILTROS POR CANAL -->
          <div class="p-3 border-b border-slate-200/70 dark:border-white/5 space-y-2 bg-white/50 dark:bg-[#0c1527]/50">
            <div class="relative">
              <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
              <input type="text" x-model="messengerSearch" placeholder="Buscar cliente, assunto ou canal..." class="w-full pl-9 pr-3 py-2 text-xs bg-slate-50 dark:bg-slate-800/80 border border-slate-200 dark:border-white/10 rounded-xl text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0] transition">
            </div>

            <!-- FILTROS POR CANAL (SEGMENTED PILLS) -->
            <div class="flex items-center gap-1 overflow-x-auto pb-0.5 text-[11px] scrollbar-none">
              <button @click="messengerChannelFilter = 'all'" :class="messengerChannelFilter === 'all' ? 'bg-[#0050f0] text-white font-bold shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/5 hover:bg-slate-100'" class="px-2 py-1 rounded-lg font-semibold transition shrink-0 cursor-pointer">
                Todas
              </button>
              <button @click="messengerChannelFilter = 'whatsapp'" :class="messengerChannelFilter === 'whatsapp' ? 'bg-[#0050f0] text-white font-bold shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/5 hover:bg-slate-100'" class="px-2 py-1 rounded-lg font-semibold transition shrink-0 flex items-center gap-1 cursor-pointer">
                <i data-lucide="phone" class="w-2.5 h-2.5 text-emerald-500"></i>
                WhatsApp
              </button>
              <button @click="messengerChannelFilter = 'livechat'" :class="messengerChannelFilter === 'livechat' ? 'bg-[#0050f0] text-white font-bold shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/5 hover:bg-slate-100'" class="px-2 py-1 rounded-lg font-semibold transition shrink-0 flex items-center gap-1 cursor-pointer">
                <i data-lucide="globe" class="w-2.5 h-2.5 text-[#0050f0]"></i>
                Site
              </button>
              <button @click="messengerChannelFilter = 'portal'" :class="messengerChannelFilter === 'portal' ? 'bg-[#0050f0] text-white font-bold shadow-2xs' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/5 hover:bg-slate-100'" class="px-2 py-1 rounded-lg font-semibold transition shrink-0 flex items-center gap-1 cursor-pointer">
                <i data-lucide="user-check" class="w-2.5 h-2.5 text-amber-500"></i>
                Portal
              </button>
            </div>
          </div>

          <!-- LISTA DE CARDS DE CONVERSA -->
          <div class="overflow-y-auto flex-1 divide-y divide-slate-100 dark:divide-white/5">
            <template x-for="c in filteredConversations" :key="c.id">
              <div @click="selectConversation(c)" 
                   :class="activeChatId === c.id ? 'bg-blue-50/70 dark:bg-[#0050f0]/10 border-l-4 border-l-[#0050f0] shadow-xs' : 'hover:bg-slate-100/70 dark:hover:bg-white/[0.03] border-l-4 border-transparent'" 
                   class="p-3.5 cursor-pointer transition-all flex items-start gap-3 relative group">
                <!-- AVATAR COM CANAL BADGE -->
                <div class="relative shrink-0">
                  <div class="w-10 h-10 rounded-full text-white font-bold text-xs flex items-center justify-center shadow-xs" :class="c.avatarBg" x-text="c.avatar"></div>
                  <!-- Ícone do Canal -->
                  <span x-show="c.channel === 'whatsapp'" class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-500 text-white flex items-center justify-center text-[9px] shadow-xs" title="WhatsApp Oficial">
                    <i data-lucide="phone" class="w-2.5 h-2.5"></i>
                  </span>
                  <span x-show="c.channel === 'livechat'" class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-[#0050f0] text-white flex items-center justify-center text-[9px] shadow-xs" title="Live Chat Site">
                    <i data-lucide="globe" class="w-2.5 h-2.5"></i>
                  </span>
                  <span x-show="c.channel === 'portal'" class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-[#f5a800] text-slate-950 flex items-center justify-center text-[9px] shadow-xs font-black" title="Portal do Cliente">
                    <i data-lucide="user-check" class="w-2.5 h-2.5"></i>
                  </span>
                </div>

                <!-- INFO PRINCIPAL -->
                <div class="flex-1 min-w-0">
                  <div class="flex items-center justify-between gap-1">
                    <span class="text-xs font-bold text-slate-900 dark:text-white truncate" x-text="c.name"></span>
                    <span class="text-[10px] text-slate-400 shrink-0 font-medium" x-text="c.lastTime"></span>
                  </div>
                  <!-- Indicador de Status IA vs Humano -->
                  <div class="flex items-center gap-1.5 mt-1">
                    <template x-if="c.aiMode === 'waiting_human'">
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-[#f5a800]/15 text-[#b45309] dark:text-[#fbbf24] border border-[#f5a800]/30 flex items-center gap-1 animate-pulse">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#f5a800]"></span>
                        TRANSBORDO HUMANO
                      </span>
                    </template>
                    <template x-if="c.aiMode === 'human_handling'">
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8] border border-[#0050f0]/20 flex items-center gap-1">
                        <i data-lucide="user" class="w-2.5 h-2.5"></i>
                        EM ATENDIMENTO
                      </span>
                    </template>
                    <template x-if="c.aiMode === 'ai_handling'">
                      <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 flex items-center gap-1">
                        <i data-lucide="bot" class="w-2.5 h-2.5 text-[#0050f0]"></i>
                        IA ATIVA
                      </span>
                    </template>
                  </div>
                  <div class="text-[11px] font-medium text-slate-500 dark:text-slate-400 truncate mt-0.5" x-text="c.company"></div>
                  <div class="text-[11px] text-slate-600 dark:text-slate-300 truncate mt-1 leading-snug" :class="c.unread > 0 ? 'font-semibold text-slate-900 dark:text-white' : ''" x-text="c.messages[c.messages.length - 1]?.text || 'Sem mensagens'"></div>
                </div>

                <!-- BADGE NÃO LIDA (RACHI BLUE) -->
                <div x-show="c.unread > 0" class="shrink-0 pt-0.5">
                  <span class="w-5 h-5 rounded-full bg-[#0050f0] text-white text-[10px] font-bold flex items-center justify-center shadow-xs" x-text="c.unread"></span>
                </div>
              </div>
            </template>
            <!-- EMPTY STATE DO INBOX (PRINT 1) -->
            <div x-show="filteredConversations.length === 0" class="p-8 text-center text-slate-400 text-xs">
              <div class="w-10 h-10 rounded-2xl bg-blue-50 dark:bg-blue-950/40 text-[#0050f0] dark:text-[#38bdf8] flex items-center justify-center mx-auto mb-2">
                <i data-lucide="message-square" class="w-5 h-5"></i>
              </div>
              <div class="font-bold text-slate-700 dark:text-slate-200 text-xs">Fila limpa por aqui</div>
              <div class="text-[11px] text-slate-400 mt-1 max-w-[200px] mx-auto leading-relaxed">Novas conversas do site, WhatsApp e Portal aparecerão automaticamente aqui.</div>
            </div>
          </div>
        </div>

        <!-- COLUNA DIREITA: JANELA DO CHAT ATIVO OU EMPTY STATE OMNICHANNEL (PRINT 1) -->
        <div class="flex-1 flex flex-col min-w-0 bg-white dark:bg-[#0c1527]">
          
          <!-- ESTADO VAZIO: CENTRAL DE ATENDIMENTO OMNICHANNEL (QUANDO NENHUMA CONVERSA SELECIONADA - PRINT 1) -->
          <div x-show="!activeConversation" class="flex-1 flex flex-col items-center justify-center p-8 text-center bg-slate-50/40 dark:bg-[#071326]/40">
            <div class="w-14 h-14 rounded-2xl bg-[#0050f0] text-white flex items-center justify-center shadow-lg shadow-blue-500/20 mb-4">
              <i data-lucide="message-square" class="w-7 h-7"></i>
            </div>
            <h2 class="text-xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Central de Atendimento Omnichannel</h2>
            <p class="text-slate-500 dark:text-slate-400 text-xs max-w-md mt-1.5 leading-relaxed">
              Selecione uma conversa à esquerda para acompanhar em tempo real, assumir um pedido de atendimento humano ou responder direto ao cliente.
            </p>
            
            <!-- 3 CARDS EXPLICATIVOS DOS CANAIS (PRINT 1) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 mt-6 max-w-2xl w-full text-left">
              <div class="p-4 rounded-xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs hover:border-[#0050f0]/40 transition">
                <span class="text-[10px] font-bold text-[#0050f0] uppercase tracking-wider block">CANAL 01 - SITE</span>
                <div class="font-bold text-slate-900 dark:text-white text-xs mt-1">Chat ao Vivo</div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 leading-normal">Visitantes qualificados pela IA ou transferidos para humano.</p>
              </div>
              <div class="p-4 rounded-xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs hover:border-[#0050f0]/40 transition">
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider block">CANAL 02 - WHATSAPP</span>
                <div class="font-bold text-slate-900 dark:text-white text-xs mt-1">WhatsApp Oficial</div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 leading-normal">Mensagens sincronizadas com resposta manual ou IA.</p>
              </div>
              <div class="p-4 rounded-xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs hover:border-[#0050f0]/40 transition">
                <span class="text-[10px] font-bold text-amber-600 uppercase tracking-wider block">CANAL 03 - CLIENTES</span>
                <div class="font-bold text-slate-900 dark:text-white text-xs mt-1">Portal do Cliente</div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1 leading-normal">Chamados e dúvidas enviadas por clientes autenticados.</p>
              </div>
            </div>

            <div class="flex items-center gap-2.5 mt-6">
              <button @click="setPage('agente-ia')" type="button" class="bg-[#0050f0] hover:bg-[#0040d0] text-white font-bold px-4 py-2 rounded-xl text-xs flex items-center gap-2 shadow-xs transition cursor-pointer">
                <i data-lucide="zap" class="w-3.5 h-3.5 text-[#38bdf8]"></i>
                <span>Gerenciar Agente IA</span>
              </button>
              <a href="https://web.whatsapp.com" target="_blank" rel="noopener" class="bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 hover:bg-slate-100 text-slate-700 dark:text-slate-200 font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-2 transition">
                <i data-lucide="phone" class="w-3.5 h-3.5 text-emerald-500"></i>
                <span>Configurar WhatsApp</span>
              </a>
            </div>
          </div>

          <!-- JANELA DE CONVERSA ATIVA -->
          <div x-show="activeConversation" class="flex-1 flex flex-col min-w-0">
            <!-- CHAT HEADER COM IDENTIDADE RACHI -->
            <div class="p-4 sm:px-5 border-b border-slate-200/70 dark:border-white/5 flex items-center justify-between gap-3 bg-white/95 dark:bg-[#0c1527]/95 backdrop-blur-xs z-10 shrink-0">
              <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-full text-white font-bold text-xs flex items-center justify-center shadow-xs shrink-0" :class="activeConversation?.avatarBg" x-text="activeConversation?.avatar"></div>
                <div class="min-w-0">
                  <div class="flex items-center gap-2 flex-wrap">
                    <h3 class="text-sm font-bold text-slate-900 dark:text-white leading-tight truncate" x-text="activeConversation?.name"></h3>
                    
                    <!-- Badge Canal de Origem -->
                    <span x-show="activeConversation?.channel === 'whatsapp'" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 flex items-center gap-1">
                      <i data-lucide="phone" class="w-3 h-3"></i> WhatsApp
                    </span>
                    <span x-show="activeConversation?.channel === 'livechat'" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-[#0050f0] dark:bg-blue-950/40 dark:text-[#38bdf8] border border-blue-200 flex items-center gap-1">
                      <i data-lucide="globe" class="w-3 h-3"></i> Chat do Site
                    </span>
                    <span x-show="activeConversation?.channel === 'portal'" class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-300 flex items-center gap-1">
                      <i data-lucide="user-check" class="w-3 h-3"></i> Portal do Cliente
                    </span>

                    <!-- Badge Estado do Atendimento IA -->
                    <template x-if="activeConversation?.aiMode === 'waiting_human'">
                      <span class="px-2.5 py-0.5 rounded-full text-[10px] font-black bg-[#f5a800] text-slate-950 shadow-xs flex items-center gap-1 animate-pulse">
                        🚨 TRANSBORDO SOLICITADO
                      </span>
                    </template>
                    <template x-if="activeConversation?.aiMode === 'human_handling'">
                      <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-[#0050f0] text-white shadow-xs flex items-center gap-1">
                        👤 ATENDIMENTO HUMANO
                      </span>
                    </template>
                    <template x-if="activeConversation?.aiMode === 'ai_handling'">
                      <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8] border border-[#0050f0]/20 flex items-center gap-1">
                        🤖 IA CONVERSANDO
                      </span>
                    </template>
                  </div>

                  <div class="text-[11px] text-slate-500 mt-1 flex items-center gap-2 truncate">
                    <span class="font-semibold text-slate-700 dark:text-slate-300 truncate" x-text="activeConversation?.company"></span>
                    <span>•</span>
                    <span class="font-mono text-slate-500 dark:text-slate-400 text-[10.5px]" x-text="activeConversation?.phone"></span>
                    <template x-if="activeConversation?.handoffReason">
                      <span class="text-[#d97706] dark:text-[#fbbf24] font-medium truncate" x-text="'(' + activeConversation?.handoffReason + ')'"></span>
                    </template>
                  </div>
                </div>
              </div>

              <!-- AÇÕES DO CHAT & CONTROLO IA / HUMANO -->
              <div class="flex items-center gap-2 flex-wrap shrink-0">
                <!-- STATUS LIVE SYNC -->
                <span class="px-2.5 py-1 rounded-full text-[10.5px] font-bold bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8] border border-[#0050f0]/20 hidden xl:inline-flex items-center gap-1.5 shadow-2xs" title="Sincronização em tempo real ativa com o Website, WhatsApp e Portal">
                  <span class="w-2 h-2 rounded-full bg-[#0050f0] animate-ping"></span>
                  <span>Live Sync Ativo</span>
                </span>

                <!-- BOTÕES DE SIMULAÇÃO DE DEMONSTRAÇÃO AO VIVO -->
                <button @click="simulateLiveVisitor('livechat')" type="button" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200/70 text-slate-700 dark:bg-white/5 dark:hover:bg-white/10 dark:text-slate-200 border border-slate-200 dark:border-white/10 text-[11px] font-semibold transition flex items-center gap-1 shadow-2xs cursor-pointer" title="Simular visitante conversando no chat do site até pedir atendente humano">
                  <i data-lucide="play" class="w-3 h-3 text-[#0050f0]"></i>
                  <span class="hidden sm:inline">Simular Site</span>
                </button>
                <button @click="simulateLiveVisitor('whatsapp')" type="button" class="px-2.5 py-1.5 rounded-xl bg-slate-100 hover:bg-slate-200/70 text-slate-700 dark:bg-white/5 dark:hover:bg-white/10 dark:text-slate-200 border border-slate-200 dark:border-white/10 text-[11px] font-semibold transition flex items-center gap-1 shadow-2xs cursor-pointer" title="Simular lead no WhatsApp pedindo proposta executiva">
                  <i data-lucide="play" class="w-3 h-3 text-emerald-500"></i>
                  <span class="hidden sm:inline">Simular WhatsApp</span>
                </button>

                <!-- BOTÃO ASSUMIR ATENDIMENTO / DEVOLVER PARA A IA -->
                <template x-if="activeConversation?.aiMode === 'waiting_human' || activeConversation?.aiMode === 'ai_handling'">
                  <button @click="assumeChat(activeConversation)" type="button" class="px-3.5 py-1.5 rounded-xl bg-[#0050f0] hover:bg-[#0040d0] text-white text-xs font-black transition flex items-center gap-1.5 shadow-xs cursor-pointer" title="Pausar a IA e assumir o atendimento ao vivo">
                    <i data-lucide="user-check" class="w-3.5 h-3.5"></i>
                    <span>Assumir Atendimento</span>
                  </button>
                </template>
                <template x-if="activeConversation?.aiMode === 'human_handling'">
                  <button @click="releaseChatToAi(activeConversation)" type="button" class="px-3.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-xs cursor-pointer" title="Reativar respostas automáticas da IA">
                    <i data-lucide="bot" class="w-3.5 h-3.5 text-[#00a3e0]"></i>
                    <span>Devolver para IA</span>
                  </button>
                </template>

                <!-- GERAR TICKET -->
                <button @click="convertChatToTicket()" class="px-3 py-1.5 rounded-xl border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-200 text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer shadow-2xs" title="Transformar atendimento em Ticket">
                  <i data-lucide="ticket" class="w-3.5 h-3.5 text-[#0050f0]"></i>
                  <span class="hidden sm:inline">Ticket</span>
                </button>

                <!-- LINK WHATSAPP -->
                <a :href="'https://wa.me/' + (activeConversation?.phone ? activeConversation.phone.replace(/[^0-9]/g,'') : '')" target="_blank" rel="noopener" class="px-3 py-1.5 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white text-xs font-bold transition flex items-center gap-1.5 shadow-2xs" title="Abrir no WhatsApp Oficial">
                  <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                  <span class="hidden sm:inline">WhatsApp</span>
                </a>
              </div>
            </div>

            <!-- STREAM DE MENSAGENS -->
            <div id="chatMessagesScroll" class="flex-1 p-5 overflow-y-auto space-y-3.5 bg-slate-50/50 dark:bg-[#071326]/50">
              <!-- Evento de Conexão -->
              <div class="text-center my-2">
                <span class="px-3 py-1 rounded-full text-[10.5px] font-semibold bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400 border border-slate-200/80 dark:border-white/10 inline-flex items-center gap-1.5 shadow-2xs">
                  <i data-lucide="shield-check" class="w-3 h-3 text-[#0050f0]"></i>
                  Atendimento conectado via <strong class="text-slate-700 dark:text-slate-200" x-text="activeConversation?.channel === 'whatsapp' ? 'WhatsApp Oficial RACHI' : (activeConversation?.channel === 'portal' ? 'Portal do Cliente RACHI' : 'Chat ao Vivo do Site')"></strong>
                </span>
              </div>

              <template x-for="(m, idx) in (activeConversation ? activeConversation.messages : [])" :key="idx">
                <div>
                  <!-- MENSAGEM DO SISTEMA -->
                  <div x-show="m.sender === 'system'" class="text-center my-2">
                    <span class="px-3.5 py-1.5 rounded-full text-[10.5px] font-bold bg-amber-50 text-amber-900 dark:bg-amber-950/50 dark:text-amber-300 border border-amber-200/80 dark:border-amber-800/40 inline-flex items-center gap-1.5 shadow-2xs" x-text="m.text"></span>
                  </div>

                  <!-- MENSAGEM DO BOT / IA -->
                  <div x-show="m.sender === 'bot'" class="flex items-end gap-2 max-w-xl">
                    <div class="w-7 h-7 rounded-full bg-[#0050f0] text-white text-[10px] font-black flex items-center justify-center shrink-0 shadow-2xs">IA</div>
                    <div class="rounded-2xl rounded-bl-xs bg-white dark:bg-[#0c1527] border border-blue-100 dark:border-blue-900/40 p-3.5 shadow-xs text-xs text-slate-800 dark:text-slate-100 leading-relaxed">
                      <div class="flex items-center gap-1.5 text-[9.5px] font-bold text-[#0050f0] dark:text-[#38bdf8] uppercase tracking-wider mb-1">
                        <i data-lucide="bot" class="w-3.5 h-3.5"></i> Resposta Automática IA • RACHI Assist
                      </div>
                      <p x-text="m.text"></p>
                      <span class="block text-[9.5px] text-slate-400 dark:text-slate-500 text-right mt-1.5 font-medium" x-text="m.time"></span>
                    </div>
                  </div>

                  <!-- MENSAGEM DO CLIENTE -->
                  <div x-show="m.sender === 'customer'" class="flex items-end gap-2 max-w-xl">
                    <div class="w-7 h-7 rounded-full text-white text-[10px] font-bold flex items-center justify-center shrink-0 shadow-2xs" :class="activeConversation?.avatarBg" x-text="activeConversation?.avatar"></div>
                    <div class="rounded-2xl rounded-bl-xs bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 p-3.5 shadow-xs text-xs text-slate-800 dark:text-slate-100 leading-relaxed">
                      <p x-text="m.text"></p>
                      <span class="block text-[9.5px] text-slate-400 text-right mt-1.5 font-medium" x-text="m.time"></span>
                    </div>
                  </div>

                  <!-- MENSAGEM DO AGENTE HUMANO -->
                  <div x-show="m.sender === 'agent'" class="flex items-end justify-end gap-2 max-w-xl ml-auto">
                    <div class="rounded-2xl rounded-br-xs bg-gradient-to-r from-[#0050f0] to-[#003cb8] text-white p-3.5 shadow-xs text-xs leading-relaxed">
                      <div class="flex items-center gap-1 text-[9px] font-bold text-blue-100 uppercase tracking-wider mb-1">
                        <i data-lucide="user-check" class="w-3 h-3"></i> Consultor Casimiro Gundja • Direção RACHI
                      </div>
                      <p x-text="m.text"></p>
                      <div class="flex items-center justify-end gap-1 mt-1.5 text-[9.5px] text-blue-100">
                        <span x-text="m.time"></span>
                        <span>✓✓</span>
                      </div>
                    </div>
                  </div>
                </div>
              </template>
            </div>

            <!-- RESPOSTAS RÁPIDAS & INPUT BAR -->
            <div class="p-3.5 border-t border-slate-200/70 dark:border-white/5 bg-white dark:bg-[#0c1527] space-y-2.5 shrink-0">
              <!-- Pílulas de Resposta Rápida -->
              <div class="flex items-center gap-1.5 overflow-x-auto pb-1 text-[11px] scrollbar-none">
                <span class="text-slate-400 font-bold shrink-0 text-[10px] uppercase">Rápidas:</span>
                <button type="button" @click="sendQuickReply('Olá! Como podemos ajudar você hoje?')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#0050f0] dark:bg-white/5 dark:hover:bg-blue-950/40 dark:hover:text-[#38bdf8] text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-white/5 transition shrink-0 cursor-pointer">
                  👋 Olá! Como podemos ajudar?
                </button>
                <button type="button" @click="sendQuickReply('O seu orçamento foi formalizado e enviado por e-mail.')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#0050f0] dark:bg-white/5 dark:hover:bg-blue-950/40 dark:hover:text-[#38bdf8] text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-white/5 transition shrink-0 cursor-pointer">
                  📄 Orçamento enviado
                </button>
                <button type="button" @click="sendQuickReply('Nossa equipe técnica já está verificando sua solicitação.')" class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-blue-50 hover:text-[#0050f0] dark:bg-white/5 dark:hover:bg-blue-950/40 dark:hover:text-[#38bdf8] text-slate-600 dark:text-slate-300 border border-slate-200/60 dark:border-white/5 transition shrink-0 cursor-pointer">
                  ⚙️ Equipe técnica verificando
                </button>
              </div>

              <!-- Campo de Digitação e Botão de Envio -->
              <form @submit.prevent="sendChatMessage(false)" class="flex items-center gap-2">
                <input type="text" x-model="chatReplyText" :placeholder="'Responder ' + (activeConversation ? activeConversation.name : 'cliente') + ' via ' + (activeConversation?.channel === 'whatsapp' ? 'WhatsApp...' : 'Chat do Site...')" class="flex-1 px-4 py-2.5 text-xs bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl text-slate-900 dark:text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0] transition">
                <button type="submit" :disabled="!chatReplyText || !chatReplyText.trim()" class="px-4 py-2.5 rounded-xl bg-[#0050f0] hover:bg-[#0040d0] disabled:opacity-40 text-white text-xs font-bold flex items-center gap-1.5 shadow-2xs transition cursor-pointer" title="Registrar resposta no histórico">
                  <span>Enviar</span>
                  <i data-lucide="send" class="w-3.5 h-3.5"></i>
                </button>
                <button type="button" @click="sendChatMessage(true)" :disabled="!chatReplyText || !chatReplyText.trim()" class="px-3.5 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] disabled:opacity-40 text-white text-xs font-bold flex items-center gap-1.5 shadow-2xs transition cursor-pointer" title="Abrir conversa no WhatsApp com esta resposta preenchida">
                  <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                  <span class="hidden sm:inline">WhatsApp</span>
                </button>
              </form>
            </div>

          </div>

        </div>

      </div>
    </section>

    <!-- =====================================================================
         AGENTE IA (CRM): CENTRAL DE AUTOMAÇÃO, MOTOR LLM & QUALIFICAÇÃO (PRINT 2)
         ===================================================================== -->
    <section x-show="currentPage==='agente-ia'" x-cloak class="space-y-4">
      <!-- BARRA DE TELEMETRIA DO MOTOR LLM (PRINT 2) -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 rounded-2xl p-3 sm:px-5 shadow-xs">
        <div class="flex items-center gap-2.5 text-xs text-slate-600 dark:text-slate-300 flex-wrap">
          <span class="inline-flex items-center gap-1.5 font-bold text-slate-900 dark:text-white">
            <i data-lucide="cpu" class="w-4 h-4 text-[#0050f0]"></i>
            Motor ativo:
          </span>
          <span class="px-2 py-0.5 rounded-lg bg-blue-50 dark:bg-blue-950/40 text-[#0050f0] dark:text-[#38bdf8] font-bold border border-blue-200 dark:border-blue-900/40" x-text="aiAgent.model === 'gemini-2.5-flash' ? 'Google Gemini (gemini-2.5-flash)' : aiAgent.model"></span>
          <span>+ Fallback Cloudflare Workers AI</span>
          <span>•</span>
          <span class="flex items-center gap-1.5 font-medium">
            <span class="w-2 h-2 rounded-full" :class="aiAgent.globalPilot ? 'bg-emerald-500 animate-pulse' : 'bg-slate-400'"></span>
            Status global: <strong :class="aiAgent.globalPilot ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-500'" x-text="aiAgent.globalPilot ? 'Piloto Automático Ligado' : 'Piloto Automático Desligado'"></strong>
          </span>
        </div>
        <div>
          <button @click="setPage('messenger')" type="button" class="border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 text-slate-700 dark:text-slate-200 font-semibold px-3 py-1.5 rounded-xl text-xs flex items-center gap-1.5 shadow-2xs transition cursor-pointer">
            <i data-lucide="message-square" class="w-3.5 h-3.5 text-[#0050f0]"></i>
            <span>Abrir Central de Chat</span>
          </button>
        </div>
      </div>

      <!-- 4 KPIS DE INTELIGÊNCIA AUTÔNOMA (PRINT 2) -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5">
        <div class="rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-4 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">PILOTO AUTOMÁTICO</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8] border border-[#0050f0]/20 uppercase">IA ATIVA</span>
          </div>
          <div class="mt-2.5 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="aiAgent.globalPilot ? '1' : '0'"></span>
            <span class="text-[11px] text-emerald-600 font-semibold" x-show="aiAgent.globalPilot">Ativo 24/7</span>
          </div>
        </div>

        <div class="rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-4 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">EM QUALIFICAÇÃO</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-[#0050f0] dark:bg-blue-950/40 dark:text-[#38bdf8] border border-blue-200 uppercase">ESCOPO</span>
          </div>
          <div class="mt-2.5 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-[#0050f0] dark:text-[#38bdf8]" style="font-family:Outfit" x-text="aiAgent.stats.inQualification"></span>
            <span class="text-[11px] text-slate-400">Leads ativos</span>
          </div>
        </div>

        <div class="rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-4 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">PRÉ-ORÇAMENTOS IA</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200 uppercase">GERADOS</span>
          </div>
          <div class="mt-2.5 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="aiAgent.stats.autoQuotesGenerated"></span>
            <span class="text-[11px] text-slate-400">Em Kwanzas</span>
          </div>
        </div>

        <div class="rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-4 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">TRANSFERIDOS HUMANO</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200 uppercase">HANDOFF</span>
          </div>
          <div class="mt-2.5 flex items-baseline gap-2">
            <span class="text-2xl sm:text-3xl font-black text-[#f5a800]" style="font-family:Outfit" x-text="waitingHumanCount"></span>
            <span class="text-[11px] text-amber-600 font-semibold" x-show="waitingHumanCount > 0">Atenção</span>
          </div>
        </div>
      </div>

      <!-- CONTROLE GRANULAR POR CANAL (PRINT 2) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
        <!-- CANAL 1: CHAT DO SITE -->
        <div class="p-4 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs flex items-center justify-between gap-3">
          <div class="min-w-0">
            <div class="flex items-center gap-2">
              <span class="font-bold text-xs text-slate-900 dark:text-white truncate">Chat do Site - Leads</span>
              <span :class="aiAgent.channels.site.active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border-emerald-200' : 'bg-slate-100 text-slate-600 dark:bg-white/5 dark:text-slate-400 border-slate-200'" class="px-2 py-0.5 rounded-full text-[9px] font-bold border uppercase" x-text="aiAgent.channels.site.active ? 'IA ATIVA' : 'PAUSADO'"></span>
            </div>
            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">Captação e qualificação de leads no site</p>
          </div>
          <button @click="toggleChannel('site')" type="button" :class="aiAgent.channels.site.active ? 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300' : 'bg-[#0050f0] hover:bg-[#0040d0] text-white'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition shrink-0 cursor-pointer" x-text="aiAgent.channels.site.active ? 'Pausar' : 'Ativar'"></button>
        </div>

        <!-- CANAL 2: WHATSAPP ATENDIMENTO -->
        <div class="p-4 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs flex items-center justify-between gap-3">
          <div class="min-w-0">
            <div class="flex items-center gap-2">
              <span class="font-bold text-xs text-slate-900 dark:text-white truncate">WhatsApp 1 - Atendimento</span>
              <span :class="aiAgent.channels.whatsapp1.active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border-emerald-200' : 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border-amber-200'" class="px-2 py-0.5 rounded-full text-[9px] font-bold border uppercase" x-text="aiAgent.channels.whatsapp1.active ? 'IA ATIVA' : 'PAUSADO'"></span>
            </div>
            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">+244 923 000 000 (Linha Principal)</p>
          </div>
          <button @click="toggleChannel('whatsapp1')" type="button" :class="aiAgent.channels.whatsapp1.active ? 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300' : 'bg-[#0050f0] hover:bg-[#0040d0] text-white'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition shrink-0 cursor-pointer" x-text="aiAgent.channels.whatsapp1.active ? 'Pausar' : 'Ativar'"></button>
        </div>

        <!-- CANAL 3: WHATSAPP DIRETOR -->
        <div class="p-4 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 shadow-xs flex items-center justify-between gap-3">
          <div class="min-w-0">
            <div class="flex items-center gap-2">
              <span class="font-bold text-xs text-slate-900 dark:text-white truncate">WhatsApp 2 - Diretor</span>
              <span :class="aiAgent.channels.whatsapp2.active ? 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border-emerald-200' : 'bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border-amber-200'" class="px-2 py-0.5 rounded-full text-[9px] font-bold border uppercase" x-text="aiAgent.channels.whatsapp2.active ? 'IA ATIVA' : 'PAUSADO'"></span>
            </div>
            <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 truncate">+244 923 888 777 (VIP / Direção)</p>
          </div>
          <button @click="toggleChannel('whatsapp2')" type="button" :class="aiAgent.channels.whatsapp2.active ? 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300' : 'bg-[#0050f0] hover:bg-[#0040d0] text-white'" class="px-3 py-1.5 rounded-xl text-xs font-bold transition shrink-0 cursor-pointer" x-text="aiAgent.channels.whatsapp2.active ? 'Pausar' : 'Ativar'"></button>
        </div>
      </div>

      <!-- GRID INFERIOR (2 COLUNAS: PIPELINE DE QUALIFICAÇÃO + CONFIGURAÇÕES AGENTE IA) -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        
        <!-- COLUNA ESQUERDA: PIPELINE DE QUALIFICAÇÃO AUTÔNOMA (7 COLS) -->
        <div class="lg:col-span-7 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-5 shadow-xs flex flex-col justify-between">
          <div>
            <div class="flex items-center justify-between gap-2 pb-3 border-b border-slate-100 dark:border-white/5">
              <div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white leading-tight">Pipeline de Qualificação Autônoma</h3>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5">Visitantes do site e WhatsApp qualificados pela IA com pontuação e rascunho de proposta.</p>
              </div>
              <button @click="setPage('messenger')" type="button" class="text-xs font-bold text-[#0050f0] dark:text-[#38bdf8] hover:underline flex items-center gap-1 shrink-0">
                <span>Ver Inbox</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
              </button>
            </div>

            <!-- LISTA DE LEADS EM QUALIFICAÇÃO / PROPOSTA -->
            <div class="mt-4 space-y-3">
              <template x-for="lead in aiAgent.pipelineLeads" :key="lead.id">
                <div class="p-3.5 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/70 dark:border-white/5 hover:border-[#0050f0]/40 transition flex items-center justify-between gap-3">
                  <div class="min-w-0">
                    <div class="flex items-center gap-2">
                      <span class="font-bold text-xs text-slate-900 dark:text-white truncate" x-text="lead.name"></span>
                      <span class="px-2 py-0.2 rounded-full text-[9px] font-bold" :class="lead.channel === 'whatsapp' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-[#0050f0]'" x-text="lead.channel === 'whatsapp' ? 'WhatsApp' : 'Site'"></span>
                      <span class="px-2 py-0.2 rounded-full text-[9px] font-bold bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8]" x-text="'Score: ' + lead.score + '/100'"></span>
                    </div>
                    <div class="text-[11px] font-medium text-slate-600 dark:text-slate-300 mt-0.5 truncate" x-text="lead.scope"></div>
                    <div class="text-[10.5px] text-slate-400 mt-0.5" x-text="lead.company + ' • Estimativa: ' + lead.quoteEstimate"></div>
                  </div>
                  <button @click="setPage('messenger'); selectConversation(conversations.find(c => c.name.includes(lead.name.split(' ')[0])) || conversations[0])" class="px-3 py-1.5 rounded-xl bg-white dark:bg-slate-800 hover:bg-[#0050f0] hover:text-white text-[#0050f0] dark:text-[#38bdf8] border border-slate-200 dark:border-white/10 text-xs font-bold transition shrink-0 cursor-pointer shadow-2xs">
                    Atender
                  </button>
                </div>
              </template>
            </div>
          </div>

          <!-- 3 ETAPAS ILUSTRATIVAS DO PIPELINE (PRINT 2) -->
          <div class="pt-5 mt-4 border-t border-slate-100 dark:border-white/5">
            <div class="flex items-center justify-center gap-2 sm:gap-4 text-[11px] font-semibold text-slate-600 dark:text-slate-300 flex-wrap">
              <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200/60 dark:border-white/10 flex items-center gap-1.5">
                <span class="w-4 h-4 rounded-full bg-[#0050f0] text-white text-[9px] font-bold flex items-center justify-center">1</span>
                Captação 24/7
              </span>
              <span>&rarr;</span>
              <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200/60 dark:border-white/10 flex items-center gap-1.5">
                <span class="w-4 h-4 rounded-full bg-[#0050f0] text-white text-[9px] font-bold flex items-center justify-center">2</span>
                Score &amp; Escopo
              </span>
              <span>&rarr;</span>
              <span class="px-2.5 py-1 rounded-lg bg-slate-100 dark:bg-white/5 border border-slate-200/60 dark:border-white/10 flex items-center gap-1.5">
                <span class="w-4 h-4 rounded-full bg-[#f5a800] text-slate-950 text-[9px] font-bold flex items-center justify-center">3</span>
                Pré-Orçamento Kz
              </span>
            </div>

            <div class="flex items-center justify-center gap-2 mt-4">
              <button @click="setPage('messenger')" type="button" class="bg-[#0050f0] hover:bg-[#0040d0] text-white font-bold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 shadow-xs transition cursor-pointer">
                <i data-lucide="inbox" class="w-3.5 h-3.5"></i>
                <span>Abrir Inbox ao Vivo</span>
              </button>
              <button @click="simulateLiveVisitor('livechat')" type="button" class="border border-slate-200 dark:border-white/10 bg-slate-50 dark:bg-white/5 hover:bg-slate-100 text-slate-700 dark:text-slate-200 font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 transition cursor-pointer">
                <i data-lucide="play" class="w-3.5 h-3.5 text-[#0050f0]"></i>
                <span>Simular Lead</span>
              </button>
            </div>
          </div>
        </div>

        <!-- COLUNA DIREITA: CONFIGURAÇÕES DO AGENTE IA (5 COLS) -->
        <div class="lg:col-span-5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/80 dark:border-white/10 p-5 shadow-xs flex flex-col justify-between">
          <div class="space-y-4">
            <div class="flex items-center justify-between gap-2 pb-3 border-b border-slate-100 dark:border-white/5">
              <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-[#0050f0] text-white flex items-center justify-center shadow-xs">
                  <i data-lucide="zap" class="w-4 h-4"></i>
                </div>
                <div>
                  <h3 class="font-bold text-sm text-slate-900 dark:text-white leading-tight">Agente IA (RACHI Assist)</h3>
                  <p class="text-[10.5px] text-slate-500">Gemini + Workers AI (Site &amp; WhatsApp)</p>
                </div>
              </div>
              <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10.5px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                ONLINE
              </span>
            </div>

            <!-- TOGGLES PRINCIPAIS (SWITCHES) -->
            <div class="space-y-3">
              <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/5">
                <div>
                  <div class="text-xs font-bold text-slate-900 dark:text-white">Piloto Automático Global</div>
                  <div class="text-[10.5px] text-slate-500">Chave geral de respostas automáticas</div>
                </div>
                <button type="button" @click="aiAgent.globalPilot = !aiAgent.globalPilot" :class="aiAgent.globalPilot ? 'bg-[#0050f0]' : 'bg-slate-300 dark:bg-slate-700'" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                  <span :class="aiAgent.globalPilot ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"></span>
                </button>
              </div>

              <div class="flex items-center justify-between gap-3 p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/5">
                <div>
                  <div class="text-xs font-bold text-slate-900 dark:text-white">Auto-gerar Pré-Orçamento</div>
                  <div class="text-[10.5px] text-slate-500">Calcular estimativa em Kwanzas ao qualificar</div>
                </div>
                <button type="button" @click="aiAgent.autoQuote = !aiAgent.autoQuote" :class="aiAgent.autoQuote ? 'bg-[#0050f0]' : 'bg-slate-300 dark:bg-slate-700'" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                  <span :class="aiAgent.autoQuote ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"></span>
                </button>
              </div>
            </div>

            <!-- MOTOR LLM & CREDENCIAIS DE API -->
            <div class="p-3 rounded-xl bg-slate-50 dark:bg-white/[0.02] border border-slate-200/60 dark:border-white/5">
              <div class="flex items-center justify-between cursor-pointer" @click="aiAgent.showApiKeyInput = !aiAgent.showApiKeyInput">
                <div>
                  <div class="text-xs font-bold text-slate-900 dark:text-white">Motor LLM &amp; Credenciais de API</div>
                  <div class="text-[10.5px] text-slate-500">Google Gemini 2.5 Flash • Usando Edge/Padrão</div>
                </div>
                <span class="text-[10.5px] font-bold text-[#0050f0] dark:text-[#38bdf8]" x-text="aiAgent.showApiKeyInput ? 'RECOLHER &uarr;' : 'EXPANDIR &darr;'"></span>
              </div>
              <div x-show="aiAgent.showApiKeyInput" x-transition class="mt-3 pt-3 border-t border-slate-200/60 dark:border-white/5 space-y-2">
                <label class="block text-[10.5px] font-bold text-slate-600 dark:text-slate-400">Chave de API Gemini (Opcional se usar Edge Worker)</label>
                <input type="password" x-model="aiAgent.apiKey" placeholder="AIzaSy... (Deixe em branco para usar Cloudflare Binding)" class="w-full px-3 py-2 text-xs bg-white dark:bg-slate-800 border border-slate-200 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0]">
              </div>
            </div>

            <!-- EDITOR DE DIRETRIZES COMERCIAIS & TOM DE VOZ -->
            <div>
              <label class="block text-[10.5px] font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">
                Diretrizes Comerciais &amp; Tom de Voz (Prompt da RACHI)
              </label>
              <textarea x-model="aiAgent.systemPrompt" rows="5" class="w-full p-3 text-xs bg-slate-50 dark:bg-white/[0.02] border border-slate-200 dark:border-white/10 rounded-xl text-slate-900 dark:text-white font-mono leading-relaxed focus:outline-none focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0]"></textarea>
            </div>
          </div>

          <!-- BOTÕES DE AÇÃO DO AGENTE IA -->
          <div class="pt-4 mt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between gap-2">
            <button @click="saveAiAgentSettings()" type="button" class="flex-1 bg-[#f5a800] hover:bg-[#df8b13] text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs flex items-center justify-center gap-1.5 shadow-xs transition cursor-pointer">
              <i data-lucide="check" class="w-3.5 h-3.5"></i>
              <span>Salvar Diretrizes</span>
            </button>
            <button @click="aiAgent.testPromptModal = true" type="button" class="border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-800 hover:bg-slate-100 text-slate-700 dark:text-slate-200 font-bold px-3.5 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition cursor-pointer shadow-2xs">
              <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#0050f0]"></i>
              <span>Testar IA</span>
            </button>
          </div>
        </div>

      </div>

      <!-- MODAL DE TESTE INTERATIVO DA IA (SIMULADOR DE DIRETRIZES) -->
      <div x-show="aiAgent.testPromptModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div @click.away="aiAgent.testPromptModal = false" class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-2xl max-w-lg w-full p-5 shadow-2xl space-y-4">
          <div class="flex items-center justify-between pb-3 border-b border-slate-100 dark:border-white/5">
            <div class="flex items-center gap-2">
              <div class="w-8 h-8 rounded-xl bg-[#0050f0] text-white flex items-center justify-center shadow-xs">
                <i data-lucide="sparkles" class="w-4 h-4"></i>
              </div>
              <div>
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Simulador de Atendimento IA</h3>
                <p class="text-[11px] text-slate-500">Teste o tom de voz e as respostas comerciais da RACHI</p>
              </div>
            </div>
            <button @click="aiAgent.testPromptModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-white p-1 rounded-lg">
              <i data-lucide="x" class="w-4 h-4"></i>
            </button>
          </div>

          <div class="space-y-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">Simular Pergunta do Cliente / Lead:</label>
              <div class="flex gap-2">
                <input type="text" x-model="aiAgent.testQuestion" @keydown.enter.prevent="runAiAgentTest()" placeholder="Ex: Quanto custa criar uma loja virtual com Multicaixa Express?" class="flex-1 px-3 py-2 text-xs bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0]">
                <button @click="runAiAgentTest()" :disabled="aiAgent.testLoading || !aiAgent.testQuestion.trim()" class="px-3.5 py-2 rounded-xl bg-[#0050f0] hover:bg-[#0040d0] text-white text-xs font-bold flex items-center gap-1 disabled:opacity-40 transition cursor-pointer">
                  <span x-text="aiAgent.testLoading ? 'Pensando...' : 'Enviar'"></span>
                  <i data-lucide="send" class="w-3.5 h-3.5"></i>
                </button>
              </div>
            </div>

            <div x-show="aiAgent.testAnswer" class="p-3.5 rounded-xl bg-blue-50/60 dark:bg-blue-950/20 border border-blue-200/80 dark:border-blue-800/40 text-xs text-slate-800 dark:text-slate-100 leading-relaxed space-y-1">
              <div class="text-[9.5px] font-bold text-[#0050f0] dark:text-[#38bdf8] uppercase flex items-center gap-1">
                <i data-lucide="bot" class="w-3 h-3"></i> Resposta do Agente IA (RACHI Assist)
              </div>
              <p x-text="aiAgent.testAnswer"></p>
            </div>
          </div>

          <div class="pt-3 border-t border-slate-100 dark:border-white/5 flex justify-end">
            <button @click="aiAgent.testPromptModal = false" type="button" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 text-slate-700 dark:text-slate-200 text-xs font-bold transition cursor-pointer">
              Fechar
            </button>
          </div>
        </div>
      </div>
    </section>


        <!-- PERFIS / EQUIPE, COLABORADORES & USUÁRIOS (MODELO DO PRINT 4) -->
    <section x-show="currentPage==='usuarios'" x-cloak class="space-y-6">
      <!-- HEADER -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Equipe, Colaboradores & Usuários</h1>
          <p class="text-slate-500 text-sm mt-0.5">Gestão centralizada de permissões, acessos administrativos e contas de clientes.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="openCreateUserModal()" 
                  type="button"
                  class="bg-[#ffa525] hover:bg-[#dd8f20] text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Novo Usuário</span>
          </button>
        </div>
      </div>

            <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: SUPER ADMIN -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">SUPER ADMIN</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200/80 dark:border-amber-800/40 uppercase">NÍVEL MÁXIMO</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStatsPrint4.superAdmins">2</span>
          </div>
        </div>

        <!-- Card 2: ADMINISTRADORES -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">ADMINISTRADORES</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200/80 dark:border-blue-800/40 uppercase">ADMIN</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStatsPrint4.admins">2</span>
          </div>
        </div>

        <!-- Card 3: EQUIPE OPERACIONAL -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">EQUIPE OPERACIONAL</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-50 text-purple-700 dark:bg-purple-950/40 dark:text-purple-400 border border-purple-200/80 dark:border-purple-800/40 uppercase">OPERACIONAL</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStatsPrint4.staff">1</span>
          </div>
        </div>

        <!-- Card 4: CLIENTES NO PORTAL -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">CLIENTES NO PORTAL</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 dark:bg-white/10 dark:text-slate-300 border border-slate-200/80 dark:border-white/10 uppercase">CLIENTE</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="userStatsPrint4.clients">5</span>
          </div>
        </div>
      </div>

      <!-- CARD CONTAINER COM FILTROS E TABELA -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <!-- TOP FILTER BAR -->
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <!-- PILL TABS -->
          <div class="flex items-center gap-1.5 flex-wrap">
            <button @click="userTab = 'todos'" 
                    type="button"
                    :class="userTab === 'todos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Todos (<span x-text="users.length"></span>)
            </button>
            <button @click="userTab = 'equipe'" 
                    type="button"
                    :class="userTab === 'equipe' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Equipe (<span x-text="userStatsPrint4.superAdmins + userStatsPrint4.admins + userStatsPrint4.staff"></span>)
            </button>
            <button @click="userTab = 'clientes'" 
                    type="button"
                    :class="userTab === 'clientes' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Clientes (<span x-text="userStatsPrint4.clients"></span>)
            </button>
            <button @click="userTab = 'inativos'" 
                    type="button"
                    :class="userTab === 'inativos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Inativos (<span x-text="userStatsPrint4.inativos"></span>)
            </button>
          </div>

          <!-- SEARCH & SELECT -->
          <div class="flex flex-col sm:flex-row items-center gap-2.5">
            <div class="relative w-full sm:w-64">
              <input type="text" x-model="userSearch" placeholder="Buscar por nome, email ou empresa..."
                     class="w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-hidden focus:border-[#ffa525]">
            </div>
            <select x-model="userFilterRole" class="w-full sm:w-auto px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 focus:outline-hidden focus:border-[#ffa525]">
              <option value="all">Todos os papéis</option>
              <option value="super_admin">Super Admin</option>
              <option value="admin">Administrador</option>
              <option value="employee">Equipe Operacional</option>
              <option value="customer">Cliente</option>
            </select>
            <button type="button" class="w-full sm:w-auto px-4 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-bold transition hover:opacity-90">Filtrar</button>
          </div>
        </div>

        <!-- TABELA -->
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="border-b border-slate-100 dark:border-white/5 text-[10px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
                <th class="py-3 px-4 sm:px-6">Usuário</th>
                <th class="py-3 px-4">Papel / Função</th>
                <th class="py-3 px-4">Contato / Empresa</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4">Cadastro</th>
                <th class="py-3 px-4 sm:px-6 text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="u in filteredUsersPrint4" :key="u.id">
                <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                  <!-- USUÁRIO -->
                  <td class="py-3.5 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 font-bold flex items-center justify-center text-xs shrink-0 shadow-xs" x-text="u.ini || (u.nome ? u.nome.substring(0,2).toUpperCase() : 'US')"></div>
                      <div class="min-w-0">
                        <div class="font-bold text-slate-900 dark:text-white text-xs truncate" x-text="u.nome"></div>
                        <div class="text-[11px] text-slate-400 truncate" x-text="u.email"></div>
                      </div>
                    </div>
                  </td>

                  <!-- PAPEL / FUNÇÃO -->
                  <td class="py-3.5 px-4">
                    <template x-if="u.role_slug === 'super_admin' || (u.tipo && u.tipo.includes('Master')) || u.id === 1 || u.id === 21">
                      <span class="text-xs font-black text-[#dd8f20] dark:text-[#ffa525] uppercase tracking-wider">SUPER ADMIN</span>
                    </template>
                    <template x-if="u.role_slug === 'admin' || (u.tipo && u.tipo === 'Administrador' && u.id !== 1 && u.id !== 21)">
                      <span class="text-xs font-bold text-slate-800 dark:text-slate-200 uppercase">ADMINISTRADOR</span>
                    </template>
                    <template x-if="['employee', 'instructor', 'rh_specialist', 'attendant'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Funcionário') || u.tipo.includes('Instrutor') || u.tipo.includes('Especialista') || u.tipo.includes('Operacional')))">
                      <span class="text-xs font-semibold text-slate-700 dark:text-slate-300 uppercase">EQUIPE OPERACIONAL</span>
                    </template>
                    <template x-if="['customer', 'student'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Cliente') || u.tipo.includes('Aluno')))">
                      <span class="text-xs font-medium text-slate-500 uppercase">CLIENTE</span>
                    </template>
                  </td>

                  <!-- CONTATO / EMPRESA -->
                  <td class="py-3.5 px-4">
                    <div class="font-medium text-slate-700 dark:text-slate-300 text-xs" x-text="u.empresa || u.contato || u.phone || u.telefone || '—'"></div>
                  </td>

                  <!-- STATUS -->
                  <td class="py-3.5 px-4">
                    <span class="text-xs font-bold uppercase tracking-wider" 
                          :class="u.status === 'Ativo' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400'"
                          x-text="u.status"></span>
                  </td>

                  <!-- CADASTRO -->
                  <td class="py-3.5 px-4 text-slate-500 text-xs" x-text="u.created_at || u.data || '20/11/2026'"></td>

                  <!-- AÇÕES -->
                  <td class="py-3.5 px-4 sm:px-6 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                      <template x-if="u.id === 1 || u.email === 'admin@rachi.ao'">
                        <span class="px-3 py-1.5 rounded-lg bg-slate-100 dark:bg-white/10 text-xs font-semibold text-slate-500 dark:text-slate-400">Minha Conta</span>
                      </template>
                      <template x-if="u.id !== 1 && u.email !== 'admin@rachi.ao'">
                        <div class="flex items-center gap-1">
                          <button @click="openEditUserModal(u)" 
                                  type="button"
                                  class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 flex items-center gap-1 transition cursor-pointer">
                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                            <span>Editar</span>
                          </button>
                          <button @click="openResetPasswordModal(u)" 
                                  type="button"
                                  class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 flex items-center gap-1 transition cursor-pointer">
                            <i data-lucide="key" class="w-3.5 h-3.5"></i>
                            <span>Acesso</span>
                          </button>
                          <button @click="toggleUserStatus(u)" 
                                  type="button"
                                  class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 transition cursor-pointer"
                                  x-text="u.status === 'Ativo' ? 'Desativar' : 'Ativar'">
                          </button>
                          <button @click="confirmDeleteUser(u)" 
                                  type="button"
                                  class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                                  title="Remover Usuário">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                          </button>
                        </div>
                      </template>
                    </div>
                  </td>
                </tr>
              </template>
              <tr x-show="filteredUsersPrint4.length === 0">
                <td colspan="6" class="text-center py-10 text-slate-400 text-xs italic">
                  Nenhum usuário encontrado com os filtros selecionados.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- CLIENTES (MODELO ADAPTADO DO PRINT 1 PARA RACHI) -->
    <section x-show="currentPage==='clientes'" x-cloak class="space-y-6">
      <!-- Cabeçalho Principal (Print 1) -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white tracking-tight" style="font-family:Outfit">Diretório de Clientes & Leads</h1>
          <p class="text-slate-500 dark:text-slate-400 text-sm mt-0.5">Gestão centralizada de Clientes Ativos, Leads do Site e Contatos RACHI.</p>
        </div>
        <button @click="openCreateUserModalWithRole('customer')" 
                class="px-4 py-2.5 rounded-xl font-bold text-xs text-slate-950 bg-[#ffa525] hover:bg-[#dd8f20] shadow-sm flex items-center gap-2 transition cursor-pointer self-start sm:self-auto">
          <i data-lucide="plus" class="w-4 h-4"></i>
          <span>Novo Cliente</span>
        </button>
      </div>

            <!-- CARDS KPI DE RESUMO (MODELO PRINT 1) -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Card 1: TOTAL GERAL -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">TOTAL GERAL</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 dark:bg-white/10 dark:text-slate-300 border border-slate-200/80 dark:border-white/10 uppercase">TODOS</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="clientStats.total">9</span>
          </div>
        </div>

        <!-- Card 2: CLIENTES ATIVOS -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">CLIENTES ATIVOS</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200/80 dark:border-emerald-800/40 uppercase">ATIVO</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="clientStats.ativos">9</span>
          </div>
        </div>

        <!-- Card 3: CONTAS EMPRESA -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">CONTAS EMPRESA</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200/80 dark:border-blue-800/40 uppercase">EMPRESA</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="clientStats.empresas">8</span>
          </div>
        </div>

        <!-- Card 4: LEADS / PARTICULARES -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">LEADS / PARTICULARES</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200/80 dark:border-amber-800/40 uppercase">LEAD</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="clientStats.leads">1</span>
          </div>
        </div>
      </div>

      <!-- TABELA DE CLIENTES NOVO MODELO (PRINT 1) -->
      <div class="sc2 p-0 overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs">
        <!-- Barra de Filtros e Pesquisa -->
        <div class="p-4 border-b border-slate-200/80 dark:border-white/5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
          <!-- Abas de Filtros Tipo Pílula -->
          <div class="flex items-center gap-1.5 flex-wrap">
            <button @click="clientFilterTab='todos'; $nextTick(() => { if (window.lucide) lucide.createIcons(); });" 
                    :class="clientFilterTab==='todos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-2xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-400 font-semibold'" 
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Todos (<span x-text="clientStats.total"></span>)
            </button>
            <button @click="clientFilterTab='ativos'; $nextTick(() => { if (window.lucide) lucide.createIcons(); });" 
                    :class="clientFilterTab==='ativos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-2xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-400 font-semibold'" 
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Ativos (<span x-text="clientStats.ativos"></span>)
            </button>
            <button @click="clientFilterTab='empresas'; $nextTick(() => { if (window.lucide) lucide.createIcons(); });" 
                    :class="clientFilterTab==='empresas' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-2xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-400 font-semibold'" 
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Empresas (<span x-text="clientStats.empresas"></span>)
            </button>
            <button @click="clientFilterTab='leads'; $nextTick(() => { if (window.lucide) lucide.createIcons(); });" 
                    :class="clientFilterTab==='leads' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-2xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-400 font-semibold'" 
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Leads / Particulares (<span x-text="clientStats.leads"></span>)
            </button>
          </div>

          <!-- Campo de Busca -->
          <div class="relative w-full sm:w-80">
            <input type="text" x-model="clientSearch" placeholder="Filtrar por nome, empresa, e-mail..." 
                   class="w-full pl-9 pr-3 py-1.5 rounded-xl border border-slate-200 dark:border-white/10 bg-slate-50/50 dark:bg-white/5 text-xs text-slate-900 dark:text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#ffa525]/30 focus:border-[#ffa525] transition">
            <i data-lucide="search" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></i>
          </div>
        </div>

        <div class="overflow-x-auto min-h-[340px]">
          <table class="w-full text-left border-collapse text-xs">
            <thead>
              <tr class="border-b border-slate-200/80 dark:border-white/5 text-[11px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 bg-slate-50/60 dark:bg-white/[0.02]">
                <th class="py-3.5 px-4 font-bold">Empresa / Contato</th>
                <th class="py-3.5 px-4 font-bold">Canal / E-mail</th>
                <th class="py-3.5 px-4 font-bold">Telefone</th>
                <th class="py-3.5 px-4 font-bold">Categoria</th>
                <th class="py-3.5 px-4 font-bold">Portal</th>
                <th class="py-3.5 px-4 font-bold text-center">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="c in filteredClients" :key="c.id">
                <tr class="hover:bg-slate-50/70 dark:hover:bg-white/[0.02] transition">
                  <!-- EMPRESA / CONTATO -->
                  <td class="py-3 px-4">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 rounded-xl bg-slate-900 text-white dark:bg-white/10 dark:text-white font-black text-xs flex items-center justify-center shrink-0 border border-slate-800 dark:border-white/10 shadow-2xs" x-text="getClientInitials(c)"></div>
                      <div class="min-w-0">
                        <div class="font-bold text-slate-900 dark:text-white text-xs truncate max-w-[220px]" x-text="c.nome"></div>
                        <div class="text-[11px] text-slate-400 flex items-center gap-1 mt-0.5 truncate max-w-[220px]">
                          <span>Contato:</span>
                          <span class="text-slate-500 dark:text-slate-400 font-medium" x-text="c.contato || (c.tipo === 'Empresa' ? 'Diretoria / Responsável' : 'Particular')"></span>
                        </div>
                      </div>
                    </div>
                  </td>

                  <!-- CANAL / E-MAIL -->
                  <td class="py-3 px-4">
                    <span class="font-mono text-xs text-slate-600 dark:text-slate-300 font-medium" x-text="c.email || '—'"></span>
                  </td>

                  <!-- TELEFONE -->
                  <td class="py-3 px-4">
                    <span class="font-mono text-xs font-semibold text-slate-700 dark:text-slate-300" x-text="c.tel || '—'"></span>
                  </td>

                  <!-- CATEGORIA -->
                  <td class="py-3 px-4">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider" 
                          :class="c.categoria === 'LEAD' ? 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200/60 dark:border-amber-500/20' : 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200/60 dark:border-emerald-500/20'" 
                          x-text="c.categoria || 'ATIVO'"></span>
                  </td>

                  <!-- PORTAL & ORDENS RACHI -->
                  <td class="py-3 px-4">
                    <div class="text-xs">
                      <span class="inline-flex items-center gap-1.5 font-bold text-blue-600 dark:text-blue-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                        <span x-text="c.portal || 'Portal Ativo'"></span>
                      </span>
                      <div class="text-[11px] text-slate-400 mt-0.5">
                        <span class="font-semibold text-slate-600 dark:text-slate-300" x-text="c.tr + (c.tr === 1 ? ' pedido' : ' pedidos')"></span>
                        <span class="text-slate-300 dark:text-slate-600">•</span>
                        <span x-text="'Desde ' + (c.desde || 'Oct/2026')"></span>
                      </div>
                    </div>
                  </td>

                  <!-- AÇÕES (PRINT 1) -->
                  <td class="py-3 px-4 text-center">
                    <div class="flex items-center justify-center gap-1.5 flex-nowrap">
                      <!-- Enviar Acesso -->
                      <button @click="openSendAccessModal(c)" 
                              type="button"
                              class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-slate-700 dark:text-slate-200 text-xs font-semibold transition cursor-pointer shadow-2xs whitespace-nowrap" 
                              title="Enviar Acesso ao Portal">
                        <i data-lucide="key" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span class="hidden xl:inline">Enviar Acesso</span>
                      </button>

                      <!-- Mover p/ Lead ou Ativo -->
                      <button @click="toggleClientCategory(c)" 
                              type="button"
                              class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-slate-600 dark:text-slate-300 text-xs font-semibold transition cursor-pointer shadow-2xs whitespace-nowrap" 
                              :title="c.categoria === 'LEAD' ? 'Mover para Cliente Ativo' : 'Mover para Lead'">
                        <span x-text="c.categoria === 'LEAD' ? 'Mover p/ Ativo' : 'Mover p/ Lead'"></span>
                      </button>

                      <!-- Editar -->
                      <button @click="openEditClientModal(c)" 
                              type="button"
                              class="inline-flex items-center gap-1 px-2 py-1 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-700 dark:text-slate-200 hover:text-blue-600 transition cursor-pointer shadow-2xs whitespace-nowrap" 
                              title="Editar Informações">
                        <i data-lucide="pencil" class="w-3.5 h-3.5 text-slate-500"></i>
                        <span class="hidden xl:inline">Editar</span>
                      </button>

                      <!-- Eliminar -->
                      <button @click="deleteClient(c)" 
                              type="button"
                              class="p-1.5 rounded-lg border border-rose-200 dark:border-rose-500/20 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-rose-500 transition cursor-pointer shadow-2xs" 
                              title="Eliminar Cliente">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>

              <tr x-show="filteredClients.length === 0">
                <td colspan="6" class="text-center py-12">
                  <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i data-lucide="users" class="w-6 h-6"></i>
                  </div>
                  <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum cliente encontrado</h4>
                  <p class="text-xs text-slate-500 mt-1">Tente ajustar a sua pesquisa ou a aba de filtro selecionada.</p>
                </td>
              </tr>
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
                <span class="text-xs text-slate-500 font-semibold" x-text="selectedRequest.servico + ' —¢ ' + selectedRequest.data"></span>
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
                <button class="bap w-full justify-center text-xs">Guardar Nota Interna</button>
              </div>
            </div>
          </div>
        </div>
      </template>

            <template x-if="!selectedRequest">
        <div class="space-y-6">
          <!-- HEADER -->
          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
              <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão de Solicitações & Pipeline de Entrada</h1>
              <p class="text-slate-500 text-sm mt-0.5">Analise briefings de clientes, qualifique leads, converta em projetos e gere orçamentos formais.</p>
            </div>
            <div class="flex items-center gap-2">
              <button @click="setPage('grafica-orcamentos')" 
                      type="button"
                      class="border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-bold px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-200 cursor-pointer transition shadow-xs">
                Ver Orçamentos
              </button>
            </div>
          </div>

                    <!-- 4 KPIS -->
          <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Total no Pipeline -->
            <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">TOTAL NO PIPELINE</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 dark:bg-white/10 dark:text-slate-300 border border-slate-200/80 dark:border-white/10 uppercase">TOTAL</span>
              </div>
              <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="pipelineStats.total">4</span>
              </div>
            </div>

            <!-- Card 2: Novas / Pendentes -->
            <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">NOVAS / PENDENTES</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 dark:bg-amber-950/40 dark:text-amber-400 border border-amber-200/80 dark:border-amber-800/40 uppercase">TRIAGEM</span>
              </div>
              <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-amber-500" style="font-family:Outfit" x-text="pipelineStats.novas">0</span>
              </div>
            </div>

            <!-- Card 3: Em Análise / Proposta -->
            <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">EM ANÁLISE / PROPOSTA</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200/80 dark:border-blue-800/40 uppercase">ANÁLISE</span>
              </div>
              <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit" x-text="pipelineStats.analise">0</span>
              </div>
            </div>

            <!-- Card 4: Aprovadas / Concluídas -->
            <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
              <div class="flex items-center justify-between gap-2">
                <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">APROVADAS / CONCLUÍDAS</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-950/40 dark:text-emerald-400 border border-emerald-200/80 dark:border-emerald-800/40 uppercase">APROVADO</span>
              </div>
              <div class="mt-3">
                <span class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="pipelineStats.concluidas">1</span>
              </div>
            </div>
          </div>

          <!-- CARD CONTAINER COM FILTROS E TABELA -->
          <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
            <!-- TOP FILTER BAR -->
            <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center gap-3">
              <div class="relative flex-1 w-full">
                <input type="text" x-model="reqFilterSearch" placeholder="Buscar por protocolo, título ou cliente..."
                       class="w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-hidden focus:border-[#ffa525]">
              </div>
              <select x-model="reqFilterStatus" class="w-full sm:w-auto px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 focus:outline-hidden focus:border-[#ffa525]">
                <option value="Todos">Todos os status</option>
                <option value="Nova">Nova / Pendente</option>
                <option value="Em Análise">Em Análise</option>
                <option value="Em Execução">Em Execução</option>
                <option value="Concluído">Concluída</option>
                <option value="Cancelado">Cancelada</option>
              </select>
              <button type="button" class="w-full sm:w-auto px-4 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-bold transition hover:opacity-90">Filtrar</button>
            </div>

            <!-- TABELA -->
            <div class="overflow-x-auto">
              <table class="w-full text-left text-xs">
                <thead>
                  <tr class="border-b border-slate-100 dark:border-white/5 text-[10px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
                    <th class="py-3 px-4 sm:px-6">Protocolo</th>
                    <th class="py-3 px-4">Demanda / Título</th>
                    <th class="py-3 px-4">Cliente / Contato</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 sm:px-6 text-right">Ações</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-white/5">
                  <template x-for="req in filteredRequests" :key="req.id">
                    <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                      <!-- PROTOCOLO -->
                      <td class="py-3.5 px-4 sm:px-6">
                        <span class="font-mono font-bold text-xs text-[#dd8f20] dark:text-[#ffa525]" x-text="req.protocol || ('GNDJ-20261123-' + req.id)"></span>
                      </td>

                      <!-- DEMANDA / TÍTULO -->
                      <td class="py-3.5 px-4">
                        <div class="font-bold text-slate-900 dark:text-white text-xs max-w-sm truncate" x-text="req.titulo || req.title"></div>
                      </td>

                      <!-- CLIENTE / CONTATO -->
                      <td class="py-3.5 px-4">
                        <div class="font-bold text-slate-900 dark:text-white text-xs" x-text="req.cliente"></div>
                        <div class="text-[11px] text-slate-400 truncate" x-text="req.empresa || req.email || '—'"></div>
                      </td>

                      <!-- STATUS -->
                      <td class="py-3.5 px-4">
                        <span class="text-xs font-black uppercase tracking-wider" 
                              :class="req.status === 'Concluído' || req.status === 'Concluída' ? 'text-emerald-600 dark:text-emerald-400' : (req.status === 'Em Execução' ? 'text-blue-600 dark:text-blue-400' : 'text-slate-800 dark:text-slate-200')" 
                              x-text="req.status.toUpperCase()"></span>
                      </td>

                      <!-- AÇÕES -->
                      <td class="py-3.5 px-4 sm:px-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                          <button @click="openReq(req)" 
                                  type="button"
                                  class="px-3 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5 transition cursor-pointer">
                            <span>Gerenciar</span>
                            <span class="text-xs">&rarr;</span>
                          </button>
                          <button @click="confirmDeleteReq(req)" 
                                  type="button"
                                  class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                                  title="Remover solicitação">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </template>
                  <tr x-show="filteredRequests.length === 0">
                    <td colspan="5" class="text-center py-10 text-slate-400 text-xs italic">
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
        <button type="button" @click="openCreateCourseModal()" class="bap cursor-pointer"><i data-lucide="plus" class="w-4 h-4"></i> Criar Novo Curso</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="coursesList.length || 12"></div><div class="text-xs text-slate-500 mt-1 font-bold">Cursos no Catálogo</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="activeEnrollmentsCount || 48"></div><div class="text-xs text-slate-500 mt-1 font-bold">Turmas Ativas</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit" x-text="academyEnrollments.length || 48"></div><div class="text-xs text-slate-500 mt-1 font-bold">Matrículas Totais</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">38</div><div class="text-xs text-slate-500 mt-1 font-bold">Diplomas Emitidos</div></div>
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
        <button type="button" @click="openCreateProductModal()" class="bap cursor-pointer"><i data-lucide="plus" class="w-4 h-4"></i> Adicionar Produto</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">24</div><div class="text-xs text-slate-500 mt-1 font-bold">Total Produtos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">15</div><div class="text-xs text-slate-500 mt-1 font-bold">Vendas do Mês</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">3</div><div class="text-xs text-slate-500 mt-1 font-bold">Stock Crítico</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">2,10M</div><div class="text-xs text-slate-500 mt-1 font-bold">Receita (AOA)</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Item</th><th>SKU</th><th>Categoria</th><th>Valor Unitário</th><th>Stock</th><th>Saídas</th><th>Status</th></tr></thead>
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

    <section x-show="currentPage==='rh-solicitacoes'" x-cloak class="space-y-6">
      <div class="flex items-center justify-between gap-3">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Human Capital — Solicitações & Consultoria</h1>
          <p class="text-sm text-slate-500 mt-1">Pedidos enviados pela página Human Capital e pelas suas páginas de serviços.</p>
        </div>
        <button type="button" @click="refreshAdminRequests(true)" class="bap text-xs">Atualizar</button>
      </div>
      <div class="kc"><span class="text-3xl font-black text-slate-900 dark:text-white" x-text="capitalRequests.length"></span><span class="text-sm text-slate-500 ml-3">Solicitações Recebidas</span></div>
      <div class="sc2 p-0 overflow-hidden"><div class="overflow-x-auto"><table class="at">
        <thead><tr><th>Protocolo</th><th>Cliente / Empresa</th><th>Serviço</th><th>Data</th><th>Estado</th><th>Atendimento</th></tr></thead>
        <tbody>
          <template x-for="r in capitalRequests" :key="r.id"><tr>
            <td class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400" x-text="r.protocol"></td>
            <td><div class="font-bold text-slate-900 dark:text-white" x-text="r.cliente"></div><div class="text-xs text-slate-500" x-text="r.empresa"></div></td>
            <td class="text-sm text-slate-700 dark:text-slate-300" x-text="r.titulo"></td>
            <td class="text-xs text-slate-500" x-text="r.data || r.created_at"></td>
            <td><span class="badge2" :class="r.sc" x-text="r.statusLabel || r.status"></span></td>
            <td><button type="button" @click="openReq(r)" class="bap text-xs">Ver solicitação</button></td>
          </tr></template>
          <tr x-show="capitalRequests.length === 0"><td colspan="6" class="text-center py-10 text-sm text-slate-500">Nenhuma solicitação Human Capital recebida.</td></tr>
        </tbody>
      </table></div></div>
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
        <button type="button" @click="openCreateJobModal()" class="bap cursor-pointer"><i data-lucide="plus" class="w-4 h-4"></i> Publicar Vaga</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">8</div><div class="text-xs text-slate-500 mt-1 font-bold">Soluções Ativas</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">6</div><div class="text-xs text-slate-500 mt-1 font-bold">Demandas & Processos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">4</div><div class="text-xs text-slate-500 mt-1 font-bold">Em Atendimento</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">2</div><div class="text-xs text-slate-500 mt-1 font-bold">Concluídos</div></div>
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
        <button type="button" @click="openCreatePrintModal()" class="bap cursor-pointer"><i data-lucide="plus" class="w-4 h-4"></i> Novo Pedido Gráfico</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">18</div><div class="text-xs text-slate-500 mt-1 font-bold">Formatos Disponíveis</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">12</div><div class="text-xs text-slate-500 mt-1 font-bold">Em Produção</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-yellow-500" style="font-family:Outfit">7</div><div class="text-xs text-slate-500 mt-1 font-bold">Orçamentos Emitidos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">450,0k</div><div class="text-xs text-slate-500 mt-1 font-bold">Receita (AOA)</div></div>
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

        <!-- CATÁLOGO DE SERVIÇOS (MODELO DO PRINT 3) -->
    <section x-show="currentPage==='servicos'" x-cloak class="space-y-6">
      <!-- HEADER -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Catálogo de Serviços</h1>
          <p class="text-slate-500 text-sm mt-0.5">Gerenciamento de pacotes, consultorias e serviços oferecidos pela RACHI.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="openNewServiceModal()" 
                  type="button"
                  class="bg-[#ffa525] hover:bg-[#dd8f20] text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Novo Serviço</span>
          </button>
        </div>
      </div>

            <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total de Serviços -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Total de Serviços</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="serviceStats.total">7</div>
            <span class="text-xs font-bold tracking-wider text-slate-400 dark:text-slate-500">Catálogo</span>
          </div>
        </div>

        <!-- Card 2: Serviços Ativos -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Serviços Ativos</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="serviceStats.ativos">7</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 dark:text-emerald-400 uppercase">ATIVO</span>
          </div>
        </div>

        <!-- Card 3: Pausados / Inativos -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Pausados / Inativos</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="serviceStats.inativos">0</div>
            <span class="text-xs font-bold tracking-wider text-slate-400 dark:text-slate-500 uppercase">INATIVO</span>
          </div>
        </div>

        <!-- Card 4: Ticket Médio Base -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">TICKET MÉDIO BASE</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 dark:bg-blue-950/40 dark:text-blue-400 border border-blue-200/80 dark:border-blue-800/40 uppercase">MÉDIA</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="serviceStats.ticketMedio">Kz 0,00</span>
          </div>
        </div>
      </div>

      <!-- CARD CONTAINER COM FILTROS E TABELA -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <!-- TOP FILTER BAR -->
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
          <!-- PILL TABS -->
          <div class="flex items-center gap-1.5">
            <button @click="serviceTab = 'todos'" 
                    type="button"
                    :class="serviceTab === 'todos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Todos (<span x-text="serviceStats.total"></span>)
            </button>
            <button @click="serviceTab = 'ativos'" 
                    type="button"
                    :class="serviceTab === 'ativos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Ativos (<span x-text="serviceStats.ativos"></span>)
            </button>
            <button @click="serviceTab = 'inativos'" 
                    type="button"
                    :class="serviceTab === 'inativos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Inativos (<span x-text="serviceStats.inativos"></span>)
            </button>
          </div>

          <!-- SEARCH BAR -->
          <div class="flex items-center gap-2.5 w-full sm:w-auto">
            <div class="relative w-full sm:w-72">
              <input type="text" x-model="serviceSearch" placeholder="Buscar serviço por nome, categoria ou código..."
                     class="w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-hidden focus:border-[#ffa525]">
            </div>
            <button type="button" class="px-4 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-bold transition hover:opacity-90">Filtrar</button>
          </div>
        </div>

        <!-- TABELA -->
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="border-b border-slate-100 dark:border-white/5 text-[10px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
                <th class="py-3 px-4 sm:px-6">Serviço</th>
                <th class="py-3 px-4">Categoria</th>
                <th class="py-3 px-4">Preço Base</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4 sm:px-6 text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="srv in filteredServices" :key="srv.id">
                <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                  <!-- SERVIÇO -->
                  <td class="py-3.5 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                      <div class="w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/10 flex items-center justify-center text-slate-700 dark:text-slate-300 shrink-0">
                        <i :data-lucide="srv.icon || 'layers'" class="w-4 h-4"></i>
                      </div>
                      <div class="min-w-0">
                        <div class="font-bold text-slate-900 dark:text-white text-xs truncate max-w-sm" x-text="srv.nome"></div>
                        <div class="text-[11px] text-slate-400 truncate max-w-sm" x-text="srv.descricao || srv.codigo"></div>
                      </div>
                    </div>
                  </td>

                  <!-- CATEGORIA -->
                  <td class="py-3.5 px-4">
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-slate-100 dark:bg-white/5 text-slate-700 dark:text-slate-300 border border-slate-200/60 dark:border-white/10" x-text="srv.categoria"></span>
                  </td>

                  <!-- PREÇO BASE -->
                  <td class="py-3.5 px-4 font-bold text-xs text-slate-900 dark:text-white" x-text="srv.precoBase"></td>

                  <!-- STATUS -->
                  <td class="py-3.5 px-4">
                    <span class="text-xs font-bold uppercase tracking-wider" 
                          :class="srv.status === 'Ativo' ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400'"
                          x-text="srv.status"></span>
                  </td>

                  <!-- AÇÕES -->
                  <td class="py-3.5 px-4 sm:px-6 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                      <button @click="editService(srv)" 
                              type="button"
                              class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 flex items-center gap-1 transition cursor-pointer">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                        <span>Editar</span>
                      </button>
                      <button @click="toggleServiceStatus(srv)" 
                              type="button"
                              class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 transition cursor-pointer"
                              x-text="srv.status === 'Ativo' ? 'Desativar' : 'Ativar'">
                      </button>
                      <button @click="deleteService(srv)" 
                              type="button"
                              class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                              title="Remover serviço">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>
              <tr x-show="filteredServices.length === 0">
                <td colspan="5" class="text-center py-10 text-slate-400 text-xs italic">
                  Nenhum serviço encontrado com os filtros selecionados.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- GESTÃO FINANCEIRA & FATURAMENTO (MODELO DO PRINT 2) -->
    <section x-show="currentPage==='financeiro'" x-cloak class="space-y-6">
      <!-- HEADER -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão Financeira & Faturamento</h1>
          <p class="text-slate-500 text-sm mt-0.5">Controle de receitas de contratos, parcelas, emissão de faturas e liquidações.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="openNewInvoiceModal()" 
                  type="button"
                  class="bg-[#ffa525] hover:bg-[#dd8f20] text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nova Fatura / Lançamento</span>
          </button>
        </div>
      </div>

            <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total Faturado -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Total Faturado</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="finStats.totalFormatted">Kz 0,00</div>
            <span class="text-xs font-bold tracking-wider text-slate-400 dark:text-slate-500" x-text="finStats.totalCount + ' lanç.'"></span>
          </div>
        </div>

        <!-- Card 2: Recebido em Caixa -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">Recebido em Caixa</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="finStats.recebidoFormatted">Kz 0,00</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 dark:text-emerald-400 uppercase">RECEBIDO</span>
          </div>
        </div>

        <!-- Card 3: A Receber (Pendente) -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">A Receber (Pendente)</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="finStats.pendenteFormatted">Kz 0,00</div>
            <span class="text-xs font-bold tracking-wider text-blue-600 dark:text-blue-400 uppercase">PENDENTE</span>
          </div>
        </div>

        <!-- Card 4: Em Atraso (Vencido) -->
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-4 sm:p-5 shadow-xs flex flex-col justify-between">
          <div class="flex items-center justify-between gap-2">
            <span class="text-[10.5px] font-bold tracking-wider text-slate-500 uppercase">EM ATRASO (VENCIDO)</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 dark:bg-rose-950/40 dark:text-rose-400 border border-rose-200/80 dark:border-rose-800/40 uppercase">VENCIDO</span>
          </div>
          <div class="mt-3">
            <span class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="finStats.vencidoFormatted">Kz 0,00</span>
          </div>
        </div>
      </div>

      <!-- CARD CONTAINER COM FILTROS E TABELA -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <!-- TOP FILTER BAR -->
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
          <!-- PILL TABS -->
          <div class="flex items-center gap-1.5 flex-wrap">
            <button @click="finTab = 'todos'" 
                    type="button"
                    :class="finTab === 'todos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Todos (<span x-text="finStats.totalCount"></span>)
            </button>
            <button @click="finTab = 'pendentes'" 
                    type="button"
                    :class="finTab === 'pendentes' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Pendentes (<span x-text="finStats.pendenteCount"></span>)
            </button>
            <button @click="finTab = 'recebidos'" 
                    type="button"
                    :class="finTab === 'recebidos' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Recebidos / Pagos (<span x-text="finStats.recebidoCount"></span>)
            </button>
            <button @click="finTab = 'cancelados'" 
                    type="button"
                    :class="finTab === 'cancelados' ? 'bg-[#ffa525] text-slate-950 font-bold shadow-xs' : 'bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 font-semibold'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition cursor-pointer">
              Cancelados (<span x-text="finStats.canceladoCount"></span>)
            </button>
          </div>

          <!-- SEARCH & SELECT -->
          <div class="flex flex-col sm:flex-row items-center gap-2.5">
            <div class="relative w-full sm:w-64">
              <input type="text" x-model="finSearch" placeholder="Buscar descrição, cliente ou NF..."
                     class="w-full px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-hidden focus:border-[#ffa525]">
            </div>
            <select x-model="finType" class="w-full sm:w-auto px-3.5 py-2 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-800 dark:text-slate-200 focus:outline-hidden focus:border-[#ffa525]">
              <option value="all">Todos os tipos</option>
              <option value="receita">Receita / Contrato</option>
              <option value="multicaixa">Multicaixa</option>
            </select>
            <button type="button" class="px-4 py-2 rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-bold transition hover:opacity-90">Filtrar</button>
          </div>
        </div>

        <!-- TABELA -->
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead>
              <tr class="border-b border-slate-100 dark:border-white/5 text-[10px] font-black uppercase tracking-wider text-slate-400 bg-slate-50/50 dark:bg-white/[0.01]">
                <th class="py-3 px-4 sm:px-6">Fatura / Descrição</th>
                <th class="py-3 px-4">Cliente</th>
                <th class="py-3 px-4">Valor</th>
                <th class="py-3 px-4">Vencimento</th>
                <th class="py-3 px-4">Status</th>
                <th class="py-3 px-4 sm:px-6 text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="inv in filteredInvoices" :key="inv.id">
                <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                  <!-- FATURA / DESCRIÇÃO -->
                  <td class="py-3.5 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                      <div class="w-8 h-8 rounded-xl bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0">
                        <i data-lucide="arrow-down-left" class="w-4 h-4"></i>
                      </div>
                      <div class="min-w-0">
                        <div class="font-bold text-slate-900 dark:text-white text-xs max-w-xs truncate" x-text="inv.titulo"></div>
                        <div class="text-[11px] text-slate-400 truncate" x-text="inv.codigo + ' · ' + inv.metodo + ' · Receita'"></div>
                      </div>
                    </div>
                  </td>

                  <!-- CLIENTE -->
                  <td class="py-3.5 px-4">
                    <div class="font-bold text-slate-900 dark:text-white text-xs truncate" x-text="inv.cliente"></div>
                    <div class="text-[11px] text-slate-400 truncate" x-text="inv.email"></div>
                  </td>

                  <!-- VALOR -->
                  <td class="py-3.5 px-4 font-bold text-xs text-slate-900 dark:text-white">
                    <span x-text="'+ AOA ' + inv.valor.toLocaleString('pt-AO', {minimumFractionDigits: 2})"></span>
                  </td>

                  <!-- VENCIMENTO -->
                  <td class="py-3.5 px-4 text-slate-500 text-xs" x-text="inv.vencimento"></td>

                  <!-- STATUS -->
                  <td class="py-3.5 px-4">
                    <template x-if="inv.status === 'A RECEBER'">
                      <span class="text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider">A RECEBER</span>
                    </template>
                    <template x-if="inv.status === 'RECEBIDO'">
                      <span class="text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">RECEBIDO</span>
                    </template>
                    <template x-if="inv.status === 'CANCELADO'">
                      <span class="text-xs font-bold text-rose-600 uppercase tracking-wider">CANCELADO</span>
                    </template>
                  </td>

                  <!-- AÇÕES -->
                  <td class="py-3.5 px-4 sm:px-6 text-right">
                    <div class="flex items-center justify-end gap-1.5">
                      <template x-if="inv.status === 'A RECEBER'">
                        <div class="flex items-center gap-1.5">
                          <button @click="receiveInvoice(inv)" 
                                  type="button"
                                  class="px-3 py-1.5 rounded-lg bg-slate-900 text-white dark:bg-white dark:text-slate-900 text-xs font-bold flex items-center gap-1 hover:opacity-90 transition cursor-pointer">
                            <span>✓ Receber</span>
                          </button>
                          <button @click="cancelInvoice(inv)" 
                                  type="button"
                                  class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 transition cursor-pointer">
                            Cancelar
                          </button>
                          <button @click="deleteInvoice(inv)" 
                                  type="button"
                                  class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                                  title="Remover lançamento">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                          </button>
                        </div>
                      </template>
                      <template x-if="inv.status === 'RECEBIDO'">
                        <div class="flex items-center gap-1.5">
                          <button @click="downloadReceipt(inv)" 
                                  type="button"
                                  class="px-2.5 py-1.5 rounded-lg border border-slate-200 dark:border-white/10 hover:bg-slate-100 dark:hover:bg-white/5 text-xs font-medium text-slate-700 dark:text-slate-200 transition cursor-pointer">
                            Recibo PDF
                          </button>
                          <button @click="deleteInvoice(inv)" 
                                  type="button"
                                  class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                                  title="Remover lançamento">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                          </button>
                        </div>
                      </template>
                      <template x-if="inv.status === 'CANCELADO'">
                        <button @click="deleteInvoice(inv)" 
                                type="button"
                                class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer"
                                title="Remover lançamento">
                          <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                      </template>
                    </div>
                  </td>
                </tr>
              </template>
              <tr x-show="filteredInvoices.length === 0">
                <td colspan="6" class="text-center py-10 text-slate-400 text-xs italic">
                  Nenhum lançamento encontrado com os filtros selecionados.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- RELATÓRIOS -->
    <section x-show="currentPage==='relatorios'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">📈 Central de Relatórios Executivos</h1>
          <p class="text-slate-500 text-sm mt-0.5">Exportação instantânea de dados em Excel, CSV e PDF por unidade de negócio.</p>
        </div>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <template x-for="r in reports" :key="r.label">
          <div class="sc2 hover:border-blue-500/50 transition group flex flex-col justify-between">
            <div>
              <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                  <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl shadow-sm shrink-0" :class="r.bg" x-text="r.icon"></div>
                  <div>
                    <div class="font-extrabold text-slate-900 dark:text-white text-base" x-text="r.label"></div>
                    <div class="text-xs text-slate-500 font-medium mt-0.5" x-text="r.desc"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="flex gap-2 mt-5 pt-3.5 border-t border-slate-100 dark:border-white/5">
              <button type="button" @click="exportReport(r.key, 'excel')" class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-700 dark:text-slate-300 hover:text-blue-600 transition font-bold cursor-pointer" title="Descarregar folha de cálculo Excel">Excel (.xlsx)</button>
              <button type="button" @click="exportReport(r.key, 'csv')" class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-blue-500/10 text-slate-700 dark:text-slate-300 hover:text-blue-600 transition font-bold cursor-pointer" title="Descarregar ficheiro CSV">CSV</button>
              <button type="button" @click="exportReport(r.key, 'pdf')" class="text-xs px-3 py-1.5 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-rose-50 dark:hover:bg-rose-500/10 text-slate-700 dark:text-slate-300 hover:text-rose-600 transition font-bold cursor-pointer" title="Imprimir / Guardar como PDF">PDF</button>
            </div>
          </div>
        </template>
      </div>
    </section>

    <!-- NOTIFICAÇÕES -->
    <section x-show="currentPage==='notificacoes'" x-cloak class="space-y-6">
      <div>
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">🔔 Centro de Notificações</h1>
        <p class="text-slate-500 text-sm mt-0.5">Alertas de clientes, novos pedidos, stocks e tarefas pendentes.</p>
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
        <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">⚙️ Parâmetros & Configurações</h1>
        <p class="text-slate-500 text-sm mt-0.5">Dados institucionais, preferências de aparência e segurança.</p>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="sc2 space-y-4">
          <h3 class="text-base font-extrabold text-slate-900 dark:text-white">Dados da Organização</h3>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">Razão Social</label><input type="text" value="RACHI — Soluções Inteligentes Lda." class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">NIF / Identificação Fiscal</label><input type="text" value="5417000000" class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">E-mail Corporativo</label><input type="email" value="geral@rachi.ao" class="ia"></div>
          <div><label class="text-xs font-bold text-slate-600 dark:text-slate-400 mb-1 block">Telefone Principal</label><input type="text" value="+244 972 888 585" class="ia"></div>
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

    <!-- LOJA PEDIDOS -->
    <section x-show="currentPage==='loja-pedidos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-tec.png" alt="RACHI Tec" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Tec — Pedidos & Formulários de TI</h1>
            <p class="text-slate-500 text-sm mt-0.5">Gestão de vendas da loja e de formulários preenchidos em /tec e sub-páginas.</p>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <button type="button" @click="refreshAdminRequests(true)" class="bap text-xs"><i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Atualizar</button>
        </div>
      </div>

      <!-- Abas de Navegação entre Pedidos de Venda e Formulários /tec -->
      <div class="flex items-center gap-3 border-b border-slate-200 dark:border-white/10 pb-1">
        <button type="button" @click="tecTab = 'pedidos'"
          class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition cursor-pointer"
          :class="tecTab === 'pedidos' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5'">
          <i data-lucide="shopping-cart" class="w-4 h-4"></i>
          <span>Pedidos de Venda Loja</span>
          <span class="px-1.5 py-0.5 rounded-full text-[10px] font-black" :class="tecTab === 'pedidos' ? 'bg-white/20 text-white' : 'bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-slate-300'" x-text="tecOrders.length"></span>
        </button>

        <button type="button" @click="tecTab = 'propostas'"
          class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-xs transition cursor-pointer"
          :class="tecTab === 'propostas' ? 'bg-blue-600 text-white shadow-md shadow-blue-500/25' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5'">
          <i data-lucide="file-text" class="w-4 h-4"></i>
          <span>Formulários & Propostas /tec</span>
          <span class="px-1.5 py-0.5 rounded-full text-[10px] font-black" :class="tecTab === 'propostas' ? 'bg-white/20 text-white' : 'bg-blue-100 dark:bg-blue-500/20 text-blue-700 dark:text-blue-300'" x-text="tecRequests.length"></span>
        </button>
      </div>

      <!-- ABA 1: PEDIDOS DE VENDA DA LOJA -->
      <div x-show="tecTab === 'pedidos'" class="space-y-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="tecOrders.length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Total Pedidos</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">2,10M</div><div class="text-xs text-slate-500 mt-1 font-bold">Facturação (AOA)</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">15</div><div class="text-xs text-slate-500 mt-1 font-bold">Pedidos Concluídos</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit">0</div><div class="text-xs text-slate-500 mt-1 font-bold">Em Aberto</div></div>
        </div>

        <div class="sc2 p-0 overflow-hidden">
          <div class="overflow-x-auto min-h-[280px]">
            <table class="at">
              <thead><tr><th>NÂº Pedido</th><th>Cliente</th><th>Valor Total</th><th>Data</th><th>Status</th></tr></thead>
              <tbody>
                <template x-for="o in tecOrders" :key="o.id">
                  <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                    <td class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400" x-text="o.numero"></td>
                    <td><div class="font-bold text-slate-900 dark:text-white text-sm" x-text="o.cliente"></div></td>
                    <td class="font-black text-emerald-600 dark:text-emerald-400" x-text="o.total"></td>
                    <td class="text-slate-500 text-xs" x-text="o.data"></td>
                    <td><span class="badge2 s-ativo" x-text="o.status"></span></td>
                  </tr>
                </template>
                <tr x-show="!tecOrders || tecOrders.length === 0">
                  <td colspan="5" class="text-center py-12">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                      <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum pedido de venda registado</h4>
                    <p class="text-xs text-slate-500 mt-1">Os pedidos da loja RACHI Tec aparecerão listados aqui automaticamente.</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- ABA 2: FORMULÁRIOS & PROPOSTAS PREENCHIDOS DA PÁGINA /TEC E SUB-PÁGINAS -->
      <div x-show="tecTab === 'propostas'" class="space-y-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
          <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="tecRequests.length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Solicitações Recebidas</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit" x-text="tecRequests.filter(r => (r.status_key === 'new' || (r.status || '').toLowerCase().includes('nov'))).length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Novas Propostas</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit" x-text="tecRequests.filter(r => ['in_analysis', 'in_progress', 'quoted'].includes(r.status_key)).length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Em Negociação</div></div>
          <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="tecRequests.filter(r => r.status_key === 'completed').length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Concluídas</div></div>
        </div>

        <div class="sc2 p-0 overflow-hidden">
          <div class="p-4 border-b border-slate-100 dark:border-white/10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
              <h2 class="font-bold text-slate-900 dark:text-white text-sm">Formulários de Serviços de TI (/tec)</h2>
              <p class="text-xs text-slate-500">Demandas de consultoria, websites, sistemas de gestão, digitalização e suporte técnico.</p>
            </div>
            <div class="flex items-center gap-2">
              <span class="text-xs font-bold text-slate-500" x-text="tecRequests.length + ' demanda(s) registada(s)'"></span>
            </div>
          </div>
          <div class="overflow-x-auto min-h-[280px]">
            <table class="at">
              <thead><tr><th>Protocolo</th><th>Solicitante & Empresa</th><th>Serviço / Proposta</th><th>Contacto</th><th>Data</th><th>Status</th><th>Ações</th></tr></thead>
              <tbody>
                <template x-for="r in tecRequests" :key="r.id">
                  <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                    <td class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400" x-text="r.protocol || ('#' + r.id)"></td>
                    <td>
                      <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="r.cliente"></div>
                      <div class="text-xs text-slate-500" x-text="r.empresa || 'Cliente Particular'"></div>
                    </td>
                    <td>
                      <div class="font-semibold text-slate-800 dark:text-slate-200 text-xs" x-text="r.titulo || r.servico"></div>
                      <div class="text-[11px] text-slate-400 line-clamp-1" x-text="r.descricao"></div>
                    </td>
                    <td>
                      <div class="text-xs font-mono font-bold text-slate-700 dark:text-slate-300" x-text="r.telefone || 'Não informado'"></div>
                      <div class="text-[11px] text-slate-400" x-text="r.email"></div>
                    </td>
                    <td class="text-slate-500 text-xs whitespace-nowrap" x-text="r.data || r.created_at"></td>
                    <td>
                      <span class="badge2" :class="r.sc" x-text="r.status"></span>
                    </td>
                    <td class="whitespace-nowrap">
                      <div class="flex items-center gap-2">
                        <button type="button" @click="openReq(r)" class="bap text-xs py-1 px-2.5 flex items-center gap-1.5 cursor-pointer">
                          <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                          <span>Ver Proposta</span>
                        </button>
                        <template x-if="r.telefone && r.telefone.replace(/\D/g, '').length >= 9">
                          <a :href="'https://wa.me/' + (r.telefone.replace(/\D/g, '').startsWith('244') ? r.telefone.replace(/\D/g, '') : '244' + r.telefone.replace(/\D/g, '')) + '?text=Olá%20' + encodeURIComponent(r.cliente) + '!%20Entramos%20em%20contacto%20sobre%20a%20sua%20solicitação%20no%20RACHI%20Tec%20(' + encodeURIComponent(r.protocol || '') + ').'"
                            target="_blank" class="p-1.5 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/20 transition cursor-pointer" title="WhatsApp Direto">
                            <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                          </a>
                        </template>
                      </div>
                    </td>
                  </tr>
                </template>
                <tr x-show="!tecRequests || tecRequests.length === 0">
                  <td colspan="7" class="text-center py-12">
                    <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                      <i data-lucide="file-text" class="w-6 h-6"></i>
                    </div>
                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum formulário de proposta registado ainda</h4>
                    <p class="text-xs text-slate-500 mt-1">Quando os clientes preencherem formulários na página /tec ou suas sub-páginas, eles aparecerão aqui instantaneamente.</p>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <!-- LOJA ESTOQUE -->
    <section x-show="currentPage==='loja-estoque'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-tec.png" alt="RACHI Tec" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Tec — Controlo & Alertas de Stock</h1>
            <p class="text-slate-500 text-sm mt-0.5">Gestão em tempo real de inventário, reposição, disponibilidade e alertas de stock crítico da loja.</p>
          </div>
        </div>
        <div class="flex items-center gap-2">
          <button type="button" @click="openStockModal(null, 'add')" class="bap cursor-pointer flex items-center gap-2">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nova Entrada em Stock</span>
          </button>
        </div>
      </div>

      <!-- 4 Cards de Métricas de Stock -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="sProducts.length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Linhas de Produto</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit" x-text="sProducts.reduce((acc, p) => acc + (p.est || 0), 0)"></div><div class="text-xs text-slate-500 mt-1 font-bold">Unidades em Depósito</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit" x-text="sProducts.filter(p => (p.est || 0) <= (p.min_est || 5)).length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Stock Crítico / Reposição</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-rose-500" style="font-family:Outfit" x-text="sProducts.filter(p => p.status !== 'Ativo' || (p.est || 0) === 0).length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Itens Indisponíveis / Esgotados</div></div>
      </div>

      <!-- Barra de Filtros Rápidos de Stock -->
      <div class="sc2 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
        <div class="flex items-center gap-2.5 flex-1 max-w-md">
          <div class="relative w-full">
            <i data-lucide="search" class="w-4 h-4 absolute left-3 top-3 text-slate-400"></i>
            <input type="text" x-model="stockSearch" placeholder="Filtrar por nome, SKU ou categoria..." class="ia w-full pl-9 text-xs">
          </div>
        </div>
        <div class="flex items-center gap-2">
          <span class="text-xs font-bold text-slate-500">Filtrar:</span>
          <select x-model="stockFilter" class="ia text-xs font-semibold py-1.5 px-3">
            <option value="all">Todos os Produtos</option>
            <option value="critico">Apenas Stock Crítico</option>
            <option value="esgotado">Apenas Esgotados / Indisponíveis</option>
            <option value="disponivel">Apenas Disponíveis na Loja</option>
          </select>
        </div>
      </div>

      <!-- Tabela de Controlo de Stock Completa -->
      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto min-h-[320px]">
          <table class="at">
            <thead>
              <tr>
                <th>Produto & Categoria</th>
                <th>SKU</th>
                <th>Stock Atual</th>
                <th>Mínimo Exigido</th>
                <th>Nível de Stock</th>
                <th>Situação</th>
                <th>Disponibilidade na Loja</th>
                <th class="text-right">Ações de Gestão</th>
              </tr>
            </thead>
            <tbody>
              <template x-for="p in filteredStockProducts" :key="p.id">
                <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                  <td>
                    <div class="font-bold text-slate-900 dark:text-white text-sm" x-text="p.nome"></div>
                    <div class="text-xs text-slate-500" x-text="p.cat"></div>
                  </td>
                  <td class="font-mono text-xs font-bold text-slate-500" x-text="p.sku"></td>
                  <td>
                    <div class="flex items-center gap-2">
                      <button type="button" @click="quickStockStep(p, -1)" class="w-6 h-6 rounded-lg bg-slate-100 dark:bg-white/10 hover:bg-rose-100 dark:hover:bg-rose-500/20 text-slate-700 dark:text-slate-300 hover:text-rose-600 font-black text-xs flex items-center justify-center transition cursor-pointer" title="Retirar 1 un.">-</button>
                      <span class="font-black text-sm min-w-[50px] text-center" :class="p.est <= (p.min_est || 5) ? 'text-amber-500' : 'text-slate-900 dark:text-white'" x-text="p.est + ' un.'"></span>
                      <button type="button" @click="quickStockStep(p, 1)" class="w-6 h-6 rounded-lg bg-slate-100 dark:bg-white/10 hover:bg-emerald-100 dark:hover:bg-emerald-500/20 text-slate-700 dark:text-slate-300 hover:text-emerald-600 font-black text-xs flex items-center justify-center transition cursor-pointer" title="Adicionar 1 un.">+</button>
                    </div>
                  </td>
                  <td class="text-slate-500 text-xs font-semibold" x-text="(p.min_est || 5) + ' un.'"></td>
                  <td class="w-40">
                    <div class="flex items-center gap-2">
                      <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-white/10 overflow-hidden">
                        <div class="h-full rounded-full transition-all" :class="p.est <= (p.min_est || 5) ? 'bg-amber-500' : 'bg-emerald-500'" :style="'width: ' + Math.min(100, Math.round((p.est / Math.max(1, p.est + 10)) * 100)) + '%'"></div>
                      </div>
                      <span class="text-[11px] font-bold text-slate-400" x-text="Math.min(100, Math.round((p.est / Math.max(1, p.est + 10)) * 100)) + '%'"></span>
                    </div>
                  </td>
                  <td>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold inline-flex items-center gap-1.5" :class="p.est <= (p.min_est || 5) ? 'bg-amber-500/10 text-amber-600 dark:text-amber-400' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400'">
                      <span class="w-1.5 h-1.5 rounded-full" :class="p.est <= (p.min_est || 5) ? 'bg-amber-500' : 'bg-emerald-500'"></span>
                      <span x-text="p.est <= (p.min_est || 5) ? 'Stock Baixo' : 'Normal'"></span>
                    </span>
                  </td>
                  <td>
                    <template x-if="p.status === 'Ativo' && p.est > 0">
                      <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-300 border border-emerald-200/60 dark:border-emerald-500/30 inline-flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Disponível</span>
                      </span>
                    </template>
                    <template x-if="p.status === 'Ativo' && p.est === 0">
                      <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 dark:bg-amber-500/15 dark:text-amber-300 border border-amber-200/60 dark:border-amber-500/30 inline-flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                        <span>Esgotado (0 un.)</span>
                      </span>
                    </template>
                    <template x-if="p.status !== 'Ativo'">
                      <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 dark:bg-rose-500/15 dark:text-rose-300 border border-rose-200/60 dark:border-rose-500/30 inline-flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                        <span>Indisponível (Pausado)</span>
                      </span>
                    </template>
                  </td>
                  <td class="text-right whitespace-nowrap">
                    <div class="flex items-center justify-end gap-1.5">
                      <button type="button" @click="openStockModal(p, 'add')" class="bap text-xs py-1 px-2.5 flex items-center gap-1 cursor-pointer" title="Adicionar / Ajustar Stock">
                        <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                        <span>Ajustar</span>
                      </button>
                      <button type="button" @click="toggleProductAvailability(p)" class="p-1.5 rounded-lg border text-xs font-bold transition cursor-pointer"
                        :class="p.status === 'Ativo' ? 'border-amber-300 text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-500/10' : 'border-emerald-300 text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-500/10'"
                        :title="p.status === 'Ativo' ? 'Marcar como Indisponível na Loja' : 'Marcar como Disponível na Loja'">
                        <i :data-lucide="p.status === 'Ativo' ? 'eye-off' : 'eye'" class="w-3.5 h-3.5"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              </template>
              <tr x-show="filteredStockProducts.length === 0">
                <td colspan="8" class="text-center py-12 text-slate-500 text-sm">
                  Nenhum produto encontrado para o filtro selecionado.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- RH CANDIDATOS / BANCO DE TALENTOS -->
    <section x-show="currentPage==='rh-candidatos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-human-capital.png" alt="RACHI Human Capital" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Human Capital — Banco de Talentos</h1>
            <p class="text-slate-500 text-sm mt-0.5">Perfis qualificados, banco curricular e candidatos a oportunidades corporativas.</p>
          </div>
        </div>
        <button @click="openCreateUserModalWithRole('customer')" class="bap"><i data-lucide="user-plus" class="w-4 h-4"></i> Adicionar Candidato</button>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">0</div><div class="text-xs text-slate-500 mt-1 font-bold">Candidatos Registados</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">0</div><div class="text-xs text-slate-500 mt-1 font-bold">Disponíveis Imediatos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">8</div><div class="text-xs text-slate-500 mt-1 font-bold">Processos em Aberto</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">100%</div><div class="text-xs text-slate-500 mt-1 font-bold">Taxa de Conformidade</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto min-h-[280px]">
          <table class="at">
            <thead><tr><th>Candidato / Perfil</th><th>Área de Especialidade</th><th>Nível de Carreira</th><th>Contacto</th><th>Estado</th></tr></thead>
            <tbody>
              <tr>
                <td colspan="5" class="text-center py-12">
                  <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i data-lucide="users" class="w-6 h-6"></i>
                  </div>
                  <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum candidato registado no Banco de Talentos</h4>
                  <p class="text-xs text-slate-500 mt-1">Os profissionais inscritos nos processos seletivos da RACHI serão exibidos aqui.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- GRÁFICA ORÇAMENTOS -->
    <section x-show="currentPage==='grafica-orcamentos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3.5">
          <div class="w-12 h-12 rounded-2xl bg-white dark:bg-white/10 border border-slate-200/80 dark:border-white/15 p-1.5 shadow-sm flex items-center justify-center shrink-0">
            <img src="/images/areas/rachi-print.png" alt="RACHI Print" class="h-9 w-auto object-contain drop-shadow-sm">
          </div>
          <div>
            <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">RACHI Print — Orçamentos & Ordens de Produção</h1>
            <p class="text-slate-500 text-sm mt-0.5">Gestão de orçamentos gráficos solicitados por empresas e aprovações de tiragem.</p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="kc text-center"><div class="text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit" x-text="printQuotes.length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Orçamentos Emitidos</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-amber-500" style="font-family:Outfit" x-text="printRequests.length"></div><div class="text-xs text-slate-500 mt-1 font-bold">Solicitações Recebidas</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">450,0k</div><div class="text-xs text-slate-500 mt-1 font-bold">Facturação (AOA)</div></div>
        <div class="kc text-center"><div class="text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">18</div><div class="text-xs text-slate-500 mt-1 font-bold">Catálogo Print</div></div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="p-5 flex items-center justify-between gap-3 border-b border-slate-100 dark:border-white/10">
          <div>
            <h2 class="font-bold text-slate-900 dark:text-white">Solicitações de Cotação</h2>
            <p class="text-xs text-slate-500 mt-1">Pedidos enviados pelo catálogo e pelas páginas de serviços da Print.</p>
          </div>
          <button type="button" @click="refreshAdminRequests(true)" class="bap text-xs">Atualizar</button>
        </div>
        <div class="overflow-x-auto">
          <table class="at">
            <thead><tr><th>Protocolo</th><th>Cliente / Empresa</th><th>Produto / Serviço</th><th>Data</th><th>Estado</th><th>Atendimento</th></tr></thead>
            <tbody>
              <template x-for="r in printRequests" :key="r.id">
                <tr>
                  <td class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400" x-text="r.protocol"></td>
                  <td><div class="font-bold text-slate-900 dark:text-white" x-text="r.cliente"></div><div class="text-xs text-slate-500" x-text="r.empresa"></div></td>
                  <td class="text-sm text-slate-700 dark:text-slate-300" x-text="r.titulo"></td>
                  <td class="text-xs text-slate-500" x-text="r.data || r.created_at"></td>
                  <td><span class="badge2" :class="r.sc" x-text="r.statusLabel || r.status"></span></td>
                  <td><button type="button" @click="openReq(r)" class="bap text-xs">Ver solicitação</button></td>
                </tr>
              </template>
              <tr x-show="printRequests.length === 0"><td colspan="6" class="text-center py-10 text-sm text-slate-500">Nenhuma solicitação de cotação recebida.</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="sc2 p-0 overflow-hidden">
        <div class="overflow-x-auto min-h-[280px]">
          <table class="at">
            <thead><tr><th>NÂº Orçamento</th><th>Cliente / Empresa</th><th>Valor Previsto</th><th>Data</th><th>Status</th></tr></thead>
            <tbody>
              <template x-for="q in printQuotes" :key="q.id">
                <tr class="hover:bg-slate-50/60 dark:hover:bg-white/[0.02] transition">
                  <td class="font-mono text-xs font-bold text-blue-600 dark:text-blue-400" x-text="q.numero"></td>
                  <td><div class="font-bold text-slate-900 dark:text-white text-sm" x-text="q.cliente"></div></td>
                  <td class="font-black text-emerald-600 dark:text-emerald-400" x-text="q.total"></td>
                  <td class="text-slate-500 text-xs" x-text="q.data"></td>
                  <td><span class="badge2 s-ativo" x-text="q.status"></span></td>
                </tr>
              </template>
              <tr x-show="!printQuotes || printQuotes.length === 0">
                <td colspan="5" class="text-center py-12">
                  <div class="w-12 h-12 rounded-2xl bg-slate-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-3 text-slate-400">
                    <i data-lucide="printer" class="w-6 h-6"></i>
                  </div>
                  <h4 class="text-sm font-bold text-slate-900 dark:text-white">Nenhum orçamento gráfico registado</h4>
                  <p class="text-xs text-slate-500 mt-1">Os orçamentos emitidos pela RACHI Print serão exibidos aqui.</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
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
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300">Pesquisar utilizador registado</label>
            <div class="relative">
              <input type="search" x-model="academyUserSearch" :disabled="!!newStudentForm.user_id" placeholder="Nome ou e-mail do perfil"
                class="w-full pl-9 pr-3.5 py-2.5 rounded-xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-xs text-slate-900 dark:text-white focus:outline-hidden focus:border-[#0050f0] disabled:opacity-60">
              <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
            </div>
            <div x-show="!newStudentForm.user_id && academyUserSearch.trim().length >= 2" x-cloak class="max-h-40 overflow-y-auto rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-[#0d1627]">
              <template x-for="user in matchingAcademyUsers" :key="user.id">
                <button type="button" @click="selectRegisteredAcademyUser(user)" class="w-full text-left px-3 py-2.5 border-b last:border-b-0 border-slate-100 dark:border-white/5 hover:bg-blue-50 dark:hover:bg-white/5 transition">
                  <span class="block text-xs font-bold text-slate-800 dark:text-white" x-text="user.nome"></span>
                  <span class="block text-[11px] text-slate-500" x-text="user.email + (user.telefone ? ' Â· ' + user.telefone : '')"></span>
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
            <input type="tel" x-model="newStudentForm.phone" required placeholder="+244 972 888 585"
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
            <p class="text-xs text-slate-500">Registe um utilizador e defina suas credenciais e perfil de acesso.</p>
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
              <input type="tel" x-model="userForm.telefone" placeholder="+244 972 888 585"
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
              <input type="tel" x-model="userForm.telefone" placeholder="+244 972 888 585"
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
              <span>Nova Palavra-passe</span>
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
                title="Gerar outra palavra-passe">
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

    <!-- MODAL 7: CONFIRMAR EXCLUSÃƒO DE UTILIZADOR -->
    <div x-show="showDeleteUserModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showDeleteUserModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-md bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-rose-500 to-red-600"></div>
        
        <div class="flex items-center gap-3 mb-4">
          <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0">
            <i data-lucide="alert-triangle" class="w-6 h-6"></i>
          </div>
          <div>
            <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Eliminar Utilizador</h3>
            <p class="text-xs text-slate-500">Esta ação é irreversível.</p>
          </div>
        </div>

        <p class="text-xs text-slate-600 dark:text-slate-300 mb-4 leading-relaxed">
          Tem certeza de que deseja eliminar permanentemente o utilizador
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
            <span>Sim, Eliminar Utilizador</span>
          </button>
        </div>
      </div>
    </div>

    <!-- MODAL 8: SELEÇÃƒO MODERNA DE PERFIL DE ACESSO -->
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

    <!-- MODAL 9: NOVA ORDEM DE SERVIÇO / SOLICITAÇÃƒO -->
    <div x-show="showCreateOrderModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreateOrderModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-cyan-500"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
              <i data-lucide="plus-circle" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Nova Ordem de Serviço</h3>
              <p class="text-xs text-slate-500 mt-0.5">Registo de atendimento para uma das 4 unidades.</p>
            </div>
          </div>
          <button @click="showCreateOrderModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitCreateOrder()" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Unidade de Negócio *</label>
              <select x-model.number="newOrder.business_unit_id" class="ia w-full" required>
                <option value="1">💻 RACHI Tec</option>
                <option value="2">🖨️ RACHI Print</option>
                <option value="3">🎓 RACHI Academy</option>
                <option value="4">👥 RACHI Human Capital</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Prioridade *</label>
              <select x-model="newOrder.priority" class="ia w-full" required>
                <option value="normal">Normal</option>
                <option value="high">Alta</option>
                <option value="urgent">Urgente</option>
                <option value="low">Baixa</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Título / Demanda Solicitada *</label>
            <input type="text" x-model="newOrder.title" placeholder="Ex: Manutenção de Servidor ou Criação de Identidade" class="ia w-full" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nome do Cliente</label>
              <input type="text" x-model="newOrder.customer_name" placeholder="Nome do cliente" class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">E-mail</label>
              <input type="email" x-model="newOrder.customer_email" placeholder="cliente@exemplo.ao" class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Telefone</label>
              <input type="text" x-model="newOrder.customer_phone" placeholder="+244 ..." class="ia w-full">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Descrição / Detalhes da Ordem</label>
            <textarea x-model="newOrder.description" rows="3" placeholder="Descreva os requisitos ou orientações para a equipa..." class="ia w-full"></textarea>
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreateOrderModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="newOrder.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!newOrder.isSubmitting"></i>
              <span x-text="newOrder.isSubmitting ? 'A criar ordem...' : 'Registar Ordem'"></span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 10: PUBLICAR VAGA CORPORATIVA (HUMAN CAPITAL) -->
    <div x-show="showCreateJobModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreateJobModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
              <i data-lucide="briefcase" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Publicar Vaga Corporativa</h3>
              <p class="text-xs text-slate-500 mt-0.5">RACHI Human Capital — Gestão de Oportunidades & Recrutamento.</p>
            </div>
          </div>
          <button @click="showCreateJobModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitCreateJob()" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Título do Cargo / Posição *</label>
            <input type="text" x-model="newJob.cargo" placeholder="Ex: Engenheiro de Software Full Stack" class="ia w-full" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Empresa Contratante</label>
              <input type="text" x-model="newJob.empresa" placeholder="RACHI Human Capital ou Empresa Parceira" class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Localização</label>
              <input type="text" x-model="newJob.local" placeholder="Luanda / Nacional" class="ia w-full">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Modalidade</label>
              <select x-model="newJob.mod" class="ia w-full">
                <option value="Presencial">Presencial</option>
                <option value="Híbrido">Híbrido</option>
                <option value="Remoto">Remoto</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Faixa Salarial / Honorários</label>
              <input type="text" x-model="newJob.sal" placeholder="Ex: AOA 250k+ ou Sob Proposta" class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Prazo do Processo</label>
              <input type="text" x-model="newJob.prazo" placeholder="30 dias" class="ia w-full">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Requisitos & Perfil Desejado</label>
            <textarea x-model="newJob.req" rows="3" placeholder="Requisitos, qualificações e competências exigidas..." class="ia w-full"></textarea>
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreateJobModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="newJob.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!newJob.isSubmitting"></i>
              <span x-text="newJob.isSubmitting ? 'A publicar...' : 'Publicar Vaga'"></span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 11: ADICIONAR PRODUTO TEC -->
    <div x-show="showCreateProductModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreateProductModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-600 via-sky-500 to-indigo-600"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
              <i data-lucide="package-plus" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Adicionar Produto TI</h3>
              <p class="text-xs text-slate-500 mt-0.5">RACHI Tec — Cadastro de Hardware, Equipamentos & Suprimentos.</p>
            </div>
          </div>
          <button @click="showCreateProductModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitCreateProduct()" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nome do Produto *</label>
            <input type="text" x-model="newProduct.nome" placeholder="Ex: Notebook Lenovo ThinkPad E15" class="ia w-full" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Código SKU (Opcional)</label>
              <input type="text" x-model="newProduct.sku" placeholder="Auto-gerado se vazio (ex: TEC-001)" class="ia w-full font-mono">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Categoria</label>
              <input type="text" x-model="newProduct.cat" placeholder="Notebooks, Periféricos, Redes..." class="ia w-full">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Preço Unitário (AOA) *</label>
              <input type="number" step="0.01" x-model="newProduct.preco" placeholder="185000" class="ia w-full font-bold" required>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Stock Inicial</label>
              <input type="number" x-model.number="newProduct.est" class="ia w-full font-bold">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Stock Mínimo</label>
              <input type="number" x-model.number="newProduct.min_est" class="ia w-full font-bold">
            </div>
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreateProductModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="newProduct.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!newProduct.isSubmitting"></i>
              <span x-text="newProduct.isSubmitting ? 'A guardar...' : 'Guardar Produto'"></span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL: AJUSTE DE STOCK RACHI TEC (showStockModal) -->
    <div x-show="showStockModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showStockModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-600 via-sky-500 to-emerald-500"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-blue-500/10 text-blue-600 dark:text-blue-400 flex items-center justify-center">
              <i data-lucide="package-check" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-lg font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão & Ajuste de Stock</h3>
              <p class="text-xs text-slate-500">RACHI Tec — Entrada, saída e disponibilidade na loja</p>
            </div>
          </div>
          <button type="button" @click="showStockModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/5 cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitStockAdjustment()" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Produto da Loja *</label>
            <select x-model="stockForm.product_id" required class="ia w-full text-xs font-semibold">
              <template x-for="p in sProducts" :key="p.id">
                <option :value="p.id" x-text="p.nome + ' (' + p.sku + ') — Stock Atual: ' + p.est + ' un.'"></option>
              </template>
            </select>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tipo de Movimento *</label>
              <select x-model="stockForm.action" class="ia w-full text-xs font-semibold">
                <option value="add">âž• Entrada / Adicionar ao Stock</option>
                <option value="remove">âž– Saída / Baixa de Stock</option>
                <option value="set">🔄 Definir Saldo Absoluto</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Quantidade (unidades) *</label>
              <input type="number" min="1" max="100000" x-model="stockForm.quantity" required class="ia w-full text-xs font-semibold">
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Stock Mínimo de Alerta</label>
              <input type="number" min="0" max="1000" x-model="stockForm.minimum_stock" placeholder="Ex: 3" class="ia w-full text-xs">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Motivo / Justificação</label>
              <input type="text" x-model="stockForm.reason" placeholder="Ex: Novo lote recebido" class="ia w-full text-xs">
            </div>
          </div>

          <div class="p-3 rounded-2xl bg-slate-50 dark:bg-white/[0.03] border border-slate-200/70 dark:border-white/10 flex items-center justify-between">
            <div class="pr-3">
              <span class="text-xs font-bold text-slate-800 dark:text-slate-200 block">Pausar se ficar zerado</span>
              <span class="text-[11px] text-slate-500 block">Muda automaticamente o produto para indisponível caso o stock chegue a zero.</span>
            </div>
            <input type="checkbox" x-model="stockForm.auto_disable" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-3 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showStockModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="stockForm.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!stockForm.isSubmitting"></i>
              <span x-text="stockForm.isSubmitting ? 'A processar...' : 'Atualizar Stock'"></span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 12: NOVO PEDIDO GRÁFICO (PRINT) -->
    <div x-show="showCreatePrintModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreatePrintModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-500 via-orange-500 to-rose-500"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center">
              <i data-lucide="printer" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Novo Item / Ordem Gráfica</h3>
              <p class="text-xs text-slate-500 mt-0.5">RACHI Print — Cadastrar tiragem gráfica, material ou acabamento.</p>
            </div>
          </div>
          <button @click="showCreatePrintModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitCreatePrint()" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Serviço / Produto Gráfico *</label>
            <input type="text" x-model="newPrint.nome" placeholder="Ex: Cartões de Visita Premium ou Banners Lona" class="ia w-full" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Material & Acabamento</label>
              <input type="text" x-model="newPrint.mat" placeholder="Couché 300g Laminação Fosca..." class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Formato / Tamanho</label>
              <input type="text" x-model="newPrint.tam" placeholder="90x50mm, A4, A5..." class="ia w-full font-mono">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Tiragem Mínima</label>
              <input type="number" x-model.number="newPrint.qtm" class="ia w-full font-bold">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Preço (AOA) *</label>
              <input type="number" step="0.01" x-model="newPrint.preco" placeholder="4500" class="ia w-full font-bold" required>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Prazo de Produção</label>
              <input type="text" x-model="newPrint.prazo" placeholder="3 dias úteis" class="ia w-full">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Especificações Adicionais</label>
            <textarea x-model="newPrint.desc" rows="2" placeholder="Cores, verniz, corte vinco ou orientações..." class="ia w-full"></textarea>
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreatePrintModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="newPrint.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!newPrint.isSubmitting"></i>
              <span x-text="newPrint.isSubmitting ? 'A registar...' : 'Registar Item Gráfico'"></span>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- MODAL 13: CRIAR NOVO CURSO / FORMAÇÃƒO (ACADEMY) -->
    <div x-show="showCreateCourseModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6" role="dialog">
      <div @click="showCreateCourseModal = false" class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity"></div>
      <div class="relative w-full max-w-xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-2xl overflow-hidden z-10 text-left">
        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500"></div>
        <div class="flex items-center justify-between pb-4 mb-5 border-b border-slate-100 dark:border-white/10">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
              <i data-lucide="graduation-cap" class="w-5 h-5"></i>
            </div>
            <div>
              <h3 class="text-base font-black text-slate-900 dark:text-white" style="font-family:Outfit">Criar Nova Formação</h3>
              <p class="text-xs text-slate-500 mt-0.5">RACHI Academy — Registar novo curso ou trilha no catálogo.</p>
            </div>
          </div>
          <button @click="showCreateCourseModal = false" class="p-2 rounded-xl text-slate-400 hover:text-slate-600 dark:hover:text-white cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
          </button>
        </div>

        <form @submit.prevent="submitCreateCourse()" class="space-y-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Título da Formação *</label>
            <input type="text" x-model="newCourse.nome" placeholder="Ex: Cibersegurança & Governança de Dados" class="ia w-full" required>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Área / Categoria</label>
              <input type="text" x-model="newCourse.cat" placeholder="Tecnologia & TI, Gestão, Redes..." class="ia w-full">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Nível da Formação</label>
              <select x-model="newCourse.level" class="ia w-full">
                <option value="beginner">Iniciante</option>
                <option value="intermediate">Intermédio</option>
                <option value="advanced">Avançado</option>
              </select>
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Preço (AOA) *</label>
              <input type="number" step="0.01" x-model="newCourse.preco" placeholder="65000" class="ia w-full font-bold" required>
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Carga Horária (h)</label>
              <input type="number" x-model.number="newCourse.dur" placeholder="40" class="ia w-full font-bold">
            </div>
            <div>
              <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Módulos</label>
              <input type="number" x-model.number="newCourse.modulos" placeholder="4" class="ia w-full font-bold">
            </div>
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Formador / Docente Responsável</label>
            <input type="text" x-model="newCourse.prof" placeholder="Corpo Docente RACHI ou Especialista" class="ia w-full">
          </div>

          <div>
            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">Resumo / Conteúdo Programático</label>
            <textarea x-model="newCourse.desc" rows="2" placeholder="Objetivos pedagógicos e competências desenvolvidas..." class="ia w-full"></textarea>
          </div>

          <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-slate-100 dark:border-white/10">
            <button type="button" @click="showCreateCourseModal = false" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/10 text-slate-700 dark:text-white text-xs font-bold cursor-pointer">Cancelar</button>
            <button type="submit" :disabled="newCourse.isSubmitting" class="bap px-5 py-2 cursor-pointer flex items-center gap-1.5">
              <i data-lucide="check" class="w-4 h-4" x-show="!newCourse.isSubmitting"></i>
              <span x-text="newCourse.isSubmitting ? 'A registar...' : 'Registar Curso'"></span>
            </button>
          </div>
        </form>
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


    <!-- =====================================================================
         MÓDULO 1: SITES (SOLICITADO NO ITEM 8 DO BRIEFING)
         ===================================================================== -->
    <section x-show="currentPage==='sites'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gerenciador de Sites &amp; Aplicações</h1>
          <p class="text-slate-500 text-sm mt-0.5">Gestão de websites cadastrados, tecnologias, status operacional e certificados SSL.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="showAlert('info', 'Novo Site', 'Abrindo assistente de implantação de site...')" class="bg-purple-600 hover:bg-purple-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Novo Site</span>
          </button>
        </div>
      </div>

      <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">TOTAL DE SITES</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">87</div>
            <span class="text-xs font-bold tracking-wider text-slate-400">Cadastrados</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">SITES ONLINE</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">85</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase">97.7% UP</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">EM MANUTENÇÃO</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-amber-500" style="font-family:Outfit">2</div>
            <span class="text-xs font-bold tracking-wider text-amber-600 uppercase">STAGING</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">CERTIFICADOS SSL</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">87</div>
            <span class="text-xs font-bold tracking-wider text-blue-600 uppercase">100% SEGURO</span>
          </div>
        </div>
      </div>

      <!-- Tabela de Sites -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex items-center justify-between gap-4">
          <h3 class="font-bold text-sm sm:text-base text-slate-900 dark:text-white">Websites Gerenciados pela RACHI</h3>
          <span class="text-xs text-slate-400 font-semibold">5 de 87 sites listados</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 dark:bg-white/[0.02] text-slate-400 uppercase tracking-wider text-[10.5px] border-b border-slate-100 dark:border-white/5">
              <tr>
                <th class="py-3 px-4 font-bold">Plataforma / Nome</th>
                <th class="py-3 px-4 font-bold">URL</th>
                <th class="py-3 px-4 font-bold">Cliente Responsável</th>
                <th class="py-3 px-4 font-bold">Tecnologia</th>
                <th class="py-3 px-4 font-bold text-center">SSL</th>
                <th class="py-3 px-4 font-bold text-center">Status</th>
                <th class="py-3 px-4 font-bold text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="s in sites" :key="s.id">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-white/[0.02] transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white" x-text="s.nome"></td>
                  <td class="py-3.5 px-4">
                    <a :href="s.url" target="_blank" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline flex items-center gap-1">
                      <span x-text="s.url"></span>
                      <i data-lucide="external-link" class="w-3 h-3"></i>
                    </a>
                  </td>
                  <td class="py-3.5 px-4 text-slate-600 dark:text-slate-300 font-medium" x-text="s.cliente"></td>
                  <td class="py-3.5 px-4 text-slate-500 font-mono" x-text="s.tech"></td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">Ativo</span>
                  </td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2.5 py-0.5 rounded-md text-[10.5px] font-bold uppercase"
                          :class="s.status === 'Online' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'"
                          x-text="s.status"></span>
                  </td>
                  <td class="py-3.5 px-4 text-right">
                    <button @click="showAlert('success', 'Site', 'Painel técnico do site acessado com sucesso!')" class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition" title="Gerenciar site">
                      <i data-lucide="settings-2" class="w-3.5 h-3.5"></i>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- =====================================================================
         MÓDULO 2: DOMÍNIOS (SOLICITADO NO ITEM 8 DO BRIEFING)
         ===================================================================== -->
    <section x-show="currentPage==='dominios'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão de Domínios &amp; DNS</h1>
          <p class="text-slate-500 text-sm mt-0.5">Controle de zonas de DNS, expirações, renovações automáticas e proteção whois.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="showAlert('info', 'Registrar Domínio', 'Assistente de consulta Whois aberto.')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="globe" class="w-4 h-4"></i>
            <span>Registrar Domínio</span>
          </button>
        </div>
      </div>

      <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">DOMÍNIOS GERENCIADOS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">22</div>
            <span class="text-xs font-bold tracking-wider text-slate-400">Total</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">STATUS ATIVO</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">20</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase">DNS OK</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">RENOVAÇÃO PRÓXIMA</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-amber-500" style="font-family:Outfit">2</div>
            <span class="text-xs font-bold tracking-wider text-amber-600 uppercase">&lt; 30 DIAS</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">PROVEDORES DNS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">3</div>
            <span class="text-xs font-bold tracking-wider text-purple-600 uppercase">CLOUDFLARE</span>
          </div>
        </div>
      </div>

      <!-- Tabela de Domínios -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex items-center justify-between gap-4">
          <h3 class="font-bold text-sm sm:text-base text-slate-900 dark:text-white">Domínios Registrados</h3>
          <span class="text-xs text-slate-400 font-semibold">Exibindo registros ativos</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 dark:bg-white/[0.02] text-slate-400 uppercase tracking-wider text-[10.5px] border-b border-slate-100 dark:border-white/5">
              <tr>
                <th class="py-3 px-4 font-bold">Domínio</th>
                <th class="py-3 px-4 font-bold">Cliente</th>
                <th class="py-3 px-4 font-bold">Servidor DNS</th>
                <th class="py-3 px-4 font-bold">Data Registro</th>
                <th class="py-3 px-4 font-bold">Expiração</th>
                <th class="py-3 px-4 font-bold text-center">Status</th>
                <th class="py-3 px-4 font-bold text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="d in dominios" :key="d.id">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-white/[0.02] transition-colors">
                  <td class="py-3.5 px-4 font-bold font-mono text-purple-600 dark:text-purple-400" x-text="d.domain"></td>
                  <td class="py-3.5 px-4 text-slate-800 dark:text-slate-200 font-semibold" x-text="d.cliente"></td>
                  <td class="py-3.5 px-4 text-slate-500 font-medium" x-text="d.dns"></td>
                  <td class="py-3.5 px-4 text-slate-500" x-text="d.registro"></td>
                  <td class="py-3.5 px-4 font-semibold text-slate-700 dark:text-slate-300" x-text="d.expiracao"></td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2.5 py-0.5 rounded-md text-[10.5px] font-bold uppercase"
                          :class="d.status === 'Ativo' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'"
                          x-text="d.status"></span>
                  </td>
                  <td class="py-3.5 px-4 text-right">
                    <button @click="showAlert('success', 'DNS', 'Zonas de DNS carregadas.')" class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition" title="Editar DNS">
                      <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- =====================================================================
         MÓDULO 3: TRÁFEGO PAGO (SOLICITADO NO ITEM 8 DO BRIEFING)
         ===================================================================== -->
    <section x-show="currentPage==='trafego'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão de Tráfego Pago &amp; Anúncios</h1>
          <p class="text-slate-500 text-sm mt-0.5">Campanhas ativas no Meta Ads, Google Ads e LinkedIn Ads com métricas de conversão e ROI.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="showAlert('info', 'Nova Campanha', 'Assistente de criação de campanha de tráfego iniciado.')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Nova Campanha</span>
          </button>
        </div>
      </div>

      <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">INVESTIMENTO MENSAL</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Kz 2.24M</div>
            <span class="text-xs font-bold tracking-wider text-slate-400">Total</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">CLIQUES GERADOS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">37.5k</div>
            <span class="text-xs font-bold tracking-wider text-blue-600 uppercase">TRÁFEGO</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">CONVERSÕES TOTAIS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">771</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase">LEADS</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">CTR MÉDIO</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">7.98%</div>
            <span class="text-xs font-bold tracking-wider text-purple-600 uppercase">ALTO ROI</span>
          </div>
        </div>
      </div>

      <!-- Tabela de Campanhas -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex items-center justify-between gap-4">
          <h3 class="font-bold text-sm sm:text-base text-slate-900 dark:text-white">Campanhas em Execução</h3>
          <span class="text-xs text-slate-400 font-semibold">Performance em tempo real</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 dark:bg-white/[0.02] text-slate-400 uppercase tracking-wider text-[10.5px] border-b border-slate-100 dark:border-white/5">
              <tr>
                <th class="py-3 px-4 font-bold">Campanha</th>
                <th class="py-3 px-4 font-bold">Cliente / Conta</th>
                <th class="py-3 px-4 font-bold">Plataforma</th>
                <th class="py-3 px-4 font-bold">Investimento</th>
                <th class="py-3 px-4 font-bold">Cliques</th>
                <th class="py-3 px-4 font-bold">Conversões</th>
                <th class="py-3 px-4 font-bold">CTR</th>
                <th class="py-3 px-4 font-bold text-center">Status</th>
                <th class="py-3 px-4 font-bold text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="cp in campanhas" :key="cp.id">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-white/[0.02] transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white" x-text="cp.nome"></td>
                  <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300 font-semibold" x-text="cp.cliente"></td>
                  <td class="py-3.5 px-4 font-bold text-blue-600 dark:text-blue-400" x-text="cp.plataforma"></td>
                  <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white" x-text="cp.invest"></td>
                  <td class="py-3.5 px-4 font-semibold text-slate-600 dark:text-slate-400" x-text="cp.cliques.toLocaleString()"></td>
                  <td class="py-3.5 px-4 font-bold text-emerald-600 dark:text-emerald-400" x-text="cp.conv"></td>
                  <td class="py-3.5 px-4 font-bold text-purple-600 dark:text-purple-400" x-text="cp.ctr"></td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2.5 py-0.5 rounded-md text-[10.5px] font-bold uppercase"
                          :class="cp.status === 'Ativa' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200'"
                          x-text="cp.status"></span>
                  </td>
                  <td class="py-3.5 px-4 text-right">
                    <button @click="showAlert('info', 'Análise', 'Dashboard de conversão da campanha aberto.')" class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition">
                      <i data-lucide="bar-chart-2" class="w-3.5 h-3.5"></i>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

    <!-- =====================================================================
         MÓDULO 4: PROJETOS (SOLICITADO NO ITEM 8 DO BRIEFING)
         ===================================================================== -->
    <section x-show="currentPage==='projetos'" x-cloak class="space-y-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">Gestão de Projetos &amp; Entregas</h1>
          <p class="text-slate-500 text-sm mt-0.5">Acompanhamento de cronogramas, tarefas concluídas, equipes alocadas e marcos contratuais.</p>
        </div>
        <div class="flex items-center gap-2">
          <button @click="showAlert('info', 'Novo Projeto', 'Assistente de criação de projeto aberto.')" class="bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-4 py-2.5 rounded-xl text-xs sm:text-sm flex items-center gap-2 shadow-xs transition cursor-pointer">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Novo Projeto</span>
          </button>
        </div>
      </div>

      <!-- 4 KPIS -->
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">PROJETOS ATIVOS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white" style="font-family:Outfit">12</div>
            <span class="text-xs font-bold tracking-wider text-slate-400">Em curso</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">CONCLUÍDOS</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-emerald-600 dark:text-emerald-400" style="font-family:Outfit">28</div>
            <span class="text-xs font-bold tracking-wider text-emerald-600 uppercase">ENTREGUES</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">EM HOMOLOGAÇÃO</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-blue-600 dark:text-blue-400" style="font-family:Outfit">3</div>
            <span class="text-xs font-bold tracking-wider text-blue-600 uppercase">QA / TESTES</span>
          </div>
        </div>
        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 p-5 shadow-xs">
          <div class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">SLA NO PRAZO</div>
          <div class="flex items-center justify-between mt-3">
            <div class="text-2xl sm:text-3xl font-black text-purple-600 dark:text-purple-400" style="font-family:Outfit">98.4%</div>
            <span class="text-xs font-bold tracking-wider text-purple-600 uppercase">PRECISÃO</span>
          </div>
        </div>
      </div>

      <!-- Tabela de Projetos -->
      <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-white/10 shadow-xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 dark:border-white/5 flex items-center justify-between gap-4">
          <h3 class="font-bold text-sm sm:text-base text-slate-900 dark:text-white">Projetos em Execução</h3>
          <span class="text-xs text-slate-400 font-semibold">Cronogramas &amp; Prazos</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 dark:bg-white/[0.02] text-slate-400 uppercase tracking-wider text-[10.5px] border-b border-slate-100 dark:border-white/5">
              <tr>
                <th class="py-3 px-4 font-bold">Projeto</th>
                <th class="py-3 px-4 font-bold">Cliente</th>
                <th class="py-3 px-4 font-bold">Responsável</th>
                <th class="py-3 px-4 font-bold">Início</th>
                <th class="py-3 px-4 font-bold">Entrega</th>
                <th class="py-3 px-4 font-bold">Progresso</th>
                <th class="py-3 px-4 font-bold text-center">Status</th>
                <th class="py-3 px-4 font-bold text-right">Ações</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-white/5">
              <template x-for="p in projetos" :key="p.id">
                <tr class="hover:bg-slate-50/80 dark:hover:bg-white/[0.02] transition-colors">
                  <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white" x-text="p.nome"></td>
                  <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300 font-medium" x-text="p.cliente"></td>
                  <td class="py-3.5 px-4 text-slate-600 dark:text-slate-400" x-text="p.responsavel"></td>
                  <td class="py-3.5 px-4 text-slate-500" x-text="p.inicio"></td>
                  <td class="py-3.5 px-4 font-semibold text-slate-800 dark:text-slate-200" x-text="p.entrega"></td>
                  <td class="py-3.5 px-4 w-36">
                    <div class="flex items-center gap-2">
                      <div class="flex-1 h-2 bg-slate-100 dark:bg-white/10 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full" :style="'width: ' + p.progresso + '%'"></div>
                      </div>
                      <span class="text-[10px] font-bold text-slate-700 dark:text-slate-300" x-text="p.progresso + '%'"></span>
                    </div>
                  </td>
                  <td class="py-3.5 px-4 text-center">
                    <span class="px-2.5 py-0.5 rounded-md text-[10.5px] font-bold uppercase"
                          :class="p.status === 'Concluído' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : (p.status === 'Em Testes' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-purple-50 text-purple-700 border border-purple-200')"
                          x-text="p.status"></span>
                  </td>
                  <td class="py-3.5 px-4 text-right">
                    <button @click="showAlert('info', 'Projeto', 'Quadro Kanban do projeto aberto.')" class="p-1.5 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 transition">
                      <i data-lucide="layout-grid" class="w-3.5 h-3.5"></i>
                    </button>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
        </div>
      </div>
    </section>

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

  // 1. Gráfico de Facturação (Área)
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
          data: [8, 14, 6, 12],
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
    syncTimeText: 'Just now •',
    isSyncing: false,
    reqFilterStatus: 'all',
    reqSearch: '',
    refreshSync() {
      this.isSyncing = true;
      setTimeout(() => {
        this.isSyncing = false;
        this.syncTimeText = 'Atualizado agora •';
        this.showAlert('success', 'Sincronização Concluída', 'Todos os dados e métricas foram atualizados com sucesso.', 3000);
      }, 700);
    },
    get paginatedRequests() {
      let list = this.allRequests || [];
      if (this.reqFilterStatus && this.reqFilterStatus !== 'all') {
        list = list.filter(r => r.status === this.reqFilterStatus);
      }
      if (this.reqSearch) {
        const q = this.reqSearch.toLowerCase();
        list = list.filter(r => (r.protocol || '').toLowerCase().includes(q) || (r.cliente || '').toLowerCase().includes(q) || (r.title || r.servico || '').toLowerCase().includes(q));
      }
      return list.slice(0, 7);
    },
    sites: [
      { id: 1, nome: "Portal Corporativo BFA", url: "https://bfa.ao", cliente: "Banco de Fomento Angola", tech: "Laravel + Vue.js", status: "Online", ssl: "Ativo", created_at: "15/01/2026", updated_at: "24/11/2026" },
      { id: 2, nome: "E-Commerce GundjaTech", url: "https://gundjatech.com", cliente: "GundjaTech", tech: "Next.js + Tailwind", status: "Online", ssl: "Ativo", created_at: "10/02/2026", updated_at: "25/11/2026" },
      { id: 3, nome: "Plataforma Cotech Contábil", url: "https://cotech.ao", cliente: "Cotech Contabilidade", tech: "WordPress Headless", status: "Online", ssl: "Ativo", created_at: "05/03/2026", updated_at: "20/11/2026" },
      { id: 4, nome: "Catálogo Digital Laurinita", url: "https://laurinita.co.ao", cliente: "Laurinita Distribuidora", tech: "React + Cloudflare", status: "Em Manutenção", ssl: "Ativo", created_at: "18/04/2026", updated_at: "22/11/2026" },
      { id: 5, nome: "Portal Acadêmico Instituto Saber", url: "https://paraisodosaber.ao", cliente: "Instituto Técnico Saber", tech: "Laravel + Livewire", status: "Online", ssl: "Ativo", created_at: "20/05/2026", updated_at: "26/11/2026" }
    ],
    dominios: [
      { id: 1, domain: "rachi.ao", cliente: "RACHI Oficial", registro: "10/01/2024", expiracao: "10/01/2027", status: "Ativo", dns: "Cloudflare", auto_renew: true },
      { id: 2, domain: "gundjatech.com", cliente: "GundjaTech", registro: "15/03/2025", expiracao: "15/03/2027", status: "Ativo", dns: "Cloudflare", auto_renew: true },
      { id: 3, domain: "cotechcontabilidade.com.br", cliente: "Cotech Contabilidade", registro: "02/06/2025", expiracao: "02/06/2027", status: "Ativo", dns: "Registro.br", auto_renew: true },
      { id: 4, domain: "laurinita.co.ao", cliente: "Laurinita Distribuidora", registro: "12/12/2025", expiracao: "12/12/2026", status: "Renovando", dns: "DNS.AO", auto_renew: false },
      { id: 5, domain: "paraisodosaber.ao", cliente: "Instituto Técnico Saber", registro: "25/11/2025", expiracao: "25/11/2027", status: "Ativo", dns: "Cloudflare", auto_renew: true }
    ],
    campanhas: [
      { id: 1, nome: "Black Friday RACHI Print 2026", cliente: "RACHI Print", plataforma: "Meta Ads", invest: "Kz 450.000", cliques: 14200, impressoes: 185000, conv: 342, ctr: "7.67%", cpc: "Kz 31,69", status: "Ativa" },
      { id: 2, nome: "Geração de Leads B2B TI", cliente: "RACHI Tec", plataforma: "Google Ads", invest: "Kz 850.000", cliques: 9800, impressoes: 120000, conv: 186, ctr: "8.16%", cpc: "Kz 86,73", status: "Ativa" },
      { id: 3, nome: "Matrículas Cursos Executivos", cliente: "RACHI Academy", plataforma: "LinkedIn Ads", invest: "Kz 620.000", cliques: 5400, impressoes: 74000, conv: 98, ctr: "7.29%", cpc: "Kz 114,81", status: "Ativa" },
      { id: 4, nome: "Recrutamento Executivo Luanda", cliente: "RACHI Human Capital", plataforma: "Meta Ads", invest: "Kz 320.000", cliques: 8100, impressoes: 92000, conv: 145, ctr: "8.80%", cpc: "Kz 39,50", status: "Pausada" }
    ],
    projetos: [
      { id: 1, nome: "Implantação ERP Corporativo", cliente: "Banco de Fomento Angola", responsavel: "Casimiro Gundja", inicio: "01/10/2026", entrega: "15/12/2026", progresso: 75, tarefas: "18/24", status: "Em Andamento" },
      { id: 2, nome: "Portal de Autoatendimento Web", cliente: "Cotech Contabilidade", responsavel: "Equipe Web", inicio: "15/10/2026", entrega: "30/11/2026", progresso: 90, tarefas: "19/21", status: "Em Testes" },
      { id: 3, nome: "Reestruturação de Rede & Servidores", cliente: "Instituto Técnico Saber", responsavel: "Suporte Técnico", inicio: "01/11/2026", entrega: "10/12/2026", progresso: 45, tarefas: "9/20", status: "Em Andamento" },
      { id: 4, nome: "Campanha Institucional & Catálogo Gráfico", cliente: "Laurinita Distribuidora", responsavel: "Diretoria Criativa", inicio: "20/09/2026", entrega: "15/11/2026", progresso: 100, tarefas: "15/15", status: "Concluído" }
    ],

    currentPage: 'dashboard',
        messengerFilter: 'all',
    messengerChannelFilter: 'all',
    aiAgent: {
      globalPilot: true,
      autoQuote: true,
      model: 'gemini-2.5-flash',
      apiKey: '',
      fallbackEngine: 'Cloudflare Workers AI (@cf/meta/llama-3.1-8b-instruct)',
      channels: {
        site: { name: 'Chat do Site - Leads', active: true, desc: 'Captação e qualificação de leads no site' },
        whatsapp1: { name: 'WhatsApp 1 - Atendimento', active: false, desc: 'Linha comercial principal (+244 923 000 000)' },
        whatsapp2: { name: 'WhatsApp 2 - Diretor', active: false, desc: 'Linha executiva da diretoria (+244 923 888 777)' }
      },
      stats: {
        activePilot: 1,
        inQualification: 3,
        autoQuotesGenerated: 8,
        handedOffToHuman: 5
      },
      systemPrompt: `Você é o Assistente Comercial Sênior da RACHI (empresa de tecnologia e transformação digital em Angola). Converse em português de forma clara, executiva, acolhedora e objetiva (máximo 3 frases por resposta).
Nossas soluções:
1. Software & Sistemas sob medida (ERP, CRM, Gestão Escolar e Hospitalar).
2. Criação de Sites e Lojas Virtuais com Multicaixa Express (a partir de 180.000 Kz).
3. Gestão de Cibersegurança, Infraestrutura de Redes e Servidores Cloud.
4. RACHI Academy (Cursos e Formações Tecnológicas).
5. Serviços Gráficos & Marketing Digital.
Regras: Sempre identifique o nome do cliente, empresa, necessidade e prazo. Se o cliente solicitar reunião com a diretoria ou negociação de descontos, acione o transbordo humano imediatamente.`,
      pipelineLeads: [
        { id: 101, name: "Dr. António Silva", company: "Banco de Fomento Angola", channel: "whatsapp", score: 95, scope: "Implantação ERP Corporativo", quoteEstimate: "Kz 3.850.000", status: "Transbordo Solicitado", time: "15:28" },
        { id: 102, name: "Laurindo Augusto Cakoyi", company: "Instituto Técnico Saber", channel: "livechat", score: 88, scope: "Formação Cibersegurança 15 vagas", quoteEstimate: "Kz 950.000", status: "Transbordo Solicitado", time: "15:15" },
        { id: 103, name: "Visitante Comercial (Luanda)", company: "Lead do Site", channel: "whatsapp", score: 72, scope: "Loja Virtual + Multicaixa Express", quoteEstimate: "Kz 240.000", status: "IA Qualificando", time: "13:30" }
      ],
      showApiKeyInput: false,
      testPromptModal: false,
      testQuestion: '',
      testAnswer: '',
      testLoading: false
    },
    messengerSearch: '',
    activeChatId: 1,
    chatReplyText: '',
    messengerStats: { today: 64, whatsapp: 38, livechat: 18, portal: 8 },
    conversations: [
      {
        id: 1,
        name: "Dr. António Silva",
        company: "Banco de Fomento Angola",
        channel: "whatsapp",
        aiMode: "waiting_human",
        handoffReason: "Solicitou reunião executiva de alinhamento",
        phone: "+244 972 888 585",
        avatar: "AS",
        avatarBg: "bg-[#071326]",
        status: "online",
        unread: 2,
        lastTime: "15:28",
        subject: "Implantação ERP Corporativo",
        messages: [
          { sender: "customer", text: "Boa tarde! A IA me explicou sobre a arquitetura do ERP, mas preciso fechar os prazos de entrega e assinar o aditivo contratual com o Dr. Casimiro.", time: "15:22" },
          { sender: "bot", text: "Com certeza, Dr. António! Como a aprovação de prazos e aditivos contratuais exige validação executiva da nossa direção, estou a transferir o seu atendimento agora mesmo para o Dr. Casimiro Gundja. Um momento!", time: "15:24" },
          { sender: "system", text: "🚨 [Sistema]: Transbordo para Humano acionado via WhatsApp. Aguardando assunção do atendente.", time: "15:25" },
          { sender: "customer", text: "Perfeito, fico no aguardo.", time: "15:28" }
        ]
      },
      {
        id: 2,
        name: "Laurindo Augusto Cakoyi",
        company: "Instituto Técnico Saber",
        channel: "livechat",
        aiMode: "waiting_human",
        handoffReason: "Pediu proposta com desconto para 15 colaboradores",
        phone: "+244 930 133 850",
        avatar: "LA",
        avatarBg: "bg-[#0050f0]",
        status: "online",
        unread: 1,
        lastTime: "15:15",
        subject: "Dúvida sobre Formação Academy",
        messages: [
          { sender: "customer", text: "Olá! A IA já me passou o valor individual da Formação em Cibersegurança, mas nossa direção quer fechar uma turma in-company de 15 pessoas com proposta formal.", time: "15:10" },
          { sender: "bot", text: "Excelente iniciativa! Para turmas corporativas fechadas com condições comerciais diferenciadas e fatura proforma, estou a transferir este chat diretamente para um consultor executivo da RACHI.", time: "15:12" },
          { sender: "system", text: "🚨 [Sistema]: Transbordo para Humano acionado via Live Chat do Site.", time: "15:13" },
          { sender: "customer", text: "Obrigado, aguardo o consultor.", time: "15:15" }
        ]
      },
      {
        id: 3,
        name: "Diretoria GundjaTech",
        company: "GundjaTech (Portal do Cliente)",
        channel: "portal",
        aiMode: "waiting_human",
        handoffReason: "Solicitou alteração de escopo no projeto ativo",
        phone: "+244 923 000 000",
        avatar: "GU",
        avatarBg: "bg-[#1e293b]",
        status: "online",
        unread: 1,
        lastTime: "14:50",
        subject: "Alteração de Escopo no Portal",
        messages: [
          { sender: "customer", text: "Boa tarde! Estou logado no portal e notei que precisamos adicionar o módulo de faturamento em multimoedas no projeto em andamento.", time: "14:45" },
          { sender: "bot", text: "Olá Diretoria GundjaTech! O assistente virtual registrou a sua solicitação. Como se trata de alteração de escopo em projeto ativo, transferi para o gestor técnico responsável.", time: "14:48" },
          { sender: "system", text: "🚨 [Sistema]: Transbordo para Humano acionado a partir do Portal do Cliente.", time: "14:49" }
        ]
      },
      {
        id: 4,
        name: "Cotech Contabilidade",
        company: "Cotech Contabilidade",
        channel: "livechat",
        aiMode: "ai_handling",
        handoffReason: null,
        phone: "+244 923 000 111",
        avatar: "CO",
        avatarBg: "bg-[#0b2246]",
        status: "online",
        unread: 0,
        lastTime: "14:15",
        subject: "Emissão de Guias no Portal",
        messages: [
          { sender: "customer", text: "Boa tarde, onde consigo emitir a segunda via do recibo do serviço?", time: "14:12" },
          { sender: "bot", text: "Boa tarde! Você pode emitir no Portal do Cliente acessando o menu 'Financeiro > Facturas & Recibos'. Deseja que eu gere o link direto para download?", time: "14:15" },
          { sender: "customer", text: "Já encontrei aqui, muito obrigado!", time: "14:16" }
        ]
      },
      {
        id: 5,
        name: "Visitante Comercial (Luanda)",
        company: "Lead do Site",
        channel: "whatsapp",
        aiMode: "ai_handling",
        handoffReason: null,
        phone: "+244 923 888 777",
        avatar: "VW",
        avatarBg: "bg-slate-600",
        status: "online",
        unread: 0,
        lastTime: "13:30",
        subject: "Informações sobre criação de Loja Virtual",
        messages: [
          { sender: "customer", text: "Olá! Quanto custa criar uma loja virtual com catálogo e pagamentos Multicaixa Express?", time: "13:28" },
          { sender: "bot", text: "Olá! A RACHI desenvolve e-commerces completos com integração de Multicaixa Express e gestão de estoque a partir de 180.000 Kz. Qual é o ramo de produtos da sua loja?", time: "13:30" }
        ]
      },
      {
        id: 6,
        name: "Laurinita Distribuidora",
        company: "Laurinita Distribuidora (Portal do Cliente)",
        channel: "portal",
        aiMode: "human_handling",
        handoffReason: "Atendimento assumido por Casimiro Gundja",
        phone: "+244 923 333 804",
        avatar: "LA",
        avatarBg: "bg-[#071326]",
        status: "online",
        unread: 0,
        lastTime: "12:40",
        subject: "Renovação de Domínio e Hospedagem",
        messages: [
          { sender: "customer", text: "Bom dia, o nosso domínio laurinita.co.ao vence no próximo mês.", time: "12:20" },
          { sender: "bot", text: "O domínio laurinita.co.ao está registrado sob gestão da RACHI. Transferindo para o consultor financeiro...", time: "12:22" },
          { sender: "system", text: "👤 [Sistema]: O consultor Casimiro Gundja assumiu o atendimento.", time: "12:25" },
          { sender: "agent", text: "Olá, Sr. Laurindo! Já emitimos a fatura proforma da renovação anual com 10% de desconto.", time: "12:35" },
          { sender: "customer", text: "Excelente, Casimiro! Pagamento efetuado via transferência bancária.", time: "12:40" }
        ]
      }
    ],
    get waitingHumanCount() {
      return (this.conversations || []).filter(c => c.aiMode === 'waiting_human').length;
    },
    playAdminAudioChime(type = 'incoming') {
      try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        if (ctx.state === 'suspended') ctx.resume();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain);
        gain.connect(ctx.destination);
        const now = ctx.currentTime;
        if (type === 'incoming') {
          osc.type = 'sine';
          osc.frequency.setValueAtTime(523.25, now); // C5
          osc.frequency.exponentialRampToValueAtTime(783.99, now + 0.12); // G5
          gain.gain.setValueAtTime(0.08, now);
          gain.gain.exponentialRampToValueAtTime(0.001, now + 0.22);
          osc.start(now);
          osc.stop(now + 0.22);
        } else if (type === 'alert') {
          osc.type = 'triangle';
          osc.frequency.setValueAtTime(440, now);
          osc.frequency.setValueAtTime(659.25, now + 0.08);
          osc.frequency.setValueAtTime(880, now + 0.16);
          gain.gain.setValueAtTime(0.12, now);
          gain.gain.exponentialRampToValueAtTime(0.001, now + 0.35);
          osc.start(now);
          osc.stop(now + 0.35);
        }
      } catch(e) {}
    },
    initLiveChatSync() {
      try {
        if (typeof BroadcastChannel !== 'undefined') {
          this.liveChatChannel = new BroadcastChannel('rachi_live_chat_channel');
          this.liveChatChannel.onmessage = (event) => {
            this.handleIncomingLiveChat(event.data);
          };
        }
      } catch(e) {}

      window.addEventListener('storage', (event) => {
        if (event.key === 'rachi_live_chat_sync' && event.newValue) {
          try {
            const data = JSON.parse(event.newValue);
            if (data) this.handleIncomingLiveChat(data);
          } catch(err) {}
        }
      });
    },
    handleIncomingLiveChat(data) {
      if (!data) return;
      const now = new Date();
      const time = data.time || (String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0'));

      if (data.type === 'visitor_message') {
        let conv = (this.conversations || []).find(c => c.id === data.sessionId || c.sessionId === data.sessionId);
        if (conv) {
          conv.messages.push({
            sender: 'customer',
            text: data.text,
            time: time
          });
          conv.lastTime = time;
          if (this.activeChatId !== conv.id) {
            conv.unread = (conv.unread || 0) + 1;
          }
        } else {
          conv = {
            id: data.sessionId || ('chat_' + Date.now()),
            sessionId: data.sessionId,
            name: data.name || (data.channel === 'portal' ? 'Cliente do Portal' : 'Visitante do Site'),
            company: data.channel === 'portal' ? 'Portal do Cliente' : (data.channel === 'whatsapp' ? 'WhatsApp Lead' : 'Website Oficial RACHI'),
            channel: data.channel || 'livechat',
            aiMode: 'ai_handling',
            handoffReason: null,
            phone: data.phone || '+244 972 888 585',
            avatar: (data.name || 'VS').substring(0, 2).toUpperCase(),
            avatarBg: data.channel === 'portal' ? 'bg-amber-600' : (data.channel === 'whatsapp' ? 'bg-emerald-600' : 'bg-blue-600'),
            status: 'online',
            unread: this.activeChatId === data.sessionId ? 0 : 1,
            lastTime: time,
            subject: 'Atendimento em Tempo Real',
            messages: [
              { sender: 'customer', text: data.text, time: time }
            ]
          };
          this.conversations.unshift(conv);
          this.messengerStats.today++;
          if (data.channel && this.messengerStats[data.channel] !== undefined) {
            this.messengerStats[data.channel]++;
          }
        }
        this.playAdminAudioChime('incoming');
        this.$nextTick(() => {
          const chatBox = document.getElementById('chatMessagesScroll');
          if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
          if (window.lucide) lucide.createIcons();
        });
      } else if (data.type === 'bot_message') {
        const conv = (this.conversations || []).find(c => c.id === data.sessionId || c.sessionId === data.sessionId);
        if (conv) {
          conv.messages.push({
            sender: 'bot',
            text: data.replyText,
            time: time
          });
          conv.lastTime = time;
          this.$nextTick(() => {
            const chatBox = document.getElementById('chatMessagesScroll');
            if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            if (window.lucide) lucide.createIcons();
          });
        }
      } else if (data.type === 'bot_transbordo') {
        const conv = (this.conversations || []).find(c => c.id === data.sessionId || c.sessionId === data.sessionId);
        if (conv) {
          if (data.replyText) {
            conv.messages.push({
              sender: 'bot',
              text: data.replyText,
              time: time
            });
          }
          conv.messages.push({
            sender: 'system',
            text: '🚨 [Sistema]: Transbordo para Humano acionado. O cliente necessita de atendimento especializado.',
            time: time
          });
          conv.aiMode = 'waiting_human';
          conv.handoffReason = data.reason || 'Visitante solicitou atendimento humano';
          conv.lastTime = time;
          this.playAdminAudioChime('alert');
          this.showAlert('warning', '🚨 Transbordo Humano Acionado', 'A IA direcionou a conversa com ' + conv.name + ' para um atendente humano.');
          this.$nextTick(() => {
            const chatBox = document.getElementById('chatMessagesScroll');
            if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            if (window.lucide) lucide.createIcons();
          });
        }
      }
    },
    toggleChannel(channelKey) {
      if (this.aiAgent.channels[channelKey]) {
        this.aiAgent.channels[channelKey].active = !this.aiAgent.channels[channelKey].active;
        if (typeof showToast === 'function') {
          showToast(this.aiAgent.channels[channelKey].name + (this.aiAgent.channels[channelKey].active ? ' ativado com sucesso.' : ' pausado.'), 'info');
        }
      }
    },
    saveAiAgentSettings() {
      try {
        localStorage.setItem('rachi_ai_agent_settings', JSON.stringify(this.aiAgent));
      } catch(e) {}
      if (typeof showToast === 'function') {
        showToast('Diretrizes e configurações do Agente IA salvas com sucesso!', 'success');
      }
    },
    runAiAgentTest() {
      if (!this.aiAgent.testQuestion.trim()) return;
      this.aiAgent.testLoading = true;
      this.aiAgent.testAnswer = '';
      setTimeout(() => {
        const q = this.aiAgent.testQuestion.toLowerCase();
        if (q.includes('preço') || q.includes('custo') || q.includes('loja') || q.includes('site') || q.includes('quanto')) {
          this.aiAgent.testAnswer = 'Olá! A RACHI desenvolve lojas virtuais completas com integração de Multicaixa Express e gestão de estoque em tempo real a partir de 180.000 Kz. Qual é o ramo de produtos da sua loja para ajustarmos o orçamento?';
        } else if (q.includes('erp') || q.includes('sistema') || q.includes('software')) {
          this.aiAgent.testAnswer = 'Excelente! Os sistemas ERP da RACHI contam com módulos customizados para faturação certificada pela AGT, controle de compras, estoque e financeiro. Deseja agendar uma demonstração técnica com o nosso consultor executivo?';
        } else {
          this.aiAgent.testAnswer = 'Com certeza! A RACHI é especialista em transformação digital e soluções corporativas em Angola. Como podemos acelerar os resultados do seu negócio hoje?';
        }
        this.aiAgent.testLoading = false;
      }, 600);
    },
    assumeChat(conv) {
      if (!conv) return;
      conv.aiMode = 'human_handling';
      conv.handoffReason = 'Atendimento assumido pelo consultor';
      const now = new Date();
      const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
      conv.messages.push({
        sender: 'system',
        text: '👤 [Sistema]: Você assumiu este atendimento. A IA foi pausada para esta conversa.',
        time: time
      });
      const payload = {
        type: 'agent_takeover',
        sessionId: conv.sessionId || conv.id,
        agentName: 'Casimiro Gundja'
      };
      if (this.liveChatChannel) {
        this.liveChatChannel.postMessage(payload);
      }
      localStorage.setItem('rachi_live_chat_sync', JSON.stringify({ ...payload, _ts: Date.now() }));
      this.showAlert('success', 'Atendimento Assumido', 'Você assumiu a conversa com ' + conv.name + '. A IA está pausada.');
      this.$nextTick(() => {
        const chatBox = document.getElementById('chatMessagesScroll');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        if (window.lucide) lucide.createIcons();
      });
    },
    releaseChatToAi(conv) {
      if (!conv) return;
      conv.aiMode = 'ai_handling';
      conv.handoffReason = null;
      const now = new Date();
      const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
      conv.messages.push({
        sender: 'system',
        text: '🤖 [Sistema]: Atendimento devolvido ao assistente virtual de IA da RACHI.',
        time: time
      });
      const payload = {
        type: 'release_to_ai',
        sessionId: conv.sessionId || conv.id
      };
      if (this.liveChatChannel) {
        this.liveChatChannel.postMessage(payload);
      }
      localStorage.setItem('rachi_live_chat_sync', JSON.stringify({ ...payload, _ts: Date.now() }));
      this.showAlert('info', 'IA Reativada', 'O assistente virtual de IA voltou a responder automaticamente para ' + conv.name + '.');
      this.$nextTick(() => {
        const chatBox = document.getElementById('chatMessagesScroll');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        if (window.lucide) lucide.createIcons();
      });
    },
    get activeConversation() {
      return this.conversations.find(c => c.id === this.activeChatId) || this.conversations[0];
    },
    get filteredConversations() {
      let list = this.conversations || [];
      // Filtro por estado superior (Print 1: Todas, Abertas, Aguardando Humano, Encerradas)
      if (this.messengerFilter === 'open') {
        list = list.filter(c => c.status !== 'closed');
      } else if (this.messengerFilter === 'waiting_human') {
        list = list.filter(c => c.aiMode === 'waiting_human');
      } else if (this.messengerFilter === 'closed') {
        list = list.filter(c => c.status === 'closed');
      }

      // Filtro por canal (WhatsApp, Site, Portal)
      if (this.messengerChannelFilter && this.messengerChannelFilter !== 'all') {
        list = list.filter(c => c.channel === this.messengerChannelFilter);
      }
      if (this.messengerSearch) {
        const q = this.messengerSearch.toLowerCase();
        list = list.filter(c => c.name.toLowerCase().includes(q) || c.company.toLowerCase().includes(q) || (c.phone || '').includes(q));
      }
      return list;
    },
    get unreadMessengerCount() {
      return (this.conversations || []).reduce((acc, c) => acc + (c.unread || 0), 0);
    },
    selectConversation(c) {
      this.activeChatId = c.id;
      c.unread = 0;
      this.$nextTick(() => {
        const chatBox = document.getElementById('chatMessagesScroll');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        if (window.lucide) lucide.createIcons();
      });
    },
    sendChatMessage(openWa = false) {
      if (!this.chatReplyText || !this.chatReplyText.trim()) return;
      const conv = this.activeConversation;
      if (!conv) return;
      const msgText = this.chatReplyText.trim();
      const now = new Date();
      const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
      conv.messages.push({
        sender: 'agent',
        text: msgText,
        time: time
      });
      conv.lastTime = time;
      this.chatReplyText = '';

      const payload = {
        type: 'agent_message',
        sessionId: conv.sessionId || conv.id,
        text: msgText,
        agentName: 'Casimiro Gundja',
        time: time
      };
      if (this.liveChatChannel) {
        this.liveChatChannel.postMessage(payload);
      }
      localStorage.setItem('rachi_live_chat_sync', JSON.stringify({ ...payload, _ts: Date.now() }));

      this.$nextTick(() => {
        const chatBox = document.getElementById('chatMessagesScroll');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        if (window.lucide) lucide.createIcons();
      });

      if (openWa && conv.phone) {
        const cleanPhone = conv.phone.replace(/[^0-9]/g, '');
        const waUrl = 'https://wa.me/' + cleanPhone + '?text=' + encodeURIComponent(msgText);
        window.open(waUrl, '_blank');
        this.showAlert('success', 'WhatsApp Aberto', 'Mensagem registrada e transferida para o WhatsApp de ' + conv.name + '.');
      } else {
        this.showAlert('success', 'Mensagem Enviada', 'Resposta enviada com sucesso para ' + conv.name + ' via ' + (conv.channel === 'whatsapp' ? 'WhatsApp' : 'Live Chat') + '.');
      }
    },
    sendQuickReply(text) {
      this.chatReplyText = text;
      this.sendChatMessage();
    },
    convertChatToTicket() {
      const conv = this.activeConversation;
      if (!conv) return;
      this.showAlert('success', 'Ticket Criado', 'Conversa com ' + conv.name + ' convertida com sucesso em solicitação técnica.');
      this.setPage('solicitacoes');
    },
    simulateLiveVisitor(channel = 'livechat') {
      const now = new Date();
      const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
      const simId = 'sim_' + Date.now();
      const name = channel === 'whatsapp' ? 'Dr. Paulo Kassoma (WhatsApp)' : (channel === 'portal' ? 'Eng. Manuel Costa (Portal)' : 'Dra. Maria Fernandes (Website)');
      const company = channel === 'whatsapp' ? 'Kassoma Investimentos' : (channel === 'portal' ? 'Costa Construções' : 'Empresa Luanda Oil');
      const initialText = channel === 'whatsapp' 
        ? 'Olá! Vi os serviços da RACHI no WhatsApp e gostaria de uma proposta para 50 crachás e sistema de ponto.' 
        : (channel === 'portal' 
            ? 'Boa tarde! Gostaria de consultar o prazo da nossa fatura proforma nº 442.' 
            : 'Olá! A IA pode me informar como funciona a consultoria de transformação digital da RACHI?');

      const conv = {
        id: simId,
        sessionId: simId,
        name: name,
        company: company,
        channel: channel,
        aiMode: 'ai_handling',
        handoffReason: null,
        phone: '+244 923 888 ' + Math.floor(100 + Math.random() * 900),
        avatar: name.split(' ').map(n=>n[0]).slice(0,2).join(''),
        avatarBg: channel === 'whatsapp' ? 'bg-emerald-600' : (channel === 'portal' ? 'bg-amber-600' : 'bg-blue-600'),
        status: 'online',
        unread: 1,
        lastTime: time,
        subject: 'Demanda Comercial ' + (channel === 'whatsapp' ? 'WhatsApp' : (channel === 'portal' ? 'Portal' : 'Website')),
        messages: [
          { sender: 'customer', text: initialText, time: time }
        ]
      };
      this.conversations.unshift(conv);
      this.activeChatId = conv.id;
      this.messengerStats.today++;
      if (this.messengerStats[channel] !== undefined) this.messengerStats[channel]++;
      this.playAdminAudioChime('incoming');
      this.showAlert('info', 'Nova Conversa Ao Vivo', `Nova conversa iniciada por ${name} via ${channel.toUpperCase()}.`);

      // A IA responde automaticamente após 1.5s
      setTimeout(() => {
        const replyTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        conv.messages.push({
          sender: 'bot',
          text: `Olá ${name.split(' ')[0]}! Prazer em atendê-lo(a). A RACHI possui soluções completas e modulares para a sua empresa. Como se trata de um projeto que envolve personalização e prazos executivos, gostaria de falar diretamente com um consultor humano para receber a proposta formal?`,
          time: replyTime
        });
        conv.lastTime = replyTime;
        this.playAdminAudioChime('incoming');
        this.$nextTick(() => {
          const chatBox = document.getElementById('chatMessagesScroll');
          if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
          if (window.lucide) lucide.createIcons();
        });

        // Cliente pede humano após mais 2.5s -> dispara transbordo
        setTimeout(() => {
          const handoffTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
          conv.messages.push({
            sender: 'customer',
            text: 'Sim, por favor! Gostaria de falar com o consultor humano agora para fecharmos a proposta.',
            time: handoffTime
          });
          conv.messages.push({
            sender: 'system',
            text: '🚨 [Sistema]: Transbordo para Humano acionado! O cliente solicitou atendimento humano. Clique em "Assumir Atendimento" acima para responder ao vivo.',
            time: handoffTime
          });
          conv.aiMode = 'waiting_human';
          conv.handoffReason = 'Cliente solicitou falar com consultor humano';
          conv.lastTime = handoffTime;
          this.playAdminAudioChime('alert');
          this.showAlert('warning', '🚨 Transbordo Acionado!', `${name} está aguardando você assumir o atendimento!`);
          this.$nextTick(() => {
            const chatBox = document.getElementById('chatMessagesScroll');
            if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            if (window.lucide) lucide.createIcons();
          });
        }, 2800);
      }, 1600);
    },
    simulateIncomingMessage() {
      const conv = this.activeConversation;
      if (!conv) return;
      const now = new Date();
      const time = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
      conv.messages.push({
        sender: 'customer',
        text: 'Entendido! Obrigado pela rápida resposta da equipe RACHI.',
        time: time
      });
      conv.lastTime = time;
      this.$nextTick(() => {
        const chatBox = document.getElementById('chatMessagesScroll');
        if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        if (window.lucide) lucide.createIcons();
      });
    },
    sidebarCollapsed: false,
    mobileMenuOpen: false,
    selectedRequest: null,
    // Tema padrão é 'light' (Branco/Claro elegante)
    theme: localStorage.getItem('rachi_admin_theme') || 'light',
    openMenus: { academy: false, loja: false, rh: false, grafica: false },
    adminUser: {
      nome: "Super Administrador RACHI",
      email: "admin@rachi.ao",
      initials: 'SA'
    },
    academyEnrollments: [{"id":9,"aluno_id":11,"user_id":20,"nome":"Aluno Teste","email":"aluno@rachi.ao","telefone":"1232342343","curso":"Forma\u00e7\u00e3o RACHI","curso_slug":"","curso_id":1,"status":"active","data":"25\/09\/2026 21:47","codigo":"RAC-00009"}],
    coursesList: [{"id":15,"name":"Curso Especializado: Engenharia Social Institucional","slug":"engenharia-social-institucional"}],
    users: [
      { id: 21, name: "Casimiro Gundja", nome: "Casimiro Gundja", email: "casimirogundja@outlook.com", phone: "+244 923 000 000", telefone: "+244 923 000 000", empresa: "Diretoria Executiva", tipo: "Super Admin", role: "Super Admin", role_id: 1, role_slug: "super_admin", tc: "bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "24/11/2026 18:00", mod: ["Todos os Módulos"], av: "bg-gradient-to-br from-amber-500 to-amber-700", ini: "CG", created_at: "20/11/2026", data: "20/11/2026" },
      { id: 1, name: "Super Administrador RACHI", nome: "Super Administrador RACHI", email: "admin@rachi.ao", phone: "+244 923 000 000", telefone: "+244 923 000 000", empresa: "Diretoria Geral", tipo: "Super Admin", role: "Super Admin", role_id: 1, role_slug: "super_admin", tc: "bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "24/11/2026 19:44", mod: ["Todos os Módulos"], av: "bg-gradient-to-br from-amber-500 to-amber-700", ini: "SA", created_at: "20/11/2026", data: "20/11/2026" },
      { id: 22, name: "Dr. António Silva", nome: "Dr. António Silva", email: "antonio.silva@bancoteste.ao", phone: "+244 972 888 585", telefone: "+244 972 888 585", empresa: "Banco de Fomento Angola", tipo: "Administrador", role: "Administrador", role_id: 2, role_slug: "admin", tc: "bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "24/11/2026 14:20", mod: ["Todos os Módulos"], av: "bg-gradient-to-br from-blue-600 to-indigo-700", ini: "AS", created_at: "20/11/2026", data: "20/11/2026" },
      { id: 26, name: "Gestão Operacional RACHI", nome: "Gestão Operacional RACHI", email: "gestao@rachi.ao", phone: "+244 912 000 111", telefone: "+244 912 000 111", empresa: "Operações Luanda", tipo: "Administrador", role: "Administrador", role_id: 2, role_slug: "admin", tc: "bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "24/11/2026 11:30", mod: ["Todos os Módulos"], av: "bg-gradient-to-br from-blue-600 to-indigo-700", ini: "GO", created_at: "20/11/2026", data: "20/11/2026" },
      { id: 27, name: "Especialista Suporte & Design", nome: "Especialista Suporte & Design", email: "suporte@rachi.ao", phone: "+244 923 444 555", telefone: "+244 923 444 555", empresa: "Suporte Técnico RACHI", tipo: "Equipe Operacional", role: "Equipe Operacional", role_id: 4, role_slug: "employee", tc: "bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 16:00", mod: ["Tec", "Print"], av: "bg-gradient-to-br from-purple-600 to-indigo-700", ini: "ES", created_at: "21/11/2026", data: "21/11/2026" },
      { id: 28, name: "GundjaTech", nome: "GundjaTech", email: "admin@gundjatech.com", phone: "19953248420", telefone: "19953248420", empresa: "Diretoria GundjaTech", tipo: "Cliente", role: "Cliente", role_id: 6, role_slug: "customer", tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 10:15", mod: ["Portal Cliente"], av: "bg-gradient-to-br from-slate-700 to-slate-900", ini: "GU", created_at: "23/11/2026", data: "23/11/2026" },
      { id: 29, name: "Cotech Contabilidade", nome: "Cotech Contabilidade", email: "comercial@cotechcontabilidade.com.br", phone: "+244 923 000 111", telefone: "+244 923 000 111", empresa: "Cotech Contabilidade", tipo: "Cliente", role: "Cliente", role_id: 6, role_slug: "customer", tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 11:40", mod: ["Portal Cliente"], av: "bg-gradient-to-br from-slate-700 to-slate-900", ini: "CO", created_at: "23/11/2026", data: "23/11/2026" },
      { id: 30, name: "Rachi Tech", nome: "Rachi Tech", email: "rachitecnologia@gmail.com", phone: "+244 923 888 777", telefone: "+244 923 888 777", empresa: "Rodrigues Lussiate", tipo: "Cliente", role: "Cliente", role_id: 6, role_slug: "customer", tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 12:00", mod: ["Portal Cliente"], av: "bg-gradient-to-br from-slate-700 to-slate-900", ini: "RA", created_at: "23/11/2026", data: "23/11/2026" },
      { id: 31, name: "Laurinita Distribuidora Ltda", nome: "Laurinita Distribuidora Ltda", email: "te@gmail.com", phone: "+244923333804", telefone: "+244923333804", empresa: "Laurindo Augusto Cakoyi", tipo: "Cliente", role: "Cliente", role_id: 6, role_slug: "customer", tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 14:10", mod: ["Portal Cliente"], av: "bg-gradient-to-br from-slate-700 to-slate-900", ini: "LA", created_at: "23/11/2026", data: "23/11/2026" },
      { id: 32, name: "INSTITUTO TÉCNICO PRIVADO DE S...", nome: "INSTITUTO TÉCNICO PRIVADO DE S...", email: "eftsparaisodosaber@gmail.com", phone: "+244 930 133 850", telefone: "+244 930 133 850", empresa: "Laurindo Augusto Cakoyi", tipo: "Cliente", role: "Cliente", role_id: 6, role_slug: "customer", tc: "bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300", status: "Ativo", statusLabel: "Ativo", raw_status: "active", sk: "ativo", is_deleted: false, deleted_at: null, ua: "23/11/2026 15:30", mod: ["Portal Cliente"], av: "bg-gradient-to-br from-slate-700 to-slate-900", ini: "IN", created_at: "23/11/2026", data: "23/11/2026" }
    ],
    rolesList: [{"id":1,"name":"Super Administrador","slug":"super_admin","description":"Acesso irrestrito a todo o sistema e configura\u00e7\u00f5es"},{"id":2,"name":"Administrador","slug":"admin","description":"Gest\u00e3o geral da plataforma e relat\u00f3rios"},{"id":3,"name":"Gestor de Unidade","slug":"manager","description":"Gest\u00e3o operacional de uma unidade de neg\u00f3cio"},{"id":4,"name":"Funcion\u00e1rio \/ T\u00e9cnico","slug":"employee","description":"Atendimento, execu\u00e7\u00e3o de servi\u00e7os e pedidos"},{"id":5,"name":"Atendente","slug":"attendant","description":"Triagem e primeiro contacto com clientes"},{"id":6,"name":"Cliente","slug":"customer","description":"Acesso ao portal de autoatendimento e pedidos"},{"id":7,"name":"Aluno","slug":"student","description":"Acesso aos cursos da RACHI Academy"},{"id":8,"name":"Instrutor Academy","slug":"instructor","description":"Gest\u00e3o de cursos, m\u00f3dulos e turmas"},{"id":9,"name":"Especialista RH","slug":"rh_specialist","description":"Recrutamento, vagas e candidatos"}],
    clients: [
      {"id":16,"nome":"Empresa Teste Luanda Lda","email":"financeiro@empresa-teste.ao","tipo":"Empresa","contato":"Diretoria Financeira","tel":"923999888","tr":1,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Oct/2026","ini":"ET"},
      {"id":15,"nome":"Silva & Filhos Lda","email":"antonio.teste@empresa.ao","tipo":"Empresa","contato":"António Silva","tel":"923000111","tr":1,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Oct/2026","ini":"SF"},
      {"id":14,"nome":"gundja","email":"casimirogundja@outlook.com","tipo":"Empresa","contato":"Casimiro Gundja","tel":"1293797234927","tr":2,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Oct/2026","ini":"GU"},
      {"id":13,"nome":"Banco de Fomento Angola","email":"antonio.silva@bfa.ao","tipo":"Empresa","contato":"Dr. António Silva","tel":"+244 923 111 222","tr":1,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Oct/2026","ini":"BF"},
      {"id":12,"nome":"Banco de Fomento Angola Teste","email":"antonio.silva@bancoteste.ao","tipo":"Empresa","contato":"Dr. António Silva","tel":"+244 972 888 585","tr":1,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Oct/2026","ini":"BF"},
      {"id":11,"nome":"Aluno Teste","email":"aluno@rachi.ao","tipo":"Particular","contato":"Aluno Particular","tel":"1232342343","tr":0,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Sep/2026","ini":"AT"},
      {"id":10,"nome":"Gundja","email":"","tipo":"Empresa","contato":"Administração","tel":"12342342342","tr":1,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Sep/2026","ini":"GU"},
      {"id":9,"nome":"Super Administrador RACHI","email":"admin@rachi.ao","tipo":"Empresa","contato":"Diretoria Geral","tel":"+244 923 000 000","tr":10,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Sep/2026","ini":"SR"},
      {"id":1,"nome":"Inov Quimua Consultoria Lda","email":"cliente@empresa.ao","tipo":"Empresa","contato":"Dr. Quimua","tel":"+244 912 345 678","tr":0,"status":"Ativo","categoria":"ATIVO","portal":"Portal Ativo","sk":"ativo","desde":"Sep/2026","ini":"IQ"}
    ],
    clientSearch: '',
    clientFilterTab: 'todos',
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
    showCreateOrderModal: false,
    newOrder: { business_unit_id: 1, title: '', customer_name: '', customer_email: '', customer_phone: '', priority: 'normal', description: '', isSubmitting: false },
    showCreateJobModal: false,
    newJob: { cargo: '', empresa: 'RACHI Human Capital', local: 'Luanda', mod: 'Presencial', sal: '', prazo: '30 dias', req: '', isSubmitting: false },
    showCreateProductModal: false,
    newProduct: { nome: '', sku: '', cat: 'Hardware & Equipamentos', preco: '', est: 10, min_est: 3, marca: 'RACHI Tec', isSubmitting: false },
    showCreatePrintModal: false,
    newPrint: { nome: '', mat: 'Couché 300g Laminação Fosca', tam: '90x50mm', qtm: 100, preco: '', prazo: '3 dias úteis', desc: '', isSubmitting: false },
    showCreateCourseModal: false,
    newCourse: { nome: '', cat: 'Tecnologia & TI', dur: 40, level: 'intermediate', preco: '', prof: 'Corpo Docente RACHI', modulos: 4, desc: '', isSubmitting: false },
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

    
    userTab: 'todos',
    get userStatsPrint4() {
      const all = this.users || [];
      const active = all.filter(u => !u.is_deleted);
      return {
        superAdmins: active.filter(u => u.role_slug === 'super_admin' || (u.tipo && u.tipo.includes('Master')) || u.id === 1 || u.id === 21).length,
        admins: active.filter(u => (u.role_slug === 'admin' || (u.tipo && u.tipo === 'Administrador')) && u.id !== 1 && u.id !== 21).length,
        staff: active.filter(u => ['employee', 'instructor', 'rh_specialist', 'attendant'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Funcionário') || u.tipo.includes('Instrutor') || u.tipo.includes('Especialista') || u.tipo.includes('Operacional')))).length,
        clients: active.filter(u => ['customer', 'student'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Aluno') || u.tipo.includes('Cliente')))).length,
        inativos: all.filter(u => u.is_deleted || u.status === 'Bloqueado' || u.status === 'Inativo').length
      };
    },
    get filteredUsersPrint4() {
      let list = this.users || [];
      if (this.userTab === 'equipe') {
        list = list.filter(u => !u.is_deleted && (['super_admin', 'admin', 'manager', 'employee', 'instructor', 'rh_specialist', 'attendant'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Admin') || u.tipo.includes('Funcionário') || u.tipo.includes('Especialista') || u.tipo.includes('Operacional')))));
      } else if (this.userTab === 'clientes') {
        list = list.filter(u => !u.is_deleted && (['customer', 'student'].includes(u.role_slug) || (u.tipo && (u.tipo.includes('Cliente') || u.tipo.includes('Aluno')))));
      } else if (this.userTab === 'inativos') {
        list = list.filter(u => u.is_deleted || u.status === 'Bloqueado' || u.status === 'Inativo');
      }
      if (this.userFilterRole && this.userFilterRole !== 'all') {
        list = list.filter(u => u.role_slug === this.userFilterRole || (u.tipo && u.tipo.toLowerCase().includes(this.userFilterRole.toLowerCase())));
      }
      if (this.userSearch && this.userSearch.trim()) {
        const q = this.userSearch.toLowerCase().trim();
        list = list.filter(u =>
          (u.nome && u.nome.toLowerCase().includes(q)) ||
          (u.email && u.email.toLowerCase().includes(q)) ||
          (u.telefone && u.telefone.toLowerCase().includes(q)) ||
          (u.tipo && u.tipo.toLowerCase().includes(q)) ||
          (u.empresa && u.empresa.toLowerCase().includes(q))
        );
      }
      return list;
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

    get clientStats() {
      const list = this.clients || [];
      return {
        total: list.length,
        ativos: list.filter(c => c.status === 'Ativo' || c.categoria === 'ATIVO').length,
        empresas: list.filter(c => c.tipo === 'Empresa').length,
        leads: list.filter(c => c.status === 'Lead' || c.categoria === 'LEAD' || c.tipo === 'Particular').length
      };
    },

    get filteredClients() {
      let list = this.clients || [];
      if (this.clientFilterTab === 'ativos') {
        list = list.filter(c => c.status === 'Ativo' || c.categoria === 'ATIVO');
      } else if (this.clientFilterTab === 'empresas') {
        list = list.filter(c => c.tipo === 'Empresa');
      } else if (this.clientFilterTab === 'leads') {
        list = list.filter(c => c.status === 'Lead' || c.categoria === 'LEAD' || c.tipo === 'Particular');
      }
      if (this.clientSearch && this.clientSearch.trim()) {
        const q = this.clientSearch.toLowerCase().trim();
        list = list.filter(c => 
          (c.nome && c.nome.toLowerCase().includes(q)) ||
          (c.email && c.email.toLowerCase().includes(q)) ||
          (c.tel && c.tel.toLowerCase().includes(q)) ||
          (c.tipo && c.tipo.toLowerCase().includes(q)) ||
          (c.contato && c.contato.toLowerCase().includes(q))
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
          this.showAlert('error', 'Falha ao Eliminar', data.message || 'Não foi possível excluir a matrícula.');
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

    openCreateUserModalWithRole(slug) {
      const role = (this.rolesList || []).find(r => r.slug === slug);
      this.userForm = {
        id: null,
        nome: '',
        email: '',
        telefone: '',
        role_id: role ? role.id : (this.rolesList && this.rolesList[0] ? this.rolesList[0].id : 1),
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
            icon: '✏️',
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
            icon: '🛡️',
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
            icon: '🛡️',
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
        this.showAlert('warning', 'Ação Bloqueada', 'Não é permitido eliminar o Administrador Master do sistema.');
        return;
      }
      this.userToDelete = u;
      this.showDeleteUserModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async executeDeleteUser() {
      if (!this.userToDelete) return;
      const userName = this.userToDelete.nome;
      const targetId = Number(this.userToDelete.id);
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch(`/admin/users/${targetId}/delete`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token || ''
          }
        });
        const data = await res.json();
        if (data.success) {
          this.users = (this.users || []).filter(x => Number(x.id) !== targetId);
          this.showDeleteUserModal = false;
          this.userToDelete = null;
          this.notifs.unshift({
            icon: '🗑️',
            ib: 'bg-rose-50 text-rose-600',
            titulo: 'Utilizador Excluído',
            msg: data.message,
            data: 'Agora mesmo',
            lida: false
          });
          this.showAlert('success', 'Utilizador Excluído', data.message || `O utilizador ${userName} foi excluído com sucesso!`);
          await this.refreshUsers(false);
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Falha ao Eliminar', data.message || 'Não foi possível eliminar o utilizador.');
        }
      } catch (err) {
        console.error(err);
        this.showAlert('error', 'Erro de Conexão', 'Erro ao eliminar utilizador.');
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

    getClientInitials(c) {
      if (c.ini) return c.ini;
      if (!c.nome) return 'CL';
      const parts = c.nome.trim().split(/\s+/).filter(Boolean);
      if (parts.length >= 2) {
        return (parts[0][0] + parts[1][0]).toUpperCase();
      }
      return c.nome.slice(0, 2).toUpperCase();
    },

    openSendAccessModal(c) {
      const matched = (this.users || []).find(u => (c.email && u.email === c.email) || u.id === c.id);
      const userObj = matched || {
        id: c.id,
        nome: c.nome,
        email: c.email || 'cliente@rachi.ao',
        telefone: c.tel || '',
        role_slug: 'customer'
      };
      this.openResetPasswordModal(userObj);
    },

    toggleClientCategory(c) {
      const isLead = (c.categoria === 'LEAD' || c.status === 'Lead');
      c.categoria = isLead ? 'ATIVO' : 'LEAD';
      c.status = isLead ? 'Ativo' : 'Lead';
      c.sk = isLead ? 'ativo' : 'lead';
      this.showAlert('info', 'Categoria Atualizada', `${c.nome} foi movido para ${c.categoria}.`);
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    openEditClientModal(c) {
      const matched = (this.users || []).find(u => (c.email && u.email === c.email) || u.id === c.id);
      const userObj = matched || {
        id: c.id,
        nome: c.nome,
        email: c.email,
        telefone: c.tel || '',
        tipo: c.tipo || 'Cliente',
        role_slug: 'customer',
        role_id: 6,
        status: c.status || 'Ativo',
        raw_status: 'active'
      };
      this.openEditUserModal(userObj);
    },

    deleteClient(c) {
      const matched = (this.users || []).find(u => (c.email && u.email === c.email) || u.id === c.id);
      const userObj = matched || {
        id: c.id,
        nome: c.nome,
        email: c.email
      };
      this.confirmDeleteUser(userObj);
    },

    get pageTitle() {
      const m = {
        'dashboard': 'Visão Geral',
        'usuarios': 'Equipe, Colaboradores & Usuários',
        'clientes': 'Base de Clientes',
        'solicitacoes': 'Gestão de Solicitações & Pipeline de Entrada',
        'servicos': 'Catálogo de Serviços',
        'academy-cursos': 'RACHI Academy — Cursos',
        'academy-alunos': 'RACHI Academy — Alunos',
        'academy-matriculas': 'RACHI Academy — Matrículas',
        'loja-produtos': 'RACHI Store — Produtos',
        'loja-pedidos': 'RACHI Store — Pedidos',
        'loja-estoque': 'RACHI Store — Stock',
        'rh-solicitacoes': 'Human Capital — Solicitações',
        'rh-vagas': 'Human Capital — Vagas',
        'rh-candidatos': 'Human Capital — Candidatos',
        'grafica-produtos': 'RACHI Print — Produtos',
        'grafica-orcamentos': 'RACHI Print — Orçamentos',
        'financeiro': 'Gestão Financeira & Faturamento',
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
      if (this.sidebarCollapsed) {
        this.sidebarCollapsed = false;
      }
      const willOpen = !this.openMenus[m];
      // Modo Acordeão: fecha todas as outras unidades para não extrapolar a tela
      Object.keys(this.openMenus).forEach(k => {
        this.openMenus[k] = false;
      });
      if (willOpen) {
        this.openMenus[m] = true;
      }
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
        const printResponse = await fetch('/admin/print/requests', {
          headers: { 'Accept': 'application/json' }, credentials: 'same-origin'
        });
        if (!printResponse.ok) throw new Error('Falha ao carregar solicitações Print.');
        this.printRequests = (await printResponse.json()).requests || [];
        const capitalResponse = await fetch('/admin/capital/requests', {
          headers: { 'Accept': 'application/json' }, credentials: 'same-origin'
        });
        if (!capitalResponse.ok) throw new Error('Falha ao carregar solicitações Human Capital.');
        this.capitalRequests = (await capitalResponse.json()).requests || [];
        const tecResponse = await fetch('/admin/tec/requests', {
          headers: { 'Accept': 'application/json' }, credentials: 'same-origin'
        });
        if (tecResponse.ok) {
          this.tecRequests = (await tecResponse.json()).requests || [];
        }
        const ordersResponse = await fetch('/admin/tec/orders', {
          headers: { 'Accept': 'application/json' }, credentials: 'same-origin'
        });
        if (ordersResponse.ok) {
          const ordersData = await ordersResponse.json();
          if (ordersData.orders) {
            this.tecOrders = ordersData.orders;
          }
        }
        if (this.selectedRequest) {
          this.selectedRequest = [...this.allRequests, ...this.printRequests, ...this.capitalRequests, ...this.tecRequests].find(item => item.id === this.selectedRequest.id) || this.selectedRequest;
        }
        if (showToast) this.showAlert('success', 'Solicitações atualizadas', 'As conversas e pedidos foram sincronizados.');
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
      req.status_key = s.key;
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
        const res = await fetch(`/admin/solicitacoes/${req.id}/status`, {
          method: 'POST',
          credentials: 'same-origin',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ status: s.label, comment: 'Status alterado para "' + s.label + '" pelo administrador.' })
        });
        const data = await res.json();
        if (data && data.success && data.request) {
          const idx = this.allRequests.findIndex(r => r.id === req.id);
          if (idx !== -1) {
            this.allRequests[idx] = data.request;
          }
          if (this.selectedRequest && this.selectedRequest.id === req.id) {
            this.selectedRequest = data.request;
          }
        }

        if (typeof BroadcastChannel !== 'undefined') {
          const bc = new BroadcastChannel('rachi_request_channel');
          bc.postMessage({ type: 'status_updated', requestId: req.id, status: s.label, timestamp: Date.now() });
          bc.close();
        }
      } catch(e) {
        console.error('Falha ao persistir status:', e);
      }
    },

    async logout() {
      if (window.RachiSession) {
        await window.RachiSession.logout();
        return;
      }
      try {
        await fetch('/logout', { method: 'POST', headers: { 'Accept': 'application/json' } });
      } catch(e) {}
      window.location.href = '/login';
    },

    init() {
      this.applyTheme();
      this.$watch('sidebarCollapsed', () => {
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      });
      this.$watch('clientFilterTab', () => {
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      });
      this.$watch('clientSearch', () => {
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      });
      this.allRequests = [{"id":14,"protocol":"TEC-2026-000014","business_unit_id":1,"title":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","titulo":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","cliente":"Silva \u0026 Filhos Lda","empresa":"Silva \u0026 Filhos Lda","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital: \ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","description":"\ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","data":"12\/10\/2026 03:01","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 03:01","date":"12\/10\/2026 03:01","desc":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","title":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","dot":"bg-indigo-500"}],"messages":[]},{"id":13,"protocol":"SOL-2026-000013","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","cliente":"gundja","empresa":"gundja","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED: \ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","description":"\ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","data":"12\/10\/2026 02:06","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 02:06","date":"12\/10\/2026 02:06","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","dot":"bg-indigo-500"}],"messages":[]},{"id":12,"protocol":"SOL-2026-000012","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","cliente":"Banco de Fomento Angola","empresa":"Banco de Fomento Angola","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm): \ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","description":"\ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","data":"11\/10\/2026 23:23","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 23:23","date":"11\/10\/2026 23:23","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","dot":"bg-indigo-500"}],"messages":[]},{"id":11,"protocol":"SOL-2026-000011","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","cliente":"Banco de Fomento Angola Teste","empresa":"Banco de Fomento Angola Teste","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio: \ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","description":"\ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","data":"11\/10\/2026 20:47","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 20:47","date":"11\/10\/2026 20:47","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","dot":"bg-indigo-500"}],"messages":[]},{"id":10,"protocol":"SOL-2026-000010","business_unit_id":1,"title":"solici","titulo":"solici","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"solici: solici","description":"solici","data":"23\/09\/2026 03:48","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 02:48","date":"23\/09\/2026 02:48","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","dot":"bg-indigo-500"}],"messages":[{"id":11,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false},{"id":12,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false}]},{"id":9,"protocol":"SOL-2026-000009","business_unit_id":1,"title":"Teste teste","titulo":"Teste teste","cliente":"Gundja","empresa":"Gundja","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Teste teste: Testetetetetetetet Descri\u00e7\u00e3o","description":"Testetetetetetetet Descri\u00e7\u00e3o","data":"23\/09\/2026 03:35","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 03:38","date":"23\/09\/2026 03:38","desc":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","title":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","dot":"bg-amber-500"},{"data":"23\/09\/2026 02:35","date":"23\/09\/2026 02:35","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","dot":"bg-amber-500"}],"messages":[{"id":10,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Resposta teste","text":"Resposta teste","data":"23\/09\/2026 03:37","is_staff":true,"fromUser":false}]},{"id":7,"protocol":"SOL-2026-000007","business_unit_id":2,"title":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","titulo":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC: Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","description":"Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","data":"21\/09\/2026 10:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"21\/09\/2026 12:00","date":"21\/09\/2026 12:00","desc":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","title":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","dot":"bg-amber-500"}],"messages":[]},{"id":4,"protocol":"SOL-2026-000004","business_unit_id":3,"title":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados","titulo":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Academy","unit":"RACHI Academy","unitBadge":"bg-indigo-500\/15 text-indigo-700 border-indigo-200","descricao":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados: Solicita\u00e7\u00e3o de turma corporativa in-company para 15 gestores da \u00e1rea de infraestrutura de TI.","description":"Solicita\u00e7\u00e3o de turma corporativa in-company para 15 gestores da \u00e1rea de infraestrutura de TI.","data":"21\/09\/2026 08:30","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"High","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"21\/09\/2026 08:30","date":"21\/09\/2026 08:30","desc":"Solicita\u00e7\u00e3o Aberta (#SOL-2026-000004)","title":"Solicita\u00e7\u00e3o Aberta (#SOL-2026-000004)","dot":"bg-indigo-500"}],"messages":[{"id":7,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Gostar\u00edamos de saber a disponibilidade de instrutores para in\u00edcio na primeira quinzena de outubro.","text":"Gostar\u00edamos de saber a disponibilidade de instrutores para in\u00edcio na primeira quinzena de outubro.","data":"21\/09\/2026 08:35","is_staff":false,"fromUser":true}]},{"id":1,"protocol":"SOL-2026-000001","business_unit_id":1,"title":"Desenvolvimento de Novo Website Institucional \u0026 Portal","titulo":"Desenvolvimento de Novo Website Institucional \u0026 Portal","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Desenvolvimento de Novo Website Institucional \u0026 Portal: Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","description":"Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","data":"19\/09\/2026 09:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"High","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"19\/09\/2026 11:00","date":"19\/09\/2026 11:00","desc":"Em An\u00e1lise de Requisitos e Arquitetura","title":"Em An\u00e1lise de Requisitos e Arquitetura","dot":"bg-amber-500"},{"data":"19\/09\/2026 10:30","date":"19\/09\/2026 10:30","desc":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","title":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","dot":"bg-amber-500"},{"data":"19\/09\/2026 09:15","date":"19\/09\/2026 09:15","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","dot":"bg-amber-500"}],"messages":[{"id":1,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","text":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","data":"19\/09\/2026 11:15","is_staff":false,"fromUser":true},{"id":2,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","text":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","data":"19\/09\/2026 11:45","is_staff":true,"fromUser":false},{"id":6,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Mensagem de teste do cliente via API","text":"Mensagem de teste do cliente via API","data":"23\/09\/2026 02:49","is_staff":false,"fromUser":true}]},{"id":5,"protocol":"SOL-2026-000005","business_unit_id":1,"title":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","titulo":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral: Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","description":"Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","data":"18\/09\/2026 14:00","status":"Or\u00e7amentada","statusLabel":"Or\u00e7amentada","status_key":"quoted","priority":"Normal","sc":"s-analise","dot":"bg-blue-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 10:00","date":"20\/09\/2026 10:00","desc":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","title":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","dot":"bg-blue-500"},{"data":"18\/09\/2026 14:00","date":"18\/09\/2026 14:00","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","dot":"bg-blue-500"}],"messages":[]},{"id":6,"protocol":"SOL-2026-000006","business_unit_id":4,"title":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","titulo":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software: Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","description":"Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","data":"17\/09\/2026 16:20","status":"Aguardando Cliente","statusLabel":"Aguardando Cliente","status_key":"waiting_customer","priority":"High","sc":"s-wait","dot":"bg-orange-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","title":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","title":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"21\/09\/2026 11:00","date":"21\/09\/2026 11:00","desc":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","title":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","dot":"bg-orange-500"}],"messages":[]},{"id":2,"protocol":"SOL-2026-000002","business_unit_id":2,"title":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","titulo":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos: Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","description":"Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","data":"16\/09\/2026 14:00","status":"Em execu\u00e7\u00e3o","statusLabel":"Em execu\u00e7\u00e3o","status_key":"in_progress","priority":"Normal","sc":"s-exec","dot":"bg-cyan-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 16:30","date":"20\/09\/2026 16:30","desc":"Em Fase de Acabamento \u0026 Corte","title":"Em Fase de Acabamento \u0026 Corte","dot":"bg-cyan-500"},{"data":"17\/09\/2026 11:20","date":"17\/09\/2026 11:20","desc":"Prova de Cor e Impress\u00e3o Aprovada","title":"Prova de Cor e Impress\u00e3o Aprovada","dot":"bg-cyan-500"},{"data":"16\/09\/2026 14:00","date":"16\/09\/2026 14:00","desc":"Ordem de Produ\u00e7\u00e3o Iniciada","title":"Ordem de Produ\u00e7\u00e3o Iniciada","dot":"bg-cyan-500"}],"messages":[{"id":3,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"A prova digital ficou excelente, autorizamos a tiragem completa.","text":"A prova digital ficou excelente, autorizamos a tiragem completa.","data":"16\/09\/2026 15:30","is_staff":false,"fromUser":true},{"id":4,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","text":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","data":"16\/09\/2026 16:00","is_staff":true,"fromUser":false}]},{"id":8,"protocol":"SOL-2026-000008","business_unit_id":1,"title":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","titulo":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia: Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","description":"Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","data":"10\/09\/2026 11:00","status":"Cancelada","statusLabel":"Cancelada","status_key":"cancelled","priority":"Low","sc":"s-cancel","dot":"bg-rose-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/09\/2026 14:00","date":"12\/09\/2026 14:00","desc":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","title":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","dot":"bg-rose-500"}],"messages":[{"id":8,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Ola","text":"Ola","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false},{"id":9,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Bom dia","text":"Bom dia","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false}]},{"id":3,"protocol":"SOL-2026-000003","business_unit_id":4,"title":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","titulo":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios: Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","description":"Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","data":"05\/09\/2026 10:00","status":"Conclu\u00edda","statusLabel":"Conclu\u00edda","status_key":"completed","priority":"Normal","sc":"s-done","dot":"bg-emerald-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"18\/09\/2026 17:00","date":"18\/09\/2026 17:00","desc":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","title":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","dot":"bg-emerald-500"},{"data":"12\/09\/2026 15:00","date":"12\/09\/2026 15:00","desc":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","title":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","dot":"bg-emerald-500"},{"data":"05\/09\/2026 10:00","date":"05\/09\/2026 10:00","desc":"Contrato de Consultoria Ativado","title":"Contrato de Consultoria Ativado","dot":"bg-emerald-500"}],"messages":[{"id":5,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","text":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","data":"18\/09\/2026 17:30","is_staff":true,"fromUser":false}]}];
      this.refreshAdminRequests();
      window.setInterval(() => this.refreshAdminRequests(), 5000);
      this.initLiveChatSync();

      // Sincronização em tempo real de solicitações & chat
      try {
        if (typeof BroadcastChannel !== 'undefined') {
          this.reqChannel = new BroadcastChannel('rachi_request_channel');
          this.reqChannel.onmessage = (event) => {
            if (event.data) {
              this.refreshAdminRequests();
            }
          };
          this.ordersChannel = new BroadcastChannel('rachi_orders_channel');
          this.ordersChannel.onmessage = (event) => {
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
      const authUserObj = null;

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
        if (this.kpis && this.kpis.length >= 4) {
          if (this.clients && this.clients.length > 0) {
            this.kpis[0].value = this.clients.length.toString();
          }
          if (this.allRequests && this.allRequests.length > 0) {
            this.kpis[1].value = this.allRequests.length.toString();
          }
          if (this.tecOrders && this.tecOrders.length > 0) {
            this.kpis[2].value = this.tecOrders.length.toString();
          }
        }
        renderCharts(this.theme);
        if (window.lucide) lucide.createIcons();
      });
    },

    get totalRequestsCount() {
      return (this.allRequests && this.allRequests.length > 0) ? this.allRequests.length : 14;
    },
    get totalOrdersCount() {
      return (this.tecOrders && this.tecOrders.length > 0) ? this.tecOrders.length : 3;
    },
    get totalClientsCount() {
      return (this.clients && this.clients.length > 0) ? this.clients.length : 9;
    },

    kpis: [
      { label: 'Clientes Ativos na Base', value: "9", trend: 12.5, icon: 'users' },
      { label: 'Novas Solicitações no Mês', value: "14", trend: 18.2, icon: 'clipboard-list' },
      { label: 'Pedidos da Loja Processados', value: "3", trend: 24, icon: 'shopping-cart' },
      { label: 'Facturação Total (AOA)', value: "4,85M", trend: 15.8, icon: 'banknote' }
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

    allRequests: [
      {
        id: 101,
        protocol: "GNDJ-20261123-N2Z3",
        business_unit_id: 1,
        title: "Realizar Pagamento e gerenciamento d...",
        titulo: "Realizar Pagamento e gerenciamento de faturas e contratos",
        cliente: "Rachi Tech",
        empresa: "rachitecnologia@gmail.com",
        servico: "RACHI Tec",
        unit: "RACHI Tec",
        unitBadge: "bg-blue-500/15 text-blue-700 border-blue-200",
        descricao: "Realizar Pagamento e gerenciamento de faturas e contratos.",
        description: "Realizar Pagamento e gerenciamento de faturas e contratos.",
        data: "23/11/2026 10:00",
        status: "Em Execução",
        statusLabel: "Em Execução",
        status_key: "in_progress",
        priority: "Normal",
        sc: "s-exec",
        dot: "bg-cyan-500",
        responsavel: "Casimiro Gundja",
        technician: "Casimiro Gundja",
        timeline: [{ data: "23/11/2026 10:00", date: "23/11/2026 10:00", desc: "Contrato em execução.", title: "Contrato em execução.", dot: "bg-cyan-500" }],
        messages: []
      },
      {
        id: 102,
        protocol: "GNDJ-20261123-ORC8",
        business_unit_id: 1,
        title: "Desenvolvimento site ECOMMERCE",
        titulo: "Desenvolvimento site ECOMMERCE",
        cliente: "Laurinita Distribuidora Ltda",
        empresa: "te@gmail.com",
        servico: "RACHI Tec",
        unit: "RACHI Tec",
        unitBadge: "bg-blue-500/15 text-blue-700 border-blue-200",
        descricao: "Desenvolvimento completo de plataforma e-commerce institucional.",
        description: "Desenvolvimento completo de plataforma e-commerce institucional.",
        data: "23/11/2026 11:30",
        status: "Concluído",
        statusLabel: "Concluído",
        status_key: "completed",
        priority: "High",
        sc: "s-done",
        dot: "bg-emerald-500",
        responsavel: "Casimiro Gundja",
        technician: "Casimiro Gundja",
        timeline: [{ data: "23/11/2026 11:30", date: "23/11/2026 11:30", desc: "Projeto homologado e concluído.", title: "Projeto homologado e concluído.", dot: "bg-emerald-500" }],
        messages: []
      },
      {
        id: 103,
        protocol: "GNDJ-20261123-ORC9",
        business_unit_id: 1,
        title: "Desenvolvimento site ecommerce",
        titulo: "Desenvolvimento site ecommerce",
        cliente: "Cotech Contabilidade",
        empresa: "comercial@cotechcontabilidade.co...",
        servico: "RACHI Tec",
        unit: "RACHI Tec",
        unitBadge: "bg-blue-500/15 text-blue-700 border-blue-200",
        descricao: "Desenvolvimento site ecommerce e catálogo corporativo.",
        description: "Desenvolvimento site ecommerce e catálogo corporativo.",
        data: "23/11/2026 14:00",
        status: "Em Execução",
        statusLabel: "Em Execução",
        status_key: "in_progress",
        priority: "Normal",
        sc: "s-exec",
        dot: "bg-cyan-500",
        responsavel: "Casimiro Gundja",
        technician: "Casimiro Gundja",
        timeline: [{ data: "23/11/2026 14:00", date: "23/11/2026 14:00", desc: "Em fase de desenvolvimento frontend.", title: "Em fase de desenvolvimento frontend.", dot: "bg-cyan-500" }],
        messages: []
      },
      {
        id: 104,
        protocol: "GNDJ-20261123-ORC10",
        business_unit_id: 1,
        title: "Site Institucional e Painel de gerenciam...",
        titulo: "Site Institucional e Painel de gerenciamento administrativo",
        cliente: "INSTITUTO TÉCNICO PRIVADO D...",
        empresa: "eftsparaisodosaber@gmail.com",
        servico: "RACHI Tec",
        unit: "RACHI Tec",
        unitBadge: "bg-blue-500/15 text-blue-700 border-blue-200",
        descricao: "Site Institucional e Painel de gerenciamento escolar e administrativo.",
        description: "Site Institucional e Painel de gerenciamento escolar e administrativo.",
        data: "23/11/2026 15:45",
        status: "Em Execução",
        statusLabel: "Em Execução",
        status_key: "in_progress",
        priority: "Normal",
        sc: "s-exec",
        dot: "bg-cyan-500",
        responsavel: "Casimiro Gundja",
        technician: "Casimiro Gundja",
        timeline: [{ data: "23/11/2026 15:45", date: "23/11/2026 15:45", desc: "Setup inicial e arquitetura de dados.", title: "Setup inicial e arquitetura de dados.", dot: "bg-cyan-500" }],
        messages: []
      },{"id":14,"protocol":"TEC-2026-000014","business_unit_id":1,"title":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","titulo":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","cliente":"Silva \u0026 Filhos Lda","empresa":"Silva \u0026 Filhos Lda","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital: \ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","description":"\ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","data":"12\/10\/2026 03:01","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 03:01","date":"12\/10\/2026 03:01","desc":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","title":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","dot":"bg-indigo-500"}],"messages":[]},{"id":13,"protocol":"SOL-2026-000013","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","cliente":"gundja","empresa":"gundja","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED: \ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","description":"\ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","data":"12\/10\/2026 02:06","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 02:06","date":"12\/10\/2026 02:06","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","dot":"bg-indigo-500"}],"messages":[]},{"id":12,"protocol":"SOL-2026-000012","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","cliente":"Banco de Fomento Angola","empresa":"Banco de Fomento Angola","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm): \ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","description":"\ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","data":"11\/10\/2026 23:23","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 23:23","date":"11\/10\/2026 23:23","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","dot":"bg-indigo-500"}],"messages":[]},{"id":11,"protocol":"SOL-2026-000011","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","cliente":"Banco de Fomento Angola Teste","empresa":"Banco de Fomento Angola Teste","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio: \ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","description":"\ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","data":"11\/10\/2026 20:47","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 20:47","date":"11\/10\/2026 20:47","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","dot":"bg-indigo-500"}],"messages":[]},{"id":10,"protocol":"SOL-2026-000010","business_unit_id":1,"title":"solici","titulo":"solici","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"solici: solici","description":"solici","data":"23\/09\/2026 03:48","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 02:48","date":"23\/09\/2026 02:48","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","dot":"bg-indigo-500"}],"messages":[{"id":11,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false},{"id":12,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false}]},{"id":9,"protocol":"SOL-2026-000009","business_unit_id":1,"title":"Teste teste","titulo":"Teste teste","cliente":"Gundja","empresa":"Gundja","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Teste teste: Testetetetetetetet Descri\u00e7\u00e3o","description":"Testetetetetetetet Descri\u00e7\u00e3o","data":"23\/09\/2026 03:35","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 03:38","date":"23\/09\/2026 03:38","desc":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","title":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","dot":"bg-amber-500"},{"data":"23\/09\/2026 02:35","date":"23\/09\/2026 02:35","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","dot":"bg-amber-500"}],"messages":[{"id":10,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Resposta teste","text":"Resposta teste","data":"23\/09\/2026 03:37","is_staff":true,"fromUser":false}]},{"id":7,"protocol":"SOL-2026-000007","business_unit_id":2,"title":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","titulo":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC: Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","description":"Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","data":"21\/09\/2026 10:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"21\/09\/2026 12:00","date":"21\/09\/2026 12:00","desc":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","title":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","dot":"bg-amber-500"}],"messages":[]},{"id":4,"protocol":"SOL-2026-000004","business_unit_id":3,"title":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados","titulo":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Academy","unit":"RACHI Academy","unitBadge":"bg-indigo-500\/15 text-indigo-700 border-indigo-200","descricao":"Forma\u00e7\u00e3o Executiva em Ciberseguran\u00e7a \u0026 Prote\u00e7\u00e3o de Dados: Solicita\u00e7\u00e3o de turma corporativa in-company para 15 gestores da \u00e1rea de infraestrutura de TI.","description":"Solicita\u00e7\u00e3o de turma corporativa in-company para 15 gestores da \u00e1rea de infraestrutura de TI.","data":"21\/09\/2026 08:30","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"High","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"21\/09\/2026 08:30","date":"21\/09\/2026 08:30","desc":"Solicita\u00e7\u00e3o Aberta (#SOL-2026-000004)","title":"Solicita\u00e7\u00e3o Aberta (#SOL-2026-000004)","dot":"bg-indigo-500"}],"messages":[{"id":7,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Gostar\u00edamos de saber a disponibilidade de instrutores para in\u00edcio na primeira quinzena de outubro.","text":"Gostar\u00edamos de saber a disponibilidade de instrutores para in\u00edcio na primeira quinzena de outubro.","data":"21\/09\/2026 08:35","is_staff":false,"fromUser":true}]},{"id":1,"protocol":"SOL-2026-000001","business_unit_id":1,"title":"Desenvolvimento de Novo Website Institucional \u0026 Portal","titulo":"Desenvolvimento de Novo Website Institucional \u0026 Portal","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Desenvolvimento de Novo Website Institucional \u0026 Portal: Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","description":"Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","data":"19\/09\/2026 09:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"High","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"19\/09\/2026 11:00","date":"19\/09\/2026 11:00","desc":"Em An\u00e1lise de Requisitos e Arquitetura","title":"Em An\u00e1lise de Requisitos e Arquitetura","dot":"bg-amber-500"},{"data":"19\/09\/2026 10:30","date":"19\/09\/2026 10:30","desc":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","title":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","dot":"bg-amber-500"},{"data":"19\/09\/2026 09:15","date":"19\/09\/2026 09:15","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","dot":"bg-amber-500"}],"messages":[{"id":1,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","text":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","data":"19\/09\/2026 11:15","is_staff":false,"fromUser":true},{"id":2,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","text":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","data":"19\/09\/2026 11:45","is_staff":true,"fromUser":false},{"id":6,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Mensagem de teste do cliente via API","text":"Mensagem de teste do cliente via API","data":"23\/09\/2026 02:49","is_staff":false,"fromUser":true}]},{"id":5,"protocol":"SOL-2026-000005","business_unit_id":1,"title":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","titulo":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral: Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","description":"Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","data":"18\/09\/2026 14:00","status":"Or\u00e7amentada","statusLabel":"Or\u00e7amentada","status_key":"quoted","priority":"Normal","sc":"s-analise","dot":"bg-blue-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 10:00","date":"20\/09\/2026 10:00","desc":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","title":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","dot":"bg-blue-500"},{"data":"18\/09\/2026 14:00","date":"18\/09\/2026 14:00","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","dot":"bg-blue-500"}],"messages":[]},{"id":6,"protocol":"SOL-2026-000006","business_unit_id":4,"title":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","titulo":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software: Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","description":"Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","data":"17\/09\/2026 16:20","status":"Aguardando Cliente","statusLabel":"Aguardando Cliente","status_key":"waiting_customer","priority":"High","sc":"s-wait","dot":"bg-orange-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","title":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","title":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"21\/09\/2026 11:00","date":"21\/09\/2026 11:00","desc":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","title":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","dot":"bg-orange-500"}],"messages":[]},{"id":2,"protocol":"SOL-2026-000002","business_unit_id":2,"title":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","titulo":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos: Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","description":"Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","data":"16\/09\/2026 14:00","status":"Em execu\u00e7\u00e3o","statusLabel":"Em execu\u00e7\u00e3o","status_key":"in_progress","priority":"Normal","sc":"s-exec","dot":"bg-cyan-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 16:30","date":"20\/09\/2026 16:30","desc":"Em Fase de Acabamento \u0026 Corte","title":"Em Fase de Acabamento \u0026 Corte","dot":"bg-cyan-500"},{"data":"17\/09\/2026 11:20","date":"17\/09\/2026 11:20","desc":"Prova de Cor e Impress\u00e3o Aprovada","title":"Prova de Cor e Impress\u00e3o Aprovada","dot":"bg-cyan-500"},{"data":"16\/09\/2026 14:00","date":"16\/09\/2026 14:00","desc":"Ordem de Produ\u00e7\u00e3o Iniciada","title":"Ordem de Produ\u00e7\u00e3o Iniciada","dot":"bg-cyan-500"}],"messages":[{"id":3,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"A prova digital ficou excelente, autorizamos a tiragem completa.","text":"A prova digital ficou excelente, autorizamos a tiragem completa.","data":"16\/09\/2026 15:30","is_staff":false,"fromUser":true},{"id":4,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","text":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","data":"16\/09\/2026 16:00","is_staff":true,"fromUser":false}]},{"id":8,"protocol":"SOL-2026-000008","business_unit_id":1,"title":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","titulo":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia: Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","description":"Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","data":"10\/09\/2026 11:00","status":"Cancelada","statusLabel":"Cancelada","status_key":"cancelled","priority":"Low","sc":"s-cancel","dot":"bg-rose-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/09\/2026 14:00","date":"12\/09\/2026 14:00","desc":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","title":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","dot":"bg-rose-500"}],"messages":[{"id":8,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Ola","text":"Ola","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false},{"id":9,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Bom dia","text":"Bom dia","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false}]},{"id":3,"protocol":"SOL-2026-000003","business_unit_id":4,"title":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","titulo":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios: Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","description":"Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","data":"05\/09\/2026 10:00","status":"Conclu\u00edda","statusLabel":"Conclu\u00edda","status_key":"completed","priority":"Normal","sc":"s-done","dot":"bg-emerald-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"18\/09\/2026 17:00","date":"18\/09\/2026 17:00","desc":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","title":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","dot":"bg-emerald-500"},{"data":"12\/09\/2026 15:00","date":"12\/09\/2026 15:00","desc":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","title":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","dot":"bg-emerald-500"},{"data":"05\/09\/2026 10:00","date":"05\/09\/2026 10:00","desc":"Contrato de Consultoria Ativado","title":"Contrato de Consultoria Ativado","dot":"bg-emerald-500"}],"messages":[{"id":5,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","text":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","data":"18\/09\/2026 17:30","is_staff":true,"fromUser":false}]}],
    reqFilterSearch: '',
    reqFilterUnit: 'Todas',
    reqFilterStatus: 'Todos',

    
    // ==========================================
    // GETTERS & MÉTODOS PARA OS MODELOS DOS PRINTS 1, 2 E 3
    // ==========================================
    get pipelineStats() {
      const all = this.allRequests || [];
      return {
        total: all.length,
        novas: all.filter(r => (r.status_key === 'new' || (r.status && r.status.toLowerCase().includes('nov')))).length,
        analise: all.filter(r => (r.status_key === 'in_analysis' || (r.status && (r.status.toLowerCase().includes('anál') || r.status.toLowerCase().includes('orçam'))))).length,
        concluidas: all.filter(r => (r.status_key === 'completed' || (r.status && (r.status.toLowerCase().includes('conclu') || r.status.toLowerCase().includes('aprov'))))).length
      };
    },
    confirmDeleteReq(req) {
      if (!confirm('Deseja realmente remover a solicitação #' + (req.protocol || req.id) + '?')) return;
      const idx = this.allRequests.findIndex(r => r.id === req.id);
      if (idx !== -1) {
        this.allRequests.splice(idx, 1);
        this.showAlert('success', 'Solicitação Removida', 'A solicitação foi removida do pipeline.');
      }
    },

    // FINANÇAS (PRINT 2)
    finTab: 'todos',
    finSearch: '',
    finType: 'all',
    financialInvoices: [
      { id: 1, codigo: 'NF #ORC-20261123-3JSP', titulo: 'Contrato Aprovado: Realizar Pagamento e gerenciamento d...', cliente: 'Rachi Tech', email: 'rachitecnologia@gmail.com', metodo: 'MULTICAIXA', valor: 150000, vencimento: '01/12/2026', status: 'A RECEBER', raw_status: 'pending' },
      { id: 2, codigo: 'NF #ORC-20261123-IER4', titulo: 'Contrato Aprovado: Site Institucional e Painel de gerenciam...', cliente: 'INSTITUTO TÉCNICO PRIVADO D...', email: 'eftsparaisodosaber@gmail.com', metodo: 'MULTICAIXA', valor: 3310000, vencimento: '30/11/2026', status: 'A RECEBER', raw_status: 'pending' },
      { id: 3, codigo: 'NF #ORC-20261123-K3JX', titulo: 'Contrato Aprovado: Desenvolvimento site ecommerce', cliente: 'Cotech Contabilidade', email: 'comercial@cotechcontabilidade.co...', metodo: 'MULTICAIXA', valor: 1800000, vencimento: '30/11/2026', status: 'A RECEBER', raw_status: 'pending' },
      { id: 4, codigo: 'NF #ORC-20261123-UWGG', titulo: 'Contrato Aprovado: Desenvolvimento site ECOMMERCE', cliente: 'Laurinita Distribuidora Ltda', email: 'te@gmail.com', metodo: 'MULTICAIXA', valor: 2050000, vencimento: '30/11/2026', status: 'RECEBIDO', raw_status: 'paid' }
    ],
    get finStats() {
      const list = this.financialInvoices || [];
      const total = list.reduce((acc, i) => acc + (i.status !== 'CANCELADO' ? i.valor : 0), 0);
      const recebido = list.filter(i => i.status === 'RECEBIDO').reduce((acc, i) => acc + i.valor, 0);
      const pendente = list.filter(i => i.status === 'A RECEBER').reduce((acc, i) => acc + i.valor, 0);
      const vencido = 0;
      const fmt = (v) => 'AOA ' + v.toLocaleString('pt-AO', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
      return {
        total,
        totalFormatted: fmt(total),
        recebidoFormatted: fmt(recebido),
        pendenteFormatted: fmt(pendente),
        vencidoFormatted: fmt(vencido),
        totalCount: list.length,
        pendenteCount: list.filter(i => i.status === 'A RECEBER').length,
        recebidoCount: list.filter(i => i.status === 'RECEBIDO').length,
        canceladoCount: list.filter(i => i.status === 'CANCELADO').length
      };
    },
    get filteredInvoices() {
      let list = this.financialInvoices || [];
      if (this.finTab === 'pendentes') list = list.filter(i => i.status === 'A RECEBER');
      else if (this.finTab === 'recebidos') list = list.filter(i => i.status === 'RECEBIDO');
      else if (this.finTab === 'cancelados') list = list.filter(i => i.status === 'CANCELADO');

      if (this.finSearch && this.finSearch.trim()) {
        const q = this.finSearch.toLowerCase().trim();
        list = list.filter(i =>
          i.titulo.toLowerCase().includes(q) ||
          i.codigo.toLowerCase().includes(q) ||
          i.cliente.toLowerCase().includes(q) ||
          i.email.toLowerCase().includes(q)
        );
      }
      return list;
    },
    receiveInvoice(inv) {
      inv.status = 'RECEBIDO';
      inv.raw_status = 'paid';
      this.showAlert('success', 'Fatura Liquidada', `Fatura ${inv.codigo} marcada como recebida com sucesso.`);
    },
    cancelInvoice(inv) {
      if (!confirm('Deseja cancelar o lançamento desta fatura?')) return;
      inv.status = 'CANCELADO';
      inv.raw_status = 'cancelled';
      this.showAlert('info', 'Fatura Cancelada', `A fatura ${inv.codigo} foi cancelada.`);
    },
    deleteInvoice(inv) {
      if (!confirm('Remover definitivamente este registo financeiro?')) return;
      const idx = this.financialInvoices.findIndex(i => i.id === inv.id);
      if (idx !== -1) {
        this.financialInvoices.splice(idx, 1);
        this.showAlert('success', 'Registo Excluído', 'Lançamento financeiro removido com sucesso.');
      }
    },
    downloadReceipt(inv) {
      this.showAlert('info', 'A Gerar Recibo', `Download do recibo oficial da fatura ${inv.codigo}...`);
    },
    openNewInvoiceModal() {
      const desc = prompt('Descrição do lançamento/fatura:');
      if (!desc) return;
      const val = parseFloat(prompt('Valor em AOA:', '250000')) || 250000;
      const cli = prompt('Nome do cliente:', 'Cliente RACHI') || 'Cliente RACHI';
      const id = Date.now();
      this.financialInvoices.unshift({
        id,
        codigo: 'NF #ORC-' + new Date().toISOString().slice(0,10).replace(/-/g,'') + '-' + Math.random().toString(36).substring(2,6).toUpperCase(),
        titulo: 'Contrato: ' + desc,
        cliente: cli,
        email: 'contato@cliente.ao',
        metodo: 'MULTICAIXA',
        valor: val,
        vencimento: '30/12/2026',
        status: 'A RECEBER',
        raw_status: 'pending'
      });
      this.showAlert('success', 'Fatura Emitida', 'Novo lançamento adicionado ao faturamento.');
    },

    // CATÁLOGO DE SERVIÇOS (PRINT 3)
    serviceTab: 'todos',
    serviceSearch: '',
    servicesCatalog: [
      { id: 1, nome: 'Desenvolvimento Web & E-commerce', codigo: 'SRV-TI-01', descricao: 'Lojas virtuais, portais corporativos e plataformas sob medida.', categoria: 'TECNOLOGIA & SOFTWARE', precoBase: 'AOA 450.000,00', valorNum: 450000, status: 'Ativo', icon: 'globe' },
      { id: 2, nome: 'Consultoria & Transformação Digital', codigo: 'SRV-TI-02', descricao: 'Diagnóstico tecnológico, automação e modernização de processos.', categoria: 'TECNOLOGIA & SOFTWARE', precoBase: 'AOA 350.000,00', valorNum: 350000, status: 'Ativo', icon: 'cpu' },
      { id: 3, nome: 'Identidade Visual & Branding Corporativo', codigo: 'SRV-DSG-01', descricao: 'Criação de marcas, manuais de identidade e papelaria executiva.', categoria: 'DESIGN & BRANDING', precoBase: 'AOA 180.000,00', valorNum: 180000, status: 'Ativo', icon: 'palette' },
      { id: 4, nome: 'Diagnóstico e Estruturação de Cargos & Salários', codigo: 'SRV-RH-01', descricao: 'Plano de carreiras, matriz salarial e políticas de benefícios.', categoria: 'CONSULTORIA RH', precoBase: 'AOA 280.000,00', valorNum: 280000, status: 'Ativo', icon: 'briefcase' },
      { id: 5, nome: 'Recrutamento & Seleção Executiva', codigo: 'SRV-RH-02', descricao: 'Headhunting especializado para posições técnicas e de liderança.', categoria: 'CONSULTORIA RH', precoBase: 'AOA 150.000,00', valorNum: 150000, status: 'Ativo', icon: 'user-check' },
      { id: 6, nome: 'Roll-up Banners & Comunicação Visual', codigo: 'SRV-PRT-01', descricao: 'Estruturas de alumínio e impressão fotográfica de alta definição.', categoria: 'IMPRESSÃO & GRÁFICA', precoBase: 'AOA 85.000,00', valorNum: 85000, status: 'Ativo', icon: 'printer' },
      { id: 7, nome: 'Brindes & Materiais Promocionais Personalizados', codigo: 'SRV-PRT-02', descricao: 'Garrafas térmicas, agendas, crachás e kits corporativos.', categoria: 'IMPRESSÃO & GRÁFICA', precoBase: 'AOA 500.000,00', valorNum: 500000, status: 'Ativo', icon: 'gift' }
    ],
    get serviceStats() {
      const list = this.servicesCatalog || [];
      const ativos = list.filter(s => s.status === 'Ativo').length;
      const inativos = list.filter(s => s.status !== 'Ativo').length;
      const sum = list.reduce((acc, s) => acc + (s.valorNum || 0), 0);
      const ticket = list.length > 0 ? Math.round(sum / list.length) : 0;
      return {
        total: list.length,
        ativos,
        inativos,
        ticketMedio: 'AOA ' + ticket.toLocaleString('pt-AO')
      };
    },
    get filteredServices() {
      let list = this.servicesCatalog || [];
      if (this.serviceTab === 'ativos') list = list.filter(s => s.status === 'Ativo');
      else if (this.serviceTab === 'inativos') list = list.filter(s => s.status !== 'Ativo');

      if (this.serviceSearch && this.serviceSearch.trim()) {
        const q = this.serviceSearch.toLowerCase().trim();
        list = list.filter(s =>
          s.nome.toLowerCase().includes(q) ||
          s.categoria.toLowerCase().includes(q) ||
          s.codigo.toLowerCase().includes(q) ||
          (s.descricao && s.descricao.toLowerCase().includes(q))
        );
      }
      return list;
    },
    toggleServiceStatus(srv) {
      srv.status = srv.status === 'Ativo' ? 'Inativo' : 'Ativo';
      this.showAlert('info', 'Status Atualizado', `Serviço "${srv.nome}" agora está ${srv.status}.`);
    },
    editService(srv) {
      const novoNome = prompt('Editar nome do serviço:', srv.nome);
      if (novoNome) srv.nome = novoNome;
      const novoPreco = prompt('Editar preço base (ex: AOA 300.000,00):', srv.precoBase);
      if (novoPreco) srv.precoBase = novoPreco;
      this.showAlert('success', 'Serviço Atualizado', 'As alterações foram salvas.');
    },
    deleteService(srv) {
      if (!confirm(`Deseja remover o serviço "${srv.nome}"?`)) return;
      const idx = this.servicesCatalog.findIndex(s => s.id === srv.id);
      if (idx !== -1) {
        this.servicesCatalog.splice(idx, 1);
        this.showAlert('success', 'Serviço Removido', 'Serviço excluído do catálogo.');
      }
    },
    openNewServiceModal() {
      const nome = prompt('Nome do novo serviço:');
      if (!nome) return;
      const cat = prompt('Categoria (ex: TECNOLOGIA & SOFTWARE, CONSULTORIA RH, IMPRESSÃO & GRÁFICA):', 'TECNOLOGIA & SOFTWARE') || 'TECNOLOGIA & SOFTWARE';
      const preco = prompt('Preço base (ex: AOA 250.000,00):', 'AOA 250.000,00') || 'AOA 250.000,00';
      const id = Date.now();
      this.servicesCatalog.push({
        id,
        nome,
        codigo: 'SRV-NEW-' + String(this.servicesCatalog.length + 1).padStart(2, '0'),
        descricao: 'Serviço profissional disponibilizado pela RACHI.',
        categoria: cat.toUpperCase(),
        precoBase: preco,
        valorNum: parseFloat(preco.replace(/[^0-9]/g, '')) || 250000,
        status: 'Ativo',
        icon: 'layers'
      });
      this.showAlert('success', 'Serviço Criado', 'Novo serviço cadastrado no catálogo.');
    },

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

    openCreateOrderModal() {
      this.newOrder = { business_unit_id: 1, title: '', customer_name: '', customer_email: '', customer_phone: '', priority: 'normal', description: '', isSubmitting: false };
      this.showCreateOrderModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitCreateOrder() {
      if (!this.newOrder.title.trim()) {
        this.showAlert('warning', 'Atenção', 'Por favor informe o título ou serviço solicitado.');
        return;
      }
      this.newOrder.isSubmitting = true;
      try {
        const res = await fetch('/admin/requests/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.newOrder)
        });
        const data = await res.json();
        if (data.success && data.request) {
          this.requests.unshift(data.request);
          this.showCreateOrderModal = false;
          this.showAlert('success', 'Ordem Criada', data.message || 'Nova ordem de serviço registada com sucesso!');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Erro', data.message || 'Não foi possível registar a ordem.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro de Conexão', 'Falha ao comunicar com o servidor.');
      } finally {
        this.newOrder.isSubmitting = false;
      }
    },

    openCreateJobModal() {
      this.newJob = { cargo: '', empresa: 'RACHI Human Capital', local: 'Luanda', mod: 'Presencial', sal: '', prazo: '30 dias', req: '', isSubmitting: false };
      this.showCreateJobModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitCreateJob() {
      if (!this.newJob.cargo.trim()) {
        this.showAlert('warning', 'Atenção', 'O título da vaga/posição é obrigatório.');
        return;
      }
      this.newJob.isSubmitting = true;
      try {
        const res = await fetch('/admin/capital/jobs/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.newJob)
        });
        const data = await res.json();
        if (data.success && data.job) {
          this.rhJobs.unshift(data.job);
          this.showCreateJobModal = false;
          this.showAlert('success', 'Vaga Publicada', data.message || 'Vaga corporativa adicionada ao Human Capital!');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Erro', data.message || 'Não foi possível publicar a vaga.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro de Conexão', 'Falha ao conectar ao servidor.');
      } finally {
        this.newJob.isSubmitting = false;
      }
    },

    openCreateProductModal() {
      this.newProduct = { nome: '', sku: '', cat: 'Hardware & Equipamentos', preco: '', est: 10, min_est: 3, marca: 'RACHI Tec', isSubmitting: false };
      this.showCreateProductModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitCreateProduct() {
      if (!this.newProduct.nome.trim()) {
        this.showAlert('warning', 'Atenção', 'O nome do produto é obrigatório.');
        return;
      }
      this.newProduct.isSubmitting = true;
      try {
        const res = await fetch('/admin/tec/products/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.newProduct)
        });
        const data = await res.json();
        if (data.success && data.product) {
          this.sProducts.unshift(data.product);
          this.showCreateProductModal = false;
          this.showAlert('success', 'Produto Adicionado', data.message || 'Produto adicionado ao catálogo RACHI Tec!');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Erro', data.message || 'Não foi possível adicionar o produto.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro de Conexão', 'Falha ao conectar ao servidor.');
      } finally {
        this.newProduct.isSubmitting = false;
      }
    },

    openCreatePrintModal() {
      this.newPrint = { nome: '', mat: 'Couché 300g Laminação Fosca', tam: '90x50mm', qtm: 100, preco: '', prazo: '3 dias úteis', desc: '', isSubmitting: false };
      this.showCreatePrintModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitCreatePrint() {
      if (!this.newPrint.nome.trim()) {
        this.showAlert('warning', 'Atenção', 'O nome do serviço ou produto gráfico é obrigatório.');
        return;
      }
      this.newPrint.isSubmitting = true;
      try {
        const res = await fetch('/admin/print/orders/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.newPrint)
        });
        const data = await res.json();
        if (data.success && data.item) {
          this.gProducts.unshift(data.item);
          this.showCreatePrintModal = false;
          this.showAlert('success', 'Ordem Gráfica', data.message || 'Item adicionado à produção da RACHI Print!');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Erro', data.message || 'Não foi possível adicionar o item gráfico.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro de Conexão', 'Falha ao conectar ao servidor.');
      } finally {
        this.newPrint.isSubmitting = false;
      }
    },

    openCreateCourseModal() {
      this.newCourse = { nome: '', cat: 'Tecnologia & TI', dur: 40, level: 'intermediate', preco: '', prof: 'Corpo Docente RACHI', modulos: 4, desc: '', isSubmitting: false };
      this.showCreateCourseModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitCreateCourse() {
      if (!this.newCourse.nome.trim()) {
        this.showAlert('warning', 'Atenção', 'O título da formação/curso é obrigatório.');
        return;
      }
      this.newCourse.isSubmitting = true;
      try {
        const res = await fetch('/admin/academy/courses/create', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify(this.newCourse)
        });
        const data = await res.json();
        if (data.success && data.course) {
          this.aCourses.unshift(data.course);
          this.coursesList.unshift(data.course);
          this.showCreateCourseModal = false;
          this.showAlert('success', 'Formação Criada', data.message || 'Curso registado com sucesso na RACHI Academy!');
          this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
        } else {
          this.showAlert('error', 'Erro', data.message || 'Não foi possível registar o curso.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro de Conexão', 'Falha ao conectar ao servidor.');
      } finally {
        this.newCourse.isSubmitting = false;
      }
    },

    exportReport(type, format) {
      if (format === 'pdf') {
        window.print();
        return;
      }
      let rows = [];
      let filename = 'relatorio_' + type + '_' + new Date().toISOString().slice(0, 10) + '.csv';

      if (type === 'clientes') {
        rows.push(['ID', 'Nome', 'Email', 'Telefone', 'Tipo', 'Status', 'Desde']);
        (this.clients || []).forEach(c => {
          rows.push([c.id, c.nome, c.email, c.tel || '', c.tipo, c.status, c.desde || '']);
        });
      } else if (type === 'solicitacoes') {
        rows.push(['Protocolo', 'Cliente', 'Unidade', 'Título', 'Status', 'Prioridade', 'Data']);
        (this.requests || []).forEach(r => {
          rows.push([r.protocol, r.cliente, r.unit || r.servico, r.title, r.status, r.priority, r.data]);
        });
      } else if (type === 'pedidos') {
        rows.push(['ID', 'Número', 'Cliente', 'Total', 'Status', 'Data']);
        (this.tecOrders || []).forEach(o => {
          rows.push([o.id, o.numero, o.cliente, o.total, o.status, o.data]);
        });
      } else if (type === 'academy') {
        rows.push(['ID', 'Título', 'Categoria', 'Carga', 'Preço', 'Alunos', 'Status']);
        (this.aCourses || []).forEach(c => {
          rows.push([c.id, c.titulo, c.cat, c.dur, c.preco, c.alunos, c.status]);
        });
      } else {
        rows.push(['Unidade', 'Facturação AOA', 'Percentual']);
        (this.finMods || []).forEach(f => {
          rows.push([f.label, f.value, f.pct + '%']);
        });
      }

      const csvContent = '\uFEFF' + rows.map(e => e.map(x => '"' + ('' + (x ?? '')).replace(/"/g, '""') + '"').join(';')).join('\n');
      const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.setAttribute('download', filename);
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
      this.showAlert('success', 'Relatório Exportado', 'Download do ficheiro ' + filename + ' concluído com sucesso!');
    },

    aCourses: [{"id":15,"titulo":"Curso Especializado: Engenharia Social Institucional","slug":"engenharia-social-institucional","cat":"Tecnologia da Informa\u00e7\u00e3o","preco":"AOA 60.000,00","dur":"16h","nivel":"Interm\u00e9dio","status":"Ativo","alunos":18,"taxa":92,"modulos":5,"prof":"Corpo Docente RACHI"}],
    sProducts: [{"id":7,"nome":"Auriculares sem Fio Bluetooth TWS","marca":"RACHI Tec","sku":"TEC-FONE-TWS","cat":"Consum\u00edveis \u0026 Escrit\u00f3rio","preco":"AOA 15.000,00","preco_raw":15000,"est":25,"min_est":4,"vendas":0,"status":"Ativo"},{"id":8,"nome":"Capa Tem\u00e1tica Naruto para iPhone","marca":"RACHI Tec","sku":"TEC-ACC-NARUTO","cat":"Material Promocional","preco":"AOA 7.000,00","preco_raw":7000,"est":25,"min_est":5,"vendas":0,"status":"Ativo"},{"id":9,"nome":"T-Shirt Naruto Shippuden Modo S\u00e1bio \u0026 Gamakichi","marca":"RACHI Tec","sku":"TEC-OTK-TSH01","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":18,"min_est":4,"vendas":0,"status":"Ativo"},{"id":10,"nome":"T-Shirt Akatsuki Cl\u00e1ssica Nuvens Vermelhas","marca":"RACHI Tec","sku":"TEC-OTK-TSH02","cat":"Universo Otaku \u0026 Geek","preco":"AOA 8.500,00","preco_raw":8500,"est":22,"min_est":5,"vendas":0,"status":"Ativo"},{"id":11,"nome":"T-Shirt Saitama Serious Punch \u2014 One Punch Man","marca":"RACHI Tec","sku":"TEC-OTK-TSH03","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.000,00","preco_raw":9000,"est":15,"min_est":3,"vendas":0,"status":"Ativo"},{"id":12,"nome":"T-Shirt Naruto Shippuden Modo Chakra da Kurama","marca":"RACHI Tec","sku":"TEC-OTK-TSH04","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":16,"min_est":4,"vendas":0,"status":"Ativo"},{"id":13,"nome":"T-Shirt Madara Uchiha \u2014 O Fantasma dos Uchiha","marca":"RACHI Tec","sku":"TEC-OTK-TSH05","cat":"Universo Otaku \u0026 Geek","preco":"AOA 10.000,00","preco_raw":10000,"est":14,"min_est":3,"vendas":0,"status":"Ativo"},{"id":14,"nome":"T-Shirt Minato Namikaze \u0026 Kushina Uzumaki \u2014 Fam\u00edlia","marca":"RACHI Tec","sku":"TEC-OTK-TSH06","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":15,"min_est":4,"vendas":0,"status":"Ativo"},{"id":15,"nome":"T-Shirt Nanadaime Hokage \u2014 Do Balan\u00e7o ao Topo","marca":"RACHI Tec","sku":"TEC-OTK-TSH07","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":17,"min_est":4,"vendas":0,"status":"Ativo"},{"id":16,"nome":"T-Shirt Gaara do Deserto \u2014 Kazekage de Suna","marca":"RACHI Tec","sku":"TEC-OTK-TSH08","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.000,00","preco_raw":9000,"est":12,"min_est":3,"vendas":0,"status":"Ativo"},{"id":17,"nome":"T-Shirt Sukuna \u0026 Kurama \u2014 Lua de Sangue Carmesim","marca":"RACHI Tec","sku":"TEC-OTK-TSH09","cat":"Universo Otaku \u0026 Geek","preco":"AOA 10.000,00","preco_raw":10000,"est":15,"min_est":3,"vendas":0,"status":"Ativo"},{"id":18,"nome":"T-Shirt Monkey D. Luffy \u2014 One Piece Gear","marca":"RACHI Tec","sku":"TEC-OTK-TSH10","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.000,00","preco_raw":9000,"est":19,"min_est":4,"vendas":0,"status":"Ativo"},{"id":19,"nome":"T-Shirt Super Saiyan Goku Neon Splash \u2014 Dragon Ball Z","marca":"RACHI Tec","sku":"TEC-OTK-TSH11","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":20,"min_est":5,"vendas":0,"status":"Ativo"},{"id":20,"nome":"T-Shirt Kid Goku na Nuvem Voadora Kintoun Cl\u00e1ssico","marca":"RACHI Tec","sku":"TEC-OTK-TSH12","cat":"Universo Otaku \u0026 Geek","preco":"AOA 8.500,00","preco_raw":8500,"est":14,"min_est":3,"vendas":0,"status":"Ativo"},{"id":22,"nome":"T-Shirt Naruto Tra\u00e7o Manga Sketch Minimalista","marca":"RACHI Tec","sku":"TEC-OTK-TSH13","cat":"Universo Otaku \u0026 Geek","preco":"AOA 8.500,00","preco_raw":8500,"est":16,"min_est":3,"vendas":0,"status":"Ativo"},{"id":23,"nome":"T-Shirt Itachi Uchiha Chibi \u0026 Akatsuki Back","marca":"RACHI Tec","sku":"TEC-OTK-TSH14","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.000,00","preco_raw":9000,"est":18,"min_est":4,"vendas":0,"status":"Ativo"},{"id":24,"nome":"T-Shirt Naruto na Floresta Verde Oliva \u2014 Vila da Folha","marca":"RACHI Tec","sku":"TEC-OTK-TSH15","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":15,"min_est":3,"vendas":0,"status":"Ativo"},{"id":25,"nome":"T-Shirt Naruto Painel Mang\u00e1 Multi-Cenas Quadros","marca":"RACHI Tec","sku":"TEC-OTK-TSH16","cat":"Universo Otaku \u0026 Geek","preco":"AOA 9.500,00","preco_raw":9500,"est":17,"min_est":4,"vendas":0,"status":"Ativo"},{"id":1,"nome":"HP Elitebook x360 1040 G8 (2-in-1)","marca":"RACHI Tec","sku":"TEC-NB-HP1040","cat":"Inform\u00e1tica e Tecnologia","preco":"AOA 1.489.000,29","preco_raw":1489000.29,"est":7,"min_est":2,"vendas":4,"status":"Ativo"},{"id":2,"nome":"Smartwatch Lige Executivo Pro","marca":"RACHI Tec","sku":"TEC-SW-LIGE01","cat":"Inform\u00e1tica e Tecnologia","preco":"AOA 10.000,00","preco_raw":10000,"est":25,"min_est":5,"vendas":0,"status":"Ativo"},{"id":3,"nome":"TV Box Android MXQ Pro 4K Ultra HD","marca":"RACHI Tec","sku":"TEC-TV-MXQPRO","cat":"Inform\u00e1tica e Tecnologia","preco":"AOA 18.000,00","preco_raw":18000,"est":15,"min_est":3,"vendas":0,"status":"Ativo"},{"id":4,"nome":"Cabo Console RS232\/DB9 para RJ45 1.5M","marca":"RACHI Tec","sku":"TEC-CAB-RS232","cat":"Inform\u00e1tica e Tecnologia","preco":"AOA 16.989,89","preco_raw":16989.89,"est":30,"min_est":5,"vendas":0,"status":"Ativo"},{"id":5,"nome":"Auricular com Fio 3.5mm Alta Fidelidade","marca":"RACHI Tec","sku":"TEC-FONE-FIO","cat":"Consum\u00edveis \u0026 Escrit\u00f3rio","preco":"AOA 3.000,00","preco_raw":3000,"est":50,"min_est":10,"vendas":0,"status":"Ativo"}],
    tecOrders: [{"id":3,"numero":"PED-00003","cliente":"gundja","total":"AOA 1.489.000,29","status":"Pending","data":"12\/10\/2026 03:28"},{"id":1,"numero":"PED-00001","cliente":"Empresa Teste Luanda Lda","total":"AOA 2.978.000,58","status":"Pending","data":"12\/10\/2026 03:24"},{"id":2,"numero":"PED-00002","cliente":"Super Administrador RACHI","total":"AOA 1.489.000,29","status":"Pending","data":"12\/10\/2026 03:24"}],
    tecRequests: [{"id":14,"protocol":"TEC-2026-000014","business_unit_id":1,"title":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","titulo":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital","cliente":"Silva \u0026 Filhos Lda","empresa":"Silva \u0026 Filhos Lda","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Consultoria \u0026 Transforma\u00e7\u00e3o Digital: \ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","description":"\ud83d\udda5\ufe0f Unidade: RACHI Tec\n\ud83d\udccc Servi\u00e7o \/ Assunto: Consultoria \u0026 Transforma\u00e7\u00e3o Digital\n\ud83d\udc64 Solicitante: Teste Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Silva \u0026 Filhos Lda\n\ud83d\udcde Contacto: 923000111\n\u2709\ufe0f Email: antonio.teste@empresa.ao\n\u2b50 Plano \/ Modalidade: Enterprise Pro\n\n\ud83d\udcdd Detalhes da Demanda:\nGostar\u00edamos de agendar um diagn\u00f3stico de processos para a nossa empresa.","data":"12\/10\/2026 03:01","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 03:01","date":"12\/10\/2026 03:01","desc":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","title":"Formul\u00e1rio preenchido na p\u00e1gina RACHI Tec (Consultoria \u0026 Transforma\u00e7\u00e3o Digital)","dot":"bg-indigo-500"}],"messages":[]},{"id":10,"protocol":"SOL-2026-000010","business_unit_id":1,"title":"solici","titulo":"solici","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"solici: solici","description":"solici","data":"23\/09\/2026 03:48","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 02:48","date":"23\/09\/2026 02:48","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000010)","dot":"bg-indigo-500"}],"messages":[{"id":11,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false},{"id":12,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"oi","text":"oi","data":"25\/09\/2026 19:19","is_staff":true,"fromUser":false}]},{"id":9,"protocol":"SOL-2026-000009","business_unit_id":1,"title":"Teste teste","titulo":"Teste teste","cliente":"Gundja","empresa":"Gundja","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Teste teste: Testetetetetetetet Descri\u00e7\u00e3o","description":"Testetetetetetetet Descri\u00e7\u00e3o","data":"23\/09\/2026 03:35","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"23\/09\/2026 03:38","date":"23\/09\/2026 03:38","desc":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","title":"Status alterado para \u0022Em An\u00e1lise\u0022 pelo administrador.","dot":"bg-amber-500"},{"data":"23\/09\/2026 02:35","date":"23\/09\/2026 02:35","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000009)","dot":"bg-amber-500"}],"messages":[{"id":10,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Resposta teste","text":"Resposta teste","data":"23\/09\/2026 03:37","is_staff":true,"fromUser":false}]},{"id":1,"protocol":"SOL-2026-000001","business_unit_id":1,"title":"Desenvolvimento de Novo Website Institucional \u0026 Portal","titulo":"Desenvolvimento de Novo Website Institucional \u0026 Portal","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Desenvolvimento de Novo Website Institucional \u0026 Portal: Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","description":"Moderniza\u00e7\u00e3o do portal corporativo com \u00e1rea de agendamento de consultas, cat\u00e1logo de produtos e integra\u00e7\u00e3o de pagamentos.","data":"19\/09\/2026 09:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"High","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"19\/09\/2026 11:00","date":"19\/09\/2026 11:00","desc":"Em An\u00e1lise de Requisitos e Arquitetura","title":"Em An\u00e1lise de Requisitos e Arquitetura","dot":"bg-amber-500"},{"data":"19\/09\/2026 10:30","date":"19\/09\/2026 10:30","desc":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","title":"Atribu\u00edda ao T\u00e9cnico Casimiro Gundja","dot":"bg-amber-500"},{"data":"19\/09\/2026 09:15","date":"19\/09\/2026 09:15","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000001)","dot":"bg-amber-500"}],"messages":[{"id":1,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","text":"Ol\u00e1, enviamos o briefing t\u00e9cnico e a paleta da nossa marca.","data":"19\/09\/2026 11:15","is_staff":false,"fromUser":true},{"id":2,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","text":"Recebido com sucesso! Estamos finalizando a proposta or\u00e7ament\u00e1ria detalhada.","data":"19\/09\/2026 11:45","is_staff":true,"fromUser":false},{"id":6,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"Mensagem de teste do cliente via API","text":"Mensagem de teste do cliente via API","data":"23\/09\/2026 02:49","is_staff":false,"fromUser":true}]},{"id":5,"protocol":"SOL-2026-000005","business_unit_id":1,"title":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","titulo":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Implementa\u00e7\u00e3o de Servidor Local \u0026 Firewall Perimetral: Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","description":"Fornecimento e parametriza\u00e7\u00e3o de firewall com VPN corporativa, backup redundante e controle de tr\u00e1fego.","data":"18\/09\/2026 14:00","status":"Or\u00e7amentada","statusLabel":"Or\u00e7amentada","status_key":"quoted","priority":"Normal","sc":"s-analise","dot":"bg-blue-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 10:00","date":"20\/09\/2026 10:00","desc":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","title":"Proposta comercial or\u00e7amentada e enviada para aprova\u00e7\u00e3o do cliente.","dot":"bg-blue-500"},{"data":"18\/09\/2026 14:00","date":"18\/09\/2026 14:00","desc":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","title":"Solicita\u00e7\u00e3o Criada (#SOL-2026-000005)","dot":"bg-blue-500"}],"messages":[]},{"id":8,"protocol":"SOL-2026-000008","business_unit_id":1,"title":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","titulo":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Tec","unit":"RACHI Tec","unitBadge":"bg-blue-500\/15 text-blue-700 border-blue-200","descricao":"Repara\u00e7\u00e3o de Servidores Legados Fora de Garantia: Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","description":"Pedido cancelado por indisponibilidade de pe\u00e7as originais no fabricante internacional.","data":"10\/09\/2026 11:00","status":"Cancelada","statusLabel":"Cancelada","status_key":"cancelled","priority":"Low","sc":"s-cancel","dot":"bg-rose-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/09\/2026 14:00","date":"12\/09\/2026 14:00","desc":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","title":"Cancelado a pedido do cliente devido \u00e0 obsolesc\u00eancia dos componentes.","dot":"bg-rose-500"}],"messages":[{"id":8,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Ola","text":"Ola","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false},{"id":9,"user_id":18,"nome":"Administra\u00e7\u00e3o","sender":"Administra\u00e7\u00e3o","message":"Bom dia","text":"Bom dia","data":"23\/09\/2026 03:34","is_staff":true,"fromUser":false}]}],
    tecTab: 'pedidos',
    stockSearch: '',
    stockFilter: 'all',
    showStockModal: false,
    selectedStockProduct: null,
    stockForm: {
      product_id: '',
      action: 'add',
      quantity: 5,
      minimum_stock: 3,
      reason: 'Reposição de inventário',
      auto_disable: false,
      isSubmitting: false
    },

    get filteredStockProducts() {
      let list = this.sProducts || [];
      if (this.stockFilter === 'critico') {
        list = list.filter(p => (p.est || 0) <= (p.min_est || 5));
      } else if (this.stockFilter === 'esgotado') {
        list = list.filter(p => p.status !== 'Ativo' || (p.est || 0) === 0);
      } else if (this.stockFilter === 'disponivel') {
        list = list.filter(p => p.status === 'Ativo' && (p.est || 0) > 0);
      }

      if (this.stockSearch && this.stockSearch.trim() !== '') {
        const q = this.stockSearch.toLowerCase();
        list = list.filter(p => 
          (p.nome && p.nome.toLowerCase().includes(q)) ||
          (p.sku && p.sku.toLowerCase().includes(q)) ||
          (p.cat && p.cat.toLowerCase().includes(q))
        );
      }
      return list;
    },

    openStockModal(product = null, defaultAction = 'add') {
      this.selectedStockProduct = product;
      this.stockForm.product_id = product ? product.id : (this.sProducts[0]?.id || '');
      this.stockForm.action = defaultAction;
      this.stockForm.quantity = 5;
      this.stockForm.minimum_stock = product ? (product.min_est || 3) : 3;
      this.stockForm.reason = defaultAction === 'add' ? 'Entrada de novo lote / reposição' : (defaultAction === 'remove' ? 'Ajuste de avaria ou retirada' : 'Conferência de balanço');
      this.stockForm.auto_disable = false;
      this.stockForm.isSubmitting = false;
      this.showStockModal = true;
      this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
    },

    async submitStockAdjustment() {
      if (!this.stockForm.product_id) {
        this.showAlert('error', 'Erro', 'Selecione um produto.');
        return;
      }
      this.stockForm.isSubmitting = true;
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/tec/stock/adjust', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({
            product_id: this.stockForm.product_id,
            action: this.stockForm.action,
            quantity: this.stockForm.quantity,
            minimum_stock: this.stockForm.minimum_stock,
            reason: this.stockForm.reason,
            auto_disable: this.stockForm.auto_disable
          })
        });
        const data = await res.json();
        if (data.success && data.product) {
          const idx = this.sProducts.findIndex(p => p.id === data.product.id);
          if (idx !== -1) {
            this.sProducts[idx] = data.product;
          }
          this.showStockModal = false;
          this.showAlert('success', 'Stock Atualizado', data.message);
        } else {
          this.showAlert('error', 'Erro', data.message || 'Falha ao atualizar stock.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro', 'Erro ao processar requisição: ' + err.message);
      } finally {
        this.stockForm.isSubmitting = false;
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      }
    },

    async toggleProductAvailability(product) {
      try {
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/tec/stock/toggle-status', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({ product_id: product.id })
        });
        const data = await res.json();
        if (data.success && data.product) {
          const idx = this.sProducts.findIndex(p => p.id === data.product.id);
          if (idx !== -1) {
            this.sProducts[idx] = data.product;
          }
          this.showAlert('success', 'Disponibilidade Atualizada', data.message);
        } else {
          this.showAlert('error', 'Erro', data.message || 'Falha ao alterar disponibilidade.');
        }
      } catch (err) {
        this.showAlert('error', 'Erro', 'Erro ao alterar estado: ' + err.message);
      } finally {
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      }
    },

    async quickStockStep(product, step) {
      try {
        const action = step > 0 ? 'add' : 'remove';
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('/admin/tec/stock/adjust', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': token || ''
          },
          body: JSON.stringify({
            product_id: product.id,
            action: action,
            quantity: 1,
            reason: step > 0 ? 'Entrada rápida de stock (+1 un.)' : 'Baixa rápida de stock (-1 un.)'
          })
        });
        const data = await res.json();
        if (data.success && data.product) {
          const idx = this.sProducts.findIndex(p => p.id === data.product.id);
          if (idx !== -1) {
            this.sProducts[idx] = data.product;
          }
        }
      } catch (err) {
        console.error(err);
      } finally {
        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
      }
    },
    rhJobs: [{"id":7,"cargo":"Formaliza\u00e7\u00e3o e Legaliza\u00e7\u00e3o de Empresas","empresa":"RACHI Human Capital","local":"Luanda \/ Nacional","mod":"Presencial \/ H\u00edbrido","sal":"AOA 150.000,00","cands":12,"prazo":"12 dias","req":"Apoio integral na constitui\u00e7\u00e3o, certid\u00f5es, NIF e regulariza\u00e7\u00e3o de neg\u00f3cios em Angola.","status":"Aberta"},{"id":8,"cargo":"Recrutamento e Gest\u00e3o de Pessoas","empresa":"RACHI Human Capital","local":"Luanda \/ Nacional","mod":"Presencial \/ H\u00edbrido","sal":"AOA 95.000,00","cands":12,"prazo":"15 dias","req":"Sele\u00e7\u00e3o de talentos qualificados e estrutura\u00e7\u00e3o de equipas de alto desempenho.","status":"Aberta"}],
    gProducts: [{"id":"p_6","nome":"Capa Tem\u00e1tica Naruto para iPhone 11 \/ 12 Pro","desc":"Capa protetora personalizada em silicone de alta resist\u00eancia com acabamento premium.","mat":"Acabamento Premium","tam":"Personalizado","qtm":12,"preco":"AOA 7.000,00","prazo":"2-3 dias \u00fateis","status":"Ativo"},{"id":"s_5","nome":"Design de Identidade Visual e Logotipo","desc":"Cria\u00e7\u00e3o de marca, manual de normas gr\u00e1ficas e presen\u00e7a institucional forte.","mat":"Impress\u00e3o Digital \/ UV","tam":"A definir","qtm":1,"preco":"AOA 120.000,00","prazo":"7 dias","status":"Ativo"},{"id":"s_6","nome":"Produ\u00e7\u00e3o Gr\u00e1fica: Banners, Roll-ups e Brindes","desc":"Impress\u00e3o em grande formato, cart\u00f5es de visita de luxo e brindes corporativos.","mat":"Impress\u00e3o Digital \/ UV","tam":"A definir","qtm":1,"preco":"AOA 35.000,00","prazo":"3 dias","status":"Ativo"}],
    capitalRequests: [{"id":6,"protocol":"SOL-2026-000006","business_unit_id":4,"title":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","titulo":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Recrutamento \u0026 Hunting de 3 Engenheiros de Software: Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","description":"Triagem, aplica\u00e7\u00e3o de testes t\u00e9cnicos e entrevistas para contrata\u00e7\u00e3o imediata de 3 desenvolvedores Full Stack.","data":"17\/09\/2026 16:20","status":"Aguardando Cliente","statusLabel":"Aguardando Cliente","status_key":"waiting_customer","priority":"High","sc":"s-wait","dot":"bg-orange-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","title":"Status alterado para \u0022Ag. Cliente\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"12\/10\/2026 02:38","date":"12\/10\/2026 02:38","desc":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","title":"Status alterado para \u0022Em Execu\u00e7\u00e3o\u0022 pelo administrador.","dot":"bg-orange-500"},{"data":"21\/09\/2026 11:00","date":"21\/09\/2026 11:00","desc":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","title":"Aguardando valida\u00e7\u00e3o dos perfis finais pela Dire\u00e7\u00e3o do Cliente.","dot":"bg-orange-500"}],"messages":[]},{"id":3,"protocol":"SOL-2026-000003","business_unit_id":4,"title":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","titulo":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Human Capital","unit":"RACHI Human Capital","unitBadge":"bg-emerald-500\/15 text-emerald-700 border-emerald-200","descricao":"Diagn\u00f3stico e Estrutura\u00e7\u00e3o de Cargos \u0026 Sal\u00e1rios: Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","description":"Elabora\u00e7\u00e3o de manual de cargos, matriz de compet\u00eancias e plano de cargos e sal\u00e1rios para 28 colaboradores.","data":"05\/09\/2026 10:00","status":"Conclu\u00edda","statusLabel":"Conclu\u00edda","status_key":"completed","priority":"Normal","sc":"s-done","dot":"bg-emerald-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"18\/09\/2026 17:00","date":"18\/09\/2026 17:00","desc":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","title":"Entrega do Dossi\u00ea Final e Homologa\u00e7\u00e3o","dot":"bg-emerald-500"},{"data":"12\/09\/2026 15:00","date":"12\/09\/2026 15:00","desc":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","title":"Apresenta\u00e7\u00e3o do Diagn\u00f3stico Preliminar","dot":"bg-emerald-500"},{"data":"05\/09\/2026 10:00","date":"05\/09\/2026 10:00","desc":"Contrato de Consultoria Ativado","title":"Contrato de Consultoria Ativado","dot":"bg-emerald-500"}],"messages":[{"id":5,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","text":"Dossi\u00ea final homologado e entregue com sucesso \u00e0 Dire\u00e7\u00e3o.","data":"18\/09\/2026 17:30","is_staff":true,"fromUser":false}]}],
    printRequests: [{"id":13,"protocol":"SOL-2026-000013","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED","cliente":"gundja","empresa":"gundja","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Garrafas T\u00e9rmicas Inteligentes com Display LED: \ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","description":"\ud83d\udce6 Produto: Garrafas T\u00e9rmicas Inteligentes com Display LED\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Materiais promocionais \u0026 Brindes\n\ud83d\udc64 Solicitante: casimiro\n\ud83c\udfe2 Empresa: gundja\n\ud83d\udcde Telefone \/ WhatsApp: 1293797234927\n\u2709\ufe0f Email: casimirogundja@outlook.com\n\ud83d\udd22 Quantidade Estimada: 30\n\u23f1\ufe0f Prazo Desejado: Prazo Normal (3 a 5 dias \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nteste teste","data":"12\/10\/2026 02:06","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Normal","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"12\/10\/2026 02:06","date":"12\/10\/2026 02:06","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Garrafas T\u00e9rmicas Inteligentes com Display LED)","dot":"bg-indigo-500"}],"messages":[]},{"id":12,"protocol":"SOL-2026-000012","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm)","cliente":"Banco de Fomento Angola","empresa":"Banco de Fomento Angola","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banner Premium (85x200cm): \ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","description":"\ud83d\udce6 Produto: Roll-up Banner Premium (85x200cm)\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Linha 1 \u2014 Grande Formato\n\ud83d\udc64 Solicitante: Dr. Antonio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola\n\ud83d\udcde Telefone \/ WhatsApp: +244 923 111 222\n\u2709\ufe0f Email: antonio.silva@bfa.ao\n\ud83d\udd22 Quantidade Estimada: 5 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nPreciso para a confer\u00eancia de sexta-feira com acabamento mate.","data":"11\/10\/2026 23:23","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 23:23","date":"11\/10\/2026 23:23","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banner Premium (85x200cm))","dot":"bg-indigo-500"}],"messages":[]},{"id":11,"protocol":"SOL-2026-000011","business_unit_id":2,"title":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","titulo":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio","cliente":"Banco de Fomento Angola Teste","empresa":"Banco de Fomento Angola Teste","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Cota\u00e7\u00e3o Gr\u00e1fica: Roll-up Banners Autoportantes em Alum\u00ednio: \ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","description":"\ud83d\udce6 Produto: Roll-up Banners Autoportantes em Alum\u00ednio\n\ud83c\udff7\ufe0f Linha Gr\u00e1fica: Gr\u00e1fica para Eventos \u0026 Feiras\n\ud83d\udc64 Solicitante: Dr. Ant\u00f3nio Silva\n\ud83c\udfe2 Empresa: Banco de Fomento Angola Teste\n\ud83d\udcde Telefone \/ WhatsApp: +244 972 888 585\n\u2709\ufe0f Email: antonio.silva@bancoteste.ao\n\ud83d\udd22 Quantidade Estimada: 15 unidades\n\u23f1\ufe0f Prazo Desejado: Urg\u00eancia Expresso (24h a 48h \u00fateis)\n\n\ud83d\udcdd Especifica\u00e7\u00f5es \u0026 Detalhes:\nLonas de alta defini\u00e7\u00e3o anti-reflexo com estojos almofadados para confer\u00eancia.","data":"11\/10\/2026 20:47","status":"Nova","statusLabel":"Nova","status_key":"new","priority":"Urgent","sc":"s-novo","dot":"bg-indigo-500","responsavel":"Casimiro Gundja (Especialista Web)","technician":"Casimiro Gundja (Especialista Web)","timeline":[{"data":"11\/10\/2026 20:47","date":"11\/10\/2026 20:47","desc":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","title":"Solicita\u00e7\u00e3o de cota\u00e7\u00e3o enviada pelo cat\u00e1logo online (Roll-up Banners Autoportantes em Alum\u00ednio)","dot":"bg-indigo-500"}],"messages":[]},{"id":7,"protocol":"SOL-2026-000007","business_unit_id":2,"title":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","titulo":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Confec\u00e7\u00e3o de 500 Pastas Institucionais \u0026 Crach\u00e1s PVC: Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","description":"Impress\u00e3o em PVC 0.76mm com cord\u00e3o personalizado e pastas com acabamento especial e corte a laser.","data":"21\/09\/2026 10:15","status":"Em an\u00e1lise","statusLabel":"Em an\u00e1lise","status_key":"in_analysis","priority":"Normal","sc":"s-analise","dot":"bg-amber-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"21\/09\/2026 12:00","date":"21\/09\/2026 12:00","desc":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","title":"Em an\u00e1lise de viabilidade de mat\u00e9ria-prima e prazo de entrega.","dot":"bg-amber-500"}],"messages":[]},{"id":2,"protocol":"SOL-2026-000002","business_unit_id":2,"title":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","titulo":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos","cliente":"Super Administrador RACHI","empresa":"Super Administrador RACHI","servico":"RACHI Print","unit":"RACHI Print","unitBadge":"bg-amber-500\/15 text-amber-700 border-amber-200","descricao":"Produ\u00e7\u00e3o de Material Gr\u00e1fico \u0026 Brindes Corporativos: Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","description":"Impress\u00e3o offset de 1.000 cat\u00e1logos com lamina\u00e7\u00e3o fosca, 2 Roll-ups retr\u00e1teis e 200 pastas institucionais com bolsa.","data":"16\/09\/2026 14:00","status":"Em execu\u00e7\u00e3o","statusLabel":"Em execu\u00e7\u00e3o","status_key":"in_progress","priority":"Normal","sc":"s-exec","dot":"bg-cyan-500","responsavel":"Casimiro Gundja","technician":"Casimiro Gundja","timeline":[{"data":"20\/09\/2026 16:30","date":"20\/09\/2026 16:30","desc":"Em Fase de Acabamento \u0026 Corte","title":"Em Fase de Acabamento \u0026 Corte","dot":"bg-cyan-500"},{"data":"17\/09\/2026 11:20","date":"17\/09\/2026 11:20","desc":"Prova de Cor e Impress\u00e3o Aprovada","title":"Prova de Cor e Impress\u00e3o Aprovada","dot":"bg-cyan-500"},{"data":"16\/09\/2026 14:00","date":"16\/09\/2026 14:00","desc":"Ordem de Produ\u00e7\u00e3o Iniciada","title":"Ordem de Produ\u00e7\u00e3o Iniciada","dot":"bg-cyan-500"}],"messages":[{"id":3,"user_id":1,"nome":"Super Administrador RACHI","sender":"Super Administrador RACHI","message":"A prova digital ficou excelente, autorizamos a tiragem completa.","text":"A prova digital ficou excelente, autorizamos a tiragem completa.","data":"16\/09\/2026 15:30","is_staff":false,"fromUser":true},{"id":4,"user_id":7,"nome":"Casimiro Gundja","sender":"Casimiro Gundja","message":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","text":"\u00d3timo! Previs\u00e3o de entrega do lote para quinta-feira no vosso escrit\u00f3rio.","data":"16\/09\/2026 16:00","is_staff":true,"fromUser":false}]}],
    printQuotes: [],

    finMods: [
      { label: 'RACHI Store / Tec', icon: '🛒', value: "2.100.000,00", pct: 43, bc: 'bg-sky-500' },
      { label: 'RACHI Academy', icon: '🎓', value: "1.250.000,00", pct: 26, bc: 'bg-indigo-600' },
      { label: 'RACHI Print', icon: '🖨️', value: "450.000,00", pct: 9, bc: 'bg-amber-500' },
      { label: 'Human Capital', icon: '👥', value: "1.050.000,00", pct: 22, bc: 'bg-emerald-600' }
    ],

    txs: [{"id":"ord_3","icon":"\ud83d\uded2","desc":"Pedido #PED-2026-00003","cli":"gundja","data":"12\/10\/2026","tipo":"entrada","valor":"1.489.000,29","mod":"Tec"},{"id":"ord_1","icon":"\ud83d\uded2","desc":"Pedido #PED-2026-00001","cli":"Empresa Teste Luanda Lda","data":"12\/10\/2026","tipo":"entrada","valor":"2.978.000,58","mod":"Tec"},{"id":"ord_2","icon":"\ud83d\uded2","desc":"Pedido #PED-2026-00002","cli":"Super Administrador RACHI","data":"12\/10\/2026","tipo":"entrada","valor":"1.489.000,29","mod":"Tec"}],

    reports: [
      { key: 'clientes', icon: '👤', label: 'Clientes & Contactos', desc: '9 registos sincronizados', count: '9', bg: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400' },
      { key: 'financeiro', icon: '💰', label: 'Facturação & Vendas', desc: 'AOA 4.850.000,00 facturados', count: 'AOA 4.850.000,00', bg: 'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' },
      { key: 'pedidos', icon: '📦', label: 'Pedidos da Loja', desc: '3 pedidos de venda registados', count: '3', bg: 'bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400' },
      { key: 'solicitacoes', icon: '📋', label: 'Ordens & Solicitações', desc: '14 ordens de atendimento', count: '14', bg: 'bg-amber-50 text-amber-600 dark:bg-orange-500/10 dark:text-orange-400' },
      { key: 'academy', icon: '🎓', label: 'Academy & Cursos', desc: '12 formações no catálogo', count: '12', bg: 'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' },
      { key: 'capital', icon: '👥', label: 'Recrutamento & RH', desc: '8 soluções corporativas ativas', count: '8', bg: 'bg-teal-50 text-teal-600 dark:bg-teal-500/10 dark:text-teal-400' }
    ],

    notifs: [
      { icon: '📋', ib: 'bg-amber-50 text-amber-600 dark:bg-orange-500/10 dark:text-orange-400', titulo: 'Nova Demanda Corporativa', msg: 'A Empresa Alpha Lda. registou uma nova solicitação de recrutamento de TI.', data: '21/09/2026 09:00', lida: false },
      { icon: '🎓', ib: 'bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400', titulo: 'Nova Matrícula na Academy', msg: 'Pedro Alves matriculou-se em Cibersegurança e Proteção de Dados.', data: '21/09/2026 08:45', lida: false },
      { icon: '🛒', ib: 'bg-purple-50 text-purple-600 dark:bg-purple-500/10 dark:text-purple-400', titulo: 'Novo Pedido Loja #154', msg: 'Inov Quimua solicitou compra corporativa de 10 notebooks ThinkPad.', data: '21/09/2026 08:30', lida: false },
      { icon: '⚠️', ib: 'bg-yellow-50 text-yellow-600 dark:bg-yellow-500/10 dark:text-yellow-400', titulo: 'Alerta de Stock Mínimo', msg: 'Monitor LG 27" — restam apenas 3 unidades no stock central.', data: '20/09/2026 18:00', lida: false }
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

  // Tooltip flutuante instantâneo para sidebar recolhido (não cortado por overflow)
  const tip = document.createElement('div');
  tip.id = 'sidebar-floating-legend';
  tip.style.cssText = 'position:fixed;display:none;padding:6px 12px;border-radius:8px;font-size:11px;font-weight:700;letter-spacing:0.01em;white-space:nowrap;pointer-events:none;z-index:999999;transition:opacity 0.12s ease;';
  document.body.appendChild(tip);

  document.addEventListener('mouseover', (e) => {
    const sidebar = document.getElementById('admin-sidebar') || document.getElementById('client-sidebar');
    if (!sidebar || !sidebar.classList.contains('collapsed')) {
      tip.style.display = 'none';
      return;
    }
    const item = e.target.closest('[data-legend]');
    if (!item || !sidebar.contains(item)) {
      tip.style.display = 'none';
      return;
    }
    const txt = item.getAttribute('data-legend');
    if (!txt) {
      tip.style.display = 'none';
      return;
    }
    tip.textContent = txt;
    const isDark = document.documentElement.classList.contains('dark');
    tip.style.background = isDark ? '#071326' : '#ffffff';
    tip.style.color = isDark ? '#f8fafc' : '#0f172a';
    tip.style.border = isDark ? '1px solid rgba(0, 80, 240, 0.35)' : '1px solid #cbd5e1';
    tip.style.boxShadow = isDark ? '0 10px 25px rgba(0,0,0,0.6)' : '0 10px 25px rgba(0,0,0,0.12)';
    
    const r = item.getBoundingClientRect();
    tip.style.display = 'block';
    tip.style.left = (r.right + 12) + 'px';
    tip.style.top = (r.top + (r.height / 2) - 14) + 'px';
  });

  document.addEventListener('mouseout', (e) => {
    const item = e.target.closest('[data-legend]');
    if (item) tip.style.display = 'none';
  });
});
</script>
</body>
</html>
