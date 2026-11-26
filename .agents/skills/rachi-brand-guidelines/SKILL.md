---
name: rachi-brand-guidelines
description: >-
  MANDATORY skill for creating ANY visual, digital, frontend, UI, design, marketing, or code asset for RACHI.
  Enforces official brand identity tokens (Azul RACHI #0050f0, Ciano #00a3e0, Âmbar/Gold #f5a800, Navy #071326),
  Outfit and Plus Jakarta Sans typography, and prohibits disparate rainbow/purple/rose color scatter.
---

# RACHI • Manual Oficial de Identidade Visual e Design System

Este documento estabelece as diretrizes e regras técnicas obrigatórias de design para **toda e qualquer criação, alteração ou código visual** no projeto **RACHI** (websites, landing pages, painéis administrativos, portais de clientes, widgets de chat, formulários, e-mails, modais e peças de marketing).

---

## 1. Princípio da Marca: Clareza Corporativa & Tecnologia Nobre

A **RACHI** é uma empresa de vanguarda tecnológica e soluções corporativas em Angola, com atuação integrada em:
- **Soluções Digitais & Software** (ERP, CRM, E-commerce, Sistemas de Gestão e IA).
- **Consultoria e Transformação Digital**.
- **Comunicação Omnichannel** (Live Chat, WhatsApp Business, Portal do Cliente).

**Tom de Voz Visual**: Executivo, sofisticado, confiável, tecnológico e de alto impacto comercial. 
**Regra Fundamental**: A interface deve inspirar credibilidade de nível bancário e elegância tecnológica, **jamais parecendo um brinquedo colorido ou uma colcha de retalhos de cores aleatórias**.

---

## 2. Tokens Oficiais de Cores (Design Tokens)

Sempre utilize rigorosamente os valores hexadecimais da marca:

| Token | Nome Técnico | HEX | RGB | Papel no Design System |
| :--- | :--- | :--- | :--- | :--- |
| `rachiBlue` | **Azul Elétrico RACHI** | `#0050f0` | `0, 80, 240` | **Cor Primária da Marca**: Botões de ação principais (CTAs), seleções ativas, barras laterais de foco, ícones principais e links institucionais. |
| `rachiBlueHover` | **Azul RACHI Escuro** | `#0040d0` | `0, 64, 208` | Estado `:hover` e `:active` de botões principais. |
| `rachiCyan` | **Ciano Vibrante RACHI** | `#00a3e0` | `0, 163, 224` | **Acento de Luz**: Gradientes luminosos com #0050f0, micro-pontos pulsantes, detalhes em dark mode (`#38bdf8`). |
| `rachiGold` | **Âmbar/Gold Institucional** | `#f5a800` | `245, 168, 0` | **Acento de Atenção & Transbordo**: Badges de transbordo pendente, alertas de sistema, itens de alta prioridade. |
| `rachiNavy` | **Navy Profundo RACHI** | `#071326` | `7, 19, 38` | **Fundo Nobre (Dark)**: Sidebar, cabeçalhos escuros, fundos de tela dark mode e avatares executivos. |
| `rachiDarkCard` | **Superfície Dark Card** | `#0c1527` | `12, 21, 39` | Cartões, janelas ativas de chat, tabelas e modais no tema escuro. |
| `rachiLightBg` | **Fundo Claro (Light Mode)** | `#f4f6fb` | `244, 246, 251` | Fundo principal da aplicação em modo claro (arejado e limpo). |
| `rachiLightCard`| **Superfície Light Card**| `#ffffff` | `255, 255, 255` | Cartões, caixas de diálogo e painéis no tema claro. |
| `whatsappGreen` | **Verde WhatsApp Oficial** | `#25D366` | `37, 211, 102` | **Canal Externo**: Exclusivo para botões e links diretos do WhatsApp. |

### Snippet CSS (:root)
```css
:root {
  --rachi-blue: #0050f0;
  --rachi-blue-hover: #0040d0;
  --rachi-cyan: #00a3e0;
  --rachi-gold: #f5a800;
  --rachi-navy: #071326;
  --rachi-dark-card: #0c1527;
  --rachi-light-bg: #f4f6fb;
  --rachi-light-card: #ffffff;
  --rachi-border-light: #e2e8f0;
  --rachi-border-dark: rgba(0, 80, 240, 0.16);
  --font-heading: 'Outfit', sans-serif;
  --font-body: 'Plus Jakarta Sans', sans-serif;
}
```

### Configuração Tailwind CSS
```javascript
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
        heading: ['"Outfit"', '"Plus Jakarta Sans"', 'sans-serif']
      },
      colors: {
        rachiBlue: '#0050f0',
        rachiCyan: '#00a3e0',
        rachiGold: '#f5a800',
        rachiNavy: '#071326'
      }
    }
  }
}
```

---

## 3. Tipografia Oficial

A RACHI utiliza uma combinação tipográfica de alto impacto:

1. **`Outfit`** (Fonte de Destaque e Títulos):
   - Uso: Títulos principais de seções (`h1`, `h2`, `h3`), valores monetários em Kz, KPIs, logotipos e contadores.
   - Pesos: `font-bold` (700), `font-extrabold` (800) e `font-black` (900).
   - Estilo: `style="font-family:Outfit"` ou `font-heading`.

2. **`Plus Jakarta Sans`** (Fonte de Leitura e Interface):
   - Uso: Corpo de texto, parágrafos, tabelas, botões, formulários, inputs e menus de navegação.
   - Pesos: `font-normal` (400), `font-medium` (500), `font-semibold` (600) e `font-bold` (700).

---

## 4. O Que NUNCA Fazer (Anti-Padrões de Marca)

- ❌ **Proibido usar tons de roxo ou púrpura** (`#7c3aed`, `#9333ea`, `#8b5cf6`, `bg-purple-600`, etc.). A RACHI **não** tem identidade roxa.
- ❌ **Proibido usar tons de rosa ou magenta** (`bg-rose-600`, `bg-pink-500`) como cor decorativa ou em botões principais.
- ❌ **Proibido dispersar cores em "arco-íris"** (por exemplo, fazer cada botão ou card de uma cor diferente: um verde pastel, um azul céu, um rosa, um laranja, etc.).
- ❌ **Proibido usar azuis desbotados ou genéricos** (`bg-indigo-600`, `bg-violet-600`, `bg-sky-400`); use sempre o **Azul RACHI `#0050f0`** ou **Ciano `#00a3e0`**.
- ❌ **Proibido usar bordas pretas brutas**; use sempre bordas sutis com opacidade (`border-slate-200/80` no tema claro e `border-white/10` ou `rgba(0,80,240,0.16)` no escuro).

---

## 5. Padrões de Componentes da Interface (UI Patterns)

### 5.1 Botões de Ação
- **Ação Primária (CTA)**:
  `bg-[#0050f0] hover:bg-[#0040d0] text-white font-bold rounded-xl shadow-xs transition px-4 py-2.5 text-xs flex items-center gap-2 cursor-pointer`
- **Ação Secundária (Neutro Profissional)**:
  `bg-slate-100 hover:bg-slate-200/80 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-white/10 rounded-xl px-3 py-2 text-xs font-semibold transition cursor-pointer`
- **Ação de Alerta / Transbordo Humano**:
  `bg-[#f5a800] hover:bg-[#df8b13] text-slate-950 font-bold rounded-xl shadow-xs transition px-3.5 py-1.5 text-xs flex items-center gap-1.5 cursor-pointer`
- **Ação de Integração WhatsApp**:
  `bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold rounded-xl shadow-xs transition px-3.5 py-2 text-xs flex items-center gap-1.5 cursor-pointer`

### 5.2 Badges e Indicadores de Status (Pills)
- **Status Ativo / Omnichannel RACHI**:
  `bg-[#0050f0]/10 text-[#0050f0] dark:text-[#38bdf8] border border-[#0050f0]/20 rounded-full px-2.5 py-0.5 text-[11px] font-bold inline-flex items-center gap-1.5`
- **Status Transbordo Pendente**:
  `bg-[#f5a800]/10 text-[#d97706] dark:text-[#fbbf24] border border-[#f5a800]/30 rounded-full px-2.5 py-0.5 text-[11px] font-bold inline-flex items-center gap-1.5 animate-pulse`
- **Status WhatsApp**:
  `bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20 rounded-full px-2 py-0.5 text-[10px] font-bold`
- **Status Neutro / IA Conversando**:
  `bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-white/10 rounded-full px-2 py-0.5 text-[10px] font-semibold`

### 5.3 Itens Ativos em Listas e Menus
Quando um card, item de lista ou menu estiver selecionado/ativo:
```html
:class="isActive ? 'bg-blue-50/70 dark:bg-[#0050f0]/10 border-l-4 border-l-[#0050f0] shadow-xs' : 'hover:bg-slate-50 dark:hover:bg-white/[0.03] border-l-4 border-transparent'"
```

### 5.4 Balões de Mensagem no Chat e Messenger
- **Assistente Virtual IA (RACHI Assist)**:
  `rounded-2xl rounded-bl-xs bg-white dark:bg-[#0c1527] border border-blue-100 dark:border-blue-900/40 p-3.5 shadow-xs text-xs text-slate-800 dark:text-slate-100 leading-relaxed`
  Cabeçalho: `text-[#0050f0] dark:text-[#38bdf8] font-bold text-[9.5px] uppercase tracking-wider`
- **Consultor Humano Executivo (Casimiro Gundja)**:
  `rounded-2xl rounded-br-xs bg-gradient-to-r from-[#0050f0] to-[#003cb8] text-white p-3.5 shadow-xs text-xs leading-relaxed`
- **Cliente**:
  `rounded-2xl rounded-bl-xs bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 p-3.5 shadow-xs text-xs text-slate-800 dark:text-slate-100`

---

## 6. Procedimento Mandatório de Engenharia para o Painel Admin

Ao alterar qualquer interface ou tela administrativa:
1. Aplique a modificação em **ambos os arquivos**:
   - `public/pages/admin-dashboard.html`
   - `resources/views/admin/dashboard.blade.php`
2. Valide o balanceamento exato de tags HTML (`<section>`, `<div>`).
3. Execute e passe 100% da suíte de testes automatizados (`php artisan test`).
4. Realize o deploy para os ambientes de Staging e Produção Cloudflare.
