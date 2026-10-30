<!DOCTYPE html>
<html lang="pt-AO" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Política de Privacidade e Protecção de Dados · RACHI</title>
    <meta name="description" content="Política de Privacidade e Tratamento de Dados Pessoais da RACHI, em estrita conformidade com a Lei n.º 22/11 de Protecção de Dados Pessoais da República de Angola.">
    <link rel="canonical" href="https://rachi.ao/privacidade">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">

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
                radial-gradient(ellipse 75% 45% at 50% 0%, rgba(2, 132, 199, 0.08) 0%, transparent 65%),
                radial-gradient(circle at 88% 15%, rgba(245, 168, 0, 0.07) 0%, transparent 45%) !important;
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
        html:not(.dark) .legal-badge-blue {
            background: rgba(2, 132, 199, 0.09) !important;
            border: 1px solid rgba(2, 132, 199, 0.24) !important;
            color: #0369a1 !important;
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
                radial-gradient(ellipse 80% 50% at 50% 0%, rgba(0, 163, 224, 0.14) 0%, transparent 65%),
                radial-gradient(circle at 85% 18%, rgba(245, 168, 0, 0.09) 0%, transparent 45%) !important;
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
        html.dark .legal-badge-blue {
            background: rgba(56, 189, 248, 0.12) !important;
            border: 1px solid rgba(56, 189, 248, 0.28) !important;
            color: #38bdf8 !important;
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
        html.dark .legal-link { color: #fbbf24 !important; }
        html.dark .legal-link:hover { color: #fde68a !important; }
        html.dark .legal-card-footer { border-top: 1px solid rgba(255, 255, 255, 0.09) !important; color: #94a3b8 !important; }
        html.dark .legal-footer {
            background: #071326 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }

        /* Shared structural polish */
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
            background: rgba(245, 168, 0, 0.14);
            color: #d97706;
            flex-shrink: 0;
        }
        html.dark .legal-section-num {
            background: rgba(245, 168, 0, 0.18);
            color: #fbbf24;
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
                <a href="/privacidade" class="legal-nav-tab active px-3.5 py-2 rounded-xl transition">Política de Privacidade</a>
                <a href="/termos" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Termos de Uso</a>
                <a href="/cookies" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Política de Cookies</a>
                <a href="/reclamacoes-e-denuncia" class="legal-nav-tab px-3.5 py-2 rounded-xl transition">Reclamações e Denúncia</a>
            </nav>
        </div>

        <article class="legal-card rounded-3xl p-6 sm:p-10 lg:p-12 transition-colors duration-300">

            <div class="legal-badge-blue inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                <i data-lucide="shield-check" class="w-4 h-4"></i>
                <span>Conformidade com a Lei n.º 22/11 de Angola</span>
            </div>

            <h1 class="legal-title text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight mb-2">
                Política de Privacidade e Protecção de Dados Pessoais
            </h1>
            <p class="legal-meta text-xs pb-6 mb-8">
                Última actualização: 29 de Outubro de 2026 · Válida para todo o território da República de Angola
            </p>

            <div class="legal-content text-sm sm:text-[15px] space-y-7 leading-relaxed">

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">1</span>
                        <span>Enquadramento Legal e Responsável pelo Tratamento</span>
                    </h2>
                    <p>
                        A presente Política regula o tratamento de dados pessoais recolhidos pela <strong>RACHI</strong> através do website <code>rachi.ao</code>, dos seus portais de cliente e módulos operacionais, em estrita conformidade com a <strong>Lei n.º 22/11 de 17 de Junho — Lei de Protecção de Dados Pessoais da República de Angola</strong> e sob as directrizes da Agência de Protecção de Dados (APD).
                    </p>
                    <p class="mt-2.5">
                        A entidade responsável pelo tratamento é a <strong>RACHI</strong>, com sede em Luanda, Angola, contactável através do e-mail oficial <a href="mailto:geral@rachi.ao" class="legal-link font-semibold underline">geral@rachi.ao</a> e telefone <code>+244 972 888 585</code>.
                    </p>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">2</span>
                        <span>Dados Pessoais Recolhidos</span>
                    </h2>
                    <p>No âmbito da prestação dos nossos serviços empresariais, recolhemos unicamente os dados necessários à finalidade contratual e de suporte:</p>
                    <ul class="list-disc pl-6 mt-2.5 space-y-1.5">
                        <li><strong>Identificação pessoal e corporativa:</strong> Nome completo, Número de Identificação Fiscal (NIF), denominação social da empresa e representante;</li>
                        <li><strong>Contactos:</strong> Endereço de correio electrónico, número de telefone e WhatsApp;</li>
                        <li><strong>Morada de facturação e entrega:</strong> Província (ex.: Luanda), município, bairro, rua e pontos de referência para envio de materiais impressos e suprimentos de TI;</li>
                        <li><strong>Dados de navegação e autenticação:</strong> Palavra-passe encriptada, endereço IP, tokens de sessão e preferências de tema.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">3</span>
                        <span>Finalidades do Tratamento</span>
                    </h2>
                    <p>Os dados recolhidos destinam-se exclusivamente a:</p>
                    <ol class="list-decimal pl-6 mt-2.5 space-y-1.5">
                        <li>Emissão de propostas comerciais, orçamentos e facturas pró-forma (com referências Multicaixa Express / transferência bancária);</li>
                        <li>Abertura, gestão e acompanhamento de chamados de suporte técnico de TI (RACHI Tec);</li>
                        <li>Execução e entrega de trabalhos gráficos, branding e sinalética corporativa (RACHI Print);</li>
                        <li>Inscrição em cursos executivos, emissão e validação de certificados profissionais (RACHI Academy);</li>
                        <li>Consultoria de recursos humanos, contabilidade e legalização empresarial (RACHI Human Capital);</li>
                        <li>Cumprimento de obrigações tributárias e fiscais perante a Administração Geral Tributária (AGT).</li>
                    </ol>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">4</span>
                        <span>Segurança e Não Partilha de Dados</span>
                    </h2>
                    <p>
                        A RACHI aplica medidas técnicas e organizativas rigorosas para impedir acessos não autorizados, perda ou destruição acidental dos seus dados. <strong>Não comercializamos nem cedemos os seus dados a terceiros</strong>, salvo para cumprimento de obrigações legais perante autoridades judiciais ou tributárias angolanas competentes.
                    </p>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">5</span>
                        <span>Direitos do Titular dos Dados</span>
                    </h2>
                    <p>
                        Nos termos dos artigos da Lei n.º 22/11, assiste ao titular dos dados o direito de acesso, confirmação, rectificação, actualização e eliminação dos seus dados pessoais. Poderá exercer qualquer destes direitos a qualquer momento mediante solicitação por e-mail para <a href="mailto:geral@rachi.ao" class="legal-link font-semibold underline">geral@rachi.ao</a>.
                    </p>
                </section>

                <section>
                    <h2 class="legal-section-title text-lg sm:text-xl font-bold mb-2.5 flex items-center">
                        <span class="legal-section-num">6</span>
                        <span>Conservação de Dados</span>
                    </h2>
                    <p>
                        Os dados pessoais serão conservados apenas durante o período estritamente necessário à execução do contrato ou durante os prazos obrigatórios previstos na legislação fiscal e comercial de Angola.
                    </p>
                </section>

            </div>

            <div class="legal-card-footer mt-10 pt-6 flex flex-wrap items-center justify-between gap-4 text-xs">
                <div class="flex items-center gap-4">
                    <a href="/termos" class="legal-link underline font-medium">Termos de Uso</a>
                    <span>·</span>
                    <a href="/cookies" class="legal-link underline font-medium">Política de Cookies</a>
                </div>
                <a href="/contacto" class="legal-link font-bold hover:underline">Fale connosco para esclarecimentos &rarr;</a>
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
