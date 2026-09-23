<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto — Fale Connosco — RACHI Soluções Inteligentes</title>
    <meta name="description" content="Entre em contacto com a RACHI. Conte-nos o seu desafio e receba a solução ideal em tecnologia, gráfica, formação e capital humano em Angola.">
    <!-- Google Fonts: Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
        [x-cloak] { display: none !important; }
        html {
            scroll-behavior: smooth;
        }
        section[id], div[id] {
            scroll-margin-top: 80px;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            color: #0b1a2e;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        html.dark body {
            background-color: #071326 !important;
            color: #e2e8f0 !important;
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
        .site-header.header-top-dark .logo-light { display: block !important; }
        .site-header.header-top-dark .logo-dark { display: none !important; }

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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            padding: 0;
            border-radius: 50%;
            border: 1.5px solid #00a3e0 !important;
            background: rgba(7, 19, 38, 0.85);
            color: #ffffff;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .site-header.header-top-dark .lang-toggle-btn:hover {
            border-color: #4ea2ff;
            background: rgba(0, 163, 224, 0.2);
            box-shadow: 0 0 14px rgba(0, 163, 224, 0.4);
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
        .site-header.header-scrolled-light .logo-light { display: none !important; }
        .site-header.header-scrolled-light .logo-dark { display: block !important; }

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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            padding: 0;
            border-radius: 50%;
            border: 1.5px solid #00a3e0 !important;
            background: #ffffff;
            color: #0b1a2e;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        .site-header.header-scrolled-light .lang-toggle-btn:hover {
            border-color: #00a3e0;
            background: rgba(0, 163, 224, 0.08);
            color: #0077c2;
            box-shadow: 0 0 12px rgba(0, 163, 224, 0.25);
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
        .site-header.header-scrolled-light .logo-light { display: none !important; }
        .site-header.header-scrolled-light .logo-dark { display: block !important; }

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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            padding: 0;
            border-radius: 50%;
            border: 1.5px solid #00a3e0 !important;
            background: #ffffff;
            color: #0b1a2e;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }
        .site-header.header-scrolled-light .lang-toggle-btn:hover {
            border-color: #00a3e0;
            background: rgba(0, 163, 224, 0.08);
            color: #0077c2;
            box-shadow: 0 0 12px rgba(0, 163, 224, 0.25);
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

        /* ============================================================ */
        /* CONTACT PAGE ENHANCEMENTS (LIGHT & DARK MODE LUXURY)         */
        /* ============================================================ */

        /* Inputs & Textareas */
        .contact-input {
            background-color: #ffffff;
            border: 1.5px solid #e2e8f0;
            color: #0f172a;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .contact-input:hover {
            border-color: #cbd5e1;
            background-color: #ffffff;
        }
        .contact-input:focus {
            border-color: #00a3e0;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(0, 163, 224, 0.14);
            outline: none;
        }
        html.dark .contact-input {
            background-color: #091528 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.25) !important;
        }
        html.dark .contact-input::placeholder {
            color: #64748b !important;
        }
        html.dark .contact-input:hover {
            border-color: rgba(255, 255, 255, 0.25) !important;
            background-color: #0d1e38 !important;
        }
        html.dark .contact-input:focus {
            border-color: #00a3e0 !important;
            background-color: #091528 !important;
            box-shadow: 0 0 0 4px rgba(0, 163, 224, 0.25) !important;
        }

        /* Channel Cards */
        .contact-channel-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .contact-channel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px -4px rgba(0, 80, 240, 0.1);
            border-color: rgba(0, 163, 224, 0.45);
        }
        html.dark .contact-channel-card {
            background: linear-gradient(145deg, rgba(13, 30, 56, 0.96) 0%, rgba(7, 19, 38, 0.99) 100%) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 12px 30px -8px rgba(0, 0, 0, 0.65) !important;
        }
        html.dark .contact-channel-card:hover {
            transform: translateY(-3px);
            border-color: rgba(0, 163, 224, 0.5) !important;
            box-shadow: 0 18px 38px -8px rgba(0, 0, 0, 0.8), 0 0 20px rgba(0, 163, 224, 0.2) !important;
        }

        /* Contact Form Container */
        .contact-form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 45px -15px rgba(0, 0, 0, 0.07);
        }
        html.dark .contact-form-card {
            background: linear-gradient(150deg, rgba(13, 30, 56, 0.98) 0%, rgba(7, 18, 36, 0.99) 100%) !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.85), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }

        /* FAQ Cards */
        .contact-faq-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.25s ease;
        }
        .contact-faq-card:hover {
            border-color: rgba(0, 163, 224, 0.4);
            box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.06);
        }
        html.dark .contact-faq-card {
            background: linear-gradient(145deg, rgba(13, 30, 56, 0.95) 0%, rgba(7, 19, 38, 0.98) 100%) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 8px 24px -6px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark .contact-faq-card:hover {
            border-color: rgba(0, 163, 224, 0.45) !important;
        }
    </style>
    <link rel="stylesheet" href="/css/site.css">
</head>
<body x-data="rachiApp()" class="min-h-screen flex flex-col justify-between pt-[75px] bg-[#f8fafc] dark:bg-[#071326] text-slate-900 dark:text-slate-100 transition-colors duration-300">



    <!-- ============================================================== -->
    <!-- VIEW 1: PUBLIC PORTAL (EXACT CLONE OF https://hom.rachi.ao/)   -->
    <!-- ============================================================== -->
    <div x-show="currentView === 'public'">
        
        <!-- HEADER COM SUPORTE TOTAL A MODO CLARO E ESCURO -->
        <header id="main-site-header" class="site-header px-4 sm:px-6 lg:px-8 py-3.5 sm:py-4 lg:py-4.5 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 lg:gap-4 xl:gap-6">
                <!-- Brand Logo (Automated Switch: White Logo on Top, Dark Logo on Scrolled) -->
                <div class="flex-shrink-0 flex items-center justify-start z-10">
                    <a href="#home" @click.prevent="goToHome()" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
                        <!-- Light Logo (for dark header at top) -->
                        <img src="/images/logo-rachi-light.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'"
                             alt="RACHI" 
                             class="brand-logo-img logo-light filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.3)] transition-all">
                        <!-- Dark Logo (for light header when scrolled) -->
                        <img src="/images/logo-rachi-dark.png" 
                             onerror="this.onerror=null; this.src='/images/logo-rachi.png'"
                             alt="RACHI" 
                             class="brand-logo-img logo-dark filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.2)] transition-all">
                    </a>
                </div>

                <!-- Main Navigation Links in Capsule -->
                <div class="flex-1 hidden lg:flex items-center justify-center min-w-0 px-2 xl:px-4">
                    <nav class="flex items-center main-nav-capsule">
                        <a href="#home" @click.prevent="goToHome()" class="nav-link cursor-pointer" :class="currentTab === 'home' ? 'active' : ''">
                        <span>Home</span>
                    </a>
                    
                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseover="open = true" @click="open = !open" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="open ? 'nav-link-open' : ''">
                            <span>Sobre Nós</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="open ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="header-dropdown absolute top-full left-0 mt-3 w-56 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2 z-50 text-sm space-y-1">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                            <a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Depoimentos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (4 Unidades) -->
                    <div class="relative" x-data="{ openSol: false }" @mouseleave="openSol = false">
                        <button @mouseover="openSol = true" @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="['capital','academy','tec','print'].includes(currentTab) || openSol ? 'active' : ''">
                            <span>Soluções</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="openSol ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="openSol" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="header-dropdown absolute top-full left-0 mt-3 w-80 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2.5 z-50 text-sm space-y-1.5">
                            
                            <a href="/capital" @click="openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-emerald-500/15 text-slate-300 hover:text-emerald-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center font-black text-xs">
                                        01
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Human Capital</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Pessoas &amp; Gestão</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/academy" @click="openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-indigo-500/15 text-slate-300 hover:text-indigo-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center font-black text-xs">
                                        02
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Academy</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Capacitação &amp; Ensino</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/tec" @click="openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-sky-500/15 text-slate-300 hover:text-sky-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center font-black text-xs">
                                        03
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Tec</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Tecnologia &amp; TI</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/print" @click="openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-amber-500/15 text-slate-300 hover:text-amber-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center font-black text-xs">
                                        04
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Print</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Gráfica &amp; Produção</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                        </div>
                    </div>

                    <a href="/#etica" class="nav-link">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="/loja" class="nav-link">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" class="nav-link active">
                        <span>Contacto</span>
                    </a>
                </nav>
                </div>

                <!-- Header Actions (Entrar / Perfil de Usuário Conectado) -->
                <div class="flex-shrink-0 flex items-center justify-end gap-2.5 sm:gap-3 z-10">
                    <!-- Botão Padronizado de Alternância de Tema (Dark / Light Mode) -->
                    <button type="button"
                        onclick="window.toggleRachiTheme()"
                        class="theme-toggle-btn flex-shrink-0 w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center transition-all duration-200 cursor-pointer border border-slate-300/80 dark:border-white/10 bg-slate-100/90 hover:bg-slate-200/90 dark:bg-white/5 dark:hover:bg-white/15 text-slate-700 dark:text-amber-400 shadow-sm"
                        aria-label="Alternar Modo Escuro / Claro"
                        title="Alternar Modo Escuro / Claro">
                        <!-- Lua (Visível no modo claro -> ao clicar ativa escuro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-700 dark:hidden transition-transform duration-300 hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sol (Visível no modo escuro -> ao clicar ativa claro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hidden dark:block transition-transform duration-300 hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>

                    <template x-if="!currentUser">
                        <a href="/?login=1" class="btn-entrar-nav group">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-0.5 transition-transform">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                                <polyline points="10 17 15 12 10 7"/>
                                <line x1="15" y1="12" x2="3" y2="12"/>
                            </svg>
                            <span>ENTRAR</span>
                        </a>
                    </template>

                    <template x-if="currentUser">
                        <div class="relative" x-data="{ userMenuDropdown: false }" @click.outside="userMenuDropdown = false">
                            <button @click="userMenuDropdown = !userMenuDropdown"
                                    class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-900/80 dark:hover:bg-slate-800 text-slate-800 dark:text-white border border-slate-300 dark:border-slate-700/80 transition shadow-sm cursor-pointer">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#0050f0] to-[#00a3e0] text-white font-black text-xs flex items-center justify-center shadow">
                                    <span x-text="currentUser.avatar || 'CG'"></span>
                                </div>
                                <div class="text-left hidden sm:block">
                                    <div class="text-xs font-bold leading-tight max-w-[130px] truncate" x-text="currentUser.nome || currentUser.name || 'Minha Conta'"></div>
                                    <div class="text-[10px] text-blue-600 dark:text-blue-300 font-semibold" x-text="currentUser.roleLabel || 'Conectado'"></div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400 transition-transform duration-200" :class="userMenuDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div x-show="userMenuDropdown"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                 class="header-dropdown absolute right-0 mt-2 w-64 bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200 dark:border-slate-700 rounded-2xl shadow-2xl p-2 z-50 text-xs text-slate-800 dark:text-slate-200 space-y-1">
                                <a href="/?view=customer" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 transition">
                                    <svg class="w-4 h-4 text-[#0050f0] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    <span>Painel do Cliente</span>
                                </a>
                                <a href="/loja" class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 transition">
                                    <div class="flex items-center gap-2.5">
                                        <svg class="w-4 h-4 text-[#00a3e0] dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                        <span>Loja</span>
                                    </div>
                                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-600 dark:text-blue-400 font-bold">Conectado</span>
                                </a>
                                <a href="/aluno-dashboard" class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 transition">
                                    <div class="flex items-center gap-2.5">
                                        <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                        <span>Perfil Aluno (Academy)</span>
                                    </div>
                                    <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 font-bold" x-text="currentUser.has_matricula ? 'Ativa' : 'Cursos'"></span>
                                </a>
                                <div class="pt-1 mt-1 border-t border-slate-200 dark:border-slate-800">
                                    <button @click="logout(); userMenuDropdown = false" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-500/10 text-left text-rose-500 transition font-medium cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        <span>Terminar Sessão</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-slate-800 dark:text-white hover:text-[#0077c2] dark:hover:text-[#00a3e0] focus:outline-none" aria-label="Menu Principal">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-white/95 dark:bg-[#071326]/95 backdrop-blur-2xl border border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl text-slate-800 dark:text-slate-100">
                <a href="/#home" class="block font-medium py-1.5 hover:text-[#0077c2] dark:hover:text-[#00a3e0]">Home</a>
                <div class="border-t border-slate-200 dark:border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-amber-500 tracking-wider">Sobre Nós</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="/#sobre" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Quem somos</a>
                        <a href="/#o-que-fazemos" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">O que fazemos</a>
                        <a href="/#parceiros" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Parceiros</a>
                        <a href="/#depoimentos" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">Depoimentos</a>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-[#0077c2] dark:text-[#00a3e0] tracking-wider">Soluções</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="/capital" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-emerald-500">01 RACHI Human Capital (Pessoas &amp; Gestão)</a>
                        <a href="/academy" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-500">02 RACHI Academy (Capacitação &amp; Ensino)</a>
                        <a href="/tec" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-sky-500">03 RACHI Tec (Tecnologia &amp; TI)</a>
                        <a href="/print" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-amber-500">04 RACHI Print (Gráfica &amp; Produção)</a>
                    </div>
                </div>
                <div class="border-t border-slate-200 dark:border-white/10 pt-2 space-y-2">
                    <a href="/#etica" class="block font-medium py-1 hover:text-[#0077c2] dark:hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="/loja" class="block font-medium py-1 hover:text-[#0077c2] dark:hover:text-[#00a3e0]">Loja</a>
                    <a href="/contacto" class="block font-medium py-1 text-[#0077c2] dark:text-[#00a3e0] font-bold">Contacto</a>
                </div>
            </div>
        </header>

        <!-- Script de Rolagem Inteligente: Claro no modo claro, Escuro no modo escuro -->
        <script>
            (function() {
                function updateHeaderScroll() {
                    var header = document.getElementById('main-site-header') || document.querySelector('.site-header');
                    if (!header) return;
                    var isDark = document.documentElement.classList.contains('dark');
                    if (isDark) {
                        header.classList.remove('header-scrolled-light');
                        header.classList.add('header-top-dark');
                    } else {
                        header.classList.remove('header-top-dark');
                        header.classList.add('header-scrolled-light');
                    }
                }
                window.addEventListener('scroll', updateHeaderScroll, { passive: true });
                window.addEventListener('DOMContentLoaded', updateHeaderScroll);
                window.addEventListener('rachi-theme-changed', updateHeaderScroll);
                updateHeaderScroll();
            })();
        </script>

        <!-- SUB-PAGE: CONTACTO VIEW -->
        <div class="min-h-screen bg-[#f8fafc] dark:bg-[#071326] transition-colors duration-300">
            <!-- Hero Banner Executivo com suporte total a Modo Claro e Escuro -->
            <section class="bg-gradient-to-b from-slate-100/70 via-white to-blue-50/30 dark:from-[#071326] dark:via-[#071326] dark:to-[#071326] text-slate-900 dark:text-white pt-12 pb-14 sm:pt-14 sm:pb-16 relative overflow-hidden border-b border-slate-200/90 dark:border-slate-800/80 transition-colors duration-300">
                <!-- Luzes ambientes corporativas suaves -->
                <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-400/10 dark:bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute top-1/2 right-0 w-96 h-96 bg-[#00a3e0]/10 dark:bg-[#00a3e0]/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 left-1/3 w-80 h-80 bg-[#f5a800]/5 dark:bg-[#f5a800]/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 mb-6 font-medium">
                        <a href="/#home" class="hover:text-slate-900 dark:hover:text-white transition cursor-pointer flex items-center gap-1.5">
                            <i data-lucide="home" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span>Início</span>
                        </a>
                        <span>/</span>
                        <span class="text-[#0077c2] dark:text-sky-400 font-semibold">Contacto &amp; Atendimento</span>
                    </nav>

                    <div class="max-w-3xl">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-[850] text-slate-900 dark:text-white tracking-tight leading-tight uppercase font-heading">
                            Fale com a <span class="text-[#0077c2] dark:text-[#00a3e0]">RACHI</span>
                        </h1>
                        <div class="w-20 h-1.5 bg-gradient-to-r from-[#0077c2] to-[#eba72d] dark:from-[#00a3e0] dark:to-[#eba72d] rounded-full my-5"></div>
                        <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base lg:text-lg leading-relaxed font-normal">
                            Conte-nos o seu desafio. A nossa equipa de consultores e especialistas técnicos responde com a máxima prontidão para impulsionar o seu negócio em Angola através do nosso ecossistema integrado.
                        </p>

                        <!-- Pílulas de Acesso Rápido -->
                        <div class="mt-7 flex flex-wrap items-center gap-3">
                            <a href="https://wa.me/244923000000" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100/90 dark:bg-emerald-500/20 dark:hover:bg-emerald-500/30 border border-emerald-300/80 dark:border-emerald-500/40 text-emerald-800 dark:text-emerald-300 text-xs font-bold transition-all shadow-sm cursor-pointer hover:-translate-y-0.5 transform">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.861.173.086.275.072.376-.044.101-.115.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
                                <span>WhatsApp Directo (+244 923 000 000)</span>
                            </a>
                            <a href="mailto:geral@rachi.ao"
                               class="inline-flex items-center gap-2.5 px-4 py-2.5 rounded-xl bg-blue-50 hover:bg-blue-100/90 dark:bg-blue-500/20 dark:hover:bg-blue-500/30 border border-blue-300/80 dark:border-blue-500/40 text-blue-800 dark:text-blue-300 text-xs font-bold transition-all shadow-sm cursor-pointer hover:-translate-y-0.5 transform">
                                <i data-lucide="mail" class="w-4 h-4 text-blue-600 dark:text-blue-400 shrink-0"></i>
                                <span>geral@rachi.ao</span>
                            </a>
                            <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-white dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-300 text-xs font-medium shadow-sm">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-500 dark:text-amber-400"></i>
                                <span>Seg - Sex: 08h às 17h</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION: CANAIS & FORMULÁRIO EXECUTIVO -->
            <section id="contacto" class="py-14 sm:py-16 md:py-20 bg-[#f8fafc] dark:bg-[#071326] transition-colors duration-300" aria-labelledby="contact-title">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-stretch">
                        
                        <!-- Coluna da Esquerda: Canais Oficiais & Unidades -->
                        <div class="lg:col-span-5 flex flex-col justify-between h-full space-y-6 lg:space-y-0">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-[#0050f0] dark:text-sky-400 bg-blue-50 dark:bg-blue-500/15 px-3.5 py-1 rounded-full border border-blue-100 dark:border-blue-500/30">
                                    Canais Oficiais
                                </span>
                                <h2 id="contact-title" class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mt-3 uppercase tracking-tight font-heading">
                                    Fale Connosco
                                </h2>
                                <p class="text-slate-600 dark:text-slate-300 mt-2 text-sm leading-relaxed">
                                    Escolha o canal corporativo mais conveniente para a sua empresa ou preencha o formulário ao lado para atendimento imediato.
                                </p>
                            </div>

                            <!-- Cards de Contacto Interativos perfeitamente alinhados -->
                            <div class="space-y-3.5 pt-2">
                                <!-- E-mail -->
                                <div class="contact-channel-card flex items-center justify-between p-4 sm:p-5 rounded-2xl group transition-all">
                                    <div class="flex items-center gap-3.5 min-w-0">
                                        <div class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-500/15 text-[#0050f0] dark:text-sky-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <i data-lucide="mail" class="w-5 h-5"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">E-mail Corporativo</div>
                                            <a href="mailto:geral@rachi.ao" class="text-sm font-bold text-slate-900 dark:text-white hover:text-[#00a3e0] dark:hover:text-[#00a3e0] transition truncate block">geral@rachi.ao</a>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Geral, propostas e orçamentos</div>
                                        </div>
                                    </div>
                                    <button @click="copyText('geral@rachi.ao', 'E-mail')" title="Copiar e-mail" class="p-2.5 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 transition cursor-pointer shrink-0 ml-2">
                                        <i data-lucide="copy" class="w-4 h-4"></i>
                                    </button>
                                </div>

                                <!-- Telefone & WhatsApp -->
                                <div class="contact-channel-card flex items-center justify-between p-4 sm:p-5 rounded-2xl group transition-all">
                                    <div class="flex items-center gap-3.5 min-w-0">
                                        <div class="w-11 h-11 rounded-xl bg-emerald-50 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <i data-lucide="phone-call" class="w-5 h-5"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Telefone &amp; WhatsApp</div>
                                            <a href="tel:+244923000000" class="text-sm font-bold text-slate-900 dark:text-white hover:text-emerald-500 transition truncate block">+244 923 000 000</a>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Atendimento telefónico e mensagens</div>
                                        </div>
                                    </div>
                                    <a href="https://wa.me/244923000000" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold text-xs transition-all shadow-sm cursor-pointer shrink-0 ml-2 hover:scale-105 flex items-center gap-1.5">
                                        <span>WhatsApp</span>
                                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>

                                <!-- Localização & Sede -->
                                <div class="contact-channel-card flex items-center justify-between p-4 sm:p-5 rounded-2xl group transition-all">
                                    <div class="flex items-center gap-3.5 min-w-0">
                                        <div class="w-11 h-11 rounded-xl bg-blue-50 dark:bg-blue-500/15 text-blue-600 dark:text-sky-400 flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform">
                                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">Sede Administrativa</div>
                                            <div class="text-sm font-bold text-slate-900 dark:text-white truncate">Luanda, Angola</div>
                                            <div class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Segunda a Sexta: 08h — 17h</div>
                                        </div>
                                    </div>
                                    <a href="https://maps.google.com/?q=Luanda,Angola" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 rounded-xl bg-slate-100 dark:bg-slate-800/80 hover:bg-[#0050f0]/10 dark:hover:bg-sky-500/20 text-xs font-bold text-[#0050f0] dark:text-sky-400 transition shrink-0 ml-2 flex items-center gap-1.5">
                                        <span>Maps</span>
                                        <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Coluna da Direita: Formulário Executivo de Alto Padrão & Dinâmico -->
                        <div class="lg:col-span-7 contact-form-card p-6 sm:p-8 rounded-3xl relative overflow-hidden flex flex-col justify-between h-full"
                             x-data="{ 
                                 isSubmitting: false, 
                                 formSent: false,
                                 charCount: 0,
                                 formData: {
                                     nome: '',
                                     email: '',
                                     telefone: '',
                                     unidade: 'Geral',
                                     mensagem: ''
                                 },
                                 getPlaceholder() {
                                     switch(this.formData.unidade) {
                                         case 'RACHI Tec': return 'Descreva a necessidade em infraestrutura de TI, redes estruturadas, suporte ou servidores...';
                                         case 'RACHI Print': return 'Indique os materiais gráficos, tiragens pretendidas, formatos ou brindes corporativos...';
                                         case 'RACHI Academy': return 'Qual o programa executivo ou necessidade de formação corporativa da sua equipa?';
                                         case 'RACHI Human Capital': return 'Descreva a necessidade em recrutamento especializado, consultoria de RH ou gestão...';
                                         case 'Loja': return 'Quais os equipamentos de informática ou produtos homologados que pretende orçamentar?';
                                         case 'Parcerias': return 'Apresente a sua proposta de parceria institucional ou representação comercial...';
                                         default: return 'Descreva sucintamente a sua necessidade corporativa ou pedido de cotação...';
                                     }
                                 },
                                 async handleFormSubmit() {
                                     this.isSubmitting = true;
                                     await new Promise(r => setTimeout(r, 600));
                                     this.isSubmitting = false;
                                     this.formSent = true;
                                     showToast('A sua mensagem foi registada com sucesso! A equipa entrará em contacto em breve.', 'Mensagem Enviada!', 'success', 4500);
                                     this.formData.nome = '';
                                     this.formData.email = '';
                                     this.formData.telefone = '';
                                     this.formData.unidade = 'Geral';
                                     this.formData.mensagem = '';
                                     this.charCount = 0;
                                     $nextTick(() => { if (window.lucide) lucide.createIcons(); });
                                 }
                             }">

                            <!-- Linha de Destaque Superior Corporativa RACHI -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#00a3e0] via-[#0050f0] to-[#f5a800]"></div>

                            <div>
                                <!-- Header do Formulário -->
                                <div class="mb-5 pb-3 border-b border-slate-100 dark:border-slate-800">
                                    <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-500/15 border border-emerald-200/80 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-300 text-[11px] font-bold uppercase tracking-wider mb-1.5">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Atendimento Centralizado
                                    </div>
                                    <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                                        Envie a sua Mensagem
                                    </h3>
                                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-0.5">
                                        Preencha os campos para direcionamento direto à nossa equipa.
                                    </p>
                                </div>

                                <!-- Banner de Confirmação de Envio -->
                                <div x-show="formSent" x-cloak x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 -translate-y-2 scale-98" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="mb-4 p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-700/60 text-emerald-900 dark:text-emerald-200 flex items-start gap-3 shadow-xs">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                                        <i data-lucide="check-circle-2" class="w-4.5 h-4.5"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-sm text-emerald-950 dark:text-emerald-100">Mensagem Enviada com Sucesso!</h4>
                                        <p class="text-xs text-emerald-800 dark:text-emerald-300 mt-0.5">Agradecemos o seu contacto. Um especialista da RACHI responderá com brevidade.</p>
                                    </div>
                                    <button type="button" @click="formSent = false" class="text-emerald-700 dark:text-emerald-400 hover:text-emerald-950 dark:hover:text-white p-1 cursor-pointer">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>

                                <!-- Campos do Formulário Executivo -->
                                <form @submit.prevent="handleFormSubmit()" class="space-y-3.5">
                                    <!-- Linha 1: Nome Completo & E-mail -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                                Nome Completo <span class="text-amber-500">*</span>
                                            </label>
                                            <div class="relative group">
                                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#00a3e0] transition-colors">
                                                    <i data-lucide="user" class="w-4 h-4"></i>
                                                </span>
                                                <input type="text" x-model="formData.nome" required placeholder="Seu nome" class="contact-input w-full pl-10 pr-3.5 py-2.5 rounded-xl text-xs sm:text-sm placeholder:text-slate-400">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                                E-mail <span class="text-amber-500">*</span>
                                            </label>
                                            <div class="relative group">
                                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#00a3e0] transition-colors">
                                                    <i data-lucide="mail" class="w-4 h-4"></i>
                                                </span>
                                                <input type="email" x-model="formData.email" required placeholder="seu.email@empresa.ao" class="contact-input w-full pl-10 pr-3.5 py-2.5 rounded-xl text-xs sm:text-sm placeholder:text-slate-400">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Linha 2: Telefone & Unidade -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                                Telefone / WhatsApp <span class="text-amber-500">*</span>
                                            </label>
                                            <div class="relative group">
                                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#00a3e0] transition-colors">
                                                    <i data-lucide="phone" class="w-4 h-4"></i>
                                                </span>
                                                <input type="tel" x-model="formData.telefone" required placeholder="+244 923 000 000" class="contact-input w-full pl-10 pr-3.5 py-2.5 rounded-xl text-xs sm:text-sm placeholder:text-slate-400">
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                                                Área ou Unidade de Interesse
                                            </label>
                                            <div class="relative group">
                                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-[#00a3e0] transition-colors">
                                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                                </span>
                                                <select x-model="formData.unidade" class="contact-input w-full pl-10 pr-9 py-2.5 rounded-xl text-xs sm:text-sm appearance-none cursor-pointer">
                                                    <option value="Geral">Orçamento Geral / Informações</option>
                                                    <option value="RACHI Tec">🌐 RACHI Tec — Tecnologia, Redes e TI</option>
                                                    <option value="RACHI Print">🖨️ RACHI Print — Produção Gráfica e Brindes</option>
                                                    <option value="RACHI Academy">🎓 RACHI Academy — Formação Executiva</option>
                                                    <option value="RACHI Human Capital">👥 RACHI Human Capital — RH &amp; Gestão</option>
                                                    <option value="Loja">🛍️ Loja de Equipamentos e Produtos</option>
                                                    <option value="Parcerias">🤝 Parcerias Estratégicas</option>
                                                </select>
                                                <span class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                                                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Linha 3: Mensagem Dinâmica -->
                                    <div>
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                                                Mensagem ou Pedido de Cotação <span class="text-amber-500">*</span>
                                            </label>
                                            <span class="text-[11px] text-slate-400 font-mono" x-text="charCount + ' car.'">0 car.</span>
                                        </div>
                                        <textarea rows="3" required x-model="formData.mensagem" @input="charCount = $el.value.length" :placeholder="getPlaceholder()" class="contact-input w-full p-3 rounded-xl text-xs sm:text-sm placeholder:text-slate-400 resize-none transition-all"></textarea>
                                    </div>

                                    <!-- Linha 4: Botão de Envio de Alto Padrão -->
                                    <div class="pt-1">
                                        <button type="submit" :disabled="isSubmitting"
                                                class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#0050f0] via-[#0077c2] to-[#00a3e0] hover:from-[#003ebf] hover:to-[#0089c2] text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider shadow-md hover:shadow-lg hover:shadow-blue-500/25 transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer border border-transparent disabled:opacity-70 disabled:cursor-not-allowed group">
                                            <template x-if="!isSubmitting">
                                                <span class="flex items-center gap-2">
                                                    <span>Enviar Mensagem Agora</span>
                                                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                                                </span>
                                            </template>
                                            <template x-if="isSubmitting">
                                                <span class="flex items-center gap-2">
                                                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    <span>A Enviar Mensagem...</span>
                                                </span>
                                            </template>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Rodapé de Confidencialidade -->
                            <div class="flex items-center justify-center gap-1.5 text-xs text-slate-400 pt-3 border-t border-slate-100 dark:border-slate-800/80 mt-3 text-center">
                                <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                <span>Os seus dados estão protegidos sob rigorosa política de confidencialidade corporativa.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SEÇÃO: FAQ - PERGUNTAS FREQUENTES -->
            <section class="py-16 bg-[#f8fafc] dark:bg-[#071326] border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-10">
                        <span class="text-xs font-bold uppercase tracking-widest text-[#0050f0] dark:text-sky-400 bg-blue-100/60 dark:bg-blue-500/15 px-3 py-1 rounded-full border border-blue-200 dark:border-blue-500/30">
                            Esclarecimento Rápido
                        </span>
                        <h3 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-3 uppercase tracking-tight font-heading">
                            Perguntas Frequentes
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2">Dúvidas comuns sobre propostas, prazos e atendimento da RACHI.</p>
                    </div>

                    <div class="space-y-3.5" x-data="{ activeFaq: 1 }">
                        <div class="contact-faq-card rounded-2xl overflow-hidden shadow-sm">
                            <button @click="activeFaq = (activeFaq === 1 ? null : 1)" class="w-full p-4.5 sm:p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex justify-between items-center hover:text-[#00a3e0] dark:hover:text-[#00a3e0] transition cursor-pointer">
                                <span>Qual é o tempo médio para recebimento de um orçamento formal?</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform shrink-0 ml-3" :class="activeFaq === 1 ? 'rotate-180 text-[#00a3e0]' : ''"></i>
                            </button>
                            <div x-show="activeFaq === 1" x-collapse class="px-4.5 sm:px-5 pb-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-3.5">
                                Para a maioria dos produtos da loja e serviços de consultoria padrão, o orçamento detalhado em PDF e com fatura pró-forma é emitido no mesmo dia útil (geralmente em menos de 2 a 4 horas). Projetos complexos de TI, infraestrutura de redes ou grandes tiragens gráficas levam até 24 a 48 horas úteis após o levantamento técnico dos requisitos.
                            </div>
                        </div>

                        <div class="contact-faq-card rounded-2xl overflow-hidden shadow-sm">
                            <button @click="activeFaq = (activeFaq === 2 ? null : 2)" class="w-full p-4.5 sm:p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex justify-between items-center hover:text-[#00a3e0] dark:hover:text-[#00a3e0] transition cursor-pointer">
                                <span>Como posso solicitar suporte presencial da equipa RACHI Tec na minha empresa?</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform shrink-0 ml-3" :class="activeFaq === 2 ? 'rotate-180 text-[#00a3e0]' : ''"></i>
                            </button>
                            <div x-show="activeFaq === 2" x-collapse class="px-4.5 sm:px-5 pb-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-3.5">
                                Pode solicitar através do formulário acima selecionando a unidade <strong>RACHI Tec</strong> ou diretamente pelo WhatsApp corporativo. Para clientes com Contrato de Suporte Contínuo (SLA), a intervenção técnica presencial ocorre em prazos prioritários acordados previamente.
                            </div>
                        </div>

                        <div class="contact-faq-card rounded-2xl overflow-hidden shadow-sm">
                            <button @click="activeFaq = (activeFaq === 3 ? null : 3)" class="w-full p-4.5 sm:p-5 text-left font-bold text-sm sm:text-base text-slate-900 dark:text-white flex justify-between items-center hover:text-[#00a3e0] dark:hover:text-[#00a3e0] transition cursor-pointer">
                                <span>A RACHI atende clientes e projetos fora da província de Luanda?</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform shrink-0 ml-3" :class="activeFaq === 3 ? 'rotate-180 text-[#00a3e0]' : ''"></i>
                            </button>
                            <div x-show="activeFaq === 3" x-collapse class="px-4.5 sm:px-5 pb-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-3.5">
                                Sim! Atendemos empresas e instituições em todo o território angolano (Benguela, Huíla, Cabinda, Huambo, etc.). Serviços de consultoria, formações da RACHI Academy e suporte em nuvem são realizados 100% online, enquanto entregas físicas de equipamentos e materiais gráficos são despachadas via operadores logísticos parceiros com rastreamento garantido.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- FOOTER EXACT TO RACHI -->
        <footer class="bg-[#071326] text-white pt-16 pb-8 border-t border-slate-800 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <div>
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-10 mb-4">
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Um ecossistema de soluções inteligentes para impulsionar negócios e pessoas em Angola e no mundo.
                        </p>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 mb-3">Áreas de Negócio</h4>
                        <ul class="space-y-2 text-xs text-slate-300">
                            <li><a href="/tec" class="hover:text-white">RACHI Tec</a></li>
                            <li><a href="/print" class="hover:text-white">RACHI Print</a></li>
                            <li><a href="/academy" class="hover:text-white">RACHI Academy</a></li>
                            <li><a href="/capital" class="hover:text-white">RACHI Human Capital</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold uppercase tracking-wider text-amber-400 mb-3">Sobre Nós</h4>
                        <ul class="space-y-2 text-xs text-slate-300">
                            <li><a href="/#sobre" class="hover:text-white">Quem somos</a></li>
                            <li><a href="/#o-que-fazemos" class="hover:text-white">O que fazemos</a></li>
                            <li><a href="/#parceiros" class="hover:text-white">Parceiros</a></li>
                            <li><a href="/#etica" class="hover:text-white">Ética e Compliance</a></li>
                            <li><a href="/contacto" class="text-amber-400 font-bold hover:text-white">Contacto</a></li>
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

    <!-- Script Implementation -->
    <script>
        function rachiApp() {
            return {
                currentView: 'public',
                currentTab: 'contacto',
                mobileMenuOpen: false,
                customerTab: 'dashboard',
                currentUser: null,
                contactSubject: 'Orçamento de Projeto',
                toast: {
                    show: false,
                    title: '',
                    message: '',
                    type: 'success',
                    timer: null
                },
                init() {
                    window.showToast = (msg, title, type, dur) => this.showToast(msg, title, type, dur);
                    this.restoreUserSession();
                    window.addEventListener('storage', (e) => {
                        if (e.key === 'rachi_user_session') {
                            this.restoreUserSession();
                        }
                    });
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },
                restoreUserSession() {
                    try {
                        const stored = localStorage.getItem('rachi_user_session');
                        if (stored) {
                            const data = JSON.parse(stored);
                            if (data.email && data.email.toLowerCase() === 'casimirogundja@outlook.com') {
                                data.has_matricula = true;
                            }
                            this.currentUser = data;
                        } else {
                            this.currentUser = null;
                        }
                    } catch (e) {
                        console.error('Erro ao restaurar sessão RACHI:', e);
                        this.currentUser = null;
                    }
                },
                logout() {
                    localStorage.removeItem('rachi_user_session');
                    this.currentUser = null;
                    this.showToast('Sessão terminada com sucesso em todo o ecossistema RACHI.', 'Sessão Encerrada', 'info', 3200);
                },
                copyText(text, label = 'Item') {
                    if (navigator.clipboard && navigator.clipboard.writeText) {
                        navigator.clipboard.writeText(text).then(() => {
                            this.showToast(`${label} copiado para a área de transferência: ${text}`, 'Copiado!', 'success', 2800);
                        }).catch(() => {
                            this.fallbackCopy(text, label);
                        });
                    } else {
                        this.fallbackCopy(text, label);
                    }
                },
                fallbackCopy(text, label) {
                    const el = document.createElement('textarea');
                    el.value = text;
                    document.body.appendChild(el);
                    el.select();
                    document.execCommand('copy');
                    document.body.removeChild(el);
                    this.showToast(`${label} copiado: ${text}`, 'Copiado!', 'success', 2800);
                },
                showToast(message, title = 'Notificação', type = 'success', duration = 3800) {
                    if (this.toast.timer) clearTimeout(this.toast.timer);
                    this.toast.title = title;
                    this.toast.message = message;
                    this.toast.type = type;
                    this.toast.show = true;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                    this.toast.timer = setTimeout(() => {
                        this.toast.show = false;
                    }, duration);
                },
                submitContactForm(e) {
                    const form = e.target;
                    this.showToast(
                        'A sua mensagem sobre "' + this.contactSubject + '" foi registada com sucesso! A equipa da RACHI entrará em contacto muito brevemente.',
                        'Mensagem Enviada!',
                        'success',
                        4500
                    );
                    form.reset();
                    this.contactSubject = 'Orçamento de Projeto';
                },
                goToHome() {
                    window.location.href = '/#home';
                },
                loginModal: false,
                cartDrawer: false,
                cart: [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + item.price, 0);
                },
                loginAs(role) {
                    window.location.href = '/';
                }
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    <!-- Toast Notification (Auto-Dismiss) - Royal Blue & White Palette -->
    <div x-show="toast.show" 
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="opacity-0 translate-y-2 scale-95" 
         x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
         x-transition:leave="transition ease-in duration-200 transform" 
         x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
         x-transition:leave-end="opacity-0 translate-y-2 scale-95" 
         x-cloak 
         class="fixed bottom-6 right-6 z-50 max-w-md w-full bg-[#071326]/95 backdrop-blur-xl border border-blue-500/30 shadow-2xl rounded-2xl p-4 text-white">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-[#00a3e0] flex items-center justify-center flex-shrink-0">
                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
            </div>
            <div class="flex-1 pr-2">
                <h4 class="text-sm font-bold text-white" x-text="toast.title"></h4>
                <p class="text-xs text-slate-300 mt-0.5 leading-relaxed" x-text="toast.message"></p>
            </div>
            <button @click="toast.show = false" class="text-slate-400 hover:text-white transition p-1">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="w-full bg-white/10 h-1 rounded-full mt-3 overflow-hidden">
            <div class="bg-gradient-to-r from-[#0050f0] to-[#00a3e0] h-full w-full animate-[shrink_3.5s_linear_forwards]"></div>
        </div>
    </div>
</body>
</html>
