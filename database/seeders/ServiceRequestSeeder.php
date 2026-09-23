<?php

namespace Database\Seeders;

use App\Models\BusinessUnit;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Message;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestStatusHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ServiceRequestSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@rachi.ao')->first() ?? User::find(1);
        $casimiroUser = User::where('email', 'casimirogundja@outlook.com')->first() ?? User::find(7);

        // Garantir Customer para o Super Administrador RACHI
        $adminCustomer = Customer::updateOrCreate(
            ['user_id' => $adminUser->id],
            [
                'type' => 'company',
                'company_name' => 'Super Administrador RACHI',
                'trade_name' => 'RACHI S.A.',
                'phone' => '+244 923 000 000',
                'whatsapp' => '+244 923 000 000',
                'status' => 'active',
            ]
        );

        // Garantir Employee para o Técnico Casimiro
        $techEmployee = null;
        if ($casimiroUser) {
            $techEmployee = Employee::updateOrCreate(
                ['user_id' => $casimiroUser->id],
                [
                    'employee_code' => 'EMP-TEC-007',
                    'position' => 'Engenheiro de Sistemas & Especialista Web',
                    'department' => 'Tecnologia da Informação',
                    'business_unit_id' => 1,
                    'hire_date' => '2024-01-15',
                    'status' => 'active',
                ]
            );
        }

        $tecUnit = BusinessUnit::where('slug', 'tec')->first() ?? BusinessUnit::find(1);
        $printUnit = BusinessUnit::where('slug', 'print')->first() ?? BusinessUnit::find(2);
        $capitalUnit = BusinessUnit::where('slug', 'capital')->first() ?? BusinessUnit::find(4);

        // 1. SOL-2026-000001 (RACHI Tec - Website)
        $req1 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000001'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $tecUnit?->id ?? 1,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Desenvolvimento de Novo Website Institucional & Portal',
                'description' => 'Modernização do portal corporativo com área de agendamento de consultas, catálogo de produtos e integração de pagamentos.',
                'priority' => 'high',
                'status' => 'in_analysis',
                'requested_date' => Carbon::create(2026, 9, 19),
                'estimated_date' => Carbon::create(2026, 10, 25),
                'created_at' => Carbon::create(2026, 9, 19, 9, 15, 0),
                'updated_at' => Carbon::create(2026, 9, 19, 11, 45, 0),
            ]
        );

        // Históricos SOL-2026-000001
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req1->id, 'new_status' => 'new'],
            [
                'user_id' => $adminUser->id,
                'old_status' => null,
                'comment' => 'Solicitação Criada (#SOL-2026-000001)',
                'created_at' => Carbon::create(2026, 9, 19, 9, 15, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req1->id, 'new_status' => 'assigned'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Atribuída ao Técnico Casimiro Gundja',
                'created_at' => Carbon::create(2026, 9, 19, 10, 30, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req1->id, 'new_status' => 'in_analysis'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'assigned',
                'comment' => 'Em Análise de Requisitos e Arquitetura',
                'created_at' => Carbon::create(2026, 9, 19, 11, 0, 0),
            ]
        );

        // Mensagens SOL-2026-000001
        Message::firstOrCreate(
            ['service_request_id' => $req1->id, 'message' => 'Olá, enviamos o briefing técnico e a paleta da nossa marca.'],
            [
                'user_id' => $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 19, 11, 15, 0),
            ]
        );
        Message::firstOrCreate(
            ['service_request_id' => $req1->id, 'message' => 'Recebido com sucesso! Estamos finalizando a proposta orçamentária detalhada.'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 19, 11, 45, 0),
            ]
        );

        // 2. SOL-2026-000002 (RACHI Print - Brindes & Catálogos)
        $req2 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000002'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $printUnit?->id ?? 2,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Produção de Material Gráfico & Brindes Corporativos',
                'description' => 'Impressão offset de 1.000 catálogos com laminação fosca, 2 Roll-ups retráteis e 200 pastas institucionais com bolsa.',
                'priority' => 'normal',
                'status' => 'in_progress',
                'requested_date' => Carbon::create(2026, 9, 16),
                'estimated_date' => Carbon::create(2026, 9, 24),
                'created_at' => Carbon::create(2026, 9, 16, 14, 0, 0),
                'updated_at' => Carbon::create(2026, 9, 20, 16, 30, 0),
            ]
        );

        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req2->id, 'new_status' => 'new'],
            [
                'user_id' => $adminUser->id,
                'old_status' => null,
                'comment' => 'Ordem de Produção Iniciada',
                'created_at' => Carbon::create(2026, 9, 16, 14, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req2->id, 'new_status' => 'approved'],
            [
                'user_id' => $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Prova de Cor e Impressão Aprovada',
                'created_at' => Carbon::create(2026, 9, 17, 11, 20, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req2->id, 'new_status' => 'in_progress'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'approved',
                'comment' => 'Em Fase de Acabamento & Corte',
                'created_at' => Carbon::create(2026, 9, 20, 16, 30, 0),
            ]
        );

        Message::firstOrCreate(
            ['service_request_id' => $req2->id, 'message' => 'A prova digital ficou excelente, autorizamos a tiragem completa.'],
            [
                'user_id' => $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 16, 15, 30, 0),
            ]
        );
        Message::firstOrCreate(
            ['service_request_id' => $req2->id, 'message' => 'Ótimo! Previsão de entrega do lote para quinta-feira no vosso escritório.'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 16, 16, 0, 0),
            ]
        );

        // 3. SOL-2026-000003 (RACHI Capital - RH)
        $req3 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000003'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $capitalUnit?->id ?? 4,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Diagnóstico e Estruturação de Cargos & Salários',
                'description' => 'Elaboração de manual de cargos, matriz de competências e plano de cargos e salários para 28 colaboradores.',
                'priority' => 'normal',
                'status' => 'completed',
                'requested_date' => Carbon::create(2026, 9, 5),
                'estimated_date' => Carbon::create(2026, 9, 18),
                'completed_at' => Carbon::create(2026, 9, 18, 17, 0, 0),
                'created_at' => Carbon::create(2026, 9, 5, 10, 0, 0),
                'updated_at' => Carbon::create(2026, 9, 18, 17, 30, 0),
            ]
        );

        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req3->id, 'new_status' => 'new'],
            [
                'user_id' => $adminUser->id,
                'old_status' => null,
                'comment' => 'Contrato de Consultoria Ativado',
                'created_at' => Carbon::create(2026, 9, 5, 10, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req3->id, 'new_status' => 'in_progress'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Apresentação do Diagnóstico Preliminar',
                'created_at' => Carbon::create(2026, 9, 12, 15, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req3->id, 'new_status' => 'completed'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'in_progress',
                'comment' => 'Entrega do Dossiê Final e Homologação',
                'created_at' => Carbon::create(2026, 9, 18, 17, 0, 0),
            ]
        );

        Message::firstOrCreate(
            ['service_request_id' => $req3->id, 'message' => 'Dossiê final homologado e entregue com sucesso à Direção.'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 18, 17, 30, 0),
            ]
        );

        $academyUnit = BusinessUnit::where('slug', 'academy')->first() ?? BusinessUnit::find(3);

        // 4. SOL-2026-000004 (RACHI Academy - Formação Executiva) -> 'new'
        $req4 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000004'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $academyUnit?->id ?? 3,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Formação Executiva em Cibersegurança & Proteção de Dados',
                'description' => 'Solicitação de turma corporativa in-company para 15 gestores da área de infraestrutura de TI.',
                'priority' => 'high',
                'status' => 'new',
                'requested_date' => Carbon::create(2026, 9, 21),
                'estimated_date' => Carbon::create(2026, 10, 10),
                'created_at' => Carbon::create(2026, 9, 21, 8, 30, 0),
                'updated_at' => Carbon::create(2026, 9, 21, 8, 30, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req4->id, 'new_status' => 'new'],
            [
                'user_id' => $adminUser->id,
                'old_status' => null,
                'comment' => 'Solicitação Aberta (#SOL-2026-000004)',
                'created_at' => Carbon::create(2026, 9, 21, 8, 30, 0),
            ]
        );
        Message::firstOrCreate(
            ['service_request_id' => $req4->id, 'message' => 'Gostaríamos de saber a disponibilidade de instrutores para início na primeira quinzena de outubro.'],
            [
                'user_id' => $adminUser->id,
                'created_at' => Carbon::create(2026, 9, 21, 8, 35, 0),
            ]
        );

        // 5. SOL-2026-000005 (RACHI Tec - Instalação de Servidor & Firewall) -> 'quoted'
        $req5 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000005'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $tecUnit?->id ?? 1,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Implementação de Servidor Local & Firewall Perimetral',
                'description' => 'Fornecimento e parametrização de firewall com VPN corporativa, backup redundante e controle de tráfego.',
                'priority' => 'normal',
                'status' => 'quoted',
                'requested_date' => Carbon::create(2026, 9, 18),
                'estimated_date' => Carbon::create(2026, 10, 5),
                'created_at' => Carbon::create(2026, 9, 18, 14, 0, 0),
                'updated_at' => Carbon::create(2026, 9, 20, 10, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req5->id, 'new_status' => 'new'],
            [
                'user_id' => $adminUser->id,
                'old_status' => null,
                'comment' => 'Solicitação Criada (#SOL-2026-000005)',
                'created_at' => Carbon::create(2026, 9, 18, 14, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req5->id, 'new_status' => 'quoted'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Proposta comercial orçamentada e enviada para aprovação do cliente.',
                'created_at' => Carbon::create(2026, 9, 20, 10, 0, 0),
            ]
        );

        // 6. SOL-2026-000006 (RACHI Human Capital - Recrutamento TI) -> 'waiting_customer'
        $req6 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000006'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $capitalUnit?->id ?? 4,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Recrutamento & Hunting de 3 Engenheiros de Software',
                'description' => 'Triagem, aplicação de testes técnicos e entrevistas para contratação imediata de 3 desenvolvedores Full Stack.',
                'priority' => 'high',
                'status' => 'waiting_customer',
                'requested_date' => Carbon::create(2026, 9, 17),
                'estimated_date' => Carbon::create(2026, 10, 1),
                'created_at' => Carbon::create(2026, 9, 17, 16, 20, 0),
                'updated_at' => Carbon::create(2026, 9, 21, 11, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req6->id, 'new_status' => 'waiting_customer'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'in_analysis',
                'comment' => 'Aguardando validação dos perfis finais pela Direção do Cliente.',
                'created_at' => Carbon::create(2026, 9, 21, 11, 0, 0),
            ]
        );

        // 7. SOL-2026-000007 (RACHI Print - Crachás e Pastas Corporativas) -> 'in_analysis'
        $req7 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000007'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $printUnit?->id ?? 2,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Confecção de 500 Pastas Institucionais & Crachás PVC',
                'description' => 'Impressão em PVC 0.76mm com cordão personalizado e pastas com acabamento especial e corte a laser.',
                'priority' => 'normal',
                'status' => 'in_analysis',
                'requested_date' => Carbon::create(2026, 9, 21),
                'estimated_date' => Carbon::create(2026, 9, 29),
                'created_at' => Carbon::create(2026, 9, 21, 10, 15, 0),
                'updated_at' => Carbon::create(2026, 9, 21, 12, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req7->id, 'new_status' => 'in_analysis'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Em análise de viabilidade de matéria-prima e prazo de entrega.',
                'created_at' => Carbon::create(2026, 9, 21, 12, 0, 0),
            ]
        );

        // 8. SOL-2026-000008 (RACHI Tec - Manutenção de Equipamentos Descontinuados) -> 'cancelled'
        $req8 = ServiceRequest::updateOrCreate(
            ['protocol' => 'SOL-2026-000008'],
            [
                'customer_id' => $adminCustomer->id,
                'business_unit_id' => $tecUnit?->id ?? 1,
                'assigned_to' => $techEmployee?->id,
                'title' => 'Reparação de Servidores Legados Fora de Garantia',
                'description' => 'Pedido cancelado por indisponibilidade de peças originais no fabricante internacional.',
                'priority' => 'low',
                'status' => 'cancelled',
                'requested_date' => Carbon::create(2026, 9, 10),
                'cancelled_at' => Carbon::create(2026, 9, 12, 14, 0, 0),
                'created_at' => Carbon::create(2026, 9, 10, 11, 0, 0),
                'updated_at' => Carbon::create(2026, 9, 12, 14, 0, 0),
            ]
        );
        ServiceRequestStatusHistory::firstOrCreate(
            ['service_request_id' => $req8->id, 'new_status' => 'cancelled'],
            [
                'user_id' => $casimiroUser?->id ?? $adminUser->id,
                'old_status' => 'new',
                'comment' => 'Cancelado a pedido do cliente devido à obsolescência dos componentes.',
                'created_at' => Carbon::create(2026, 9, 12, 14, 0, 0),
            ]
        );
    }
}
