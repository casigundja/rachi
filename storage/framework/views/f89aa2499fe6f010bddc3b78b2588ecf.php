<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja RACHI Tec — Informática, Equipamentos &amp; Tecnologia em Angola</title>
    <meta name="description" content="A sua loja online de informática, consumíveis, computadores e tecnologia corporativa em Angola. Compre com entrega rápida em Luanda e garantia oficial.">
    <link rel="canonical" href="https://rachi.ao/loja">

    <!-- Open Graph -->
    <meta property="og:title" content="Loja RACHI Tec — Informática, Equipamentos & Tecnologia">
    <meta property="og:description" content="Laptops, cabos, smartwatches, TV Box e periféricos corporativos com entrega garantida e faturação em Luanda.">
    <meta property="og:url" content="https://rachi.ao/loja">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    <link rel="shortcut icon" href="/images/logo-rachi-light.png">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

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
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        rachi: {
                            gold: '#f5a800',       // Amarelo padrão oficial RACHI
                            goldDark: '#d59b2d',   // Amarelo escuro / hover
                            goldLight: '#fef3c7',  // Fundo suave amarelo
                            navy: '#071326',       // Azul marinho profundo institucional RACHI
                            navyLight: '#0d1f3d',  // Marinho médio
                            navyBorder: '#1a2f52', // Borda sutil marinho
                            blue: '#00a3e0',       // Azul ciano RACHI
                            darkText: '#071326',
                        },
                        boti: {
                            dark: '#071326',       // Marinho Oficial RACHI
                            green: '#f5a800',      // Amarelo Oficial RACHI
                            lightGreen: '#e09900', // Amarelo de ação / botão
                            accent: '#00a3e0',     // Azul assinatura RACHI Tec
                            gold: '#f5a800',       // Dourado/Amarelo RACHI
                            amber: '#f5a800',
                            rose: '#f43f5e',
                            bgLight: '#f7f8fa',
                            cardBg: '#ffffff',
                            border: '#e8ecef',
                        }
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
    <link rel="stylesheet" href="/css/site.css?v=<?php echo e(time()); ?>">

    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        section[id], div[id] { scroll-margin-top: 130px; }

        body {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* CARD PRODUTO ESTILO BOTICÁRIO */
        .boti-card {
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease, border-color 0.25s ease;
        }
        .boti-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -8px rgba(245, 168, 0, 0.22);
            border-color: #f5a800;
        }

        /* BOTÃO COMPRAR ESTILO BOTICÁRIO */
        .btn-comprar {
            background-color: #f5a800;
            color: #071326;
            font-weight: 900;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(213, 155, 45, 0.3);
        }
        .btn-comprar:hover {
            background-color: #e09900;
            color: #071326;
            transform: scale(1.02);
            box-shadow: 0 8px 20px -4px rgba(245, 168, 0, 0.5);
        }

        /* CATEGORIAS EM BOLHAS (CIRCULAR SHELVES ESTILO BOTICÁRIO) */
        .bubble-item {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .bubble-item:hover .bubble-circle {
            transform: translateY(-4px) scale(1.04);
            box-shadow: 0 12px 24px -6px rgba(245, 168, 0, 0.28);
        }
        .bubble-circle {
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ROLAGEM AMIGÁVEL & MODERNA */
        html {
            scroll-behavior: smooth;
        }

        /* Barra de rolagem global elegante, sutil e arredondada */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
            border: 2px solid #f1f5f9;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Ocultar barra de rolagem onde o design pede visual limpo e fluido */
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
        /* TOAST PROGRESS BAR ANIMATION */
        @keyframes toastProgress {
            from { width: 100%; }
            to { width: 0%; }
        }
        .toast-progress {
            animation: toastProgress linear forwards;
        }

        /* ============================================================ */
        /* LUXURY DARK MODE STYLES FOR RACHI TEC STORE                  */
        /* ============================================================ */
        html.dark body {
            background-color: #040b17 !important;
            color: #cbd5e1 !important;
        }

        /* 1. HERO CAROUSEL DARK MODE (HP ELITEBOOK, REVENDEDOR, CABOS) */
        html.dark section.boti-hero-carousel,
        html.dark section.bg-\[\#f3f4f6\] {
            background: radial-gradient(circle at 82% 25%, rgba(245, 168, 0, 0.12), transparent 48%),
                        radial-gradient(circle at 18% 75%, rgba(0, 163, 224, 0.10), transparent 45%),
                        linear-gradient(180deg, #061122 0%, #030814 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        /* Hero Text & Headings */
        html.dark section.boti-hero-carousel h1,
        html.dark section.boti-hero-carousel h2,
        html.dark section.bg-\[\#f3f4f6\] h1,
        html.dark section.bg-\[\#f3f4f6\] h2 {
            color: #ffffff !important;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.55);
        }

        html.dark section.boti-hero-carousel p,
        html.dark section.bg-\[\#f3f4f6\] p {
            color: #cbd5e1 !important;
        }

        html.dark section.boti-hero-carousel strong,
        html.dark section.bg-\[\#f3f4f6\] strong {
            color: #ffffff !important;
        }

        /* Hero Badges */
        html.dark section.boti-hero-carousel span.bg-amber-100,
        html.dark section.bg-\[\#f3f4f6\] span.bg-amber-100 {
            background: rgba(245, 168, 0, 0.18) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
        }

        html.dark section.boti-hero-carousel span.bg-teal-100,
        html.dark section.bg-\[\#f3f4f6\] span.bg-teal-100 {
            background: rgba(16, 185, 129, 0.18) !important;
            color: #34d399 !important;
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
        }

        /* Hero CTA Buttons (Golden Luxury Pill) */
        html.dark section.boti-hero-carousel a[class*="bg-white"],
        html.dark section.boti-hero-carousel button[class*="bg-white"],
        html.dark section.bg-\[\#f3f4f6\] a[class*="bg-white"],
        html.dark section.bg-\[\#f3f4f6\] button[class*="bg-white"] {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%) !important;
            color: #071326 !important;
            font-weight: 900 !important;
            border: 1px solid #f5a800 !important;
            box-shadow: 0 8px 24px -4px rgba(245, 168, 0, 0.45) !important;
        }

        html.dark section.boti-hero-carousel a[class*="bg-white"]:hover,
        html.dark section.boti-hero-carousel button[class*="bg-white"]:hover,
        html.dark section.bg-\[\#f3f4f6\] a[class*="bg-white"]:hover,
        html.dark section.bg-\[\#f3f4f6\] button[class*="bg-white"]:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f5a800 100%) !important;
            box-shadow: 0 12px 28px -2px rgba(245, 168, 0, 0.65) !important;
            transform: scale(1.05) !important;
            color: #071326 !important;
        }

        /* Hero Image Card Showcase on Right */
        html.dark section.boti-hero-carousel .relative.z-10.p-6.bg-white,
        html.dark section.bg-\[\#f3f4f6\] .relative.z-10.p-6.bg-white {
            background: linear-gradient(145deg, rgba(14, 34, 68, 0.95) 0%, rgba(6, 17, 36, 0.98) 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.8), 0 0 30px rgba(245, 168, 0, 0.12), inset 0 1px 0 rgba(255, 255, 255, 0.12) !important;
        }

        html.dark section.boti-hero-carousel .relative.z-10.rounded-2xl.border-4.border-white,
        html.dark section.bg-\[\#f3f4f6\] .relative.z-10.rounded-2xl.border-4.border-white {
            border-color: rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 24px 50px -10px rgba(0, 0, 0, 0.8) !important;
        }

        /* Decorative squares */
        html.dark section.boti-hero-carousel .pointer-events-none,
        html.dark section.bg-\[\#f3f4f6\] .pointer-events-none {
            opacity: 0.3 !important;
        }

        /* Hero Arrow Controls (< and >) */
        html.dark section.boti-hero-carousel > button,
        html.dark section.bg-\[\#f3f4f6\] > button {
            background: rgba(13, 31, 61, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.16) !important;
            color: #ffffff !important;
            backdrop-filter: blur(10px) !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5) !important;
        }

        html.dark section.boti-hero-carousel > button svg,
        html.dark section.bg-\[\#f3f4f6\] > button svg {
            color: #f5a800 !important;
        }

        html.dark section.boti-hero-carousel > button:hover,
        html.dark section.bg-\[\#f3f4f6\] > button:hover {
            background: #f5a800 !important;
            border-color: #f5a800 !important;
            box-shadow: 0 0 20px rgba(245, 168, 0, 0.5) !important;
        }

        html.dark section.boti-hero-carousel > button:hover svg,
        html.dark section.bg-\[\#f3f4f6\] > button:hover svg {
            color: #071326 !important;
        }

        /* Hero Dots */
        html.dark section.boti-hero-carousel .bg-slate-300,
        html.dark section.bg-\[\#f3f4f6\] .bg-slate-300 {
            background-color: rgba(255, 255, 255, 0.22) !important;
        }
        html.dark section.boti-hero-carousel .bg-slate-300:hover,
        html.dark section.bg-\[\#f3f4f6\] .bg-slate-300:hover {
            background-color: rgba(255, 255, 255, 0.5) !important;
        }

        /* 2. CATEGORY BUBBLES SECTION */
        html.dark .bubble-item .bubble-circle {
            background: #0b1c38 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark .bubble-item:hover .bubble-circle {
            border-color: #f5a800 !important;
            box-shadow: 0 10px 24px -4px rgba(245, 168, 0, 0.35) !important;
        }
        html.dark .bubble-item span {
            color: #cbd5e1 !important;
        }
        html.dark .bubble-item:hover span {
            color: #f5a800 !important;
        }

        /* 3. 4 TRUST PILLARS */
        html.dark section.max-w-7xl > div.grid.grid-cols-2.lg\:grid-cols-4.bg-white {
            background: linear-gradient(145deg, rgba(12, 27, 54, 0.95) 0%, rgba(6, 16, 35, 0.98) 100%) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 14px 34px -8px rgba(0, 0, 0, 0.6) !important;
        }
        html.dark section.max-w-7xl > div.grid.grid-cols-2.lg\:grid-cols-4 h4 {
            color: #ffffff !important;
        }
        html.dark section.max-w-7xl > div.grid.grid-cols-2.lg\:grid-cols-4 p {
            color: #94a3b8 !important;
        }

        /* 4. PRODUCT CARDS (BOTI-CARD) DARK MODE LUXURY UPGRADE */
        html.dark .boti-card {
            background: linear-gradient(160deg, #0d1e38 0%, #08152a 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 12px 32px -6px rgba(0, 0, 0, 0.65), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            border-radius: 1.5rem !important;
        }

        html.dark .boti-card:hover {
            border-color: rgba(245, 168, 0, 0.65) !important;
            box-shadow: 0 20px 48px -8px rgba(0, 0, 0, 0.85), 0 0 28px rgba(245, 168, 0, 0.28), inset 0 1px 0 rgba(255, 255, 255, 0.14) !important;
            transform: translateY(-4px) !important;
        }

        /* Product Image Showcase Pod in Dark Mode (Luxury Dark Glass Pedestal) */
        html.dark .boti-card .relative.bg-gradient-to-b {
            background: radial-gradient(circle at 50% 40%, rgba(255, 255, 255, 0.06) 0%, rgba(13, 30, 56, 0.6) 75%, rgba(8, 21, 42, 0.95) 100%) !important;
            border-radius: 1.25rem !important;
            margin: 0.75rem 0.75rem 0 0.75rem !important;
            height: 13.5rem !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 8px 24px -4px rgba(0, 0, 0, 0.5) !important;
        }

        html.dark .boti-card:hover .relative.bg-gradient-to-b {
            background: radial-gradient(circle at 50% 40%, rgba(245, 168, 0, 0.14) 0%, rgba(13, 30, 56, 0.75) 75%, rgba(8, 21, 42, 0.98) 100%) !important;
            border-color: rgba(245, 168, 0, 0.35) !important;
        }

        /* Floating 3D drop shadow on transparent product cutouts */
        html.dark .boti-card img {
            filter: drop-shadow(0 14px 20px rgba(0, 0, 0, 0.65)) drop-shadow(0 3px 6px rgba(0, 0, 0, 0.45)) !important;
        }

        /* Favorite button inside the pod in dark mode */
        html.dark .boti-card button[type="button"].bg-white\/90 {
            background: rgba(13, 30, 56, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.35) !important;
        }

        html.dark .boti-card button[type="button"].bg-white\/90 i {
            color: #cbd5e1 !important;
        }

        /* Category Pill (Golden Glow) */
        html.dark .boti-card .boti-cat-badge,
        html.dark .boti-card span.bg-amber-50 {
            background: rgba(245, 168, 0, 0.15) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
            font-weight: 800 !important;
        }

        /* Rating Badge (Frosted Pod) */
        html.dark .boti-card .boti-rating-badge,
        html.dark .boti-card div.bg-amber-50\/60 {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        html.dark .boti-card .boti-rating-badge span.text-slate-900,
        html.dark .boti-card div.bg-amber-50\/60 span.text-slate-900 {
            color: #ffffff !important;
            font-weight: 800 !important;
        }

        html.dark .boti-card .boti-rating-badge span.text-slate-400,
        html.dark .boti-card div.bg-amber-50\/60 span.text-slate-400 {
            color: #cbd5e1 !important;
        }

        /* Product Title */
        html.dark .boti-card h3 {
            color: #ffffff !important;
            font-weight: 800 !important;
            line-height: 1.35 !important;
        }

        html.dark .boti-card:hover h3 {
            color: #f5a800 !important;
        }

        /* Short Description */
        html.dark .boti-card p[x-text="p.shortDesc"] {
            color: #94a3b8 !important;
            line-height: 1.55 !important;
        }

        /* Card Divider */
        html.dark .boti-card .border-t {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Price Section */
        html.dark .boti-card strong.text-slate-950 {
            color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.45) !important;
            font-weight: 900 !important;
        }

        html.dark .boti-card span.text-slate-400.line-through {
            color: #64748b !important;
        }

        html.dark .boti-card span.text-slate-500 {
            color: #94a3b8 !important;
        }

        /* Stock Status Pill (Neon Emerald Glow) */
        html.dark .boti-card .boti-stock-badge,
        html.dark .boti-card div.bg-emerald-50 {
            background: rgba(16, 185, 129, 0.15) !important;
            color: #34d399 !important;
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
            box-shadow: 0 0 12px rgba(16, 185, 129, 0.15) !important;
            font-weight: 800 !important;
        }

        /* Buy Button (Golden CTA) */
        html.dark .boti-card button.btn-comprar {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%) !important;
            color: #071326 !important;
            font-weight: 900 !important;
            border: 1px solid #f5a800 !important;
            box-shadow: 0 4px 18px rgba(245, 168, 0, 0.4) !important;
        }

        html.dark .boti-card button.btn-comprar:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f5a800 100%) !important;
            box-shadow: 0 8px 26px rgba(245, 168, 0, 0.65) !important;
            transform: translateY(-1px) !important;
        }

        /* View Details Link */
        html.dark .boti-card button.hover\:text-amber-700 {
            color: #94a3b8 !important;
        }

        html.dark .boti-card button.hover\:text-amber-700:hover {
            color: #fbbf24 !important;
        }

        /* 5. CATALOG SORT & SEARCH BAR */
        html.dark #catalogo select,
        html.dark #catalogo input {
            background-color: #0c1a33 !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
        }
        html.dark #catalogo .border-b {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* 6. MODALS & SIDEBARS */
        html.dark .bg-white\/95.backdrop-blur-md,
        html.dark div[role="dialog"] .bg-white,
        html.dark .fixed .bg-white {
            background-color: #08162e !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            color: #e2e8f0 !important;
        }

        /* 6.1 TOP BAR DROPDOWNS (ECOSSISTEMA RACHI & ACESSIBILIDADE) IN DARK MODE */
        html.dark div[x-show="openGrupo"],
        html.dark div[x-show="openAcess"] {
            background: rgba(7, 19, 38, 0.98) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 24px 60px -10px rgba(0, 0, 0, 0.9), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            backdrop-filter: blur(24px) !important;
        }

        html.dark div[x-show="openGrupo"] .bg-slate-50\/80 {
            background: rgba(255, 255, 255, 0.04) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* 7. CONSULTATIVE B2B QUOTE BANNER (PRECISA DE COTAÇÃO EM LOTE) */
        html.dark .boti-quote-banner,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 {
            background: radial-gradient(circle at 88% 50%, rgba(245, 168, 0, 0.16), transparent 52%),
                        radial-gradient(circle at 12% 50%, rgba(0, 163, 224, 0.12), transparent 48%),
                        linear-gradient(135deg, #0d2246 0%, #061226 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
            box-shadow: 0 16px 42px -8px rgba(0, 0, 0, 0.75), 0 0 30px rgba(245, 168, 0, 0.12) !important;
        }

        html.dark .boti-quote-banner span.text-\[\#b45309\],
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 span.text-\[\#b45309\] {
            color: #fbbf24 !important;
            font-weight: 800 !important;
            letter-spacing: 0.12em !important;
        }

        html.dark .boti-quote-banner h3,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 h3 {
            color: #ffffff !important;
            font-weight: 900 !important;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.55) !important;
        }

        html.dark .boti-quote-banner p,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 p {
            color: #cbd5e1 !important;
        }

        html.dark .boti-quote-banner a,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 a {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%) !important;
            color: #071326 !important;
            font-weight: 900 !important;
            border: 1px solid #f5a800 !important;
            box-shadow: 0 8px 24px -4px rgba(245, 168, 0, 0.45) !important;
        }

        html.dark .boti-quote-banner a:hover,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 a:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f5a800 100%) !important;
            box-shadow: 0 12px 28px -2px rgba(245, 168, 0, 0.65) !important;
            transform: scale(1.05) !important;
            color: #071326 !important;
        }

        html.dark .boti-quote-banner a svg,
        html.dark .bg-gradient-to-r.from-amber-50.via-amber-100\/50.to-orange-50 a svg {
            color: #071326 !important;
        }

        /* 8. SLIDING CART DRAWER IN DARK MODE */
        html.dark .w-full.max-w-md.bg-white.h-full {
            background-color: #08162e !important;
            color: #e2e8f0 !important;
            border-left: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        html.dark .w-full.max-w-md.bg-white.h-full .bg-slate-50 {
            background-color: #061124 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark .w-full.max-w-md.bg-white.h-full .bg-white {
            background-color: #0d203f !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        html.dark .w-full.max-w-md.bg-white.h-full h3,
        html.dark .w-full.max-w-md.bg-white.h-full h4,
        html.dark .w-full.max-w-md.bg-white.h-full strong {
            color: #ffffff !important;
        }

        html.dark .w-full.max-w-md.bg-white.h-full span.text-\[\#071326\] {
            color: #f5a800 !important;
        }

        html.dark .w-full.max-w-md.bg-white.h-full input {
            background-color: #071428 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }

        /* ============================================================ */
        /* 9. DUAL-THEME DOUBLE PROMO BANNERS (LIGHT & DARK MODE)       */
        /* ============================================================ */
        
        /* --- LIGHT MODE DEFAULTS (WARM PORCELAIN & ICE SKY) --- */
        .boti-promo-support {
            background: linear-gradient(135deg, #fffdf5 0%, #fef3c7 60%, #fff7ed 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.4) !important;
            box-shadow: 0 12px 30px -6px rgba(245, 168, 0, 0.14) !important;
        }
        .boti-promo-support .promo-badge {
            background: rgba(245, 168, 0, 0.2) !important;
            color: #b45309 !important;
            border: 1px solid rgba(245, 168, 0, 0.4) !important;
            font-weight: 800 !important;
        }
        .boti-promo-support h3 {
            color: #071326 !important;
            font-weight: 900 !important;
        }
        .boti-promo-support .promo-desc {
            color: #475569 !important;
            font-weight: 500 !important;
        }
        .boti-promo-support .promo-btn {
            background: #071326 !important;
            color: #f5a800 !important;
            border: 1px solid rgba(245, 168, 0, 0.45) !important;
            box-shadow: 0 4px 14px rgba(7, 19, 38, 0.25) !important;
            font-weight: 900 !important;
        }
        .boti-promo-support .promo-btn:hover {
            background: #0d203f !important;
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(7, 19, 38, 0.35) !important;
            transform: translateY(-2px) !important;
        }

        .boti-promo-web {
            background: linear-gradient(135deg, #f8fcff 0%, #e0f2fe 60%, #f0fdf4 100%) !important;
            border: 1px solid rgba(0, 163, 224, 0.35) !important;
            box-shadow: 0 12px 30px -6px rgba(0, 163, 224, 0.14) !important;
        }
        .boti-promo-web .promo-badge {
            background: rgba(0, 163, 224, 0.14) !important;
            color: #0284c7 !important;
            border: 1px solid rgba(0, 163, 224, 0.3) !important;
            font-weight: 800 !important;
        }
        .boti-promo-web h3 {
            color: #071326 !important;
            font-weight: 900 !important;
        }
        .boti-promo-web .promo-desc {
            color: #475569 !important;
            font-weight: 500 !important;
        }
        .boti-promo-web .promo-btn {
            background: #00a3e0 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(0, 163, 224, 0.35) !important;
            font-weight: 900 !important;
        }
        .boti-promo-web .promo-btn:hover {
            background: #008cc2 !important;
            box-shadow: 0 8px 20px rgba(0, 163, 224, 0.5) !important;
            transform: translateY(-2px) !important;
        }

        /* --- DARK MODE OVERRIDES (DEEP LUXURY NAVY GLASS) --- */
        html.dark .boti-promo-support {
            background: linear-gradient(145deg, #0d203f 0%, #071326 100%) !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
            box-shadow: 0 16px 40px -8px rgba(0, 0, 0, 0.7), 0 0 24px rgba(245, 168, 0, 0.12) !important;
        }
        html.dark .boti-promo-support .promo-badge {
            background: rgba(245, 168, 0, 0.18) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 168, 0, 0.35) !important;
        }
        html.dark .boti-promo-support h3 {
            color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark .boti-promo-support .promo-desc {
            color: #cbd5e1 !important;
        }
        html.dark .boti-promo-support .promo-btn {
            background: linear-gradient(135deg, #f5a800 0%, #d97706 100%) !important;
            color: #071326 !important;
            font-weight: 900 !important;
            border: 1px solid #f5a800 !important;
            box-shadow: 0 4px 16px rgba(245, 168, 0, 0.4) !important;
        }
        html.dark .boti-promo-support .promo-btn:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f5a800 100%) !important;
            box-shadow: 0 8px 24px rgba(245, 168, 0, 0.65) !important;
        }

        html.dark .boti-promo-web {
            background: linear-gradient(145deg, #0b2246 0%, #041122 100%) !important;
            border: 1px solid rgba(0, 163, 224, 0.35) !important;
            box-shadow: 0 16px 40px -8px rgba(0, 0, 0, 0.7), 0 0 24px rgba(0, 163, 224, 0.15) !important;
        }
        html.dark .boti-promo-web .promo-badge {
            background: rgba(0, 163, 224, 0.18) !important;
            color: #38bdf8 !important;
            border: 1px solid rgba(0, 163, 224, 0.35) !important;
        }
        html.dark .boti-promo-web h3 {
            color: #ffffff !important;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark .boti-promo-web .promo-desc {
            color: #cbd5e1 !important;
        }
        html.dark .boti-promo-web .promo-btn {
            background: #00a3e0 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 4px 16px rgba(0, 163, 224, 0.4) !important;
        }
        html.dark .boti-promo-web .promo-btn:hover {
            background: #38bdf8 !important;
            box-shadow: 0 8px 24px rgba(0, 163, 224, 0.6) !important;
        }

        /* ============================================================ */
        /* 10. DUAL-THEME STORE HEADER (LIGHT MODE & DARK MODE)         */
        /* ============================================================ */
        .store-top-bar {
            background-color: #f8fafc !important;
            border-bottom: 1px solid #e2e8f0 !important;
            color: #475569 !important;
        }
        .store-main-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05) !important;
            color: #071326 !important;
        }
        .store-cat-bar {
            background-color: #ffffff !important;
            border-top: 1px solid #e2e8f0 !important;
            color: #475569 !important;
        }

        /* Dark Mode overrides */
        html.dark .store-top-bar {
            background-color: #0b172a !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }
        html.dark .store-top-bar button,
        html.dark .store-top-bar a,
        html.dark .store-top-bar span {
            color: #94a3b8;
        }
        html.dark .store-top-bar button:hover,
        html.dark .store-top-bar a:hover {
            color: #ffffff !important;
        }
        html.dark .store-main-header {
            background-color: #071326 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.5) !important;
            color: #ffffff !important;
        }
        html.dark .store-cat-bar {
            background-color: #0b172a !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #cbd5e1 !important;
        }
    </style>
</head>
<body x-data="botiLojaApp()" x-init="init()" class="min-h-screen flex flex-col justify-between">

    <!-- ============================================================== -->
    <!-- TOAST NOTIFICATION MODERNO & AUTO-DISMISS                      -->
    <!-- ============================================================== -->
    <div x-show="toast.show" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         x-cloak
         class="fixed top-5 right-5 z-[9999] max-w-sm sm:max-w-md w-full px-4 sm:px-0 pointer-events-auto">
        
        <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-200/90 p-4 relative overflow-hidden flex items-start gap-3.5">
            <!-- Barra de Progresso com Duração Dinâmica -->
            <div class="absolute bottom-0 left-0 h-1 bg-[#f5a800] toast-progress"
                 :style="'animation-duration: ' + (toast.duration || 3500) + 'ms'"></div>

            <!-- Ícone de Acordo com o Tipo -->
            <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center shadow-sm"
                 :class="{
                    'bg-amber-50 text-[#b45309] border border-amber-200/80': toast.type === 'success',
                    'bg-amber-50 text-amber-600 border border-amber-200/70': toast.type === 'warning',
                    'bg-rose-50 text-rose-600 border border-rose-200/70': toast.type === 'error',
                    'bg-sky-50 text-sky-600 border border-sky-200/70': toast.type === 'info'
                 }">
                <template x-if="toast.type === 'success'">
                    <i data-lucide="check-circle" class="w-5 h-5 text-[#f5a800]"></i>
                </template>
                <template x-if="toast.type === 'warning'">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
                </template>
                <template x-if="toast.type === 'error'">
                    <i data-lucide="alert-octagon" class="w-5 h-5 text-rose-600"></i>
                </template>
                <template x-if="toast.type === 'info'">
                    <i data-lucide="info" class="w-5 h-5 text-sky-600"></i>
                </template>
            </div>

            <!-- Conteúdo de Texto do Alerta -->
            <div class="flex-1 min-w-0 pr-1 text-left">
                <h4 class="font-bold text-xs sm:text-sm text-slate-900 leading-snug" x-text="toast.title"></h4>
                <p class="text-xs text-slate-600 mt-0.5 leading-relaxed break-words" x-text="toast.message"></p>
            </div>

            <!-- Botão de Fechar Imediato -->
            <button type="button" @click="toast.show = false" class="text-slate-400 hover:text-slate-700 p-1 -mr-1 rounded-lg transition hover:bg-slate-100 cursor-pointer">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- 2. CABEÇALHO PRINCIPAL (BOTICÁRIO E-COMMERCE HEADER)           -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- 1. BARRA SUPERIOR (ULTRA-TOP STRIP ESTILO BOTICÁRIO)          -->
    <!-- ============================================================== -->
    <div class="store-top-bar bg-[#f8fafc] text-slate-600 text-[11px] py-1.5 px-4 sm:px-6 border-b border-slate-200 z-50 relative select-none transition-colors duration-200">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Esquerda: Acessibilidade, Ecossistema RACHI, Ajuda, B2B -->
            <div class="flex items-center gap-4 sm:gap-6 flex-wrap">
                <!-- Acessibilidade Dropdown -->
                <div class="relative" x-data="{ openAcess: false }" @mouseleave="openAcess = false">
                    <button @click="openAcess = !openAcess; $nextTick(() => { if (window.lucide) lucide.createIcons(); })" 
                            :class="openAcess ? 'text-[#071326] dark:text-white' : 'text-slate-600 hover:text-[#071326] dark:text-slate-300 dark:hover:text-white'"
                            class="flex items-center gap-1.5 transition cursor-pointer font-medium py-0.5">
                        <i data-lucide="eye" class="w-3.5 h-3.5 text-amber-500"></i>
                        <span>Acessibilidade</span>
                        <i data-lucide="chevron-down" class="w-3 h-3 opacity-70 transition-transform duration-200" :class="openAcess ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openAcess" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                         class="absolute top-full left-0 mt-2 bg-white dark:bg-[#071326]/98 text-slate-800 dark:text-slate-200 rounded-2xl shadow-2xl dark:shadow-[0_20px_50px_rgba(0,0,0,0.85)] p-2 z-50 text-xs w-64 border border-slate-200/80 dark:border-white/10 ring-1 ring-slate-900/5 dark:ring-white/5 backdrop-blur-xl">
                        <div class="px-2.5 py-1.5 border-b border-slate-100 dark:border-white/10 mb-1 flex items-center justify-between">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Opções de Visualização</span>
                            <i data-lucide="sparkles" class="w-3 h-3 text-amber-500"></i>
                        </div>
                        <button @click="showToast('Modo de alto contraste ativado.', 'Acessibilidade', 'info', 3000); openAcess = false" 
                                class="w-full text-left p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-white/5 flex items-center gap-3 transition cursor-pointer group">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 border border-amber-200/50 dark:border-amber-500/30 flex items-center justify-center shrink-0 group-hover:bg-amber-500 group-hover:text-white transition">
                                <i data-lucide="contrast" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Alto Contraste</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Aumenta o contraste visual</div>
                            </div>
                        </button>
                        <button @click="showToast('Tamanho da fonte ajustado para leitura confortável.', 'Acessibilidade', 'info', 3000); openAcess = false" 
                                class="w-full text-left p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-white/5 flex items-center gap-3 transition cursor-pointer group mt-0.5">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 dark:bg-blue-500/15 text-blue-600 dark:text-blue-400 border border-blue-200/50 dark:border-blue-500/30 flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition">
                                <i data-lucide="type" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">Aumentar Fonte</div>
                                <div class="text-[10px] text-slate-500 dark:text-slate-400">Texto maior para leitura fácil</div>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Ecossistema RACHI (Dropdown Moderno & Elegante) -->
                <div class="relative" x-data="{ openGrupo: false }" @mouseleave="openGrupo = false">
                    <button @click="openGrupo = !openGrupo; $nextTick(() => { if (window.lucide) lucide.createIcons(); })" 
                            :class="openGrupo ? 'text-[#071326] dark:text-white' : 'text-slate-600 hover:text-[#071326] dark:text-slate-300 dark:hover:text-white'"
                            class="flex items-center gap-1.5 transition cursor-pointer font-medium py-0.5">
                        <i data-lucide="layers" class="w-3.5 h-3.5 text-amber-500"></i>
                        <span>Ecossistema RACHI</span>
                        <i data-lucide="chevron-down" class="w-3 h-3 opacity-70 transition-transform duration-200" :class="openGrupo ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openGrupo" x-cloak 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                         class="absolute top-full left-0 mt-2 bg-white dark:bg-[#071326]/98 text-slate-800 dark:text-slate-200 rounded-2xl shadow-2xl dark:shadow-[0_20px_50px_rgba(0,0,0,0.85)] p-2.5 z-50 text-xs w-[340px] sm:w-[360px] border border-slate-200/80 dark:border-white/10 ring-1 ring-slate-900/5 dark:ring-white/5 backdrop-blur-xl">
                        
                        <!-- Top Header -->
                        <div class="px-3 py-2 border-b border-slate-100 dark:border-white/10 mb-1.5">
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-400">Ecossistema RACHI</span>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Unidades e soluções corporativas integradas</p>
                        </div>

                        <div class="space-y-1">
                            <!-- 0. Portal Principal -->
                            <a href="/" class="group flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-white/5 transition duration-150">
                                <div class="w-9 h-9 rounded-xl bg-slate-900 dark:bg-slate-800/90 text-amber-400 border border-amber-500/20 flex items-center justify-center shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                                    <i data-lucide="globe" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition block">Portal Principal</span>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Visão institucional completa do grupo</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400 dark:text-slate-500 opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 group-hover:text-amber-400 transition-all shrink-0"></i>
                            </a>

                            <!-- 1. RACHI Tec -->
                            <a href="/tec" class="group flex items-center gap-3 p-2 rounded-xl hover:bg-sky-50/60 dark:hover:bg-sky-500/10 transition duration-150">
                                <div class="w-9 h-9 rounded-xl bg-sky-50 dark:bg-sky-500/15 text-sky-600 dark:text-sky-400 border border-sky-200/50 dark:border-sky-500/30 flex items-center justify-center shrink-0 group-hover:bg-sky-600 dark:group-hover:bg-sky-500 group-hover:text-white transition">
                                    <i data-lucide="cpu" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-sky-700 dark:group-hover:text-sky-400 transition block">RACHI Tec</span>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Infraestrutura, suporte &amp; soluções corporativas</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-sky-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all shrink-0"></i>
                            </a>

                            <!-- 2. RACHI Human Capital -->
                            <a href="/capital" class="group flex items-center gap-3 p-2 rounded-xl hover:bg-emerald-50/60 dark:hover:bg-emerald-500/10 transition duration-150">
                                <div class="w-9 h-9 rounded-xl bg-emerald-50 dark:bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 border border-emerald-200/50 dark:border-emerald-500/30 flex items-center justify-center shrink-0 group-hover:bg-emerald-600 dark:group-hover:bg-emerald-500 group-hover:text-white transition">
                                    <i data-lucide="users" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition block">RACHI Human Capital</span>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Recrutamento executivo, hunting &amp; gestão</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-emerald-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all shrink-0"></i>
                            </a>

                            <!-- 3. RACHI Academy -->
                            <a href="/academy" class="group flex items-center gap-3 p-2 rounded-xl hover:bg-indigo-50/60 dark:hover:bg-indigo-500/10 transition duration-150">
                                <div class="w-9 h-9 rounded-xl bg-indigo-50 dark:bg-indigo-500/15 text-indigo-600 dark:text-indigo-400 border border-indigo-200/50 dark:border-indigo-500/30 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 dark:group-hover:bg-indigo-500 group-hover:text-white transition">
                                    <i data-lucide="graduation-cap" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-indigo-700 dark:group-hover:text-indigo-400 transition block">RACHI Academy</span>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Cursos práticos, certificações &amp; bootcamps</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-indigo-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all shrink-0"></i>
                            </a>

                            <!-- 4. RACHI Print -->
                            <a href="/print" class="group flex items-center gap-3 p-2 rounded-xl hover:bg-amber-50/60 dark:hover:bg-amber-500/10 transition duration-150">
                                <div class="w-9 h-9 rounded-xl bg-amber-50 dark:bg-amber-500/15 text-amber-600 dark:text-amber-400 border border-amber-200/50 dark:border-amber-500/30 flex items-center justify-center shrink-0 group-hover:bg-amber-600 dark:group-hover:bg-amber-500 group-hover:text-white transition">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-amber-700 dark:group-hover:text-amber-400 transition block">RACHI Print</span>
                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Impressão corporativa, brindes &amp; comunicação visual</p>
                                </div>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-amber-400 opacity-0 group-hover:opacity-100 group-hover:translate-x-0.5 transition-all shrink-0"></i>
                            </a>
                        </div>

                        <!-- Footer -->
                        <div class="mt-2 pt-2 border-t border-slate-100 dark:border-white/10 px-3 py-2 flex items-center justify-between text-[11px] bg-slate-50/80 dark:bg-white/5 rounded-xl">
                            <span class="text-slate-500 dark:text-slate-400">Precisa de proposta multi-serviços?</span>
                            <a href="/contacto" class="text-amber-600 dark:text-amber-400 hover:text-amber-700 dark:hover:text-amber-300 font-bold flex items-center gap-1 transition">
                                <span>Falar com o Grupo</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Precisa de ajuda? (Abre Chat Online ao Clicar) -->
                <button @click="openChatModal()" class="hover:text-[#071326] dark:hover:text-white transition cursor-pointer flex items-center gap-1.5 font-medium text-slate-600 dark:text-slate-300">
                    <i data-lucide="headphones" class="w-3 h-3 text-amber-500"></i>
                    <span>Precisa de ajuda?</span>
                </button>

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 2. CABEÇALHO PRINCIPAL (OBOTICÁRIO E-COMMERCE EXACT LAYOUT)   -->
    <!-- ============================================================== -->
    <header class="store-main-header sticky top-0 z-40 bg-white dark:bg-[#071326] border-b border-slate-200 dark:border-white/10 shadow-sm transition-all duration-200 text-slate-800 dark:text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between gap-3 sm:gap-6 py-5 lg:py-6">
                
                <!-- Logótipo da Loja RACHI Tec -->
                <div class="shrink-0">
                    <a href="/loja" class="flex items-center gap-2 focus:outline-none" title="RACHI Tec — Loja Oficial">
                        <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain dark:hidden" onerror="this.src='https://hom.rachi.ao/assets/img/logo-rachi-dark.png'">
                        <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain hidden dark:block" onerror="this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'">
                        <span class="store-brand-text hidden sm:inline-block font-black text-xs uppercase tracking-widest text-[#071326] dark:text-white border-l-2 border-[#f5a800] pl-2.5 py-0.5">
                            Tec Loja
                        </span>
                    </a>
                </div>

                <!-- Barra de Busca Estilo Boticário (Pílula com Lupa na Direita) -->
                <div class="flex-1 max-w-2xl px-1 sm:px-2">
                    <div class="relative flex items-center w-full">
                        <input type="search" x-model="searchQuery" @input="filterProducts()"
                            placeholder="O que você procura hoje?"
                            class="store-search-input w-full pl-5 pr-11 py-2.5 bg-slate-100 hover:bg-slate-200/80 focus:bg-white text-xs sm:text-sm text-slate-900 placeholder-slate-400 rounded-full border border-slate-200 focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/25 transition-all outline-none shadow-2xs dark:bg-slate-900/90 dark:hover:bg-slate-900 dark:focus:bg-slate-950 dark:text-white dark:border-slate-700">
                        
                        <button @click="filterProducts()"
                            class="absolute right-3.5 text-slate-400 hover:text-[#f5a800] transition"
                            title="Buscar Produtos">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>

                <!-- Ações Direitas: Headphone/Ajuda + Localização + Usuário + Sacola -->
                <div class="flex items-center gap-2 sm:gap-3.5 shrink-0">
                    <!-- Botão Padronizado de Alternância de Tema (Dark / Light Mode) -->
                    <button type="button"
                        onclick="window.toggleRachiTheme()"
                        class="theme-toggle-btn w-9 h-9 rounded-full flex items-center justify-center transition cursor-pointer hover:bg-slate-100 dark:hover:bg-white/10"
                        aria-label="Alternar Modo Escuro / Claro"
                        title="Alternar Modo Escuro / Claro">
                        <!-- Lua (Visível no modo claro -> ao clicar ativa escuro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-600 hover:text-[#071326] dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sol (Visível no modo escuro -> ao clicar ativa claro) -->
                        <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>

                    <!-- Ícone Headphone Atendimento com Pulse -->
                    <button type="button" @click="openChatModal()" class="w-9 h-9 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 text-slate-600 dark:text-slate-300 hover:text-[#071326] dark:hover:text-white flex items-center justify-center transition cursor-pointer relative" title="Ajuda &amp; Chat Online">
                        <i data-lucide="headphones" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-emerald-500 border border-white dark:border-[#071326] animate-pulse"></span>
                    </button>

                    <!-- Perfil de Usuário Executivo & Moderno -->
                    <div class="relative">
                        <button type="button" @click="userMenuOpen = !userMenuOpen"
                            class="store-user-btn flex items-center gap-2.5 py-1 px-2 sm:px-3 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 border border-transparent hover:border-slate-200 dark:hover:border-white/10 transition-all cursor-pointer select-none">
                            <div class="store-user-avatar w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-900 text-[#f5a800] border border-[#f5a800]/40 flex items-center justify-center font-black text-xs shrink-0 shadow-xs">
                                <span x-text="userLoggedIn ? userInitials : 'U'">CC</span>
                            </div>
                            <div class="text-left text-xs leading-tight hidden md:block">
                                <div class="flex items-center gap-1">
                                    <span class="store-user-name text-xs font-bold text-slate-800 dark:text-white" x-text="userLoggedIn ? 'Olá, ' + currentUserFirstName : 'Iniciar Sessão'">Olá, Casimiro</span>
                                    <i data-lucide="chevron-down" class="w-3 h-3 text-slate-400 transition-transform duration-200" :class="{ 'rotate-180': userMenuOpen }"></i>
                                </div>
                                <span class="store-user-sub text-[11px] text-slate-500 dark:text-slate-400 font-medium" x-text="userLoggedIn ? 'Minha Conta' : 'Conta RACHI'">Minha Conta</span>
                            </div>
                        </button>

                        <!-- Popover Dropdown Estilo Executivo Moderno -->
                        <div x-show="userMenuOpen"
                             @click.outside="userMenuOpen = false"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             x-cloak
                             class="absolute right-0 top-full mt-2 w-72 bg-white dark:bg-[#071326] text-slate-800 dark:text-white rounded-2xl shadow-2xl border border-slate-200 dark:border-white/10 p-4 z-50 text-left">
                            
                            <!-- Arrow Tip -->
                            <div class="w-3.5 h-3.5 bg-white dark:bg-[#071326] border-t border-l border-slate-200 dark:border-white/10 rotate-45 absolute -top-2 right-6 pointer-events-none"></div>

                            <!-- Caso Logado -->
                            <template x-if="userLoggedIn">
                                <div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-900 dark:to-slate-800 text-[#f5a800] border border-[#f5a800]/40 flex items-center justify-center font-black text-sm shrink-0 shadow-sm select-none">
                                            <span x-text="userInitials">CC</span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <h3 class="font-bold text-slate-900 dark:text-white text-sm leading-tight truncate" x-text="currentUser.name || 'Casimiro Custódio'"></h3>
                                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate" x-text="currentUser.email || 'casimirogundja@outlook.com'"></p>
                                        </div>
                                    </div>

                                    <div class="mt-3 py-1.5 px-2.5 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-white/10 flex items-center justify-between text-[11px]">
                                        <span class="text-slate-600 dark:text-slate-300 font-medium">Conta Corporativa</span>
                                        <span class="text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 dark:bg-emerald-400"></span> Ativa
                                        </span>
                                    </div>

                                    <hr class="my-3 border-slate-200 dark:border-white/10">

                                    <nav class="flex flex-col space-y-1">
                                        <button type="button" @click="openAccountModal('dados'); userMenuOpen = false"
                                            class="w-full flex items-center gap-3 py-2 px-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 transition group text-left cursor-pointer">
                                            <i data-lucide="user-check" class="w-4 h-4 text-[#f5a800] group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-medium">Meus Dados Cadastrais</span>
                                        </button>
                                        <button type="button" @click="openAccountModal('pedidos'); userMenuOpen = false"
                                            class="w-full flex items-center gap-3 py-2 px-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 transition group text-left cursor-pointer">
                                            <i data-lucide="package" class="w-4 h-4 text-[#f5a800] group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-medium">Histórico de Pedidos &amp; Faturas</span>
                                        </button>
                                        <button type="button" @click="openAccountModal('favoritos'); userMenuOpen = false"
                                            class="w-full flex items-center gap-3 py-2 px-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 transition group text-left cursor-pointer">
                                            <i data-lucide="heart" class="w-4 h-4 text-[#f5a800] group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-medium">Produtos Salvos</span>
                                        </button>
                                        <button type="button" @click="openChatModal(); userMenuOpen = false"
                                            class="w-full flex items-center gap-3 py-2 px-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 transition group text-left cursor-pointer">
                                            <i data-lucide="headphones" class="w-4 h-4 text-[#f5a800] group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-medium">Suporte Corporativo Online</span>
                                        </button>
                                    </nav>

                                    <div class="mt-2.5 pt-2.5 border-t border-slate-200 dark:border-white/10 text-xs text-slate-500 dark:text-slate-400 flex items-center justify-between">
                                        <span>Sessão iniciada</span>
                                        <button type="button" @click="logout(); userMenuOpen = false" class="text-rose-500 hover:text-rose-600 dark:text-rose-400 dark:hover:text-rose-300 font-bold flex items-center gap-1 cursor-pointer">
                                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                                            <span>Sair</span>
                                        </button>
                                    </div>
                                </div>
                            </template>

                            <!-- Caso Deslogado -->
                            <template x-if="!userLoggedIn">
                                <div>
                                    <button type="button" @click="loginModalOpen = true; authTab = 'login'; userMenuOpen = false"
                                        class="w-full py-2.5 px-4 bg-[#f5a800] hover:bg-[#e09900] active:bg-[#c88200] text-[#071326] font-black text-xs rounded-xl shadow-md hover:shadow-lg transition text-center flex items-center justify-center cursor-pointer">
                                        Acessar minha conta
                                    </button>
                                    <div class="mt-2.5 text-center text-xs text-slate-500 dark:text-slate-400">
                                        Não tem conta? 
                                        <button type="button" @click="loginModalOpen = true; authTab = 'register'; userMenuOpen = false"
                                            class="font-black text-[#f5a800] hover:text-[#fbbf24] underline underline-offset-2 ml-0.5 transition cursor-pointer">
                                            Cadastrar.
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Sacola / Carrinho com Contador -->
                    <button type="button" @click="cartDrawerOpen = true"
                        class="relative p-2 text-slate-600 dark:text-slate-300 hover:text-[#071326] dark:hover:text-white transition flex items-center justify-center cursor-pointer"
                        title="Sacola de Compras">
                        <i data-lucide="shopping-bag" class="w-5 sm:w-6 h-5 sm:h-6"></i>
                        <span x-show="cartCount > 0" 
                              x-text="cartCount"
                              class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] bg-[#f5a800] text-[#071326] text-[10px] font-black rounded-full flex items-center justify-center px-1 shadow-sm">
                        </span>
                    </button>

                    <!-- Mobile Hamburger -->
                    <button @click="mobileNavOpen = !mobileNavOpen" class="lg:hidden p-1.5 text-slate-600 dark:text-slate-300 hover:text-[#071326] dark:hover:text-white">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- 3. BARRA HORIZONTAL DE CATEGORIAS (COM NAVEGAÇÃO < >)          -->
        <!-- ============================================================== -->
        <div class="store-cat-bar border-t border-slate-200 dark:border-white/10 bg-white dark:bg-[#0b172a] text-slate-600 dark:text-slate-300 transition-colors duration-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 relative flex items-center">
                <!-- Categorias com Scroll Suave -->
                <div id="categories-scroll-row" class="flex items-center gap-1 sm:gap-3 overflow-x-auto py-2.5 no-scrollbar scrollbar-none text-xs font-semibold text-slate-600 dark:text-slate-300 whitespace-nowrap flex-1 scroll-smooth select-none">
                    <button @click="selectCategory('todos')" 
                        :class="activeCategory === 'todos' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer flex items-center gap-1">
                        <span class="text-amber-500">⚡</span>
                        <span>Entrega Rápida</span>
                    </button>
                    
                    <button @click="filterOnlyPromo()" 
                        class="px-2 py-1 text-rose-500 font-bold hover:text-rose-600 dark:text-rose-400 dark:hover:text-rose-300 transition cursor-pointer flex items-center gap-1">
                        <span>🏷️</span>
                        <span>Outlet</span>
                    </button>
                    
                    <button @click="selectCategory('informatica')" 
                        :class="activeCategory === 'informatica' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        Laptops &amp; PCs
                    </button>
                    
                    <button @click="selectCategory('conectividade')" 
                        :class="activeCategory === 'conectividade' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        Cabos &amp; Redes
                    </button>
                    
                    <button @click="selectCategory('smartwatches')" 
                        :class="activeCategory === 'smartwatches' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        Smartwatches
                    </button>
                    
                    <button @click="selectCategory('tvbox')" 
                        :class="activeCategory === 'tvbox' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        TV Box 4K
                    </button>
                    
                    <button @click="selectCategory('audio')" 
                        :class="activeCategory === 'audio' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        Áudio &amp; Fones
                    </button>
                    
                    <button @click="selectCategory('promocional')" 
                        :class="activeCategory === 'promocional' ? 'text-[#f5a800] font-black border-b-2 border-[#f5a800]' : 'hover:text-[#071326] dark:hover:text-white'"
                        class="px-2 py-1 transition cursor-pointer">
                        Acessórios &amp; Brindes
                    </button>
                    
                    <a href="/print" class="px-2 py-1 hover:text-[#071326] dark:hover:text-white transition">
                        Consumíveis &amp; Papelaria
                    </a>
                    
                    <a href="/tec" class="px-2 py-1 text-sky-600 dark:text-sky-400 font-bold hover:text-sky-700 dark:hover:text-sky-300 transition">
                        Serviços TI
                    </a>
                    
                    <button @click="sortBy = 'vendas'; filterProducts()" class="px-2 py-1 text-amber-600 dark:text-amber-400 font-bold hover:text-amber-700 dark:hover:text-amber-300 transition cursor-pointer">
                        Mais Vendidos
                    </button>
                </div>

                <!-- Setas de Scroll < > no canto direito da barra de categorias -->
                <div class="hidden sm:flex items-center gap-1 pl-2 border-l border-slate-200 dark:border-white/10">
                    <button @click="document.getElementById('categories-scroll-row').scrollBy({ left: -160, behavior: 'smooth' })" 
                        class="w-6 h-6 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-400 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white cursor-pointer transition" title="Rolar para esquerda">
                        <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                    </button>
                    <button @click="document.getElementById('categories-scroll-row').scrollBy({ left: 160, behavior: 'smooth' })" 
                        class="w-6 h-6 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 flex items-center justify-center text-slate-400 hover:text-slate-700 dark:text-slate-400 dark:hover:text-white cursor-pointer transition" title="Rolar para direita">
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileNavOpen" x-cloak class="lg:hidden bg-white dark:bg-[#071326] border-t border-slate-200 dark:border-white/10 px-4 py-4 space-y-3 shadow-lg text-slate-800 dark:text-slate-200">
            <div class="font-bold text-xs uppercase text-slate-400 tracking-wider">Departamentos</div>
            <div class="grid grid-cols-2 gap-2">
                <template x-for="cat in categories" :key="cat.id">
                    <button @click="selectCategory(cat.id); mobileNavOpen = false" 
                        class="text-left text-xs font-semibold p-2.5 rounded-xl bg-slate-50 dark:bg-slate-800 hover:bg-amber-50 dark:hover:bg-amber-500/10 hover:text-[#b45309] dark:hover:text-amber-400 text-slate-700 dark:text-slate-200 transition"
                        x-text="cat.name">
                    </button>
                </template>
            </div>
            <div class="border-t border-slate-200 dark:border-white/10 pt-3 flex flex-col gap-2 text-xs font-medium">
                <a href="/" class="py-1 text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition">← Voltar à Página Principal</a>
                <a href="/tec" class="py-1 text-sky-600 dark:text-sky-400 font-bold hover:text-sky-700 dark:hover:text-sky-300 transition">Conhecer RACHI Tec (Serviços)</a>
                <button type="button" @click="openChatModal(); mobileNavOpen = false" class="py-1 text-amber-600 dark:text-amber-400 font-bold text-left flex items-center gap-2 hover:text-amber-700 dark:hover:text-amber-300 transition cursor-pointer">
                    <i data-lucide="headphones" class="w-4 h-4"></i>
                    <span>Ajuda &amp; Chat Online (Atendimento)</span>
                </button>
                <a href="/contacto" class="py-1 text-slate-700 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white transition">Fale com um Especialista</a>
            </div>
        </div>
    </header>

    <main class="flex-1">

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- 4. CARROSSEL PRINCIPAL (RÉPLICA FIEL DO PRINT O BOTICÁRIO)     -->
        <!-- ============================================================== -->
        <section class="w-full bg-[#f3f4f6] relative overflow-hidden boti-hero-carousel" x-data="{ currentSlide: 0, totalSlides: 3, timer: null }"
                 x-init="timer = setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 6000)"
                 @mouseenter="clearInterval(timer)"
                 @mouseleave="timer = setInterval(() => { currentSlide = (currentSlide + 1) % totalSlides }, 6000)">
            
            <div class="max-w-7xl mx-auto px-4 sm:px-8 py-6 sm:py-10 relative min-h-[380px] sm:min-h-[440px] grid grid-cols-1 items-center">
                
                <!-- SLIDE 1: SEJA UM REVENDEDOR / PARCEIRO B2B (EXATO AO PRINT) -->
                <div x-show="currentSlide === 0" 
                     x-transition:enter="transition ease-out duration-500 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-300 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="col-start-1 row-start-1 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <!-- Lado Esquerdo: Tipografia Exata ao Print -->
                    <div class="lg:col-span-6 z-10 text-left pl-2 sm:pl-6">
                        <p class="text-xs sm:text-sm font-extrabold tracking-widest text-slate-800 uppercase mb-1">
                            SEJA UM
                        </p>
                        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-none uppercase mb-2">
                            revendedor<br>
                            <span class="text-slate-800 font-extrabold text-2xl sm:text-3xl lg:text-4xl block mt-1 tracking-normal">DA RACHI TEC</span>
                        </h1>
                        
                        <p class="mt-4 sm:mt-6 text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md font-medium">
                            Conquiste a independência financeira e expanda os seus negócios com <strong class="text-slate-900 font-bold">equipamentos de informática, garantia oficial e faturação com NIF em Luanda</strong>.
                        </p>

                        <!-- Botão Saiba mais > com Estilo Exato ao Print (Pílula Branca com Sombra) -->
                        <div class="mt-6 sm:mt-8">
                            <a href="/contacto?assunto=parceiro" 
                               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white hover:bg-slate-50 text-slate-900 font-black text-xs sm:text-sm rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 border border-slate-200">
                                <span>Saiba mais</span>
                                <span class="text-sm font-black">&gt;</span>
                            </a>
                        </div>
                    </div>

                    <!-- Lado Direito: Imagem da Equipe com Blocos Geométricos Verdes/Âmbar (Exato ao Print) -->
                    <div class="lg:col-span-6 relative flex items-center justify-center">
                        <!-- Quadrados Geométricos Decorativos (Estilo Boticário) -->
                        <div class="absolute -top-6 left-12 w-28 h-28 bg-[#10b981]/70 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="absolute bottom-2 -left-4 w-36 h-36 bg-[#059669]/80 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="absolute top-10 right-4 w-32 h-44 bg-[#10b981]/75 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="absolute -bottom-6 right-16 w-24 h-24 bg-[#047857]/85 rounded-none pointer-events-none hidden sm:block"></div>

                        <!-- Fotografia da Equipe RACHI em Estúdio -->
                        <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-4 border-white max-w-lg w-full">
                            <img src="/images/rachi-hero-team.jpg" alt="Equipe RACHI Tec" class="w-full h-auto object-cover max-h-[340px]">
                        </div>
                    </div>
                </div>

                <!-- SLIDE 2: HP ELITEBOOK X360 G8 -->
                <div x-show="currentSlide === 1" x-cloak
                     x-transition:enter="transition ease-out duration-500 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-300 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="col-start-1 row-start-1 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <div class="lg:col-span-6 z-10 text-left pl-2 sm:pl-6">
                        <span class="inline-block px-3 py-1 bg-amber-100 text-amber-900 rounded-full font-black text-[11px] uppercase tracking-wider mb-2">
                            PRODUTO CORPORATIVO TOP 1
                        </span>
                        <h2 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight uppercase mb-2">
                            HP Elitebook<br>
                            <span class="text-[#f5a800]">x360 1040 G8</span>
                        </h2>
                        <p class="mt-4 text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md font-medium">
                            Ecrã táctil conversível 360°, processador Intel Core i7, 16GB RAM e SSD 512GB NVMe. Pronta entrega em Luanda por <strong class="text-slate-900 font-bold">1.489.000,29 AOA</strong>.
                        </p>
                        <div class="mt-6 sm:mt-8">
                            <button @click="selectCategory('informatica')"
                               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white hover:bg-slate-50 text-slate-900 font-black text-xs sm:text-sm rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 border border-slate-200 cursor-pointer">
                                <span>Comprar Agora</span>
                                <span class="text-sm font-black">&gt;</span>
                            </button>
                        </div>
                    </div>

                    <div class="lg:col-span-6 relative flex items-center justify-center">
                        <div class="absolute -top-4 left-10 w-32 h-32 bg-[#f5a800]/40 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="absolute -bottom-4 right-10 w-40 h-40 bg-[#071326]/15 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="relative z-10 p-6 bg-white/80 dark:bg-white/5 backdrop-blur-md rounded-3xl shadow-xl max-w-md w-full text-center border border-slate-100 dark:border-white/10">
                            <img src="/images/hp-elitebook-studio.png" alt="HP Elitebook" class="h-56 w-auto object-contain mx-auto drop-shadow-2xl">
                        </div>
                    </div>
                </div>

                <!-- SLIDE 3: REDES & CONECTIVIDADE (CABOS CONSOLE E TV BOX 4K) -->
                <div x-show="currentSlide === 2" x-cloak
                     x-transition:enter="transition ease-out duration-500 transform"
                     x-transition:enter-start="opacity-0 translate-x-8"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-300 transform"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-8"
                     class="col-start-1 row-start-1 w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    
                    <div class="lg:col-span-6 z-10 text-left pl-2 sm:pl-6">
                        <span class="inline-block px-3 py-1 bg-teal-100 text-teal-900 rounded-full font-black text-[11px] uppercase tracking-wider mb-2">
                            REDES &amp; SISTEMAS
                        </span>
                        <h2 class="text-3xl sm:text-5xl font-black text-slate-900 tracking-tight leading-tight uppercase mb-2">
                            Cabos Console<br>
                            <span class="text-teal-600">&amp; TV Box 4K</span>
                        </h2>
                        <p class="mt-4 text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md font-medium">
                            Cabos seriais DB9 para RJ45 para switches Cisco e módulos TV Box 4K para salas de reunião e sinalética digital.
                        </p>
                        <div class="mt-6 sm:mt-8">
                            <button @click="selectCategory('conectividade')"
                               class="inline-flex items-center gap-2 px-8 py-3.5 bg-white hover:bg-slate-50 text-slate-900 font-black text-xs sm:text-sm rounded-full shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 border border-slate-200 cursor-pointer">
                                <span>Ver Conectividade</span>
                                <span class="text-sm font-black">&gt;</span>
                            </button>
                        </div>
                    </div>

                    <div class="lg:col-span-6 relative flex items-center justify-center">
                        <div class="absolute -top-4 right-10 w-36 h-36 bg-teal-500/30 rounded-none pointer-events-none hidden sm:block"></div>
                        <div class="relative z-10 p-6 bg-white/80 dark:bg-white/5 backdrop-blur-md rounded-3xl shadow-xl max-w-md w-full flex items-center justify-center gap-6 border border-slate-100 dark:border-white/10">
                            <img src="/images/cabo-console-studio.png" alt="Cabo Console" class="h-44 w-auto object-contain drop-shadow-2xl">
                            <img src="/images/tvbox-studio.png" alt="TV Box 4K" class="h-44 w-auto object-contain drop-shadow-2xl">
                        </div>
                    </div>
                </div>

                <!-- Botões de Navegação do Carrossel (< e > exatamente como no print) -->
                <button @click="currentSlide = (currentSlide - 1 + totalSlides) % totalSlides" 
                    class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-slate-50 text-slate-700 hover:text-black shadow-lg flex items-center justify-center transition-all z-20 cursor-pointer border border-slate-200/80">
                    <i data-lucide="chevron-left" class="w-5 h-5 text-emerald-700"></i>
                </button>

                <button @click="currentSlide = (currentSlide + 1) % totalSlides" 
                    class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-white hover:bg-slate-50 text-slate-700 hover:text-black shadow-lg flex items-center justify-center transition-all z-20 cursor-pointer border border-slate-200/80">
                    <i data-lucide="chevron-right" class="w-5 h-5 text-emerald-700"></i>
                </button>

                <!-- Botão Flutuante de Compre pelo WhatsApp (Exato ao Print no Canto Inferior Direito) -->
                <div class="absolute bottom-4 right-4 sm:right-8 z-30 flex items-center gap-1.5" x-data="{ showWpp: true }" x-show="showWpp">
                    <a href="https://wa.me/244923000000?text=Olá!%20Gostaria%20de%20comprar%20pelo%20WhatsApp%20da%20RACHI%20Tec." target="_blank"
                       class="inline-flex items-center gap-2 px-3.5 py-2 bg-[#25D366] hover:bg-[#20ba59] text-white rounded-lg shadow-lg font-bold text-xs transition duration-200 hover:scale-105">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.044c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.13.564 4.129 1.545 5.86l-1.645 6.012 6.168-1.618c1.674.912 3.593 1.438 5.632 1.438 6.627 0 12-5.373 12-12 0-6.627-5.373-12-12-12z"/></svg>
                        <span>Compre pelo WhatsApp</span>
                    </a>
                    <button @click="showWpp = false" class="text-slate-400 hover:text-slate-700 p-1 text-xs">✕</button>
                </div>
            </div>

            <!-- Indicadores de Slides (Dots no Centro Inferior) -->
            <div class="flex justify-center items-center gap-1.5 pb-4">
                <template x-for="(dot, idx) in totalSlides" :key="idx">
                    <button @click="currentSlide = idx" 
                            class="h-2 rounded-full transition-all duration-300 cursor-pointer"
                            :class="currentSlide === idx ? 'w-6 bg-[#10b981]' : 'w-2 bg-slate-300 hover:bg-slate-400'">
                    </button>
                </template>
            </div>
        </section>

        <!-- 5. CATEGORIAS EM BOLHAS (CIRCULAR BUBBLES — ESTILO BOTICÁRIO) -->
        <!-- ============================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            <div class="flex items-center justify-between mb-5 sm:mb-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full bg-[#f5a800] animate-pulse"></span>
                        <span class="text-[11px] sm:text-xs font-extrabold uppercase tracking-widest text-[#d97706]">Departamentos em Destaque</span>
                    </div>
                    <h2 class="text-xl sm:text-2xl font-black text-slate-900 font-display tracking-tight">Navegue por Categoria</h2>
                </div>
                <!-- Setas de rolagem suave para desktop -->
                <div class="hidden sm:flex items-center gap-2">
                    <button @click="$refs.bubbleTrack.scrollBy({ left: -240, behavior: 'smooth' })"
                        class="w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-600 hover:text-[#d97706] hover:border-[#f5a800] flex items-center justify-center transition shadow-sm hover:shadow"
                        title="Anterior">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <button @click="$refs.bubbleTrack.scrollBy({ left: 240, behavior: 'smooth' })"
                        class="w-9 h-9 rounded-full border border-slate-200 bg-white text-slate-600 hover:text-[#d97706] hover:border-[#f5a800] flex items-center justify-center transition shadow-sm hover:shadow"
                        title="Próximo">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <!-- Trilho de Bolhas Horizontais com Scroll Suave -->
            <div id="bubble-track-row" x-ref="bubbleTrack" class="flex items-start gap-4 sm:gap-6 overflow-x-auto no-scrollbar scrollbar-none scroll-smooth py-3 px-1 select-none cursor-grab active:cursor-grabbing">
                
                <!-- Bolha 1: Todos os Produtos -->
                <button @click="selectCategory('todos')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'todos' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-[#071326] via-[#0d1f3d] to-[#f5a800] text-white flex items-center justify-center shadow-inner">
                            <i data-lucide="layout-grid" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'todos' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Ver Tudo
                        </span>
                        <span x-show="activeCategory === 'todos'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 2: Laptops & PCs -->
                <button @click="selectCategory('informatica')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'informatica' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-[#071326] text-[#f5a800] border border-[#f5a800]/40 text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">i7 Touch</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-slate-50 via-slate-100 to-blue-50/80 text-[#071326] flex items-center justify-center">
                            <i data-lucide="laptop" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'informatica' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Laptops &amp; PCs
                        </span>
                        <span x-show="activeCategory === 'informatica'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 3: Smartwatches -->
                <button @click="selectCategory('smartwatches')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'smartwatches' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-amber-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">Top</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-amber-50 via-orange-50 to-amber-100/60 text-amber-600 flex items-center justify-center">
                            <i data-lucide="watch" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'smartwatches' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Smartwatches
                        </span>
                        <span x-show="activeCategory === 'smartwatches'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 4: Cabos & Conectores -->
                <button @click="selectCategory('conectividade')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'conectividade' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-sky-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">Cisco</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-sky-50 via-blue-50 to-cyan-50 text-sky-600 flex items-center justify-center">
                            <i data-lucide="network" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'conectividade' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Cabos &amp; Redes
                        </span>
                        <span x-show="activeCategory === 'conectividade'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 5: TV Box 4K -->
                <button @click="selectCategory('tvbox')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'tvbox' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-purple-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">4K Ultra</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-purple-50 via-violet-50 to-indigo-50 text-purple-600 flex items-center justify-center">
                            <i data-lucide="tv" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'tvbox' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            TV Box 4K
                        </span>
                        <span x-show="activeCategory === 'tvbox'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 6: Áudio & Fones -->
                <button @click="selectCategory('audio')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'audio' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-teal-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">TWS</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-teal-50 via-emerald-50 to-cyan-50 text-teal-600 flex items-center justify-center">
                            <i data-lucide="headphones" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'audio' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Áudio &amp; Fones
                        </span>
                        <span x-show="activeCategory === 'audio'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 7: Acessórios -->
                <button @click="selectCategory('promocional')" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center"
                         :class="activeCategory === 'promocional' ? 'ring-2 ring-[#f5a800] ring-offset-2 ring-offset-[#f7f8fa] bg-amber-50 shadow-md' : 'bg-white shadow-sm border border-slate-200/80'">
                        <span class="absolute -top-1 -right-0.5 bg-indigo-600 text-white text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">iPhone</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 text-indigo-600 flex items-center justify-center">
                            <i data-lucide="smartphone" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-center whitespace-nowrap transition"
                              :class="activeCategory === 'promocional' ? 'text-[#b45309] font-black' : 'text-slate-700 group-hover:text-[#d97706]'">
                            Acessórios
                        </span>
                        <span x-show="activeCategory === 'promocional'" class="w-1.5 h-1.5 rounded-full bg-[#f5a800] mt-1"></span>
                    </div>
                </button>

                <!-- Bolha 8: Serviços TI -->
                <a href="/tec" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center bg-white shadow-sm border border-slate-200/80">
                        <span class="absolute -top-1 -right-0.5 bg-[#f5a800] text-[#071326] text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10">B2B</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-slate-900 via-[#071326] to-[#0d1f3d] text-[#f5a800] flex items-center justify-center shadow-inner">
                            <i data-lucide="shield-check" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-bold tracking-tight text-slate-700 group-hover:text-[#d97706] text-center whitespace-nowrap transition">
                            Serviços TI
                        </span>
                    </div>
                </a>

                <!-- Bolha 9: Até 30% OFF -->
                <button @click="filterOnlyPromo()" class="bubble-item flex flex-col items-center gap-2.5 shrink-0 group focus:outline-none min-w-[76px] sm:min-w-[84px]">
                    <div class="bubble-circle relative w-16 h-16 sm:w-20 sm:h-20 rounded-full p-1 flex items-center justify-center bg-white shadow-sm border border-rose-200/80">
                        <span class="absolute -top-1 -right-0.5 bg-amber-400 text-slate-950 text-[9px] font-black px-1.5 py-0.5 rounded-full shadow-sm z-10 animate-pulse">HOT</span>
                        <div class="w-full h-full rounded-full bg-gradient-to-br from-rose-500 via-rose-600 to-pink-600 text-white flex items-center justify-center shadow-md shadow-rose-300/40">
                            <i data-lucide="badge-percent" class="w-6 h-6 sm:w-8 sm:h-8 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xs sm:text-[13px] font-black tracking-tight text-rose-600 group-hover:text-rose-700 text-center whitespace-nowrap transition">
                            Até 30% OFF
                        </span>
                    </div>
                </button>



            </div>
        </section>

        <!-- ============================================================== -->
        <!-- 6. BARRA DE DIFERENCIAIS / CONFIANÇA (4 PILARES)               -->
        <!-- ============================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200/80 shadow-sm">
                
                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#d97706] flex items-center justify-center shrink-0">
                        <i data-lucide="truck" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Entrega Rápida em Luanda</h4>
                        <p class="text-[11px] text-slate-500">Direto no seu escritório ou casa</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <i data-lucide="store" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Clique &amp; Retire Grátis</h4>
                        <p class="text-[11px] text-slate-500">Nas instalações da RACHI</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <i data-lucide="file-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Factura com NIF Formal</h4>
                        <p class="text-[11px] text-slate-500">Conformidade fiscal garantida</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-2">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-900">Garantia &amp; Assistência</h4>
                        <p class="text-[11px] text-slate-500">Suporte técnico especializado</p>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================== -->
        <!-- 7. VITRINE PRINCIPAL DE PRODUTOS (CARDS NO MODELO BOTICÁRIO)   -->
        <!-- ============================================================== -->
        <section id="catalogo" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            
            <!-- Cabeçalho da Vitrine -->
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pb-6 mb-8 border-b border-slate-200">
                <div>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#d97706]" x-text="currentCategoryTitle"></span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display mt-1">
                        Catálogo de Produtos em Destaque
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Preços transparentes em Kwanzas com garantia e suporte técnico da RACHI Tec.
                    </p>
                </div>

                <!-- Ordenação e Contador -->
                <div class="flex items-center gap-3 self-start sm:self-auto">
                    <span class="text-xs text-slate-500 font-medium">
                        <strong class="text-slate-900" x-text="filteredProducts.length"></strong> produto(s)
                    </span>
                    <select x-model="sortBy" @change="sortProducts()"
                        class="text-xs font-semibold bg-white border border-slate-300 rounded-xl px-3 py-2 text-slate-700 focus:outline-none focus:border-[#f5a800]">
                        <option value="destaque">Mais Relevantes</option>
                        <option value="menor_preco">Menor Preço</option>
                        <option value="maior_preco">Maior Preço</option>
                        <option value="nome">Nome (A–Z)</option>
                    </select>
                </div>
            </div>

            <!-- Grade dos Produtos Estilo Boticário -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <template x-for="p in filteredProducts" :key="p.slug">
                    <article class="boti-card bg-white rounded-3xl border border-slate-200/90 shadow-sm hover:shadow-2xl hover:border-amber-400 transition-all duration-300 flex flex-col justify-between relative group overflow-hidden">
                        
                        <!-- Topo: Foto Studio, Badges e Botão Favorito -->
                        <div class="relative bg-gradient-to-b from-slate-50/80 via-white to-white h-64 p-5 flex items-center justify-center border-b border-slate-100/90 overflow-hidden">
                            
                            <!-- Badges Elegantes em Pílula (Sem cortes) -->
                            <div class="absolute top-3.5 left-3.5 flex flex-col items-start gap-1.5 z-10">
                                <span x-show="p.discountPercent" x-text="p.discountPercent"
                                    class="px-2.5 py-0.5 bg-rose-600 text-white font-black text-[10px] rounded-full uppercase tracking-wider shadow-sm flex items-center gap-1"></span>
                                <span x-show="p.badge" x-text="p.badge"
                                    class="px-2.5 py-0.5 bg-[#071326]/90 backdrop-blur-sm text-[#f5a800] border border-[#f5a800]/30 font-bold text-[9px] rounded-full uppercase tracking-wider shadow-sm"></span>
                            </div>

                            <!-- Botão Favorito no Canto Superior Direito -->
                            <button type="button" @click.stop="toggleFavorite(p)" 
                                class="absolute top-3.5 right-3.5 w-8 h-8 rounded-full bg-white/90 backdrop-blur-sm border border-slate-200/90 flex items-center justify-center transition-all hover:scale-110 shadow-sm z-10 cursor-pointer"
                                :title="isFavorite(p) ? 'Remover dos favoritos' : 'Adicionar aos favoritos'">
                                <i data-lucide="heart" class="w-4 h-4 transition-colors" 
                                   :class="isFavorite(p) ? 'text-rose-500 fill-rose-500' : 'text-slate-400 hover:text-rose-500'"></i>
                            </button>

                            <!-- Foto Studio do Produto com Zoom Suave -->
                            <img :src="p.image" :alt="p.title" 
                                class="max-h-full max-w-full object-contain group-hover:scale-108 transition-transform duration-300 drop-shadow-md cursor-pointer"
                                @click="openQuickView(p)">
                        </div>

                        <!-- Corpo do Card: Avaliação, Título, Preço e Botão de Compra -->
                        <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <!-- Categoria e Avaliação com Estrelas -->
                                <div class="flex items-center justify-between text-[11px] mb-2.5 gap-2">
                                    <span class="boti-cat-badge font-bold uppercase tracking-wider text-amber-800 bg-amber-50 px-2.5 py-0.5 rounded-full border border-amber-200/60 truncate" x-text="p.category"></span>
                                    <div class="boti-rating-badge flex items-center gap-1 text-amber-500 font-bold shrink-0 bg-amber-50/60 px-2 py-0.5 rounded-full">
                                        <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                        <span class="text-slate-900 font-black text-xs" x-text="p.rating || '4.9'"></span>
                                        <span class="text-slate-400 font-normal text-[10px]" x-text="'(' + (p.reviews || 12) + ')'"></span>
                                    </div>
                                </div>

                                <!-- Título do Produto -->
                                <h3 @click="openQuickView(p)" 
                                    class="font-black text-slate-900 text-sm sm:text-[15px] line-clamp-2 leading-snug group-hover:text-amber-600 transition-colors cursor-pointer font-display min-h-[42px]"
                                    x-text="p.title"></h3>

                                <!-- Descrição resumida -->
                                <p class="text-[11px] text-slate-500 line-clamp-2 mt-1.5 leading-relaxed" x-text="p.shortDesc"></p>
                            </div>

                            <div class="mt-4 pt-3.5 border-t border-slate-100">
                                
                                <!-- Preços: "De" / "Por" -->
                                <div class="mb-3">
                                    <span x-show="p.oldPrice" class="text-xs text-slate-400 line-through block font-medium" x-text="'De ' + p.oldPrice"></span>
                                    <div class="flex items-baseline gap-1.5 flex-wrap sm:flex-nowrap">
                                        <span class="text-xs font-bold text-slate-500">Por:</span>
                                        <strong class="text-lg sm:text-xl font-black text-slate-950 tracking-tight whitespace-nowrap" x-text="p.price"></strong>
                                    </div>
                                    <div class="flex items-center gap-1.5 text-[10px] text-slate-500 mt-1">
                                        <i data-lucide="credit-card" class="w-3.5 h-3.5 text-amber-600 shrink-0"></i>
                                        <span class="truncate">À vista via Multicaixa ou transferência</span>
                                    </div>
                                </div>

                                <!-- Status de Stock com badge estilizado -->
                                <div class="boti-stock-badge flex items-center gap-1.5 text-[11px] text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-full w-fit font-bold border border-emerald-200/60 mb-3.5">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span x-text="p.stockText || 'Disponível em Luanda'"></span>
                                </div>

                                <!-- Botões de Ação -->
                                <div class="space-y-2">
                                    <button @click="addToCart(p)"
                                        class="btn-comprar w-full py-3 rounded-xl font-black text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-md shadow-amber-500/20 hover:shadow-lg hover:shadow-amber-500/35 transition cursor-pointer">
                                        <i data-lucide="shopping-bag" class="w-4 h-4"></i>
                                        <span>Comprar</span>
                                    </button>
                                    
                                    <button @click="openQuickView(p)"
                                        class="w-full py-1 text-center text-[11px] font-bold text-slate-500 hover:text-amber-700 transition flex items-center justify-center gap-1 cursor-pointer">
                                        <span>Ver detalhes do produto</span>
                                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                    </article>
                </template>
            </div>

            <!-- Caso Nenhum Produto Seja Encontrado -->
            <div x-show="filteredProducts.length === 0" class="text-center py-20 bg-white rounded-3xl border border-slate-200 mt-8">
                <div class="w-16 h-16 rounded-full bg-amber-50 text-[#d97706] flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="package-open" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 font-display">Nenhum produto encontrado</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 max-w-sm mx-auto">
                    Não encontramos artigos para a busca informada. Tente limpar os filtros ou buscar por outra palavra.
                </p>
                <button @click="resetFilters()" class="mt-5 px-6 py-2.5 rounded-full bg-[#f5a800] text-[#071326] font-black text-xs uppercase tracking-wider hover:bg-[#e09900]">
                    Ver todos os produtos
                </button>
            </div>

        </section>

        <!-- ============================================================== -->
        <!-- 8. BANNER DUPLO PROMOCIONAL (SHOPPABLE BANNERS BOTICÁRIO)      -->
        <!-- ============================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Banner 1: Serviços TI RACHI Tec -->
                <div class="boti-promo-banner boti-promo-support rounded-3xl p-8 relative overflow-hidden flex flex-col justify-between min-h-[220px] transition-all duration-300">
                    <div class="relative z-10">
                        <span class="promo-badge px-3 py-1 rounded-full font-bold text-[10px] uppercase tracking-wider">
                            Soluções para Empresas
                        </span>
                        <h3 class="text-2xl font-black font-display mt-3">Contratos de Suporte &amp; Manutenção de TI</h3>
                        <p class="promo-desc text-xs mt-2 max-w-md">
                            Mantenha os computadores, servidores e rede da sua empresa sempre em operação com técnicos dedicados.
                        </p>
                    </div>
                    <div class="mt-6 relative z-10">
                        <a href="/tec" class="promo-btn inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-black text-xs uppercase tracking-wider transition">
                            <span>Conhecer Planos de Suporte</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

                <!-- Banner 2: Criação de Sites e Portais -->
                <div class="boti-promo-banner boti-promo-web rounded-3xl p-8 relative overflow-hidden flex flex-col justify-between min-h-[220px] transition-all duration-300">
                    <div class="relative z-10">
                        <span class="promo-badge px-3 py-1 rounded-full font-bold text-[10px] uppercase tracking-wider">
                            Digitalização Rápida
                        </span>
                        <h3 class="text-2xl font-black font-display mt-3">Criação de Sites &amp; Lojas Virtuais</h3>
                        <p class="promo-desc text-xs mt-2 max-w-md">
                            Desenvolvimento de websites institucionais e plataformas e-commerce responsivas para o seu negócio vender mais.
                        </p>
                    </div>
                    <div class="mt-6 relative z-10">
                        <a href="/tec" class="promo-btn inline-flex items-center gap-2 px-6 py-2.5 rounded-full font-black text-xs uppercase tracking-wider transition">
                            <span>Pedir Proposta de Website</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================== -->
        <!-- 9. BENEFÍCIOS OMNICHANNEL / ATENDIMENTO VIA WHATSAPP           -->
        <!-- ============================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-gradient-to-r from-amber-50 via-amber-100/50 to-orange-50 rounded-3xl p-8 sm:p-10 border border-amber-200/90 flex flex-col md:flex-row items-center justify-between gap-6 boti-quote-banner">
                <div class="max-w-xl">
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#b45309]">Atendimento Consultivo</span>
                    <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-display mt-1">
                        Precisa de Cotação em Lote para a sua Empresa?
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 leading-relaxed">
                        Fale diretamente com os consultores corporativos da RACHI Tec. Fornecemos fatura proforma imediata para emissão de cheques ou aprovação de compras.
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="https://wa.me/244923000000" target="_blank"
                        class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-full bg-[#071326] hover:bg-[#0d1f3d] text-[#f5a800] border border-[#f5a800]/40 font-black text-xs uppercase tracking-wider transition shadow-lg shadow-black/15">
                        <i data-lucide="message-circle" class="w-4 h-4 text-[#cda851]"></i>
                        <span>Falar com Consultor no WhatsApp</span>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- ============================================================== -->
    <!-- 10. SACOLA LATERAL (SLIDING CART DRAWER — ESTILO BOTICÁRIO)    -->
    <!-- ============================================================== -->
    <div x-show="cartDrawerOpen" x-cloak class="fixed inset-0 z-50 overflow-hidden bg-black/60 backdrop-blur-sm flex justify-end">
        <div @click.outside="cartDrawerOpen = false" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="w-full max-w-md bg-white h-full shadow-2xl flex flex-col justify-between">
            
            <!-- Cabeçalho da Sacola -->
            <div class="p-5 border-b border-slate-100 flex items-center justify-between bg-slate-50">
                <div class="flex items-center gap-2.5">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-[#f5a800]"></i>
                    <h3 class="font-bold text-base text-slate-900 font-display">Minha Sacola de Compras</h3>
                    <span class="px-2 py-0.5 rounded-full bg-[#f5a800] text-[#071326] text-[10px] font-black" x-text="cartTotalCount"></span>
                </div>
                <button @click="cartDrawerOpen = false" class="p-1 text-slate-400 hover:text-slate-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Lista de Itens na Sacola -->
            <div class="p-5 overflow-y-auto flex-1 space-y-4">
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex items-start justify-between gap-3 p-3.5 rounded-2xl bg-white border border-slate-200/90 shadow-sm">
                        <img :src="item.image" :alt="item.title" class="w-16 h-16 rounded-xl object-contain bg-slate-50 p-1.5 border">
                        
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-slate-900 line-clamp-1" x-text="item.title"></h4>
                            <span class="text-[10px] text-slate-400 block uppercase" x-text="item.category"></span>
                            
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs font-black text-[#071326]" x-text="item.price"></span>
                                
                                <!-- Controlo de Quantidade (+ / -) -->
                                <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden text-xs">
                                    <button @click="decreaseQty(index)" class="px-2 py-0.5 hover:bg-slate-100">-</button>
                                    <span class="px-2 py-0.5 font-bold" x-text="item.quantity || 1"></span>
                                    <button @click="increaseQty(index)" class="px-2 py-0.5 hover:bg-slate-100">+</button>
                                </div>
                            </div>
                        </div>

                        <button @click="removeFromCart(index)" class="text-slate-300 hover:text-rose-500 p-1">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </template>

                <div x-show="cart.length === 0" class="text-center py-16 text-slate-400">
                    <i data-lucide="shopping-bag" class="w-12 h-12 text-slate-300 mx-auto mb-2"></i>
                    <p class="text-sm font-bold text-slate-700">A sua sacola está vazia</p>
                    <p class="text-xs text-slate-400 mt-1">Adicione produtos do catálogo para gerar a sua proforma.</p>
                </div>
            </div>

            <!-- Rodapé e Checkout da Sacola -->
            <div x-show="cart.length > 0" class="p-5 border-t border-slate-100 bg-slate-50 space-y-4">
                
                <!-- Cupom de Desconto -->
                <div class="flex items-center gap-2">
                    <input type="text" x-model="couponCode" placeholder="Possui cupom? Digite aqui"
                        class="flex-1 px-3 py-2 text-xs border border-slate-300 rounded-xl bg-white uppercase font-bold focus:outline-none focus:border-[#f5a800]">
                    <button @click="applyCoupon()" class="px-3.5 py-2 bg-[#071326] text-[#f5a800] border border-[#f5a800]/40 text-xs font-bold rounded-xl hover:bg-[#0d1f3d]">
                        Aplicar
                    </button>
                </div>

                <!-- Totais -->
                <div class="space-y-1.5 text-xs">
                    <div class="flex justify-between text-slate-500">
                        <span>Subtotal:</span>
                        <strong x-text="formatKz(cartTotalAmount)"></strong>
                    </div>
                    <div x-show="discountAmount > 0" class="flex justify-between text-emerald-600 font-bold">
                        <span>Desconto Cupom (10%):</span>
                        <span x-text="'- ' + formatKz(discountAmount)"></span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Entrega em Luanda:</span>
                        <span class="text-emerald-600 font-bold">A Combinar / Grátis</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between text-sm font-black text-slate-900">
                        <span>Total Geral:</span>
                        <span class="text-base font-black text-[#071326]" x-text="formatKz(finalTotal)"></span>
                    </div>
                </div>

                <!-- Botão de Finalizar Compra -->
                <button @click="checkoutModal = true"
                    class="btn-comprar w-full py-3.5 rounded-xl font-black text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg shadow-[#f5a800]/25">
                    <i data-lucide="check-circle" class="w-4 h-4 text-[#cda851]"></i>
                    <span>Finalizar Pedido / Solicitar Proforma</span>
                </button>
            </div>

        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 11. MODAL DE VISUALIZAÇÃO RÁPIDA (QUICK VIEW MODAL)             -->
    <!-- ============================================================== -->
    <div x-show="quickViewOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="quickViewOpen = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative">
            <button @click="quickViewOpen = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <template x-if="selectedProduct">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                    <div class="h-64 bg-slate-50 rounded-2xl p-4 flex items-center justify-center border">
                        <img :src="selectedProduct.image" :alt="selectedProduct.title" class="max-h-full max-w-full object-contain">
                    </div>

                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400" x-text="selectedProduct.category"></span>
                        <h3 class="text-xl font-extrabold text-slate-900 font-display mt-1" x-text="selectedProduct.title"></h3>
                        
                        <div class="flex items-baseline gap-2 mt-3">
                            <span x-show="selectedProduct.oldPrice" class="text-xs text-slate-400 line-through" x-text="selectedProduct.oldPrice"></span>
                            <strong class="text-2xl font-black text-[#071326]" x-text="selectedProduct.price"></strong>
                        </div>

                        <p class="text-xs text-slate-600 mt-3 leading-relaxed" x-text="selectedProduct.fullDesc || selectedProduct.shortDesc"></p>

                        <!-- Especificações Bullet Points -->
                        <ul class="mt-3 space-y-1 text-[11px] text-slate-600">
                            <template x-for="(spec, i) in (selectedProduct.specs || [])" :key="i">
                                <li class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#f5a800]"></span>
                                    <span x-text="spec"></span>
                                </li>
                            </template>
                        </ul>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                            <button @click="addToCart(selectedProduct); quickViewOpen = false"
                                class="btn-comprar flex-1 py-3 rounded-xl font-black text-xs uppercase tracking-wider shadow-md">
                                Adicionar à Sacola
                            </button>
                            <button @click="quickViewOpen = false" class="px-4 py-3 border border-slate-300 rounded-xl text-xs font-bold text-slate-700 hover:bg-slate-50">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 12. MODAL DE FINALIZAÇÃO / CHECKOUT PROFORMA                   -->
    <!-- ============================================================== -->
    <div x-show="checkoutModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="checkoutModal = false" class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl relative">
            <button @click="checkoutModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-[#d97706] flex items-center justify-center mx-auto mb-2">
                    <i data-lucide="file-text" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 font-display">Solicitação de Factura Proforma</h3>
                <p class="text-xs text-slate-500 mt-1">Preencha os dados da sua empresa para receber a cotação oficial com NIF.</p>
            </div>

            <form @submit.prevent="submitOrder()" class="space-y-3.5 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nome da Empresa / Cliente *</label>
                    <input type="text" x-model="orderForm.name" required placeholder="Ex: Unitel, Sonangol, Banco BFA ou Particular" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">NIF da Empresa</label>
                        <input type="text" x-model="orderForm.nif" placeholder="5400000000" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Telefone / WhatsApp *</label>
                        <input type="tel" x-model="orderForm.phone" required placeholder="+244 9xx xxx xxx" 
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">E-mail para Envio da Factura *</label>
                    <input type="email" x-model="orderForm.email" required placeholder="compras@suaempresa.ao" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 mb-1">Endereço de Entrega em Luanda</label>
                    <input type="text" x-model="orderForm.address" placeholder="Bairro, Rua, Edifício, Luanda" 
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="font-bold text-slate-600">Total do Pedido:</span>
                    <strong class="text-base font-black text-[#071326]" x-text="formatKz(finalTotal)"></strong>
                </div>

                <button type="submit" 
                    class="btn-comprar w-full py-3.5 rounded-xl font-black text-xs uppercase tracking-wider shadow-lg">
                    Confirmar Pedido &amp; Gerar Proforma
                </button>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 13. MODAL DE LOGIN / CADASTRO (ACESSAR MINHA CONTA)            -->
    <!-- ============================================================== -->
    <div x-show="loginModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="loginModalOpen = false" class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl relative">
            <button @click="loginModalOpen = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <!-- Cabeçalho com Abas -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 rounded-full bg-amber-50 text-[#d97706] flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="user-check" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-extrabold text-slate-900 font-display" x-text="authTab === 'login' ? 'Acessar Conta Corporativa' : 'Criar Nova Conta'"></h3>
                <p class="text-xs text-slate-500 mt-1" x-text="authTab === 'login' ? 'Entre com as credenciais da sua organização ou cliente' : 'Cadastre sua empresa para gerir encomendas e cotações'"></p>
                
                <div class="flex bg-slate-100 p-1 rounded-xl mt-4">
                    <button type="button" @click="authTab = 'login'" :class="authTab === 'login' ? 'bg-white text-[#d97706] font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="flex-1 py-2 text-xs rounded-lg transition">
                        Entrar
                    </button>
                    <button type="button" @click="authTab = 'register'" :class="authTab === 'register' ? 'bg-white text-[#d97706] font-bold shadow-sm' : 'text-slate-600 hover:text-slate-900'" class="flex-1 py-2 text-xs rounded-lg transition">
                        Cadastrar
                    </button>
                </div>
            </div>

            <!-- Formulário de Login -->
            <form x-show="authTab === 'login'" @submit.prevent="submitLogin()" class="space-y-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">E-mail Corporativo ou NIF</label>
                    <input type="text" x-model="loginForm.email" required placeholder="empresa@exemplo.ao ou 5400000000"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20 transition">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="font-bold text-slate-700">Palavra-passe</label>
                        <a href="/contacto" class="text-[11px] text-[#d97706] hover:text-[#b45309] hover:underline">Esqueceu a senha?</a>
                    </div>
                    <input type="password" x-model="loginForm.password" required placeholder="••••••••"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20 transition">
                </div>

                <div class="flex items-center gap-2 text-slate-600">
                    <input type="checkbox" id="rememberMe" x-model="loginForm.remember" class="rounded text-[#f5a800] focus:ring-[#f5a800]">
                    <label for="rememberMe" class="text-xs cursor-pointer">Lembrar neste dispositivo</label>
                </div>

                <button type="submit" class="btn-comprar w-full py-3 rounded-xl font-bold text-xs uppercase tracking-wider shadow-md mt-2">
                    Acessar minha conta
                </button>
            </form>

            <!-- Formulário de Registo / Cadastro -->
            <form x-show="authTab === 'register'" @submit.prevent="submitRegister()" class="space-y-3 text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Nome da Empresa ou Cliente *</label>
                    <input type="text" x-model="registerForm.name" required placeholder="Ex: Tec Solutions, Lda"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">NIF (Opcional)</label>
                        <input type="text" x-model="registerForm.nif" placeholder="5400000000"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Telefone / WhatsApp *</label>
                        <input type="tel" x-model="registerForm.phone" required placeholder="+244 9..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                    </div>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">E-mail *</label>
                    <input type="email" x-model="registerForm.email" required placeholder="contacto@empresa.ao"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Criar Palavra-passe *</label>
                    <input type="password" x-model="registerForm.password" required placeholder="Mínimo 6 caracteres"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                </div>

                <button type="submit" class="btn-comprar w-full py-3 rounded-xl font-bold text-xs uppercase tracking-wider shadow-md mt-2">
                    Concluir Registo Corporativo
                </button>
            </form>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 14. PAINEL DO CLIENTE (MEUS DADOS, PEDIDOS, FAVORITOS...)      -->
    <!-- ============================================================== -->
    <div x-show="accountModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.outside="accountModalOpen = false" class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative max-h-[90vh] flex flex-col">
            
            <!-- Botão Fechar -->
            <button type="button" @click="accountModalOpen = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 cursor-pointer p-1.5 rounded-xl transition hover:bg-slate-100">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <!-- Cabeçalho com Abas do Painel -->
            <div class="border-b border-slate-100 pb-4 mb-5">
                <div class="flex items-center gap-3.5 mb-4">
                    <div class="w-12 h-12 rounded-full border-2 border-slate-400 flex items-center justify-center bg-slate-50 text-[#d97706] font-bold text-lg select-none">
                        <span x-text="userInitials">CC</span>
                    </div>
                    <div>
                        <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-tight" x-text="currentUser.name"></h2>
                        <span class="text-xs text-slate-500" x-text="currentUser.email"></span>
                    </div>
                </div>

                <!-- Abas Superiores -->
                <div class="flex flex-wrap gap-1.5 bg-slate-100 p-1.5 rounded-2xl text-xs font-semibold">
                    <button type="button" @click="accountTab = 'dados'" 
                        :class="accountTab === 'dados' ? 'bg-[#f5a800] text-[#071326] font-black shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="flex-1 min-w-[90px] py-2 px-2.5 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <i data-lucide="clipboard-list" class="w-3.5 h-3.5"></i>
                        <span>Meus Dados</span>
                    </button>
                    <button type="button" @click="accountTab = 'pedidos'" 
                        :class="accountTab === 'pedidos' ? 'bg-[#f5a800] text-[#071326] font-black shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="flex-1 min-w-[90px] py-2 px-2.5 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <i data-lucide="package" class="w-3.5 h-3.5"></i>
                        <span>Meus Pedidos</span>
                    </button>
                    <button type="button" @click="accountTab = 'favoritos'" 
                        :class="accountTab === 'favoritos' ? 'bg-[#f5a800] text-[#071326] font-black shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="flex-1 min-w-[90px] py-2 px-2.5 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <i data-lucide="heart" class="w-3.5 h-3.5"></i>
                        <span>Favoritos</span>
                    </button>
                    <button type="button" @click="accountTab = 'atendimento'" 
                        :class="accountTab === 'atendimento' ? 'bg-[#f5a800] text-[#071326] font-black shadow-sm' : 'text-slate-600 hover:text-slate-900'"
                        class="flex-1 min-w-[90px] py-2 px-2.5 rounded-xl transition flex items-center justify-center gap-1.5 cursor-pointer">
                        <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                        <span>Atendimento</span>
                    </button>
                </div>
            </div>

            <!-- Conteúdo Dinâmico das Abas -->
            <div class="overflow-y-auto flex-1 pr-1">

                <!-- ABA 1: MEUS DADOS -->
                <div x-show="accountTab === 'dados'" class="space-y-4 text-xs">
                    <div class="bg-gradient-to-r from-slate-50 via-amber-50/50 to-slate-50 border border-slate-200/90 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-amber-800 font-black uppercase tracking-wider">Conta Corporativa RACHI Tec</span>
                            <h4 class="font-black text-sm text-slate-900" x-text="(currentUser.name || 'Casimiro Custódio') + ' • Cliente Verificado'">Casimiro Custódio • Cliente Verificado</h4>
                            <p class="text-[11px] text-slate-600 mt-0.5">Faturação oficial com NIF, cotações em lote e entregas corporativas em Luanda.</p>
                        </div>
                        <span class="w-10 h-10 rounded-xl bg-[#071326] text-[#f5a800] flex items-center justify-center font-black text-sm border border-[#f5a800]/40 shadow-xs" x-text="userInitials">CC</span>
                    </div>

                    <form @submit.prevent="saveUserData()" class="space-y-3 pt-1">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Nome Completo</label>
                                <input type="text" x-model="currentUser.name" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">NIF da Empresa / Cliente</label>
                                <input type="text" x-model="currentUser.nif" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">E-mail Corporativo</label>
                                <input type="email" x-model="currentUser.email" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-700 mb-1">Telefone / WhatsApp</label>
                                <input type="tel" x-model="currentUser.phone" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Morada de Entrega em Luanda</label>
                            <input type="text" x-model="currentUser.address" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800] focus:ring-2 focus:ring-[#f5a800]/20">
                        </div>

                        <div class="pt-3 flex justify-end">
                            <button type="submit" class="btn-comprar py-2.5 px-6 rounded-xl font-bold text-xs uppercase tracking-wider shadow-md">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ABA 2: MEUS PEDIDOS -->
                <div x-show="accountTab === 'pedidos'" class="space-y-3 text-xs">
                    <template x-for="order in userOrders" :key="order.id">
                        <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50/50 hover:bg-white hover:border-amber-300 transition space-y-2.5">
                            <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-200/80 pb-2.5">
                                <div>
                                    <strong class="text-sm font-black text-slate-900" x-text="order.id"></strong>
                                    <span class="block text-[11px] text-slate-500" x-text="order.date"></span>
                                </div>
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border" :class="order.statusClass" x-text="order.status"></span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-slate-700 font-medium" x-text="order.items"></span>
                                <strong class="text-sm font-black text-[#071326]" x-text="order.total"></strong>
                            </div>

                            <div class="pt-2 border-t border-slate-200/60 flex items-center justify-between gap-2">
                                <span class="text-[11px] text-slate-500">Factura Proforma com NIF emitida</span>
                                <button type="button" @click="showToast('Download da factura proforma oficial ' + order.id + ' iniciado.', 'Documento Emitido', 'success')" 
                                    class="text-[11px] font-black text-[#d97706] hover:text-[#b45309] hover:underline flex items-center gap-1 cursor-pointer">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                    <span>Baixar Proforma (PDF)</span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- ABA 3: FAVORITOS -->
                <div x-show="accountTab === 'favoritos'" class="text-xs">
                    <template x-if="favorites.length === 0">
                        <div class="text-center py-10 space-y-3">
                            <div class="w-14 h-14 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                                <i data-lucide="heart" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold text-slate-800 text-sm">A sua lista de favoritos está vazia</h4>
                            <p class="text-slate-500 max-w-sm mx-auto text-xs leading-relaxed">
                                Clique no ícone de coração nos produtos do catálogo para guardá-los aqui e acompanhar preços e disponibilidade.
                            </p>
                            <button type="button" @click="accountModalOpen = false; selectCategory('todos')" class="btn-comprar py-2.5 px-5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-sm mt-2">
                                Explorar Produtos
                            </button>
                        </div>
                    </template>

                    <template x-if="favorites.length > 0">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <template x-for="p in products.filter(item => favorites.includes(item.slug))" :key="p.slug">
                                <div class="border border-slate-200 rounded-2xl p-3 flex items-center gap-3 bg-white hover:border-amber-300 transition">
                                    <img :src="p.image" :alt="p.title" class="w-14 h-14 object-contain rounded-xl bg-slate-50 p-1 border border-slate-100">
                                    <div class="min-w-0 flex-1">
                                        <h5 class="font-bold text-slate-900 text-xs truncate" x-text="p.title"></h5>
                                        <strong class="text-xs text-[#071326] font-black text-base" x-text="p.price"></strong>
                                        <div class="mt-2 flex items-center gap-2">
                                            <button type="button" @click="addToCart(p)" class="btn-comprar px-2.5 py-1 rounded-lg text-[10px] font-bold">
                                                Comprar
                                            </button>
                                            <button type="button" @click="toggleFavorite(p)" class="text-rose-500 hover:text-rose-700 text-[10px] font-medium">
                                                Remover
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

                <!-- ABA 4: ATENDIMENTO -->
                <div x-show="accountTab === 'atendimento'" class="space-y-4 text-xs">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <a href="https://wa.me/244923000000" target="_blank" class="p-3.5 rounded-2xl bg-amber-50 hover:bg-amber-100/80 border border-amber-200 text-center transition flex flex-col items-center">
                            <i data-lucide="message-circle" class="w-6 h-6 text-[#f5a800] mb-1.5"></i>
                            <strong class="font-bold text-slate-900">WhatsApp Oficial</strong>
                            <span class="text-[10px] text-slate-600 mt-0.5">+244 923 000 000</span>
                        </a>
                        <a href="tel:+244222000000" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition flex flex-col items-center">
                            <i data-lucide="phone-call" class="w-6 h-6 text-slate-700 mb-1.5"></i>
                            <strong class="font-bold text-slate-900">Linha de Suporte</strong>
                            <span class="text-[10px] text-slate-600 mt-0.5">+244 222 000 000</span>
                        </a>
                        <a href="mailto:tec@rachi.ao" class="p-3.5 rounded-2xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-center transition flex flex-col items-center">
                            <i data-lucide="mail" class="w-6 h-6 text-slate-700 mb-1.5"></i>
                            <strong class="font-bold text-slate-900">E-mail Corporativo</strong>
                            <span class="text-[10px] text-slate-600 mt-0.5">tec@rachi.ao</span>
                        </a>
                    </div>

                    <div class="border-t border-slate-200 pt-3">
                        <h4 class="font-bold text-slate-800 mb-2">Enviar Mensagem Rápida para o Suporte</h4>
                        <form @submit.prevent="sendSupportMessage()" class="space-y-3">
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Assunto</label>
                                <input type="text" x-model="supportMessage.subject" required placeholder="Ex: Dúvida sobre garantia do produto ou entrega" 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 mb-1">Mensagem</label>
                                <textarea x-model="supportMessage.message" rows="3" required placeholder="Descreva como a equipa RACHI Tec pode ajudar..." 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:border-[#f5a800]"></textarea>
                            </div>
                            <button type="submit" class="btn-comprar w-full py-2.5 rounded-xl font-bold text-xs uppercase tracking-wider shadow-sm">
                                Enviar Mensagem ao Atendimento
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- 13. RODAPÉ E-COMMERCE COMPLETO (ESTILO BOTICÁRIO)              -->
    <!-- ============================================================== -->
    <footer class="bg-[#071326] text-white pt-14 pb-10 border-t border-amber-500/20 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 pb-10 border-b border-white/10">
                
                <div class="lg:col-span-2">
                    <a href="/" class="inline-block mb-3">
                        <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-10 w-auto" onerror="this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'">
                    </a>
                    <p class="text-xs text-slate-300 leading-relaxed max-w-sm">
                        A Loja RACHI Tec é o canal oficial de suprimentos corporativos, equipamentos de informática, cabos, redes e acessórios de tecnologia da RACHI em Angola.
                    </p>
                    <div class="mt-4 text-xs text-slate-300 space-y-1">
                        <p>📍 <strong>Localização:</strong> Luanda, Angola</p>
                        <p>📧 <strong>Email de Vendas:</strong> tec@rachi.ao / loja@rachi.ao</p>
                        <p>🕒 <strong>Atendimento:</strong> Segunda a Sexta, 08h às 17h</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#f5a800] mb-4 font-black">Departamentos</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="#catalogo" @click="selectCategory('informatica')" class="hover:text-white transition">Laptops &amp; Computadores</a></li>
                        <li><a href="#catalogo" @click="selectCategory('conectividade')" class="hover:text-white transition">Cabos Console &amp; Redes</a></li>
                        <li><a href="#catalogo" @click="selectCategory('gadgets')" class="hover:text-white transition">Smartwatches &amp; TV Box</a></li>
                        <li><a href="#catalogo" @click="selectCategory('audio')" class="hover:text-white transition">Áudio &amp; Consumíveis</a></li>
                        <li><a href="#catalogo" @click="selectCategory('promocional')" class="hover:text-white transition">Material Promocional</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#f5a800] mb-4 font-black">Atendimento ao Cliente</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="/contacto" class="hover:text-white transition">Falar Connosco</a></li>
                        <li><a href="/contacto" class="hover:text-white transition">Pedir Cotação em Lote</a></li>
                        <li><a href="/#etica" class="hover:text-white transition">Termos &amp; Condições</a></li>
                        <li><a href="/#etica" class="hover:text-white transition">Política de Privacidade</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#f5a800] mb-4 font-black">Formas de Pagamento</h4>
                    <div class="space-y-2 text-xs text-slate-300">
                        <div class="flex items-center gap-2">
                            <i data-lucide="credit-card" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Multicaixa Express / TPA</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="arrow-left-right" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Transferência Bancária (IBAN)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="file-check" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Facturação a 30 dias (Empresas)</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; 2026 RACHI Tec — Loja Corporativa Oficial. Todos os direitos reservados.</p>
                <div class="flex items-center gap-3">
                    <a href="/" class="hover:text-white">Ecossistema RACHI</a>
                    <span>•</span>
                    <a href="/tec" class="hover:text-white">RACHI Tec</a>
                    <span>•</span>
                    <a href="/contacto" class="hover:text-white">Suporte</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- ============================================================== -->
    <!-- JAVASCRIPT & APP LOGIC (ALPINE.JS)                             -->
    <!-- ============================================================== -->
    <script>
        function botiLojaApp() {
            return {
                mobileNavOpen: false,
                userMenuOpen: false,
                loginModalOpen: false,
                authTab: 'login',
                userLoggedIn: false,
                currentUser: { 
                    name: '', 
                    email: '',
                    phone: '',
                    nif: '',
                    address: '',
                    balance: '0,00 AOA',
                    level: 'Corporativo'
                },
                accountModalOpen: false,
                accountTab: 'dados',
                authChannel: null,
                chatModalOpen: false,
                chatInput: '',
                chatTyping: false,
                chatMessages: [
                    {
                        sender: 'bot',
                        name: 'Suporte RACHI',
                        avatar: '/images/logo-rachi-light.png',
                        time: 'Agora',
                        text: 'Olá! Bem-vindo(a) ao Atendimento Online da RACHI Tec. Como podemos ajudar hoje?'
                    }
                ],
                userOrders: [
                    {
                        id: 'PED-2026-849201',
                        date: '20 de Setembro de 2026',
                        items: 'HP Elitebook x360 1040 G8 (1 unidade)',
                        total: '1.489.000,29 AOA',
                        status: 'Em Trânsito',
                        statusClass: 'bg-amber-100 text-amber-800 border-amber-200'
                    },
                    {
                        id: 'PED-2026-712450',
                        date: '15 de Setembro de 2026',
                        items: 'Cabo Console RS232/DB9 para RJ45 (3 unidades)',
                        total: '50.969,67 AOA',
                        status: 'Entregue',
                        statusClass: 'bg-emerald-100 text-emerald-800 border-emerald-200'
                    }
                ],
                supportMessage: {
                    subject: '',
                    message: ''
                },
                toast: {
                    show: false,
                    type: 'success',
                    title: '',
                    message: '',
                    duration: 3500,
                    timer: null
                },
                loginForm: { email: '', password: '', remember: false },
                registerForm: { name: '', nif: '', phone: '', email: '', password: '' },
                cartDrawerOpen: false,
                quickViewOpen: false,
                checkoutModal: false,
                selectedProduct: null,
                searchQuery: '',
                activeCategory: 'todos',
                sortBy: 'destaque',
                onlyFavorites: false,
                couponCode: '',
                discountPercent: 0,
                favorites: [],
                cart: [],
                
                orderForm: {
                    name: '',
                    nif: '',
                    phone: '',
                    email: '',
                    address: ''
                },

                categories: [
                    { id: 'todos', name: 'Todos os Departamentos' },
                    { id: 'informatica', name: 'Laptops & Computadores' },
                    { id: 'smartwatches', name: 'Smartwatches' },
                    { id: 'conectividade', name: 'Cabos & Conectividade' },
                    { id: 'tvbox', name: 'TV Box & Streaming 4K' },
                    { id: 'audio', name: 'Áudio & Fones' },
                    { id: 'promocional', name: 'Acessórios & Brindes' }
                ],

                products: [
                    {
                        title: "HP Elitebook x360 1040 G8 (2-in-1)",
                        category: "Laptops & Computadores",
                        catId: "informatica",
                        price: "1.489.000,29 AOA",
                        priceNum: 1489000.29,
                        oldPrice: "1.650.000,00 AOA",
                        discountPercent: "-10% OFF",
                        badge: "Mais Vendido",
                        stockText: "Disponível (4 unidades)",
                        rating: "5.0",
                        reviews: 28,
                        shortDesc: "SSD 512GB NVMe, 16GB RAM, Intel Core i7, Touchscreen conversível 360°.",
                        fullDesc: "O HP Elitebook x360 1040 G8 é o computador portátil ideal para gestores e profissionais exigentes. Ecrã tátil conversível, bateria de longa duração e máxima segurança biométrica para dados empresariais.",
                        specs: [
                            "Processador Intel Core i7 11ª Geração",
                            "Memória RAM 16GB LPDDR4x",
                            "Armazenamento SSD 512GB PCIe NVMe",
                            "Ecrã 14'' FHD Touch com rotação 360°",
                            "Teclado retroiluminado e leitor de impressão digital"
                        ],
                        image: "/images/hp-elitebook-studio.png",
                        slug: "hp-elitebook-x360-1040-g8"
                    },
                    {
                        title: "Smartwatch Lige Executivo Pro",
                        category: "Smartwatches",
                        catId: "smartwatches",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "15.000,00 AOA",
                        discountPercent: "-33% OFF",
                        badge: "Destaque",
                        stockText: "Disponível (25 unidades)",
                        rating: "4.8",
                        reviews: 42,
                        shortDesc: "Visor digital AMOLED, chamadas Bluetooth e pulseira de aço inoxidável.",
                        fullDesc: "Relógio inteligente com acabamento executivo de luxo. Receba chamadas, notificações corporativas e acompanhe métricas de saúde com bateria de até 7 dias.",
                        specs: [
                            "Visor AMOLED de alta definição",
                            "Atendimento de chamadas via Bluetooth",
                            "Resistência à água IP68",
                            "Compatível com Android e iOS"
                        ],
                        image: "/images/smartwatch-studio.png",
                        slug: "smartwatch-lige-executivo"
                    },
                    {
                        title: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        category: "Cabos & Conectividade",
                        catId: "conectividade",
                        price: "16.989,89 AOA",
                        priceNum: 16989.89,
                        oldPrice: "18.000,00 AOA",
                        discountPercent: "-6% OFF",
                        badge: "Essencial TI",
                        stockText: "Disponível em Luanda",
                        rating: "4.9",
                        reviews: 19,
                        shortDesc: "Cabo serial padrão para configuração de roteadores e switches.",
                        fullDesc: "Cabo console de alta durabilidade para técnicos de redes e administradores de sistemas. Compatível com Cisco, Huawei, MikroTik, HP e switches corporativos.",
                        specs: [
                            "Comprimento: 1.5 metros",
                            "Conector DB9 fêmea para RJ45 macho",
                            "Revestimento flexível em PVC reforçado"
                        ],
                        image: "/images/cabo-console-studio.png",
                        slug: "cabo-console-rs232-db9-rj45"
                    },
                    {
                        title: "TV Box Android MXQ Pro 4K Ultra HD",
                        category: "TV Box & Streaming 4K",
                        catId: "tvbox",
                        price: "18.000,00 AOA",
                        priceNum: 18000.00,
                        oldPrice: "25.000,00 AOA",
                        discountPercent: "-28% OFF",
                        badge: "Promoção",
                        stockText: "Disponível em Luanda",
                        rating: "4.7",
                        reviews: 35,
                        shortDesc: "Streaming 4K, Wi-Fi integrado, HDMI e suporte a aplicativos corporativos.",
                        fullDesc: "Transforme qualquer monitor ou televisão numa estação multimídia inteligente. Ideal para salas de reuniões, sinalética digital comercial ou entretenimento.",
                        specs: [
                            "Resolução máxima 4K Ultra HD",
                            "4GB RAM + 64GB Armazenamento interno",
                            "Conexão Wi-Fi e porta Ethernet RJ45",
                            "Acompanha comando remoto e cabo HDMI"
                        ],
                        image: "/images/tvbox-studio.png",
                        slug: "tv-box-android-mxq-pro-4k"
                    },
                    {
                        title: "Auricular com Fio 3.5mm Alta Fidelidade",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        price: "3.000,00 AOA",
                        priceNum: 3000.00,
                        oldPrice: "5.000,00 AOA",
                        discountPercent: "-40% OFF",
                        badge: "Mais Barato",
                        stockText: "Disponível (50 unidades)",
                        rating: "4.6",
                        reviews: 50,
                        shortDesc: "Áudio estéreo nítido com microfone embutido para reuniões e chamadas.",
                        fullDesc: "Auriculares com fio Jack 3.5mm ideais para escritórios, call centers e reuniões do Microsoft Teams e Zoom com som limpo e isolamento acústico.",
                        specs: [
                            "Conector padrão P2 / Jack 3.5mm",
                            "Microfone de alta sensibilidade no cabo",
                            "Cabo emborrachado anti-emaranhamento"
                        ],
                        image: "/images/auricular-fio-studio.png",
                        slug: "auricular-com-fio-3-5mm"
                    },
                    {
                        title: "Auriculares sem Fio Bluetooth TWS",
                        category: "Áudio & Consumíveis",
                        catId: "audio",
                        price: "15.000,00 AOA",
                        priceNum: 15000.00,
                        oldPrice: "20.000,00 AOA",
                        discountPercent: "-25% OFF",
                        badge: "Lançamento",
                        stockText: "Disponível em Luanda",
                        rating: "4.9",
                        reviews: 22,
                        shortDesc: "Conexão Bluetooth 5.3, estojo com visor LED e autonomia até 24h.",
                        fullDesc: "Fone de ouvido sem fio de última geração com emparelhamento instantâneo, cancelamento de ruído ambiental para chamadas e conforto ergonómico prolongado.",
                        specs: [
                            "Bluetooth 5.3 estável de longo alcance",
                            "Autonomia de 6 horas contínuas (24h com estojo)",
                            "Estojo com indicador digital de bateria"
                        ],
                        image: "/images/auriculares-tws-studio.png",
                        slug: "auriculares-sem-fio-bluetooth"
                    },
                    {
                        title: "Capa Temática Naruto para iPhone",
                        category: "Acessórios & Brindes",
                        catId: "promocional",
                        price: "7.000,00 AOA",
                        priceNum: 7000.00,
                        oldPrice: "9.500,00 AOA",
                        discountPercent: "-26% OFF",
                        badge: "Popular",
                        stockText: "Disponível",
                        rating: "4.9",
                        reviews: 17,
                        shortDesc: "Silicone reforçado com proteção contra quedas e acabamento fosco.",
                        fullDesc: "Capa protetora de alta densidade compatível com iPhone 11 / 12 Pro. Estampa de alta definição que não desbota e bordas elevadas para resguardar a câmara.",
                        specs: [
                            "Material: TPU Flexível de alta resistência",
                            "Absorção de impacto nas 4 quinas",
                            "Cortes precisos para carregador e botões"
                        ],
                        image: "/images/capa-iphone-studio.png",
                        slug: "capa-tematica-naruto-iphone"
                    }
                ],

                get filteredProducts() {
                    let list = this.products;
                    if (this.activeCategory !== 'todos') {
                        if (this.activeCategory === 'gadgets') {
                            list = list.filter(p => p.catId === 'smartwatches' || p.catId === 'tvbox' || p.catId === 'gadgets');
                        } else {
                            list = list.filter(p => p.catId === this.activeCategory);
                        }
                    }
                    if (this.searchQuery.trim()) {
                        const q = this.searchQuery.toLowerCase().trim();
                        list = list.filter(p => p.title.toLowerCase().includes(q) || p.category.toLowerCase().includes(q) || p.shortDesc.toLowerCase().includes(q));
                    }
                    if (this.onlyFavorites) {
                        list = list.filter(p => this.favorites.includes(p.slug));
                    }
                    if (this.sortBy === 'menor_preco') {
                        list = [...list].sort((a, b) => a.priceNum - b.priceNum);
                    } else if (this.sortBy === 'maior_preco') {
                        list = [...list].sort((a, b) => b.priceNum - a.priceNum);
                    } else if (this.sortBy === 'nome') {
                        list = [...list].sort((a, b) => a.title.localeCompare(b.title));
                    }
                    return list;
                },

                get currentCategoryTitle() {
                    const c = this.categories.find(item => item.id === this.activeCategory);
                    return c ? c.name : 'Todos os Produtos';
                },

                get cartTotalCount() {
                    return this.cart.reduce((total, item) => total + (item.quantity || 1), 0);
                },

                get cartTotalAmount() {
                    return this.cart.reduce((total, item) => total + (item.priceNum * (item.quantity || 1)), 0);
                },

                get discountAmount() {
                    return (this.cartTotalAmount * this.discountPercent) / 100;
                },

                get finalTotal() {
                    return Math.max(0, this.cartTotalAmount - this.discountAmount);
                },

                get userInitials() {
                    if (!this.currentUser || !this.currentUser.name) return 'CC';
                    const parts = this.currentUser.name.trim().split(/s+/);
                    if (parts.length >= 2) {
                        return (parts[0][0] + parts[1][0]).toUpperCase();
                    }
                    return parts[0].slice(0, 2).toUpperCase();
                },

                get currentUserFirstName() {
                    if (!this.currentUser || !this.currentUser.name) return 'Casimiro';
                    return this.currentUser.name.trim().split(/s+/)[0];
                },

                selectCategory(catId) {
                    this.activeCategory = catId;
                    this.onlyFavorites = false;
                    this.searchQuery = '';
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                        const el = document.getElementById('catalogo');
                        if (el) el.scrollIntoView({ behavior: 'smooth' });
                    });
                },

                filterOnlyPromo() {
                    this.activeCategory = 'todos';
                    this.onlyFavorites = false;
                    this.products.sort((a, b) => (b.discountPercent ? 1 : 0) - (a.discountPercent ? 1 : 0));
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                        const el = document.getElementById('catalogo');
                        if (el) el.scrollIntoView({ behavior: 'smooth' });
                    });
                },

                resetFilters() {
                    this.activeCategory = 'todos';
                    this.searchQuery = '';
                    this.onlyFavorites = false;
                    this.$nextTick(() => lucide.createIcons());
                },

                openQuickView(p) {
                    this.selectedProduct = p;
                    this.quickViewOpen = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                addToCart(p) {
                    const existing = this.cart.find(item => item.slug === p.slug);
                    if (existing) {
                        existing.quantity = (existing.quantity || 1) + 1;
                    } else {
                        this.cart.push({
                            title: p.title,
                            category: p.category,
                            price: p.price,
                            priceNum: p.priceNum,
                            image: p.image,
                            slug: p.slug,
                            quantity: 1
                        });
                    }
                    this.cartDrawerOpen = true;
                    this.showToast(p.title + ' adicionado à sua sacola!', 'Produto Adicionado', 'success', 2500);
                    this.$nextTick(() => lucide.createIcons());
                },

                increaseQty(idx) {
                    this.cart[idx].quantity = (this.cart[idx].quantity || 1) + 1;
                },

                decreaseQty(idx) {
                    if (this.cart[idx].quantity > 1) {
                        this.cart[idx].quantity--;
                    } else {
                        this.removeFromCart(idx);
                    }
                },

                removeFromCart(idx) {
                    this.cart.splice(idx, 1);
                },

                toggleFavorite(p) {
                    const idx = this.favorites.indexOf(p.slug);
                    if (idx > -1) {
                        this.favorites.splice(idx, 1);
                    } else {
                        this.favorites.push(p.slug);
                    }
                },

                isFavorite(p) {
                    return this.favorites.includes(p.slug);
                },

                showToast(message, title = 'Notificação', type = 'success', duration = 3500) {
                    if (this.toast.timer) clearTimeout(this.toast.timer);
                    this.toast.title = title;
                    this.toast.message = message;
                    this.toast.type = type;
                    this.toast.duration = duration;
                    this.toast.show = true;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                    this.toast.timer = setTimeout(() => {
                        this.toast.show = false;
                    }, duration);
                },

                logout() {
                    this.userLoggedIn = false;
                    this.currentUser = { name: '', email: '' };
                    this.userMenuOpen = false;
                    this.accountModalOpen = false;

                    // 1. Sincronizar no localStorage para todas as janelas/abas existentes e futuras
                    try {
                        localStorage.removeItem('rachi_user_session');
                        localStorage.removeItem('rachi_academy_auth');
                        localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                    } catch (e) {}

                    // 2. Transmissão imediata via BroadcastChannel para deslogar em tempo real em todas as telas abertas
                    try {
                        if (this.authChannel) {
                            this.authChannel.postMessage({ action: 'logout', timestamp: Date.now() });
                        }
                    } catch (e) {}

                    this.showToast('Terminou a sessão com sucesso em todas as telas do ecossistema.', 'Sessão Encerrada', 'info', 3000);
                },

                applyCoupon() {
                    const code = this.couponCode.trim().toUpperCase();
                    if (code === 'RACHITEC' || code === 'RACHI10' || code === 'BEMVINDO') {
                        this.discountPercent = 10;
                        this.showToast('Ganhou 10% de desconto no total da sua compra.', 'Cupom Ativado!', 'success', 3500);
                    } else {
                        this.showToast('Cupom inválido ou expirado. Tente o código: RACHITEC', 'Cupom Inválido', 'warning', 3500);
                    }
                },

                formatKz(value) {
                    if (!value) return '0,00 AOA';
                    return new Intl.NumberFormat('pt-AO', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(value) + ' AOA';
                },

                submitOrder() {
                    const orderNum = 'PED-2026-' + Math.floor(100000 + Math.random() * 900000);
                    const clientName = this.orderForm.name || 'Cliente';
                    const clientEmail = this.orderForm.email || 'empresa@cliente.ao';
                    this.cart = [];
                    this.checkoutModal = false;
                    this.cartDrawerOpen = false;
                    this.orderForm = { name: '', nif: '', phone: '', email: '', address: '' };
                    this.showToast(
                        'Factura proforma formal gerada e enviada para ' + clientEmail + '. Entraremos em contacto para entrega em Luanda.',
                        '🎉 Pedido ' + orderNum + ' Registado!',
                        'success',
                        5500
                    );
                },

                submitLogin() {
                    const identifier = this.loginForm.email.trim() || 'casimirogundja@outlook.com';
                    this.userLoggedIn = true;
                    this.currentUser = {
                        name: 'Casimiro Custódio',
                        email: identifier,
                        phone: '+244 923 000 000',
                        nif: '5001239840',
                        address: 'Edifício Kilamba, Luanda, Angola',
                        balance: '0,00 AOA',
                        level: 'Corporativo',
                        has_matricula: identifier.toLowerCase().includes('aluno') || identifier.toLowerCase().includes('casimiro'),
                        role: 'customer',
                        tipo: 'cliente'
                    };
                    this.loginModalOpen = false;
                    this.userMenuOpen = false;

                    const unified = {
                        ...this.currentUser,
                        nome: this.currentUser.name,
                        name: this.currentUser.name,
                        loggedIn: true,
                        user: this.currentUser
                    };

                    // Sincronizar login em todas as telas
                    try {
                        localStorage.setItem('rachi_user_session', JSON.stringify(unified));
                        if (unified.has_matricula) {
                            localStorage.setItem('rachi_academy_auth', 'true');
                        }
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                        if (this.authChannel) {
                            this.authChannel.postMessage({ action: 'login', user: unified, timestamp: Date.now() });
                        }
                    } catch (e) {}

                    this.showToast(
                        'Sessão iniciada com sucesso! Bem-vindo(a) à RACHI: ' + identifier,
                        'Autenticado com Sucesso',
                        'success',
                        3500
                    );
                },

                submitRegister() {
                    const empName = this.registerForm.name.trim() || 'Casimiro Custódio';
                    const empEmail = this.registerForm.email.trim() || 'casimirogundja@outlook.com';
                    this.userLoggedIn = true;
                    this.currentUser = {
                        name: empName,
                        email: empEmail,
                        phone: this.registerForm.phone || '+244 923 000 000',
                        nif: this.registerForm.nif || '5001239840',
                        address: 'Luanda, Angola',
                        balance: '0,00 AOA',
                        level: 'Corporativo',
                        has_matricula: false,
                        role: 'customer',
                        tipo: 'cliente'
                    };
                    this.loginModalOpen = false;
                    this.userMenuOpen = false;

                    const unified = {
                        ...this.currentUser,
                        nome: this.currentUser.name,
                        name: this.currentUser.name,
                        loggedIn: true,
                        user: this.currentUser
                    };

                    // Sincronizar registro em todas as telas
                    try {
                        localStorage.setItem('rachi_user_session', JSON.stringify(unified));
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                        if (this.authChannel) {
                            this.authChannel.postMessage({ action: 'login', user: unified, timestamp: Date.now() });
                        }
                    } catch (e) {}

                    this.showToast(
                        'Registo criado com sucesso para a empresa ' + empName + '! NIF: ' + (this.registerForm.nif || 'Registado'),
                        'Conta Corporativa Criada',
                        'success',
                        4000
                    );
                },

                openChatModal() {
                    this.chatModalOpen = true;
                    this.userMenuOpen = false;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                        const feed = document.getElementById('rachi-chat-feed');
                        if (feed) feed.scrollTop = feed.scrollHeight;
                    });
                },

                closeChatModal() {
                    this.chatModalOpen = false;
                },

                sendChatMessage(customText = null) {
                    const text = (customText || this.chatInput).trim();
                    if (!text) return;
                    
                    const now = new Date();
                    const timeStr = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
                    
                    this.chatMessages.push({
                        sender: 'user',
                        name: this.userLoggedIn && this.currentUser.name ? this.currentUser.name : 'Você',
                        time: timeStr,
                        text: text
                    });
                    this.chatInput = '';
                    
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                        const feed = document.getElementById('rachi-chat-feed');
                        if (feed) feed.scrollTop = feed.scrollHeight;
                    });

                    this.chatTyping = true;
                    setTimeout(() => {
                        this.chatTyping = false;
                        let reply = '';
                        const lower = text.toLowerCase();
                        
                        if (lower.includes('pedido') || lower.includes('encomenda') || lower.includes('rastreio')) {
                            reply = 'Para consultar o seu pedido, aceda a "Meus Pedidos" no menu da sua conta ou informe o número do pedido aqui. Faturas proforma são emitidas com prazo de entrega imediato em Luanda.';
                        } else if (lower.includes('preco') || lower.includes('preço') || lower.includes('nif') || lower.includes('fatura') || lower.includes('pagamento') || lower.includes('factura')) {
                            reply = 'Os preços apresentados incluem IVA em Kwanzas (AOA). Emitimos Fatura Proforma formal e Fatura Comercial com o NIF da sua empresa. Aceitamos pagamentos por transferência bancária (IBAN) e multicaixa.';
                        } else if (lower.includes('entrega') || lower.includes('luanda') || lower.includes('levantamento') || lower.includes('onde')) {
                            reply = 'Fazemos entregas em toda a província de Luanda num prazo ágil de 24h a 48h úteis. Também pode realizar o levantamento gratuito das suas encomendas diretamente nas instalações da RACHI no Edifício Kilamba.';
                        } else if (lower.includes('laptop') || lower.includes('computador') || lower.includes('cabo') || lower.includes('tv box') || lower.includes('equipamento') || lower.includes('produto')) {
                            reply = 'Todos os nossos equipamentos informáticos contam com garantia oficial corporativa RACHI. Se desejar uma cotação para lotes empresariais, podemos preparar uma proposta formal de imediato.';
                        } else if (lower.includes('humano') || lower.includes('atendente') || lower.includes('falar') || lower.includes('whatsapp') || lower.includes('ligar')) {
                            reply = 'Com certeza! Pode falar diretamente com um dos nossos consultores pelo WhatsApp: +244 923 000 000 ou por telefone: +244 222 000 000. Estamos disponíveis de Seg. a Sex. das 08h às 17h.';
                        } else {
                            reply = 'Obrigado pelo seu contacto! A sua solicitação foi registada na nossa central RACHI. Se preferir atendimento imediato em tempo real com o consultor de plantão, pode utilizar o nosso WhatsApp: +244 923 000 000.';
                        }

                        this.chatMessages.push({
                            sender: 'bot',
                            name: 'Suporte RACHI',
                            avatar: '/images/logo-rachi-light.png',
                            time: String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0'),
                            text: reply
                        });

                        this.$nextTick(() => {
                            if (window.lucide) lucide.createIcons();
                            const feed = document.getElementById('rachi-chat-feed');
                            if (feed) feed.scrollTop = feed.scrollHeight;
                        });
                    }, 700);
                },

                openAccountModal(tab = 'dados') {
                    this.accountTab = tab;
                    this.accountModalOpen = true;
                    this.userMenuOpen = false;
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

                saveUserData() {
                    try {
                        localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: true, user: this.currentUser }));
                        localStorage.setItem('rachi_auth_sync', JSON.stringify({ action: 'update', user: this.currentUser, timestamp: Date.now() }));
                        if (this.authChannel) {
                            this.authChannel.postMessage({ action: 'update', user: this.currentUser, timestamp: Date.now() });
                        }
                    } catch (e) {}
                    this.showToast('Dados cadastrais atualizados com sucesso!', 'Perfil Atualizado', 'success', 3500);
                    this.accountModalOpen = false;
                },

                sendSupportMessage() {
                    this.showToast('Mensagem enviada com sucesso ao suporte RACHI Tec!', 'Atendimento Enviado', 'success', 4000);
                    this.supportMessage = { subject: '', message: '' };
                },

                filterProducts() {
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

                sortProducts() {
                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

                syncSessionFromStorage() {
                    try {
                        const raw = localStorage.getItem('rachi_user_session');
                        if (!raw) {
                            this.userLoggedIn = false;
                            this.currentUser = { name: '', email: '' };
                            return;
                        }
                        const parsed = JSON.parse(raw);
                        if (parsed.loggedIn === false) {
                            this.userLoggedIn = false;
                            this.currentUser = { name: '', email: '' };
                            return;
                        }
                        const u = parsed.user || (parsed.email ? parsed : null);
                        if (u && (u.name || u.nome || u.email)) {
                            this.userLoggedIn = true;
                            this.currentUser = {
                                name: u.name || u.nome || 'Cliente RACHI',
                                email: u.email || '',
                                phone: u.phone || '+244 923 000 000',
                                nif: u.nif || '5001239840',
                                address: u.address || 'Luanda, Angola',
                                balance: u.balance || '0,00 AOA',
                                level: u.level || 'Corporativo',
                                has_matricula: !!u.has_matricula,
                                role: u.role || 'customer'
                            };
                        } else {
                            this.userLoggedIn = false;
                            this.currentUser = { name: '', email: '' };
                        }
                    } catch(e) {
                        this.userLoggedIn = false;
                        this.currentUser = { name: '', email: '' };
                    }
                },

                init() {
                    // 1. Inicializar e restaurar sessão sincronizada entre todas as telas
                    this.syncSessionFromStorage();

                    // 2. BroadcastChannel para sincronização instantânea em tempo real entre todas as telas
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            this.authChannel = new BroadcastChannel('rachi_auth_channel');
                            this.authChannel.onmessage = (event) => {
                                const data = event.data;
                                if (!data) return;
                                if (data.action === 'logout') {
                                    this.userLoggedIn = false;
                                    this.currentUser = { name: '', email: '' };
                                    this.accountModalOpen = false;
                                    this.userMenuOpen = false;
                                    this.showToast('A sessão foi encerrada noutro ecrã ou separador.', 'Sessão Encerrada', 'info', 3500);
                                } else if (data.action === 'login') {
                                    this.syncSessionFromStorage();
                                    this.showToast('Sessão conectada: ' + (this.currentUser.name || 'Cliente'), 'Sessão Sincronizada', 'success', 3500);
                                } else if (data.action === 'update' && data.user) {
                                    this.syncSessionFromStorage();
                                }
                            };
                        }
                    } catch (e) {}

                    // 3. Ouvinte de evento storage (para compatibilidade total com todas as abas e janelas do navegador)
                    window.addEventListener('storage', (event) => {
                        if (event.key === 'rachi_user_session' || event.key === 'rachi_auth_sync') {
                            this.syncSessionFromStorage();
                        }
                    });

                    // Watchers do Alpine
                    this.$watch('userMenuOpen', (val) => {
                        if (val && window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    this.$watch('loginModalOpen', (val) => {
                        if (val && window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    this.$watch('chatModalOpen', (val) => {
                        if (val && window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    this.$watch('accountModalOpen', (val) => {
                        if (val && window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    this.$watch('accountTab', () => {
                        if (window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    this.$watch('toast.show', (val) => {
                        if (val && window.lucide) {
                            this.$nextTick(() => lucide.createIcons());
                        }
                    });
                    if (window.lucide) {
                        this.$nextTick(() => lucide.createIcons());
                    }
                }
            }
        }

        // Rolagem amigável com arrasto do mouse e roda do mouse horizontal
        function enableFriendlyScroll(el) {
            if (!el) return;
            let isDown = false;
            let startX = 0;
            let scrollLeft = 0;
            let isDragging = false;

            el.addEventListener('mousedown', (e) => {
                isDown = true;
                isDragging = false;
                startX = e.pageX - el.offsetLeft;
                scrollLeft = el.scrollLeft;
            });

            el.addEventListener('mouseleave', () => {
                isDown = false;
            });

            el.addEventListener('mouseup', () => {
                isDown = false;
                setTimeout(() => { isDragging = false; }, 50);
            });

            el.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                const x = e.pageX - el.offsetLeft;
                const walk = (x - startX);
                if (Math.abs(walk) > 6) {
                    isDragging = true;
                    e.preventDefault();
                    el.scrollLeft = scrollLeft - walk;
                }
            });

            // Previne clique acidental quando o usuário estava apenas arrastando
            el.addEventListener('click', (e) => {
                if (isDragging) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            }, true);

            // Roda do mouse rola suavemente no sentido horizontal
            el.addEventListener('wheel', (e) => {
                if (e.deltaY !== 0 && !e.shiftKey) {
                    e.preventDefault();
                    el.scrollBy({ left: e.deltaY * 1.5, behavior: 'smooth' });
                }
            }, { passive: false });
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
            enableFriendlyScroll(document.getElementById('categories-scroll-row'));
            enableFriendlyScroll(document.getElementById('bubble-track-row'));
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\casimiro.gundja\Documents\rachi\resources\views/public/store/index.blade.php ENDPATH**/ ?>