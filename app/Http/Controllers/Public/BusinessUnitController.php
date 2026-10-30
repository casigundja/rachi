<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Service;
use App\Models\Product;
use App\Models\Course;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestStatusHistory;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BusinessUnitController extends Controller
{
    public function tec(): View
    {
        $unit = BusinessUnit::where('slug', 'tec')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $products = Product::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $tecServices = self::getTecServices();

        return view('public.units.tec', compact('unit', 'services', 'products', 'tecServices'));
    }

    public function tecService(string $slug): View
    {
        $unit = BusinessUnit::where('slug', 'tec')->firstOrFail();
        $tecServices = self::getTecServices();

        $service = collect($tecServices)->firstWhere('slug', $slug);
        if (!$service) {
            abort(404);
        }

        $otherServices = collect($tecServices)->where('slug', '!=', $slug)->values()->all();

        return view('public.units.tec-service', compact('unit', 'service', 'otherServices', 'tecServices'));
    }

    public function print(): View
    {
        $unit = BusinessUnit::where('slug', 'print')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $products = Product::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $printServices = self::getPrintServices();

        return view('public.units.print', compact('unit', 'services', 'products', 'printServices'));
    }

    public function printService(string $slug): View
    {
        $unit = BusinessUnit::where('slug', 'print')->firstOrFail();
        $printServices = self::getPrintServices();

        $service = collect($printServices)->firstWhere('slug', $slug);
        if (!$service) {
            abort(404);
        }

        $otherServices = collect($printServices)->where('slug', '!=', $slug)->values()->all();

        return view('public.units.print-service', compact('unit', 'service', 'otherServices', 'printServices'));
    }

    public function requestQuote(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:40',
            'produto' => 'required|string|max:255',
            'linha' => 'nullable|string|max:255',
            'service_slug' => 'nullable|string|max:100',
            'empresa' => 'nullable|string|max:255',
            'quantidade' => 'nullable|string|max:100',
            'prazo' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:3000',
        ]);

        return DB::transaction(function () use ($validated, $request) {
            // 1. Identificar ou criar utilizador
            $printUnit = BusinessUnit::where('slug', 'print')->firstOrFail();
            if (auth()->check() && strcasecmp(auth()->user()->email, $validated['email']) === 0) {
                $user = auth()->user();
            } else {
                $user = User::where('email', $validated['email'])->first();
                if (!$user) {
                    $user = User::create([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'phone' => $validated['phone'],
                        'password' => bcrypt(Str::random(16)),
                        'role_id' => \App\Models\Role::where('slug', 'customer')->firstOrFail()->id,
                        'status' => 'active',
                    ]);
                }
            }

            // 2. Identificar ou criar cliente (Customer)
            $customer = $user->customer ?? Customer::where('user_id', $user->id)->first();
            $hasCompany = !empty($validated['empresa']);
            if (!$customer) {
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'type' => $hasCompany ? 'company' : 'individual',
                    'company_name' => $validated['empresa'] ?? null,
                    'trade_name' => $validated['empresa'] ?? $validated['name'],
                    'phone' => $validated['phone'],
                    'whatsapp' => $validated['phone'],
                    'status' => 'active',
                ]);
            } else {
                if ($hasCompany && empty($customer->company_name)) {
                    $customer->update([
                        'company_name' => $validated['empresa'],
                        'type' => 'company',
                    ]);
                }
                if (empty($customer->phone)) {
                    $customer->update([
                        'phone' => $validated['phone'],
                        'whatsapp' => $validated['phone'],
                    ]);
                }
            }

            // 3. Gerar protocolo único anual
            $year = date('Y');
            $protocol = 'TMP-' . Str::uuid();

            // 4. Mapear prioridade de acordo com urgência
            $urgencia = strtolower($validated['prazo'] ?? 'padrao');
            $priority = match ($urgencia) {
                'urgente', 'urgencia', 'alta' => 'urgent',
                default => 'normal',
            };

            // 5. Montar descrição detalhada com todas as especificações
            $prazosLabels = [
                'padrao' => 'Prazo Normal (3 a 5 dias úteis)',
                'urgente' => 'Urgência Expresso (24h a 48h úteis)',
                'programado' => 'Entrega Programada (Evento futuro)',
            ];
            $prazoFormatado = $prazosLabels[$urgencia] ?? ($validated['prazo'] ?? 'Normal');

            $descLines = [
                '📦 Produto: ' . $validated['produto'],
            ];
            if (!empty($validated['linha'])) {
                $descLines[] = '🏷️ Linha Gráfica: ' . $validated['linha'];
            }
            $descLines[] = '👤 Solicitante: ' . $validated['name'];
            if (!empty($validated['empresa'])) {
                $descLines[] = '🏢 Empresa: ' . $validated['empresa'];
            }
            $descLines[] = '📞 Telefone / WhatsApp: ' . $validated['phone'];
            $descLines[] = '✉️ Email: ' . $validated['email'];
            if (!empty($validated['quantidade'])) {
                $descLines[] = '🔢 Quantidade Estimada: ' . $validated['quantidade'];
            }
            $descLines[] = '⏱️ Prazo Desejado: ' . $prazoFormatado;
            if (!empty($validated['message'])) {
                $descLines[] = "\n📝 Especificações & Detalhes:\n" . $validated['message'];
            }

            $description = implode("\n", $descLines);

            // 6. Associar serviço se possível (RACHI Print é unit 2)
            $serviceId = null;
            if (!empty($validated['service_slug'])) {
                $serviceId = Service::where('business_unit_id', $printUnit->id)
                    ->where('slug', $validated['service_slug'])
                    ->value('id');
            }

            // 7. Criar a ServiceRequest
            $serviceRequest = ServiceRequest::create([
                'protocol' => $protocol,
                'customer_id' => $customer->id,
                'business_unit_id' => $printUnit->id,
                'service_id' => $serviceId,
                'title' => Str::limit('Cotação Gráfica: ' . $validated['produto'], 255, ''),
                'description' => $description,
                'priority' => $priority,
                'status' => 'new',
                'requested_date' => now()->toDateString(),
                'estimated_date' => now()->addDays($priority === 'urgent' ? 2 : 5)->toDateString(),
            ]);

            $protocol = sprintf('SOL-%s-%06d', $year, $serviceRequest->id);
            $serviceRequest->update(['protocol' => $protocol]);

            // 8. Histórico inicial
            ServiceRequestStatusHistory::create([
                'service_request_id' => $serviceRequest->id,
                'user_id' => $user->id,
                'old_status' => null,
                'new_status' => 'new',
                'comment' => "Solicitação de cotação enviada pelo catálogo online ({$validated['produto']})",
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => "Solicitação de cotação registada com sucesso! O seu número de protocolo é {$protocol}.",
                'protocol' => $protocol,
                'request_id' => $serviceRequest->id,
                'produto' => $validated['produto'],
            ]);
        });
    }

    public function academy(): View
    {
        $unit = BusinessUnit::where('slug', 'academy')->firstOrFail();
        $courses = Course::where('business_unit_id', $unit->id)->where('status', 'published')->with('modules.lessons')->get();

        return view('public.units.academy', compact('unit', 'courses'));
    }

    public function capital(): View
    {
        $unit = BusinessUnit::where('slug', 'capital')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $capitalServices = self::getCapitalServices();

        return view('public.units.capital', compact('unit', 'services', 'capitalServices'));
    }

    public function capitalService(string $slug): View
    {
        $unit = BusinessUnit::where('slug', 'capital')->firstOrFail();
        $capitalServices = self::getCapitalServices();

        $service = collect($capitalServices)->firstWhere('slug', $slug);
        if (!$service) {
            abort(404);
        }

        $otherServices = collect($capitalServices)->where('slug', '!=', $slug)->values()->all();

        return view('public.units.capital-service', compact('unit', 'service', 'otherServices', 'capitalServices'));
    }

    public static function getCapitalServices(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'cedencia-temporaria',
                'num' => '01',
                'tag' => '01 • GESTÃO DE TALENTOS',
                'title' => 'Cedência temporária de trabalhadores',
                'short_desc' => 'Disponibilização temporária de trabalhadores qualificados para a sua empresa.',
                'full_desc' => 'Disponibilizamos profissionais rigorosamente avaliados e contratados pela RACHI para alocação temporária em empresas de diversos segmentos em Angola. Ideal para demandas sazonais, projetos pontuais, substituições de licenças ou reforço da sua equipa sem encargos de rescisão contratual nem passivos laborais.',
                'icon' => 'users',
                'image' => 'images/services/service-cedencia-temporaria.jpg',
                'color' => 'emerald',
                'starting_price' => '85.000 Kz',
                'price_period' => '/mês por trabalhador',
                'cta_label' => 'Solicitar Cedência',
                'prazo' => '3 a 7 dias úteis para colocação',
                'garantia' => 'Substituição em 48h sem custo adicional',
                'bullets' => [
                    'Profissionais qualificados',
                    'Processo ágil e flexível',
                    'Conformidade legal garantida'
                ],
                'includes' => [
                    'Triagem, avaliação técnica e comportamental prévia de cada candidato',
                    'Gestão integral do processamento salarial, IRT e encargos sociais obrigatórios',
                    'Seguro de acidentes de trabalho e saúde ocupacional a cargo da RACHI',
                    'Substituição rápida e sem custos em até 48h úteis em caso de desajuste',
                    'Contrato juridicamente blindado em total harmonia com a Lei Geral do Trabalho de Angola',
                    'Acompanhamento contínuo e relatórios periódicos de assiduidade e desempenho'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Levantamento de Perfil', 'desc' => 'Definição detalhada das competências técnicas, experiência e número de colaboradores necessários.'],
                    ['num' => '02', 'title' => 'Triagem & Seleção', 'desc' => 'Entrevistas, checagem curricular e validação prática do banco de talentos RACHI.'],
                    ['num' => '03', 'title' => 'Contratação & Onboarding', 'desc' => 'Tratamento de toda a documentação legal, exames médicos de admissão e alocação imediata.'],
                    ['num' => '04', 'title' => 'Gestão & Acompanhamento', 'desc' => 'Suporte administrativo mensal, gestão de folha e monitoramento contínuo de resultados.']
                ],
                'plans' => [
                    ['name' => 'Operacional & Suporte', 'price' => '85.000 Kz', 'period' => '/mês por trabalhador', 'desc' => 'Auxiliares, recepcionistas, operadores de loja, motoristas e apoio geral.', 'popular' => false, 'features' => ['Folha de vencimento gerida', 'Seguro de acidentes de trabalho', 'Substituição em 48h', 'Apoio administrativo mensal']],
                    ['name' => 'Técnico & Especializado', 'price' => '195.000 Kz', 'period' => '/mês por trabalhador', 'desc' => 'Técnicos de TI, contabilidade, secretariado executivo, supervisores e vendas.', 'popular' => true, 'features' => ['Perfil técnico rigorosamente validado', 'Seguro e medicina no trabalho', 'Gestão fiscal e tributária', 'Garantia de retenção', 'Substituição prioritária']],
                    ['name' => 'Cargos de Gestão / Executivos', 'price' => 'Sob Cotação', 'period' => 'orçamento à medida', 'desc' => 'Gestores de projeto, coordenadores de RH e especialistas seniores.', 'popular' => false, 'features' => ['Headhunting especializado', 'Assessoria executiva dedicada', 'Cláusulas de confidencialidade', 'SLA prioritário contínuo']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar informações e cotação para o serviço de Cedência temporária de trabalhadores da RACHI Human Capital.'
            ],
            [
                'id' => 2,
                'slug' => 'constituicao-legalizacao-empresas',
                'num' => '02',
                'tag' => '02 • LEGALIZAÇÃO',
                'title' => 'Constituição e legalização de empresas',
                'short_desc' => 'Apoio completo na constituição e legalização da sua empresa.',
                'full_desc' => 'Processo completo de abertura e legalização de sociedades comerciais em Angola. Cuidamos de toda a tramitação burocrática junto do Guichet Único da Empresa (GUE), Conservatórias, AGT e Inspecção Geral do Trabalho, assegurando o início de atividade com segurança jurídica absoluta.',
                'icon' => 'building-2',
                'image' => 'images/services/service-constituicao-empresas.jpg',
                'color' => 'blue',
                'starting_price' => '185.000 Kz',
                'price_period' => 'taxa única',
                'cta_label' => 'Legalizar Empresa',
                'prazo' => '5 a 12 dias úteis',
                'garantia' => 'Acompanhamento até à publicação oficial',
                'bullets' => [
                    'Acompanhamento completo',
                    'Documentação incluída',
                    'Prazos reduzidos'
                ],
                'includes' => [
                    'Certificado de Admissibilidade de Firma no Ficheiro Central de Denominações',
                    'Elaboração e validação de Estatutos e Pacto Social sob medida',
                    'Certidão de Registo Comercial no Guichet Único da Empresa (GUE)',
                    'Atribuição de NIF definitivo junto da AGT e enquadramento fiscal',
                    'Comunicação oficial de Início de Atividade na Inspecção Geral do Trabalho (IGT)',
                    'Encaminhamento e publicação no Diário da República (III Série)'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Reserva de Nome & Objeto', 'desc' => 'Solicitação e obtenção do Certificado de Admissibilidade de Firma no Guichet.'],
                    ['num' => '02', 'title' => 'Elaboração do Pacto Social', 'desc' => 'Redação dos estatutos societários personalizados de acordo com as metas dos sócios.'],
                    ['num' => '03', 'title' => 'Registo Comercial & NIF', 'desc' => 'Inscrição comercial, emissão da Certidão Comercial e registo cadastral na AGT.'],
                    ['num' => '04', 'title' => 'Publicação & Ativação', 'desc' => 'Diário da República e comunicação formal do início de atividade junto da IGT.']
                ],
                'plans' => [
                    ['name' => 'Sociedade Unipessoal', 'price' => '185.000 Kz', 'period' => 'taxa única', 'desc' => 'Para empreendedores individuais que pretendem formalizar o seu negócio.', 'popular' => false, 'features' => ['Certidão de Admissibilidade', 'Pacto Social Unipessoal', 'NIF AGT e Registo Comercial', 'Comunicação IGT']],
                    ['name' => 'Sociedade por Quotas (Lda)', 'price' => '245.000 Kz', 'period' => 'taxa única', 'desc' => 'Ideal para 2 ou mais sócios. Inclui pacote completo de constituição e legalização.', 'popular' => true, 'features' => ['Pacto Social complexo e personalizado', 'Registo Comercial GUE', 'NIF definitivo e enquadramento fiscal', 'Publicação no Diário da República', 'Apoio bancário para abertura de conta']],
                    ['name' => 'Sociedade Anónima (S.A.) & Filiais', 'price' => '480.000 Kz', 'period' => 'taxa única', 'desc' => 'Para projetos corporativos de grande porte, consórcios e filiais de empresas estrangeiras.', 'popular' => false, 'features' => ['Estrutura com Conselho de Administração', 'Fiscal Único / Auditoria', 'Licenciamento de investimento estrangeiro', 'SLA prioritário dedicado']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação e assessoria para a Constituição e Legalização de Empresa com a RACHI Human Capital.'
            ],
            [
                'id' => 3,
                'slug' => 'consultoria-recursos-humanos',
                'num' => '03',
                'tag' => '03 • ESTRATÉGIA RH',
                'title' => 'Consultoria em recursos humanos',
                'short_desc' => 'Consultoria especializada em gestão de pessoas e organizações.',
                'full_desc' => 'Intervenções estratégicas para potencializar o capital humano da sua organização. Desenvolvemos diagnósticos organizacionais, desenho de organigramas funcionais, planos de carreiras e salários (PCR), políticas internas de conduta e sistemas modernos de avaliação de desempenho.',
                'icon' => 'briefcase',
                'image' => 'images/services/service-consultoria-rh.jpg',
                'color' => 'purple',
                'starting_price' => '150.000 Kz',
                'price_period' => 'intervenção pontual',
                'cta_label' => 'Consultoria em RH',
                'prazo' => 'Diagnóstico em 10 dias úteis',
                'garantia' => 'Metodologia comprovada e alinhada à LGT',
                'bullets' => [
                    'Diagnóstico personalizado',
                    'Estratégias eficazes',
                    'Melhoria contínua'
                ],
                'includes' => [
                    'Auditoria de conformidade com a Lei Geral do Trabalho (LGT)',
                    'Estruturação de Organigrama e Descritivo Formal de Funções',
                    'Desenho do Plano de Cargos, Carreiras e Remunerações (PCR)',
                    'Elaboração de Manual do Colaborador e Políticas de Conduta',
                    'Implementação de Avaliação de Desempenho e Metas (KPIs & OKRs)',
                    'Sessões de mentoria executiva para lideranças e equipas de RH'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Diagnóstico Inicial', 'desc' => 'Mapeamento do clima, processos internos e conformidade com a legislação laboral vigente.'],
                    ['num' => '02', 'title' => 'Desenho Estratégico', 'desc' => 'Estruturação dos organigramas, funções, matriz de competências e faixas salariais.'],
                    ['num' => '03', 'title' => 'Implementação de Processos', 'desc' => 'Apresentação dos manuais, políticas internas e ferramentas de avaliação.'],
                    ['num' => '04', 'title' => 'Capacitação & Monitoramento', 'desc' => 'Formação de líderes e acompanhamento das métricas de retenção e produtividade.']
                ],
                'plans' => [
                    ['name' => 'Diagnóstico Organizacional', 'price' => '150.000 Kz', 'period' => 'intervenção pontual', 'desc' => 'Raio-X completo dos processos de RH com relatório de recomendações executivas.', 'popular' => false, 'features' => ['Auditoria de conformidade LGT', 'Mapeamento de riscos trabalhistas', 'Relatório executivo de gaps', 'Recomendações prioritárias']],
                    ['name' => 'Plano de Cargos & Salários (PCR)', 'price' => '320.000 Kz', 'period' => 'projeto completo', 'desc' => 'Estruturação técnico-remuneratória para atrair, motivar e reter talentos chave.', 'popular' => true, 'features' => ['Descritivos de funções detalhados', 'Tabela de bandas salariais de mercado', 'Critérios claros de progressão na carreira', 'Manual de políticas de remuneração', 'Apresentação aos gestores']],
                    ['name' => 'Assessoria Mensal (Retainer RH)', 'price' => '190.000 Kz', 'period' => '/mês', 'desc' => 'Direção de RH externa contínua com reuniões periódicas e suporte jurídico-laboral.', 'popular' => false, 'features' => ['Consultor sênior dedicado', 'Apoio em processos disciplinares', 'Triagem de vagas estratégicas', 'Reuniões mensais com a administração']]
                ],
                'whatsapp_msg' => 'Olá! Tenho interesse no serviço de Consultoria em Recursos Humanos da RACHI Human Capital e gostaria de receber uma proposta.'
            ],
            [
                'id' => 4,
                'slug' => 'organizacao-contabilidade',
                'num' => '04',
                'tag' => '04 • FINANÇAS & CONTAS',
                'title' => 'Organização de contabilidade',
                'short_desc' => 'Organização documental e apoio completo à gestão contabilística.',
                'full_desc' => 'Serviço contínuo ou pontual de contabilidade geral e analítica, em conformidade com o Plano Geral de Contabilidade de Angola (PGC) e as obrigações da Administração Geral Tributária (AGT). Proporcionamos clareza financeira, conformidade fiscal e tranquilidade à sua gestão.',
                'icon' => 'calculator',
                'image' => 'images/services/service-organizacao-contabilidade.jpg',
                'color' => 'amber',
                'starting_price' => '95.000 Kz',
                'price_period' => '/mês',
                'cta_label' => 'Organizar Contabilidade',
                'prazo' => 'Fechamento até ao dia 15 de cada mês',
                'garantia' => 'Supervisão de Contabilista Certificado',
                'bullets' => [
                    'Contabilidade organizada',
                    'Relatórios precisos',
                    'Apoio contínuo'
                ],
                'includes' => [
                    'Classificação, conferência e lançamento sistemático de documentos',
                    'Apuramento e submissão mensal das declarações de IVA e IRT',
                    'Emissão de balancetes mensais analíticos e mapas de exploração',
                    'Reconciliação bancária periódica e controlo de amortizações',
                    'Preparação de Relatório de Gestão e Contas Anual para a AGT',
                    'Assinatura técnica por Perito Contabilista habilitado'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Recolha Documental', 'desc' => 'Organização e classificação de facturas de compras, vendas, extratos e recibos.'],
                    ['num' => '02', 'title' => 'Lançamento & Reconciliação', 'desc' => 'Escrituração no software certificado e reconciliação bancária minuciosa.'],
                    ['num' => '03', 'title' => 'Obrigações Fiscais (AGT)', 'desc' => 'Cálculo de IVA, IRT, Imposto do Selo e retenções na fonte com submissão tempestiva.'],
                    ['num' => '04', 'title' => 'Relatórios de Gestão', 'desc' => 'Disponibilização de balancetes mensais e demonstrações de resultados para a diretoria.']
                ],
                'plans' => [
                    ['name' => 'Microempresa (Simplificado)', 'price' => '95.000 Kz', 'period' => '/mês', 'desc' => 'Para empresas até 5 colaboradores com volume moderado de facturação.', 'popular' => false, 'features' => ['Classificação e lançamento de facturas', 'Apuramento de impostos mensais', 'Balancete trimestral', 'Suporte fiscal por email/WhatsApp']],
                    ['name' => 'PME (Regime Geral - IVA)', 'price' => '180.000 Kz', 'period' => '/mês', 'desc' => 'Apuramento periódico de IVA, balancetes mensais analíticos e fecho anual de contas.', 'popular' => true, 'features' => ['Declaração periódica de IVA', 'Submissão de mapa de amortizações', 'Balancetes mensais analíticos', 'Dossier fiscal completo para a AGT', 'Assinatura por Perito Contabilista']],
                    ['name' => 'Reconstrução de Contabilidade', 'price' => '350.000 Kz', 'period' => 'por exercício fiscal', 'desc' => 'Regularização e fecho de exercícios contabilísticos em atraso com auditoria prévia.', 'popular' => false, 'features' => ['Auditoria documental de exercícios passados', 'Reconstrução integral da escrita', 'Retificação de declarações fiscais', 'Emissão do Relatório e Contas']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de uma cotação para o serviço de Organização de Contabilidade da RACHI Human Capital.'
            ],
            [
                'id' => 5,
                'slug' => 'registo-inss',
                'num' => '05',
                'tag' => '05 • SEGURANÇA SOCIAL',
                'title' => 'Registo no INSS',
                'short_desc' => 'Apoio no registo de empresas e trabalhadores no INSS.',
                'full_desc' => 'Regularização e gestão cadastral junto do Instituto Nacional de Segurança Social (INSS). Asseguramos a inscrição da entidade empregadora, o registo de todos os colaboradores e a emissão correta das guias de pagamento mensais, evitando coimas e sanções administrativas.',
                'icon' => 'shield-check',
                'image' => 'images/services/service-registo-inss.jpg',
                'color' => 'sky',
                'starting_price' => '65.000 Kz',
                'price_period' => 'inscrição inicial',
                'cta_label' => 'Registar no INSS',
                'prazo' => '3 a 5 dias úteis',
                'garantia' => 'Emissão de comprovativos oficiais do INSS',
                'bullets' => [
                    'Registo simplificado',
                    'Conformidade assegurada',
                    'Acompanhamento dedicado'
                ],
                'includes' => [
                    'Registo e atribuição de Número de Contribuinte INSS da empresa',
                    'Inscrição e emissão de cartões/números de segurado dos funcionários',
                    'Parametrização e acesso ao portal digital do INSS',
                    'Geração das folhas de remuneração e guias de pagamento (8% + 3%)',
                    'Tratamento de processos de reforma, subsídios e licenças médicas',
                    'Emissão da Certidão de Não Devedor do INSS para concorrências'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Reunião de Documentos', 'desc' => 'Coleta da certidão comercial, NIF e BI dos trabalhadores e sócios-gerentes.'],
                    ['num' => '02', 'title' => 'Inscrição da Entidade', 'desc' => 'Registo formal da entidade empregadora e validação nos serviços do INSS.'],
                    ['num' => '03', 'title' => 'Registo dos Trabalhadores', 'desc' => 'Inscrição individual de cada colaborador e geração do número de segurado.'],
                    ['num' => '04', 'title' => 'Emissão de Guias & Certidão', 'desc' => 'Processamento da folha inicial de remunerações e obtenção da certidão de quitação.']
                ],
                'plans' => [
                    ['name' => 'Inscrição Inicial (até 5 trabalhadores)', 'price' => '65.000 Kz', 'period' => 'taxa única', 'desc' => 'Inscrição da empresa e primeiro lote de trabalhadores no INSS.', 'popular' => false, 'features' => ['Número de contribuinte da empresa', 'Inscrição de até 5 colaboradores', 'Acesso ao portal digital do INSS', 'Emissão da 1ª guia de pagamento']],
                    ['name' => 'Inscrição Corporativa (até 20 colaboradores)', 'price' => '110.000 Kz', 'period' => 'taxa única', 'desc' => 'Registo massivo com conferência de documentação individual e emissão de cartões.', 'popular' => true, 'features' => ['Inscrição de até 20 funcionários', 'Regularização de pendências de registo', 'Parametrização no portal do INSS', 'Certidão de Não Devedor incluída']],
                    ['name' => 'Gestão Mensal de Guias & Folhas', 'price' => '45.000 Kz', 'period' => '/mês', 'desc' => 'Submissão mensal das declarações de remunerações e guias de pagamento.', 'popular' => false, 'features' => ['Submissão da folha mensal de salários', 'Geração pontual da guia de 11%', 'Tratamento de admissões e baixas', 'Acompanhamento de benefícios dos trabalhadores']]
                ],
                'whatsapp_msg' => 'Olá! Preciso de apoio para o Registo e Regularização no INSS com a RACHI Human Capital.'
            ],
            [
                'id' => 6,
                'slug' => 'regularizacao-documental',
                'num' => '06',
                'tag' => '06 • COMPLIANCE & ARQUIVO',
                'title' => 'Regularização documental empresarial',
                'short_desc' => 'Apoio na organização e regularização documental da sua empresa.',
                'full_desc' => 'Auditoria e renovação de licenças, emissão de Alvarás Comerciais pelo SILAC/MINDCOM, obtenção de certidões fiscais e organização física/digital do arquivo documental da sua sociedade para que esteja sempre preparada para auditorias, financiamentos ou concorrências públicas.',
                'icon' => 'file-check-2',
                'image' => 'images/services/service-regularizacao-documental.jpg',
                'color' => 'teal',
                'starting_price' => '120.000 Kz',
                'price_period' => 'taxa única',
                'cta_label' => 'Regularizar Documentos',
                'prazo' => '5 a 15 dias úteis (conforme entidade emissora)',
                'garantia' => 'Emissão oficial pelos órgãos competentes',
                'bullets' => [
                    'Documentação completa',
                    'Regularização rápida',
                    'Evite complicações legais'
                ],
                'includes' => [
                    'Auditoria prévia de conformidade documental e passivos burocráticos',
                    'Emissão e Renovação de Alvará Comercial e Licenças Específicas',
                    'Emissão de Certidão de Não Devedor da AGT (Quitação Fiscal)',
                    'Legalização de Livro de Reclamações oficial da empresa',
                    'Digitalização, catalogação e guarda segura na nuvem dos dossiers',
                    'Acompanhamento de fiscalizações e notificações de órgãos estatais'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Auditoria & Levantamento', 'desc' => 'Inspeção minuciosa de certidões, alvarás, cadastros e licenças da sociedade.'],
                    ['num' => '02', 'title' => 'Plano de Regularização', 'desc' => 'Elaboração do roteiro de saneamento de pendências junto de cada órgão estatal.'],
                    ['num' => '03', 'title' => 'Submissão nos Portais Oficiais', 'desc' => 'Tramitação presencial e digital no SILAC, MINDCOM, AGT e Governos Provinciais.'],
                    ['num' => '04', 'title' => 'Entrega do Dossier & Arquivo', 'desc' => 'Entrega física encadernada e disponibilização do acervo digital seguro em nuvem.']
                ],
                'plans' => [
                    ['name' => 'Emissão / Renovação de Alvará', 'price' => '120.000 Kz', 'period' => 'taxa única', 'desc' => 'Tramitação completa no sistema SILAC com acompanhamento presencial.', 'popular' => false, 'features' => ['Classificação da atividade comercial', 'Submissão e pagamento de taxas no SILAC', 'Acompanhamento de vistoria', 'Emissão do Alvará definitivo']],
                    ['name' => 'Dossier Completo de Regularização', 'price' => '220.000 Kz', 'period' => 'pacote integrado', 'desc' => 'Alvará Comercial + Certidão AGT + Quitação INSS + Livro de Reclamações.', 'popular' => true, 'features' => ['Emissão/Renovação de Alvará SILAC', 'Certidão de Não Devedor AGT', 'Declaração de Quitação INSS', 'Livro de Reclamações autenticado', 'Certificado de conformidade RACHI']],
                    ['name' => 'Organização de Arquivo Corporativo', 'price' => '160.000 Kz', 'period' => 'projeto inicial', 'desc' => 'Classificação física e digitalização indexada de todos os documentos da empresa.', 'popular' => false, 'features' => ['Higienização e indexação de pastas físicas', 'Digitalização em alta resolução', 'Repositório em nuvem estruturado por setores', 'Manual de gestão documental']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de informações sobre o serviço de Regularização Documental Empresarial da RACHI Human Capital.'
            ]
        ];
    }

    public static function getTecServices(): array
    {
        return [
            [
                'id' => 1,
                'slug' => 'consultoria-transformacao-digital',
                'num' => '01',
                'tag' => '01 • ESTRATÉGIA',
                'title' => 'Consultoria em transformação digital',
                'short_desc' => 'Apoio estratégico para modernizar a empresa com tecnologia, processos e cultura digital.',
                'full_desc' => 'Consultoria especializada para impulsionar a transição tecnológica e inovação da sua empresa em Angola. Analisamos detalhadamente a infraestrutura existente, fluxos de trabalho e maturidade digital para criar um roteiro prático e faseado que elimina custos operacionais desnecessários e maximiza a produtividade da sua equipa.',
                'icon' => 'compass',
                'image' => 'images/services/service-consultoria-transformacao-digital.jpg',
                'color' => 'sky',
                'starting_price' => '120.000 Kz',
                'price_period' => 'projeto base',
                'cta_label' => 'Solicitar Consultoria',
                'prazo' => '10 a 20 dias úteis',
                'garantia' => 'Roadmap executivo detalhado e plano de ROI',
                'bullets' => [
                    'Roteiro de transformação',
                    'Priorização de investimentos',
                    'Acompanhamento da implementação'
                ],
                'includes' => [
                    'Diagnóstico aprofundado de maturidade digital e auditoria de infraestrutura técnica',
                    'Mapeamento de estrangulamentos operacionais e oportunidades imediatas de automação',
                    'Elaboração do Roteiro Tecnológico Estratégico (Roadmap de 6 a 18 meses)',
                    'Seleção e recomendação imparcial de softwares, serviços em nuvem e hardware',
                    'Plano estruturado de capacitação e gestão de mudança para os colaboradores',
                    'Relatório executivo para a administração com indicadores-chave de retorno (KPIs)'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Diagnóstico & Imersão', 'desc' => 'Entrevistas executivas com a liderança e auditoria dos sistemas e rotinas atuais.'],
                    ['num' => '02', 'title' => 'Mapeamento de Oportunidades', 'desc' => 'Identificação de redundâncias manuais e desenho da arquitetura digital ideal.'],
                    ['num' => '03', 'title' => 'Entrega do Roadmap', 'desc' => 'Apresentação formal do cronograma executivo com investimentos e ganhos mensuráveis.'],
                    ['num' => '04', 'title' => 'Acompanhamento & Validação', 'desc' => 'Apoio técnico na contratação de fornecedores e homologação das primeiras soluções.']
                ],
                'plans' => [
                    ['name' => 'Diagnóstico Ágil PME', 'price' => '120.000 Kz', 'period' => 'projeto base', 'desc' => 'Para empresas de pequeno e médio porte que precisam identificar gargalos e modernizar rotinas.', 'popular' => false, 'features' => ['Auditoria de sistemas e ferramentas atuais', 'Relatório de maturidade digital', 'Matriz de recomendações prioritárias', '1 sessão executiva de apresentação']],
                    ['name' => 'Transformação Corporativa Pro', 'price' => '250.000 Kz', 'period' => 'projeto base', 'desc' => 'Plano completo de modernização tecnológica com roteiro faseado e suporte à implantação.', 'popular' => true, 'features' => ['Diagnóstico profundo multidepartamento', 'Roadmap tecnológico detalhado (12 meses)', 'Seleção e RFP de fornecedores de software', 'Plano de gestão de mudança e cultura digital', '3 meses de mentoria e acompanhamento']],
                    ['name' => 'Assessoria Estratégica Contínua (vCTO)', 'price' => 'Sob Cotação', 'period' => 'assessoria mensal', 'desc' => 'Apoio contínuo de Diretor de Tecnologia sob demanda para guiar a evolução tecnológica da empresa.', 'popular' => false, 'features' => ['Comitê de tecnologia mensal com a direção', 'Supervisão contínua de projetos e segurança', 'Otimização contínua de custos de TI e licenças', 'Canal direto e prioritário de consultoria']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de mais informações e cotação para o serviço de Consultoria em Transformação Digital da RACHI Tec.'
            ],
            [
                'id' => 2,
                'slug' => 'criacao-websites',
                'num' => '02',
                'tag' => '02 • PRESENÇA ONLINE',
                'title' => 'Criação de websites',
                'short_desc' => 'Desenvolvimento de websites institucionais, páginas comerciais e lojas online responsivas.',
                'full_desc' => 'Criamos websites corporativos de alta performance, páginas de vendas (landing pages) focadas em conversão e plataformas de e-commerce modernas. Todos os projetos contam com carregamento ultrarrápido, adaptação total a telemóveis e computadores, otimização para o Google (SEO), contas de email profissional e painel intuitivo de gestão de conteúdos.',
                'icon' => 'globe',
                'image' => 'images/services/service-criacao-websites.jpg',
                'color' => 'indigo',
                'starting_price' => '95.000 Kz',
                'price_period' => 'taxa única',
                'cta_label' => 'Criar Meu Website',
                'prazo' => '7 a 15 dias úteis',
                'garantia' => '30 dias de suporte e garantia técnica pós-lançamento',
                'bullets' => [
                    'Design moderno e responsivo',
                    'SEO e performance',
                    'Gestão de conteúdos simples'
                ],
                'includes' => [
                    'Design exclusivo e elegante adaptado à identidade visual e cores da sua empresa',
                    'Construção 100% responsiva (visual e navegação impecáveis em telemóvel e PC)',
                    'Configuração de domínio próprio (.ao ou .com) e contas de email corporativo',
                    'Otimização avançada para motores de busca (Google SEO) para ser encontrado facilmente',
                    'Integração direta com botão de WhatsApp flutuante e formulários de captura de clientes',
                    'Painel de gestão intuitivo para editar textos, fotos e serviços sem conhecimentos técnicos',
                    'Certificado de segurança SSL gratuito e proteção básica contra ataques'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Briefing & Conteúdo', 'desc' => 'Definição dos objetivos do site, estrutura de páginas e recolha dos materiais e logótipo.'],
                    ['num' => '02', 'title' => 'Design & Layout', 'desc' => 'Criação do visual e protótipo das páginas para aprovação antes do desenvolvimento.'],
                    ['num' => '03', 'title' => 'Programação & SEO', 'desc' => 'Construção técnica, testes de velocidade, adaptação para telemóvel e indexação no Google.'],
                    ['num' => '04', 'title' => 'Publicação & Treino', 'desc' => 'Lançamento no domínio oficial, ativação de emails e sessão prática para gerir o site.']
                ],
                'plans' => [
                    ['name' => 'Landing Page Comercial', 'price' => '95.000 Kz', 'period' => 'taxa única', 'desc' => 'Página única focada em converter visitantes em clientes diretos pelo WhatsApp e telefone.', 'popular' => false, 'features' => ['Página única de alta conversão', 'Design moderno e 100% responsivo', 'Botão WhatsApp e formulário de proposta', 'Configuração de domínio e SSL', 'Entrega em até 7 dias úteis']],
                    ['name' => 'Website Institucional Pro', 'price' => '185.000 Kz', 'period' => 'taxa única', 'desc' => 'O padrão corporativo perfeito para empresas que exigem presença de autoridade no mercado angolano.', 'popular' => true, 'features' => ['Até 6 páginas institucionais', 'Contas de email corporativo inclusas', 'Catálogo interativo de serviços ou produtos', 'SEO otimizado para o Google', 'Painel administrativo fácil', '30 dias de suporte e manutenção inclusos']],
                    ['name' => 'Portal Corporativo / E-commerce', 'price' => 'Sob Cotação', 'period' => 'projeto avançado', 'desc' => 'Para empresas com catálogo amplo de produtos, pedidos online ou áreas restritas para clientes.', 'popular' => false, 'features' => ['Loja online ou portal interativo sob medida', 'Gestão de catálogo, pedidos e clientes', 'Integração de pagamentos ou orçamentos automáticos', 'Infraestrutura de servidor de alta velocidade', 'SLA prioritário de evolução contínua']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar uma proposta para a Criação de Website da minha empresa com a RACHI Tec.'
            ],
            [
                'id' => 3,
                'slug' => 'digitalizacao-processos',
                'num' => '03',
                'tag' => '03 • AUTOMAÇÃO',
                'title' => 'Digitalização de processos empresariais',
                'short_desc' => 'Mapeamos e digitalizamos processos internos para reduzir papel, erros e tempos de operação.',
                'full_desc' => 'Substitua planilhas desorganizadas, formulários físicos e processos manuais por fluxos digitais rápidos e automatizados. Estruturamos solicitações online, aprovações automáticas com notificação por email/WhatsApp e arquivo documental na nuvem para ganho imediato de produtividade.',
                'icon' => 'workflow',
                'image' => 'images/services/service-digitalizacao-processos.jpg',
                'color' => 'amber',
                'starting_price' => '140.000 Kz',
                'price_period' => 'projeto base',
                'cta_label' => 'Digitalizar Processos',
                'prazo' => '10 a 25 dias úteis',
                'garantia' => 'Garantia de redução comprovada de tempo operacional',
                'bullets' => [
                    'Diagnóstico de processos',
                    'Automação de fluxos',
                    'Ganho de eficiência operacional'
                ],
                'includes' => [
                    'Mapeamento completo dos fluxos operacionais e identificação de gargalos manuais',
                    'Desenho da nova rotina digital sem necessidade de impressões ou deslocações físicas',
                    'Criação de formulários eletrónicos dinâmicos com validação automática de dados',
                    'Fluxos de aprovação automáticos com notificações em tempo real para gestores',
                    'Repositório centralizado e seguro na nuvem com controlo de permissões e histórico',
                    'Formação prática de utilizadores com elaboração de guia passo a passo'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Mapeamento do Fluxo', 'desc' => 'Análise minuciosa de como o processo corre hoje e onde ocorrem atrasos ou falhas.'],
                    ['num' => '02', 'title' => 'Desenho da Solução', 'desc' => 'Modelagem do fluxo digital otimizado e validação dos campos com os responsáveis.'],
                    ['num' => '03', 'title' => 'Configuração & Automação', 'desc' => 'Parametrização das regras de aprovação, avisos e repositório documental.'],
                    ['num' => '04', 'title' => 'Testes & Virada', 'desc' => 'Simulação prática com utilizadores, formação da equipa e entrada em produção.']
                ],
                'plans' => [
                    ['name' => 'Automação de Fluxo Único', 'price' => '140.000 Kz', 'period' => 'projeto base', 'desc' => 'Digitalização de 1 processo crítico (ex: requisições de compras, pedidos de férias ou despesas).', 'popular' => false, 'features' => ['Mapeamento de 1 fluxo de ponta a ponta', 'Formulário digital com aprovação', 'Notificações automáticas por email', 'Formação de utilizadores']],
                    ['name' => 'Pacote Operacional Integrado', 'price' => '280.000 Kz', 'period' => 'projeto base', 'desc' => 'Digitalização de até 3 processos vitais da rotina da sua empresa.', 'popular' => true, 'features' => ['Até 3 fluxos automatizados integrados', 'Repositório digital com controlo de acesso', 'Dashboard de status das solicitações', 'Regras avançadas de aprovação', 'Suporte assistido por 60 dias']],
                    ['name' => 'Transformação Corporativa 360°', 'price' => 'Sob Cotação', 'period' => 'projeto corporativo', 'desc' => 'Eliminação total de papel e digitalização de todos os departamentos da empresa.', 'popular' => false, 'features' => ['Mapeamento empresarial completo', 'Integração com sistemas ERP existentes', 'Fluxos com assinatura eletrónica', 'SLA corporativo dedicado']]
                ],
                'whatsapp_msg' => 'Olá! Tenho interesse em digitalizar e automatizar os processos da minha empresa com a RACHI Tec.'
            ],
            [
                'id' => 4,
                'slug' => 'implementacao-sistemas-gestao',
                'num' => '04',
                'tag' => '04 • ERP & GESTÃO',
                'title' => 'Implementação de sistemas de gestão',
                'short_desc' => 'Implementação e configuração de sistemas de gestão adaptados à realidade da sua empresa.',
                'full_desc' => 'Implementamos sistemas de gestão comercial e ERP adaptados às exigências legais e fiscais de Angola. Faturação certificada pela AGT com emissão de QR Code e ficheiro SAF-T, controlo rigoroso de stocks, contas correntes, tesouraria e formação presencial da sua equipa.',
                'icon' => 'database',
                'image' => 'images/services/service-implementacao-sistemas-gestao.jpg',
                'color' => 'emerald',
                'starting_price' => '160.000 Kz',
                'price_period' => 'implementação base',
                'cta_label' => 'Implementar Sistema',
                'prazo' => '15 a 45 dias úteis',
                'garantia' => 'Facturação 100% conforme regras da AGT com suporte no 1º fecho',
                'bullets' => [
                    'Sistemas sob medida',
                    'Integração com processos actuais',
                    'Formação da equipa utilizadora'
                ],
                'includes' => [
                    'Instalação e parametrização do software de gestão conforme o regime fiscal da empresa',
                    'Configuração do módulo de Facturação Certificada pela AGT (QR Code e ficheiro SAF-T)',
                    'Configuração de controlo de stocks, preços, clientes, fornecedores e tesouraria',
                    'Importação e higienização dos registos históricos de artigos e clientes',
                    'Perfis de acesso personalizados para vendedores, operadores de caixa e gerentes',
                    'Formação prática presencial/remota e acompanhamento presencial no primeiro dia de uso'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Levantamento Fiscal & Operacional', 'desc' => 'Compreensão das regras de tributação (IVA, retenções) e categorias de produtos/serviços.'],
                    ['num' => '02', 'title' => 'Parametrização & Registos', 'desc' => 'Configuração completa do sistema e importação dos dados iniciais da empresa.'],
                    ['num' => '03', 'title' => 'Formação & Homologação', 'desc' => 'Capacitação prática dos operadores, testes de emissão de facturas e notas de crédito.'],
                    ['num' => '04', 'title' => 'Entrada em Produção', 'desc' => 'Início oficial da operação com assistência técnica dedicada em tempo real.']
                ],
                'plans' => [
                    ['name' => 'Facturação Essencial AGT', 'price' => '160.000 Kz', 'period' => 'implementação base', 'desc' => 'Para estabelecimentos comerciais e prestadores de serviços que necessitam de facturação legal rápida.', 'popular' => false, 'features' => ['Software certificado pela AGT', 'Emissão de faturas, recibos e guias', 'Configuração de impressora térmica ou A4', 'Geração de ficheiro SAF-T mensal', 'Formação de operadores']],
                    ['name' => 'Gestão Comercial & Stocks', 'price' => '320.000 Kz', 'period' => 'implementação base', 'desc' => 'Controlo completo de vendas, stocks múltiplos, caixa diário e contas correntes.', 'popular' => true, 'features' => ['Todos os recursos de Facturação AGT', 'Gestão multi-armazém e inventário', 'Contas a receber, a pagar e tesouraria', 'Relatórios financeiros e rentabilidade', 'Suporte prioritário no primeiro fecho']],
                    ['name' => 'ERP Corporativo Avançado', 'price' => 'Sob Cotação', 'period' => 'implantação sob medida', 'desc' => 'Para médias e grandes empresas com múltiplas sucursais, produção ou departamentos integrados.', 'popular' => false, 'features' => ['Múltiplas lojas interligadas em tempo real', 'Módulo de Recursos Humanos / Salários', 'Contabilidade geral integrada', 'Desenvolvimento de relatórios customizados', 'SLA de manutenção VIP']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar informações sobre a Implementação de Sistema de Gestão / Facturação AGT com a RACHI Tec.'
            ],
            [
                'id' => 5,
                'slug' => 'suporte-tecnico-especializado',
                'num' => '05',
                'tag' => '05 • HELPDESK & MANUTENÇÃO',
                'title' => 'Suporte técnico especializado',
                'short_desc' => 'Assistência técnica contínua a sistemas, equipamentos e utilizadores para manter a operação estável.',
                'full_desc' => 'Serviço gerenciado de TI para garantir que computadores, servidores, internet e impressoras da sua empresa nunca parem. Disponibilizamos suporte remoto ilimitado, visitas presenciais preventivas, gestão de backups e segurança contra vírus.',
                'icon' => 'headphones',
                'image' => 'images/services/service-suporte-tecnico-especializado.jpg',
                'color' => 'cyan',
                'starting_price' => '75.000 Kz',
                'price_period' => '/mês por empresa',
                'cta_label' => 'Contratar Suporte',
                'prazo' => 'Atendimento em até 2h para chamados críticos',
                'garantia' => 'SLA contratual garantido com técnicos dedicados',
                'bullets' => [
                    'Atendimento remoto e presencial',
                    'Manutenção preventiva e corretiva',
                    'Segurança e cópias de segurança'
                ],
                'includes' => [
                    'Helpdesk remoto ilimitado para resolução imediata de dúvidas e problemas de utilizadores',
                    'Visitas técnicas presenciais mensais para manutenção preventiva de máquinas e impressoras',
                    'Configuração e monitoramento diário de cópias de segurança (backups) dos dados vitais',
                    'Gestão da rede local, roteadores Wi-Fi, switches e estabilidade do link de internet',
                    'Instalação e atualização de antivírus corporativo, firewalls e correções de segurança',
                    'Relatório mensal de desempenho com sugestões de melhorias para a infraestrutura'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Inventário & Auditoria', 'desc' => 'Mapeamento de todos os computadores, servidores, impressoras e rede da empresa.'],
                    ['num' => '02', 'title' => 'Padronização & Segurança', 'desc' => 'Instalação dos agentes de suporte, limpeza de ameaças e configuração dos backups.'],
                    ['num' => '03', 'title' => 'Ativação do Canal de Helpdesk', 'desc' => 'Disponibilização dos números diretos e canais para os seus funcionários abrirem chamados.'],
                    ['num' => '04', 'title' => 'Gestão Preventiva Contínua', 'desc' => 'Visitas agendadas, monitoramento proativo e relatórios de disponibilidade da TI.']
                ],
                'plans' => [
                    ['name' => 'Suporte Essencial (até 5 PCs)', 'price' => '75.000 Kz', 'period' => '/mês', 'desc' => 'Atendimento ideal para pequenos escritórios manterem a rotina estável e protegida.', 'popular' => false, 'features' => ['Suporte remoto ilimitado em dias úteis', '1 visita preventiva presencial por mês', 'Rotina de backup automatizada', 'Antivírus corporativo configurado']],
                    ['name' => 'Suporte Corporativo (até 15 PCs)', 'price' => '150.000 Kz', 'period' => '/mês', 'desc' => 'Para empresas com maior fluxo de operações que precisam de agilidade e visitas frequentes.', 'popular' => true, 'features' => ['Suporte remoto prioritário', '2 visitas presenciais por mês + emergências', 'Gestão de servidor e rede Wi-Fi', 'Backups diários na nuvem e local', 'Relatório mensal de chamados']],
                    ['name' => 'Infraestrutura Total / SLA VIP', 'price' => 'Sob Cotação', 'period' => 'contrato personalizado', 'desc' => 'Para empresas com mais de 20 postos de trabalho, servidores locais e operação crítica.', 'popular' => false, 'features' => ['Técnico residente ou visitas semanais', 'Monitoramento 24/7 de servidores e rede', 'Gestão de fornecedores de internet e telefonia', 'SLA de resposta em até 1 hora']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de cotar o serviço de Suporte Técnico Especializado / Gestão de TI da RACHI Tec.'
            ]
        ];
    }

    public static function getPrintServices(): array
    {
        return [
            [
                'id' => 5,
                'slug' => 'design-identidade-visual',
                'num' => '05',
                'tag' => 'BRANDING & IDENTIDADE VISUAL',
                'title' => 'Design de Identidade Visual & Branding',
                'short_desc' => 'Criação de logótipos exclusivos, rebranding corporativo, Manual de Identidade Visual (Brandbook) e universo gráfico institucional.',
                'full_desc' => 'Desenvolvemos sistemas de identidade visual completos, estratégicos e intemporais para novas empresas e organizações em fase de modernização (rebranding). Da concepção geométrica do logótipo e definição de escalas cromáticas Pantone, CMYK e RGB à criação do Manual de Normas Gráficas (Brandbook), estacionário executivo, templates digitais e desdobramento visual para todos os suportes físicos e digitais.',
                'icon' => 'palette',
                'image' => 'images/services/service-print-identidade-branding.jpg',
                'color' => 'amber',
                'starting_price' => '120.000 Kz',
                'price_period' => 'projecto completo de marca',
                'cta_label' => 'Solicitar Proposta de Branding',
                'prazo' => '5 a 12 dias úteis (conforme pacote)',
                'garantia' => 'Entrega de ficheiros abertos vectoriais (AI, EPS, PDF, SVG, PNG) & cessão de direitos',
                'bullets' => [
                    'Criação de logótipo original com grelha construtiva',
                    'Manual de Normas Gráficas (Brandbook) completo',
                    'Estacionário, Kit Redes Sociais e Apresentações'
                ],
                'applications' => 'Criação de Marca do Zero, Rebranding Corporativo, Manual de Identidade Visual, Papelaria Executiva, Assinaturas de E-mail, Templates Social Media e Pitch Decks.',
                'includes' => [
                    'Diagnóstico de posicionamento de marca, estudo de mercado e referências estratégicas',
                    'Apresentação de propostas conceptuais de logótipo com simulações reais (mockups 3D)',
                    'Definição técnica de paleta cromática oficial nas escalas Pantone, CMYK, RGB e HEX',
                    'Selecção de família tipográfica principal e secundária para documentos e plataformas digitais',
                    'Manual de Normas Gráficas (Brandbook) com regras de redução, área de protecção e usos incorrectos',
                    'Pacote completo de ficheiros vectoriais editáveis e prontos para gráfica e web (AI, PDF/X-1a, SVG, PNG)'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Briefing & Diagnóstico Estratégico', 'desc' => 'Imersão na essência do negócio, público-alvo, valores institucionais e objectivos de posicionamento.'],
                    ['num' => '02', 'title' => 'Concepção Criativa & Grelha', 'desc' => 'Desenho vectorial de conceitos exclusivos, tipografia e sistema de cores com rigor geométrico.'],
                    ['num' => '03', 'title' => 'Apresentação em Mockups Reais', 'desc' => 'Visualização da marca aplicada em papelaria, fachadas, viaturas, vestuário e ambiente digital.'],
                    ['num' => '04', 'title' => 'Brandbook & Fecho de Ficheiros', 'desc' => 'Consolidação do Manual de Identidade Visual e entrega de todos os activos prontos para produção.']
                ],
                'plans' => [
                    [
                        'name' => 'Identidade Essencial / Startup',
                        'price' => '120.000 Kz',
                        'period' => 'pacote de arranque de marca',
                        'desc' => 'Ideal para novas empresas que precisam nascer com uma marca profissional, forte e credível.',
                        'popular' => false,
                        'features' => ['2 propostas exclusivas de logótipo', 'Guia rápido de cores (CMYK/RGB/HEX) e tipografia', 'Design de cartão de visita, papel timbrado e assinatura de e-mail', 'Entrega de todos os ficheiros vectoriais e PNG fundo transparente']
                    ],
                    [
                        'name' => 'Branding Corporativo & Brandbook',
                        'price' => '245.000 Kz',
                        'period' => 'sistema completo de marca',
                        'desc' => 'Solução completa de identidade visual institucional com manual técnico e estacionário completo.',
                        'popular' => true,
                        'features' => ['3 propostas conceptuais de marca ou rebranding', 'Manual de Identidade Visual (Brandbook) completo (25+ páginas)', 'Design de papelaria completa (cartão, pasta, envelope, timbrado, crachá)', 'Kit Redes Sociais (perfil, capas e 6 templates editáveis)', 'Arte de apresentação institucional (PowerPoint / PDF)']
                    ],
                    [
                        'name' => 'Rebranding 360º & Arquitectura de Marca',
                        'price' => 'Sob Cotação',
                        'period' => 'grupos empresariais & submarcas',
                        'desc' => 'Para grupos económicos, holdings ou empresas com múltiplas unidades de negócio e pontos físicos.',
                        'popular' => false,
                        'features' => ['Arquitectura de marca-mãe e submarcas (unidades de negócio)', 'Projecto visual de sinalética interna, fachada e frota', 'Design de linha de vestuário corporativo e kits VIP', 'Acompanhamento de produção gráfica dos primeiros lotes']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Manual de Identidade Visual (Brandbook)',
                        'image' => 'images/services/service-print-identidade-branding.jpg',
                        'tag' => 'Normas Gráficas & Pantone',
                        'desc' => 'Documento técnico oficial que padroniza a construção geométrica da marca, versões cromáticas, tipografia, margens de segurança e aplicações.',
                        'specs' => ['Formato: PDF interactivo + versão impressa opcional', 'Escalas de Cor: Pantone Solid Coated, CMYK, RGB e HEX', 'Regras: Grelha construtiva, redução mínima e fundos', 'Activos: Biblioteca vectorial AI, EPS, SVG e PNG HD']
                    ],
                    [
                        'name' => 'Design de Estacionário & Papelaria Corporativa',
                        'image' => 'images/portfolio-print/papelaria-corporativa.jpg',
                        'tag' => 'Identidade Institucional',
                        'desc' => 'Desenvolvimento coordenado de toda a linha de expediente: cartões de visita, pastas executivas, envelopes, papel timbrado, agendas e blocos.',
                        'specs' => ['Peças: Cartão, Pasta A4, Papel Timbrado, Envelope DL/C4 e Bloco', 'Ficheiros: Fechados em PDF/X-1a prontos para impressão offset', 'Acabamentos: Máscaras técnicas para Verniz UV e Hot-Stamping', 'Padronização: Alinhamento absoluto às cores da marca']
                    ],
                    [
                        'name' => 'Projecto Visual de Sinalética & Recepção',
                        'image' => 'images/portfolio-print/sinaletica-fachada-recepcao.jpg',
                        'tag' => 'Branding Ambiental & 3D',
                        'desc' => 'Desdobramento da identidade visual para fachadas externas, recepção corporativa retroiluminada, placas direccionais, vidros e wall graphics.',
                        'specs' => ['Ambientes: Fachada comercial, lobby, salas de reunião e corredores', 'Simulação: Fotomontagem realista em escala arquitectónica', 'Materiais: Especificação de ACM, acrílico, inox, LED e vinil jateado', 'Execução: Produção e instalação pela equipa RACHI Print']
                    ],
                    [
                        'name' => 'Ecossistema de Merchandising & Submarcas',
                        'image' => 'images/portfolio-print/kit-merchandising-completo.jpg',
                        'tag' => 'Universo Visual 360º',
                        'desc' => 'Criação de linguagem gráfica proprietária (grafismos, ícones e padrões) aplicada a kits promocionais, sacolas, vestuário e brindes.',
                        'specs' => ['Elementos: Ícones proprietários, padrões geométricos e selos', 'Aplicações: Vestuário, tote bags, canecas, crachás e cadernos', 'Coerência: Unidade visual em todos os pontos de contacto', 'Guias: Cotas exactas para serigrafia, bordado e laser']
                    ],
                    [
                        'name' => 'Design de Frotas, Outdoors & Campanha Externa',
                        'image' => 'images/portfolio-print/comunicacao-externa-frotas.jpg',
                        'tag' => 'Comunicação de Alto Impacto',
                        'desc' => 'Layout técnico para envelopamento de viaturas comerciais, lonas publicitárias, outdoors de rodovia e mobiliário urbano (MUPIs).',
                        'specs' => ['Viaturas: Planificação lateral, traseira e capô à escala real', 'Mídia Exterior: Artes em alta resolução para Outdoor e MUPI', 'Legibilidade: Hierarquia tipográfica optimizada para leitura rápida', 'Arte-Final: Pronta para impressão solvente/UV de grande formato']
                    ],
                    [
                        'name' => 'Identidade para Academias, Eventos & Kits VIP',
                        'image' => 'images/portfolio-print/kit-formacao-academy.jpg',
                        'tag' => 'Submarcas & Certificações',
                        'desc' => 'Identidade dedicada para programas corporativos, academias de formação, certificados oficiais, credenciais, manuais e kits executivos.',
                        'specs' => ['Peças: Certificados, crachás PVC, manuais, roll-ups e painéis', 'Segurança: Selos institucionais e chancelas vectoriais', 'Apresentação: Templates editáveis para formadores e gestores', 'Flexibilidade: Adaptável a eventos anuais e conferências']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar uma proposta para Design de Identidade Visual / Branding na RACHI Print.'
            ],
            [
                'id' => 1,
                'slug' => 'documentos-institucionais',
                'num' => '01',
                'tag' => '01 • DOCUMENTOS OFICIAIS',
                'title' => 'Impressão de documentos institucionais',
                'short_desc' => 'Impressão de relatórios, brochuras, manuais, propostas e documentos oficiais com qualidade institucional.',
                'full_desc' => 'Produção gráfica de excelência para documentos executivos, relatórios de gestão e contas, propostas para concursos públicos, manuais operacionais e livros corporativos. Oferecemos opções completas de encadernação em capa dura, wire-o metálico, lombada colada PUR ou agrafamento, com verificação prévia de pré-impressão (preflight) e prova de cor para fidelidade absoluta.',
                'icon' => 'file-text',
                'image' => 'images/services/service-print-documentos-institucionais.jpg',
                'color' => 'blue',
                'starting_price' => '18.500 Kz',
                'price_period' => 'preço base por lote',
                'cta_label' => 'Solicitar Cotação de Documentos',
                'prazo' => '24h a 72h úteis (conforme tiragem)',
                'garantia' => 'Prova de cor prévia & reimpressão garantida contra defeitos',
                'bullets' => [
                    'Impressão a cores e P&B de alta definição',
                    'Acabamentos e encadernações executivas variadas',
                    'Tiragens flexíveis: de pequenos lotes a milhares de cópias'
                ],
                'applications' => 'Relatórios de Gestão & Contas, Manuais de Procedimentos, Propostas de Concurso Público, Livros Institucionais, Catálogos e Certificados Oficiais.',
                'includes' => [
                    'Verificação técnica pré-impressão (pre-flight) de curvas de cores CMYK e margens de corte',
                    'Envio de boneca ou prova digital de pré-visualização para aprovação formal da sua administração',
                    'Seleção de papéis certificados de 80g a 350g (Couché brilho/mate, Offset e Papéis especiais)',
                    'Acabamentos nobres: Laminação Soft Touch, Verniz UV Localizado, Hot Stamping e Capa Dura',
                    'Embalamento térmico protegido e selado contra humidade para transporte seguro',
                    'Entrega rápida e pontual no escritório da sua empresa em Luanda e envio para todas as províncias'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Envio do Ficheiro & Briefing', 'desc' => 'Recebemos o ficheiro em PDF e alinhamos o número de páginas, tipo de papel, encadernação e tiragem.'],
                    ['num' => '02', 'title' => 'Validação Técnica & Prova', 'desc' => 'Nossa equipa pré-visualiza a geometria e cores, emitindo a prova digital de confirmação.'],
                    ['num' => '03', 'title' => 'Impressão em Alta Resolução', 'desc' => 'Produção em maquinário de alta precisão com calibração contínua e controlo densitométrico.'],
                    ['num' => '04', 'title' => 'Acabamento & Entrega', 'desc' => 'Corte, encadernação, controlo de qualidade e entrega direta nas instalações do cliente.']
                ],
                'plans' => [
                    [
                        'name' => 'Lote Expresso / Tiragem Curta',
                        'price' => '18.500 Kz',
                        'period' => 'a partir de / lote inicial',
                        'desc' => 'Ideal para apresentações de conselho de administração, reuniões urgentes e concursos pontuais.',
                        'popular' => false,
                        'features' => ['Tiragem de 5 a 50 exemplares', 'Impressão digital laser HD imediata', 'Acabamento em espiral ou wire-o metálico', 'Prazo expresso de 24h a 48h']
                    ],
                    [
                        'name' => 'Corporativo & Relatórios de Gestão',
                        'price' => '75.000 Kz',
                        'period' => 'lote médio institucional',
                        'desc' => 'Para relatórios anuais de contas, manuais de compliance e publicações de grande prestígio.',
                        'popular' => true,
                        'features' => ['50 a 300 exemplares com desconto', 'Capa dura ou couché 300g plastificado mate', 'Lombada colada PUR ou wire-o nobre', 'Prova física de verificação incluída', 'Entrega gratuita na zona corporativa de Luanda']
                    ],
                    [
                        'name' => 'Grande Tiragem / Escala Offset',
                        'price' => 'Sob Cotação',
                        'period' => 'orçamento por escala',
                        'desc' => 'Milhares de manuais ou brochuras com custo unitário ultra competitivo.',
                        'popular' => false,
                        'features' => ['Acima de 500 exemplares', 'Impressão offset industrial com fidelidade Pantone', 'Verniz UV localizado ou Hot Stamping', 'Logística de distribuição fracionada', 'Condições de pagamento facilitadas']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Relatórios de Gestão & Contas',
                        'image' => 'images/print-products/relatorio-gestao.png',
                        'tag' => 'Capa Dura & Hot-Stamping',
                        'desc' => 'Produção executiva para relatórios anuais de contas e prestação institucional, com acabamento em capa dura personalizada, estampagem a quente e lombada PUR.',
                        'specs' => ['Papel Miolo: Couché 135g / Offset 90g', 'Capa: Cartão cinzento 2.5mm forrado', 'Acabamento: Hot-stamping dourado ou prateado', 'Encadernação: Lombada PUR resistente']
                    ],
                    [
                        'name' => 'Brochuras & Catálogos Institucionais',
                        'image' => 'images/print-products/brochura-institucional.png',
                        'tag' => 'Acabamento Soft-Touch',
                        'desc' => 'Catálogos comerciais e brochuras de apresentação com laminação mate toque de veludo (soft-touch) e fidelidade cromática em alta definição.',
                        'specs' => ['Papel Capa: Couché 300g mate', 'Papel Miolo: Couché 150g brilho/mate', 'Acabamento: Plastificação aveludada Soft-Touch', 'Encadernação: Agrafamento ômega ou simples']
                    ],
                    [
                        'name' => 'Manuais Operacionais & Guias Técnicos',
                        'image' => 'images/print-products/manual-tecnico.png',
                        'tag' => 'Wire-o Metálico Nobre',
                        'desc' => 'Manuais de procedimentos internos, compliance e formação corporativa com encadernação metálica em espiral dupla (wire-o) e divisórias plastificadas.',
                        'specs' => ['Encadernação: Wire-o duplo metálico preto ou prata', 'Capa: PVC translúcido protetor', 'Separadores: Cartolina 250g com abas', 'Formato: A4 ou A5 horizontal/vertical']
                    ],
                    [
                        'name' => 'Certificados & Diplomas Oficiais',
                        'image' => 'images/print-products/certificado-oficial.png',
                        'tag' => 'Papel Vergê & Selo Dourado',
                        'desc' => 'Diplomas executivos, certificados de participação e mérito impressos em papéis texturados de alta gramagem com chancela e relevo.',
                        'specs' => ['Papel: Diplomata ou Vergê 250g/300g', 'Segurança: Microtexto e marca d\'água opcional', 'Acabamento: Selo holográfico ou hot-stamping', 'Opção: Pasta executiva protetora']
                    ],
                    [
                        'name' => 'Propostas Comerciais de Concurso',
                        'image' => 'images/print-products/proposta-comercial.png',
                        'tag' => 'Pastas Executivas com Bolsa',
                        'desc' => 'Dossiers e propostas de concurso público organizados com rigor institucional, divisórias de índice e caixas arquivadoras personalizadas.',
                        'specs' => ['Apresentação: Dossier com bolsa interior para cartão', 'Ficheiros: Conferência técnica preflight', 'Tiragem: Pequenos lotes sob demanda', 'Prazo: Regime de urgência 24h a 48h']
                    ],
                    [
                        'name' => 'Livros & Publicações Corporativas',
                        'image' => 'images/print-products/livro-corporativo.png',
                        'tag' => 'Costura Smyth & Capa Dura',
                        'desc' => 'Publicações comemorativas, livros de história institucional e códigos de ética impressos com encadernação costurada de luxo e fita marcadora.',
                        'specs' => ['Encadernação: Costura à linha (Smyth sewn)', 'Capa: Dura com guarda impressa personalizada', 'Extra: Fita marcadora em cetim', 'Cromia: Calibração densitométrica ISO']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação e especificações para o serviço de Impressão de Documentos Institucionais da RACHI Print.'
            ],
            [
                'id' => 2,
                'slug' => 'materiais-promocionais',
                'num' => '02',
                'tag' => '02 • BRINDES & ATIVAÇÃO',
                'title' => 'Materiais promocionais & Brindes',
                'short_desc' => 'Criação e produção de brindes e materiais promocionais para campanhas, activações e fidelização.',
                'full_desc' => 'Soluções personalizadas em brindes corporativos, merchandising de marca e kits de boas-vindas para clientes e colaboradores. Desenvolvemos desde itens de escritório e vestuário técnico a artigos tecnológicos gravados a laser, transmitindo sofisticação e perpetuando a presença da sua marca em momentos decisivos.',
                'icon' => 'gift',
                'image' => 'images/services/service-print-materiais-promocionais.jpg',
                'color' => 'amber',
                'starting_price' => '24.000 Kz',
                'price_period' => 'preço base por lote',
                'cta_label' => 'Solicitar Cotação de Brindes',
                'prazo' => '3 a 7 dias úteis',
                'garantia' => 'Mockup 3D prévio aprovado e teste de gravação de cor',
                'bullets' => [
                    'Brindes personalizados com gravação durável',
                    'Campanhas, feiras e activações corporativas',
                    'Opções flexíveis para diferentes orçamentos'
                ],
                'applications' => 'Agendas Executivas, Cadernos Corporativos, T-Shirts & Polos bordados, Garrafas Térmicas, Canecas, Pen Drives, Mochilas e Kits Onboarding.',
                'includes' => [
                    'Criação de mockup digital tridimensional gratuito com o logótipo aplicado no brinde',
                    'Tecnologias modernas de gravação: Gravação a Laser, Serigrafia, DTF Têxtil, UV e Tampografia',
                    'Catálogo alargado com opções ecológicas (cortiça, bambu), metálicas e tecidos respiráveis',
                    'Composição e personalização de caixas rígidas personalizadas para kits onboarding VIP',
                    'Controlo de qualidade minucioso e teste de abrasão nas gravações antes da embalagem final',
                    'Emissão de factura comercial com dedução de IVA e entrega corporativa direta'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Escolha do Item no Catálogo', 'desc' => 'Selecione os artigos promocionais pretendidos, quantidade e paleta de cores corporativa.'],
                    ['num' => '02', 'title' => 'Mockup Digital de Aprovação', 'desc' => 'Nossa equipa de design cria a visualização do produto com a aplicação do seu logótipo.'],
                    ['num' => '03', 'title' => 'Produção & Gravação em Oficina', 'desc' => 'Personalização com máquinas a laser, bordados de precisão ou impressão UV de alta durabilidade.'],
                    ['num' => '04', 'title' => 'Embalagem & Expedição', 'desc' => 'Acondicionamento seguro individual ou em kits temáticos e expedição rápida.']
                ],
                'plans' => [
                    [
                        'name' => 'Kit Onboarding / Boas-Vindas',
                        'price' => '24.000 Kz',
                        'period' => 'por kit / lote mín. 10 un.',
                        'desc' => 'Acolhimento de novos funcionários com itens essenciais da marca corporativa.',
                        'popular' => false,
                        'features' => ['Caderno tipo Moleskine com elástico', 'Caneta metálica com gravação a laser', 'Garrafa térmica inox personalizada', 'Saco de tecido ecológico institucional']
                    ],
                    [
                        'name' => 'Campanha & Feiras de Negócios',
                        'price' => '120.000 Kz',
                        'period' => 'lote promocional (50 a 100 un.)',
                        'desc' => 'Materiais de grande impacto visual para distribuição em congressos e feiras setoriais.',
                        'popular' => true,
                        'features' => ['Polos ou T-Shirts com bordado/estampa de alta definição', 'Canetas promocionais e blocos de notas pautados', 'Fitas lanyard com porta-cartões', 'Embalamento prático para distribuição no evento']
                    ],
                    [
                        'name' => 'Linha Executiva VIP / Fim de Ano',
                        'price' => 'Sob Cotação',
                        'period' => 'orçamento personalizado',
                        'desc' => 'Presentes de prestígio para membros de administração, sócios e clientes estratégicos.',
                        'popular' => false,
                        'features' => ['Agendas em pele sintética nobre com fecho magnético', 'Kits tecnológicos: Powerbank 10.000mAh + Pen Drive 64GB', 'Caixas de luxo com berço em espuma moldada', 'Cartão personalizado com mensagem da gerência']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Canetas Executivas Personalizadas RACHI',
                        'image' => 'images/print-products/canetas-executivas.png',
                        'tag' => 'Gravação a Laser & Tampografia',
                        'desc' => 'Canetas executivas metálicas com acabamento cromado nobre, grip anatómico e gravação resistente da sua marca em 4 cores oficiais (Preto, Prata, Azul e Amarelo).',
                        'specs' => ['Material: Metal com detalhes cromados', 'Carga: Tinta azul/preta fluida de longa escrita', 'Personalização: Laser de alta precisão ou tampografia', 'Cores: Preto, Prata, Azul e Amarelo institucional']
                    ],
                    [
                        'name' => 'Agenda Executiva Moleskine 2026',
                        'image' => 'images/print-products/agenda-executiva.png',
                        'tag' => 'Baixo-Relevo & Pele Sintética',
                        'desc' => 'Agenda executiva almofadada em pele sintética de alto padrão com gravação institucional em baixo-relevo (debossing), fecho elástico e fita marcadora.',
                        'specs' => ['Capa: Pele sintética com toque acolchoado', 'Miolo: Papel marfim 80g com visão diária/semanal', 'Acabamento: Gravação a quente em baixo-relevo', 'Fecho: Elástico resistente de cor coordenada']
                    ],
                    [
                        'name' => 'Canecas de Cerâmica Corporativas VIP',
                        'image' => 'images/print-products/caneca-ceramica.png',
                        'tag' => 'Cores da Marca & Gravação VIP',
                        'desc' => 'Coleção de cadernos corporativos tipo Moleskine com capa dura resistente, cantos arredondados, bolsa interior para notas e fita em cetim.',
                        'specs' => ['Paleta: Branco, Preto, Azul corporativo e Vermelho', 'Formato: A5 (14x21cm) com 160 páginas pautadas', 'Gravação: Serigrafia de alta resistência ou laser', 'Utilidade: Reuniões de direção e convenções de vendas']
                    ],
                    [
                        'name' => 'Garrafas Térmicas Inteligentes com Display LED',
                        'image' => 'images/print-products/garrafa-termica-led.png',
                        'tag' => 'Display Touch & Parede Dupla',
                        'desc' => 'Garrafas térmicas em aço inox 304 com isolamento a vácuo e display digital touch na tampa que exibe a temperatura real da bebida.',
                        'specs' => ['Material: Aço inoxidável 304 de grau alimentar', 'Capacidade: 500ml com infusor para chá incluído', 'Tecnologia: Sensor digital LED na tampa', 'Isolamento: Vácuo térmico até 12h de conservação']
                    ],
                    [
                        'name' => 'Sacolas Ecológicas & Kits Eco Sustentáveis',
                        'image' => 'images/print-products/sacola-ecologica.png',
                        'tag' => 'Linha Eco-Friendly & Sustentável',
                        'desc' => 'Conjunto sustentável com capa em cortiça natural, folhas recicladas pautadas, fita elástica e caneta ecológica de bambu gravada a laser.',
                        'specs' => ['Capa: Cortiça 100% natural e sustentável', 'Miolo: Papel reciclado certificado 80g', 'Caneta: Corpo em bambu e clipe metálico', 'Conceito: Responsabilidade ambiental e ESG corporativo']
                    ],
                    [
                        'name' => 'Fitas Lanyard Executivas & Porta-Cartões',
                        'image' => 'images/print-products/fita-lanyard.png',
                        'tag' => 'Kit Boas-Vindas & Caixa VIP',
                        'desc' => 'Kit institucional composto por garrafa térmica inox personalizada, caneca de porcelana de alta definição, saco ecológico TNT reforçado e caneta.',
                        'specs' => ['Composição: Garrafa térmica + Caneca cerâmica + Saco TNT + Caneta', 'Embalagem: Caixa rígida personalizada com berço', 'Acolhimento: Fortalecimento imediato da cultura da empresa', 'Tiragens: Disponível a partir de 10 unidades']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Materiais Promocionais e Brindes Corporativos da RACHI Print.'
            ],
            [
                'id' => 3,
                'slug' => 'producao-grafica-corporativa',
                'num' => '03',
                'tag' => '03 • PAPELARIA & IDENTIDADE',
                'title' => 'Produção gráfica corporativa',
                'short_desc' => 'Produção de materiais gráficos e papelaria corporativa alinhados à identidade visual da sua organização.',
                'full_desc' => 'Material de escritório institucional que consolida a credibilidade e seriedade do seu negócio. Produzimos cartões de visita de alto padrão, pastas porta-documentos com bolsa e orelha, papel timbrado, envelopes timbrados e carimbos automáticos com rigorosa fidelidade cromática e acabamentos táteis diferenciados.',
                'icon' => 'briefcase',
                'image' => 'images/services/service-print-producao-corporativa.jpg',
                'color' => 'emerald',
                'starting_price' => '15.000 Kz',
                'price_period' => 'preço base por lote',
                'cta_label' => 'Solicitar Cotação Corporativa',
                'prazo' => '2 a 5 dias úteis',
                'garantia' => 'Corte milimétrico & fidelidade cromática aos manuais de marca',
                'bullets' => [
                    'Identidade visual consistente em todos os pontos de contacto',
                    'Acabamento profissional de alto nível (Verniz UV, Soft Touch)',
                    'Prazos e qualidade rigorosamente controlados'
                ],
                'applications' => 'Cartões de Visita (soft touch, cantos redondos), Pastas com bolsa e orelha, Papel Timbrado, Envelopes Timbrados e Carimbos automáticos.',
                'includes' => [
                    'Padronização cromática baseada nas cores corporativas oficiais da sua instituição',
                    'Papéis executivos nobres: Couché fosco 350g, Offset 90g e papéis texturados de alta gama',
                    'Acabamentos táteis modernos: Plastificação Mate, Soft Touch aveludado e Verniz Localizado',
                    'Pastas com bolsa interna reforçada e ranhura de encaixe para cartão de visita',
                    'Carimbos automáticos autoentintados de longa duração com texto e logótipo nítidos',
                    'Embalagem por lotes protegidos para manter o material impecável no arquivo do seu escritório'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Levantamento de Itens', 'desc' => 'Definição dos itens de expediente necessários (cartões, pastas, envelopes, timbrados ou carimbos).'],
                    ['num' => '02', 'title' => 'Adequação ao Manual de Marca', 'desc' => 'Conferência de normas gráficas, fontes e vetores para garantir proporções e cores exatas.'],
                    ['num' => '03', 'title' => 'Impressão & Troquelagem', 'desc' => 'Impressão de alta precisão, laminação e cortes de precisão em matrizes computadorizadas.'],
                    ['num' => '04', 'title' => 'Conferência & Entrega', 'desc' => 'Revisão lote a lote e entrega organizada nas suas instalações em Luanda.']
                ],
                'plans' => [
                    [
                        'name' => 'Kit Escritório Inicial',
                        'price' => '28.000 Kz',
                        'period' => 'pacote essencial de arranque',
                        'desc' => 'Para novas empresas, advogados, consultores e escritórios em expansão.',
                        'popular' => false,
                        'features' => ['200 Cartões de visita com plastificação mate', '50 Pastas executivas com bolsa interior', '100 Folhas de papel timbrado institucional A4', '1 Carimbo automático oficial']
                    ],
                    [
                        'name' => 'Pacote Corporativo Total',
                        'price' => '85.000 Kz',
                        'period' => 'pacote completo para equipas',
                        'desc' => 'Ideal para empresas consolidadas com fluxo regular de reuniões e documentos contratuais.',
                        'popular' => true,
                        'features' => ['500 Cartões de visita com verniz localizado ou toque aveludado', '150 Pastas corporativas laminadas de alta resistência', '500 Folhas de papel timbrado offset 100g de alta absorção', '200 Envelopes saco C4 + 300 Envelopes de carta DL timbrados', '2 Carimbos automáticos de expediente']
                    ],
                    [
                        'name' => 'Gestão Anual de Papelaria / Grandes Lotes',
                        'price' => 'Sob Cotação',
                        'period' => 'contrato corporativo com reposição',
                        'desc' => 'Abastecimento contínuo para bancos, seguradoras, petrolíferas e órgãos públicos.',
                        'popular' => false,
                        'features' => ['Produção em grande escala com desconto de volume', 'Garantia de reposição de stock em 48h úteis', 'Linha de atendimento corporativo dedicada', 'Facturação com prazos de crédito negociados']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Pastas Corporativas & Envelopes Timbrados',
                        'image' => 'images/print-products/pastas-envelopes.png',
                        'tag' => 'Pastas, Blocos & Cartões',
                        'desc' => 'Pastas com bolsa e orelha, blocos espiral de notas, envelopes timbrados C4 e DL, papel de carta A4 e cartões de visita soft-touch.',
                        'specs' => ['Papel Miolo: Offset 90g e 100g premium', 'Capa: Cartolina triplex 300g / Couché 350g', 'Acabamento: Plastificação aveludada Soft-Touch', 'Formatos: A4, A5, C4 e DL institucional']
                    ],
                    [
                        'name' => 'Papel Timbrado Oficial A4',
                        'image' => 'images/print-products/papel-timbrado.png',
                        'tag' => 'Caixa Rígida & Tecnologia',
                        'desc' => 'Caixa rígida magnética de luxo, garrafa térmica fosca, powerbank 10.000mAh, pen drive 64GB em metal, chaveiro e caneta com estojo nobre.',
                        'specs' => ['Estrutura: Caixa rígida com fecho magnético', 'Itens: Garrafa térmica + Powerbank + Pen drive + Caneta VIP', 'Personalização: Gravação laser de alta precisão e baixo-relevo', 'Apresentação: Berço em EVA recortado sob medida']
                    ],
                    [
                        'name' => 'Crachás Executivos em PVC Rígido',
                        'image' => 'images/print-products/cracha-pvc.png',
                        'tag' => 'Polos, Camisas & Coletes',
                        'desc' => 'Linha de vestuário institucional: coletes acolchoados bordados, polos em piquê nobre, camisas sociais de manga comprida e t-shirts corporativas.',
                        'specs' => ['Tecidos: 100% Algodão penteado, Piquê nobre e Microfibra térmica', 'Bordado: Computadorizado de alta definição', 'Estampa: DTF têxtil de ultra-durabilidade sem desbotar', 'Modelagem: Regular e Slim fit feminina e masculina']
                    ],
                    [
                        'name' => 'Blocos & Facturação Autocopiativa',
                        'image' => 'images/print-products/bloco-autocopiativo.png',
                        'tag' => 'Letras 3D & Interiores',
                        'desc' => 'Placas externas de fachada, balcão de receção com logótipo 3D retroiluminado, sinalética interna direcional e vinil fosco jateado em vidro.',
                        'specs' => ['Letras Caixa: Aço inox polido, Acrílico cristal ou PVC expandido', 'Iluminação: LED embutido de baixo consumo e alta durabilidade', 'Vidros: Película fosca jateada com recorte computadorizado', 'Instalação: Equipa técnica especializada em Luanda']
                    ],
                    [
                        'name' => 'Decoração de Frotas, Outdoors & MUPIs',
                        'image' => 'images/portfolio-print/comunicacao-externa-frotas.jpg',
                        'tag' => 'Viaturas, Lonas & MUPIs',
                        'desc' => 'Vinil automotivo de alta conformabilidade para frotas de carrinhas, lonas com ilhós de grande resistência, painéis de outdoor e MUPIs urbanos.',
                        'specs' => ['Vinil: Automotivo polimérico com laminação UV anti-risco', 'Remoção: Sem resíduos nem danos na pintura original', 'Impressão: Tintas solventes resistentes a sol e intempéries', 'Garantia: Durabilidade de 2 a 5 anos']
                    ],
                    [
                        'name' => 'Bonés Corporativos Trucker Premium',
                        'image' => 'images/portfolio-print/bones-corporativos-rachi.jpg',
                        'tag' => 'Rede Respirável 4 Cores',
                        'desc' => 'Bonés respiráveis tipo trucker com rede traseira e estampagem nítida do logótipo institucional em 4 opções de cores (Branco, Preto, Azul e Amarelo).',
                        'specs' => ['Modelo: Trucker com fecho ajustável snapback', 'Frente: Sarja acolchoada estruturada', 'Traseira: Rede mesh respirável de alto conforto', 'Personalização: Bordado 3D ou patch emborrachado']
                    ],
                    [
                        'name' => 'Cartões de Visita Executivos VIP',
                        'image' => 'images/print-products/cartoes-visita.png',
                        'tag' => 'Soft-Touch & Verniz Localizado',
                        'desc' => 'Cartões de visita em couché fosco 350g com cantos redondos opcionais, plastificação aveludada e verniz UV com brilho localizado no logótipo.',
                        'specs' => ['Gramagem: Couché fosco 350g ou 400g extra-rígido', 'Acabamento: Toque de veludo Soft-Touch + Verniz UV 3D', 'Corte: Reto ou com cantos arredondados', 'Cores: Impressão offset HD frente e verso']
                    ],
                    [
                        'name' => 'Carimbos Automáticos Autoentintados',
                        'image' => 'images/print-products/carimbo-automatico.png',
                        'tag' => 'Mecanismo Trodat & Laser',
                        'desc' => 'Carimbos profissionais para gerência, departamento financeiro e receção com mecanismo automático de alta durabilidade e borracha gravada a laser.',
                        'specs' => ['Marcas: Estruturas Trodat / Colop de alta resistência', 'Borracha: Gravação milimétrica a laser com alta nitidez', 'Cores de Tinta: Preto, Azul, Vermelho ou Verde', 'Rendimento: Mais de 10.000 impressões nítidas por almofada']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Produção Gráfica Corporativa e Papelaria da RACHI Print.'
            ],
            [
                'id' => 4,
                'slug' => 'grafica-eventos',
                'num' => '04',
                'tag' => '04 • GRANDES FORMATOS & EVENTOS',
                'title' => 'Produção gráfica para eventos & sinalética',
                'short_desc' => 'Produção de banners, convites, credenciais, sinalética e materiais para eventos corporativos.',
                'full_desc' => 'Estruturas de grande impacto e sinalética completa para conferências, workshops, feiras internacionais e celebrações institucionais. Criamos roll-up banners autoportantes, lonas de palco (backdrops) com acabamento fosco anti-reflexo para câmaras de TV, credenciais em PVC rígido com fitas personalizadas e totens de orientação.',
                'icon' => 'calendar-range',
                'image' => 'images/services/service-print-grafica-eventos.jpg',
                'color' => 'purple',
                'starting_price' => '22.000 Kz',
                'price_period' => 'preço base unitário',
                'cta_label' => 'Solicitar Cotação para Eventos',
                'prazo' => '24h a 48h úteis (regime de urgência disponível)',
                'garantia' => 'Estruturas de alumínio reforçado e lona anti-reflexo com nitidez fotográfica',
                'bullets' => [
                    'Materiais para todos os formatos e cenografias',
                    'Entrega perfeitamente alinhada ao cronograma do seu evento',
                    'Elevado impacto visual, contraste e legibilidade'
                ],
                'applications' => 'Roll-up Banners (85x200cm, 120x200cm), Backdrops de Palco, Credenciais em PVC com fita personalizada, Totens e Sinalética Direcional.',
                'includes' => [
                    'Impressão digital em grande formato solvente e UV de secagem instantânea e cores vivas',
                    'Lonas foscas especiais de alta densidade sem reflexo em fotografias ou iluminação de palco',
                    'Fornecimento de estruturas completas de alumínio com hastes reforçadas e estojo almofadado',
                    'Credenciamento seguro: cartões em PVC com furo ovóide e fitas lanyard sublimadas com logótipo',
                    'Sinalética direcional e placas de mesa de oradores em acrílico ou PVC espumado',
                    'Disponibilidade de apoio técnico presencial para montagem e desmontagem das estruturas em Luanda'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Briefing do Evento & Medidas', 'desc' => 'Alinhamos a tipologia do evento, dimensões do espaço, número de credenciais e data da montagem.'],
                    ['num' => '02', 'title' => 'Design & Proporções de Escala', 'desc' => 'Adaptação dos ficheiros para dimensões reais garantindo máxima resolução sem granulação.'],
                    ['num' => '03', 'title' => 'Impressão em Grande Formato', 'desc' => 'Execução com maquinário industrial, costura de bainhas e aplicação de ilhós metálicos.'],
                    ['num' => '04', 'title' => 'Montagem & Entrega Pontual', 'desc' => 'Entrega antecipada das estruturas no recinto do evento ou nas instalações do cliente.']
                ],
                'plans' => [
                    [
                        'name' => 'Kit Orador / Expositor Básico',
                        'price' => '22.000 Kz',
                        'period' => 'a partir de / unidade',
                        'desc' => 'Solução rápida e prática para quem participa como patrocinador ou orador convidado.',
                        'popular' => false,
                        'features' => ['1 Roll-up Banner completo 85x200cm em alumínio anodizado', 'Lona fotográfica fosca de alta resolução', 'Saco de transporte almofadado com fecho', 'Produção rápida em até 24h']
                    ],
                    [
                        'name' => 'Conferência / Seminário Executivo',
                        'price' => '145.000 Kz',
                        'period' => 'pacote de evento (até 100 pax)',
                        'desc' => 'Cenografia visual completa para fóruns, conferências ministeriais e reuniões de empresas.',
                        'popular' => true,
                        'features' => ['1 Backdrop fotográfico de palco / receção (3x2m com acabamento anti-reflexo)', '2 Roll-up Banners institucionais para receção e auditório', '100 Credenciais em PVC com fitas sublimadas personalizadas', 'Sinalética de púlpito e mesa de honra']
                    ],
                    [
                        'name' => 'Grande Feira / Cimeira Internacional',
                        'price' => 'Sob Cotação',
                        'period' => 'projeto cenográfico customizado',
                        'desc' => 'Estandes personalizados, painéis autoportantes e montagem completa de grandes fóruns.',
                        'popular' => false,
                        'features' => ['Decoração completa de estande ou pavilhão', 'Pórticos de entrada e balcões de credenciamento', 'Equipa de montagem e suporte no dia do evento', 'SLA prioritário para urgências de última hora']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Vinil Adesivo, Sinalética & Fachadas',
                        'image' => 'images/print-products/vinil-adesivo.png',
                        'tag' => 'Painéis Neon & Balcão Curvo',
                        'desc' => 'Cenografia completa com iluminação spotlight, letreiros neon 3D, telas informativas, balcão curvo com iluminação frontal e tapete institucional.',
                        'specs' => ['Iluminação: Fita LED e Neon 3D de alta luminosidade', 'Mobiliário: Balcão curvo com acabamento premium', 'Piso: Tapete institucional de tráfego intenso', 'Cenografia: Painéis modulares com personalização integral']
                    ],
                    [
                        'name' => 'Lonas de Grande Formato & Banners com Ilhós',
                        'image' => 'images/print-products/lona-banner-ilhos.png',
                        'tag' => 'Roll-ups & Balcão QR Code',
                        'desc' => 'Estrutura metálica preta modular, balcão expositor com QR Code dinâmico, roll-ups verticais informativos de alta nitidez e folhetos.',
                        'specs' => ['Estrutura: Modular em perfis metálicos pintados', 'Comunicação: QR Code promocional e sinalética de balcão', 'Banners: Roll-ups de montagem instantânea', 'Portabilidade: Fácil transporte e remontagem']
                    ],
                    [
                        'name' => 'Balcão Promocional Portátil / Degustação',
                        'image' => 'images/print-products/balcao-promocional.png',
                        'tag' => 'Testeira Aérea & Bolsa',
                        'desc' => 'Balcão autoportante curvado com testeira superior personalizada, prateleira interna, estrutura leve desmontável e bolsa de transporte.',
                        'specs' => ['Testeira: Haste metálica com placa superior visível a distância', 'Prateleira: Suporta até 20kg de materiais de apoio', 'Montagem: Encaixe rápido sem ferramentas em 3 minutos', 'Transporte: Mala de lona reforçada inclusa']
                    ],
                    [
                        'name' => 'Roll-up Banners Autoportantes em Alumínio',
                        'image' => 'images/print-products/rollup-publicitario.png',
                        'tag' => 'Alumínio Reforçado & Saco Transporte',
                        'desc' => 'Estrutura retrátil autoportante em alumínio com impressão em lona fotográfica fosca de alta definição que não encurva nas laterais.',
                        'specs' => ['Dimensões: 85x200cm ou 120x200cm', 'Material: Estrutura em alumínio anodizado reforçado', 'Lona: Banner fosco blockout anti-reflexo', 'Inclui: Saco almofadado com fecho e alça de transporte']
                    ],
                    [
                        'name' => 'Backdrop Fotográfico de Palco & Imprensa',
                        'image' => 'images/print-products/backdrop-painel.png',
                        'tag' => 'Acabamento Fosco Anti-Reflexo',
                        'desc' => 'Painel de grande formato para fundo de palco, conferências de imprensa e photo opportunity com repetição equilibrada de logótipos de patrocinadores.',
                        'specs' => ['Tamanho: 3x2m, 4x2.5m ou sob medida', 'Resolução: Impressão UV em grande formato sem emendas', 'Acabamento: Bainhas duplas reforçadas e ilhós metálicos', 'Anti-Reflexo: Superfície fosca ideal para flashes e câmaras de TV']
                    ],
                    [
                        'name' => 'Flyers, Folhetos & Folders Promocionais',
                        'image' => 'images/print-products/flyers-folhetos.png',
                        'tag' => 'PVC Rígido & Fitas Sublimadas',
                        'desc' => 'Sistema completo de identificação e controlo de acessos para congressos, com cartões rígidos em PVC resistentes e fitas lanyard sublimadas com logótipo.',
                        'specs' => ['Cartão: PVC rígido 0.76mm tipo cartão de crédito ou A6', 'Furo: Ovóide ou redondo de segurança', 'Fita: Cetim acetinado 20mm com impressão em sublimação HD', 'Acessório: Gancho mosquetão metálico giratório']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Produção Gráfica de Eventos e Sinalética da RACHI Print.'
            ],
            [
                'id' => 6,
                'slug' => 'embalagens-cartonagem-rotulos',
                'num' => '06',
                'tag' => 'EMBALAGENS, CARTONAGEM & RÓTULOS',
                'title' => 'Embalagens, Cartonagem, Sacolas & Rótulos',
                'short_desc' => 'Produção de embalagens em cartonagem, caixas rígidas personalizadas, sacolas corporativas e rótulos adesivos em alta definição.',
                'full_desc' => 'Valorize a apresentação e protecção dos seus produtos e presentes institucionais com soluções de embalagem sob medida. Produzimos caixas em cartonagem estruturada, caixas rígidas magnéticas de luxo, sacolas personalizadas em papel couché ou kraft com alças em cordão trançado, além de rótulos adesivos resistentes à humidade, etiquetas em bobina e selos de garantia.',
                'icon' => 'package',
                'image' => 'images/services/service-print-embalagens-rotulos.jpg',
                'color' => 'amber',
                'starting_price' => '35.000 Kz',
                'price_period' => 'preço base por lote',
                'cta_label' => 'Solicitar Cotação de Embalagens',
                'prazo' => '4 a 8 dias úteis (conforme faca e tiragem)',
                'garantia' => 'Protótipo / faca técnica validada antes da produção em série',
                'bullets' => [
                    'Caixas em cartonagem e caixas rígidas magnéticas VIP',
                    'Sacolas personalizadas em couché plastificado ou kraft',
                    'Rótulos adesivos em vinil/BOPP, etiquetas e selos'
                ],
                'applications' => 'Caixas de Produto, Caixas Rígidas para Kits VIP, Sacolas de Loja e Eventos, Cintas (Sleeves), Rótulos de Bebidas/Cosméticos/Alimentos e Selos de Segurança.',
                'includes' => [
                    'Desenvolvimento da planta técnica (faca de corte e vinco) ajustada às dimensões exactas do produto',
                    'Cartolinas triplex, papel kraft natural e cartão rígido empastado de elevada resistência mecânica',
                    'Acabamentos premium: plastificação mate/brilho, Soft-Touch, Hot-Stamping dourado/prateado e verniz UV',
                    'Sacolas reforçadas no fundo e nas dobras com ilhós metálicos e cordão de nylon, algodão ou fita de cetim',
                    'Impressão de rótulos e etiquetas em vinil branco, transparente ou metalizado com meio-corte electrónico',
                    'Controlo rigoroso de colagem, vinco e resistência para transporte e exposição em ponto de venda'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Medidas & Estrutura da Embalagem', 'desc' => 'Definimos as dimensões internas, peso do produto a acondicionar, tipo de cartão e acabamento.'],
                    ['num' => '02', 'title' => 'Planta Técnica (Faca) & Mockup', 'desc' => 'Criamos a planificação da faca com a arte aplicada para validação visual antes do corte.'],
                    ['num' => '03', 'title' => 'Impressão, Laminação & Troquelagem', 'desc' => 'Impressão de alta definição seguida de plastificação, corte e vinco de precisão milimétrica.'],
                    ['num' => '04', 'title' => 'Montagem, Colagem & Entrega', 'desc' => 'Acabamento manual ou automático, colocação de cordões/berços e entrega acondicionada.']
                ],
                'plans' => [
                    [
                        'name' => 'Rótulos, Etiquetas & Selos Adesivos',
                        'price' => '18.000 Kz',
                        'period' => 'lote inicial personalizado',
                        'desc' => 'Ideal para rotulagem de produtos comerciais, frascos, caixas de envio e selos de fecho.',
                        'popular' => false,
                        'features' => ['Impressão HD em vinil resistente à água ou papel couché adesivo', 'Recorte electrónico em qualquer formato (redondo, oval, especial)', 'Opção transparente, branco brilho, mate ou metalizado', 'Entrega em cartelas prontas a destacar ou bobinas']
                    ],
                    [
                        'name' => 'Sacolas Corporativas & Cartonagem',
                        'price' => '65.000 Kz',
                        'period' => 'lote institucional (50 a 100 un.)',
                        'desc' => 'Sacolas elegantes e embalagens dobráveis para eventos, lojas, brindes e entregas executivas.',
                        'popular' => true,
                        'features' => ['Papel Couché 250g laminado mate/brilho ou Kraft 200g', 'Reforço estrutural na base e na aba das alças', 'Alças em cordão trançado ou fita acetinada coordenada', 'Opção de verniz UV localizado no logótipo']
                    ],
                    [
                        'name' => 'Caixas Rígidas VIP & Linha Industrial',
                        'price' => 'Sob Cotação',
                        'period' => 'projecto sob medida',
                        'desc' => 'Caixas rígidas com fecho magnético e berço interno ou grandes tiragens de cartonagem comercial.',
                        'popular' => false,
                        'features' => ['Cartão rígido 2mm empastado com toque aveludado Soft-Touch', 'Berço interior em espuma EVA recortada à medida dos itens', 'Hot-Stamping metálico ou baixo-relevo na tampa', 'Condições especiais para grandes tiragens comerciais']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Caixas Rígidas Magnéticas & Cartonagem VIP',
                        'image' => 'images/services/service-print-embalagens-rotulos.jpg',
                        'tag' => 'Fecho Magnético & Hot-Stamping',
                        'desc' => 'Caixas estruturadas rígidas em cartão empastado para kits executivos, lançamentos de produtos e presentes institucionais de alto prestígio.',
                        'specs' => ['Estrutura: Cartão rígido 2.0mm a 2.5mm forrado', 'Fecho: Íman oculto na pala frontal ou tampa e fundo', 'Interior: Berço em EVA ou cartão moldado sob medida', 'Acabamento: Soft-Touch + Hot-Stamping dourado/prateado']
                    ],
                    [
                        'name' => 'Sacolas Corporativas de Luxo & Kraft',
                        'image' => 'images/portfolio-print/kit-corporativo-vip.jpg',
                        'tag' => 'Cordão Trançado & Fundo Reforçado',
                        'desc' => 'Sacolas institucionais personalizadas em múltiplos tamanhos para eventos, lojas, conferências e entrega de propostas e brindes.',
                        'specs' => ['Papel: Couché 250g plastificado ou Kraft natural', 'Alças: Cordão sintético, algodão torcido ou fita gorgurão', 'Acabamento: Ilhós metálicos opcionais e reforço de fundo', 'Formatos: Pequeno (brindes), Médio (A4) e Grande (kits)']
                    ],
                    [
                        'name' => 'Rótulos em Vinil, BOPP & Etiquetas Adesivas',
                        'image' => 'images/print-products/vinil-adesivo.png',
                        'tag' => 'À Prova de Água & Recorte Especial',
                        'desc' => 'Rótulos autocolantes de alta aderência para garrafas, cosméticos, produtos alimentares, embalagens logísticas e selos de autenticidade.',
                        'specs' => ['Substrato: Vinil branco/transparente, BOPP ou Couché adesivo', 'Resistência: Impermeável, resistente a refrigeração e fricção', 'Corte: Meio-corte computadorizado em qualquer contorno', 'Fornecimento: Cartelas planas ou rolos/bobinas']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Embalagens, Cartonagem, Sacolas ou Rótulos na RACHI Print.'
            ],
            [
                'id' => 7,
                'slug' => 'vestuario-bordados-textil',
                'num' => '07',
                'tag' => 'VESTUÁRIO CORPORATIVO & BORDADOS',
                'title' => 'Vestuário Corporativo, Bordados & Estampagem',
                'short_desc' => 'Polos, camisas sociais, coletes, t-shirts e bonés personalizados com bordado computadorizado, DTF têxtil e serigrafia.',
                'full_desc' => 'Uniformize a sua equipa com conforto, durabilidade e apresentação impecável. Fornecemos e personalizamos vestuário corporativo e promocional — polos em malha piquet, camisas sociais executivas, coletes acolchoados e operacionais, t-shirts 100% algodão e bonés — utilizando bordado industrial computadorizado de alta densidade, transferência DTF e serigrafia.',
                'icon' => 'shirt',
                'image' => 'images/portfolio-print/prancha-vestuario-branding.jpg',
                'color' => 'blue',
                'starting_price' => '28.000 Kz',
                'price_period' => 'lote inicial personalizado',
                'cta_label' => 'Solicitar Cotação de Vestuário',
                'prazo' => '3 a 7 dias úteis',
                'garantia' => 'Costuras reforçadas, bordados que não desfiam e estampas resistentes à lavagem',
                'bullets' => [
                    'Polos piquet, camisas sociais e coletes bordados',
                    'T-shirts promocionais em algodão com DTF ou serigrafia',
                    'Bonés estruturados, sacos de pano (tote bags) e fitas'
                ],
                'applications' => 'Uniformes de Escritório e Atendimento, Equipas Técnicas e de Campo, Vestuário para Feiras e Campanhas, Kits de Integração de Colaboradores.',
                'includes' => [
                    'Programação de matriz de bordado (picotagem digital) para relevo e nitidez perfeitos do logótipo',
                    'Tecidos seleccionados adequados ao clima de Angola: algodão penteado, piquet respirável e sarja',
                    'Personalização em múltiplas posições: peito esquerdo, mangas, costas e gola',
                    'Grade completa de tamanhos femininos e masculinos (S, M, L, XL, XXL e 3XL)',
                    'Estampagem DTF sem limite de cores para logótipos com gradientes ou detalhes fotográficos',
                    'Embalamento individual dobrado por tamanho para fácil distribuição interna'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Escolha das Peças & Grade', 'desc' => 'Selecção dos modelos (polos, camisas, t-shirts, coletes ou bonés), cores e tamanhos da equipa.'],
                    ['num' => '02', 'title' => 'Layout Técnico & Posicionamento', 'desc' => 'Simulação digital exacta das dimensões e posições dos bordados ou estampas em cada peça.'],
                    ['num' => '03', 'title' => 'Bordado / Estampagem Industrial', 'desc' => 'Execução em máquinas de bordar multicabeças ou prensas térmicas DTF/serigrafia calibradas.'],
                    ['num' => '04', 'title' => 'Revisão & Entrega por Tamanhos', 'desc' => 'Controlo peça a peça, acabamento de linhas, passagem a vapor e entrega organizada.']
                ],
                'plans' => [
                    [
                        'name' => 'Lote T-Shirts & Bonés de Campanha',
                        'price' => '28.000 Kz',
                        'period' => 'a partir de 10 unidades',
                        'desc' => 'Excelente relação qualidade-preço para acções de marketing, activações de rua e eventos.',
                        'popular' => false,
                        'features' => ['T-shirts 100% algodão macio ou Dry-Fit desportivo', 'Estampagem frontal e costas em DTF HD ou serigrafia', 'Opção de bonés personalizados coordenados', 'Entrega rápida para eventos']
                    ],
                    [
                        'name' => 'Uniformização Executiva (Polos & Camisas)',
                        'price' => '95.000 Kz',
                        'period' => 'pacote corporativo (15 a 25 peças)',
                        'desc' => 'Apresentação institucional elegante para equipas comerciais, técnicas e administrativas.',
                        'popular' => true,
                        'features' => ['Polos em malha piquet de alta gramagem ou camisas Oxford', 'Bordado computadorizado no peito e na manga', 'Matriz de bordado gratuita incluída no pacote', 'Modelagem masculina e feminina do S ao XXL']
                    ],
                    [
                        'name' => 'Fardamento Completo / Grandes Equipas',
                        'price' => 'Sob Cotação',
                        'period' => 'orçamento por escala',
                        'desc' => 'Soluções completas de fardamento anual para médias e grandes empresas e operações.',
                        'popular' => false,
                        'features' => ['Combinação de camisas, polos, coletes acolchoados/operacionais e bonés', 'Amostra física prévia para aprovação da administração', 'Descontos progressivos para lotes acima de 50 unidades', 'Reposição garantida com a mesma matriz e padrão de cor']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Polos, Camisas Sociais & Coletes Executivos',
                        'image' => 'images/portfolio-print/vestuario-corporativo.jpg',
                        'tag' => 'Bordado Computadorizado HD',
                        'desc' => 'Linha executiva de coletes acolchoados, polos piquet com detalhes contrastantes na gola, camisas sociais de manga comprida e t-shirts institucionais.',
                        'specs' => ['Tecidos: Piquet 220g, Algodão Oxford e Microfibra acolchoada', 'Personalização: Bordado de alta densidade no peito e manga', 'Tamanhos: S, M, L, XL, XXL e 3XL', 'Durabilidade: Cores firmes que não desbotam']
                    ],
                    [
                        'name' => 'Prancha Completa de Uniformização de Marca',
                        'image' => 'images/portfolio-print/prancha-vestuario-branding.jpg',
                        'tag' => 'Padronização Frente & Costas',
                        'desc' => 'Sistema coordenado de fardamento frente e verso garantindo unidade visual entre equipas técnicas, comerciais e atendimento.',
                        'specs' => ['Inclui: Colete, Polo, Camisa, T-Shirt e Boné', 'Aplicação: Logótipo frontal + assinatura institucional nas mangas/costas', 'Tecnologia: Combinação de bordado + DTF têxtil', 'Consultoria: Adequação à paleta oficial da empresa']
                    ],
                    [
                        'name' => 'Bonés Corporativos Bordados & Trucker',
                        'image' => 'images/portfolio-print/bones-corporativos-rachi.jpg',
                        'tag' => '4 Cores Oficiais & Ajuste Snapback',
                        'desc' => 'Bonés estruturados em sarja de algodão ou modelo trucker com rede respirável, personalizados com bordado 3D ou estampa de alta definição.',
                        'specs' => ['Modelos: Americano 6 gomos em sarja ou Trucker com rede', 'Cores: Azul-marinho, Branco, Preto, Amarelo e cores sob encomenda', 'Fecho: Fivela metálica ajustável ou snapback', 'Personalização: Bordado frontal plano/3D ou DTF']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Vestuário Corporativo, Bordados e Estampagem na RACHI Print.'
            ],
            [
                'id' => 8,
                'slug' => 'sinaletica-comunicacao-visual',
                'num' => '08',
                'tag' => 'SINALÉTICA, LETRAS 3D & FROTAS',
                'title' => 'Sinalética Corporativa, Letras 3D & Frotas',
                'short_desc' => 'Fachadas em ACM, logótipos 3D retroiluminados para recepção, placas direccionais, películas jateadas, decoração de frotas e outdoors.',
                'full_desc' => 'Transforme as instalações e viaturas da sua empresa em potentes activos de comunicação institucional. Projectamos, produzimos e instalamos letreiros 3D em acrílico, PVC expandido e aço inox com iluminação LED, revestimento de fachadas em ACM, placas direccionais internas, aplicação de vinil jateado em divisórias de vidro, decoração integral de frotas, lonas, outdoors e MUPIs.',
                'icon' => 'building-2',
                'image' => 'images/portfolio-print/sinaletica-fachada-recepcao.jpg',
                'color' => 'emerald',
                'starting_price' => '45.000 Kz',
                'price_period' => 'projecto sob medida',
                'cta_label' => 'Solicitar Cotação de Sinalética',
                'prazo' => '3 a 10 dias úteis (inclui opção de instalação)',
                'garantia' => 'Materiais com protecção UV, LEDs de alto brilho e acabamento arquitectónico',
                'bullets' => [
                    'Logótipos 3D retroiluminados LED para recepção e fachada',
                    'Placas direccionais, totens, vidro jateado e wall graphics',
                    'Envelopamento de viaturas/frotas, lonas, outdoors e MUPIs'
                ],
                'applications' => 'Recepções de Escritórios, Fachadas de Lojas e Sedes, Salas de Reunião (Vidro Jateado), Sinalética de Portas e Pisos, Carrinhas Comerciais e Outdoors.',
                'includes' => [
                    'Levantamento técnico de medidas e fotomontagem prévia no espaço ou viatura real do cliente',
                    'Corte CNC router e laser de precisão em acrílico cristal, PVC expandido, ACM e inox escovado',
                    'Sistemas de retroiluminação LED de baixo consumo com transformadores ocultos de longa vida útil',
                    'Vinil polimérico automotivo e vinil fosco jateado (frosted glass) para privacidade elegante em escritórios',
                    'Impressão em grande formato UV e eco-solvente resistente ao sol intenso e chuvas',
                    'Equipa técnica própria para aplicação e instalação limpa nas instalações do cliente em Luanda'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Levantamento de Medidas & Fotos', 'desc' => 'Avaliamos as dimensões da parede, fachada, vidros ou viatura para dimensionamento exacto.'],
                    ['num' => '02', 'title' => 'Simulação 3D / Fotomontagem', 'desc' => 'Apresentamos a visualização realista de como a sinalética ficará instalada no local.'],
                    ['num' => '03', 'title' => 'Fabricação CNC, LED & Impressão', 'desc' => 'Recorte computadorizado das letras caixa, pintura automotiva, cablagem LED e impressão UV.'],
                    ['num' => '04', 'title' => 'Instalação Técnica Especializada', 'desc' => 'Fixação nivelada com gabarito técnico no seu escritório, loja ou frota empresarial.']
                ],
                'plans' => [
                    [
                        'name' => 'Sinalética Interna & Vidros Jateados',
                        'price' => '45.000 Kz',
                        'period' => 'a partir de / ambiente',
                        'desc' => 'Identificação de salas, portas, directórios de piso e películas de privacidade para escritórios.',
                        'popular' => false,
                        'features' => ['Placas de porta e sinalética direccional em acrílico ou PVC/inox', 'Aplicação de vinil jateado com recorte do logótipo em divisórias de vidro', 'Mural institucional (wall graphic) com missão e valores', 'Instalação limpa sem interromper o expediente']
                    ],
                    [
                        'name' => 'Logótipo 3D de Recepção & Fachada',
                        'price' => '165.000 Kz',
                        'period' => 'projecto executivo de destaque',
                        'desc' => 'Impacto imediato logo na entrada da sua sede com letras caixa tridimensionais e luz LED.',
                        'popular' => true,
                        'features' => ['Logótipo 3D em acrílico/PVC/inox com acabamento premium', 'Opção de halo retroiluminado em LED branco quente, frio ou azul', 'Gabarito de montagem milimétrico e fonte de alimentação oculta', 'Montagem completa incluída em Luanda']
                    ],
                    [
                        'name' => 'Fachada Integral ACM & Frota Corporativa',
                        'price' => 'Sob Cotação',
                        'period' => 'projecto arquitectónico / frota',
                        'desc' => 'Para edifícios empresariais, redes de agências/lojas e frotas de viaturas comerciais.',
                        'popular' => false,
                        'features' => ['Revestimento de fachada em ACM com caixa de luz ou letras 3D', 'Totens exteriores autoportantes iluminados', 'Decoração parcial ou integral de viaturas com vinil laminado UV', 'Garantia de durabilidade exterior e manutenção técnica']
                    ]
                ],
                'products' => [
                    [
                        'name' => 'Fachada Externa, Recepção 3D & Vidro Jateado',
                        'image' => 'images/portfolio-print/sinaletica-fachada-recepcao.jpg',
                        'tag' => 'Letras 3D LED & Acrílico',
                        'desc' => 'Solução integrada de arquitectura de marca: placa externa, parede de recepção com logótipo 3D, directório iluminado, vidro jateado e wall graphic.',
                        'specs' => ['Materiais: ACM, Acrílico Cristal, PVC Expandido e Inox', 'Iluminação: Fita e módulos LED de alta eficiência', 'Vidros: Película fosca jateada com recorte electrónico', 'Acabamento: Pintura lacada nas cores exactas da marca']
                    ],
                    [
                        'name' => 'Totens Arquitectónicos & Recepção Corporativa',
                        'image' => 'images/services/service-print-sinaletica-comunicacao.jpg',
                        'tag' => 'Wayfinding & Lobby Executivo',
                        'desc' => 'Totens direccionais de recepção (wayfinding) e letras caixa metálicas retroiluminadas para edifícios corporativos, bancos, clínicas e sedes.',
                        'specs' => ['Estrutura: Alumínio composto escovado e aço inox', 'Visibilidade: Tipografia de alto contraste e pictogramas universais', 'Fixação: Pinos distanciadores ocultos ou base autoportante', 'Ambiente: Interior corporativo e entradas de edifícios']
                    ],
                    [
                        'name' => 'Decoração de Frotas, Outdoors & MUPIs',
                        'image' => 'images/portfolio-print/comunicacao-externa-frotas.jpg',
                        'tag' => 'Vinil Automotivo & Exterior',
                        'desc' => 'Transforme as carrinhas e viaturas da empresa em mídia móvel diária, complementada por lonas de fachada, outdoors e MUPIs.',
                        'specs' => ['Vinil Frota: Polimérico conformável com laminação protectora UV', 'Lonas: Frontlight/Backlight de alta tenacidade com bainha e ilhós', 'Durabilidade: Resistente a sol intenso, chuva e lavagens', 'Remoção: Preserva a pintura original da viatura']
                    ]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Sinalética Corporativa, Letras 3D ou Decoração de Frotas na RACHI Print.'
            ],
        ];
    }

    public function show(string $unit): View
    {
        return match ($unit) {
            'tec' => $this->tec(),
            'print' => $this->print(),
            'academy' => $this->academy(),
            'capital' => $this->capital(),
            default => abort(404),
        };
    }
}
