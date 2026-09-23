<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin-session-authenticated" content="{{ auth()->check() && auth()->user()->isAdmin() ? 'true' : 'false' }}">
    <title>RACHI — Soluções inteligentes</title>
    <meta name="description" content="RACHI — soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                    colors: {
                        rachiNavy: '#071326',
                        rachiNavyLight: '#0d1f3d',
                        rachiGold: '#f5a800',
                        rachiGoldDark: '#d59b2d',
                        rachiBlue: '#00a3e0',
                        rachiBlueDark: '#0b4ea8',
                        rachiAccent: '#4ea2ff',
                        rachiDarkText: '#0b1a2e',
                    }
                }
            }
        }
    </script>
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
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }

        .site-header.header-top-dark .logo-light {
            display: block !important;
        }

        .site-header.header-top-dark .logo-dark {
            display: none !important;
        }

        /* Dark Nav Capsule */
        .site-header.header-top-dark .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.18rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            padding: 0.25rem 0.45rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        @media (min-width: 1280px) {
            .site-header.header-top-dark .main-nav-capsule {
                gap: 0.3rem;
                padding: 0.3rem 0.55rem;
            }
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.79rem;
            font-weight: 500;
            letter-spacing: 0.015em;
            color: rgba(255, 255, 255, 0.82) !important;
            padding: 0.38rem 0.72rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 1280px) {
            .site-header.header-top-dark .main-nav-capsule .nav-link {
                font-size: 0.835rem;
                padding: 0.42rem 0.95rem !important;
            }
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link:hover,
        .site-header.header-top-dark .main-nav-capsule .nav-link.nav-link-open {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12);
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 2px 14px rgba(0, 163, 224, 0.45);
            font-weight: 600;
        }

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

        .site-header.header-top-dark .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            border-color: #00a3e0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(0, 163, 224, 0.45);
        }

        .site-header.header-top-dark .mobile-menu-btn {
            display: inline-flex;
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

        .site-header.header-top-dark .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(0, 163, 224, 0.5) !important;
            color: #00a3e0 !important;
        }

        /* ------------------------------------------------------------ */
        /* STATE 2: SCROLLED DOWN (LIGHT / WHITE GLASS - KLASSE.AO STYLE)*/
        /* ------------------------------------------------------------ */
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.03) !important;
        }

        .site-header.header-scrolled-light .logo-light {
            display: none !important;
        }

        .site-header.header-scrolled-light .logo-dark {
            display: block !important;
        }

        /* Light Nav Capsule */
        .site-header.header-scrolled-light .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.18rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px;
            padding: 0.25rem 0.45rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        @media (min-width: 1280px) {
            .site-header.header-scrolled-light .main-nav-capsule {
                gap: 0.3rem;
                padding: 0.3rem 0.55rem;
            }
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.79rem;
            font-weight: 600;
            letter-spacing: 0.015em;
            color: #0b1a2e !important;
            padding: 0.38rem 0.72rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (min-width: 1280px) {
            .site-header.header-scrolled-light .main-nav-capsule .nav-link {
                font-size: 0.835rem;
                padding: 0.42rem 0.95rem !important;
            }
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
            font-weight: 700;
        }

        .site-header.header-scrolled-light .nav-link svg {
            color: #475569;
        }

        /* Light Dropdowns */
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }

        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }

        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }

        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }

        .site-header.header-scrolled-light .header-dropdown .dropdown-desc {
            color: #64748b !important;
        }

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

        .site-header.header-scrolled-light .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #0092c8 0%, #0065a5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.45);
        }

        .site-header.header-scrolled-light .mobile-menu-btn {
            display: inline-flex;
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

        /* Hero styling matching hom.rachi.ao & screenshot with Dual Theme (Light & Dark) */
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
            display: flex;
            flex-direction: column;
            gap: 0.08em;
            margin: 0;
            color: #071326;
            font-size: clamp(1.65rem, 3.1vw, 2.65rem);
            font-weight: 850;
            letter-spacing: -0.028em;
            line-height: 1.08;
            text-transform: uppercase;
            position: relative;
            z-index: 12;
            transition: color 0.4s ease;
        }

        html.dark .hero-home .hero-title {
            color: #ffffff;
        }

        .hero-title-line {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        /* Gold Gradient & Shimmer for ECOSSISTEMA */
        .hero-highlight--gold {
            display: inline-block;
            background: linear-gradient(115deg, #f59e0b 0%, #fbbf24 25%, #fef08a 50%, #fbbf24 75%, #d97706 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 10px rgba(245, 158, 11, 0.4));
            animation: textGradientShift 7s ease infinite;
            position: relative;
            cursor: default;
            transition: filter 0.3s ease, transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-highlight--gold:hover {
            transform: translateY(-2px) scale(1.02);
            filter: drop-shadow(0 4px 22px rgba(245, 158, 11, 0.65));
        }

        /* Blue Gradient & Shimmer for INTELIGENTES */
        .hero-highlight--blue {
            display: inline-block;
            background: linear-gradient(115deg, #0284c7 0%, #00a3e0 25%, #38bdf8 50%, #00a3e0 75%, #0369a1 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 10px rgba(0, 163, 224, 0.4));
            animation: textGradientShift 7s ease infinite 2.5s;
            position: relative;
            cursor: default;
            transition: filter 0.3s ease, transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .hero-highlight--blue:hover {
            transform: translateY(-2px) scale(1.02);
            filter: drop-shadow(0 4px 22px rgba(0, 163, 224, 0.65));
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

        html.dark .hero-visual {
            filter: drop-shadow(0 25px 35px rgba(0, 0, 0, 0.85));
        }

        html.dark .hero-visual-wrap:hover .hero-visual {
            filter: drop-shadow(0 30px 45px rgba(0, 0, 0, 0.95));
        }

        /* Video Link Overlay - Conheça a RACHI (Dual Theme) */
        .hero-video-link {
            position: absolute;
            right: 1.5rem;
            bottom: 2.2rem;
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
            background: rgba(8, 24, 52, 0.88) !important;
            border: 1px solid rgba(56, 189, 248, 0.45) !important;
            color: #ffffff !important;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.6), 0 0 24px rgba(0, 163, 224, 0.25) !important;
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

        @media (max-width: 575.98px) {
            .hero-home {
                padding-top: 2.2rem;
            }

            .hero-visual-wrap {
                margin-top: -1rem;
                width: 100%;
            }

            .hero-home .hero-title {
                font-size: clamp(1.35rem, 6.2vw, 1.75rem);
            }

            .hero-pillars-quick {
                gap: 0.3rem;
            }

            .hero-ecosystem-cta {
                width: 100%;
                min-width: 0;
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
            background: radial-gradient(circle at center, rgba(16, 185, 129, 0.15) 0%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(1) img {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.35)) drop-shadow(0 0 18px rgba(16, 185, 129, 0.4)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(2) .h-28 {
            background: radial-gradient(circle at center, rgba(99, 102, 241, 0.18) 0%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(2) img {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.35)) drop-shadow(0 0 18px rgba(99, 102, 241, 0.4)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(3) .h-28 {
            background: radial-gradient(circle at center, rgba(0, 163, 224, 0.18) 0%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(3) img {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.35)) drop-shadow(0 0 18px rgba(0, 163, 224, 0.4)) !important;
        }

        html.dark #solucoes .grid > div:nth-child(4) .h-28 {
            background: radial-gradient(circle at center, rgba(245, 168, 0, 0.18) 0%, transparent 72%) !important;
        }
        html.dark #solucoes .grid > div:nth-child(4) img {
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.35)) drop-shadow(0 0 18px rgba(245, 168, 0, 0.4)) !important;
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
    <link rel="stylesheet" href="/css/site.css?v={{ time() }}">
</head>

<body x-data="rachiApp()" class="min-h-screen flex flex-col justify-between">



    <!-- ============================================================== -->
    <!-- VIEW 1: PUBLIC PORTAL (EXACT CLONE OF https://hom.rachi.ao/)   -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'public'">

        <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4 lg:py-4.5 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 lg:gap-4 xl:gap-6">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="flex-shrink-0 flex items-center justify-start z-10">
                    <a href="#home" @click.prevent="goToHome()"
                        class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
                        <!-- Light Logo (for dark header at top) -->
                        <img src="/images/logo-rachi-light.png"
                            onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'"
                            alt="RACHI"
                            class="brand-logo-img logo-light filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.3)] transition-all">
                        <!-- Dark Logo (for light header when scrolled) -->
                        <img src="/images/logo-rachi-dark.png"
                            onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI"
                            class="brand-logo-img logo-dark filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.2)] transition-all">
                    </a>
                </div>

                <!-- Coluna 2 (Centro): Navegação em Cápsula (Centralizada e Protegida) -->
                <div class="flex-1 hidden lg:flex items-center justify-center min-w-0 px-2 xl:px-4">
                    <nav class="flex items-center main-nav-capsule">
                        <a href="#home" @click.prevent="goToHome()" class="nav-link cursor-pointer"
                            :class="currentTab === 'home' ? 'active' : ''">
                            <span>Home</span>
                        </a>

                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseover="open = true" @click="open = !open"
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
                            class="header-dropdown absolute top-full left-0 mt-3 w-56 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2 z-50 text-sm space-y-1">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                            <a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false"
                                class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span
                                    class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Depoimentos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (4 Unidades) -->
                    <div class="relative" x-data="{ openSol: false }" @mouseleave="openSol = false">
                        <button @mouseover="openSol = true" @click="openSol = !openSol"
                            class="nav-link flex items-center gap-1.5 focus:outline-none"
                            :class="['capital','academy','tec','print'].includes(currentTab) || openSol ? 'active' : ''">
                            <span>Soluções</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" class="opacity-70 transition-transform duration-200"
                                :class="openSol ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="openSol" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="header-dropdown absolute top-full left-0 mt-3 w-80 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2.5 z-50 text-sm space-y-1.5">

                            <a href="/capital" @click="openSol = false"
                                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-emerald-500/15 text-slate-300 hover:text-emerald-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center font-black text-xs">
                                        01
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Human Capital</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Pessoas &amp; Gestão</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right"
                                    class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/academy" @click="openSol = false"
                                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-indigo-500/15 text-slate-300 hover:text-indigo-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center font-black text-xs">
                                        02
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Academy</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Capacitação &amp; Ensino
                                        </div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right"
                                    class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/tec" @click="openSol = false"
                                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-sky-500/15 text-slate-300 hover:text-sky-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center font-black text-xs">
                                        03
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Tec</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Tecnologia &amp; TI</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right"
                                    class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/print" @click="openSol = false"
                                class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-amber-500/15 text-slate-300 hover:text-amber-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center font-black text-xs">
                                        04
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Print</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Gráfica &amp; Produção
                                        </div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right"
                                    class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                        </div>
                    </div>

                    <a href="#etica" @click.prevent="scrollToSection('etica')" class="nav-link"
                        :class="currentTab === 'etica' ? 'active' : ''">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="/loja" class="nav-link">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" class="nav-link">
                        <span>Contacto</span>
                    </a>
                </nav>
                </div>

                <!-- Coluna 3 (Direita): Autenticação, Perfil e Ações Rápidas -->
                <div class="flex-shrink-0 flex items-center justify-end gap-2 sm:gap-3 z-10">
                    <!-- Botão Padronizado de Alternância de Tema (Dark / Light Mode) -->
                    <button type="button"
                        onclick="window.toggleRachiTheme()"
                        class="theme-toggle-btn flex-shrink-0"
                        aria-label="Alternar Modo Escuro / Claro"
                        title="Alternar Modo Escuro / Claro">
                        <!-- Lua (Visível no modo claro -> ao clicar ativa escuro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-700 hover:text-slate-900 dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sol (Visível no modo escuro -> ao clicar ativa claro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>

                    <!-- Entrar / Perfil do Usuário Autenticado -->
                    <template x-if="!currentUser">
                        <button @click="loginModal = true; authTab = 'login'; authError = ''" class="btn-entrar-nav group">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                                class="group-hover:translate-x-0.5 transition-transform">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            <span>ENTRAR</span>
                        </button>
                    </template>

                    <template x-if="currentUser">
                        <div class="relative" x-data="{ userMenuDropdown: false }" @click.away="userMenuDropdown = false">
                            <button @click="userMenuDropdown = !userMenuDropdown"
                                class="flex items-center gap-2 sm:gap-2.5 py-1.5 pl-2 pr-3 sm:pr-3.5 rounded-full bg-white hover:bg-slate-50 dark:bg-slate-900/85 dark:hover:bg-slate-800/90 border border-slate-200/90 dark:border-slate-700/80 hover:border-[#0050f0]/40 dark:hover:border-amber-400/80 text-slate-800 dark:text-white transition-all shadow-sm hover:shadow-md cursor-pointer group">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-xs flex items-center justify-center shadow-xs shrink-0"
                                     x-text="currentUser.avatar || 'U'"></div>
                                <div class="text-left hidden sm:block">
                                    <div class="text-xs font-bold leading-tight max-w-[110px] xl:max-w-[145px] truncate text-slate-800 dark:text-slate-100 group-hover:text-[#0050f0] dark:group-hover:text-amber-300 transition" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-amber-600 dark:text-amber-400 font-semibold leading-none truncate max-w-[110px] xl:max-w-[145px]" x-text="currentUser.roleLabel || 'Autenticado'"></div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-transform duration-200 shrink-0" :class="userMenuDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Menu Dropdown com Permissões -->
                            <div x-show="userMenuDropdown" x-cloak
                                 class="absolute right-0 mt-2 w-64 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700 shadow-2xl py-2 z-50 text-xs text-slate-800 dark:text-white transition-colors">
                                <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
                                    <div class="font-bold text-slate-900 dark:text-slate-100 truncate" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 truncate" x-text="currentUser.email"></div>
                                </div>

                                <div class="p-1 space-y-0.5">
                                    <!-- Permissão 1: Área do Cliente -->
                                    <button @click="currentView = 'customer'; customerTab = 'dashboard'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <svg class="w-4 h-4 text-[#0050f0] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        <span>Painel do Cliente</span>
                                    </button>

                                    <!-- Permissão 2: Solicitar Produtos & Serviços -->
                                    <button @click="currentView = 'customer'; customerTab = 'new_request'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <svg class="w-4 h-4 text-[#0050f0] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Solicitar Produtos / Serviços</span>
                                    </button>

                                    <!-- Permissão 2.5: Loja Online Integrada (Sessão Sincronizada) -->
                                    <a href="/loja"
                                       class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                            <span>Loja</span>
                                        </div>
                                        <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-blue-600 border border-blue-200 dark:bg-blue-500/20 dark:text-blue-400 font-bold">Conectado</span>
                                    </a>

                                    <!-- Permissão 3: Academy (Perfil de Aluno) com validação de matrícula -->
                                    <button @click="openAcademyAluno(); userMenuDropdown = false"
                                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                            <span>Perfil Aluno (Academy)</span>
                                        </div>
                                        <template x-if="currentUser && currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-500/20 dark:text-emerald-400 font-bold">Ativa</span>
                                        </template>
                                        <template x-if="!currentUser || !currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200 dark:bg-amber-500/20 dark:text-amber-400 font-bold">Bloqueado</span>
                                        </template>
                                    </button>

                                    <!-- Se for Admin: Atalho para Admin Dashboard -->
                                    <template x-if="currentUser && (currentUser.role === 'admin' || currentUser.role === 'super_admin' || currentUser.role_slug === 'super_admin' || currentUser.tipo === 'admin')">
                                        <a href="/admin-dashboard" @click="openAdminDashboard()"
                                           class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-amber-700 dark:text-amber-300 hover:text-amber-900 font-semibold transition">
                                            <svg class="w-4 h-4 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span>Painel Administrativo</span>
                                        </a>
                                    </template>

                                    <!-- Logout -->
                                    <div class="pt-1 mt-1 border-t border-slate-100 dark:border-slate-800">
                                        <button @click="logout(); userMenuDropdown = false"
                                                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10 text-left text-rose-600 dark:text-rose-400 transition font-medium cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            <span>Terminar Sessão (Sair)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

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
                <a href="#home" @click.prevent="goToHome()"
                    class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Sobre Nós</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="#sobre" @click.prevent="scrollToSection('sobre')"
                            class="block text-sm text-slate-400 hover:text-white">Quem somos</a>
                        <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos')"
                            class="block text-sm text-slate-400 hover:text-white">O que fazemos</a>
                        <a href="#parceiros" @click.prevent="scrollToSection('parceiros')"
                            class="block text-sm text-slate-400 hover:text-white">Parceiros</a>
                        <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos')"
                            class="block text-sm text-slate-400 hover:text-white">Depoimentos</a>
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
                    <a href="#etica" @click.prevent="scrollToSection('etica')"
                        class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="/loja" class="block font-medium py-1 hover:text-[#00a3e0]">Loja</a>
                    <a href="/contacto" class="block font-medium py-1 hover:text-[#00a3e0]">Contacto</a>
                </div>
            </div>
        </header>

        <!-- Script de Rolagem Inteligente (Estilo Klasse.ao): Adaptável ao Tema -->
        <script>
                (function () {
                    function updateHeaderScroll() {
                        var header = document.getElementById('main-site-header') || document.querySelector('.site-header');
                        if (!header) return;
                        var isDark = document.documentElement.classList.contains('dark');
                        if (isDark) {
                            header.classList.remove('header-scrolled-light');
                            header.classList.add('header-top-dark');
                            return;
                        }
                        // No modo claro: o cabeçalho adapta-se perfeitamente ao fundo claro com visual cristalino
                        header.classList.remove('header-top-dark');
                        header.classList.add('header-scrolled-light');
                    }
                    window.addEventListener('scroll', updateHeaderScroll, { passive: true });
                    window.addEventListener('DOMContentLoaded', updateHeaderScroll);
                    window.addEventListener('rachi-theme-changed', updateHeaderScroll);
                    updateHeaderScroll();
                })();
        </script>

        <!-- SUB-PAGE: HOME -->
        <div x-show="currentTab === 'home'">
            <!-- HERO SECTION EXACT MATCH TO PRINT & HOM.RACHI.AO -->
            <section id="home" class="hero hero-home">
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
                        <picture>
                            <source srcset="/images/hero-home-ecosystem.png" type="image/png">
                            <img class="hero-visual"
                                src="/images/hero-home-ecosystem.png"
                                alt="Profissionais RACHI junto ao símbolo da marca" width="1600" height="975"
                                fetchpriority="high" decoding="async">
                        </picture>

                        <a class="hero-video-link" href="#sobre" @click.prevent="scrollToSection('sobre')"
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
                        <button class="hero-identity-link" type="button" @click="identityModalOpen = true"
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
                                <button @click="identityModalOpen = true"
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
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-100 dark:border-slate-800">
                                <img src="https://hom.rachi.ao/assets/img/about-team.png"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/about-team.webp'"
                                    alt="Equipa RACHI — pessoas, processos e tecnologia"
                                    class="w-full h-auto object-cover dark:hidden">
                                <img src="/images/about-team-dark.jpg"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/about-team.png'"
                                    alt="Equipa RACHI — pessoas, processos e tecnologia"
                                    class="w-full h-auto object-cover hidden dark:block">
                                <div
                                    class="absolute bottom-4 left-4 right-4 bg-slate-900/90 backdrop-blur-md text-white text-xs font-bold py-2.5 px-4 rounded-xl flex items-center justify-between border border-white/10">
                                    <span class="tracking-wider uppercase text-amber-400">Pessoas • Processos •
                                        Tecnologia</span>
                                    <span class="text-slate-300">Luanda, Angola</span>
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
                        class="grid grid-cols-3 gap-4 mt-12 py-8 px-6 bg-[#071326] text-white rounded-2xl shadow-xl text-center">
                        <div>
                            <div class="text-3xl md:text-5xl font-black text-amber-400">04</div>
                            <div class="text-xs md:text-sm text-slate-300 font-medium mt-1 uppercase tracking-wider">
                                Áreas de actuação</div>
                        </div>
                        <div class="border-x border-slate-700/80">
                            <div class="text-3xl md:text-5xl font-black text-cyan-400">100%</div>
                            <div class="text-xs md:text-sm text-slate-300 font-medium mt-1 uppercase tracking-wider">
                                Foco em resultados</div>
                        </div>
                        <div>
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
                                <img src="https://hom.rachi.ao/assets/img/what-we-do-team.png"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.webp'"
                                    alt="Profissionais RACHI a desenvolver soluções integradas"
                                    class="w-full h-auto object-cover dark:hidden">
                                <img src="/images/what-we-do-team-dark.jpg"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.png'"
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
                                            <div
                                                class="w-10 h-10 sm:w-12 sm:h-12 mb-1 flex items-center justify-center">
                                                <svg viewBox="0 0 60 60" fill="none"
                                                    class="w-9 h-9 sm:w-11 sm:h-11 drop-shadow">
                                                    <path
                                                        d="M14 10H32C39.732 10 46 16.268 46 24C46 31.732 39.732 38 32 38H24V50H14V10Z"
                                                        fill="url(#rachiHubGrad)" />
                                                    <path d="M30 36L44 50H32L22 38H30Z" fill="#eba72d" />
                                                    <circle cx="28" cy="24" r="6" fill="#071326" />
                                                    <defs>
                                                        <linearGradient id="rachiHubGrad" x1="14" y1="10" x2="46"
                                                            y2="38" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#00a3e0" />
                                                            <stop offset="1" stop-color="#eba72d" />
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
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
                                        02
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

                        <!-- Right Column: Stacked High-End Partner Cards (lg:col-span-7) -->
                        <div class="lg:col-span-7 space-y-6">
                            
                            <!-- CARD 1: INOV QUIMUA -->
                            <article class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 hover:border-[#00a3e0]/60 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                                <!-- Left Accent Border Strip -->
                                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-[#00a3e0] to-[#0b4ea8]"></div>

                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 sm:gap-6 pl-2">
                                    <!-- Partner Logo Container -->
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-center p-3 shrink-0 group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
                                        <img src="/images/inov-quimua-clean.png"
                                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/uploads/parceiros/whatsapp-image-2026-08-10-at-16-42-34-1-39cfc040.jpg?v=1786648331'"
                                             alt="INOV QUIMUA" 
                                             class="max-h-14 max-w-full object-contain dark:hidden"
                                             loading="lazy">
                                        <img src="/images/inov-quimua-dark.png"
                                             onerror="this.onerror=null; this.src='/images/inov-quimua-clean.png'"
                                             alt="INOV QUIMUA" 
                                             class="max-h-14 max-w-full object-contain hidden dark:block"
                                             loading="lazy">
                                    </div>

                                    <!-- Card Body -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Top Tag & Index -->
                                        <div class="flex items-center justify-between gap-2 mb-1.5">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#00a3e0]"></span>
                                                Consultoria &amp; Liderança
                                            </span>
                                            <span class="text-xs font-black text-slate-300 tracking-widest">01</span>
                                        </div>

                                        <!-- Partner Name -->
                                        <h3 class="text-xl font-[850] text-[#071326] group-hover:text-[#0077c2] transition-colors flex items-center gap-2">
                                            INOV QUIMUA
                                            <svg class="w-4 h-4 text-blue-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </h3>

                                        <!-- Description -->
                                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mt-1.5">
                                            Empresa de consultoria em Angola liderada por Pedro Ivanov, amplamente reconhecida pela organização de fóruns corporativos de alto nível como o conceituado <strong class="text-slate-800 font-semibold">Cacuaco Business &amp; Leadership Summit</strong>.
                                        </p>

                                        <!-- Bottom Row: Tags & Link -->
                                        <div class="mt-4 pt-3.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                                            <div class="flex flex-wrap gap-1.5">
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Consultoria</span>
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Liderança</span>
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Cimeiras</span>
                                            </div>
                                            <a href="https://ticket.ao/author/inov-quimua-consultoria/" target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1.5 text-xs font-bold text-[#00a3e0] hover:text-[#0b4ea8] transition-colors group/link"
                                               title="Visitar website da Inov Quimua">
                                                <span>Visitar site</span>
                                                <span class="transform group-hover/link:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- CARD 2: HELTON PLUS -->
                            <article class="group relative bg-white rounded-2xl sm:rounded-3xl p-6 sm:p-7 border border-slate-200/90 hover:border-amber-500/60 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                                <!-- Left Accent Border Strip -->
                                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-gradient-to-b from-[#f5a800] to-amber-600"></div>

                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 sm:gap-6 pl-2">
                                    <!-- Partner Logo Container -->
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-center p-3 shrink-0 group-hover:scale-105 group-hover:shadow-md transition-all duration-300">
                                        <img src="/images/helton-plus-clean.png"
                                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/uploads/parceiros/whatsapp-image-2026-08-10-at-16-42-35-32d82eaa.jpg?v=1786648596'"
                                             alt="HELTON PLUS" 
                                             class="max-h-14 max-w-full object-contain dark:hidden"
                                             loading="lazy">
                                        <img src="/images/helton-plus-dark.png"
                                             onerror="this.onerror=null; this.src='/images/helton-plus-clean.png'"
                                             alt="HELTON PLUS" 
                                             class="max-h-14 max-w-full object-contain hidden dark:block"
                                             loading="lazy">
                                    </div>

                                    <!-- Card Body -->
                                    <div class="flex-1 min-w-0">
                                        <!-- Top Tag & Index -->
                                        <div class="flex items-center justify-between gap-2 mb-1.5">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200/70">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Soluções Ambientais
                                            </span>
                                            <span class="text-xs font-black text-slate-300 tracking-widest">02</span>
                                        </div>

                                        <!-- Partner Name -->
                                        <h3 class="text-xl font-[850] text-[#071326] group-hover:text-amber-600 transition-colors flex items-center gap-2">
                                            HELTON PLUS
                                            <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </h3>

                                        <!-- Description -->
                                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mt-1.5">
                                            Líder consolidada em soluções de higienização profissional e controlo de pragas, mantendo compromisso rigoroso com a saúde corporativa e a conformidade ambiental de ambientes corporativos e industriais.
                                        </p>

                                        <!-- Bottom Row: Tags & Link -->
                                        <div class="mt-4 pt-3.5 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                                            <div class="flex flex-wrap gap-1.5">
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Saúde Ambiental</span>
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Higienização</span>
                                                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 text-[11px] font-medium">Certificações</span>
                                            </div>
                                            <a href="https://heltonplus.ao/" target="_blank" rel="noopener noreferrer"
                                               class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-600 hover:text-amber-700 transition-colors group/link"
                                               title="Visitar website da Helton Plus">
                                                <span>Visitar site</span>
                                                <span class="transform group-hover/link:translate-x-1 transition-transform" aria-hidden="true">&rarr;</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                        </div>

                    </div>
                </div>
            </section>

            <!-- ========================================================= -->
            <!-- SECTION: DEPOIMENTOS                                     -->
            <!-- ========================================================= -->
            <section id="depoimentos" class="py-20 bg-slate-50 border-t border-slate-200"
                aria-labelledby="testimonials-title">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0]">Confiança
                            Conquistada</span>
                        <h2 id="testimonials-title"
                            class="text-3xl md:text-4xl font-[850] text-[#071326] mt-2 uppercase">
                            O que dizem quem trabalha connosco
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
                            Ecossistema de Soluções
                        </span>
                        <h2
                            class="text-3xl sm:text-4xl lg:text-5xl font-[900] text-[#071326] mt-4 uppercase tracking-tight">
                            Soluções integradas para o seu crescimento
                        </h2>
                        <div class="w-20 h-1 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full mx-auto my-4">
                        </div>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Quatro áreas de actuação que unem pessoas, tecnologia, formação e comunicação num único
                            parceiro de excelência.
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
                                        <source srcset="/images/areas/rachi-human-capital.webp" type="image/webp">
                                        <img src="/images/areas/rachi-human-capital.png"
                                            onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-human-capital.png'"
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

                            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center gap-2">
                                <a href="/capital"
                                    class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-1.5">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                                <button @click="openRequestWithPreselection(4, 'Consultoria Empresarial & RH')"
                                    class="py-3 px-3 rounded-xl border border-slate-200 hover:border-slate-800 text-slate-700 font-bold text-xs transition"
                                    title="Pedir proposta">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                </button>
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
                                        <source srcset="/images/areas/rachi-academy.webp" type="image/webp">
                                        <img src="/images/areas/rachi-academy.png"
                                            onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-academy.png'"
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
                                        <span>Treinamento Corporativo In-Company</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center gap-2">
                                <a href="/academy"
                                    class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-indigo-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-1.5">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                                <button @click="openRequestWithPreselection(3, 'Formação e Cursos Corporativos')"
                                    class="py-3 px-3 rounded-xl border border-slate-200 hover:border-slate-800 text-slate-700 font-bold text-xs transition"
                                    title="Pedir formação">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </button>
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
                                        <source srcset="/images/areas/rachi-tec.webp" type="image/webp">
                                        <img src="/images/areas/rachi-tec.png"
                                            onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-tec.png'"
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

                            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center gap-2">
                                <a href="/tec"
                                    class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-sky-600 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-1.5">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                                <button @click="openRequestWithPreselection(1, 'Projecto de Tecnologia & TI')"
                                    class="py-3 px-3 rounded-xl border border-slate-200 hover:border-slate-800 text-slate-700 font-bold text-xs transition"
                                    title="Pedir orçamento">
                                    <i data-lucide="cpu" class="w-4 h-4"></i>
                                </button>
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
                                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                                        <img src="/images/areas/rachi-print.png"
                                            onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'"
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

                            <div class="mt-8 pt-5 border-t border-slate-100 flex items-center gap-2">
                                <a href="/print"
                                    class="flex-1 py-3 px-3 rounded-xl bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white font-bold text-xs text-center transition duration-200 shadow-sm flex items-center justify-center gap-1.5">
                                    <span>Saber mais</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                                <button @click="openRequestWithPreselection(2, 'Produção Gráfica & Brindes')"
                                    class="py-3 px-3 rounded-xl border border-slate-200 hover:border-slate-800 text-slate-700 font-bold text-xs transition"
                                    title="Pedir proposta gráfica">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </button>
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
                    style="background-image: url('https://hom.rachi.ao/assets/img/ethics-governance.webp')"></div>
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

                    <div
                        class="mt-12 p-8 rounded-2xl bg-slate-800/60 border border-slate-700 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <h4 class="text-xl font-bold text-white">Serviços com rigor e total conformidade</h4>
                            <p class="text-sm text-slate-300 mt-1 max-w-xl">
                                Conheça os nossos manuais de conformidade, políticas de privacidade e código de conduta
                                empresarial.
                            </p>
                        </div>
                        <a href="/contacto"
                            class="px-6 py-3 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition whitespace-nowrap">
                            Solicitar Documento &rarr;
                        </a>
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
                            <!-- Controles para passar/deslizar produtos -->
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
            <div x-show="identityModalOpen" x-cloak
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4">
                <div @click.away="identityModalOpen = false"
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
                    <button @click="identityModalOpen = false"
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
                        <button @click="identityModalOpen = false"
                            class="px-8 py-3 rounded-full bg-slate-800/90 hover:bg-slate-700/90 border border-slate-700 hover:border-sky-400/50 text-slate-200 hover:text-white font-bold text-xs uppercase tracking-widest transition-all duration-200 shadow-lg hover:shadow-sky-500/20 hover:-translate-y-0.5 inline-flex items-center gap-2">
                            <span>Fechar Janela</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <!-- SUB-PAGE: RACHI TEC (TECNOLOGIA & DIGITALIZAÇÃO) -->
        <div x-show="currentTab === 'tec'" x-cloak class="min-h-screen bg-slate-50">
            <!-- Hero Banner -->
            <section
                class="bg-[#071326] text-white pt-12 pb-16 px-6 lg:px-12 border-b border-slate-800 relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-900/30 via-transparent to-cyan-900/20 pointer-events-none">
                </div>
                <div class="max-w-7xl mx-auto relative z-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                        <a href="#home" @click.prevent="goToHome()"
                            class="hover:text-white transition cursor-pointer">Início</a>
                        <span>/</span>
                        <span class="text-slate-500">Soluções</span>
                        <span>/</span>
                        <span class="text-[#00a3e0] font-semibold">RACHI Tec — Loja de TI</span>
                    </nav>

                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                        <div class="max-w-3xl">
                            <span
                                class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60 inline-flex items-center gap-2">
                                <i data-lucide="shopping-bag" class="w-3.5 h-3.5 text-blue-400"></i>
                                Loja Oficial de Informática &amp; Hardware
                            </span>
                            <h1 class="text-3xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
                                Produtos de TI, Periféricos &amp; <span class="text-[#00a3e0]">Tecnologia</span>
                            </h1>
                            <p class="text-slate-300 text-base md:text-lg mt-3 leading-relaxed">
                                Ratos, TV Box 4K, computadores, cabos de rede, adaptadores e gadgets certificados.
                                Pronta entrega em Luanda e faturação formal com NIF para empresas.
                            </p>

                            <!-- Search Bar -->
                            <div class="mt-8 max-w-2xl">
                                <div
                                    class="relative flex items-center bg-white rounded-2xl p-1.5 shadow-2xl border border-slate-200">
                                    <span class="pl-3 text-slate-400">
                                        <i data-lucide="search" class="w-5 h-5"></i>
                                    </span>
                                    <input type="search" x-model="storeSearchQuery"
                                        placeholder="Pesquisar mouse, tv box, cabo, laptop..."
                                        class="w-full px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent focus:outline-none">
                                    <button @click="$nextTick(() => lucide.createIcons())"
                                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition whitespace-nowrap">
                                        Pesquisar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Store Quick Highlights -->
                        <div
                            class="lg:w-80 bg-slate-800/80 border border-slate-700/80 p-6 rounded-3xl backdrop-blur-md">
                            <h4
                                class="text-xs uppercase font-black text-amber-400 tracking-wider mb-4 flex items-center gap-2">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i> Garantia RACHI Tec
                            </h4>
                            <ul class="space-y-3 text-xs text-slate-300">
                                <li class="flex items-center gap-2.5">
                                    <i data-lucide="truck" class="w-4 h-4 text-blue-400 shrink-0"></i>
                                    <span>Entrega expressa em Luanda</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i data-lucide="file-text" class="w-4 h-4 text-amber-400 shrink-0"></i>
                                    <span>Fatura proforma e comercial com NIF</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i data-lucide="shield" class="w-4 h-4 text-emerald-400 shrink-0"></i>
                                    <span>Garantia de 6 a 12 meses em hardware</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <i data-lucide="credit-card" class="w-4 h-4 text-purple-400 shrink-0"></i>
                                    <span>Multicaixa Express &amp; TPA</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Store Catalog -->
            <section class="py-16 max-w-7xl mx-auto px-6 lg:px-12">
                <!-- Category Tabs & Sorting Filter -->
                <div
                    class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 pb-6 border-b border-slate-200">
                    <!-- Category Buttons -->
                    <div class="flex flex-wrap items-center gap-2">
                        <button @click="storeCategory = 'todas'; $nextTick(() => lucide.createIcons())"
                            :class="storeCategory === 'todas' ? 'bg-[#071326] text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition">
                            Todos os Produtos
                        </button>
                        <button @click="storeCategory = 'perifericos'; $nextTick(() => lucide.createIcons())"
                            :class="storeCategory === 'perifericos' ? 'bg-[#071326] text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="mouse" class="w-3.5 h-3.5"></i> Periféricos &amp; Mouses
                        </button>
                        <button @click="storeCategory = 'streaming'; $nextTick(() => lucide.createIcons())"
                            :class="storeCategory === 'streaming' ? 'bg-[#071326] text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="tv" class="w-3.5 h-3.5"></i> TV Box &amp; Streaming
                        </button>
                        <button @click="storeCategory = 'cabos'; $nextTick(() => lucide.createIcons())"
                            :class="storeCategory === 'cabos' ? 'bg-[#071326] text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="cable" class="w-3.5 h-3.5"></i> Cabos &amp; Redes
                        </button>
                        <button @click="storeCategory = 'computadores'; $nextTick(() => lucide.createIcons())"
                            :class="storeCategory === 'computadores' ? 'bg-[#071326] text-white shadow-md' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200'"
                            class="px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-1.5">
                            <i data-lucide="laptop" class="w-3.5 h-3.5"></i> Computadores
                        </button>
                    </div>

                    <!-- Sorting -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs text-slate-500 font-semibold">Ordenar por:</span>
                        <select x-model="storeSort"
                            class="bg-white border border-slate-300 rounded-xl px-3 py-2 text-xs font-semibold text-slate-700 focus:outline-none focus:border-blue-500">
                            <option value="recentes">Mais recentes</option>
                            <option value="preco_menor">Menor Preço</option>
                            <option value="preco_maior">Maior Preço</option>
                            <option value="nome">Nome A-Z</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <template x-for="p in filteredStoreProducts" :key="p.slug">
                        <div
                            class="bg-white dark:bg-[#0c1a33] rounded-3xl border border-slate-200 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group">
                            <!-- Image Box -->
                            <div
                                class="h-52 bg-[#f8fafc] dark:bg-gradient-to-b dark:from-white/5 dark:to-[#071326] p-4 flex items-center justify-center relative overflow-hidden group-hover:bg-slate-100/70 dark:group-hover:from-white/10 dark:group-hover:to-[#071326] transition dark:border-b dark:border-white/10">
                                <span x-show="p.badge"
                                    class="absolute top-3 left-3 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm"
                                    :class="p.badge === 'Promoção' ? 'bg-rose-500 text-white' : 'bg-amber-500 text-slate-950'"
                                    x-text="p.badge"></span>
                                <span
                                    class="absolute top-3 right-3 text-[10px] font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-950/60 dark:text-emerald-400 dark:border-emerald-800/40 px-2 py-0.5 rounded-full border border-emerald-100"
                                    x-text="p.stockText"></span>
                                <img :src="p.image" :alt="p.title"
                                    class="max-h-36 max-w-full object-contain drop-shadow-sm dark:drop-shadow-[0_12px_20px_rgba(0,0,0,0.7)] group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-600 dark:text-amber-400"
                                        x-text="p.categoryLabel || p.category"></span>
                                    <h3 class="text-sm font-bold text-slate-900 dark:text-white mt-1 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-amber-400 transition"
                                        x-text="p.title"></h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10 flex items-center justify-between">
                                    <div>
                                        <span x-show="p.oldPrice" class="text-[11px] text-slate-400 line-through block"
                                            x-text="p.oldPrice"></span>
                                        <span class="text-base font-black text-slate-950 dark:text-white" x-text="p.price"></span>
                                    </div>
                                    <button @click="addToCartFromStore(p)"
                                        class="px-3.5 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-xl text-xs transition shadow-sm hover:shadow active:scale-95 flex items-center gap-1.5">
                                        <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                        <span>Adicionar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </section>
        </div>

        <!-- SUB-PAGE: RACHI PRINT (GRÁFICA & COMUNICAÇÃO VISUAL) -->
        <!-- SUB-PAGE: RACHI PRINT (LOJA DE ARTES & LOGÓTIPOS) -->
        <div x-show="currentTab === 'print'" x-cloak class="min-h-screen bg-slate-50">
            <!-- Hero Banner -->
            <section class="bg-[#071326] text-white pt-14 pb-16 relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-pink-950/40 via-purple-950/20 to-slate-900 pointer-events-none">
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                        <a href="#home" @click.prevent="goToHome()"
                            class="hover:text-white transition cursor-pointer">Início</a>
                        <span>/</span>
                        <span class="text-slate-500">Soluções</span>
                        <span>/</span>
                        <span class="text-pink-400 font-semibold">RACHI Print</span>
                    </nav>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <div class="lg:col-span-8">
                            <div
                                class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-pink-500/10 border border-pink-500/30 text-pink-400 text-xs font-bold uppercase tracking-wider mb-4">
                                <span class="w-2 h-2 rounded-full bg-pink-400 animate-pulse"></span>
                                Estúdio & Loja de Artes, Logótipos e Identidade Visual
                            </div>
                            <h1
                                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                                Logótipos Marcantes, <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-rose-300 to-amber-300">Identidade
                                    Visual Única</span> e Artes de Alto Impacto
                            </h1>
                            <p class="mt-4 text-slate-300 text-base sm:text-lg max-w-2xl leading-relaxed">
                                Destaque a sua empresa no mercado angolano com um visual profissional. Criamos logótipos
                                100% vetorizados, manuais de marca, papelaria corporativa e pacotes de artes prontos
                                para redes sociais.
                            </p>
                            <div class="mt-8 flex flex-wrap gap-4">
                                <a href="#pacotes-logos"
                                    @click.prevent="const el = document.getElementById('pacotes-logos'); if(el) el.scrollIntoView({behavior:'smooth'})"
                                    class="btn-cta-gold shadow-lg shadow-amber-500/20 flex items-center gap-2">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                    <span>Ver Pacotes de Logótipos</span>
                                </a>
                                <a href="#pacotes-artes"
                                    @click.prevent="const el = document.getElementById('pacotes-artes'); if(el) el.scrollIntoView({behavior:'smooth'})"
                                    class="px-5 py-3 rounded-lg border border-pink-500/40 hover:border-pink-400 text-pink-300 hover:text-white text-sm font-semibold transition flex items-center gap-2 bg-pink-950/20">
                                    <i data-lucide="image" class="w-4 h-4"></i>
                                    <span>Packs para Redes Sociais</span>
                                </a>
                                <a href="#briefing-artes"
                                    @click.prevent="const el = document.getElementById('briefing-artes'); if(el) el.scrollIntoView({behavior:'smooth'})"
                                    class="px-5 py-3 rounded-lg border border-slate-600 hover:border-slate-400 text-slate-300 hover:text-white text-sm font-semibold transition flex items-center gap-2">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    <span>Briefing Rápido</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-4">
                            <div
                                class="bg-gradient-to-br from-slate-900/95 to-slate-800/90 border border-pink-500/30 rounded-2xl p-6 shadow-2xl backdrop-blur-sm">
                                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                    <i data-lucide="award" class="w-5 h-5 text-pink-400"></i>
                                    Garantias RACHI Print
                                </h3>
                                <ul class="space-y-3.5 text-xs text-slate-300">
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Arquivos Vetoriais Abertos:</strong> Entrega em .AI, .EPS, .SVG,
                                            .PDF e .PNG em alta resolução.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Direitos Autorais 100% Seus:</strong> Cessão completa para registo
                                            oficial da marca.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Aprovação por Etapas:</strong> Apresentação de conceitos com
                                            ajustes até a aprovação ideal.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Pronto para Impressão & Web:</strong> Ficheiros configurados em
                                            CMYK e RGB.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Métricas -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 pt-8 border-t border-slate-800/80">
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-pink-400">+350</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Marcas & Logos Criados</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-amber-400">100%</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Arquivos Vetoriais Editáveis</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-emerald-400">3-5 Dias</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Prazo Médio de Apresentação</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-blue-400">99%</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Aprovação nas Primeiras Propostas</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 1: PACOTES DE LOGÓTIPOS & IDENTIDADE VISUAL -->
            <section id="pacotes-logos" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span
                        class="text-pink-600 font-bold text-xs uppercase tracking-widest bg-pink-50 px-3 py-1 rounded-full border border-pink-100">
                        Criação de Marcas Profissionais
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                        Pacotes de Logótipo & Identidade Visual
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                        Escolha o pacote ideal para a sua empresa. Todos os planos incluem arquivos originais em vetor,
                        prontos para uso em fardas, fachadas, carimbos, viaturas e redes sociais.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    <!-- Pacote Essencial -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative group hover:border-pink-300">
                        <div>
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider mb-4">
                                Entrada Rápida
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Logótipo Essencial</h3>
                            <p class="text-slate-500 text-xs mt-2 leading-relaxed">
                                Ideal para profissionais autónomos, pequenos negócios e projetos em fase inicial que
                                precisam de uma marca profissional rápida.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-100">
                                <span class="text-3xl font-black text-slate-900">45.000</span>
                                <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Pagamento único • Sem
                                    mensalidades</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-600">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span><strong>2 Conceitos Iniciais</strong> para escolha</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Logótipo Principal e Versão Horizontal</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Versões Monocromáticas (Preto e Branco)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Ficheiros em PNG (sem fundo) e JPG alta resolução</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>PDF Vetorial para pequenas impressões</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Até 2 rondas de revisões</span>
                                </li>
                                <li class="flex items-start gap-2.5 text-slate-400">
                                    <i data-lucide="x" class="w-4 h-4 text-slate-300 shrink-0 mt-0.5"></i>
                                    <span>Sem manual de identidade de marca</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button @click="openRequestWithPreselection(2, 'Logótipo Essencial - 45.000 AOA')"
                                class="w-full py-3 px-4 rounded-xl border border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                <span>Escolher Essencial</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pacote Profissional (Destaque) -->
                    <div
                        class="bg-gradient-to-b from-slate-900 to-slate-950 text-white rounded-2xl p-8 shadow-2xl relative flex flex-col justify-between border-2 border-pink-500 transform lg:-translate-y-2">
                        <div
                            class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-pink-500 to-rose-500 text-white text-[11px] font-black uppercase tracking-widest px-4 py-1 rounded-full shadow-md">
                            Mais Escolhido • Melhor Custo-Benefício
                        </div>

                        <div>
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-pink-500/20 text-pink-300 text-xs font-bold uppercase tracking-wider mb-4 mt-2">
                                Identidade Completa
                            </div>
                            <h3 class="text-2xl font-black text-white">Identidade Profissional</h3>
                            <p class="text-slate-300 text-xs mt-2 leading-relaxed">
                                Para empresas que desejam uma marca imponente, memorável e preparada para competir em
                                alto nível no mercado.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-800">
                                <span class="text-4xl font-black text-white">95.000</span>
                                <span class="text-xs font-bold text-pink-400">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Pacote completo com fontes e
                                    vetores abertos</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-300">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span><strong>3 Conceitos Criativos Exclusivos</strong></span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Logótipo Principal, Secundário e Sub-marca / Ícone para Avatar</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Paleta de Cores Oficial com códigos HEX, RGB e CMYK</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Guia de Tipografia Institucional (fontes corporativas)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span><strong>Arquivos Vetoriais Abertos:</strong> Adobe Illustrator (.AI), .EPS,
                                        .SVG, .PDF</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Mockups 3D realistas (cartão, placa, farda, brindes)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Capa estilizada para Facebook/LinkedIn + Foto de perfil pronta</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-pink-400 shrink-0 mt-0.5"></i>
                                    <span>Até 4 rondas de ajustes incluídas</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button @click="openRequestWithPreselection(2, 'Identidade Profissional - 95.000 AOA')"
                                class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-extrabold text-xs transition duration-200 shadow-lg shadow-pink-500/25 flex items-center justify-center gap-2">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                                <span>Escolher Pacote Profissional</span>
                            </button>
                        </div>
                    </div>

                    <!-- Pacote Corporativo 360 -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between relative group hover:border-pink-300">
                        <div>
                            <div
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-wider mb-4">
                                Premium & Papelaria
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Corporativo 360</h3>
                            <p class="text-slate-500 text-xs mt-2 leading-relaxed">
                                Solução definitiva de branding com manual de normas completo e toda a papelaria
                                institucional pronta para impressão.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-100">
                                <span class="text-3xl font-black text-slate-900">180.000</span>
                                <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Branding 360 com papelaria e
                                    templates</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-600">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span><strong>Tudo do Pacote Profissional</strong></span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span><strong>Manual de Identidade Visual (Brandbook de 20 páginas)</strong></span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Design de Cartão de Visita Executivo (frente e verso)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Design de Papel Timbrado e Pasta Corporativa</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Design de Envelope Saco e Assinatura de E-mail em HTML</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span><strong>5 Templates Editáveis no Canva ou Photoshop</strong></span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Ajustes ilimitados na fase de criação dos conceitos</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button @click="openRequestWithPreselection(2, 'Corporativo 360 - 180.000 AOA')"
                                class="w-full py-3 px-4 rounded-xl border border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                <i data-lucide="crown" class="w-4 h-4 text-amber-500"></i>
                                <span>Escolher Corporativo 360</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 2: PACKS DE ARTES PARA REDES SOCIAIS -->
            <section id="pacotes-artes" class="py-16 bg-white border-y border-slate-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span
                            class="text-pink-600 font-bold text-xs uppercase tracking-widest bg-pink-50 px-3 py-1 rounded-full border border-pink-100">
                            Marketing Visual & Redes Sociais
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                            Packs de Artes para Instagram, Facebook & WhatsApp
                        </h2>
                        <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                            Mantenha o perfil da sua empresa com visual profissional e atraente. Artes criadas por
                            designers seniores para aumentar o engajamento e gerar vendas.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Pack 6 Artes -->
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                            <div
                                class="w-10 h-10 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center mb-4 font-black">
                                06
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Pack Starter (6 Artes)</h3>
                            <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                                Ideal para campanhas pontuais de promoções, lançamentos de produtos ou eventos
                                específicos.
                            </p>
                            <div class="text-2xl font-black text-slate-900 mb-4">
                                30.000 <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="text-[10px] text-slate-400 block font-normal">(5.000 AOA por arte)</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-600 mb-6">
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-emerald-500"></i> 6 artes para Feed (formato 1:1
                                    quadrado ou 4:5 vertical)</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-emerald-500"></i> Formatação adaptada para Stories e
                                    Status do WhatsApp</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-emerald-500"></i> Sugestão de texto / legenda de cada
                                    post</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-emerald-500"></i> Entrega em até 3 dias úteis</li>
                            </ul>
                            <button @click="openRequestWithPreselection(2, 'Pack Starter 6 Artes - 30.000 AOA')"
                                class="w-full py-2.5 px-4 rounded-lg bg-[#071326] hover:bg-pink-600 text-white font-bold text-xs transition">
                                Contratar Pack 6 Artes
                            </button>
                        </div>

                        <!-- Pack 12 Artes -->
                        <div
                            class="bg-gradient-to-br from-pink-50/70 to-purple-50/70 border-2 border-pink-300 rounded-2xl p-6 shadow-sm hover:shadow-md transition relative">
                            <span
                                class="absolute top-4 right-4 bg-pink-500 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase">
                                Recomendado
                            </span>
                            <div
                                class="w-10 h-10 rounded-xl bg-pink-600 text-white flex items-center justify-center mb-4 font-black">
                                12
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Pack Pro Mensal (12 Artes)</h3>
                            <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                                Ideal para empresas que publicam 3 vezes por semana e precisam manter uma frequência
                                consistente e visual harmonioso.
                            </p>
                            <div class="text-2xl font-black text-slate-900 mb-4">
                                55.000 <span class="text-xs font-bold text-pink-600">AOA</span>
                                <span class="text-[10px] text-slate-400 block font-normal">(Economia de 5.000
                                    AOA)</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-700 mb-6">
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-pink-600"></i> 12 artes para Feed (estático ou carrossel
                                    de até 4 telas)</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-pink-600"></i> Versões dimensionadas para Stories e
                                    WhatsApp</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-pink-600"></i> Harmonização estética do Feed (mosaico ou
                                    padrão visual)</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-pink-600"></i> Calendário mensal sugerido de postagens
                                </li>
                            </ul>
                            <button @click="openRequestWithPreselection(2, 'Pack Pro 12 Artes - 55.000 AOA')"
                                class="w-full py-2.5 px-4 rounded-lg bg-pink-600 hover:bg-pink-700 text-white font-bold text-xs transition shadow">
                                Contratar Pack 12 Artes
                            </button>
                        </div>

                        <!-- Pack 24 Artes -->
                        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                            <div
                                class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mb-4 font-black">
                                24
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Gestão Visual 360 (24 Artes)</h3>
                            <p class="text-xs text-slate-500 mt-1 mb-4 leading-relaxed">
                                Cobertura completa para presença quase diária nas redes, incluindo capas de Reels e
                                destaques temáticos.
                            </p>
                            <div class="text-2xl font-black text-slate-900 mb-4">
                                110.000 <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="text-[10px] text-slate-400 block font-normal">(Máxima autoridade e
                                    frequência)</span>
                            </div>
                            <ul class="space-y-2 text-xs text-slate-600 mb-6">
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-purple-600"></i> 24 artes personalizadas (Feed,
                                    Carrosséis e Infográficos)</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-purple-600"></i> 6 capas estilizadas para vídeos do
                                    Reels e TikTok</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-purple-600"></i> 5 capas de destaques do Instagram
                                    personalizadas</li>
                                <li class="flex items-center gap-2"><i data-lucide="check"
                                        class="w-3.5 h-3.5 text-purple-600"></i> Ficheiros abertos editáveis em formato
                                    Canva ou PSD</li>
                            </ul>
                            <button @click="openRequestWithPreselection(2, 'Gestão Visual 24 Artes - 110.000 AOA')"
                                class="w-full py-2.5 px-4 rounded-lg bg-[#071326] hover:bg-purple-600 text-white font-bold text-xs transition">
                                Contratar Pack 24 Artes
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 3: GALERIA / SHOWCASE VISUAL DE ARTES E NICHOS -->
            <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-pink-600 font-bold text-xs uppercase tracking-widest">Portfólio &
                        Inspirações</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-1">Identidades Visuais Criadas para Diversos Ramos
                    </h2>
                    <p class="text-slate-600 text-sm mt-2">Adaptamos a linguagem gráfica exactamente ao público-alvo do
                        seu sector de actividade.</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="cpu" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Tecnologia</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Linhas futuristas, minimalismo e tons cianos.</p>
                    </div>

                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-amber-50 text-amber-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="utensils" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Gastronomia</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Cores quentes, apetite e identidade vibrante.</p>
                    </div>

                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="heart-pulse" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Saúde & Clínicas</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Transmissão de higiene, confiança e serenidade.</p>
                    </div>

                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-slate-100 text-slate-800 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="scale" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Advocacia & Finanças</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Tipografia nobre, monogramas e sobriedade.</p>
                    </div>

                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-pink-50 text-pink-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="sparkles" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Moda & Beleza</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Elegância, curvas orgânicas e visual chic.</p>
                    </div>

                    <div
                        class="bg-white p-5 rounded-2xl border border-slate-200 text-center hover:border-pink-500 hover:shadow-lg transition group">
                        <div
                            class="w-12 h-12 mx-auto rounded-full bg-orange-50 text-orange-600 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                            <i data-lucide="truck" class="w-6 h-6"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 text-sm">Logística & Varejo</h4>
                        <p class="text-[11px] text-slate-500 mt-1">Dinamismo, robustez e alta legibilidade.</p>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 4: BRIEFING RÁPIDO ONLINE DE LOGÓTIPO & ARTES -->
            <section id="briefing-artes" class="py-16 bg-slate-900 text-white relative overflow-hidden">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-10">
                        <span
                            class="text-pink-400 font-bold text-xs uppercase tracking-widest bg-pink-500/10 px-3 py-1 rounded-full border border-pink-500/30">
                            Atendimento Rápido
                        </span>
                        <h2 class="text-3xl font-extrabold text-white mt-3">Envie o Briefing do seu Logótipo ou Arte
                        </h2>
                        <p class="text-slate-300 text-sm mt-2 max-w-xl mx-auto">
                            Preencha as preferências da sua marca abaixo para que a nossa equipa criativa prepare uma
                            proposta personalizada em menos de 2 horas.
                        </p>
                    </div>

                    <div class="bg-slate-800/90 border border-slate-700 rounded-3xl p-6 sm:p-10 shadow-2xl backdrop-blur-sm"
                        x-data="{
                            companyName: '',
                            businessSector: '',
                            serviceType: 'Logótipo Profissional',
                            preferredStyle: 'Moderno e Minimalista',
                            colorPreferences: '',
                            details: '',
                            sendToWhatsApp() {
                                let text = '*BRIEFING RACHI PRINT - CRIAÇÃO DE LOGO/ARTE*\n';
                                text += '🏢 *Empresa / Marca:* ' + (this.companyName || 'Não informado') + '\n';
                                text += '🏷️ *Ramo:* ' + (this.businessSector || 'Não informado') + '\n';
                                text += '📦 *Serviço:* ' + this.serviceType + '\n';
                                text += '🎨 *Estilo:* ' + this.preferredStyle + '\n';
                                if(this.colorPreferences) text += '🌈 *Cores:* ' + this.colorPreferences + '\n';
                                if(this.details) text += '📝 *Detalhes:* ' + this.details + '\n';
                                const url = 'https://wa.me/244923000000?text=' + encodeURIComponent(text);
                                window.open(url, '_blank');
                            }
                         }">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Nome
                                    da Empresa / Marca *</label>
                                <input type="text" x-model="companyName" placeholder="Ex: Rachi Motors, Luanda Coffee"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Ramo
                                    de Actividade *</label>
                                <input type="text" x-model="businessSector"
                                    placeholder="Ex: Gastronomia, Engenharia, Moda, TI"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Serviço
                                    Pretendido</label>
                                <select x-model="serviceType"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition">
                                    <option value="Logótipo Essencial (45.000 AOA)">Logótipo Essencial (45.000 AOA)
                                    </option>
                                    <option value="Identidade Profissional (95.000 AOA)">Identidade Profissional (95.000
                                        AOA)</option>
                                    <option value="Corporativo 360 (180.000 AOA)">Corporativo 360 (180.000 AOA)</option>
                                    <option value="Pack 6 Artes Redes Sociais (30.000 AOA)">Pack 6 Artes Redes Sociais
                                        (30.000 AOA)</option>
                                    <option value="Pack 12 Artes Redes Sociais (55.000 AOA)">Pack 12 Artes Redes Sociais
                                        (55.000 AOA)</option>
                                    <option value="Gestão Visual 24 Artes (110.000 AOA)">Gestão Visual 24 Artes (110.000
                                        AOA)</option>
                                    <option value="Redesign de Logótipo Existente">Redesign de Logótipo Existente
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Estilo
                                    Visual Pretendido</label>
                                <select x-model="preferredStyle"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition">
                                    <option value="Moderno e Minimalista">Moderno e Minimalista</option>
                                    <option value="Corporativo e Sóbrio">Corporativo e Sóbrio</option>
                                    <option value="Luxuoso e Elegante (Dourado / Preto)">Luxuoso e Elegante (Dourado /
                                        Preto)</option>
                                    <option value="Criativo, Jovem e Colorido">Criativo, Jovem e Colorido</option>
                                    <option value="Tecnológico e Futurista">Tecnológico e Futurista</option>
                                    <option value="Vintage / Retrô">Vintage / Retrô</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Cores
                                    de Preferência (Opcional)</label>
                                <input type="text" x-model="colorPreferences"
                                    placeholder="Ex: Azul e Dourado, Preto e Branco, Tons pastéis"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">O
                                    que deseja transmitir com a sua marca?</label>
                                <textarea x-model="details" rows="3"
                                    placeholder="Descreva brevemente valores, símbolos desejados ou referências visuais que você aprecia..."
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-pink-500 transition"></textarea>
                            </div>
                        </div>

                        <div
                            class="mt-8 pt-6 border-t border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-xs text-slate-400 text-center sm:text-left">
                                <i data-lucide="shield-check" class="w-4 h-4 inline text-emerald-400 mr-1"></i>
                                Orçamento sem compromisso e garantia de confidencialidade.
                            </div>
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                <button @click="sendToWhatsApp()"
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/30">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    <span>Enviar no WhatsApp</span>
                                </button>
                                <button
                                    @click="openRequestWithPreselection(2, serviceType + ' - ' + (companyName || 'Briefing'))"
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-gradient-to-r from-pink-500 to-rose-500 hover:from-pink-600 hover:to-rose-600 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-pink-900/30">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                    <span>Pedir Proposta Formal</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- SUB-PAGE: RACHI ACADEMY (Página separada e dedicada em /academy) -->
        <div x-show="currentTab === 'academy'" x-cloak class="hidden" x-init="$watch('currentTab', val => { if(val === 'academy') window.location.href = '/academy'; })">
        </div>
<!-- SUB-PAGE: RACHI CAPITAL (RECURSOS HUMANOS & CONSULTORIA) -->
        <!-- SUB-PAGE: RACHI CAPITAL (SITES & SUPORTE TI CORPORATIVO) -->
        <div x-show="currentTab === 'capital'" x-cloak class="min-h-screen bg-slate-50">
            <!-- Hero Banner -->
            <section class="bg-[#071326] text-white pt-14 pb-16 relative overflow-hidden">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-950/50 via-slate-900 to-amber-950/30 pointer-events-none">
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                        <a href="#home" @click.prevent="goToHome()"
                            class="hover:text-white transition cursor-pointer">Início</a>
                        <span>/</span>
                        <span class="text-slate-500">Soluções</span>
                        <span>/</span>
                        <span class="text-amber-400 font-semibold">RACHI Capital</span>
                    </nav>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <div class="lg:col-span-8">
                            <div
                                class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-wider mb-4">
                                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                                Desenvolvimento Web, Plataformas & Suporte Técnico de TI
                            </div>
                            <h1
                                class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                                Criação de Sites Modernos & <span
                                    class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-yellow-300 to-blue-400">Suporte
                                    Técnico de TI com SLA</span>
                            </h1>
                            <p class="mt-4 text-slate-300 text-base sm:text-lg max-w-2xl leading-relaxed">
                                Transforme visitantes em clientes com websites de alta performance e garanta a
                                estabilidade operacional da sua empresa através de contratos corporativos de suporte de
                                TI com atendimento rápido garantido.
                            </p>
                            <div class="mt-8 flex flex-wrap gap-4">
                                <a href="#web-solutions"
                                    @click.prevent="const el = document.getElementById('web-solutions'); if(el) el.scrollIntoView({behavior:'smooth'})"
                                    class="btn-cta-gold shadow-lg shadow-amber-500/20 flex items-center gap-2">
                                    <i data-lucide="globe" class="w-4 h-4"></i>
                                    <span>Criação de Sites & Lojas</span>
                                </a>
                                <a href="#suporte-ti"
                                    @click.prevent="const el = document.getElementById('suporte-ti'); if(el) el.scrollIntoView({behavior:'smooth'})"
                                    class="px-5 py-3 rounded-lg border border-amber-500/40 hover:border-amber-400 text-amber-300 hover:text-white text-sm font-semibold transition flex items-center gap-2 bg-amber-950/20">
                                    <i data-lucide="headphones" class="w-4 h-4"></i>
                                    <span>Planos de Suporte TI (SLA)</span>
                                </a>
                                <button
                                    @click="openRequestWithPreselection(4, 'Serviços de Criação de Sites e Suporte TI')"
                                    class="px-5 py-3 rounded-lg border border-slate-600 hover:border-slate-400 text-slate-300 hover:text-white text-sm font-semibold transition flex items-center gap-2">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                    <span>Solicitar Proposta</span>
                                </button>
                            </div>
                        </div>

                        <div class="lg:col-span-4">
                            <div
                                class="bg-gradient-to-br from-slate-900/95 to-slate-800/90 border border-amber-500/30 rounded-2xl p-6 shadow-2xl backdrop-blur-sm">
                                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2">
                                    <i data-lucide="shield-check" class="w-5 h-5 text-amber-400"></i>
                                    Compromissos Corporativos
                                </h3>
                                <ul class="space-y-3.5 text-xs text-slate-300">
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle"
                                            class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>SLA Rígido em Contrato:</strong> Tempos de resposta definidos a
                                            partir de 30 minutos a 2 horas.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle"
                                            class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Pagamentos Angolanos:</strong> Integração nativa de pagamentos por
                                            referência Multicaixa Express.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle"
                                            class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Segurança & Backups:</strong> Rotinas diárias automatizadas na
                                            nuvem contra perda de dados.</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check-circle"
                                            class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Atendimento Híbrido:</strong> Suporte remoto ilimitado com equipa
                                            local em Luanda para visitas presenciais.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Métricas -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 pt-8 border-t border-slate-800/80">
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-amber-400">+60</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Websites & Lojas no Ar</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-[#00a3e0]">99.9%</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Disponibilidade Garantida</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-emerald-400">&lt; 1h</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Tempo Médio de Resolução TI</div>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-900/50 border border-slate-800 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-cyan-400">24/7</div>
                            <div class="text-xs text-slate-400 mt-1 font-medium">Monitorização Proativa de Redes</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 1: CRIAÇÃO DE SITES & SOLUÇÕES WEB -->
            <section id="web-solutions" class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span
                        class="text-amber-600 font-bold text-xs uppercase tracking-widest bg-amber-50 px-3 py-1 rounded-full border border-amber-100">
                        Presença Digital & Conversão
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 mt-3 tracking-tight">
                        Criação de Sites Profissionais e Lojas Virtuais
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                        Construímos plataformas digitais de alta conversão, totalmente responsivas e adaptadas ao
                        comportamento do consumidor em Angola.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    <!-- Site Institucional -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:border-blue-300">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                                <i data-lucide="globe" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Autoridade de
                                Marca</span>
                            <h3 class="text-xl font-bold text-slate-900 mt-1">Website Institucional</h3>
                            <p class="text-slate-500 text-xs mt-2 leading-relaxed">
                                Ideal para empresas prestadoras de serviços, clínicas, escritórios e indústrias que
                                necessitam de presença sólida e profissional.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-100">
                                <span class="text-[11px] uppercase text-slate-400 font-bold block">A partir de</span>
                                <span class="text-3xl font-black text-slate-900">150.000</span>
                                <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Projeto completo entregue
                                    pronto</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-600">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Design exclusivo e 100% responsivo (smartphone, tablet e PC)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Otimização SEO para posicionar o seu negócio no Google</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Formulários inteligentes com envio direto para o WhatsApp</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Domínio .AO e Hospedagem de alta velocidade por 1 ano</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Contas de E-mail corporativo personalizadas</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button
                                @click="openRequestWithPreselection(4, 'Website Institucional - A partir de 150.000 AOA')"
                                class="w-full py-3 px-4 rounded-xl border border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Solicitar Orçamento de Site</span>
                            </button>
                        </div>
                    </div>

                    <!-- E-Commerce / Loja Virtual (Destaque) -->
                    <div
                        class="bg-gradient-to-b from-slate-900 to-slate-950 text-white rounded-2xl p-8 shadow-2xl relative flex flex-col justify-between border-2 border-amber-500 transform lg:-translate-y-2">
                        <div
                            class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-amber-500 to-yellow-500 text-slate-950 text-[11px] font-black uppercase tracking-widest px-4 py-1 rounded-full shadow-md">
                            Vendas 24/7 • Alta Procura
                        </div>

                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center mb-6">
                                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-amber-400 uppercase tracking-wider">Vendas Online em
                                Angola</span>
                            <h3 class="text-2xl font-black text-white mt-1">Loja Virtual (E-Commerce)</h3>
                            <p class="text-slate-300 text-xs mt-2 leading-relaxed">
                                Plataforma completa para vender produtos físicos ou digitais com carrinho de compras e
                                pagamentos locais automáticos.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-800">
                                <span class="text-[11px] uppercase text-slate-400 font-bold block">A partir de</span>
                                <span class="text-4xl font-black text-white">250.000</span>
                                <span class="text-xs font-bold text-amber-400">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Com Multicaixa Express e gestão de
                                    stock</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-300">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                    <span>Catálogo dinâmico de produtos com fotos, variações e preços</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                    <span><strong>Pagamento por Referência Multicaixa Express</strong></span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                    <span>Painel de administração fácil para gerir encomendas e stock</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                    <span>Cálculo de taxa de entrega em Luanda e Províncias</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                    <span>Certificado de segurança SSL para pagamentos 100% seguros</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button
                                @click="openRequestWithPreselection(4, 'Loja Virtual E-Commerce - A partir de 250.000 AOA')"
                                class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-950 font-extrabold text-xs transition duration-200 shadow-lg shadow-amber-500/25 flex items-center justify-center gap-2">
                                <i data-lucide="rocket" class="w-4 h-4"></i>
                                <span>Iniciar Minha Loja Virtual</span>
                            </button>
                        </div>
                    </div>

                    <!-- Sistemas Web & ERP Sob Medida -->
                    <div
                        class="bg-white rounded-2xl border border-slate-200 p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group hover:border-emerald-300">
                        <div>
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-6 group-hover:scale-110 transition">
                                <i data-lucide="cpu" class="w-6 h-6"></i>
                            </div>
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Eficiência
                                Operacional</span>
                            <h3 class="text-xl font-bold text-slate-900 mt-1">Sistemas Web Sob Medida</h3>
                            <p class="text-slate-500 text-xs mt-2 leading-relaxed">
                                Plataformas web e ERPs desenhados especificamente para a lógica operacional e regras de
                                negócio da sua empresa.
                            </p>

                            <div class="my-6 pb-6 border-b border-slate-100">
                                <span class="text-[11px] uppercase text-slate-400 font-bold block">A partir de</span>
                                <span class="text-3xl font-black text-slate-900">450.000</span>
                                <span class="text-xs font-bold text-slate-500">AOA</span>
                                <span class="block text-[11px] text-slate-400 mt-0.5">Ou orçamento conforme escopo
                                    técnico</span>
                            </div>

                            <ul class="space-y-3 text-xs text-slate-600">
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Módulos integrados: Faturação AGT, Clientes, Armazém e RH</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Níveis de acesso hierárquicos e auditoria de utilizadores</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Relatórios executivos e gráficos em tempo real (BI)</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Banco de dados na nuvem com alta disponibilidade e backups</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <i data-lucide="check" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                                    <span>Treinamento completo da sua equipa e suporte contínuo</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-8">
                            <button @click="openRequestWithPreselection(4, 'Sistema Web Sob Medida')"
                                class="w-full py-3 px-4 rounded-xl border border-slate-900 text-slate-900 hover:bg-slate-900 hover:text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                <i data-lucide="layers" class="w-4 h-4"></i>
                                <span>Solicitar Análise de Projeto</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 2: PLANOS DE SUPORTE TÉCNICO DE TI COM SLA -->
            <section id="suporte-ti" class="py-16 bg-slate-900 text-white relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center max-w-3xl mx-auto mb-14">
                        <span
                            class="text-amber-400 font-bold text-xs uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/30">
                            Terceirização & Continuidade de Negócio
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-black text-white mt-3 tracking-tight">
                            Planos Mensais de Suporte de TI com SLA
                        </h2>
                        <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                            Elimine paragens inesperadas, falhas de rede e riscos de perda de dados. Conte com uma
                            equipa técnica completa de TI por uma fracção do custo de uma contratação interna.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                        <!-- Plano Startup TI -->
                        <div
                            class="bg-slate-800/80 border border-slate-700 rounded-2xl p-8 flex flex-col justify-between hover:border-amber-400/50 transition">
                            <div>
                                <div
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-700/80 text-slate-300 text-xs font-bold uppercase tracking-wider mb-4">
                                    Até 8 Computadores
                                </div>
                                <h3 class="text-xl font-bold text-white">Suporte TI Startup</h3>
                                <p class="text-slate-400 text-xs mt-2 leading-relaxed">
                                    Ideal para pequenos escritórios, consultórios e lojas que necessitam de estabilidade
                                    básica e apoio técnico imediato.
                                </p>

                                <div class="my-6 pb-6 border-b border-slate-700">
                                    <span class="text-3xl font-black text-white">85.000</span>
                                    <span class="text-xs font-bold text-amber-400">AOA / mês</span>
                                    <div
                                        class="mt-2 inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 px-2.5 py-1 rounded text-[11px] font-bold">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i> SLA de Resposta: até 4h úteis
                                    </div>
                                </div>

                                <ul class="space-y-3 text-xs text-slate-300">
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Suporte Remoto Ilimitado (Helpdesk via telefone e acesso remoto)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>1 Visita Presencial Mensal Preventiva (limpeza lógica e física)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Instalação e gestão de antivírus corporativo</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Configuração de impressoras e partilhas de ficheiros</span>
                                    </li>
                                    <li class="flex items-start gap-2.5 text-slate-500">
                                        <i data-lucide="x" class="w-4 h-4 text-slate-600 shrink-0 mt-0.5"></i>
                                        <span>Sem gestão avançada de servidores dedicados</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-8">
                                <button
                                    @click="openRequestWithPreselection(4, 'Contrato Suporte TI Startup - 85.000 AOA/mês')"
                                    class="w-full py-3 px-4 rounded-xl border border-slate-600 hover:border-amber-400 text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                    <span>Contratar Plano Startup</span>
                                </button>
                            </div>
                        </div>

                        <!-- Plano Business TI (Destaque) -->
                        <div
                            class="bg-gradient-to-b from-slate-800 to-slate-900 border-2 border-amber-400 rounded-2xl p-8 flex flex-col justify-between shadow-2xl relative transform lg:-translate-y-2">
                            <div
                                class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-gradient-to-r from-amber-400 to-yellow-400 text-slate-950 text-[11px] font-black uppercase tracking-widest px-4 py-1 rounded-full shadow-md">
                                Mais Escolhido pelas Empresas
                            </div>

                            <div>
                                <div
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider mb-4 mt-2">
                                    Até 25 Postos + 2 Servidores
                                </div>
                                <h3 class="text-2xl font-black text-white">Suporte TI Business Pro</h3>
                                <p class="text-slate-300 text-xs mt-2 leading-relaxed">
                                    A solução completa para médias empresas que não podem tolerar interrupções
                                    operacionais e necessitam de segurança de dados.
                                </p>

                                <div class="my-6 pb-6 border-b border-slate-700">
                                    <span class="text-4xl font-black text-white">195.000</span>
                                    <span class="text-xs font-bold text-amber-400">AOA / mês</span>
                                    <div
                                        class="mt-2 inline-flex items-center gap-1.5 bg-emerald-500/20 text-emerald-300 px-2.5 py-1 rounded text-[11px] font-bold">
                                        <i data-lucide="zap" class="w-3.5 h-3.5"></i> SLA Rápido: Resposta em até 2
                                        horas
                                    </div>
                                </div>

                                <ul class="space-y-3 text-xs text-slate-200">
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Suporte Remoto Ilimitado</strong> para todos os
                                            colaboradores</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>4 Visitas Presenciais Mensais</strong> (preventivas e
                                            corretivas)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span>Gestão completa de Redes, Roteadores, Switches e Wi-Fi Corporativo</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span><strong>Rotinas Automatizadas de Backup em Nuvem Diárias</strong></span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span>Administração de Servidores Windows Server / Linux</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-amber-400 shrink-0 mt-0.5"></i>
                                        <span>Relatório técnico mensal com inventário e recomendações</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-8">
                                <button
                                    @click="openRequestWithPreselection(4, 'Contrato Suporte TI Business Pro - 195.000 AOA/mês')"
                                    class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-400 to-yellow-400 hover:from-amber-500 hover:to-yellow-500 text-slate-950 font-extrabold text-xs transition duration-200 shadow-lg shadow-amber-400/20 flex items-center justify-center gap-2">
                                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                                    <span>Contratar Plano Business Pro</span>
                                </button>
                            </div>
                        </div>

                        <!-- Plano Enterprise TI -->
                        <div
                            class="bg-slate-800/80 border border-slate-700 rounded-2xl p-8 flex flex-col justify-between hover:border-amber-400/50 transition">
                            <div>
                                <div
                                    class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-slate-700/80 text-slate-300 text-xs font-bold uppercase tracking-wider mb-4">
                                    Infraestrutura Ilimitada & Filiais
                                </div>
                                <h3 class="text-xl font-bold text-white">Suporte TI Enterprise</h3>
                                <p class="text-slate-400 text-xs mt-2 leading-relaxed">
                                    Para grandes corporações, grupos empresariais e indústrias que exigem NOC 24/7,
                                    técnico dedicado e continuidade absoluta.
                                </p>

                                <div class="my-6 pb-6 border-b border-slate-700">
                                    <span class="text-3xl font-black text-white">Sob Medida</span>
                                    <span class="text-xs font-bold text-slate-400 block mt-1">Conforme dimensão da
                                        empresa</span>
                                    <div
                                        class="mt-2 inline-flex items-center gap-1.5 bg-cyan-500/20 text-cyan-300 px-2.5 py-1 rounded text-[11px] font-bold">
                                        <i data-lucide="bell-ring" class="w-3.5 h-3.5"></i> SLA Crítico: 30 minutos
                                        (24/7/365)
                                    </div>
                                </div>

                                <ul class="space-y-3 text-xs text-slate-300">
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Número ilimitado de computadores, portáteis e servidores</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Monitorização ativa de NOC 24 horas por dia, 7 dias por semana</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Técnico residente ou visitas presenciais ilimitadas sob chamado</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Plano de Recuperação de Desastres (Disaster Recovery Plan)</span>
                                    </li>
                                    <li class="flex items-start gap-2.5">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                                        <span>Auditoria semestral de cibersegurança e testes de intrusão</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="pt-8">
                                <button @click="openRequestWithPreselection(4, 'Consultoria Suporte TI Enterprise')"
                                    class="w-full py-3 px-4 rounded-xl border border-slate-600 hover:border-amber-400 text-white font-bold text-xs transition duration-200 shadow-sm flex items-center justify-center gap-2">
                                    <span>Solicitar Proposta Enterprise</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 3: DIFERENCIAIS DA GESTÃO DE TI RACHI -->
            <section class="py-16 bg-white border-b border-slate-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-3xl mx-auto mb-12">
                        <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">Porquê Escolher a
                            RACHI</span>
                        <h2 class="text-3xl font-black text-slate-900 mt-1">Por que Terceirizar a Sua TI Connosco?</h2>
                        <p class="text-slate-600 text-sm mt-2">Reduza em até 60% os custos com equipa técnica interna e
                            ganhe acesso imediato a engenheiros de software e especialistas de redes.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div
                            class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-blue-400 hover:bg-white transition duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Prevenção Ativa</h4>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                Monitorizamos discos, temperaturas e conectividade para resolver anomalias antes que
                                elas causem paragens na sua operação.
                            </p>
                        </div>

                        <div
                            class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-amber-400 hover:bg-white transition duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-4">
                                <i data-lucide="lock" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Segurança de Dados</h4>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                Blindagem de redes e cópias de segurança criptografadas em nuvem imutável, prevenindo
                                sequestro de dados por ransomware.
                            </p>
                        </div>

                        <div
                            class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-emerald-400 hover:bg-white transition duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                                <i data-lucide="users-round" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Equipa Multidisciplinar</h4>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                Especialistas certificados em Microsoft, Cisco, MikroTik, Linux e Desenvolvimento Web
                                trabalhando juntos para o seu negócio.
                            </p>
                        </div>

                        <div
                            class="p-6 rounded-2xl bg-slate-50 border border-slate-200 hover:border-cyan-400 hover:bg-white transition duration-300">
                            <div
                                class="w-12 h-12 rounded-xl bg-cyan-100 text-cyan-700 flex items-center justify-center mb-4">
                                <i data-lucide="file-check" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-base font-bold text-slate-900">Transparência Total</h4>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                Relatórios mensais executivos detalhando chamados resolvidos, inventário de ativos e
                                recomendações de melhorias tecnológicas.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO 4: SIMULADOR / FORMULÁRIO DE COTAÇÃO RÁPIDA -->
            <section id="cotacao-capital" class="py-16 bg-slate-900 text-white relative overflow-hidden">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="text-center mb-10">
                        <span
                            class="text-amber-400 font-bold text-xs uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/30">
                            Proposta Sob Medida
                        </span>
                        <h2 class="text-3xl font-extrabold text-white mt-3">Solicite um Orçamento Técnico ou Diagnóstico
                            Gratuito</h2>
                        <p class="text-slate-300 text-sm mt-2 max-w-xl mx-auto">
                            Diga-nos o que a sua empresa precisa e receba uma proposta técnica detalhada com escopo,
                            prazos e valores em até 24 horas úteis.
                        </p>
                    </div>

                    <div class="bg-slate-800/90 border border-slate-700 rounded-3xl p-6 sm:p-10 shadow-2xl backdrop-blur-sm"
                        x-data="{
                            companyName: '',
                            serviceCategory: 'Criação de Website Institucional',
                            workstationCount: '1 a 5 computadores',
                            urgency: 'Imediato (em até 7 dias)',
                            messageText: '',
                            sendToWhatsApp() {
                                let text = '*SOLICITAÇÃO DE SERVIÇO - RACHI CAPITAL*\n';
                                text += '🏢 *Empresa:* ' + (this.companyName || 'Não informado') + '\n';
                                text += '🛠️ *Serviço Pretendido:* ' + this.serviceCategory + '\n';
                                text += '💻 *Dimensão / Postos:* ' + this.workstationCount + '\n';
                                text += '⏱️ *Urgência:* ' + this.urgency + '\n';
                                if(this.messageText) text += '📝 *Mensagem:* ' + this.messageText + '\n';
                                const url = 'https://wa.me/244923000000?text=' + encodeURIComponent(text);
                                window.open(url, '_blank');
                            }
                         }">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Nome
                                    da Empresa / Solicitante *</label>
                                <input type="text" x-model="companyName" placeholder="Ex: Grupo Atlântico, Lda"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-500 transition">
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Serviço
                                    Pretendido *</label>
                                <select x-model="serviceCategory"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-500 transition">
                                    <option value="Criação de Website Institucional">Criação de Website Institucional (a
                                        partir de 150.000 AOA)</option>
                                    <option value="Loja Virtual / E-Commerce">Loja Virtual / E-Commerce (a partir de
                                        250.000 AOA)</option>
                                    <option value="Sistema de Gestão Sob Medida (ERP/CRM)">Sistema de Gestão Sob Medida
                                        (ERP/CRM)</option>
                                    <option value="Contrato de Suporte TI Startup (85.000 AOA/mês)">Contrato de Suporte
                                        TI Startup (85.000 AOA/mês)</option>
                                    <option value="Contrato de Suporte TI Business (195.000 AOA/mês)">Contrato de
                                        Suporte TI Business (195.000 AOA/mês)</option>
                                    <option value="Contrato de Suporte TI Enterprise">Contrato de Suporte TI Enterprise
                                    </option>
                                    <option value="Auditoria e Reestruturação de Redes">Auditoria e Reestruturação de
                                        Redes</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Dimensão
                                    da Empresa / Postos</label>
                                <select x-model="workstationCount"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-500 transition">
                                    <option value="1 a 5 computadores">1 a 5 postos de trabalho</option>
                                    <option value="6 a 15 computadores">6 a 15 postos de trabalho</option>
                                    <option value="16 a 30 computadores">16 a 30 postos de trabalho</option>
                                    <option value="Mais de 30 computadores / Múltiplas filiais">Mais de 30 postos /
                                        Múltiplas filiais</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Prazo
                                    de Início Desejado</label>
                                <select x-model="urgency"
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-500 transition">
                                    <option value="Imediato (em até 7 dias)">Imediato (em até 7 dias)</option>
                                    <option value="Dentro de 1 mês">Dentro de 1 mês</option>
                                    <option value="Planeamento para próximo trimestre">Planeamento para próximo
                                        trimestre</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">Descreva
                                    os detalhes do projeto ou os problemas atuais de TI</label>
                                <textarea x-model="messageText" rows="3"
                                    placeholder="Ex: Precisamos renovar nosso site antigo para vender online e de um suporte mensal para os 12 computadores do escritório..."
                                    class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-500 transition"></textarea>
                            </div>
                        </div>

                        <div
                            class="mt-8 pt-6 border-t border-slate-700/80 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-xs text-slate-400 text-center sm:text-left">
                                <i data-lucide="shield-check" class="w-4 h-4 inline text-amber-400 mr-1"></i>
                                Proposta formal enviada em PDF timbrado com SLA e garantias.
                            </div>
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                <button @click="sendToWhatsApp()"
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/30">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    <span>Enviar no WhatsApp</span>
                                </button>
                                <button
                                    @click="openRequestWithPreselection(4, serviceCategory + ' - ' + (companyName || 'Cotação'))"
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-yellow-500 hover:from-amber-600 hover:to-yellow-600 text-slate-950 font-extrabold text-xs transition flex items-center justify-center gap-2 shadow-lg shadow-amber-900/30">
                                    <i data-lucide="send" class="w-4 h-4"></i>
                                    <span>Pedir Proposta Formal</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- SUB-PAGE: LOJA OFICIAL (REPLICA EXACTA DE https://hom.rachi.ao/loja) -->
        <!-- ============================================================== -->
        <div x-show="currentTab === 'loja'" x-cloak class="min-h-screen bg-slate-50">

            <!-- STORE HERO BANNER -->
            <section class="bg-[#071326] text-white pt-12 pb-16 px-6 lg:px-12 border-b border-slate-800">
                <div class="max-w-7xl mx-auto">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                        <a href="#home" @click.prevent="goToHome()"
                            class="hover:text-white transition cursor-pointer">Início</a>
                        <span class="text-slate-600">/</span>
                        <span class="text-amber-400 font-bold">Loja</span>
                    </nav>

                    <div class="max-w-3xl">
                        <span
                            class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
                            Loja Corporativa RACHI
                        </span>
                        <h1 class="text-3xl md:text-5xl font-[850] text-white mt-3 uppercase tracking-tight">
                            Produtos para a sua <span class="text-[#eba72d]">empresa</span>
                        </h1>
                        <p class="text-slate-300 text-base md:text-lg mt-3 leading-relaxed">
                            Encontre consumíveis, equipamentos, software e serviços num único lugar com entrega
                            garantida em Luanda.
                        </p>
                    </div>

                    <!-- Search Bar -->
                    <div class="mt-8 max-w-2xl">
                        <div
                            class="relative flex items-center bg-white rounded-2xl p-1.5 shadow-2xl border border-slate-200">
                            <span class="pl-3 text-slate-400">
                                <i data-lucide="search" class="w-5 h-5"></i>
                            </span>
                            <input type="search" x-model="storeSearchQuery"
                                placeholder="Pesquisar por nome ou referência..."
                                class="w-full px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent focus:outline-none">
                            <button @click="$nextTick(() => lucide.createIcons())"
                                class="px-6 py-2.5 bg-[#071326] hover:bg-amber-500 hover:text-slate-950 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition whitespace-nowrap">
                                Pesquisar
                            </button>
                        </div>
                    </div>

                    <!-- Store Benefits -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 pt-8 border-t border-slate-800/80">
                        <div class="flex items-center gap-3 text-xs text-slate-300">
                            <div
                                class="w-8 h-8 rounded-lg bg-blue-500/10 text-cyan-400 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="truck" class="w-4 h-4"></i>
                            </div>
                            <span>Entrega em Luanda com prazo a combinar</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-300">
                            <div
                                class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="store" class="w-4 h-4"></i>
                            </div>
                            <span>Levantamento nas instalações RACHI sem custos</span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-300">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="shield-check" class="w-4 h-4"></i>
                            </div>
                            <span>Facturação e garantia empresarial formal</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- STORE CATALOG & FILTER TOOLBAR -->
            <section class="py-12 px-6 lg:px-12 max-w-7xl mx-auto">

                <!-- Category Tabs & Sort Controls -->
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm mb-8">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <!-- Category Filter Pills -->
                        <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-none">
                            <button @click="storeCategory = 'todas'"
                                :class="storeCategory === 'todas' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Todas as Categorias
                            </button>
                            <button @click="storeCategory = 'Personalizado_Gráfica'"
                                :class="storeCategory === 'Personalizado_Gráfica' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Personalizado_Gráfica
                            </button>
                            <button @click="storeCategory = 'Consumíveis'"
                                :class="storeCategory === 'Consumíveis' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Consumíveis
                            </button>
                            <button @click="storeCategory = 'Material de Escritório'"
                                :class="storeCategory === 'Material de Escritório' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Material de Escritório
                            </button>
                            <button @click="storeCategory = 'Informática e Tecnologia'"
                                :class="storeCategory === 'Informática e Tecnologia' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Informática e Tecnologia
                            </button>
                            <button @click="storeCategory = 'Impressão e Papelaria'"
                                :class="storeCategory === 'Impressão e Papelaria' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Impressão e Papelaria
                            </button>
                            <button @click="storeCategory = 'Material Promocional'"
                                :class="storeCategory === 'Material Promocional' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'"
                                class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap">
                                Material Promocional
                            </button>
                        </div>

                        <!-- Sort dropdown -->
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-xs font-semibold text-slate-500">Ordenar por:</span>
                            <select x-model="storeSort"
                                class="text-xs font-semibold bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 text-slate-700 focus:outline-none focus:border-blue-500">
                                <option value="recentes">Mais recentes</option>
                                <option value="preco_menor">Menor preço</option>
                                <option value="preco_maior">Maior preço</option>
                                <option value="nome">Nome (A-Z)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    <template x-for="p in filteredStoreProducts" :key="p.slug">
                        <article
                            class="bg-white dark:bg-[#0c1a33] rounded-2xl border border-slate-200 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-xl hover:border-amber-400 dark:hover:border-amber-400/80 transition-all duration-300 flex flex-col justify-between group">
                            <!-- Product Media & Badges -->
                            <div class="h-56 bg-slate-50 dark:bg-gradient-to-b dark:from-white/5 dark:to-[#071326] dark:border-b dark:border-white/10 p-6 flex items-center justify-center relative overflow-hidden">
                                <img :src="p.image" :alt="p.title"
                                    class="max-h-full max-w-full object-contain dark:drop-shadow-[0_12px_20px_rgba(0,0,0,0.7)] group-hover:scale-105 transition-transform duration-300">

                                <div class="absolute top-3 left-3 flex flex-col gap-1">
                                    <span x-show="p.badge" x-text="p.badge"
                                        class="px-2.5 py-1 bg-amber-500 text-slate-950 font-black text-[10px] rounded-md uppercase tracking-wider shadow-sm"></span>
                                </div>
                            </div>

                            <!-- Product Body -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400"
                                        x-text="p.category"></p>
                                    <h3 class="font-bold text-slate-900 dark:text-white text-sm mt-1 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-amber-400 transition"
                                        x-text="p.title"></h3>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10">
                                    <!-- Price -->
                                    <div class="flex items-baseline gap-2 mb-2">
                                        <strong class="text-base font-black text-slate-900 dark:text-white" x-text="p.price"></strong>
                                        <span x-show="p.oldPrice" class="text-xs text-slate-400 line-through"
                                            x-text="p.oldPrice"></span>
                                    </div>

                                    <!-- Stock -->
                                    <p
                                        class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1.5 mb-4">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        <span x-text="p.stockText || 'Disponível'"></span>
                                    </p>

                                    <!-- Buttons -->
                                    <div class="space-y-2">
                                        <button @click="addToCartFromStore(p)"
                                            class="w-full py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm shadow-amber-500/20 transition flex items-center justify-center gap-2">
                                            <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                                            <span>Adicionar ao carrinho</span>
                                        </button>
                                        <button @click="openProductModal(p)"
                                            class="w-full py-1.5 text-center text-xs font-bold text-slate-600 hover:text-blue-600 transition flex items-center justify-center gap-1">
                                            <span>Ver detalhes</span>
                                            <span aria-hidden="true">&rarr;</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </template>
                </div>

                <!-- Empty State if no products match -->
                <div x-show="filteredStoreProducts.length === 0"
                    class="text-center py-16 bg-white rounded-2xl border border-slate-200 mt-6">
                    <i data-lucide="package-open" class="w-12 h-12 text-slate-400 mx-auto mb-3"></i>
                    <h3 class="text-lg font-bold text-slate-900">Nenhum produto encontrado</h3>
                    <p class="text-sm text-slate-500 mt-1">Tente pesquisar com outros termos ou selecione outra
                        categoria.</p>
                    <button @click="storeCategory = 'todas'; storeSearchQuery = ''"
                        class="mt-4 px-4 py-2 bg-slate-900 text-white text-xs font-bold rounded-lg">
                        Limpar Filtros
                    </button>
                </div>
            </section>
        </div>

        <!-- PRODUCT DETAILS MODAL -->
        <div x-show="productModalOpen" x-cloak
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
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
                                <span>Em estoque — Entrega em Luanda</span>
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


        <!-- FOOTER EXACT TO RACHI -->
        <footer class="bg-[#071326] text-white pt-16 pb-8 border-t border-slate-800 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div>
                        <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-10 mb-4">
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Um ecossistema de soluções inteligentes para impulsionar negócios e pessoas em Angola e no
                            mundo.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Áreas de Negócio</h4>
                        <ul class="space-y-2 text-xs text-slate-400">
                            <li><a href="/tec" class="hover:text-white transition">RACHI Tec</a></li>
                            <li><a href="/print" class="hover:text-white transition">RACHI Print</a></li>
                            <li><a href="/academy" class="hover:text-white transition">RACHI Academy</a></li>
                            <li><a href="/capital" class="hover:text-white transition">RACHI Human Capital</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Sobre Nós</h4>
                        <ul class="space-y-2 text-xs text-slate-400">
                            <li><a href="#sobre" @click.prevent="scrollToSection('sobre')" class="hover:text-white transition">Quem somos</a></li>
                            <li><a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos')" class="hover:text-white transition">O que fazemos</a></li>
                            <li><a href="#parceiros" @click.prevent="scrollToSection('parceiros')" class="hover:text-white transition">Parceiros</a></li>
                            <li><a href="#etica" @click.prevent="currentTab = 'etica'" class="hover:text-white transition">Ética e Compliance</a></li>
                            <li><a href="/contacto" class="hover:text-white transition">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-500 mb-3">Localização</h4>
                        <p class="text-xs text-slate-400">Luanda — Angola</p>
                        <p class="text-xs text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    </div>
                </div>
                <div class="border-t border-slate-800 pt-6 flex justify-between items-center text-xs text-slate-500">
                    <div>&copy; 2026 RACHI. Todos os direitos reservados.</div>
                    <div class="flex gap-4 items-center">
                        <span class="text-amber-500 font-bold">PT</span>
                        <span class="text-slate-600">|</span>
                        <span class="hover:text-white cursor-pointer transition">EN</span>
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
         class="fixed top-20 right-4 sm:right-6 z-[100] max-w-md w-full bg-slate-900/95 rounded-2xl p-4 shadow-2xl backdrop-blur-xl text-white border transition-colors duration-300"
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
        class="fixed inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4 z-50 transition-all duration-300"
        x-cloak
        x-init="$watch('loginModal', val => document.body.style.overflow = val ? 'hidden' : '')"
        @click.self="loginModal = false">
        <div :class="authTab === 'register' ? 'max-w-xl' : 'max-w-md'"
             class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl w-full p-5 sm:p-6 shadow-2xl text-slate-800 dark:text-white relative overflow-hidden transition-all duration-300">
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
                    <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                         alt="RACHI" class="h-8 object-contain hidden dark:block">
                </div>
                <button @click="loginModal = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
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
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">
                            Todos os utilizadores acedem pelo mesmo login. Use o e-mail e a palavra-passe da sua conta RACHI.
                        </p>
                    </div>
                </template>
                <template x-if="authTab === 'register'">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                            <span>Criar conta</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                            Cadastre-se como particular ou empresa. Enviaremos a palavra-passe temporária e o código de activação para o seu e-mail.
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
                        <input type="text" x-model="authForm.email" required
                               placeholder="ex: seu.email@empresa.com"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
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
                        <input :type="authForm.showPassword ? 'text' : 'password'" x-model="authForm.password" required
                               placeholder="••••••••"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl pl-10 pr-10 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        <button type="button" @click="authForm.showPassword = !authForm.showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 cursor-pointer">
                            <span x-text="authForm.showPassword ? '🙈' : '👁️'" class="text-xs"></span>
                        </button>
                    </div>
                </div>

                <!-- Botão de Ação: Login -->
                <button type="submit"
                        :disabled="authLoading"
                        class="w-full mt-2 py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#0050f0] via-[#0284c7] to-[#00a3e0] hover:from-[#0040d0] hover:to-[#0274b5] text-white font-bold text-sm uppercase tracking-wider shadow-lg shadow-blue-500/25 transition-all flex items-center justify-center gap-2 transform active:scale-[0.99] cursor-pointer">
                    <template x-if="!authLoading">
                        <div class="flex items-center gap-2">
                            <span>Acessar Plataforma</span>
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


                <!-- Endereço (opcional) -->
                <div class="pt-2 border-t border-slate-200/70 dark:border-slate-700/60 space-y-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-slate-200">
                            Endereço (opcional)
                        </label>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400">
                            Se preencher o endereço, indique pelo menos a província e o município.
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
                <p class="text-center text-xs text-slate-500 dark:text-slate-400 pt-1">
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
         class="fixed inset-0 bg-slate-950/60 dark:bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4 z-50 transition-all duration-300" 
         x-cloak 
         @click.self="matriculaModalOpen = false">
        <div class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl text-slate-800 dark:text-white relative overflow-hidden transition-all duration-300">
            <!-- Glow background effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 dark:bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Botão Fechar -->
            <div class="flex justify-end mb-1 relative z-10">
                <button @click="matriculaModalOpen = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
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
    <div x-show="cartDrawer" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
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
                                <span class="text-xs text-slate-500"
                                    x-text="item.price.toLocaleString('pt-AO') + ' AOA'"></span>
                            </div>
                        </div>
                        <button @click="removeFromCart(index)"
                            class="text-rose-500 hover:text-rose-700 text-xs font-semibold">Remover</button>
                    </div>
                </template>
            </div>
            <div class="p-6 bg-slate-50 border-t space-y-3" x-show="cart.length > 0">
                <div class="flex justify-between font-bold text-base">
                    <span>Total:</span>
                    <span class="text-amber-600" x-text="cartTotal.toLocaleString('pt-AO') + ' AOA'"></span>
                </div>
                <button @click="checkoutSimulated()"
                    class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-lg shadow">
                    Finalizar Compra (Pagamento via Multicaixa)
                </button>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- VIEW 2: CLIENT PORTAL (AUTHENTICATED)                          -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- VIEW 2: CLIENT PORTAL (PREMIUM EXECUTIVE SAAS)                 -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'customer'" x-cloak
         :class="customerDarkMode ? 'bg-slate-950 text-slate-100 dark' : 'bg-[#f8fafc] text-slate-800'"
         class="min-h-screen flex flex-col transition-colors duration-200">

        <!-- HEADER EXECUTIVO DO CLIENTE -->
        <header :class="customerDarkMode ? 'bg-[#071326] text-white border-slate-800 shadow-lg' : 'bg-white text-slate-800 border-slate-200/90 shadow-sm'"
                class="h-[68px] flex items-center justify-between px-4 sm:px-6 lg:px-8 border-b sticky top-0 z-40 transition-colors duration-200">
            <!-- Esquerda: Logótipo, Divisor e Badges de Status -->
            <div class="flex items-center gap-3 sm:gap-4">
                <a href="#home" @click.prevent="goToHome()" class="flex items-center group cursor-pointer">
                    <img :src="customerDarkMode ? '/images/logo-rachi-light.png' : '/images/logo-rachi-dark.png'" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi.png'"
                         alt="RACHI" class="h-8 sm:h-9 w-auto object-contain">
                </a>
                <div :class="customerDarkMode ? 'bg-slate-700' : 'bg-slate-200'" class="h-5 w-px hidden sm:block"></div>
                <div class="flex items-center gap-2">
                    <span :class="customerDarkMode ? 'bg-blue-900/60 text-blue-300 border-blue-600/50' : 'bg-blue-50 text-blue-700 border-blue-200'"
                          class="text-xs px-2.5 py-0.5 rounded-full font-bold border flex items-center gap-1.5 shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>Portal do Cliente VIP</span>
                    </span>
                    <span :class="customerDarkMode ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'bg-emerald-50 text-emerald-700 border-emerald-200'"
                          class="hidden md:inline-flex text-[11px] px-2 py-0.5 rounded-full font-semibold border items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        SSL 256-bit
                    </span>
                </div>
            </div>

            <!-- Centro: Barra de Busca Rápida no Painel (Filtro em Tempo Real) -->
            <div class="hidden md:flex items-center flex-1 max-w-md mx-6">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" x-model="customerSearchQuery"
                           placeholder="Buscar por protocolo, serviço, orçamento, fatura..."
                           :class="customerDarkMode ? 'bg-slate-900/90 border-slate-700/80 text-slate-200 placeholder-slate-400 focus:border-blue-400' : 'bg-slate-100 border-slate-200 text-slate-800 placeholder-slate-400 focus:bg-white focus:border-blue-500'"
                           class="w-full border rounded-full pl-9 pr-8 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-blue-400 transition">
                    <button x-show="customerSearchQuery" @click="customerSearchQuery = ''"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 dark:hover:text-white">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <!-- Direita: Ações, Alternador de Modo, Notificações, Voltar ao Site & Perfil -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Alternador Dark / Light Mode na Área do Cliente (Sincronizado) -->
                <button @click="toggleTheme()"
                        :title="customerDarkMode ? 'Mudar para Tema Claro' : 'Mudar para Tema Escuro'"
                        :class="customerDarkMode ? 'bg-slate-900/80 hover:bg-slate-800 border-slate-700/80 text-blue-400' : 'bg-slate-100 hover:bg-slate-200 border-slate-200 text-slate-700 hover:text-blue-600'"
                        class="p-2 rounded-xl border transition flex items-center justify-center cursor-pointer">
                    <template x-if="!customerDarkMode">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </template>
                    <template x-if="customerDarkMode">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </template>
                </button>

                <!-- Notificações com Dropdown -->
                <div class="relative" x-data="{ notifOpen: false }" @click.away="notifOpen = false">
                    <button @click="notifOpen = !notifOpen"
                            :class="customerDarkMode ? 'bg-slate-900/80 hover:bg-slate-800 border-slate-700/80 text-slate-300 hover:text-white' : 'bg-slate-100 hover:bg-slate-200 border-slate-200 text-slate-700 hover:text-blue-600'"
                            class="relative p-2 rounded-xl border transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute top-1 right-1 w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    </button>

                    <!-- Painel de Notificações -->
                    <div x-show="notifOpen" x-cloak
                         :class="customerDarkMode ? 'bg-slate-900/98 border-slate-700 text-white' : 'bg-white border-slate-200 text-slate-800 shadow-2xl'"
                         class="absolute right-0 mt-2 w-80 sm:w-96 rounded-2xl backdrop-blur-xl border p-4 z-50 text-xs">
                        <div :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'"
                             class="flex items-center justify-between pb-2.5 border-b">
                            <span :class="customerDarkMode ? 'text-slate-100' : 'text-slate-900'"
                                  class="font-bold flex items-center gap-1.5">
                                <span>Notificações em Tempo Real</span>
                                <span class="px-1.5 py-0.2 rounded-full bg-blue-500/20 text-blue-600 dark:text-blue-400 text-[10px] font-bold" x-text="customerNotifications.length"></span>
                            </span>
                            <button @click="customerNotifications.forEach(n => n.unread = false); notifOpen = false" class="text-[10px] text-blue-600 font-bold hover:underline">Marcar lidas</button>
                        </div>
                        <div :class="customerDarkMode ? 'divide-slate-800/80' : 'divide-slate-100'"
                             class="divide-y max-h-72 overflow-y-auto">
                            <template x-for="n in customerNotifications" :key="n.id">
                                <div :class="customerDarkMode ? 'hover:bg-slate-800/50' : 'hover:bg-slate-50'"
                                     class="py-3 flex items-start gap-3 px-2 rounded-xl transition cursor-pointer">
                                    <div class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span :class="customerDarkMode ? 'text-slate-200' : 'text-slate-800'"
                                                  class="font-bold" x-text="n.title"></span>
                                            <span class="text-[10px] text-slate-400" x-text="n.time"></span>
                                        </div>
                                        <p :class="customerDarkMode ? 'text-slate-400' : 'text-slate-500'"
                                           class="text-[11px] mt-0.5 leading-snug" x-text="n.text"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Botão Voltar ao Site -->
                <button @click="goToHome()"
                        :class="customerDarkMode ? 'text-slate-300 hover:text-white bg-slate-900/80 hover:bg-slate-800 border-slate-700/80' : 'text-slate-700 hover:text-blue-600 bg-slate-100 hover:bg-blue-50 border-slate-200'"
                        class="text-xs px-3 py-1.5 rounded-xl border flex items-center gap-1.5 transition">
                    <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="hidden sm:inline font-bold">Voltar ao Site</span>
                </button>

                <!-- Perfil do Usuário com Mini-Badge e Logout -->
                <div :class="customerDarkMode ? 'border-slate-800' : 'border-slate-200'"
                     class="flex items-center gap-2.5 pl-3 border-l">
                    <div class="text-right hidden lg:block">
                        <span :class="customerDarkMode ? 'text-slate-100' : 'text-slate-900'"
                              class="text-xs font-bold block leading-tight" x-text="currentUser ? currentUser.nome : 'Cliente Corporativo'"></span>
                        <span class="text-[10px] text-blue-600 dark:text-blue-400 font-bold block" x-text="currentUser && currentUser.has_matricula ? 'Matrícula Academy Ativa' : 'Acesso VIP Autorizado'"></span>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-md shadow-blue-500/20"
                         x-text="currentUser ? (currentUser.avatar || 'C') : 'C'">
                    </div>
                    <button @click="logout()" title="Terminar Sessão" class="text-slate-400 hover:text-rose-500 p-1.5 rounded-xl hover:bg-rose-500/10 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </div>
            </div>
        </header>

        <div class="flex-1 flex overflow-hidden">
            <!-- SIDEBAR MODERNA DO CLIENTE (BRANCA COM DESTAQUES EM AZUL) -->
            <aside :class="customerDarkMode ? 'bg-[#071326] text-white border-slate-800' : 'bg-white text-slate-800 border-slate-200/90 shadow-sm'"
                   class="w-64 lg:w-72 p-4 space-y-4 border-r flex flex-col justify-between shrink-0 overflow-y-auto transition-colors duration-200">
                <div class="space-y-4">
                    <!-- Card da Empresa / Cliente Conectado -->
                    <div :class="customerDarkMode ? 'bg-gradient-to-br from-slate-900 via-slate-900/90 to-[#0b2247]/60 border-slate-800' : 'bg-gradient-to-br from-blue-50/50 via-white to-slate-50 border-slate-200/90 shadow-sm'"
                         class="p-3.5 rounded-2xl border">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[10px] uppercase tracking-wider font-extrabold text-blue-600">Conta Corporativa</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-sm shadow-emerald-500/50"></span>
                        </div>
                        <div :class="customerDarkMode ? 'text-slate-100' : 'text-slate-900'"
                             class="font-bold text-sm truncate" x-text="currentUser ? (currentUser.empresa || currentUser.nome) : 'Inovquimua Angola'"></div>
                        <div class="text-[11px] text-slate-400 mt-0.5 flex items-center gap-1.5">
                            <span>ID: CLI-AO-9204</span>
                            <span>•</span>
                            <span class="text-blue-600 font-bold">Verificado</span>
                        </div>
                    </div>

                    <!-- Navegação Principal -->
                    <div>
                        <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 px-3 mb-2">Menu Principal</div>
                        <nav class="space-y-1">
                            <!-- Aba 1: Painel Geral -->
                            <button @click="customerTab = 'dashboard'"
                                    :class="customerTab === 'dashboard' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                    <span>Painel Geral</span>
                                </span>
                            </button>

                            <!-- Aba 2: Minhas Solicitações -->
                            <button @click="customerTab = 'requests'"
                                    :class="customerTab === 'requests' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                    <span>Minhas Solicitações</span>
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="customerTab === 'requests' ? 'bg-white/20 text-white' : (customerDarkMode ? 'bg-blue-500/20 text-blue-300' : 'bg-blue-100 text-blue-700')"
                                      x-text="customerRequests.length"></span>
                            </button>

                            <!-- Aba 3: Solicitar Novo Serviço (Destaque Azul) -->
                            <button @click="customerTab = 'new_request'"
                                    :class="customerTab === 'new_request' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-blue-300 bg-blue-500/10 hover:bg-blue-500/20 border border-blue-500/30' : 'text-blue-700 bg-blue-50/80 hover:bg-blue-100 border border-blue-200/90 font-bold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition font-semibold">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>+ Solicitar Serviço</span>
                                </span>
                                <span class="text-[9px] uppercase px-1.5 py-0.5 rounded bg-blue-600/20 text-blue-700 dark:text-blue-300 font-bold">Novo</span>
                            </button>

                            <!-- Aba 4: Meus Orçamentos -->
                            <button @click="customerTab = 'my_quotes'"
                                    :class="customerTab === 'my_quotes' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2zM10 8.5a.5.5 0 11-1 0 .5.5 0 011 0zm5 5a.5.5 0 11-1 0 .5.5 0 011 0z"/></svg>
                                    <span>Orçamentos &amp; Propostas</span>
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                      :class="customerTab === 'my_quotes' ? 'bg-white/20 text-white' : (customerDarkMode ? 'bg-blue-500/20 text-blue-300' : 'bg-blue-50 text-blue-700 border border-blue-200/60')"
                                      x-text="customerQuotes.filter(q => q.status === 'sent').length + ' Pendente'"></span>
                            </button>

                            <!-- Aba 5: Serviços & Contratos Ativos -->
                            <button @click="customerTab = 'contracts'"
                                    :class="customerTab === 'contracts' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    <span>Contratos &amp; SLAs</span>
                                </span>
                                <span :class="customerTab === 'contracts' ? 'bg-white/20 text-white' : (customerDarkMode ? 'bg-emerald-500/20 text-emerald-300' : 'bg-emerald-100 text-emerald-800')"
                                      class="px-1.5 py-0.5 rounded text-[10px] font-bold">2 Ativos</span>
                            </button>

                            <!-- Aba 6: Faturas & Documentos -->
                            <button @click="customerTab = 'documents'"
                                    :class="customerTab === 'documents' ? 'bg-blue-600 text-white font-bold shadow-md shadow-blue-600/25' : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')"
                                    class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition">
                                <span class="flex items-center gap-2.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                    <span>Faturas &amp; Recibos</span>
                                </span>
                            </button>
                        </nav>
                    </div>

                    <!-- Ecossistema Integrado (Academy & Loja) -->
                    <div :class="customerDarkMode ? 'border-slate-800' : 'border-slate-200'" class="pt-2 border-t">
                        <div class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400 px-3 mb-2">Ecossistema RACHI</div>
                        
                        <!-- Perfil Aluno (Academy) com validação de matrícula -->
                        <button @click="openAcademyAluno()"
                                class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition"
                                :class="currentUser && currentUser.has_matricula ? (customerDarkMode ? 'text-emerald-300 hover:bg-emerald-950/40 border border-emerald-500/30' : 'text-emerald-700 hover:bg-emerald-50 border border-emerald-200 font-bold') : (customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 border border-transparent' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold')">
                            <span class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                <span>RACHI Academy</span>
                            </span>
                            <template x-if="currentUser && currentUser.has_matricula">
                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold">Matriculado</span>
                            </template>
                            <template x-if="!currentUser || !currentUser.has_matricula">
                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 border border-blue-200/60 text-blue-700 font-bold">Cursos</span>
                            </template>
                        </button>

                        <!-- Loja Integrada -->
                        <a href="/loja"
                           :class="customerDarkMode ? 'text-slate-300 hover:bg-slate-800/80 hover:text-white' : 'text-slate-600 hover:bg-blue-50 hover:text-blue-700 font-semibold'"
                           class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs text-left transition mt-1">
                            <span class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                <span>Loja de Suprimentos &amp; TI</span>
                            </span>
                            <span class="text-slate-400 text-xs">&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Rodapé da Sidebar: Widget do Gestor de Atendimento Dedicado -->
                <div :class="customerDarkMode ? 'bg-gradient-to-b from-slate-900 to-[#071326] border-slate-800 text-white shadow-lg' : 'bg-slate-50 border-slate-200/90 text-slate-800 shadow-sm'"
                     class="mt-4 p-3.5 rounded-2xl border text-xs space-y-2.5">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center text-xs shadow-inner">
                                AM
                            </div>
                            <span :class="customerDarkMode ? 'ring-slate-900' : 'ring-white'"
                                  class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2"></span>
                        </div>
                        <div>
                            <div :class="customerDarkMode ? 'text-slate-200' : 'text-slate-900'"
                                 class="font-bold text-xs leading-tight">Eng. António Mendes</div>
                            <div class="text-[10px] text-blue-600 dark:text-blue-400 font-bold">Gestor de Atendimento VIP</div>
                        </div>
                    </div>
                    <p :class="customerDarkMode ? 'text-slate-400' : 'text-slate-500'"
                       class="text-[11px] leading-tight">
                        Disponível para suporte prioritário e alinhamento executivo.
                    </p>
                    <button @click="selectedRequest = customerRequests[0]; customerTab = 'view_request'"
                            :class="customerDarkMode ? 'bg-slate-800 hover:bg-blue-600 text-slate-200' : 'bg-white hover:bg-blue-600 hover:text-white text-slate-700 border border-slate-200 shadow-sm'"
                            class="w-full py-1.5 px-2.5 font-bold rounded-xl transition text-[11px] flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>Abrir Atendimento</span>
                    </button>
                </div>
            </aside>

            <!-- CONTEÚDO PRINCIPAL (MAIN CONTENT) -->
            <main :class="customerDarkMode ? 'bg-slate-950' : 'bg-[#f8fafc]'"
                  class="flex-1 p-5 sm:p-6 lg:p-8 overflow-y-auto transition-colors duration-200">

                <!-- ============================================================== -->
                <!-- ABA 1: PAINEL GERAL (DASHBOARD COMPLETO E SEM ESPAÇOS VAZIOS) -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'dashboard'" class="space-y-6">

                    <!-- Banner Executivo de Boas-Vindas (AZUL E BRANCO) -->
                    <div :class="customerDarkMode ? 'bg-gradient-to-r from-[#071326] via-[#0b244d] to-[#0c1b33] border-slate-800 text-white shadow-xl' : 'bg-white border-slate-200/90 text-slate-900 shadow-sm'"
                         class="relative overflow-hidden rounded-3xl p-6 sm:p-8 border transition-all">
                        <!-- Efeito de brilho radial ambiente de fundo (Apenas no Dark Mode) -->
                        <div x-show="customerDarkMode" class="absolute -right-16 -top-16 w-80 h-80 bg-blue-500/15 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                            <div class="max-w-2xl space-y-2">
                                <div :class="customerDarkMode ? 'bg-blue-950/60 border-blue-800 text-blue-300' : 'bg-blue-50 border-blue-200 text-blue-700'"
                                     class="inline-flex items-center gap-2 px-3 py-1 rounded-full border text-xs font-semibold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>Centro Integrado de Operações RACHI</span>
                                </div>
                                <h1 :class="customerDarkMode ? 'text-white' : 'text-slate-900'"
                                    class="text-2xl sm:text-3xl font-black tracking-tight">
                                    Olá, <span class="text-blue-600 dark:text-blue-400 font-black" x-text="currentUser ? currentUser.nome : 'Cliente Corporativo'"></span>!
                                </h1>
                                <p :class="customerDarkMode ? 'text-slate-300' : 'text-slate-600'"
                                   class="text-sm leading-relaxed">
                                    Acompanhe o andamento dos seus projetos de tecnologia, produção gráfica, capacitações e propostas comerciais em um só lugar.
                                </p>
                            </div>

                            <!-- Botões de Ação Imediata (Azul e Branco) -->
                            <div class="flex flex-wrap items-center gap-3">
                                <button @click="customerTab = 'new_request'"
                                        class="px-5 py-2.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs tracking-wide shadow-lg shadow-blue-600/25 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                    <span>NOVA SOLICITAÇÃO</span>
                                </button>
                                <button @click="customerTab = 'my_quotes'"
                                        :class="customerDarkMode ? 'bg-white/10 hover:bg-white/15 border-white/20 text-white' : 'bg-white hover:bg-blue-50 border-slate-200 text-slate-800 hover:text-blue-700'"
                                        class="px-4 py-2.5 rounded-2xl border font-bold text-xs backdrop-blur-md transition flex items-center gap-2 shadow-sm">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>Aprovar Proposta</span>
                                </button>
                                <button @click="openAcademyAluno()"
                                        :class="customerDarkMode ? 'bg-emerald-600/20 hover:bg-emerald-600/30 border-emerald-500/30 text-emerald-300' : 'bg-white hover:bg-emerald-50 border-emerald-200 text-emerald-700'"
                                        class="px-4 py-2.5 rounded-2xl border font-bold text-xs backdrop-blur-md transition flex items-center gap-2 shadow-sm">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                    <span>Sala de Aula</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Quatro Cards de Indicadores Executivos (KPIs) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                        <!-- KPI 1: Solicitações Ativas -->
                        <div class="p-5 rounded-2xl border transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer"
                             @click="customerTab = 'requests'"
                             :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                            <div class="flex items-center justify-between">
                                <span class="text-xs uppercase font-extrabold tracking-wider text-slate-400">Solicitações Ativas</span>
                                <div class="w-9 h-9 rounded-xl bg-blue-500/10 text-blue-500 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-2 mt-3">
                                <span class="text-3xl font-black text-slate-900 dark:text-white" x-text="customerRequests.length"></span>
                                <span class="text-xs font-bold text-blue-600 dark:text-blue-400">em andamento</span>
                            </div>
                            <div class="mt-3 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                                <span>1 Análise • 1 Execução</span>
                                <span class="text-blue-600 dark:text-blue-400 font-bold hover:underline">Ver todas &rarr;</span>
                            </div>
                        </div>

                        <!-- KPI 2: Orçamentos Pendentes -->
                        <div class="p-5 rounded-2xl border transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer"
                             @click="customerTab = 'my_quotes'"
                             :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                            <div class="flex items-center justify-between">
                                <span class="text-xs uppercase font-extrabold tracking-wider text-slate-400">Orçamentos Pendentes</span>
                                <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-500 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-2 mt-3">
                                <span class="text-2xl font-black text-amber-500">450.000 AOA</span>
                            </div>
                            <div class="mt-3 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                                <span class="text-amber-600 dark:text-amber-400 font-bold">Aguardando Aprovação</span>
                                <span class="text-amber-600 font-bold hover:underline">Aprovar &rarr;</span>
                            </div>
                        </div>

                        <!-- KPI 3: Serviços e Contratos -->
                        <div class="p-5 rounded-2xl border transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer"
                             @click="customerTab = 'contracts'"
                             :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                            <div class="flex items-center justify-between">
                                <span class="text-xs uppercase font-extrabold tracking-wider text-slate-400">Contratos &amp; SLAs</span>
                                <div class="w-9 h-9 rounded-xl bg-emerald-500/10 text-emerald-500 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                            </div>
                            <div class="flex items-baseline gap-2 mt-3">
                                <span class="text-3xl font-black text-emerald-500">2 Ativos</span>
                            </div>
                            <div class="mt-3 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                                <span>SLA Técnico: 4 Horas</span>
                                <span class="text-emerald-500 font-bold">100% Operacional</span>
                            </div>
                        </div>

                        <!-- KPI 4: Academy & Capacitação -->
                        <div class="p-5 rounded-2xl border transition-all duration-200 shadow-sm hover:shadow-md cursor-pointer"
                             @click="openAcademyAluno()"
                             :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                            <div class="flex items-center justify-between">
                                <span class="text-xs uppercase font-extrabold tracking-wider text-slate-400">RACHI Academy</span>
                                <div class="w-9 h-9 rounded-xl bg-indigo-500/10 text-indigo-500 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="text-base font-bold text-slate-900 dark:text-white truncate"
                                     x-text="currentUser && currentUser.has_matricula ? (currentUser.cursoMatriculado || 'Gestão Prática MPMEs') : 'Capacitação Executiva'"></div>
                            </div>
                            <div class="mt-3 text-xs flex items-center justify-between">
                                <span class="font-bold"
                                      :class="currentUser && currentUser.has_matricula ? 'text-emerald-500' : 'text-amber-500'"
                                      x-text="currentUser && currentUser.has_matricula ? 'Matrícula Ativa' : 'Matrícula Disponível'"></span>
                                <span class="text-indigo-500 font-bold hover:underline">Aceder &rarr;</span>
                            </div>
                        </div>
                    </div>

                    <!-- Grade de Duas Colunas (65% Esquerda + 35% Direita) -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        <!-- COLUNA DA ESQUERDA (2/3): Solicitações Detalhadas e Documentos -->
                        <div class="lg:col-span-2 space-y-6">

                            <!-- Card de Solicitações em Andamento -->
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pb-5 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div>
                                        <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                            <span>Projetos &amp; Solicitações em Andamento</span>
                                            <span class="text-xs px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-600 dark:text-blue-400 font-bold" x-text="filteredCustomerRequests().length"></span>
                                        </h2>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Acompanhe a esteira de atendimento técnico e prazos de entrega.</p>
                                    </div>

                                    <!-- Filtro de Status em Abas Rápidas -->
                                    <div class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 p-1 rounded-xl text-xs">
                                        <button @click="customerFilterStatus = 'all'"
                                                :class="customerFilterStatus === 'all' ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-slate-200'"
                                                class="px-2.5 py-1 rounded-lg transition">Todas</button>
                                        <button @click="customerFilterStatus = 'in_analysis'"
                                                :class="customerFilterStatus === 'in_analysis' ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-slate-200'"
                                                class="px-2.5 py-1 rounded-lg transition">Análise</button>
                                        <button @click="customerFilterStatus = 'in_progress'"
                                                :class="customerFilterStatus === 'in_progress' ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-slate-200'"
                                                class="px-2.5 py-1 rounded-lg transition">Execução</button>
                                        <button @click="customerFilterStatus = 'completed'"
                                                :class="customerFilterStatus === 'completed' ? 'bg-white dark:bg-slate-900 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-500 hover:text-slate-800 dark:hover:text-slate-200'"
                                                class="px-2.5 py-1 rounded-lg transition">Concluídas</button>
                                    </div>
                                </div>

                                <!-- Lista de Solicitações com Esteira Visual de Progresso -->
                                <div class="space-y-4 mt-5">
                                    <template x-for="req in filteredCustomerRequests()" :key="req.id">
                                        <div class="p-5 rounded-2xl border transition-all duration-200 hover:border-blue-400 group relative"
                                             :class="customerDarkMode ? 'bg-slate-950/60 border-slate-800' : 'bg-slate-50/70 border-slate-200/80'">
                                            <!-- Topo do Card: Protocolo, Unidade, Prioridade e Data -->
                                            <div class="flex flex-wrap items-center justify-between gap-2">
                                                <div class="flex items-center gap-2.5">
                                                    <span class="font-mono font-bold text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 px-2.5 py-1 rounded-lg border border-blue-200/60 dark:border-blue-900/60"
                                                          x-text="req.protocol"></span>
                                                    <span class="text-xs font-bold px-2.5 py-0.5 rounded-full border"
                                                          :class="req.unitBadge || 'bg-slate-100 text-slate-700'"
                                                          x-text="req.unit"></span>
                                                    <span class="text-[11px] font-semibold px-2 py-0.5 rounded border"
                                                          :class="req.priorityBadge || 'bg-slate-100 text-slate-600'"
                                                          x-text="'Prioridade ' + req.priority"></span>
                                                </div>
                                                <span class="text-xs font-semibold px-3 py-1 rounded-full"
                                                      :class="getStatusBadgeClass(req.status)"
                                                      x-text="req.statusLabel"></span>
                                            </div>

                                            <!-- Título e Descrição -->
                                            <div class="mt-3">
                                                <h3 class="font-bold text-base text-slate-900 dark:text-slate-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition"
                                                    x-text="req.title"></h3>
                                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed"
                                                   x-text="req.description"></p>
                                            </div>

                                            <!-- Esteira Visual de Progresso (5 Fases) -->
                                            <div class="mt-4 pt-4 border-t"
                                                 :class="customerDarkMode ? 'border-slate-800' : 'border-slate-200/60'">
                                                <div class="flex items-center justify-between text-[11px] font-semibold text-slate-500 dark:text-slate-400 mb-2">
                                                    <span class="flex items-center gap-1.5">
                                                        <span class="w-2 h-2 rounded-full"
                                                              :class="req.status === 'completed' ? 'bg-emerald-500' : 'bg-blue-600 animate-pulse'"></span>
                                                        <span>Progresso do Serviço</span>
                                                    </span>
                                                    <span class="font-mono font-bold text-slate-700 dark:text-slate-300" x-text="req.progressPercent + '% Concluído'"></span>
                                                </div>
                                                <!-- Barra de Progresso Gradual em Tons de Azul RACHI -->
                                                <div class="w-full h-2 bg-slate-200 dark:bg-slate-800 rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-blue-600 to-cyan-500 rounded-full transition-all duration-500"
                                                         :style="'width: ' + req.progressPercent + '%'"></div>
                                                </div>
                                                <!-- Marcadores de Etapa -->
                                                <div class="grid grid-cols-5 text-[10px] text-center mt-2 text-slate-400">
                                                    <span :class="req.step >= 1 ? 'text-blue-600 dark:text-blue-400 font-bold' : ''">1. Briefing</span>
                                                    <span :class="req.step >= 2 ? 'text-blue-600 dark:text-blue-400 font-bold' : ''">2. Análise</span>
                                                    <span :class="req.step >= 3 ? 'text-blue-600 dark:text-blue-400 font-bold' : ''">3. Orçamento</span>
                                                    <span :class="req.step >= 4 ? 'text-indigo-600 dark:text-indigo-400 font-bold' : ''">4. Execução</span>
                                                    <span :class="req.step >= 5 ? 'text-emerald-500 font-bold' : ''">5. Entrega</span>
                                                </div>
                                            </div>

                                            <!-- Rodapé do Card: Técnico Designado e Ações -->
                                            <div class="mt-4 pt-3 flex flex-wrap items-center justify-between gap-3 text-xs border-t"
                                                 :class="customerDarkMode ? 'border-slate-800/80' : 'border-slate-200/50'">
                                                <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-[11px]">
                                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                    <span x-text="'Técnico: ' + (req.technician || 'Equipe Técnica RACHI')"></span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <button @click="selectedRequest = req; customerTab = 'view_request'"
                                                            class="px-3.5 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs transition flex items-center gap-1.5 shadow-sm shadow-blue-600/20">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                                        <span>Abrir Chat &amp; Detalhes</span>
                                                    </button>
                                                    <template x-if="req.status === 'quoted'">
                                                        <button @click="customerTab = 'my_quotes'"
                                                                class="px-3 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 dark:bg-blue-950/60 dark:text-blue-300 border border-blue-200 dark:border-blue-800 font-bold text-xs transition shadow-sm">
                                                            Aprovar Proposta
                                                        </button>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <!-- Card de Documentos Recentes & Faturas Proforma -->
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex items-center justify-between pb-4 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div>
                                        <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            <span>Faturas Proforma &amp; Recibos Recentes</span>
                                        </h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Consulte comprovativos e referências para pagamento bancário via Multicaixa.</p>
                                    </div>
                                    <button @click="customerTab = 'documents'" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline">Ver todas &rarr;</button>
                                </div>

                                <div class="overflow-x-auto mt-4">
                                    <table class="w-full text-left text-xs">
                                        <thead>
                                            <tr class="text-[10px] uppercase font-bold text-slate-400 border-b"
                                                :class="customerDarkMode ? 'border-slate-800' : 'border-slate-200'">
                                                <th class="py-2.5 px-3">Documento</th>
                                                <th class="py-2.5 px-3">Unidade</th>
                                                <th class="py-2.5 px-3">Descrição</th>
                                                <th class="py-2.5 px-3">Valor (AOA)</th>
                                                <th class="py-2.5 px-3">Estado</th>
                                                <th class="py-2.5 px-3 text-right">Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y"
                                               :class="customerDarkMode ? 'divide-slate-800/60' : 'divide-slate-100'">
                                            <template x-for="inv in customerInvoices" :key="inv.id">
                                                <tr class="hover:bg-slate-500/5 transition">
                                                    <td class="py-3 px-3 font-mono font-bold text-blue-600 dark:text-blue-400" x-text="inv.id"></td>
                                                    <td class="py-3 px-3">
                                                        <span class="px-2 py-0.5 rounded-full font-semibold text-[10px] bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300" x-text="inv.unit"></span>
                                                    </td>
                                                    <td class="py-3 px-3 text-slate-700 dark:text-slate-300 font-medium" x-text="inv.desc"></td>
                                                    <td class="py-3 px-3 font-bold text-slate-900 dark:text-white" x-text="inv.value.toLocaleString('pt-AO') + ' AOA'"></td>
                                                    <td class="py-3 px-3">
                                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                                              :class="inv.status === 'paid' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400'"
                                                              x-text="inv.statusLabel"></span>
                                                    </td>
                                                    <td class="py-3 px-3 text-right">
                                                        <button @click="mockDownloadDoc(inv.id)"
                                                                class="px-2.5 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-semibold text-[11px] transition inline-flex items-center gap-1">
                                                            <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                            <span>PDF</span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- COLUNA DA DIREITA (1/3): Gestor Dedicado, Radar das 4 Unidades & Suporte -->
                        <div class="space-y-6">

                            <!-- Widget: Meu Gestor de Atendimento Dedicado -->
                            <div class="p-6 rounded-3xl border shadow-sm relative overflow-hidden"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex items-center justify-between pb-4 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <span class="text-xs uppercase font-extrabold tracking-wider text-slate-400">Atendimento Dedicado</span>
                                    <span class="flex items-center gap-1.5 text-[11px] font-bold text-emerald-500">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Online Agora
                                    </span>
                                </div>

                                <div class="mt-4 flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#00a3e0] to-[#071326] text-white font-black text-lg flex items-center justify-center shadow-lg shrink-0">
                                        AM
                                    </div>
                                    <div>
                                        <h3 class="font-extrabold text-base text-slate-900 dark:text-white">Eng. António Mendes</h3>
                                        <p class="text-xs text-blue-600 dark:text-blue-400 font-bold">Gestor de Atendimento Corporativo</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">Grupo RACHI • Luanda, Angola</p>
                                    </div>
                                </div>

                                <div class="mt-5 space-y-2.5 text-xs text-slate-600 dark:text-slate-300">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        <span>antonio.mendes@rachi.ao</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        <span>+244 923 000 000 (Linha Direta VIP)</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Horário: 08:00 às 18:00 (Segunda a Sexta)</span>
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-2 gap-2">
                                    <button @click="selectedRequest = customerRequests[0]; customerTab = 'view_request'"
                                            class="py-2.5 px-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-md shadow-blue-600/20">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                        <span>Chat Direto</span>
                                    </button>
                                    <a href="https://wa.me/244923000000" target="_blank"
                                       class="py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                        <span>WhatsApp</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Widget: Status do Ecossistema nas 4 Unidades RACHI -->
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">Status nas 4 Unidades RACHI</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">Serviços ativos e disponíveis para sua empresa.</p>

                                <div class="space-y-3 text-xs">
                                    <!-- RACHI Tec -->
                                    <div class="p-3 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-blue-500/20 text-blue-500 font-bold flex items-center justify-center text-[10px]">TEC</div>
                                            <div>
                                                <div class="font-bold text-slate-800 dark:text-slate-200">RACHI Tec</div>
                                                <div class="text-[11px] text-slate-500 dark:text-slate-400">Portal Web • Em Execução</div>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-bold text-blue-600 dark:text-blue-400">75% Concluído</span>
                                    </div>

                                    <!-- RACHI Print -->
                                    <div class="p-3 rounded-2xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-500 font-bold flex items-center justify-center text-[10px]">PRT</div>
                                            <div>
                                                <div class="font-bold text-slate-800 dark:text-slate-200">RACHI Print</div>
                                                <div class="text-[11px] text-slate-500 dark:text-slate-400">1.000 Catálogos em Acabamento</div>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-bold text-amber-600 dark:text-amber-400">Entrega: 24/09</span>
                                    </div>

                                    <!-- RACHI Academy -->
                                    <div class="p-3 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-indigo-500/20 text-indigo-500 font-bold flex items-center justify-center text-[10px]">ACD</div>
                                            <div>
                                                <div class="font-bold text-slate-800 dark:text-slate-200">RACHI Academy</div>
                                                <div class="text-[11px] text-slate-500 dark:text-slate-400">Cursos Executivos &amp; Alunos</div>
                                            </div>
                                        </div>
                                        <button @click="openAcademyAluno()" class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Aceder &rarr;</button>
                                    </div>

                                    <!-- RACHI Capital -->
                                    <div class="p-3 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-500 font-bold flex items-center justify-center text-[10px]">CAP</div>
                                            <div>
                                                <div class="font-bold text-slate-800 dark:text-slate-200">RACHI Capital</div>
                                                <div class="text-[11px] text-slate-500 dark:text-slate-400">Dossiê RH Homologado</div>
                                            </div>
                                        </div>
                                        <span class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400">Finalizado</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Widget: FAQ & Perguntas Frequentes -->
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">Dúvidas Frequentes</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Respostas rápidas para sua operação corporativa.</p>

                                <div class="space-y-2 text-xs">
                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 cursor-pointer"
                                         @click="activeFaq = activeFaq === 1 ? null : 1">
                                        <div class="font-semibold flex items-center justify-between text-slate-800 dark:text-slate-200">
                                            <span>Como aprovar uma proposta comercial?</span>
                                            <span x-text="activeFaq === 1 ? '−' : '+'" class="font-bold text-slate-400"></span>
                                        </div>
                                        <div x-show="activeFaq === 1" class="mt-2 text-slate-500 dark:text-slate-400 text-[11px] leading-relaxed">
                                            Basta clicar na aba "Orçamentos &amp; Propostas" e pressionar o botão "Aprovar Orçamento". A equipe técnica receberá a notificação instantaneamente.
                                        </div>
                                    </div>

                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 cursor-pointer"
                                         @click="activeFaq = activeFaq === 2 ? null : 2">
                                        <div class="font-semibold flex items-center justify-between text-slate-800 dark:text-slate-200">
                                            <span>Como pagar via Multicaixa / Referência?</span>
                                            <span x-text="activeFaq === 2 ? '−' : '+'" class="font-bold text-slate-400"></span>
                                        </div>
                                        <div x-show="activeFaq === 2" class="mt-2 text-slate-500 dark:text-slate-400 text-[11px] leading-relaxed">
                                            Na seção de faturas, copie a Entidade e Referência geradas na sua fatura proforma para pagamento no ATM, Multicaixa Express ou Internet Banking.
                                        </div>
                                    </div>

                                    <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/60 border border-slate-200/60 dark:border-slate-700/60 cursor-pointer"
                                         @click="activeFaq = activeFaq === 3 ? null : 3">
                                        <div class="font-semibold flex items-center justify-between text-slate-800 dark:text-slate-200">
                                            <span>Como matricular colaboradores na Academy?</span>
                                            <span x-text="activeFaq === 3 ? '−' : '+'" class="font-bold text-slate-400"></span>
                                        </div>
                                        <div x-show="activeFaq === 3" class="mt-2 text-slate-500 dark:text-slate-400 text-[11px] leading-relaxed">
                                            Acesse o menu "RACHI Academy" ou solicite uma turma corporativa personalizada in-company pelo botão "Nova Solicitação".
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 2: LISTA COMPLETA DE SOLICITAÇÕES                          -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'requests'" class="space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Minhas Solicitações &amp; Chamados</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Histórico completo de projetos, orçamentos e serviços abertos com o Grupo RACHI.</p>
                        </div>
                        <button @click="customerTab = 'new_request'"
                                class="px-5 py-2.5 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md shadow-blue-600/20 transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            <span>Nova Solicitação</span>
                        </button>
                    </div>

                    <!-- Lista Completa -->
                    <div class="space-y-4">
                        <template x-for="req in filteredCustomerRequests()" :key="req.id">
                            <div class="p-6 rounded-3xl border transition shadow-sm hover:border-blue-400"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono font-bold text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 px-3 py-1 rounded-lg border border-blue-200 dark:border-blue-800"
                                              x-text="req.protocol"></span>
                                        <span class="text-xs font-bold px-2.5 py-0.5 rounded-full border"
                                              :class="req.unitBadge || 'bg-slate-100 text-slate-700'"
                                              x-text="req.unit"></span>
                                        <span class="text-xs font-semibold text-slate-500" x-text="'Aberto em ' + req.date"></span>
                                    </div>
                                    <span class="text-xs font-bold px-3 py-1 rounded-full"
                                          :class="getStatusBadgeClass(req.status)"
                                          x-text="req.statusLabel"></span>
                                </div>
                                <h3 class="font-bold text-lg text-slate-900 dark:text-white mt-3" x-text="req.title"></h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed" x-text="req.description"></p>

                                <div class="mt-4 pt-4 border-t flex items-center justify-between"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div class="text-xs text-slate-500 flex items-center gap-2">
                                        <span>Responsável:</span>
                                        <span class="font-semibold text-slate-800 dark:text-slate-200" x-text="req.technician || 'Equipe Técnica'"></span>
                                    </div>
                                    <button @click="selectedRequest = req; customerTab = 'view_request'"
                                            class="px-4 py-2 rounded-xl bg-slate-900 hover:bg-blue-600 text-white font-bold text-xs transition flex items-center gap-1.5 shadow">
                                        <span>Abrir Atendimento &amp; Histórico</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 3: SOLICITAR NOVO SERVIÇO COM SELETOR DE UNIDADES         -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'new_request'" class="space-y-6">
                    <div class="max-w-3xl mx-auto p-6 sm:p-8 rounded-3xl border shadow-xl"
                         :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                        <div class="pb-5 border-b mb-6"
                             :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Solicitar Novo Produto / Serviço</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                Escolha a unidade de negócio desejada e preencha as especificações para receber proposta técnica imediata.
                            </p>
                        </div>

                        <!-- Seletor Visual de Unidade em 4 Cartões Clicáveis -->
                        <div class="mb-6">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-2.5">
                                1. Selecione a Unidade de Negócio *
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                <!-- Opção 1: RACHI Tec -->
                                <div @click="newRequest.unit = '1'"
                                     class="p-3.5 rounded-2xl border-2 cursor-pointer transition-all"
                                     :class="newRequest.unit === '1' ? 'border-blue-500 bg-blue-500/10 text-blue-600 dark:text-blue-400 shadow-md' : 'border-slate-200 dark:border-slate-800 hover:border-blue-300'">
                                    <div class="font-extrabold text-sm">RACHI Tec</div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Websites, Software &amp; TI</p>
                                </div>
                                <!-- Opção 2: RACHI Print -->
                                <div @click="newRequest.unit = '2'"
                                     class="p-3.5 rounded-2xl border-2 cursor-pointer transition-all"
                                     :class="newRequest.unit === '2' ? 'border-amber-500 bg-amber-500/10 text-amber-600 dark:text-amber-400 shadow-md' : 'border-slate-200 dark:border-slate-800 hover:border-amber-300'">
                                    <div class="font-extrabold text-sm">RACHI Print</div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Gráfica, Banners &amp; Brindes</p>
                                </div>
                                <!-- Opção 3: RACHI Academy -->
                                <div @click="newRequest.unit = '3'"
                                     class="p-3.5 rounded-2xl border-2 cursor-pointer transition-all"
                                     :class="newRequest.unit === '3' ? 'border-indigo-500 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 shadow-md' : 'border-slate-200 dark:border-slate-800 hover:border-indigo-300'">
                                    <div class="font-extrabold text-sm">RACHI Academy</div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Treinamento &amp; Cursos</p>
                                </div>
                                <!-- Opção 4: RACHI Capital -->
                                <div @click="newRequest.unit = '4'"
                                     class="p-3.5 rounded-2xl border-2 cursor-pointer transition-all"
                                     :class="newRequest.unit === '4' ? 'border-emerald-500 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 shadow-md' : 'border-slate-200 dark:border-slate-800 hover:border-emerald-300'">
                                    <div class="font-extrabold text-sm">RACHI Capital</div>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-1">Gestão de RH &amp; Consultoria</p>
                                </div>
                            </div>
                        </div>

                        <form @submit.prevent="submitRequest" class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">
                                    Título da Solicitação *
                                </label>
                                <input type="text" x-model="newRequest.title" required
                                       placeholder="Ex: Criação de Nova Plataforma de Vendas ou 5.000 Flyers Promocionais"
                                       class="w-full border rounded-xl p-3 text-xs bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">
                                    Descrição Detalhada do Projeto ou Pedido *
                                </label>
                                <textarea x-model="newRequest.description" rows="4" required
                                          placeholder="Descreva as especificações, quantidade, funcionalidades requeridas, cores, formato ou objetivos corporativos..."
                                          class="w-full border rounded-xl p-3 text-xs bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"></textarea>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Prioridade</label>
                                    <select x-model="newRequest.priority"
                                            class="w-full border rounded-xl p-3 text-xs bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                        <option value="normal">Normal (Até 5 dias úteis)</option>
                                        <option value="high">Alta (Até 48 horas úteis)</option>
                                        <option value="urgent">Urgente (SLA de Emergência 24h)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Prazo Pretendido de Entrega</label>
                                    <input type="date" x-model="newRequest.date"
                                           class="w-full border rounded-xl p-3 text-xs bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                </div>
                            </div>

                            <!-- Dropzone Simulado para Briefing e Arquivos -->
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 dark:text-slate-300 mb-1">Anexar Briefing / Arquivos (PDF, PNG, DOCX)</label>
                                <div class="border-2 border-dashed rounded-2xl p-4 text-center border-slate-300 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/40 hover:bg-slate-100 transition cursor-pointer">
                                    <svg class="w-8 h-8 mx-auto text-slate-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200">Arraste arquivos ou clique para selecionar</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Tamanho máximo de arquivo: 25 MB</p>
                                </div>
                            </div>

                            <div class="pt-3 flex gap-3">
                                <button type="submit"
                                        class="flex-1 py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-blue-600/25 transition transform hover:-translate-y-0.5">
                                    Enviar Solicitação &amp; Iniciar Atendimento
                                </button>
                                <button type="button" @click="customerTab = 'dashboard'"
                                        class="px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 text-xs font-bold transition">
                                    Cancelar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 4: MEUS ORÇAMENTOS & PROPOSTAS COMERCIAIS                  -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'my_quotes'" class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Orçamentos &amp; Propostas Comerciais</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Revise os itens técnicos, valores em Kwanzas e aprove propostas em 1 clique.</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <template x-for="q in customerQuotes" :key="q.number">
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex flex-wrap items-center justify-between gap-3 pb-4 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div class="flex items-center gap-3">
                                        <span class="font-mono font-black text-base text-slate-900 dark:text-white" x-text="q.number"></span>
                                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-500/10 text-blue-600 dark:text-blue-400" x-text="q.unit"></span>
                                        <span class="text-xs text-slate-400" x-text="'Ref: ' + q.protocol + ' • Validade: ' + q.validUntil"></span>
                                    </div>
                                    <span class="text-xs px-3 py-1 rounded-full font-bold"
                                          :class="q.status === 'approved' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400'"
                                          x-text="q.status === 'approved' ? 'Proposta Aprovada' : 'Aguardando Sua Aprovação'"></span>
                                </div>

                                <div class="mt-4">
                                    <h4 class="font-bold text-base text-slate-900 dark:text-white" x-text="q.title"></h4>
                                </div>

                                <!-- Tabela de Itens do Orçamento -->
                                <div class="mt-4 overflow-x-auto">
                                    <table class="w-full text-left text-xs">
                                        <thead>
                                            <tr class="text-[10px] uppercase font-bold text-slate-400 border-b"
                                                :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                                <th class="py-2">Item / Descrição Técnica</th>
                                                <th class="py-2 text-center">Qtd</th>
                                                <th class="py-2 text-right">Subtotal (AOA)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y"
                                               :class="customerDarkMode ? 'divide-slate-800/40' : 'divide-slate-100'">
                                            <template x-for="(item, idx) in (q.items || [])" :key="idx">
                                                <tr>
                                                    <td class="py-2.5 text-slate-700 dark:text-slate-300" x-text="item.desc"></td>
                                                    <td class="py-2.5 text-center font-bold text-slate-500" x-text="item.qty"></td>
                                                    <td class="py-2.5 text-right font-semibold text-slate-900 dark:text-white" x-text="item.price.toLocaleString('pt-AO') + ' AOA'"></td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Rodapé com Total e Botão de Ação -->
                                <div class="mt-5 pt-4 border-t flex flex-wrap items-center justify-between gap-4"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div>
                                        <span class="text-xs text-slate-400 uppercase font-bold block">Valor Total Homologado (c/ IVA 14%)</span>
                                        <span class="text-2xl font-black text-emerald-600 dark:text-emerald-400"
                                              x-text="q.total.toLocaleString('pt-AO') + ' AOA'"></span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <button @click="mockDownloadDoc(q.number)"
                                                class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs transition flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                            <span>Baixar Proposta Oficial</span>
                                        </button>
                                        <template x-if="q.status === 'sent'">
                                            <button @click="approveQuote(q)"
                                                    class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs transition shadow-lg shadow-emerald-600/20 flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                <span>Aprovar Orçamento</span>
                                            </button>
                                        </template>
                                        <template x-if="q.status === 'approved'">
                                            <span class="px-4 py-2 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center gap-1.5">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                                <span>Orçamento Homologado</span>
                                            </span>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 5: SERVIÇOS & CONTRATOS ATIVOS                             -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'contracts'" class="space-y-6">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Serviços &amp; Contratos Ativos</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Acordos de nível de serviço (SLA), manutenções programadas e contratos recorrentes.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <template x-for="c in customerContracts" :key="c.id">
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex items-center justify-between pb-3 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <span class="font-mono font-bold text-xs text-slate-500" x-text="c.id"></span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/20 text-emerald-500" x-text="c.status"></span>
                                </div>
                                <h3 class="font-bold text-base text-slate-900 dark:text-white mt-3" x-text="c.name"></h3>
                                <div class="mt-4 space-y-2 text-xs text-slate-500 dark:text-slate-400">
                                    <div class="flex justify-between">
                                        <span>Unidade:</span>
                                        <span class="font-bold text-slate-700 dark:text-slate-200" x-text="c.unit"></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Garantia de SLA:</span>
                                        <span class="font-bold text-blue-600 dark:text-blue-400" x-text="c.sla"></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Próxima Renovação:</span>
                                        <span class="font-bold text-slate-700 dark:text-slate-200" x-text="c.renewal"></span>
                                    </div>
                                </div>
                                <div class="mt-5 pt-3 border-t flex justify-end"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <button @click="mockDownloadDoc(c.name)"
                                            class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                        <span>Ver Termos do Contrato</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 6: FATURAS & DOCUMENTOS FISCAIS                            -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'documents'" class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Central de Faturas &amp; Documentos</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Acesse proformas, termos de aceitação e comprovativos oficiais.</p>
                        </div>
                    </div>

                    <div class="p-6 rounded-3xl border shadow-sm overflow-x-auto"
                         :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-[10px] uppercase font-bold text-slate-400 border-b"
                                    :class="customerDarkMode ? 'border-slate-800' : 'border-slate-200'">
                                    <th class="py-3 px-4">Referência</th>
                                    <th class="py-3 px-4">Unidade</th>
                                    <th class="py-3 px-4">Descrição</th>
                                    <th class="py-3 px-4">Data de Emissão</th>
                                    <th class="py-3 px-4">Valor</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Download</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y"
                                   :class="customerDarkMode ? 'divide-slate-800/60' : 'divide-slate-100'">
                                <template x-for="inv in customerInvoices" :key="inv.id">
                                    <tr class="hover:bg-slate-500/5 transition">
                                        <td class="py-3.5 px-4 font-mono font-bold text-blue-600 dark:text-blue-400" x-text="inv.id"></td>
                                        <td class="py-3.5 px-4 font-semibold" x-text="inv.unit"></td>
                                        <td class="py-3.5 px-4 text-slate-700 dark:text-slate-300 font-medium" x-text="inv.desc"></td>
                                        <td class="py-3.5 px-4 text-slate-500" x-text="inv.date"></td>
                                        <td class="py-3.5 px-4 font-bold text-slate-900 dark:text-white" x-text="inv.value.toLocaleString('pt-AO') + ' AOA'"></td>
                                        <td class="py-3.5 px-4">
                                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold"
                                                  :class="inv.status === 'paid' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-950/40 dark:text-amber-400'"
                                                  x-text="inv.statusLabel"></span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right">
                                            <button @click="mockDownloadDoc(inv.id)"
                                                    class="px-3 py-1.5 rounded-xl bg-slate-900 hover:bg-blue-600 text-white font-bold text-xs transition inline-flex items-center gap-1.5 shadow">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                <span>Baixar PDF</span>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- ABA 7: DETALHES DA SOLICITAÇÃO & CHAT COM TÉCNICO              -->
                <!-- ============================================================== -->
                <div x-show="customerTab === 'view_request'" x-cloak class="space-y-4">
                    <button @click="customerTab = 'dashboard'"
                            class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline inline-flex items-center gap-1.5 mb-2">
                        <span>&larr; Voltar ao Painel Geral</span>
                    </button>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-if="selectedRequest">
                        <!-- Chat e Especificações Técnicas -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex items-center justify-between pb-4 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <span class="font-mono font-black text-lg text-blue-600 dark:text-blue-400"
                                          x-text="selectedRequest.protocol"></span>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold"
                                          :class="getStatusBadgeClass(selectedRequest.status)"
                                          x-text="selectedRequest.statusLabel"></span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mt-4" x-text="selectedRequest.title"></h3>
                                <p class="text-slate-600 dark:text-slate-300 text-xs mt-2 leading-relaxed"
                                   x-text="selectedRequest.description"></p>
                            </div>

                            <!-- Chat Interativo com Técnico -->
                            <div class="p-6 rounded-3xl border shadow-sm"
                                 :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                                <div class="flex items-center justify-between mb-4 pb-3 border-b"
                                     :class="customerDarkMode ? 'border-slate-800' : 'border-slate-100'">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow">
                                            CG
                                        </div>
                                        <div>
                                            <div class="font-bold text-xs text-slate-900 dark:text-white">Casimiro Gundja</div>
                                            <div class="text-[10px] text-emerald-500 font-semibold">Técnico Designado (Online)</div>
                                        </div>
                                    </div>
                                    <span class="text-[10px] text-slate-400">Atendimento Registrado em Protocolo</span>
                                </div>

                                <!-- Mensagens -->
                                <div class="space-y-3 mb-4 max-h-72 overflow-y-auto pr-2">
                                    <template x-for="m in selectedRequest.messages" :key="m.id">
                                        <div class="p-3.5 rounded-2xl text-xs max-w-lg shadow-sm"
                                             :class="m.fromUser ? 'bg-blue-50 dark:bg-blue-950/50 ml-auto border border-blue-200/80 dark:border-blue-800 text-blue-950 dark:text-blue-100' : 'bg-slate-100 dark:bg-slate-800 mr-auto border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200'">
                                            <div class="text-[10px] font-bold mb-1"
                                                 :class="m.fromUser ? 'text-blue-600 dark:text-blue-400' : 'text-slate-600 dark:text-slate-400'"
                                                 x-text="m.sender"></div>
                                            <div class="leading-relaxed" x-text="m.text"></div>
                                        </div>
                                    </template>
                                </div>

                                <div class="flex gap-2">
                                    <input type="text" x-model="chatInput" @keydown.enter.prevent="sendChatMessage()"
                                           placeholder="Escreva sua mensagem ou dúvida técnica..."
                                           class="flex-1 border rounded-xl px-4 py-2.5 text-xs bg-slate-50 dark:bg-slate-800 border-slate-300 dark:border-slate-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                    <button @click="sendChatMessage()"
                                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-2.5 rounded-xl text-xs transition shadow-md shadow-blue-600/20">
                                        Enviar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Histórica do Chamado -->
                        <div class="p-6 rounded-3xl border shadow-sm h-fit"
                             :class="customerDarkMode ? 'bg-slate-900 border-slate-800' : 'bg-white border-slate-200/90'">
                            <h4 class="font-bold text-sm text-slate-900 dark:text-white mb-4">Linha do Tempo de Execução</h4>
                            <div class="space-y-4 relative before:absolute before:inset-0 before:left-2 before:w-0.5 before:bg-slate-200 dark:before:bg-slate-800">
                                <template x-for="step in selectedRequest.timeline" :key="step.title">
                                    <div class="flex items-start gap-3 relative z-10">
                                        <div class="w-4 h-4 mt-0.5 rounded-full bg-blue-600 ring-4 ring-blue-100 dark:ring-blue-950 shrink-0 shadow"></div>
                                        <div>
                                            <div class="text-[10px] text-slate-400 font-semibold" x-text="step.date"></div>
                                            <div class="font-bold text-xs text-slate-800 dark:text-slate-200 mt-0.5" x-text="step.title"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- VIEW 3: EMPLOYEE PORTAL (AUTHENTICATED)                        -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'employee'" x-cloak class="min-h-screen bg-slate-100 flex flex-col">
        <header class="bg-[#071326] text-white h-16 flex items-center justify-between px-6 border-b border-slate-800">
            <div class="flex items-center gap-4">
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-8">
                <span
                    class="text-xs px-2.5 py-0.5 rounded bg-blue-900/60 text-blue-300 font-bold border border-blue-700/50">Área
                    de Atendimento & Técnicos</span>
            </div>
            <div class="flex items-center gap-4">
                <button @click="currentView = 'public'"
                    class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i> Voltar ao Site
                </button>
                <div class="flex items-center gap-2 pl-4 border-l border-slate-800">
                    <span class="text-sm font-semibold">Técnico: Casimiro (RACHI Tec)</span>
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs">
                        CG</div>
                </div>
            </div>
        </header>

        <div class="flex-1 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-[#071326] text-white p-4 space-y-2 border-r border-slate-800">
                <button
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left bg-blue-600 text-white font-bold shadow-md shadow-blue-600/20">
                    <i data-lucide="inbox" class="w-4 h-4"></i> Fila de Chamados
                </button>
                <button @click="alert('Módulo de estoque: 6 itens monitorados.')"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left text-slate-400 hover:bg-slate-800">
                    <i data-lucide="boxes" class="w-4 h-4"></i> Movimentação Estoque
                </button>
            </aside>

            <!-- Main Panel -->
            <main class="flex-1 p-8 overflow-y-auto">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Fila de Atendimento (Suporte & Vendas)</h2>

                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600 uppercase text-xs border-b">
                            <tr>
                                <th class="p-4">Protocolo</th>
                                <th class="p-4">Unidade</th>
                                <th class="p-4">Assunto</th>
                                <th class="p-4">Prioridade</th>
                                <th class="p-4">Alterar Estado</th>
                                <th class="p-4 text-right">Orçamento</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <template x-for="r in customerRequests" :key="r.id">
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 font-mono font-bold text-blue-600" x-text="r.protocol"></td>
                                    <td class="p-4"><span class="px-2 py-0.5 rounded bg-slate-100 text-xs font-semibold"
                                            x-text="r.unit"></span></td>
                                    <td class="p-4 font-medium" x-text="r.title"></td>
                                    <td class="p-4"><span class="text-xs px-2 py-0.5 rounded font-semibold text-white"
                                            :class="r.priority === 'urgent' ? 'bg-red-500' : 'bg-amber-500'"
                                            x-text="r.priority"></span></td>
                                    <td class="p-4">
                                        <select @change="updateRequestStatus(r, $event.target.value)"
                                            class="text-xs border rounded p-1.5 bg-white">
                                            <option value="new" :selected="r.status === 'new'">Nova</option>
                                            <option value="in_analysis" :selected="r.status === 'in_analysis'">Em
                                                análise</option>
                                            <option value="quoted" :selected="r.status === 'quoted'">Orçado</option>
                                            <option value="in_progress" :selected="r.status === 'in_progress'">Em
                                                execução</option>
                                            <option value="completed" :selected="r.status === 'completed'">Concluída
                                            </option>
                                        </select>
                                    </td>
                                    <td class="p-4 text-right">
                                        <button @click="openSendQuote(r)"
                                            class="text-xs bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold px-3 py-1.5 rounded shadow">
                                            Gerar Orçamento
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- VIEW 4: ADMIN PORTAL (AUTHENTICATED)                           -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'admin'" x-cloak class="min-h-screen bg-slate-100 flex flex-col">
        <header class="bg-[#071326] text-white h-16 flex items-center justify-between px-6 border-b border-slate-800">
            <div class="flex items-center gap-4">
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-8">
                <span
                    class="text-xs px-2.5 py-0.5 rounded bg-red-900/60 text-red-300 font-bold border border-red-700/50">Super
                    Administrador</span>
            </div>
            <div class="flex items-center gap-4">
                <button @click="currentView = 'public'"
                    class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i> Voltar ao Site
                </button>
                <div class="flex items-center gap-2 pl-4 border-l border-slate-800">
                    <span class="text-sm font-semibold">Administrador Geral</span>
                    <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center font-bold text-xs">SA
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-[#071326] text-white p-4 space-y-2 border-r border-slate-800">
                <button
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left bg-amber-500 text-slate-950 font-bold">
                    <i data-lucide="bar-chart-3" class="w-4 h-4"></i> Dashboard Executivo
                </button>
                <button @click="alert('Visualização de 4 unidades cadastradas.')"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left text-slate-400 hover:bg-slate-800">
                    <i data-lucide="building" class="w-4 h-4"></i> Unidades de Negócio
                </button>
                <button @click="alert('Controle de estoque sincronizado.')"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left text-slate-400 hover:bg-slate-800">
                    <i data-lucide="package" class="w-4 h-4"></i> Produtos e Estoque
                </button>
                <button @click="alert('Módulo de Auditoria: todas as operações gravadas em activity_logs.')"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left text-slate-400 hover:bg-slate-800">
                    <i data-lucide="shield" class="w-4 h-4"></i> Logs de Auditoria
                </button>
            </aside>

            <!-- Main Panel -->
            <main class="flex-1 p-8 overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-slate-900">Visão Geral da Empresa (4 Unidades)</h2>
                </div>

                <!-- 8 KPIs (Section 48) -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Vendas Totais</span>
                        <div class="text-2xl font-black text-emerald-600 mt-2">1.504.000,29 AOA</div>
                        <span class="text-xs text-emerald-500 mt-1 block">&uarr; +14% esse mês</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Pedidos</span>
                        <div class="text-2xl font-black text-slate-900 mt-2">14</div>
                        <span class="text-xs text-slate-400 mt-1 block">Na loja virtual</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Solicitações</span>
                        <div class="text-2xl font-black text-amber-500 mt-2" x-text="customerRequests.length"></div>
                        <span class="text-xs text-slate-400 mt-1 block">Entre as 4 unidades</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Estoque Crítico</span>
                        <div class="text-2xl font-black text-rose-600 mt-2">1</div>
                        <span class="text-xs text-rose-400 mt-1 block">Produtos &lt; 5 unid.</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Clientes</span>
                        <div class="text-2xl font-black text-slate-900 mt-2">42</div>
                        <span class="text-xs text-slate-400 mt-1 block">Particulares / Empresas</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Funcionários</span>
                        <div class="text-2xl font-black text-slate-900 mt-2">12</div>
                        <span class="text-xs text-slate-400 mt-1 block">Com acesso a tickets</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Cursos Vendidos</span>
                        <div class="text-2xl font-black text-purple-600 mt-2">89</div>
                        <span class="text-xs text-purple-400 mt-1 block">RACHI Academy</span>
                    </div>
                    <div class="bg-white p-5 rounded-xl border border-slate-200">
                        <span class="text-xs text-slate-500 uppercase font-bold">Serviços Cadastrados</span>
                        <div class="text-2xl font-black text-slate-900 mt-2" x-text="services.length"></div>
                        <span class="text-xs text-slate-400 mt-1 block">Ativos no catálogo</span>
                    </div>
                </div>

                <!-- Recent Activity Logs Table (Section 31 & RN015) -->
                <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="font-bold text-base text-slate-900 mb-4">Auditoria / Activity Logs (RN015)</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs p-3 bg-slate-50 rounded-lg">
                            <div>
                                <span class="font-bold text-blue-600">STATUS_UPDATE:</span>
                                <span class="text-slate-700">Técnico Casimiro alterou o status de
                                    <strong>#SOL-2026-000001</strong> para 'Em Análise'</span>
                            </div>
                            <span class="text-slate-400">Há 12 min</span>
                        </div>
                        <div class="flex items-center justify-between text-xs p-3 bg-slate-50 rounded-lg">
                            <div>
                                <span class="font-bold text-emerald-600">QUOTE_APPROVED:</span>
                                <span class="text-slate-700">Cliente 'Inov Quimua' aprovou orçamento
                                    <strong>#ORC-2026-0001</strong> no valor de 450.000 AOA</span>
                            </div>
                            <span class="text-slate-400">Há 35 min</span>
                        </div>
                        <div class="flex items-center justify-between text-xs p-3 bg-slate-50 rounded-lg">
                            <div>
                                <span class="font-bold text-amber-600">STOCK_MOVEMENT:</span>
                                <span class="text-slate-700">Saída de 1x 'HP Elitebook x360' por motivo de Venda
                                    #PED-2026-000002</span>
                            </div>
                            <span class="text-slate-400">Há 1 hora</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Script Implementation -->
    <script>
        function rachiApp() {
            return {
                currentView: 'public',
                currentTab: 'home',
                mobileMenuOpen: false,
                customerTab: 'dashboard',
                authTab: 'login',
                authForm: {
                    email: '',
                    password: '',
                    showPassword: false
                },
                registerForm: {
                    tipo_cliente: 'particular',
                    nome: '',
                    nif: '',
                    email: '',
                    telefone: '',
                    whatsapp: '',
                    provincia: '',
                    municipio: '',
                    bairro: '',
                    rua: '',
                    numero: '',
                    referencia: ''
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
                showLoginToast(title, message, type = 'success', duration = 4500) {
                    if (this.loginToast.timer) {
                        clearTimeout(this.loginToast.timer);
                        this.loginToast.timer = null;
                    }
                    this.loginToast.title = title;
                    this.loginToast.message = message;
                    this.loginToast.type = type;
                    if (type === 'success') {
                        this.loginToast.badge = 'Conectado';
                    } else if (type === 'logout') {
                        this.loginToast.badge = 'Desconectado';
                    } else if (type === 'error') {
                        this.loginToast.badge = 'Erro';
                    } else if (type === 'warning') {
                        this.loginToast.badge = 'Atenção';
                    } else {
                        this.loginToast.badge = 'Info';
                    }
                    this.loginToast.progressKey = Date.now();
                    this.loginToast.show = true;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                    this.loginToast.timer = setTimeout(() => {
                        this.loginToast.show = false;
                        this.loginToast.timer = null;
                    }, duration);
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
                            if (this.authErrorTimer) {
                                clearTimeout(this.authErrorTimer);
                            }
                            this.authErrorTimer = setTimeout(() => {
                                this.authError = '';
                                this.authErrorTimer = null;
                            }, 4500);
                        }
                    });
                    // Sincronização em tempo real entre todas as abas e sub-páginas
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            this.authChannel = new BroadcastChannel('rachi_auth_channel');
                            this.authChannel.onmessage = (event) => {
                                const data = event.data;
                                if (!data) return;
                                if (data.action === 'logout') {
                                    const name = data.name || (this.currentUser && (this.currentUser.nome || this.currentUser.name)) || '';
                                    this.currentUser = null;
                                    if (this.currentView === 'customer') {
                                        this.currentView = 'public';
                                        this.currentTab = 'home';
                                    }
                                    this.showLoginToast(
                                        'Sessão Encerrada!',
                                        name ? `A sessão de ${name} foi encerrada com segurança em outra aba.` : 'A sessão foi terminada com segurança em todo o ecossistema.',
                                        'logout',
                                        4500
                                    );
                                } else if (data.action === 'login') {
                                    this.restoreUserSession();
                                }
                            };
                        }
                    } catch(e) {}

                    // Ouvinte de evento storage (para compatibilidade total entre abas e janelas)
                    window.addEventListener('storage', (event) => {
                        if (event.key === 'rachi_user_session' || event.key === 'rachi_auth_sync') {
                            this.restoreUserSession();
                        }
                    });

                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('login') === '1') {
                        this.loginModal = true;
                    }

                    // Sincronização em tempo real de solicitações & chat
                    this.refreshCustomerRequests();
                    setInterval(() => {
                        if (this.currentView === 'customer') {
                            this.refreshCustomerRequests();
                        }
                    }, 5000);

                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            this.reqChannel = new BroadcastChannel('rachi_request_channel');
                            this.reqChannel.onmessage = (event) => {
                                if (event.data) {
                                    this.refreshCustomerRequests();
                                }
                            };
                        }
                    } catch(e) {}

                    setInterval(() => {
                        if (!this.featuredPaused && this.currentTab === 'home') {
                            this.nextFeaturedProduct();
                        }
                    }, 4500);
                },
                restoreUserSession() {
                    try {
                        const savedUser = localStorage.getItem('rachi_user_session');
                        const isAcademyAuth = localStorage.getItem('rachi_academy_auth') === 'true';
                        if (savedUser) {
                            const parsed = JSON.parse(savedUser);
                            if (parsed.loggedIn === false) {
                                this.currentUser = null;
                            } else {
                                const u = parsed.user || (parsed.email ? parsed : null);
                                if (u && (u.nome || u.name || u.email)) {
                                    const userEmail = (u.email || '').toLowerCase().trim();

                                    let hasConfirmedMatricula = false;
                                    const regRaw = localStorage.getItem('rachi_registered_users');
                                    if (regRaw) {
                                        try {
                                            const regList = JSON.parse(regRaw);
                                            if (Array.isArray(regList)) {
                                                const foundReg = regList.find(r => r.email && r.email.toLowerCase() === userEmail);
                                                if (foundReg && foundReg.has_matricula === true) {
                                                    hasConfirmedMatricula = true;
                                                }
                                            }
                                        } catch(e) {}
                                    }

                                    // Matrícula ativa somente para contas oficiais de alunos ou matrícula comprovada
                                    let hasMatricula = false;
                                    if (userEmail === 'aluno@rachi.ao' || userEmail === 'casimirogundja@outlook.com') {
                                        hasMatricula = true;
                                    } else if (u.has_matricula === true || hasConfirmedMatricula) {
                                        hasMatricula = true;
                                    }

                                    this.currentUser = {
                                        ...u,
                                        nome: u.nome || u.name,
                                        name: u.nome || u.name,
                                        has_matricula: hasMatricula
                                    };
                                    // Sincronizar liberação da Academy apenas se tiver matrícula ativa
                                    if (this.currentUser.has_matricula || this.currentUser.role === 'admin' || this.currentUser.tipo === 'admin') {
                                        localStorage.setItem('rachi_academy_auth', 'true');
                                    } else {
                                        localStorage.removeItem('rachi_academy_auth');
                                    }
                                }
                            }
                        } else {
                            this.currentUser = null;
                        }
                    } catch (e) { }
                },
                goToHome() {
                    this.currentView = 'public';
                    this.currentTab = 'home';
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    try {
                        if (window.location.hash) {
                            history.pushState(null, '', window.location.pathname + window.location.search);
                        }
                    } catch (e) { }
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                loginModal: false,
                cartDrawer: false,
                identityModalOpen: false,
                openStore() {
                    window.location.href = '/loja';
                },
                openUnitPage(unit) {
                    if (unit === 'academy') {
                        window.location.href = '/academy';
                        return;
                    }
                    if (unit === 'capital') {
                        window.location.href = '/capital';
                        return;
                    }
                    if (unit === 'tec') {
                        window.location.href = '/tec';
                        return;
                    }
                    if (unit === 'print') {
                        window.location.href = '/print';
                        return;
                    }
                    this.currentView = 'public';
                    this.currentTab = unit;
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    try {
                        window.history.pushState(null, '', '#' + unit);
                    } catch (e) { }
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    this.$nextTick(() => lucide.createIcons());
                },
                openContacto() {
                    window.location.href = '/contacto';
                },
                storeCategory: 'todas',
                storeSearchQuery: '',
                storeSort: 'recentes',
                productModalOpen: false,
                selectedStoreProduct: null,
                storeProducts: [
                    {
                        id: 1,
                        slug: "hp-elitebook-x360-1040-g8",
                        name: "HP Elitebook x360 1040 G8 (2-in-1)",
                        title: "HP Elitebook x360 1040 G8 (2-in-1)",
                        category: "Laptops & Computadores",
                        catId: "informatica",
                        priceText: "1.489.000,29 AOA",
                        price: "1.489.000,29 AOA",
                        priceNum: 1489000.29,
                        oldPrice: "1.650.000,00 AOA",
                        discountPercent: "-10% OFF",
                        badge: "Mais Vendido",
                        badgeColor: "bg-amber-500 text-slate-950",
                        rating: "5.0",
                        reviews: 28,
                        stockText: "Disponível (4 unidades)",
                        shortDesc: "SSD 512GB NVMe, 16GB RAM, Intel Core i7, Touchscreen conversível 360°.",
                        image: "/images/hp-elitebook-studio.png"
                    },
                    {
                        id: 2,
                        slug: "smartwatch-lige-executivo",
                        name: "Smartwatch Lige Executivo Pro",
                        title: "Smartwatch Lige Executivo Pro",
                        category: "Smartwatches & Wearables",
                        catId: "smartwatches",
                        priceText: "10.000,00 AOA",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "15.000,00 AOA",
                        discountPercent: "-33% OFF",
                        badge: "Destaque",
                        badgeColor: "bg-blue-600 text-white",
                        rating: "4.8",
                        reviews: 42,
                        stockText: "Disponível (25 unidades)",
                        shortDesc: "Visor digital AMOLED, chamadas Bluetooth e pulseira de aço inoxidável.",
                        image: "/images/smartwatch-studio.png"
                    },
                    {
                        id: 3,
                        slug: "cabo-console-rs232-db9-rj45",
                        name: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        title: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        category: "Cabos & Redes",
                        catId: "conectividade",
                        priceText: "16.989,89 AOA",
                        price: "16.989,89 AOA",
                        priceNum: 16989.89,
                        oldPrice: "18.000,00 AOA",
                        discountPercent: "-6% OFF",
                        badge: "Essencial TI",
                        badgeColor: "bg-emerald-600 text-white",
                        rating: "4.9",
                        reviews: 19,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Cabo serial padrão para configuração de roteadores e switches Cisco/Huawei.",
                        image: "/images/cabo-console-studio.png"
                    },
                    {
                        id: 4,
                        slug: "tv-box-android-mxq-pro-4k",
                        name: "TV Box Android MXQ Pro 4K Ultra HD",
                        title: "TV Box Android MXQ Pro 4K Ultra HD",
                        category: "TV Box & Streaming",
                        catId: "tvbox",
                        priceText: "18.000,00 AOA",
                        price: "18.000,00 AOA",
                        priceNum: 18000.00,
                        oldPrice: "25.000,00 AOA",
                        discountPercent: "-28% OFF",
                        badge: "Promoção",
                        badgeColor: "bg-purple-600 text-white",
                        rating: "4.7",
                        reviews: 35,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Streaming 4K, Wi-Fi integrado, HDMI e suporte a aplicativos corporativos.",
                        image: "/images/tvbox-studio.png"
                    },
                    {
                        id: 5,
                        slug: "auricular-com-fio-3-5mm",
                        name: "Auricular com Fio 3.5mm Alta Fidelidade",
                        title: "Auricular com Fio 3.5mm Alta Fidelidade",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        priceText: "3.000,00 AOA",
                        price: "3.000,00 AOA",
                        priceNum: 3000.00,
                        oldPrice: "5.000,00 AOA",
                        discountPercent: "-40% OFF",
                        badge: "Mais Barato",
                        badgeColor: "bg-amber-500 text-slate-950",
                        rating: "4.6",
                        reviews: 50,
                        stockText: "Disponível (50 unidades)",
                        shortDesc: "Áudio estéreo nítido com microfone embutido para reuniões e chamadas.",
                        image: "/images/auricular-fio-studio.png"
                    },
                    {
                        id: 6,
                        slug: "auriculares-sem-fio-bluetooth",
                        name: "Auriculares sem Fio Bluetooth TWS",
                        title: "Auriculares sem Fio Bluetooth TWS",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        priceText: "15.000,00 AOA",
                        price: "15.000,00 AOA",
                        priceNum: 15000.00,
                        oldPrice: "20.000,00 AOA",
                        discountPercent: "-25% OFF",
                        badge: "Lançamento",
                        badgeColor: "bg-sky-600 text-white",
                        rating: "4.9",
                        reviews: 22,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Conexão Bluetooth 5.3, estojo com visor LED e autonomia até 24h.",
                        image: "/images/auriculares-tws-studio.png"
                    },
                    {
                        id: 7,
                        slug: "capa-tematica-naruto-iphone",
                        name: "Capa Temática Naruto para iPhone",
                        title: "Capa Temática Naruto para iPhone",
                        category: "Acessórios & Brindes",
                        catId: "promocional",
                        priceText: "7.000,00 AOA",
                        price: "7.000,00 AOA",
                        priceNum: 7000.00,
                        oldPrice: "9.500,00 AOA",
                        discountPercent: "-26% OFF",
                        badge: "Popular",
                        badgeColor: "bg-rose-600 text-white",
                        rating: "4.9",
                        reviews: 17,
                        stockText: "Disponível",
                        shortDesc: "Silicone reforçado com proteção contra quedas e acabamento fosco.",
                        image: "/images/capa-iphone-studio.png"
                    }
                ],
                get filteredStoreProducts() {
                    let list = this.storeProducts;
                    if (this.storeCategory && this.storeCategory !== 'todas') {
                        list = list.filter(p => p.category.toLowerCase().includes(this.storeCategory.toLowerCase()));
                    }
                    if (this.storeSearchQuery && this.storeSearchQuery.trim()) {
                        const q = this.storeSearchQuery.toLowerCase().trim();
                        list = list.filter(p => p.title.toLowerCase().includes(q) || p.category.toLowerCase().includes(q));
                    }
                    if (this.storeSort === 'preco_menor') {
                        list = [...list].sort((a, b) => {
                            const pa = parseFloat(a.price.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                            const pb = parseFloat(b.price.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                            return pa - pb;
                        });
                    } else if (this.storeSort === 'preco_maior') {
                        list = [...list].sort((a, b) => {
                            const pa = parseFloat(a.price.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                            const pb = parseFloat(b.price.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                            return pb - pa;
                        });
                    } else if (this.storeSort === 'nome') {
                        list = [...list].sort((a, b) => a.title.localeCompare(b.title));
                    }
                    return list;
                },
                openProductModal(p) {
                    this.selectedStoreProduct = p;
                    this.productModalOpen = true;
                },
                addToCartFromStore(p) {
                    const priceNum = parseFloat(p.price.replace(/[^0-9,]/g, '').replace(',', '.')) || 0;
                    this.cart.push({
                        id: Date.now(),
                        name: p.title,
                        category: p.category,
                        price: priceNum,
                        image: p.image
                    });
                    this.cartDrawer = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                featuredIndex: 0,
                featuredPaused: false,
                featuredProducts: [
                    {
                        id: 1,
                        slug: "hp-elitebook-x360-1040-g8",
                        name: "HP Elitebook x360 1040 G8 (2-in-1)",
                        title: "HP Elitebook x360 1040 G8 (2-in-1)",
                        category: "Laptops & Computadores",
                        catId: "informatica",
                        priceText: "1.489.000,29 AOA",
                        price: "1.489.000,29 AOA",
                        priceNum: 1489000.29,
                        oldPrice: "1.650.000,00 AOA",
                        discountPercent: "-10% OFF",
                        badge: "Mais Vendido",
                        badgeColor: "bg-amber-500 text-slate-950",
                        rating: "5.0",
                        reviews: 28,
                        stockText: "Disponível (4 unidades)",
                        shortDesc: "SSD 512GB NVMe, 16GB RAM, Intel Core i7, Touchscreen conversível 360°.",
                        image: "/images/hp-elitebook-studio.png"
                    },
                    {
                        id: 2,
                        slug: "smartwatch-lige-executivo",
                        name: "Smartwatch Lige Executivo Pro",
                        title: "Smartwatch Lige Executivo Pro",
                        category: "Smartwatches & Wearables",
                        catId: "smartwatches",
                        priceText: "10.000,00 AOA",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "15.000,00 AOA",
                        discountPercent: "-33% OFF",
                        badge: "Destaque",
                        badgeColor: "bg-blue-600 text-white",
                        rating: "4.8",
                        reviews: 42,
                        stockText: "Disponível (25 unidades)",
                        shortDesc: "Visor digital AMOLED, chamadas Bluetooth e pulseira de aço inoxidável.",
                        image: "/images/smartwatch-studio.png"
                    },
                    {
                        id: 3,
                        slug: "cabo-console-rs232-db9-rj45",
                        name: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        title: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        category: "Cabos & Redes",
                        catId: "conectividade",
                        priceText: "16.989,89 AOA",
                        price: "16.989,89 AOA",
                        priceNum: 16989.89,
                        oldPrice: "18.000,00 AOA",
                        discountPercent: "-6% OFF",
                        badge: "Essencial TI",
                        badgeColor: "bg-emerald-600 text-white",
                        rating: "4.9",
                        reviews: 19,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Cabo serial padrão para configuração de roteadores e switches Cisco/Huawei.",
                        image: "/images/cabo-console-studio.png"
                    },
                    {
                        id: 4,
                        slug: "tv-box-android-mxq-pro-4k",
                        name: "TV Box Android MXQ Pro 4K Ultra HD",
                        title: "TV Box Android MXQ Pro 4K Ultra HD",
                        category: "TV Box & Streaming",
                        catId: "tvbox",
                        priceText: "18.000,00 AOA",
                        price: "18.000,00 AOA",
                        priceNum: 18000.00,
                        oldPrice: "25.000,00 AOA",
                        discountPercent: "-28% OFF",
                        badge: "Promoção",
                        badgeColor: "bg-purple-600 text-white",
                        rating: "4.7",
                        reviews: 35,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Streaming 4K, Wi-Fi integrado, HDMI e suporte a aplicativos corporativos.",
                        image: "/images/tvbox-studio.png"
                    },
                    {
                        id: 5,
                        slug: "auricular-com-fio-3-5mm",
                        name: "Auricular com Fio 3.5mm Alta Fidelidade",
                        title: "Auricular com Fio 3.5mm Alta Fidelidade",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        priceText: "3.000,00 AOA",
                        price: "3.000,00 AOA",
                        priceNum: 3000.00,
                        oldPrice: "5.000,00 AOA",
                        discountPercent: "-40% OFF",
                        badge: "Mais Barato",
                        badgeColor: "bg-amber-500 text-slate-950",
                        rating: "4.6",
                        reviews: 50,
                        stockText: "Disponível (50 unidades)",
                        shortDesc: "Áudio estéreo nítido com microfone embutido para reuniões e chamadas.",
                        image: "/images/auricular-fio-studio.png"
                    },
                    {
                        id: 6,
                        slug: "auriculares-sem-fio-bluetooth",
                        name: "Auriculares sem Fio Bluetooth TWS",
                        title: "Auriculares sem Fio Bluetooth TWS",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        priceText: "15.000,00 AOA",
                        price: "15.000,00 AOA",
                        priceNum: 15000.00,
                        oldPrice: "20.000,00 AOA",
                        discountPercent: "-25% OFF",
                        badge: "Lançamento",
                        badgeColor: "bg-sky-600 text-white",
                        rating: "4.9",
                        reviews: 22,
                        stockText: "Disponível em Luanda",
                        shortDesc: "Conexão Bluetooth 5.3, estojo com visor LED e autonomia até 24h.",
                        image: "/images/auriculares-tws-studio.png"
                    },
                    {
                        id: 7,
                        slug: "capa-tematica-naruto-iphone",
                        name: "Capa Temática Naruto para iPhone",
                        title: "Capa Temática Naruto para iPhone",
                        category: "Acessórios & Brindes",
                        catId: "promocional",
                        priceText: "7.000,00 AOA",
                        price: "7.000,00 AOA",
                        priceNum: 7000.00,
                        oldPrice: "9.500,00 AOA",
                        discountPercent: "-26% OFF",
                        badge: "Popular",
                        badgeColor: "bg-rose-600 text-white",
                        rating: "4.9",
                        reviews: 17,
                        stockText: "Disponível",
                        shortDesc: "Silicone reforçado com proteção contra quedas e acabamento fosco.",
                        image: "/images/capa-iphone-studio.png"
                    }
                ],
                get visibleFeaturedProducts() {
                    const total = this.featuredProducts.length;
                    const maxStart = total - 3;
                    const start = Math.min(this.featuredIndex, maxStart);
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
                        this.featuredIndex = maxIndex;
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
                    this.$nextTick(() => lucide.createIcons());
                },

                scrollToSection(id) {
                    if (id === 'academy') {
                        window.location.href = '/academy';
                        return;
                    }
                    if (id === 'capital' || id === 'tec' || id === 'print') {
                        this.openUnitPage(id);
                        return;
                    }
                    if (id === 'contacto') {
                        window.location.href = '/contacto';
                        return;
                    }
                    this.currentView = 'public';
                    this.currentTab = 'home';
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    if (id === 'home' || id === 'inicio' || !id) {
                        this.goToHome();
                        return;
                    }
                    try {
                        window.history.pushState(null, '', '#' + id);
                    } catch (e) { }
                    this.$nextTick(() => {
                        setTimeout(() => {
                            const el = document.getElementById(id);
                            if (el) {
                                const headerOffset = 75;
                                const elementPosition = el.getBoundingClientRect().top;
                                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                                window.scrollTo({
                                    top: offsetPosition,
                                    behavior: 'smooth'
                                });
                            }
                        }, 50);
                    });
                },
                chatInput: '',
                newRequest: {
                    unit: '',
                    title: '',
                    description: '',
                    priority: 'normal',
                    date: ''
                },
                selectedRequest: null,
                cart: [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + item.price, 0);
                },
                products: [
                    { id: 1, name: 'HP Elitebook x360 1040 G8 (2-in-1)', category: 'informatica', price: 1489000.29, stock: 4, desc: 'SSD 512GB, 16GB RAM DDR4, Touchscreen conversível.', image: '/images/hp-elitebook-studio.png' },
                    { id: 2, name: 'Smartwatch Lige Executivo', category: 'informatica', price: 10000.00, stock: 25, desc: 'Visor digital com funções de chamada e pulseira metálica.', image: '/images/smartwatch-studio.png' },
                    { id: 3, name: 'Cabo Console RS232/DB9 para RJ45', category: 'informatica', price: 16989.89, stock: 30, desc: 'Para configuração de switches e roteadores.', image: '/images/cabo-console-studio.png' },
                    { id: 4, name: 'Auricular com Fio 3.5mm', category: 'consumiveis', price: 3000.00, stock: 50, desc: 'Áudio estéreo de alta fidelidade para chamadas e reuniões.', image: '/images/auricular-fio-studio.png' },
                    { id: 5, name: 'Capa Temática Naruto p/ iPhone', category: 'promocional', price: 7000.00, stock: 2, desc: 'Capa decorada de alta durabilidade e aderência.', image: '/images/capa-iphone-studio.png' },
                    { id: 6, name: 'TV Box Android MXQ Pro 4K', category: 'informatica', price: 18000.00, stock: 15, desc: 'Streaming em 4K e conexão Wi-Fi de alta velocidade.', image: '/images/tvbox-studio.png' }
                ],
                services: [
                    { id: 1, unitId: 1, name: 'Consultoria em Transformação Digital', description: 'Apoio estratégico para modernizar a empresa com tecnologia, processos e cultura digital.', price: 'Sob Consulta' },
                    { id: 2, unitId: 1, name: 'Criação de Websites & Portais', description: 'Desenvolvimento de websites institucionais, páginas comerciais e lojas online responsivas.', price: 'A partir de 450.000 AOA' },
                    { id: 3, unitId: 1, name: 'Digitalização de Processos Empresariais', description: 'Mapeamos e digitalizamos processos internos para reduzir papel, erros e tempos de operação.', price: 'Sob Consulta' },
                    { id: 4, unitId: 1, name: 'Implementação de Sistemas de Gestão', description: 'Implementação e configuração de sistemas de gestão adaptados à realidade da sua empresa.', price: 'Sob Consulta' },
                    { id: 5, unitId: 1, name: 'Suporte Técnico Especializado', description: 'Assistência técnica contínua a sistemas, equipamentos e utilizadores para manter a operação estável.', price: 'Planos a partir de 85.000 AOA/mês' },
                    { id: 6, unitId: 2, name: 'Branding & Identidade Visual', description: 'Desenvolvimento de logotipo, manual de normas e identidade completa.', price: 'A partir de 120.000 AOA' },
                    { id: 7, unitId: 2, name: 'Impressão de Grandes Formatos', description: 'Banners, lonas, roll-ups e adesivos de alta resolução.', price: 'Sob Cotação' },
                    { id: 8, unitId: 4, name: 'Formalização e Constituição de Empresas', description: 'Processo completo de abertura de empresa, NIF e licenças comerciais.', price: '150.000 AOA' },
                    { id: 9, unitId: 4, name: 'Recrutamento & Selecção de Talentos', description: 'Atração de perfis qualificados alinhados aos valores e necessidades do seu negócio.', price: 'Sob Consulta' }
                ],
                courses: [
                    { id: 1, title: 'Gestão e Estruturação Prática de MPMEs em Angola', level: 'Intermédio', duration: '24 Horas', price: '65.000 AOA', description: 'Aprenda a organizar processos administrativos, finanças básicas e conformidade tributária.' },
                    { id: 2, title: 'Transformação Digital e Automação de Processos', level: 'Iniciante', duration: '16 Horas', price: '45.000 AOA', description: 'Implemente ferramentas modernas, reduza retrabalho e aumente a produtividade da sua equipa.' }
                ],
                customerDarkMode: false,
                customerSearchQuery: '',
                customerFilterStatus: 'all',
                customerNotificationsOpen: false,
                customerNotifications: [
                    { id: 1, title: 'Proposta Comercial Emitida', text: 'O orçamento ORC-2026-0001 (450.000 AOA) para o Website foi emitido pela RACHI Tec.', time: 'Há 25 min', unread: true, unit: 'RACHI Tec' },
                    { id: 2, title: 'Produção Gráfica em Execução', text: 'Seus 1.000 Catálogos Corporativos entraram em fase de acabamento na RACHI Print.', time: 'Há 2 horas', unread: true, unit: 'RACHI Print' },
                    { id: 3, title: 'Gestor Designado', text: 'Eng. António Mendes está online como seu gestor de atendimento corporativo.', time: 'Hoje', unread: false, unit: 'Geral' }
                ],
                customerRequests: [
                    {
                        id: 1,
                        protocol: 'SOL-2026-000001',
                        unit: 'RACHI Tec',
                        unitBadge: 'bg-blue-500/15 text-blue-700 border-blue-200',
                        title: 'Desenvolvimento de Novo Website Institucional & Portal',
                        description: 'Modernização do portal corporativo com área de agendamento de consultas, catálogo de produtos e integração de pagamentos.',
                        status: 'in_analysis',
                        statusLabel: 'Em Análise',
                        priority: 'Alta',
                        priorityBadge: 'bg-rose-50 text-rose-700 border-rose-200',
                        step: 2,
                        progressPercent: 35,
                        date: '19/09/2026',
                        technician: 'Casimiro Gundja (Especialista Web)',
                        deadline: '25/10/2026',
                        timeline: [
                            { date: '19/09/2026 09:15', title: 'Solicitação Criada (#SOL-2026-000001)' },
                            { date: '19/09/2026 10:30', title: 'Atribuída ao Técnico Casimiro Gundja' },
                            { date: '19/09/2026 11:00', title: 'Em Análise de Requisitos e Arquitetura' }
                        ],
                        messages: [
                            { id: 1, sender: 'Cliente', fromUser: true, text: 'Olá, enviamos o briefing técnico e a paleta da nossa marca.' },
                            { id: 2, sender: 'Técnico Casimiro', fromUser: false, text: 'Recebido com sucesso! Estamos finalizando a proposta orçamentária detalhada.' }
                        ]
                    },
                    {
                        id: 2,
                        protocol: 'SOL-2026-000002',
                        unit: 'RACHI Print',
                        unitBadge: 'bg-amber-500/15 text-amber-700 border-amber-200',
                        title: 'Produção de Material Gráfico & Brindes Corporativos',
                        description: 'Impressão offset de 1.000 catálogos com laminação fosca, 2 Roll-ups retráteis e 200 pastas institucionais com bolsa.',
                        status: 'in_progress',
                        statusLabel: 'Em Execução',
                        priority: 'Média',
                        priorityBadge: 'bg-amber-50 text-amber-700 border-amber-200',
                        step: 4,
                        progressPercent: 75,
                        date: '16/09/2026',
                        technician: 'Oficina Gráfica RACHI Print',
                        deadline: '24/09/2026',
                        timeline: [
                            { date: '16/09/2026 14:00', title: 'Ordem de Produção Iniciada' },
                            { date: '17/09/2026 11:20', title: 'Prova de Cor e Impressão Aprovada' },
                            { date: '20/09/2026 16:30', title: 'Em Fase de Acabamento & Corte' }
                        ],
                        messages: [
                            { id: 1, sender: 'Cliente', fromUser: true, text: 'A prova digital ficou excelente, autorizamos a tiragem completa.' },
                            { id: 2, sender: 'Produção Print', fromUser: false, text: 'Ótimo! Previsão de entrega do lote para quinta-feira no vosso escritório.' }
                        ]
                    },
                    {
                        id: 3,
                        protocol: 'SOL-2026-000003',
                        unit: 'RACHI Capital',
                        unitBadge: 'bg-emerald-500/15 text-emerald-700 border-emerald-200',
                        title: 'Diagnóstico e Estruturação de Cargos & Salários',
                        description: 'Elaboração de manual de cargos, matriz de competências e plano de cargos e salários para 28 colaboradores.',
                        status: 'completed',
                        statusLabel: 'Concluído',
                        priority: 'Normal',
                        priorityBadge: 'bg-slate-50 text-slate-700 border-slate-200',
                        step: 5,
                        progressPercent: 100,
                        date: '05/09/2026',
                        technician: 'Consultoria RACHI Capital',
                        deadline: '18/09/2026',
                        timeline: [
                            { date: '05/09/2026 10:00', title: 'Contrato de Consultoria Ativado' },
                            { date: '12/09/2026 15:00', title: 'Apresentação do Diagnóstico Preliminar' },
                            { date: '18/09/2026 17:00', title: 'Entrega do Dossiê Final e Homologação' }
                        ],
                        messages: [
                            { id: 1, sender: 'Consultoria Capital', fromUser: false, text: 'Dossiê final homologado e entregue com sucesso à Direção.' }
                        ]
                    }
                ],
                customerQuotes: [
                    { 
                        number: 'ORC-2026-0001', 
                        protocol: 'SOL-2026-000001', 
                        unit: 'RACHI Tec',
                        title: 'Desenvolvimento Web Institucional',
                        subtotal: 394736,
                        iva: 55264,
                        total: 450000, 
                        validUntil: '05/10/2026', 
                        status: 'sent',
                        items: [
                            { desc: 'Arquitetura de Informação & Design UI/UX Personalizado', qty: 1, price: 180000 },
                            { desc: 'Desenvolvimento Frontend Responsivo & Painel Integrado', qty: 1, price: 150000 },
                            { desc: 'Otimização de Performance, SEO & Segurança SSL', qty: 1, price: 64736 },
                            { desc: 'IVA Legal (14%)', qty: 1, price: 55264 }
                        ]
                    },
                    { 
                        number: 'ORC-2026-0002', 
                        protocol: 'SOL-2026-000002', 
                        unit: 'RACHI Print',
                        title: 'Impressão Offset de Catálogos & Roll-ups',
                        subtotal: 245614,
                        iva: 34386,
                        total: 280000, 
                        validUntil: '12/10/2026', 
                        status: 'approved',
                        items: [
                            { desc: '1.000 Catálogos A4 Couché 250g com verniz localizado', qty: 1, price: 210000 },
                            { desc: '2 Roll-ups Retráteis em Alumínio 200x85cm', qty: 2, price: 35614 },
                            { desc: 'IVA Legal (14%)', qty: 1, price: 34386 }
                        ]
                    }
                ],
                customerInvoices: [
                    { id: 'FAT-2026-089', protocol: 'SOL-2026-000002', unit: 'RACHI Print', desc: 'Material Gráfico & Catálogos', value: 280000, date: '18/09/2026', status: 'paid', statusLabel: 'Liquidado' },
                    { id: 'PRF-2026-104', protocol: 'SOL-2026-000001', unit: 'RACHI Tec', desc: 'Proforma 50% Adiantamento Website', value: 225000, date: '19/09/2026', status: 'pending', statusLabel: 'Aguardando Pagamento' },
                    { id: 'FAT-2026-062', protocol: 'SOL-2026-000003', unit: 'RACHI Capital', desc: 'Consultoria de Estruturação RH', value: 620000, date: '18/09/2026', status: 'paid', statusLabel: 'Liquidado' }
                ],
                customerContracts: [
                    { id: 'CTR-TEC-2026', unit: 'RACHI Tec', name: 'Suporte de TI & Gestão de Infraestrutura', sla: '4 Horas Úteis', renewal: '15/12/2026', status: 'Ativo' },
                    { id: 'CTR-PRT-2026', unit: 'RACHI Print', name: 'Fornecimento Contínuo de Material Gráfico & Suprimentos', sla: 'Prioridade VIP', renewal: '31/01/2027', status: 'Ativo' }
                ],
                addToCart(p) {
                    this.cart.push(p);
                    this.cartDrawer = true;
                },
                removeFromCart(idx) {
                    this.cart.splice(idx, 1);
                },
                checkoutSimulated() {
                    alert('Pedido realizado com sucesso! Gerada fatura proforma para pagamento via Multicaixa.');
                    this.cart = [];
                    this.cartDrawer = false;
                },
                async refreshCustomerRequests() {
                    try {
                        const response = await fetch('/solicitacoes/conversas', {
                            headers: { 'Accept': 'application/json' },
                            credentials: 'same-origin'
                        });
                        if (!response.ok) return;
                        const data = await response.json();
                        if (data && data.requests && data.requests.length > 0) {
                            this.customerRequests = data.requests;
                            if (this.selectedRequest) {
                                const currentId = this.selectedRequest.id;
                                const currentProto = this.selectedRequest.protocol;
                                const found = this.customerRequests.find(r => r.id === currentId || r.protocol === currentProto);
                                if (found) {
                                    this.selectedRequest = found;
                                }
                            }
                        }
                    } catch(e) {
                        console.error('Erro ao atualizar solicitações:', e);
                    }
                },
                async submitRequest() {
                    if (!this.newRequest.title || !this.newRequest.description) {
                        alert('Por favor, preencha o título e a descrição da solicitação.');
                        return;
                    }

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const response = await fetch('/solicitacoes/nova', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify({
                                title: this.newRequest.title,
                                description: this.newRequest.description,
                                unit_id: this.newRequest.unit || 1,
                                priority: this.newRequest.priority || 'normal'
                            })
                        });

                        const data = await response.json();
                        if (data && data.success && data.request) {
                            this.customerRequests.unshift(data.request);
                            this.selectedRequest = data.request;
                            this.customerTab = 'view_request';
                            alert(data.message || `Solicitação ${data.request.protocol} criada com sucesso!`);
                            this.newRequest = { unit: '', title: '', description: '', priority: 'normal', date: '' };

                            try {
                                if (typeof BroadcastChannel !== 'undefined') {
                                    const bc = new BroadcastChannel('rachi_request_channel');
                                    bc.postMessage({ type: 'new_request', request: data.request, timestamp: Date.now() });
                                    bc.close();
                                }
                            } catch(e) {}
                            return;
                        }
                    } catch(e) {
                        console.error('Falha ao submeter solicitação ao servidor:', e);
                    }

                    // Fallback local se a rede falhar
                    const nextId = this.customerRequests.length + 1;
                    const protocol = `SOL-2026-${String(nextId).padStart(6, '0')}`;
                    const unitNames = { '1': 'RACHI Tec', '2': 'RACHI Print', '3': 'RACHI Academy', '4': 'RACHI Human Capital' };

                    const newReq = {
                        id: nextId,
                        protocol: protocol,
                        unit: unitNames[this.newRequest.unit] || 'Geral',
                        title: this.newRequest.title,
                        description: this.newRequest.description,
                        status: 'new',
                        statusLabel: 'Nova',
                        priority: this.newRequest.priority,
                        date: new Date().toLocaleDateString('pt-PT'),
                        timeline: [
                            { date: new Date().toLocaleString('pt-PT'), title: `Solicitação Criada (${protocol})` }
                        ],
                        messages: []
                    };

                    this.customerRequests.unshift(newReq);
                    this.selectedRequest = newReq;
                    this.customerTab = 'view_request';
                    alert(`Solicitação ${protocol} criada com sucesso!`);
                    this.newRequest = { unit: '', title: '', description: '', priority: 'normal', date: '' };
                },
                openRequestWithPreselection(unitId, title) {
                    this.currentView = 'customer';
                    this.customerTab = 'new_request';
                    this.newRequest.unit = String(unitId);
                    this.newRequest.title = title;
                },
                enrollCourse(c) {
                    const title = c && c.title ? encodeURIComponent(c.title) : '';
                    const price = c && c.price ? encodeURIComponent(c.price) : '';
                    window.location.href = `/academy/login?curso=${title}&preco=${price}&modo=register&urlAfterLogin=${encodeURIComponent(window.location.href)}`;
                },
                async sendChatMessage() {
                    if (!this.chatInput.trim() || !this.selectedRequest) return;
                    const msgText = this.chatInput.trim();
                    this.chatInput = '';

                    const tempMsg = {
                        id: Date.now(),
                        sender: 'Cliente',
                        fromUser: true,
                        text: msgText,
                        message: msgText,
                        data: new Date().toLocaleDateString('pt-PT') + ' ' + new Date().toLocaleTimeString('pt-PT', { hour: '2-digit', minute: '2-digit' })
                    };
                    if (!this.selectedRequest.messages) this.selectedRequest.messages = [];
                    this.selectedRequest.messages.push(tempMsg);

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const targetId = this.selectedRequest.id || this.selectedRequest.protocol;
                        const response = await fetch(`/solicitacoes/${targetId}/mensagem`, {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify({ message: msgText })
                        });
                        const data = await response.json();
                        if (data && data.success && data.message) {
                            const lastIdx = this.selectedRequest.messages.length - 1;
                            if (lastIdx >= 0) {
                                this.selectedRequest.messages[lastIdx] = data.message;
                            }
                            try {
                                if (typeof BroadcastChannel !== 'undefined') {
                                    const bc = new BroadcastChannel('rachi_request_channel');
                                    bc.postMessage({ type: 'new_message', requestId: this.selectedRequest.id, message: data.message, timestamp: Date.now() });
                                    bc.close();
                                }
                            } catch(e) {}
                        }
                    } catch(e) {
                        console.error('Erro ao enviar mensagem:', e);
                    }
                },
                approveQuote(q) {
                    q.status = 'approved';
                    const req = this.customerRequests.find(r => r.protocol === q.protocol);
                    if (req) {
                        req.status = 'in_progress';
                        req.statusLabel = 'Em Execução';
                        req.timeline.push({
                            date: new Date().toLocaleString('pt-PT'),
                            title: `Orçamento ${q.number} aprovado. Serviço em execução.`
                        });
                    }
                    alert('Orçamento aprovado com sucesso! A equipa iniciou a execução do serviço.');
                },
                updateRequestStatus(r, newStatus) {
                    r.status = newStatus;
                    const labels = {
                        new: 'Nova',
                        in_analysis: 'Em análise',
                        quoted: 'Orçado',
                        in_progress: 'Em execução',
                        completed: 'Concluída'
                    };
                    r.statusLabel = labels[newStatus] || newStatus;
                    r.timeline.push({
                        date: new Date().toLocaleString('pt-PT'),
                        title: `Estado alterado para: ${r.statusLabel}`
                    });
                },
                openSendQuote(r) {
                    const price = prompt('Digite o valor do orçamento em Kwanzas (AOA):', '150000');
                    if (price) {
                        const newQ = {
                            number: `ORC-2026-${String(this.customerQuotes.length + 1).padStart(4, '0')}`,
                            protocol: r.protocol,
                            total: parseFloat(price),
                            validUntil: '15 dias',
                            status: 'sent'
                        };
                        this.customerQuotes.push(newQ);
                        this.updateRequestStatus(r, 'quoted');
                        alert(`Orçamento ${newQ.number} emitido para a solicitação ${r.protocol}!`);
                    }
                },
                activeFaq: null,
                filteredCustomerRequests() {
                    let list = this.customerRequests;
                    if (this.customerFilterStatus && this.customerFilterStatus !== 'all') {
                        list = list.filter(r => r.status === this.customerFilterStatus);
                    }
                    if (this.customerSearchQuery && this.customerSearchQuery.trim()) {
                        const q = this.customerSearchQuery.toLowerCase();
                        list = list.filter(r => 
                            (r.protocol && r.protocol.toLowerCase().includes(q)) ||
                            (r.title && r.title.toLowerCase().includes(q)) ||
                            (r.unit && r.unit.toLowerCase().includes(q)) ||
                            (r.description && r.description.toLowerCase().includes(q))
                        );
                    }
                    return list;
                },
                mockDownloadDoc(docName) {
                    alert(`O download do documento "${docName}" foi iniciado em formato PDF oficial com carimbo do Grupo RACHI.`);
                },
                getStatusBadgeClass(status) {
                    switch (status) {
                        case 'new': return 'bg-blue-100 text-blue-800 border border-blue-200';
                        case 'in_analysis': return 'bg-amber-100 text-amber-800 border border-amber-200';
                        case 'quoted': return 'bg-purple-100 text-purple-800 border border-purple-200';
                        case 'in_progress': return 'bg-indigo-100 text-indigo-800 border border-indigo-200';
                        case 'completed': return 'bg-emerald-100 text-emerald-800 border border-emerald-200';
                        case 'cancelled': return 'bg-rose-100 text-rose-800 border border-rose-200';
                        default: return 'bg-slate-100 text-slate-800 border border-slate-200';
                    }
                },
                quickFillAuth(type) {
                    this.authError = '';
                    if (type === 'aluno_matriculado') {
                        this.authForm.email = 'casimirogundja@outlook.com';
                        this.authForm.password = '123456';
                    } else if (type === 'cliente_sem_matricula') {
                        this.authForm.email = 'cliente@inovquimua.ao';
                        this.authForm.password = '123';
                    } else if (type === 'admin') {
                        this.authForm.email = 'admin@rachi.ao';
                        this.authForm.password = 'admin123';
                    } else if (type === 'funcionario') {
                        this.authForm.email = 'atendente@rachi.ao';
                        this.authForm.password = '123';
                    }
                },
                async submitUnifiedLogin() {
                    this.authError = '';
                    const email = (this.authForm.email || '').trim().toLowerCase();
                    const password = (this.authForm.password || '').trim();

                    if (!email) {
                        this.authError = 'Por favor, informe o seu e-mail de acesso.';
                        return;
                    }

                    if (!email.includes('@') || !email.includes('.')) {
                        this.authError = 'Formato de e-mail inválido. Utilize nome@empresa.com';
                        return;
                    }

                    if (!password) {
                        this.authError = 'Por favor, digite a sua palavra-passe de acesso.';
                        return;
                    }

                    this.authLoading = true;
                    const serverLogin = await this.authenticateServerSession(email, password);
                    this.authLoading = false;

                    if (!serverLogin.success) {
                        this.authError = serverLogin.message || 'As credenciais fornecidas não conferem com os nossos registos.';
                        return;
                    }

                    // Base de usuários e controle de permissões do ecossistema RACHI
                    const ecosystemUsers = [
                        {
                            id: 25,
                            aluno_id: 104,
                            nome: 'Casimiro Gundja',
                            email: 'casimirogundja@outlook.com',
                            password: '123456',
                            role: 'customer',
                            roleLabel: 'Cliente Corporativo & Aluno',
                            empresa: 'Gundja Tech & Soluções',
                            avatar: 'CG',
                            has_matricula: true,
                            cursoMatriculado: 'Cibersegurança e Proteção de Dados',
                            tipo: 'cliente'
                        },
                        {
                            id: 101,
                            nome: 'Casimiro Gundja',
                            email: 'aluno@rachi.ao',
                            password: '123456',
                            role: 'customer',
                            roleLabel: 'Cliente & Aluno',
                            empresa: 'Gundja Tech',
                            avatar: 'CG',
                            has_matricula: true,
                            cursoMatriculado: 'Desenvolvimento Web Fullstack & IA',
                            tipo: 'cliente'
                        },
                        {
                            id: 102,
                            nome: 'Inov Quimua Consultoria',
                            email: 'cliente@inovquimua.ao',
                            password: '123',
                            role: 'customer',
                            roleLabel: 'Cliente Corporativo',
                            empresa: 'Inov Quimua',
                            avatar: 'IQ',
                            has_matricula: false,
                            cursoMatriculado: null,
                            tipo: 'cliente'
                        },
                        {
                            id: 1,
                            nome: 'Super Administrador RACHI',
                            email: 'admin@rachi.ao',
                            password: 'admin123',
                            role: 'admin',
                            roleLabel: 'Super Administrador',
                            empresa: 'RACHI S.A.',
                            avatar: 'AD',
                            has_matricula: true,
                            modulos: ['todos'],
                            tipo: 'admin'
                        },
                        {
                            id: 201,
                            nome: 'Casimiro Gundja (Técnico)',
                            email: 'atendente@rachi.ao',
                            password: '123',
                            role: 'employee',
                            roleLabel: 'Equipe de Atendimento',
                            empresa: 'RACHI Operações',
                            avatar: 'AT',
                            has_matricula: false,
                            tipo: 'funcionario'
                        }
                    ];

                    let user = ecosystemUsers.find(u => u.email.toLowerCase() === email);

                    // Se não estiver na lista base, busca nos utilizadores registados localmente ou nos dados do servidor
                    if (!user) {
                        try {
                            const regUsersRaw = localStorage.getItem('rachi_registered_users');
                            if (regUsersRaw) {
                                const regUsers = JSON.parse(regUsersRaw);
                                if (Array.isArray(regUsers)) {
                                    const regUser = regUsers.find(ru => ru.email && ru.email.toLowerCase() === email);
                                    if (regUser) {
                                        user = { ...regUser };
                                    }
                                }
                            }
                        } catch(e) {}
                    }

                    if (!user && serverLogin.user) {
                        const sUser = serverLogin.user;
                        const sName = sUser.name || sUser.nome || 'Utilizador';
                        const initials = sName.trim().split(/\s+/).filter(Boolean).map(n => n[0]).join('').slice(0, 2).toUpperCase() || 'CL';
                        user = {
                            id: sUser.id,
                            nome: sName,
                            name: sName,
                            email: sUser.email,
                            role: sUser.role || 'customer',
                            roleLabel: sUser.tipo === 'admin' ? 'Super Administrador' : (sUser.tipo === 'funcionario' ? 'Equipe de Atendimento' : 'Cliente'),
                            empresa: sUser.empresa || 'Cliente RACHI',
                            avatar: initials,
                            has_matricula: !!sUser.has_matricula,
                            tipo: sUser.tipo || 'cliente'
                        };
                    }

                    // Se o utilizador NÃO foi encontrado
                    if (!user) {
                        this.authError = 'Nenhum utilizador encontrado com este e-mail. Por favor, verifique os dados ou crie uma conta.';
                        return;
                    }

                    // Validação de palavra-passe para contas puramente locais
                    if (!serverLogin.success && user.password && user.password !== password) {
                        this.authError = 'Palavra-passe incorreta. Por favor, tente novamente.';
                        return;
                    }

                    // Validação de acesso à Academy: clientes criados no site são estritamente do Portal do Cliente
                    if (email === 'aluno@rachi.ao' || email === 'casimirogundja@outlook.com') {
                        user.has_matricula = true;
                        if (!user.cursoMatriculado) {
                            user.cursoMatriculado = 'Desenvolvimento Web Fullstack & IA';
                        }
                    } else if (user.tipo === 'cliente' || user.role === 'customer') {
                        // Clientes do site nunca recebem acesso à Academy sem matrícula explícita
                        user.has_matricula = false;
                        user.cursoMatriculado = null;
                        delete user.aluno_id;
                    }

                    // Salvar sessão global unificada
                    user.nome = user.nome || user.name;
                    user.name = user.nome || user.name;
                    this.currentUser = user;

                    const unifiedSession = {
                        ...user,
                        nome: user.nome,
                        name: user.name,
                        loggedIn: true,
                        user: user
                    };

                    localStorage.setItem('rachi_user_session', JSON.stringify(unifiedSession));

                    // Se tiver matrícula ativa, libera automaticamente na Academy e Dashboard do Aluno
                    if (user.has_matricula || user.role === 'admin' || user.tipo === 'admin') {
                        localStorage.setItem('rachi_academy_auth', 'true');
                    } else {
                        localStorage.removeItem('rachi_academy_auth');
                    }

                    // Transmissão em tempo real para sincronizar loja, academy e todas as janelas abertas
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            const bc = new BroadcastChannel('rachi_auth_channel');
                            bc.postMessage({ action: 'login', user: unifiedSession, timestamp: Date.now() });
                            bc.close();
                        }
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                    } catch(e) {}

                    const wasHeadingToAdmin = (this.authError && this.authError.includes('painel')) || this.redirectAfterLogin === '/admin-dashboard';
                    if (this.redirectAfterLogin) this.redirectAfterLogin = null;
                    if (wasHeadingToAdmin && (user.role === 'admin' || user.tipo === 'admin' || user.role === 'super_admin')) {
                        this.loginModal = false;
                        window.location.assign('/admin-dashboard');
                        return;
                    }

                    // Fechar modal de login
                    this.loginModal = false;

                    // Permanecer na mesma página atual e apresentar alerta visual de confirmação
                    const displayName = user.nome || user.name || 'Utilizador';
                    this.showLoginToast(
                        'Autenticado com Sucesso!',
                        `Bem-vindo(a), ${displayName}! Sessão iniciada com sucesso no ecossistema RACHI.`,
                        'success',
                        4500
                    );

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },
                async authenticateServerSession(email, password) {
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const response = await fetch('/login', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify({ email, password, remember: false })
                        });
                        const data = await response.json().catch(() => ({}));
                        if (data.csrf_token) {
                            const metaCsrf = document.querySelector('meta[name="csrf-token"]');
                            if (metaCsrf) metaCsrf.setAttribute('content', data.csrf_token);
                        }
                        if (response.ok && data.success) {
                            return { success: true, redirect: data.redirect, user: data.user };
                        }
                        return { success: false, message: data.message || 'Credenciais inválidas.' };
                    } catch (error) {
                        return { success: false, message: 'Não foi possível contactar o serviço de autenticação.' };
                    }
                },
                openAdminDashboard() {
                    this.userMenuDropdown = false;
                    window.location.assign('/admin-dashboard');
                },
                async submitRegister() {
                    this.authError = '';
                    const nome = (this.registerForm.nome || '').trim();
                    const email = (this.registerForm.email || '').trim().toLowerCase();
                    const nif = (this.registerForm.nif || '').trim();
                    const telefone = (this.registerForm.telefone || '').trim();
                    const whatsapp = (this.registerForm.whatsapp || '').trim();
                    const tipo_cliente = this.registerForm.tipo_cliente || 'particular';
                    const provincia = (this.registerForm.provincia || '').trim();
                    const municipio = (this.registerForm.municipio || '').trim();
                    const bairro = (this.registerForm.bairro || '').trim();
                    const rua = (this.registerForm.rua || '').trim();
                    const numero = (this.registerForm.numero || '').trim();
                    const referencia = (this.registerForm.referencia || '').trim();

                    if (!nome) {
                        this.authError = 'Por favor, informe o seu nome completo.';
                        return;
                    }
                    if (!email || !email.includes('@') || !email.includes('.')) {
                        this.authError = 'Por favor, informe um endereço de e-mail válido.';
                        return;
                    }

                    // Se preencher o endereço, indique pelo menos a província e o município.
                    const hasAddress = provincia || municipio || bairro || rua || numero || referencia;
                    if (hasAddress && (!provincia || !municipio)) {
                        this.authError = 'Se preencher o endereço, indique pelo menos a província e o município.';
                        return;
                    }

                    this.authLoading = true;
                    await new Promise(r => setTimeout(r, 600));
                    this.authLoading = false;

                    // Verificar se e-mail já existe
                    let regUsers = [];
                    const regUsersRaw = localStorage.getItem('rachi_registered_users');
                    if (regUsersRaw) {
                        try {
                            regUsers = JSON.parse(regUsersRaw) || [];
                        } catch(e) {
                            regUsers = [];
                        }
                    }

                    if (regUsers.some(u => u.email && u.email.toLowerCase() === email)) {
                        this.authError = 'Este e-mail já está cadastrado. Faça login para continuar.';
                        return;
                    }

                    // Iniciais do Avatar
                    const parts = nome.split(' ').filter(p => p.length > 0);
                    const initials = parts.length >= 2 
                        ? (parts[0][0] + parts[parts.length - 1][0]).toUpperCase()
                        : nome.substring(0, 2).toUpperCase();

                    // Gerar automaticamente palavra-passe temporária e código de activação de 6 dígitos
                    const randomNum = Math.floor(100000 + Math.random() * 900000);
                    const tempPassword = 'Rachi' + randomNum;
                    const activationCode = Math.floor(100000 + Math.random() * 900000).toString();

                    const newUser = {
                        id: Date.now(),
                        nome: nome,
                        name: nome,
                        nif: nif,
                        email: email,
                        password: tempPassword,
                        telefone: telefone,
                        whatsapp: whatsapp,
                        tipo_cliente: tipo_cliente,
                        role: 'customer',
                        roleLabel: tipo_cliente === 'empresa' ? 'Cliente Empresa' : 'Cliente Particular',
                        empresa: tipo_cliente === 'empresa' ? nome : 'Conta Particular',
                        avatar: initials,
                        has_matricula: false,
                        cursoMatriculado: null,
                        tipo: 'cliente',
                        status: 'ativo',
                        activation_code: activationCode,
                        endereco: {
                            provincia: provincia,
                            municipio: municipio,
                            bairro: bairro,
                            rua: rua,
                            numero: numero,
                            referencia: referencia
                        },
                        createdAt: new Date().toISOString()
                    };

                    regUsers.push(newUser);
                    localStorage.setItem('rachi_registered_users', JSON.stringify(regUsers));
                    localStorage.removeItem('rachi_academy_auth');

                    // Preenche o formulário de login para permitir acesso imediato
                    this.authForm.email = email;
                    this.authForm.password = tempPassword;
                    this.authTab = 'login';
                    this.authError = '';

                    this.showLoginToast(
                        'Conta Criada com Sucesso!',
                        `Palavra-passe temporária (${tempPassword}) e código (${activationCode}) enviados para ${email}.`,
                        'success',
                        9000
                    );

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },
                openAcademyAluno() {
                    if (this.currentUser && this.currentUser.has_matricula) {
                        localStorage.setItem('rachi_academy_auth', 'true');
                        window.location.href = '/aluno-dashboard';
                    } else {
                        this.matriculaModalOpen = true;
                    }
                },
                logout() {
                    const prevName = (this.currentUser && (this.currentUser.nome || this.currentUser.name)) || 'Utilizador';
                    this.currentUser = null;
                    localStorage.removeItem('rachi_user_session');
                    localStorage.removeItem('rachi_academy_auth');
                    localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));

                    // Transmissão imediata para deslogar em tempo real todas as telas abertas (Loja, Academy, etc.)
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            const bc = new BroadcastChannel('rachi_auth_channel');
                            bc.postMessage({ action: 'logout', name: prevName, timestamp: Date.now() });
                            bc.close();
                        }
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                    } catch(e) {}

                    this.currentView = 'public';
                    this.currentTab = 'home';

                    this.showLoginToast(
                        'Sessão Encerrada com Sucesso!',
                        `Até breve, ${prevName}! A sua sessão foi terminada com segurança em todo o ecossistema RACHI.`,
                        'logout',
                        4500
                    );

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },
                loginAs(role) {
                    if (role === 'customer') {
                        this.quickFillAuth('cliente_sem_matricula');
                        this.submitUnifiedLogin();
                    } else if (role === 'employee') {
                        this.quickFillAuth('funcionario');
                        this.submitUnifiedLogin();
                    } else if (role === 'admin') {
                        this.quickFillAuth('admin');
                        this.submitUnifiedLogin();
                    }
                }
            };
        }

        window.scrollToSection = function (id) {
            const app = document.querySelector('[x-data]');
            if (app && app._x_dataStack && app._x_dataStack[0]) {
                if (id === 'contacto') {
                    window.location.href = '/contacto';
                    return;
                }
                app._x_dataStack[0].scrollToSection(id);
                return;
            }
            if (id === 'contacto') {
                window.location.href = '/contacto';
                return;
            }
            if (id === 'home' || id === 'inicio' || !id) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }
            setTimeout(() => {
                const el = document.getElementById(id);
                if (el) {
                    const headerOffset = 75;
                    const elementPosition = el.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }, 50);
        };

        window.goToHome = function () {
            window.scrollToSection('home');
        };

        function handleUrlHash() {
            if (window.location.hash) {
                const targetId = window.location.hash.replace('#', '');
                const app = document.querySelector('[x-data]');
                if (targetId === 'academy') {
                    window.location.replace('/academy');
                    return;
                }
                if (['capital', 'tec', 'print'].includes(targetId)) {
                    window.location.replace('/' + targetId);
                    return;
                }
                if (targetId === 'contacto') {
                    window.location.replace('/contacto');
                    return;
                }
                if (window.scrollToSection) {
                    window.scrollToSection(targetId);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            setTimeout(handleUrlHash, 250);
        });

        window.addEventListener('hashchange', handleUrlHash);
    </script>
</body>

</html>
