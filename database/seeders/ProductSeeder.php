<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\StockMovement;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catInformatica = Category::firstOrCreate(
            ['slug' => 'informatica-tecnologia'],
            ['name' => 'Informática e Tecnologia', 'type' => 'product']
        );
        $catConsumiveis = Category::firstOrCreate(
            ['slug' => 'consumiveis'],
            ['name' => 'Consumíveis & Escritório', 'type' => 'product']
        );
        $catPromocional = Category::firstOrCreate(
            ['slug' => 'material-promocional'],
            ['name' => 'Material Promocional & Brindes', 'type' => 'product']
        );
        $catOtaku = Category::firstOrCreate(
            ['slug' => 'universo-otaku-anime'],
            ['name' => 'Universo Otaku & Geek', 'type' => 'product']
        );

        // Remover produto excluído da loja se ainda existir
        Product::where('sku', 'TEC-KIT-GOKU01')->orWhere('slug', 'caneca-ceramica-dragon-ball-kit')->delete();

        $products = [
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica->id,
                'sku' => 'TEC-NB-HP1040',
                'name' => 'HP Elitebook x360 1040 G8 (2-in-1)',
                'slug' => 'hp-elitebook-x360-1040-g8-2-in-1',
                'short_description' => 'Armazenamento SSD 512GB, Memória RAM 16GB DDR4, Intel Core i7, Touchscreen conversível 360°.',
                'description' => 'O HP EliteBook x360 1040 G8 foi desenvolvido para profissionais exigentes que necessitam de versatilidade, mobilidade e segurança empresarial.',
                'price' => 1489000.29,
                'cost_price' => 1150000.00,
                'stock_quantity' => 8,
                'minimum_stock' => 2,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/hp-elitebook-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica->id,
                'sku' => 'TEC-SW-LIGE01',
                'name' => 'Smartwatch Lige Executivo Pro',
                'slug' => 'smartwatch-lige-executivo',
                'short_description' => 'Visor digital AMOLED, chamadas Bluetooth e pulseira de aço inoxidável.',
                'description' => 'Relógio inteligente com acabamento executivo de luxo. Receba chamadas, notificações corporativas e acompanhe métricas de saúde com bateria de até 7 dias.',
                'price' => 10000.00,
                'cost_price' => 6500.00,
                'stock_quantity' => 25,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/smartwatch-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica->id,
                'sku' => 'TEC-TV-MXQPRO',
                'name' => 'TV Box Android MXQ Pro 4K Ultra HD',
                'slug' => 'tv-box-android-mxq-pro-4k',
                'short_description' => 'Streaming 4K, Wi-Fi integrado, HDMI e suporte a aplicativos corporativos.',
                'description' => 'Transforme qualquer monitor ou televisão numa estação multimídia inteligente. Ideal para salas de reuniões, sinalética digital comercial ou entretenimento.',
                'price' => 18000.00,
                'cost_price' => 12000.00,
                'stock_quantity' => 15,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/tvbox-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica->id,
                'sku' => 'TEC-CAB-RS232',
                'name' => 'Cabo Console RS232/DB9 para RJ45 1.5M',
                'slug' => 'cabo-console-rs232-db9-rj45',
                'short_description' => 'Cabo serial padrão para configuração de roteadores e switches corporativos.',
                'description' => 'Cabo console de alta durabilidade para técnicos de redes e administradores de sistemas. Compatível com Cisco, Huawei, MikroTik, HP e switches corporativos.',
                'price' => 16989.89,
                'cost_price' => 9000.00,
                'stock_quantity' => 30,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/cabo-console-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catConsumiveis->id,
                'sku' => 'TEC-FONE-FIO',
                'name' => 'Auricular com Fio 3.5mm Alta Fidelidade',
                'slug' => 'auricular-com-fio-3-5mm',
                'short_description' => 'Áudio estéreo nítido com microfone embutido para reuniões e chamadas.',
                'description' => 'Auriculares com fio Jack 3.5mm ideais para escritórios, call centers e reuniões do Microsoft Teams e Zoom com som limpo e isolamento acústico.',
                'price' => 3000.00,
                'cost_price' => 1500.00,
                'stock_quantity' => 50,
                'minimum_stock' => 10,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/auricular-fio-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catConsumiveis->id,
                'sku' => 'TEC-FONE-TWS',
                'name' => 'Auriculares sem Fio Bluetooth TWS',
                'slug' => 'auriculares-sem-fio-bluetooth',
                'short_description' => 'Conexão Bluetooth 5.3, estojo com visor LED e autonomia até 24h.',
                'description' => 'Fone de ouvido sem fio de última geração com emparelhamento instantâneo, cancelamento de ruído ambiental para chamadas e conforto ergonómico prolongado.',
                'price' => 15000.00,
                'cost_price' => 8500.00,
                'stock_quantity' => 20,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/auriculares-tws-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catPromocional->id,
                'sku' => 'TEC-ACC-NARUTO',
                'name' => 'Capa Temática Naruto para iPhone',
                'slug' => 'capa-tematica-naruto-iphone',
                'short_description' => 'Silicone reforçado com proteção contra quedas e acabamento fosco.',
                'description' => 'Capa protetora de alta densidade compatível com iPhone 11 / 12 Pro. Estampa de alta definição que não desbota e bordas elevadas para resguardar a câmara.',
                'price' => 7000.00,
                'cost_price' => 3500.00,
                'stock_quantity' => 25,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/capa-iphone-studio.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH01',
                'name' => 'T-Shirt Naruto Shippuden Modo Sábio & Gamakichi',
                'slug' => 'tshirt-naruto-modo-sabio-gamakichi',
                'short_description' => 'Algodão premium 100%, estampa digital HD com Naruto Sennin no topo de Gamakichi.',
                'description' => 'T-Shirt temática de alta qualidade da linha Otaku Store RACHI Tec. Tecido macio e respirável com estampa em serigrafia digital de alta durabilidade.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 18,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/otaku/tshirt-naruto-gamakichi.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH02',
                'name' => 'T-Shirt Akatsuki Clássica Nuvens Vermelhas',
                'slug' => 'tshirt-akatsuki-nuvens-vermelhas',
                'short_description' => 'Design icónico da organização Akatsuki com estampa das nuvens carmesim em fundo preto.',
                'description' => 'A peça mais desejada pelos fãs de anime. Confeccionada com corte confortável e costura reforçada nas golas e mangas.',
                'price' => 8500.00,
                'cost_price' => 4000.00,
                'stock_quantity' => 22,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => true,
                'image' => '/images/otaku/tshirt-akatsuki-classic-black.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH03',
                'name' => 'T-Shirt Saitama Serious Punch — One Punch Man',
                'slug' => 'tshirt-saitama-serious-punch',
                'short_description' => 'Estampa do punho devastador de Saitama em alta resolução gráfica.',
                'description' => 'Inspirada no herói mais forte dos animes. Acabamento especial anti-encolhimento e conforto térmico para o dia a dia.',
                'price' => 9000.00,
                'cost_price' => 4200.00,
                'stock_quantity' => 15,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-saitama-punch.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH04',
                'name' => 'T-Shirt Naruto Shippuden Modo Chakra da Kurama',
                'slug' => 'tshirt-naruto-modo-chakra-kurama',
                'short_description' => 'Naruto envolto no lendário manto dourado de Nove Caudas com detalhes reluzentes.',
                'description' => 'T-Shirt exclusiva com arte vetorial de alta definição do ápice da Quarta Grande Guerra Ninja.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 16,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-naruto-kurama-chakra.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH05',
                'name' => 'T-Shirt Madara Uchiha — O Fantasma dos Uchiha',
                'slug' => 'tshirt-madara-uchiha-fantasma',
                'short_description' => 'Arte imponente do lendário patriarca Uchiha com armadura carmesim e pose de combate.',
                'description' => 'Disponível nas versões Branco, Cinza e Azul Noite. Qualidade têxtil premium da Otaku Store RACHI Tec.',
                'price' => 10000.00,
                'cost_price' => 4800.00,
                'stock_quantity' => 14,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-madara-uchiha-white.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH06',
                'name' => 'T-Shirt Minato Namikaze & Kushina Uzumaki — Família',
                'slug' => 'tshirt-minato-kushina-familia',
                'short_description' => 'Tributo emocionante aos pais do Naruto no momento do seu nascimento.',
                'description' => 'Uma das artes mais queridas da comunidade anime, com estampa vívida e duradoura sobre tecido confortável de 100% algodão.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 15,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-minato-kushina-family.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH07',
                'name' => 'T-Shirt Nanadaime Hokage — Do Balanço ao Topo',
                'slug' => 'tshirt-nanadaime-hokage-balanco',
                'short_description' => 'Contraste visual marcante entre a infância no balanço e a capa do Sétimo Hokage.',
                'description' => 'Composição artística de superação retratando a trajetória de Naruto até se tornar o Hokage respeitado por todos.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 17,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-hokage-naruto-swing.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH08',
                'name' => 'T-Shirt Gaara do Deserto — Kazekage de Suna',
                'slug' => 'tshirt-gaara-deserto-kazekage',
                'short_description' => 'Gaara controlando a areia com selo de amor na testa e olhar compenetrado.',
                'description' => 'Ilustração estilizada de Gaara em tecido macio de alta durabilidade. Tecido fresco para o clima nacional.',
                'price' => 9000.00,
                'cost_price' => 4200.00,
                'stock_quantity' => 12,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-gaara-sand.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH09',
                'name' => 'T-Shirt Sukuna & Kurama — Lua de Sangue Carmesim',
                'slug' => 'tshirt-sukuna-kurama-lua-sangue',
                'short_description' => 'Arte sombria e imponente com lua de sangue e criatura colossal em tons escarlates.',
                'description' => 'Design impactante para fãs de dark fantasy anime sobre camiseta preta de alta gramatura e toque zero.',
                'price' => 10000.00,
                'cost_price' => 4800.00,
                'stock_quantity' => 15,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-sukuna-blood-moon.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH10',
                'name' => 'T-Shirt Monkey D. Luffy — One Piece Gear',
                'slug' => 'tshirt-monkey-d-luffy-one-piece',
                'short_description' => 'Luffy com o icónico chapéu de palha em perfil dinâmico sobre fundo cinza mescla.',
                'description' => 'A peça indispensável para qualquer nakama. Conforto extraordinário e estampa impecável com cores autênticas de One Piece.',
                'price' => 9000.00,
                'cost_price' => 4200.00,
                'stock_quantity' => 19,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-luffy-one-piece.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH11',
                'name' => 'T-Shirt Super Saiyan Goku Neon Splash — Dragon Ball Z',
                'slug' => 'tshirt-super-saiyan-goku-neon',
                'short_description' => 'Estilo street art neon com Goku transformado em Super Saiyajin e aura amarela vibrante.',
                'description' => 'Mistura de arte urbana contemporânea com o maior ícone dos animes. Estampa exclusiva Otaku Store.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 20,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-goku-super-saiyan-neon.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH12',
                'name' => 'T-Shirt Kid Goku na Nuvem Voadora Kintoun Clássico',
                'slug' => 'tshirt-kid-goku-nuvem-voadora',
                'short_description' => 'O clássico Goku criança voando na nuvem dourada com sorriso contagiante.',
                'description' => 'Nostalgia pura da primeira saga de Akira Toriyama com acabamento gráfico vintage.',
                'price' => 8500.00,
                'cost_price' => 4000.00,
                'stock_quantity' => 14,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-kid-goku-kintoun.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH13',
                'name' => 'T-Shirt Naruto Traço Manga Sketch Minimalista',
                'slug' => 'tshirt-naruto-traco-manga-sketch',
                'short_description' => 'Estilo autêntico de nanquim original do mangá de Masashi Kishimoto sobre malha cinza.',
                'description' => 'Visual sofisticado e minimalista para quem aprecia a arte original do mangá japonês.',
                'price' => 8500.00,
                'cost_price' => 4000.00,
                'stock_quantity' => 16,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-naruto-sketch-grey.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH14',
                'name' => 'T-Shirt Itachi Uchiha Chibi & Akatsuki Back',
                'slug' => 'tshirt-itachi-uchiha-chibi-back',
                'short_description' => 'Itachi em versão chibi na frente e estampa marcante nas costas com símbolo Akatsuki.',
                'description' => 'Design moderno frente e verso em 100% algodão penteado de alta densidade.',
                'price' => 9000.00,
                'cost_price' => 4200.00,
                'stock_quantity' => 18,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-itachi-chibi-back.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH15',
                'name' => 'T-Shirt Naruto na Floresta Verde Oliva — Vila da Folha',
                'slug' => 'tshirt-naruto-floresta-verde-oliva',
                'short_description' => 'Naruto descansando à sombra de uma árvore sob a luz solar da floresta de Konoha.',
                'description' => 'Cores ricas e atmosfera serena sobre malha verde oliva de alta qualidade e costura reforçada.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 15,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-naruto-tree-green.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catOtaku->id,
                'sku' => 'TEC-OTK-TSH16',
                'name' => 'T-Shirt Naruto Painel Mangá Multi-Cenas Quadros',
                'slug' => 'tshirt-naruto-painel-manga-quadros',
                'short_description' => 'Composição em 4 painéis de mangá coloridos com cenas lendárias de Naruto e Gaara.',
                'description' => 'T-Shirt estilo editorial japonês com momentos marcantes da jornada ninja.',
                'price' => 9500.00,
                'cost_price' => 4500.00,
                'stock_quantity' => 17,
                'minimum_stock' => 4,
                'status' => 'active',
                'featured' => false,
                'image' => '/images/otaku/tshirt-naruto-manga-panel.png'
            ],
        ];

        foreach ($products as $pData) {
            $image = $pData['image'] ?? null;
            unset($pData['image']);

            $product = Product::updateOrCreate(
                ['sku' => $pData['sku']],
                $pData
            );

            if ($image) {
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'path' => $image],
                    ['alt' => $product->name, 'is_primary' => true, 'sort_order' => 1]
                );
            }

            // Registrar saldo inicial em StockMovement se não existir
            StockMovement::firstOrCreate(
                ['product_id' => $product->id, 'type' => 'entry'],
                [
                    'user_id' => 1,
                    'quantity' => $product->stock_quantity,
                    'previous_quantity' => 0,
                    'current_quantity' => $product->stock_quantity,
                    'reason' => 'Saldo Inicial de Sincronização Loja RACHI Tec',
                    'created_at' => now(),
                ]
            );
        }
    }
}
