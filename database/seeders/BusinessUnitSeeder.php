<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use Illuminate\Database\Seeder;

class BusinessUnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            [
                'id' => 1,
                'name' => 'RACHI Tec',
                'slug' => 'tec',
                'description' => 'Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico especializado.',
                'logo' => 'https://hom.rachi.ao/assets/img/areas/rachi-tec.png',
                'phone' => '+244 923 000 001',
                'email' => 'tec@rachi.ao',
                'status' => 'active',
            ],
            [
                'id' => 2,
                'name' => 'RACHI Print',
                'slug' => 'print',
                'description' => 'Produção gráfica, brindes empresariais, design de marcas, sinalética e comunicação visual.',
                'logo' => 'https://hom.rachi.ao/assets/img/areas/rachi-print.png',
                'phone' => '+244 923 000 002',
                'email' => 'print@rachi.ao',
                'status' => 'active',
            ],
            [
                'id' => 3,
                'name' => 'RACHI Academy',
                'slug' => 'academy',
                'description' => 'Capacitação profissional, formação corporativa, cursos práticos com certificação.',
                'logo' => 'https://hom.rachi.ao/assets/img/areas/rachi-academy.png',
                'phone' => '+244 923 000 003',
                'email' => 'academy@rachi.ao',
                'status' => 'active',
            ],
            [
                'id' => 4,
                'name' => 'RACHI Human Capital',
                'slug' => 'capital',
                'description' => 'Estruturação de empresas, formalização de negócios, recrutamento, gestão de pessoas e logística.',
                'logo' => 'https://hom.rachi.ao/assets/img/areas/rachi-capital.png',
                'phone' => '+244 923 000 004',
                'email' => 'capital@rachi.ao',
                'status' => 'active',
            ],
        ];

        foreach ($units as $unit) {
            BusinessUnit::updateOrCreate(['id' => $unit['id']], $unit);
        }
    }
}
