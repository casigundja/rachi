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
        $catTI = Category::where('slug', 'tecnologia-informacao')->first();
        if (!$catTI) {
            $catTI = Category::first();
        }

        $coursesData = [
            [
                'slug' => 'engenharia-social-institucional',
                'name' => 'Curso Especializado: Engenharia Social Institucional',
                'category_id' => $catTI?->id,
                'short_description' => 'Capacitar colaboradores e gestores a reconhecer e neutralizar ataques de engenharia social no ambiente institucional, fortalecendo a cultura de segurança organizacional.',
                'description' => 'Capacitação corporativa especializada focada no elo humano da segurança da informação. Aborda conceitos de manipulação psicológica, fraudes corporativas, engenharia social presencial e digital, governança e conformidade institucional.',
                'price' => 60000.00,
                'duration_hours' => 16,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Introdução à Engenharia Social',
                        'lessons' => [
                            ['title' => 'Conceitos Fundamentais e Anatomia dos Ataques', 'duration' => 45],
                            ['title' => 'Exemplos Reais e Riscos Institucionais e Regulamentares', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Táticas de Manipulação Psicológica',
                        'lessons' => [
                            ['title' => 'Phishing, Spear Phishing e Vishing na Prática', 'duration' => 60],
                            ['title' => 'Pretexting e Tailgating no Ambiente Corporativo', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 3 — Cenários Institucionais',
                        'lessons' => [
                            ['title' => 'Estudo de Casos Reais em Bancos e Seguradoras', 'duration' => 55],
                            ['title' => 'Incidentes em Órgãos Governamentais e Grandes Empresas', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 4 — Estratégias de Proteção',
                        'lessons' => [
                            ['title' => 'Políticas de Segurança da Informação e Gestão de Acessos', 'duration' => 50],
                            ['title' => 'Autenticação Multifator e Procedimentos de Validação Interna', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 5 — Simulações Práticas',
                        'lessons' => [
                            ['title' => 'Exercícios de Phishing Controlado em Ambiente Seguro', 'duration' => 60],
                            ['title' => 'Roleplays de Interação Suspeita e Protocolo de Resposta', 'duration' => 60],
                        ]
                    ]
                ]
            ]
        ];

        // Limpar cursos anteriores para manter apenas o solicitado
        CourseLesson::whereHas('module.course', function ($q) {
            $q->where('slug', '!=', 'engenharia-social-institucional');
        })->delete();

        CourseModule::whereHas('course', function ($q) {
            $q->where('slug', '!=', 'engenharia-social-institucional');
        })->delete();

        Course::where('slug', '!=', 'engenharia-social-institucional')->delete();

        foreach ($coursesData as $cData) {
            $modulesData = $cData['modules'] ?? [];
            unset($cData['modules']);

            $cData['business_unit_id'] = 3; // ACADEMY
            $cData['status'] = 'published';
            $cData['published_at'] = now();
            $cData['thumbnail'] = '/images/courses/engenharia-social.jpg';

            $course = Course::updateOrCreate(
                ['slug' => $cData['slug']],
                $cData
            );

            foreach ($modulesData as $mIndex => $m) {
                $lessonsData = $m['lessons'] ?? [];
                $mod = CourseModule::updateOrCreate(
                    [
                        'course_id' => $course->id,
                        'sort_order' => $mIndex + 1,
                    ],
                    [
                        'title' => $m['title'],
                        'description' => $m['title'],
                        'status' => 'active'
                    ]
                );

                foreach ($lessonsData as $lIndex => $l) {
                    CourseLesson::updateOrCreate(
                        [
                            'course_module_id' => $mod->id,
                            'sort_order' => $lIndex + 1,
                        ],
                        [
                            'title' => $l['title'],
                            'duration_minutes' => $l['duration'] ?? 45,
                            'status' => 'active'
                        ]
                    );
                }
            }
        }
    }
}
