<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Print (Gráfica &amp; Produção)</title>
    <meta name="description" content="{{ $service['short_desc'] }}">

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
        section[id], div[id] { scroll-margin-top: 95px; }

        body {
            font-family: 'Inter', sans-serif;
            color: #0b1a2e;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        html.dark body {
            background-color: #080c16;
            color: #f8fafc;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
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
        html:not(.dark) .site-header .header-dropdown {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
        }
        html:not(.dark) .site-header .header-dropdown a {
            color: #334155 !important;
        }
        html:not(.dark) .site-header .header-dropdown a:hover {
            background-color: #f8fafc !important;
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

        .btn-cta-amber {
            background: linear-gradient(135deg, #f5a800 0%, #e08b00 100%);
            color: #080c16;
            font-weight: 700;
            border-radius: 9999px;
            padding: 0.5rem 1.25rem;
            font-size: 0.8125rem;
            box-shadow: 0 4px 15px rgba(245, 168, 0, 0.35);
            transition: all 0.2s ease;
            display: inline-flex; align-items: center; gap: 0.5rem;
            text-decoration: none;
        }
        .btn-cta-amber:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245, 168, 0, 0.5);
            color: #050d1a;
        }
    </style>
    <link rel="stylesheet" href="/css/print-services.css?v=20261011-2">

    <!-- Alpine Store & Global Modal Logic (Loaded before body parsing) -->
    <script>
        function printServiceStudio() {
            return {
                mobileMenuOpen: false, 
                solutionsOpen: false,                 activeModalImage: null,
                activeModalTitle: '',
                activeModalDesc: '',
                activeModalTag: '',
                showQuoteModal: false,
                quoteProduct: '',
                quoteCategory: @json($service['title'] ?? 'RACHI Print'),
                quoteServiceSlug: @json($service['slug'] ?? ''),
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
                openModal: function(img, title, desc, tag) {
                    this.activeModalImage = img;
                    this.activeModalTitle = title;
                    this.activeModalDesc = desc;
                    this.activeModalTag = tag;
                    document.body.style.overflow = 'hidden';
                    this.$nextTick(function() {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },
                closeModal: function() {
                    this.activeModalImage = null;
                    if (!this.showQuoteModal) {
                        document.body.style.overflow = '';
                    }
                },
                openQuoteModal: function(productName) {
                    this.quoteProduct = productName || @json($service['title'] ?? 'RACHI Print');
                    this.quoteSubmitting = false;
                    this.quoteSuccess = false;
                    this.quoteErrorMsg = '';
                    this.quoteProtocol = '';
                    this.showQuoteModal = true;
                    document.body.style.overflow = 'hidden';

                    // Update DOM fallback inputs
                    var titleEl = document.getElementById('modal-quote-product-display');
                    if (titleEl) titleEl.textContent = this.quoteProduct;
                    var prodInput = document.getElementById('modal-quote-product-input');
                    if (prodInput) prodInput.value = this.quoteProduct;

                    var formBox = document.getElementById('quote-modal-form-content');
                    if (formBox) formBox.style.display = 'block';
                    var successBox = document.getElementById('quote-modal-success-content');
                    if (successBox) successBox.style.display = 'none';

                    this.$nextTick(function() {
                        if (window.lucide) window.lucide.createIcons();
                    });
                },
                closeQuoteModal: function() {
                    this.showQuoteModal = false;
                    var modalEl = document.getElementById('rachi-quote-modal');
                    if (modalEl) modalEl.style.display = 'none';
                    if (!this.activeModalImage) {
                        document.body.style.overflow = '';
                    }
                },
                submitQuote: async function() {
                    if (this.quoteSubmitting || this.quoteSuccess) return;
                    if (!this.quoteForm.name || !this.quoteForm.email || !this.quoteForm.phone) {
                        this.quoteErrorMsg = 'Por favor preencha os campos obrigatórios (Nome, E-mail e Telefone).';
                        return;
                    }
                    this.quoteSubmitting = true;
                    this.quoteErrorMsg = '';

                    try {
                        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        var token = csrfMeta ? csrfMeta.getAttribute('content') : '';
                        var res = await fetch('/print/solicitar-cotacao', {
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

                        var data = await res.json();
                        if (res.ok && data.success) {
                            this.quoteSuccess = true;
                            this.quoteProtocol = data.protocol;
                            var protoEl = document.getElementById('quote-protocol-display');
                            if (protoEl) protoEl.textContent = data.protocol;
                            var prodSuccessEl = document.getElementById('quote-success-product-display');
                            if (prodSuccessEl) prodSuccessEl.textContent = this.quoteProduct;
                            var formBox = document.getElementById('quote-modal-form-content');
                            if (formBox) formBox.style.display = 'none';
                            var successBox = document.getElementById('quote-modal-success-content');
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
                        this.$nextTick(function() {
                            if (window.lucide) window.lucide.createIcons();
                        });
                    }
                },
                requestProduct: function(prodName) {
                    this.openQuoteModal(prodName);
                },
                init: function() {
                    window.rachiPrintServiceInstance = this;
                    var self = this;
                    window.rachiOpenQuote = function(name) { self.openQuoteModal(name); };

                    var params = new URLSearchParams(window.location.search);
                    var prod = params.get('produto');
                    if (prod) {
                        this.$nextTick(function() {
                            self.openQuoteModal(decodeURIComponent(prod));
                        });
                    }
                }
            };
        }

        window.printServiceStudio = printServiceStudio;
        document.addEventListener('alpine:init', function() {
            if (window.Alpine) {
                Alpine.data('printServiceStudio', printServiceStudio);
            }
        });

        window.rachiOpenQuoteModal = function(productName) {
            productName = productName || @json($service['title'] ?? 'RACHI Print');
            if (window.rachiPrintServiceInstance && typeof window.rachiPrintServiceInstance.openQuoteModal === 'function') {
                window.rachiPrintServiceInstance.openQuoteModal(productName);
                return false;
            }
            try {
                var bodyEl = document.querySelector('body[x-data]');
                if (bodyEl && window.Alpine) {
                    var d = Alpine.$data(bodyEl);
                    if (d && typeof d.openQuoteModal === 'function') {
                        d.openQuoteModal(productName);
                        return false;
                    }
                }
            } catch(e) {}

            var modalEl = document.getElementById('rachi-quote-modal');
            if (modalEl) {
                modalEl.removeAttribute('x-cloak');
                modalEl.style.display = 'flex';
                var titleEl = document.getElementById('modal-quote-product-display');
                if (titleEl) titleEl.textContent = productName;
                var prodInput = document.getElementById('modal-quote-product-input');
                if (prodInput) prodInput.value = productName;
                var formBox = document.getElementById('quote-modal-form-content');
                if (formBox) formBox.style.display = 'block';
                var successBox = document.getElementById('quote-modal-success-content');
                if (successBox) successBox.style.display = 'none';
                document.body.style.overflow = 'hidden';
            }
            return false;
        };

        window.rachiCloseQuoteModal = function() {
            if (window.rachiPrintServiceInstance && typeof window.rachiPrintServiceInstance.closeQuoteModal === 'function') {
                window.rachiPrintServiceInstance.closeQuoteModal();
                return false;
            }
            try {
                var bodyEl = document.querySelector('body[x-data]');
                if (bodyEl && window.Alpine) {
                    var d = Alpine.$data(bodyEl);
                    if (d && typeof d.closeQuoteModal === 'function') {
                        d.closeQuoteModal();
                        return false;
                    }
                }
            } catch(e) {}

            var modalEl = document.getElementById('rachi-quote-modal');
            if (modalEl) {
                modalEl.style.display = 'none';
                document.body.style.overflow = '';
            }
            return false;
        };
    </script>
</head>
<body x-data="printServiceStudio()" class="print-service-page antialiased selection:bg-amber-500 selection:text-white">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER                                            -->
    <!-- ============================================================ -->
    <header id="main-site-header" class="site-header py-3.5 px-4 sm:px-6 lg:px-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo RACHI Print -->
            <a href="/print" class="flex items-center gap-3 group focus:outline-none">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#f5a800]/20 to-[#080c16] p-1.5 flex items-center justify-center border border-[#f5a800]/30 shadow-md group-hover:scale-105 transition-transform duration-300">
                    <picture>
                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                        <img src="/images/areas/rachi-print.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                             alt="RACHI Print" 
                             class="h-9 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider text-slate-900 dark:text-white brand-logo-text flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#f5a800] text-xs font-bold px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20">PRINT</span>
                    </span>
                    <span class="text-[10px] text-slate-500 dark:text-slate-400 tracking-widest uppercase font-medium">Gráfica &amp; Produção</span>
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center main-nav-capsule">
                <a href="/" class="nav-link cursor-pointer">
                    <span>Home</span>
                </a>
                
                <!-- Solutions Dropdown -->
                <div class="relative" x-data="{ openSol: false }" @click.outside="openSol = false" @keydown.escape.window="openSol = false">
                    <button type="button" @click="openSol = !openSol; $nextTick(() => { if (window.lucide) window.lucide.createIcons(); })" class="nav-link flex items-center gap-1.5 focus:outline-none active cursor-pointer">
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

                <a href="/print#servicos-print" class="nav-link">
                    <span>Serviços Gráficos</span>
                </a>

                <a href="/loja" class="nav-link">
                    <span>Loja</span>
                </a>

                <a href="/contacto" class="nav-link">
                    <span>Contacto</span>
                </a>
            </nav>

            <!-- Header Actions -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                

                <button type="button" @click="openQuoteModal()" class="btn-cta-amber group cursor-pointer">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Solicitar Cotação</span>
                </button>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-slate-700 dark:text-white hover:text-amber-500 focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-white/98 dark:bg-[#080c16]/98 backdrop-blur-2xl border-b border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl transition-colors">
            <a href="/" class="block font-medium py-1.5 text-slate-800 dark:text-white hover:text-amber-600 dark:hover:text-amber-400">Home</a>
            <div class="border-t border-slate-200 dark:border-white/10 pt-2">
                <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400 tracking-wider">Soluções</span>
                <div class="pl-3 mt-1 space-y-1.5">
                    <a href="/capital" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-emerald-500">01 RACHI Human Capital</a>
                    <a href="/academy" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-500">02 RACHI Academy</a>
                    <a href="/tec" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-sky-500">03 RACHI Tec</a>
                    <a href="/print" class="block text-sm text-amber-600 dark:text-amber-400 font-bold">04 RACHI Print</a>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-white/10 pt-2 space-y-1">
                <a href="/print#produtos-graficos" @click="mobileMenuOpen = false" class="block font-medium py-1 text-slate-700 dark:text-slate-300 hover:text-amber-600 dark:hover:text-white">Catálogo de Produtos</a>
                <button type="button" @click="mobileMenuOpen = false; openQuoteModal()" class="block w-full text-left font-medium py-1 text-amber-600 dark:text-amber-400 font-bold cursor-pointer">Pedir Cotação / Proposta</button>
            </div>
        </div>
    </header>

    <!-- MEGA PAINEL DE SOLUÇÕES (ECOSSISTEMA RACHI) -->
    @include('components.solutions-mega-menu')


    <main class="pt-28 pb-16">

        <!-- ======================================================== -->
        <!-- BREADCRUMB                                               -->
        <!-- ======================================================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 overflow-x-auto whitespace-nowrap">
                <a href="/" class="hover:text-amber-600 dark:hover:text-amber-400 transition">Portal RACHI</a>
                <span class="text-slate-400">/</span>
                <a href="/print" class="hover:text-amber-600 dark:hover:text-amber-400 transition">RACHI Print</a>
                <span class="text-slate-400">/</span>
                <a href="/print#produtos-graficos" class="hover:text-amber-600 dark:hover:text-amber-400 transition">Serviços Gráficos</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $service['title'] }}</span>
            </nav>
        </div>

        <!-- ======================================================== -->
        <!-- 1. HERO DO SERVIÇO                                       -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
            <div class="print-service-hero relative rounded-3xl p-8 sm:p-12 lg:p-16 bg-gradient-to-br from-[#080c16] via-[#101a2f] to-[#080c16] border border-amber-500/25 overflow-hidden shadow-2xl text-white">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-8 space-y-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="print-service-badge text-xs font-bold uppercase tracking-widest text-amber-400 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30">
                                {{ $service['tag'] }}
                            </span>
                            <span class="print-service-brand text-xs font-bold uppercase tracking-widest text-slate-300 px-3 py-1 rounded-full bg-white/10 border border-white/15">
                                RACHI Print • Gráfica &amp; Produção
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                            {{ $service['title'] }}
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                            {{ $service['full_desc'] }}
                        </p>


                        <!-- Botões de Ação Imediata -->
                        <div class="print-service-actions pt-4 flex flex-col sm:flex-row items-center gap-4">
                            <button type="button" @click="openQuoteModal()" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl bg-gradient-to-r from-[#f5a800] to-[#e08b00] hover:from-[#e08b00] hover:to-[#c67a00] text-[#080c16] font-bold text-sm transition shadow-lg shadow-amber-500/25 cursor-pointer">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Solicitar Proposta / Cotação</span>
                            </button>
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="print-service-whatsapp w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm transition shadow-lg shadow-green-500/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Falar no WhatsApp Directo</span>
                            </a>
                            <a href="/print#produtos-graficos" class="print-service-back text-xs text-slate-400 hover:text-amber-400 transition flex items-center gap-1 py-2">
                                <span>&larr; Voltar aos serviços Print</span>
                            </a>
                        </div>
                    </div>

                    <!-- Card Visual em Destaque -->
                    <div class="lg:col-span-4">
                        <div class="print-service-visual relative rounded-3xl overflow-hidden p-6 bg-gradient-to-b from-white/10 to-white/5 border border-white/15 backdrop-blur-xl shadow-2xl flex flex-col items-center text-center group">
                            @if(!empty($service['image']))
                                <div class="w-full h-64 sm:h-72 rounded-2xl overflow-hidden mb-6 relative border border-white/10 shadow-lg">
                                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-[#f5a800] text-[#080c16] shadow">Oficial RACHI</span>
                                        <span class="text-[11px] font-semibold text-white/90 drop-shadow">Qualidade Offset/Digital</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#f5a800] to-[#080c16] p-5 flex items-center justify-center shadow-xl border border-amber-400/30 mb-6 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $service['icon'] }}" class="w-12 h-12 text-white"></i>
                                </div>
                            @endif

                            <span class="print-service-certification text-xs font-bold text-amber-400 uppercase tracking-widest mb-1">Produção Certificada</span>
                            <h3 class="text-xl font-bold text-white mb-3">{{ $service['title'] }}</h3>
                            <p class="text-xs text-slate-300 leading-relaxed mb-6">
                                Maquinário de ponta, calibração densitométrica e papéis nobres para as principais empresas de Luanda e de Angola.
                            </p>

                            <div class="print-service-guarantee w-full py-3 px-4 rounded-2xl bg-white/[0.06] border border-white/10 flex items-center justify-between text-xs text-slate-200">
                                <span class="flex items-center gap-1.5 font-semibold">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-[#f5a800]"></i>
                                    Prova de Cor Gratuita
                                </span>
                                <span class="text-[#f5a800] font-bold">100% Garantido</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ======================================================== -->
        <!-- 3. CATÁLOGO DE PRODUTOS & AMOSTRAS DESTA LINHA          -->
        <!-- ======================================================== -->
        @if(!empty($service['products']))
        <section id="catalogo-produtos" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-500 px-3.5 py-1.5 rounded-full bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800">
                    Catálogo de Produtos da Linha
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                    Produtos & Amostras de {{ $service['title'] }}
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                    Consulte as especificações detalhadas, clique para ampliar amostras reais e solicite uma cotação sob medida para a sua empresa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach($service['products'] as $prod)
                    <div id="produto-{{ \Illuminate\Support\Str::slug($prod['name']) }}" class="scroll-mt-28 group bg-white dark:bg-[#0c1322] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-xl hover:border-amber-500/50 transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        <div>
                            <!-- Imagem do Produto com Botão de Zoom -->
                            <div class="relative h-56 sm:h-60 bg-gradient-to-b from-slate-100 via-slate-50 to-white dark:from-slate-900/60 dark:to-slate-950/80 p-5 flex items-center justify-center overflow-hidden cursor-pointer border-b border-slate-100 dark:border-slate-800"
                                 @click="openModal('{{ asset($prod['image']) }}', '{{ addslashes($prod['name']) }}', '{{ addslashes($prod['desc']) }}', '{{ addslashes($prod['tag']) }}')">
                                <img src="{{ asset($prod['image']) }}" alt="{{ $prod['name'] }}" class="max-h-full max-w-full object-contain filter drop-shadow-[0_8px_16px_rgba(0,0,0,0.12)] group-hover:scale-110 transition-transform duration-500" loading="lazy">
                                
                                <span class="absolute top-3 left-3 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-amber-500 text-slate-950 shadow-md">
                                    {{ $prod['tag'] }}
                                </span>

                                <div class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-900/80 hover:bg-slate-900 text-white dark:bg-white/20 dark:hover:bg-white/30 dark:text-white backdrop-blur-md text-xs font-semibold transition shadow-sm">
                                    <i data-lucide="zoom-in" class="w-3.5 h-3.5"></i>
                                    <span>Ver Amostra</span>
                                </div>
                            </div>

                            <!-- Informações do Produto -->
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white group-hover:text-amber-500 transition leading-snug">
                                    {{ $prod['name'] }}
                                </h3>

                                <p class="text-xs text-slate-600 dark:text-slate-300 mt-2.5 leading-relaxed">
                                    {{ $prod['desc'] }}
                                </p>

                                @if(!empty($prod['specs']))
                                    <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800/80 space-y-2">
                                        <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Especificações Técnicas:</div>
                                        @foreach($prod['specs'] as $sp)
                                            <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300">
                                                <span class="w-3.5 h-3.5 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-400 flex items-center justify-center text-[9px] shrink-0 font-bold">✓</span>
                                                <span class="line-clamp-1 font-medium">{{ $sp }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Ações para Solicitar -->
                        <div class="p-6 pt-0 space-y-2.5">
                            <button type="button"
                                    @click="requestProduct('{{ addslashes($prod['name']) }}')"
                                    class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white dark:bg-slate-800 dark:border dark:border-white/10 dark:hover:bg-amber-500 dark:hover:text-slate-950 font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>Solicitar Cotação</span>
                            </button>

                            <a href="https://wa.me/244972888585?text={{ urlencode('Olá! Gostaria de solicitar cotação para o produto: ' . $prod['name'] . ' da linha ' . $service['title'] . ' da RACHI Print.') }}"
                               target="_blank"
                               class="w-full py-2.5 px-4 rounded-xl border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 hover:bg-emerald-500/10 font-bold text-xs transition flex items-center justify-center gap-2">
                                <i data-lucide="message-circle" class="w-4 h-4 text-emerald-500"></i>
                                <span>Pedir via WhatsApp</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        @endif

        <!-- ======================================================== -->
        <!-- 5. OUTROS SERVIÇOS DO CATÁLOGO RACHI PRINT               -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-500">Catálogo Completo</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Outros Serviços RACHI Print</h2>
                </div>
                <a href="/print#servicos-print" class="text-xs font-bold text-amber-500 hover:underline flex items-center gap-1">
                    <span>Ver todos</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherServices as $other)
                    <a href="{{ route('print.service.show', $other['slug']) }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-[#0c1322] border border-slate-200 dark:border-slate-800 hover:border-amber-500/50 hover:shadow-xl transition-all duration-300">
                        @if(!empty($other['image']))
                            <div class="w-full h-48 sm:h-52 relative overflow-hidden bg-slate-900">
                                <img src="{{ asset($other['image']) }}" alt="{{ $other['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0c1322] via-transparent to-transparent"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full border border-white/10">
                                    {{ $other['tag'] }}
                                </span>
                            </div>
                        @endif
                        <div class="p-5">
                            @if(empty($other['image']))
                                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-[#f5a800] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $other['icon'] }}" class="w-5 h-5"></i>
                                </div>
                                <span class="text-[10px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">{{ $other['tag'] }}</span>
                            @endif
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white mt-1 group-hover:text-amber-400 transition line-clamp-1">{{ $other['title'] }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $other['short_desc'] }}</p>
                            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $other['starting_price'] }}</span>
                                <span class="text-amber-500 font-semibold flex items-center gap-0.5 group-hover:translate-x-1 transition-transform">
                                    Ver Detalhes &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- LIGHTBOX MODAL DE PRODUTO / AMOSTRA                          -->
        <!-- ============================================================ -->
        <div x-show="activeModalImage !== null" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 bg-slate-950/80 backdrop-blur-md"
             @click.self="closeModal()"
             @keydown.escape.window="closeModal()"
             x-cloak>
            
            <div x-show="activeModalImage !== null"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 class="relative w-full max-w-4xl bg-white dark:bg-[#0c1322] rounded-3xl shadow-2xl border border-slate-200 dark:border-slate-800 overflow-hidden z-10">
                
                <!-- Close Button -->
                <button @click="closeModal()" 
                        class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center transition shadow-lg cursor-pointer">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>

                <!-- Modal Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2">
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
                            <button @click="closeModal(); openQuoteModal(activeModalTitle)"
                                    class="w-full py-3 px-5 rounded-xl bg-slate-900 hover:bg-[#f5a800] hover:text-[#080c16] text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-lg cursor-pointer">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                <span>Solicitar Cotação deste Produto</span>
                            </button>
                            <a :href="'https://wa.me/244972888585?text=' + encodeURIComponent('Olá! Gostaria de solicitar cotação para o produto: ' + activeModalTitle + ' da linha {{ $service['title'] }} da RACHI Print.')"
                               target="_blank"
                               class="w-full py-3 px-5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-600/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Pedir via WhatsApp</span>
                            </a>
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
                    </div>

                    <!-- Mensagem de Erro (se houver) -->
                    <div x-show="quoteErrorMsg" 
                         x-transition 
                         class="mb-4 p-3.5 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 text-xs flex items-start gap-2.5">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5 text-rose-500"></i>
                        <span x-text="quoteErrorMsg"></span>
                    </div>

                    <!-- Formulário -->
                    <form @submit.prevent="submitQuote()" class="space-y-4">
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
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <!-- Footer Logo Oficial RACHI Print -->
                    <a href="/print" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                            <img src="/images/areas/rachi-print.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
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
                        <li><a href="/capital" class="hover:text-emerald-400 transition">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition text-[#d97706] dark:text-[#f5a800] font-bold">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#d97706] dark:text-[#f5a800] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/" class="hover:text-slate-900 dark:hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="/print#catalogo" class="hover:text-slate-900 dark:hover:text-white transition">Catálogo de Produtos</a></li>
                        <li><a href="/#sobre" class="hover:text-slate-900 dark:hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contacto &amp; Propostas</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#d97706] dark:text-[#f5a800] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
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
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>
