<script>
    (function() {
        // ==============================================================================
        // 1. GESTÃO DE ESTADO DO IDIOMA (PT / EN / ZH - MANDARIM)
        // ==============================================================================
        function getStoredLanguage() {
            try {
                var local = localStorage.getItem('rachi_lang');
                if (local === 'zh-CN' || local === 'zh') return 'zh-CN';
                if (local === 'en') return 'en';
                if (local === 'pt') return 'pt';

                var cookieMatch = document.cookie.match(/(^|;)\s*googtrans=([^;]+)/);
                if (cookieMatch) {
                    var val = decodeURIComponent(cookieMatch[2]);
                    if (val.indexOf('/zh-CN') !== -1 || val.indexOf('/zh') !== -1) return 'zh-CN';
                    if (val.indexOf('/en') !== -1) return 'en';
                }
                return 'pt';
            } catch (e) {
                return 'pt';
            }
        }

        // ==============================================================================
        // 2. COOKIES DE TRADUÇÃO (GOOGLE TRANSLATE SEGURO E HIGIENIZADO)
        // ==============================================================================
        function setGoogleTranslateCookie(lang) {
            try {
                var host = window.location.hostname;
                var isIp = /^(\d{1,3}\.){3}\d{1,3}$/.test(host) || host === 'localhost' || host === '127.0.0.1';
                var rootDomain = '';
                if (!isIp && host.indexOf('.') !== -1) {
                    var parts = host.split('.');
                    if (parts.length >= 2) {
                        rootDomain = '.' + parts.slice(-2).join('.');
                    }
                }

                if (lang === 'pt') {
                    var exp = 'expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    document.cookie = 'googtrans=; ' + exp;
                    document.cookie = 'googtrans=; ' + exp + ' domain=' + host + ';';
                    if (rootDomain) {
                        document.cookie = 'googtrans=; ' + exp + ' domain=' + rootDomain + ';';
                    }
                    return;
                }

                var cookieVal = '/pt/' + lang;
                var maxAge = 31536000;
                document.cookie = 'googtrans=' + cookieVal + '; path=/; max-age=' + maxAge + '; SameSite=Lax';
                document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + host + '; max-age=' + maxAge + '; SameSite=Lax';
                if (!isIp && rootDomain) {
                    document.cookie = 'googtrans=' + cookieVal + '; path=/; domain=' + rootDomain + '; max-age=' + maxAge + '; SameSite=Lax';
                }
            } catch(e) {}
        }

        // ==============================================================================
        // 3. DICIONÁRIO COMPLETO DE TRADUÇÃO INSTANTÂNEA (ZERO DELAY / OFFLINE-READY)
        // ==============================================================================
        var RACHI_I18N = {
            en: {
                "Home": "Home",
                "Sobre Nós": "About Us",
                "Soluções": "Solutions",
                "Ética e Compliance": "Ethics & Compliance",
                "Loja": "Store",
                "Contacto": "Contact",
                "Contactos": "Contacts",
                "Aceder à Plataforma": "Access Platform",
                "Aceder à plataforma": "Access Platform",
                "ACEDER À PLATAFORMA": "ACCESS PLATFORM",
                "Criar conta gratuita": "Create free account",
                "Ainda não tem conta?": "Don't have an account yet?",
                "Já tem conta?": "Already have an account?",
                "Já tem uma conta registada?": "Already registered?",
                "Fazer login": "Log In",
                "Iniciar Sessão": "Sign In",
                "INICIAR SESSÃO": "SIGN IN",
                "Criar conta": "Create account",
                "CRIAR CONTA": "CREATE ACCOUNT",
                "Ecossistema de Soluções Inteligentes": "Ecosystem of Intelligent Solutions",
                "Soluções Inteligentes": "Intelligent Solutions",
                "Tecnologia, produção gráfica, formação profissional e capital humano integrados para potenciar empresas em Angola.": "Technology, graphic production, professional training and human capital integrated to empower businesses in Angola.",
                "Explorar Soluções": "Explore Solutions",
                "Fale Connosco": "Contact Us",
                "Ver Soluções": "View Solutions",
                "O nosso diferencial": "Our Difference",
                "O Nosso Diferencial": "Our Difference",
                "O NOSSO DIFERENCIAL": "OUR DIFFERENCE",
                "Foco no que realmente importa": "Focus on What Really Matters",
                "PESSOAS • PROCESSOS • TECNOLOGIA": "PEOPLE • PROCESSES • TECHNOLOGY",
                "Pessoas • Processos • Tecnologia": "People • Processes • Technology",
                "Pessoas, Processos e Tecnologia": "People, Processes and Technology",
                "VER MISSÃO, VISÃO E VALORES": "VIEW MISSION, VISION AND VALUES",
                "Ver Missão, Visão e Valores": "View Mission, Vision and Values",
                "Missão, Visão e Valores": "Mission, Vision and Values",
                "Missão": "Mission",
                "Visão": "Vision",
                "Valores": "Values",
                "Sede & Contactos": "Headquarters & Contacts",
                "SEDE & CONTACTOS": "HEADQUARTERS & CONTACTS",
                "Sede Administrativa": "Administrative Headquarters",
                "Rua Ndunduma": "Rua Ndunduma",
                "Miramar – Luanda, Angola": "Miramar – Luanda, Angola",
                "Por detrás do BFA": "Behind BFA",
                "Links Úteis": "Quick Links",
                "Unidades": "Business Units",
                "Quem somos": "Who we are",
                "O que fazemos": "What we do",
                "Parceiros": "Partners",
                "Testemunhos": "Testimonials",
                "Política de Privacidade": "Privacy Policy",
                "Política de Privacidade (Lei 22/11)": "Privacy Policy (Law 22/11)",
                "Termos e Condições": "Terms & Conditions",
                "Termos e Condições de Uso": "Terms & Conditions of Use",
                "Política de Cookies": "Cookies Policy",
                "Reclamações e Denúncia": "Complaints & Whistleblowing",
                "Canal de Reclamações e Denúncia": "Complaints & Whistleblowing Channel",
                "Apresentar Reclamação": "Submit Complaint",
                "Canal de Denúncia": "Whistleblowing Channel",
                "Todos os direitos reservados.": "All rights reserved.",
                "Todos os direitos reservados. República de Angola.": "All rights reserved. Republic of Angola.",
                "Modo Claro": "Light Mode",
                "Modo Escuro": "Dark Mode",
                "Segunda a Sexta: 08h00 às 17h00": "Monday to Friday: 08:00 to 17:00",
                "Horário: Seg-Sex 08h às 17h": "Hours: Mon-Fri 08:00 to 17:00",
                "Capacitação Profissional": "Professional Training",
                "Recursos Humanos": "Human Resources",
                "Produção Gráfica": "Graphic Production",
                "Tecnologia & TI": "Technology & IT",
                "Mais do que prestar serviços, construímos parcerias estratégicas que transformam potencial em resultados sólidos.": "More than providing services, we build strategic partnerships that transform potential into solid results.",
                "O diferencial da RACHI está na capacidade de integrar, num só ecossistema, soluções essenciais para a estruturação, modernização e crescimento das empresas.": "RACHI's differential lies in the capacity to integrate, in a single ecosystem, essential solutions for company structuring, modernization and growth.",
                "Não actuamos apenas sobre problemas isolados. Analisamos a realidade de cada negócio, identificamos os seus principais desafios e desenvolvemos soluções ajustadas às suas necessidades, combinando formalização empresarial, tecnologia, presença de marca e capacitação contínua.": "We do not merely act on isolated problems. We analyze each business's reality, identify key challenges, and build solutions tailored to their needs, combining corporate formalization, technology, branding, and ongoing training."
            },
            "zh-CN": {
                "Home": "首页",
                "Sobre Nós": "关于我们",
                "Soluções": "解决方案",
                "Ética e Compliance": "道德与合规",
                "Loja": "在线商城",
                "Contacto": "联系我们",
                "Contactos": "联系我们",
                "Aceder à Plataforma": "进入平台",
                "Aceder à plataforma": "进入平台",
                "ACEDER À PLATAFORMA": "进入平台",
                "Criar conta gratuita": "免费注册账户",
                "Ainda não tem conta?": "还没有账户？",
                "Já tem conta?": "已有账户？",
                "Já tem uma conta registada?": "已有注册账户？",
                "Fazer login": "立即登录",
                "Iniciar Sessão": "登录",
                "INICIAR SESSÃO": "登录",
                "Criar conta": "创建账户",
                "CRIAR CONTA": "创建账户",
                "Ecossistema de Soluções Inteligentes": "智能化解决方案生态系统",
                "Soluções Inteligentes": "智能化解决方案",
                "Tecnologia, produção gráfica, formação profissional e capital humano integrados para potenciar empresas em Angola.": "整合技术、图文印刷、专业培训和人力资本，助力安哥拉企业成长。",
                "Explorar Soluções": "探索解决方案",
                "Fale Connosco": "联系我们",
                "Ver Soluções": "查看解决方案",
                "O nosso diferencial": "我们的核心优势",
                "O Nosso Diferencial": "我们的核心优势",
                "O NOSSO DIFERENCIAL": "我们的核心优势",
                "Foco no que realmente importa": "聚焦于真正核心价值",
                "PESSOAS • PROCESSOS • TECNOLOGIA": "人员 • 流程 • 科技",
                "Pessoas • Processos • Tecnologia": "人员 • 流程 • 科技",
                "Pessoas, Processos e Tecnologia": "人员、流程与科技",
                "VER MISSÃO, VISÃO E VALORES": "查看使命、愿景与价值观",
                "Ver Missão, Visão e Valores": "查看使命、愿景与价值观",
                "Missão, Visão e Valores": "使命、愿景与价值观",
                "Missão": "使命",
                "Visão": "愿景",
                "Valores": "核心价值观",
                "Sede & Contactos": "总部与联系方式",
                "SEDE & CONTACTOS": "总部与联系方式",
                "Sede Administrativa": "行政总部",
                "Rua Ndunduma": "Ndunduma 街",
                "Miramar – Luanda, Angola": "Miramar – 罗安达，安哥拉",
                "Por detrás do BFA": "BFA 银行后侧",
                "Links Úteis": "常用链接",
                "Unidades": "业务板块",
                "Quem somos": "关于我们",
                "O que fazemos": "业务范围",
                "Parceiros": "合作伙伴",
                "Testemunhos": "客户评价",
                "Política de Privacidade": "隐私政策",
                "Política de Privacidade (Lei 22/11)": "隐私政策（第22/11号法）",
                "Termos e Condições": "服务条款",
                "Termos e Condições de Uso": "使用条款与条件",
                "Política de Cookies": "Cookie政策",
                "Reclamações e Denúncia": "投诉与举报",
                "Canal de Reclamações e Denúncia": "官方投诉与道德举报渠道",
                "Apresentar Reclamação": "提交投诉",
                "Canal de Denúncia": "举报渠道",
                "Todos os direitos reservados.": "保留所有权利。",
                "Todos os direitos reservados. República de Angola.": "保留所有权利。安哥拉共和国。",
                "Modo Claro": "明亮模式",
                "Modo Escuro": "暗黑模式",
                "Segunda a Sexta: 08h00 às 17h00": "周一至周五：08:00 至 17:00",
                "Horário: Seg-Sex 08h às 17h": "营业时间：周一至周五 08:00-17:00",
                "Capacitação Profissional": "专业人才培训",
                "Recursos Humanos": "人力资源管理",
                "Produção Gráfica": "图文印刷出版",
                "Tecnologia & TI": "IT技术与系统",
                "Mais do que prestar serviços, construímos parcerias estratégicas que transformam potencial em resultados sólidos.": "不仅是提供服务，我们更建立战略伙伴关系，将潜能转化为坚实成果。",
                "O diferencial da RACHI está na capacidade de integrar, num só ecossistema, soluções essenciais para a estruturação, modernização e crescimento das empresas.": "RACHI的核心优势在于能够在统一的生态系统中，整合企业构建、现代化和发展所需的核心解决方案。",
                "Não actuamos apenas sobre problemas isolados. Analisamos a realidade de cada negócio, identificamos os seus principais desafios e desenvolvemos soluções ajustadas às suas necessidades, combinando formalização empresarial, tecnologia, presença de marca e capacitação contínua.": "我们不只解决孤立问题。我们深入分析每个企业的实际情况，明确主要挑战，结合企业合规、科技创新、品牌形象和持续赋能，提供量身定制的解决方案。"
            }
        };

        // ==============================================================================
        // 4. MOTOR DE TRADUÇÃO INSTANTÂNEA NO DOM
        // ==============================================================================
        function applyDomTranslation(lang) {
            var dict = RACHI_I18N[lang];
            var isPt = (lang === 'pt' || !dict);

            function walk(node) {
                if (!node) return;
                if (node.nodeType === 3) {
                    var txt = node.nodeValue;
                    if (!txt || !txt.trim()) return;

                    if (node.__rachi_orig === undefined) {
                        node.__rachi_orig = txt;
                    }

                    if (isPt) {
                        if (node.__rachi_orig !== undefined && node.nodeValue !== node.__rachi_orig) {
                            node.nodeValue = node.__rachi_orig;
                        }
                        return;
                    }

                    var trimmed = txt.trim();
                    if (dict[trimmed]) {
                        var leading = txt.match(/^\s*/)[0];
                        var trailing = txt.match(/\s*$/)[0];
                        node.nodeValue = leading + dict[trimmed] + trailing;
                    } else if (node.__rachi_orig && dict[node.__rachi_orig.trim()]) {
                        var origTrimmed = node.__rachi_orig.trim();
                        var leading = node.__rachi_orig.match(/^\s*/)[0];
                        var trailing = node.__rachi_orig.match(/\s*$/)[0];
                        node.nodeValue = leading + dict[origTrimmed] + trailing;
                    }
                } else if (node.nodeType === 1) {
                    var tag = node.tagName.toLowerCase();
                    if (tag === 'script' || tag === 'style' || tag === 'noscript' || tag === 'svg' || tag === 'code' || tag === 'pre') return;
                    if (node.classList && (node.classList.contains('rachi-fab-dock') || node.classList.contains('notranslate'))) return;

                    for (var child = node.firstChild; child; child = child.nextSibling) {
                        walk(child);
                    }
                }
            }

            walk(document.body || document.documentElement);
        }

        // ==============================================================================
        // 5. ATUALIZAR INDICADORES VISUAIS NO DOM (BOTÕES DO RODAPÉ, MENU E FAB)
        // ==============================================================================
        function updateVisualLangIndicators(lang) {
            try {
                document.documentElement.lang = (lang === 'zh-CN') ? 'zh-CN' : lang;

                // 1. Atualizar texto do Floating Action Button (FAB)
                var fabLabels = { 'pt': 'PT', 'en': 'EN', 'zh-CN': '中文' };
                document.querySelectorAll('.rachi-lang-fab-label').forEach(function(el) {
                    el.textContent = fabLabels[lang] || 'PT';
                });

                // 2. Atualizar menu popover flutuante
                document.querySelectorAll('[data-lang-option]').forEach(function(btn) {
                    var isSelected = btn.getAttribute('data-lang-option') === lang;
                    btn.classList.toggle('active', isSelected);
                    var check = btn.querySelector('.rachi-lang-check');
                    if (check) check.style.display = isSelected ? 'inline' : 'none';
                });

                // 3. Atualizar botões PT | EN | 中文 no rodapé de todas as páginas
                document.querySelectorAll('[data-rachi-lang]').forEach(function(el) {
                    var elLang = el.getAttribute('data-rachi-lang');
                    if (elLang === lang) {
                        el.classList.add('text-amber-500', 'dark:text-amber-400', 'font-black');
                        el.classList.remove('opacity-60', 'opacity-70', 'font-normal');
                    } else {
                        el.classList.remove('text-amber-500', 'dark:text-amber-400', 'font-black', 'font-bold');
                        el.classList.add('opacity-70', 'font-normal');
                    }
                });
            } catch(e) {}
        }

        // ==============================================================================
        // 6. APLICAR NO SELECT DO GOOGLE TRANSLATE (.goog-te-combo)
        // ==============================================================================
        function applyComboLanguage(lang) {
            var combo = document.querySelector('.goog-te-combo');
            if (combo && combo.options && combo.options.length > 0) {
                var targetVal = '';
                if (lang === 'pt') {
                    targetVal = '';
                } else if (lang === 'en') {
                    targetVal = 'en';
                } else if (lang === 'zh-CN' || lang === 'zh') {
                    for (var i = 0; i < combo.options.length; i++) {
                        var v = combo.options[i].value;
                        if (v === 'zh-CN' || v === 'zh' || v.indexOf('zh') !== -1) {
                            targetVal = v;
                            break;
                        }
                    }
                    if (!targetVal) targetVal = 'zh-CN';
                }

                if (combo.value !== targetVal) {
                    combo.value = targetVal;
                    combo.dispatchEvent(new Event('change', { bubbles: true, cancelable: true }));
                    if (typeof combo.onchange === 'function') {
                        combo.onchange();
                    }
                }
                return true;
            }
            return false;
        }

        // ==============================================================================
        // 7. FUNÇÃO GLOBAL DE MUDANÇA DE IDIOMA (CHAMADA PELOS BOTÕES)
        // ==============================================================================
        window.setRachiLanguage = function(lang) {
            if (!lang) lang = 'pt';
            if (lang === 'zh') lang = 'zh-CN';

            try { localStorage.setItem('rachi_lang', lang); } catch(e) {}
            setGoogleTranslateCookie(lang);
            updateVisualLangIndicators(lang);
            applyDomTranslation(lang);

            window.dispatchEvent(new CustomEvent('rachi-lang-changed', { detail: { lang: lang } }));

            if (applyComboLanguage(lang)) {
                return;
            }

            // Tenta sincronizar com o Google Translate assim que o script terminar de carregar
            var attempts = 0;
            var interval = setInterval(function() {
                attempts++;
                if (applyComboLanguage(lang) || attempts >= 30) {
                    clearInterval(interval);
                }
            }, 100);
        };

        // ==============================================================================
        // 8. CALLBACK OFICIAL DO GOOGLE TRANSLATE ELEMENT
        // ==============================================================================
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
                    applyDomTranslation(saved);
                    var attempts = 0;
                    var pollInterval = setInterval(function() {
                        attempts++;
                        if (applyComboLanguage(saved) || attempts >= 40) {
                            clearInterval(pollInterval);
                        }
                    }, 150);
                }
            } catch(e) {}
        };

        // ==============================================================================
        // 9. INSERIR SCRIPT DO GOOGLE TRANSLATE (SEGURO E ASSÍNCRONO)
        // ==============================================================================
        if (!document.getElementById('google-translate-script')) {
            var s = document.createElement('script');
            s.id = 'google-translate-script';
            s.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
            s.async = true;
            s.defer = true;
            document.head.appendChild(s);
        }

        // ==============================================================================
        // 10. COMPONENTE ALPINE.JS + FALLBACK DIRETO NO DOM
        // ==============================================================================
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

        // Listener global de clique nos botões data-rachi-lang (rodapé e navegação)
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('[data-rachi-lang]');
            if (btn) {
                e.preventDefault();
                var l = btn.getAttribute('data-rachi-lang');
                if (l) window.setRachiLanguage(l);
            }
        });

        // Inicialização ao carregar a página
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                var current = getStoredLanguage();
                updateVisualLangIndicators(current);
                if (current && current !== 'pt') {
                    applyDomTranslation(current);
                }
            });
        } else {
            var current = getStoredLanguage();
            updateVisualLangIndicators(current);
            if (current && current !== 'pt') {
                applyDomTranslation(current);
            }
        }
    })();
</script>

<!-- ============================================================================== -->
<!-- RACHI FLOATING CONTROLS: TEMA (DARK/LIGHT) & TRADUTOR MULTI-IDIOMA (PT/EN/ZH)  -->
<!-- ============================================================================== -->

<div id="rachi-floating-dock" class="rachi-fab-dock notranslate" x-data="rachiFloatingDock()" @click.outside="langMenuOpen = false">

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

<!-- Content Container Oculto do Google Translate (Renderizável fora da tela) -->
<div id="google_translate_element" class="rachi-gt-host notranslate" aria-hidden="true"></div>

<!-- ============================================================================== -->
<!-- ESTILOS DO FLOATING DOCK, MENU DE IDIOMAS & HIGIENIZAÇÃO DO GOOGLE TRANSLATE   -->
<!-- ============================================================================== -->
<style>
/* 1. CONTAINER DO GOOGLE TRANSLATE (OFF-SCREEN PARA NÃO BLOQUEAR A INICIALIZAÇÃO) */
.rachi-gt-host,
#google_translate_element {
    position: absolute !important;
    top: -9999px !important;
    left: -9999px !important;
    width: 1px !important;
    height: 1px !important;
    overflow: hidden !important;
    opacity: 0 !important;
    pointer-events: none !important;
    visibility: visible !important;
}

/* 2. DOCK FLUTUANTE INFERIOR DIREITO */
.rachi-fab-dock {
    position: fixed !important;
    bottom: 1.5rem !important;
    right: 1.5rem !important;
    z-index: 9999 !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 0.65rem !important;
}
.rachi-fab-dock .rachi-theme-fab {
    position: relative !important;
    bottom: auto !important;
    right: auto !important;
    z-index: auto !important;
    display: inline-flex !important;
}
.rachi-fab-dock .rachi-lang-fab {
    position: relative !important;
    bottom: auto !important;
    right: auto !important;
    z-index: auto !important;
    display: inline-flex !important;
}

/* 3. BOTÃO DO IDIOMA */
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

/* 4. MENU POPOVER DO IDIOMA */
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

/* 5. BOTÃO DO TEMA (CLARO/ESCURO) */
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

/* 6. HIGIENIZAÇÃO COMPLETA DO GOOGLE TRANSLATE (SEM BANNERS NEM QUEBRAS DE LAYOUT) */
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

@media (max-width: 768px) {
    /* UNIVERSAL SAFARI/WEBKIT GPU TILE DEFENSE ON MOBILE */
    .site-header {
        -webkit-backdrop-filter: none !important;
        backdrop-filter: none !important;
    }
    html:not(.dark) .site-header {
        background: #ffffff !important;
    }
    html.dark .site-header {
        background: #071326 !important;
    }
    .blur-3xl, .blur-2xl, .blur-xl, [class*="blur-3xl"], [class*="blur-2xl"] {
        display: none !important;
        filter: none !important;
        -webkit-filter: none !important;
    }
    .site-header .btn-entrar-nav[style*="display: none"],
    .site-header .btn-entrar-nav[style*="display:none"],
    .btn-entrar-nav[style*="display: none"],
    .btn-entrar-nav[style*="display:none"] {
        display: none !important;
    }
    .rachi-fab-dock {
        bottom: calc(1rem + env(safe-area-inset-bottom, 0px)) !important;
        right: 1rem !important;
        gap: 0.45rem !important;
        z-index: 9999 !important;
    }
    .rachi-lang-fab {
        height: 2.35rem !important;
        padding: 0 0.65rem !important;
        gap: 0.25rem !important;
        font-size: 0.72rem !important;
        border-radius: 9999px !important;
    }
    html:not(.dark) .rachi-lang-fab {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid rgba(203, 213, 225, 0.9) !important;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12) !important;
        color: #0f172a !important;
    }
    html.dark .rachi-lang-fab {
        background: rgba(15, 23, 42, 0.95) !important;
        border: 1px solid rgba(255, 255, 255, 0.16) !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.5) !important;
        color: #ffffff !important;
    }
    .rachi-lang-fab svg.w-3 {
        display: none !important;
    }
    .rachi-theme-fab {
        width: 2.35rem !important;
        height: 2.35rem !important;
        padding: 0 !important;
        border-radius: 9999px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .rachi-theme-fab .fab-label {
        display: none !important;
    }
    html:not(.dark) .rachi-theme-fab {
        background: rgba(255, 255, 255, 0.95) !important;
        border: 1px solid rgba(203, 213, 225, 0.9) !important;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12) !important;
        color: #1e293b !important;
    }
    html:not(.dark) .rachi-theme-fab span.fab-light-content {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    html:not(.dark) .rachi-theme-fab span.fab-dark-content {
        display: none !important;
    }
    html.dark .rachi-theme-fab {
        background: rgba(15, 23, 42, 0.95) !important;
        border: 1px solid rgba(245, 158, 11, 0.35) !important;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.5), 0 0 12px rgba(245, 158, 11, 0.2) !important;
        color: #fef08a !important;
    }
    html.dark .rachi-theme-fab span.fab-light-content {
        display: none !important;
    }
    html.dark .rachi-theme-fab span.fab-dark-content {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .rachi-lang-menu {
        width: 13rem !important;
        right: 0 !important;
        bottom: calc(3.2rem + env(safe-area-inset-bottom, 0px)) !important;
    }
}

/* ==========================================================================
   RACHI DUAL-THEME SAFETY UTILITIES (html.dark & Light Mode Integrity)
   ========================================================================== */
.dark\:inline:is(.dark *) { display: inline !important; }
.dark\:bg-transparent:is(.dark *) { background-color: transparent !important; }
.dark\:bg-\[\#030d1c\]:is(.dark *) { background-color: #030d1c !important; }
.dark\:bg-\[\#060b17\]:is(.dark *) { background-color: #060b17 !important; }
.dark\:bg-\[\#071326\]\/90:is(.dark *) { background-color: rgba(7, 19, 38, 0.90) !important; }
.dark\:bg-\[\#071326\]\/98:is(.dark *) { background-color: rgba(7, 19, 38, 0.98) !important; }
.dark\:bg-\[\#080c16\]\/98:is(.dark *) { background-color: rgba(8, 12, 22, 0.98) !important; }
.dark\:bg-\[\#090f1d\]:is(.dark *) { background-color: #090f1d !important; }
.dark\:bg-\[\#0a1a33\]:is(.dark *) { background-color: #0a1a33 !important; }
.dark\:bg-\[\#0a1a33\]\/60:is(.dark *) { background-color: rgba(10, 26, 51, 0.60) !important; }
.dark\:bg-\[\#0b1220\]:is(.dark *) { background-color: #0b1220 !important; }
.dark\:bg-\[\#0c1322\]:is(.dark *) { background-color: #0c1322 !important; }
.dark\:bg-\[\#0c1427\]:is(.dark *) { background-color: #0c1427 !important; }
.dark\:bg-\[\#0c1829\]:is(.dark *) { background-color: #0c1829 !important; }
.dark\:bg-\[\#0c1829\]\/95:is(.dark *) { background-color: rgba(12, 24, 41, 0.95) !important; }
.dark\:bg-\[\#0c192c\]:is(.dark *) { background-color: #0c192c !important; }
.dark\:bg-\[\#0c2230\]:is(.dark *) { background-color: #0c2230 !important; }
.dark\:bg-\[\#0e1935\]:is(.dark *) { background-color: #0e1935 !important; }
.dark\:bg-slate-900\/60:is(.dark *) { background-color: rgba(15, 23, 42, 0.60) !important; }
.dark\:bg-slate-950\/85:is(.dark *) { background-color: rgba(2, 6, 23, 0.85) !important; }
.dark\:bg-amber-950\/60:is(.dark *) { background-color: rgba(69, 26, 3, 0.60) !important; }
.dark\:bg-rose-950\/40:is(.dark *) { background-color: rgba(76, 5, 25, 0.40) !important; }
.dark\:bg-sky-950:is(.dark *) { background-color: #082f49 !important; }
.dark\:bg-sky-950\/60:is(.dark *) { background-color: rgba(8, 47, 73, 0.60) !important; }
.dark\:bg-indigo-950\/60:is(.dark *) { background-color: rgba(30, 27, 75, 0.60) !important; }
.dark\:bg-black\/60:is(.dark *) { background-color: rgba(0, 0, 0, 0.60) !important; }
.dark\:bg-white\/15:is(.dark *) { background-color: rgba(255, 255, 255, 0.15) !important; }
.dark\:bg-white\/\[0\.06\]:is(.dark *) { background-color: rgba(255, 255, 255, 0.06) !important; }

.dark\:border-amber-800:is(.dark *) { border-color: #92400e !important; }
.dark\:border-rose-800:is(.dark *) { border-color: #9f1239 !important; }
.dark\:border-sky-800:is(.dark *) { border-color: #075985 !important; }
.dark\:border-indigo-800:is(.dark *) { border-color: #3730a3 !important; }
.dark\:border-emerald-800\/60:is(.dark *) { border-color: rgba(6, 95, 70, 0.60) !important; }
.dark\:border-sky-500\/25:is(.dark *) { border-color: rgba(14, 165, 233, 0.25) !important; }
.dark\:border-amber-500\/20:is(.dark *) { border-color: rgba(245, 158, 11, 0.20) !important; }

.dark\:text-\[\#10b981\]:is(.dark *) { color: #10b981 !important; }
.dark\:text-sky-300:is(.dark *) { color: #7dd3fc !important; }
.dark\:text-amber-400\/80:is(.dark *) { color: rgba(251, 191, 36, 0.80) !important; }
.dark\:text-emerald-400\/80:is(.dark *) { color: rgba(52, 211, 153, 0.80) !important; }
.dark\:text-slate-700\/60:is(.dark *) { color: rgba(51, 65, 85, 0.60) !important; }

.dark\:via-\[\#0c182c\]:is(.dark *) {
    --tw-gradient-to: rgb(12 24 44 / 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), #0c182c var(--tw-gradient-via-position), var(--tw-gradient-to);
}
.dark\:via-\[\#092244\]:is(.dark *) {
    --tw-gradient-to: rgb(9 34 68 / 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), #092244 var(--tw-gradient-via-position), var(--tw-gradient-to);
}
.dark\:from-slate-900\/60:is(.dark *) {
    --tw-gradient-from: rgba(15, 23, 42, 0.60) var(--tw-gradient-from-position);
    --tw-gradient-to: rgba(15, 23, 42, 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}
.dark\:to-slate-950\/80:is(.dark *) {
    --tw-gradient-to: rgba(2, 6, 23, 0.80) var(--tw-gradient-to-position);
}
.dark\:from-emerald-950\/50:is(.dark *) {
    --tw-gradient-from: rgba(2, 44, 34, 0.50) var(--tw-gradient-from-position);
    --tw-gradient-to: rgba(2, 44, 34, 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}
.dark\:to-teal-950\/30:is(.dark *) {
    --tw-gradient-to: rgba(4, 47, 46, 0.30) var(--tw-gradient-to-position);
}
.dark\:from-white\/10:is(.dark *) {
    --tw-gradient-from: rgba(255, 255, 255, 0.10) var(--tw-gradient-from-position);
    --tw-gradient-to: rgba(255, 255, 255, 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}
.dark\:to-white\/5:is(.dark *) {
    --tw-gradient-to: rgba(255, 255, 255, 0.05) var(--tw-gradient-to-position);
}
.dark\:from-\[\#0050f0\]\/15:is(.dark *) {
    --tw-gradient-from: rgba(0, 80, 240, 0.15) var(--tw-gradient-from-position);
    --tw-gradient-to: rgba(0, 80, 240, 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}
.dark\:to-\[\#0050f0\]\/10:is(.dark *) {
    --tw-gradient-to: rgba(0, 80, 240, 0.10) var(--tw-gradient-to-position);
}

.dark\:from-\[\#071326\]\/85:is(.dark *) {
    --tw-gradient-from: rgba(7, 19, 38, 0.85) var(--tw-gradient-from-position);
    --tw-gradient-to: rgba(7, 19, 38, 0) var(--tw-gradient-to-position);
    --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
}
.dark\:ring-\[\#090f1d\]:is(.dark *) { --tw-ring-color: #090f1d !important; }
.dark\:ring-slate-800:is(.dark *) { --tw-ring-color: #1e293b !important; }
.dark\:ring-white\/10:is(.dark *) { --tw-ring-color: rgba(255, 255, 255, 0.10) !important; }
.dark\:shadow-\[0_0_50px_rgba\(0\,163\,224\,0\.2\)\]:is(.dark *) { box-shadow: 0 0 50px rgba(0, 163, 224, 0.2) !important; }
.dark\:bg-\[radial-gradient\(ellipse_70\%_60\%_at_50\%_-10\%\,rgba\(16\,185\,129\,0\.22\)\,transparent_70\%\)\]:is(.dark *) {
    background-image: radial-gradient(ellipse 70% 60% at 50% -10%, rgba(16, 185, 129, 0.22), transparent 70%) !important;
}
</style>
