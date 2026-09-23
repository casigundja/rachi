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
        $catInformatica = Category::where('slug', 'informatica-tecnologia')->first();
        $catConsumiveis = Category::where('slug', 'consumiveis')->first();
        $catPromocional = Category::where('slug', 'material-promocional')->first();

        $products = [
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica?->id,
                'sku' => 'TEC-NB-HP1040',
                'name' => 'HP Elitebook x360 1040 G8 (2-in-1)',
                'slug' => 'hp-elitebook-x360-1040-g8-2-in-1',
                'short_description' => 'Armazenamento SSD 512GB, Memória RAM 16GB DDR4, Intel Core i7, Touchscreen conversível.',
                'description' => 'O HP EliteBook x360 1040 G8 foi desenvolvido para profissionais exigentes que necessitam de versatilidade, mobilidade e segurança empresarial.',
                'price' => 1489000.29,
                'cost_price' => 1150000.00,
                'stock_quantity' => 8,
                'minimum_stock' => 2,
                'status' => 'active',
                'featured' => true,
                'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-05-at-11-02-30-3bbd6053.jpg'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica?->id,
                'sku' => 'TEC-SW-LIGE01',
                'name' => 'Smartwatch Lige Executivo',
                'slug' => 'smartwatch-lige',
                'short_description' => 'Elegante Smartwatch Lige com visor digital, chamadas Bluetooth, pulseira metálica dourada.',
                'description' => 'Relógio inteligente de alta definição com monitor cardíaco, contador de passos, chamadas telefônicas e pulseira extra.',
                'price' => 10000.00,
                'cost_price' => 6500.00,
                'stock_quantity' => 25,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => true,
                'image' => 'https://hom.rachi.ao/uploads/produtos/smart-whatch-8ee88fb4.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica?->id,
                'sku' => 'TEC-TV-MXQPRO',
                'name' => 'TV Box Android MXQ Pro 4K',
                'slug' => 'tv-box-android',
                'short_description' => 'TV BOX MXQ PRO 4K com suporte a streaming, HDMI e conexão Wi-Fi de alta estabilidade.',
                'description' => 'Transforme qualquer monitor ou televisão em uma smart TV com acesso a aplicativos e reprodução multimídia de alta resolução.',
                'price' => 18000.00,
                'cost_price' => 12000.00,
                'stock_quantity' => 15,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => true,
                'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-11-at-09-06-36-f406b8ca.jpg'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catInformatica?->id,
                'sku' => 'TEC-CAB-RS232',
                'name' => 'Cabo Console RS232/DB9 Serial para RJ45 1.5M',
                'slug' => 'cabo-console-rs232-db9-com-serial-para-rj45-1-5m-preto',
                'short_description' => 'Cabo Console para configuração de roteadores, switches Cisco e equipamentos de rede.',
                'description' => 'Cabo profissional de 1.5 metros para administradores de rede e suporte técnico de TI.',
                'price' => 16989.89,
                'cost_price' => 9000.00,
                'stock_quantity' => 30,
                'minimum_stock' => 5,
                'status' => 'active',
                'featured' => false,
                'image' => 'https://hom.rachi.ao/uploads/produtos/cabo-console_rj45-db44e13a.png'
            ],
            [
                'business_unit_id' => 1,
                'category_id' => $catConsumiveis?->id,
                'sku' => 'TEC-FONE-FIO',
                'name' => 'Auricular com fio Estéreo 3.5mm',
                'slug' => 'auricular-com-fio',
                'short_description' => 'Auricular ergonômico com microfone integrado e isolamento de ruído.',
                'description' => 'Fones de ouvido com alta nitidez sonora e acabamento reforçado para uso diário em escritórios.',
                'price' => 3000.00,
                'cost_price' => 1500.00,
                'stock_quantity' => 50,
                'minimum_stock' => 10,
                'status' => 'active',
                'featured' => false,
                'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-09-at-23-27-07-2-2e9986bc.jpg'
            ],
            [
                'business_unit_id' => 2,
                'category_id' => $catPromocional?->id,
                'sku' => 'PRT-CAPA-IP12',
                'name' => 'Capa Temática Naruto para iPhone 11 / 12 Pro',
                'slug' => 'capa-tematica-naruto-para-iphone-11-12-pro',
                'short_description' => 'Capa protetora personalizada em silicone de alta resistência com acabamento premium.',
                'description' => 'Impressão em alta definição resistente a arranhões e quedas.',
                'price' => 7000.00,
                'cost_price' => 3500.00,
                'stock_quantity' => 12,
                'minimum_stock' => 3,
                'status' => 'active',
                'featured' => false,
                'image' => 'https://hom.rachi.ao/uploads/produtos/capa-iphone-22a16aff.png'
            ],
        ];

        foreach ($products as $pData) {
            $image = $pData['image'] ?? null;
            unset($pData['image']);

            $product = Product::updateOrCreate(['sku' => $pData['sku']], $pData);

            if ($image) {
                ProductImage::updateOrCreate(
                    ['product_id' => $product->id, 'path' => $image],
                    ['alt' => $product->name, 'is_primary' => true, 'sort_order' => 1]
                );
            }

            // Registrar saldo inicial em StockMovement
            StockMovement::firstOrCreate(
                ['product_id' => $product->id, 'type' => 'entry'],
                [
                    'user_id' => 1,
                    'quantity' => $product->stock_quantity,
                    'previous_quantity' => 0,
                    'current_quantity' => $product->stock_quantity,
                    'reason' => 'Saldo Inicial de Implantação',
                    'created_at' => now(),
                ]
            );
        }
    }
}
