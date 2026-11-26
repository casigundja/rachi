# Diretrizes Obrigatórias do Projeto RACHI • Identidade Visual & Engenharia de Frontend

> **REGRA GERAL E MANDATÓRIA DO WORKSPACE**: Qualquer interface, tela, página web, landing page, modal, painel administrativo, componente, CSS, criativo, marketing ou código de frontend criado ou editado neste projeto **DEVE SEGUIR ESTRITAMENTE A IDENTIDADE VISUAL OFICIAL DA RACHI**.

---

## 1. Princípio Fundamental de Cores: Não ao "Arco-íris"
- **Nunca introduzir cores aleatórias** (roxos `#7c3aed` / `#9333ea`, rosas `#e11d48` / `#f43f5e`, verdes fluorescentes ou azuis violeta genéricos).
- Toda a interface deve ser coerente, sóbria, corporativa e harmonizada em torno dos tokens oficiais da RACHI.

---

## 2. Tokens Oficiais da Identidade RACHI (Design Tokens)

| Token | Nome | Valor HEX | Uso Mandatório |
| :--- | :--- | :--- | :--- |
| `rachiBlue` | **Azul RACHI** | `#0050f0` | **Cor Primária**: Botões principais de ação (CTAs), seleções ativas, abas ativas, links e destaques nobres. |
| `rachiCyan` | **Ciano RACHI** | `#00a3e0` | **Acento Luminoso**: Ícones luminosos, gradientes com #0050f0, destaques em dark mode (`#38bdf8`). |
| `rachiGold` | **Âmbar/Gold RACHI** | `#f5a800` | **Acento de Atenção & Transbordo**: Badges de transbordo humano pendente, alertas de sistema, avisos institucionais. |
| `rachiNavy` | **Navy Profundo** | `#071326` | **Fundo Nobre (Dark Mode)**: Sidebars, cabeçalhos escuros, fundos de páginas e avatares executivos. |
| `rachiDarkCard` | **Superfície Dark** | `#0c1527` | Cartões, janelas ativas de chat, tabelas e modais no modo escuro. |
| `rachiLightBg` | **Fundo Light** | `#f4f6fb` | Fundo principal da aplicação em modo claro. |
| `rachiLightCard` | **Superfície Light** | `#ffffff` | Cartões e painéis no modo claro. |
| `whatsappGreen` | **WhatsApp Oficial** | `#25D366` | Exclusivo para botões e badges oficiais de integração com WhatsApp. |

---

## 3. Tipografia Oficial
- **Títulos, Cabeçalhos e Números em Destaque**: `font-family: 'Outfit', sans-serif` (pesos 600, 700, 800, 900).
- **Corpo de Texto, Menus, Formulários e Tabelas**: `font-family: 'Plus Jakarta Sans', sans-serif` (pesos 400, 500, 600, 700).

---

## 4. Padrões de Componentes Obrigatórios

1. **Botão Principal (CTA Primário)**:
   `bg-[#0050f0] hover:bg-[#0040d0] text-white font-bold rounded-xl shadow-xs transition`
2. **Botão Secundário / Ações Neutras**:
   `bg-slate-100 hover:bg-slate-200/80 dark:bg-white/5 dark:hover:bg-white/10 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-white/10 rounded-xl`
3. **Botão / Alerta de Transbordo Humano**:
   `bg-[#f5a800] text-slate-950 font-bold rounded-xl` ou `bg-[#f5a800]/10 text-[#d97706] dark:text-[#fbbf24] border border-[#f5a800]/30`
4. **Campos de Formulário e Busca**:
   `focus:ring-2 focus:ring-[#0050f0]/20 focus:border-[#0050f0]`
5. **Item Ativo em Listas e Menus**:
   Borda lateral de destaque no Azul RACHI: `border-l-4 border-l-[#0050f0] bg-blue-50/70 dark:bg-[#0050f0]/10`
6. **Balões de Mensagem no Chat**:
   - **Assistente IA (RACHI Assist)**: `bg-white dark:bg-[#0c1527] border border-blue-100 dark:border-blue-900/40 text-slate-800 dark:text-slate-100` com badge `text-[#0050f0] dark:text-[#38bdf8]`.
   - **Consultor Humano Executivo**: `bg-gradient-to-r from-[#0050f0] to-[#003cb8] text-white shadow-xs`.
   - **Cliente**: `bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-white/10 text-slate-800 dark:text-slate-100`.

---

## 5. Regra de Sincronização Dupla
Sempre que editar uma visualização de painel administrativo, altere simultaneamente:
- `public/pages/admin-dashboard.html`
- `resources/views/admin/dashboard.blade.php`
E garanta que **ambos os arquivos mantenham 100% de paridade**, com tags HTML perfeitamente balanceadas e testes automatizados (`php artisan test`) passando.
