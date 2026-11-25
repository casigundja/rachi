/**
 * GundjaTech / RACHI — AI CRM Chat Widget
 * Assistente Inteligente de Qualificação de Leads & Atendimento Automatizado
 * Com Regras de Negócio, Captura para CRM e Transbordo Humano para WhatsApp (+244 972 888 585).
 */
(function() {
    'use strict';

    if (window.__GundjaAIChatInitialized) return;
    window.__GundjaAIChatInitialized = true;

    // Configurações Oficiais
    const CONFIG = {
        officialWhatsApp: '244972888585',
        officialDisplayPhone: '+244 972 888 585',
        crmLeadApi: '/api/crm/lead',
        fallbackContactApi: '/contacto',
        storageKey: 'gt_ai_chat_session_v1',
    };

    // Estado da Conversa
    let state = {
        isOpen: false,
        step: 'INIT', // INIT, SITE_NOVO_SEGMENT, REFAZER_MOTIVO, PRICE_TYPE, LOOKING, ASK_NAME, ASK_PHONE, COMPLETED, HUMAN_HANDOFF
        leadData: {
            service: '',
            objective: '',
            name: '',
            phone: '',
            company: '',
            notes: ''
        },
        messages: [
            { sender: 'bot', text: 'Oi! Aqui é da GundjaTech.' },
            { sender: 'bot', text: 'Precisa de ajuda com o site ou sistema da sua empresa?' }
        ],
        chips: [
            { label: 'Quero um site novo', action: 'site_novo' },
            { label: 'Quero refazer meu site', action: 'refazer_site' },
            { label: 'Quanto custa?', action: 'quanto_custa' },
            { label: 'Só estou olhando', action: 'so_olhando' },
            { label: 'Falar com Humano', action: 'falar_humano' }
        ]
    };

    // Restaurar sessão se existir
    try {
        const saved = sessionStorage.getItem(CONFIG.storageKey);
        if (saved) {
            const parsed = JSON.parse(saved);
            if (parsed && Array.isArray(parsed.messages) && parsed.messages.length > 0) {
                state.messages = parsed.messages;
                state.step = parsed.step || state.step;
                state.leadData = parsed.leadData || state.leadData;
                state.chips = parsed.chips || state.chips;
            }
        }
    } catch(e) {}

    function persistState() {
        try {
            sessionStorage.setItem(CONFIG.storageKey, JSON.stringify({
                step: state.step,
                leadData: state.leadData,
                messages: state.messages,
                chips: state.chips
            }));
        } catch(e) {}
    }

    // Estilos CSS Integrados (GundjaTech Design Tokens: Solar Amber #FFA525, Ochre #DD8F20, Pitch Black #0B0B0B)
    const styleEl = document.createElement('style');
    styleEl.id = 'gt-ai-chat-styles';
    styleEl.textContent = `
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        #gt-chat-widget-root {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif !important;
            -webkit-font-smoothing: antialiased;
            z-index: 999999 !important;
            position: relative;
        }

        /* FAB Button */
        .gt-chat-fab {
            position: fixed !important;
            bottom: 20px !important;
            right: 20px !important;
            width: 58px !important;
            height: 58px !important;
            border-radius: 9999px !important;
            background: linear-gradient(135deg, #FFA525 0%, #DD8F20 100%) !important;
            box-shadow: 0 8px 25px rgba(255, 165, 37, 0.45), 0 3px 8px rgba(0, 0, 0, 0.2) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            border: 2px solid rgba(255, 255, 255, 0.35) !important;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
            z-index: 999999 !important;
            padding: 0 !important;
            outline: none !important;
        }

        .gt-chat-fab:hover {
            transform: scale(1.08) translateY(-2px) !important;
            box-shadow: 0 12px 30px rgba(255, 165, 37, 0.6), 0 4px 12px rgba(0, 0, 0, 0.25) !important;
        }

        .gt-chat-fab:active {
            transform: scale(0.96) !important;
        }

        .gt-chat-fab svg {
            width: 28px !important;
            height: 28px !important;
            color: #0B0B0B !important;
            transition: transform 0.25s ease !important;
        }

        .gt-chat-fab-badge {
            position: absolute !important;
            top: 1px !important;
            right: 1px !important;
            width: 14px !important;
            height: 14px !important;
            background-color: #10B981 !important;
            border: 2.5px solid #ffffff !important;
            border-radius: 9999px !important;
        }

        /* Chat Modal Container */
        .gt-chat-window {
            position: fixed !important;
            bottom: 90px !important;
            right: 20px !important;
            width: 375px !important;
            max-width: calc(100vw - 32px) !important;
            height: 560px !important;
            max-height: calc(100vh - 120px) !important;
            background: #FFFAF4 !important;
            border-radius: 22px !important;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.32), 0 0 0 1px rgba(0, 0, 0, 0.08) !important;
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
            z-index: 999998 !important;
            transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
            transform-origin: bottom right !important;
        }

        html.dark .gt-chat-window {
            background: #0D121D !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.12) !important;
        }

        .gt-chat-window.gt-hidden {
            opacity: 0 !important;
            visibility: hidden !important;
            transform: scale(0.85) translateY(20px) !important;
            pointer-events: none !important;
        }

        /* Chat Header */
        .gt-chat-header {
            background: #0B0B0B !important;
            padding: 14px 18px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .gt-chat-header-brand {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .gt-chat-logo-ring {
            width: 38px !important;
            height: 38px !important;
            border-radius: 9999px !important;
            background: #141414 !important;
            border: 1.5px solid rgba(255, 165, 37, 0.45) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4) !important;
        }

        .gt-chat-header-info h4 {
            margin: 0 !important;
            font-size: 15px !important;
            font-weight: 800 !important;
            color: #FFFFFF !important;
            letter-spacing: -0.3px !important;
            line-height: 1.2 !important;
        }

        .gt-chat-header-info h4 span {
            color: #FFA525 !important;
        }

        .gt-chat-status {
            display: flex !important;
            align-items: center !important;
            gap: 5px !important;
            margin-top: 2px !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            color: #94A3B8 !important;
        }

        .gt-chat-dot {
            width: 7px !important;
            height: 7px !important;
            border-radius: 9999px !important;
            background-color: #10B981 !important;
            box-shadow: 0 0 8px #10B981 !important;
        }

        .gt-chat-close-btn {
            width: 32px !important;
            height: 32px !important;
            border-radius: 9999px !important;
            background: rgba(255, 255, 255, 0.1) !important;
            color: #FFFFFF !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            cursor: pointer !important;
            transition: background 0.2s ease !important;
            outline: none !important;
            padding: 0 !important;
        }

        .gt-chat-close-btn:hover {
            background: rgba(255, 255, 255, 0.2) !important;
        }

        /* Messages Body */
        .gt-chat-body {
            flex: 1 !important;
            padding: 16px !important;
            overflow-y: auto !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 10px !important;
            scroll-behavior: smooth !important;
        }

        .gt-chat-body::-webkit-scrollbar {
            width: 5px !important;
        }
        .gt-chat-body::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.15) !important;
            border-radius: 9999px !important;
        }
        html.dark .gt-chat-body::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15) !important;
        }

        .gt-chat-bubble {
            max-width: 84% !important;
            padding: 11px 15px !important;
            font-size: 13.5px !important;
            line-height: 1.45 !important;
            word-break: break-word !important;
            animation: gtFadeIn 0.25s ease !important;
        }

        .gt-chat-bubble.gt-bot {
            align-self: flex-start !important;
            background: #FFFFFF !important;
            color: #1E293B !important;
            border-radius: 18px 18px 18px 4px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04), 0 0 0 1px rgba(0, 0, 0, 0.06) !important;
            font-weight: 500 !important;
        }

        html.dark .gt-chat-bubble.gt-bot {
            background: #182234 !important;
            color: #F1F5F9 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
        }

        .gt-chat-bubble.gt-user {
            align-self: flex-end !important;
            background: linear-gradient(135deg, #FFA525 0%, #DD8F20 100%) !important;
            color: #0B0B0B !important;
            border-radius: 18px 18px 4px 18px !important;
            font-weight: 600 !important;
            box-shadow: 0 3px 10px rgba(255, 165, 37, 0.3) !important;
        }

        /* Chips / Quick Reply Options */
        .gt-chat-chips-container {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 7px !important;
            margin-top: 6px !important;
            margin-bottom: 4px !important;
            animation: gtFadeIn 0.3s ease !important;
        }

        .gt-chat-chip {
            background: #FFFFFF !important;
            border: 1.5px solid #FFA525 !important;
            color: #DD8F20 !important;
            padding: 7px 15px !important;
            border-radius: 9999px !important;
            font-size: 12.5px !important;
            font-weight: 600 !important;
            cursor: pointer !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 0 2px 5px rgba(255, 165, 37, 0.12) !important;
            outline: none !important;
            text-align: left !important;
        }

        html.dark .gt-chat-chip {
            background: #111A29 !important;
            color: #FFA525 !important;
            border-color: #FFA525 !important;
        }

        .gt-chat-chip:hover {
            background: #FFA525 !important;
            color: #0B0B0B !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 4px 12px rgba(255, 165, 37, 0.35) !important;
        }

        .gt-chat-chip.gt-chip-human {
            border-color: #10B981 !important;
            color: #059669 !important;
            background: #F0FDF4 !important;
        }
        html.dark .gt-chat-chip.gt-chip-human {
            background: rgba(16, 185, 129, 0.1) !important;
            color: #34D399 !important;
        }
        .gt-chat-chip.gt-chip-human:hover {
            background: #10B981 !important;
            color: #FFFFFF !important;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4) !important;
        }

        /* WhatsApp Card */
        .gt-whatsapp-card {
            background: #F0FDF4 !important;
            border: 1.5px solid #10B981 !important;
            border-radius: 14px !important;
            padding: 12px 14px !important;
            margin-top: 6px !important;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.15) !important;
            animation: gtFadeIn 0.3s ease !important;
        }

        html.dark .gt-whatsapp-card {
            background: #062017 !important;
            border-color: #059669 !important;
        }

        .gt-whatsapp-btn {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            width: 100% !important;
            background: #25D366 !important;
            color: #FFFFFF !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            padding: 10px 14px !important;
            border-radius: 10px !important;
            text-decoration: none !important;
            margin-top: 8px !important;
            box-shadow: 0 3px 10px rgba(37, 211, 102, 0.35) !important;
            transition: all 0.2s ease !important;
            border: none !important;
            cursor: pointer !important;
        }

        .gt-whatsapp-btn:hover {
            background: #20BA5A !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 5px 14px rgba(37, 211, 102, 0.45) !important;
        }

        /* Footer Input */
        .gt-chat-footer {
            padding: 10px 14px 14px 14px !important;
            background: #FFFFFF !important;
            border-top: 1px solid rgba(0, 0, 0, 0.07) !important;
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
        }

        html.dark .gt-chat-footer {
            background: #0B0F18 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
        }

        .gt-chat-input-pill {
            flex: 1 !important;
            height: 42px !important;
            border-radius: 9999px !important;
            border: 1px solid #CBD5E1 !important;
            background: #F8FAFC !important;
            padding: 0 16px !important;
            font-size: 13px !important;
            color: #0F172A !important;
            outline: none !important;
            transition: all 0.2s ease !important;
        }

        html.dark .gt-chat-input-pill {
            background: #182234 !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
            color: #FFFFFF !important;
        }

        .gt-chat-input-pill:focus {
            border-color: #FFA525 !important;
            box-shadow: 0 0 0 3px rgba(255, 165, 37, 0.25) !important;
            background: #FFFFFF !important;
        }

        html.dark .gt-chat-input-pill:focus {
            background: #1E293B !important;
        }

        .gt-chat-send-btn {
            width: 42px !important;
            height: 42px !important;
            border-radius: 9999px !important;
            background: #FFA525 !important;
            color: #FFFFFF !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            border: none !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 3px 10px rgba(255, 165, 37, 0.35) !important;
            outline: none !important;
            padding: 0 !important;
            flex-shrink: 0 !important;
        }

        .gt-chat-send-btn:hover {
            background: #DD8F20 !important;
            transform: scale(1.05) !important;
        }

        .gt-chat-send-btn:active {
            transform: scale(0.95) !important;
        }

        .gt-chat-send-btn svg {
            width: 19px !important;
            height: 19px !important;
            stroke-width: 2.8 !important;
        }

        /* Typing indicator */
        .gt-typing-indicator {
            display: flex !important;
            align-items: center !important;
            gap: 4px !important;
            padding: 8px 12px !important;
            background: #FFFFFF !important;
            border-radius: 14px !important;
            width: fit-content !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05) !important;
        }
        html.dark .gt-typing-indicator {
            background: #182234 !important;
        }
        .gt-typing-dot {
            width: 6px !important;
            height: 6px !important;
            border-radius: 9999px !important;
            background: #FFA525 !important;
            animation: gtBounce 1.2s infinite ease-in-out !important;
        }
        .gt-typing-dot:nth-child(2) { animation-delay: 0.2s !important; }
        .gt-typing-dot:nth-child(3) { animation-delay: 0.4s !important; }

        @keyframes gtBounce {
            0%, 60%, 100% { transform: translateY(0); }
            30% { transform: translateY(-5px); }
        }

        @keyframes gtFadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile adjustments: Adjust theme fab dock so there is NO overlap */
        @media (min-width: 640px) {
            .rachi-fab-dock {
                right: 5.75rem !important;
            }
        }
        @media (max-width: 639px) {
            .rachi-fab-dock {
                bottom: calc(5.25rem + env(safe-area-inset-bottom, 0px)) !important;
                right: 1.25rem !important;
            }
            .gt-chat-window {
                right: 12px !important;
                bottom: 84px !important;
                max-height: calc(100vh - 100px) !important;
                width: calc(100vw - 24px) !important;
            }
        }
    `;
    document.head.appendChild(styleEl);

    // G-Nexus Logo SVG Oficial GundjaTech
    const gNexusSvg = `
        <svg width="22" height="22" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="50" cy="50" r="45" stroke="#FFA525" stroke-width="4.5" fill="#0B0B0B" />
            <path d="M 68 32 C 60 23 40 23 31 32 C 21 42 21 58 31 68 C 41 78 59 78 69 68 C 73 64 75 58 75 52 L 48 52" stroke="#FFA525" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="48" cy="52" r="4.5" fill="#FFA525" />
        </svg>
    `;

    // Criar Elementos no DOM
    const root = document.createElement('div');
    root.id = 'gt-chat-widget-root';
    root.innerHTML = `
        <!-- Floating FAB -->
        <button type="button" id="gt-chat-fab-btn" class="gt-chat-fab" aria-label="Abrir Chat de Atendimento GundjaTech" title="Falar com Assistente IA GundjaTech">
            <div class="gt-chat-fab-badge"></div>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
            </svg>
        </button>

        <!-- Chat Modal Window -->
        <div id="gt-chat-modal" class="gt-chat-window gt-hidden" role="dialog" aria-modal="true" aria-label="Chat de Atendimento GundjaTech">
            <!-- Header -->
            <div class="gt-chat-header">
                <div class="gt-chat-header-brand">
                    <div class="gt-chat-logo-ring">
                        ${gNexusSvg}
                    </div>
                    <div class="gt-chat-header-info">
                        <h4>Gundja<span>Tech</span></h4>
                        <div class="gt-chat-status">
                            <span class="gt-chat-dot"></span>
                            <span>Online agora</span>
                        </div>
                    </div>
                </div>
                <button type="button" id="gt-chat-close-btn" class="gt-chat-close-btn" aria-label="Fechar Chat">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Messages Body -->
            <div id="gt-chat-messages" class="gt-chat-body"></div>

            <!-- Footer Input -->
            <form id="gt-chat-form" class="gt-chat-footer">
                <input type="text" id="gt-chat-input" class="gt-chat-input-pill" placeholder="Digite sua mensagem ou escolha uma opção..." autocomplete="off" />
                <button type="submit" id="gt-chat-submit" class="gt-chat-send-btn" aria-label="Enviar mensagem">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>
        </div>
    `;
    document.body.appendChild(root);

    const fabBtn = document.getElementById('gt-chat-fab-btn');
    const modal = document.getElementById('gt-chat-modal');
    const closeBtn = document.getElementById('gt-chat-close-btn');
    const messagesEl = document.getElementById('gt-chat-messages');
    const form = document.getElementById('gt-chat-form');
    const input = document.getElementById('gt-chat-input');

    // Toggle Modal
    function toggleChat(forceState) {
        state.isOpen = typeof forceState === 'boolean' ? forceState : !state.isOpen;
        if (state.isOpen) {
            modal.classList.remove('gt-hidden');
            setTimeout(() => {
                input.focus();
                scrollToBottom();
            }, 100);
        } else {
            modal.classList.add('gt-hidden');
        }
    }

    fabBtn.addEventListener('click', () => toggleChat());
    closeBtn.addEventListener('click', () => toggleChat(false));

    function scrollToBottom() {
        setTimeout(() => {
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }, 50);
    }

    // Renderizar Histórico de Mensagens
    function renderMessages() {
        messagesEl.innerHTML = '';
        state.messages.forEach(msg => {
            const bubble = document.createElement('div');
            bubble.className = `gt-chat-bubble ${msg.sender === 'bot' ? 'gt-bot' : 'gt-user'}`;
            // Se contiver quebras de linha
            bubble.innerHTML = msg.text.replace(/\n/g, '<br>');
            messagesEl.appendChild(bubble);

            if (msg.isWhatsAppCard) {
                renderWhatsAppCard(msg.whatsAppText);
            }
        });

        // Renderizar Chips se houver opções ativas
        if (state.chips && state.chips.length > 0) {
            const chipsContainer = document.createElement('div');
            chipsContainer.className = 'gt-chat-chips-container';
            state.chips.forEach(chip => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = `gt-chat-chip ${chip.action === 'falar_humano' ? 'gt-chip-human' : ''}`;
                btn.textContent = chip.label;
                btn.addEventListener('click', () => handleChipClick(chip));
                chipsContainer.appendChild(btn);
            });
            messagesEl.appendChild(chipsContainer);
        }

        scrollToBottom();
    }

    function renderWhatsAppCard(customText) {
        const textToEncode = customText || `Olá! Estive a falar no chat do site da GundjaTech e gostaria de falar com um atendente humano.`;
        const waUrl = `https://wa.me/${CONFIG.officialWhatsApp}?text=${encodeURIComponent(textToEncode)}`;

        const card = document.createElement('div');
        card.className = 'gt-whatsapp-card';
        card.innerHTML = `
            <div style="font-weight: 700; font-size: 13px; color: #047857; display: flex; align-items: center; gap: 6px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                Atendimento Humano no WhatsApp
            </div>
            <div style="font-size: 12px; color: #065F46; margin-top: 3px;">
                Conecte-se diretamente com nossos consultores de negócios em Luanda:
            </div>
            <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="gt-whatsapp-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Abrir WhatsApp (+244 972 888 585)
            </a>
        `;
        messagesEl.appendChild(card);
    }

    function showTyping() {
        const ind = document.createElement('div');
        ind.id = 'gt-typing-node';
        ind.className = 'gt-typing-indicator';
        ind.innerHTML = `
            <div class="gt-typing-dot"></div>
            <div class="gt-typing-dot"></div>
            <div class="gt-typing-dot"></div>
        `;
        messagesEl.appendChild(ind);
        scrollToBottom();
    }

    function hideTyping() {
        const ind = document.getElementById('gt-typing-node');
        if (ind) ind.remove();
    }

    function addBotMessage(text, newChips, isWhatsApp, customWhatsAppText) {
        showTyping();
        setTimeout(() => {
            hideTyping();
            const msgObj = { sender: 'bot', text };
            if (isWhatsApp) {
                msgObj.isWhatsAppCard = true;
                msgObj.whatsAppText = customWhatsAppText;
            }
            state.messages.push(msgObj);
            state.chips = newChips || [];
            persistState();
            renderMessages();
        }, 550);
    }

    function addUserMessage(text) {
        state.messages.push({ sender: 'user', text });
        state.chips = [];
        persistState();
        renderMessages();
    }

    // Salvar Lead no CRM (worker_contacts)
    async function syncLeadToCrm() {
        const payload = {
            name: state.leadData.name || 'Visitante Chat IA',
            phone: state.leadData.phone || 'Não informado',
            company: state.leadData.company || '',
            subject: `[Lead CRM Chat] ${state.leadData.service || 'Interesse Comercial'}`,
            message: `Lead gerado pelo Chat IA GundjaTech:
- Nome: ${state.leadData.name}
- Telefone/WhatsApp: ${state.leadData.phone}
- Empresa: ${state.leadData.company || 'N/A'}
- Necessidade: ${state.leadData.service}
- Objetivo/Escopo: ${state.leadData.objective || 'N/A'}
- Detalhes: ${state.leadData.notes || 'Registado via automação do Chat IA'}
Data: ${new Date().toLocaleString('pt-PT')}`
        };

        try {
            const resp = await fetch(CONFIG.crmLeadApi, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(payload)
            });
            if (!resp.ok) {
                // Fallback para /contacto
                await fetch(CONFIG.fallbackContactApi, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
            }
        } catch (err) {
            console.warn('[GundjaTech CRM Chat] Falha ao enviar para API CRM:', err);
        }
    }

    // Lógica do Transbordo Humano
    function triggerHumanHandoff(contextReason) {
        state.step = 'HUMAN_HANDOFF';
        const visitorName = state.leadData.name ? `, ${state.leadData.name}` : '';
        const serviceMention = state.leadData.service ? ` sobre *${state.leadData.service}*` : '';
        const waMsg = `Olá! Estive a falar no chat do site da GundjaTech e gostaria de falar com um atendente humano${serviceMention}. ${state.leadData.name ? '(Meu nome: ' + state.leadData.name + ')' : ''}`;

        addBotMessage(
            `Com certeza${visitorName}! Estou a transferir-te agora mesmo para a nossa equipa de consultores especializados no WhatsApp da GundjaTech / RACHI. 💬\n\nClica no botão verde abaixo para iniciar a conversa direta:`,
            [
                { label: 'Voltar ao Menu Principal', action: 'reset_flow' }
            ],
            true,
            waMsg
        );

        // Se o lead já tiver nome ou telefone, salvar no CRM
        if (state.leadData.name || state.leadData.phone) {
            state.leadData.notes += ' [Solicitou atendimento humano no WhatsApp]';
            syncLeadToCrm();
        }
    }

    // Gerenciador de Cliques nas Opções (Chips)
    function handleChipClick(chip) {
        addUserMessage(chip.label);

        switch (chip.action) {
            case 'site_novo':
                state.leadData.service = 'Criação de Site Novo';
                state.step = 'SITE_NOVO_SEGMENT';
                addBotMessage(
                    'Excelente escolha! Um site profissional moderno eleva a autoridade da sua marca e converte visitantes em clientes 24h por dia. 🚀\nQual é o segmento da sua empresa ou projeto?',
                    [
                        { label: 'Comércio & Loja Virtual', action: 'seg_comercio' },
                        { label: 'Serviços & Consultoria', action: 'seg_servicos' },
                        { label: 'Tecnologia & Inovação', action: 'seg_ti' },
                        { label: 'Construção & Indústria', action: 'seg_industria' },
                        { label: 'Falar com Humano', action: 'falar_humano' }
                    ]
                );
                break;

            case 'refazer_site':
                state.leadData.service = 'Reformulação / Redesign de Site';
                state.step = 'REFAZER_MOTIVO';
                addBotMessage(
                    'Reformular o site é a chave para aumentar velocidade, SEO e taxas de conversão. ⚡\nO que gostaria de melhorar no seu site atual?',
                    [
                        { label: 'Design mais moderno e profissional', action: 'motivo_design' },
                        { label: 'Mais rápido no telemóvel', action: 'motivo_mobile' },
                        { label: 'Integrar WhatsApp & Pagamentos', action: 'motivo_integracao' },
                        { label: 'Falar com Humano', action: 'falar_humano' }
                    ]
                );
                break;

            case 'quanto_custa':
                state.leadData.service = 'Cotação / Orçamento';
                state.step = 'PRICE_TYPE';
                addBotMessage(
                    'Os nossos projetos são sob medida com entrega ágil e alta disponibilidade. Desenvolvemos desde Landing Pages comerciais de alta conversão (a partir de 95.000 Kz) até plataformas empresariais completas e lojas virtuais integradas.\nQual solução melhor atende ao seu plano?',
                    [
                        { label: 'Landing Page Comercial', action: 'preco_landing' },
                        { label: 'Site Institucional Completo', action: 'preco_institucional' },
                        { label: 'Loja Virtual / E-commerce', action: 'preco_loja' },
                        { label: 'Sistema / Software Web', action: 'preco_sistema' },
                        { label: 'Falar com Humano', action: 'falar_humano' }
                    ]
                );
                break;

            case 'so_olhando':
                state.leadData.service = 'Exploração Institucional';
                state.step = 'LOOKING';
                addBotMessage(
                    'Sem problemas! Sinta-se à vontade para navegar pelos nossos serviços, catálogo de TI e soluções corporativas. Quando precisar de algo ou quiser tirar dúvidas com um especialista, basta clicar abaixo! 😊',
                    [
                        { label: 'Quero um site novo', action: 'site_novo' },
                        { label: 'Ver Soluções de TI', action: 'ver_ti' },
                        { label: 'Falar com Humano', action: 'falar_humano' }
                    ]
                );
                break;

            case 'falar_humano':
                triggerHumanHandoff('Opção de falar com humano selecionada');
                break;

            case 'reset_flow':
                state.step = 'INIT';
                addBotMessage(
                    'Como posso ajudar a sua empresa hoje?',
                    [
                        { label: 'Quero um site novo', action: 'site_novo' },
                        { label: 'Quero refazer meu site', action: 'refazer_site' },
                        { label: 'Quanto custa?', action: 'quanto_custa' },
                        { label: 'Falar com Humano', action: 'falar_humano' }
                    ]
                );
                break;

            // Sub-opções que conduzem à captura de Lead
            case 'seg_comercio':
            case 'seg_servicos':
            case 'seg_ti':
            case 'seg_industria':
            case 'motivo_design':
            case 'motivo_mobile':
            case 'motivo_integracao':
            case 'preco_landing':
            case 'preco_institucional':
            case 'preco_loja':
            case 'preco_sistema':
            case 'ver_ti':
                state.leadData.objective = chip.label;
                state.step = 'ASK_NAME';
                addBotMessage(
                    'Perfeito! Para que os nossos especialistas técnicos preparem a estimativa detalhada e o cronograma ideal, por favor, **qual é o seu nome** (ou nome da sua empresa)?'
                );
                break;

            default:
                addBotMessage('Entendido! Por favor, informe o seu nome para darmos seguimento:');
                state.step = 'ASK_NAME';
                break;
        }
    }

    // Processar Mensagens Livres Digitadas pelo Usuário
    function handleUserInput(userText) {
        const text = userText.trim();
        if (!text) return;

        addUserMessage(text);
        input.value = '';

        const lower = text.toLowerCase();

        // 1. Verificação Imediata de Transbordo Humano
        if (
            lower.includes('humano') ||
            lower.includes('atendente') ||
            lower.includes('pessoa') ||
            lower.includes('alguém') ||
            lower.includes('whatsapp') ||
            lower.includes('zap') ||
            lower.includes('ligar') ||
            lower.includes('telefone') ||
            lower.includes('falar com')
        ) {
            triggerHumanHandoff(text);
            return;
        }

        // 2. Fluxo Passo a Passo de Captura de Lead (CRM)
        if (state.step === 'ASK_NAME') {
            state.leadData.name = text;
            state.step = 'ASK_PHONE';
            addBotMessage(
                `Muito obrigado, **${text}**! 👍\n\nPor favor, informe o seu número de **WhatsApp / Telemóvel** (ex: 972 888 585 ou +244...) para que possamos enviar o resumo da proposta e falar consigo:`
            );
            return;
        }

        if (state.step === 'ASK_PHONE') {
            const cleanDigits = text.replace(/\D/g, '');
            if (cleanDigits.length < 8) {
                addBotMessage(
                    'Por favor, insira um contacto telefónico ou WhatsApp válido (com pelo menos 9 dígitos) para que a nossa equipa possa enviar a proposta:'
                );
                return;
            }

            state.leadData.phone = text;
            state.step = 'COMPLETED';

            // Gravar no CRM via API
            syncLeadToCrm();

            const waMsg = `Olá! Meu nome é ${state.leadData.name}. Deixei meu contacto (${state.leadData.phone}) no chat da GundjaTech referente a: ${state.leadData.service || 'Soluções Web / TI'}.`;

            addBotMessage(
                `Fantástico, **${state.leadData.name}**! 🎉\n\nOs seus dados foram registados no nosso **sistema CRM com sucesso**. A nossa equipa de projetos já foi notificada e entrará em contacto muito em breve.\n\nSe preferir falar connosco agora mesmo, clique no botão do WhatsApp:`,
                [
                    { label: 'Falar com Humano no WhatsApp', action: 'falar_humano' },
                    { label: 'Fazer nova consulta', action: 'reset_flow' }
                ],
                true,
                waMsg
            );
            return;
        }

        // 3. IA de Resposta Contextual (GundjaTech / RACHI Knowledge Base)
        if (lower.includes('site') || lower.includes('landing') || lower.includes('página') || lower.includes('web')) {
            state.leadData.service = 'Criação / Reformulação de Site';
            state.step = 'ASK_NAME';
            addBotMessage(
                'Criamos websites modernos, ultra-rápidos e totalmente focados em converter visitantes em clientes. Entregamos com integração de WhatsApp, SEO para o Google e design 100% responsivo.\n\nPara lhe enviar uma proposta, **qual é o seu nome**?'
            );
            return;
        }

        if (lower.includes('preço') || lower.includes('custa') || lower.includes('orçamento') || lower.includes('valor')) {
            state.leadData.service = 'Consulta de Preços';
            state.step = 'ASK_NAME';
            addBotMessage(
                'Temos opções a partir de 95.000 Kz para Landing Pages comerciais de alta conversão, e propostas completas para sites corporativos e e-commerce.\n\nQual é o seu nome para apresentarmos uma solução sob medida para o seu orçamento?'
            );
            return;
        }

        if (lower.includes('loja') || lower.includes('e-commerce') || lower.includes('vender')) {
            state.leadData.service = 'Loja Virtual / E-commerce';
            state.step = 'ASK_NAME';
            addBotMessage(
                'Desenvolvemos lojas virtuais robustas com catálogo inteligente, cálculo de frete, pagamentos e notificações automáticas.\n\nQual é o seu nome para detalharmos o projeto da sua loja?'
            );
            return;
        }

        if (lower.includes('curso') || lower.includes('formação') || lower.includes('academy') || lower.includes('aula')) {
            state.leadData.service = 'RACHI Academy — Cursos e Formações';
            state.step = 'ASK_NAME';
            addBotMessage(
                'A RACHI Academy oferece cursos executivos e técnicos com certificação prática em Tecnologia, Gestão e Negócios.\n\nQual é o seu nome e qual formação tem interesse?'
            );
            return;
        }

        if (lower.includes('rh') || lower.includes('recrutamento') || lower.includes('capital') || lower.includes('trabalho')) {
            state.leadData.service = 'RACHI Human Capital — RH & Recrutamento';
            state.step = 'ASK_NAME';
            addBotMessage(
                'A RACHI Human Capital cuida de recrutamento, selecção de talentos, cedência temporária e regularização documental.\n\nQual é o seu nome e de que apoio necessita a sua organização?'
            );
            return;
        }

        // Resposta padrão inteligente convidando à identificação
        state.leadData.notes = (state.leadData.notes ? state.leadData.notes + ' | ' : '') + text;
        state.step = 'ASK_NAME';
        addBotMessage(
            'Entendi perfeitamente! Para que um dos nossos consultores técnicos da GundjaTech possa avaliar a sua necessidade e responder com precisão, **qual é o seu nome**?',
            [
                { label: 'Falar com Humano', action: 'falar_humano' }
            ]
        );
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        handleUserInput(input.value);
    });

    // Inicialização da interface
    renderMessages();

})();
