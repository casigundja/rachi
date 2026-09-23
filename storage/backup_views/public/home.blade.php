<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        /* ============================================================ */
        /* DUAL THEME HEADER (Dark at top -> Light when scrolled)        */
        /* Exactly matching https://klasse.ao/                          */
        /* ============================================================ */

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
            transition: background-color 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                border-color 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                backdrop-filter 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .brand-logo-img {
            height: 48px;
            width: auto;
            max-width: 220px;
            object-fit: contain;
            transition: transform 0.25s ease, filter 0.25s ease;
        }

        @media (min-width: 992px) {
            .brand-logo-img {
                height: 52px;
                max-width: 240px;
            }
        }

        /* ------------------------------------------------------------ */
        /* STATE 1: AT TOP (DARK LUXURY GLASS)                          */
        /* ------------------------------------------------------------ */
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.92) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.35), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
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
            gap: 0.25rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9999px;
            padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2), 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.88rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.78) !important;
            padding: 0.45rem 0.9rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link:hover,
        .site-header.header-top-dark .main-nav-capsule .nav-link.nav-link-open {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08);
        }

        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.25), rgba(0, 163, 224, 0.12));
            border: 1px solid rgba(0, 163, 224, 0.38);
            box-shadow: 0 0 14px rgba(0, 163, 224, 0.22);
            font-weight: 600;
        }

        /* Dark Action Buttons */
        .site-header.header-top-dark .lang-toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            height: 38px;
            padding: 0 0.85rem;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-top-dark .lang-toggle-btn:hover {
            border-color: rgba(0, 163, 224, 0.5);
            background: rgba(0, 163, 224, 0.12);
            box-shadow: 0 0 15px rgba(0, 163, 224, 0.2);
        }

        .site-header.header-top-dark .cart-icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.04);
            color: #ffffff;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-top-dark .cart-icon-btn:hover {
            border-color: rgba(235, 167, 45, 0.6);
            background: rgba(235, 167, 45, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 0 15px rgba(235, 167, 45, 0.3);
        }

        .site-header.header-top-dark .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 9999px;
            border: 1px solid rgba(0, 163, 224, 0.45);
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.16) 0%, rgba(5, 25, 55, 0.45) 100%);
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
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
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
            gap: 0.25rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px;
            padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.88rem;
            font-weight: 600;
            color: #0b1a2e !important;
            padding: 0.45rem 0.9rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.12);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 8px rgba(0, 163, 224, 0.15);
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

        /* Light Action Buttons */
        .site-header.header-scrolled-light .lang-toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            height: 38px;
            padding: 0 0.85rem;
            border-radius: 9999px;
            border: 1px solid rgba(11, 26, 46, 0.12);
            background: rgba(11, 26, 46, 0.04);
            color: #0b1a2e;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-scrolled-light .lang-toggle-btn:hover {
            border-color: #00a3e0;
            background: rgba(0, 163, 224, 0.08);
            color: #0077c2;
            box-shadow: 0 0 12px rgba(0, 163, 224, 0.18);
        }

        .site-header.header-scrolled-light .cart-icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(11, 26, 46, 0.12);
            background: rgba(11, 26, 46, 0.04);
            color: #0b1a2e;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-scrolled-light .cart-icon-btn svg {
            color: #0b1a2e !important;
        }

        .site-header.header-scrolled-light .cart-icon-btn:hover {
            border-color: rgba(235, 167, 45, 0.7);
            background: rgba(235, 167, 45, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 0 12px rgba(235, 167, 45, 0.25);
        }

        .site-header.header-scrolled-light .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
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
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            color: #0b1a2e !important;
        }

        .site-header.header-top-dark .mobile-menu-btn {
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
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
            gap: 0.25rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px;
            padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.88rem;
            font-weight: 600;
            color: #0b1a2e !important;
            padding: 0.45rem 0.9rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }

        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.12);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 8px rgba(0, 163, 224, 0.15);
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

        /* Light Action Buttons */
        .site-header.header-scrolled-light .lang-toggle-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            height: 38px;
            padding: 0 0.85rem;
            border-radius: 9999px;
            border: 1px solid rgba(11, 26, 46, 0.12);
            background: rgba(11, 26, 46, 0.04);
            color: #0b1a2e;
            font-size: 0.75rem;
            font-weight: 700;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-scrolled-light .lang-toggle-btn:hover {
            border-color: #00a3e0;
            background: rgba(0, 163, 224, 0.08);
            color: #0077c2;
            box-shadow: 0 0 12px rgba(0, 163, 224, 0.18);
        }

        .site-header.header-scrolled-light .cart-icon-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(11, 26, 46, 0.12);
            background: rgba(11, 26, 46, 0.04);
            color: #0b1a2e;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .site-header.header-scrolled-light .cart-icon-btn svg {
            color: #0b1a2e !important;
        }

        .site-header.header-scrolled-light .cart-icon-btn:hover {
            border-color: rgba(235, 167, 45, 0.7);
            background: rgba(235, 167, 45, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 0 12px rgba(235, 167, 45, 0.25);
        }

        .site-header.header-scrolled-light .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
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
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            color: #0b1a2e !important;
        }

        /* Hero styling matching hom.rachi.ao & screenshot */
        /* ============================================================
           HERO REDESIGN: EXECUTIVE SIZING & INTEGRATED ARTWORK BACKDROP
        ============================================================ */
        .hero-home {
            position: relative;
            background:
                radial-gradient(ellipse 75% 50% at 50% 12%, rgba(0, 163, 224, 0.22) 0%, transparent 68%),
                radial-gradient(circle at 15% 35%, rgba(11, 78, 168, 0.4) 0%, transparent 42rem),
                radial-gradient(circle at 85% 30%, rgba(78, 162, 255, 0.25) 0%, transparent 40rem),
                radial-gradient(circle at 50% 85%, rgba(245, 168, 0, 0.14) 0%, transparent 45rem),
                linear-gradient(180deg, #071326 0%, #0b2247 40%, #0e3064 72%, #091b36 100%);
            padding-top: 6.8rem;
            padding-bottom: 2.5rem;
            text-align: center;
            overflow: hidden;
            color: #ffffff;
        }

        /* Ambient Glow Orb behind Hero */
        .hero-ambient-orb {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: min(92vw, 700px);
            height: 300px;
            background: radial-gradient(ellipse at 35% 50%, rgba(245, 168, 0, 0.15) 0%, transparent 60%),
                radial-gradient(ellipse at 65% 50%, rgba(0, 163, 224, 0.16) 0%, transparent 60%);
            filter: blur(50px);
            pointer-events: none;
            z-index: 0;
            animation: heroOrbPulse 8s ease-in-out infinite alternate;
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
            background: radial-gradient(ellipse 70% 60% at 50% 40%, rgba(11, 34, 71, 0.65) 0%, rgba(7, 19, 38, 0.35) 55%, transparent 85%);
            border-radius: 2.5rem;
            pointer-events: none;
            z-index: 1;
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

        /* Hero Main Title: Balanced Executive Sizing */
        .hero-home .hero-title {
            display: flex;
            flex-direction: column;
            gap: 0.08em;
            margin: 0;
            color: #ffffff;
            font-size: clamp(1.65rem, 3.1vw, 2.65rem);
            font-weight: 850;
            letter-spacing: -0.028em;
            line-height: 1.08;
            text-transform: uppercase;
            position: relative;
            z-index: 12;
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
            filter: drop-shadow(0 2px 14px rgba(245, 158, 11, 0.45));
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
            background: linear-gradient(115deg, #38bdf8 0%, #00a3e0 25%, #bae6fd 50%, #00a3e0 75%, #0284c7 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 2px 14px rgba(0, 163, 224, 0.45));
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
            color: #cbd5e1;
            font-size: clamp(0.92rem, 1.3vw, 1.15rem);
            font-weight: 500;
            line-height: 1.4;
            letter-spacing: -0.01em;
        }

        .hero-subtitle-lead {
            color: #e2e8f0;
            font-weight: 600;
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
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #fef08a;
            border: 1px solid rgba(245, 158, 11, 0.55);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            animation: badgeFloatA 4.5s ease-in-out infinite alternate;
        }

        .hero-inline-badge--gold svg {
            color: #fbbf24;
        }

        .hero-inline-badge--gold:hover {
            transform: translateY(-2px) scale(1.05);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.4);
            border-color: #fbbf24;
        }

        .hero-inline-badge--blue {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #bae6fd;
            border: 1px solid rgba(14, 165, 233, 0.55);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
            animation: badgeFloatB 4.5s ease-in-out infinite alternate 1.2s;
        }

        .hero-inline-badge--blue svg {
            color: #38bdf8;
        }

        .hero-inline-badge--blue:hover {
            transform: translateY(-2px) scale(1.05);
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
            color: #94a3b8;
            font-weight: 500;
            font-size: 1.05em;
            margin: 0 0.1rem;
        }

        .hero-subtitle-dot {
            color: #38bdf8;
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
            min-width: min(100%, 20rem);
            min-height: 48px;
            padding: 0.75rem 2rem;
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 999px;
            background: linear-gradient(100deg, #f7ba42 0%, #f2a92e 100%);
            color: #071326;
            font-weight: 850;
            font-size: 0.88rem;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 28px rgba(234, 167, 45, 0.42);
            position: relative;
            z-index: 12;
        }

        .hero-ecosystem-cta span[aria-hidden="true"] {
            color: #071326;
            font-size: 1.15em;
            display: inline-block;
            transition: transform 0.25s ease;
        }

        .hero-ecosystem-cta:hover {
            color: #071326;
            background: linear-gradient(100deg, #ffc554 0%, #f5a800 100%);
            filter: brightness(1.05);
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(234, 167, 45, 0.58);
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
            width: min(100%, 45rem);
            margin: -2.85rem auto 0;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .hero-visual-wrap::before {
            content: "";
            position: absolute;
            inset: 12% 5%;
            background: radial-gradient(circle at 35% 55%, rgba(245, 168, 0, 0.32) 0%, transparent 65%),
                        radial-gradient(circle at 65% 50%, rgba(0, 163, 224, 0.42) 0%, transparent 65%);
            filter: blur(55px);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
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
            border-radius: 28px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            -webkit-mask-image: linear-gradient(to bottom,
                    #000 0%,
                    #000 90%,
                    transparent 100%);
            mask-image: linear-gradient(to bottom,
                    #000 0%,
                    #000 90%,
                    transparent 100%);
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.5), 0 0 35px rgba(0, 163, 224, 0.15);
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.35));
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), filter 0.4s ease;
        }

        .hero-visual-wrap:hover .hero-visual {
            transform: scale(1.015);
            filter: drop-shadow(0 28px 50px rgba(0, 0, 0, 0.45));
        }

        /* Video Link Overlay with Play Button */
        .hero-video-link {
            position: absolute;
            right: 1.25rem;
            bottom: 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.4rem 0.85rem 0.4rem 0.45rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.95);
            color: #1e293b;
            box-shadow: 0 8px 24px rgba(11, 26, 46, 0.22);
            backdrop-filter: blur(10px);
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
            z-index: 10;
            transition: all 0.25s ease;
        }

        .hero-video-link:hover {
            color: #0b4ea8;
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(11, 26, 46, 0.3);
        }

        .hero-video-play {
            display: grid;
            place-items: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: #1469c6;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(20, 105, 198, 0.35);
            flex-shrink: 0;
        }

        .hero-video-play svg {
            width: 1.15rem;
            height: 1.15rem;
            display: block;
        }

        /* Hero Pillars (Missão, Visão, Valores) */
        .hero-pillars {
            position: relative;
            z-index: 5;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: clamp(0.8rem, 1.5vw, 1.25rem);
            margin-top: 2rem;
            text-align: left;
        }

        .hero-pillar {
            --hero-pillar-accent: #1599d0;
            display: grid;
            grid-template-columns: auto minmax(0, 1fr);
            gap: 1rem;
            align-items: center;
            min-height: 8.5rem;
            padding: clamp(1rem, 1.7vw, 1.35rem);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 1.1rem;
            background: rgba(14, 29, 56, 0.7);
            backdrop-filter: blur(16px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
        }

        .hero-pillar:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.25);
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.35);
        }

        .hero-pillar.theme-blue { --hero-pillar-accent: #00a3e0; }
        .hero-pillar.theme-gold { --hero-pillar-accent: #f5a800; }
        .hero-pillar.theme-green { --hero-pillar-accent: #10b981; }

        .hero-pillar-icon {
            display: grid;
            place-items: center;
            width: 3.8rem;
            height: 3.8rem;
            border: 1px solid color-mix(in srgb, var(--hero-pillar-accent) 40%, transparent);
            border-radius: 1rem;
            background: color-mix(in srgb, var(--hero-pillar-accent) 15%, transparent);
            color: var(--hero-pillar-accent);
            flex-shrink: 0;
        }

        .hero-pillar-icon svg {
            width: 2rem;
            height: 2rem;
            display: block;
        }

        .hero-pillar-copy {
            position: relative;
            min-width: 0;
            padding-bottom: 0.5rem;
        }

        .hero-pillar-copy::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 2rem;
            height: 2px;
            border-radius: 999px;
            background: var(--hero-pillar-accent);
        }

        .hero-pillar-index {
            display: block;
            margin-bottom: 0.2rem;
            color: var(--hero-pillar-accent);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.05em;
        }

        .hero-pillar h2 {
            margin: 0 0 0.2rem;
            color: #ffffff;
            font-size: clamp(0.95rem, 1.25vw, 1.12rem);
            font-weight: 800;
            letter-spacing: 0.01em;
            text-transform: uppercase;
        }

        .hero-pillar p {
            margin: 0;
            color: #94a3b8;
            font-size: clamp(0.76rem, 1vw, 0.86rem);
            line-height: 1.45;
        }

        .hero-identity-action {
            display: flex;
            justify-content: center;
            margin-top: 1.8rem;
        }

        .hero-identity-link {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.45rem 0.5rem;
            border: 0;
            border-bottom: 2px solid #00a3e0;
            background: transparent;
            color: #38bdf8;
            font: inherit;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.045em;
            text-transform: uppercase;
            cursor: pointer;
            transition: color 0.2s ease, border-color 0.2s ease, gap 0.2s ease;
        }

        .hero-identity-link:hover {
            gap: 0.9rem;
            border-color: #f5a800;
            color: #fbbf24;
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
                width: calc(100% - 2rem);
                margin: -0.75rem auto 0;
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
    </style>
    <link rel="stylesheet" href="/css/site.css">
</head>

<body x-data="rachiApp()" class="min-h-screen flex flex-col justify-between">

    <!-- FLOATING ROLE / VIEW SWITCHER AT BOTTOM-RIGHT (DOES NOT PUSH NAVBAR DOWN) -->
    <aside
        class="fixed bottom-4 right-4 z-50 flex items-center shadow-2xl rounded-full bg-slate-900/95 border border-slate-700/80 p-1.5 backdrop-blur-md">
        <span class="text-[11px] font-bold text-amber-400 px-2.5 uppercase tracking-wider hidden md:inline">
            Módulos:
        </span>
        <button @click="goToHome()"
            :class="currentView === 'public' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-300 hover:text-white'"
            class="px-3 py-1 text-xs rounded-full transition">
            Portal Público
        </button>
        <button @click="currentView = 'customer'"
            :class="currentView === 'customer' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-300 hover:text-white'"
            class="px-3 py-1 text-xs rounded-full transition">
            Área do Cliente
        </button>
        <button @click="currentView = 'employee'"
            :class="currentView === 'employee' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-300 hover:text-white'"
            class="px-3 py-1 text-xs rounded-full transition">
            Funcionário
        </button>
        <button @click="currentView = 'admin'"
            :class="currentView === 'admin' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-300 hover:text-white'"
            class="px-3 py-1 text-xs rounded-full transition">
            Administração
        </button>
    </aside>

    <!-- ============================================================== -->
    <!-- VIEW 1: PUBLIC PORTAL (EXACT CLONE OF https://hom.rachi.ao/)   -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'public'">

        <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-10 py-3">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Brand Logo (Automated Switch: White Logo on Top, Dark Logo on Scrolled) -->
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

                <!-- Main Navigation Links in Capsule -->
                <nav class="hidden lg:flex items-center main-nav-capsule">
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

                            <a href="capital.html" @click="openSol = false"
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

                            <a href="academy.html" @click="openSol = false"
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

                            <a href="tec.html" @click="openSol = false"
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

                            <a href="print.html" @click="openSol = false"
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
                    <a href="loja.html" class="nav-link">
                        <span>Loja</span>
                    </a>
                    <a href="contacto.html" class="nav-link">
                        <span>Contacto</span>
                    </a>
                </nav>

                <!-- Header Actions (PT, Cart, Entrar) -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <!-- Language selector -->
                    <button class="lang-toggle-btn group" title="Idioma">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2"
                            class="text-blue-400 opacity-80 group-hover:opacity-100 group-hover:rotate-12 transition">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="2" y1="12" x2="22" y2="12"></line>
                            <path
                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                            </path>
                        </svg>
                        <span>PT</span>
                    </button>

                    <!-- Cart button -->
                    <button @click="cartDrawer = true" class="cart-icon-btn group" title="Carrinho">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="group-hover:text-amber-400 transition">
                            <circle cx="8" cy="21" r="1"></circle>
                            <circle cx="19" cy="21" r="1"></circle>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12">
                            </path>
                        </svg>
                        <span x-show="cart.length > 0" x-text="cart.length"
                            class="absolute -top-1 -right-1 bg-gradient-to-r from-amber-500 to-yellow-400 text-slate-950 font-black text-[10px] w-4 h-4 rounded-full flex items-center justify-center shadow-md"></span>
                    </button>

                    <!-- Entrar button -->
                    <button @click="loginModal = true" class="btn-entrar-nav group">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                            class="group-hover:translate-x-0.5 transition-transform">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        <span>ENTRAR</span>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-[#00a3e0] focus:outline-none"
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
                class="header-dropdown lg:hidden bg-[#071326]/95 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
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
                        <a href="capital.html" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-emerald-400">01 RACHI Human Capital (Pessoas
                            &amp; Gestão)</a>
                        <a href="academy.html" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy (Capacitação
                            &amp; Ensino)</a>
                        <a href="tec.html" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-sky-400">03 RACHI Tec (Tecnologia &amp;
                            TI)</a>
                        <a href="print.html" @click="mobileMenuOpen = false"
                            class="block text-sm text-slate-400 hover:text-amber-400">04 RACHI Print (Gráfica &amp;
                            Produção)</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2 space-y-2">
                    <a href="#etica" @click.prevent="scrollToSection('etica')"
                        class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="loja.html" class="block font-medium py-1 hover:text-[#00a3e0]">Loja</a>
                    <a href="contacto.html" class="block font-medium py-1 hover:text-[#00a3e0]">Contacto</a>
                </div>
            </div>
        </header>

        <!-- Script de Rolagem Inteligente (Estilo Klasse.ao): Escuro em cima, Claro ao rolar -->
        <script>
                (function () {
                    function updateHeaderScroll() {
                        var header = document.getElementById('main-site-header') || document.querySelector('.site-header');
                        if (!header) return;
                        if (window.scrollY > 30) {
                            header.classList.remove('header-top-dark');
                            header.classList.add('header-scrolled-light');
                        } else {
                            header.classList.remove('header-scrolled-light');
                            header.classList.add('header-top-dark');
                        }
                    }
                    window.addEventListener('scroll', updateHeaderScroll, { passive: true });
                    window.addEventListener('DOMContentLoaded', updateHeaderScroll);
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
                                onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/hero-home-ecosystem.png?v=1788434016'"
                                alt="Profissionais RACHI junto ao símbolo da marca" width="1600" height="975"
                                fetchpriority="high" decoding="async">
                        </picture>

                        <a class="hero-video-link" href="#sobre" @click.prevent="scrollToSection('sobre')"
                            aria-label="Conheça a RACHI">
                            <span class="hero-video-play" aria-hidden="true">
                                <svg width="20" height="20" class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                    <path d="m9 7 8 5-8 5V7Z" fill="currentColor" />
                                </svg>
                            </span>
                            <span>Conheça a RACHI</span>
                        </a>
                    </div>

                    <div class="hero-pillars" aria-label="Missão, visão e valores">
                        <article class="hero-pillar theme-blue reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 32 32" fill="none">
                                    <circle cx="16" cy="16" r="11" stroke="currentColor" stroke-width="1.7"
                                        opacity=".35" />
                                    <circle cx="16" cy="16" r="7.25" stroke="currentColor" stroke-width="1.8" />
                                    <circle cx="16" cy="16" r="3" fill="currentColor" />
                                    <path d="M16 3.5v3.2M16 25.3v3.2M3.5 16h3.2M25.3 16h3.2" stroke="currentColor"
                                        stroke-width="1.8" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">01</span>
                                <h2>Missão</h2>
                                <p>Impulsionar empresas e pessoas através de soluções inteligentes, integradas e inovadoras.</p>
                            </div>
                        </article>
                        <article class="hero-pillar theme-gold reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 32 32" fill="none">
                                    <path d="M4.5 16s4.2-7.2 11.5-7.2S27.5 16 27.5 16s-4.2 7.2-11.5 7.2S4.5 16 4.5 16Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                    <circle cx="16" cy="16" r="3.4" stroke="currentColor" stroke-width="1.8" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">02</span>
                                <h2>Visão</h2>
                                <p>Ser o ecossistema de referência em Angola, acelerando negócios e transformação digital.</p>
                            </div>
                        </article>
                        <article class="hero-pillar theme-green reveal">
                            <div class="hero-pillar-icon" aria-hidden="true">
                                <svg viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M16 4.8 19.2 12l7.8.7-5.9 5.1 1.8 7.6L16 21.8l-6.9 3.6 1.8-7.6-5.9-5.1L20.8 12 16 4.8Z"
                                        stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="hero-pillar-copy">
                                <span class="hero-pillar-index">03</span>
                                <h2>Valores</h2>
                                <p>Inovação contínua, ética inegociável, excelência e foco em resultados sustentáveis.</p>
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
                                <a href="contacto.html"
                                    class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-slate-300 hover:border-slate-800 text-slate-700 font-semibold text-sm transition">
                                    <span>Fale com a equipa</span>
                                </a>
                            </div>
                        </div>

                        <div class="lg:col-span-6 relative">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-100">
                                <img src="https://hom.rachi.ao/assets/img/about-team.png"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/about-team.webp'"
                                    alt="Equipa RACHI — pessoas, processos e tecnologia"
                                    class="w-full h-auto object-cover">
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
                            <div class="rounded-2xl overflow-hidden shadow-2xl border border-slate-200">
                                <img src="https://hom.rachi.ao/assets/img/what-we-do-team.png"
                                    onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.webp'"
                                    alt="Profissionais RACHI a desenvolver soluções integradas"
                                    class="w-full h-auto object-cover">
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
            <!-- SECTION: PARCEIROS                                       -->
            <!-- ========================================================= -->
            <section id="parceiros" class="py-20 bg-white border-t border-slate-200" aria-labelledby="partners-title">
                <div class="max-w-7xl mx-auto px-6 lg:px-12">
                    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0]">Parcerias
                                Estratégicas</span>
                            <h2 id="partners-title"
                                class="text-3xl md:text-4xl font-[850] text-[#071326] mt-2 uppercase">
                                Marcas e instituições que caminham connosco
                            </h2>
                            <p class="text-slate-600 mt-2 max-w-2xl text-sm md:text-base">
                                Colaboramos com organizações que partilham o compromisso de elevar empresas e
                                profissionais em Angola.
                            </p>
                        </div>
                        <div
                            class="mt-4 md:mt-0 flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-xl text-xs font-bold text-slate-800">
                            <span class="text-lg text-amber-500 font-black">02</span>
                            <span>parceiros em destaque</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Partner 1: INOV QUIMUA -->
                        <a href="https://ticket.ao/author/inov-quimua-consultoria/" target="_blank"
                            rel="noopener noreferrer"
                            class="p-8 rounded-3xl border border-slate-200 bg-slate-50 hover:bg-white hover:border-blue-500 hover:shadow-2xl transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span
                                        class="text-xs font-extrabold text-blue-600 uppercase tracking-wider bg-blue-100/60 px-3 py-1 rounded-full">
                                        Parceiro 01
                                    </span>
                                    <span
                                        class="text-xs font-bold text-slate-400 group-hover:text-blue-600 transition flex items-center gap-1">
                                        Visitar website &rarr;
                                    </span>
                                </div>
                                <div class="h-20 flex items-center mb-6">
                                    <img src="https://hom.rachi.ao/uploads/parceiros/whatsapp-image-2026-08-10-at-16-42-34-1-39cfc040.jpg?v=1786648331"
                                        alt="INOV QUIMUA" class="max-h-full max-w-[180px] object-contain rounded-lg">
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition">INOV
                                    QUIMUA</h3>
                                <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                                    Inov Quimua Consultoria é uma empresa de consultoria em Angola liderada por Pedro
                                    Ivanov, conhecida por organizar eventos empresariais e fóruns de liderança voltados
                                    para o desenvolvimento local, como o Cacuaco Business &amp; Leadership Summit.
                                </p>
                            </div>
                            <div
                                class="mt-6 pt-4 border-t border-slate-200/80 text-xs font-bold text-blue-600 flex items-center gap-1">
                                <span>Consultoria empresarial &bull; Liderança &bull; Cimeiras corporativas</span>
                            </div>
                        </a>

                        <!-- Partner 2: HELTON PLUS -->
                        <a href="https://heltonplus.ao/" target="_blank" rel="noopener noreferrer"
                            class="p-8 rounded-3xl border border-slate-200 bg-slate-50 hover:bg-white hover:border-amber-500 hover:shadow-2xl transition-all duration-300 group flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-6">
                                    <span
                                        class="text-xs font-extrabold text-amber-600 uppercase tracking-wider bg-amber-100/60 px-3 py-1 rounded-full">
                                        Parceiro 02
                                    </span>
                                    <span
                                        class="text-xs font-bold text-slate-400 group-hover:text-amber-600 transition flex items-center gap-1">
                                        Visitar website &rarr;
                                    </span>
                                </div>
                                <div class="h-20 flex items-center mb-6">
                                    <img src="https://hom.rachi.ao/uploads/parceiros/whatsapp-image-2026-08-10-at-16-42-35-32d82eaa.jpg?v=1786648596"
                                        alt="HELTON PLUS" class="max-h-full max-w-[180px] object-contain rounded-lg">
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-amber-500 transition">
                                    HELTON PLUS</h3>
                                <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                                    Líder em soluções de higienização e controle de pragas. Compromisso rigoroso com a
                                    saúde e conformidade ambiental de Ambientes Corporativos, Institucionais e
                                    Familiares.
                                </p>
                            </div>
                            <div
                                class="mt-6 pt-4 border-t border-slate-200/80 text-xs font-bold text-amber-600 flex items-center gap-1">
                                <span>Soluções ambientais &bull; Saúde corporativa &bull; Certificações</span>
                            </div>
                        </a>
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
                                <a href="capital.html"
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
                                <a href="academy.html"
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
                                <a href="tec.html"
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
                                <a href="print.html"
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
                        <a href="contacto.html"
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
                        <a href="contacto.html"
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

                            <a href="loja.html"
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


            <!-- IDENTITY MODAL (MISSÃO, VISÃO E VALORES) -->
            <div x-show="identityModalOpen" x-cloak
                class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4">
                <div @click.away="identityModalOpen = false"
                    class="bg-white rounded-3xl max-w-3xl w-full p-8 md:p-10 shadow-2xl border border-slate-100 relative">
                    <button @click="identityModalOpen = false"
                        class="absolute top-6 right-6 text-slate-400 hover:text-slate-700 p-2">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                    <span class="text-xs font-bold text-amber-500 uppercase tracking-widest">Identidade
                        Corporativa</span>
                    <h3 class="text-3xl font-[850] text-[#071326] mt-1 mb-6 uppercase">Missão, Visão e Valores</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="p-6 rounded-2xl bg-blue-50/70 border border-blue-100">
                            <span class="text-blue-600 font-black text-xl">01</span>
                            <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Missão</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Gerar valor sustentável com soluções inteligentes e integradas em tecnologia, gráfica,
                                educação e capital humano, facilitando o crescimento das empresas em Angola.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-amber-50/70 border border-amber-100">
                            <span class="text-amber-600 font-black text-xl">02</span>
                            <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Visão</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Ser a principal referência em ecossistemas de soluções empresariais em Angola,
                                reconhecida pela inovação contínua, proximidade e impacto positivo nos negócios.
                            </p>
                        </div>
                        <div class="p-6 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                            <span class="text-emerald-600 font-black text-xl">03</span>
                            <h4 class="font-bold text-slate-900 text-lg mt-1 mb-2">Valores</h4>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                Ética irrepreensível, compromisso com a qualidade, foco no cliente, colaboração e
                                responsabilidade no desenvolvimento socioeconómico sustentável.
                            </p>
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <button @click="identityModalOpen = false"
                            class="px-8 py-3 bg-[#071326] hover:bg-slate-800 text-white font-bold rounded-xl text-sm transition">
                            Fechar Janela
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
                            class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group">
                            <!-- Image Box -->
                            <div
                                class="h-52 bg-[#f8fafc] p-4 flex items-center justify-center relative overflow-hidden group-hover:bg-slate-100/70 transition">
                                <span x-show="p.badge"
                                    class="absolute top-3 left-3 text-[10px] font-black uppercase tracking-wider px-2.5 py-1 rounded-full shadow-sm"
                                    :class="p.badge === 'Promoção' ? 'bg-rose-500 text-white' : 'bg-amber-500 text-slate-950'"
                                    x-text="p.badge"></span>
                                <span
                                    class="absolute top-3 right-3 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100"
                                    x-text="p.stockText"></span>
                                <img :src="p.image" :alt="p.title"
                                    class="max-h-36 max-w-full object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300">
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-1 flex flex-col justify-between">
                                <div>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-blue-600"
                                        x-text="p.categoryLabel || p.category"></span>
                                    <h3 class="text-sm font-bold text-slate-900 mt-1 line-clamp-2 group-hover:text-blue-600 transition"
                                        x-text="p.title"></h3>
                                </div>
                                <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                    <div>
                                        <span x-show="p.oldPrice" class="text-[11px] text-slate-400 line-through block"
                                            x-text="p.oldPrice"></span>
                                        <span class="text-base font-black text-slate-950" x-text="p.price"></span>
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

        <!-- SUB-PAGE: RACHI ACADEMY (Página separada e dedicada em academy.html) -->
        <div x-show="currentTab === 'academy'" x-cloak class="hidden" x-init="$watch('currentTab', val => { if(val === 'academy') window.location.href = 'academy.html'; })">
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
                            class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-amber-400 transition-all duration-300 flex flex-col justify-between group">
                            <!-- Product Media & Badges -->
                            <div class="h-56 bg-slate-50 p-6 flex items-center justify-center relative overflow-hidden">
                                <img :src="p.image" :alt="p.title"
                                    class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300">

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
                                    <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2 leading-snug group-hover:text-blue-600 transition"
                                        x-text="p.title"></h3>
                                </div>

                                <div class="mt-4 pt-3 border-t border-slate-100">
                                    <!-- Price -->
                                    <div class="flex items-baseline gap-2 mb-2">
                                        <strong class="text-base font-black text-slate-900" x-text="p.price"></strong>
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
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-10 mb-4">
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Um ecossistema de soluções inteligentes para impulsionar negócios e pessoas em Angola e no
                            mundo.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 mb-3">Áreas de Negócio</h4>
                        <ul class="space-y-2 text-xs text-slate-300">
                            <li><a href="tec.html" class="hover:text-white">RACHI Tec</a></li>
                            <li><a href="print.html" class="hover:text-white">RACHI Print</a></li>
                            <li><a href="academy.html" class="hover:text-white">RACHI Academy</a></li>
                            <li><a href="capital.html" class="hover:text-white">RACHI Human Capital</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 mb-3">Sobre Nós</h4>
                        <ul class="space-y-2 text-xs text-slate-300">
                            <li><a href="#sobre" @click.prevent="scrollToSection('sobre')" class="hover:text-white">Quem
                                    somos</a></li>
                            <li><a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos')"
                                    class="hover:text-white">O que fazemos</a></li>
                            <li><a href="#parceiros" @click.prevent="scrollToSection('parceiros')"
                                    class="hover:text-white">Parceiros</a></li>
                            <li><a href="#etica" @click.prevent="currentTab = 'etica'" class="hover:text-white">Ética e
                                    Compliance</a></li>
                            <li><a href="contacto.html" class="hover:text-white">Contacto</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 mb-3">Localização</h4>
                        <p class="text-xs text-slate-400">Luanda — Angola</p>
                        <p class="text-xs text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    </div>
                </div>
                <div class="border-t border-slate-800/80 pt-6 flex justify-between items-center text-xs text-slate-500">
                    <div>&copy; 2026 RACHI. Todos os direitos reservados.</div>
                    <div class="flex gap-4">
                        <span class="text-amber-400 font-bold">PT</span>
                        <span class="text-slate-600">|</span>
                        <span>EN</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: ENTRAR / AUTENTICAÇÃO COM TROCA RÁPIDA DE PAPÉIS        -->
    <!-- ============================================================== -->
    <div x-show="loginModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>
        <div class="bg-slate-900 border border-slate-700 rounded-2xl max-w-md w-full p-8 shadow-2xl text-white">
            <div class="flex justify-between items-center mb-6">
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-8">
                <button @click="loginModal = false" class="text-slate-400 hover:text-white text-2xl">&times;</button>
            </div>
            <h3 class="text-lg font-bold mb-1">Acesso aos Portais Integrados</h3>
            <p class="text-xs text-slate-400 mb-6">Selecione o perfil que deseja simular ou faça login:</p>

            <div class="space-y-3">
                <button @click="loginAs('customer')"
                    class="w-full p-3 rounded-lg border border-blue-500/40 bg-blue-500/10 hover:bg-blue-500/20 text-left flex items-center gap-3 transition">
                    <div
                        class="w-8 h-8 rounded-full bg-blue-500 text-slate-950 font-bold flex items-center justify-center text-sm">
                        C</div>
                    <div>
                        <div class="text-sm font-bold text-white">Entrar como Cliente</div>
                        <div class="text-xs text-slate-400">Inov Quimua Consultoria (Abrir chamados, ver orçamentos)
                        </div>
                    </div>
                </button>

                <button @click="loginAs('employee')"
                    class="w-full p-3 rounded-lg border border-emerald-500/40 bg-emerald-500/10 hover:bg-emerald-500/20 text-left flex items-center gap-3 transition">
                    <div
                        class="w-8 h-8 rounded-full bg-emerald-500 text-slate-950 font-bold flex items-center justify-center text-sm">
                        F</div>
                    <div>
                        <div class="text-sm font-bold text-white">Entrar como Funcionário / Atendente</div>
                        <div class="text-xs text-slate-400">Casimiro Gundja (Fila de solicitações, emitir cotações)
                        </div>
                    </div>
                </button>

                <button @click="loginAs('admin')"
                    class="w-full p-3 rounded-lg border border-amber-500/40 bg-amber-500/10 hover:bg-amber-500/20 text-left flex items-center gap-3 transition">
                    <div
                        class="w-8 h-8 rounded-full bg-amber-500 text-slate-950 font-bold flex items-center justify-center text-sm">
                        A</div>
                    <div>
                        <div class="text-sm font-bold text-white">Entrar como Administrador Geral</div>
                        <div class="text-xs text-slate-400">Controle de Estoque, 4 Unidades, Relatórios e Usuários</div>
                    </div>
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
    <div x-show="currentView === 'customer'" x-cloak class="min-h-screen bg-slate-100 flex flex-col">
        <header class="bg-[#071326] text-white h-16 flex items-center justify-between px-6 border-b border-slate-800">
            <div class="flex items-center gap-4">
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-8">
                <span
                    class="text-xs px-2.5 py-0.5 rounded bg-blue-900/60 text-blue-300 font-bold border border-blue-700/50">Área
                    do Cliente</span>
            </div>
            <div class="flex items-center gap-4">
                <button @click="currentView = 'public'"
                    class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i> Voltar ao Site
                </button>
                <div class="flex items-center gap-2 pl-4 border-l border-slate-800">
                    <span class="text-sm font-semibold">Inov Quimua Consultoria</span>
                    <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center font-bold text-xs">IQ
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-[#071326] text-white p-4 space-y-2 border-r border-slate-800">
                <button @click="customerTab = 'dashboard'"
                    :class="customerTab === 'dashboard' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-400 hover:bg-slate-800'"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Painel Geral
                </button>
                <button @click="customerTab = 'new_request'"
                    :class="customerTab === 'new_request' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-400 hover:bg-slate-800'"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left transition">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Nova Solicitação
                </button>
                <button @click="customerTab = 'my_quotes'"
                    :class="customerTab === 'my_quotes' ? 'bg-amber-500 text-slate-950 font-bold' : 'text-slate-400 hover:bg-slate-800'"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left transition">
                    <i data-lucide="receipt" class="w-4 h-4"></i> Orçamentos
                </button>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-8 overflow-y-auto">
                <!-- Dashboard overview -->
                <div x-show="customerTab === 'dashboard'">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-slate-900">Visão Geral do Cliente</h2>
                            <p class="text-sm text-slate-500">Acompanhe suas solicitações, orçamentos e serviços em
                                andamento.</p>
                        </div>
                        <button @click="customerTab = 'new_request'" class="btn-cta-gold text-sm py-2 px-4">
                            + Nova Solicitação
                        </button>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                            <span class="text-xs text-slate-500 uppercase font-bold">Solicitações Ativas</span>
                            <div class="text-3xl font-black text-slate-900 mt-2" x-text="customerRequests.length"></div>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                            <span class="text-xs text-slate-500 uppercase font-bold">Orçamentos Pendentes</span>
                            <div class="text-3xl font-black text-amber-500 mt-2"
                                x-text="customerQuotes.filter(q => q.status === 'sent').length"></div>
                        </div>
                        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                            <span class="text-xs text-slate-500 uppercase font-bold">Cursos Inscritos</span>
                            <div class="text-3xl font-black text-emerald-600 mt-2">1</div>
                        </div>
                    </div>

                    <!-- List of requests -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
                        <h3 class="font-bold text-base text-slate-900 mb-4">Minhas Solicitações (Clique para ver
                            detalhes e chat)</h3>
                        <div class="space-y-3">
                            <template x-for="req in customerRequests" :key="req.id">
                                <div @click="selectedRequest = req; customerTab = 'view_request'"
                                    class="p-4 border border-slate-200 hover:border-amber-500 rounded-xl transition cursor-pointer flex justify-between items-center">
                                    <div>
                                        <div class="flex items-center gap-3">
                                            <span class="font-mono font-bold text-blue-600"
                                                x-text="req.protocol"></span>
                                            <span
                                                class="text-xs font-semibold px-2 py-0.5 rounded bg-slate-100 text-slate-700"
                                                x-text="req.unit"></span>
                                        </div>
                                        <h4 class="font-bold text-slate-900 mt-1" x-text="req.title"></h4>
                                        <p class="text-xs text-slate-500 mt-0.5" x-text="req.description"></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold"
                                            :class="getStatusBadgeClass(req.status)" x-text="req.statusLabel"></span>
                                        <div class="text-xs text-slate-400 mt-1" x-text="req.date"></div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Form to create request -->
                <div x-show="customerTab === 'new_request'">
                    <div class="max-w-2xl bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Solicitar Novo Serviço</h3>
                        <p class="text-xs text-slate-500 mb-6">Preencha o formulário abaixo para receber acompanhamento
                            e orçamento.</p>

                        <form @submit.prevent="submitRequest" class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Unidade de Negócio
                                    *</label>
                                <select x-model="newRequest.unit" required
                                    class="w-full border rounded-lg p-2.5 text-sm">
                                    <option value="">Selecione a Unidade...</option>
                                    <option value="1">RACHI Tec</option>
                                    <option value="2">RACHI Print</option>
                                    <option value="3">RACHI Academy</option>
                                    <option value="4">RACHI Human Capital</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Título da
                                    Solicitação *</label>
                                <input type="text" x-model="newRequest.title" required
                                    placeholder="Ex: Sistema de Gestão para Clínica"
                                    class="w-full border rounded-lg p-2.5 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Descrição Detalhada
                                    *</label>
                                <textarea x-model="newRequest.description" rows="4" required
                                    placeholder="Descreva os requisitos..."
                                    class="w-full border rounded-lg p-2.5 text-sm"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase text-slate-700 mb-1">Prioridade</label>
                                    <select x-model="newRequest.priority"
                                        class="w-full border rounded-lg p-2.5 text-sm">
                                        <option value="normal">Normal</option>
                                        <option value="high">Alta</option>
                                        <option value="urgent">Urgente</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Prazo
                                        Pretendido</label>
                                    <input type="date" x-model="newRequest.date"
                                        class="w-full border rounded-lg p-2.5 text-sm">
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-lg shadow mt-2">
                                [ Enviar Solicitação ]
                            </button>
                        </form>
                    </div>
                </div>

                <!-- View single request -->
                <div x-show="customerTab === 'view_request'" x-cloak>
                    <button @click="customerTab = 'dashboard'"
                        class="text-sm text-blue-600 hover:underline mb-4 inline-block">&larr; Voltar ao painel</button>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-if="selectedRequest">
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white p-6 rounded-xl border border-slate-200">
                                <div class="flex justify-between items-center pb-3 border-b">
                                    <span class="font-mono font-bold text-xl text-blue-600"
                                        x-text="selectedRequest.protocol"></span>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold"
                                        :class="getStatusBadgeClass(selectedRequest.status)"
                                        x-text="selectedRequest.statusLabel"></span>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 mt-4" x-text="selectedRequest.title"></h3>
                                <p class="text-slate-600 text-sm mt-2 leading-relaxed"
                                    x-text="selectedRequest.description"></p>
                            </div>

                            <!-- Chat -->
                            <div class="bg-white p-6 rounded-xl border border-slate-200">
                                <h4 class="font-bold text-slate-900 mb-4">Mensagens do Atendimento</h4>
                                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                                    <template x-for="m in selectedRequest.messages" :key="m.id">
                                        <div class="p-3 rounded-lg text-sm"
                                            :class="m.fromUser ? 'bg-amber-50 ml-12 border border-amber-200' : 'bg-slate-100 mr-12'">
                                            <div class="text-xs text-slate-400 font-semibold mb-1" x-text="m.sender">
                                            </div>
                                            <div x-text="m.text"></div>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" x-model="chatInput" placeholder="Digite uma mensagem..."
                                        class="flex-1 border rounded-lg px-3 py-2 text-sm">
                                    <button @click="sendChatMessage()"
                                        class="bg-slate-900 text-white px-4 py-2 rounded-lg text-sm font-semibold">Enviar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline (Section 16) -->
                        <div class="bg-white p-6 rounded-xl border border-slate-200 h-fit">
                            <h4 class="font-bold text-slate-900 mb-4">Histórico do Chamado</h4>
                            <div class="space-y-4">
                                <template x-for="step in selectedRequest.timeline" :key="step.title">
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 mt-1.5 rounded-full bg-amber-500"></div>
                                        <div>
                                            <div class="text-xs text-slate-400" x-text="step.date"></div>
                                            <div class="font-semibold text-sm text-slate-800" x-text="step.title"></div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quotes -->
                <div x-show="customerTab === 'my_quotes'">
                    <h3 class="text-xl font-bold text-slate-900 mb-4">Orçamentos Recebidos</h3>
                    <div class="space-y-4">
                        <template x-for="q in customerQuotes" :key="q.number">
                            <div
                                class="bg-white p-5 rounded-xl border border-slate-200 flex justify-between items-center shadow-sm">
                                <div>
                                    <span class="font-mono font-bold text-lg text-slate-900" x-text="q.number"></span>
                                    <div class="text-xs text-slate-500 mt-1"
                                        x-text="'Referente a ' + q.protocol + ' • Vencimento: ' + q.validUntil"></div>
                                    <div class="text-lg font-black text-emerald-600 mt-2"
                                        x-text="q.total.toLocaleString('pt-AO') + ' AOA'"></div>
                                </div>
                                <div>
                                    <button x-show="q.status === 'sent'" @click="approveQuote(q)"
                                        class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-lg shadow">
                                        Aprovar Orçamento
                                    </button>
                                    <span x-show="q.status === 'approved'"
                                        class="text-xs px-3 py-1.5 bg-emerald-100 text-emerald-800 font-bold rounded-full">
                                        Aprovado com Sucesso
                                    </span>
                                </div>
                            </div>
                        </template>
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
                    class="text-xs px-2.5 py-0.5 rounded bg-emerald-900/60 text-emerald-300 font-bold border border-emerald-700/50">Área
                    de Atendimento & Técnicos</span>
            </div>
            <div class="flex items-center gap-4">
                <button @click="currentView = 'public'"
                    class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                    <i data-lucide="globe" class="w-3.5 h-3.5"></i> Voltar ao Site
                </button>
                <div class="flex items-center gap-2 pl-4 border-l border-slate-800">
                    <span class="text-sm font-semibold">Técnico: Casimiro (RACHI Tec)</span>
                    <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center font-bold text-xs">
                        CG</div>
                </div>
            </div>
        </header>

        <div class="flex-1 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-[#071326] text-white p-4 space-y-2 border-r border-slate-800">
                <button
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-left bg-amber-500 text-slate-950 font-bold">
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
                init() {
                    setInterval(() => {
                        if (!this.featuredPaused && this.currentTab === 'home') {
                            this.nextFeaturedProduct();
                        }
                    }, 4500);
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
                    window.location.href = 'loja.html';
                },
                openUnitPage(unit) {
                    if (unit === 'academy') {
                        window.location.href = 'academy.html';
                        return;
                    }
                    if (unit === 'capital') {
                        window.location.href = 'capital.html';
                        return;
                    }
                    if (unit === 'tec') {
                        window.location.href = 'tec.html';
                        return;
                    }
                    if (unit === 'print') {
                        window.location.href = 'print.html';
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
                    window.location.href = 'contacto.html';
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
                        image: "/images/hp-elitebook-studio.jpg"
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
                        image: "/images/smartwatch-studio.jpg"
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
                        image: "/images/cabo-console-studio.jpg"
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
                        image: "/images/tvbox-studio.jpg"
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
                        image: "/images/auricular-fio-studio.jpg"
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
                        image: "/images/auriculares-tws-studio.jpg"
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
                        image: "/images/capa-iphone-studio.jpg"
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
                        image: "/images/hp-elitebook-studio.jpg"
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
                        image: "/images/smartwatch-studio.jpg"
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
                        image: "/images/cabo-console-studio.jpg"
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
                        image: "/images/tvbox-studio.jpg"
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
                        image: "/images/auricular-fio-studio.jpg"
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
                        image: "/images/auriculares-tws-studio.jpg"
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
                        image: "/images/capa-iphone-studio.jpg"
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
                        window.location.href = 'academy.html';
                        return;
                    }
                    if (id === 'capital' || id === 'tec' || id === 'print') {
                        this.openUnitPage(id);
                        return;
                    }
                    if (id === 'contacto') {
                        window.location.href = 'contacto.html';
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
                    { id: 1, name: 'HP Elitebook x360 1040 G8 (2-in-1)', category: 'informatica', price: 1489000.29, stock: 4, desc: 'SSD 512GB, 16GB RAM DDR4, Touchscreen conversível.', image: 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-05-at-11-02-30-3bbd6053.jpg' },
                    { id: 2, name: 'Smartwatch Lige Executivo', category: 'informatica', price: 10000.00, stock: 25, desc: 'Visor digital com funções de chamada e pulseira metálica.', image: 'https://hom.rachi.ao/uploads/produtos/smart-whatch-8ee88fb4.png' },
                    { id: 3, name: 'Cabo Console RS232/DB9 para RJ45', category: 'informatica', price: 16989.89, stock: 30, desc: 'Para configuração de switches e roteadores.', image: 'https://hom.rachi.ao/uploads/produtos/cabo-console_rj45-db44e13a.png' },
                    { id: 4, name: 'Auricular com Fio 3.5mm', category: 'consumiveis', price: 3000.00, stock: 50, desc: 'Áudio estéreo de alta fidelidade para chamadas e reuniões.', image: 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-09-at-23-27-07-2-2e9986bc.jpg' },
                    { id: 5, name: 'Capa Temática Naruto p/ iPhone', category: 'promocional', price: 7000.00, stock: 2, desc: 'Capa decorada de alta durabilidade e aderência.', image: 'https://hom.rachi.ao/uploads/produtos/capa-iphone-22a16aff.png' },
                    { id: 6, name: 'TV Box Android MXQ Pro 4K', category: 'informatica', price: 18000.00, stock: 15, desc: 'Streaming em 4K e conexão Wi-Fi de alta velocidade.', image: 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-11-at-09-06-36-f406b8ca.jpg' }
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
                customerRequests: [
                    {
                        id: 1,
                        protocol: 'SOL-2026-000001',
                        unit: 'RACHI Tec',
                        title: 'Desenvolvimento de Novo Website Institucional',
                        description: 'Necessitamos de modernizar o portal corporativo com área de agendamento e integração de pagamentos.',
                        status: 'in_analysis',
                        statusLabel: 'Em Análise',
                        priority: 'high',
                        date: '19/09/2026',
                        timeline: [
                            { date: '19/09/2026 09:15', title: 'Solicitação Criada (#SOL-2026-000001)' },
                            { date: '19/09/2026 10:30', title: 'Atribuída ao Técnico Casimiro' },
                            { date: '19/09/2026 11:00', title: 'Em Análise Técnica' }
                        ],
                        messages: [
                            { id: 1, sender: 'Cliente', fromUser: true, text: 'Olá, enviamos o briefing anexado.' },
                            { id: 2, sender: 'Técnico Casimiro', fromUser: false, text: 'Recebido! Estamos elaborando o orçamento preliminar.' }
                        ]
                    }
                ],
                customerQuotes: [
                    { number: 'ORC-2026-0001', protocol: 'SOL-2026-000001', total: 450000, validUntil: '05/10/2026', status: 'sent' }
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
                submitRequest() {
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
                    window.location.href = `academy-login.html?curso=${title}&preco=${price}&modo=register&urlAfterLogin=${encodeURIComponent(window.location.href)}`;
                },
                sendChatMessage() {
                    if (!this.chatInput.trim()) return;
                    this.selectedRequest.messages.push({
                        id: Date.now(),
                        sender: 'Cliente',
                        fromUser: true,
                        text: this.chatInput
                    });
                    this.chatInput = '';
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
                getStatusBadgeClass(status) {
                    switch (status) {
                        case 'new': return 'bg-blue-100 text-blue-800';
                        case 'in_analysis': return 'bg-yellow-100 text-yellow-800';
                        case 'quoted': return 'bg-purple-100 text-purple-800';
                        case 'in_progress': return 'bg-indigo-100 text-indigo-800';
                        case 'completed': return 'bg-emerald-100 text-emerald-800';
                        case 'cancelled': return 'bg-rose-100 text-rose-800';
                        default: return 'bg-slate-100 text-slate-800';
                    }
                },
                loginAs(role) {
                    this.loginModal = false;
                    if (role === 'customer') this.currentView = 'customer';
                    if (role === 'employee') this.currentView = 'employee';
                    if (role === 'admin') this.currentView = 'admin';
                }
            };
        }

        window.scrollToSection = function (id) {
            const app = document.querySelector('[x-data]');
            if (app && app._x_dataStack && app._x_dataStack[0]) {
                if (id === 'contacto') {
                    window.location.href = 'contacto.html';
                    return;
                }
                app._x_dataStack[0].scrollToSection(id);
                return;
            }
            if (id === 'contacto') {
                window.location.href = 'contacto.html';
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
                    window.location.replace('academy.html');
                    return;
                }
                if (['capital', 'tec', 'print'].includes(targetId)) {
                    window.location.replace(targetId + '.html');
                    return;
                }
                if (targetId === 'contacto') {
                    window.location.replace('contacto.html');
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