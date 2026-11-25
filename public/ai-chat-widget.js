/**
 * RACHI — Assistente Virtual Inteligente & CRM de Atendimento
 * Adaptado com a Identidade Visual Oficial da RACHI (Azul Royal, Cyan Elétrico e Âmbar Dourado).
 * Abrange as 4 unidades de negócio: RACHI Tec, RACHI Print, RACHI Academy e RACHI Human Capital.
 * Transbordo Humano direto para WhatsApp (+244 972 888 585) e sincronização com o banco CRM.
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

        // Limpar instância antiga se houver
        const oldRoot = document.getElementById('gt-chat-widget-root') || document.getElementById('rachi-chat-widget-root');
        if (oldRoot) oldRoot.remove();
        const oldStyles = document.getElementById('gt-chat-styles') || document.getElementById('rachi-chat-styles');
        if (oldStyles) oldStyles.remove();

        const CONFIG = {
            officialWhatsApp: '244972888585',
            officialDisplayPhone: '+244 972 888 585',
            crmLeadApi: '/api/crm/lead',
            fallbackContactApi: '/contacto',
            storageKey: 'rachi_ai_chat_session_v2',
        };

        // Estado da Conversa Oficial RACHI
        let state = {
            isOpen: false,
            step: 'INIT', // INIT, UNIT_TEC, UNIT_PRINT, UNIT_ACADEMY, UNIT_CAPITAL, PRICE_SELECT, ASK_NAME, ASK_PHONE, COMPLETED, HUMAN_HANDOFF
            leadData: {
                unit: 'Geral',
                service: '',
                objective: '',
                name: '',
                phone: '',
                company: '',
                notes: ''
            },
            messages: [
                { sender: 'bot', text: 'Olá! Seja bem-vindo à **RACHI — Soluções Inteligentes** em Angola.' },
                { sender: 'bot', text: 'Como podemos potenciar a sua empresa hoje? Escolha uma das nossas 4 unidades ou solicite atendimento:' }
            ],
            chips: [
                { label: '💻 RACHI Tec (Tecnologia & TI)', action: 'unit_tec' },
                { label: '🖨️ RACHI Print (Gráfica & Brindes)', action: 'unit_print' },
                { label: '🎓 RACHI Academy (Cursos)', action: 'unit_academy' },
                { label: '👥 RACHI Capital (RH & Gestão)', action: 'unit_capital' },
                { label: '💰 Pedir Cotação / Orçamento', action: 'solicitar_orcamento' },
                { label: '💬 Falar com Atendente Humano', action: 'falar_humano' }
            ]
        };

        // Restaurar sessão
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

        // Estilos CSS Oficiais RACHI (Azul Profundo #071326, Cyan #00a3e0, Royal Blue #0050f0, Âmbar Dourado #eba72d)
        const styleEl = document.createElement('style');
        styleEl.id = 'rachi-chat-styles';
        styleEl.textContent = `
            #rachi-chat-widget-root {
                font-family: 'Montserrat', system-ui, -apple-system, sans-serif !important;
                -webkit-font-smoothing: antialiased;
                z-index: 999999 !important;
                position: relative;
            }

            /* FAB Flutuante RACHI */
            .rachi-chat-fab {
                position: fixed !important;
                bottom: 20px !important;
                right: 20px !important;
                width: 58px !important;
                height: 58px !important;
                border-radius: 9999px !important;
                background: linear-gradient(135deg, #0050f0 0%, #00a3e0 55%, #eba72d 100%) !important;
                box-shadow: 0 8px 24px rgba(0, 80, 240, 0.4), 0 3px 8px rgba(0, 0, 0, 0.25) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                cursor: pointer !important;
                border: 2px solid rgba(255, 255, 255, 0.6) !important;
                transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
                z-index: 999999 !important;
                padding: 0 !important;
                outline: none !important;
            }

            .rachi-chat-fab:hover {
                transform: scale(1.08) translateY(-2px) !important;
                box-shadow: 0 12px 30px rgba(0, 163, 224, 0.55), 0 4px 12px rgba(0, 0, 0, 0.3) !important;
            }

            .rachi-chat-fab:active {
                transform: scale(0.96) !important;
            }

            .rachi-chat-fab svg {
                width: 28px !important;
                height: 28px !important;
                color: #FFFFFF !important;
                transition: transform 0.25s ease !important;
            }

            .rachi-chat-fab-badge {
                position: absolute !important;
                top: 1px !important;
                right: 1px !important;
                width: 14px !important;
                height: 14px !important;
                background-color: #10B981 !important;
                border: 2.5px solid #ffffff !important;
                border-radius: 9999px !important;
                box-shadow: 0 0 6px rgba(16, 185, 129, 0.8) !important;
            }

            /* Janela Modal do Chat RACHI */
            .rachi-chat-window {
                position: fixed !important;
                bottom: 90px !important;
                right: 20px !important;
                width: 380px !important;
                max-width: calc(100vw - 32px) !important;
                height: 570px !important;
                max-height: calc(100vh - 120px) !important;
                background: #FFFFFF !important;
                border-radius: 20px !important;
                box-shadow: 0 20px 50px rgba(7, 19, 38, 0.35), 0 0 0 1px rgba(0, 80, 240, 0.12) !important;
                display: flex !important;
                flex-direction: column !important;
                overflow: hidden !important;
                z-index: 999998 !important;
                transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.25s !important;
                transform-origin: bottom right !important;
            }

            html.dark .rachi-chat-window {
                background: #071326 !important;
                box-shadow: 0 20px 55px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(0, 163, 224, 0.25) !important;
            }

            .rachi-chat-window.rachi-hidden {
                opacity: 0 !important;
                visibility: hidden !important;
                transform: scale(0.85) translateY(20px) !important;
                pointer-events: none !important;
            }

            /* Header RACHI */
            .rachi-chat-header {
                background: linear-gradient(135deg, #071326 0%, #0c203f 100%) !important;
                padding: 14px 18px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            }

            .rachi-chat-header-brand {
                display: flex !important;
                align-items: center !important;
                gap: 12px !important;
            }

            .rachi-chat-logo-ring {
                width: 38px !important;
                height: 38px !important;
                border-radius: 12px !important;
                background: rgba(255, 255, 255, 0.08) !important;
                border: 1px solid rgba(0, 163, 224, 0.5) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3) !important;
                padding: 4px !important;
            }

            .rachi-chat-header-info h4 {
                margin: 0 !important;
                font-size: 15px !important;
                font-weight: 800 !important;
                color: #FFFFFF !important;
                letter-spacing: 0.5px !important;
                line-height: 1.2 !important;
            }

            .rachi-chat-header-info .rachi-subtitle {
                display: block !important;
                font-size: 10px !important;
                font-weight: 700 !important;
                color: #eba72d !important;
                letter-spacing: 0.8px !important;
                text-transform: uppercase !important;
            }

            .rachi-chat-status {
                display: flex !important;
                align-items: center !important;
                gap: 5px !important;
                margin-top: 3px !important;
                font-size: 11px !important;
                font-weight: 600 !important;
                color: #94A3B8 !important;
            }

            .rachi-chat-dot {
                width: 7px !important;
                height: 7px !important;
                border-radius: 9999px !important;
                background-color: #10B981 !important;
                box-shadow: 0 0 8px #10B981 !important;
            }

            .rachi-chat-close-btn {
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

            .rachi-chat-close-btn:hover {
                background: rgba(255, 255, 255, 0.2) !important;
            }

            /* Corpo das Mensagens */
            .rachi-chat-body {
                flex: 1 !important;
                padding: 16px !important;
                overflow-y: auto !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 10px !important;
                background: #F8FAFC !important;
                scroll-behavior: smooth !important;
            }

            html.dark .rachi-chat-body {
                background: #0B1628 !important;
            }

            .rachi-chat-body::-webkit-scrollbar {
                width: 5px !important;
            }
            .rachi-chat-body::-webkit-scrollbar-thumb {
                background: rgba(0, 80, 240, 0.2) !important;
                border-radius: 9999px !important;
            }
            html.dark .rachi-chat-body::-webkit-scrollbar-thumb {
                background: rgba(0, 163, 224, 0.3) !important;
            }

            .rachi-chat-bubble {
                max-width: 86% !important;
                padding: 11px 15px !important;
                font-size: 13.5px !important;
                line-height: 1.48 !important;
                word-break: break-word !important;
                animation: rachiFadeIn 0.25s ease !important;
            }

            .rachi-chat-bubble.rachi-bot {
                align-self: flex-start !important;
                background: #FFFFFF !important;
                color: #0F172A !important;
                border-radius: 16px 16px 16px 4px !important;
                box-shadow: 0 2px 8px rgba(7, 19, 38, 0.06), 0 0 0 1px rgba(0, 80, 240, 0.08) !important;
                font-weight: 500 !important;
            }

            html.dark .rachi-chat-bubble.rachi-bot {
                background: #0f1d35 !important;
                color: #F1F5F9 !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.08) !important;
            }

            .rachi-chat-bubble.rachi-user {
                align-self: flex-end !important;
                background: linear-gradient(135deg, #0050f0 0%, #00a3e0 100%) !important;
                color: #FFFFFF !important;
                border-radius: 16px 16px 4px 16px !important;
                font-weight: 600 !important;
                box-shadow: 0 3px 12px rgba(0, 80, 240, 0.35) !important;
            }

            /* Chips / Opções da RACHI */
            .rachi-chat-chips-container {
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 7px !important;
                margin-top: 6px !important;
                margin-bottom: 4px !important;
                animation: rachiFadeIn 0.3s ease !important;
            }

            .rachi-chat-chip {
                background: #FFFFFF !important;
                border: 1.5px solid #00a3e0 !important;
                color: #0050f0 !important;
                padding: 7px 14px !important;
                border-radius: 9999px !important;
                font-size: 12.5px !important;
                font-weight: 600 !important;
                cursor: pointer !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                box-shadow: 0 2px 6px rgba(0, 163, 224, 0.12) !important;
                outline: none !important;
                text-align: left !important;
            }

            html.dark .rachi-chat-chip {
                background: #0d1e38 !important;
                color: #38bdf8 !important;
                border-color: #0284c7 !important;
            }

            .rachi-chat-chip:hover {
                background: #0050f0 !important;
                border-color: #0050f0 !important;
                color: #FFFFFF !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 4px 12px rgba(0, 80, 240, 0.35) !important;
            }

            .rachi-chat-chip.rachi-chip-gold {
                border-color: #eba72d !important;
                color: #b45309 !important;
            }
            html.dark .rachi-chat-chip.rachi-chip-gold {
                color: #fbbf24 !important;
                border-color: #eba72d !important;
            }
            .rachi-chat-chip.rachi-chip-gold:hover {
                background: #eba72d !important;
                border-color: #eba72d !important;
                color: #0B0B0B !important;
            }

            .rachi-chat-chip.rachi-chip-human {
                border-color: #10B981 !important;
                color: #059669 !important;
                background: #F0FDF4 !important;
            }
            html.dark .rachi-chat-chip.rachi-chip-human {
                background: rgba(16, 185, 129, 0.12) !important;
                color: #34D399 !important;
            }
            .rachi-chat-chip.rachi-chip-human:hover {
                background: #10B981 !important;
                color: #FFFFFF !important;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4) !important;
            }

            /* WhatsApp Card */
            .rachi-whatsapp-card {
                background: #F0FDF4 !important;
                border: 1.5px solid #10B981 !important;
                border-radius: 14px !important;
                padding: 12px 14px !important;
                margin-top: 6px !important;
                box-shadow: 0 4px 14px rgba(16, 185, 129, 0.15) !important;
                animation: rachiFadeIn 0.3s ease !important;
            }

            html.dark .rachi-whatsapp-card {
                background: #062017 !important;
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

            /* Input Inferior */
            .rachi-chat-footer {
                padding: 10px 14px 14px 14px !important;
                background: #FFFFFF !important;
                border-top: 1px solid rgba(0, 80, 240, 0.1) !important;
                display: flex !important;
                align-items: center !important;
                gap: 10px !important;
            }

            html.dark .rachi-chat-footer {
                background: #071326 !important;
                border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            }

            .rachi-chat-input-pill {
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

            html.dark .rachi-chat-input-pill {
                background: #0f1d35 !important;
                border-color: rgba(255, 255, 255, 0.15) !important;
                color: #FFFFFF !important;
            }

            .rachi-chat-input-pill:focus {
                border-color: #00a3e0 !important;
                box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.25) !important;
                background: #FFFFFF !important;
            }

            html.dark .rachi-chat-input-pill:focus {
                background: #132442 !important;
            }

            .rachi-chat-send-btn {
                width: 42px !important;
                height: 42px !important;
                border-radius: 9999px !important;
                background: linear-gradient(135deg, #0050f0 0%, #00a3e0 100%) !important;
                color: #FFFFFF !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                border: none !important;
                cursor: pointer !important;
                transition: all 0.2s ease !important;
                box-shadow: 0 3px 10px rgba(0, 80, 240, 0.35) !important;
                outline: none !important;
                padding: 0 !important;
                flex-shrink: 0 !important;
            }

            .rachi-chat-send-btn:hover {
                background: linear-gradient(135deg, #003db3 0%, #0088ba 100%) !important;
                transform: scale(1.05) !important;
            }

            .rachi-chat-send-btn:active {
                transform: scale(0.95) !important;
            }

            .rachi-chat-send-btn svg {
                width: 19px !important;
                height: 19px !important;
                stroke-width: 2.8 !important;
            }

            /* Indicador de Digitação */
            .rachi-typing-indicator {
                display: flex !important;
                align-items: center !important;
                gap: 4px !important;
                padding: 8px 12px !important;
                background: #FFFFFF !important;
                border-radius: 14px !important;
                width: fit-content !important;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05) !important;
            }
            html.dark .rachi-typing-indicator {
                background: #0f1d35 !important;
            }
            .rachi-typing-dot {
                width: 6px !important;
                height: 6px !important;
                border-radius: 9999px !important;
                background: #00a3e0 !important;
                animation: rachiBounce 1.2s infinite ease-in-out !important;
            }
            .rachi-typing-dot:nth-child(2) { animation-delay: 0.2s !important; }
            .rachi-typing-dot:nth-child(3) { animation-delay: 0.4s !important; }

            @keyframes rachiBounce {
                0%, 60%, 100% { transform: translateY(0); }
                30% { transform: translateY(-5px); }
            }

            @keyframes rachiFadeIn {
                from { opacity: 0; transform: translateY(6px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Ajustes Mobile e Dock */
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

        // Criar Elementos no DOM
        const root = document.createElement('div');
        root.id = 'rachi-chat-widget-root';
        root.innerHTML = `
            <!-- Floating FAB RACHI -->
            <button type="button" id="rachi-chat-fab-btn" class="rachi-chat-fab" aria-label="Abrir Chat de Atendimento RACHI" title="Falar com Assistente Virtual RACHI">
                <div class="rachi-chat-fab-badge"></div>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                </svg>
            </button>

            <!-- Chat Modal Window RACHI -->
            <div id="rachi-chat-modal" class="rachi-chat-window rachi-hidden" role="dialog" aria-modal="true" aria-label="Chat de Atendimento RACHI">
                <!-- Header -->
                <div class="rachi-chat-header">
                    <div class="rachi-chat-header-brand">
                        <div class="rachi-chat-logo-ring">
                            ${rachiSymbolSvg}
                        </div>
                        <div class="rachi-chat-header-info">
                            <h4>RACHI</h4>
                            <span class="rachi-subtitle">Soluções Inteligentes</span>
                            <div class="rachi-chat-status">
                                <span class="rachi-chat-dot"></span>
                                <span>Atendimento Online</span>
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

                <!-- Footer Input -->
                <form id="rachi-chat-form" class="rachi-chat-footer">
                    <input type="text" id="rachi-chat-input" class="rachi-chat-input-pill" placeholder="Digite sua mensagem ou escolha uma opção..." autocomplete="off" />
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
        const messagesEl = document.getElementById('rachi-chat-messages');
        const form = document.getElementById('rachi-chat-form');
        const input = document.getElementById('rachi-chat-input');

        function toggleChat(forceState) {
            state.isOpen = typeof forceState === 'boolean' ? forceState : !state.isOpen;
            if (state.isOpen) {
                modal.classList.remove('rachi-hidden');
                setTimeout(() => {
                    input.focus();
                    scrollToBottom();
                }, 100);
            } else {
                modal.classList.add('rachi-hidden');
            }
        }

        fabBtn.addEventListener('click', () => toggleChat());
        closeBtn.addEventListener('click', () => toggleChat(false));

        function scrollToBottom() {
            setTimeout(() => {
                messagesEl.scrollTop = messagesEl.scrollHeight;
            }, 50);
        }

        function renderMessages() {
            messagesEl.innerHTML = '';
            state.messages.forEach(msg => {
                const bubble = document.createElement('div');
                bubble.className = `rachi-chat-bubble ${msg.sender === 'bot' ? 'rachi-bot' : 'rachi-user'}`;
                bubble.innerHTML = msg.text.replace(/\n/g, '<br>');
                messagesEl.appendChild(bubble);

                if (msg.isWhatsAppCard) {
                    renderWhatsAppCard(msg.whatsAppText);
                }
            });

            if (state.chips && state.chips.length > 0) {
                const chipsContainer = document.createElement('div');
                chipsContainer.className = 'rachi-chat-chips-container';
                state.chips.forEach(chip => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    let chipClass = 'rachi-chat-chip';
                    if (chip.action === 'falar_humano') chipClass += ' rachi-chip-human';
                    else if (chip.action === 'solicitar_orcamento') chipClass += ' rachi-chip-gold';
                    btn.className = chipClass;
                    btn.textContent = chip.label;
                    btn.addEventListener('click', () => handleChipClick(chip));
                    chipsContainer.appendChild(btn);
                });
                messagesEl.appendChild(chipsContainer);
            }

            scrollToBottom();
        }

        function renderWhatsAppCard(customText) {
            const textToEncode = customText || `Olá! Estive a falar no chat do site da RACHI e gostaria de falar com um consultor humano.`;
            const waUrl = `https://wa.me/${CONFIG.officialWhatsApp}?text=${encodeURIComponent(textToEncode)}`;

            const card = document.createElement('div');
            card.className = 'rachi-whatsapp-card';
            card.innerHTML = `
                <div style="font-weight: 700; font-size: 13px; color: #047857; display: flex; align-items: center; gap: 6px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    Atendimento Humano RACHI no WhatsApp
                </div>
                <div style="font-size: 12px; color: #065F46; margin-top: 3px;">
                    Fale agora com um dos nossos consultores executivos em Luanda:
                </div>
                <a href="${waUrl}" target="_blank" rel="noopener noreferrer" class="rachi-whatsapp-btn">
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
            ind.id = 'rachi-typing-node';
            ind.className = 'rachi-typing-indicator';
            ind.innerHTML = `
                <div class="rachi-typing-dot"></div>
                <div class="rachi-typing-dot"></div>
                <div class="rachi-typing-dot"></div>
            `;
            messagesEl.appendChild(ind);
            scrollToBottom();
        }

        function hideTyping() {
            const ind = document.getElementById('rachi-typing-node');
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
                name: state.leadData.name || 'Visitante Chat RACHI',
                phone: state.leadData.phone || 'Não informado',
                company: state.leadData.company || '',
                subject: `[Lead CRM RACHI] ${state.leadData.unit}: ${state.leadData.service || 'Interesse Comercial'}`,
                message: `Lead gerado pelo Chat Virtual da RACHI:
- Unidade: ${state.leadData.unit}
- Serviço de Interesse: ${state.leadData.service}
- Objetivo / Detalhe: ${state.leadData.objective || 'N/A'}
- Nome: ${state.leadData.name}
- Telefone / WhatsApp: ${state.leadData.phone}
- Empresa: ${state.leadData.company || 'N/A'}
- Notas: ${state.leadData.notes || 'Registado pelo fluxo automatizado da RACHI'}
Data/Hora: ${new Date().toLocaleString('pt-PT')}`
            };

            try {
                const resp = await fetch(CONFIG.crmLeadApi, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify(payload)
                });
                if (!resp.ok) {
                    await fetch(CONFIG.fallbackContactApi, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                        body: JSON.stringify(payload)
                    });
                }
            } catch (err) {
                console.warn('[RACHI CRM Chat] Falha ao enviar lead:', err);
            }
        }

        // Transbordo Humano
        function triggerHumanHandoff(contextReason) {
            state.step = 'HUMAN_HANDOFF';
            const visitorName = state.leadData.name ? `, ${state.leadData.name}` : '';
            const unitMention = state.leadData.unit && state.leadData.unit !== 'Geral' ? ` da *${state.leadData.unit}*` : '';
            const serviceMention = state.leadData.service ? ` sobre *${state.leadData.service}*` : '';
            const waMsg = `Olá! Estive a falar no chat do site da RACHI e gostaria de falar com um consultor humano${unitMention}${serviceMention}. ${state.leadData.name ? '(Meu nome: ' + state.leadData.name + ')' : ''}`;

            addBotMessage(
                `Com certeza${visitorName}! Estou a transferir a sua solicitação para a nossa equipa de consultores especializados da RACHI no WhatsApp (+244 972 888 585). 💬\n\nClique no botão verde abaixo para iniciar a conversa:`,
                [
                    { label: 'Voltar ao Menu Principal', action: 'reset_flow' }
                ],
                true,
                waMsg
            );

            if (state.leadData.name || state.leadData.phone) {
                state.leadData.notes += ' [Transferido para atendimento humano no WhatsApp]';
                syncLeadToCrm();
            }
        }

        // Gerenciamento de Opções Rápidas por Unidade RACHI
        function handleChipClick(chip) {
            addUserMessage(chip.label);

            switch (chip.action) {
                case 'unit_tec':
                    state.leadData.unit = 'RACHI Tec';
                    state.step = 'UNIT_TEC';
                    addBotMessage(
                        'A **RACHI Tec** é o nosso braço de Tecnologia & Inovação. Oferecemos hardware corporativo, criação de websites de alta conversão, lojas virtuais, sistemas de faturação certificados pela AGT e suporte de TI.\n\nQual destas soluções procura?',
                        [
                            { label: 'Criação de Website / Landing Page', action: 'tec_website' },
                            { label: 'Loja Virtual / E-commerce', action: 'tec_loja' },
                            { label: 'Hardware & Equipamentos de TI', action: 'tec_hardware' },
                            { label: 'Suporte Técnico & Manutenção TI', action: 'tec_suporte' },
                            { label: 'Falar com Consultor Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                case 'unit_print':
                    state.leadData.unit = 'RACHI Print';
                    state.step = 'UNIT_PRINT';
                    addBotMessage(
                        'A **RACHI Print** é especialista em comunicação visual, gráfica rápida e brindes corporativos de alto padrão. Cuidamos desde cartões de visita e banners até fardamentos e brindes personalizados para eventos.\n\nO que deseja orçar?',
                        [
                            { label: 'Brindes Corporativos & Eventos', action: 'print_brindes' },
                            { label: 'Cartões, Flyers & Folhetos', action: 'print_papelaria' },
                            { label: 'Banners & Grandes Formatos', action: 'print_banners' },
                            { label: 'Criação de Logótipo & Marca', action: 'print_branding' },
                            { label: 'Falar com Consultor Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                case 'unit_academy':
                    state.leadData.unit = 'RACHI Academy';
                    state.step = 'UNIT_ACADEMY';
                    addBotMessage(
                        'A **RACHI Academy** desenvolve competências estratégicas através de formações executivas práticas nas áreas de Tecnologia, Gestão Empresarial, Finanças e Atendimento ao Cliente, com certificação.\n\nQual é a sua necessidade formativa?',
                        [
                            { label: 'Treinamento Corporativo (In-Company)', action: 'academy_empresa' },
                            { label: 'Cursos de TI & Redes', action: 'academy_ti' },
                            { label: 'Gestão, Finanças & Liderança', action: 'academy_gestao' },
                            { label: 'Consultar Calendário de Turmas', action: 'academy_calendario' },
                            { label: 'Falar com Atendente Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                case 'unit_capital':
                    state.leadData.unit = 'RACHI Human Capital';
                    state.step = 'UNIT_CAPITAL';
                    addBotMessage(
                        'A **RACHI Human Capital** oferece soluções completas de consultoria em RH: recrutamento e selecção de talentos, cedência temporária de trabalhadores, organização de contabilidade, legalização de empresas e regularização no INSS.\n\nEm que área necessita de assessoria?',
                        [
                            { label: 'Recrutamento & Selecção de Pessoal', action: 'capital_recrutamento' },
                            { label: 'Cedência Temporária de Colaboradores', action: 'capital_cedencia' },
                            { label: 'Constituição & Legalização de Empresa', action: 'capital_legalizacao' },
                            { label: 'Contabilidade & Regularização INSS', action: 'capital_contabilidade' },
                            { label: 'Falar com Consultor Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                case 'solicitar_orcamento':
                    state.step = 'PRICE_SELECT';
                    addBotMessage(
                        'Perfeito! Na RACHI estruturamos propostas transparentes e sob medida para a realidade do seu negócio.\n\nPara qual das nossas áreas gostaria de receber cotação?',
                        [
                            { label: 'Tecnologia / Sites / TI', action: 'unit_tec' },
                            { label: 'Produção Gráfica / Brindes', action: 'unit_print' },
                            { label: 'Cursos / Formação', action: 'unit_academy' },
                            { label: 'RH / Contabilidade / Legalização', action: 'unit_capital' },
                            { label: 'Falar com Atendente Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                case 'falar_humano':
                    triggerHumanHandoff('Opção falar com humano');
                    break;

                case 'reset_flow':
                    state.step = 'INIT';
                    addBotMessage(
                        'Como podemos potenciar a sua organização hoje? Escolha uma das opções abaixo:',
                        [
                            { label: '💻 RACHI Tec (Tecnologia & TI)', action: 'unit_tec' },
                            { label: '🖨️ RACHI Print (Gráfica & Brindes)', action: 'unit_print' },
                            { label: '🎓 RACHI Academy (Cursos)', action: 'unit_academy' },
                            { label: '👥 RACHI Capital (RH & Gestão)', action: 'unit_capital' },
                            { label: '💬 Falar com Atendente Humano', action: 'falar_humano' }
                        ]
                    );
                    break;

                // Captura do Serviço Específico
                case 'tec_website':
                case 'tec_loja':
                case 'tec_hardware':
                case 'tec_suporte':
                case 'print_brindes':
                case 'print_papelaria':
                case 'print_banners':
                case 'print_branding':
                case 'academy_empresa':
                case 'academy_ti':
                case 'academy_gestao':
                case 'academy_calendario':
                case 'capital_recrutamento':
                case 'capital_cedencia':
                case 'capital_legalizacao':
                case 'capital_contabilidade':
                    state.leadData.service = chip.label;
                    state.step = 'ASK_NAME';
                    addBotMessage(
                        `Excelente escolha! Para que a equipa da **${state.leadData.unit}** prepare a proposta detalhada, por favor, **qual é o seu nome** (ou da sua empresa)?`
                    );
                    break;

                default:
                    state.step = 'ASK_NAME';
                    addBotMessage('Entendido! Por favor, informe o seu nome para prosseguirmos:');
                    break;
            }
        }

        // Processar Mensagens Livres
        function handleUserInput(userText) {
            const text = userText.trim();
            if (!text) return;

            addUserMessage(text);
            input.value = '';

            const lower = text.toLowerCase();

            // 1. Transbordo Humano
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

            // 2. Fluxo de Captura de Lead (CRM)
            if (state.step === 'ASK_NAME') {
                state.leadData.name = text;
                state.step = 'ASK_PHONE';
                addBotMessage(
                    `Muito obrigado, **${text}**! 👍\n\nPor favor, informe o seu número de **WhatsApp ou Telefone** (ex: 972 888 585) para enviarmos o resumo e a cotação formal:`
                );
                return;
            }

            if (state.step === 'ASK_PHONE') {
                const cleanDigits = text.replace(/\D/g, '');
                if (cleanDigits.length < 8) {
                    addBotMessage(
                        'Por favor, indique um contacto telefónico ou WhatsApp válido (com pelo menos 9 dígitos) para que possamos enviar a proposta da RACHI:'
                    );
                    return;
                }

                state.leadData.phone = text;
                state.step = 'COMPLETED';

                // Sincronizar com o banco D1 / CRM
                syncLeadToCrm();

                const waMsg = `Olá! Meu nome é ${state.leadData.name}. Deixei meu contacto (${state.leadData.phone}) no chat da RACHI referente a: ${state.leadData.unit} - ${state.leadData.service || 'Soluções Integradas'}.`;

                addBotMessage(
                    `Perfeito, **${state.leadData.name}**! 🎉\n\nOs seus dados foram registados no nosso **sistema CRM da RACHI**. A equipa responsável pela **${state.leadData.unit}** já foi notificada e entrará em contacto muito brevemente.\n\nSe preferir atendimento imediato, clique no botão abaixo para falar no WhatsApp:`,
                    [
                        { label: 'Falar no WhatsApp Agora', action: 'falar_humano' },
                        { label: 'Consultar outro serviço', action: 'reset_flow' }
                    ],
                    true,
                    waMsg
                );
                return;
            }

            // 3. IA de Resposta Contextual para RACHI
            if (lower.includes('site') || lower.includes('software') || lower.includes('ti') || lower.includes('computador') || lower.includes('tec') || lower.includes('hardware')) {
                state.leadData.unit = 'RACHI Tec';
                state.leadData.service = 'Tecnologia & TI';
                state.step = 'ASK_NAME';
                addBotMessage(
                    'A **RACHI Tec** desenvolve websites de alto desempenho, lojas virtuais, sistemas de gestão e fornece equipamentos e manutenção de TI.\n\nPara lhe enviarmos um orçamento sob medida, **qual é o seu nome**?'
                );
                return;
            }

            if (lower.includes('grafica') || lower.includes('gráfica') || lower.includes('brinde') || lower.includes('banner') || lower.includes('cartão') || lower.includes('print')) {
                state.leadData.unit = 'RACHI Print';
                state.leadData.service = 'Produção Gráfica';
                state.step = 'ASK_NAME';
                addBotMessage(
                    'A **RACHI Print** produz materiais gráficos de excelência, brindes corporativos, lonas, roll-ups e identidade visual completa.\n\nQual é o seu nome para prepararmos uma estimativa de produção?'
                );
                return;
            }

            if (lower.includes('curso') || lower.includes('formação') || lower.includes('formacao') || lower.includes('academy') || lower.includes('aula') || lower.includes('aluno')) {
                state.leadData.unit = 'RACHI Academy';
                state.leadData.service = 'Cursos Executivos';
                state.step = 'ASK_NAME';
                addBotMessage(
                    'A **RACHI Academy** oferece formações corporativas e cursos certificados em Gestão, Finanças, Redes e Tecnologia.\n\nQual é o seu nome e qual o curso do seu interesse?'
                );
                return;
            }

            if (lower.includes('rh') || lower.includes('recrutamento') || lower.includes('contabilidade') || lower.includes('inss') || lower.includes('empresa') || lower.includes('capital')) {
                state.leadData.unit = 'RACHI Human Capital';
                state.leadData.service = 'Gestão de Pessoas & Consultoria';
                state.step = 'ASK_NAME';
                addBotMessage(
                    'A **RACHI Human Capital** apoia a sua empresa em recrutamento especializado, cedência temporária, contabilidade organizada e regularização legal/INSS.\n\nQual é o seu nome para direcionarmos ao nosso consultor?'
                );
                return;
            }

            if (lower.includes('preço') || lower.includes('preco') || lower.includes('custa') || lower.includes('orçamento') || lower.includes('orcamento') || lower.includes('valor')) {
                state.step = 'PRICE_SELECT';
                addBotMessage(
                    'A RACHI oferece soluções personalizadas para micro, pequenas e grandes empresas em Angola. Desenvolvemos propostas transparentes com excelente custo-benefício.\n\nPara qual das nossas áreas procura cotação?',
                    [
                        { label: '💻 RACHI Tec (Tecnologia)', action: 'unit_tec' },
                        { label: '🖨️ RACHI Print (Gráfica)', action: 'unit_print' },
                        { label: '🎓 RACHI Academy (Cursos)', action: 'unit_academy' },
                        { label: '👥 RACHI Capital (RH & Contabilidade)', action: 'unit_capital' },
                        { label: '💬 Falar com Atendente Humano', action: 'falar_humano' }
                    ]
                );
                return;
            }

            // Resposta Padrão RACHI
            state.leadData.notes = (state.leadData.notes ? state.leadData.notes + ' | ' : '') + text;
            state.step = 'ASK_NAME';
            addBotMessage(
                'Entendi perfeitamente! Para que os consultores da RACHI possam analisar a sua solicitação com todo o rigor, **qual é o seu nome**?',
                [
                    { label: 'Falar com Atendente Humano', action: 'falar_humano' }
                ]
            );
        }

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            handleUserInput(input.value);
        });

        renderMessages();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRachiAIChat);
    } else {
        initRachiAIChat();
    }
})();
