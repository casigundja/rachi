<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseLesson;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $catGestao = Category::where('slug', 'gestao-lideranca')->first();
        $catTI = Category::where('slug', 'tecnologia-informacao')->first();

        // 1. Curso de Gestão de MPMEs
        $course1 = Course::updateOrCreate(
            ['slug' => 'gestao-estruturacao-mpme'],
            [
                'business_unit_id' => 3, // ACADEMY
                'category_id' => $catGestao?->id,
                'name' => 'Gestão e Estruturação Prática de MPMEs em Angola',
                'short_description' => 'Aprenda a organizar processos administrativos, finanças básicas e conformidade tributária para crescer com solidez.',
                'description' => 'Curso completo e focado no mercado angolano. O programa aborda desde a organização societária e contábil até a digitalização das vendas e fidelização de clientes.',
                'price' => 65000.00,
                'duration_hours' => 24,
                'level' => 'intermediate',
                'status' => 'published',
                'published_at' => now(),
            ]
        );

        $mod1 = CourseModule::updateOrCreate(
            ['course_id' => $course1->id, 'sort_order' => 1],
            ['title' => 'Módulo 1 — Fundação e Regularização do Negócio', 'description' => 'Aspectos legais, NIF, contabilidade e alvarás.', 'status' => 'active']
        );

        CourseLesson::updateOrCreate(
            ['course_module_id' => $mod1->id, 'sort_order' => 1],
            ['title' => 'Aula 1: Do Informal ao Formal — Primeiros Passos em Angola', 'duration_minutes' => 45, 'status' => 'active']
        );
        CourseLesson::updateOrCreate(
            ['course_module_id' => $mod1->id, 'sort_order' => 2],
            ['title' => 'Aula 2: Planeamento Financeiro e Fluxo de Caixa Essencial', 'duration_minutes' => 60, 'status' => 'active']
        );

        $mod2 = CourseModule::updateOrCreate(
            ['course_id' => $course1->id, 'sort_order' => 2],
            ['title' => 'Módulo 2 — Gestão Operacional e Pessoas', 'description' => 'Contratações, liderança e rotinas de excelência.', 'status' => 'active']
        );

        CourseLesson::updateOrCreate(
            ['course_module_id' => $mod2->id, 'sort_order' => 1],
            ['title' => 'Aula 3: Como Contratar e Manter Bons Profissionais', 'duration_minutes' => 50, 'status' => 'active']
        );

        // 2. Curso de Tecnologia e Digitalização
        Course::updateOrCreate(
            ['slug' => 'transformacao-digital-para-empresas'],
            [
                'business_unit_id' => 3,
                'category_id' => $catTI?->id,
                'name' => 'Transformação Digital e Automação de Processos',
                'short_description' => 'Implemente ferramentas modernas, reduza retrabalho e aumente a produtividade da sua equipe.',
                'description' => 'Aprenda na prática a escolher os melhores sistemas de gestão, integrar WhatsApp Business e automatizar tarefas repetitivas.',
                'price' => 45000.00,
                'duration_hours' => 16,
                'level' => 'beginner',
                'status' => 'published',
                'published_at' => now(),
            ]
        );
    }
}
