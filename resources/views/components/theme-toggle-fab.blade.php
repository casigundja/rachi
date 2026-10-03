<!-- Botão Flutuante (FAB) de Alternância de Modo Claro / Escuro com Legenda -->
<button type="button"
    id="rachi-theme-toggle-fab"
    onclick="if(typeof toggleRachiTheme==='function'){toggleRachiTheme()}else if(typeof window.toggleRachiTheme==='function'){window.toggleRachiTheme()}else{var d=document.documentElement.classList.toggle('dark');localStorage.setItem('rachi_theme',d?'dark':'light');window.dispatchEvent(new CustomEvent('rachi-theme-changed',{detail:{dark:d}}));}"
    class="rachi-theme-fab group"
    aria-label="Alternar entre Modo Claro e Modo Escuro"
    title="Alternar entre Modo Claro e Modo Escuro">
    
    <!-- MODO CLARO ATIVO -> Exibe Lua + "Modo Escuro" -->
    <span class="fab-light-content">
        <svg class="w-4 h-4 text-slate-700 group-hover:text-[#0050f0] transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
        </svg>
        <span class="fab-label text-slate-800 group-hover:text-slate-950 font-bold text-xs tracking-wide">Modo Escuro</span>
    </span>

    <!-- MODO ESCURO ATIVO -> Exibe Sol + "Modo Claro" -->
    <span class="fab-dark-content">
        <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="4"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
        </svg>
        <span class="fab-label text-amber-100 group-hover:text-white font-bold text-xs tracking-wide">Modo Claro</span>
    </span>
</button>

<style>
/* RACHI FLOATING ACTION BUTTON (FAB) - WITH THEME LABEL (LEGENDA) */
.rachi-theme-fab {
    position: fixed !important;
    bottom: 1.5rem !important;
    right: 1.5rem !important;
    z-index: 9999 !important;
    width: auto !important;
    min-width: unset !important;
    height: 2.75rem !important;
    padding: 0 1.15rem !important;
    border-radius: 9999px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    user-select: none !important;
    white-space: nowrap !important;
    box-sizing: border-box !important;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    outline: none !important;
}

.rachi-theme-fab:active {
    transform: translateY(0) scale(0.97) !important;
}

.rachi-theme-fab .fab-label {
    line-height: 1 !important;
    white-space: nowrap !important;
}

/* LIGHT MODE */
html:not(.dark) .rachi-theme-fab {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(16px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
    border: 1px solid rgba(203, 213, 225, 0.95) !important;
    box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.12), 0 4px 8px -2px rgba(15, 23, 42, 0.06) !important;
    color: #1e293b !important;
}
html:not(.dark) .rachi-theme-fab:hover {
    background: #ffffff !important;
    border-color: rgba(0, 80, 240, 0.45) !important;
    box-shadow: 0 14px 32px -4px rgba(0, 80, 240, 0.22), 0 6px 12px -2px rgba(15, 23, 42, 0.1) !important;
    transform: translateY(-2px) scale(1.03) !important;
}
html:not(.dark) .rachi-theme-fab .fab-light-content {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
}
html:not(.dark) .rachi-theme-fab .fab-dark-content {
    display: none !important;
}

/* DARK MODE */
html.dark .rachi-theme-fab {
    background: rgba(15, 23, 42, 0.95) !important;
    backdrop-filter: blur(16px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
    border: 1px solid rgba(255, 255, 255, 0.16) !important;
    box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.6), 0 0 16px rgba(245, 158, 11, 0.18) !important;
    color: #fef08a !important;
}
html.dark .rachi-theme-fab:hover {
    background: rgba(30, 41, 59, 0.98) !important;
    border-color: rgba(245, 158, 11, 0.55) !important;
    box-shadow: 0 14px 36px -4px rgba(0, 0, 0, 0.7), 0 0 24px rgba(245, 158, 11, 0.3) !important;
    transform: translateY(-2px) scale(1.03) !important;
    color: #ffffff !important;
}
html.dark .rachi-theme-fab .fab-light-content {
    display: none !important;
}
html.dark .rachi-theme-fab .fab-dark-content {
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.5rem !important;
}

@media (max-width: 640px) {
    .rachi-theme-fab {
        bottom: 1.25rem !important;
        right: 1.25rem !important;
        height: 2.5rem !important;
        padding: 0 0.95rem !important;
    }
}
</style>
