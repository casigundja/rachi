<!DOCTYPE html>
<html lang="pt">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="admin-session-authenticated" content="{{ auth()->check() && auth()->user()->isAdmin() ? 'true' : 'false' }}">
    <title>RACHI — Soluções Inteligentes em Tecnologia, Gráfica, Formação & Gestão</title>
    <meta name="description" content="Ecossistema empresarial em Angola: RACHI Tec (tecnologia, websites e suporte de TI), RACHI Print (gráfica e brindes), RACHI Academy (formações executivas) e RACHI Human Capital (RH, contabilidade e legalização).">
    <link rel="canonical" href="https://rachi.ao/">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Open Graph / Redes Sociais -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://rachi.ao/">
    <meta property="og:title" content="RACHI — Soluções Inteligentes em Angola">
    <meta property="og:description" content="Soluções integradas de tecnologia, produção gráfica, formação profissional corporativa e consultoria em recursos humanos em Luanda e em todo o país.">
    <meta property="og:image" content="https://rachi.ao/images/banner_modo_claro.png">
    <meta property="og:locale" content="pt_AO">
    <meta property="og:site_name" content="RACHI">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="RACHI — Soluções Inteligentes em Angola">
    <meta name="twitter:description" content="Tecnologia, produção gráfica, formação profissional e capital humano integrados.">
    <meta name="twitter:image" content="https://rachi.ao/images/banner_modo_claro.png">

    <!-- Dados Estruturados Schema.org (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "RACHI",
      "legalName": "RACHI — Soluções Inteligentes",
      "url": "https://rachi.ao",
      "logo": "https://rachi.ao/images/logo-rachi-light.png",
      "description": "Ecossistema de serviços empresariais integrados em Angola nas áreas de tecnologia, produção gráfica, capacitação profissional e gestão de pessoas.",
      "telephone": "+244972888585",
      "email": "geral@rachi.ao",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Rua Ndunduma, Miramar (Por detrás do BFA)",
        "addressLocality": "Luanda",
        "addressRegion": "Luanda",
        "addressCountry": "AO"
      },
      "department": [
        {
          "@type": "ProfessionalService",
          "name": "RACHI Tec",
          "description": "Desenvolvimento de websites, plataformas web, digitalização de processos e suporte técnico de TI com SLA."
        },
        {
          "@type": "ProfessionalService",
          "name": "RACHI Print",
          "description": "Produção gráfica corporativa, brindes empresariais, impressão institucional e sinalética."
        },
        {
          "@type": "EducationalOrganization",
          "name": "RACHI Academy",
          "description": "Cursos práticos e formação executiva com certificação verificável via QR Code."
        },
        {
          "@type": "ProfessionalService",
          "name": "RACHI Human Capital",
          "description": "Estruturação societária, contabilidade, processamento salarial e recrutamento de talentos."
        }
      ]
    }
    </script>
    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="/worker-marketing.css?v=20261030-2">
    <!-- Alpine.js -->
    <script defer src="/libs/alpine.js"></script>
    <!-- Lucide Icons -->
    <script src="/libs/lucide.js"></script>
    
    <!-- Script de Inicialização Imediata do Tema (Anti-Flash Dark Mode) -->
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
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        section[id],
        div[id] {
            scroll-margin-top: 80px;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: #0b1a2e;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Ocultar barras de rolagem preservando navegação por scroll */
        .no-scrollbar::-webkit-scrollbar,
        .scrollbar-none::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }
        .no-scrollbar,
        .scrollbar-none {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        /* ============================================================ */
        /* DUAL THEME HEADER (Dark at top -> Light when scrolled)        */
        /* Exactly matching https://klasse.ao/                          */
        /* ============================================================ */

        .site-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                border-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                backdrop-filter 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        #main-site-header > div,
        .site-header-inner {
            max-width: 1040px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        @media (min-width: 1024px) {
            #main-site-header .header-col-logo {
                width: 140px !important;
                flex-shrink: 0 !important;
            }
            #main-site-header .header-col-nav {
                flex: 1 !important;
                display: flex !important;
                justify-content: center !important;
                min-width: 0 !important;
            }
            #main-site-header .header-col-auth {
                width: 140px !important;
                flex-shrink: 0 !important;
                display: flex !important;
                justify-content: flex-end !important;
            }
        }


        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            transition: transform 0.25s ease, filter 0.25s ease;
        }

        @media (min-width: 992px) {
            .brand-logo-img {
                height: 42px;
                max-width: 210px;
            }
        }

        /* ------------------------------------------------------------ */
        /* STATE 1: AT TOP (DARK LUXURY GLASS)                          */
        /* ------------------------------------------------------------ */
        html.dark .site-header,
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }

        html.dark .site-header .logo-light,
        .site-header.header-top-dark .logo-light {
            display: block !important;
        }

        html.dark .site-header .logo-dark,
        .site-header.header-top-dark .logo-dark {
            display: none !important;
        }

        /* Dark Nav Capsule */
        html.dark .site-header .main-nav-capsule,
        .site-header.header-top-dark .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.14rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            padding: 0.22rem 0.35rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        @media (min-width: 1280px) {
            html.dark .site-header .main-nav-capsule,
            .site-header.header-top-dark .main-nav-capsule {
                gap: 0.16rem;
                padding: 0.24rem 0.4rem;
            }
        }

        html.dark .site-header .main-nav-capsule .nav-link,
        .site-header.header-top-dark .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.79rem;
            font-weight: 600;
            letter-spacing: 0.015em;
            color: rgba(255, 255, 255, 0.85) !important;
            padding: 0.34rem 0.65rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 1280px) {
            html.dark .site-header .main-nav-capsule .nav-link,
            .site-header.header-top-dark .main-nav-capsule .nav-link {
                font-size: 0.82rem;
                padding: 0.36rem 0.72rem !important;
            }
        }

        html.dark .site-header .main-nav-capsule .nav-link:hover,
        html.dark .site-header .main-nav-capsule .nav-link.nav-link-open,
        .site-header.header-top-dark .main-nav-capsule .nav-link:hover,
        .site-header.header-top-dark .main-nav-capsule .nav-link.nav-link-open {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12);
        }

        html.dark .site-header .main-nav-capsule .nav-link.active,
        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 2px 14px rgba(0, 163, 224, 0.45);
            font-weight: 600;
        }

        html.dark .site-header .btn-entrar-nav,
        .site-header.header-top-dark .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 9999px;
            border: 1px solid rgba(0, 163, 224, 0.45);
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.18) 0%, rgba(5, 25, 55, 0.5) 100%);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        html.dark .site-header .btn-entrar-nav:hover,
        .site-header.header-top-dark .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            border-color: #00a3e0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(0, 163, 224, 0.45);
        }

        html.dark .site-header .mobile-menu-btn,
        .site-header.header-top-dark .mobile-menu-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.75rem;
            color: #ffffff !important;
            transition: all 0.2s ease;
        }

        html.dark .site-header .mobile-menu-btn:hover,
        .site-header.header-top-dark .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(0, 163, 224, 0.5) !important;
            color: #00a3e0 !important;
        }

        /* ------------------------------------------------------------ */
        /* STATE 2: SCROLLED DOWN (LIGHT / WHITE GLASS - KLASSE.AO STYLE)*/
        /* ------------------------------------------------------------ */
        html:not(.dark) .site-header,
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.03) !important;
        }

        html:not(.dark) .site-header .logo-light,
        .site-header.header-scrolled-light .logo-light {
            display: none !important;
        }

        html:not(.dark) .site-header .logo-dark,
        .site-header.header-scrolled-light .logo-dark {
            display: block !important;
        }

        /* Light Nav Capsule */
        html:not(.dark) .site-header .main-nav-capsule,
        .site-header.header-scrolled-light .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.14rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px;
            padding: 0.22rem 0.35rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        @media (min-width: 1280px) {
            html:not(.dark) .site-header .main-nav-capsule,
            .site-header.header-scrolled-light .main-nav-capsule {
                gap: 0.16rem;
                padding: 0.24rem 0.4rem;
            }
        }

        html:not(.dark) .site-header .main-nav-capsule .nav-link,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.79rem;
            font-weight: 600;
            letter-spacing: 0.015em;
            color: #0b1a2e !important;
            padding: 0.34rem 0.65rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 1280px) {
            html:not(.dark) .site-header .main-nav-capsule .nav-link,
            .site-header.header-scrolled-light .main-nav-capsule .nav-link {
                font-size: 0.82rem;
                padding: 0.36rem 0.72rem !important;
            }
        }

        html:not(.dark) .site-header .main-nav-capsule .nav-link:hover,
        html:not(.dark) .site-header .main-nav-capsule .nav-link.nav-link-open,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }

        html:not(.dark) .site-header .main-nav-capsule .nav-link.active,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
            font-weight: 700;
        }

        html:not(.dark) .site-header .nav-link svg,
        .site-header.header-scrolled-light .nav-link svg {
            color: #475569;
        }

        /* Light Dropdowns */
        html:not(.dark) .site-header .header-dropdown,
        html:not(.dark) .header-dropdown,
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }

        html:not(.dark) .site-header .header-dropdown a,
        html:not(.dark) .header-dropdown a,
        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }

        html:not(.dark) .site-header .header-dropdown a:hover,
        html:not(.dark) .header-dropdown a:hover,
        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }

        html:not(.dark) .site-header .header-dropdown .dropdown-title,
        html:not(.dark) .header-dropdown .dropdown-title,
        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }

        html:not(.dark) .site-header .header-dropdown .dropdown-desc,
        html:not(.dark) .header-dropdown .dropdown-desc,
        .site-header.header-scrolled-light .header-dropdown .dropdown-desc {
            color: #64748b !important;
        }

        html:not(.dark) .site-header .btn-entrar-nav,
        .site-header.header-scrolled-light .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 9999px;
            border: 1px solid #00a3e0;
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 163, 224, 0.35);
        }

        html:not(.dark) .site-header .btn-entrar-nav:hover,
        .site-header.header-scrolled-light .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #0092c8 0%, #0065a5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.45);
        }

        html:not(.dark) .site-header .mobile-menu-btn,
        .site-header.header-scrolled-light .mobile-menu-btn {
            display: none;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            border-radius: 0.75rem;
            color: #0b1a2e !important;
            transition: all 0.2s ease;
        }

        .site-header.header-scrolled-light .mobile-menu-btn:hover {
            background: rgba(0, 163, 224, 0.08) !important;
            border-color: #00a3e0 !important;
            color: #0077c2 !important;
        }

        /* Toast auto-dismiss countdown progress bar */
        @keyframes toastShrink {
            0% { width: 100%; }
            100% { width: 0%; }
        }
        .toast-progress-bar {
            animation: toastShrink 4.5s linear forwards;
        }

        /* Hero styling matching rachi.ao & screenshot with Dual Theme (Light & Dark) */
        /* ============================================================
           HERO REDESIGN: EXECUTIVE SIZING & INTEGRATED ARTWORK BACKDROP
        ============================================================ */
        .hero-home {
            position: relative;
            background-color: #f8fafc;
            background-image:
                radial-gradient(ellipse 80% 50% at 50% 0%, rgba(0, 163, 224, 0.08) 0%, transparent 60%),
                radial-gradient(circle at 85% 25%, rgba(245, 168, 0, 0.07) 0%, transparent 50%),
                radial-gradient(circle at 15% 35%, rgba(0, 163, 224, 0.06) 0%, transparent 50%),
                linear-gradient(180deg, #f1f5f9 0%, #f8fafc 45%, #ffffff 100%);
            background-repeat: no-repeat;
            background-position: center top;
            background-size: 100% 100%;
            padding-top: 7.5rem;
            padding-bottom: 3.5rem;
            text-align: center;
            overflow: hidden;
            color: #071326;
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        background-image 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                        color 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html.dark .hero-home {
            background-color: #030813 !important;
            background-image:
                radial-gradient(ellipse 95% 65% at 50% 10%, rgba(0, 163, 224, 0.22) 0%, transparent 65%),
                radial-gradient(ellipse 75% 55% at 50% 52%, rgba(0, 163, 224, 0.22) 0%, rgba(245, 168, 0, 0.08) 45%, transparent 72%),
                radial-gradient(circle at 18% 35%, rgba(11, 78, 168, 0.35) 0%, transparent 42rem),
                radial-gradient(circle at 82% 30%, rgba(245, 168, 0, 0.18) 0%, transparent 40rem),
                radial-gradient(ellipse 85% 45% at 50% 90%, rgba(0, 163, 224, 0.15) 0%, transparent 60%),
                linear-gradient(180deg, #020610 0%, #051329 35%, #071937 68%, #030a17 100%) !important;
            background-size: 100% 100% !important;
            color: #ffffff !important;
        }

        /* Ambient Glow Orb behind Hero */
        .hero-ambient-orb {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(92vw, 700px);
            height: 300px;
            background: radial-gradient(ellipse at 35% 50%, rgba(245, 168, 0, 0.10) 0%, transparent 60%),
                radial-gradient(ellipse at 65% 50%, rgba(0, 163, 224, 0.12) 0%, transparent 60%);
            filter: blur(55px);
            pointer-events: none;
            z-index: 0;
            opacity: 0.55;
            transition: opacity 0.4s ease, background 0.4s ease;
            animation: heroOrbPulse 8s ease-in-out infinite alternate;
        }

        html.dark .hero-ambient-orb {
            background: radial-gradient(ellipse at 35% 50%, rgba(245, 168, 0, 0.15) 0%, transparent 60%),
                radial-gradient(ellipse at 65% 50%, rgba(0, 163, 224, 0.16) 0%, transparent 60%);
            opacity: 0.9;
        }

        @keyframes heroOrbPulse {
            0% {
                transform: translate(-50%, -50%) scale(0.92);
                opacity: 0.7;
            }

            50% {
                transform: translate(-48%, -52%) scale(1.04);
                opacity: 0.95;
            }

            100% {
                transform: translate(-52%, -48%) scale(1.08);
                opacity: 0.85;
            }
        }

        /* Hero Content Container with Legibility Scrim */
        .hero-home .hero-content {
            position: relative;
            z-index: 10;
            max-width: 64rem;
            margin: 0 auto;
        }

        .hero-home .hero-content::before {
            content: "";
            position: absolute;
            inset: -1.2rem -1.5rem -1.2rem -1.5rem;
            background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(255, 255, 255, 0.82) 0%, rgba(248, 250, 252, 0.45) 55%, transparent 85%);
            border-radius: 2.5rem;
            pointer-events: none;
            z-index: 1;
            transition: background 0.4s ease;
        }

        html.dark .hero-home .hero-content::before {
            display: none !important;
        }

        /* Top Pill Badge (Refined & Compact) */
        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.28rem 0.95rem;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 9999px;
            box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.05);
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 12;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hero-badge-pill:hover {
            transform: translateY(-1.5px);
            border-color: rgba(245, 168, 0, 0.45);
            box-shadow: 0 6px 20px -3px rgba(245, 168, 0, 0.16);
        }

        .hero-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            animation: badgeDotPulse 2s infinite cubic-bezier(0.66, 0, 0, 1);
        }

        @keyframes badgeDotPulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .hero-badge-text {
            font-size: 0.75rem;
            font-weight: 750;
            color: #0f172a;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .hero-badge-divider {
            width: 1px;
            height: 11px;
            background: #cbd5e1;
        }

        .hero-badge-sub {
            font-size: 0.72rem;
            font-weight: 650;
            color: #00a3e0;
            letter-spacing: 0.02em;
        }

        /* Hero Main Title: Balanced Executive Sizing (Dual Theme) */
        .hero-home .hero-title {
            display: block;
            margin: 0;
            color: #071326;
            font-size: clamp(1.65rem, 3.1vw, 2.65rem);
            font-weight: 850;
            letter-spacing: -0.028em;
            line-height: 1.15;
            text-transform: uppercase;
            position: relative;
            z-index: 12;
            transition: color 0.4s ease;
            isolation: isolate;
        }

        html.dark .hero-home .hero-title {
            color: #ffffff;
        }

        .hero-title-line {
            display: block;
            margin-bottom: 0.15rem;
            transition: transform 0.3s ease;
        }

        /* Gold Gradient & Shimmer for ECOSSISTEMA */
        .hero-highlight--gold {
            display: inline-block;
            background: linear-gradient(115deg, #f59e0b 0%, #fbbf24 25%, #fef08a 50%, #fbbf24 75%, #d97706 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            -webkit-box-decoration-break: clone;
            box-decoration-break: clone;
            transform: translateZ(0);
            animation: textGradientShift 7s ease infinite;
            position: relative;
            cursor: default;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-highlight--gold:hover {
            transform: translateY(-2px) scale(1.02);
        }

        /* Blue Gradient & Shimmer for INTELIGENTES */
        .hero-highlight--blue {
            display: inline-block;
            background: linear-gradient(115deg, #0284c7 0%, #00a3e0 25%, #38bdf8 50%, #00a3e0 75%, #0369a1 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            -webkit-box-decoration-break: clone;
            box-decoration-break: clone;
            transform: translateZ(0);
            animation: textGradientShift 7s ease infinite 2.5s;
            position: relative;
            cursor: default;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-highlight--blue:hover {
            transform: translateY(-2px) scale(1.02);
        }

        @keyframes textGradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Subtitle: Compact, Clean and Fluid */
        .hero-subtitle-box {
            margin: 0.75rem auto 0;
            max-width: 48rem;
            position: relative;
            z-index: 12;
        }

        .hero-home .hero-subtitle {
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 0.4rem 0.55rem;
            color: #475569;
            font-size: clamp(0.92rem, 1.3vw, 1.15rem);
            font-weight: 500;
            line-height: 1.4;
            letter-spacing: -0.01em;
            transition: color 0.4s ease;
        }

        html.dark .hero-home .hero-subtitle {
            color: #cbd5e1;
        }

        .hero-subtitle-lead {
            color: #0f172a;
            font-weight: 600;
            transition: color 0.4s ease;
        }

        html.dark .hero-subtitle-lead {
            color: #e2e8f0;
        }

        .hero-inline-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.2rem 0.75rem;
            border-radius: 9999px;
            font-weight: 750;
            font-size: 0.88em;
            vertical-align: middle;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            cursor: default;
            user-select: none;
        }

        .hero-inline-badge--gold {
            background: rgba(254, 243, 199, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #92400e;
            border: 1px solid rgba(245, 158, 11, 0.45);
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.12);
            animation: badgeFloatA 4.5s ease-in-out infinite alternate;
        }

        .hero-inline-badge--gold svg {
            color: #d97706;
        }

        .hero-inline-badge--gold:hover {
            transform: translateY(-2px) scale(1.05);
            background: rgba(254, 243, 199, 0.95);
            box-shadow: 0 6px 18px rgba(245, 158, 11, 0.25);
            border-color: #f59e0b;
        }

        html.dark .hero-inline-badge--gold {
            background: rgba(255, 255, 255, 0.12);
            color: #fef08a;
            border: 1px solid rgba(245, 158, 11, 0.55);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }

        html.dark .hero-inline-badge--gold svg {
            color: #fbbf24;
        }

        html.dark .hero-inline-badge--gold:hover {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.4);
            border-color: #fbbf24;
        }

        .hero-inline-badge--blue {
            background: rgba(224, 242, 254, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #0369a1;
            border: 1px solid rgba(0, 163, 224, 0.45);
            box-shadow: 0 2px 8px rgba(0, 163, 224, 0.12);
            animation: badgeFloatB 4.5s ease-in-out infinite alternate 1.2s;
        }

        .hero-inline-badge--blue svg {
            color: #0284c7;
        }

        .hero-inline-badge--blue:hover {
            transform: translateY(-2px) scale(1.05);
            background: rgba(224, 242, 254, 0.95);
            box-shadow: 0 6px 18px rgba(0, 163, 224, 0.25);
            border-color: #00a3e0;
        }

        html.dark .hero-inline-badge--blue {
            background: rgba(255, 255, 255, 0.12);
            color: #bae6fd;
            border: 1px solid rgba(14, 165, 233, 0.55);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
        }

        html.dark .hero-inline-badge--blue svg {
            color: #38bdf8;
        }

        html.dark .hero-inline-badge--blue:hover {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 24px rgba(14, 165, 233, 0.4);
            border-color: #38bdf8;
        }

        .hero-inline-icon {
            width: 0.95rem;
            height: 0.95rem;
            flex-shrink: 0;
        }

        .hero-subtitle-conjunction {
            color: #64748b;
            font-weight: 500;
            font-size: 1.05em;
            margin: 0 0.1rem;
            transition: color 0.4s ease;
        }

        html.dark .hero-subtitle-conjunction {
            color: #94a3b8;
        }

        .hero-subtitle-dot {
            color: #00a3e0;
            font-weight: 850;
        }

        .hero-inline-icon {
            width: 0.95rem;
            height: 0.95rem;
            flex-shrink: 0;
        }

        .hero-subtitle-conjunction {
            color: #94a3b8;
            font-weight: 400;
            font-size: 1.05em;
            margin: 0 0.1rem;
        }

        .hero-subtitle-dot {
            color: #00a3e0;
            font-weight: 800;
        }

        @keyframes badgeFloatA {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-3px);
            }
        }

        @keyframes badgeFloatB {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-3.5px);
            }
        }

        /* Ecosystem Pillar Quick-Chips: Sleek & Compact */
        .hero-pillars-quick {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            margin: 0.8rem auto 0;
            max-width: 48rem;
            position: relative;
            z-index: 12;
        }

        .hero-pillar-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            background: rgba(248, 250, 252, 0.92);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(226, 232, 240, 0.85);
            font-size: 0.72rem;
            color: #475569;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .hero-pillar-chip strong {
            font-weight: 800;
            letter-spacing: 0.02em;
            color: #0f172a;
        }

        .hero-pillar-chip span {
            font-size: 0.7rem;
            color: #64748b;
        }

        .hero-pillar-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .hero-pillar-chip--tec .hero-pillar-dot {
            background: #0284c7;
        }

        .hero-pillar-chip--print .hero-pillar-dot {
            background: #ea580c;
        }

        .hero-pillar-chip--academy .hero-pillar-dot {
            background: #16a34a;
        }

        .hero-pillar-chip--capital .hero-pillar-dot {
            background: #d97706;
        }

        .hero-pillar-chip:hover {
            transform: translateY(-1.5px);
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.08);
        }

        .hero-pillar-chip--tec:hover {
            border-color: rgba(2, 132, 199, 0.5);
            color: #0284c7;
        }

        .hero-pillar-chip--print:hover {
            border-color: rgba(234, 88, 12, 0.5);
            color: #ea580c;
        }

        .hero-pillar-chip--academy:hover {
            border-color: rgba(22, 163, 74, 0.5);
            color: #16a34a;
        }

        .hero-pillar-chip--capital:hover {
            border-color: rgba(217, 119, 6, 0.5);
            color: #d97706;
        }

        /* Ecosystem CTA Button */
        .hero-home .hero-actions {
            margin: 1.1rem 0 0;
            position: relative;
            z-index: 12;
        }

        .hero-ecosystem-cta {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.85rem;
            min-width: min(100%, 19rem);
            min-height: 48px;
            padding: 0.72rem 2.2rem;
            border: 1px solid rgba(255, 235, 150, 0.55);
            border-radius: 9999px;
            background: linear-gradient(180deg, #f5a623 0%, #df8b13 100%);
            color: #061021;
            font-weight: 850;
            font-size: 0.86rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 0 28px rgba(245, 166, 35, 0.48), 0 8px 24px rgba(0, 0, 0, 0.35);
            position: relative;
            z-index: 12;
        }

        .hero-ecosystem-cta span[aria-hidden="true"] {
            color: #061021;
            font-size: 1.15em;
            display: inline-block;
            transition: transform 0.25s ease;
        }

        .hero-ecosystem-cta:hover {
            color: #061021;
            background: linear-gradient(180deg, #ffb53a 0%, #ea951b 100%);
            transform: translateY(-2px);
            box-shadow: 0 0 36px rgba(245, 166, 35, 0.65), 0 12px 30px rgba(0, 0, 0, 0.45);
        }

        .hero-ecosystem-cta:hover span[aria-hidden="true"] {
            transform: translateX(4px);
        }

        /* ============================================================
           INTEGRATED ARTWORK: BACKDROP WITH SEAMLESS TOP BLEND
        ============================================================ */
        .hero-home-container {
            max-width: 74rem;
            margin-inline: auto;
            padding-top: 3rem;
            padding-left: 1rem;
            padding-right: 1rem;
            position: relative;
        }

        .hero-visual-wrap {
            position: relative;
            width: min(100%, 54rem);
            margin: -2.2rem auto 0;
            z-index: 5;
            transition: all 0.3s ease;
        }

        .hero-visual-wrap picture {
            display: block;
            position: relative;
            z-index: 1;
        }

        .hero-visual {
            display: block;
            width: 100%;
            height: auto;
            object-fit: contain;
            object-position: center;
            border: none !important;
            border-radius: 0 !important;
            background: transparent !important;
            -webkit-mask-image: none !important;
            mask-image: none !important;
            box-shadow: none !important;
            filter: drop-shadow(0 18px 28px rgba(7, 19, 38, 0.14));
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;
        }

        .hero-visual-wrap:hover .hero-visual {
            transform: scale(1.012);
            filter: drop-shadow(0 22px 34px rgba(7, 19, 38, 0.20));
        }

        /* Alternância Dinâmica de Imagem do Hero (Claro vs Escuro) */
        .hero-visual-light,
        picture.hero-visual-light {
            display: block !important;
        }

        .hero-visual-dark,
        picture.hero-visual-dark {
            display: none !important;
        }

        html.dark .hero-visual-light,
        html.dark picture.hero-visual-light {
            display: none !important;
        }

        html.dark .hero-visual-dark,
        html.dark picture.hero-visual-dark {
            display: block !important;
        }

        /* Ambient ground shadow beneath characters in Dark Mode */
        html.dark .hero-visual-wrap::after {
            content: "";
            position: absolute;
            bottom: 3%;
            left: 6%;
            right: 6%;
            height: 28px;
            background: radial-gradient(ellipse 55% 100% at 50% 100%, rgba(0, 0, 0, 0.8) 0%, transparent 80%);
            filter: blur(10px);
            pointer-events: none;
            z-index: 1;
        }

        html.dark .hero-visual {
            filter: drop-shadow(0 20px 32px rgba(0, 0, 0, 0.65));
        }

        html.dark .hero-visual-wrap:hover .hero-visual {
            filter: drop-shadow(0 24px 40px rgba(0, 0, 0, 0.75));
        }

        /* Video Link Overlay - Conheça a RACHI (Dual Theme) */
        .hero-video-link {
            position: absolute;
            right: 1.2rem;
            bottom: 1.2rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.42rem 1.25rem 0.42rem 0.45rem;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(0, 163, 224, 0.35);
            color: #071326;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.08), 0 0 20px rgba(0, 163, 224, 0.12);
            font-size: 0.84rem;
            font-weight: 750;
            letter-spacing: 0.02em;
            text-decoration: none;
            z-index: 12;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hero-video-link:hover {
            color: #0077c2;
            background: #ffffff;
            border-color: #00a3e0;
            transform: translateY(-2.5px) scale(1.02);
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12), 0 0 28px rgba(0, 163, 224, 0.25);
        }

        html.dark .hero-video-link {
            background: rgba(7, 22, 48, 0.85) !important;
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(56, 189, 248, 0.5) !important;
            color: #ffffff !important;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.65), 0 0 24px rgba(0, 163, 224, 0.3) !important;
        }

        html.dark .hero-video-link span,
        html.dark .hero-video-link span:not(.hero-video-play) {
            color: #ffffff !important;
        }

        html.dark .hero-video-link:hover {
            color: #38bdf8 !important;
            background: rgba(12, 34, 72, 0.96) !important;
            border-color: rgba(56, 189, 248, 0.85) !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.75), 0 0 32px rgba(0, 163, 224, 0.5) !important;
        }

        html.dark .hero-video-link:hover span,
        html.dark .hero-video-link:hover span:not(.hero-video-play) {
            color: #38bdf8 !important;
        }

        .hero-video-play {
            display: grid;
            place-items: center;
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            color: #ffffff;
            box-shadow: 0 0 16px rgba(0, 163, 224, 0.65);
            flex-shrink: 0;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .hero-video-link:hover .hero-video-play {
            transform: scale(1.08);
            box-shadow: 0 0 22px rgba(0, 163, 224, 0.95);
        }

        .hero-video-play svg {
            width: 1.05rem;
            height: 1.05rem;
            display: block;
            margin-left: 2px;
        }

        /* Hero Pillars matching print exactly (Dual Theme) */
        .hero-pillars {
            position: relative;
            z-index: 10;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: clamp(1rem, 1.8vw, 1.5rem);
            max-width: 72rem;
            margin: 1.5rem auto 0;
            text-align: left;
        }

        .hero-pillar {
            display: flex;
            align-items: center;
            gap: 1.35rem;
            padding: clamp(1.85rem, 2.5vw, 2.5rem) clamp(1.35rem, 1.8vw, 1.75rem);
            min-height: clamp(8.5rem, 11vw, 9.8rem);
            border: 1px solid rgba(226, 232, 240, 0.95);
            border-radius: 1.35rem;
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            box-shadow: 0 10px 30px -4px rgba(15, 23, 42, 0.07), 0 4px 10px rgba(15, 23, 42, 0.03);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hero-pillar:hover {
            transform: translateY(-3px);
            border-color: rgba(0, 163, 224, 0.35);
            background: #ffffff;
            box-shadow: 0 18px 38px -6px rgba(0, 163, 224, 0.15), 0 8px 16px rgba(15, 23, 42, 0.05);
        }

        html.dark .hero-pillar {
            background: linear-gradient(145deg, rgba(13, 31, 62, 0.85) 0%, rgba(6, 17, 36, 0.92) 100%) !important;
            backdrop-filter: blur(28px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(180%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.12) !important;
        }

        html.dark .hero-pillar:hover {
            transform: translateY(-4px) !important;
            border-color: rgba(56, 189, 248, 0.4) !important;
            background: linear-gradient(145deg, rgba(18, 42, 82, 0.9) 0%, rgba(8, 22, 46, 0.96) 100%) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 28px rgba(0, 163, 224, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
        }

        .hero-pillar-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 4.1rem;
            height: 4.1rem;
            border-radius: 1.15rem;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .hero-pillar:hover .hero-pillar-icon {
            transform: scale(1.05);
        }

        .hero-pillar.theme-blue .hero-pillar-icon {
            background: rgba(239, 246, 255, 0.95);
            border: 1px solid rgba(0, 163, 224, 0.28);
            color: #0284c7;
            box-shadow: 0 4px 12px rgba(0, 163, 224, 0.12);
        }

        html.dark .hero-pillar.theme-blue .hero-pillar-icon {
            background: rgba(8, 26, 54, 0.85);
            border: 1px solid rgba(0, 163, 224, 0.35);
            color: #00a3e0;
            box-shadow: 0 0 16px rgba(0, 163, 224, 0.15);
        }

        .hero-pillar.theme-gold .hero-pillar-icon {
            background: rgba(254, 243, 199, 0.95);
            border: 1px solid rgba(245, 158, 11, 0.28);
            color: #d97706;
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.12);
        }

        html.dark .hero-pillar.theme-gold .hero-pillar-icon {
            background: rgba(42, 30, 8, 0.85);
            border: 1px solid rgba(245, 158, 11, 0.35);
            color: #f59e0b;
            box-shadow: 0 0 16px rgba(245, 158, 11, 0.15);
        }

        .hero-pillar.theme-green .hero-pillar-icon {
            background: rgba(236, 253, 245, 0.95);
            border: 1px solid rgba(16, 185, 129, 0.28);
            color: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.12);
        }

        html.dark .hero-pillar.theme-green .hero-pillar-icon {
            background: rgba(8, 38, 24, 0.85);
            border: 1px solid rgba(16, 185, 129, 0.35);
            color: #10b981;
            box-shadow: 0 0 16px rgba(16, 185, 129, 0.15);
        }

        .hero-pillar-icon svg {
            width: 2rem;
            height: 2rem;
            display: block;
        }

        .hero-pillar-copy {
            position: relative;
            flex: 1;
            min-width: 0;
        }

        .hero-pillar-index {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.06em;
        }

        .hero-pillar.theme-blue .hero-pillar-index { color: #0284c7; }
        .hero-pillar.theme-gold .hero-pillar-index { color: #d97706; }
        .hero-pillar.theme-green .hero-pillar-index { color: #059669; }

        html.dark .hero-pillar.theme-blue .hero-pillar-index { color: #00a3e0; }
        html.dark .hero-pillar.theme-gold .hero-pillar-index { color: #f59e0b; }
        html.dark .hero-pillar.theme-green .hero-pillar-index { color: #10b981; }

        .hero-pillar h2 {
            margin: 0 0 0.35rem;
            color: #071326;
            font-size: clamp(1.02rem, 1.25vw, 1.18rem);
            font-weight: 850;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        html.dark .hero-pillar h2 {
            color: #ffffff;
        }

        .hero-pillar p {
            margin: 0;
            color: #475569;
            font-size: clamp(0.82rem, 0.98vw, 0.9rem);
            line-height: 1.5;
            font-weight: 450;
            transition: color 0.3s ease;
        }

        html.dark .hero-pillar p {
            color: #cbd5e1 !important;
        }

        .hero-pillar-accent-bar {
            width: 36px;
            height: 3px;
            border-radius: 9999px;
            margin-top: 1rem;
        }

        .hero-pillar.theme-blue .hero-pillar-accent-bar {
            background: #00a3e0;
            box-shadow: 0 0 8px rgba(0, 163, 224, 0.7);
        }

        .hero-pillar.theme-gold .hero-pillar-accent-bar {
            background: #f59e0b;
            box-shadow: 0 0 8px rgba(245, 158, 11, 0.7);
        }

        .hero-pillar.theme-green .hero-pillar-accent-bar {
            background: #10b981;
            box-shadow: 0 0 8px rgba(16, 185, 129, 0.7);
        }

        /* Hero Identity Link CTA (Dual Theme) */
        .hero-identity-link {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.85rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(203, 213, 225, 0.9);
            color: #071326;
            font: inherit;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.06);
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }

        .hero-identity-link span[aria-hidden="true"] {
            color: #d97706;
            font-size: 1.15em;
            display: inline-block;
            transition: transform 0.25s ease;
        }

        .hero-identity-link:hover,
        .hero-identity-link:focus-visible {
            background: #071326;
            border-color: #071326;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(7, 19, 38, 0.22);
        }

        .hero-identity-link:hover span[aria-hidden="true"] {
            transform: translateX(4px);
            color: #fbbf24;
        }

        html.dark .hero-identity-link {
            background: rgba(4, 14, 32, 0.75);
            border: 1px solid rgba(56, 189, 248, 0.28);
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.45), 0 0 16px rgba(0, 163, 224, 0.15);
        }

        html.dark .hero-identity-link span[aria-hidden="true"] {
            color: #f7ba42;
        }

        html.dark .hero-identity-link:hover,
        html.dark .hero-identity-link:focus-visible {
            background: rgba(8, 25, 55, 0.92);
            border-color: rgba(56, 189, 248, 0.65);
            color: #38bdf8;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.6), 0 0 24px rgba(0, 163, 224, 0.35);
        }

        @media (max-width: 991.98px) {
            .hero-home {
                padding-top: 5.5rem;
            }

            .hero-pillars {
                grid-template-columns: 1fr;
            }

            .hero-video-link {
                position: relative;
                right: auto;
                bottom: auto;
                justify-content: center;
                width: fit-content;
                margin: 0.75rem auto 0;
            }

            .hero-visual-wrap {
                margin-top: -1.75rem;
                width: min(100%, 46rem);
            }

            .hero-home .hero-title {
                font-size: clamp(1.5rem, 4.5vw, 2.2rem);
            }

            .hero-home .hero-content::before {
                inset: -1rem -0.5rem -1rem -0.5rem;
            }
        }

        @media (max-width: 640px) {
            .site-header {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
                padding-top: 0.65rem !important;
                padding-bottom: 0.65rem !important;
            }
            .header-col-logo {
                padding-left: 0.25rem;
            }
            .brand-logo-img {
                height: 32px !important;
                max-width: 140px !important;
            }
            .btn-entrar-nav {
                padding: 0.42rem 0.85rem !important;
                font-size: 0.74rem !important;
                letter-spacing: 0.04em !important;
            }
            .mobile-menu-btn {
                padding: 0.4rem !important;
            }
        }

        @media (max-width: 575.98px) {
            .hero-home {
                padding-top: 4.8rem !important;
                padding-bottom: 2.2rem !important;
            }

            .hero-home-container {
                padding-top: 0 !important;
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }

            .hero-home .hero-title {
                font-size: clamp(1.4rem, 6.2vw, 1.85rem) !important;
                line-height: 1.15 !important;
            }

            .hero-title-line {
                display: block !important;
                margin-bottom: 0.2rem !important;
            }

            .hero-subtitle-box {
                margin: 0.75rem auto 0 !important;
                max-width: 22rem !important;
                padding: 0 0.25rem !important;
            }

            .hero-home .hero-subtitle {
                font-size: 0.86rem !important;
                line-height: 1.5 !important;
                gap: 0.35rem 0.45rem !important;
                justify-content: center !important;
            }

            .hero-inline-badge {
                padding: 0.15rem 0.65rem !important;
                font-size: 0.82em !important;
            }

            .hero-ecosystem-cta {
                width: 100% !important;
                max-width: 19rem !important;
                min-width: 0 !important;
                margin: 1.15rem auto 0 !important;
                padding: 0.72rem 1.6rem !important;
                font-size: 0.82rem !important;
            }

            .hero-visual-wrap {
                margin-top: 0.5rem !important;
                width: 100% !important;
                max-width: 26rem !important;
                margin-inline: auto !important;
            }

            .hero-visual {
                width: 100% !important;
                height: auto !important;
                min-height: auto !important;
                max-height: 320px !important;
                object-fit: contain !important;
                object-position: center !important;
                border: none !important;
                -webkit-mask-image: none !important;
                mask-image: none !important;
                filter: drop-shadow(0 14px 24px rgba(7, 19, 38, 0.12)) !important;
            }

            .hero-video-link {
                position: relative !important;
                right: auto !important;
                bottom: auto !important;
                display: inline-flex !important;
                width: auto !important;
                max-width: fit-content !important;
                margin: 0.85rem auto 0 !important;
                padding: 0.4rem 1.25rem 0.4rem 0.45rem !important;
                font-size: 0.8rem !important;
                background: rgba(255, 255, 255, 0.95) !important;
                backdrop-filter: blur(16px) !important;
                -webkit-backdrop-filter: blur(16px) !important;
                border: 1px solid rgba(0, 163, 224, 0.35) !important;
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08) !important;
            }

            .hero-pillars-quick {
                gap: 0.3rem !important;
            }

            .hero-pillars {
                grid-template-columns: 1fr !important;
                gap: 0.85rem !important;
                margin-top: 1.5rem !important;
            }

            .hero-pillar {
                padding: 1.25rem 1.15rem !important;
                min-height: 0 !important;
                gap: 1.1rem !important;
            }

            .hero-pillar-icon {
                width: 3.25rem !important;
                height: 3.25rem !important;
            }

            .hero-pillar h2 {
                font-size: 1.05rem !important;
            }

            .hero-pillar p {
                font-size: 0.82rem !important;
            }
        }

        /* ------------------------------------------------------------ */
        /* COMPREHENSIVE DARK MODE: PARCEIROS, CARDS & SECTIONS         */
        /* ------------------------------------------------------------ */
        html.dark #parceiros {
            background-color: #040b17 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark #partners-title {
            color: #ffffff !important;
        }

        html.dark #partners-title span,
        html.dark .partners-title-gradient {
            background-image: linear-gradient(135deg, #00a3e0 0%, #38bdf8 50%, #60a5fa 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            filter: drop-shadow(0 0 16px rgba(0, 163, 224, 0.35));
        }

        /* Parceiros Article Cards (Dark Luxury Glass) */
        html.dark #parceiros article,
        html.dark article.bg-white {
            background: linear-gradient(145deg, rgba(12, 26, 51, 0.94) 0%, rgba(7, 18, 38, 0.98) 100%) !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 16px 40px -10px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
        }

        html.dark #parceiros article:hover,
        html.dark article.bg-white:hover {
            transform: translateY(-4px) !important;
            border-color: rgba(56, 189, 248, 0.45) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 24px rgba(0, 163, 224, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        /* Partner Logo Container (Dark Mode Luxury Tile) */
        html.dark #parceiros article .shrink-0,
        html.dark #parceiros article .rounded-2xl.bg-white {
            background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.08) 0%, rgba(13, 30, 56, 0.85) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 6px 18px rgba(0, 0, 0, 0.45) !important;
        }

        html.dark #parceiros article:hover .shrink-0,
        html.dark #parceiros article:hover .rounded-2xl.bg-white {
            border-color: rgba(56, 189, 248, 0.45) !important;
            box-shadow: 0 0 20px rgba(0, 163, 224, 0.25) !important;
        }

        /* Badges inside Partner Cards */
        html.dark #parceiros article .bg-blue-50 {
            background-color: rgba(14, 46, 85, 0.75) !important;
            color: #38bdf8 !important;
            border-color: rgba(56, 189, 248, 0.35) !important;
        }

        html.dark #parceiros article .bg-amber-50 {
            background-color: rgba(56, 38, 8, 0.75) !important;
            color: #fbbf24 !important;
            border-color: rgba(245, 158, 11, 0.35) !important;
        }

        /* Titles and Texts inside Partner Cards */
        html.dark #parceiros article h3 {
            color: #ffffff !important;
        }

        html.dark #parceiros article p {
            color: #cbd5e1 !important;
        }

        html.dark #parceiros article strong {
            color: #ffffff !important;
        }

        html.dark #parceiros article .text-slate-300 {
            color: rgba(255, 255, 255, 0.25) !important;
        }

        /* Mini Tags inside Partner Cards */
        html.dark #parceiros article .bg-slate-100 {
            background-color: rgba(255, 255, 255, 0.08) !important;
            color: #cbd5e1 !important;
            border: 1px solid rgba(255, 255, 255, 0.06) !important;
        }

        html.dark #parceiros article .border-slate-100 {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Metrics & Trust Box (Left Column) */
        html.dark #parceiros .lg\:col-span-5 .bg-white {
            background: linear-gradient(145deg, rgba(12, 26, 51, 0.94) 0%, rgba(7, 18, 38, 0.98) 100%) !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.5) !important;
        }

        html.dark #parceiros .lg\:col-span-5 .bg-white .text-\[\#071326\] {
            color: #ffffff !important;
        }

        html.dark #parceiros .lg\:col-span-5 .bg-white .text-slate-500 {
            color: #94a3b8 !important;
        }

        html.dark #parceiros .lg\:col-span-5 .bg-emerald-50 {
            background-color: rgba(6, 44, 28, 0.7) !important;
            color: #34d399 !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
        }

        html.dark #parceiros .lg\:col-span-5 .border-slate-200\/70 {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark #parceiros .lg\:col-span-5 a.bg-\[\#071326\] {
            background: linear-gradient(135deg, #0b2246 0%, #07152e 100%) !important;
            border: 1px solid rgba(56, 189, 248, 0.35) !important;
            color: #ffffff !important;
        }

        html.dark #parceiros .lg\:col-span-5 a.bg-\[\#071326\]:hover {
            background: linear-gradient(135deg, #0f3064 0%, #0a1e42 100%) !important;
            border-color: rgba(56, 189, 248, 0.75) !important;
            box-shadow: 0 0 20px rgba(0, 163, 224, 0.3) !important;
        }

        /* Universal Cards & Containers in Dark Mode */
        html.dark .bg-white:not(.shrink-0):not(.brand-white-pill):not(.theme-toggle-btn):not(.logo-container-white) {
            background-color: #0c1a33 !important;
            color: #e2e8f0 !important;
        }

        html.dark .bg-slate-50,
        html.dark .bg-\[\#f8fafc\] {
            background-color: #050e1d !important;
            color: #cbd5e1 !important;
        }

        /* ------------------------------------------------------------ */
        /* SECTION: LOJA (PRODUTOS EM DESTAQUE) DARK MODE POLISH       */
        /* ------------------------------------------------------------ */
        html.dark #loja {
            background-color: #071326 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark #loja h2 {
            color: #ffffff !important;
        }

        html.dark #loja p {
            color: #cbd5e1 !important;
        }

        /* 3 Benefit Cards (Entrega, Levantamento, Empresas) */
        html.dark #loja .grid-cols-1.md\:grid-cols-3 > div {
            background: linear-gradient(145deg, rgba(12, 26, 51, 0.94) 0%, rgba(7, 18, 38, 0.98) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 10px 28px -4px rgba(0, 0, 0, 0.5) !important;
        }

        html.dark #loja .grid-cols-1.md\:grid-cols-3 h3 {
            color: #ffffff !important;
        }

        html.dark #loja .grid-cols-1.md\:grid-cols-3 p {
            color: #94a3b8 !important;
        }

        html.dark #loja .w-12.h-12.bg-blue-100 {
            background: rgba(14, 46, 85, 0.85) !important;
            color: #38bdf8 !important;
            border: 1px solid rgba(56, 189, 248, 0.35) !important;
            box-shadow: 0 0 16px rgba(0, 163, 224, 0.25) !important;
        }

        html.dark #loja .w-12.h-12.bg-amber-100 {
            background: rgba(56, 38, 8, 0.85) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 158, 11, 0.35) !important;
            box-shadow: 0 0 16px rgba(245, 158, 11, 0.25) !important;
        }

        html.dark #loja .w-12.h-12.bg-emerald-100 {
            background: rgba(6, 44, 28, 0.85) !important;
            color: #34d399 !important;
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
            box-shadow: 0 0 16px rgba(16, 185, 129, 0.25) !important;
        }

        /* Carousel Top Controls (< 2/5 >) */
        html.dark #loja .bg-slate-100.p-1\.5 {
            background: rgba(12, 26, 51, 0.95) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        html.dark #loja .bg-slate-100.p-1\.5 button {
            background: rgba(255, 255, 255, 0.09) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        html.dark #loja .bg-slate-100.p-1\.5 button:hover {
            background: #f5a800 !important;
            color: #071326 !important;
            border-color: #f5a800 !important;
        }

        html.dark #loja .bg-slate-100.p-1\.5 span {
            color: #cbd5e1 !important;
        }

        /* Link: Explorar catálogo completo */
        html.dark #loja a[href="/loja"] {
            background: linear-gradient(135deg, #0b2246 0%, #07152e 100%) !important;
            border: 1px solid rgba(56, 189, 248, 0.35) !important;
            color: #ffffff !important;
        }

        html.dark #loja a[href="/loja"]:hover {
            background: #f5a800 !important;
            border-color: #f5a800 !important;
            color: #071326 !important;
            box-shadow: 0 0 20px rgba(245, 168, 0, 0.35) !important;
        }

        /* Product Cards */
        html.dark #loja .grid.grid-cols-1.sm\:grid-cols-2 > div,
        html.dark #loja [class*="bg-white rounded-2xl border"] {
            background: linear-gradient(145deg, rgba(12, 26, 51, 0.94) 0%, rgba(7, 18, 38, 0.98) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 14px 34px -8px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
            color: #e2e8f0 !important;
        }

        html.dark #loja .grid.grid-cols-1.sm\:grid-cols-2 > div:hover,
        html.dark #loja [class*="bg-white rounded-2xl border"]:hover {
            transform: translateY(-4px) !important;
            border-color: rgba(56, 189, 248, 0.45) !important;
            box-shadow: 0 20px 45px -8px rgba(0, 0, 0, 0.8), 0 0 24px rgba(0, 163, 224, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        /* Product Image Showcase Pod (Dark Mode Luxury Pedestal) */
        html.dark #loja .h-52 {
            background: radial-gradient(circle at 50% 45%, rgba(255, 255, 255, 0.08) 0%, rgba(13, 30, 56, 0.65) 70%, rgba(7, 18, 38, 0.95) 100%) !important;
            border-radius: 1.15rem !important;
            margin: 0.85rem !important;
            height: 12.5rem !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 8px 24px -4px rgba(0, 0, 0, 0.55) !important;
        }

        html.dark #loja .group:hover .h-52 {
            background: radial-gradient(circle at 50% 45%, rgba(245, 168, 0, 0.14) 0%, rgba(13, 30, 56, 0.75) 70%, rgba(7, 18, 38, 0.98) 100%) !important;
            border-color: rgba(245, 168, 0, 0.4) !important;
        }

        /* Floating 3D drop shadow on product transparent PNG images */
        html.dark #loja .h-52 img {
            filter: drop-shadow(0 14px 20px rgba(0, 0, 0, 0.75)) drop-shadow(0 3px 6px rgba(0, 0, 0, 0.5)) !important;
        }

        /* Product Category */
        html.dark #loja span[x-text="p.category"] {
            color: #38bdf8 !important;
            font-weight: 800 !important;
        }

        /* Rating Text */
        html.dark #loja span[x-text="p.rating"] {
            color: #e2e8f0 !important;
        }

        /* Product Name */
        html.dark #loja h4[x-text="p.name"] {
            color: #ffffff !important;
        }

        html.dark #loja .group:hover h4[x-text="p.name"] {
            color: #38bdf8 !important;
        }

        /* Product Short Description */
        html.dark #loja p[x-text="p.shortDesc"] {
            color: #94a3b8 !important;
        }

        /* Product Price Section (High Contrast Visibility) */
        html.dark #loja span[x-text="p.oldPrice"] {
            color: #64748b !important;
        }

        html.dark #loja span[x-text="p.priceText"],
        html.dark #loja .text-slate-950:not(button):not(a) {
            color: #ffffff !important;
            font-size: 1.15rem !important;
            font-weight: 900 !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        /* Comprar Button */
        html.dark #loja button.bg-\[\#f5a800\] {
            background: #f5a800 !important;
            color: #071326 !important;
            font-weight: 900 !important;
            box-shadow: 0 4px 14px rgba(245, 168, 0, 0.35) !important;
        }

        html.dark #loja button.bg-\[\#f5a800\]:hover {
            background: #fbbf24 !important;
            box-shadow: 0 6px 20px rgba(245, 168, 0, 0.5) !important;
        }

        /* Bottom Dots */
        html.dark #loja .bg-slate-300 {
            background-color: rgba(255, 255, 255, 0.22) !important;
        }

        html.dark #loja .bg-slate-300:hover {
            background-color: rgba(255, 255, 255, 0.45) !important;
        }

        /* ------------------------------------------------------------ */
        /* SECTION: SOLUÇÕES (4 ÁREAS DE ACTUAÇÃO) DARK MODE POLISH    */
        /* ------------------------------------------------------------ */
        html.dark #solucoes {
            background: #040b17 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark #solucoes h2 {
            color: #ffffff !important;
        }

        html.dark #solucoes h3 {
            color: #ffffff !important;
        }

        html.dark #solucoes p {
            color: #cbd5e1 !important;
        }

        /* Cards Base */
        html.dark #solucoes .group.bg-white {
            background: linear-gradient(150deg, rgba(12, 26, 51, 0.95) 0%, rgba(6, 15, 33, 0.98) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 16px 38px -8px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            color: #e2e8f0 !important;
        }

        /* Individual Card Accent Borders & Glows */
        html.dark #solucoes .grid > div:nth-child(1) {
            border-color: rgba(16, 185, 129, 0.28) !important;
        }
        html.dark #solucoes .grid > div:nth-child(1):hover {
            transform: translateY(-5px) !important;
            border-color: rgba(16, 185, 129, 0.65) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 28px rgba(16, 185, 129, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        html.dark #solucoes .grid > div:nth-child(2) {
            border-color: rgba(99, 102, 241, 0.28) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2):hover {
            transform: translateY(-5px) !important;
            border-color: rgba(99, 102, 241, 0.65) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 28px rgba(99, 102, 241, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        html.dark #solucoes .grid > div:nth-child(3) {
            border-color: rgba(0, 163, 224, 0.28) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3):hover {
            transform: translateY(-5px) !important;
            border-color: rgba(0, 163, 224, 0.65) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 28px rgba(0, 163, 224, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        html.dark #solucoes .grid > div:nth-child(4) {
            border-color: rgba(245, 168, 0, 0.28) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4):hover {
            transform: translateY(-5px) !important;
            border-color: rgba(245, 168, 0, 0.65) !important;
            box-shadow: 0 24px 50px -8px rgba(0, 0, 0, 0.8), 0 0 28px rgba(245, 168, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        /* Top Category Badges (Dark Glass Pills) */
        html.dark #solucoes .bg-emerald-50 {
            background: rgba(6, 44, 28, 0.85) !important;
            color: #34d399 !important;
            border-color: rgba(16, 185, 129, 0.4) !important;
            box-shadow: 0 0 14px rgba(16, 185, 129, 0.15) !important;
        }

        html.dark #solucoes .bg-indigo-50 {
            background: rgba(30, 27, 75, 0.85) !important;
            color: #818cf8 !important;
            border-color: rgba(99, 102, 241, 0.4) !important;
            box-shadow: 0 0 14px rgba(99, 102, 241, 0.15) !important;
        }

        html.dark #solucoes .bg-sky-50 {
            background: rgba(8, 47, 73, 0.85) !important;
            color: #38bdf8 !important;
            border-color: rgba(56, 189, 248, 0.4) !important;
            box-shadow: 0 0 14px rgba(0, 163, 224, 0.15) !important;
        }

        html.dark #solucoes .bg-amber-50 {
            background: rgba(69, 26, 3, 0.85) !important;
            color: #fbbf24 !important;
            border-color: rgba(245, 158, 11, 0.4) !important;
            box-shadow: 0 0 14px rgba(245, 158, 11, 0.15) !important;
        }

        /* Logo Containers & Contour Illumination */
        html.dark #solucoes .grid > div:nth-child(1) .h-28 {
            background: radial-gradient(circle at 50% 50%, rgba(0, 229, 255, 0.32) 0%, rgba(16, 185, 129, 0.14) 45%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(1) img {
            filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 14px rgba(16, 185, 129, 0.35)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(2) .h-28 {
            background: radial-gradient(circle at 50% 50%, rgba(129, 140, 248, 0.35) 0%, rgba(99, 102, 241, 0.15) 45%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2) img {
            filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 14px rgba(99, 102, 241, 0.35)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(3) .h-28 {
            background: radial-gradient(circle at 50% 50%, rgba(14, 165, 233, 0.38) 0%, rgba(2, 132, 199, 0.15) 45%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3) img {
            filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 14px rgba(0, 163, 224, 0.35)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(4) .h-28 {
            background: radial-gradient(circle at 50% 50%, rgba(245, 158, 11, 0.38) 0%, rgba(217, 119, 6, 0.15) 45%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4) img {
            filter: drop-shadow(0 4px 14px rgba(0, 0, 0, 0.5)) drop-shadow(0 0 14px rgba(245, 168, 0, 0.35)) !important;
        }

        /* Watermarks 01, 02, 03, 04 */
        html.dark #solucoes span.select-none {
            color: rgba(255, 255, 255, 0.15) !important;
            font-weight: 900 !important;
        }
        html.dark #solucoes .grid > div:nth-child(1):hover span.select-none {
            color: rgba(16, 185, 129, 0.45) !important;
            text-shadow: 0 0 20px rgba(16, 185, 129, 0.5) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2):hover span.select-none {
            color: rgba(99, 102, 241, 0.45) !important;
            text-shadow: 0 0 20px rgba(99, 102, 241, 0.5) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3):hover span.select-none {
            color: rgba(0, 163, 224, 0.45) !important;
            text-shadow: 0 0 20px rgba(0, 163, 224, 0.5) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4):hover span.select-none {
            color: rgba(245, 168, 0, 0.45) !important;
            text-shadow: 0 0 20px rgba(245, 168, 0, 0.5) !important;
        }

        /* Checklist Bullets */
        html.dark #solucoes .space-y-2 span {
            color: #e2e8f0 !important;
            font-weight: 600 !important;
        }
        html.dark #solucoes .border-slate-100 {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Saber mais Buttons */
        html.dark #solucoes a[class*="bg-slate-900"] {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            font-weight: 750 !important;
        }
        html.dark #solucoes .grid > div:nth-child(1) a[class*="bg-slate-900"]:hover {
            background: #10b981 !important;
            border-color: #10b981 !important;
            box-shadow: 0 0 18px rgba(16, 185, 129, 0.45) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2) a[class*="bg-slate-900"]:hover {
            background: #6366f1 !important;
            border-color: #6366f1 !important;
            box-shadow: 0 0 18px rgba(99, 102, 241, 0.45) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3) a[class*="bg-slate-900"]:hover {
            background: #00a3e0 !important;
            border-color: #00a3e0 !important;
            box-shadow: 0 0 18px rgba(0, 163, 224, 0.45) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4) a[class*="bg-slate-900"]:hover {
            background: #f5a800 !important;
            border-color: #f5a800 !important;
            color: #071326 !important;
            box-shadow: 0 0 18px rgba(245, 168, 0, 0.45) !important;
        }

        /* Icon Buttons */
        html.dark #solucoes button[title*="Pedir"] {
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #cbd5e1 !important;
        }
        html.dark #solucoes .grid > div:nth-child(1) button[title*="Pedir"]:hover {
            background: rgba(16, 185, 129, 0.15) !important;
            border-color: #10b981 !important;
            color: #34d399 !important;
            box-shadow: 0 0 14px rgba(16, 185, 129, 0.3) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2) button[title*="Pedir"]:hover {
            background: rgba(99, 102, 241, 0.15) !important;
            border-color: #6366f1 !important;
            color: #a5b4fc !important;
            box-shadow: 0 0 14px rgba(99, 102, 241, 0.3) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3) button[title*="Pedir"]:hover {
            background: rgba(0, 163, 224, 0.15) !important;
            border-color: #00a3e0 !important;
            color: #38bdf8 !important;
            box-shadow: 0 0 14px rgba(0, 163, 224, 0.3) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4) button[title*="Pedir"]:hover {
            background: rgba(245, 168, 0, 0.15) !important;
            border-color: #f5a800 !important;
            color: #fbbf24 !important;
            box-shadow: 0 0 14px rgba(245, 168, 0, 0.3) !important;
        }

        /* ============================================================ */
        /* DUAL-THEME FOOTER: CLEAN & LUXURIOUS LIGHT MODE & DARK MODE */
        /* ============================================================ */
        .site-footer {
            background-color: #f8fafc;
            color: #475569;
            border-top: 1px solid #e2e8f0;
        }

        .site-footer .footer-logo-light {
            display: none !important;
        }

        .site-footer .footer-logo-dark {
            display: block !important;
        }

        .site-footer h4 {
            color: #071326;
            font-weight: 850;
        }

        .site-footer p {
            color: #64748b;
        }

        .site-footer ul li a {
            color: #475569;
            transition: color 0.2s ease;
        }

        .site-footer ul li a:hover {
            color: #00a3e0;
        }

        .site-footer .footer-bottom {
            border-top: 1px solid #e2e8f0;
            color: #64748b;
        }

        .site-footer .footer-lang-pt {
            color: #d97706;
            font-weight: 750;
        }

        .site-footer .footer-lang-en {
            color: #64748b;
            transition: color 0.2s ease;
        }

        .site-footer .footer-lang-en:hover {
            color: #00a3e0;
        }

        /* Dark Mode Footer */
        html.dark .site-footer {
            background-color: #040b17 !important;
            color: #94a3b8 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        html.dark .site-footer .footer-logo-light {
            display: block !important;
        }

        html.dark .site-footer .footer-logo-dark {
            display: none !important;
        }

        html.dark .site-footer h4 {
            color: #fbbf24 !important;
        }

        html.dark .site-footer p {
            color: #94a3b8 !important;
        }

        html.dark .site-footer ul li a {
            color: #cbd5e1 !important;
        }

        html.dark .site-footer ul li a:hover {
            color: #ffffff !important;
        }

        html.dark .site-footer .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #64748b !important;
        }

        html.dark .site-footer .footer-lang-pt {
            color: #fbbf24 !important;
        }

        html.dark .site-footer .footer-lang-en {
            color: #94a3b8 !important;
        }

        html.dark .site-footer .footer-lang-en:hover {
            color: #ffffff !important;
        }
    </style>
    <link rel="stylesheet" href="/css/site.css?v=1790340043">
</head>

<body x-data="rachiApp()" class="min-h-screen flex flex-col justify-between">



    <!-- ============================================================== -->
    <!-- VIEW 1: PUBLIC PORTAL (EXACT CLONE OF https://rachi.ao/)   -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'public'">

        <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4 lg:py-4.5">
            <div class="site-header-inner max-w-[1040px] mx-auto flex items-center justify-between gap-2 lg:gap-3 xl:gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="header-col-logo w-auto lg:w-[140px] flex-shrink-0 flex items-center justify-start z-10">
                    <a href="#home" @click.prevent="goToHome(); solutionsOpen = false"
                        class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
                        <!-- Light Logo (for dark header at top) -->
                        <img src="/images/logo-rachi-light.png"
                            onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                            alt="RACHI"
                            class="brand-logo-img logo-light filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.3)] transition-all">
                        <!-- Dark Logo (for light header when scrolled) -->
                        <img src="/images/logo-rachi-dark.png"
                            onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI"
                            class="brand-logo-img logo-dark filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.2)] transition-all">
                    </a>
                </div>

                <!-- Coluna 2 (Centro): Navegação em Cápsula (Centralizada e Protegida) -->
                <div class="header-col-nav flex-1 hidden lg:flex items-center justify-center min-w-0 px-1">
                    <nav class="flex items-center main-nav-capsule">
                        <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="nav-link cursor-pointer"
                            :class="(!solutionsOpen && currentTab === 'home') ? 'active' : ''">
                            <span>Home</span>
                        </a>

                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false; solutionsOpen = false" @keydown.escape.window="open = false; solutionsOpen = false" >
                        <button type="button" @click="open = !open; solutionsOpen = false"
                            class="nav-link flex items-center gap-1.5 focus:outline-none"
                            :class="open ? 'nav-link-open' : ''">
                            <span>Sobre Nós</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" class="opacity-70 transition-transform duration-200"
                                :class="open ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="header-dropdown absolute top-full left-0 mt-2 w-56 bg-white/95 dark:bg-[#071326]/95 backdrop-blur-2xl border border-slate-200/90 dark:border-white/15 rounded-2xl shadow-xl dark:shadow-2xl p-2 z-50 text-sm space-y-1 before:absolute before:-top-3 before:left-0 before:right-0 before:h-3">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                                                                                    <a href="#diferencial" @click.prevent="scrollToSection('diferencial'); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O nosso diferencial</span>
                            </a>
                            <a href="#missao" @click.prevent="openIdentityModal(); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="compass" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Missão, visão e valores</span>
                            </a>
<a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false; solutionsOpen = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Testemunhos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                    <button type="button"
                        id="btn-nav-solutions"
                        @click.stop="solutionsOpen = !solutionsOpen"
                        class="nav-link solutions-trigger-btn relative flex items-center gap-1.5 focus:outline-none cursor-pointer transition-all duration-200"
                        :class="solutionsOpen ? 'text-white font-semibold' : (['capital','academy','tec','print'].includes(currentTab) ? 'active' : '')">
                        <span class="relative py-1 inline-block">
                            Soluções
                            <!-- Linha ciano brilhante sob a palavra Soluções (idêntica à imagem de referência) -->
                            <span x-show="solutionsOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-x-0"
                                x-transition:enter-end="opacity-100 scale-x-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-x-100"
                                x-transition:leave-end="opacity-0 scale-x-0"
                                style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; background-color: #00a3e0; border-radius: 9999px; box-shadow: 0 0 10px rgba(0, 163, 224, 0.9);"
                                x-cloak></span>
                        </span>
                    </button>

                    <a href="#etica" @click.prevent="scrollToSection('etica'); solutionsOpen = false; mobileMenuOpen = false" class="nav-link"
                        :class="currentTab === 'etica' ? 'active' : ''">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="/loja" @click="solutionsOpen = false" class="nav-link">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" @click="solutionsOpen = false" class="nav-link">
                        <span>Contacto</span>
                    </a>
                </nav>
                </div>

                <!-- Coluna 3 (Direita): Autenticação, Perfil e Ações Rápidas -->
                <div class="header-col-auth w-auto lg:w-[140px] flex-shrink-0 flex items-center justify-end gap-2 sm:gap-3 z-10">
                    

                    <!-- Entrar / Perfil do Utilizador Autenticado (Renderizado estaticamente para zero layout shift) -->
                    <button x-show="!currentUser" @click="loginModal = true; authTab = 'login'; authError = ''" class="btn-entrar-nav group">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                            class="group-hover:translate-x-0.5 transition-transform">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        <span>ENTRAR</span>
                    </button>

                    <div x-show="currentUser" x-cloak class="relative" x-data="{ userMenuDropdown: false }" @click.away="userMenuDropdown = false">
                        <button @click="userMenuDropdown = !userMenuDropdown"
                            class="user-menu-capsule flex items-center gap-2 sm:gap-2.5 py-1.5 pl-2 pr-3 sm:pr-3.5 rounded-full transition-all duration-200 cursor-pointer group"
                            aria-label="Menu do Utilizador"
                            :aria-expanded="userMenuDropdown">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-xs flex items-center justify-center shadow-xs shrink-0 ring-1 ring-black/5 dark:ring-white/10"
                                 x-text="currentUser?.avatar || 'U'"></div>
                            <span class="user-menu-capsule-name text-xs font-bold leading-none max-w-[110px] xl:max-w-[150px] truncate transition-colors hidden sm:inline-block" x-text="currentUser?.nome"></span>
                            <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[#00a3e0] transition-transform duration-200 shrink-0" :class="userMenuDropdown ? 'rotate-180 text-[#00a3e0]' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Menu Dropdown com Permissões & Design Premium -->
                        <div x-show="userMenuDropdown" x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="user-menu-dropdown header-dropdown absolute right-0 mt-2.5 w-72 sm:w-80 rounded-2xl p-2.5 z-50 text-xs transition-colors">
                            
                            <!-- Header do Utilizador -->
                            <div class="user-menu-header-card px-3.5 py-3 rounded-xl mb-1.5 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-sm flex items-center justify-center shadow-xs shrink-0 ring-2 ring-white dark:ring-slate-800"
                                     x-text="currentUser?.avatar || 'U'"></div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5">
                                        <span class="user-menu-name font-bold text-xs sm:text-sm truncate" x-text="currentUser?.nome"></span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0" title="Ativo"></span>
                                    </div>
                                    <div class="user-menu-email text-[11px] truncate mt-0.5" x-text="currentUser?.email"></div>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <!-- Permissão 3: Academy (Perfil de Aluno) - Acesso por Matrícula Ativa -->
                                <button @click="openAcademyAluno(); userMenuDropdown = false"
                                        class="group w-full flex items-center justify-between p-2.5 rounded-xl hover:bg-emerald-50/70 dark:hover:bg-emerald-950/30 text-left transition-all duration-150 cursor-pointer border border-transparent hover:border-emerald-200/60 dark:hover:border-emerald-800/40">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="user-menu-item-title text-xs font-semibold group-hover:text-emerald-600 dark:group-hover:text-emerald-300 transition-colors">Perfil Aluno (Academy)</div>
                                            <div class="user-menu-item-sub text-[10px]">Portal e cursos</div>
                                        </div>
                                    </div>
                                    <template x-if="canAccessStudentPortal()">
                                        <span class="user-menu-badge-active inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full whitespace-nowrap shrink-0">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span>Matrícula Ativa</span>
                                        </span>
                                    </template>
                                    <template x-if="!canAccessStudentPortal()">
                                        <span class="user-menu-badge-inactive inline-flex items-center gap-1.5 text-[10px] font-bold px-2.5 py-1 rounded-full whitespace-nowrap shrink-0">
                                            <span>Sem Matrícula</span>
                                        </span>
                                    </template>
                                </button>

                                <!-- Apenas Administrador ou Super Administrador: Atalho para Admin Dashboard -->
                                <template x-if="isAdminUser()">
                                    <a href="/admin-dashboard" @click="openAdminDashboard(); userMenuDropdown = false"
                                       class="group w-full flex items-center justify-between p-2.5 rounded-xl hover:bg-amber-50/70 dark:hover:bg-amber-950/30 text-left transition-all duration-150 cursor-pointer border border-transparent hover:border-amber-200/60 dark:hover:border-amber-800/40">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="user-menu-item-title text-xs font-semibold group-hover:text-amber-600 dark:group-hover:text-amber-300 transition-colors">Painel Administrativo</div>
                                                <div class="user-menu-item-sub text-[10px]">Gestão e controlo</div>
                                            </div>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-500 group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </template>

                                <!-- Logout -->
                                <div class="pt-1.5 mt-1.5 border-t border-slate-100 dark:border-white/5">
                                    <button @click="logout(); userMenuDropdown = false"
                                            class="group w-full flex items-center justify-between p-2.5 rounded-xl hover:bg-rose-50/80 dark:hover:bg-rose-950/30 text-left transition-all duration-150 cursor-pointer border border-transparent hover:border-rose-200/60 dark:hover:border-rose-800/40">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-rose-500/10 text-rose-600 dark:text-rose-400 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            </div>
                                            <div>
                                                <div class="text-xs font-semibold text-rose-600 dark:text-rose-400">Terminar Sessão</div>
                                                <div class="user-menu-item-sub text-[10px]">Sair com segurança</div>
                                            </div>
                                        </div>
                                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 group-hover:text-rose-500 group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="mobile-menu-btn lg:hidden p-2 rounded-xl text-slate-800 dark:text-white hover:text-[#0050f0] dark:hover:text-[#00a3e0] focus:outline-none transition"
                        aria-label="Menu Principal">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak
                class="header-dropdown lg:hidden bg-white/95 dark:bg-[#071326]/95 text-slate-800 dark:text-white backdrop-blur-2xl border-t border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
                <a href="#home" @click.prevent="goToHome(); solutionsOpen = false"
                    class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Sobre Nós</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="#sobre" @click.prevent="scrollToSection('sobre'); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white">Quem somos</a>
                        <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white">O que fazemos</a>
                                                <a href="#diferencial" @click.prevent="scrollToSection('diferencial'); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white transition">O nosso diferencial</a>
                        <a href="#missao" @click.prevent="openIdentityModal(); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white transition">Missão, visão e valores</a>
<a href="#parceiros" @click.prevent="scrollToSection('parceiros'); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white">Parceiros</a>
                        <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-white">Testemunhos</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-[#00a3e0] tracking-wider">Soluções</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="/capital" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-emerald-400">01 RACHI Human Capital (Pessoas
                            &amp; Gestão)</a>
                        <a href="/academy" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy (Capacitação
                            &amp; Ensino)</a>
                        <a href="/tec" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-sky-400">03 RACHI Tec (Tecnologia &amp;
                            TI)</a>
                        <a href="/print" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-amber-400">04 RACHI Print (Gráfica &amp;
                            Produção)</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2 space-y-2">
                    <a href="#etica" @click.prevent="scrollToSection('etica'); solutionsOpen = false; mobileMenuOpen = false"
                        class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="/loja" class="block font-medium py-1 hover:text-[#00a3e0]">Loja</a>
                    <a href="/contacto" class="block font-medium py-1 hover:text-[#00a3e0]">Contacto</a>
                </div>
            </div>
        </header>

        <!-- MEGA PAINEL DE SOLUÇÕES (ECOSSISTEMA RACHI) -->
        @include('components.solutions-mega-menu')

        <!-- Script de Rolagem Inteligente (Estilo Klasse.ao): Adaptável ao Tema -->
        <script>
                (function () {
                    function updateHeaderScroll() {
                        var header = document.getElementById('main-site-header') || document.querySelector('.site-header');
                        if (!header) return;
                        if (window.scrollY > 20) {
                            header.classList.add('header-scrolled');
                        } else {
                            header.classList.remove('header-scrolled');
                        }
                    }
                    window.addEventListener('scroll', updateHeaderScroll, { passive: true });
                    updateHeaderScroll();
                })();
        </script>

        <!-- SUB-PAGE: HOME -->
        <div x-show="currentTab === 'home'">
            <!-- HERO SECTION EXACT MATCH TO PRINT & HOM.RACHI.AO -->
            <section id="home" class="hero-home">
                <!-- Ambient Pulsing Glow behind Hero -->
                <div class="hero-ambient-orb" aria-hidden="true"></div>

                <div class="container hero-home-container">
                    <div class="hero-content text-center">
                        <!-- Main Animated Hero Title -->
                        <h1 class="hero-title reveal">
                            <span class="hero-title-line">
                                UM <span class="hero-highlight hero-highlight--gold">ECOSSISTEMA</span> DE
                            </span>
                            <span class="hero-title-line">
                                SOLUÇÕES <span class="hero-highlight hero-highlight--blue">INTELIGENTES</span>
                            </span>
                        </h1>

                        <!-- Enhanced Dynamic Subtitle with Floating Badges -->
                        <div class="hero-subtitle-box reveal delay-1">
                            <p class="hero-subtitle">
                                <span class="hero-subtitle-lead">para impulsionar</span>
                                <span class="hero-inline-badge hero-inline-badge--gold" title="Empresas & Negócios">
                                    <svg class="hero-inline-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <span>negócios</span>
                                </span>
                                <span class="hero-subtitle-conjunction">&amp;</span>
                                <span class="hero-inline-badge hero-inline-badge--blue" title="Líderes & Pessoas">
                                    <svg class="hero-inline-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="2.2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>pessoas</span>
                                </span>
                            </p>
                        </div>

                        <div class="hero-actions reveal delay-2">
                            <a class="btn hero-ecosystem-cta" href="#solucoes"
                                @click.prevent="scrollToSection('solucoes')">
                                <span>CONHEÇA O ECOSSISTEMA</span>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="hero-visual-wrap reveal delay-2">
                        <!-- Imagem Hero para Modo Claro -->
                        <picture class="hero-visual-light">
                            <source srcset="/images/hero-ecosystem-transparent.png" type="image/png">
                            <img class="hero-visual hero-visual-light"
                                src="/images/hero-ecosystem-transparent.png"
                                alt="Profissionais RACHI junto ao símbolo da marca" width="1600" height="975"
                                fetchpriority="high" decoding="async">
                        </picture>

                        <!-- Imagem Hero para Modo Escuro -->
                        <picture class="hero-visual-dark">
                            <source srcset="/images/hero-ecosystem-transparent.png" type="image/png">
                            <img class="hero-visual hero-visual-dark"
                                src="/images/hero-ecosystem-transparent.png"
                                alt="Profissionais RACHI junto ao símbolo da marca" width="1600" height="975"
                                fetchpriority="high" decoding="async">
                        </picture>

                        <a class="hero-video-link" href="#sobre" @click.prevent="scrollToSection('sobre'); mobileMenuOpen = false"
                            aria-label="Conheça a RACHI">
                            <span class="hero-video-play" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                    <path d="m9 7 8 5-8 5V7Z" fill="currentColor" />
                                </svg>
                            </span>
                            <span>Conheça a RACHI</span>
                        </a>
                    </div>

                    <div class="hero-pillars" aria-label="Missão, visão e valores">
                        <article class="hero-pillar theme-blue reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <circle cx="12" cy="12" r="6" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">01</span>
                                <h2>MISSÃO</h2>
                                <p>Gerar valor com soluções inteligentes e inovadoras.</p>
                                <div class="hero-pillar-accent-bar" aria-hidden="true"></div>
                            </div>
                        </article>
                        <article class="hero-pillar theme-gold reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">02</span>
                                <h2>VISÃO</h2>
                                <p>Ser referência em soluções que transformam o futuro.</p>
                                <div class="hero-pillar-accent-bar" aria-hidden="true"></div>
                            </div>
                        </article>
                        <article class="hero-pillar theme-green reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">03</span>
                                <h2>VALORES</h2>
                                <p>Integridade, inovação e compromisso com resultados sustentáveis.</p>
                                <div class="hero-pillar-accent-bar" aria-hidden="true"></div>
                            </div>
                        </article>
                    </div>

                    <div class="hero-identity-action reveal delay-2">
                        <button class="hero-identity-link" type="button" @click="openIdentityModal()"
                            aria-haspopup="dialog">
                            <span>VER MISSÃO, VISÃO E VALORES</span>
                            <span aria-hidden="true">&rarr;</span>
                        </button>
                    </div>
                </div>
            </section>


            <!-- ========================================================= -->
            <!-- SECTION: SOBRE NÓS (QUEM SOMOS)                          -->
            <!-- ========================================================= -->
            <section id="sobre" class="py-20 bg-white border-t border-slate-100" aria-labelledby="about-title">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <div class="lg:col-span-6">
                            <span
                                class="text-xs font-extrabold uppercase tracking-widest text-[#00a3e0] bg-blue-50 px-3 py-1 rounded-full">
                                Sobre a RACHI
                            </span>
                            <h2 id="about-title"
                                class="text-4xl md:text-5xl font-[850] text-[#071326] mt-4 tracking-tight uppercase leading-none">
                                Quem <span class="text-[#eba72d]">Somos</span>
                            </h2>
                            <div
                                class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] via-[#00a3e0] to-[#eba72d] rounded-full my-6">
                            </div>
                            <p class="text-xl font-medium text-slate-700 leading-relaxed mb-6">
                                Soluções inteligentes para negócios mais fortes e sustentáveis.
                            </p>
                            <p class="text-slate-600 leading-relaxed mb-4">
                                A RACHI actua como parceira estratégica para empresas que precisam de soluções práticas,
                                integradas e confiáveis. Reunimos competências essenciais nas áreas de tecnologia,
                                comunicação visual, capacitação e recursos humanos para responder com agilidade aos
                                desafios do mercado angolano.
                            </p>
                            <div class="pt-4 flex flex-wrap gap-4">
                                <button @click="openIdentityModal()"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-[#071326] hover:bg-[#0d1f3d] text-white font-semibold text-sm transition">
                                    <i data-lucide="compass" class="w-4 h-4 text-amber-400"></i>
                                    <span>Missão, visão e valores</span>
                                    <span aria-hidden="true">&rarr;</span>
                                </button>
                                <a href="/contacto"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-slate-300 hover:border-slate-800 text-slate-700 font-semibold text-sm transition">
                                    <span>Fale com a equipa</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-6 relative">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl dark:shadow-2xl border border-slate-200/90 dark:border-slate-800 bg-white dark:bg-[#071326] transition-colors duration-300">
                                <img src="/images/about-team-clean.png"
                                    onerror="this.onerror=null; this.src='/images/about-team-clean.png'"
                                    alt="Equipa RACHI — pessoas, processos e tecnologia"
                                    class="w-full h-auto object-cover dark:hidden">
                                <img src="/images/about-team-dark.jpg"
                                    onerror="this.onerror=null; this.src='/images/about-team-clean.png'"
                                    alt="Equipa RACHI — pessoas, processos e tecnologia"
                                    class="w-full h-auto object-cover hidden dark:block">
                                <div
                                    class="absolute bottom-4 left-4 right-4 bg-white/95 dark:bg-slate-900/90 backdrop-blur-md text-slate-800 dark:text-white text-xs font-bold py-2.5 px-4 rounded-xl flex items-center justify-between border border-slate-200/90 dark:border-white/10 z-20 shadow-md transition-colors">
                                    <span class="tracking-wider uppercase text-amber-500 dark:text-amber-400 font-extrabold">Pessoas • Processos • Tecnologia</span>
                                    <span class="text-slate-500 dark:text-slate-300 font-medium">Luanda, Angola</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3 Cards: Negócio Integrado, Parceria B2B, Crescimento Sustentável -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
                        <div
                            class="p-8 rounded-2xl border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl hover:border-blue-400 transition-all duration-300 group">
                            <span class="text-2xl font-black text-blue-600 block mb-3">01</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition">
                                Negócio integrado</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Unimos tecnologia, produção gráfica, capacitação e recursos humanos para simplificar a
                                operação da sua empresa e acelerar resultados.
                            </p>
                        </div>
                        <div
                            class="p-8 rounded-2xl border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl hover:border-amber-400 transition-all duration-300 group">
                            <span class="text-2xl font-black text-amber-500 block mb-3">02</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-amber-500 transition">
                                Parceria B2B</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Trabalhamos lado a lado com equipas e lideranças, criando soluções ajustadas a cada
                                desafio e momento de maturidade do negócio.
                            </p>
                        </div>
                        <div
                            class="p-8 rounded-2xl border border-slate-200 bg-slate-50 hover:bg-white hover:shadow-xl hover:border-emerald-400 transition-all duration-300 group">
                            <span class="text-2xl font-black text-emerald-600 block mb-3">03</span>
                            <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-emerald-600 transition">
                                Crescimento sustentável</h3>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Focamos em eficiência, rigor e inovação para apoiar o desenvolvimento contínuo, seguro e
                                rentável da sua organização.
                            </p>
                        </div>
                    </div>

                    <!-- Stats Bar -->
                    <div
                        class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-4 mt-12 py-6 sm:py-8 px-4 sm:px-6 bg-[#071326] text-white rounded-2xl shadow-xl text-center divide-y sm:divide-y-0 sm:divide-x divide-slate-700/80">
                        <div class="pb-4 sm:pb-0">
                            <div class="text-3xl md:text-5xl font-black text-amber-400">04</div>
                            <div class="text-xs md:text-sm text-slate-300 font-medium mt-1 uppercase tracking-wider">
                                Áreas de actuação</div>
                        </div>
                        <div class="pt-4 sm:pt-0">
                            <div class="text-3xl md:text-5xl font-black text-cyan-400">100%</div>
                            <div class="text-xs md:text-sm text-slate-300 font-medium mt-1 uppercase tracking-wider">
                                Foco em resultados</div>
                        </div>
                        <div class="pt-4 sm:pt-0">
                            <div class="text-3xl md:text-5xl font-black text-emerald-400">360º</div>
                            <div class="text-xs md:text-sm text-slate-300 font-medium mt-1 uppercase tracking-wider">
                                Soluções integradas</div>
                        </div>
                    </div>

                    <!-- Porquê Existimos: 4 Pilares -->
                    <div class="mt-20 pt-16 border-t border-slate-200">
                        <div class="max-w-3xl mb-12">
                            <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Porquê
                                Existimos</span>
                            <h3 class="text-2xl md:text-3xl font-[850] text-[#071326] mt-2">
                                Ajudamos empresas angolanas a crescer com estrutura, tecnologia e conhecimento.
                            </h3>
                            <p class="text-slate-600 mt-4 leading-relaxed">
                                A RACHI existe para ajudar empresas e empreendedores a superar desafios de gestão,
                                formalização e transformação digital. Oferecemos soluções práticas que fortalecem a
                                estrutura organizacional e impulsionam o crescimento sustentável dos negócios.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Pilar 1 -->
                            <div
                                class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition">
                                <div
                                    class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold mb-4">
                                    <i data-lucide="building-2" class="w-6 h-6"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">01</span>
                                <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Formalização</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Apoiamos a organização e estruturação de empresas para um crescimento seguro e em
                                    conformidade legal.
                                </p>
                            </div>

                            <!-- Pilar 2 -->
                            <div
                                class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition">
                                <div
                                    class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold mb-4">
                                    <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">02</span>
                                <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Capacitação</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Desenvolvemos competências de profissionais, líderes e equipas com metodologia
                                    prática e aplicável.
                                </p>
                            </div>

                            <!-- Pilar 3 -->
                            <div
                                class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition">
                                <div
                                    class="w-12 h-12 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center font-bold mb-4">
                                    <i data-lucide="laptop" class="w-6 h-6"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">03</span>
                                <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Tecnologia</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Digitalizamos processos e implementamos soluções de software e TI que aumentam a
                                    produtividade.
                                </p>
                            </div>

                            <!-- Pilar 4 -->
                            <div
                                class="p-6 rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-lg transition">
                                <div
                                    class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold mb-4">
                                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                                </div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">04</span>
                                <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Crescimento</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Criamos estratégias e materiais institucionais orientados para a evolução contínua
                                    da marca.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: O QUE FAZEMOS                                   -->
            <!-- ========================================================= -->
            <section id="o-que-fazemos" class="py-20 bg-slate-50 border-t border-slate-200"
                aria-labelledby="what-we-do-title">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <div class="lg:col-span-6">
                            <span
                                class="text-xs font-extrabold uppercase tracking-widest text-[#00a3e0] bg-blue-100/60 px-3 py-1 rounded-full">
                                Capacidades da RACHI
                            </span>
                            <h2 id="what-we-do-title"
                                class="text-4xl md:text-5xl font-[850] text-[#071326] mt-4 tracking-tight uppercase leading-none">
                                O que <span class="text-[#f5a800]">fazemos</span>
                            </h2>
                            <div
                                class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] via-[#00a3e0] to-[#f5a800] rounded-full my-6">
                            </div>
                            <p class="text-xl font-medium text-slate-700 leading-relaxed mb-6">
                                Soluções inteligentes para transformar e impulsionar o seu negócio.
                            </p>

                            <div class="bg-white p-6 rounded-2xl border-l-4 border-amber-500 shadow-sm mb-6">
                                <p class="text-base font-bold text-slate-900">
                                    "Mais do que serviços, entregamos soluções que geram resultados."
                                </p>
                            </div>

                            <div class="space-y-4 text-slate-600 leading-relaxed text-sm">
                                <p>
                                    A <strong>RACHI – Soluções Inteligentes</strong> desenvolve serviços pensados para
                                    criar, estruturar, modernizar e fortalecer empresas em Angola.
                                </p>
                                <p>
                                    A nossa lógica de actuação é simples: reduzir dificuldades, acelerar decisões e
                                    oferecer uma experiência empresarial integrada, acompanhando o cliente desde a
                                    legalização do negócio até à organização administrativa, capacitação das equipas,
                                    digitalização dos processos e comunicação visual da marca.
                                </p>
                                <p>
                                    Reunimos, num só ecossistema, soluções de formalização empresarial, recursos
                                    humanos, formação profissional, tecnologia e produção gráfica.
                                </p>
                            </div>
                        </div>

                        <div class="lg:col-span-6">
                            <div class="rounded-2xl overflow-hidden shadow-2xl border border-slate-200 dark:border-slate-800">
                                <img src="/images/what-we-do-team-clean.png"
                                    onerror="this.onerror=null; this.src='/images/what-we-do-team-clean.png'"
                                    alt="Profissionais RACHI a desenvolver soluções integradas"
                                    class="w-full h-auto object-cover dark:hidden">
                                <img src="/images/what-we-do-team-dark.jpg"
                                    onerror="this.onerror=null; this.src='/images/what-we-do-team-clean.png'"
                                    alt="Profissionais RACHI a desenvolver soluções integradas"
                                    class="w-full h-auto object-cover hidden dark:block">
                            </div>
                        </div>
                    </div>

                    <!-- Ecosystem Infographic Diagram -->
                    <!-- ECOSYSTEM INFOGRAPHIC DIAGRAM (100% VETORIAL, NÍTIDO EM RETINA/4K) -->
                    <div
                        class="mt-16 bg-white p-6 sm:p-10 md:p-12 rounded-3xl border border-slate-200/80 shadow-2xl relative overflow-hidden">
                        <!-- Subtle background illumination -->
                        <div
                            class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl pointer-events-none">
                        </div>
                        <div
                            class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none">
                        </div>

                        <div class="text-center mb-10 relative z-10">
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-50 px-3.5 py-1 rounded-full border border-blue-100">
                                Visão Integrada
                            </span>
                            <h3 class="text-2xl md:text-3xl font-[850] text-[#071326] mt-2 uppercase tracking-tight">
                                O nosso ecossistema de soluções
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto mt-2">
                                Uma estrutura conectada e sinérgica pensada para atender todas as fases de crescimento
                                do seu negócio.
                            </p>
                        </div>

                        <!-- DIAGRAM CONTENT (DESKTOP TREE & RESPONSIVE GRID) -->
                        <div class="relative max-w-5xl mx-auto z-10">

                            <!-- DESKTOP CONNECTOR SVG OVERLAY (Hidden on mobile) -->
                            <div class="hidden lg:block absolute inset-0 pointer-events-none z-0">
                                <svg class="w-full h-full" viewBox="0 0 1000 460" fill="none"
                                    preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="lineGradLeft1" x1="360" y1="75" x2="460" y2="200"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#2563eb" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3" />
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft2" x1="360" y1="230" x2="450" y2="230"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f59e0b" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#f59e0b" stop-opacity="0.3" />
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft3" x1="360" y1="385" x2="460" y2="260"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#10b981" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3" />
                                        </linearGradient>
                                        <linearGradient id="lineGradRight1" x1="640" y1="75" x2="540" y2="200"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06b6d4" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3" />
                                        </linearGradient>
                                        <linearGradient id="lineGradRight2" x1="640" y1="230" x2="550" y2="230"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#9333ea" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#9333ea" stop-opacity="0.3" />
                                        </linearGradient>
                                        <linearGradient id="lineGradRight3" x1="640" y1="385" x2="540" y2="260"
                                            gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f97316" stop-opacity="0.7" />
                                            <stop offset="1" stop-color="#eba72d" stop-opacity="0.3" />
                                        </linearGradient>
                                    </defs>

                                    <!-- Left Lines -->
                                    <!-- Top Left to Center -->
                                    <path d="M 360 75 C 430 75, 430 195, 465 205" stroke="url(#lineGradLeft1)"
                                        stroke-width="2.5" stroke-linecap="round" />
                                    <circle cx="430" cy="135" r="4.5" fill="#2563eb" stroke="#ffffff"
                                        stroke-width="2" />

                                    <!-- Middle Left to Center -->
                                    <path d="M 360 230 L 450 230" stroke="url(#lineGradLeft2)" stroke-width="2.5"
                                        stroke-linecap="round" />
                                    <circle cx="405" cy="230" r="4.5" fill="#f59e0b" stroke="#ffffff"
                                        stroke-width="2" />

                                    <!-- Bottom Left to Center -->
                                    <path d="M 360 385 C 430 385, 430 265, 465 255" stroke="url(#lineGradLeft3)"
                                        stroke-width="2.5" stroke-linecap="round" />
                                    <circle cx="430" cy="325" r="4.5" fill="#10b981" stroke="#ffffff"
                                        stroke-width="2" />

                                    <!-- Right Lines -->
                                    <!-- Top Right to Center -->
                                    <path d="M 640 75 C 570 75, 570 195, 535 205" stroke="url(#lineGradRight1)"
                                        stroke-width="2.5" stroke-linecap="round" />
                                    <circle cx="570" cy="135" r="4.5" fill="#06b6d4" stroke="#ffffff"
                                        stroke-width="2" />

                                    <!-- Middle Right to Center -->
                                    <path d="M 640 230 L 550 230" stroke="url(#lineGradRight2)" stroke-width="2.5"
                                        stroke-linecap="round" />
                                    <circle cx="595" cy="230" r="4.5" fill="#9333ea" stroke="#ffffff"
                                        stroke-width="2" />

                                    <!-- Bottom Right to Center -->
                                    <path d="M 640 385 C 570 385, 570 265, 535 255" stroke="url(#lineGradRight3)"
                                        stroke-width="2.5" stroke-linecap="round" />
                                    <circle cx="570" cy="325" r="4.5" fill="#f97316" stroke="#ffffff"
                                        stroke-width="2" />
                                </svg>
                            </div>

                            <!-- 3-Column Content Grid -->
                            <div class="grid grid-cols-1 lg:grid-cols-11 gap-6 lg:gap-8 items-center relative z-10">

                                <!-- LEFT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 01: Formalização Empresarial -->
                                    <div
                                        class="group bg-white hover:bg-blue-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="file-check-2" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-blue-600 uppercase tracking-wide">
                                                Formalização Empresarial
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Legalização, constituição e regularização do negócio.
                                            </p>
                                        </div>
                                        <span
                                            class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-blue-600 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 02: Recursos Humanos -->
                                    <div
                                        class="group bg-white hover:bg-amber-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-amber-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="users" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-amber-500 uppercase tracking-wide">
                                                Recursos Humanos
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Gestão de pessoas, recrutamento e desenvolvimento.
                                            </p>
                                        </div>
                                        <span
                                            class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 03: Formação Profissional -->
                                    <div
                                        class="group bg-white hover:bg-emerald-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-emerald-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div
                                            class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-emerald-600 uppercase tracking-wide">
                                                Formação Profissional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Capacitação prática para equipas mais produtivas.
                                            </p>
                                        </div>
                                        <span
                                            class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-emerald-600 border-2 border-white shadow"></span>
                                    </div>
                                </div>

                                <!-- CENTER HUB: RACHI CENTRAL NODE -->
                                <div class="lg:col-span-3 flex flex-col items-center justify-center py-4 lg:py-0">
                                    <div class="relative group">
                                        <!-- Animated Ambient Glow -->
                                        <div
                                            class="absolute -inset-2 rounded-full bg-gradient-to-r from-blue-500 via-amber-400 to-cyan-400 opacity-30 group-hover:opacity-60 blur-md transition duration-500">
                                        </div>

                                        <!-- Central Node Badge -->
                                        <div
                                            class="relative w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-[#071326] border-4 border-white shadow-2xl flex flex-col items-center justify-center text-center p-3 transition-transform duration-300 group-hover:scale-105">

                                            <!-- Brand Graphic Emblem -->
                                            <div class="w-10 h-10 sm:w-12 sm:h-12 mb-1 flex items-center justify-center">
                                                <img src="/images/rachi-symbol-official.png" alt="RACHI" class="w-9 h-9 sm:w-11 sm:h-11 object-contain drop-shadow">
                                            </div>

                                            <span
                                                class="text-white font-[900] text-sm sm:text-base tracking-wider uppercase leading-tight">
                                                RACHI
                                            </span>
                                            <span
                                                class="text-[8px] sm:text-[9px] font-bold text-amber-400 tracking-[0.15em] uppercase mt-0.5 leading-none">
                                                SOLUÇÕES INTELIGENTES
                                            </span>

                                            <!-- Connector Points around Circle -->
                                            <span
                                                class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-[#00a3e0] border-2 border-white shadow"></span>
                                            <span
                                                class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white shadow"></span>
                                            <span
                                                class="absolute -left-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                            <span
                                                class="absolute -right-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-cyan-400 border-2 border-white shadow"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 04: Tecnologia e Digitalização -->
                                    <div
                                        class="group bg-white hover:bg-cyan-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-cyan-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span
                                            class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-cyan-500 border-2 border-white shadow"></span>
                                        <div
                                            class="w-12 h-12 rounded-xl bg-cyan-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-cyan-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="monitor" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-cyan-600 uppercase tracking-wide">
                                                Tecnologia e Digitalização
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Soluções tecnológicas para automatizar e escalar.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 05: Comunicação Institucional -->
                                    <div
                                        class="group bg-white hover:bg-purple-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-purple-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span
                                            class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-purple-600 border-2 border-white shadow"></span>
                                        <div
                                            class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-purple-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="megaphone" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-purple-600 uppercase tracking-wide">
                                                Comunicação Institucional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Identidade visual, marketing e presença no mercado.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 06: Produção Gráfica -->
                                    <div
                                        class="group bg-white hover:bg-orange-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-orange-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span
                                            class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-orange-500 border-2 border-white shadow"></span>
                                        <div
                                            class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="printer" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4
                                                class="text-xs sm:text-sm font-extrabold text-orange-500 uppercase tracking-wide">
                                                Produção Gráfica
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Materiais gráficos de qualidade que fortalecem a marca.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Bottom Badges / Trust Points -->
                        <div
                            class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-xs font-semibold text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                <span>Soluções 100% Integradas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span>Parceiro Estratégico B2B</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span>Rigor, Inovação e Conformidade</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: PARCEIROS ESTRATÉGICOS (SPLIT BENTO ARCHITECTURE) -->
            
                        <!-- ========================================================= -->
            <!-- SECTION: O NOSSO DIFERENCIAL                              -->
            <!-- ========================================================= -->
            <section id="diferencial" class="diff-section py-20 transition-colors duration-300" aria-labelledby="diferencial-title">
                <style>
                    /* Base Light Mode — O Nosso Diferencial */
                    #diferencial.diff-section {
                        background-color: #ffffff !important;
                        border-top: 1px solid #e2e8f0 !important;
                        color: #071326;
                    }
                    html.dark #diferencial.diff-section {
                        background-color: #071326 !important;
                        border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
                        color: #e2e8f0 !important;
                    }

                    #diferencial .diff-hero-flex {
                        display: flex;
                        flex-direction: column;
                        gap: 2.5rem;
                        align-items: center;
                    }
                    @media (min-width: 1024px) {
                        #diferencial .diff-hero-flex {
                            flex-direction: row;
                            justify-content: space-between;
                            align-items: center;
                            gap: 3rem;
                        }
                        #diferencial .diff-hero-text {
                            flex: 1 1 0%;
                            min-width: 0;
                        }
                        #diferencial .diff-hero-image {
                            width: 50%;
                            max-width: 580px;
                            flex-shrink: 0;
                            display: flex;
                            justify-content: flex-end;
                        }
                    }

                    /* Typography & Dual Brand Bars */
                    #diferencial .diff-main-title {
                        font-family: 'Montserrat', sans-serif;
                        line-height: 1.08;
                        color: #071326;
                    }
                    html.dark #diferencial .diff-main-title {
                        color: #ffffff !important;
                    }
                    #diferencial .diff-title-accent {
                        color: #eba72d;
                    }
                    html.dark #diferencial .diff-title-accent {
                        color: #fbbf24 !important;
                    }
                    #diferencial .diff-pill-blue {
                        background-color: #0050f0 !important;
                    }
                    html.dark #diferencial .diff-pill-blue {
                        background-color: #00a3e0 !important;
                        box-shadow: 0 0 12px rgba(0, 163, 224, 0.45);
                    }
                    #diferencial .diff-pill-gold {
                        background-color: #eba72d !important;
                    }
                    html.dark #diferencial .diff-pill-gold {
                        background-color: #fbbf24 !important;
                        box-shadow: 0 0 12px rgba(251, 191, 36, 0.4);
                    }
                    #diferencial .diff-hero-sub {
                        color: #334155;
                    }
                    html.dark #diferencial .diff-hero-sub {
                        color: #e2e8f0 !important;
                    }

                    /* Dual-Theme Studio Visual Card */
                    #diferencial .diff-visual-wrap {
                        width: 100%;
                        max-width: 36rem;
                    }
                    #diferencial .diff-visual-card {
                        background-color: #ffffff !important;
                        border: 1px solid rgba(226, 232, 240, 0.95) !important;
                        box-shadow: 0 20px 45px -12px rgba(7, 19, 38, 0.10), 0 4px 14px -2px rgba(7, 19, 38, 0.04) !important;
                        border-radius: 1rem;
                        overflow: hidden;
                        transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
                    }
                    html.dark #diferencial .diff-visual-card {
                        background-color: #071326 !important;
                        border: 1px solid rgba(255, 255, 255, 0.10) !important;
                        box-shadow: 0 24px 55px -12px rgba(0, 0, 0, 0.72), 0 0 32px rgba(0, 80, 240, 0.12) !important;
                    }
                    #diferencial .diff-img-light {
                        display: block !important;
                        width: 100%;
                        height: auto;
                    }
                    #diferencial .diff-img-dark {
                        display: none !important;
                        width: 100%;
                        height: auto;
                    }
                    html.dark #diferencial .diff-img-light {
                        display: none !important;
                    }
                    html.dark #diferencial .diff-img-dark {
                        display: block !important;
                    }

                    /* Middle Content: Foco no que realmente importa */
                    #diferencial .diff-content-grid {
                        display: flex;
                        flex-direction: column;
                        gap: 2rem;
                        align-items: flex-start;
                        width: 100%;
                        border-top: 1px solid #f1f5f9;
                    }
                    html.dark #diferencial .diff-content-grid {
                        border-top-color: rgba(255, 255, 255, 0.08) !important;
                    }
                    @media (min-width: 768px) {
                        #diferencial .diff-content-grid {
                            flex-direction: row;
                            align-items: flex-start;
                            gap: 3.5rem;
                        }
                        #diferencial .diff-tagline-col {
                            width: 240px;
                            flex-shrink: 0;
                        }
                        #diferencial .diff-text-col {
                            flex: 1 1 0%;
                            min-width: 0;
                            width: 100%;
                        }
                    }
                    #diferencial .diff-target-badge {
                        background-color: #eff6ff;
                        border: 1px solid #bfdbfe;
                        color: #0284c7;
                        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.08);
                    }
                    html.dark #diferencial .diff-target-badge {
                        background-color: rgba(0, 163, 224, 0.14) !important;
                        border-color: rgba(56, 189, 248, 0.35) !important;
                        color: #38bdf8 !important;
                        box-shadow: 0 0 18px rgba(0, 163, 224, 0.18) !important;
                    }
                    #diferencial .diff-tagline-title {
                        color: #0f172a;
                    }
                    html.dark #diferencial .diff-tagline-title {
                        color: #ffffff !important;
                    }
                    #diferencial .diff-text-col p {
                        color: #475569;
                    }
                    html.dark #diferencial .diff-text-col p {
                        color: #cbd5e1 !important;
                    }
                    #diferencial .diff-text-col strong {
                        color: #0f172a;
                    }
                    html.dark #diferencial .diff-text-col strong {
                        color: #ffffff !important;
                    }

                    /* Bottom Highlight Box: O QUE NOS TORNA DIFERENTES */
                    #diferencial .diff-pillars-box {
                        margin-top: 4rem;
                        background-color: #f8fafc !important;
                        border: 1px solid #e2e8f0 !important;
                        border-radius: 1.5rem;
                        padding: 2rem;
                        box-shadow: 0 12px 32px -8px rgba(15, 23, 42, 0.05);
                        transition: all 0.3s ease;
                    }
                    @media (min-width: 640px) {
                        #diferencial .diff-pillars-box {
                            margin-top: 5rem;
                            padding: 3rem;
                        }
                    }
                    html.dark #diferencial .diff-pillars-box {
                        background: linear-gradient(145deg, rgba(12, 26, 51, 0.92) 0%, rgba(8, 19, 38, 0.96) 100%) !important;
                        border: 1px solid rgba(255, 255, 255, 0.09) !important;
                        box-shadow: 0 20px 45px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
                    }
                    #diferencial .diff-pillars-heading {
                        color: #0f172a;
                    }
                    html.dark #diferencial .diff-pillars-heading {
                        color: #ffffff !important;
                    }

                    #diferencial .diff-cards-grid {
                        display: grid;
                        grid-template-columns: repeat(1, minmax(0, 1fr));
                        gap: 1.5rem;
                        width: 100%;
                    }
                    @media (min-width: 640px) {
                        #diferencial .diff-cards-grid {
                            grid-template-columns: repeat(2, minmax(0, 1fr));
                        }
                    }
                    @media (min-width: 1024px) {
                        #diferencial .diff-cards-grid {
                            grid-template-columns: repeat(5, minmax(0, 1fr));
                            gap: 1.25rem;
                        }
                    }

                    #diferencial .diff-pillar-item {
                        border-radius: 1rem;
                        padding: 1rem;
                        border: 1px solid transparent;
                        transition: background-color 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
                    }
                    #diferencial .diff-pillar-item:hover {
                        background-color: #ffffff !important;
                        border-color: #e2e8f0 !important;
                        box-shadow: 0 10px 24px -6px rgba(15, 23, 42, 0.07);
                        transform: translateY(-2px);
                    }
                    html.dark #diferencial .diff-pillar-item:hover {
                        background-color: rgba(255, 255, 255, 0.04) !important;
                        border-color: rgba(255, 255, 255, 0.10) !important;
                        box-shadow: 0 12px 28px -6px rgba(0, 0, 0, 0.45);
                    }
                    #diferencial .diff-pillar-title {
                        color: #0f172a;
                    }
                    html.dark #diferencial .diff-pillar-title {
                        color: #ffffff !important;
                    }
                    #diferencial .diff-pillar-desc {
                        color: #475569;
                    }
                    html.dark #diferencial .diff-pillar-desc {
                        color: #94a3b8 !important;
                    }

                    /* 5 Colored Pillar Icon Badges (Light & Dark) */
                    #diferencial .diff-icon-blue {
                        background-color: #eff6ff;
                        border: 1px solid #bfdbfe;
                        color: #0050f0;
                    }
                    html.dark #diferencial .diff-icon-blue {
                        background-color: rgba(37, 99, 235, 0.16) !important;
                        border-color: rgba(96, 165, 250, 0.35) !important;
                        color: #60a5fa !important;
                    }
                    #diferencial .diff-icon-amber {
                        background-color: #fffbeb;
                        border: 1px solid #fde68a;
                        color: #d97706;
                    }
                    html.dark #diferencial .diff-icon-amber {
                        background-color: rgba(245, 158, 11, 0.16) !important;
                        border-color: rgba(251, 191, 36, 0.35) !important;
                        color: #fbbf24 !important;
                    }
                    #diferencial .diff-icon-emerald {
                        background-color: #ecfdf5;
                        border: 1px solid #a7f3d0;
                        color: #059669;
                    }
                    html.dark #diferencial .diff-icon-emerald {
                        background-color: rgba(16, 185, 129, 0.16) !important;
                        border-color: rgba(52, 211, 153, 0.35) !important;
                        color: #34d399 !important;
                    }
                    #diferencial .diff-icon-purple {
                        background-color: #faf5ff;
                        border: 1px solid #e9d5ff;
                        color: #7c3aed;
                    }
                    html.dark #diferencial .diff-icon-purple {
                        background-color: rgba(168, 85, 247, 0.16) !important;
                        border-color: rgba(192, 132, 252, 0.35) !important;
                        color: #c084fc !important;
                    }
                    #diferencial .diff-icon-cyan {
                        background-color: #ecfeff;
                        border: 1px solid #a5f3fc;
                        color: #0891b2;
                    }
                    html.dark #diferencial .diff-icon-cyan {
                        background-color: rgba(6, 182, 212, 0.16) !important;
                        border-color: rgba(34, 211, 238, 0.35) !important;
                        color: #22d3ee !important;
                    }
                </style>

                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    
                    <!-- Top Flex: Hero with Title & Corporate Team Visual -->
                    <div class="diff-hero-flex mb-16">
                        
                        <!-- Left: Title, Decorative Pill Bar, Subtitle -->
                        <div class="diff-hero-text w-full">
                            <h2 id="diferencial-title" class="diff-main-title text-4xl sm:text-5xl lg:text-6xl font-[850] uppercase tracking-tight">
                                O NOSSO<br>
                                <span class="diff-title-accent">DIFERENCIAL</span>
                            </h2>
                            
                            <!-- Decorative dual-color bar (Blue & Yellow) -->
                            <div class="flex items-center gap-1.5 mt-5 mb-6">
                                <span class="diff-pill-blue w-10 h-1.5 rounded-full"></span>
                                <span class="diff-pill-gold w-10 h-1.5 rounded-full"></span>
                            </div>

                            <!-- Subtitle -->
                            <div class="space-y-1">
                                <p class="diff-hero-sub text-xl sm:text-2xl font-semibold">
                                    Integramos soluções.
                                </p>
                                <p class="diff-hero-sub text-xl sm:text-2xl font-semibold">
                                    Transformamos negócios.
                                </p>
                            </div>
                        </div>

                        <!-- Right: Corporate Team Image Visual (Dual-Theme: Light & Dark) -->
                        <div class="diff-hero-image w-full">
                            <div class="diff-visual-wrap relative">
                                <div class="diff-visual-card relative">
                                    <img src="/images/differential-team-clean.png?v=8"
                                         onerror="this.onerror=null; this.src='/images/differential-team.jpg'"
                                         alt="O Nosso Diferencial — Equipa RACHI"
                                         class="diff-img-light object-cover select-none">
                                    <img src="/images/differential-team-dark.jpg?v=8"
                                         onerror="this.onerror=null; this.src='/images/differential-team-clean.png'"
                                         alt="O Nosso Diferencial — Equipa RACHI"
                                         class="diff-img-dark object-cover select-none">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Middle Content: Foco no que realmente importa + 3 Parágrafos -->
                    <div class="diff-content-grid pt-8">
                        
                        <!-- Left: Circular Icon Badge + Tagline -->
                        <div class="diff-tagline-col pt-2">
                            <div class="diff-target-badge w-14 h-14 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                            </div>
                            <p class="diff-tagline-title font-extrabold text-base sm:text-lg leading-snug">
                                Foco no que<br>realmente importa
                            </p>
                        </div>

                        <!-- Right: 3 Text Paragraphs with Bold Emphasis -->
                        <div class="diff-text-col space-y-6 text-base sm:text-lg leading-relaxed">
                            <p>
                                O diferencial da RACHI está na capacidade de <strong class="font-bold">integrar</strong>, num só ecossistema, <strong class="font-bold">soluções essenciais</strong> para a estruturação, modernização e crescimento das empresas.
                            </p>
                            <p>
                                Não actuamos apenas sobre <strong class="font-bold">problemas isolados</strong>. Analisamos a realidade de cada negócio, identificamos os seus principais desafios e desenvolvemos <strong class="font-bold">soluções ajustadas</strong> às suas necessidades, combinando formalização empresarial, gestão, recursos humanos, formação, tecnologia e comunicação institucional.
                            </p>
                            <p>
                                A RACHI diferencia-se também, pela <strong class="font-bold">abordagem prática, integrada e orientada para resultados</strong>, oferecendo aos seus clientes uma resposta completa para transformar ideias em negócios estruturados e empresas tradicionais em organizações mais <strong class="font-bold">modernas, competitivas e sustentáveis</strong>.
                            </p>
                        </div>

                    </div>

                    <!-- Highlight Card: O QUE NOS TORNA DIFERENTES -->
                    <div class="diff-pillars-box">
                        
                        <!-- Card Header -->
                        <div class="text-center max-w-xl mx-auto mb-12">
                            <h3 class="diff-pillars-heading text-xl sm:text-2xl font-[850] uppercase tracking-wider">
                                O QUE NOS TORNA DIFERENTES
                            </h3>
                            <div class="flex items-center justify-center gap-1.5 mt-2.5">
                                <span class="diff-pill-blue w-6 h-1 rounded-full"></span>
                                <span class="diff-pill-gold w-6 h-1 rounded-full"></span>
                            </div>
                        </div>

                        <!-- 5 Columns Grid -->
                        <div class="diff-cards-grid">
                            
                            <!-- 1. INTEGRAÇÃO -->
                            <div class="diff-pillar-item flex flex-col items-center text-center group">
                                <div class="diff-icon-blue w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                    <i data-lucide="puzzle" class="w-6 h-6"></i>
                                </div>
                                <h4 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                    INTEGRAÇÃO
                                </h4>
                                <p class="diff-pillar-desc text-xs leading-relaxed">
                                    Todas as soluções que o seu negócio precisa, num só ecossistema.
                                </p>
                            </div>

                            <!-- 2. ABORDAGEM PRÁTICA -->
                            <div class="diff-pillar-item flex flex-col items-center text-center group">
                                <div class="diff-icon-amber w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                    <i data-lucide="user" class="w-6 h-6"></i>
                                </div>
                                <h4 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                    ABORDAGEM PRÁTICA
                                </h4>
                                <p class="diff-pillar-desc text-xs leading-relaxed">
                                    Soluções aplicáveis à realidade do seu negócio.
                                </p>
                            </div>

                            <!-- 3. ORIENTAÇÃO PARA RESULTADOS -->
                            <div class="diff-pillar-item flex flex-col items-center text-center group">
                                <div class="diff-icon-emerald w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                                </div>
                                <h4 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                    ORIENTAÇÃO PARA RESULTADOS
                                </h4>
                                <p class="diff-pillar-desc text-xs leading-relaxed">
                                    Foco em gerar valor, eficiência e crescimento sustentável.
                                </p>
                            </div>

                            <!-- 4. SOLUÇÕES AJUSTADAS -->
                            <div class="diff-pillar-item flex flex-col items-center text-center group">
                                <div class="diff-icon-purple w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                    <i data-lucide="user-check" class="w-6 h-6"></i>
                                </div>
                                <h4 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                    SOLUÇÕES AJUSTADAS
                                </h4>
                                <p class="diff-pillar-desc text-xs leading-relaxed">
                                    Analisamos o seu negócio e criamos soluções à medida.
                                </p>
                            </div>

                            <!-- 5. PARCEIRA DE CONFIANÇA -->
                            <div class="diff-pillar-item flex flex-col items-center text-center group">
                                <div class="diff-icon-cyan w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                                </div>
                                <h4 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                    PARCEIRA DE CONFIANÇA
                                </h4>
                                <p class="diff-pillar-desc text-xs leading-relaxed">
                                    Compromisso com a transparência, ética e o sucesso dos nossos clientes.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </section>


<!-- ========================================================= -->
            <section id="parceiros" class="relative py-20 lg:py-28 bg-[#f8fafc] overflow-hidden border-t border-slate-200" aria-labelledby="partners-title">
                <!-- Ambient Backdrop Glows -->
                <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-400/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
                <div class="absolute bottom-0 left-10 w-80 h-80 bg-amber-400/5 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

                <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start">
                        
                        <!-- Left Column: Sticky Editorial Header (lg:col-span-5) -->
                        <div class="lg:col-span-5 lg:sticky lg:top-28">
                            <!-- Eyebrow Badge -->
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#00a3e0]/10 border border-[#00a3e0]/20 text-[#00a3e0] text-xs font-black uppercase tracking-wider mb-4 shadow-xs">
                                <span class="w-2 h-2 rounded-full bg-[#00a3e0] animate-pulse"></span>
                                <span>Parcerias Estratégicas</span>
                            </div>

                            <!-- Section Title -->
                            <h2 id="partners-title" class="text-3xl sm:text-4xl font-[900] text-[#071326] tracking-tight leading-[1.15] uppercase">
                                Marcas e instituições <br>
                                <span class="partners-title-gradient text-transparent bg-clip-text bg-gradient-to-r from-[#00a3e0] via-[#0b4ea8] to-[#071326]">
                                    que caminham connosco
                                </span>
                            </h2>

                            <!-- Subtitle -->
                            <p class="text-slate-600 text-sm sm:text-base leading-relaxed mt-4">
                                Colaboramos com organizações que partilham o compromisso de elevar empresas e profissionais em Angola, somando forças para criar soluções de alto impacto.
                            </p>

                            <!-- Metrics & Trust Box -->
                            <div class="mt-8 p-5 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-slate-950 font-black text-xl shadow-sm">
                                        06
                                    </div>
                                    <div>
                                        <div class="text-xs font-black text-[#071326] uppercase tracking-wider">Parceiros Oficiais</div>
                                        <div class="text-[11px] text-slate-500 font-medium">Alianças de alto valor corporativo</div>
                                    </div>
                                </div>
                                <span class="hidden sm:inline-flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-100">
                                    Ativos
                                </span>
                            </div>

                            <!-- CTA Block -->
                            <div class="mt-6 pt-6 border-t border-slate-200/70 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                                <a href="/contacto" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#071326] hover:bg-[#0b1c3d] text-white font-bold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition-all duration-200 group">
                                    <span>Seja Nosso Parceiro</span>
                                    <svg class="w-4 h-4 text-[#00a3e0] group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                                <span class="text-xs text-slate-400 font-medium sm:max-w-[140px] leading-tight">
                                    Cresça com o ecossistema RACHI
                                </span>
                            </div>
                        </div>

                        <!-- Right Column: Refined Logo Grid — Proporcional & Equilibrado (lg:col-span-7) -->
                        <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 items-stretch">
                            
                             <!-- CARD 1: INOV QUIMUA -->
                            <div class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-white/10 hover:border-blue-400/50 dark:hover:border-blue-500/40 shadow-xs hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-[#00a3e0] to-[#0b4ea8] opacity-80"></div>
                                <img src="/images/inov-quimua-tight.png"
                                     onerror="this.onerror=null; this.src='/images/inov-quimua-clean.png'"
                                     alt="INOV QUIMUA"
                                     class="h-12 sm:h-14 w-auto max-w-[82%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                                <img src="/images/inov-quimua-dark-tight.png"
                                     onerror="this.onerror=null; this.src='/images/inov-quimua-dark.png'"
                                     alt="INOV QUIMUA"
                                     class="h-12 sm:h-14 w-auto max-w-[82%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                            </div>

                            <!-- CARD 2: HELTON PLUS -->
                            <div class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-white/10 hover:border-amber-400/50 dark:hover:border-amber-500/40 shadow-xs hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-[#f5a800] to-amber-600 opacity-80"></div>
                                <img src="/images/helton-plus-tight.png"
                                     onerror="this.onerror=null; this.src='/images/helton-plus-clean.png'"
                                     alt="HELTON PLUS"
                                     class="h-20 sm:h-24 w-auto max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                                <img src="/images/helton-plus-dark.png"
                                     onerror="this.onerror=null; this.src='/images/helton-plus-clean.png'"
                                     alt="HELTON PLUS"
                                     class="h-20 sm:h-24 w-auto max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                            </div>

                            <!-- CARD 3: REPALANGA -->
                            <div class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-white/10 hover:border-cyan-400/50 dark:hover:border-cyan-500/40 shadow-xs hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-[#00a3e0] to-cyan-600 opacity-80"></div>
                                <img src="/images/repalanga-clean.png"
                                     onerror="this.onerror=null; this.src='/images/repalanga-tight.png'"
                                     alt="REPALANGA"
                                     class="h-11 sm:h-12 w-auto max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                                <img src="/images/repalanga-dark.png"
                                     onerror="this.onerror=null; this.src='/images/repalanga-clean.png'"
                                     alt="REPALANGA"
                                     class="h-11 sm:h-12 w-auto max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                            </div>

                            <!-- CARD 4: REDE DO REINO -->
                            <div class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-white/10 hover:border-green-400/50 dark:hover:border-green-500/40 shadow-xs hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-green-500 to-emerald-700 opacity-80"></div>
                                <img src="/images/rede-do-reino-clean.png"
                                     onerror="this.onerror=null; this.src='/images/rede-do-reino.png'"
                                     alt="REDE DO REINO"
                                     class="h-14 sm:h-16 w-auto max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                                <img src="/images/rede-do-reino-dark.png"
                                     onerror="this.onerror=null; this.src='/images/rede-do-reino-clean.png'"
                                     alt="REDE DO REINO"
                                     class="h-14 sm:h-16 w-auto max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                            </div>

                            <!-- CARD 5: KUMOSI PRESTAÇÃO DE SERVIÇOS -->
                            <div class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 dark:border-white/10 hover:border-amber-400/50 dark:hover:border-amber-500/40 shadow-xs hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-amber-500 via-emerald-500 to-[#0b4ea8] opacity-80"></div>
                                <img src="/images/kumosi-badge.png"
                                     alt="KUMOSI — Prestação de Serviços"
                                     class="h-20 sm:h-24 w-auto max-w-[85%] object-contain drop-shadow-xs group-hover:scale-105 transition-transform duration-300"
                                     loading="eager">
                            </div>

                            <!-- CARD 6: KLASSE (DESTAQUE COM LINK OFICIAL EXCLUSIVO) -->
                            <a href="https://klasse.ao/" target="_blank" rel="noopener noreferrer"
                               class="group relative bg-white dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-emerald-300/80 dark:border-emerald-500/30 hover:border-emerald-500 shadow-xs hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center min-h-[140px] sm:min-h-[155px] overflow-hidden cursor-pointer">
                                <div class="absolute top-0 inset-x-0 h-[3px] bg-gradient-to-r from-emerald-400 via-teal-500 to-emerald-600"></div>
                                <div class="absolute top-2.5 right-2.5 text-emerald-600 dark:text-emerald-400 opacity-60 group-hover:opacity-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50/60 dark:from-emerald-950/50 dark:to-teal-950/30 border border-emerald-200/70 dark:border-emerald-800/60 flex items-center justify-center p-2 shrink-0 group-hover:scale-105 transition-transform duration-300">
                                        <img src="/images/logo-klasse-clean.png"
                                             alt="KLASSE"
                                             class="max-h-full max-w-full object-contain"
                                             loading="eager">
                                    </div>
                                    <div>
                                        <div class="text-xl sm:text-2xl font-[900] tracking-tight text-slate-900 dark:text-white leading-none">
                                            KLASSE
                                        </div>
                                        <div class="text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mt-1">
                                            Gestão Escolar
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>

                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: TESTEMUNHOS                                    -->
            <!-- ========================================================= -->
            <section id="depoimentos" class="py-20 bg-slate-50 border-t border-slate-200"
                aria-labelledby="testimonials-title">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0]">Confiança
                            Conquistada</span>
                        <h2 id="testimonials-title"
                            class="text-3xl md:text-4xl font-[850] text-[#071326] mt-2 uppercase">
                            O que diz quem trabalha connosco
                        </h2>
                        <p class="text-slate-600 mt-3 text-sm md:text-base">
                            Resultados e confiança construídos com empresas, líderes e profissionais que escolheram a
                            RACHI.
                        </p>
                    </div>

                    <!-- Testimonial Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div
                            class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex text-amber-400 mb-4">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                </div>
                                <p class="text-sm text-slate-700 leading-relaxed italic">
                                    "A parceria com a RACHI permitiu modernizar os nossos processos e equipar a nossa
                                    infraestrutura tecnológica com elevado rigor. O suporte técnico é impecável."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-sm">
                                    CM
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">Carlos Mendes</div>
                                    <div class="text-xs text-slate-500">Director de Operações &bull; Grupo Industrial
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex text-amber-400 mb-4">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                </div>
                                <p class="text-sm text-slate-700 leading-relaxed italic">
                                    "Os serviços gráficos da RACHI Print e as formações executivas da RACHI Academy
                                    elevaram o padrão institucional e a produtividade da nossa equipa interna."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-sm">
                                    AP
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">Ana Paula Ferreira</div>
                                    <div class="text-xs text-slate-500">Gestora de RH &bull; Serviços Corporativos</div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                            <div>
                                <div class="flex text-amber-400 mb-4">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                </div>
                                <p class="text-sm text-slate-700 leading-relaxed italic">
                                    "Agilidade, pontualidade e soluções que realmente funcionam no contexto empresarial
                                    angolano. A entrega de consumíveis e materiais foi irrepreensível."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm">
                                    MS
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">Mateus Silva</div>
                                    <div class="text-xs text-slate-500">CEO &bull; Inovação &amp; Distribuição</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: AS 4 UNIDADES (SOLUÇÕES INTEGRADAS)              -->
            <!-- ========================================================= -->
            <section id="solucoes"
                class="py-24 bg-gradient-to-b from-slate-50 via-white to-slate-50 border-t border-slate-200/80 relative overflow-hidden">
                <!-- Background decorative ambient lights -->
                <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400/5 rounded-full blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute bottom-0 right-1/4 w-96 h-96 bg-amber-400/5 rounded-full blur-3xl pointer-events-none">
                </div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <span
                            class="text-xs font-black uppercase tracking-[0.2em] text-[#00a3e0] bg-blue-50 px-4 py-1.5 rounded-full border border-blue-100 shadow-sm">
                            ECOSSISTEMA RACHI
                        </span>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-[900] text-[#071326] mt-4 uppercase tracking-tight">
                            CONSTRUÍMOS O NEGÓCIO QUE AINDA NÃO EXISTE.
                        </h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full mx-auto my-4">
                        </div>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Um ecossistema completo de soluções para criar, estruturar, modernizar e impulsionar empresas com mais eficiência, inovação e sustentabilidade.

                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 items-stretch">

                        <!-- 01: RACHI HUMAN CAPITAL -->
                        <div
                            class="group bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-emerald-400 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                            <!-- Top accent gradient line -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 to-teal-400">
                            </div>
                            <!-- Watermark 01 -->
                            <span
                                class="absolute top-4 right-5 text-4xl font-[900] text-slate-100 group-hover:text-emerald-100 transition-colors pointer-events-none select-none">
                                01
                            </span>

                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[11px] font-black tracking-wider uppercase text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                                        Pessoas &amp; Gestão
                                    </span>
                                </div>

                                <!-- Official Brand Logo -->
                                <div
                                    class="h-28 flex items-center justify-center my-3 group-hover:scale-105 transition-transform duration-300">
                                    <picture>
                                        <source srcset="/images/areas/rachi-human-capital.webp?v={{ time() }}" type="image/webp">
                                        <img src="/images/areas/rachi-human-capital.png?v={{ time() }}"
                                            onerror="this.onerror=null; this.src='/images/areas/rachi-human-capital.png'"
                                            alt="RACHI Human Capital"
                                            class="max-h-24 max-w-[140px] object-contain drop-shadow-sm">
                                    </picture>
                                </div>

                                <h3
                                    class="text-xl font-[850] text-[#071326] mt-2 tracking-tight group-hover:text-emerald-600 transition-colors">
                                    RACHI Human Capital
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed min-h-[50px]">
                                    Serviços empresariais, recursos humanos, contabilidade e regularização documental.
                                </p>

                                
                            
                                <div class="mt-5 space-y-2 pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                        <span>Recursos Humanos &amp; Recrutamento</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                        <span>Contabilidade &amp; Apoio Legal</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-5 border-t border-slate-100">
                                <a href="/capital"
                                    class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-2 group-hover:shadow-md">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 02: RACHI ACADEMY -->
                        <div
                            class="group bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-indigo-400 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                            <!-- Top accent gradient line -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-500">
                            </div>
                            <!-- Watermark 02 -->
                            <span
                                class="absolute top-4 right-5 text-4xl font-[900] text-slate-100 group-hover:text-indigo-100 transition-colors pointer-events-none select-none">
                                02
                            </span>

                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[11px] font-black tracking-wider uppercase text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                                        Capacitação &amp; Ensino
                                    </span>
                                </div>

                                <!-- Official Brand Logo -->
                                <div
                                    class="h-28 flex items-center justify-center my-3 group-hover:scale-105 transition-transform duration-300">
                                    <picture>
                                        <source srcset="/images/areas/rachi-academy.webp?v={{ time() }}" type="image/webp">
                                        <img src="/images/areas/rachi-academy.png?v={{ time() }}"
                                            onerror="this.onerror=null; this.src='/images/areas/rachi-academy.png'"
                                            alt="RACHI Academy"
                                            class="max-h-24 max-w-[140px] object-contain drop-shadow-sm">
                                    </picture>
                                </div>

                                <h3
                                    class="text-xl font-[850] text-[#071326] mt-2 tracking-tight group-hover:text-indigo-600 transition-colors">
                                    RACHI Academy
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed min-h-[50px]">
                                    Formação profissional e corporativa em gestão, liderança, cibersegurança e
                                    competências digitais.
                                </p>

                                
                            
                                <div class="mt-5 space-y-2 pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-indigo-500 shrink-0"></i>
                                        <span>Certificação Digital com QR Code</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-indigo-500 shrink-0"></i>
                                        <span>Formação Corporativa In-Company</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-5 border-t border-slate-100">
                                <a href="/academy"
                                    class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-indigo-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-2 group-hover:shadow-md">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 03: RACHI TEC -->
                        <div
                            class="group bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-sky-400 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                            <!-- Top accent gradient line -->
                            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-sky-500 to-blue-600">
                            </div>
                            <!-- Watermark 03 -->
                            <span
                                class="absolute top-4 right-5 text-4xl font-[900] text-slate-100 group-hover:text-sky-100 transition-colors pointer-events-none select-none">
                                03
                            </span>

                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[11px] font-black tracking-wider uppercase text-sky-700 bg-sky-50 px-3 py-1 rounded-full border border-sky-100">
                                        Tecnologia &amp; TI
                                    </span>
                                </div>

                                <!-- Official Brand Logo -->
                                <div
                                    class="h-28 flex items-center justify-center my-3 group-hover:scale-105 transition-transform duration-300">
                                    <picture>
                                        <source srcset="/images/areas/rachi-tec.webp?v={{ time() }}" type="image/webp">
                                        <img src="/images/areas/rachi-tec.png?v={{ time() }}"
                                            onerror="this.onerror=null; this.src='/images/areas/rachi-tec.png'"
                                            alt="RACHI Tec"
                                            class="max-h-24 max-w-[140px] object-contain drop-shadow-sm">
                                    </picture>
                                </div>

                                <h3
                                    class="text-xl font-[850] text-[#071326] mt-2 tracking-tight group-hover:text-sky-600 transition-colors">
                                    RACHI Tec
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed min-h-[50px]">
                                    Digitalização, sistemas de gestão, websites, transformação digital e suporte
                                    técnico.
                                </p>

                                
                            
                                <div class="mt-5 space-y-2 pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-sky-500 shrink-0"></i>
                                        <span>Sistemas de Gestão &amp; Infraestrutura</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-sky-500 shrink-0"></i>
                                        <span>Suporte Técnico &amp; Transformação Digital</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-5 border-t border-slate-100">
                                <a href="/tec"
                                    class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-sky-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-2 group-hover:shadow-md">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>

                        <!-- 04: RACHI PRINT -->
                        <div
                            class="group bg-white rounded-3xl p-7 border border-slate-200/90 hover:border-amber-400 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative overflow-hidden">
                            <!-- Top accent gradient line -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-500 to-orange-400">
                            </div>
                            <!-- Watermark 04 -->
                            <span
                                class="absolute top-4 right-5 text-4xl font-[900] text-slate-100 group-hover:text-amber-100 transition-colors pointer-events-none select-none">
                                04
                            </span>

                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="text-[11px] font-black tracking-wider uppercase text-amber-700 bg-amber-50 px-3 py-1 rounded-full border border-amber-200">
                                        Gráfica &amp; Produção
                                    </span>
                                </div>

                                <!-- Official Brand Logo -->
                                <div
                                    class="h-28 flex items-center justify-center my-3 group-hover:scale-105 transition-transform duration-300">
                                    <picture>
                                        <source srcset="/images/areas/rachi-print.webp?v={{ time() }}" type="image/webp">
                                        <img src="/images/areas/rachi-print.png?v={{ time() }}"
                                            onerror="this.onerror=null; this.src='/images/areas/rachi-print.png'"
                                            alt="RACHI Print"
                                            class="max-h-24 max-w-[140px] object-contain drop-shadow-sm">
                                    </picture>
                                </div>

                                <h3
                                    class="text-xl font-[850] text-[#071326] mt-2 tracking-tight group-hover:text-amber-600 transition-colors">
                                    RACHI Print
                                </h3>

                                <p class="text-xs sm:text-sm text-slate-600 mt-2.5 leading-relaxed min-h-[50px]">
                                    Produção gráfica, impressão institucional, materiais promocionais e eventos.
                                </p>

                                
                            
                                <div class="mt-5 space-y-2 pt-4 border-t border-slate-100">
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-amber-500 shrink-0"></i>
                                        <span>Impressão Offset &amp; Digital Premium</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-amber-500 shrink-0"></i>
                                        <span>Brindes Corporativos &amp; Sinalização</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-5 border-t border-slate-100">
                                <a href="/print"
                                    class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-2 group-hover:shadow-md">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Quick Assurance Bar -->
                    <div
                        class="mt-14 p-6 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                <i data-lucide="shield-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">Precisa de um pacote integrado para a sua
                                    empresa?</h4>
                                <p class="text-xs text-slate-500">Combinamos soluções empresariais, tecnologia,
                                    capacitação e produção gráfica num único contrato de confiança.</p>
                            </div>
                        </div>
                        <a href="/contacto"
                            class="btn-cta-gold text-xs whitespace-nowrap px-5 py-2.5 flex items-center gap-1.5">
                            <span>Fale com um Consultor</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            </section>

                                    <!-- ========================================================= -->
            <!-- SECTION: ÉTICA E COMPLIANCE                              -->
            <!-- ========================================================= -->
            <section id="etica" class="py-20 bg-slate-900 text-white relative overflow-hidden"
                aria-labelledby="ethics-title">
                <div class="absolute inset-0 bg-cover bg-center opacity-10"
                    style="background-image: url('/images/blue-waves-bg.jpg')"></div>
                <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
                    <div class="max-w-3xl mb-16">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
                            Governação &amp; Integridade
                        </span>
                        <h2 id="ethics-title"
                            class="text-3xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
                            Ética que orienta. <span class="text-[#eba72d]">Integridade que fortalece.</span>
                        </h2>
                        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
                        <p class="text-slate-300 text-base md:text-lg leading-relaxed">
                            Crescer com confiança exige mais do que resultados. Exige princípios, responsabilidade e
                            compromisso com clientes, parceiros e com a lei angolana.
                        </p>
                    </div>

                    <!-- 4 Pillars of Ethics -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- 1 -->
                        <div
                            class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md hover:border-amber-400 transition">
                            <span class="text-amber-400 text-xs font-black uppercase tracking-widest">Pilar 01</span>
                            <h3 class="text-lg font-bold text-white mt-2 mb-2">Ética e Integridade</h3>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Relações comerciais honestas, combate à corrupção e respeito escrupuloso pelos
                                compromissos contratuais.
                            </p>
                        </div>
                        <!-- 2 -->
                        <div
                            class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md hover:border-cyan-400 transition">
                            <span class="text-cyan-400 text-xs font-black uppercase tracking-widest">Pilar 02</span>
                            <h3 class="text-lg font-bold text-white mt-2 mb-2">Transparência</h3>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Comunicação clara, governação corporativa responsável e decisões alinhadas com as boas
                                práticas empresariais.
                            </p>
                        </div>
                        <!-- 3 -->
                        <div
                            class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md hover:border-blue-400 transition">
                            <span class="text-blue-400 text-xs font-black uppercase tracking-widest">Pilar 03</span>
                            <h3 class="text-lg font-bold text-white mt-2 mb-2">Responsabilidade</h3>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Confidencialidade de dados, prevenção rigorosa de conflitos de interesse e protecção das
                                informações dos clientes.
                            </p>
                        </div>
                        <!-- 4 -->
                        <div
                            class="p-6 rounded-2xl bg-slate-800/80 border border-slate-700/80 backdrop-blur-md hover:border-emerald-400 transition">
                            <span class="text-emerald-400 text-xs font-black uppercase tracking-widest">Pilar 04</span>
                            <h3 class="text-lg font-bold text-white mt-2 mb-2">Conformidade Legal</h3>
                            <p class="text-xs text-slate-300 leading-relaxed">
                                Cumprimento de todas as exigências legais, fiscais e regulatórias vigentes na República
                                de Angola.
                            </p>
                        </div>
                    </div>

                    <!-- Canal Oficial de Reclamações e Denúncia -->
                    <div class="mt-10 p-6 sm:p-8 rounded-3xl bg-slate-800/85 border border-slate-700/80 backdrop-blur-md flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="max-w-2xl">
                            <span class="inline-flex items-center gap-1.5 text-[11px] font-extrabold uppercase tracking-widest text-amber-400 mb-2">
                                <i data-lucide="shield-alert" class="w-3.5 h-3.5"></i>
                                Ouvidoria &amp; Canal de Ética Confidencial
                            </span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-white">
                                Canal de Reclamações e Denúncia
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-300 mt-1.5 leading-relaxed">
                                Disponibilizamos um canal transparente e seguro para apresentação de reclamações (Lei n.º 15/03) ou denúncias confidenciais e anónimas de condutas irregulares, com emissão imediata de protocolo de acompanhamento.
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3 shrink-0">
                            <a href="/reclamacoes-e-denuncia"
                               class="px-5 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs uppercase tracking-wider transition inline-flex items-center gap-2 shadow-lg">
                                <span>Apresentar Reclamação</span>
                                <span>&rarr;</span>
                            </a>
                            <a href="/reclamacoes-e-denuncia?tipo=denuncia"
                               class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-bold text-xs uppercase tracking-wider transition inline-flex items-center gap-2">
                                <span>Canal de Denúncia</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: LOJA (DESTAQUES & MAIS COMPRADOS COM CARROSSEL)   -->
            <!-- ========================================================= -->
            <section id="loja" class="py-20 bg-white border-t border-slate-200">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                        <div>
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-50 px-3 py-1 rounded-full border border-blue-100 inline-flex items-center gap-1.5 mb-2">
                                <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-500"></i>
                                Produtos em Destaque &bull; Os Mais Comprados
                            </span>
                            <h2 class="text-3xl md:text-4xl font-[850] text-[#071326] mt-1 uppercase">
                                Tudo o que a sua empresa precisa, num só lugar
                            </h2>
                            <p class="text-slate-600 mt-2 max-w-2xl text-sm md:text-base">
                                Consumíveis, material de escritório, tecnologia, impressão e artigos promocionais — com
                                entrega em Luanda ou levantamento nas nossas instalações.
                            </p>
                        </div>

                        <div class="flex flex-wrap items-center gap-3">
                            <!-- Controlos para passar/deslizar produtos -->
                            <div class="flex items-center gap-2 bg-slate-100 p-1.5 rounded-xl border border-slate-200">
                                <button @click="prevFeaturedProduct()"
                                    class="w-9 h-9 rounded-lg bg-white text-slate-700 hover:text-amber-600 hover:bg-slate-50 flex items-center justify-center shadow-sm transition active:scale-95"
                                    title="Produto Anterior">
                                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                                </button>
                                <span class="text-xs font-bold text-slate-600 px-2 select-none"
                                    x-text="(featuredIndex + 1) + ' / ' + (featuredProducts.length - 2)"></span>
                                <button @click="nextFeaturedProduct()"
                                    class="w-9 h-9 rounded-lg bg-white text-slate-700 hover:text-amber-600 hover:bg-slate-50 flex items-center justify-center shadow-sm transition active:scale-95"
                                    title="Próximo Produto">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </button>
                            </div>

                            <a href="/loja"
                                class="px-5 py-3 rounded-xl bg-[#071326] text-white hover:bg-amber-500 hover:text-slate-950 font-bold text-xs uppercase tracking-wider transition whitespace-nowrap shadow-sm inline-flex items-center gap-2">
                                <span>Explorar catálogo completo</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                        <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="truck" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">Entrega em Luanda</h3>
                                <p class="text-xs text-slate-600 mt-1">Receba no seu escritório ou instalações com prazo
                                    ágil e embalagem segura.</p>
                            </div>
                        </div>

                        <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="store" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">Levantamento na RACHI</h3>
                                <p class="text-xs text-slate-600 mt-1">Retire a sua encomenda directamente nas nossas
                                    instalações sem qualquer custo de entrega.</p>
                            </div>
                        </div>

                        <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="building" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 text-base">Para Empresas e MPME</h3>
                                <p class="text-xs text-slate-600 mt-1">Condições especiais para encomendas corporativas
                                    em quantidade e facturação formal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Slider / Carrossel: Produtos em Destaque & Mais Comprados -->
                    <div class="relative overflow-hidden" @mouseenter="featuredPaused = true"
                        @mouseleave="featuredPaused = false">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all duration-500">
                            <template x-for="p in visibleFeaturedProducts" :key="p.id">
                                <div
                                    class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                                    <div
                                        class="h-52 bg-white flex items-center justify-center p-4 relative group-hover:bg-slate-50 transition border-b border-slate-100">
                                        <div class="absolute top-3.5 left-3.5 flex flex-col gap-1 items-start z-10">
                                            <span
                                                class="text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm"
                                                :class="p.badgeColor" x-text="p.badge"></span>
                                            <span x-show="p.discountPercent"
                                                class="text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full bg-rose-500 text-white shadow-sm"
                                                x-text="p.discountPercent"></span>
                                        </div>
                                        <img :src="p.image" :alt="p.name"
                                            class="max-h-40 max-w-full object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="p-5 flex-1 flex flex-col justify-between">
                                        <div>
                                            <div class="flex items-center justify-between text-[11px] mb-1">
                                                <span class="font-bold uppercase tracking-wider text-slate-400"
                                                    x-text="p.category"></span>
                                                <span class="text-amber-500 font-bold flex items-center gap-1">
                                                    ★ <span class="text-slate-700 font-semibold" x-text="p.rating"></span>
                                                </span>
                                            </div>
                                            <h4 class="font-bold text-slate-900 text-sm sm:text-base leading-snug group-hover:text-blue-600 transition line-clamp-2"
                                                x-text="p.name"></h4>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed" x-text="p.shortDesc"></p>
                                        </div>
                                        <div
                                            class="mt-4 pt-3 border-t border-slate-100 flex items-end justify-between gap-2">
                                            <div>
                                                <span x-show="p.oldPrice" class="block text-xs text-slate-400 line-through font-medium"
                                                    x-text="p.oldPrice"></span>
                                                <span class="font-black text-slate-950 text-base sm:text-lg tracking-tight"
                                                    x-text="p.priceText"></span>
                                            </div>
                                            <button @click="addToCartFromFeatured(p)"
                                                class="px-4 py-2.5 bg-[#f5a800] hover:bg-[#e09900] text-slate-950 font-black rounded-xl text-xs uppercase tracking-wider transition shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5 whitespace-nowrap">
                                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5"></i>
                                                <span>Comprar</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <!-- Indicadores de Carrossel -->
                        <div class="flex justify-center items-center gap-2 mt-6">
                            <template x-for="(dot, idx) in (featuredProducts.length - 2)" :key="idx">
                                <button @click="featuredIndex = idx; $nextTick(() => lucide.createIcons())"
                                    class="h-2 rounded-full transition-all duration-300"
                                    :class="featuredIndex === idx ? 'w-8 bg-amber-500' : 'w-2 bg-slate-300 hover:bg-slate-400'"
                                    :title="'Ver posição ' + (idx + 1)"></button>
                            </template>
                        </div>
                    </div>
                </div>
            </section>


            <!-- IDENTITY MODAL (MISSÃO, VISÃO E VALORES) - DARK LUXURY GLASS REDESIGN -->
            <div id="identity-modal" x-show="identityModalOpen" x-cloak
                @keydown.escape.window="closeIdentityModal()"
                @click.self="closeIdentityModal()"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 overflow-y-auto bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 cursor-pointer" style="z-index: 2000 !important;">
                <div @click.stop
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                    class="bg-[#050e1f]/95 backdrop-blur-2xl rounded-3xl max-w-4xl w-full p-7 sm:p-10 shadow-[0_25px_70px_rgba(0,0,0,0.85),0_0_50px_rgba(0,163,224,0.14)] border border-sky-500/25 relative overflow-hidden text-white">

                    <!-- Ambient Glow Effect inside Modal -->
                    <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-96 h-48 bg-sky-500/15 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>

                    <!-- Close Button -->
                    <button @click="closeIdentityModal()"
                        aria-label="Fechar janela"
                        class="absolute top-5 right-5 sm:top-6 sm:right-6 w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 border border-white/10 hover:border-sky-400/50 text-slate-400 hover:text-white flex items-center justify-center transition-all duration-200 z-10">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Header -->
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-400 text-[11px] font-extrabold uppercase tracking-widest mb-3">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 shadow-[0_0_8px_#f59e0b]"></span>
                            <span>Identidade Corporativa</span>
                        </div>
                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-[900] text-white tracking-tight uppercase leading-tight">
                            Missão, Visão e <span class="bg-gradient-to-r from-amber-400 via-yellow-300 to-amber-500 bg-clip-text text-transparent">Valores</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-400 mt-1.5 mb-7 max-w-xl">
                            Os pilares estratégicos e valores fundamentais que orientam as decisões e o ecossistema de soluções RACHI em Angola.
                        </p>
                    </div>

                    <!-- 3 Pillars Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 relative z-10">
                        <!-- 01 Missão -->
                        <div class="rounded-2xl p-6 bg-gradient-to-b from-blue-950/40 to-slate-900/80 border border-blue-500/25 hover:border-blue-400/50 transition-all duration-300 hover:-translate-y-1 shadow-[0_12px_30px_rgba(0,0,0,0.4)] hover:shadow-[0_16px_36px_rgba(0,163,224,0.2)] flex flex-col justify-between relative group overflow-hidden">
                            <div class="absolute -top-12 -right-12 w-24 h-24 bg-blue-500/10 rounded-full blur-xl group-hover:bg-blue-500/20 transition-all duration-300"></div>
                            <div>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-blue-500/15 border border-blue-500/35 flex items-center justify-center text-[#00a3e0] shadow-[0_0_12px_rgba(0,163,224,0.25)]">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10" />
                                            <circle cx="12" cy="12" r="6" />
                                            <circle cx="12" cy="12" r="2" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-black text-blue-400 tracking-wider px-2.5 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/25">01</span>
                                </div>
                                <h4 class="text-lg font-[850] text-white tracking-wide uppercase mb-2 group-hover:text-blue-300 transition-colors">Missão</h4>
                                <p class="text-xs text-slate-300 leading-relaxed">
                                    Gerar valor sustentável com soluções inteligentes e integradas em tecnologia, gráfica,
                                    educação e capital humano, facilitando o crescimento das empresas em Angola.
                                </p>
                            </div>
                            <div class="w-8 h-0.5 rounded-full bg-blue-400 shadow-[0_0_8px_rgba(0,163,224,0.8)] mt-5"></div>
                        </div>

                        <!-- 02 Visão -->
                        <div class="rounded-2xl p-6 bg-gradient-to-b from-amber-950/40 to-slate-900/80 border border-amber-500/25 hover:border-amber-400/50 transition-all duration-300 hover:-translate-y-1 shadow-[0_12px_30px_rgba(0,0,0,0.4)] hover:shadow-[0_16px_36px_rgba(245,168,0,0.2)] flex flex-col justify-between relative group overflow-hidden">
                            <div class="absolute -top-12 -right-12 w-24 h-24 bg-amber-500/10 rounded-full blur-xl group-hover:bg-amber-500/20 transition-all duration-300"></div>
                            <div>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-amber-500/15 border border-amber-500/35 flex items-center justify-center text-[#f5a800] shadow-[0_0_12px_rgba(245,168,0,0.25)]">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-black text-amber-400 tracking-wider px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/25">02</span>
                                </div>
                                <h4 class="text-lg font-[850] text-white tracking-wide uppercase mb-2 group-hover:text-amber-300 transition-colors">Visão</h4>
                                <p class="text-xs text-slate-300 leading-relaxed">
                                    Ser a principal referência em ecossistemas de soluções empresariais em Angola,
                                    reconhecida pela inovação contínua, proximidade e impacto positivo nos negócios.
                                </p>
                            </div>
                            <div class="w-8 h-0.5 rounded-full bg-amber-400 shadow-[0_0_8px_rgba(245,168,0,0.8)] mt-5"></div>
                        </div>

                        <!-- 03 Valores -->
                        <div class="rounded-2xl p-6 bg-gradient-to-b from-emerald-950/40 to-slate-900/80 border border-emerald-500/25 hover:border-emerald-400/50 transition-all duration-300 hover:-translate-y-1 shadow-[0_12px_30px_rgba(0,0,0,0.4)] hover:shadow-[0_16px_36px_rgba(16,185,129,0.2)] flex flex-col justify-between relative group overflow-hidden">
                            <div class="absolute -top-12 -right-12 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl group-hover:bg-emerald-500/20 transition-all duration-300"></div>
                            <div>
                                <div class="flex items-center justify-between gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-emerald-500/15 border border-emerald-500/35 flex items-center justify-center text-[#10b981] shadow-[0_0_12px_rgba(16,185,129,0.25)]">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                        </svg>
                                    </div>
                                    <span class="text-xs font-black text-emerald-400 tracking-wider px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/25">03</span>
                                </div>
                                <h4 class="text-lg font-[850] text-white tracking-wide uppercase mb-2 group-hover:text-emerald-300 transition-colors">Valores</h4>
                                <p class="text-xs text-slate-300 leading-relaxed">
                                    Ética irrepreensível, compromisso com a qualidade, foco no cliente, colaboração e
                                    responsabilidade no desenvolvimento socioeconómico sustentável.
                                </p>
                            </div>
                            <div class="w-8 h-0.5 rounded-full bg-emerald-400 shadow-[0_0_8px_rgba(16,185,129,0.8)] mt-5"></div>
                        </div>
                    </div>

                    <!-- Footer Action Button -->
                    <div class="mt-8 pt-2 text-center relative z-10">
                        <button @click="closeIdentityModal()"
                            class="px-8 py-3 rounded-full bg-slate-800/90 hover:bg-slate-700/90 border border-slate-700 hover:border-sky-400/50 text-slate-200 hover:text-white font-bold text-xs uppercase tracking-widest transition-all duration-200 shadow-lg hover:shadow-sky-500/20 hover:-translate-y-0.5 inline-flex items-center gap-2">
                            <span>Fechar Janela</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <!-- PRODUCT DETAILS MODAL -->
        <div x-show="productModalOpen" x-cloak
            class="fixed inset-0 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4" style="z-index: 2000 !important;">
            <div @click.away="productModalOpen = false"
                class="bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 shadow-2xl border border-slate-100 relative">
                <button @click="productModalOpen = false"
                    class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 p-2">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>

                <template x-if="selectedStoreProduct">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div
                            class="bg-slate-50 rounded-2xl p-6 flex items-center justify-center border border-slate-100 h-64">
                            <img :src="selectedStoreProduct.image" :alt="selectedStoreProduct.title"
                                class="max-h-full max-w-full object-contain">
                        </div>

                        <div>
                            <span class="text-xs font-extrabold uppercase text-amber-500"
                                x-text="selectedStoreProduct.category"></span>
                            <h2 class="text-xl font-black text-slate-900 mt-1 leading-snug"
                                x-text="selectedStoreProduct.title"></h2>

                            <div class="mt-4 flex items-baseline gap-3">
                                <span class="text-2xl font-black text-slate-900"
                                    x-text="selectedStoreProduct.price"></span>
                                <span x-show="selectedStoreProduct.oldPrice" class="text-sm text-slate-400 line-through"
                                    x-text="selectedStoreProduct.oldPrice"></span>
                            </div>

                            <p class="text-xs text-emerald-600 font-semibold mt-2 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                <span>Em stock — Entrega em Luanda</span>
                            </p>

                            <p class="text-xs text-slate-600 mt-4 leading-relaxed">
                                Artigo certificado com garantia oficial RACHI. Acompanha documentação fiscal corporativa
                                e suporte pós-venda especializado.
                            </p>

                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                                <button @click="addToCartFromStore(selectedStoreProduct); productModalOpen = false"
                                    class="flex-1 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 text-slate-950 font-bold rounded-xl text-xs uppercase tracking-wider transition">
                                    Adicionar ao carrinho
                                </button>
                                <button @click="productModalOpen = false"
                                    class="px-4 py-3 border border-slate-200 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-50">
                                    Fechar
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>


                <!-- FOOTER CORPORATIVO OFICIAL RACHI -->
        <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div>
                        <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-10 mb-4 hidden dark:block">
                        <img src="/images/logo-rachi.png" onerror="this.onerror=null; this.src='/images/logo-rachi-dark.png'" alt="RACHI" class="h-10 mb-4 dark:hidden">
                        <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                            Ecossistema integrado de soluções corporativas em Angola: tecnologia, produção gráfica, formação profissional e capital humano.
                        </p>
                        <div class="mt-4 flex items-center gap-3 text-xs text-slate-500">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 font-semibold border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Luanda · Angola
                            </span>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Unidades de Negócio</h4>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <li><a href="/tec" class="hover:text-slate-900 dark:hover:text-white transition font-medium">RACHI Tec — Tecnologia, Sites &amp; Suporte TI</a></li>
                            <li><a href="/print" class="hover:text-slate-900 dark:hover:text-white transition font-medium">RACHI Print — Gráfica, Brindes &amp; Sinalética</a></li>
                            <li><a href="/academy" class="hover:text-slate-900 dark:hover:text-white transition font-medium">RACHI Academy — Formação &amp; Certificação</a></li>
                            <li><a href="/capital" class="hover:text-slate-900 dark:hover:text-white transition font-medium">RACHI Human Capital — RH &amp; Contabilidade</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Institucional &amp; Legal</h4>
                        <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                            <li><a href="/privacidade" class="hover:text-blue-600 dark:hover:text-amber-400 transition font-semibold">Política de Privacidade (Lei 22/11)</a></li>
                            <li><a href="/termos" class="hover:text-blue-600 dark:hover:text-amber-400 transition font-semibold">Termos e Condições de Uso</a></li>
                            <li><a href="/cookies" class="hover:text-blue-600 dark:hover:text-amber-400 transition">Política de Cookies</a></li>
                            <li><a href="/reclamacoes-e-denuncia" class="hover:text-blue-600 dark:hover:text-amber-400 transition font-semibold">Reclamações e Denúncia</a></li>
                            <li><a href="#etica" @click.prevent="scrollToSection('etica')" class="hover:text-slate-900 dark:hover:text-white transition">Ética e Compliance</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Sede &amp; Contactos</h4>
                        <p class="text-xs text-slate-700 dark:text-slate-300 font-semibold">Rua Ndunduma</p>
                        <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 font-medium">Miramar – Luanda, Angola</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Por detrás do BFA</p>
                        <p class="text-xs text-slate-700 dark:text-slate-300 font-medium mt-2 flex items-center gap-1.5">
                            <span class="text-slate-400">Tel:</span> +244 972 888 585
                        </p>
                        <p class="text-xs text-slate-700 dark:text-slate-300 font-medium mt-1 flex items-center gap-1.5">
                            <span class="text-slate-400">WhatsApp:</span> +244 923 000 001
                        </p>
                        <p class="text-xs text-slate-700 dark:text-slate-300 font-medium mt-1 flex items-center gap-1.5">
                            <span class="text-slate-400">E-mail:</span> geral@rachi.ao
                        </p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-2">Segunda a Sexta: 08h00 às 17h00</p>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-slate-800 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs text-slate-500 dark:text-slate-400">
                    <div>&copy; 2026 <strong class="text-slate-900 dark:text-white">RACHI</strong> — Soluções Inteligentes. Todos os direitos reservados. República de Angola.</div>
                    <div class="flex gap-3 items-center text-xs">
                        <button type="button" onclick="setRachiLanguage('pt')" data-rachi-lang="pt" class="cursor-pointer font-bold text-amber-500 dark:text-amber-400 hover:opacity-100 transition" title="Português">PT</button>
                        <span class="text-slate-500 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('en')" data-rachi-lang="en" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="English">EN</button>
                        <span class="text-slate-500 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('zh-CN')" data-rachi-lang="zh-CN" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="中文 (Mandarim)">中文</button>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- ============================================================== -->
    <!-- ALERTA TOAST FLUTUANTE DINÂMICO (SUCESSO, LOGOUT, ERRO, AVISO)  -->
    <!-- ============================================================== -->
    <div x-show="loginToast.show"
         x-cloak
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-0 sm:translate-x-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-0 sm:translate-x-4 scale-95"
         class="fixed top-20 right-4 sm:right-6 z-[2100] max-w-md w-full bg-slate-900/95 rounded-2xl p-4 shadow-2xl backdrop-blur-xl text-white border transition-colors duration-300"
         style="z-index: 2100 !important;"
         :class="{
             'border-emerald-500/50 shadow-emerald-500/10': loginToast.type === 'success',
             'border-[#0050f0]/60 shadow-blue-500/10': loginToast.type === 'logout',
             'border-rose-500/60 shadow-rose-500/15': loginToast.type === 'error',
             'border-amber-500/50 shadow-amber-500/10': loginToast.type === 'warning',
             'border-sky-500/50 shadow-sky-500/10': loginToast.type === 'info'
         }">
        <div class="flex items-start gap-3.5">
            <!-- Ícone Condicional por Tipo de Alerta -->
            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 border"
                 :class="{
                     'bg-emerald-500/20 text-emerald-400 border-emerald-500/30': loginToast.type === 'success',
                     'bg-blue-500/20 text-[#00a3e0] border-blue-500/30': loginToast.type === 'logout',
                     'bg-rose-500/20 text-rose-400 border-rose-500/30': loginToast.type === 'error',
                     'bg-amber-500/20 text-amber-400 border-amber-500/30': loginToast.type === 'warning',
                     'bg-sky-500/20 text-sky-400 border-sky-500/30': loginToast.type === 'info'
                 }">
                <!-- Sucesso (Checkmark) -->
                <template x-if="loginToast.type === 'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </template>
                <!-- Logout / Desconectar -->
                <template x-if="loginToast.type === 'logout'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </template>
                <!-- Erro (Cross / Alert) -->
                <template x-if="loginToast.type === 'error'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </template>
                <!-- Aviso (Triangle) -->
                <template x-if="loginToast.type === 'warning'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </template>
                <!-- Info (Info circle) -->
                <template x-if="loginToast.type === 'info'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
            </div>

            <!-- Conteúdo do Alerta -->
            <div class="flex-1 min-w-0">
                <div class="font-bold text-sm text-white flex items-center gap-2">
                    <span x-text="loginToast.title"></span>
                    <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded border"
                          :class="{
                              'bg-emerald-500/20 text-emerald-400 border-emerald-500/30': loginToast.type === 'success',
                              'bg-blue-500/20 text-blue-300 border-blue-500/30': loginToast.type === 'logout',
                              'bg-rose-500/20 text-rose-300 border-rose-500/30': loginToast.type === 'error',
                              'bg-amber-500/20 text-amber-300 border-amber-500/30': loginToast.type === 'warning',
                              'bg-sky-500/20 text-sky-300 border-sky-500/30': loginToast.type === 'info'
                          }"
                          x-text="loginToast.badge"></span>
                </div>
                <p class="text-xs text-slate-300 mt-0.5 leading-relaxed break-words" x-text="loginToast.message"></p>
            </div>

            <!-- Botão Fechar -->
            <button @click="closeLoginToast()"
                    class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition leading-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Barra de Progresso com Contagem Decrescente Automática -->
        <div class="w-full bg-white/10 h-1 rounded-full mt-3 overflow-hidden">
            <div :key="loginToast.progressKey"
                 class="toast-progress-bar h-full w-full"
                 :class="{
                     'bg-gradient-to-r from-emerald-500 to-teal-400': loginToast.type === 'success',
                     'bg-gradient-to-r from-[#0050f0] to-[#00a3e0]': loginToast.type === 'logout',
                     'bg-gradient-to-r from-rose-500 to-red-600': loginToast.type === 'error',
                     'bg-gradient-to-r from-amber-500 to-yellow-400': loginToast.type === 'warning',
                     'bg-gradient-to-r from-sky-500 to-blue-600': loginToast.type === 'info'
                 }">
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: ENTRAR E CRIAR CONTA UNIFICADO (LIGHT & DARK MODE)      -->
    <!-- ============================================================== -->
    <div x-show="loginModal"
        class="fixed inset-0 bg-slate-950/75 dark:bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 overflow-y-auto transition-all duration-300 no-scrollbar scrollbar-none"
        style="z-index: 2000 !important;"
        x-cloak
        x-init="$watch('loginModal', val => document.body.style.overflow = val ? 'hidden' : '')"
        @click.self="loginModal = false">
        <div :class="authTab === 'register' ? 'max-w-xl max-h-[88vh] overflow-y-auto my-auto no-scrollbar scrollbar-none' : 'max-w-md my-auto overflow-hidden'"
             class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl w-full p-5 sm:p-6 shadow-2xl text-slate-800 dark:text-white relative transition-all duration-300">
            <!-- Glow background effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 dark:bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Header: Logo & Botão Fechar -->
            <div class="flex justify-between items-center mb-4 relative z-10">
                <div class="flex items-center">
                    <!-- Dark Logo para Modo Claro -->
                    <img src="/images/logo-rachi-dark.png" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi.png'"
                         alt="RACHI" class="h-8 object-contain dark:hidden">
                    <!-- Light Logo para Modo Escuro -->
                    <img src="/images/logo-rachi-light.png" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                         alt="RACHI" class="h-8 object-contain hidden dark:block">
                </div>
                <button @click="loginModal = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
                        title="Fechar">
                    &times;
                </button>
            </div>

            <!-- Título e Descrição Dinâmicos -->
            <div class="relative z-10 mb-4">
                <template x-if="authTab === 'login'">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
                            <span>Iniciar sessão</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 mt-1 leading-relaxed">
                            Todos os utilizadores acedem pelo mesmo login. Use o e-mail e a palavra-passe da sua conta RACHI.
                        </p>
                    </div>
                </template>
                <template x-if="authTab === 'register'">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                            <span>Criar conta</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 leading-relaxed">
                            Registe-se como particular ou empresa. Enviaremos a palavra-passe temporária e o código de activação para o seu e-mail.
                        </p>
                    </div>
                </template>
            </div>

            <!-- Alerta de Erro Unificado (Com desaparecimento automático e transição suave) -->
            <div x-show="authError" x-cloak
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                class="mb-3 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 dark:bg-rose-500/15 dark:border-rose-500/40 dark:text-rose-300 text-xs flex items-center justify-between gap-2.5 relative z-10 shadow-sm">
                <div class="flex items-center gap-2.5 flex-1 min-w-0">
                    <svg class="w-4 h-4 flex-shrink-0 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span x-text="authError" class="leading-relaxed"></span>
                </div>
                <button type="button" @click="authError = ''" class="text-rose-400 hover:text-rose-600 dark:hover:text-rose-200 p-0.5 rounded cursor-pointer leading-none flex-shrink-0" title="Fechar">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- ABA 1: FORMULÁRIO DE LOGIN -->
            <form x-show="authTab === 'login'" @submit.prevent="submitUnifiedLogin()" class="space-y-4 relative z-10">
                <!-- Campo E-mail -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        E-mail
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </span>
                        <input type="email" x-model="authForm.email"
                               @input="authErrors.email = ''"
                               placeholder="ex: seu.email@empresa.com"
                               :class="authErrors.email ? 'border-rose-500 focus:border-rose-500' : 'border-slate-200 dark:border-slate-700 focus:border-[#0050f0]'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <p x-show="authErrors.email" x-text="authErrors.email" class="text-[11px] text-rose-500 font-semibold mt-1" x-cloak></p>
                </div>

                <!-- Campo Palavra-passe -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                            Palavra-passe
                        </label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="authForm.showPassword ? 'text' : 'password'" x-model="authForm.password"
                               @input="authErrors.password = ''"
                               placeholder="••••••••"
                               :class="authErrors.password ? 'border-rose-500 focus:border-rose-500' : 'border-slate-200 dark:border-slate-700 focus:border-[#0050f0]'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border rounded-xl pl-10 pr-10 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        <button type="button" @click="authForm.showPassword = !authForm.showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 cursor-pointer">
                            <span x-text="authForm.showPassword ? '🙈' : '👁️'" class="text-xs"></span>
                        </button>
                    </div>
                    <p x-show="authErrors.password" x-text="authErrors.password" class="text-[11px] text-rose-500 font-semibold mt-1" x-cloak></p>
                </div>

                <!-- Botão de Ação: Login -->
                <button type="submit"
                        :disabled="authLoading"
                        class="w-full mt-2 py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#0050f0] via-[#0284c7] to-[#00a3e0] hover:from-[#0040d0] hover:to-[#0274b5] text-white font-bold text-sm uppercase tracking-wider shadow-lg shadow-blue-500/25 transition-all flex items-center justify-center gap-2 transform active:scale-[0.99] cursor-pointer">
                    <template x-if="!authLoading">
                        <div class="flex items-center gap-2">
                            <span>Aceder à Plataforma</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="authLoading">
                        <div class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Validando credenciais...</span>
                        </div>
                    </template>
                </button>

                <!-- Footer Link -->
                <p class="text-center text-xs text-slate-500 dark:text-slate-400 pt-1">
                    Ainda não tem conta?
                    <button type="button" @click="authTab = 'register'; authError = ''"
                            class="font-bold text-[#0050f0] dark:text-amber-400 hover:underline cursor-pointer ml-1">
                        Criar conta gratuita
                    </button>
                </p>
            </form>

            <!-- ABA 2: FORMULÁRIO DE CRIAR CONTA -->
            <form x-show="authTab === 'register'" @submit.prevent="submitRegister()" class="space-y-3 relative z-10">
                <!-- Tipo de cliente -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Tipo de cliente
                    </label>
                    <div class="grid grid-cols-2 gap-2 p-1 bg-slate-100 dark:bg-slate-800/90 rounded-xl border border-slate-200/80 dark:border-slate-700/60">
                        <button type="button" @click="registerForm.tipo_cliente = 'particular'"
                                :class="registerForm.tipo_cliente === 'particular' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white'"
                                class="py-1.5 text-xs rounded-lg transition text-center cursor-pointer flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>Particular</span>
                        </button>
                        <button type="button" @click="registerForm.tipo_cliente = 'empresa'"
                                :class="registerForm.tipo_cliente === 'empresa' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white'"
                                class="py-1.5 text-xs rounded-lg transition text-center cursor-pointer flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Empresa</span>
                        </button>
                    </div>
                </div>

                <!-- Nome Completo / Nome da Empresa & NIF (opcional) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            <span x-show="registerForm.tipo_cliente === 'empresa'">Nome da empresa</span>
                            <span x-show="registerForm.tipo_cliente !== 'empresa'">Nome completo</span>
                        </label>
                        <input type="text" x-model="registerForm.nome" required
                               :placeholder="registerForm.tipo_cliente === 'empresa' ? 'Empresa, Lda.' : 'O seu nome'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            NIF (opcional)
                        </label>
                        <input type="text" x-model="registerForm.nif"
                               placeholder="Número de identificação fiscal"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                </div>

                <!-- E-mail -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        E-mail
                    </label>
                    <input type="email" x-model="registerForm.email" required
                           placeholder="nome@gmail.com"
                           class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                </div>

                <!-- Telefone (opcional) & WhatsApp (opcional) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Telefone (opcional)
                        </label>
                        <input type="tel" x-model="registerForm.telefone"
                               placeholder="+244 ..."
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            WhatsApp (opcional)
                        </label>
                        <input type="tel" x-model="registerForm.whatsapp"
                               placeholder="+244 ..."
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                </div>


                <!-- Morada (opcional) -->
                <div class="pt-2 border-t border-slate-200/70 dark:border-slate-700/60 space-y-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-slate-200">
                            Endereço (opcional)
                        </label>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 dark:text-slate-400">
                            Se preencher a morada, indique pelo menos a província e o município.
                        </p>
                    </div>

                    <!-- Província e Município -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Província
                            </label>
                            <select x-model="registerForm.provincia"
                                    class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white transition outline-none cursor-pointer">
                                <option value="">Seleccione a província</option>
                                <option value="Luanda">Luanda</option>
                                <option value="Bengo">Bengo</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Bié">Bié</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Cuando Cubango">Cuando Cubango</option>
                                <option value="Cuanza Norte">Cuanza Norte</option>
                                <option value="Cuanza Sul">Cuanza Sul</option>
                                <option value="Cunene">Cunene</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Huíla">Huíla</option>
                                <option value="Lunda Norte">Lunda Norte</option>
                                <option value="Lunda Sul">Lunda Sul</option>
                                <option value="Malanje">Malanje</option>
                                <option value="Moxico">Moxico</option>
                                <option value="Namibe">Namibe</option>
                                <option value="Uíge">Uíge</option>
                                <option value="Zaire">Zaire</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Município
                            </label>
                            <input type="text" x-model="registerForm.municipio"
                                   placeholder="Seleccione o município"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>

                    <!-- Distrito / Bairro e Rua -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Distrito / Bairro
                            </label>
                            <input type="text" x-model="registerForm.bairro"
                                   placeholder="Talatona"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Rua
                            </label>
                            <input type="text" x-model="registerForm.rua"
                                   placeholder="Rua / avenida"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>

                    <!-- N.º e Referência -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                N.º
                            </label>
                            <input type="text" x-model="registerForm.numero"
                                   placeholder="Porta"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Referência
                            </label>
                            <input type="text" x-model="registerForm.referencia"
                                   placeholder="Referência"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>
                </div>

                <!-- Palavra-passe & Confirmação -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 border-t border-slate-200/60 dark:border-slate-700/60">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Palavra-passe
                        </label>
                        <input type="password" x-model="registerForm.password" required minlength="6"
                               placeholder="Mínimo 6 caracteres"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Confirmar Palavra-passe
                        </label>
                        <input type="password" x-model="registerForm.password_confirmation" required minlength="6"
                               placeholder="Repita a palavra-passe"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 outline-none">
                    </div>
                </div>

                <!-- Termos e Privacidade (Lei 22/11 de Angola) -->
                <label class="flex items-start gap-2 text-[11px] text-slate-600 dark:text-slate-400 cursor-pointer pt-1">
                    <input type="checkbox" x-model="registerForm.terms_accepted" required class="mt-0.5 accent-[#0050f0]">
                    <span>Concordo com os <a href="/termos" target="_blank" class="text-blue-600 dark:text-amber-400 underline font-semibold">Termos de Uso</a> e a <a href="/privacidade" target="_blank" class="text-blue-600 dark:text-amber-400 underline font-semibold">Política de Privacidade</a> (Lei n.º 22/11 de Angola).</span>
                </label>

                <!-- Botão de Ação: Criar Conta -->
                <button type="submit"
                        :disabled="authLoading"
                        class="w-full mt-3 py-3.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-bold text-sm uppercase tracking-wider shadow-lg shadow-emerald-500/25 transition-all flex items-center justify-center gap-2 transform active:scale-[0.99] cursor-pointer">
                    <template x-if="!authLoading">
                        <div class="flex items-center gap-2">
                            <span>Criar conta</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="authLoading">
                        <div class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Criando conta e gerando acessos...</span>
                        </div>
                    </template>
                </button>

                <!-- Footer Link -->
                <p class="text-center text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 pt-1">
                    Já tem uma conta registada?
                    <button type="button" @click="authTab = 'login'; authError = ''"
                            class="font-bold text-[#0050f0] dark:text-amber-400 hover:underline cursor-pointer ml-1">
                        Fazer login
                    </button>
                </p>
            </form>
        </div>
    </div>

    <!-- MODAL INFORMATIVO: MATRÍCULA NECESSÁRIA NA ACADEMY (RESPONDE A DARK MODE E MODO CLARO) -->
    <div x-show="matriculaModalOpen" 
         class="fixed inset-0 bg-slate-950/75 dark:bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 overflow-y-auto transition-all duration-300" style="z-index: 2000 !important;" 
         x-cloak 
         @click.self="matriculaModalOpen = false">
        <div class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl text-slate-800 dark:text-white relative overflow-hidden transition-all duration-300">
            <!-- Glow background effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 dark:bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Botão Fechar -->
            <div class="flex justify-end mb-1 relative z-10">
                <button @click="matriculaModalOpen = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
                        title="Fechar">
                    &times;
                </button>
            </div>

            <!-- Ícone -->
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 dark:bg-amber-500/20 dark:text-amber-400 dark:border-amber-500/30 flex items-center justify-center mx-auto mb-4 relative z-10 shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-center text-slate-900 dark:text-white mb-2 relative z-10">
                Matrícula Necessária
            </h3>
            
            <p class="text-xs text-slate-600 dark:text-slate-300 text-center leading-relaxed mb-6 relative z-10">
                O seu perfil de cliente está ativo para solicitar produtos e serviços, porém <strong class="text-amber-600 dark:text-amber-400 font-bold">ainda não possui matrícula ativa</strong> em nenhum curso da <strong>RACHI Academy</strong>.
                <br><br>
                Faça a sua matrícula para liberar acesso à Sala de Aula, aulas em vídeo, materiais e emissão de certificados.
            </p>

            <div class="space-y-2.5 relative z-10">
                <button @click="window.location.href = '/academy'" 
                        class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-slate-950 font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 transition cursor-pointer transform active:scale-[0.99]">
                    <span>Conhecer Cursos & Fazer Matrícula</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
                <button @click="matriculaModalOpen = false" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold text-xs transition cursor-pointer">
                    Voltar ao Painel do Cliente
                </button>
            </div>
        </div>
    </div>

    <!-- CART SLIDE-OVER -->
    <div x-show="cartDrawer" class="fixed inset-0 overflow-hidden" style="z-index: 2000 !important;" x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="cartDrawer = false"></div>
        <div class="absolute inset-y-0 right-0 max-w-md w-full bg-white shadow-2xl flex flex-col">
            <div class="p-6 border-b flex justify-between items-center bg-[#071326] text-white">
                <h3 class="font-bold text-lg">Meu Carrinho</h3>
                <button @click="cartDrawer = false" class="text-slate-400 hover:text-white text-2xl">&times;</button>
            </div>
            <div class="p-6 flex-1 overflow-y-auto space-y-4">
                <template x-if="cart.length === 0">
                    <div class="text-center py-12 text-slate-400">
                        <i data-lucide="shopping-cart" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                        <p>O seu carrinho está vazio.</p>
                    </div>
                </template>
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex items-center justify-between border-b pb-3">
                        <div class="flex items-center gap-3">
                            <img :src="item.image" class="w-12 h-12 object-contain rounded bg-slate-50 p-1 border">
                            <div>
                                <h5 class="text-sm font-bold text-slate-800" x-text="item.name"></h5>
                                <span class="text-xs text-slate-500 dark:text-slate-400"
                                    x-text="item.price.toLocaleString('pt-AO') + ' AOA'"></span>
                            </div>
                        </div>
                        <button @click="removeFromCart(index)"
                            class="text-rose-500 hover:text-rose-700 text-xs font-semibold">Remover</button>
                    </div>
                </template>
            </div>
            <div class="p-6 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 space-y-3" x-show="cart.length > 0">
                <div class="flex justify-between font-bold text-base">
                    <span class="text-slate-700 dark:text-slate-300">Total:</span>
                    <span class="text-amber-600 dark:text-amber-400 font-black" x-text="cartTotal.toLocaleString('pt-AO') + ' AOA'"></span>
                </div>

                <!-- Formulário de Identificação do Cliente para Factura Proforma (quando não autenticado) -->
                <template x-if="!currentUser && cartCheckoutStep === 'identity'">
                    <div class="space-y-3 pt-2 border-t border-slate-200 dark:border-slate-700 text-xs">
                        <div class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300 text-[11px] leading-relaxed">
                            <strong>Factura Proforma Multicaixa:</strong> Introduza os dados de facturação para emitirmos o documento formal com coordenadas de pagamento.
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Nome / Empresa *</label>
                            <input type="text" x-model="checkoutForm.name" required placeholder="O seu nome ou empresa" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">E-mail *</label>
                                <input type="email" x-model="checkoutForm.email" required placeholder="para envio da proforma" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Telefone *</label>
                                <input type="text" x-model="checkoutForm.phone" required placeholder="+244 ..." class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">NIF (Opcional)</label>
                                <input type="text" x-model="checkoutForm.document" placeholder="N.º fiscal" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Município / Bairro</label>
                                <input type="text" x-model="checkoutForm.address" placeholder="Talatona, Luanda" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                        </div>
                        <div class="pt-2 flex gap-2">
                            <button type="button" @click="submitProformaOrder()" class="flex-1 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition">
                                Emitir Factura Proforma
                            </button>
                            <button type="button" @click="cartCheckoutStep = 'cart'" class="px-3 py-3 border rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300">
                                Voltar
                            </button>
                        </div>
                        <p class="text-center text-[10px] text-slate-500 pt-1">
                            Já tem conta? <button type="button" @click="cartDrawer = false; loginModal = true; authTab = 'login'" class="text-blue-600 font-bold underline">Iniciar sessão</button>
                        </p>
                    </div>
                </template>

                <template x-if="currentUser || cartCheckoutStep === 'cart'">
                    <div class="space-y-2">
                        <button @click="processCartCheckout()"
                            class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-xl shadow-lg transition text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                            <span>Gerar Factura Proforma (Multicaixa)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                        <p class="text-[11px] text-center text-slate-500 dark:text-slate-400">
                            Facturação formal com coordenadas bancárias Multicaixa Express / IBAN.
                        </p>
                    </div>
                </template>
            </div>
        </div>
    </div>



    <!-- Script Implementation -->
    <script>
        function rachiApp() {
            return {
                currentUser: null,
                isLoggedIn: false,
                currentView: 'public',
                currentTab: 'home',
                identityModalOpen: false,
                matriculaModalOpen: false,
                mobileMenuOpen: false,
                solutionsOpen: false,
                loginModal: false,
                cartDrawer: false,
                productModalOpen: false,
                selectedStoreProduct: null,
                cartCheckoutStep: 'cart',
                checkoutForm: {
                    name: '',
                    email: '',
                    phone: '',
                    document: '',
                    address: ''
                },
                authTab: 'login',
                authForm: {
                    email: '',
                    password: '',
                    showPassword: false
                },
                authErrors: {
                    email: '',
                    password: ''
                },
                registerForm: {
                    tipo_cliente: 'particular',
                    nome: '',
                    nif: '',
                    email: '',
                    telefone: '',
                    whatsapp: '',
                    password: '',
                    password_confirmation: '',
                    provincia: '',
                    municipio: '',
                    terms_accepted: true
                },
                authError: '',
                authErrorTimer: null,
                authLoading: false,
                loginToast: {
                    show: false,
                    title: '',
                    message: '',
                    type: 'success',
                    badge: 'Ativo',
                    timer: null,
                    progressKey: 0
                },
                showLoginToast(title, message, type = 'success', duration = 6000) {
                    return RachiToast.show(message, { title, type, duration });
                },
                closeLoginToast() {
                    if (this.loginToast.timer) {
                        clearTimeout(this.loginToast.timer);
                        this.loginToast.timer = null;
                    }
                    this.loginToast.show = false;
                },
                toggleTheme() {
                    if (typeof window.toggleRachiTheme === 'function') {
                        this.customerDarkMode = window.toggleRachiTheme();
                    } else {
                        const isDark = document.documentElement.classList.toggle('dark');
                        this.customerDarkMode = isDark;
                        localStorage.setItem('rachi_theme', isDark ? 'dark' : 'light');
                    }
                },
                init() {
                    this.restoreUserSession();
                    this.customerDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('rachi_theme') === 'dark';
                    window.addEventListener('rachi-theme-changed', (e) => {
                        this.customerDarkMode = e.detail && typeof e.detail.dark !== 'undefined' ? e.detail.dark : document.documentElement.classList.contains('dark');
                    });
                    this.$watch('authError', (val) => {
                        if (val) {
                            if (this.authErrorTimer) clearTimeout(this.authErrorTimer);
                            this.authErrorTimer = setTimeout(() => {
                                this.authError = '';
                                this.authErrorTimer = null;
                            }, 4500);
                        }
                    });

                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('login') === '1') {
                        this.loginModal = true;
                    }
                    if (window.location.hash) {
                        const targetId = window.location.hash.replace('#', '').toLowerCase();
                        if (['missao', 'visao', 'valores', 'identidade', 'missao-visao-valores'].includes(targetId)) {
                            this.identityModalOpen = true;
                        } else if (targetId) {
                            setTimeout(() => {
                                this.scrollToSection(targetId);
                            }, 300);
                        }
                    }
                    window.addEventListener('hashchange', () => {
                        const hash = window.location.hash.replace('#', '').toLowerCase();
                        if (['missao', 'visao', 'valores', 'identidade', 'missao-visao-valores'].includes(hash)) {
                            this.identityModalOpen = true;
                        }
                    });
                    window.openIdentityModal = () => { this.openIdentityModal(); };
                    window.closeIdentityModal = () => { this.closeIdentityModal(); };
                    this.$nextTick(() => lucide.createIcons());
                },

                async restoreUserSession() {
                    try {
                        this.currentUser = await window.RachiSession.session();
                        this.isLoggedIn = !!this.currentUser;
                        if (this.currentUser) this.loginModal = false;
                    } catch(e) {}
                },

                goToHome() {
                    this.solutionsOpen = false;
                    this.currentTab = 'home';
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    try {
                        if (window.location.hash) {
                            history.pushState(null, '', window.location.pathname + window.location.search);
                        }
                    } catch (e) {}
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                openIdentityModal() {
                    this.identityModalOpen = true;
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    if (this.solutionsOpen) this.solutionsOpen = false;
                },
                closeIdentityModal() {
                    this.identityModalOpen = false;
                },
                openStore() { window.location.href = '/loja'; },
                openUnitPage(unit) {
                    if (unit === 'academy') { window.location.href = '/academy'; return; }
                    if (unit === 'capital') { window.location.href = '/capital'; return; }
                    if (unit === 'tec') { window.location.href = '/tec'; return; }
                    if (unit === 'print') { window.location.href = '/print'; return; }
                    window.location.href = '/' + unit;
                },
                openContacto() { window.location.href = '/contacto'; },

                openProductModal(p) {
                    this.selectedStoreProduct = p;
                    this.productModalOpen = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                addToCartFromStore(p) {
                    this.cart.push({
                        id: Date.now(),
                        name: p.title || p.name,
                        category: p.category,
                        price: p.priceNum || parseFloat(String(p.price).replace(/[^0-9]/g, '')) || 10000,
                        image: p.image
                    });
                    this.cartDrawer = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                featuredIndex: 0,
                featuredProducts: [
                    {
                        id: 1,
                        slug: "hp-elitebook-x360-1040-g8",
                        name: "HP Elitebook x360 1040 G8 (2-in-1)",
                        title: "HP Elitebook x360 1040 G8 (2-in-1)",
                        category: "Laptops & Computadores",
                        price: "1.489.000,29 AOA",
                        priceNum: 1489000.29,
                        oldPrice: "1.650.000,00 AOA",
                        discountPercent: "-10% OFF",
                        badge: "Mais Vendido",
                        image: "/images/hp-elitebook-studio.png"
                    },
                    {
                        id: 2,
                        slug: "smartwatch-lige-executivo",
                        name: "Smartwatch Lige Executivo Pro",
                        title: "Smartwatch Lige Executivo Pro",
                        category: "Smartwatches & Wearables",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "15.000,00 AOA",
                        discountPercent: "-33% OFF",
                        badge: "Destaque",
                        image: "/images/smartwatch-studio.png"
                    },
                    {
                        id: 3,
                        slug: "cabo-console-rs232-db9-rj45",
                        name: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        title: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        category: "Cabos & Redes",
                        price: "16.989,89 AOA",
                        priceNum: 16989.89,
                        oldPrice: "18.000,00 AOA",
                        discountPercent: "-6% OFF",
                        badge: "Essencial TI",
                        image: "/images/cabo-console-studio.png"
                    },
                    {
                        id: 4,
                        slug: "tv-box-android-mxq-pro-4k",
                        name: "TV Box Android MXQ Pro 4K Ultra HD",
                        title: "TV Box Android MXQ Pro 4K Ultra HD",
                        category: "TV Box & Streaming",
                        price: "18.000,00 AOA",
                        priceNum: 18000.00,
                        oldPrice: "25.000,00 AOA",
                        discountPercent: "-28% OFF",
                        badge: "Promoção",
                        image: "/images/tvbox-studio.png"
                    }
                ],

                get visibleFeaturedProducts() {
                    const total = this.featuredProducts.length;
                    const maxStart = total - 3;
                    const start = Math.min(this.featuredIndex, Math.max(0, maxStart));
                    return this.featuredProducts.slice(start, start + 3);
                },

                nextFeaturedProduct() {
                    const maxIndex = this.featuredProducts.length - 3;
                    if (this.featuredIndex >= maxIndex) {
                        this.featuredIndex = 0;
                    } else {
                        this.featuredIndex++;
                    }
                    this.$nextTick(() => lucide.createIcons());
                },

                prevFeaturedProduct() {
                    const maxIndex = this.featuredProducts.length - 3;
                    if (this.featuredIndex <= 0) {
                        this.featuredIndex = Math.max(0, maxIndex);
                    } else {
                        this.featuredIndex--;
                    }
                    this.$nextTick(() => lucide.createIcons());
                },

                addToCartFromFeatured(p) {
                    this.cart.push({
                        id: Date.now(),
                        name: p.name,
                        category: p.category,
                        price: p.priceNum,
                        image: p.image
                    });
                    this.cartDrawer = true;
                    this.cartCheckoutStep = 'cart';
                    this.$nextTick(() => lucide.createIcons());
                },

                scrollToSection(id) {
                    if (id === 'academy') { window.location.href = '/academy'; return; }
                    if (id === 'capital' || id === 'tec' || id === 'print') { this.openUnitPage(id); return; }
                    if (id === 'contacto') { window.location.href = '/contacto'; return; }
                    this.currentTab = 'home';
                    this.solutionsOpen = false;
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;

                    if (id === 'home' || id === 'inicio' || !id) {
                        this.goToHome();
                        return;
                    }
                    try { window.history.pushState(null, '', '#' + id); } catch (e) {}
                    this.$nextTick(() => {
                        setTimeout(() => {
                            const el = document.getElementById(id);
                            if (el) {
                                const headerOffset = 75;
                                const elementPosition = el.getBoundingClientRect().top;
                                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                            }
                        }, 50);
                    });
                },

                cart: [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price || 0), 0);
                },

                removeFromCart(idx) {
                    this.cart.splice(idx, 1);
                },

                processCartCheckout() {
                    if (!this.currentUser) {
                        this.cartCheckoutStep = 'identity';
                        return;
                    }
                    this.submitProformaOrder();
                },

                submitProformaOrder() {
                    const clientName = this.currentUser ? this.currentUser.name : (this.checkoutForm.name || 'Cliente');
                    const clientEmail = this.currentUser ? this.currentUser.email : (this.checkoutForm.email || 'contacto@cliente.ao');

                    if (!this.currentUser && (!this.checkoutForm.name || !this.checkoutForm.email || !this.checkoutForm.phone)) {
                        RachiToast.warning('Por favor, preencha o Nome, E-mail e Telefone para emissão da Factura Proforma.');
                        return;
                    }

                    const proformaNumber = 'PRF-2026-' + Math.floor(10000 + Math.random() * 90000);
                    RachiToast.success('Factura Proforma ' + proformaNumber + ' gerada com sucesso para ' + clientName + '! Coordenadas de pagamento Multicaixa Express enviadas para ' + clientEmail + '.');
                    this.cart = [];
                    this.cartDrawer = false;
                    this.cartCheckoutStep = 'cart';

                    if (this.currentUser) {
                        setTimeout(() => {
                            window.location.href = '/portal#orders';
                        }, 1200);
                    }
                },

                async submitUnifiedLogin() {
                    this.authErrors.email = '';
                    this.authErrors.password = '';
                    this.authError = '';

                    const email = this.authForm.email.trim();
                    const password = this.authForm.password;

                    if (!email) {
                        this.authErrors.email = 'Por favor, introduza o seu endereço de e-mail.';
                        return;
                    }
                    if (!password) {
                        this.authErrors.password = 'Por favor, introduza a palavra-passe.';
                        return;
                    }

                    this.authLoading = true;
                    try {
                        this.currentUser = await RachiSession.login(email, password);
                        this.isLoggedIn = !!this.currentUser;
                        this.loginModal = false;
                        RachiToast.success('Sessão iniciada com sucesso. Bem-vindo(a), ' + (this.currentUser.name || 'Cliente') + '!');
                    } catch(e) {
                        this.authError = e.message || 'As credenciais fornecidas não conferem com os nossos registos.';
                    } finally {
                        this.authLoading = false;
                    }
                },

                async submitRegister() {
                    this.authError = '';
                    const f = this.registerForm;

                    if (!f.nome.trim()) {
                        this.authError = 'Por favor, introduza o seu nome completo ou nome da empresa.';
                        return;
                    }
                    if (!f.email.trim()) {
                        this.authError = 'Por favor, introduza um endereço de e-mail válido.';
                        return;
                    }
                    if (!f.password || f.password.length < 6) {
                        this.authError = 'A palavra-passe deve conter pelo menos 6 caracteres.';
                        return;
                    }
                    if (f.password !== f.password_confirmation) {
                        this.authError = 'A confirmação da palavra-passe não confere.';
                        return;
                    }
                    if (!f.terms_accepted) {
                        this.authError = 'Deverá aceitar os Termos de Uso e a Política de Privacidade (Lei 22/11).';
                        return;
                    }

                    this.authLoading = true;
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                        const payload = {
                            name: f.nome.trim(),
                            email: f.email.trim().toLowerCase(),
                            password: f.password,
                            password_confirmation: f.password_confirmation,
                            type: f.tipo_cliente === 'empresa' ? 'company' : 'individual',
                            document: f.nif ? f.nif.trim() : null,
                            phone: f.telefone ? f.telefone.trim() : null
                        };

                        const response = await fetch('/registro', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await response.json().catch(() => ({}));

                        if (response.ok && data.success) {
                            RachiToast.success('Conta criada com sucesso! A aceder ao seu portal...');
                            this.currentUser = data.user;
                            this.isLoggedIn = true;
                            this.loginModal = false;
                            setTimeout(() => {
                                window.location.href = data.redirect || '/portal';
                            }, 800);
                        } else {
                            let msg = data.message || 'Não foi possível concluir o registo. Verifique os dados.';
                            if (data.errors) {
                                msg = Object.values(data.errors).flat().join(' ');
                            }
                            this.authError = msg;
                        }
                    } catch(err) {
                        this.authError = 'Erro de ligação ao servidor. Tente novamente.';
                    } finally {
                        this.authLoading = false;
                    }
                },

                isAdminUser() {
                    if (!this.currentUser) return false;
                    const roleSlug = String(this.currentUser.role_slug || '').toLowerCase().trim();
                    const tipo = String(this.currentUser.tipo || '').toLowerCase().trim();
                    return ['admin', 'super_admin', 'super-admin'].includes(roleSlug) || tipo === 'admin';
                },

                isStudentUser() {
                    if (!this.currentUser) return false;
                    const roleSlug = String(this.currentUser.role_slug || '').toLowerCase().trim();
                    return roleSlug === 'student' || roleSlug === 'aluno' || this.currentUser.tipo === 'aluno';
                },

                isCustomerUser() {
                    if (!this.currentUser) return false;
                    return !this.isAdminUser();
                },

                canAccessStudentPortal() {
                    return this.isAdminUser() || !!(this.currentUser && (this.currentUser.has_matricula || this.currentUser.has_active_enrollment));
                },

                openAdminDashboard() {
                    this.userMenuDropdown = false;
                    if (!this.isAdminUser()) {
                        RachiToast.warning('Acesso Restrito: Apenas administradores podem aceder ao Painel Administrativo.');
                        return;
                    }
                    window.location.assign('/admin-dashboard');
                },

                openAcademyAluno() {
                    this.userMenuDropdown = false;
                    if (this.canAccessStudentPortal()) {
                        window.location.href = '/aluno-dashboard';
                    } else {
                        this.matriculaModalOpen = true;
                    }
                },

                async logout() {
                    await window.RachiSession.logout();
                }
            };
        }
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>