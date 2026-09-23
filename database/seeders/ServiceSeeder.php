<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // TEC
            [
                'business_unit_id' => 1,
                'name' => 'Consultoria em Transformação Digital',
                'slug' => 'consultoria-transformacao-digital',
                'short_description' => 'Apoio estratégico para modernizar a empresa com tecnologia, processos e cultura digital.',
                'description' => 'Diagnóstico de maturidade digital, roteiro de transformação, priorização de investimentos e acompanhamento contínuo da implementação tecnológica.',
                'base_price' => 250000.00,
                'pricing_type' => 'quote',
                'estimated_days' => 15,
                'featured' => true,
            ],
            [
                'business_unit_id' => 1,
                'name' => 'Criação de Websites e Plataformas Web',
                'slug' => 'criacao-websites',
                'short_description' => 'Desenvolvimento de websites institucionais, portais comerciais e lojas online responsivas.',
                'description' => 'Projetos sob medida em tecnologias modernas, alta performance, otimização para SEO e painel administrativo integrado.',
                'base_price' => 450000.00,
                'pricing_type' => 'quote',
                'estimated_days' => 20,
                'featured' => true,
            ],
            [
                'business_unit_id' => 1,
                'name' => 'Digitalização de Processos Empresariais',
                'slug' => 'digitalizacao-processos-empresariais',
                'short_description' => 'Mapeamos e digitalizamos fluxos operacionais para reduzir erros, papel e tempo de resposta.',
                'description' => 'Automação de workflows, eliminação de gargalos e ganho expressivo de produtividade para MPMEs.',
                'base_price' => 180000.00,
                'pricing_type' => 'quote',
                'estimated_days' => 10,
                'featured' => false,
            ],
            [
                'business_unit_id' => 1,
                'name' => 'Suporte Técnico e Manutenção Especializada',
                'slug' => 'suporte-tecnico-especializado',
                'short_description' => 'Assistência contínua a sistemas, redes, equipamentos e utilizadores para manter a operação estável.',
                'description' => 'Planos mensais de suporte preventivo e corretivo presencial e remoto em Luanda.',
                'base_price' => 85000.00,
                'pricing_type' => 'fixed',
                'estimated_days' => 1,
                'featured' => true,
            ],

            // PRINT
            [
                'business_unit_id' => 2,
                'name' => 'Design de Identidade Visual e Logotipo',
                'slug' => 'design-identidade-visual',
                'short_description' => 'Criação de marca, manual de normas gráficas e presença institucional forte.',
                'description' => 'Desenvolvimento de logotipos, tipografia institucional, paleta de cores e templates para redes sociais.',
                'base_price' => 120000.00,
                'pricing_type' => 'fixed',
                'estimated_days' => 7,
                'featured' => true,
            ],
            [
                'business_unit_id' => 2,
                'name' => 'Produção Gráfica: Banners, Roll-ups e Brindes',
                'slug' => 'producao-grafica-promocional',
                'short_description' => 'Impressão em grande formato, cartões de visita de luxo e brindes corporativos.',
                'description' => 'Materiais promocionais de altíssima definição com acabamentos especiais.',
                'base_price' => 35000.00,
                'pricing_type' => 'quote',
                'estimated_days' => 3,
                'featured' => true,
            ],

            // CAPITAL
            [
                'business_unit_id' => 4,
                'name' => 'Formalização e Legalização de Empresas',
                'slug' => 'formalizacao-legalizacao-empresas',
                'short_description' => 'Apoio integral na constituição, certidões, NIF e regularização de negócios em Angola.',
                'description' => 'Orientação jurídica e burocrática para transição do informal para o formal com segurança.',
                'base_price' => 150000.00,
                'pricing_type' => 'fixed',
                'estimated_days' => 12,
                'featured' => true,
            ],
            [
                'business_unit_id' => 4,
                'name' => 'Recrutamento e Gestão de Pessoas',
                'slug' => 'recrutamento-gestao-pessoas',
                'short_description' => 'Seleção de talentos qualificados e estruturação de equipas de alto desempenho.',
                'description' => 'Triagem por competências técnicas e comportamentais para cargos estratégicos e operacionais.',
                'base_price' => 95000.00,
                'pricing_type' => 'quote',
                'estimated_days' => 15,
                'featured' => false,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }
    }
}
