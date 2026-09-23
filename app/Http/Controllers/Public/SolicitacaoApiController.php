<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Customer;
use App\Models\Message;
use App\Models\ServiceRequest;
use App\Models\ServiceRequestStatusHistory;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SolicitacaoApiController extends Controller
{
    /**
     * Retorna lista de solicitações sincronizadas para a Central de Solicitações e Portal do Cliente
     */
    public function index(): JsonResponse
    {
        $requests = ServiceRequest::with([
            'customer.user',
            'businessUnit',
            'service',
            'assignedEmployee.user',
            'statusHistories' => fn($q) => $q->orderBy('created_at', 'asc'),
            'messages.user.role',
        ])
            ->latest('id')
            ->get()
            ->map(fn($sr) => $this->formatRequest($sr));

        return response()->json([
            'success' => true,
            'requests' => $requests,
        ]);
    }

    /**
     * Envia mensagem do cliente para a solicitação (SMS / Chat)
     */
    public function sendMessage(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:3000',
        ]);

        $serviceRequest = is_numeric($id)
            ? ServiceRequest::findOrFail($id)
            : ServiceRequest::where('protocol', $id)->firstOrFail();

        // Determina o remetente
        $senderUser = auth()->user() ?? $serviceRequest->customer?->user ?? User::where('email', 'admin@rachi.ao')->first() ?? User::find(1);

        $isStaff = $senderUser->isAdmin() || $senderUser->isEmployee();

        $message = Message::create([
            'service_request_id' => $serviceRequest->id,
            'user_id' => $senderUser->id,
            'message' => $validated['message'],
        ]);
        $message->load('user');

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'user_id' => $message->user_id,
                'sender' => $isStaff ? ($message->user?->name ?? 'Técnico RACHI') : 'Cliente',
                'nome' => $message->user?->name ?? ($isStaff ? 'Administração' : 'Cliente'),
                'message' => $message->message,
                'text' => $message->message,
                'data' => $message->created_at->format('d/m/Y H:i'),
                'fromUser' => !$isStaff,
                'is_staff' => $isStaff,
            ],
        ]);
    }

    /**
     * Cria nova solicitação vinda do Portal do Cliente
     */
    public function storeRequest(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:3000',
            'unit_id' => 'nullable',
            'priority' => 'nullable|string',
        ]);

        $user = auth()->user() ?? User::where('email', 'admin@rachi.ao')->first() ?? User::find(1);
        $customer = $user->customer ?? Customer::where('user_id', $user->id)->first();

        if (!$customer) {
            $customer = Customer::create([
                'user_id' => $user->id,
                'type' => 'company',
                'company_name' => $user->name,
                'trade_name' => 'RACHI Cliente',
                'phone' => '+244 923 000 000',
                'status' => 'active',
            ]);
        }

        // Determinar unidade
        $unitId = (int) ($validated['unit_id'] ?? 1);
        if ($unitId < 1 || $unitId > 4) $unitId = 1;

        // Protocolo autoincremental formatado
        $nextNum = ServiceRequest::count() + 1;
        $protocol = 'SOL-2026-' . str_pad($nextNum, 6, '0', STR_PAD_LEFT);

        $priorityMap = [
            'baixa' => 'low',
            'normal' => 'normal',
            'media' => 'normal',
            'alta' => 'high',
            'urgente' => 'urgent',
        ];
        $priority = $priorityMap[strtolower($validated['priority'] ?? 'normal')] ?? 'normal';

        $sr = ServiceRequest::create([
            'protocol' => $protocol,
            'customer_id' => $customer->id,
            'business_unit_id' => $unitId,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $priority,
            'status' => 'new',
            'requested_date' => now(),
            'estimated_date' => now()->addDays(15),
        ]);

        // Registo de histórico
        ServiceRequestStatusHistory::create([
            'service_request_id' => $sr->id,
            'user_id' => $user->id,
            'old_status' => null,
            'new_status' => 'new',
            'comment' => "Solicitação Criada (#{$protocol})",
        ]);

        $formatted = $this->formatRequest($sr->fresh([
            'customer.user',
            'businessUnit',
            'assignedEmployee.user',
            'statusHistories',
            'messages',
        ]));

        return response()->json([
            'success' => true,
            'message' => "Solicitação {$protocol} criada com sucesso!",
            'request' => $formatted,
        ]);
    }

    /**
     * Atualiza o estado da solicitação
     */
    public function updateStatus(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $sr = is_numeric($id)
            ? ServiceRequest::findOrFail($id)
            : ServiceRequest::where('protocol', $id)->firstOrFail();

        $statusMap = [
            'Novo' => 'new',
            'Em Análise' => 'in_analysis',
            'Orçamento' => 'quoted',
            'Ag. Cliente' => 'waiting_customer',
            'Em Execução' => 'in_progress',
            'Concluído' => 'completed',
            'Cancelado' => 'cancelled',
            'novo' => 'new',
            'analise' => 'in_analysis',
            'orcamento' => 'quoted',
            'aguardando' => 'waiting_customer',
            'execucao' => 'in_progress',
            'concluido' => 'completed',
            'cancelado' => 'cancelled',
        ];

        $newStatus = $statusMap[$validated['status']] ?? $validated['status'];
        $oldStatus = $sr->status;

        $sr->update(['status' => $newStatus]);
        if ($newStatus === 'completed') $sr->update(['completed_at' => now()]);
        if ($newStatus === 'cancelled') $sr->update(['cancelled_at' => now()]);

        ServiceRequestStatusHistory::create([
            'service_request_id' => $sr->id,
            'user_id' => auth()->id() ?? 1,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'comment' => $validated['comment'] ?? "Status alterado para {$validated['status']}",
        ]);

        return response()->json([
            'success' => true,
            'request' => $this->formatRequest($sr->fresh([
                'customer.user',
                'businessUnit',
                'assignedEmployee.user',
                'statusHistories',
                'messages',
            ])),
        ]);
    }

    private function formatRequest(ServiceRequest $sr): array
    {
        $statusLabels = [
            'new' => 'Novo',
            'in_analysis' => 'Em Análise',
            'waiting_customer' => 'Ag. Cliente',
            'quoted' => 'Orçamento',
            'approved' => 'Aprovado',
            'in_progress' => 'Em Execução',
            'in_review' => 'Em Revisão',
            'completed' => 'Concluído',
            'cancelled' => 'Cancelado',
        ];
        $statusStyles = [
            'new' => ['s-novo', 'bg-indigo-500'],
            'in_analysis' => ['s-analise', 'bg-amber-500'],
            'waiting_customer' => ['s-wait', 'bg-orange-500'],
            'quoted' => ['s-exec', 'bg-blue-500'],
            'approved' => ['s-ativo', 'bg-emerald-500'],
            'in_progress' => ['s-exec', 'bg-cyan-500'],
            'in_review' => ['s-analise', 'bg-purple-500'],
            'completed' => ['s-done', 'bg-emerald-500'],
            'cancelled' => ['s-cancel', 'bg-rose-500'],
        ];

        [$style, $dot] = $statusStyles[$sr->status] ?? ['s-analise', 'bg-blue-500'];

        $unitBadges = [
            'RACHI Tec' => 'bg-blue-500/15 text-blue-700 border-blue-200',
            'RACHI Print' => 'bg-amber-500/15 text-amber-700 border-amber-200',
            'RACHI Academy' => 'bg-indigo-500/15 text-indigo-700 border-indigo-200',
            'RACHI Human Capital' => 'bg-emerald-500/15 text-emerald-700 border-emerald-200',
        ];

        $unitName = $sr->businessUnit?->name ?? 'RACHI Tec';

        return [
            'id' => $sr->id,
            'protocol' => $sr->protocol,
            'titulo' => $sr->title,
            'title' => $sr->title,
            'cliente' => $sr->customer?->display_name ?? 'Cliente RACHI',
            'empresa' => $sr->customer?->company_name ?? $sr->customer?->trade_name ?? 'RACHI S.A.',
            'servico' => $unitName,
            'unit' => $unitName,
            'unitBadge' => $unitBadges[$unitName] ?? 'bg-slate-100 text-slate-700 border-slate-200',
            'descricao' => $sr->description,
            'data' => $sr->created_at?->format('d/m/Y H:i') ?? '',
            'status' => $statusLabels[$sr->status] ?? ucfirst($sr->status),
            'statusLabel' => $statusLabels[$sr->status] ?? ucfirst($sr->status),
            'status_key' => $sr->status,
            'priority' => ucfirst($sr->priority ?? 'normal'),
            'sc' => $style,
            'dot' => $dot,
            'responsavel' => $sr->assignedEmployee?->user?->name ?? 'Casimiro Gundja (Especialista Web)',
            'timeline' => $sr->statusHistories->map(fn($h) => [
                'data' => $h->created_at?->format('d/m/Y H:i') ?? '',
                'date' => $h->created_at?->format('d/m/Y H:i') ?? '',
                'title' => $h->comment ?: ($statusLabels[$h->new_status] ?? ucfirst($h->new_status)),
                'desc' => $h->comment ?: ($statusLabels[$h->new_status] ?? ucfirst($h->new_status)),
                'dot' => $dot,
            ])->values(),
            'messages' => $sr->messages->map(function ($m) use ($sr) {
                $isStaff = $m->user ? ($m->user->isAdmin() || $m->user->isEmployee()) : false;
                return [
                    'id' => $m->id,
                    'user_id' => $m->user_id,
                    'sender' => $isStaff ? ($m->user?->name ?? 'Técnico RACHI') : 'Cliente',
                    'nome' => $m->user?->name ?? ($isStaff ? 'Administração' : 'Cliente'),
                    'message' => $m->message,
                    'text' => $m->message,
                    'data' => $m->created_at?->format('d/m/Y H:i') ?? '',
                    'fromUser' => !$isStaff,
                    'is_staff' => $isStaff,
                ];
            })->values(),
        ];
    }
}
