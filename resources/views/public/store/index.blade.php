<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja RACHI Tec — Informática, Equipamentos &amp; Tecnologia em Angola</title>
    <meta name="description" content="A sua loja online de informática, consumíveis, computadores e tecnologia corporativa em Angola. Compre com entrega rápida em Luanda e garantia oficial.">
    <link rel="canonical" href="https://rachi.ao/loja">

    <x-public-footer unit="store" />

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
                userLoggedIn: !!(window.AUTH_USER && window.AUTH_USER.name),
                currentUser: window.AUTH_USER || { 
                    name: '', 
                    email: '',
                    phone: '',
                    nif: '',
                    address: '',
                    balance: '0,00 AOA',
                    level: 'Corporativo'
                },
                isSubmittingOrder: false,
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
                get cartCount() { return this.cart.reduce((sum, item) => sum + Number(item.quantity || item.qty || 1), 0); },
                
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
                    { id: 'promocional', name: 'Acessórios & Brindes' },
                    { id: 'otaku', name: 'Universo Otaku & Anime' }
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
                    },
                    {
                        title: "T-Shirt Naruto Shippuden Modo Sábio & Gamakichi",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Mais Vendido",
                        stockText: "Disponível em Luanda",
                        rating: "5.0",
                        reviews: 36,
                        shortDesc: "Algodão premium 100%, estampa digital HD com Naruto Sennin no topo de Gamakichi.",
                        fullDesc: "T-Shirt temática de alta qualidade da linha Otaku Store RACHI Tec. Tecido macio e respirável com estampa em serigrafia digital de alta durabilidade que não desbota após lavagens. Disponível nas cores Branco, Preto e Cinza.",
                        specs: [
                            "100% Algodão penteado 30.1 de toque suave",
                            "Estampa digital HD com máxima fidelidade de cor",
                            "Cores disponíveis: Branco, Preto, Cinza",
                            "Tamanhos: S, M, L, XL e XXL",
                            "Gola redonda reforçada e costuras duplas"
                        ],
                        image: "/images/otaku/tshirt-naruto-gamakichi.png",
                        slug: "tshirt-naruto-modo-sabio-gamakichi"
                    },
                    {
                        title: "T-Shirt Akatsuki Clássica Nuvens Vermelhas",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "8.500,00 AOA",
                        priceNum: 8500.00,
                        oldPrice: "11.000,00 AOA",
                        discountPercent: "-22% OFF",
                        badge: "Destaque",
                        stockText: "Disponível (Stock Existente)",
                        rating: "4.9",
                        reviews: 48,
                        shortDesc: "Design icónico da organização Akatsuki com estampa das nuvens carmesim em fundo preto.",
                        fullDesc: "A peça mais desejada pelos fãs de anime. Confeccionada com corte confortável e costura reforçada nas golas e mangas.",
                        specs: [
                            "100% Algodão premium respirável",
                            "Nuvens carmesim Akatsuki com borda branca nítida",
                            "Costura dupla reforçada ombro a ombro",
                            "Disponível pronta-entrega em Luanda"
                        ],
                        image: "/images/otaku/tshirt-akatsuki-classic-black.png",
                        slug: "tshirt-akatsuki-nuvens-vermelhas"
                    },
                    {
                        title: "T-Shirt Saitama Serious Punch — One Punch Man",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.000,00 AOA",
                        priceNum: 9000.00,
                        oldPrice: "11.500,00 AOA",
                        discountPercent: "-21% OFF",
                        badge: "Sucesso",
                        stockText: "Disponível em Luanda",
                        rating: "5.0",
                        reviews: 29,
                        shortDesc: "Estampa do punho devastador de Saitama em alta resolução gráfica.",
                        fullDesc: "Inspirada no herói mais forte dos animes. Acabamento especial anti-encolhimento e conforto térmico para o dia a dia.",
                        specs: [
                            "Malha 100% algodão de toque macio",
                            "Impressão Silk Digital HD de alta durabilidade",
                            "Tamanhos: S, M, L, XL",
                            "Corte anatómico moderno"
                        ],
                        image: "/images/otaku/tshirt-saitama-punch.png",
                        slug: "tshirt-saitama-serious-punch"
                    },
                    {
                        title: "T-Shirt Naruto Shippuden Modo Chakra da Kurama",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Épico",
                        stockText: "Disponível",
                        rating: "4.9",
                        reviews: 33,
                        shortDesc: "Naruto envolto no lendário manto dourado de Nove Caudas com detalhes reluzentes.",
                        fullDesc: "T-Shirt exclusiva com arte vetorial de alta definição do ápice da Quarta Grande Guerra Ninja.",
                        specs: [
                            "Algodão 30.1 penteado premium",
                            "Estampa vibrante de longa duração",
                            "Gola careca reforçada com elastano"
                        ],
                        image: "/images/otaku/tshirt-naruto-kurama-chakra.png",
                        slug: "tshirt-naruto-modo-chakra-kurama"
                    },
                    {
                        title: "T-Shirt Madara Uchiha — O Fantasma dos Uchiha",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "13.000,00 AOA",
                        discountPercent: "-23% OFF",
                        badge: "Exclusivo",
                        stockText: "Disponível (Branco, Cinza, Azul)",
                        rating: "5.0",
                        reviews: 41,
                        shortDesc: "Arte imponente do lendário patriarca Uchiha com armadura carmesim e pose de combate.",
                        fullDesc: "Disponível nas versões Branco, Cinza e Azul Noite. Qualidade têxtil premium da Otaku Store RACHI Tec.",
                        specs: [
                            "Múltiplas opções de cores: Branco, Cinza e Azul",
                            "Tecido com tratamento especial anti-bolinhas",
                            "Corte unissexo regular fit com ótimo caimento"
                        ],
                        image: "/images/otaku/tshirt-madara-uchiha-white.png",
                        slug: "tshirt-madara-uchiha-fantasma"
                    },
                    {
                        title: "T-Shirt Minato Namikaze & Kushina Uzumaki — Família",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Emocionante",
                        stockText: "Disponível em Luanda",
                        rating: "5.0",
                        reviews: 52,
                        shortDesc: "Tributo emocionante aos pais do Naruto no momento do seu nascimento. Cores Vermelho, Branco e Preto.",
                        fullDesc: "Uma das artes mais queridas da comunidade anime, com estampa vívida e duradoura sobre tecido confortável de algodão.",
                        specs: [
                            "100% Algodão antialérgico respirável",
                            "Estampa frontal com Minato, Kushina e bebê Naruto",
                            "Cores disponíveis: Vermelho, Preto e Branco"
                        ],
                        image: "/images/otaku/tshirt-minato-kushina-family.png",
                        slug: "tshirt-minato-kushina-familia"
                    },
                    {
                        title: "T-Shirt Nanadaime Hokage — Do Balanço ao Topo",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.500,00 AOA",
                        discountPercent: "-24% OFF",
                        badge: "Mais Procurado",
                        stockText: "Disponível",
                        rating: "5.0",
                        reviews: 39,
                        shortDesc: "Contraste visual marcante entre a infância no balanço e a capa do Sétimo Hokage.",
                        fullDesc: "Composição artística de tirar o fôlego retratando a trajetória de superação do Naruto até se tornar Hokage.",
                        specs: [
                            "100% Algodão penteado de alta gramatura",
                            "Impressão de alta gama com tons dourados e sépia",
                            "Tamanhos S a XXL disponíveis"
                        ],
                        image: "/images/otaku/tshirt-hokage-naruto-swing.png",
                        slug: "tshirt-nanadaime-hokage-balanco"
                    },
                    {
                        title: "T-Shirt Gaara do Deserto — Kazekage de Suna",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.000,00 AOA",
                        priceNum: 9000.00,
                        oldPrice: "11.000,00 AOA",
                        discountPercent: "-18% OFF",
                        badge: "Destaque",
                        stockText: "Disponível em Luanda",
                        rating: "4.8",
                        reviews: 25,
                        shortDesc: "Gaara controlando a areia com selo de amor na testa e olhar compenetrado.",
                        fullDesc: "Ilustração estilizada de Gaara em tecido macio de alta durabilidade.",
                        specs: [
                            "Tecido leve e fresco para o clima de Luanda",
                            "Estampa detalhada em alta fidelidade de cor",
                            "Gola reforçada que não deforma"
                        ],
                        image: "/images/otaku/tshirt-gaara-sand.png",
                        slug: "tshirt-gaara-deserto-kazekage"
                    },
                    {
                        title: "T-Shirt Sukuna & Kurama — Lua de Sangue Carmesim",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "13.000,00 AOA",
                        discountPercent: "-23% OFF",
                        badge: "Dark Fantasy",
                        stockText: "Disponível",
                        rating: "4.9",
                        reviews: 31,
                        shortDesc: "Arte sombria e imponente com lua de sangue e criatura colossal em tons escarlates.",
                        fullDesc: "Design impactante para fãs de Shingeki no Kyojin, Jujutsu Kaisen e Naruto sombrio sobre camiseta preta de alta gramatura.",
                        specs: [
                            "Camiseta preta de alta gramatura",
                            "Estampa de impacto visual em vermelho carmesim",
                            "Corte moderno unissexo"
                        ],
                        image: "/images/otaku/tshirt-sukuna-blood-moon.png",
                        slug: "tshirt-sukuna-kurama-lua-sangue"
                    },
                    {
                        title: "T-Shirt Monkey D. Luffy — One Piece Gear",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.000,00 AOA",
                        priceNum: 9000.00,
                        oldPrice: "11.500,00 AOA",
                        discountPercent: "-21% OFF",
                        badge: "Rei dos Piratas",
                        stockText: "Disponível em Luanda",
                        rating: "5.0",
                        reviews: 44,
                        shortDesc: "Luffy com o icónico chapéu de palha em perfil dinâmico sobre fundo cinza mescla.",
                        fullDesc: "A peça indispensável para qualquer nakama. Conforto extraordinário e estampa impecável com cores autênticas de One Piece.",
                        specs: [
                            "Malha cinza mescla 100% algodão",
                            "Cores vivas e resistentes a lavagens",
                            "Pronta-entrega em Luanda"
                        ],
                        image: "/images/otaku/tshirt-luffy-one-piece.png",
                        slug: "tshirt-monkey-d-luffy-one-piece"
                    },
                    {
                        title: "T-Shirt Super Saiyan Goku Neon Splash — Dragon Ball Z",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Goku SSJ",
                        stockText: "Disponível",
                        rating: "5.0",
                        reviews: 50,
                        shortDesc: "Estilo street art neon com Goku transformado em Super Saiyajin e aura amarela vibrante.",
                        fullDesc: "Mistura de arte urbana contemporânea com o maior ícone dos animes. Estampa exclusiva Otaku Store.",
                        specs: [
                            "Efeito visual neon splash vibrante",
                            "Tecido encorpado e durável 100% algodão",
                            "Tamanhos S a XXL"
                        ],
                        image: "/images/otaku/tshirt-goku-super-saiyan-neon.png",
                        slug: "tshirt-super-saiyan-goku-neon"
                    },
                    {
                        title: "T-Shirt Kid Goku na Nuvem Voadora Kintoun Clássico",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "8.500,00 AOA",
                        priceNum: 8500.00,
                        oldPrice: "10.500,00 AOA",
                        discountPercent: "-19% OFF",
                        badge: "Nostalgia",
                        stockText: "Disponível",
                        rating: "4.8",
                        reviews: 26,
                        shortDesc: "O clássico Goku criança voando na nuvem dourada com sorriso contagiante.",
                        fullDesc: "Nostalgia pura da primeira saga de Akira Toriyama com acabamento gráfico vintage.",
                        specs: [
                            "100% Algodão penteado leve e confortável",
                            "Estampa retrô de alta resolução",
                            "Ideal para uso diário casual"
                        ],
                        image: "/images/otaku/tshirt-kid-goku-kintoun.png",
                        slug: "tshirt-kid-goku-nuvem-voadora"
                    },
                    {
                        title: "T-Shirt Naruto Traço Manga Sketch Minimalista",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "8.500,00 AOA",
                        priceNum: 8500.00,
                        oldPrice: "11.000,00 AOA",
                        discountPercent: "-22% OFF",
                        badge: "Minimal",
                        stockText: "Disponível",
                        rating: "4.8",
                        reviews: 21,
                        shortDesc: "Estilo autêntico de nanquim original do mangá de Masashi Kishimoto sobre malha cinza.",
                        fullDesc: "Visual sofisticado e discreto para quem aprecia a arte original do mangá.",
                        specs: [
                            "Malha cinza mescla premium de alta qualidade",
                            "Estampa linear em nanquim digital",
                            "Toque suave zero no tecido"
                        ],
                        image: "/images/otaku/tshirt-naruto-sketch-grey.png",
                        slug: "tshirt-naruto-traco-manga-sketch"
                    },
                    {
                        title: "T-Shirt Itachi Uchiha Chibi & Akatsuki Back",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.000,00 AOA",
                        priceNum: 9000.00,
                        oldPrice: "11.500,00 AOA",
                        discountPercent: "-21% OFF",
                        badge: "Favorito",
                        stockText: "Disponível em Luanda",
                        rating: "5.0",
                        reviews: 38,
                        shortDesc: "Itachi em versão chibi na frente e estampa marcante nas costas com símbolo Akatsuki.",
                        fullDesc: "Design moderno com detalhes na frente e nas costas, ideal para eventos de anime e uso casual.",
                        specs: [
                            "Estampa dupla frente e costas",
                            "100% Algodão penteado de alta densidade",
                            "Disponível pronta entrega em Luanda"
                        ],
                        image: "/images/otaku/tshirt-itachi-chibi-back.png",
                        slug: "tshirt-itachi-uchiha-chibi-back"
                    },
                    {
                        title: "T-Shirt Naruto na Floresta Verde Oliva — Vila da Folha",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Verde Folha",
                        stockText: "Disponível",
                        rating: "4.9",
                        reviews: 19,
                        shortDesc: "Naruto descansando à sombra de uma árvore sob a luz solar da floresta de Konoha.",
                        fullDesc: "Cores ricas e atmosfera serena da infância de Naruto sobre malha verde oliva de alta qualidade.",
                        specs: [
                            "Cor Verde Oliva exclusiva",
                            "Estampa artística em alta definição",
                            "Conforto térmico excelente"
                        ],
                        image: "/images/otaku/tshirt-naruto-tree-green.png",
                        slug: "tshirt-naruto-floresta-verde-oliva"
                    },
                    {
                        title: "T-Shirt Naruto Painel Mangá Multi-Cenas Quadros",
                        category: "Universo Otaku",
                        catId: "otaku",
                        price: "9.500,00 AOA",
                        priceNum: 9500.00,
                        oldPrice: "12.000,00 AOA",
                        discountPercent: "-20% OFF",
                        badge: "Mangá Art",
                        stockText: "Disponível",
                        rating: "4.9",
                        reviews: 27,
                        shortDesc: "Composição em 4 painéis de mangá coloridos com cenas lendárias de Naruto e Gaara.",
                        fullDesc: "T-Shirt estilo editorial japonês com momentos marcantes da jornada dos ninjas da Folha e da Areia.",
                        specs: [
                            "Composição em 4 quadrinhos de mangá",
                            "100% Algodão respirável",
                            "Corte unissexo confortável"
                        ],
                        image: "/images/otaku/tshirt-naruto-manga-panel.png",
                        slug: "tshirt-naruto-painel-manga-quadros"
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
                    if (p && (p.isUnavailable || (p.stock_quantity !== undefined && p.stock_quantity <= 0))) {
                        this.showToast('Este produto está indisponível ou esgotado no momento.', 'Produto Indisponível', 'error', 3000);
                        return;
                    }
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

                showToast(message, title = 'Notificação', type = 'success', duration = 6000) { return RachiToast.show(message, { title, type, duration }); },

                async logout() { await window.RachiSession.logout(); },

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

                handleCheckoutClick() {
                    if (!this.cart || this.cart.length === 0) {
                        this.showToast('A sua sacola de compras está vazia. Adicione produtos antes de finalizar.', 'Sacola Vazia', 'warning', 3500);
                        return;
                    }

                    // Se estiver logado: pega as informações do utilizador autenticado e finaliza a compra direto!
                    const loggedIn = this.userLoggedIn && this.currentUser && (this.currentUser.name || this.currentUser.email);
                    if (loggedIn) {
                        this.executeOrder({
                            name: this.currentUser.name,
                            email: this.currentUser.email,
                            phone: this.currentUser.phone || '',
                            nif: this.currentUser.nif || '',
                            address: this.currentUser.address || ''
                        });
                    } else {
                        // Caso NÃO tenha um utilizador autenticado: aí abre o formulário para preencher!
                        this.checkoutModal = true;
                    }
                },

                submitOrderForm() {
                    if (!this.orderForm.name || !this.orderForm.email || !this.orderForm.phone) {
                        this.showToast('Por favor, preencha o Nome, E-mail e Contacto Telefónico.', 'Campos Obrigatórios', 'warning', 3500);
                        return;
                    }
                    this.executeOrder(this.orderForm);
                },

                async executeOrder(clientData) {
                    if (this.isSubmittingOrder) return;
                    this.isSubmittingOrder = true;

                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                        const res = await fetch('/api/loja/pedidos', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token || ''
                            },
                            body: JSON.stringify({
                                customer_name: clientData.name,
                                customer_email: clientData.email,
                                customer_phone: clientData.phone,
                                customer_nif: clientData.nif || '',
                                delivery_address: clientData.address || '',
                                items: this.cart,
                                total: this.finalTotal,
                                subtotal: this.cartSubtotal,
                                discount: this.cartDiscount
                            })
                        });

                        const data = await res.json();
                        if (!res.ok || data.success === false) {
                            throw new Error(data.message || 'Falha ao processar o pedido.');
                        }

                        // Sincroniza stock localmente
                        if (Array.isArray(data.updated_stock)) {
                            data.updated_stock.forEach(us => {
                                const prod = this.products.find(p => p.id === us.id || p.slug === us.slug);
                                if (prod) {
                                    prod.est = us.stock_quantity;
                                    prod.stock_quantity = us.stock_quantity;
                                    prod.isUnavailable = us.status !== 'active' || us.stock_quantity <= 0;
                                    prod.stockText = us.stock_quantity <= 0 ? 'Esgotado' : `Disponível (${us.stock_quantity} unidades)`;
                                }
                            });
                        }

                        const orderNum = data.order_number || ('PED-2026-' + Math.floor(100000 + Math.random() * 900000));
                        this.cart = [];
                        this.checkoutModal = false;
                        this.cartDrawerOpen = false;
                        this.orderForm = { name: '', nif: '', phone: '', email: '', address: '' };

                        // Notifica canal BroadcastChannel para atualizar o /admin-dashboard instantaneamente
                        try {
                            if (window.BroadcastChannel) {
                                const ch = new BroadcastChannel('rachi_orders_channel');
                                ch.postMessage({ action: 'new_order', order: data.order, timestamp: Date.now() });
                            }
                        } catch(e) {}

                        this.showToast(
                            'Pedido ' + orderNum + ' registado com sucesso para ' + (clientData.name || clientData.email) + '! Factura proforma enviada para Pedidos de Venda.',
                            '🎉 Pedido Finalizado!',
                            'success',
                            6500
                        );
                    } catch (err) {
                        this.showToast(err.message || 'Erro ao submeter pedido.', 'Erro no Pedido', 'error', 4500);
                    } finally {
                        this.isSubmittingOrder = false;
                        this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                    }
                },

                async submitLogin() { try { this.currentUser = await RachiSession.login(this.loginForm.email.trim(), this.loginForm.password); this.userLoggedIn = true; this.loginModalOpen = false; } catch(e) { this.showToast(e.message, 'Falha no login', 'warning', 3500); } },

                submitRegister() { location.href = '/registro'; },

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
                        name: this.userLoggedIn && this.currentUser.name ? this.currentUser.name : 'Utilizador',
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
                            reply = 'Para consultar o seu pedido, aceda a "Meus Pedidos" no menu da sua conta ou informe o número do pedido aqui. Facturas pró-forma são emitidas com prazo de entrega imediato em Luanda.';
                        } else if (lower.includes('preco') || lower.includes('preço') || lower.includes('nif') || lower.includes('fatura') || lower.includes('pagamento') || lower.includes('factura')) {
                            reply = 'Os preços apresentados incluem IVA em Kwanzas (AOA). Emitimos Factura Pró-forma formal e Factura Comercial com o NIF da sua empresa. Aceitamos pagamentos por transferência bancária (IBAN) e multicaixa.';
                        } else if (lower.includes('entrega') || lower.includes('luanda') || lower.includes('levantamento') || lower.includes('onde')) {
                            reply = 'Fazemos entregas em toda a província de Luanda num prazo ágil de 24h a 48h úteis. Também pode realizar o levantamento gratuito das suas encomendas diretamente nas instalações da RACHI no Edifício Kilamba.';
                        } else if (lower.includes('laptop') || lower.includes('computador') || lower.includes('cabo') || lower.includes('tv box') || lower.includes('equipamento') || lower.includes('produto')) {
                            reply = 'Todos os nossos equipamentos informáticos contam com garantia oficial corporativa RACHI. Se desejar uma cotação para lotes empresariais, podemos preparar uma proposta formal de imediato.';
                        } else if (lower.includes('humano') || lower.includes('atendente') || lower.includes('falar') || lower.includes('whatsapp') || lower.includes('ligar')) {
                            reply = 'Com certeza! Pode falar diretamente com um dos nossos consultores pelo WhatsApp: +244 972 888 585 ou por telefone: +244 222 000 000. Estamos disponíveis de Seg. a Sex. das 08h às 17h.';
                        } else {
                            reply = 'Obrigado pelo seu contacto! A sua solicitação foi registada na nossa central RACHI. Se preferir atendimento imediato em tempo real com o consultor de plantão, pode utilizar o nosso WhatsApp: +244 972 888 585.';
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


                        if (this.authChannel) {
                            this.authChannel.postMessage({ action: 'update', user: this.currentUser, timestamp: Date.now() });
                        }
                    } catch (e) {}
                    this.showToast('Dados de registo atualizados com sucesso!', 'Perfil Atualizado', 'success', 3500);
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

                async syncSessionFromStorage() {
                    const user = await RachiSession.session();
                    if (user && user.name) {
                        this.currentUser = Object.assign({}, this.currentUser, user);
                        this.userLoggedIn = true;
                    } else if (window.AUTH_USER && window.AUTH_USER.name) {
                        this.currentUser = Object.assign({}, this.currentUser, window.AUTH_USER);
                        this.userLoggedIn = true;
                    }
                },

                init() {
                    // 1. Inicializar e restaurar sessão sincronizada entre todas as telas
                    this.syncSessionFromStorage();

                    // Sincronização em tempo real com stock da base de dados
                    try {
                        const liveList = @json($liveProducts ?? []);
                        if (Array.isArray(liveList) && liveList.length > 0) {
                            this.products.forEach(p => {
                                const found = liveList.find(lp => 
                                    (lp.slug && p.slug && lp.slug === p.slug) ||
                                    (lp.name && p.title && lp.name.toLowerCase().trim() === p.title.toLowerCase().trim()) ||
                                    (lp.sku && p.sku && lp.sku === p.sku)
                                );
                                if (found) {
                                    p.id = found.id;
                                    p.sku = found.sku;
                                    p.stock_quantity = found.stock_quantity;
                                    p.status = found.status;
                                    p.isUnavailable = found.status !== 'active' || found.stock_quantity <= 0;
                                    p.stockText = found.status !== 'active' 
                                        ? 'Indisponível' 
                                        : (found.stock_quantity <= 0 ? 'Esgotado' : `Disponível (${found.stock_quantity} unidades)`);
                                }
                            });
                        }
                    } catch (e) {
                        console.error('Erro ao sincronizar stock:', e);
                    }


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
    @include('components.theme-toggle-fab')
</body>
</html>
