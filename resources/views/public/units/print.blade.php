<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Print — Impressão Institucional, Brindes &amp; Produção Gráfica Corporativa</title>
    <meta name="description" content="RACHI Print — Impressão de documentos institucionais, materiais promocionais, produção gráfica corporativa e gráfica para eventos com acabamentos de alta qualidade em Angola.">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="/worker-marketing.css">
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
    <link rel="stylesheet" href="/css/site.css?v=1790340043">
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        section[id], div[id] { scroll-margin-top: 90px; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0b1a2e;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        html.dark body {
            background-color: #080c16 !important;
            color: #f1f5f9 !important;
        }

        /* Headings & Typography */
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
            color: #0b1a2e;
            transition: color 0.3s ease;
        }
        html.dark h1, 
        html.dark h2, 
        html.dark h3, 
        html.dark h4 {
            color: #ffffff !important;
        }

        .hero-title {
            color: #0b1a2e;
            transition: color 0.3s ease;
        }
        html.dark .hero-title {
            color: #ffffff !important;
        }

        .hero-subtitle {
            color: #475569;
            transition: color 0.3s ease;
        }
        html.dark .hero-subtitle {
            color: #cbd5e1 !important;
        }

        .section-tag {
            background-color: rgba(245, 168, 0, 0.1);
            border: 1px solid rgba(245, 168, 0, 0.25);
            color: #b45309;
        }
        html.dark .section-tag {
            background-color: rgba(245, 168, 0, 0.12);
            border-color: rgba(245, 168, 0, 0.3);
            color: #fcd34d !important;
        }

        .section-title {
            color: #0b1a2e;
            transition: color 0.3s ease;
        }
        html.dark .section-title {
            color: #ffffff !important;
        }

        .section-desc {
            color: #475569;
            transition: color 0.3s ease;
        }
        html.dark .section-desc {
            color: #94a3b8 !important;
        }

        .hero-trust-bar {
            border-top: 1px solid #e2e8f0;
            color: #334155;
            transition: border-color 0.3s ease, color 0.3s ease;
        }
        html.dark .hero-trust-bar {
            border-top-color: rgba(255, 255, 255, 0.1) !important;
            color: #cbd5e1 !important;
        }

        /* Gradient Text Helper */
        .text-gradient-amber {
            background: linear-gradient(135deg, #d97706 0%, #f5a800 50%, #b45309 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }
        html.dark .text-gradient-amber {
            background: linear-gradient(135deg, #f5a800 0%, #ffd580 50%, #f5a800 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        /* Ambient Glow Backgrounds */
        .ambient-bg {
            background: 
                radial-gradient(75% 95% at 82% -5%, rgba(245, 168, 0, 0.12), transparent 58%),
                radial-gradient(60% 80% at 12% 45%, rgba(0, 163, 224, 0.08), transparent 62%),
                radial-gradient(45% 60% at 70% 95%, rgba(245, 168, 0, 0.06), transparent 65%),
                #f8fafc;
            transition: background 0.3s ease;
        }

        html.dark .ambient-bg {
            background: 
                radial-gradient(75% 95% at 82% -5%, rgba(245, 168, 0, 0.16), transparent 58%),
                radial-gradient(60% 80% at 12% 45%, rgba(0, 163, 224, 0.12), transparent 62%),
                radial-gradient(45% 60% at 70% 95%, rgba(245, 168, 0, 0.08), transparent 65%),
                #080c16;
        }

        /* HEADER THEME SYSTEM (LIGHT & DARK MODES) */
        .site-header {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        backdrop-filter 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* 1. DARK MODE (html.dark) */
        html.dark .site-header {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.35) !important;
        }
        html.dark .site-header.header-scrolled {
            background: rgba(7, 19, 38, 0.98) !important;
            box-shadow: 0 6px 35px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark .site-header .brand-logo-box {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        html.dark .site-header .brand-logo-text {
            color: #ffffff !important;
        }
        html.dark .site-header .brand-subtitle {
            color: #94a3b8 !important;
        }
        html.dark .site-header .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        html.dark .site-header .main-nav-capsule .nav-link {
            position: relative; font-size: 0.88rem; font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            white-space: nowrap; text-decoration: none;
            transition: all 0.2s ease;
        }
        html.dark .site-header .main-nav-capsule .nav-link:hover {
            color: #ffffff !important; background: rgba(255, 255, 255, 0.08);
        }
        html.dark .site-header .main-nav-capsule .nav-link.active {
            color: #f5a800 !important;
            background: rgba(245, 168, 0, 0.2);
            border: 1px solid rgba(245, 168, 0, 0.4);
            box-shadow: 0 2px 8px rgba(245, 168, 0, 0.2);
            font-weight: 700;
        }
        html.dark .site-header .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
        }
        html.dark .site-header .mobile-menu-btn {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        /* 2. LIGHT MODE (html:not(.dark)) */
        html:not(.dark) .site-header {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06) !important;
        }
        html:not(.dark) .site-header.header-scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.1) !important;
        }
        html:not(.dark) .site-header .brand-logo-box {
            background: rgba(11, 26, 46, 0.04) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
        }
        html:not(.dark) .site-header .brand-logo-text {
            color: #071326 !important;
        }
        html:not(.dark) .site-header .brand-subtitle {
            color: #64748b !important;
        }
        html:not(.dark) .site-header .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link {
            font-size: 0.88rem; font-weight: 600;
            color: #0b1a2e !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            white-space: nowrap; text-decoration: none;
            transition: all 0.2s ease;
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link:hover {
            color: #d97706 !important; background: rgba(245, 168, 0, 0.08);
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link.active {
            color: #d97706 !important;
            background: rgba(245, 168, 0, 0.12);
            border: 1px solid rgba(245, 168, 0, 0.3);
            font-weight: 700;
        }
        html:not(.dark) .site-header .theme-toggle-btn {
            background: rgba(11, 26, 46, 0.04) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
            color: #0b1a2e !important;
        }
        html:not(.dark) .site-header .mobile-menu-btn {
            color: #0b1a2e !important;
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
        }

        /* Buttons */
        .btn-upload-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #f5a800 0%, #e08b00 100%);
            color: #071326 !important;
            border: none;
            padding: 15px 32px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(245, 168, 0, 0.4);
            text-decoration: none;
        }
        .btn-upload-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 168, 0, 0.55);
            color: #050d1a !important;
        }

        .btn-watch-examples {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #ffffff;
            color: #0f172a !important;
            border: 1px solid #cbd5e1;
            padding: 15px 28px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            text-decoration: none;
        }
        .btn-watch-examples:hover {
            background: #fffbeb;
            border-color: #f5a800;
            color: #d97706 !important;
            transform: translateY(-2px);
        }

        html.dark .btn-watch-examples {
            background: rgba(255, 255, 255, 0.04);
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: none;
        }
        html.dark .btn-watch-examples:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(245, 168, 0, 0.4);
            color: #f5a800 !important;
        }

        /* Feature Card */
        .feature-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            padding: 30px 24px;
            text-align: left;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            position: relative;
            overflow: hidden;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(245, 168, 0, 0.4);
            box-shadow: 0 20px 35px -5px rgba(245, 168, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        html.dark .feature-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.07);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
        }
        html.dark .feature-card:hover {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(245, 168, 0, 0.35);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5), 0 0 20px rgba(245, 168, 0, 0.1);
        }

        .feature-card-title {
            color: #0f172a;
            transition: color 0.25s ease;
        }
        html.dark .feature-card-title {
            color: #ffffff !important;
        }

        .feature-card-desc {
            color: #475569;
            transition: color 0.25s ease;
        }
        html.dark .feature-card-desc {
            color: #94a3b8 !important;
        }

        /* Showcase Product Card */
        .showcase-product-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }
        .showcase-product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.08);
        }
        html.dark .showcase-product-card {
            background-color: rgba(15, 22, 38, 0.95) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark .showcase-product-card:hover {
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.6) !important;
        }

        .showcase-border-blue:hover { border-color: rgba(2, 132, 199, 0.6) !important; }
        .showcase-border-amber:hover { border-color: rgba(245, 168, 0, 0.6) !important; }
        .showcase-border-emerald:hover { border-color: rgba(5, 150, 105, 0.6) !important; }
        .showcase-border-purple:hover { border-color: rgba(124, 58, 237, 0.6) !important; }

        .showcase-divider {
            border-top: 1px solid #e2e8f0;
        }
        html.dark .showcase-divider {
            border-top-color: rgba(255, 255, 255, 0.1) !important;
        }

        .showcase-title {
            color: #0f172a;
            transition: color 0.25s ease;
        }
        html.dark .showcase-title {
            color: #ffffff !important;
        }

        .showcase-desc {
            color: #475569;
            transition: color 0.25s ease;
        }
        html.dark .showcase-desc {
            color: #cbd5e1 !important;
        }

        .showcase-bullet {
            color: #334155;
            transition: color 0.25s ease;
        }
        html.dark .showcase-bullet {
            color: #e2e8f0 !important;
        }

        .showcase-app-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #64748b;
        }
        html.dark .showcase-app-box {
            background-color: rgba(255, 255, 255, 0.03) !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
            color: #94a3b8 !important;
        }

        .showcase-app-label {
            color: #1e293b;
        }
        html.dark .showcase-app-label {
            color: #cbd5e1 !important;
        }

        .showcase-btn {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #0f172a;
            transition: all 0.25s ease;
        }
        html.dark .showcase-btn {
            background-color: rgba(255, 255, 255, 0.06) !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .showcase-btn-blue:hover { background-color: #0284c7 !important; color: #ffffff !important; border-color: #0284c7 !important; }
        .showcase-btn-amber:hover { background-color: #f5a800 !important; color: #071326 !important; border-color: #f5a800 !important; }
        .showcase-btn-emerald:hover { background-color: #059669 !important; color: #ffffff !important; border-color: #059669 !important; }
        .showcase-btn-purple:hover { background-color: #7c3aed !important; color: #ffffff !important; border-color: #7c3aed !important; }

        /* Trust Strip */
        .trust-strip {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
            border-radius: 1.5rem;
            padding: 2.5rem;
        }
        html.dark .trust-strip {
            background: rgba(255, 255, 255, 0.02) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: none !important;
        }

        .trust-label {
            color: #64748b;
        }
        html.dark .trust-label {
            color: #94a3b8 !important;
        }

        /* CTA Studio Card */
        .cta-banner-card {
            background: linear-gradient(135deg, #0c182b 0%, #07101e 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.4) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4) !important;
            color: #ffffff !important;
            position: relative;
            border-radius: 1.5rem;
            padding: 3.5rem 2rem;
            overflow: hidden;
            text-align: center;
        }

        .cta-banner-card h2 {
            color: #ffffff !important;
        }

        .cta-banner-card p {
            color: #cbd5e1 !important;
        }

        .cta-banner-card .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.25) !important;
            padding: 15px 28px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            text-decoration: none;
        }
        .cta-banner-card .btn-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: rgba(245, 168, 0, 0.6) !important;
            color: #f5a800 !important;
            transform: translateY(-2px);
        }

        /* Footer */
        .site-footer {
            background-color: #f1f5f9;
            border-top: 1px solid #e2e8f0;
            padding: 3rem 0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .site-footer {
            background-color: #060911 !important;
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }

        .footer-brand-box {
            background-color: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
        }
        html.dark .footer-brand-box {
            background-color: rgba(255, 255, 255, 0.06);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .footer-copyright {
            color: #64748b;
        }
        html.dark .footer-copyright {
            color: #94a3b8 !important;
        }
        .footer-copyright strong {
            color: #0f172a;
        }
        html.dark .footer-copyright strong {
            color: #ffffff !important;
        }

        .footer-link {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .footer-link:hover {
            color: #0f172a;
        }
        html.dark .footer-link {
            color: #94a3b8 !important;
        }
        html.dark .footer-link:hover {
            color: #ffffff !important;
        }
    </style>
</head>
<body x-data="rachiPrintStudio()" class="ambient-bg antialiased">

    <!-- ============================================================ -->
    <!-- NAVIGATION (Standardized RACHI Capsule Header System)         -->
    <!-- ============================================================ -->
    <header class="site-header" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Print -->
            <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                <div class="brand-logo-box h-12 px-2.5 py-1 rounded-xl flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                    <picture class="flex items-center">
                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                        <img src="/images/areas/rachi-print.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                             alt="RACHI Print" 
                             class="h-10 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="brand-logo-text font-display font-black text-lg tracking-wider flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#d97706] dark:text-[#f5a800] text-xs font-bold px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20">PRINT</span>
                    </span>
                    <span class="brand-subtitle text-[10px] tracking-widest uppercase font-medium transition-colors">Gráfica &amp; Produção</span>
                </div>
            </a>

            <!-- Central Nav Links (Capsule System) -->
            <nav class="hidden lg:flex items-center main-nav-capsule">
                <a href="/" class="nav-link cursor-pointer">
                    <span>Home</span>
                </a>
                
                <!-- Solutions Dropdown -->
                <div class="relative" x-data="{ openSol: false }" @click.outside="openSol = false" @keydown.escape.window="openSol = false">
                    <button @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none active">
                        <span>Soluções</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="openSol ? 'rotate-180 text-amber-500' : ''">
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
                         x-cloak 
                         class="header-dropdown absolute top-full left-0 mt-3 w-80 bg-white/95 dark:bg-[#071326]/95 backdrop-blur-2xl border border-slate-200/90 dark:border-white/15 rounded-2xl shadow-2xl p-2.5 z-50 text-sm space-y-1.5 transition-colors">
                        <a href="/capital" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-emerald-500/15 text-slate-700 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-500 dark:text-emerald-400 flex items-center justify-center font-black text-xs">01</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Human Capital</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 dropdown-desc">Recrutamento &amp; RH</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>
                        <a href="/academy" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-indigo-500/15 text-slate-700 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-500 dark:text-indigo-400 flex items-center justify-center font-black text-xs">02</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Academy</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 dropdown-desc">Educação &amp; Treinamento</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>
                        <a href="/tec" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-sky-500/15 text-slate-700 dark:text-slate-300 hover:text-sky-600 dark:hover:text-sky-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-500 dark:text-sky-400 flex items-center justify-center font-black text-xs">03</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Tec</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 dropdown-desc">Sistemas &amp; TI</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>
                        <a href="/print" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-amber-500/15 text-amber-600 dark:text-amber-400 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-500 dark:text-amber-400 flex items-center justify-center font-black text-xs">04</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title text-amber-600 dark:text-amber-300">RACHI Print</div>
                                    <div class="text-[11px] text-amber-600/80 dark:text-amber-400/80 dropdown-desc">Gráfica &amp; Produção</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-100 transition"></i>
                        </a>
                    </div>
                </div>

                <a href="#produtos-graficos" class="nav-link"><span>Produtos</span></a>
                <a href="#como-funciona" class="nav-link"><span>Diferenciais</span></a>
                <a href="/loja" class="nav-link"><span>Loja</span></a>
                <a href="/contacto" class="nav-link"><span>Pedir Orçamento</span></a>
                <a href="/contacto" class="nav-link"><span>Contacto</span></a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                <!-- Botão Padronizado de Alternância de Tema (Dark / Light Mode) -->
                <button type="button"
                    onclick="window.toggleRachiTheme()"
                    class="theme-toggle-btn w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center transition-colors cursor-pointer"
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

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl transition-colors">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-cloak class="lg:hidden bg-white/98 dark:bg-[#080c16]/98 border-b border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-xl transition-colors">
            <a href="/" class="block py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-amber-600 dark:hover:text-white">Home</a>
            <div class="pt-2 border-t border-slate-200 dark:border-white/10 space-y-1">
                <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400 tracking-wider">Soluções</span>
                <a href="/capital" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">01 RACHI Human Capital</a>
                <a href="/academy" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">02 RACHI Academy</a>
                <a href="/tec" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">03 RACHI Tec</a>
                <a href="/print" class="block pl-3 text-xs text-amber-600 dark:text-amber-400 font-bold py-1">04 RACHI Print</a>
            </div>
            <div class="pt-2 border-t border-slate-200 dark:border-white/10 space-y-2">
                <a href="#produtos-graficos" @click="mobileMenuOpen = false" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Produtos Gráficos</a>
                <a href="#como-funciona" @click="mobileMenuOpen = false" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Diferenciais</a>
                <a href="/loja" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Loja</a>
                <a href="/contacto" class="block text-sm text-amber-600 dark:text-amber-400 font-bold py-1">Pedir Orçamento</a>
                <a href="/contacto" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Contacto</a>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- HERO SECTION                                                 -->
    <!-- ============================================================ -->
    <main class="pt-32 pb-20">
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8 sm:pt-14">
            <div class="space-y-8 max-w-4xl mx-auto">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full section-tag text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>Gráfica de Alto Padrão • Luanda &amp; Províncias</span>
                </div>

                <!-- Main Heading -->
                <h1 class="hero-title text-4xl sm:text-6xl lg:text-7xl font-black leading-tight tracking-tight">
                    Dê vida aos seus materiais com <br class="hidden sm:inline">
                    <span class="text-gradient-amber">acabamento institucional</span>
                </h1>

                <!-- Subtitle -->
                <p class="hero-subtitle text-base sm:text-xl leading-relaxed max-w-3xl mx-auto font-normal">
                    Produção gráfica corporativa, brindes promocionais e documentos institucionais de alta definição que destacam a sua empresa, impressionam clientes e garantem total conformidade de marca.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a href="/contacto" class="btn-upload-primary">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Solicitar Cotação</span>
                    </a>

                    <a href="#produtos-graficos" class="btn-watch-examples">
                        <i data-lucide="layers" class="w-5 h-5 text-amber-500"></i>
                        <span>Ver 4 Linhas de Produção</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="pt-8 hero-trust-bar max-w-2xl mx-auto flex flex-wrap items-center justify-center gap-8 sm:gap-12 text-xs sm:text-sm">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/10 text-emerald-500 flex items-center justify-center shrink-0">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Offset &amp; Digital</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">100% Controlo de Qualidade</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-sky-500/10 text-sky-500 flex items-center justify-center shrink-0">
                            <i data-lucide="truck" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Entrega Nacional</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- FEATURE HIGHLIGHTS                                           -->
        <!-- ============================================================ -->
        <section id="como-funciona" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest section-tag px-3 py-1 rounded-full">
                    Excelência em Cada Detalhe
                </span>
                <h2 class="section-title text-3xl sm:text-4xl font-black mt-4">
                    Por que as empresas líderes confiam na RACHI Print
                </h2>
                <p class="section-desc text-sm sm:text-base mt-3">
                    Combinamos capacidade industrial com acabamentos manuais nobres para posicionar a sua marca com máxima autoridade.
                </p>
            </div>

            <!-- 4 Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-500 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <h3 class="feature-card-title text-lg font-bold mb-2">Faça sua empresa parecer maior</h3>
                    <p class="feature-card-desc text-xs leading-relaxed">
                        Transforme apresentações e relatórios em publicações executivas que transmitem solidez, prestígio institucional e credibilidade.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/15 border border-blue-500/30 text-blue-500 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <h3 class="feature-card-title text-lg font-bold mb-2">Destaque-se da concorrência</h3>
                    <p class="feature-card-desc text-xs leading-relaxed">
                        Acabamentos com verniz UV localizado, laminação soft-touch, relevo seco e hot-stamping que colocam sua marca num patamar superior.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-500 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="calendar" class="w-6 h-6"></i>
                    </div>
                    <h3 class="feature-card-title text-lg font-bold mb-2">Perfeito para eventos &amp; campanhas</h3>
                    <p class="feature-card-desc text-xs leading-relaxed">
                        Produção ágil de credenciais, sinalética, backdrops e brindes temáticos prontos no prazo exato da sua activação ou feira.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-500 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="sliders" class="w-6 h-6"></i>
                    </div>
                    <h3 class="feature-card-title text-lg font-bold mb-2">Feito sob medida para seu orçamento</h3>
                    <p class="feature-card-desc text-xs leading-relaxed">
                        Flexibilidade de tiragens: desde pequenas tiragens digitais sob demanda até grandes tiragens offset para ampla distribuição.
                    </p>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- SHOWCASE SECTION: "Veja no que seus materiais gráficos      -->
        <!-- podem se transformar" (As 4 Linhas Oficiais de Produção)     -->
        <!-- ============================================================ -->
        <section id="produtos-graficos" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest section-tag px-3 py-1 rounded-full">
                    Catálogo de Soluções
                </span>
                <h2 class="section-title text-3xl sm:text-5xl font-black mt-4">
                    Veja no que seus materiais gráficos podem se transformar
                </h2>
                <p class="section-desc text-sm sm:text-base mt-3">
                    As quatro linhas oficiais de produção da RACHI Print, prontas para atender as exigências mais elevadas de empresas e instituições.
                </p>
            </div>

            <!-- 4 Detailed Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- PRODUTO 1: Impressão de documentos institucionais -->
                <div class="showcase-product-card showcase-border-blue group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-blue-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-500/15 border border-blue-500/30 text-blue-500 flex items-center justify-center">
                                <i data-lucide="file-text" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-blue-500/10 text-blue-500 border border-blue-500/20">
                                Documentos Oficiais
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold showcase-title group-hover:text-blue-500 transition">
                            Impressão de documentos institucionais
                        </h3>

                        <p class="showcase-desc text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Impressão de relatórios, brochuras, manuais, propostas e documentos oficiais com qualidade institucional.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 showcase-divider space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Impressão a cores e P&amp;B</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Acabamentos variados</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Tiragens flexíveis</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl showcase-app-box text-xs space-y-1">
                            <span class="font-bold showcase-app-label block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Relatórios de Gestão &amp; Contas, Manuais de Procedimentos, Propostas de Concurso Público, Livros Institucionais e Certificados Oficiais.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 showcase-divider">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl showcase-btn showcase-btn-blue font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
                            <span>Solicitar Cotação de Documentos</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 2: Materiais promocionais -->
                <div class="showcase-product-card showcase-border-amber group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-amber-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-500 flex items-center justify-center">
                                <i data-lucide="gift" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                Brindes &amp; Ativação
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold showcase-title group-hover:text-amber-500 transition">
                            Materiais promocionais
                        </h3>

                        <p class="showcase-desc text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Criação e produção de brindes e materiais promocionais para campanhas, activações e fidelização.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 showcase-divider space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Brindes personalizados</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Campanhas e activações</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Opções para diferentes orçamentos</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl showcase-app-box text-xs space-y-1">
                            <span class="font-bold showcase-app-label block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Agendas Executivas, Cadernos Corporativos, T-Shirts &amp; Polos bordados, Garrafas Térmicas, Canecas, Pen Drives, Mochilas e Kits Onboarding.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 showcase-divider">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl showcase-btn showcase-btn-amber font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
                            <span>Solicitar Cotação de Brindes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 3: Produção gráfica corporativa -->
                <div class="showcase-product-card showcase-border-emerald group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-emerald-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-500 flex items-center justify-center">
                                <i data-lucide="briefcase" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                Papelaria &amp; Identidade
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold showcase-title group-hover:text-emerald-500 transition">
                            Produção gráfica corporativa
                        </h3>

                        <p class="showcase-desc text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Produção de materiais gráficos alinhados à identidade visual da sua empresa ou instituição.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 showcase-divider space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Identidade visual consistente</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Acabamento profissional</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Prazos e qualidade controlados</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl showcase-app-box text-xs space-y-1">
                            <span class="font-bold showcase-app-label block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Cartões de Visita (soft touch, cantos redondos), Pastas com bolsa e orelha, Papel Timbrado, Envelopes Timbrados e Carimbos automáticos.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 showcase-divider">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl showcase-btn showcase-btn-emerald font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
                            <span>Solicitar Cotação Corporativa</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 4: Produção gráfica para eventos -->
                <div class="showcase-product-card showcase-border-purple group">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-purple-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-500 flex items-center justify-center">
                                <i data-lucide="calendar-range" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/20">
                                Grandes Formatos &amp; Feiras
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold showcase-title group-hover:text-purple-500 transition">
                            Produção gráfica para eventos
                        </h3>

                        <p class="showcase-desc text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Produção de banners, convites, credenciais, sinalética e materiais para eventos corporativos.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 showcase-divider space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Materiais para todos os formatos</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Entrega alinhada ao evento</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold showcase-bullet">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/15 text-emerald-500 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Impacto visual e legibilidade</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl showcase-app-box text-xs space-y-1">
                            <span class="font-bold showcase-app-label block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Roll-up Banners (85x200cm, 120x200cm), Backdrops de Palco, Credenciais em PVC com fita personalizada, Totens e Sinalética Direcional.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 showcase-divider">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl showcase-btn showcase-btn-purple font-bold text-xs tracking-wider uppercase flex items-center justify-center gap-2">
                            <span>Solicitar Cotação para Eventos</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- TRUST & TECHNICAL SPECS BAR                                  -->
        <!-- ============================================================ -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
            <div class="trust-strip">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-[#d97706] dark:text-[#f5a800]">+1.2M</div>
                        <div class="text-xs trust-label font-medium mt-1">Páginas &amp; Peças Entregues</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-emerald-500">100%</div>
                        <div class="text-xs trust-label font-medium mt-1">Fidelidade Cromática &amp; ISO</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-sky-500">48h</div>
                        <div class="text-xs trust-label font-medium mt-1">Opção Express em Luanda</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-purple-500">18</div>
                        <div class="text-xs trust-label font-medium mt-1">Províncias Atendidas</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- CALL TO ACTION BANNER (Studio CTA)                           -->
        <!-- ============================================================ -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28 mb-12">
            <div class="cta-banner-card">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/20 inline-block">
                        Atendimento Corporativo
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black">
                        Pronto para elevar a produção gráfica da sua instituição?
                    </h2>
                    <p class="text-sm sm:text-base leading-relaxed">
                        Fale diretamente com os nossos consultores gráficos e receba um orçamento personalizado com as melhores especificações para o seu projeto.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/contacto" class="btn-upload-primary">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                            <span>Falar Connosco / Pedir Proposta</span>
                        </a>
                        <a href="https://wa.me/244972888585?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20cota%C3%A7%C3%A3o%20para%20a%20RACHI%20Print." target="_blank" class="btn-cta-secondary">
                            <i data-lucide="message-circle" class="w-5 h-5 text-emerald-400"></i>
                            <span>WhatsApp Direto</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ============================================================ -->
    <!-- FOOTER                                                       -->
    <!-- ============================================================ -->
    <footer class="site-footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Brand & Copyright -->
                <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                    <div class="footer-brand-box h-10 px-2.5 py-1 rounded-xl flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                            <img src="/images/areas/rachi-print.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                                 alt="RACHI Print" 
                                 class="h-7 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(0,0,0,0.15)] dark:drop-shadow-[0_0_4px_rgba(255,255,255,0.35)]">
                        </picture>
                    </div>
                    <div class="text-xs footer-copyright">
                        &copy; 2026 <strong>RACHI Print</strong>. Todos os direitos reservados.
                    </div>
                </a>

                <!-- Footer Nav Links -->
                <div class="flex flex-wrap items-center justify-center gap-6 text-xs">
                    <a href="/" class="footer-link">Portal RACHI</a>
                    <a href="/capital" class="footer-link hover:text-emerald-500">Human Capital</a>
                    <a href="/academy" class="footer-link hover:text-indigo-500">Academy</a>
                    <a href="/tec" class="footer-link hover:text-sky-500">Tec</a>
                    <a href="/contacto" class="footer-link hover:text-[#f5a800]">Contacto</a>
                </div>

            </div>
        </div>
    </footer>

    <!-- Alpine.js Application Logic -->
    <script>
        function rachiPrintStudio() {
            return {
                mobileMenuOpen: false,

                init() {
                    const handleScroll = () => {
                        const nav = document.getElementById('navbar');
                        if (nav) {
                            if (window.scrollY > 30) {
                                nav.classList.add('header-scrolled');
                            } else {
                                nav.classList.remove('header-scrolled');
                            }
                        }
                    };
                    window.addEventListener('scroll', handleScroll, { passive: true });
                    handleScroll();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script></body>
</html>