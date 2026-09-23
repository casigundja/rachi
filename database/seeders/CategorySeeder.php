<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // TEC
            ['business_unit_id' => 1, 'name' => 'Informática e Tecnologia', 'slug' => 'informatica-tecnologia', 'type' => 'product'],
            ['business_unit_id' => 1, 'name' => 'Serviços Digitais & Web', 'slug' => 'servicos-digitais', 'type' => 'service'],
            ['business_unit_id' => 1, 'name' => 'Sistemas e Softwares', 'slug' => 'sistemas-softwares', 'type' => 'service'],

            // PRINT
            ['business_unit_id' => 2, 'name' => 'Personalizado Gráfica', 'slug' => 'personalizado-grafica', 'type' => 'product'],
            ['business_unit_id' => 2, 'name' => 'Impressão e Papelaria', 'slug' => 'impressao-papelaria', 'type' => 'product'],
            ['business_unit_id' => 2, 'name' => 'Material Promocional', 'slug' => 'material-promocional', 'type' => 'product'],
            ['business_unit_id' => 2, 'name' => 'Design & Identidade Visual', 'slug' => 'design-identidade', 'type' => 'service'],

            // ACADEMY
            ['business_unit_id' => 3, 'name' => 'Gestão e Liderança', 'slug' => 'gestao-lideranca', 'type' => 'course'],
            ['business_unit_id' => 3, 'name' => 'Tecnologia da Informação', 'slug' => 'tecnologia-informacao', 'type' => 'course'],
            ['business_unit_id' => 3, 'name' => 'Comunicação e Vendas', 'slug' => 'comunicacao-vendas', 'type' => 'course'],

            // CAPITAL
            ['business_unit_id' => 4, 'name' => 'Formalização Empresarial', 'slug' => 'formalizacao-empresarial', 'type' => 'service'],
            ['business_unit_id' => 4, 'name' => 'Recursos Humanos e Talentos', 'slug' => 'recursos-humanos', 'type' => 'service'],
            ['business_unit_id' => 4, 'name' => 'Logística & Suporte Operacional', 'slug' => 'logistica-suporte', 'type' => 'service'],
            ['business_unit_id' => 4, 'name' => 'Consumíveis & Escritório', 'slug' => 'consumiveis', 'type' => 'product'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug'], 'business_unit_id' => $cat['business_unit_id']],
                $cat
            );
        }
    }
}
