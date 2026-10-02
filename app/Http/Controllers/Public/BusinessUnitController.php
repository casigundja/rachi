<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Service;
use App\Models\Product;
use App\Models\Course;
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
                    'Reconciliação bancária periódica e controle de amortizações',
                    'Preparação de Relatório de Gestão e Contas Anual para a AGT',
                    'Assinatura técnica por Perito Contabilista habilitado'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Recolha Documental', 'desc' => 'Organização e classificação de faturas de compras, vendas, extratos e recibos.'],
                    ['num' => '02', 'title' => 'Lançamento & Reconciliação', 'desc' => 'Escrituração no software certificado e reconciliação bancária minuciosa.'],
                    ['num' => '03', 'title' => 'Obrigações Fiscais (AGT)', 'desc' => 'Cálculo de IVA, IRT, Imposto do Selo e retenções na fonte com submissão tempestiva.'],
                    ['num' => '04', 'title' => 'Relatórios de Gestão', 'desc' => 'Disponibilização de balancetes mensais e demonstrações de resultados para a diretoria.']
                ],
                'plans' => [
                    ['name' => 'Microempresa (Simplificado)', 'price' => '95.000 Kz', 'period' => '/mês', 'desc' => 'Para empresas até 5 colaboradores com volume moderado de faturação.', 'popular' => false, 'features' => ['Classificação e lançamento de faturas', 'Apuramento de impostos mensais', 'Balancete trimestral', 'Suporte fiscal por email/WhatsApp']],
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
                    ['num' => '02', 'title' => 'Inscrição da Entidade', 'desc' => 'Cadastro formal da entidade empregadora e validação nos serviços do INSS.'],
                    ['num' => '03', 'title' => 'Cadastro dos Trabalhadores', 'desc' => 'Inscrição individual de cada colaborador e geração do número de segurado.'],
                    ['num' => '04', 'title' => 'Emissão de Guias & Certidão', 'desc' => 'Processamento da folha inicial de remunerações e obtenção da certidão de quitação.']
                ],
                'plans' => [
                    ['name' => 'Inscrição Inicial (até 5 trabalhadores)', 'price' => '65.000 Kz', 'period' => 'taxa única', 'desc' => 'Inscrição da empresa e primeiro lote de trabalhadores no INSS.', 'popular' => false, 'features' => ['Número de contribuinte da empresa', 'Inscrição de até 5 colaboradores', 'Acesso ao portal digital do INSS', 'Emissão da 1ª guia de pagamento']],
                    ['name' => 'Inscrição Corporativa (até 20 colaboradores)', 'price' => '110.000 Kz', 'period' => 'taxa única', 'desc' => 'Cadastro massivo com conferência de documentação individual e emissão de cartões.', 'popular' => true, 'features' => ['Inscrição de até 20 funcionários', 'Regularização de pendências cadastrais', 'Parametrização no portal do INSS', 'Certidão de Não Devedor incluída']],
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
                    'Repositório centralizado e seguro na nuvem com controle de permissões e histórico',
                    'Formação prática de utilizadores com elaboração de guia passo a passo'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Mapeamento do Fluxo', 'desc' => 'Análise minuciosa de como o processo corre hoje e onde ocorrem atrasos ou falhas.'],
                    ['num' => '02', 'title' => 'Desenho da Solução', 'desc' => 'Modelagem do fluxo digital otimizado e validação dos campos com os responsáveis.'],
                    ['num' => '03', 'title' => 'Configuração & Automação', 'desc' => 'Parametrização das regras de aprovação, avisos e repositório documental.'],
                    ['num' => '04', 'title' => 'Testes & Virada', 'desc' => 'Simulação prática com utilizadores, formação da equipa e entrada em produção.']
                ],
                'plans' => [
                    ['name' => 'Automação de Fluxo Único', 'price' => '140.000 Kz', 'period' => 'projeto base', 'desc' => 'Digitalização de 1 processo crítico (ex: requisições de compras, pedidos de férias ou despesas).', 'popular' => false, 'features' => ['Mapeamento de 1 fluxo de ponta a ponta', 'Formulário digital com aprovação', 'Notificações automáticas por email', 'Treinamento de utilizadores']],
                    ['name' => 'Pacote Operacional Integrado', 'price' => '280.000 Kz', 'period' => 'projeto base', 'desc' => 'Digitalização de até 3 processos vitais da rotina da sua empresa.', 'popular' => true, 'features' => ['Até 3 fluxos automatizados integrados', 'Repositório digital com controle de acesso', 'Dashboard de status das solicitações', 'Regras avançadas de aprovação', 'Suporte assistido por 60 dias']],
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
                'full_desc' => 'Implementamos sistemas de gestão comercial e ERP adaptados às exigências legais e fiscais de Angola. Faturação certificada pela AGT com emissão de QR Code e ficheiro SAF-T, controle rigoroso de estoques, contas correntes, tesouraria e formação presencial da sua equipa.',
                'icon' => 'database',
                'image' => 'images/services/service-implementacao-sistemas-gestao.jpg',
                'color' => 'emerald',
                'starting_price' => '160.000 Kz',
                'price_period' => 'implantação base',
                'cta_label' => 'Implementar Sistema',
                'prazo' => '15 a 45 dias úteis',
                'garantia' => 'Faturação 100% conforme regras da AGT com suporte no 1º fecho',
                'bullets' => [
                    'Sistemas sob medida',
                    'Integração com processos actuais',
                    'Formação da equipa utilizadora'
                ],
                'includes' => [
                    'Instalação e parametrização do software de gestão conforme o regime fiscal da empresa',
                    'Configuração do módulo de Faturação Certificada pela AGT (QR Code e ficheiro SAF-T)',
                    'Configuração de controlo de stocks, preços, clientes, fornecedores e tesouraria',
                    'Importação e higienização dos cadastros históricos de artigos e clientes',
                    'Perfis de acesso personalizados para vendedores, operadores de caixa e gerentes',
                    'Formação prática presencial/remota e acompanhamento presencial no primeiro dia de uso'
                ],
                'steps' => [
                    ['num' => '01', 'title' => 'Levantamento Fiscal & Operacional', 'desc' => 'Compreensão das regras de tributação (IVA, retenções) e categorias de produtos/serviços.'],
                    ['num' => '02', 'title' => 'Parametrização & Cadastros', 'desc' => 'Configuração completa do sistema e importação dos dados iniciais da empresa.'],
                    ['num' => '03', 'title' => 'Formação & Homologação', 'desc' => 'Capacitação prática dos operadores, testes de emissão de faturas e notas de crédito.'],
                    ['num' => '04', 'title' => 'Entrada em Produção', 'desc' => 'Início oficial da operação com assistência técnica dedicada em tempo real.']
                ],
                'plans' => [
                    ['name' => 'Faturação Essencial AGT', 'price' => '160.000 Kz', 'period' => 'implantação base', 'desc' => 'Para estabelecimentos comerciais e prestadores de serviços que necessitam de faturação legal rápida.', 'popular' => false, 'features' => ['Software certificado pela AGT', 'Emissão de faturas, recibos e guias', 'Configuração de impressora térmica ou A4', 'Geração de ficheiro SAF-T mensal', 'Treinamento de operadores']],
                    ['name' => 'Gestão Comercial & Estoques', 'price' => '320.000 Kz', 'period' => 'implantação base', 'desc' => 'Controlo completo de vendas, stocks múltiplos, caixa diário e contas correntes.', 'popular' => true, 'features' => ['Todos os recursos de Faturação AGT', 'Gestão multi-armazém e inventário', 'Contas a receber, a pagar e tesouraria', 'Relatórios financeiros e lucratividade', 'Suporte prioritário no primeiro fecho']],
                    ['name' => 'ERP Corporativo Avançado', 'price' => 'Sob Cotação', 'period' => 'implantação sob medida', 'desc' => 'Para médias e grandes empresas com múltiplas sucursais, produção ou departamentos integrados.', 'popular' => false, 'features' => ['Múltiplas lojas interligadas em tempo real', 'Módulo de Recursos Humanos / Salários', 'Contabilidade geral integrada', 'Desenvolvimento de relatórios customizados', 'SLA de manutenção VIP']]
                ],
                'whatsapp_msg' => 'Olá! Gostaria de solicitar informações sobre a Implementação de Sistema de Gestão / Faturação AGT com a RACHI Tec.'
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
                    'Emissão de fatura comercial com dedução de IVA e entrega corporativa direta'
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
                        'features' => ['Produção em grande escala com desconto de volume', 'Garantia de reposição de stock em 48h úteis', 'Linha de atendimento corporativo dedicada', 'Faturação com prazos de crédito negociados']
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
                'whatsapp_msg' => 'Olá! Gostaria de solicitar cotação para Produção Gráfica de Eventos e Sinalética da RACHI Print.'
            ]
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
