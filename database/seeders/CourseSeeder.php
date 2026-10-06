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

        $coursesData = [
            [
                'slug' => 'ciberseguranca',
                'name' => 'Cibersegurança e Defesa Digital',
                'category_id' => $catTI?->id,
                'short_description' => 'Aprenda a prevenir ameaças cibernéticas, proteger infraestruturas críticas de dados e reforçar a segurança digital com práticas de mercado.',
                'description' => 'Programa intensivo de segurança ofensiva e defensiva. Aborda análise de vulnerabilidades, resposta a incidentes, normas ISO 27001, proteção de redes corporativas e conformidade regulamentar.',
                'price' => 75000.00,
                'duration_hours' => 36,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Fundamentos de Segurança e Ameaças Modernas',
                        'lessons' => [
                            ['title' => 'Aula 1: Anatomia de um Ataque Cibernético e Vetores de Risco', 'duration' => 50],
                            ['title' => 'Aula 2: Políticas de Segurança, Senhas e Gestão de Identidades', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Defesa de Redes e Resposta a Incidentes',
                        'lessons' => [
                            ['title' => 'Aula 3: Firewalls, VPNs e Monitoramento de Tráfego em Tempo Real', 'duration' => 60],
                            ['title' => 'Aula 4: Protocolos de Recuperação e Continuidade de Negócios', 'duration' => 55],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'competencias-digitais',
                'name' => 'Competências Digitais e Produtividade com IA',
                'category_id' => $catTI?->id,
                'short_description' => 'Capacitação no uso de ferramentas em nuvem, inteligência artificial e produtividade digital para se destacar no ambiente de trabalho moderno.',
                'description' => 'Capacitação prática em ferramentas essenciais do ecossistema digital corporativo: Google Workspace, Microsoft 365, automação no trabalho e técnicas de engenharia de prompts com IA generativa.',
                'price' => 45000.00,
                'duration_hours' => 20,
                'level' => 'beginner',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Ferramentas em Nuvem e Colaboração',
                        'lessons' => [
                            ['title' => 'Aula 1: Gestão de Documentos e Colaboração em Tempo Real', 'duration' => 40],
                            ['title' => 'Aula 2: Organização de Fluxos de Trabalho e Tarefas Digitais', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Inteligência Artificial para o Dia a Dia',
                        'lessons' => [
                            ['title' => 'Aula 3: Prompts Avançados para Pesquisa, Redação e Análise', 'duration' => 50],
                            ['title' => 'Aula 4: Criação de Apresentações e Relatórios com IA', 'duration' => 45],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'formacao-corporativa',
                'name' => 'Formação Corporativa e Liderança Executiva',
                'category_id' => $catGestao?->id,
                'short_description' => 'Soluções sob medida para capacitar equipas e lideranças empresariais, alinhando competências técnicas aos objectivos estratégicos da organização.',
                'description' => 'Programa executivo desenhado para gestores e diretores. Aborda liderança de alta performance, alinhamento cultural, governança corporativa e gestão de mudanças em cenários dinâmicos.',
                'price' => 95000.00,
                'duration_hours' => 40,
                'level' => 'advanced',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Planeamento Estratégico e Governança',
                        'lessons' => [
                            ['title' => 'Aula 1: Definição de OKRs e Metas de Alto Impacto', 'duration' => 60],
                            ['title' => 'Aula 2: Governança, Compliance e Gestão de Riscos', 'duration' => 55],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Liderança Inspiradora e Gestão de Mudanças',
                        'lessons' => [
                            ['title' => 'Aula 3: Condução de Equipas Multidisciplinares em Crise', 'duration' => 50],
                            ['title' => 'Aula 4: Comunicação Estratégica para o C-Level', 'duration' => 55],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'formacao-profissional',
                'name' => 'Formação Profissional para o Mercado de Trabalho',
                'category_id' => $catGestao?->id,
                'short_description' => 'Acelere a sua inserção no mercado de trabalho com programas práticos, projetos reais e certificação de alto valor para a sua carreira.',
                'description' => 'Desenvolvimento de competências comportamentais e técnicas indispensáveis: postura profissional, comunicação assertiva, resolução de problemas e preparação para processos de recrutamento.',
                'price' => 50000.00,
                'duration_hours' => 30,
                'level' => 'beginner',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Postura e Comunicação no Ambiente de Trabalho',
                        'lessons' => [
                            ['title' => 'Aula 1: Comunicação Interpessoal e Resolução de Conflitos', 'duration' => 45],
                            ['title' => 'Aula 2: Gestão do Tempo e Priorização de Demandas', 'duration' => 40],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Construção de Carreira e Empregabilidade',
                        'lessons' => [
                            ['title' => 'Aula 3: Criação de Portfólio Profissional e LinkedIn em Angola', 'duration' => 50],
                            ['title' => 'Aula 4: Simulação Prática de Entrevistas de Emprego', 'duration' => 55],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'gestao-empresarial',
                'name' => 'Gestão Empresarial Estratégica',
                'category_id' => $catGestao?->id,
                'short_description' => 'Domine finanças, operações, governança e estratégias de crescimento para gerir empresas com eficiência e sustentabilidade.',
                'description' => 'Visão holística da administração empresarial adaptada a Angola: controle financeiro, gestão tributária, precificação de produtos e escalabilidade comercial.',
                'price' => 80000.00,
                'duration_hours' => 32,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Finanças e Sustentabilidade Operacional',
                        'lessons' => [
                            ['title' => 'Aula 1: Fluxo de Caixa, DRE e Ponto de Equilíbrio', 'duration' => 60],
                            ['title' => 'Aula 2: Precificação Inteligente e Margens de Lucro', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Operações e Escala',
                        'lessons' => [
                            ['title' => 'Aula 3: Otimização de Processos Internos e Redução de Custos', 'duration' => 55],
                            ['title' => 'Aula 4: Indicadores de Desempenho (KPIs) para Tomada de Decisão', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'lideranca',
                'name' => 'Liderança e Gestão de Pessoas',
                'category_id' => $catGestao?->id,
                'short_description' => 'Desenvolva inteligência emocional, técnicas de delegação, motivação de equipas e comunicação assertiva para líderes modernos.',
                'description' => 'Formação prática para líderes de equipas: inteligência emocional, feedback construtivo, delegação eficaz e alinhamento de talentos com os objetivos corporativos.',
                'price' => 60000.00,
                'duration_hours' => 24,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — O Papel do Líder Contemporâneo',
                        'lessons' => [
                            ['title' => 'Aula 1: Da Gestão de Tarefas à Liderança de Pessoas', 'duration' => 45],
                            ['title' => 'Aula 2: Inteligência Emocional e Autogestão', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Desenvolvimento e Motivação de Equipas',
                        'lessons' => [
                            ['title' => 'Aula 3: Como Dar Feedbacks que Geram Mudanças Reais', 'duration' => 50],
                            ['title' => 'Aula 4: Delegação sem Perda de Controlo de Qualidade', 'duration' => 45],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'auditoria-sistemas',
                'name' => 'Auditoria de Sistemas e Conformidade TI',
                'category_id' => $catTI?->id,
                'short_description' => 'Técnicas de auditoria, conformidade regulamentar, análise de riscos e controles internos em ambientes de tecnologia.',
                'description' => 'Capacitação completa em auditoria de infraestruturas tecnológicas, testes de integridade, logs forenses e conformidade com normas locais e internacionais de proteção de dados.',
                'price' => 85000.00,
                'duration_hours' => 30,
                'level' => 'advanced',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Frameworks de Auditoria de TI',
                        'lessons' => [
                            ['title' => 'Aula 1: COBIT e Melhores Práticas de Governança', 'duration' => 55],
                            ['title' => 'Aula 2: Mapeamento de Riscos e Matriz de Vulnerabilidades', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Execução da Auditoria e Relatórios',
                        'lessons' => [
                            ['title' => 'Aula 3: Testes de Controles Gerais e de Aplicação (ITGC)', 'duration' => 60],
                            ['title' => 'Aula 4: Elaboração de Relatórios de Auditoria e Planos de Ação', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'automacao-digital-ia',
                'name' => 'Automação de Processos e Inteligência Artificial',
                'category_id' => $catTI?->id,
                'short_description' => 'Automatize tarefas repetitivas, implemente agentes inteligentes e aumente a produtividade da sua empresa usando IA moderna.',
                'description' => 'Aprenda a conectar plataformas (Zapier, Make, n8n) e integrar APIs de IA para automatizar funis de vendas, suporte ao cliente e emissão de relatórios sem necessidade de código complexo.',
                'price' => 70000.00,
                'duration_hours' => 28,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Arquitetura de Automação No-Code / Low-Code',
                        'lessons' => [
                            ['title' => 'Aula 1: Mapeamento de Gargalos e Escolha de Ferramentas', 'duration' => 50],
                            ['title' => 'Aula 2: Criação de Fluxos Automatizados com Webhooks e Gatilhos', 'duration' => 55],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Agentes de IA e Integrações Avançadas',
                        'lessons' => [
                            ['title' => 'Aula 3: Integração do ChatGPT e Claude em Processos Corporativos', 'duration' => 60],
                            ['title' => 'Aula 4: Automação de Atendimento e Triagem de Leads', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'gestao-projectos',
                'name' => 'Gestão de Projectos (Ágil & Tradicional)',
                'category_id' => $catGestao?->id,
                'short_description' => 'Metodologias Scrum, Kanban e PMBOK aplicadas a projectos reais, com controle de escopo, prazos, orçamentos e riscos.',
                'description' => 'Do planeamento inicial à entrega de valor contínuo. Aprenda a gerir cronogramas, prever riscos, mobilizar equipas e utilizar ferramentas modernas como Jira, Trello e Notion.',
                'price' => 65000.00,
                'duration_hours' => 26,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Metodologias Ágeis: Scrum e Kanban',
                        'lessons' => [
                            ['title' => 'Aula 1: Sprints, Backlogs e Cerimônias Ágeis na Prática', 'duration' => 50],
                            ['title' => 'Aula 2: Gestão Visual com Kanban e Limitação de Trabalho em Curso', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Gestão de Escopo, Custos e Stakeholders',
                        'lessons' => [
                            ['title' => 'Aula 3: Elaboração do Termo de Abertura e WBS (EAP)', 'duration' => 55],
                            ['title' => 'Aula 4: Monitoramento de Prazos e Gestão de Riscos do Projecto', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'atendimento-cliente',
                'name' => 'Excelência no Atendimento ao Cliente e Sucesso do Cliente',
                'category_id' => $catGestao?->id,
                'short_description' => 'Técnicas de atendimento humanizado, resolução de conflitos, retenção de clientes e métricas de satisfação (CSAT, NPS).',
                'description' => 'Como transformar o atendimento em um diferencial competitivo sustentável: escuta ativa, empatia corporativa, redução do tempo de resposta e fidelização no mercado angolano.',
                'price' => 40000.00,
                'duration_hours' => 18,
                'level' => 'beginner',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Comunicação Humanizada e Resolução Ágil',
                        'lessons' => [
                            ['title' => 'Aula 1: Os Pilares da Experiência do Cliente (Customer Experience)', 'duration' => 40],
                            ['title' => 'Aula 2: Como Lidar com Reclamações e Clientes Difíceis', 'duration' => 45],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Omnicanalidade e Métricas de Retenção',
                        'lessons' => [
                            ['title' => 'Aula 3: Atendimento Eficiente via WhatsApp, E-mail e Telefone', 'duration' => 45],
                            ['title' => 'Aula 4: Indicadores de Sucesso: NPS, CSAT e Taxa de Retenção', 'duration' => 40],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'vendas-b2b',
                'name' => 'Vendas B2B e Negociação Comercial',
                'category_id' => $catGestao?->id,
                'short_description' => 'Prospecção ativa, qualificação de leads, técnicas de fechamento e gestão de pipeline para vendas complexas.',
                'description' => 'Estratégias de vendas corporativas de alto valor: mapeamento de decisores, metodologia SPIN Selling, propostas irresistíveis e técnicas de negociação win-win.',
                'price' => 55000.00,
                'duration_hours' => 22,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Prospecção e Qualificação Estratégica',
                        'lessons' => [
                            ['title' => 'Aula 1: Definição do Perfil de Cliente Ideal (ICP) em Angola', 'duration' => 45],
                            ['title' => 'Aula 2: Técnicas de Abordagem a Decisores (Cold Outreach)', 'duration' => 50],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Negociação e Fechamento de Contratos',
                        'lessons' => [
                            ['title' => 'Aula 3: Superação de Objeções de Preço e Concorrência', 'duration' => 50],
                            ['title' => 'Aula 4: Estruturação de Propostas Comerciais Vencedoras', 'duration' => 45],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'contabilidade-fiscalidade',
                'name' => 'Contabilidade Prática e Fiscalidade em Angola',
                'category_id' => $catGestao?->id,
                'short_description' => 'Impostos angolanos (IVA, IRT, II), apuração tributária, fecho de contas e conformidade com a AGT.',
                'description' => 'Guia prático para contabilistas e empresários: legislação tributária angolana atualizada, retenções na fonte, submissão de mapas fiscais no portal da AGT e organização contábil preventiva.',
                'price' => 75000.00,
                'duration_hours' => 35,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Sistema Tributário Angolano na Prática',
                        'lessons' => [
                            ['title' => 'Aula 1: Regime do IVA: Apuração, Isenções e Reembolsos', 'duration' => 60],
                            ['title' => 'Aula 2: IRT e Segurança Social (INSS): Folha de Pagamentos', 'duration' => 55],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Obrigações Fiscais e Fecho do Exercício',
                        'lessons' => [
                            ['title' => 'Aula 3: Imposto Industrial (II) e Pagamentos Provisórios', 'duration' => 60],
                            ['title' => 'Aula 4: Prestação de Contas e Preparação para Inspeções da AGT', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'gestao-estruturacao-mpme',
                'name' => 'Gestão e Estruturação Prática de MPMEs em Angola',
                'category_id' => $catGestao?->id,
                'short_description' => 'Aprenda a organizar processos administrativos, finanças básicas e conformidade tributária para crescer com solidez.',
                'description' => 'Curso completo e focado no mercado angolano. O programa aborda desde a organização societária e contábil até a digitalização das vendas e fidelização de clientes.',
                'price' => 65000.00,
                'duration_hours' => 24,
                'level' => 'intermediate',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Fundação e Regularização do Negócio',
                        'lessons' => [
                            ['title' => 'Aula 1: Do Informal ao Formal — Primeiros Passos em Angola', 'duration' => 45],
                            ['title' => 'Aula 2: Planeamento Financeiro e Fluxo de Caixa Essencial', 'duration' => 60],
                        ]
                    ],
                    [
                        'title' => 'Módulo 2 — Gestão Operacional e Pessoas',
                        'lessons' => [
                            ['title' => 'Aula 3: Como Contratar e Manter Bons Profissionais', 'duration' => 50],
                        ]
                    ]
                ]
            ],
            [
                'slug' => 'transformacao-digital-para-empresas',
                'name' => 'Transformação Digital e Automação de Processos',
                'category_id' => $catTI?->id,
                'short_description' => 'Implemente ferramentas modernas, reduza retrabalho e aumente a produtividade da sua equipe.',
                'description' => 'Aprenda na prática a escolher os melhores sistemas de gestão, integrar WhatsApp Business e automatizar tarefas repetitivas.',
                'price' => 45000.00,
                'duration_hours' => 16,
                'level' => 'beginner',
                'modules' => [
                    [
                        'title' => 'Módulo 1 — Diagnóstico Digital da Empresa',
                        'lessons' => [
                            ['title' => 'Aula 1: Identificação de Processos Manuais e Ineficientes', 'duration' => 45],
                            ['title' => 'Aula 2: Ferramentas Gratuitas e de Baixo Custo para Começar', 'duration' => 50],
                        ]
                    ]
                ]
            ]
        ];

        foreach ($coursesData as $cData) {
            $modulesData = $cData['modules'] ?? [];
            unset($cData['modules']);

            $cData['business_unit_id'] = 3; // ACADEMY
            $cData['status'] = 'published';
            $cData['published_at'] = now();

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
