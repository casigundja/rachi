<!-- ============================================================================== -->
<!-- RACHI FLOATING CONTROLS: TEMA (DARK/LIGHT) & TRADUTOR MULTI-IDIOMA (PT/EN/ZH)  -->
<!-- ============================================================================== -->

<div id="rachi-floating-dock" class="rachi-fab-dock" x-data="rachiFloatingDock()" @click.outside="langMenuOpen = false">

    <!-- 1. POPUP DE SELEÇÃO DE IDIOMA (PT / EN / ZH - MANDARIM) -->
    <div x-show="langMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         x-cloak
         class="rachi-lang-menu shadow-2xl">
        <div class="rachi-lang-menu-header">
            <span class="text-[10px] font-black uppercase tracking-widest text-[#00a3e0]">Idioma / Language / 语言</span>
        </div>
        <div class="rachi-lang-menu-list">
            <!-- Português -->
            <button type="button" @click="changeLang('pt')" onclick="setRachiLanguage('pt')" class="rachi-lang-item" :class="currentLang === 'pt' ? 'active' : ''" data-lang-option="pt">
                <span class="rachi-lang-flag">🇦🇴</span>
                <div class="rachi-lang-text">
                    <strong class="text-xs">Português</strong>
                    <span class="text-[10px] opacity-70">Padrão Oficial (PT)</span>
                </div>
                <span x-show="currentLang === 'pt'" class="rachi-lang-check">✓</span>
            </button>

            <!-- English -->
            <button type="button" @click="changeLang('en')" onclick="setRachiLanguage('en')" class="rachi-lang-item" :class="currentLang === 'en' ? 'active' : ''" data-lang-option="en">
                <span class="rachi-lang-flag">🇬🇧</span>
                <div class="rachi-lang-text">
                    <strong class="text-xs">English</strong>
                    <span class="text-[10px] opacity-70">English (EN)</span>
                </div>
                <span x-show="currentLang === 'en'" class="rachi-lang-check">✓</span>
            </button>

            <!-- Mandarim (中文) -->
            <button type="button" @click="changeLang('zh-CN')" onclick="setRachiLanguage('zh-CN')" class="rachi-lang-item" :class="currentLang === 'zh-CN' ? 'active' : ''" data-lang-option="zh-CN">
                <span class="rachi-lang-flag">🇨🇳</span>
                <div class="rachi-lang-text">
                    <strong class="text-xs">中文 (Mandarim)</strong>
                    <span class="text-[10px] opacity-70">Simplified Chinese (ZH)</span>
                </div>
                <span x-show="currentLang === 'zh-CN'" class="rachi-lang-check">✓</span>
            </button>
        </div>
    </div>

    <!-- 2. BOTÃO DO TRADUTOR FLUTUANTE -->
    <button type="button"
            id="rachi-lang-fab-btn"
            @click="langMenuOpen = !langMenuOpen"
            class="rachi-lang-fab group"
            aria-label="Alterar Idioma (Português, English, 中文)"
            title="Alterar Idioma / Change Language / 更改语言">
        <svg class="w-4 h-4 text-[#00a3e0] group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <path stroke-linecap="round" stroke-linejoin="round" d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
        <span class="rachi-lang-fab-label font-bold text-xs tracking-wide" x-text="langLabels[currentLang] || 'PT'">PT</span>
        <svg class="w-3 h-3 opacity-60 transition-transform duration-200" :class="langMenuOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    <!-- 3. BOTÃO FLUTUANTE DE TEMA (CLARO / ESCURO) -->
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

</div>

<!-- Content Container Oculto do Google Translate -->
<div id="google_translate_element" style="display:none !important;" aria-hidden="true"></div>

<!-- ============================================================================== -->
<!-- MOTOR JAVASCRIPT DO TRADUTOR RACHI (PT / EN / ZH - MANDARIM)                    -->
<!-- ============================================================================== -->
<script>
    (function() {
        // 1. Obter idioma salvo (localStorage ou Cookie)
        function getStoredLanguage() {
            try {
                var cookieMatch = document.cookie.match(/(^|;)\s*googtrans=([^;]+)/);
                if (cookieMatch) {
                    var val = decodeURIComponent(cookieMatch[2]);
                    if (val.indexOf('/zh-CN') !== -1 || val.indexOf('/zh') !== -1) return 'zh-CN';
                    if (val.indexOf('/en') !== -1) return 'en';
                    if (val.indexOf('/pt') !== -1) return 'pt';
                }
                var local = localStorage.getItem('rachi_lang');
                if (local === 'zh-CN' || local === 'zh') return 'zh-CN';
                if (local === 'en') return 'en';
                return 'pt';
            } catch (e) {
                return 'pt';
            }
        }

        // 2. Gravar cookies para Google Translate
        function setGoogleTranslateCookie(lang) {
            try {
                var host = window.location.hostname;
                var isIp = /^(\d{1,3}\.){3}\d{1,3}$/.test(host) || host === 'localhost' || host === '127.0.0.1';

                if (lang === 'pt') {
                    // Ao voltar para Português, limpa cookies de tradução e define /pt/pt
                    var exp = 'expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;';
                    document.cookie = 'googtrans=; ' + exp;
                    document.cookie = 'googtrans=; ' + exp + ' domain=' + host + ';';
                    document.cookie = 'googtrans=/pt/pt; path=/; max-age=31536000; SameSite=Lax';
                    if (!isIp) {
                        var parts = host.split('.');
                        if (parts.length >= 2) {
                            var rootDomain = '.' + parts.slice(-2).join('.');
                            document.cookie = 'googtrans=; ' + exp + ' domain=' + rootDomain + ';';
                            document.cookie = 'googtrans=/pt/pt; path=/; domain=' + rootDomain + '; max-age=31536000; SameSite=Lax';
                        }
                    }
                    return;
                }

                var cookieVal = '/pt/' + lang;
                var maxAge = 31536000;
                
                document.cookie = 'googtrans=' + cookieVal + '; path=/; max-age=' + maxAge + '; SameSite=Lax';
                document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + host + '; max-age=' + maxAge + '; SameSite=Lax';
                document.cookie = 'googtrans=/auto/' + lang + '; path=/; max-age=' + maxAge + '; SameSite=Lax';

                if (!isIp) {
                    var parts = host.split('.');
                    if (parts.length >= 2) {
                        var rootDomain = '.' + parts.slice(-2).join('.');
                        document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + rootDomain + '; max-age=' + maxAge + '; SameSite=Lax';
                        document.cookie = 'googtrans=/auto/' + lang + '; path=/; domain=' + rootDomain + '; max-age=' + maxAge + '; SameSite=Lax';
                    }
                }
            } catch(e) {}
        }

        // 3. Atualizar indicadores visuais no DOM (FAB, Menu e Rodapé)
        function updateVisualLangIndicators(lang) {
            try {
                document.documentElement.lang = (lang === 'zh-CN') ? 'zh-CN' : lang;

                // Atualizar texto do FAB
                var fabLabels = { 'pt': 'PT', 'en': 'EN', 'zh-CN': '中文' };
                document.querySelectorAll('.rachi-lang-fab-label').forEach(function(el) {
                    el.textContent = fabLabels[lang] || 'PT';
                });

                // Atualizar itens do menu dropdown
                document.querySelectorAll('[data-lang-option]').forEach(function(btn) {
                    var isSelected = btn.getAttribute('data-lang-option') === lang;
                    btn.classList.toggle('active', isSelected);
                    var check = btn.querySelector('.rachi-lang-check');
                    if (check) check.style.display = isSelected ? 'inline' : 'none';
                });

                // Atualizar botões de idioma no rodapé de todas as páginas
                document.querySelectorAll('[data-rachi-lang]').forEach(function(el) {
                    var elLang = el.getAttribute('data-rachi-lang');
                    if (elLang === lang) {
                        el.classList.add('text-amber-500', 'dark:text-amber-400', 'font-black');
                        el.classList.remove('opacity-60', 'opacity-70');
                    } else {
                        el.classList.remove('text-amber-500', 'dark:text-amber-400', 'font-black');
                        el.classList.add('opacity-70');
                    }
                });
            } catch(e) {}
        }

        // 4. Aplicar idioma no select do Google Translate (.goog-te-combo)
        function applyComboLanguage(lang) {
            var combo = document.querySelector('.goog-te-combo');
            if (combo) {
                var targetVal = (lang === 'pt') ? 'pt' : lang;
                if (combo.value !== targetVal) {
                    combo.value = targetVal;
                    combo.dispatchEvent(new Event('change'));
                }
                return true;
            }
            return false;
        }

        // 5. Função global para troca de idioma
        window.setRachiLanguage = function(lang) {
            if (!lang) lang = 'pt';
            try { localStorage.setItem('rachi_lang', lang); } catch(e) {}
            setGoogleTranslateCookie(lang);
            updateVisualLangIndicators(lang);

            window.dispatchEvent(new CustomEvent('rachi-lang-changed', { detail: { lang: lang } }));

            var applied = applyComboLanguage(lang);
            if (!applied) {
                var attempts = 0;
                var interval = setInterval(function() {
                    attempts++;
                    if (applyComboLanguage(lang) || attempts > 15) {
                        clearInterval(interval);
                        if (!document.querySelector('.goog-te-combo')) {
                            window.location.reload();
                        }
                    }
                }, 100);
            }
        };

        // 6. Callback oficial do Google Translate
        window.googleTranslateElementInit = function() {
            try {
                new google.translate.TranslateElement({
                    pageLanguage: 'pt',
                    includedLanguages: 'pt,en,zh-CN',
                    autoDisplay: false
                }, 'google_translate_element');

                var saved = getStoredLanguage();
                updateVisualLangIndicators(saved);

                if (saved && saved !== 'pt') {
                    var attempts = 0;
                    var pollInterval = setInterval(function() {
                        attempts++;
                        if (applyComboLanguage(saved) || attempts >= 40) {
                            clearInterval(pollInterval);
                        }
                    }, 150);
                }
            } catch(e) {
                console.warn('Google Translate initialization:', e);
            }
        };

        // 7. Inserir script do Google Translate de forma segura (HTTPS)
        if (!document.getElementById('google-translate-script')) {
            var s = document.createElement('script');
            s.id = 'google-translate-script';
            s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            s.async = true;
            s.defer = true;
            document.head.appendChild(s);
        }

        // 8. Alpine.js Component + Fallback Vanilla JS
        window.rachiFloatingDock = function() {
            return {
                langMenuOpen: false,
                currentLang: getStoredLanguage(),
                langLabels: {
                    'pt': 'PT',
                    'en': 'EN',
                    'zh-CN': '中文'
                },
                init() {
                    window.addEventListener('rachi-lang-changed', (e) => {
                        this.currentLang = e.detail.lang;
                    });
                    updateVisualLangIndicators(this.currentLang);
                },
                changeLang(lang) {
                    this.langMenuOpen = false;
                    this.currentLang = lang;
                    window.setRachiLanguage(lang);
                }
            };
        };

        // Vanilla JS Fallback para abrir/fechar menu de idiomas
        document.addEventListener('DOMContentLoaded', function() {
            var current = getStoredLanguage();
            updateVisualLangIndicators(current);

            var fabBtn = document.getElementById('rachi-lang-fab-btn');
            var menu = document.getElementById('rachi-lang-menu');
            if (fabBtn && menu) {
                fabBtn.addEventListener('click', function(e) {
                    if (!window.Alpine) {
                        e.stopPropagation();
                        menu.classList.toggle('hidden');
                    }
                });
                document.addEventListener('click', function(e) {
                    if (!window.Alpine && menu && !menu.contains(e.target) && !fabBtn.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });
    })();
</script>

<!-- ============================================================================== -->
<!-- ESTILOS DO FLOATING DOCK, MENU DE IDIOMAS & HIGIENIZAÇÃO DO GOOGLE TRANSLATE   -->
<!-- ============================================================================== -->
<style>
/* 1. DOCK FLUTUANTE INFERIOR DIREITO */
.rachi-fab-dock {
    position: fixed !important;
    bottom: 1.5rem !important;
    right: 1.5rem !important;
    z-index: 9999 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.65rem !important;
}

/* 2. BOTÃO DO IDIOMA */
.rachi-lang-fab {
    height: 2.75rem !important;
    padding: 0 1rem !important;
    border-radius: 9999px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 0.45rem !important;
    cursor: pointer !important;
    user-select: none !important;
    white-space: nowrap !important;
    outline: none !important;
    box-sizing: border-box !important;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* LIGHT MODE DO IDIOMA */
html:not(.dark) .rachi-lang-fab {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(16px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
    border: 1px solid rgba(203, 213, 225, 0.95) !important;
    box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.12), 0 4px 8px -2px rgba(15, 23, 42, 0.06) !important;
    color: #1e293b !important;
}
html:not(.dark) .rachi-lang-fab:hover {
    background: #ffffff !important;
    border-color: rgba(0, 163, 224, 0.5) !important;
    box-shadow: 0 14px 32px -4px rgba(0, 163, 224, 0.22) !important;
    transform: translateY(-2px) scale(1.02) !important;
}

/* DARK MODE DO IDIOMA */
html.dark .rachi-lang-fab {
    background: rgba(15, 23, 42, 0.95) !important;
    backdrop-filter: blur(16px) saturate(180%) !important;
    -webkit-backdrop-filter: blur(16px) saturate(180%) !important;
    border: 1px solid rgba(255, 255, 255, 0.16) !important;
    box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.6) !important;
    color: #f1f5f9 !important;
}
html.dark .rachi-lang-fab:hover {
    background: rgba(30, 41, 59, 0.98) !important;
    border-color: rgba(0, 163, 224, 0.5) !important;
    transform: translateY(-2px) scale(1.02) !important;
}

/* 3. MENU POPOVER DO IDIOMA */
.rachi-lang-menu {
    position: absolute !important;
    bottom: calc(100% + 0.75rem) !important;
    right: 0 !important;
    width: 15rem !important;
    border-radius: 1.25rem !important;
    padding: 0.5rem !important;
    z-index: 10000 !important;
}
html:not(.dark) .rachi-lang-menu {
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(20px) saturate(190%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(190%) !important;
    border: 1px solid rgba(226, 232, 240, 0.95) !important;
    box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.18) !important;
}
html.dark .rachi-lang-menu {
    background: rgba(7, 19, 38, 0.98) !important;
    backdrop-filter: blur(20px) saturate(190%) !important;
    -webkit-backdrop-filter: blur(20px) saturate(190%) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 20px 45px -10px rgba(0, 0, 0, 0.6) !important;
}
.rachi-lang-menu-header {
    padding: 0.5rem 0.75rem 0.35rem !important;
    border-bottom: 1px solid rgba(148, 163, 184, 0.15) !important;
    margin-bottom: 0.25rem !important;
}
.rachi-lang-item {
    width: 100% !important;
    display: flex !important;
    align-items: center !important;
    gap: 0.75rem !important;
    padding: 0.6rem 0.75rem !important;
    border-radius: 0.85rem !important;
    text-align: left !important;
    cursor: pointer !important;
    transition: all 0.18s ease !important;
    border: none !important;
    background: transparent !important;
}
html:not(.dark) .rachi-lang-item {
    color: #1e293b !important;
}
html:not(.dark) .rachi-lang-item:hover {
    background: #f1f5f9 !important;
    color: #0077c2 !important;
}
html:not(.dark) .rachi-lang-item.active {
    background: rgba(0, 163, 224, 0.12) !important;
    color: #0077c2 !important;
    font-weight: 700 !important;
}
html.dark .rachi-lang-item {
    color: #e2e8f0 !important;
}
html.dark .rachi-lang-item:hover {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #38bdf8 !important;
}
html.dark .rachi-lang-item.active {
    background: rgba(0, 163, 224, 0.2) !important;
    color: #38bdf8 !important;
    font-weight: 700 !important;
}
.rachi-lang-flag {
    font-size: 1.25rem !important;
    line-height: 1 !important;
}
.rachi-lang-text {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
}
.rachi-lang-check {
    color: #00a3e0 !important;
    font-weight: 900 !important;
}

/* 4. BOTÃO DO TEMA (CLARO/ESCURO) */
.rachi-theme-fab {
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

/* 5. HIGIENIZAÇÃO COMPLETA DO GOOGLE TRANSLATE (SEM BANNERS NEM QUEBRAS DE LAYOUT) */
.goog-te-banner-frame.skiptranslate,
iframe.goog-te-banner-frame {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    border: none !important;
}
body {
    top: 0px !important;
    position: static !important;
}
.goog-te-gadget {
    display: none !important;
}
#goog-gt-tt, 
.goog-te-balloon-frame {
    display: none !important;
    visibility: hidden !important;
}
.goog-text-highlight {
    background: none !important;
    box-shadow: none !important;
}
#google_translate_element {
    display: none !important;
}

@media (max-width: 640px) {
    .rachi-fab-dock {
        bottom: 1.25rem !important;
        right: 1.25rem !important;
        gap: 0.45rem !important;
    }
    .rachi-lang-fab {
        height: 2.5rem !important;
        padding: 0 0.85rem !important;
    }
    .rachi-theme-fab {
        height: 2.5rem !important;
        padding: 0 0.95rem !important;
    }
    .rachi-lang-menu {
        width: 13.5rem !important;
        right: 0 !important;
    }
}
</style>
