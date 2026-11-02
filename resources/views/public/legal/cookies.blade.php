<!DOCTYPE html>
<html lang="pt-AO" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Política de Cookies e Armazenamento Local · RACHI</title>
    <meta name="description" content="Informação clara e transparente sobre os cookies e tecnologias de armazenamento local utilizadas pela plataforma da RACHI.">
    <link rel="canonical" href="https://rachi.ao/cookies">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <script defer src="/libs/alpine.js"></script>
    <script src="/libs/lucide.js"></script>

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="/worker-marketing.css?v=20261030-2">

    <!-- Script Anti-Flash de Tema -->
    <script>
        (function() {
            var theme = localStorage.getItem('rachi_theme');
            if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        window.toggleRachiTheme = function() {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('rachi_theme', isDark ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            return isDark;
        };

        window.addEventListener('storage', function(e) {
            if (e.key === 'rachi_theme') {
                if (e.newValue === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: e.newValue === 'dark' } }));
            }
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body.legal-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        h1, h2, h3, h4 { font-family: 'Outfit', sans-serif; }

        /* ============================================================
           DUAL-THEME SYSTEM: LIGHT MODE (html:not(.dark))
           ============================================================ */
        html:not(.dark) body.legal-body {
            background-color: #f4f7fb !important;
            background-image:
                radial-gradient(ellipse 75% 45% at 50% 0%, rgba(16, 185, 129, 0.08) 0%, transparent 65%),
                radial-gradient(circle at 85% 18%, rgba(2, 132, 199, 0.07) 0%, transparent 45%) !important;
            color: #1e293b !important;
        }
        html:not(.dark) .legal-header {
            background: rgba(255, 255, 255, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.04) !important;
        }
        html:not(.dark) .legal-logo-dark { display: block !important; }
        html:not(.dark) .legal-logo-light { display: none !important; }

        html:not(.dark) .legal-back-btn {
            color: #334155 !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .legal-back-btn:hover {
            color: #0284c7 !important;
            background: #f0f9ff !important;
            border-color: #bae6fd !important;
        }

        html:not(.dark) .legal-theme-btn {
            background: #f8fafc !important;
            border: 1px solid #cbd5e1 !important;
            color: #0f172a !important;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04) !important;
        }
        html:not(.dark) .legal-theme-btn:hover {
            background: #ffffff !important;
            border-color: #0284c7 !important;
            color: #0284c7 !important;
        }
        html:not(.dark) .legal-theme-btn .mode-when-light { display: inline-flex !important; }
        html:not(.dark) .legal-theme-btn .mode-when-dark { display: none !important; }

        html:not(.dark) .legal-nav-tabs {
            background: #eef2f7 !important;
            border: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .legal-nav-tab { color: #475569 !important; }
        html:not(.dark) .legal-nav-tab:hover { color: #0f172a !important; }
        html:not(.dark) .legal-nav-tab.active {
            background: #ffffff !important;
            color: #0f172a !important;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08) !important;
        }

        html:not(.dark) .legal-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 20px 50px -15px rgba(15, 23, 42, 0.08), 0 4px 14px -4px rgba(15, 23, 42, 0.03) !important;
        }
        html:not(.dark) .legal-badge-emerald {
            background: rgba(16, 185, 129, 0.10) !important;
            border: 1px solid rgba(5, 150, 105, 0.25) !important;
            color: #047857 !important;
        }
        html:not(.dark) .legal-title { color: #0b1a2e !important; }
        html:not(.dark) .legal-meta { color: #64748b !important; border-bottom: 1px solid #f1f5f9 !important; }
        html:not(.dark) .legal-section-title { color: #0f172a !important; }
        html:not(.dark) .legal-content { color: #334155 !important; }
        html:not(.dark) .legal-content strong { color: #0f172a !important; }
        html:not(.dark) .legal-content code {
            background: #f1f5f9 !important;
            border: 1px solid #e2e8f0 !important;
            color: #0369a1 !important;
        }
        html:not(.dark) .legal-subcard {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-left: 3px solid #10b981 !important;
        }
        html:not(.dark) .legal-subcard-title { color: #0f172a !important; }
        html:not(.dark) .legal-subcard-desc { color: #475569 !important; }
        html:not(.dark) .legal-link { color: #0284c7 !important; }
        html:not(.dark) .legal-link:hover { color: #0369a1 !important; }
        html:not(.dark) .legal-card-footer { border-top: 1px solid #e2e8f0 !important; color: #64748b !important; }
        html:not(.dark) .legal-footer {
            background: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #64748b !important;
        }

        /* ============================================================
           DUAL-THEME SYSTEM: DARK MODE (html.dark)
           ============================================================ */
        html.dark body.legal-body {
            background-color: #050b16 !important;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% 0%, rgba(16, 185, 129, 0.13) 0%, transparent 65%),
                radial-gradient(circle at 85% 18%, rgba(0, 163, 224, 0.10) 0%, transparent 45%) !important;
            color: #e2e8f0 !important;
        }
        html.dark .legal-header {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.45) !important;
        }
        html.dark .legal-logo-dark { display: none !important; }
        html.dark .legal-logo-light { display: block !important; }

        html.dark .legal-back-btn {
            color: #cbd5e1 !important;
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        html.dark .legal-back-btn:hover {
            color: #fbbf24 !important;
            background: rgba(245, 168, 0, 0.12) !important;
            border-color: rgba(245, 168, 0, 0.35) !important;
        }

        html.dark .legal-theme-btn {
            background: rgba(15, 23, 42, 0.9) !important;
            border: 1px solid rgba(251, 191, 36, 0.35) !important;
            color: #fef08a !important;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark .legal-theme-btn:hover {
            background: rgba(30, 41, 59, 0.95) !important;
            border-color: #fbbf24 !important;
            color: #ffffff !important;
        }
        html.dark .legal-theme-btn .mode-when-light { display: none !important; }
        html.dark .legal-theme-btn .mode-when-dark { display: inline-flex !important; }

        html.dark .legal-nav-tabs {
            background: rgba(15, 23, 42, 0.75) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
        }
        html.dark .legal-nav-tab { color: #94a3b8 !important; }
        html.dark .legal-nav-tab:hover { color: #f8fafc !important; }
        html.dark .legal-nav-tab.active {
            background: rgba(245, 168, 0, 0.16) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 168, 0, 0.32) !important;
        }

        html.dark .legal-card {
            background: linear-gradient(180deg, #0c182d 0%, #091222 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.10) !important;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }
        html.dark .legal-badge-emerald {
            background: rgba(16, 185, 129, 0.14) !important;
            border: 1px solid rgba(52, 211, 153, 0.30) !important;
            color: #34d399 !important;
        }
        html.dark .legal-title { color: #ffffff !important; }
        html.dark .legal-meta { color: #94a3b8 !important; border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important; }
        html.dark .legal-section-title { color: #f8fafc !important; }
        html.dark .legal-content { color: #cbd5e1 !important; }
        html.dark .legal-content strong { color: #ffffff !important; }
        html.dark .legal-content code {
            background: rgba(15, 23, 42, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #fcd34d !important;
        }
        html.dark .legal-subcard {
            background: rgba(15, 23, 42, 0.72) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            border-left: 3px solid #34d399 !important;
        }
        html.dark .legal-subcard-title { color: #ffffff !important; }
        html.dark .legal-subcard-desc { color: #cbd5e1 !important; }
        html.dark .legal-link { color: #fbbf24 !important; }
        html.dark .legal-link:hover { color: #fde68a !important; }
        html.dark .legal-card-footer { border-top: 1px solid rgba(255, 255, 255, 0.09) !important; color: #94a3b8 !important; }
        html.dark .legal-footer {
            background: #071326 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }

        .legal-content code {
            padding: 0.15rem 0.45rem;
            border-radius: 0.4rem;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .legal-section-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.65rem;
            height: 1.65rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: 800;
            margin-right: 0.55rem;
            background: rgba(16, 185, 129, 0.14);
            color: #059669;
            flex-shrink: 0;
        }
        html.dark .legal-section-num {
            background: rgba(52, 211, 153, 0.18);
            color: #34d399;
        }
    </style>
</head>
<body class="legal-body antialiased">

    <!-- HEADER INSTITUCIONAL DUAL-THEME -->
    <header class="legal-header sticky top-0 z-40 px-4 sm:px-8 py-3.5 transition-all duration-300">
        <div class="max-w-6xl mx-auto flex items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-3 shrink-0" title="Voltar à página inicial da RACHI">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="legal-logo-dark h-8 sm:h-9 w-auto object-contain">
                <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="legal-logo-light h-8 sm:h-9 w-auto object-contain">
            </a>

            <div class="flex items-center gap-2.5 sm:gap-3">
                <a href="/" class="legal-back-btn text-xs font-semibold px-3.5 py-2 rounded-full flex items-center gap-1.5 transition">
                    <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                    <span>Voltar ao Início</span>
                </a>

                <button type="button"
                        onclick="toggleRachiTheme()"
                        class="legal-theme-btn px-3.5 py-2 rounded-full text-xs font-bold transition cursor-pointer"
                        aria-label="Alternar entre Modo Claro e Modo Escuro">
                    <span class="mode-when-light items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <span>Modo Escuro</span>
                    </span>
                    <span class="mode-when-dark items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                        <span>Modo Claro</span>
                    </span>
                </button>
            </div>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main class="flex-1 w-full max-w-4xl mx-auto px-4 sm:px-6 py-10 sm:py-14">

        <!-- Navegação Rápida entre Documentos Legais -->
        <div class="mb-6 flex justify-center">
            <nav class="legal-nav-tabs inline-flex flex-wrap items-center gap-1 p-1.5 rounded-2xl text-xs font-bold" aria-label="Documentos legais">
                <a href="/privacidade" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Política de Privacidade</a>
                <a href="/termos" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Termos de Uso</a>
                <a href="/cookies" class="legal-nav-tab active px-3.5 py-2 rounded-xl transition">Política de Cookies</a>
                <a href="/reclamacoes-e-denuncia" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Reclamações e Denúncia</a>
            </nav>
        </div>

        <article class="legal-card rounded-3xl p-6 sm:p-10 lg:p-12 transition-colors duration-300">

            <div class="legal-badge-emerald inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                <i data-lucide="cookie" class="w-4 h-4"></i>
                <span>Gestão de Preferências</span>
            </div>

            <h1 class="legal-title text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight mb-2">
                Política de Cookies e Armazenamento Local
            </h1>
            <p class="legal-meta text-xs pb-6 mb-8">
                Última actualização: 29 de Outubro de 2026 · RACHI Angola
            </p>

            <div class="legal-content text-sm sm:text-[15px] space-y-7 leading-relaxed">

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">1</span>
                        <span>O que são Cookies?</span>
                    </h2>
                    <p>
                        Cookies são pequenos ficheiros de texto armazenados no seu computador ou telemóvel quando acede ao nosso website. Ajudam a manter a sessão autenticada, memorizar as preferências do utilizador (como o Modo Escuro e o Modo Claro) e garantir a estabilidade da navegação.
                    </p>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">2</span>
                        <span>Quais as tecnologias que utilizamos?</span>
                    </h2>
                    <div class="space-y-3.5 mt-3">
                        <div class="legal-subcard p-4 sm:p-5 rounded-2xl transition-colors">
                            <h3 class="legal-subcard-title font-bold text-sm sm:text-base">Cookies Estritamente Necessários (Sessão &amp; Segurança)</h3>
                            <p class="legal-subcard-desc text-xs sm:text-sm mt-1.5 leading-relaxed">
                                O cookie <code>rachi_session</code> e tokens CSRF servem exclusivamente para garantir a segurança da autenticação e a protecção contra submissões fraudulentas de formulários.
                            </p>
                        </div>

                        <div class="legal-subcard p-4 sm:p-5 rounded-2xl transition-colors">
                            <h3 class="legal-subcard-title font-bold text-sm sm:text-base">Armazenamento Local (localStorage)</h3>
                            <p class="legal-subcard-desc text-xs sm:text-sm mt-1.5 leading-relaxed">
                                As chaves <code>rachi_theme</code> e <code>rachi_lang</code> memorizam se prefere visualizar o site em Modo Escuro ou Modo Claro e o idioma seleccionado, evitando o efeito de cintilação da tela.
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">3</span>
                        <span>Como gerir ou desactivar cookies?</span>
                    </h2>
                    <p>
                        Poderá a qualquer momento configurar o seu navegador de internet para recusar cookies ou alertá-lo antes de um cookie ser gravado. Note que a desactivação de cookies estritamente necessários poderá inviabilizar o acesso ao portal autenticado de clientes.
                    </p>
                </section>

            </div>

            <div class="legal-card-footer mt-10 pt-6 flex flex-wrap items-center justify-between gap-4 text-xs">
                <div class="flex items-center gap-4">
                    <a href="/privacidade" class="legal-link underline font-medium">Política de Privacidade</a>
                    <span>·</span>
                    <a href="/termos" class="legal-link underline font-medium">Termos de Uso</a>
                </div>
                <a href="/" class="legal-link font-bold hover:underline">Voltar ao Início &rarr;</a>
            </div>

        </article>
    </main>

    <!-- FOOTER INSTITUCIONAL -->
    <footer class="legal-footer py-6 text-center text-xs transition-colors duration-300">
        &copy; {{ date('Y') }} RACHI — Todos os direitos reservados. República de Angola.
    </footer>

    <script>if (window.lucide) { lucide.createIcons(); }</script>
    @include('components.theme-toggle-fab')
</body>
</html>
