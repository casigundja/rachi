/**
 * RACHI — Assistente Virtual Conversacional Inteligente (IA Interativa)
 * Comunicação fluida e interativa em tempo real com conhecimento de todo o ecossistema RACHI.
 * Permite diálogo natural, consultoria executiva, qualificação de leads e transbordo para WhatsApp (+244 972 888 585).
 */
(function() {
    'use strict';

    function initRachiAIChat() {
        if (window.__RachiAIChatInitialized) return;
        if (!document.body) {
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initRachiAIChat);
            } else {
                window.addEventListener('load', initRachiAIChat);
            }
            return;
        }
        window.__RachiAIChatInitialized = true;

        // Limpeza de instâncias anteriores
        const oldRoot = document.getElementById('rachi-chat-widget-root') || document.getElementById('gt-chat-widget-root');
        if (oldRoot) oldRoot.remove();
        const oldStyles = document.getElementById('rachi-chat-styles') || document.getElementById('gt-chat-styles');
        if (oldStyles) oldStyles.remove();

        const CONFIG = {
            officialWhatsApp: '244972888585',
            officialDisplayPhone: '+244 972 888 585',
            chatApi: '/api/chat',
            crmLeadApi: '/api/crm/lead',
            storageKey: 'rachi_chat_realistic_v5',
        };

        // Estado da Conversa Interativa (100% Livre e Natural)
        let state = {
            isOpen: false,
            isLoading: false,
            isGreetingPlaying: false,
            leadData: {
                name: '',
                phone: '',
                company: '',
                interest: ''
            },
            messages: []
        };

        // Restaurar histórico de sessão se houver
        try {
            const saved = sessionStorage.getItem(CONFIG.storageKey);
            if (saved) {
                const parsed = JSON.parse(saved);
                if (parsed && Array.isArray(parsed.messages) && parsed.messages.length > 0) {
                    state.messages = parsed.messages;
                    state.leadData = parsed.leadData || state.leadData;
                }
            }
        } catch(e) {}

        function persistState() {
            try {
                sessionStorage.setItem(CONFIG.storageKey, JSON.stringify({
                    messages: state.messages,
                    leadData: state.leadData
                }));
            } catch(e) {}
        }

        // Estilos Visuais Modernos, Translúcidos e Fieis ao Padrão
        const styleEl = document.createElement('style');
        styleEl.id = 'rachi-chat-styles';
        styleEl.textContent = `
            #rachi-chat-widget-root {
                font-family: 'Montserrat', system-ui, -apple-system, sans-serif !important;
                -webkit-font-smoothing: antialiased;
                z-index: 999999 !important;
                position: relative;
            }

            /* FAB Flutuante - Âmbar Dourado com Ícone Escuro e Badge Online */
            .rachi-chat-fab {
                position: fixed !important;
                bottom: 24px !important;
                right: 24px !important;
                width: 58px !important;
                height: 58px !important;
                border-radius: 9999px !important;
                background: #eba72d !important;
                box-shadow: 0 8px 24px rgba(235, 167, 45, 0.4), 0 3px 8px rgba(0, 0, 0, 0.2) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                border: none !important;
                transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
                z-index: 999999 !important;
                padding: 0 !important;
                outline: none !important;
            }

            .rachi-chat-fab:hover {
                transform: scale(1.08) translateY(-2px) !important;
                background: #f1b342 !important;
                box-shadow: 0 12px 30px rgba(235, 167, 45, 0.55), 0 4px 12px rgba(0, 0, 0, 0.25) !important;
            }

            .rachi-chat-fab:active {
                transform: scale(0.96) !important;
            }

            .rachi-chat-fab svg {
                width: 28px !important;
                height: 28px !important;
                color: #111827 !important;
                stroke: #111827 !important;
                transition: transform 0.25s ease !important;
            }

            .rachi-chat-fab-badge {
                position: absolute !important;
                top: 2px !important;
                right: 2px !important;
                width: 13px !important;
                height: 13px !important;
                background-color: #10B981 !important;
                border: 2px solid #ffffff !important;
                border-radius: 9999px !important;
                box-shadow: 0 0 6px rgba(16, 185, 129, 0.8) !important;
            }

            /* Balão Proativo / Tooltip de Boas-Vindas RACHI */
            .rachi-chat-callout {
                position: fixed !important;
                bottom: 94px !important;
                right: 24px !important;
                width: 275px !important;
                max-width: calc(100vw - 48px) !important;
                background: #FFFFFF !important;
                border-radius: 18px !important;
                padding: 16px 18px !important;
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.12), 0 3px 10px rgba(0, 0, 0, 0.05) !important;
                border: 1px solid rgba(0, 80, 240, 0.06) !important;
                z-index: 999997 !important;
                cursor: pointer !important;
                transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
                transform-origin: bottom right !important;
                animation: rachiCalloutIn 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
            }

            html.dark .rachi-chat-callout {
                background: #111B29 !important;
                border-color: rgba(255, 255, 255, 0.1) !important;
                box-shadow: 0 14px 35px rgba(0, 0, 0, 0.5) !important;
            }

            .rachi-chat-callout.rachi-hidden {
                opacity: 0 !important;
                visibility: hidden !important;
                transform: scale(0.9) translateY(12px) !important;
                pointer-events: none !important;
            }

            .rachi-chat-callout-header {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 10px !important;
            }

            .rachi-chat-callout-title {
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #0F172A !important;
                margin: 0 !important;
                line-height: 1.25 !important;
            }

            html.dark .rachi-chat-callout-title {
                color: #FFFFFF !important;
            }

            .rachi-chat-callout-close {
                width: 22px !important;
                height: 22px !important;
                border-radius: 9999px !important;
                background: transparent !important;
                color: #94A3B8 !important;
                border: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                padding: 0 !important;
                transition: color 0.15s ease, background 0.15s ease !important;
                flex-shrink: 0 !important;
            }

            .rachi-chat-callout-close:hover {
                color: #475569 !important;
                background: #F1F5F9 !important;
            }

            html.dark .rachi-chat-callout-close:hover {
                color: #FFFFFF !important;
                background: rgba(255, 255, 255, 0.1) !important;
            }

            .rachi-chat-callout-body {
                font-size: 13.5px !important;
                color: #475569 !important;
                line-height: 1.45 !important;
                margin: 6px 0 0 0 !important;
                font-weight: 450 !important;
            }

            html.dark .rachi-chat-callout-body {
                color: #94A3B8 !important;
            }

            @keyframes rachiCalloutIn {
                from {
                    opacity: 0;
                    transform: scale(0.88) translateY(16px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            /* Janela Modal do Chat - Elegante e Levemente Translúcida (Glassmorphism) */
            .rachi-chat-window {
                position: fixed !important;
                bottom: 96px !important;
                right: 24px !important;
                width: 380px !important;
                max-width: calc(100vw - 32px) !important;
                height: 560px !important;
                max-height: calc(100vh - 120px) !important;
                background: rgba(255, 255, 255, 0.88) !important;
                backdrop-filter: blur(20px) saturate(190%) !important;
                -webkit-backdrop-filter: blur(20px) saturate(190%) !important;
                border: 1px solid rgba(255, 255, 255, 0.6) !important;
                border-radius: 20px !important;
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden !important;
                z-index: 999998 !important;
                transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
                transform-origin: bottom right !important;
            }

            html.dark .rachi-chat-window {
                background: rgba(11, 17, 26, 0.85) !important;
                backdrop-filter: blur(20px) saturate(190%) !important;
                -webkit-backdrop-filter: blur(20px) saturate(190%) !important;
                border: 1px solid rgba(255, 255, 255, 0.12) !important;
                box-shadow: 0 20px 55px rgba(0, 0, 0, 0.75), 0 0 0 1px rgba(255, 255, 255, 0.1) !important;
            }

            .rachi-chat-window.rachi-hidden {
                opacity: 0 !important;
                visibility: hidden !important;
                transform: scale(0.85) translateY(20px) !important;
                pointer-events: none !important;
            }

            /* Header Pitch Black Levemente Translúcido */
            .rachi-chat-header {
                background: rgba(0, 0, 0, 0.92) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                padding: 14px 18px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            }

            .rachi-chat-header-brand {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
            }

            .rachi-chat-logo-ring {
                width: 40px !important;
                height: 40px !important;
                border-radius: 9999px !important;
                background: #111111 !important;
                border: 1.5px solid #eba72d !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5) !important;
                padding: 4px !important;
            }

            .rachi-chat-header-info h4 {
                margin: 0 !important;
                font-size: 16px !important;
                font-weight: 800 !important;
                color: #FFFFFF !important;
                letter-spacing: 0.5px !important;
                line-height: 1.2 !important;
            }

            .rachi-chat-status {
                display: flex !important;
                align-items: center !important;
                gap: 6px !important;
                margin-top: 2px !important;
                font-size: 11px !important;
                font-weight: 500 !important;
                color: #A1A1AA !important;
            }

            .rachi-chat-dot {
                width: 7px !important;
                height: 7px !important;
                border-radius: 9999px !important;
                background-color: #10B981 !important;
                box-shadow: 0 0 6px #10B981 !important;
            }

            .rachi-chat-close-btn {
                width: 32px !important;
                height: 32px !important;
                border-radius: 9999px !important;
                background: rgba(255, 255, 255, 0.12) !important;
                color: #FFFFFF !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: none !important;
                cursor: pointer !important;
                transition: background 0.2s ease, transform 0.15s ease !important;
                outline: none !important;
                padding: 0 !important;
            }

            .rachi-chat-close-btn:hover {
                background: rgba(255, 255, 255, 0.25) !important;
                transform: scale(1.05) !important;
            }

            /* Corpo das Mensagens Translúcido */
            .rachi-chat-body {
                flex: 1 !important;
                padding: 16px !important;
                overflow-y: auto !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 12px !important;
                background: rgba(248, 250, 252, 0.72) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                scroll-behavior: smooth !important;
            }

            html.dark .rachi-chat-body {
                background: rgba(11, 17, 26, 0.75) !important;
            }

            .rachi-chat-body::-webkit-scrollbar {
                width: 5px !important;
            }
            .rachi-chat-body::-webkit-scrollbar-thumb {
                background: rgba(0, 80, 240, 0.2) !important;
                border-radius: 9999px !important;
            }

            .rachi-chat-bubble {
                max-width: 86% !important;
                padding: 12px 16px !important;
                font-size: 13.5px !important;
                line-height: 1.5 !important;
                word-break: break-word !important;
                animation: rachiFadeIn 0.25s ease !important;
            }

            .rachi-chat-bubble.rachi-bot {
                align-self: flex-start !important;
                background: rgba(255, 255, 255, 0.94) !important;
                backdrop-filter: blur(8px) !important;
                color: #0F172A !important;
                border-radius: 18px 18px 18px 4px !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
                font-weight: 500 !important;
            }

            html.dark .rachi-chat-bubble.rachi-bot {
                background: rgba(21, 31, 46, 0.9) !important;
                color: #F1F5F9 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
            }

            .rachi-chat-bubble.rachi-user {
                align-self: flex-end !important;
                background: rgba(7, 19, 38, 0.95) !important;
                color: #FFFFFF !important;
                border-radius: 18px 18px 4px 18px !important;
                font-weight: 500 !important;
                box-shadow: 0 3px 12px rgba(7, 19, 38, 0.25) !important;
            }

            html.dark .rachi-chat-bubble.rachi-user {
                background: #0050f0 !important;
            }

            /* Indicador de Digitação Realista (Bolha com 3 pontos pulsantes) */
            .rachi-typing-indicator {
                align-self: flex-start !important;
                display: flex !important;
                align-items: center !important;
                gap: 5px !important;
                padding: 12px 18px !important;
                background: rgba(255, 255, 255, 0.94) !important;
                backdrop-filter: blur(8px) !important;
                border-radius: 18px 18px 18px 4px !important;
                width: fit-content !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
                animation: rachiFadeIn 0.2s ease !important;
            }

            html.dark .rachi-typing-indicator {
                background: rgba(21, 31, 46, 0.9) !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
            }

            .rachi-typing-dot {
                width: 6.5px !important;
                height: 6.5px !important;
                border-radius: 9999px !important;
                background: #94A3B8 !important;
                animation: rachiBounce 1.3s infinite ease-in-out !important;
            }

            html.dark .rachi-typing-dot {
                background: #64748B !important;
            }

            .rachi-typing-dot:nth-child(2) { animation-delay: 0.2s !important; }
            .rachi-typing-dot:nth-child(3) { animation-delay: 0.4s !important; }

            @keyframes rachiBounce {
                0%, 60%, 100% { transform: translateY(0); opacity: 0.45; }
                30% { transform: translateY(-4px); opacity: 1; }
            }

            @keyframes rachiFadeIn {
                from { opacity: 0; transform: translateY(6px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* WhatsApp Card */
            .rachi-whatsapp-card {
                background: rgba(240, 253, 244, 0.92) !important;
                border: 1.5px solid #10B981 !important;
                border-radius: 14px !important;
                padding: 12px 14px !important;
                margin-top: 4px !important;
                box-shadow: 0 4px 14px rgba(16, 185, 129, 0.15) !important;
                animation: rachiFadeIn 0.3s ease !important;
            }

            html.dark .rachi-whatsapp-card {
                background: rgba(6, 32, 23, 0.9) !important;
                border-color: #059669 !important;
            }

            .rachi-whatsapp-btn {
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

            .rachi-whatsapp-btn:hover {
                background: #20BA5A !important;
                transform: translateY(-1px) !important;
                box-shadow: 0 5px 14px rgba(37, 211, 102, 0.45) !important;
            }

            /* Input Inferior com Botão Âmbar e Efeito de Vidro */
            .rachi-chat-footer {
                padding: 12px 16px 16px 16px !important;
                background: rgba(255, 255, 255, 0.88) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                border-top: 1px solid rgba(0, 0, 0, 0.06) !important;
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
            }

            html.dark .rachi-chat-footer {
                background: rgba(11, 17, 26, 0.88) !important;
                border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            }

            .rachi-chat-input-pill {
                flex: 1 !important;
                height: 44px !important;
                border-radius: 9999px !important;
                border: 1.5px solid rgba(226, 232, 240, 0.9) !important;
                background: rgba(255, 255, 255, 0.92) !important;
                padding: 0 18px !important;
                font-size: 13.5px !important;
                color: #0F172A !important;
                outline: none !important;
                transition: all 0.2s ease !important;
            }

            html.dark .rachi-chat-input-pill {
                background: rgba(21, 31, 46, 0.85) !important;
                border-color: rgba(255, 255, 255, 0.15) !important;
                color: #FFFFFF !important;
            }

            .rachi-chat-input-pill:focus {
                border-color: #eba72d !important;
                background: #FFFFFF !important;
                box-shadow: 0 0 0 3px rgba(235, 167, 45, 0.2) !important;
            }

            .rachi-chat-send-btn {
                width: 44px !important;
                height: 44px !important;
                border-radius: 9999px !important;
                background: #eba72d !important;
                color: #FFFFFF !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: none !important;
                cursor: pointer !important;
                transition: all 0.2s ease !important;
                box-shadow: 0 3px 10px rgba(235, 167, 45, 0.4) !important;
                outline: none !important;
                padding: 0 !important;
                flex-shrink: 0 !important;
            }

            .rachi-chat-send-btn:hover {
                background: #f1b342 !important;
                transform: scale(1.05) !important;
            }

            .rachi-chat-send-btn:active {
                transform: scale(0.95) !important;
            }

            .rachi-chat-send-btn svg {
                width: 20px !important;
                height: 20px !important;
                stroke-width: 2.5 !important;
            }

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
                .rachi-chat-window {
                    right: 12px !important;
                    bottom: 84px !important;
                    max-height: calc(100vh - 100px) !important;
                    width: calc(100vw - 24px) !important;
                }
                .rachi-chat-callout {
                    right: 16px !important;
                    bottom: 88px !important;
                    max-width: calc(100vw - 32px) !important;
                }
            }

            /* Ocultação total e graciosa de botões flutuantes quando a sacola ou checkout estão ativos */
            body.cart-drawer-open #rachi-chat-widget-root,
            body.cart-drawer-open .rachi-chat-fab,
            body.cart-drawer-open .rachi-chat-callout,
            body.cart-drawer-open .rachi-fab-dock,
            body.rachi-overlay-active #rachi-chat-widget-root,
            body.rachi-overlay-active .rachi-chat-fab,
            body.rachi-overlay-active .rachi-chat-callout,
            body.rachi-overlay-active .rachi-fab-dock,
            body.modal-open #rachi-chat-widget-root,
            body.modal-open .rachi-chat-fab,
            body.modal-open .rachi-chat-callout,
            body.modal-open .rachi-fab-dock {
                opacity: 0 !important;
                pointer-events: none !important;
                visibility: hidden !important;
                transform: translateY(24px) scale(0.96) !important;
                transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s !important;
            }
        `;
        document.head.appendChild(styleEl);

        // Ícone Oficial do Símbolo RACHI (com gradiente Azul-Cyan a Âmbar)
        const rachiSymbolSvg = `
            <svg width="24" height="24" viewBox="0 0 334 405" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M 11 119 L 9 120 L 7 122 L 7 124 L 8 126 L 9 127 L 11 128 L 13 129 L 17 130 L 31 132 L 63 139 L 67 141 L 89 146 L 103 149 L 117 152 L 122 153 L 127 154 L 133 155 L 145 155 L 146 152 L 144 148 L 142 147 L 140 146 L 136 145 L 126 143 L 113 141 L 91 135 L 82 134 L 42 124 L 33 122 L 24 120 L 19 119 Z M 65 0 L 56 1 L 51 2 L 48 3 L 45 4 L 40 6 L 33 10 L 29 13 L 25 16 L 17 24 L 14 28 L 11 33 L 7 41 L 3 53 L 2 59 L 1 66 L 0 79 L 1 87 L 3 91 L 6 93 L 8 94 L 11 95 L 15 95 L 19 97 L 32 99 L 36 101 L 45 103 L 63 106 L 81 111 L 99 114 L 112 117 L 138 124 L 147 125 L 151 127 L 160 128 L 166 130 L 175 133 L 181 136 L 184 138 L 187 141 L 189 144 L 190 146 L 191 148 L 192 152 L 192 161 L 191 165 L 190 167 L 189 169 L 187 172 L 182 177 L 176 180 L 173 181 L 161 181 L 154 180 L 141 178 L 135 177 L 119 174 L 109 171 L 104 171 L 94 168 L 78 166 L 58 161 L 47 159 L 34 157 L 27 156 L 15 155 L 7 156 L 5 157 L 3 159 L 2 162 L 1 167 L 0 174 L 1 216 L 1 235 L 0 351 L 1 358 L 3 361 L 3 365 L 5 370 L 7 372 L 7 374 L 9 377 L 13 383 L 20 390 L 25 394 L 28 396 L 36 400 L 41 402 L 45 402 L 49 404 L 69 404 L 73 403 L 78 402 L 83 400 L 85 398 L 87 398 L 94 394 L 100 389 L 101 388 L 106 382 L 108 379 L 110 376 L 110 374 L 112 372 L 113 370 L 116 362 L 117 356 L 118 351 L 119 334 L 120 257 L 125 259 L 131 260 L 136 260 L 138 262 L 138 264 L 139 266 L 142 270 L 145 274 L 153 283 L 158 291 L 165 299 L 176 315 L 187 328 L 201 348 L 217 368 L 219 372 L 222 376 L 226 381 L 237 392 L 240 394 L 243 396 L 245 397 L 249 398 L 251 400 L 253 401 L 256 402 L 265 404 L 285 404 L 292 402 L 302 398 L 305 396 L 311 392 L 320 383 L 323 379 L 326 374 L 327 372 L 328 370 L 330 365 L 332 358 L 333 350 L 333 346 L 332 338 L 331 334 L 330 331 L 328 326 L 327 324 L 326 322 L 322 316 L 316 307 L 311 300 L 306 293 L 292 274 L 288 270 L 286 266 L 271 248 L 268 243 L 272 238 L 281 229 L 287 221 L 290 217 L 297 206 L 299 202 L 302 196 L 305 189 L 307 183 L 310 174 L 313 162 L 314 156 L 315 150 L 316 137 L 316 127 L 315 114 L 313 108 L 313 102 L 312 98 L 311 94 L 308 85 L 306 80 L 300 68 L 297 63 L 291 54 L 287 49 L 272 34 L 267 30 L 263 27 L 260 25 L 257 23 L 252 20 L 240 14 L 232 11 L 229 10 L 222 8 L 218 7 L 214 6 L 208 5 L 201 4 L 192 3 L 167 2 L 121 2 L 94 0 Z" fill="url(#rachiChatGrad)"/>
                <defs>
                    <linearGradient id="rachiChatGrad" x1="0" y1="0" x2="334" y2="405" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#00a3e0"/>
                        <stop offset="1" stop-color="#eba72d"/>
                    </linearGradient>
                </defs>
            </svg>
        `;

        // Criar Estrutura DOM
        const root = document.createElement('div');
        root.id = 'rachi-chat-widget-root';
        root.innerHTML = `
            <!-- Balão Proativo / Tooltip Adaptado para RACHI -->
            <div id="rachi-chat-callout" class="rachi-chat-callout rachi-hidden" role="tooltip" aria-live="polite">
                <div class="rachi-chat-callout-header">
                    <h5 class="rachi-chat-callout-title">Olá! Precisa de ajuda?</h5>
                    <button type="button" id="rachi-chat-callout-close" class="rachi-chat-callout-close" aria-label="Fechar aviso">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <p class="rachi-chat-callout-body">Posso apoiar a sua empresa com as soluções inteligentes da RACHI.</p>
            </div>

            <!-- Botão Flutuante (FAB) Âmbar -->
            <button type="button" id="rachi-chat-fab-btn" class="rachi-chat-fab" aria-label="Abrir Chat Interativo RACHI" title="Conversar com a IA da RACHI">
                <div class="rachi-chat-fab-badge"></div>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
            </button>

            <!-- Janela do Chat Interativo -->
            <div id="rachi-chat-modal" class="rachi-chat-window rachi-hidden" role="dialog" aria-modal="true" aria-label="Chat Interativo RACHI">
                <!-- Header Pitch Black -->
                <div class="rachi-chat-header">
                    <div class="rachi-chat-header-brand">
                        <div class="rachi-chat-logo-ring">
                            ${rachiSymbolSvg}
                        </div>
                        <div class="rachi-chat-header-info">
                            <h4>RACHI</h4>
                            <div class="rachi-chat-status">
                                <span class="rachi-chat-dot"></span>
                                <span>Online agora</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="rachi-chat-close-btn" class="rachi-chat-close-btn" aria-label="Fechar Chat">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <!-- Messages Body -->
                <div id="rachi-chat-messages" class="rachi-chat-body"></div>

                <!-- Footer Input com Botão Âmbar -->
                <form id="rachi-chat-form" class="rachi-chat-footer">
                    <input type="text" id="rachi-chat-input" class="rachi-chat-input-pill" placeholder="Digite sua mensagem..." autocomplete="off" />
                    <button type="submit" id="rachi-chat-submit" class="rachi-chat-send-btn" aria-label="Enviar mensagem">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>
            </div>
        `;
        document.body.appendChild(root);

        const fabBtn = document.getElementById('rachi-chat-fab-btn');
        const modal = document.getElementById('rachi-chat-modal');
        const closeBtn = document.getElementById('rachi-chat-close-btn');
        const callout = document.getElementById('rachi-chat-callout');
        const calloutClose = document.getElementById('rachi-chat-callout-close');
        const messagesEl = document.getElementById('rachi-chat-messages');
        const form = document.getElementById('rachi-chat-form');
        const input = document.getElementById('rachi-chat-input');

        function isAnyOverlayActive() {
            return document.body.classList.contains('cart-drawer-open') || 
                   document.body.classList.contains('rachi-overlay-active') ||
                   document.body.classList.contains('modal-open');
        }

        function showCallout() {
            let isDismissed = false;
            try {
                isDismissed = sessionStorage.getItem('rachi_chat_callout_dismissed') === '1';
            } catch(e) {}

            if (!isDismissed && !state.isOpen && !isAnyOverlayActive() && callout) {
                callout.classList.remove('rachi-hidden');
            }
        }

        function hideCallout(permanent) {
            if (callout) {
                callout.classList.add('rachi-hidden');
            }
            if (permanent) {
                try {
                    sessionStorage.setItem('rachi_chat_callout_dismissed', '1');
                } catch(e) {}
            }
        }

        window.RachiChatDismissBubble = function() {
            hideCallout(true);
        };

        // Observa abertura do carrinho ou modais para recolher o chat e o balão instantaneamente
        try {
            const overlayObserver = new MutationObserver(() => {
                if (isAnyOverlayActive()) {
                    hideCallout(false);
                    if (state.isOpen) {
                        toggleChat(false);
                    }
                }
            });
            overlayObserver.observe(document.body, { attributes: true, attributeFilter: ['class'] });
        } catch(e) {}

        if (callout) {
            callout.addEventListener('click', (e) => {
                e.stopPropagation();
                hideCallout(true);
                toggleChat(true);
            });
        }

        if (calloutClose) {
            calloutClose.addEventListener('click', (e) => {
                e.stopPropagation();
                hideCallout(true);
            });
        }

        // Exibir o balão proativo após 2.5 segundos
        setTimeout(showCallout, 2500);

        function scrollToBottom() {
            setTimeout(() => {
                messagesEl.scrollTop = messagesEl.scrollHeight;
            }, 50);
        }

        function showTyping() {
            state.isLoading = true;
            let ind = document.getElementById('rachi-typing-node');
            if (!ind) {
                ind = document.createElement('div');
                ind.id = 'rachi-typing-node';
                ind.className = 'rachi-typing-indicator';
                ind.innerHTML = `
                    <div class="rachi-typing-dot"></div>
                    <div class="rachi-typing-dot"></div>
                    <div class="rachi-typing-dot"></div>
                `;
                messagesEl.appendChild(ind);
            }
            scrollToBottom();
        }

        function hideTyping() {
            state.isLoading = false;
            const ind = document.getElementById('rachi-typing-node');
            if (ind) ind.remove();
        }

        function renderMessages() {
            const typingNode = document.getElementById('rachi-typing-node');
            messagesEl.innerHTML = '';
            
            state.messages.forEach(msg => {
                const bubble = document.createElement('div');
                bubble.className = `rachi-chat-bubble ${msg.sender === 'bot' ? 'rachi-bot' : 'rachi-user'}`;
                
                let formatted = msg.text
                    .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                    .replace(/\n/g, '<br>');
                bubble.innerHTML = formatted;
                messagesEl.appendChild(bubble);

                if (msg.isWhatsAppCard) {
                    renderWhatsAppCard(msg.whatsAppText);
                }
            });

            if (typingNode && state.isLoading) {
                messagesEl.appendChild(typingNode);
            }

            scrollToBottom();
        }

        // Animação Realista de Boas-Vindas com Indicador de Digitação
        async function playRealisticGreeting() {
            if (state.isGreetingPlaying) return;
            state.isGreetingPlaying = true;

            // 1. Mostrar bolha de digitação inicial (humano pensando/digitando)
            showTyping();
            await new Promise(res => setTimeout(res, 900));

            // 2. Apresentar primeira mensagem
            hideTyping();
            state.messages.push({
                sender: 'bot',
                text: 'Olá! Seja bem-vindo à **RACHI — Soluções Inteligentes**. 🇦🇴'
            });
            renderMessages();

            // 3. Mostrar bolha de digitação novamente para a segunda frase
            showTyping();
            await new Promise(res => setTimeout(res, 1100));

            // 4. Apresentar segunda mensagem calorosa
            hideTyping();
            state.messages.push({
                sender: 'bot',
                text: 'Como posso apoiar a sua empresa hoje? Sinta-se à vontade para me falar sobre o que procura ou fazer a sua pergunta!'
            });
            renderMessages();
            persistState();

            state.isGreetingPlaying = false;
        }

        function toggleChat(forceState) {
            state.isOpen = typeof forceState === 'boolean' ? forceState : !state.isOpen;
            if (state.isOpen) {
                hideCallout(false);
                modal.classList.remove('rachi-hidden');
                setTimeout(() => {
                    input.focus();
                    scrollToBottom();
                }, 100);

                // Se ainda não houver mensagens nesta sessão, dispara a animação realista
                if (state.messages.length === 0) {
                    playRealisticGreeting();
                }
            } else {
                modal.classList.add('rachi-hidden');
            }
        }

        fabBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleChat();
        });

        closeBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleChat(false);
        });

        // Fechar ao clicar fora da janela do chat (Dispensar ao clicar fora)
        document.addEventListener('pointerdown', (e) => {
            if (!state.isOpen) return;
            // Se o clique foi fora do modal e fora do botão FAB, oculta o chat
            if (!modal.contains(e.target) && !fabBtn.contains(e.target)) {
                toggleChat(false);
            }
        });

        // Fechar ao pressionar a tecla ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && state.isOpen) {
                toggleChat(false);
            }
        });

        function renderWhatsAppCard(customText) {
            const textToEncode = customText || 'Olá! Estive a falar no chat interativo da RACHI e gostaria de falar com um consultor humano.';
            const waUrl = `https://wa.me/${CONFIG.officialWhatsApp}?text=${encodeURIComponent(textToEncode)}`;

            const card = document.createElement('div');
            card.className = 'rachi-whatsapp-card';
            card.innerHTML = `
                <div style="font-weight: 700; font-size: 13px; color: #047857; display: flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Atendimento Humano RACHI no WhatsApp
                </div>
                <div style="font-size: 12px; color: #065F46; margin-top: 3px;">
                    Prefere falar diretamente com a nossa equipa em Luanda?
                </div>
                <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="rachi-whatsapp-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Continuar no WhatsApp (+244 972 888 585)
                </a>
            `;
            messagesEl.appendChild(card);
        }

        // Envio e Processamento de Mensagens com a API de IA (Diálogo 100% Livre)
        async function handleSendMessage(userText) {
            const text = (userText || '').trim();
            if (!text || state.isLoading) return;

            // 1. Adicionar mensagem do utilizador
            state.messages.push({ sender: 'user', text });
            renderMessages();
            input.value = '';

            // Detectar Nome informado no diálogo
            const nameMatch = text.match(/(?:chamo-me|me chamo|meu nome é|aqui é(?: o| a)?|sou o|sou a)\s+([^,!?]+)/i);
            if (nameMatch && nameMatch[1]) {
                const words = nameMatch[1].trim().split(/\s+/);
                const stopWords = new Set(['de','da','do','dos','das','em','na','no','com','e','que','para','gostaria','queria','preciso','estou','sou','tenho','um','uma']);
                const resWords = [];
                for (const w of words) {
                    const cleanWord = w.replace(/[^A-Za-zÀ-ÖØ-öø-ÿ.]/g, '');
                    if (!cleanWord || stopWords.has(cleanWord.toLowerCase().replace(/\./g, ''))) break;
                    resWords.push(cleanWord);
                    if (resWords.length >= 3) break;
                }
                if (resWords.length > 0) {
                    state.leadData.name = resWords.join(' ');
                }
            }

            // Detectar Telefone informado no diálogo
            const phoneMatch = text.match(/(?:\+?244\s*)?(?:9\d{2}[\s.-]?\d{3}[\s.-]?\d{3}|9\d{8})/);
            if (phoneMatch) {
                state.leadData.phone = phoneMatch[0].trim();
            }

            showTyping();

            try {
                // Preparar histórico para a API
                const payloadMessages = state.messages.slice(-8).map(m => ({
                    role: m.sender === 'bot' ? 'assistant' : 'user',
                    content: m.text
                }));

                const response = await fetch(CONFIG.chatApi, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        messages: payloadMessages,
                        leadData: state.leadData
                    })
                });

                hideTyping();

                if (response.ok) {
                    const data = await response.json();
                    const replyText = data.reply || 'Olá! Como posso ajudar a sua empresa hoje?';
                    const isWhatsApp = data.isWhatsAppSuggested || /humano|atendente|whatsapp|ligar/i.test(text);

                    state.messages.push({
                        sender: 'bot',
                        text: replyText,
                        isWhatsAppCard: isWhatsApp,
                        whatsAppText: 'Olá! Estive a conversar no chat do site da RACHI e gostaria de falar com um consultor humano sobre os meus projetos.'
                    });

                    persistState();
                    renderMessages();
                } else {
                    throw new Error('Falha na resposta da API');
                }
            } catch (err) {
                hideTyping();
                // Resposta de fallback elegante e calorosa
                state.messages.push({
                    sender: 'bot',
                    text: 'A **RACHI** é um ecossistema empresarial integrado em Angola, preparado para apoiar o seu negócio com soluções inovadoras e personalizadas.\n\nComo posso apoiar a sua empresa hoje? Sinta-se à vontade para me falar sobre o seu projeto ou necessidade!',
                    isWhatsAppCard: true,
                    whatsAppText: 'Olá! Estive a falar no chat do site da RACHI e gostaria de solicitar informações e proposta.'
                });
                persistState();
                renderMessages();
            }
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSendMessage(input.value);
        });

        // Se já tiver mensagens em sessão, renderiza-as de imediato
        if (state.messages.length > 0) {
            renderMessages();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRachiAIChat);
    } else {
        initRachiAIChat();
    }
})();
