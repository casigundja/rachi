<!-- MEGA PAINEL DE SOLUÇÕES (ECOSSISTEMA RACHI) -->
<!-- Suporte Completo, Dinâmico, Otimizado e Equilibrado para Modo Escuro e Modo Claro -->
<style>
    /* Container Principal do Painel */
    .solutions-mega-panel {
        position: fixed;
        top: 76px;
        left: 0;
        width: 100%;
        max-height: calc(100vh - 76px);
        overflow-y: auto;
        z-index: 1025;
        background: #ffffff;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.12);
        border-bottom: 1px solid rgba(11, 26, 46, 0.08);
        transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }
    html.dark .solutions-mega-panel {
        background: #000818;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 35px 70px -15px rgba(0, 0, 0, 0.95);
    }

    /* Bloco Superior (Hero Ecossistema na Proporção Ideal) */
    .solutions-mega-hero {
        position: relative;
        width: 100%;
        background: radial-gradient(circle at 60% 50%, #eff6ff 0%, #f8faff 55%, #ffffff 100%);
        overflow: hidden;
        border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        padding: 16px 20px 18px 20px;
        transition: background 0.3s ease, border-color 0.3s ease;
    }
    html.dark .solutions-mega-hero {
        background: #000818;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        padding: 14px 20px 16px 20px;
    }

    /* Alternância e Estilização dos Banners (Dark vs Light - Altura Ajustada e Equilibrada) */
    .solutions-banner-dark {
        display: none !important;
    }
    .solutions-banner-light {
        display: block !important;
        width: 100%;
        max-width: 1140px;
        height: auto;
        max-height: 330px;
        object-fit: contain;
        pointer-events: none;
        user-select: none;
    }
    html.dark .solutions-banner-dark {
        display: block !important;
        width: 100%;
        max-width: 1140px;
        height: auto;
        max-height: 330px;
        object-fit: contain;
        pointer-events: none;
        user-select: none;
    }
    html.dark .solutions-banner-light {
        display: none !important;
    }

    /* Botão de Fechar o Menu (X) */
    .solutions-close-btn {
        position: absolute;
        top: 16px;
        right: 24px;
        z-index: 40;
        width: 38px;
        height: 38px;
        border-radius: 9999px;
        background: rgba(11, 26, 46, 0.06);
        border: 1px solid rgba(11, 26, 46, 0.12);
        color: #0b1a2e;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .solutions-close-btn:hover {
        background: rgba(11, 26, 46, 0.14);
        color: #000000;
        transform: scale(1.06);
    }
    html.dark .solutions-close-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #cbd5e1;
    }
    html.dark .solutions-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
        transform: scale(1.06);
    }

    /* Divisor Elegante */
    .solutions-mega-divider {
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent 4%, rgba(0, 163, 224, 0.3) 30%, rgba(212, 160, 23, 0.35) 70%, transparent 96%);
        opacity: 0.9;
    }

    /* Bloco Inferior (Áreas de Actuação) */
    .solutions-mega-bottom {
        width: 100%;
        background-color: #f8fafc;
        color: #071326;
        padding: 28px 0 36px 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    html.dark .solutions-mega-bottom {
        background-color: #030814;
        color: #f8fafc;
    }

    /* Kicker e Título das 4 Áreas */
    .solutions-mega-kicker {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #0284c7;
    }
    html.dark .solutions-mega-kicker {
        color: #38bdf8;
    }
    .solutions-mega-heading {
        font-size: 16px;
        font-weight: 750;
        color: #0f172a;
        margin: 0;
        letter-spacing: -0.015em;
        transition: color 0.3s ease;
    }
    html.dark .solutions-mega-heading {
        color: #f8fafc;
    }

    /* Estilo Base dos 4 Cards (Idêntico ao Print do Usuário) */
    .solutions-unit-card {
        background-color: #ffffff;
        border-radius: 24px;
        padding: 22px 20px 22px 20px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(15, 23, 42, 0.09);
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05);
    }
    html.dark .solutions-unit-card {
        background: #071326;
        border: 1px solid rgba(255, 255, 255, 0.07);
        box-shadow: 0 8px 24px -4px rgba(0, 0, 0, 0.6);
    }

    /* Barra Superior Colorida (Top Accent Line do Print) */
    .solutions-card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3.5px;
    }

    /* Top Row do Card: Tag Pill + Watermark 01..04 */
    .solutions-card-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 6px;
    }
    .solutions-card-tag {
        font-size: 10px;
        font-weight: 850;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        padding: 3.5px 12px;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
    }
    .solutions-card-num {
        font-size: 28px;
        font-weight: 900;
        line-height: 1;
        letter-spacing: -0.02em;
        user-select: none;
        pointer-events: none;
    }

    /* Container do Logo 3D com Glow Radial Circular */
    .solutions-card-visual {
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin: 8px 0 12px 0;
    }
    .solutions-visual-glow {
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 9999px;
        pointer-events: none;
        z-index: 1;
    }
    .solutions-card-visual img {
        max-height: 85px;
        max-width: 130px;
        object-fit: contain;
        position: relative;
        z-index: 2;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .solutions-unit-card:hover .solutions-card-visual img {
        transform: scale(1.06);
    }

    /* Título das Unidades nos Cards (Alinhado à Esquerda) */
    .solutions-card-title {
        font-size: 18px;
        font-weight: 850;
        color: #0f172a;
        margin: 0 0 8px 0;
        letter-spacing: -0.02em;
        text-align: left;
        line-height: 1.25;
        transition: color 0.25s ease;
    }
    html.dark .solutions-card-title {
        color: #ffffff;
    }

    /* Descrição nos Cards (Alinhada à Esquerda) */
    .solutions-unit-desc {
        font-size: 12px;
        color: #475569;
        line-height: 1.5;
        min-height: 48px;
        margin: 0 0 16px 0;
        text-align: left;
        font-weight: 450;
        transition: color 0.3s ease;
    }
    html.dark .solutions-unit-desc {
        color: #94a3b8;
    }

    /* Checklist / Bullet Points (Idêntico ao Print) */
    .solutions-card-checklist {
        display: flex;
        flex-direction: column;
        gap: 9px;
        margin-bottom: 20px;
        text-align: left;
    }
    .solutions-check-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11.5px;
        font-weight: 600;
        line-height: 1.35;
        color: #1e293b;
    }
    html.dark .solutions-check-item {
        color: #e2e8f0;
    }

    /* Linha de Ações Inferior (Botão Principal + Botão de Ícone) */
    .solutions-card-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: auto;
        padding-top: 10px;
    }
    .solutions-card-main-btn {
        flex: 1;
        padding: 10px 14px;
        border-radius: 12px;
        background: #0f172a;
        border: 1px solid transparent;
        color: #ffffff;
        font-size: 12px;
        font-weight: 750;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }
    html.dark .solutions-card-main-btn {
        background: #0c182c;
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #ffffff;
    }
    .solutions-card-icon-btn {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid rgba(15, 23, 42, 0.1);
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }
    html.dark .solutions-card-icon-btn {
        background: #0c182c;
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: #cbd5e1;
    }

    /* ------------------------------------------------------------- */
    /* 01: Human Capital (Verde / Esmeralda)                         */
    /* ------------------------------------------------------------- */
    .solutions-bar-capital { background: linear-gradient(90deg, #10b981, #059669); }
    .solutions-tag-capital {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.25);
    }
    html.dark .solutions-tag-capital {
        background: #022c22;
        color: #10b981;
        border: 1px solid #059669;
    }
    .solutions-num-capital { color: #cbd5e1; }
    html.dark .solutions-card-capital { border-color: rgba(16, 185, 129, 0.32); }
    .solutions-glow-capital {
        background: radial-gradient(circle, rgba(0, 229, 255, 0.42) 0%, rgba(16, 185, 129, 0.16) 45%, transparent 70%);
    }
    .solutions-check-capital { color: #10b981; }
    .solutions-unit-card.solutions-card-capital:hover {
        border-color: #10b981;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(16, 185, 129, 0.15);
    }
    html.dark .solutions-unit-card.solutions-card-capital:hover {
        border-color: #10b981;
        box-shadow: 0 14px 32px rgba(16, 185, 129, 0.25);
    }
    .solutions-unit-card.solutions-card-capital:hover .solutions-card-main-btn {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
    }
    .solutions-unit-card.solutions-card-capital:hover .solutions-card-icon-btn {
        border-color: #10b981;
        color: #10b981;
    }

    /* ------------------------------------------------------------- */
    /* 02: Academy (Índigo / Roxo)                                   */
    /* ------------------------------------------------------------- */
    .solutions-bar-academy { background: linear-gradient(90deg, #6366f1, #4f46e5); }
    .solutions-tag-academy {
        background: rgba(99, 102, 241, 0.1);
        color: #4f46e5;
        border: 1px solid rgba(99, 102, 241, 0.25);
    }
    html.dark .solutions-tag-academy {
        background: #1e1b4b;
        color: #818cf8;
        border: 1px solid #4338ca;
    }
    html.dark .solutions-card-academy { border-color: rgba(99, 102, 241, 0.32); }
    .solutions-glow-academy {
        background: radial-gradient(circle, rgba(129, 140, 248, 0.42) 0%, rgba(99, 102, 241, 0.16) 45%, transparent 70%);
    }
    .solutions-check-academy { color: #818cf8; }
    .solutions-unit-card.solutions-card-academy:hover {
        border-color: #6366f1;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(99, 102, 241, 0.15);
    }
    html.dark .solutions-unit-card.solutions-card-academy:hover {
        border-color: #6366f1;
        box-shadow: 0 14px 32px rgba(99, 102, 241, 0.25);
    }
    .solutions-unit-card.solutions-card-academy:hover .solutions-card-main-btn {
        background: #6366f1;
        border-color: #6366f1;
        color: #ffffff;
    }
    .solutions-unit-card.solutions-card-academy:hover .solutions-card-icon-btn {
        border-color: #6366f1;
        color: #818cf8;
    }

    /* ------------------------------------------------------------- */
    /* 03: Tec (Azul Celeste / Ciano)                                */
    /* ------------------------------------------------------------- */
    .solutions-bar-tec { background: linear-gradient(90deg, #0ea5e9, #0284c7); }
    .solutions-tag-tec {
        background: rgba(14, 165, 233, 0.1);
        color: #0284c7;
        border: 1px solid rgba(14, 165, 233, 0.25);
    }
    html.dark .solutions-tag-tec {
        background: #082f49;
        color: #38bdf8;
        border: 1px solid #0284c7;
    }
    .solutions-num-tec { color: #cbd5e1; }
    html.dark .solutions-card-tec { border-color: rgba(14, 165, 233, 0.32); }
    .solutions-glow-tec {
        background: radial-gradient(circle, rgba(14, 165, 233, 0.45) 0%, rgba(2, 132, 199, 0.16) 45%, transparent 70%);
    }
    .solutions-check-tec { color: #38bdf8; }
    .solutions-unit-card.solutions-card-tec:hover {
        border-color: #0284c7;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(14, 165, 233, 0.15);
    }
    html.dark .solutions-unit-card.solutions-card-tec:hover {
        border-color: #0284c7;
        box-shadow: 0 14px 32px rgba(14, 165, 233, 0.25);
    }
    .solutions-unit-card.solutions-card-tec:hover .solutions-card-main-btn {
        background: #0284c7;
        border-color: #0284c7;
        color: #ffffff;
    }
    .solutions-unit-card.solutions-card-tec:hover .solutions-card-icon-btn {
        border-color: #0284c7;
        color: #38bdf8;
    }

    /* ------------------------------------------------------------- */
    /* 04: Print (Laranja / Âmbar)                                   */
    /* ------------------------------------------------------------- */
    .solutions-bar-print { background: linear-gradient(90deg, #f59e0b, #ea580c); }
    .solutions-tag-print {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }
    html.dark .solutions-tag-print {
        background: #451a03;
        color: #fbbf24;
        border: 1px solid #b45309;
    }
    .solutions-num-print { color: #cbd5e1; }
    html.dark .solutions-card-print { border-color: rgba(245, 158, 11, 0.32); }
    .solutions-glow-print {
        background: radial-gradient(circle, rgba(245, 158, 11, 0.45) 0%, rgba(217, 119, 6, 0.16) 45%, transparent 70%);
    }
    .solutions-check-print { color: #f59e0b; }
    .solutions-unit-card.solutions-card-print:hover {
        border-color: #f59e0b;
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(245, 158, 11, 0.15);
    }
    html.dark .solutions-unit-card.solutions-card-print:hover {
        border-color: #f59e0b;
        box-shadow: 0 14px 32px rgba(245, 158, 11, 0.25);
    }
    .solutions-unit-card.solutions-card-print:hover .solutions-card-main-btn {
        background: #f59e0b;
        border-color: #f59e0b;
        color: #0f172a;
    }
    .solutions-unit-card.solutions-card-print:hover .solutions-card-icon-btn {
        border-color: #f59e0b;
        color: #f59e0b;
    }
</style>

<!-- Backdrop inteligente com suporte a tema e blur cinematográfico -->
<div x-show="solutionsOpen"
     x-transition:enter="transition-opacity ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="solutionsOpen = false"
     style="position: fixed; inset: 0; background: rgba(2, 6, 17, 0.72); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 1020;"
     x-cloak></div>

<!-- Painel Expansível de Soluções -->
<div x-show="solutionsOpen"
     x-transition:enter="transition ease-out duration-350"
     x-transition:enter-start="opacity-0 -translate-y-4 scale-[0.99]"
     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
     x-transition:leave-end="opacity-0 -translate-y-3 scale-[0.99]"
     @keydown.escape.window="solutionsOpen = false"
     class="solutions-mega-panel"
     x-cloak>

    <!-- ============================================================== -->
    <!-- 1. BLOCO SUPERIOR: HERO ECOSSISTEMA RACHI                      -->
    <!-- Alterna perfeitamente entre Dark Mode e Light Mode             -->
    <!-- ============================================================== -->
    <div class="solutions-mega-hero">
        <!-- Botão Fechar Painel (X) -->
        <button type="button"
                @click="solutionsOpen = false"
                class="solutions-close-btn group"
                title="Fechar painel de soluções"
                aria-label="Fechar painel de soluções">
            <svg style="width: 17px; height: 17px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Banner Hero Seamless com Transição Perfeita em Ambos os Temas -->
        <div style="width: 100%; max-width: 1220px; margin: 0 auto; display: flex; justify-content: center; align-items: center;">
            <!-- Versão Dark Mode -->
            <img src="/images/solutions-mega-banner-feathered.png?v=8"
                 alt="Ecossistema RACHI - Construímos o negócio que ainda não existe"
                 class="solutions-banner-dark"
                 loading="eager">

            <!-- Versão Light Mode (Banner Oficial com Fundo Transparente) -->
            <img src="/images/banner_modo_claro.png?v={{ time() }}"
                 alt="Ecossistema RACHI - Construímos o negócio que ainda não existe"
                 class="solutions-banner-light"
                 loading="eager">
        </div>
    </div>

    <!-- Divisor Sutil -->
    <div class="solutions-mega-divider"></div>

    <!-- ============================================================== -->
    <!-- 2. BLOCO INFERIOR: AS QUATRO ÁREAS DE ACTUAÇÃO (CARDS)         -->
    <!-- ============================================================== -->
    <div class="solutions-mega-bottom">
        <div style="width: 100%; max-width: 1220px; margin: 0 auto; padding: 0 24px;">
            
            <!-- Título e Kicker das Áreas -->
            <div style="text-align: center; margin-bottom: 26px;">
                <div style="display: inline-flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: #00a3e0;"></span>
                    <span class="solutions-mega-kicker">ECOSSISTEMA INTEGRADO</span>
                    <span style="display: inline-block; width: 6px; height: 6px; border-radius: 9999px; background: #00a3e0;"></span>
                </div>
                <h3 class="solutions-mega-heading">
                    Quatro áreas de actuação que unem pessoas, tecnologia, formação e comunicação.
                </h3>
            </div>

            <!-- Grid com os 4 Cards das Soluções (Réplica Fiel do Print) -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; align-items: stretch;">
                
                <!-- CARD 01: RACHI HUMAN CAPITAL -->
                <div class="group solutions-unit-card solutions-card-capital">
                    <!-- Barra de Destaque Superior -->
                    <div class="solutions-card-accent-bar solutions-bar-capital"></div>

                    <div>
                        <!-- Topo: Pill Badge + Número D'Água -->
                        <div class="solutions-card-header-row">
                            <span class="solutions-card-tag solutions-tag-capital">
                                PESSOAS &amp; GESTÃO
                            </span>
                            <span class="solutions-card-num solutions-num-capital">
                                01
                            </span>
                        </div>

                        <!-- Gráfico 3D com Aura Radial -->
                        <div class="solutions-card-visual">
                            <div class="solutions-visual-glow solutions-glow-capital"></div>
                            <img src="/images/areas/rachi-3d-capital-trans.png?v=9"
                                 alt="RACHI Human Capital"
                                 loading="lazy">
                        </div>

                        <!-- Título e Descrição (Alinhados à Esquerda) -->
                        <h4 class="solutions-card-title">
                            RACHI Human<br>Capital
                        </h4>
                        <p class="solutions-unit-desc">
                            Serviços empresariais, recursos humanos, contabilidade e regularização documental.
                        </p>

                        <!-- Checklist de Recursos / Especialidades -->
                        <div class="solutions-card-checklist">
                            <div class="solutions-check-item">
                                <svg class="solutions-check-capital" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Recursos Humanos &amp; Recrutamento</span>
                            </div>
                            <div class="solutions-check-item">
                                <svg class="solutions-check-capital" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Contabilidade &amp; Apoio Legal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Ação Inferiores -->
                    <div class="solutions-card-actions">
                        <a href="/capital"
                           @click="solutionsOpen = false"
                           class="solutions-card-main-btn">
                           <span>Saber mais</span>
                           <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M5 12h14M12 5l7 7-7 7" />
                           </svg>
                        </a>
                        <a href="/capital"
                           @click="solutionsOpen = false"
                           class="solutions-card-icon-btn"
                           title="Pedir proposta">
                           <svg style="width: 15px; height: 15px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <line x1="22" y1="2" x2="11" y2="13" />
                               <polygon points="22 2 15 22 11 13 2 9 22 2" />
                           </svg>
                        </a>
                    </div>
                </div>

                <!-- CARD 02: RACHI ACADEMY -->
                <div class="group solutions-unit-card solutions-card-academy">
                    <!-- Barra de Destaque Superior -->
                    <div class="solutions-card-accent-bar solutions-bar-academy"></div>

                    <div>
                        <!-- Topo: Pill Badge + Número D'Água -->
                        <div class="solutions-card-header-row">
                            <span class="solutions-card-tag solutions-tag-academy">
                                CAPACITAÇÃO &amp; ENSINO
                            </span>
                            <span class="solutions-card-num solutions-num-academy">
                                02
                            </span>
                        </div>

                        <!-- Gráfico 3D com Aura Radial -->
                        <div class="solutions-card-visual">
                            <div class="solutions-visual-glow solutions-glow-academy"></div>
                            <img src="/images/areas/rachi-3d-academy-trans.png?v=9"
                                 alt="RACHI Academy"
                                 loading="lazy">
                        </div>

                        <!-- Título e Descrição (Alinhados à Esquerda) -->
                        <h4 class="solutions-card-title">
                            RACHI Academy
                        </h4>
                        <p class="solutions-unit-desc">
                            Formação profissional e corporativa em gestão, liderança, cibersegurança e competências digitais.
                        </p>

                        <!-- Checklist de Recursos / Especialidades -->
                        <div class="solutions-card-checklist">
                            <div class="solutions-check-item">
                                <svg class="solutions-check-academy" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Certificação Digital com QR Code</span>
                            </div>
                            <div class="solutions-check-item">
                                <svg class="solutions-check-academy" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Treinamento Corporativo In-Company</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Ação Inferiores -->
                    <div class="solutions-card-actions">
                        <a href="/academy"
                           @click="solutionsOpen = false"
                           class="solutions-card-main-btn">
                           <span>Saber mais</span>
                           <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M5 12h14M12 5l7 7-7 7" />
                           </svg>
                        </a>
                        <a href="/academy"
                           @click="solutionsOpen = false"
                           class="solutions-card-icon-btn"
                           title="Pedir formação">
                           <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                               <path d="M6 12v5c3 3 9 3 12 0v-5" />
                           </svg>
                        </a>
                    </div>
                </div>

                <!-- CARD 03: RACHI TEC -->
                <div class="group solutions-unit-card solutions-card-tec">
                    <!-- Barra de Destaque Superior -->
                    <div class="solutions-card-accent-bar solutions-bar-tec"></div>

                    <div>
                        <!-- Topo: Pill Badge + Número D'Água -->
                        <div class="solutions-card-header-row">
                            <span class="solutions-card-tag solutions-tag-tec">
                                TECNOLOGIA &amp; TI
                            </span>
                            <span class="solutions-card-num solutions-num-tec">
                                03
                            </span>
                        </div>

                        <!-- Gráfico 3D com Aura Radial -->
                        <div class="solutions-card-visual">
                            <div class="solutions-visual-glow solutions-glow-tec"></div>
                            <img src="/images/areas/rachi-3d-tec-trans.png?v=9"
                                 alt="RACHI Tec"
                                 loading="lazy">
                        </div>

                        <!-- Título e Descrição (Alinhados à Esquerda) -->
                        <h4 class="solutions-card-title">
                            RACHI Tec
                        </h4>
                        <p class="solutions-unit-desc">
                            Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico.
                        </p>

                        <!-- Checklist de Recursos / Especialidades -->
                        <div class="solutions-card-checklist">
                            <div class="solutions-check-item">
                                <svg class="solutions-check-tec" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Sistemas de Gestão &amp; Infraestrutura</span>
                            </div>
                            <div class="solutions-check-item">
                                <svg class="solutions-check-tec" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Suporte Técnico &amp; Transformação Digital</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Ação Inferiores -->
                    <div class="solutions-card-actions">
                        <a href="/tec"
                           @click="solutionsOpen = false"
                           class="solutions-card-main-btn">
                           <span>Saber mais</span>
                           <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M5 12h14M12 5l7 7-7 7" />
                           </svg>
                        </a>
                        <a href="/tec"
                           @click="solutionsOpen = false"
                           class="solutions-card-icon-btn"
                           title="Pedir orçamento">
                           <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <rect x="4" y="4" width="16" height="16" rx="2" />
                               <rect x="9" y="9" width="6" height="6" />
                               <line x1="9" y1="1" x2="9" y2="4" /><line x1="15" y1="1" x2="15" y2="4" />
                               <line x1="9" y1="20" x2="9" y2="23" /><line x1="15" y1="20" x2="15" y2="23" />
                               <line x1="20" y1="9" x2="23" y2="9" /><line x1="20" y1="14" x2="23" y2="14" />
                               <line x1="1" y1="9" x2="4" y2="9" /><line x1="1" y1="14" x2="4" y2="14" />
                           </svg>
                        </a>
                    </div>
                </div>

                <!-- CARD 04: RACHI PRINT -->
                <div class="group solutions-unit-card solutions-card-print">
                    <!-- Barra de Destaque Superior -->
                    <div class="solutions-card-accent-bar solutions-bar-print"></div>

                    <div>
                        <!-- Topo: Pill Badge + Número D'Água -->
                        <div class="solutions-card-header-row">
                            <span class="solutions-card-tag solutions-tag-print">
                                GRÁFICA &amp; PRODUÇÃO
                            </span>
                            <span class="solutions-card-num solutions-num-print">
                                04
                            </span>
                        </div>

                        <!-- Gráfico 3D com Aura Radial -->
                        <div class="solutions-card-visual">
                            <div class="solutions-visual-glow solutions-glow-print"></div>
                            <img src="/images/areas/rachi-3d-print-trans.png?v=9"
                                 alt="RACHI Print"
                                 loading="lazy">
                        </div>

                        <!-- Título e Descrição (Alinhados à Esquerda) -->
                        <h4 class="solutions-card-title">
                            RACHI Print
                        </h4>
                        <p class="solutions-unit-desc">
                            Produção gráfica, impressão institucional, materiais promocionais e eventos.
                        </p>

                        <!-- Checklist de Recursos / Especialidades -->
                        <div class="solutions-card-checklist">
                            <div class="solutions-check-item">
                                <svg class="solutions-check-print" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Impressão Offset &amp; Digital Premium</span>
                            </div>
                            <div class="solutions-check-item">
                                <svg class="solutions-check-print" style="width: 15px; height: 15px; flex-shrink: 0;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="m9 12 2 2 4-4" />
                                </svg>
                                <span>Brindes Corporativos &amp; Sinalização</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botões de Ação Inferiores -->
                    <div class="solutions-card-actions">
                        <a href="/print"
                           @click="solutionsOpen = false"
                           class="solutions-card-main-btn">
                           <span>Saber mais</span>
                           <svg style="width: 13px; height: 13px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                               <path d="M5 12h14M12 5l7 7-7 7" />
                           </svg>
                        </a>
                        <a href="/print"
                           @click="solutionsOpen = false"
                           class="solutions-card-icon-btn"
                           title="Produção Gráfica & Brindes">
                           <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                               <polyline points="6 9 6 2 18 2 18 9" />
                               <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                               <rect x="6" y="14" width="12" height="8" />
                           </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
