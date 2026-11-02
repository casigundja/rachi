<!DOCTYPE html>
<html lang="pt-AO" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reclamações e Denúncia · RACHI</title>
    <meta name="description" content="Canal rápido e confidencial de Reclamações e Denúncia da RACHI em Angola.">
    <link rel="canonical" href="https://rachi.ao/reclamacoes-e-denuncia">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <script defer src="/libs/alpine.js"></script>
    <script src="/libs/lucide.js"></script>
    <link rel="stylesheet" href="/worker-marketing.css?v=20261030-2">

    <!-- Anti-Flash de Tema -->
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
                document.documentElement.classList.toggle('dark', e.newValue === 'dark');
            }
        });
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body.rc-body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 0;
            transition: background-color 0.25s ease, color 0.25s ease;
        }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }

        /* LIGHT MODE */
        html:not(.dark) body.rc-body {
            background-color: #f4f7fb !important;
            color: #1e293b !important;
        }
        html:not(.dark) .rc-header {
            background: rgba(255, 255, 255, 0.94) !important;
            backdrop-filter: blur(16px) !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .rc-logo-dark { display: block !important; }
        html:not(.dark) .rc-logo-light { display: none !important; }
        html:not(.dark) .rc-back {
            color: #334155 !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .rc-back:hover {
            color: #0284c7 !important;
            border-color: #bae6fd !important;
            background: #f0f9ff !important;
        }
        html:not(.dark) .rc-card {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 18px 40px -15px rgba(15, 23, 42, 0.08) !important;
        }
        html:not(.dark) .rc-tabs {
            background: #f1f5f9 !important;
            border: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .rc-tab { color: #475569 !important; }
        html:not(.dark) .rc-tab:hover { color: #0f172a !important; }
        html:not(.dark) .rc-tab.is-active {
            background: #ffffff !important;
            color: #0f172a !important;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08) !important;
        }
        html:not(.dark) .rc-title { color: #0b1a2e !important; }
        html:not(.dark) .rc-muted { color: #64748b !important; }
        html:not(.dark) .rc-label { color: #1e293b !important; }
        html:not(.dark) .rc-input {
            background-color: #f8fafc !important;
            border: 1.5px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html:not(.dark) .rc-input::placeholder { color: #94a3b8 !important; }
        html:not(.dark) .rc-input:focus {
            background-color: #ffffff !important;
            border-color: #0284c7 !important;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12) !important;
            outline: none !important;
        }
        html:not(.dark) .rc-anon-bar {
            background: #fff1f2 !important;
            border: 1px solid #fecdd3 !important;
            color: #9f1239 !important;
        }
        html:not(.dark) .rc-subbox {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .rc-attach {
            background: #f8fafc !important;
            border: 1px dashed #cbd5e1 !important;
            color: #334155 !important;
        }
        html:not(.dark) .rc-attach:hover {
            border-color: #0284c7 !important;
            color: #0284c7 !important;
        }
        html:not(.dark) .rc-link { color: #0284c7 !important; }

        /* DARK MODE */
        html.dark body.rc-body {
            background-color: #050b16 !important;
            background-image: radial-gradient(ellipse 75% 45% at 50% 0%, rgba(0, 163, 224, 0.12) 0%, transparent 65%) !important;
            color: #e2e8f0 !important;
        }
        html.dark .rc-header {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(16px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        html.dark .rc-logo-dark { display: none !important; }
        html.dark .rc-logo-light { display: block !important; }
        html.dark .rc-back {
            color: #cbd5e1 !important;
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        html.dark .rc-back:hover {
            color: #fbbf24 !important;
            border-color: rgba(245, 168, 0, 0.35) !important;
            background: rgba(245, 168, 0, 0.10) !important;
        }
        html.dark .rc-card {
            background: linear-gradient(180deg, #0c182d 0%, #091222 100%) !important;
            border: 1px solid rgba(255, 255, 255, 0.10) !important;
            box-shadow: 0 24px 55px -15px rgba(0, 0, 0, 0.65) !important;
        }
        html.dark .rc-tabs {
            background: rgba(15, 23, 42, 0.85) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
        }
        html.dark .rc-tab { color: #94a3b8 !important; }
        html.dark .rc-tab:hover { color: #f8fafc !important; }
        html.dark .rc-tab.is-active {
            background: rgba(245, 168, 0, 0.16) !important;
            color: #fbbf24 !important;
            border: 1px solid rgba(245, 168, 0, 0.32) !important;
        }
        html.dark .rc-title { color: #ffffff !important; }
        html.dark .rc-muted { color: #94a3b8 !important; }
        html.dark .rc-label { color: #f1f5f9 !important; }
        html.dark .rc-input {
            background-color: rgba(7, 15, 30, 0.85) !important;
            border: 1.5px solid rgba(255, 255, 255, 0.14) !important;
            color: #f8fafc !important;
            color-scheme: dark;
        }
        html.dark .rc-input option { background: #0b172a; color: #f8fafc; }
        html.dark .rc-input::placeholder { color: #64748b !important; }
        html.dark .rc-input:focus {
            background-color: rgba(10, 22, 42, 0.98) !important;
            border-color: #fbbf24 !important;
            box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.16) !important;
            outline: none !important;
        }
        html.dark .rc-anon-bar {
            background: rgba(136, 19, 55, 0.32) !important;
            border: 1px solid rgba(251, 113, 133, 0.30) !important;
            color: #fecdd3 !important;
        }
        html.dark .rc-subbox {
            background: rgba(15, 23, 42, 0.72) !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
        }
        html.dark .rc-attach {
            background: rgba(7, 15, 30, 0.65) !important;
            border: 1px dashed rgba(255, 255, 255, 0.20) !important;
            color: #cbd5e1 !important;
        }
        html.dark .rc-attach:hover {
            border-color: #fbbf24 !important;
            color: #fbbf24 !important;
        }
        html.dark .rc-link { color: #fbbf24 !important; }

        .rc-btn-amber {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: #071326;
            font-weight: 800;
            box-shadow: 0 8px 20px -5px rgba(217, 119, 6, 0.4);
        }
        .rc-btn-rose {
            background: linear-gradient(135deg, #e11d48 0%, #be123c 100%);
            color: #ffffff;
            font-weight: 800;
            box-shadow: 0 8px 20px -5px rgba(225, 29, 72, 0.4);
        }
        .rc-btn-blue {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            font-weight: 800;
        }
    </style>
</head>
<body class="rc-body antialiased" x-data="complaintsPortal('{{ $initialTab ?? 'reclamacao' }}')">

    <!-- HEADER LIMPO -->
    <header class="rc-header sticky top-0 z-40 px-4 sm:px-8 py-3">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center shrink-0" title="Voltar à página inicial">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="rc-logo-dark h-8 sm:h-9 w-auto object-contain">
                <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="rc-logo-light h-8 sm:h-9 w-auto object-contain">
            </a>

            <a href="/" class="rc-back text-xs font-semibold px-3.5 py-2 rounded-full inline-flex items-center gap-1.5 transition">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Voltar ao Início</span>
            </a>
        </div>
    </header>

    <!-- CONTEÚDO CENTRALIZADO E DIRECTO -->
    <main class="flex-1 w-full max-w-2xl mx-auto px-4 py-8 sm:py-10">

        <!-- Título Compacto -->
        <div class="text-center mb-6">
            <h1 class="rc-title text-2xl sm:text-3xl font-extrabold tracking-tight">
                Reclamações e Denúncia
            </h1>
            <p class="rc-muted text-xs sm:text-sm mt-1.5">
                Canal confidencial com geração imediata de protocolo de acompanhamento.
            </p>
        </div>

        <!-- CARTÃO ÚNICO E PRÁTICO -->
        <section class="rc-card rounded-3xl p-5 sm:p-7">

            <!-- Seletor Rápido em 3 Abas -->
            <div class="rc-tabs grid grid-cols-3 gap-1 p-1 rounded-2xl mb-6 text-xs font-bold">
                <button type="button"
                        @click="switchMode('reclamacao')"
                        class="rc-tab py-2.5 px-2 rounded-xl transition cursor-pointer text-center"
                        :class="activeTab === 'reclamacao' ? 'is-active' : ''">
                    Reclamação
                </button>
                <button type="button"
                        @click="switchMode('denuncia')"
                        class="rc-tab py-2.5 px-2 rounded-xl transition cursor-pointer text-center"
                        :class="activeTab === 'denuncia' ? 'is-active' : ''">
                    Denúncia
                </button>
                <button type="button"
                        @click="switchMode('consultar')"
                        class="rc-tab py-2.5 px-2 rounded-xl transition cursor-pointer text-center"
                        :class="activeTab === 'consultar' ? 'is-active' : ''">
                    Protocolo
                </button>
            </div>

            <!-- 1. CONFIRMAÇÃO DE ENVIO -->
            <div x-show="submittedResult" x-cloak class="space-y-5 text-center py-2">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 text-emerald-500 flex items-center justify-center mx-auto">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

                <div>
                    <h2 class="rc-title text-xl font-extrabold" x-text="submittedResult?.type === 'denuncia' ? 'Denúncia Registada' : 'Reclamação Registada'"></h2>
                    <p class="rc-muted text-xs sm:text-sm mt-1" x-text="submittedResult?.sla_label"></p>
                </div>

                <div class="rc-subbox rounded-2xl p-4 flex items-center justify-between gap-3 text-left">
                    <div>
                        <span class="rc-muted text-[11px] uppercase tracking-wider font-bold block">Seu Protocolo</span>
                        <strong class="rc-title text-xl sm:text-2xl font-black font-mono tracking-wider" x-text="submittedResult?.protocol"></strong>
                    </div>
                    <button type="button"
                            @click="copyProtocol(submittedResult?.protocol)"
                            class="rc-back px-3.5 py-2 rounded-xl text-xs font-bold cursor-pointer shrink-0">
                        <span x-text="copied ? 'Copiado!' : 'Copiar'"></span>
                    </button>
                </div>

                <div class="flex flex-wrap justify-center gap-3 pt-1">
                    <button type="button" @click="checkSubmittedProtocol()" class="rc-btn-blue px-5 py-2.5 rounded-xl text-xs uppercase tracking-wider cursor-pointer">
                        Acompanhar Estado
                    </button>
                    <button type="button" @click="resetForm()" class="rc-back px-5 py-2.5 rounded-xl text-xs font-bold cursor-pointer">
                        Novo Registo
                    </button>
                </div>
            </div>

            <!-- 2. CONSULTAR PROTOCOLO -->
            <div x-show="!submittedResult && activeTab === 'consultar'" x-cloak class="space-y-4">
                <form @submit.prevent="submitLookup()" class="flex flex-col sm:flex-row gap-2.5">
                    <input type="text"
                           x-model="lookupCode"
                           placeholder="Código do protocolo (ex.: REC-2026-8F4A2)"
                           class="rc-input flex-1 rounded-xl px-4 py-3 text-sm font-mono uppercase tracking-wider"
                           required>
                    <button type="submit"
                            :disabled="lookupLoading"
                            class="rc-btn-blue px-6 py-3 rounded-xl text-xs uppercase tracking-wider cursor-pointer disabled:opacity-60">
                        <span x-text="lookupLoading ? 'A procurar...' : 'Consultar'"></span>
                    </button>
                </form>

                <div x-show="lookupError" x-cloak class="p-3.5 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-500 text-xs font-semibold" x-text="lookupError"></div>

                <div x-show="lookupRecord" x-cloak class="rc-subbox rounded-2xl p-4 sm:p-5 space-y-3 text-xs">
                    <div class="flex flex-wrap items-center justify-between gap-2 pb-2.5 border-b border-slate-200/70 dark:border-white/10">
                        <strong class="rc-title text-base font-black font-mono" x-text="lookupRecord?.protocol"></strong>
                        <span class="px-3 py-1 rounded-full font-extrabold bg-amber-500/15 text-amber-500" x-text="lookupRecord?.status_label"></span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <div><span class="rc-muted">Unidade:</span> <strong class="rc-label" x-text="lookupRecord?.business_unit"></strong></div>
                        <div><span class="rc-muted">Data:</span> <strong class="rc-label" x-text="lookupRecord?.created_at"></strong></div>
                    </div>
                    <div><span class="rc-muted">Motivo:</span> <strong class="rc-label" x-text="lookupRecord?.category"></strong></div>
                    <template x-if="lookupRecord?.response_notes">
                        <div class="p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/25">
                            <strong class="text-emerald-500 block mb-0.5">Resposta RACHI:</strong>
                            <span class="rc-label" x-text="lookupRecord?.response_notes"></span>
                        </div>
                    </template>
                </div>
            </div>

            <!-- 3. FORMULÁRIO SIMPLIFICADO (RECLAMAÇÃO OU DENÚNCIA) -->
            <form x-show="!submittedResult && (activeTab === 'reclamacao' || activeTab === 'denuncia')"
                  @submit.prevent="submitForm()"
                  enctype="multipart/form-data"
                  class="space-y-4">
                @csrf

                <!-- Switch compacto de Anonimato (apenas em Denúncia) -->
                <div x-show="activeTab === 'denuncia'" x-cloak class="rc-anon-bar rounded-xl px-4 py-3 flex items-center justify-between gap-3">
                    <div class="text-xs font-bold flex items-center gap-2">
                        <i data-lucide="eye-off" class="w-4 h-4 shrink-0"></i>
                        <span>Enviar de forma 100% anónima (sem nome nem e-mail)</span>
                    </div>
                    <label class="inline-flex items-center cursor-pointer shrink-0">
                        <input type="checkbox" x-model="form.is_anonymous" class="sr-only">
                        <span class="w-10 h-6 flex items-center rounded-full p-0.5 transition-colors"
                              :class="form.is_anonymous ? 'bg-rose-600 justify-end' : 'bg-slate-400/50 justify-start'">
                            <span class="bg-white w-5 h-5 rounded-full shadow"></span>
                        </span>
                    </label>
                </div>

                <div x-show="formError" x-cloak class="p-3 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-500 text-xs font-semibold" x-text="formError"></div>

                <!-- Linha 1: Unidade + Motivo -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="rc-label block text-xs font-bold mb-1">Unidade <span class="text-rose-500">*</span></label>
                        <select x-model="form.business_unit" class="rc-input w-full rounded-xl px-3.5 py-2.5 text-sm" required>
                            <option value="">Seleccionar...</option>
                            <option value="RACHI Tec">RACHI Tec</option>
                            <option value="RACHI Print">RACHI Print</option>
                            <option value="RACHI Academy">RACHI Academy</option>
                            <option value="RACHI Human Capital">RACHI Human Capital</option>
                            <option value="Loja Online RACHI">Loja Online</option>
                            <option value="Geral / Administração">Geral / Administração</option>
                        </select>
                    </div>

                    <div>
                        <label class="rc-label block text-xs font-bold mb-1">Motivo <span class="text-rose-500">*</span></label>
                        <select x-model="form.category" class="rc-input w-full rounded-xl px-3.5 py-2.5 text-sm" required>
                            <option value="">Seleccionar...</option>
                            <template x-if="activeTab === 'reclamacao'">
                                <optgroup label="Reclamação">
                                    <option value="Qualidade do Produto ou Serviço">Qualidade do Produto / Serviço</option>
                                    <option value="Atraso na Entrega ou Prazo">Atraso na Entrega / Prazo</option>
                                    <option value="Facturação ou Pagamento">Facturação / Pagamento</option>
                                    <option value="Atendimento ou Suporte">Atendimento / Suporte</option>
                                    <option value="Outro Motivo">Outro Motivo</option>
                                </optgroup>
                            </template>
                            <template x-if="activeTab === 'denuncia'">
                                <optgroup label="Denúncia">
                                    <option value="Fraude, Suborno ou Corrupção">Fraude, Suborno ou Corrupção</option>
                                    <option value="Conduta Antiética ou Assédio">Conduta Antiética ou Assédio</option>
                                    <option value="Conflito de Interesses">Conflito de Interesses</option>
                                    <option value="Violação de Dados ou Sigilo">Violação de Dados / Sigilo</option>
                                    <option value="Outra Irregularidade">Outra Irregularidade</option>
                                </optgroup>
                            </template>
                        </select>
                    </div>
                </div>

                <!-- Linha 2: Nome + E-mail (Oculto quando Anónimo) -->
                <div x-show="!(activeTab === 'denuncia' && form.is_anonymous)" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                    <div>
                        <label class="rc-label block text-xs font-bold mb-1">Seu Nome <span class="text-rose-500">*</span></label>
                        <input type="text"
                               x-model="form.name"
                               placeholder="Nome completo"
                               :required="!(activeTab === 'denuncia' && form.is_anonymous)"
                               class="rc-input w-full rounded-xl px-3.5 py-2.5 text-sm">
                    </div>
                    <div>
                        <label class="rc-label block text-xs font-bold mb-1">E-mail para Resposta <span class="text-rose-500">*</span></label>
                        <input type="email"
                               x-model="form.email"
                               placeholder="seu.email@exemplo.com"
                               :required="!(activeTab === 'denuncia' && form.is_anonymous)"
                               class="rc-input w-full rounded-xl px-3.5 py-2.5 text-sm">
                    </div>
                </div>

                <!-- Linha 3: Mensagem Directa -->
                <div>
                    <label class="rc-label block text-xs font-bold mb-1">Descrição <span class="text-rose-500">*</span></label>
                    <textarea x-model="form.description"
                              rows="4"
                              required
                              minlength="10"
                              :placeholder="activeTab === 'denuncia'
                                  ? 'Descreva de forma simples o que ocorreu...'
                                  : 'Explique brevemente o sucedido (se tiver n.º de factura/pedido, pode indicar aqui)...'"
                              class="rc-input w-full rounded-xl px-3.5 py-2.5 text-sm leading-relaxed"></textarea>
                </div>

                <!-- Linha 4: Anexo compacto + Botão Enviar -->
                <div class="pt-1 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex items-center gap-2 min-w-0">
                        <label class="rc-attach px-3.5 py-2.5 rounded-xl text-xs font-semibold inline-flex items-center gap-2 cursor-pointer transition truncate max-w-full">
                            <i data-lucide="paperclip" class="w-3.5 h-3.5 shrink-0"></i>
                            <span class="truncate" x-text="attachmentName || 'Anexar ficheiro (opcional)'"></span>
                            <input type="file"
                                   x-ref="attachmentInput"
                                   @change="handleFileChange($event)"
                                   accept=".pdf,.jpg,.jpeg,.png,.webp"
                                   class="hidden">
                        </label>
                        <button type="button"
                                x-show="attachmentName"
                                @click="clearFile()"
                                class="text-xs font-bold text-rose-500 hover:underline shrink-0 cursor-pointer">
                            Remover
                        </button>
                    </div>

                    <button type="submit"
                            :disabled="submitting"
                            class="px-6 py-3 rounded-xl text-xs uppercase tracking-wider cursor-pointer inline-flex items-center justify-center gap-2 transition hover:brightness-105 disabled:opacity-60 shrink-0"
                            :class="activeTab === 'denuncia' ? 'rc-btn-rose' : 'rc-btn-amber'">
                        <span x-text="submitting ? 'A enviar...' : (activeTab === 'denuncia' ? 'Enviar Denúncia' : 'Enviar Reclamação')"></span>
                        <span>&rarr;</span>
                    </button>
                </div>

                <p class="rc-muted text-[11px] text-center pt-2">
                    Tratamento confidencial ao abrigo da <a href="/privacidade" class="rc-link underline">Lei n.º 22/11</a> · Resposta até 5 dias úteis.
                </p>
            </form>
        </section>

        <!-- Rodapé Resumido de 1 Linha -->
        <div class="mt-6 text-center rc-muted text-xs space-y-2">
            <p>Sede &amp; Livro Físico: Rua Ndunduma, Miramar – Luanda · <a href="mailto:geral@rachi.ao" class="rc-link underline">geral@rachi.ao</a> · +244 972 888 585</p>
            <div class="flex flex-wrap justify-center gap-3 text-[11px]">
                <a href="/privacidade" class="rc-link hover:underline">Privacidade</a>
                <span>&bull;</span>
                <a href="/termos" class="rc-link hover:underline">Termos de Uso</a>
                <span>&bull;</span>
                <a href="/cookies" class="rc-link hover:underline">Cookies</a>
            </div>
        </div>
    </main>

    <footer class="py-4 px-4 text-center rc-muted text-[11px]">
        &copy; {{ date('Y') }} RACHI — Soluções Inteligentes. Todos os direitos reservados.
    </footer>

    <script>
        function complaintsPortal(defaultTab) {
            return {
                activeTab: defaultTab || 'reclamacao',
                submitting: false,
                formError: '',
                attachmentName: '',
                submittedResult: null,
                copied: false,

                lookupCode: '',
                lookupLoading: false,
                lookupError: '',
                lookupRecord: null,

                form: {
                    is_anonymous: false,
                    business_unit: '',
                    category: '',
                    name: '',
                    email: '',
                    description: ''
                },

                init() {
                    var params = new URLSearchParams(window.location.search);
                    var proto = params.get('protocolo');
                    if (proto) {
                        this.activeTab = 'consultar';
                        this.lookupCode = proto;
                        this.submitLookup();
                    }
                },

                switchMode(tab) {
                    this.activeTab = tab;
                    this.formError = '';
                    this.submittedResult = null;
                    if (tab === 'reclamacao' || tab === 'denuncia') {
                        this.form.category = '';
                        if (tab === 'reclamacao') {
                            this.form.is_anonymous = false;
                        }
                    }
                },

                handleFileChange(event) {
                    var file = event.target.files && event.target.files[0];
                    if (!file) {
                        this.attachmentName = '';
                        return;
                    }
                    if (file.size > 5 * 1024 * 1024) {
                        this.formError = 'O ficheiro excede o limite de 5 MB.';
                        event.target.value = '';
                        this.attachmentName = '';
                        return;
                    }
                    this.formError = '';
                    this.attachmentName = file.name;
                },

                clearFile() {
                    if (this.$refs.attachmentInput) {
                        this.$refs.attachmentInput.value = '';
                    }
                    this.attachmentName = '';
                },

                async submitForm() {
                    this.formError = '';
                    this.submitting = true;
                    try {
                        var fd = new FormData();
                        fd.append('type', this.activeTab);
                        fd.append('is_anonymous', (this.activeTab === 'denuncia' && this.form.is_anonymous) ? '1' : '0');
                        fd.append('business_unit', this.form.business_unit);
                        fd.append('category', this.form.category);
                        fd.append('name', this.form.name);
                        fd.append('email', this.form.email);
                        fd.append('description', this.form.description);

                        if (this.$refs.attachmentInput && this.$refs.attachmentInput.files[0]) {
                            fd.append('attachment', this.$refs.attachmentInput.files[0]);
                        }

                        var csrfMeta = document.querySelector('meta[name="csrf-token"]');
                        var res = await fetch('/api/reclamacoes-denuncia', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrfMeta ? csrfMeta.content : ''
                            },
                            body: fd
                        });

                        var data = await res.json();
                        if (!res.ok || !data.ok) {
                            if (data && data.errors) {
                                var firstKey = Object.keys(data.errors)[0];
                                this.formError = data.errors[firstKey][0];
                            } else {
                                this.formError = (data && data.message) || 'Verifique os campos preenchidos.';
                            }
                            return;
                        }

                        this.submittedResult = data;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    } catch (err) {
                        this.formError = 'Falha de ligação. Tente novamente.';
                    } finally {
                        this.submitting = false;
                    }
                },

                copyProtocol(code) {
                    if (!code || !navigator.clipboard) return;
                    navigator.clipboard.writeText(code);
                    this.copied = true;
                    setTimeout(() => { this.copied = false; }, 2200);
                },

                checkSubmittedProtocol() {
                    if (!this.submittedResult) return;
                    var code = this.submittedResult.protocol;
                    this.submittedResult = null;
                    this.activeTab = 'consultar';
                    this.lookupCode = code;
                    this.submitLookup();
                },

                resetForm() {
                    this.submittedResult = null;
                    this.formError = '';
                    this.clearFile();
                    this.form.description = '';
                },

                async submitLookup() {
                    this.lookupError = '';
                    this.lookupRecord = null;
                    var code = (this.lookupCode || '').trim().toUpperCase();
                    if (!code) return;
                    this.lookupLoading = true;
                    try {
                        var res = await fetch('/api/reclamacoes-denuncia/consultar?protocol=' + encodeURIComponent(code), {
                            headers: { 'Accept': 'application/json' }
                        });
                        var data = await res.json();
                        if (!res.ok || !data.ok) {
                            this.lookupError = (data && data.message) || 'Protocolo não encontrado.';
                            return;
                        }
                        this.lookupRecord = data.record;
                    } catch (e) {
                        this.lookupError = 'Não foi possível consultar agora.';
                    } finally {
                        this.lookupLoading = false;
                    }
                }
            };
        }

        if (window.lucide) lucide.createIcons();
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) lucide.createIcons();
        });
    </script>

    @include('components.theme-toggle-fab')
</body>
</html>
