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
            margin-left: auto !important;
            margin-right: auto !important;
            margin-top: 0 !important;
            text-align: center !important;
            max-width: 58rem !important;
            transition: color 0.3s ease;
        }
        html.dark .hero-title {
            color: #ffffff !important;
        }

        .hero-subtitle {
            color: #475569;
            margin-left: auto !important;
            margin-right: auto !important;
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            text-align: center !important;
            max-width: 44rem !important;
            display: block !important;
            font-size: clamp(1rem, 1.3vw, 1.15rem) !important;
            line-height: 1.65 !important;
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

        
        /* Dynamic Hero Components */
        .hero-quick-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.95rem;
            border-radius: 9999px;
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
            color: #1e293b;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }
        html.dark .hero-quick-pill {
            background: rgba(15, 22, 38, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            color: #e2e8f0;
        }
        .hero-quick-pill:hover {
            transform: translateY(-2px);
        }
        .hero-pill-blue:hover {
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
            color: #2563eb;
        }
        html.dark .hero-pill-blue:hover {
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.25);
            color: #60a5fa;
        }
        .hero-pill-amber:hover {
            border-color: rgba(245, 158, 11, 0.6);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.15);
            color: #d97706;
        }
        html.dark .hero-pill-amber:hover {
            border-color: rgba(245, 158, 11, 0.6);
            box-shadow: 0 8px 24px rgba(245, 158, 11, 0.25);
            color: #fbbf24;
        }
        .hero-pill-emerald:hover {
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
            color: #059669;
        }
        html.dark .hero-pill-emerald:hover {
            border-color: rgba(16, 185, 129, 0.6);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
            color: #34d399;
        }
        .hero-pill-purple:hover {
            border-color: rgba(168, 85, 247, 0.6);
            box-shadow: 0 8px 20px rgba(168, 85, 247, 0.15);
            color: #7c3aed;
        }
        html.dark .hero-pill-purple:hover {
            border-color: rgba(168, 85, 247, 0.6);
            box-shadow: 0 8px 24px rgba(168, 85, 247, 0.25);
            color: #c084fc;
        }

        .hero-feature-card {
            padding: 1.25rem 1.35rem;
            border-radius: 1.25rem;
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        html.dark .hero-feature-card {
            background: rgba(15, 22, 38, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        .hero-feature-card:hover {
            transform: translateY(-3px);
            border-color: rgba(245, 168, 0, 0.45);
            box-shadow: 0 12px 28px rgba(245, 168, 0, 0.12);
        }
        html.dark .hero-feature-card:hover {
            border-color: rgba(245, 168, 0, 0.45);
            box-shadow: 0 14px 32px rgba(0, 0, 0, 0.5), 0 0 20px rgba(245, 168, 0, 0.15);
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 1.75rem;
            border-radius: 9999px;
            background: linear-gradient(135deg, #f5a800 0%, #e08b00 100%);
            color: #071326 !important;
            font-weight: 800;
            font-size: 0.875rem;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(245, 168, 0, 0.35);
            transition: all 0.25s ease;
        }
        .btn-hero-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(245, 168, 0, 0.5);
            color: #000000 !important;
        }
        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.85rem 1.75rem;
            border-radius: 9999px;
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.12);
            color: #1e293b !important;
            font-weight: 700;
            font-size: 0.875rem;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            transition: all 0.25s ease;
        }
        html.dark .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #f1f5f9 !important;
        }
        .btn-hero-secondary:hover {
            transform: translateY(-2px);
            border-color: rgba(245, 168, 0, 0.4);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
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

        .dropdown-title {
            color: #0b1a2e;
            transition: color 0.2s ease;
        }
        html.dark .dropdown-title {
            color: #f8fafc !important;
        }
        .dropdown-desc {
            color: #64748b;
            transition: color 0.2s ease;
        }
        html.dark .dropdown-desc {
            color: #94a3b8 !important;
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

                
        /* CTA Amber Button */
        .btn-cta-amber {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%);
            color: #071326 !important;
            font-weight: 800;
            font-size: 0.85rem;
            padding: 0.75rem 1.6rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(245, 168, 0, 0.35);
        }
        .btn-cta-amber:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(245, 168, 0, 0.45);
            background: linear-gradient(135deg, #fbbf24 0%, #f5a800 100%);
            color: #000000 !important;
        }

        /* Showcase Product Card */
        .showcase-product-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.75rem;
            padding: 2.25rem 2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        }
        .showcase-product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.08);
        }
        html.dark .showcase-product-card {
            background: linear-gradient(180deg, #0d1527 0%, #080f1d 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 14px 34px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.05) !important;
        }
        html.dark .showcase-product-card:hover {
            transform: translateY(-5px);
        }

        .showcase-border-blue:hover { border-color: rgba(2, 132, 199, 0.6) !important; }
        .showcase-border-amber:hover { border-color: rgba(245, 168, 0, 0.6) !important; }
        .showcase-border-emerald:hover { border-color: rgba(5, 150, 105, 0.6) !important; }
        .showcase-border-purple:hover { border-color: rgba(124, 58, 237, 0.6) !important; }

        html.dark .showcase-border-blue:hover {
            border-color: rgba(56, 189, 248, 0.5) !important;
            box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.3), inset 0 1px 0 rgba(56, 189, 248, 0.25) !important;
        }
        html.dark .showcase-border-amber:hover {
            border-color: rgba(245, 168, 0, 0.5) !important;
            box-shadow: 0 20px 40px -10px rgba(245, 168, 0, 0.3), inset 0 1px 0 rgba(245, 168, 0, 0.25) !important;
        }
        html.dark .showcase-border-emerald:hover {
            border-color: rgba(52, 211, 153, 0.5) !important;
            box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.3), inset 0 1px 0 rgba(52, 211, 153, 0.25) !important;
        }
        html.dark .showcase-border-purple:hover {
            border-color: rgba(192, 132, 252, 0.5) !important;
            box-shadow: 0 20px 40px -10px rgba(168, 85, 247, 0.3), inset 0 1px 0 rgba(192, 132, 252, 0.25) !important;
        }

        /* Aplicações Comuns Box */
        .showcase-applications-box {
            margin-top: 1.5rem;
            padding: 1.15rem 1.25rem;
            border-radius: 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
        }
        html.dark .showcase-applications-box {
            background: rgba(15, 23, 42, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.05);
        }
        .showcase-applications-box .app-box-header {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #64748b;
            margin-bottom: 0.45rem;
        }
        html.dark .showcase-applications-box .app-box-header {
            color: #94a3b8 !important;
        }
        .showcase-applications-box .app-box-text {
            font-size: 0.8125rem;
            line-height: 1.6;
            color: #334155;
            margin: 0;
            font-weight: 400;
        }
        html.dark .showcase-applications-box .app-box-text {
            color: #e2e8f0 !important;
            font-weight: 500;
        }

        /* Botão de Ação "Saber mais" */
        .showcase-action-btn {
            width: 100%;
            padding: 0.95rem 1.25rem;
            border-radius: 0.875rem;
            background: #0f172a;
            color: #ffffff !important;
            font-weight: 800;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            border: 1px solid transparent;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            user-select: none;
        }
        html.dark .showcase-action-btn {
            background: rgba(30, 41, 59, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.14) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
        }
        .showcase-product-card:hover .showcase-action-btn i {
            transform: translateX(4px);
        }

        /* Hover Color Variations for Buttons */
        .showcase-border-blue:hover .showcase-action-btn {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
            border-color: #0284c7 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 24px rgba(2, 132, 199, 0.4) !important;
        }
        .showcase-border-amber:hover .showcase-action-btn {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%) !important;
            border-color: #f5a800 !important;
            color: #071326 !important;
            font-weight: 900 !important;
            box-shadow: 0 8px 24px rgba(245, 168, 0, 0.4) !important;
        }
        .showcase-border-emerald:hover .showcase-action-btn {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            border-color: #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 24px rgba(5, 150, 105, 0.4) !important;
        }
        .showcase-border-purple:hover .showcase-action-btn {
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%) !important;
            border-color: #7c3aed !important;
            color: #ffffff !important;
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.4) !important;
        }

        /* Bullet Points Text in Dark Mode */
        html.dark .showcase-product-card .text-slate-800 {
            color: #f1f5f9 !important;
        }
        html.dark .showcase-product-card .text-slate-600 {
            color: #94a3b8 !important;
        }

/* Line Cover & Product Grid Showcase */
        .line-cover-wrap {
            position: relative;
            border-radius: 1rem;
            overflow: hidden;
            aspect-ratio: 16 / 9;
            background: #0f172a;
            margin-bottom: 1.25rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
        }
        .line-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .line-cover-wrap:hover .line-cover-img {
            transform: scale(1.05);
        }
        .line-cover-badge {
            position: absolute;
            bottom: 0.75rem;
            left: 0.75rem;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(8px);
            color: #ffffff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.3rem 0.65rem;
            border-radius: 9999px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .line-products-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.25rem;
            margin-bottom: 0.75rem;
            padding-top: 1rem;
            border-top: 1px dashed #e2e8f0;
        }
        html.dark .line-products-section-header {
            border-top-color: rgba(255, 255, 255, 0.1);
        }
        .line-products-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }
        @media (min-width: 640px) {
            .line-products-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        .line-product-item {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 1.125rem;
            padding: 0.65rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
            text-align: left;
            user-select: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            position: relative;
            overflow: hidden;
        }
        .line-product-item:hover {
            transform: translateY(-4px);
            border-color: #f5a800;
            box-shadow: 0 16px 30px -10px rgba(245, 168, 0, 0.22), 0 4px 15px rgba(0, 0, 0, 0.06);
        }
        html.dark .line-product-item {
            background: rgba(15, 23, 42, 0.65) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
        }
        html.dark .line-product-item:hover {
            border-color: #f5a800 !important;
            box-shadow: 0 16px 35px -8px rgba(245, 168, 0, 0.35), 0 0 20px rgba(245, 168, 0, 0.15) !important;
        }
        .line-product-thumb-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 1;
            border-radius: 0.875rem;
            overflow: hidden;
            background: linear-gradient(145deg, #f8fafc 0%, #ffffff 40%, #edf2f7 100%);
            border: 1px solid rgba(226, 232, 240, 0.6);
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem;
        }
        html.dark .line-product-thumb-wrap {
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.06) 0%, rgba(255, 255, 255, 0.02) 100%) !important;
            border-color: rgba(255, 255, 255, 0.06) !important;
        }
        .line-product-thumb {
            width: 100%;
            height: 100%;
            max-width: 100%;
            max-height: 100%;
            object-fit: contain !important;
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), filter 0.35s ease;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.1));
        }
        .line-product-item:hover .line-product-thumb {
            transform: scale(1.1);
            filter: drop-shadow(0 12px 18px rgba(0, 0, 0, 0.18));
        }
        .line-product-zoom-hint {
            position: absolute;
            inset: 0;
            background: rgba(7, 19, 38, 0.25);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            opacity: 0;
            border-radius: 0.875rem;
            transition: opacity 0.25s ease;
            pointer-events: none;
        }
        .line-product-item:hover .line-product-zoom-hint {
            opacity: 1;
        }
        .line-product-title {
            font-size: 11.5px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }
        html.dark .line-product-title {
            color: #f1f5f9 !important;
        }
        .line-product-tag {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

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

        /* CTA Studio Card (Light Mode & Dark Mode) */
        .cta-banner-card {
            background: linear-gradient(135deg, #ffffff 0%, #fffdf9 40%, #f8fafc 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
            box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(245, 168, 0, 0.1) !important;
            color: #0b1a2e !important;
            position: relative;
            border-radius: 1.75rem;
            padding: 3.75rem 2rem;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease;
        }

        .cta-banner-card h2 {
            color: #0b1a2e !important;
        }

        .cta-banner-card p {
            color: #475569 !important;
        }

        .cta-banner-badge {
            background-color: rgba(245, 168, 0, 0.12);
            border: 1px solid rgba(245, 168, 0, 0.3);
            color: #b45309;
        }

        .cta-banner-card .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #ffffff !important;
            color: #0f172a !important;
            border: 1px solid #cbd5e1 !important;
            padding: 15px 30px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
            text-decoration: none;
        }
        .cta-banner-card .btn-cta-secondary:hover {
            background: #f8fafc !important;
            border-color: #10b981 !important;
            color: #059669 !important;
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.18);
            transform: translateY(-2px);
        }

        /* Dark Mode overrides for CTA Card */
        html.dark .cta-banner-card {
            background: linear-gradient(135deg, #0c182b 0%, #07101e 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.4) !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            color: #ffffff !important;
        }

        html.dark .cta-banner-card h2 {
            color: #ffffff !important;
        }

        html.dark .cta-banner-card p {
            color: #cbd5e1 !important;
        }

        html.dark .cta-banner-badge {
            background-color: rgba(245, 168, 0, 0.14);
            border-color: rgba(245, 168, 0, 0.35);
            color: #fcd34d !important;
        }

        html.dark .cta-banner-card .btn-cta-secondary {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            box-shadow: none !important;
        }

        html.dark .cta-banner-card .btn-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.16) !important;
            border-color: rgba(245, 168, 0, 0.6) !important;
            color: #f5a800 !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4) !important;
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

        /* ============================================================
           HERO BANNER RACHI PRINT (Arte Editorial Industrial CMYK)
           ============================================================ */
        .breadcrumb-nav-bar {
            background-color: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
        html.dark .breadcrumb-nav-bar {
            background-color: #040d1d !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }

        #print-hero-banner {
            position: relative;
            width: 100%;
            min-height: clamp(470px, 43vw, 600px);
            display: flex;
            align-items: center;
            overflow: hidden;
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            isolation: isolate;
            transition: background-color 0.35s ease, border-color 0.35s ease;
        }
        html.dark #print-hero-banner {
            background-color: #040d1d !important;
            border-bottom-color: rgba(255, 255, 255, 0.08) !important;
        }

        #print-hero-banner > picture {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            display: block;
        }

        #print-hero-banner .print-hero-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center right;
            z-index: 0;
            pointer-events: none;
            user-select: none;
            transition: filter 0.35s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-bg {
            filter: brightness(1.06) contrast(1.02) saturate(1.06);
        }
        html.dark #print-hero-banner .print-hero-bg {
            filter: none;
        }

        #print-hero-banner .print-hero-scrim {
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            transition: background 0.35s ease;
        }

        /* Light Mode Editorial Studio Scrim */
        html:not(.dark) #print-hero-banner .print-hero-scrim {
            background:
                linear-gradient(90deg,
                    rgba(255, 255, 255, 0.98) 0%,
                    rgba(250, 252, 255, 0.95) 33%,
                    rgba(248, 250, 252, 0.74) 51%,
                    rgba(248, 250, 252, 0.12) 75%,
                    rgba(255, 255, 255, 0) 100%),
                linear-gradient(0deg,
                    rgba(248, 250, 252, 0.52) 0%,
                    transparent 22%);
        }

        /* Dark Mode Editorial Midnight Scrim */
        html.dark #print-hero-banner .print-hero-scrim {
            background:
                linear-gradient(90deg,
                    rgba(4, 12, 26, 0.95) 0%,
                    rgba(5, 16, 35, 0.86) 28%,
                    rgba(6, 18, 38, 0.42) 52%,
                    rgba(6, 18, 38, 0.05) 76%,
                    transparent 100%),
                linear-gradient(0deg,
                    rgba(4, 12, 26, 0.42) 0%,
                    transparent 26%);
        }

        @media (max-width: 767px) {
            #print-hero-banner {
                min-height: 400px;
            }
            #print-hero-banner .print-hero-bg {
                object-position: 68% center;
            }
            #print-hero-banner .print-hero-inner {
                padding: 2rem 1.25rem !important;
            }
            #print-hero-banner .print-hero-heading {
                font-size: 1.5rem !important;
            }
            #print-hero-banner .print-hero-line-top {
                font-size: clamp(1.15rem, 4.5vw, 1.5rem) !important;
            }
            #print-hero-banner .print-hero-box-amber {
                font-size: clamp(1.45rem, 6vw, 2.2rem) !important;
            }
            #print-hero-banner .print-hero-line-bottom {
                font-size: clamp(1.45rem, 6vw, 2.2rem) !important;
            }
            #print-hero-banner .print-hero-desc {
                font-size: 0.825rem !important;
                line-height: 1.45 !important;
            }
            html:not(.dark) #print-hero-banner .print-hero-scrim {
                background:
                    linear-gradient(90deg,
                        rgba(255, 255, 255, 0.97) 0%,
                        rgba(248, 250, 252, 0.90) 58%,
                        rgba(248, 250, 252, 0.62) 100%),
                    linear-gradient(0deg,
                        rgba(248, 250, 252, 0.65) 0%,
                        transparent 35%);
            }
            html.dark #print-hero-banner .print-hero-scrim {
                background:
                    linear-gradient(90deg,
                        rgba(4, 12, 26, 0.95) 0%,
                        rgba(5, 16, 35, 0.88) 55%,
                        rgba(6, 18, 38, 0.55) 100%),
                    linear-gradient(0deg,
                        rgba(4, 12, 26, 0.55) 0%,
                        transparent 35%);
            }
        }

        #print-hero-banner .print-hero-inner {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 80rem;
            margin: 0 auto;
            padding: clamp(2.75rem, 5vw, 4.25rem) clamp(1.25rem, 4vw, 3rem);
        }

        #print-hero-banner .print-hero-editorial {
            max-width: 580px;
            margin-left: clamp(0rem, 3.5vw, 3rem);
        }

        #print-hero-banner .print-hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 0.85rem;
        }

        #print-hero-banner .print-hero-topline {
            width: 42px;
            height: 2.5px;
            border-radius: 9999px;
            flex-shrink: 0;
            transition: background-color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-topline {
            background-color: #d97706;
        }
        html.dark #print-hero-banner .print-hero-topline {
            background-color: #ffffff;
        }

        #print-hero-banner .print-hero-eyebrow-text {
            font-family: 'Inter', sans-serif;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            transition: color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-eyebrow-text {
            color: #b45309 !important;
        }
        html.dark #print-hero-banner .print-hero-eyebrow-text {
            color: #fcd34d !important;
        }

        #print-hero-banner .print-hero-heading {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            font-family: 'Outfit', 'Inter', sans-serif;
            text-align: left !important;
        }
        html:not(.dark) #print-hero-banner .print-hero-heading {
            color: #0b1a2e !important;
        }
        html.dark #print-hero-banner .print-hero-heading {
            color: #ffffff !important;
        }

        #print-hero-banner .print-hero-line-top {
            font-weight: 500;
            font-size: clamp(1.55rem, 2.45vw, 2.3rem);
            line-height: 1.18;
            letter-spacing: 0.005em;
            transition: color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-line-top {
            color: #0b1a2e !important;
        }
        html.dark #print-hero-banner .print-hero-line-top {
            color: #ffffff !important;
            font-weight: 400;
        }

        #print-hero-banner .print-hero-box-amber {
            display: inline-block;
            padding: 0.06em 0.36em 0.13em 0.36em;
            margin: 0.28rem 0 0.36rem 0;
            font-weight: 800;
            font-size: clamp(2.2rem, 3.65vw, 3.45rem);
            line-height: 1.06;
            letter-spacing: 0.01em;
            border-radius: 0.2rem;
            transition: all 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-box-amber {
            border: 2.5px solid #d97706;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.14) 0%, rgba(251, 191, 36, 0.05) 100%);
            color: #d97706 !important;
            box-shadow: 0 10px 24px -8px rgba(217, 119, 6, 0.22);
        }
        html.dark #print-hero-banner .print-hero-box-amber {
            border: 2.5px solid #e59819;
            background: rgba(5, 15, 32, 0.36);
            color: #f59e0b !important;
            box-shadow: 0 10px 28px -8px rgba(0, 0, 0, 0.45);
        }

        #print-hero-banner .print-hero-line-bottom {
            font-weight: 500;
            font-size: clamp(1.85rem, 2.95vw, 2.8rem);
            line-height: 1.15;
            letter-spacing: 0.005em;
            transition: color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-line-bottom {
            color: #0b1a2e !important;
        }
        html.dark #print-hero-banner .print-hero-line-bottom {
            color: #ffffff !important;
            font-weight: 400;
        }

        #print-hero-banner .print-hero-desc {
            margin: 0.75rem 0 0 0;
            max-width: 500px;
            font-family: 'Inter', sans-serif;
            font-size: clamp(0.86rem, 0.98vw, 0.96rem);
            line-height: 1.62;
            text-align: left !important;
            transition: color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-desc {
            font-weight: 450;
            color: #334155 !important;
        }
        html.dark #print-hero-banner .print-hero-desc {
            font-weight: 300;
            color: rgba(241, 245, 249, 0.93) !important;
        }

        #print-hero-banner .print-hero-brand {
            margin-top: 1.75rem;
            padding-left: clamp(0rem, 5vw, 4.75rem);
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 0.45rem;
        }

        #print-hero-banner .print-hero-brand-icon {
            height: clamp(54px, 4.6vw, 68px);
            width: auto;
            object-fit: contain;
            transition: filter 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-brand-icon {
            filter: drop-shadow(0 8px 16px rgba(15, 23, 42, 0.16));
        }
        html.dark #print-hero-banner .print-hero-brand-icon {
            filter: drop-shadow(0 8px 18px rgba(0, 0, 0, 0.45));
        }

        #print-hero-banner .print-hero-brand-name {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-weight: 800;
            font-size: clamp(1.25rem, 1.75vw, 1.55rem);
            line-height: 1.1;
            letter-spacing: 0.01em;
            transition: color 0.3s ease;
        }
        html:not(.dark) #print-hero-banner .print-hero-brand-name {
            color: #0b1a2e !important;
        }
        html.dark #print-hero-banner .print-hero-brand-name {
            color: #ffffff !important;
        }

        .print-pillars-strip {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .print-pillars-strip {
            background-color: #071326 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        .print-pillar-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.05);
            transition: all 0.25s ease;
        }
        .print-pillar-card:hover {
            background-color: #ffffff;
            border-color: rgba(217, 119, 6, 0.38);
            box-shadow: 0 12px 24px -6px rgba(15, 23, 42, 0.09);
            transform: translateY(-2px);
        }
        html.dark .print-pillar-card {
            background-color: rgba(15, 23, 42, 0.72) !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.28) !important;
        }
        html.dark .print-pillar-card:hover {
            background-color: rgba(15, 23, 42, 0.94) !important;
            border-color: rgba(245, 168, 0, 0.38) !important;
        }
        html:not(.dark) .print-pillar-title { color: #0f172a !important; }
        html.dark .print-pillar-title { color: #ffffff !important; }
        html:not(.dark) .print-pillar-desc { color: #475569 !important; }
        html.dark .print-pillar-desc { color: #94a3b8 !important; }

        /* ============================================================
           NOSSOS SERVIÇOS, PORTFÓLIO & CTA (Design Editorial RACHI Print)
           ============================================================ */
        .rprint-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.42rem 1.15rem;
            border-radius: 9999px;
            background-color: #f6eefb;
            color: #d91b7a;
            font-family: 'Inter', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.01em;
            border: 1px solid rgba(217, 27, 122, 0.08);
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .rprint-pill {
            background-color: rgba(217, 27, 122, 0.16) !important;
            border-color: rgba(244, 114, 182, 0.28) !important;
            color: #f472b6 !important;
        }

        .rprint-gradient-text {
            background: linear-gradient(90deg, #d91b7a 0%, #ef5b5b 52%, #f5a623 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        html.dark .rprint-gradient-text {
            background: linear-gradient(90deg, #f43f8e 0%, #fb7185 50%, #fbbf24 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }

        .rprint-sec-header {
            text-align: center;
            max-width: 50rem;
            margin: 0 auto 3.5rem auto;
        }

        .rprint-sec-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-weight: 800;
            font-size: clamp(2rem, 3.6vw, 3.1rem);
            line-height: 1.16;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin: 1.1rem 0 0 0;
        }
        html.dark .rprint-sec-title {
            color: #ffffff !important;
        }

        .rprint-sec-sub {
            font-family: 'Inter', sans-serif;
            font-size: clamp(0.92rem, 1.05vw, 1.02rem);
            line-height: 1.65;
            color: #64748b;
            max-width: 39rem;
            margin: 0.95rem auto 0 auto;
        }
        html.dark .rprint-sec-sub {
            color: #94a3b8 !important;
        }

        /* Services Grid (3x2) */
        .rprint-services-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.75rem;
        }
        @media (min-width: 640px) {
            .rprint-services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .rprint-services-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .rprint-service-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.15rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 6px 20px -4px rgba(15, 23, 42, 0.05);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.3s ease,
                        border-color 0.3s ease,
                        background-color 0.3s ease;
        }
        .rprint-service-card:hover {
            transform: translateY(-6px);
            background-color: #ffffff;
            border-color: rgba(217, 27, 122, 0.32);
            box-shadow: 0 18px 36px -10px rgba(15, 23, 42, 0.10);
        }
        html.dark .rprint-service-card {
            background-color: #0d1729 !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.28);
        }
        html.dark .rprint-service-card:hover {
            background-color: #111e35 !important;
            border-color: rgba(244, 63, 142, 0.42) !important;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.55);
        }

        .rprint-service-media {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            background-color: #e2e8f0;
        }
        html.dark .rprint-service-media {
            background-color: #08101e;
        }

        .rprint-service-media picture {
            display: contents;
        }

        .rprint-service-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rprint-service-card:hover .rprint-service-media img {
            transform: scale(1.05);
        }

        .rprint-service-body {
            padding: 1.65rem 1.75rem 1.85rem 1.75rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .rprint-service-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 0.85rem;
            background-color: #f6eaf8;
            color: #d91b7a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            transition: transform 0.25s ease, background-color 0.25s ease;
        }
        .rprint-service-card:hover .rprint-service-icon {
            transform: scale(1.06);
            background-color: #f2def6;
        }
        html.dark .rprint-service-icon {
            background-color: rgba(217, 27, 122, 0.16) !important;
            color: #f472b6 !important;
            border: 1px solid rgba(244, 114, 182, 0.22);
        }

        .rprint-service-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            line-height: 1.32;
            color: #0f172a;
            margin: 0 0 0.65rem 0;
            transition: color 0.2s ease;
        }
        .rprint-service-card:hover .rprint-service-title {
            color: #d91b7a;
        }
        html.dark .rprint-service-title {
            color: #ffffff !important;
        }
        html.dark .rprint-service-card:hover .rprint-service-title {
            color: #f472b6 !important;
        }

        .rprint-service-desc {
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            line-height: 1.62;
            color: #64748b;
            margin: 0;
        }
        html.dark .rprint-service-desc {
            color: #94a3b8 !important;
        }

        .rprint-service-badge {
            position: absolute;
            top: 0.85rem;
            left: 0.85rem;
            z-index: 2;
            padding: 0.28rem 0.72rem;
            border-radius: 9999px;
            font-family: 'Inter', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            background: rgba(15, 23, 42, 0.78);
            color: #ffffff;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.16);
        }

        .rprint-service-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 1rem;
        }

        .rprint-service-chip {
            font-family: 'Inter', sans-serif;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.24rem 0.6rem;
            border-radius: 0.45rem;
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
        }
        html.dark .rprint-service-chip {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #cbd5e1 !important;
            border-color: rgba(255, 255, 255, 0.10) !important;
        }

        .rprint-service-more {
            margin-top: auto;
            padding-top: 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            color: #d91b7a;
            transition: gap 0.2s ease, color 0.2s ease;
        }
        .rprint-service-card:hover .rprint-service-more {
            gap: 0.62rem;
        }
        html.dark .rprint-service-more {
            color: #f472b6 !important;
        }

        /* Branding & Visual Identity Dedicated Section */
        .rprint-branding-section {
            padding: 5.25rem 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            border-top: 1px solid rgba(226, 232, 240, 0.85);
            transition: background 0.3s ease, border-color 0.3s ease;
        }
        html.dark .rprint-branding-section {
            background: linear-gradient(180deg, #091222 0%, #070e1b 100%) !important;
            border-top-color: rgba(255, 255, 255, 0.07) !important;
        }

        .rprint-branding-hero-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            align-items: center;
        }
        @media (min-width: 1024px) {
            .rprint-branding-hero-grid {
                grid-template-columns: 1.05fr 1fr;
                gap: 3.25rem;
            }
        }

        .rprint-branding-visual {
            position: relative;
            border-radius: 1.35rem;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background-color: #0b1424;
            box-shadow: 0 22px 45px -16px rgba(15, 23, 42, 0.18);
            cursor: pointer;
        }
        html.dark .rprint-branding-visual {
            border-color: rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 24px 50px -14px rgba(0, 0, 0, 0.65);
        }
        .rprint-branding-visual img {
            width: 100%;
            height: auto;
            aspect-ratio: 16 / 10;
            object-fit: cover;
            display: block;
            transition: transform 0.55s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rprint-branding-visual:hover img {
            transform: scale(1.04);
        }

        .rprint-branding-visual-bar {
            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: 1rem;
            padding: 0.85rem 1.1rem;
            border-radius: 0.95rem;
            background: rgba(7, 15, 30, 0.84);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            color: #ffffff;
        }

        .rprint-deliverables-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.95rem;
            margin-top: 1.65rem;
        }
        @media (min-width: 640px) {
            .rprint-deliverables-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .rprint-deliverable-card {
            padding: 1.1rem 1.15rem;
            border-radius: 1rem;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            transition: transform 0.22s ease, border-color 0.22s ease;
        }
        .rprint-deliverable-card:hover {
            transform: translateY(-2px);
            border-color: rgba(217, 27, 122, 0.32);
        }
        html.dark .rprint-deliverable-card {
            background-color: #0e192d !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
        }
        html.dark .rprint-deliverable-card:hover {
            border-color: rgba(244, 114, 182, 0.38) !important;
        }

        .rprint-deliverable-num {
            display: inline-block;
            font-family: 'Outfit', sans-serif;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            color: #d91b7a;
            background-color: #f8ecf9;
            padding: 0.18rem 0.55rem;
            border-radius: 9999px;
            margin-bottom: 0.5rem;
        }
        html.dark .rprint-deliverable-num {
            background-color: rgba(217, 27, 122, 0.18) !important;
            color: #f472b6 !important;
        }

        .rprint-deliverable-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-size: 0.98rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 0.32rem 0;
        }
        html.dark .rprint-deliverable-title {
            color: #ffffff !important;
        }

        .rprint-deliverable-desc {
            font-family: 'Inter', sans-serif;
            font-size: 0.81rem;
            line-height: 1.55;
            color: #64748b;
            margin: 0;
        }
        html.dark .rprint-deliverable-desc {
            color: #94a3b8 !important;
        }

        /* Brand Ecosystem Applications Showcase Grid */
        .rprint-brand-apps-wrap {
            margin-top: 4rem;
            padding-top: 3.25rem;
            border-top: 1px solid #e2e8f0;
        }
        html.dark .rprint-brand-apps-wrap {
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }

        .rprint-brand-apps-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        @media (min-width: 640px) {
            .rprint-brand-apps-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .rprint-brand-apps-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .rprint-brand-app-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.15rem;
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.04);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.3s ease,
                        border-color 0.3s ease;
        }
        .rprint-brand-app-card:hover {
            transform: translateY(-5px);
            border-color: rgba(245, 158, 11, 0.45);
            box-shadow: 0 18px 34px -10px rgba(15, 23, 42, 0.14);
        }
        html.dark .rprint-brand-app-card {
            background-color: #0d1729 !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.35);
        }
        html.dark .rprint-brand-app-card:hover {
            border-color: rgba(251, 191, 36, 0.45) !important;
            box-shadow: 0 20px 38px -10px rgba(0, 0, 0, 0.6);
        }

        .rprint-brand-app-media {
            position: relative;
            aspect-ratio: 4 / 3;
            background-color: #08101e;
            overflow: hidden;
        }
        .rprint-brand-app-media picture {
            display: contents;
        }
        .rprint-brand-app-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rprint-brand-app-card:hover .rprint-brand-app-media img {
            transform: scale(1.05);
        }

        .rprint-brand-app-body {
            padding: 1.2rem 1.35rem 1.35rem 1.35rem;
        }
        .rprint-brand-app-kicker {
            font-family: 'Inter', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            color: #d97706;
            margin-bottom: 0.3rem;
            display: block;
        }
        html.dark .rprint-brand-app-kicker {
            color: #fbbf24 !important;
        }
        .rprint-brand-app-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 0.35rem 0;
        }
        html.dark .rprint-brand-app-title {
            color: #ffffff !important;
        }
        .rprint-brand-app-desc {
            font-family: 'Inter', sans-serif;
            font-size: 0.82rem;
            line-height: 1.55;
            color: #64748b;
            margin: 0;
        }
        html.dark .rprint-brand-app-desc {
            color: #94a3b8 !important;
        }

        /* Finishes & Technologies Strip */
        .rprint-finishes-box {
            margin-top: 2.75rem;
            padding: 1.65rem 1.85rem;
            border-radius: 1.2rem;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        }
        html.dark .rprint-finishes-box {
            background-color: #0c1628 !important;
            border-color: rgba(255, 255, 255, 0.09) !important;
        }
        .rprint-finishes-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            margin-top: 1rem;
        }
        .rprint-finish-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.48rem 0.9rem;
            border-radius: 9999px;
            font-family: 'Inter', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            background-color: #f8fafc;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        html.dark .rprint-finish-pill {
            background-color: rgba(255, 255, 255, 0.05) !important;
            color: #e2e8f0 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
        }

        /* Portfolio Section & Grid */
        .rprint-portfolio-section {
            padding: 5.25rem 0;
            background-color: #f9fafc;
            border-top: 1px solid rgba(226, 232, 240, 0.75);
            border-bottom: 1px solid rgba(226, 232, 240, 0.75);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .rprint-portfolio-section {
            background-color: #060d19 !important;
            border-top-color: rgba(255, 255, 255, 0.06) !important;
            border-bottom-color: rgba(255, 255, 255, 0.06) !important;
        }

        .rprint-portfolio-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.6rem;
        }
        @media (min-width: 640px) {
            .rprint-portfolio-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        @media (min-width: 1024px) {
            .rprint-portfolio-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .rprint-portfolio-item {
            position: relative;
            border-radius: 1.1rem;
            overflow: hidden;
            aspect-ratio: 4 / 3;
            background-color: #0b1424;
            border: 1px solid rgba(15, 23, 42, 0.08);
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
            transition: transform 0.32s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.32s ease,
                        border-color 0.32s ease;
        }
        .rprint-portfolio-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 38px -12px rgba(15, 23, 42, 0.24);
            border-color: rgba(217, 27, 122, 0.35);
        }
        html.dark .rprint-portfolio-item {
            border-color: rgba(255, 255, 255, 0.10) !important;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.35);
        }
        html.dark .rprint-portfolio-item:hover {
            border-color: rgba(244, 63, 142, 0.45) !important;
            box-shadow: 0 22px 44px -10px rgba(0, 0, 0, 0.6);
        }

        .rprint-portfolio-item picture {
            display: contents;
        }

        .rprint-portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.55s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .rprint-portfolio-item:hover img {
            transform: scale(1.05);
        }

        .rprint-portfolio-caption {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(6, 13, 25, 0) 42%, rgba(6, 13, 25, 0.90) 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 1.25rem 1.35rem;
            opacity: 0;
            transform: translateY(6px);
            transition: opacity 0.28s ease, transform 0.28s ease;
        }
        .rprint-portfolio-item:hover .rprint-portfolio-caption,
        .rprint-portfolio-item:focus-visible .rprint-portfolio-caption {
            opacity: 1;
            transform: translateY(0);
        }
        @media (hover: none) {
            .rprint-portfolio-caption {
                opacity: 1;
                transform: none;
            }
        }

        .rprint-portfolio-tag {
            font-family: 'Inter', sans-serif;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #fbbf24;
            margin-bottom: 0.22rem;
        }

        .rprint-portfolio-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-weight: 700;
            font-size: 1.05rem;
            line-height: 1.25;
            color: #ffffff !important;
            margin: 0;
        }

        /* CTA Card Section */
        .rprint-cta-card {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            padding: clamp(3rem, 5.5vw, 4.5rem) clamp(1.5rem, 4vw, 3.5rem);
            text-align: center;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.04);
            isolation: isolate;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .rprint-cta-card {
            background-color: #0c1628 !important;
            border-color: rgba(255, 255, 255, 0.10) !important;
            box-shadow: 0 18px 45px rgba(0, 0, 0, 0.42);
        }

        .rprint-cta-glow {
            position: absolute;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background: radial-gradient(ellipse 46% 58% at 50% 0%,
                rgba(217, 27, 122, 0.09) 0%,
                rgba(245, 166, 35, 0.05) 52%,
                transparent 78%);
        }
        html.dark .rprint-cta-glow {
            background: radial-gradient(ellipse 48% 60% at 50% 0%,
                rgba(236, 72, 153, 0.18) 0%,
                rgba(245, 158, 11, 0.08) 56%,
                transparent 82%);
        }

        .rprint-cta-inner {
            position: relative;
            z-index: 1;
            max-width: 44rem;
            margin: 0 auto;
        }

        .rprint-cta-title {
            font-family: 'Outfit', 'Inter', sans-serif;
            font-weight: 800;
            font-size: clamp(1.85rem, 3.2vw, 2.75rem);
            line-height: 1.22;
            letter-spacing: -0.02em;
            color: #0f172a;
            margin: 0;
        }
        html.dark .rprint-cta-title {
            color: #ffffff !important;
        }

        .rprint-cta-sub {
            font-family: 'Inter', sans-serif;
            font-size: clamp(0.92rem, 1.05vw, 1rem);
            line-height: 1.65;
            color: #64748b;
            max-width: 34rem;
            margin: 1.1rem auto 0 auto;
        }
        html.dark .rprint-cta-sub {
            color: #94a3b8 !important;
        }

        .rprint-cta-actions {
            margin-top: 2.2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .rprint-btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            padding: 0.9rem 1.85rem;
            border-radius: 9999px;
            border: none;
            background: linear-gradient(90deg, #e11d74 0%, #f05a4f 52%, #f59e0b 100%);
            color: #ffffff !important;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 12px 26px -6px rgba(225, 29, 116, 0.45);
            transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
        }
        .rprint-btn-gradient:hover {
            transform: translateY(-2px);
            filter: brightness(1.04);
            box-shadow: 0 16px 32px -6px rgba(225, 29, 116, 0.55);
        }

        .rprint-btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.55rem;
            padding: 0.9rem 1.85rem;
            border-radius: 9999px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            color: #0f172a !important;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.03);
            transition: transform 0.22s ease, border-color 0.22s ease, background-color 0.22s ease;
        }
        .rprint-btn-outline:hover {
            transform: translateY(-2px);
            border-color: #cbd5e1;
            background-color: #f8fafc;
        }
        html.dark .rprint-btn-outline {
            background-color: rgba(255, 255, 255, 0.04) !important;
            border-color: rgba(255, 255, 255, 0.16) !important;
            color: #ffffff !important;
        }
        html.dark .rprint-btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.09) !important;
            border-color: rgba(255, 255, 255, 0.28) !important;
        }

        /* Header Quick Theme Button & Dropdown Dual-Theme Integrity */
        .header-theme-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.35rem;
            height: 2.35rem;
            border-radius: 9999px;
            cursor: pointer;
            transition: all 0.22s ease;
        }
        html:not(.dark) .header-theme-pill {
            background: rgba(15, 23, 42, 0.04) !important;
            border: 1px solid rgba(15, 23, 42, 0.10) !important;
            color: #0f172a !important;
        }
        html:not(.dark) .header-theme-pill:hover {
            background: rgba(245, 158, 11, 0.12) !important;
            border-color: rgba(217, 119, 6, 0.35) !important;
            color: #b45309 !important;
        }
        html.dark .header-theme-pill {
            background: rgba(255, 255, 255, 0.07) !important;
            border: 1px solid rgba(251, 191, 36, 0.32) !important;
            color: #fbbf24 !important;
        }
        html.dark .header-theme-pill:hover {
            background: rgba(251, 191, 36, 0.16) !important;
            border-color: #fbbf24 !important;
            color: #fef08a !important;
        }
        html:not(.dark) .header-theme-pill .icon-for-light { display: block !important; }
        html:not(.dark) .header-theme-pill .icon-for-dark { display: none !important; }
        html.dark .header-theme-pill .icon-for-light { display: none !important; }
        html.dark .header-theme-pill .icon-for-dark { display: block !important; }

        html:not(.dark) .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.14) !important;
        }
        html.dark .header-dropdown {
            background: rgba(7, 19, 38, 0.97) !important;
            border-color: rgba(255, 255, 255, 0.14) !important;
            box-shadow: 0 24px 48px -10px rgba(0, 0, 0, 0.65) !important;
        }
    
        @media (max-width: 1023px) {
            .site-header .main-nav-capsule, html.dark .site-header .main-nav-capsule, html:not(.dark) .site-header .main-nav-capsule { display: none !important; }
        }

        @media (max-width: 640px) {
            
            .site-header .brand-logo-text { font-size: 1rem !important; }
            
        }
</style>

    <!-- Alpine Store & Global Modal Logic (Loaded before body parsing) -->
    <script>
        function rachiPrintStudio() {
            return {
                mobileMenuOpen: false,
                showAllPortfolio: false,
                activeLine: null,
                activeModalImage: null,
                activeModalTitle: '',
                activeModalDesc: '',
                activeModalTag: '',
                activeModalSlug: '',
                showQuoteModal: false,
                quoteProduct: '',
                quoteCategory: 'RACHI Print',
                quoteServiceSlug: '',
                quoteSubmitting: false,
                quoteSuccess: false,
                quoteProtocol: '',
                quoteErrorMsg: '',
                quoteForm: {
                    name: '',
                    empresa: '',
                    phone: '',
                    email: '',
                    quantidade: '',
                    prazo: 'padrao',
                    message: ''
                },

                openQuoteModal(productName, lineName, serviceSlug) {
                    this.quoteProduct = productName || 'Solução Gráfica RACHI Print';
                    this.quoteCategory = lineName || this.activeModalTag || 'RACHI Print';
                    this.quoteServiceSlug = serviceSlug || this.activeModalSlug || '';
                    this.quoteSubmitting = false;
                    this.quoteSuccess = false;
                    this.quoteErrorMsg = '';
                    this.quoteProtocol = '';
                    this.showQuoteModal = true;
                    document.body.style.overflow = 'hidden';

                    // Update DOM fallback inputs
                    const titleEl = document.getElementById('modal-quote-product-display');
                    if (titleEl) titleEl.textContent = this.quoteProduct;
                    const prodInput = document.getElementById('modal-quote-product-input');
                    if (prodInput) prodInput.value = this.quoteProduct;
                    const lineInput = document.getElementById('modal-quote-line-input');
                    if (lineInput) lineInput.value = this.quoteCategory;
                    const slugInput = document.getElementById('modal-quote-slug-input');
                    if (slugInput) slugInput.value = this.quoteServiceSlug;

                    const formBox = document.getElementById('quote-modal-form-content');
                    if (formBox) formBox.style.display = 'block';
                    const successBox = document.getElementById('quote-modal-success-content');
                    if (successBox) successBox.style.display = 'none';

                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                closeQuoteModal() {
                    this.showQuoteModal = false;
                    const modalEl = document.getElementById('rachi-quote-modal');
                    if (modalEl) modalEl.style.display = 'none';
                    if (!this.activeModalImage) {
                        document.body.style.overflow = '';
                    }
                },

                async submitQuote() {
                    if (this.quoteSubmitting || this.quoteSuccess) return;
                    if (!this.quoteForm.name || !this.quoteForm.email || !this.quoteForm.phone) {
                        this.quoteErrorMsg = 'Por favor preencha os campos obrigatórios (Nome, E-mail e Telefone).';
                        return;
                    }
                    this.quoteSubmitting = true;
                    this.quoteErrorMsg = '';

                    try {
                        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
                        const res = await fetch('/print/solicitar-cotacao', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                name: this.quoteForm.name,
                                empresa: this.quoteForm.empresa,
                                phone: this.quoteForm.phone,
                                email: this.quoteForm.email,
                                produto: this.quoteProduct,
                                linha: this.quoteCategory,
                                service_slug: this.quoteServiceSlug,
                                quantidade: this.quoteForm.quantidade,
                                prazo: this.quoteForm.prazo,
                                message: this.quoteForm.message
                            })
                        });

                        const data = await res.json();
                        if (res.ok && data.success) {
                            this.quoteSuccess = true;
                            this.quoteProtocol = data.protocol;
                            const protoEl = document.getElementById('quote-protocol-display');
                            if (protoEl) protoEl.textContent = data.protocol;
                            const prodSuccessEl = document.getElementById('quote-success-product-display');
                            if (prodSuccessEl) prodSuccessEl.textContent = this.quoteProduct;
                            const formBox = document.getElementById('quote-modal-form-content');
                            if (formBox) formBox.style.display = 'none';
                            const successBox = document.getElementById('quote-modal-success-content');
                            if (successBox) successBox.style.display = 'block';

                            if (window.toast) {
                                window.toast.success(data.message || 'Solicitação registada com sucesso!');
                            }
                        } else {
                            this.quoteErrorMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(', ') : 'Erro ao processar solicitação. Tente novamente.');
                        }
                    } catch (err) {
                        console.error(err);
                        this.quoteErrorMsg = 'Erro de comunicação com o servidor. Verifique a sua ligação.';
                    } finally {
                        this.quoteSubmitting = false;
                        this.$nextTick(() => {
                            if (window.lucide) window.lucide.createIcons();
                        });
                    }
                },

                toggleLine(lineId) {
                    if (this.activeLine === lineId) {
                        this.activeLine = null;
                    } else {
                        this.activeLine = lineId;
                    }
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                selectLine(lineId) {
                    this.activeLine = lineId;
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                        const cardEl = document.getElementById('linha-' + lineId);
                        if (cardEl) {
                            cardEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                        }
                    });
                },

                openModal(img, title, desc, tag, slug) {
                    this.activeModalImage = img;
                    this.activeModalTitle = title;
                    this.activeModalDesc = desc;
                    this.activeModalTag = tag;
                    this.activeModalSlug = slug || '';
                    document.body.style.overflow = 'hidden';
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },

                closeModal() {
                    this.activeModalImage = null;
                    this.activeModalSlug = '';
                    if (!this.showQuoteModal) {
                        document.body.style.overflow = '';
                    }
                },

                init() {
                    window.rachiPrintInstance = this;
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
            };
        }

        window.rachiPrintStudio = rachiPrintStudio;
        document.addEventListener('alpine:init', () => {
            if (window.Alpine) {
                Alpine.data('rachiPrintStudio', rachiPrintStudio);
            }
        });

        // Global Modal Triggers (Works seamlessly across Alpine & Vanilla JS)
        window.rachiOpenQuoteModal = function(productName, lineName, serviceSlug) {
            productName = productName || 'Solução Gráfica RACHI Print';
            lineName = lineName || 'RACHI Print';
            serviceSlug = serviceSlug || '';

            if (window.rachiPrintInstance && typeof window.rachiPrintInstance.openQuoteModal === 'function') {
                window.rachiPrintInstance.openQuoteModal(productName, lineName, serviceSlug);
                return false;
            }

            try {
                const bodyEl = document.querySelector('body[x-data]');
                if (bodyEl && window.Alpine) {
                    const d = Alpine.$data(bodyEl);
                    if (d && typeof d.openQuoteModal === 'function') {
                        d.openQuoteModal(productName, lineName, serviceSlug);
                        return false;
                    }
                }
            } catch (e) {}

            const modalEl = document.getElementById('rachi-quote-modal');
            if (modalEl) {
                modalEl.removeAttribute('x-cloak');
                modalEl.style.display = 'flex';
                const titleEl = document.getElementById('modal-quote-product-display');
                if (titleEl) titleEl.textContent = productName;
                const prodInput = document.getElementById('modal-quote-product-input');
                if (prodInput) prodInput.value = productName;
                const lineInput = document.getElementById('modal-quote-line-input');
                if (lineInput) lineInput.value = lineName;
                const slugInput = document.getElementById('modal-quote-slug-input');
                if (slugInput) slugInput.value = serviceSlug;
                const formBox = document.getElementById('quote-modal-form-content');
                if (formBox) formBox.style.display = 'block';
                const successBox = document.getElementById('quote-modal-success-content');
                if (successBox) successBox.style.display = 'none';
                document.body.style.overflow = 'hidden';
            }
            return false;
        };

        window.rachiCloseQuoteModal = function() {
            if (window.rachiPrintInstance && typeof window.rachiPrintInstance.closeQuoteModal === 'function') {
                window.rachiPrintInstance.closeQuoteModal();
                return false;
            }
            try {
                const bodyEl = document.querySelector('body[x-data]');
                if (bodyEl && window.Alpine) {
                    const d = Alpine.$data(bodyEl);
                    if (d && typeof d.closeQuoteModal === 'function') {
                        d.closeQuoteModal();
                        return false;
                    }
                }
            } catch (e) {}
            const modalEl = document.getElementById('rachi-quote-modal');
            if (modalEl) {
                modalEl.style.display = 'none';
                document.body.style.overflow = '';
            }
            return false;
        };

        window.rachiSubmitQuoteForm = async function(e) {
            if (e) e.preventDefault();
            const name = document.querySelector('input[x-model="quoteForm.name"]')?.value || '';
            const empresa = document.querySelector('input[x-model="quoteForm.empresa"]')?.value || '';
            const phone = document.querySelector('input[x-model="quoteForm.phone"]')?.value || '';
            const email = document.querySelector('input[x-model="quoteForm.email"]')?.value || '';
            const quantidade = document.querySelector('input[x-model="quoteForm.quantidade"]')?.value || '';
            const prazo = document.querySelector('select[x-model="quoteForm.prazo"]')?.value || 'padrao';
            const message = document.querySelector('textarea[x-model="quoteForm.message"]')?.value || '';
            const produto = document.getElementById('modal-quote-product-input')?.value || document.getElementById('modal-quote-product-display')?.textContent || 'Solução Gráfica RACHI Print';
            const linha = document.getElementById('modal-quote-line-input')?.value || 'RACHI Print';
            const service_slug = document.getElementById('modal-quote-slug-input')?.value || '';

            if (!name || !email || !phone) {
                alert('Por favor preencha os campos obrigatórios (Nome, E-mail e Telefone).');
                return false;
            }

            try {
                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                const token = csrfMeta ? csrfMeta.getAttribute('content') : '';
                const res = await fetch('/print/solicitar-cotacao', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ name, empresa, phone, email, produto, linha, service_slug, quantidade, prazo, message })
                });
                const data = await res.json();
                if (res.ok && data.success) {
                    const protoEl = document.getElementById('quote-protocol-display');
                    if (protoEl) protoEl.textContent = data.protocol;
                    const prodSuccessEl = document.getElementById('quote-success-product-display');
                    if (prodSuccessEl) prodSuccessEl.textContent = produto;
                    const formBox = document.getElementById('quote-modal-form-content');
                    if (formBox) formBox.style.display = 'none';
                    const successBox = document.getElementById('quote-modal-success-content');
                    if (successBox) successBox.style.display = 'block';
                    if (window.toast) window.toast.success(data.message || 'Solicitação registada com sucesso!');
                } else {
                    alert(data.message || 'Erro ao processar solicitação.');
                }
            } catch(err) {
                console.error(err);
                alert('Erro ao enviar solicitação.');
            }
            return false;
        };
    </script>
</head>
<body x-data="rachiPrintStudio()" class="ambient-bg antialiased">

    <!-- ============================================================ -->
    <!-- NAVIGATION (Standardized RACHI Capsule Header System)         -->
    <!-- ============================================================ -->
    <header class="site-header" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-14 sm:h-20 flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Print -->
            <a href="/" class="flex items-center gap-2.5 sm:gap-3 group text-decoration-none select-none" title="Ir para a página inicial (Portal RACHI)">
                <picture class="flex items-center shrink-0">
                    <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                    <img src="/images/areas/rachi-print.png" 
                         onerror="this.onerror=null; this.src='/images/areas/rachi-print.png'" 
                         alt="RACHI Print" 
                         class="h-8 sm:h-9 w-auto object-contain transition-transform duration-200 group-hover:scale-105 filter drop-shadow-[0_2px_8px_rgba(245,168,0,0.35)]">
                </picture>
                <span class="font-display font-black text-base sm:text-lg tracking-wider text-slate-900 dark:text-white transition-colors">
                    RACHI <span class="text-[#d97706] dark:text-[#f5a800]">Print</span>
                </span>
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
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400 dropdown-desc">Educação &amp; Formação</div>
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

                <a href="#produtos-graficos" class="nav-link"><span>Serviços</span></a>
                <a href="#identidade-branding" class="nav-link"><span>Branding</span></a>
                <a href="#portfolio-print" class="nav-link"><span>Portfólio</span></a>
                <a href="/loja" class="nav-link"><span>Loja</span></a>
                <a href="/contacto" class="nav-link"><span>Contacto</span></a>
            </nav>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2 sm:gap-2.5">
                <button type="button"
                        onclick="toggleRachiTheme()"
                        class="header-theme-pill"
                        aria-label="Alternar entre Modo Claro e Modo Escuro"
                        title="Alternar Modo Claro / Modo Escuro">
                    <svg class="icon-for-light w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg class="icon-for-dark w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>

                <button type="button"
                        @click="openQuoteModal('Orçamento Personalizado RACHI Print', 'RACHI Print', '')"
                        onclick="return window.rachiOpenQuoteModal('Orçamento Personalizado RACHI Print', 'RACHI Print', '')"
                        class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-extrabold bg-gradient-to-r from-[#f5a800] to-[#d97706] text-[#071326] shadow-md hover:brightness-105 transition cursor-pointer">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                    <span>Pedir Orçamento</span>
                </button>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl transition-colors" aria-label="Abrir menu">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-cloak class="lg:hidden bg-white/98 dark:bg-[#080c16]/98 border-b border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-xl transition-colors">
            <a href="/" class="block py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-amber-600 dark:hover:text-white">Home</a>
            <div class="pt-2 border-t border-slate-200 dark:border-white/10 space-y-1">
                <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400 tracking-wider">Soluções</span>
                <a href="/capital" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">RACHI Human Capital</a>
                <a href="/academy" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">RACHI Academy</a>
                <a href="/tec" class="block pl-3 text-xs text-slate-600 dark:text-slate-400 py-1">RACHI Tec</a>
                <a href="/print" class="block pl-3 text-xs text-amber-600 dark:text-amber-400 font-bold py-1">RACHI Print</a>
            </div>
            <div class="pt-2 border-t border-slate-200 dark:border-white/10 space-y-2">
                <a href="#produtos-graficos" @click="mobileMenuOpen = false" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Nossos Serviços</a>
                <a href="#identidade-branding" @click="mobileMenuOpen = false" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Identidade Visual &amp; Branding</a>
                <a href="#portfolio-print" @click="mobileMenuOpen = false" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Portfólio</a>
                <a href="/loja" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Loja</a>
                <a href="/contacto" class="block text-sm text-slate-700 dark:text-slate-300 py-1">Contacto</a>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- 1. HERO BANNER: RACHI Print (Arte Editorial Indústria Gráfica) -->
    <!-- ============================================================ -->
    <main class="flex-1" style="padding-top: 75px;">
        <!-- Breadcrumbs Navigation Bar (Theme Adaptive) -->
        <div class="breadcrumb-nav-bar py-3 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <nav class="flex items-center gap-2 text-xs font-medium">
                    <a href="/" class="hover:text-amber-600 dark:hover:text-white transition cursor-pointer">Início</a>
                    <span class="opacity-50">/</span>
                    <span class="opacity-70">Soluções</span>
                    <span class="opacity-50">/</span>
                    <span class="text-amber-700 dark:text-[#f5a800] font-bold">RACHI Print</span>
                </nav>
            </div>
        </div>

        <!-- Hero Artwork Section -->
        <section id="print-hero-banner" aria-label="Gráfica de Alto Padrão — RACHI Print">
            <picture>
                <source srcset="{{ asset('images/print-hero-banner.webp') }}" type="image/webp">
                <img src="{{ asset('images/print-hero-banner.jpg') }}"
                     alt="RACHI Print — Dê vida aos seus materiais com acabamento institucional"
                     class="print-hero-bg"
                     loading="eager"
                     fetchpriority="high">
            </picture>

            <div class="print-hero-scrim" aria-hidden="true"></div>

            <div class="print-hero-inner">
                <div class="print-hero-editorial">
                    <!-- Barra superior branca + Tag original da RACHI Print -->
                    <div class="print-hero-eyebrow">
                        <span class="print-hero-topline" aria-hidden="true"></span>
                        <span class="print-hero-eyebrow-text">Gráfica de Alto Padrão</span>
                    </div>

                    <!-- Título Original da RACHI Print com o Design Editorial do Modelo -->
                    <h1 class="print-hero-heading">
                        <span class="print-hero-line-top">Dê vida aos seus materiais com</span>
                        <span class="print-hero-box-amber">Acabamento</span>
                        <span class="print-hero-line-bottom">Institucional</span>
                    </h1>

                    <!-- Subtítulo Oficial Completo da RACHI Print -->
                    <p class="print-hero-desc">
                        Design de identidade visual, branding corporativo, produção gráfica de alta definição, embalagens, brindes promocionais e sinalética que destacam a sua empresa, impressionam clientes e garantem total conformidade de marca.
                    </p>

                    <!-- Assinatura Oficial RACHI Print -->
                    <div class="print-hero-brand">
                        <picture>
                            <source srcset="{{ asset('images/areas/rachi-print-symbol.webp') }}" type="image/webp">
                            <img src="{{ asset('images/areas/rachi-print-symbol.png') }}"
                                 alt="Símbolo RACHI Print"
                                 class="print-hero-brand-icon">
                        </picture>
                        <span class="print-hero-brand-name">RACHI Print</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4 Pilares Estratégicos da Unidade RACHI Print -->
        <section class="print-pillars-strip w-full">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                    <div class="print-pillar-card flex items-center gap-3.5 p-4 rounded-2xl">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="print-pillar-title font-bold text-sm text-slate-900 dark:text-white">Branding &amp; Identidade Visual</div>
                            <div class="print-pillar-desc text-xs text-slate-500 dark:text-slate-400">Criação de marcas, logótipos e Brandbook</div>
                        </div>
                    </div>

                    <div class="print-pillar-card flex items-center gap-3.5 p-4 rounded-2xl">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="print-pillar-title font-bold text-sm text-slate-900 dark:text-white">Produção Gráfica &amp; Editorial</div>
                            <div class="print-pillar-desc text-xs text-slate-500 dark:text-slate-400">Rigor cromático CMYK e acabamentos nobres</div>
                        </div>
                    </div>

                    <div class="print-pillar-card flex items-center gap-3.5 p-4 rounded-2xl">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/10 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="gift" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="print-pillar-title font-bold text-sm text-slate-900 dark:text-white">Brindes, Têxtil &amp; Embalagens</div>
                            <div class="print-pillar-desc text-xs text-slate-500 dark:text-slate-400">Kits VIP, fardamento bordado e cartonagem</div>
                        </div>
                    </div>

                    <div class="print-pillar-card flex items-center gap-3.5 p-4 rounded-2xl">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/10 dark:bg-sky-500/15 text-sky-600 dark:text-sky-400 flex items-center justify-center shrink-0">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="print-pillar-title font-bold text-sm text-slate-900 dark:text-white">Sinalética &amp; Grandes Formatos</div>
                            <div class="print-pillar-desc text-xs text-slate-500 dark:text-slate-400">Letras 3D, fachadas, frotas e eventos</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 2. NOSSOS SERVIÇOS — Branding, Design & Impressão Gráfica    -->
        <!-- ============================================================ -->
        <section id="produtos-graficos" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="catalogo"></div><div id="servicos-print"></div>
            <div class="rprint-sec-header">
                <span class="rprint-pill">Nossos Serviços</span>
                <h2 class="rprint-sec-title">
                    Soluções completas em <span class="rprint-gradient-text">branding e impressão gráfica</span>
                </h2>
                <p class="rprint-sec-sub">
                    Da criação da marca e manual de identidade visual à produção gráfica, embalagens, brindes, fardamento e sinalética corporativa para todas as necessidades do seu negócio.
                </p>
            </div>

            <div class="rprint-services-grid">
                <!-- 1. Design de Identidade Visual e Branding -->
                <a id="linha-1"
                   href="{{ route('print.service.show', 'design-identidade-visual') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Branding &amp; Marcas</span>
                        <picture>
                            <source srcset="{{ asset('images/services/service-print-identidade-branding.webp') }}" type="image/webp">
                            <img src="{{ asset('images/services/service-print-identidade-branding.jpg') }}"
                                 alt="Design de Identidade Visual e Branding"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="palette" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Design de Identidade Visual e Branding</h3>
                        <p class="rprint-service-desc">
                            Criação de logótipos exclusivos, rebranding corporativo, Manual de Normas Gráficas (Brandbook), paleta Pantone/CMYK, tipografia institucional e kits para redes sociais.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Logótipo &amp; Rebranding</span>
                            <span class="rprint-service-chip">Brandbook</span>
                            <span class="rprint-service-chip">Kit Social Media</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 2. Papelaria Corporativa e Cartões de Visita -->
                <a id="linha-2"
                   href="{{ route('print.service.show', 'producao-grafica-corporativa') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Estacionário Executivo</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/papelaria-corporativa.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/papelaria-corporativa.jpg') }}"
                                 alt="Papelaria Corporativa e Cartões de Visita"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Cartões de Visita e Papelaria Corporativa</h3>
                        <p class="rprint-service-desc">
                            Estacionário completo alinhado à sua marca: cartões de visita com Soft-Touch e verniz UV localizado, pastas com bolsa, envelopes, papel timbrado, blocos e carimbos.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Cartões Soft-Touch</span>
                            <span class="rprint-service-chip">Pastas &amp; Envelopes</span>
                            <span class="rprint-service-chip">Carimbos</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 3. Impressão Editorial, Institucional e Folhetos -->
                <a id="linha-3"
                   href="{{ route('print.service.show', 'documentos-institucionais') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Editorial &amp; Folhetos</span>
                        <img src="{{ asset('images/services/service-print-documentos-institucionais.jpg') }}"
                             alt="Impressão de Documentos Institucionais e Folhetos"
                             loading="lazy">
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Impressão Institucional, Catálogos e Folhetos</h3>
                        <p class="rprint-service-desc">
                            Impressão de relatórios de gestão e contas, brochuras, catálogos comerciais, flyers, desdobráveis, manuais técnicos, propostas de concurso e certificados oficiais.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Relatórios &amp; Livros</span>
                            <span class="rprint-service-chip">Brochuras &amp; Flyers</span>
                            <span class="rprint-service-chip">Certificados</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 4. Embalagens, Cartonagem, Sacolas e Rótulos -->
                <a id="linha-4"
                   href="{{ route('print.service.show', 'embalagens-cartonagem-rotulos') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Packaging &amp; Cartonagem</span>
                        <picture>
                            <source srcset="{{ asset('images/services/service-print-embalagens-rotulos.webp') }}" type="image/webp">
                            <img src="{{ asset('images/services/service-print-embalagens-rotulos.jpg') }}"
                                 alt="Embalagens, Cartonagem, Sacolas e Rótulos"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="package" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Embalagens, Cartonagem, Sacolas e Rótulos</h3>
                        <p class="rprint-service-desc">
                            Produção de embalagens em cartonagem à medida, caixas rígidas magnéticas, sacolas corporativas em couché ou kraft, rótulos em vinil/bobina, etiquetas e selos.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Caixas &amp; Cartonagem</span>
                            <span class="rprint-service-chip">Sacolas VIP</span>
                            <span class="rprint-service-chip">Rótulos Adesivos</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 5. Materiais Promocionais, Brindes e Kits VIP -->
                <a id="linha-5"
                   href="{{ route('print.service.show', 'materiais-promocionais') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Brindes &amp; Kits VIP</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/kit-corporativo-vip.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/kit-corporativo-vip.jpg') }}"
                                 alt="Materiais Promocionais, Brindes e Kits Executivos"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="gift" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Materiais Promocionais, Brindes e Kits VIP</h3>
                        <p class="rprint-service-desc">
                            Kits onboarding, agendas executivas em baixo-relevo, garrafas térmicas, canecas, powerbanks, pendrives e canetas metálicas com gravação a laser e UV.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Kits Onboarding</span>
                            <span class="rprint-service-chip">Agendas &amp; Garrafas</span>
                            <span class="rprint-service-chip">Gravação Laser</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 6. Vestuário Corporativo, Bordados e Estampagem -->
                <a id="linha-6"
                   href="{{ route('print.service.show', 'vestuario-bordados-textil') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Fardamento &amp; Têxtil</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/vestuario-corporativo.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/vestuario-corporativo.jpg') }}"
                                 alt="Vestuário Corporativo, Bordados e Estampagem"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="shirt" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Vestuário Corporativo, Bordados e Estampagem</h3>
                        <p class="rprint-service-desc">
                            Uniformização profissional de equipas: polos em malha piquet, camisas sociais, coletes acolchoados, t-shirts promocionais e bonés com bordado HD, DTF e serigrafia.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Polos &amp; Camisas</span>
                            <span class="rprint-service-chip">Bordado HD</span>
                            <span class="rprint-service-chip">DTF &amp; Serigrafia</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 7. Sinalética Corporativa, Fachadas e Letras 3D -->
                <a id="linha-7"
                   href="{{ route('print.service.show', 'sinaletica-comunicacao-visual') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Sinalética &amp; Letras 3D</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/sinaletica-fachada-recepcao.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/sinaletica-fachada-recepcao.jpg') }}"
                                 alt="Sinalética Corporativa, Fachadas e Letras 3D"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="building-2" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Sinalética Corporativa, Fachadas e Letras 3D</h3>
                        <p class="rprint-service-desc">
                            Placas externas em ACM, logótipos 3D retroiluminados em LED para recepção, placas direccionais em acrílico/inox, películas de vidro jateado e wall graphics.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Letras Caixa LED</span>
                            <span class="rprint-service-chip">Fachadas ACM</span>
                            <span class="rprint-service-chip">Vidro Jateado</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 8. Comunicação Externa, Frotas, Outdoors e MUPIs -->
                <a id="linha-8"
                   href="{{ route('print.service.show', 'sinaletica-comunicacao-visual') }}?produto={{ urlencode('Decoração de Frotas, Outdoors & MUPIs') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Frotas &amp; Mídia Exterior</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/comunicacao-externa-frotas.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/comunicacao-externa-frotas.jpg') }}"
                                 alt="Comunicação Externa, Decoração de Frotas, Outdoors e MUPIs"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="layers" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Decoração de Frotas, Lonas, Outdoors e MUPIs</h3>
                        <p class="rprint-service-desc">
                            Envelopamento e personalização de viaturas comerciais em vinil polimérico laminado UV, impressão de lonas com ilhós, outdoors, MUPIs e montras.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Viaturas &amp; Frotas</span>
                            <span class="rprint-service-chip">Lonas &amp; Banners</span>
                            <span class="rprint-service-chip">Outdoors &amp; MUPIs</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Pedir cotação desta linha</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>

                <!-- 9. Produção Gráfica para Eventos, Feiras e Stands -->
                <a id="linha-9"
                   href="{{ route('print.service.show', 'grafica-eventos') }}"
                   class="rprint-service-card">
                    <div class="rprint-service-media">
                        <span class="rprint-service-badge">Eventos &amp; Stands</span>
                        <picture>
                            <source srcset="{{ asset('images/portfolio-print/stands-cenografia-eventos.webp') }}" type="image/webp">
                            <img src="{{ asset('images/portfolio-print/stands-cenografia-eventos.jpg') }}"
                                 alt="Produção Gráfica para Eventos, Feiras e Stands"
                                 loading="lazy">
                        </picture>
                    </div>
                    <div class="rprint-service-body">
                        <div class="rprint-service-icon">
                            <i data-lucide="calendar-range" class="w-5 h-5"></i>
                        </div>
                        <h3 class="rprint-service-title">Cenografia para Eventos, Feiras e Stands</h3>
                        <p class="rprint-service-desc">
                            Stands modulares personalizados, roll-ups em alumínio, backdrops fotográficos anti-reflexo, balcões promocionais, fitas lanyard, pins e credenciais em PVC.
                        </p>
                        <div class="rprint-service-tags">
                            <span class="rprint-service-chip">Stands &amp; Backdrops</span>
                            <span class="rprint-service-chip">Roll-ups</span>
                            <span class="rprint-service-chip">Credenciais PVC</span>
                        </div>
                        <span class="rprint-service-more">
                            <span>Ver planos e detalhes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </span>
                    </div>
                </a>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 2.5 ESTÚDIO DE BRANDING, IDENTIDADE VISUAL & APLICAÇÕES      -->
        <!-- ============================================================ -->
        <section id="identidade-branding" class="rprint-branding-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rprint-branding-hero-grid">
                    <!-- Coluna Visual: Estúdio de Identidade Visual & Brandbook -->
                    <div class="rprint-branding-visual"
                         role="button"
                         tabindex="0"
                         @click="openModal(@js(asset('images/services/service-print-identidade-branding.jpg')), 'Design de Identidade Visual & Manual de Marca (Brandbook)', 'Concepção estratégica de logótipos com grelha geométrica, definição de paleta cromática Pantone/CMYK/RGB, tipografia institucional, estacionário executivo e activos vectoriais prontos para gráfica e plataformas digitais.', 'Estúdio de Branding RACHI Print', 'design-identidade-visual')"
                         @keydown.enter="openModal(@js(asset('images/services/service-print-identidade-branding.jpg')), 'Design de Identidade Visual & Manual de Marca (Brandbook)', 'Concepção estratégica de logótipos com grelha geométrica, definição de paleta cromática Pantone/CMYK/RGB, tipografia institucional, estacionário executivo e activos vectoriais prontos para gráfica e plataformas digitais.', 'Estúdio de Branding RACHI Print', 'design-identidade-visual')">
                        <picture>
                            <source srcset="{{ asset('images/services/service-print-identidade-branding.webp') }}" type="image/webp">
                            <img src="{{ asset('images/services/service-print-identidade-branding.jpg') }}"
                                 alt="Manual de Identidade Visual, Escala Pantone e Estacionário Corporativo — RACHI Print"
                                 loading="lazy">
                        </picture>
                        <div class="rprint-branding-visual-bar">
                            <div>
                                <div class="text-[11px] font-bold uppercase tracking-wider text-amber-400">Estúdio Criativo RACHI Print</div>
                                <div class="text-xs sm:text-sm font-semibold text-white">Manual de Marca • Escalas Pantone &amp; CMYK • Ficheiros Vectoriais</div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-300 shrink-0">
                                <i data-lucide="zoom-in" class="w-4 h-4"></i>
                                <span>Ampliar</span>
                            </span>
                        </div>
                    </div>

                    <!-- Coluna Estratégica: Entregáveis de Identidade Visual & Branding -->
                    <div>
                        <span class="rprint-pill">Identidade Visual &amp; Branding</span>
                        <h2 class="rprint-sec-title" style="text-align: left; margin-top: 0.75rem;">
                            Construímos marcas <span class="rprint-gradient-text">fortes, coerentes e memoráveis</span>
                        </h2>
                        <p class="rprint-sec-sub" style="text-align: left; margin: 0.9rem 0 0 0; max-width: 100%;">
                            Mais do que imprimir, a RACHI Print cria e estrutura toda a comunicação visual da sua organização. Desenvolvemos marcas de raiz ou conduzimos processos de <strong>rebranding</strong> garantindo unidade absoluta entre o digital, o papel, o fardamento e o espaço físico.
                        </p>

                        <div class="rprint-deliverables-grid">
                            <div class="rprint-deliverable-card">
                                <span class="rprint-deliverable-num">01 • MARCA</span>
                                <h3 class="rprint-deliverable-title">Criação de Logótipo &amp; Rebranding</h3>
                                <p class="rprint-deliverable-desc">
                                    Símbolos exclusivos construídos sobre grelha geométrica, versões horizontais, verticais e monocromáticas para máxima legibilidade.
                                </p>
                            </div>

                            <div class="rprint-deliverable-card">
                                <span class="rprint-deliverable-num">02 • BRANDBOOK</span>
                                <h3 class="rprint-deliverable-title">Manual de Normas Gráficas</h3>
                                <p class="rprint-deliverable-desc">
                                    Documentação oficial com códigos Pantone, CMYK, RGB e HEX, tipografia institucional, margens de segurança e regras de aplicação.
                                </p>
                            </div>

                            <div class="rprint-deliverable-card">
                                <span class="rprint-deliverable-num">03 • PRESENÇA</span>
                                <h3 class="rprint-deliverable-title">Estacionário &amp; Kit Digital</h3>
                                <p class="rprint-deliverable-desc">
                                    Papelaria executiva completa, assinaturas de e-mail, templates editáveis para redes sociais e apresentações corporativas (Pitch Deck).
                                </p>
                            </div>

                            <div class="rprint-deliverable-card">
                                <span class="rprint-deliverable-num">04 • EXECUÇÃO</span>
                                <h3 class="rprint-deliverable-title">Desdobramento 360º &amp; Produção</h3>
                                <p class="rprint-deliverable-desc">
                                    Arte-final fechada e produção directa de embalagens, uniformes, fachadas 3D, viaturas e stands sem perda de fidelidade cromática.
                                </p>
                            </div>
                        </div>

                        <div class="mt-7 flex flex-wrap items-center gap-3.5">
                            <button type="button"
                                    onclick="window.rachiOpenQuoteModal('Projecto de Identidade Visual & Branding', 'Branding & Identidade Visual', 'design-identidade-visual'); return false;"
                                    class="rprint-btn-gradient">
                                <i data-lucide="sparkles" class="w-4 h-4"></i>
                                <span>Pedir Proposta de Branding</span>
                            </button>
                            <a href="{{ route('print.service.show', 'design-identidade-visual') }}"
                               class="rprint-btn-outline">
                                <span>Ver Pacotes de Identidade Visual</span>
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Vitrine Visual de Aplicações de Marca (6 Pranchas Oficiais) -->
                <div class="rprint-brand-apps-wrap">
                    <div class="rprint-sec-header" style="margin-bottom: 1.5rem;">
                        <span class="rprint-pill"> Universo da Marca na Prática </span>
                        <h3 class="rprint-sec-title" style="font-size: clamp(1.65rem, 2.7vw, 2.35rem);">
                            Aplicações de <span class="rprint-gradient-text">identidade visual e comunicação 360º</span>
                        </h3>
                        <p class="rprint-sec-sub">
                            Veja como traduzimos a identidade visual de uma organização em todos os pontos de contacto com clientes, equipas e parceiros. Clique em qualquer aplicação para ampliar.
                        </p>
                    </div>

                    <div class="rprint-brand-apps-grid">
                        <!-- Prancha 1: Papelaria & Estacionário -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/papelaria-corporativa.jpg')), 'Identidade Aplicada em Papelaria & Estacionário', 'Desenvolvimento e produção coordenada de agenda executiva em baixo-relevo, bloco de notas, pasta institucional com bolsa, cartões de visita, envelopes e papel timbrado.', 'Identidade Corporativa', 'design-identidade-visual')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/papelaria-corporativa.jpg')), 'Identidade Aplicada em Papelaria & Estacionário', 'Desenvolvimento e produção coordenada de agenda executiva em baixo-relevo, bloco de notas, pasta institucional com bolsa, cartões de visita, envelopes e papel timbrado.', 'Identidade Corporativa', 'design-identidade-visual')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/papelaria-corporativa.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/papelaria-corporativa.jpg') }}"
                                         alt="Identidade Aplicada em Papelaria e Estacionário Corporativo"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">01 • Estacionário Institucional</span>
                                <h4 class="rprint-brand-app-title">Papelaria Corporativa Completa</h4>
                                <p class="rprint-brand-app-desc">Pastas, cartões de visita, envelopes, papel timbrado, blocos e agendas alinhados ao manual de marca.</p>
                            </div>
                        </div>

                        <!-- Prancha 2: Sinalética, Fachada & Recepção -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/sinaletica-fachada-recepcao.jpg')), 'Branding Ambiental: Fachada, Recepção 3D & Sinalética', 'Projecto completo de arquitectura de marca: placa externa, recepção com logótipo 3D iluminado, sinalética direccional interna, vidro jateado para salas de reunião e wall graphic.', 'Sinalética & Arquitectura', 'sinaletica-comunicacao-visual')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/sinaletica-fachada-recepcao.jpg')), 'Branding Ambiental: Fachada, Recepção 3D & Sinalética', 'Projecto completo de arquitectura de marca: placa externa, recepção com logótipo 3D iluminado, sinalética direccional interna, vidro jateado para salas de reunião e wall graphic.', 'Sinalética & Arquitectura', 'sinaletica-comunicacao-visual')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/sinaletica-fachada-recepcao.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/sinaletica-fachada-recepcao.jpg') }}"
                                         alt="Fachada Externa, Recepção 3D, Sinalética, Vidro Jateado e Wall Graphic"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">02 • Branding Ambiental</span>
                                <h4 class="rprint-brand-app-title">Fachadas, Recepção 3D &amp; Sinalética</h4>
                                <p class="rprint-brand-app-desc">Placas externas, recepção LED, directórios internos, películas em vidro jateado e murais corporativos.</p>
                            </div>
                        </div>

                        <!-- Prancha 3: Aplicações Externas & Frotas -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/comunicacao-externa-frotas.jpg')), 'Aplicações Externas: Viaturas, Banners, Outdoors & MUPIs', 'Padronização visual exterior em frotas de viaturas comerciais, lonas de fachada com ilhós, painéis de outdoor e mobiliário urbano (MUPIs).', 'Comunicação Externa', 'sinaletica-comunicacao-visual')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/comunicacao-externa-frotas.jpg')), 'Aplicações Externas: Viaturas, Banners, Outdoors & MUPIs', 'Padronização visual exterior em frotas de viaturas comerciais, lonas de fachada com ilhós, painéis de outdoor e mobiliário urbano (MUPIs).', 'Comunicação Externa', 'sinaletica-comunicacao-visual')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/comunicacao-externa-frotas.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/comunicacao-externa-frotas.jpg') }}"
                                         alt="Aplicações Externas: Viaturas, Banners, Outdoors e MUPIs"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">03 • Visibilidade Urbana</span>
                                <h4 class="rprint-brand-app-title">Frotas, Banners, Outdoors &amp; MUPIs</h4>
                                <p class="rprint-brand-app-desc">Decoração de carrinhas empresariais, lonas resistentes ao tempo e campanhas de rua de alto impacto.</p>
                            </div>
                        </div>

                        <!-- Prancha 4: Ecossistema de Merchandising & Fardamento -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/kit-merchandising-completo.jpg')), 'Ecossistema Completo de Merchandising & Vestuário', 'Linha coordenada de coletes acolchoados, polos bordados, t-shirts, bonés, tote bag, caneca, cadernos, crachá PVC com fita lanyard e cartões.', 'Merchandising & Têxtil', 'vestuario-bordados-textil')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/kit-merchandising-completo.jpg')), 'Ecossistema Completo de Merchandising & Vestuário', 'Linha coordenada de coletes acolchoados, polos bordados, t-shirts, bonés, tote bag, caneca, cadernos, crachá PVC com fita lanyard e cartões.', 'Merchandising & Têxtil', 'vestuario-bordados-textil')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/kit-merchandising-completo.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/kit-merchandising-completo.jpg') }}"
                                         alt="Ecossistema Completo de Merchandising e Vestuário Corporativo"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">04 • Cultura &amp; Equipa</span>
                                <h4 class="rprint-brand-app-title">Vestuário, Tote Bags &amp; Merchandising</h4>
                                <p class="rprint-brand-app-desc">Uniformização e brindes integrados que fortalecem o orgulho de pertença e a presença da marca.</p>
                            </div>
                        </div>

                        <!-- Prancha 5: Submarcas, Academias & Certificação -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/kit-formacao-academy.jpg')), 'Identidade para Academias, Formação & Certificados', 'Kit completo para centros de formação e eventos: certificado oficial com selo dourado, crachá personalizado, manual encadernado, sacola, painel fotográfico e roll-up.', 'Submarcas & Formação', 'documentos-institucionais')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/kit-formacao-academy.jpg')), 'Identidade para Academias, Formação & Certificados', 'Kit completo para centros de formação e eventos: certificado oficial com selo dourado, crachá personalizado, manual encadernado, sacola, painel fotográfico e roll-up.', 'Submarcas & Formação', 'documentos-institucionais')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/kit-formacao-academy.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/kit-formacao-academy.jpg') }}"
                                         alt="Kit de Identidade para Formação, Certificados, Crachás e Roll-ups"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">05 • Academias &amp; Congressos</span>
                                <h4 class="rprint-brand-app-title">Kits de Formação, Diplomas &amp; Crachás</h4>
                                <p class="rprint-brand-app-desc">Certificados com selo metálico, credenciais PVC, manuais técnicos, sacolas e roll-ups institucionais.</p>
                            </div>
                        </div>

                        <!-- Prancha 6: Stands & Feiras -->
                        <div class="rprint-brand-app-card"
                             role="button"
                             tabindex="0"
                             @click="openModal(@js(asset('images/portfolio-print/stands-cenografia-eventos.jpg')), 'Stands Modulares, Expositores & Feiras de Negócios', 'Projecto cenográfico e produção de stands para feiras e exposições, combinando estrutura iluminada, balcão com QR Code e comunicação por unidade de negócio.', 'Feiras & Exposições', 'grafica-eventos')"
                             @keydown.enter="openModal(@js(asset('images/portfolio-print/stands-cenografia-eventos.jpg')), 'Stands Modulares, Expositores & Feiras de Negócios', 'Projecto cenográfico e produção de stands para feiras e exposições, combinando estrutura iluminada, balcão com QR Code e comunicação por unidade de negócio.', 'Feiras & Exposições', 'grafica-eventos')">
                            <div class="rprint-brand-app-media">
                                <picture>
                                    <source srcset="{{ asset('images/portfolio-print/stands-cenografia-eventos.webp') }}" type="image/webp">
                                    <img src="{{ asset('images/portfolio-print/stands-cenografia-eventos.jpg') }}"
                                         alt="Stands Corporativos, Balcões e Cenografia para Feiras"
                                         loading="lazy">
                                </picture>
                            </div>
                            <div class="rprint-brand-app-body">
                                <span class="rprint-brand-app-kicker">06 • Feiras &amp; Cimeiras</span>
                                <h4 class="rprint-brand-app-title">Stands Corporativos &amp; Cenografia</h4>
                                <p class="rprint-brand-app-desc">Arquitectura promocional, balcões de atendimento, painéis retroiluminados e expositores portáteis.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Faixa Técnica: Acabamentos Especiais & Tecnologias Gráficas -->
                    <div class="rprint-finishes-box">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <div>
                                <div class="text-xs font-extrabold uppercase tracking-wider text-amber-600 dark:text-amber-400">Acabamentos Nobres &amp; Parque Tecnológico</div>
                                <div class="text-sm sm:text-base font-bold text-slate-900 dark:text-white mt-0.5">Tecnologias de impressão, corte e personalização disponíveis na RACHI Print</div>
                            </div>
                        </div>
                        <div class="rprint-finishes-list">
                            <span class="rprint-finish-pill"><i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-500"></i> Laminação Soft-Touch (Toque Aveludado)</span>
                            <span class="rprint-finish-pill"><i data-lucide="sun" class="w-3.5 h-3.5 text-amber-500"></i> Verniz UV Localizado 3D</span>
                            <span class="rprint-finish-pill"><i data-lucide="award" class="w-3.5 h-3.5 text-amber-500"></i> Hot-Stamping Dourado &amp; Prateado</span>
                            <span class="rprint-finish-pill"><i data-lucide="stamp" class="w-3.5 h-3.5 text-amber-500"></i> Baixo-Relevo &amp; Corte Especial (Troquel)</span>
                            <span class="rprint-finish-pill"><i data-lucide="cpu" class="w-3.5 h-3.5 text-sky-500"></i> Gravação a Laser de Precisão</span>
                            <span class="rprint-finish-pill"><i data-lucide="shirt" class="w-3.5 h-3.5 text-sky-500"></i> Bordado Computadorizado &amp; DTF Têxtil</span>
                            <span class="rprint-finish-pill"><i data-lucide="box" class="w-3.5 h-3.5 text-emerald-500"></i> Recorte CNC, Acrílico &amp; Letras 3D LED</span>
                            <span class="rprint-finish-pill"><i data-lucide="printer" class="w-3.5 h-3.5 text-emerald-500"></i> Impressão Offset, Digital HD &amp; UV Grande Formato</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 3. PORTFÓLIO — Trabalhos realizados (Pasta Oficial)          -->
        <!-- ============================================================ -->
        @php
            $portfolioDir = public_path('images/banner/trabalho realizado');
            $curatedMeta = [
                'WhatsApp Image 2026-10-14 at 12.35.36.jpeg' => [
                    'order' => 1,
                    'title' => 'Kits Institucionais & Brindes Personalizados',
                    'tag' => 'Brindes & Instituições',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Garrafas térmicas em inox, canecas sublimadas e sacolas personalizadas produzidas para instituições públicas e empresas parceiras.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.05.jpeg' => [
                    'order' => 2,
                    'title' => 'Kit Executivo: Agenda, Caneca & Esferográfica',
                    'tag' => 'Kits Personalizados',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Conjunto institucional personalizado sob medida composto por agenda executiva com gravação dourada, caneca de cerâmica e esferográfica.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.24.jpeg' => [
                    'order' => 3,
                    'title' => 'Crachá Executivo Dourado Magnético',
                    'tag' => 'Identificação Corporativa',
                    'slug' => 'producao-grafica-corporativa',
                    'desc' => 'Crachá executivo personalizado com acabamento dourado escovado e fixação magnética dupla de alta segurança.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.27.jpeg' => [
                    'order' => 4,
                    'title' => 'Pins & Bottons Corporativos Personalizados',
                    'tag' => 'Eventos & Identificação',
                    'slug' => 'grafica-eventos',
                    'desc' => 'Bottons e pins metálicos personalizados com acabamento brilhante resistente para atendimento ao cliente, eventos e equipas.',
                ],
                'WhatsApp Image 2026-10-14 at 12.32.54.jpeg' => [
                    'order' => 5,
                    'title' => 'Agenda em Cortiça Gravada & Caneca VIP',
                    'tag' => 'Linha Eco & Executiva',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Caderno ecológico revestido em cortiça natural personalizado combinando com caneca sublimada de alta resolução.',
                ],
                'WhatsApp Image 2026-10-14 at 12.34.33.jpeg' => [
                    'order' => 6,
                    'title' => 'Kit Corporativo: Garrafa, Caneca, Sacola & Caneta',
                    'tag' => 'Kit Boas-Vindas',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Conjunto institucional completo com garrafa térmica branca, caneca corporativa, sacola personalizada e esferográfica.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.02.jpeg' => [
                    'order' => 7,
                    'title' => 'Canecas Institucionais para Campanhas',
                    'tag' => 'Personalização em Cerâmica',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Impressão de alta definição frente e verso em canecas de porcelana para campanhas institucionais e acções sociais.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.10.jpeg' => [
                    'order' => 8,
                    'title' => 'Agenda Institucional com Gravação Dourada',
                    'tag' => 'Papelaria & Agendas',
                    'slug' => 'documentos-institucionais',
                    'desc' => 'Personalização elegante de agendas anuais e cadernos executivos com acabamento dourado para lideranças e instituições.',
                ],
                'WhatsApp Image 2026-10-14 at 12.36.14.jpeg' => [
                    'order' => 9,
                    'title' => 'Estampagem Têxtil DTF de Alta Definição',
                    'tag' => 'Vestuário & DTF',
                    'slug' => 'vestuario-bordados-textil',
                    'desc' => 'Estampagem têxtil colorida de alta durabilidade e cores vibrantes sobre t-shirt preta 100% algodão com tecnologia DTF.',
                ],
                'WhatsApp Image 2026-10-14 at 12.35.27.jpeg' => [
                    'order' => 10,
                    'title' => 'Linha Corporativa de Garrafas, Canecas & Sacolas',
                    'tag' => 'Brindes Corporativos',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Produção em série de garrafas térmicas inox em diversas cores, canecas corporativas e sacolas institucionais.',
                ],
                'WhatsApp Image 2026-10-14 at 12.38.52.jpeg' => [
                    'order' => 11,
                    'title' => 'Canecas Personalizadas para Eventos & Causas',
                    'tag' => 'Brindes Promocionais',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Canecas personalizadas com fidelidade cromática para campanhas de sensibilização, eventos e datas comemorativas.',
                ],
                'WhatsApp Image 2026-10-14 at 12.35.58.jpeg' => [
                    'order' => 12,
                    'title' => 'T-Shirt Branca Personalizada em Alta Resolução',
                    'tag' => 'Estampagem Têxtil',
                    'slug' => 'vestuario-bordados-textil',
                    'desc' => 'Impressão têxtil policromática com contornos precisos e elevada resistência à lavagem em malha de algodão.',
                ],
                'WhatsApp Image 2026-10-14 at 12.34.06.jpeg' => [
                    'order' => 13,
                    'title' => 'Brindes para Administração Pública & Empresas',
                    'tag' => 'Brindes Institucionais',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Garrafas térmicas metálicas, canecas institucionais e sacolas personalizadas entregues a entidades públicas e privadas.',
                ],
                'WhatsApp Image 2026-10-14 at 12.38.43.jpeg' => [
                    'order' => 14,
                    'title' => 'Canecas Comemorativas Frente e Verso',
                    'tag' => 'Personalização em Porcelana',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Canecas brancas de cerâmica personalizadas frente e verso com emblemas e logótipos de programas institucionais.',
                ],
                'WhatsApp Image 2026-10-14 at 12.36.28.jpeg' => [
                    'order' => 15,
                    'title' => 'T-Shirt Mescla com Estampagem Colorida',
                    'tag' => 'Têxtil Personalizado',
                    'slug' => 'vestuario-bordados-textil',
                    'desc' => 'Aplicação térmica de alta definição sobre tecido cinzento mescla com toque macio e cores intensas.',
                ],
                'WhatsApp Image 2026-10-14 at 12.35.39.jpeg' => [
                    'order' => 16,
                    'title' => 'Conjunto Garrafa Térmica & Caneca Corporativa',
                    'tag' => 'Personalização Corporativa',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Dupla executiva de garrafa térmica branca e caneca em cerâmica com aplicação nítida das cores oficiais da marca.',
                ],
                'WhatsApp Image 2026-10-14 at 12.39.07.jpeg' => [
                    'order' => 17,
                    'title' => 'Caneca Institucional de Homenagem',
                    'tag' => 'Personalização Institucional',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Caneca personalizada com dedicatória institucional, brasão oficial e acabamento vitrificado de alto brilho.',
                ],
                'WhatsApp Image 2026-10-14 at 12.36.16.jpeg' => [
                    'order' => 18,
                    'title' => 'Estampagem Monocromática de Traço Fino',
                    'tag' => 'Serigrafia & DTF',
                    'slug' => 'vestuario-bordados-textil',
                    'desc' => 'Estampagem têxtil de linhas finas de alto contraste em t-shirt de algodão cinzenta.',
                ],
                'WhatsApp Image 2026-10-14 at 12.34.19.jpeg' => [
                    'order' => 19,
                    'title' => 'Garrafas Térmicas Vermelha e Branca & Canecas',
                    'tag' => 'Brindes & Kits',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Personalização coordenada em garrafas térmicas metálicas coloridas, canecas sublimadas e sacolas de apresentação.',
                ],
                'WhatsApp Image 2026-10-14 at 12.38.34.jpeg' => [
                    'order' => 20,
                    'title' => 'Kit Corporativo com Garrafas & Esferográficas',
                    'tag' => 'Kits Corporativos',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Lote de kits promocionais compostos por garrafas térmicas personalizadas, sacolas e canetas institucionais.',
                ],
                'WhatsApp Image 2026-10-14 at 12.36.48.jpeg' => [
                    'order' => 21,
                    'title' => 'Garrafas Térmicas Personalizadas Multimarcas',
                    'tag' => 'Gravação Durável',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Acabamento resistente em garrafas térmicas de parede dupla personalizadas para empresas e clientes.',
                ],
                'WhatsApp Image 2026-10-14 at 12.35.45.jpeg' => [
                    'order' => 22,
                    'title' => 'Mostruário de Produção de Brindes & Kits',
                    'tag' => 'Brindes & Activação',
                    'slug' => 'materiais-promocionais',
                    'desc' => 'Diversidade de garrafas térmicas, canecas e sacolas produzidas nas oficinas da RACHI Print.',
                ],
            ];

            $portfolioItems = [];
            $seenHashes = [];
            if (is_dir($portfolioDir)) {
                $rawFiles = scandir($portfolioDir) ?: [];
                foreach ($rawFiles as $fName) {
                    if ($fName === '.' || $fName === '..') continue;
                    $ext = strtolower(pathinfo($fName, PATHINFO_EXTENSION));
                    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) continue;
                    $fullPath = $portfolioDir . DIRECTORY_SEPARATOR . $fName;
                    if (!is_file($fullPath)) continue;

                    $hash = @md5_file($fullPath) ?: $fName;
                    if (isset($seenHashes[$hash])) continue;
                    $seenHashes[$hash] = true;

                    $ver = @filemtime($fullPath) ?: 1;
                    $meta = $curatedMeta[$fName] ?? [
                        'order' => 100,
                        'title' => 'Trabalho Realizado — RACHI Print',
                        'tag' => 'Produção RACHI Print',
                        'slug' => 'materiais-promocionais',
                        'desc' => 'Projecto gráfico e personalização produzidos nas oficinas da RACHI Print com rigor cromático e acabamento profissional.',
                    ];

                    $portfolioItems[] = [
                        'url' => '/images/banner/trabalho%20realizado/' . rawurlencode($fName) . '?v=' . $ver,
                        'order' => $meta['order'],
                        'title' => $meta['title'],
                        'tag' => $meta['tag'],
                        'slug' => $meta['slug'],
                        'desc' => $meta['desc'],
                    ];
                }
                usort($portfolioItems, fn($a, $b) => $a['order'] <=> $b['order']);
            }
        @endphp

        <section id="portfolio-print" class="rprint-portfolio-section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="rprint-sec-header">
                    <span class="rprint-pill">Portfólio</span>
                    <h2 class="rprint-sec-title">
                        Trabalhos <span class="rprint-gradient-text">realizados</span>
                    </h2>
                    <p class="rprint-sec-sub">
                        Explore os {{ count($portfolioItems) }} trabalhos reais produzidos na RACHI Print e inspire-se para o seu próximo projecto.
                    </p>
                </div>

                <div class="rprint-portfolio-grid">
                    @foreach($portfolioItems as $idx => $item)
                        <div class="rprint-portfolio-item"
                             @if($idx >= 6) x-show="showAllPortfolio" x-cloak x-transition.opacity.duration.300ms @endif
                             role="button"
                             tabindex="0"
                             @click="openModal(@js($item['url']), @js($item['title']), @js($item['desc']), @js($item['tag']), @js($item['slug']))"
                             @keydown.enter="openModal(@js($item['url']), @js($item['title']), @js($item['desc']), @js($item['tag']), @js($item['slug']))">
                            <img src="{{ $item['url'] }}"
                                 alt="{{ $item['title'] }}"
                                 loading="lazy">
                            <div class="rprint-portfolio-caption">
                                <span class="rprint-portfolio-tag">{{ $item['tag'] }}</span>
                                <h3 class="rprint-portfolio-title">{{ $item['title'] }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(count($portfolioItems) > 6)
                    <div class="mt-10 text-center">
                        <button type="button"
                                @click="showAllPortfolio = !showAllPortfolio; if (!showAllPortfolio) { document.getElementById('portfolio-print')?.scrollIntoView({ behavior: 'smooth', block: 'start' }); } $nextTick(() => { if (window.lucide) window.lucide.createIcons(); })"
                                class="rprint-btn-outline">
                            <span x-text="showAllPortfolio ? 'Ocultar trabalhos' : 'Mostrar mais trabalhos ({{ count($portfolioItems) - 6 }} restantes)'">
                                Mostrar mais trabalhos ({{ count($portfolioItems) - 6 }} restantes)
                            </span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :style="showAllPortfolio ? 'transform: rotate(180deg);' : ''"></i>
                        </button>
                    </div>
                @endif
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- 4. CALL TO ACTION — Pronto para transformar as suas ideias?  -->
        <!-- ============================================================ -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 my-20 sm:my-24">
            <div class="rprint-cta-card">
                <div class="rprint-cta-glow" aria-hidden="true"></div>
                <div class="rprint-cta-inner">
                    <h2 class="rprint-cta-title">
                        Pronto para transformar as suas <span class="rprint-gradient-text">ideias em realidade</span>?
                    </h2>
                    <p class="rprint-cta-sub">
                        Entre em contacto connosco e descubra como a RACHI Print pode desenvolver a sua identidade visual, branding, brindes, sinalética e produção gráfica.
                    </p>
                    <div class="rprint-cta-actions">
                        <button type="button"
                                onclick="window.rachiOpenQuoteModal('Orçamento Personalizado — RACHI Print', 'RACHI Print', ''); return false;"
                                class="rprint-btn-gradient">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            <span>Pedir Orçamento</span>
                        </button>
                        <a href="tel:+244972888585"
                           class="rprint-btn-outline">
                            <i data-lucide="phone" class="w-4 h-4"></i>
                            <span>Ligar Agora</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Product Preview Modal (Alpine Lightbox) -->
        <div x-show="activeModalImage" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @keydown.escape.window="closeModal()"
             class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md"
             style="display: none;">
            
            <div class="fixed inset-0" @click="closeModal()"></div>

            <div class="relative w-full max-w-3xl bg-white dark:bg-[#0c192c] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden z-10"
                 @click.stop>
                
                <!-- Close Button -->
                <button @click="closeModal()" 
                        class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition shadow-lg">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>

                <!-- Modal Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Image container with subtle dark background -->
                    <div class="relative bg-gradient-to-b from-slate-900 via-[#0a1424] to-[#060c18] flex items-center justify-center p-8 min-h-[300px] md:min-h-[420px] max-h-[500px] overflow-hidden">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,rgba(245,168,0,0.14),transparent_65%)] pointer-events-none"></div>
                        <img :src="activeModalImage" :alt="activeModalTitle" class="relative z-10 max-h-[420px] w-auto max-w-full object-contain filter drop-shadow-[0_20px_35px_rgba(0,0,0,0.7)] transition-transform duration-300">
                    </div>

                    <!-- Product Details -->
                    <div class="p-6 sm:p-8 flex flex-col justify-between">
                        <div>
                            <div class="inline-block text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-amber-500/10 text-amber-500 border border-amber-500/20 mb-3"
                                 x-text="activeModalTag">
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-white leading-tight" 
                                x-text="activeModalTitle">
                            </h3>
                            <p class="mt-4 text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed font-normal" 
                               x-text="activeModalDesc">
                            </p>
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex flex-col gap-3">
                            <button type="button"
                                    @click="closeModal(); openQuoteModal(activeModalTitle, activeModalTag, activeModalSlug)"
                                    class="w-full py-3 px-5 rounded-xl bg-slate-900 hover:bg-[#f5a800] hover:text-[#080c16] text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-lg cursor-pointer">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>Solicitar Cotação deste Produto</span>
                            </button>
                            <a :href="'https://wa.me/244972888585?text=' + encodeURIComponent('Olá! Gostaria de solicitar cotação para o produto: ' + activeModalTitle + ' da RACHI Print.')"
                               target="_blank"
                               class="w-full py-3 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-600/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Pedir Cotação via WhatsApp</span>
                            </a>
                            <template x-if="activeModalSlug">
                                <a :href="'/print/servicos/' + activeModalSlug + '?produto=' + encodeURIComponent(activeModalTitle)"
                                   class="w-full py-3 px-5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition text-decoration-none">
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    <span>Abrir Página da Linha &amp; Cotação</span>
                                </a>
                            </template>
                            <button @click="closeModal()" 
                                    class="w-full py-2.5 px-4 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold transition cursor-pointer">
                                Fechar Visualização
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- MODAL FORMULÁRIO DE COTAÇÃO (SALVA NO BANCO & ADMIN)          -->
        <!-- ============================================================ -->
        <div x-show="showQuoteModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 flex items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md overflow-y-auto"
             id="rachi-quote-modal"
             style="z-index: 99999;"
             @click.self="closeQuoteModal()"
             @keydown.escape.window="closeQuoteModal()"
             x-cloak>

            <div x-show="showQuoteModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-2xl bg-white dark:bg-[#0c1322] rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden my-8 z-20">

                <!-- Botão Fechar -->
                <button type="button"
                        @click="closeQuoteModal()"
                        onclick="window.rachiCloseQuoteModal(); return false;"
                        class="absolute top-4 right-4 z-20 w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center transition cursor-pointer">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>

                <!-- Estado 1: Formulário de Solicitação -->
                <div x-show="!quoteSuccess" id="quote-modal-form-content" class="p-6 sm:p-8">
                    <!-- Header do Modal -->
                    <div class="mb-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-[#f5a800] text-xs font-bold uppercase tracking-wider mb-2">
                            <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                            <span>RACHI Print • Cotação Oficial</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                            Solicitar Cotação Gráfica
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">
                            Preencha as informações do solicitante. A sua solicitação será registada no sistema e a equipa comercial responderá com a proforma oficial em até 2 horas úteis.
                        </p>

                        <!-- Item Selecionado -->
                        <div class="mt-4 p-3 rounded-xl bg-amber-500/10 border border-amber-500/25 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-500 text-slate-950 flex items-center justify-center shrink-0 font-bold">
                                <i data-lucide="package" class="w-4 h-4"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-[10px] uppercase font-bold text-amber-600 dark:text-amber-400 tracking-wider">Item Selecionado</div>
                                <div class="text-xs font-bold text-slate-900 dark:text-white truncate" id="modal-quote-product-display" x-text="quoteProduct"></div>
                            </div>
                        </div>
                        <input type="hidden" id="modal-quote-product-input" name="produto">
                        <input type="hidden" id="modal-quote-line-input" name="linha">
                        <input type="hidden" id="modal-quote-slug-input" name="service_slug">
                    </div>

                    <!-- Mensagem de Erro (se houver) -->
                    <div x-show="quoteErrorMsg" 
                         x-transition 
                         class="mb-4 p-3.5 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 text-xs flex items-start gap-2.5">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5 text-rose-500"></i>
                        <span x-text="quoteErrorMsg"></span>
                    </div>

                    <!-- Formulário -->
                    <form id="rachi-quote-form" @submit.prevent="submitQuote()" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nome Completo -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    Nome do Solicitante <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" 
                                       x-model="quoteForm.name" 
                                       required 
                                       placeholder="Ex: Dr. António Silva"
                                       class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            </div>

                            <!-- Empresa / Instituição -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    Empresa / Instituição
                                </label>
                                <input type="text" 
                                       x-model="quoteForm.empresa" 
                                       placeholder="Ex: Banco / Empresa LDA"
                                       class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Telefone / WhatsApp -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    Telefone / WhatsApp <span class="text-rose-500">*</span>
                                </label>
                                <input type="tel" 
                                       x-model="quoteForm.phone" 
                                       required 
                                       placeholder="Ex: +244 972 888 585"
                                       class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            </div>

                            <!-- E-mail -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    E-mail Corporativo <span class="text-rose-500">*</span>
                                </label>
                                <input type="email" 
                                       x-model="quoteForm.email" 
                                       required 
                                       placeholder="comercial@empresa.co.ao"
                                       class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Quantidade Estimada -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    Quantidade / Tiragem Estimada
                                </label>
                                <input type="text" 
                                       x-model="quoteForm.quantidade" 
                                       placeholder="Ex: 50 un / 500 exemplares / 10 m²"
                                       class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            </div>

                            <!-- Prazo Desejado -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                    Prazo de Entrega Desejado
                                </label>
                                <select x-model="quoteForm.prazo"
                                        class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                                    <option value="padrao">Prazo Normal (3 a 5 dias úteis)</option>
                                    <option value="urgente">Urgência Expresso (24h a 48h úteis)</option>
                                    <option value="programado">Entrega Programada (Evento futuro)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Especificações / Mensagem -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5">
                                Especificações &amp; Requisitos Adicionais
                            </label>
                            <textarea x-model="quoteForm.message" 
                                      rows="3" 
                                      placeholder="Descreva detalhes específicos, dimensões personalizadas, tipos de acabamento (bainha, ilhós, laminação mate/brilho, gramagem, etc.)..."
                                      class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
                        </div>

                        <!-- Ações do Formulário -->
                        <div class="pt-2 flex flex-col sm:flex-row items-center justify-between gap-3">
                            <div class="text-[11px] text-slate-500 dark:text-slate-400 flex items-center gap-1.5">
                                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500"></i>
                                <span>Salvo de imediato no sistema RACHI</span>
                            </div>

                            <div class="flex items-center gap-2.5 w-full sm:w-auto">
                                <button type="button" 
                                        @click="closeQuoteModal()" 
                                        class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold transition cursor-pointer">
                                    Cancelar
                                </button>
                                
                                <button type="submit" 
                                        :disabled="quoteSubmitting"
                                        class="flex-1 sm:flex-none px-6 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs flex items-center justify-center gap-2 transition shadow-md shadow-amber-500/20 disabled:opacity-50 cursor-pointer">
                                    <template x-if="quoteSubmitting">
                                        <svg class="animate-spin h-3.5 w-3.5 text-slate-950" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                        </svg>
                                    </template>
                                    <template x-if="!quoteSubmitting">
                                        <i data-lucide="send" class="w-3.5 h-3.5"></i>
                                    </template>
                                    <span x-text="quoteSubmitting ? 'A enviar solicitação...' : 'Confirmar e Enviar Pedido'"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Estado 2: Sucesso com Protocolo -->
                <div x-show="quoteSuccess" id="quote-modal-success-content" class="p-8 text-center" x-cloak>
                    <div class="w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-500 mx-auto flex items-center justify-center mb-4">
                        <i data-lucide="check-circle-2" class="w-8 h-8"></i>
                    </div>

                    <span class="inline-block text-[10px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 mb-2">
                        Solicitação Registada no Sistema
                    </span>

                    <h3 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">
                        Cotação Enviada com Sucesso!
                    </h3>

                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-md mx-auto">
                        O seu pedido de cotação para <strong class="text-slate-900 dark:text-white" id="quote-success-product-display" x-text="quoteProduct"></strong> foi enviado para o departamento de produção e já está disponível em <strong class="text-amber-500">Solicitações &amp; Ordens</strong> da administração.
                    </p>

                    <!-- Box de Protocolo -->
                    <div class="my-6 p-4 rounded-2xl bg-slate-50 dark:bg-slate-900/80 border border-slate-200 dark:border-slate-800 max-w-sm mx-auto">
                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
                            Número de Protocolo Oficial
                        </div>
                        <div class="text-xl sm:text-2xl font-black text-[#f5a800] tracking-wider font-mono select-all" id="quote-protocol-display" x-text="quoteProtocol"></div>
                        <div class="text-[11px] text-slate-500 mt-1">Guarde este código para acompanhamento do seu pedido</div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 max-w-md mx-auto pt-2">
                        <a :href="'https://wa.me/244972888585?text=' + encodeURIComponent('Olá! Acabei de submeter uma solicitação de cotação para ' + quoteProduct + ' com o Protocolo ' + quoteProtocol + '. Poderiam confirmar a recepção?')"
                           target="_blank"
                           class="w-full sm:w-auto px-5 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-600/20">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                            <span>Acompanhar via WhatsApp</span>
                        </a>

                        <button type="button"
                                @click="closeQuoteModal()"
                                onclick="window.rachiCloseQuoteModal(); return false;"
                                class="w-full sm:w-auto px-5 py-3 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold transition cursor-pointer">
                            Concluir &amp; Fechar
                        </button>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <!-- ============================================================ -->
    <!-- FOOTER                                                       -->
    <!-- ============================================================ -->
    <!-- ============================================================ -->
    <!-- FOOTER                                                       -->
    <!-- ============================================================ -->
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <!-- Footer Logo Oficial RACHI Print -->
                    <a href="/print" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                            <img src="/images/areas/rachi-print.png" 
                                 onerror="this.onerror=null; this.src='/images/areas/rachi-print.png'" 
                                 alt="RACHI Print" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(245,168,0,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-slate-900 dark:text-white">RACHI <span class="text-[#f5a800]">Print</span></span>
                    </a>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Gráfica digital, impressão offset, merchandising e produção corporativa premium com acabamento industrial nobre.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#d97706] dark:text-[#f5a800] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-emerald-400 transition">RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition">RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition text-[#d97706] dark:text-[#f5a800] font-bold">RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#d97706] dark:text-[#f5a800] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/" class="hover:text-slate-900 dark:hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="/print#catalogo" class="hover:text-slate-900 dark:hover:text-white transition">Catálogo de Produtos</a></li>
                        <li><a href="/#sobre" class="hover:text-slate-900 dark:hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contacto &amp; Propostas</a></li>
                        <li><a href="/reclamacoes-e-denuncia" class="hover:text-slate-900 dark:hover:text-white transition">Reclamações e Denúncia</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#d97706] dark:text-[#f5a800] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Produção sob encomenda e entregas em todo o país.</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 dark:text-slate-400 gap-4">
                <div>&copy; {{ date('Y') }} <strong class="text-slate-900 dark:text-white">RACHI Print</strong>. Todos os direitos reservados.</div>
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

    <!-- Bottom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
