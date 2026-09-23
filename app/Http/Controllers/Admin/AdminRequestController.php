<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\ServiceRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AdminRequestController extends Controller
{
    public function allRequests(): Collection
    {
        return ServiceRequest::with([
            'customer.user',
            'businessUnit',
            'service',
            'assignedEmployee.user',
            'statusHistories.user',
            'messages.user.role',
        ])
            ->latest()
            ->limit(100)
            ->get()
            ->map(fn (ServiceRequest $serviceRequest) => $this->present($serviceRequest));
    }

    public function index(): JsonResponse
    {
        return response()->json(['requests' => $this->allRequests()]);
    }

    public function sendMessage(Request $request, ServiceRequest $serviceRequest): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'service_request_id' => $serviceRequest->id,
            'user_id' => $request->user()->id,
            'message' => $validated['message'],
        ])->load('user');

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'user_id' => $message->user_id,
                'nome' => $message->user?->name ?? 'Administração',
                'sender' => $message->user?->name ?? 'Administração',
                'message' => $message->message,
                'text' => $message->message,
                'data' => $message->created_at->format('d/m/Y H:i'),
                'is_staff' => true,
                'fromUser' => false,
            ],
        ]);
    }

    public function updateStatus(Request $request, ServiceRequest $serviceRequest): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $statusMap = [
            'Novo' => 'new',
            'Em Análise' => 'in_analysis',
            'Orçamento' => 'quoted',
            'Ag. Cliente' => 'waiting_customer',
            'Em Execução' => 'in_progress',
            'Em Revisão' => 'in_review',
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
        $oldStatus = $serviceRequest->status;

        $serviceRequest->update(['status' => $newStatus]);
        if ($newStatus === 'completed') $serviceRequest->update(['completed_at' => now()]);
        if ($newStatus === 'cancelled') $serviceRequest->update(['cancelled_at' => now()]);

        \App\Models\ServiceRequestStatusHistory::create([
            'service_request_id' => $serviceRequest->id,
            'user_id' => $request->user()?->id ?? 1,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'comment' => $validated['comment'] ?? "Status alterado para {$validated['status']} pelo administrador",
            'created_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'request' => $this->present($serviceRequest->fresh([
                'customer.user',
                'businessUnit',
                'service',
                'assignedEmployee.user',
                'statusHistories.user',
                'messages.user.role',
            ])),
        ]);
    }

    private function present(ServiceRequest $serviceRequest): array
    {
        $statusLabels = [
            'new' => 'Nova',
            'in_analysis' => 'Em análise',
            'waiting_customer' => 'Aguardando Cliente',
            'quoted' => 'Orçamentada',
            'approved' => 'Aprovada',
            'in_progress' => 'Em execução',
            'in_review' => 'Em revisão',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
        ];
        $statusStyles = [
            'new' => ['s-novo', 'bg-indigo-500'],
            'in_analysis' => ['s-analise', 'bg-amber-500'],
            'waiting_customer' => ['s-wait', 'bg-orange-500'],
            'quoted' => ['s-analise', 'bg-blue-500'],
            'approved' => ['s-ativo', 'bg-emerald-500'],
            'in_progress' => ['s-exec', 'bg-cyan-500'],
            'in_review' => ['s-analise', 'bg-purple-500'],
            'completed' => ['s-done', 'bg-emerald-500'],
            'cancelled' => ['s-cancel', 'bg-rose-500'],
        ];

        [$style, $dot] = $statusStyles[$serviceRequest->status] ?? ['s-novo', 'bg-blue-500'];

        $unitBadges = [
            'RACHI Tec' => 'bg-blue-500/15 text-blue-700 border-blue-200',
            'RACHI Print' => 'bg-amber-500/15 text-amber-700 border-amber-200',
            'RACHI Academy' => 'bg-indigo-500/15 text-indigo-700 border-indigo-200',
            'RACHI Human Capital' => 'bg-emerald-500/15 text-emerald-700 border-emerald-200',
        ];

        $unitName = $serviceRequest->businessUnit?->name ?? $serviceRequest->service?->name ?? 'RACHI Tec';

        return [
            'id' => $serviceRequest->id,
            'protocol' => $serviceRequest->protocol,
            'title' => $serviceRequest->title,
            'titulo' => $serviceRequest->title,
            'cliente' => $serviceRequest->customer?->display_name ?? 'Cliente',
            'empresa' => $serviceRequest->customer?->company_name
                ?? $serviceRequest->customer?->trade_name
                ?? 'Particular',
            'servico' => $unitName,
            'unit' => $unitName,
            'unitBadge' => $unitBadges[$unitName] ?? 'bg-slate-100 text-slate-700 border-slate-200',
            'descricao' => trim($serviceRequest->title . ': ' . $serviceRequest->description, ': '),
            'description' => $serviceRequest->description,
            'data' => $serviceRequest->created_at?->format('d/m/Y H:i') ?? '',
            'status' => $statusLabels[$serviceRequest->status] ?? ucfirst($serviceRequest->status),
            'statusLabel' => $statusLabels[$serviceRequest->status] ?? ucfirst($serviceRequest->status),
            'status_key' => $serviceRequest->status,
            'priority' => ucfirst($serviceRequest->priority ?? 'normal'),
            'sc' => $style,
            'dot' => $dot,
            'responsavel' => $serviceRequest->assignedEmployee?->user?->name ?? 'Casimiro Gundja (Especialista Web)',
            'technician' => $serviceRequest->assignedEmployee?->user?->name ?? 'Casimiro Gundja (Especialista Web)',
            'timeline' => $serviceRequest->statusHistories->map(fn ($history) => [
                'data' => $history->created_at?->format('d/m/Y H:i') ?? '',
                'date' => $history->created_at?->format('d/m/Y H:i') ?? '',
                'desc' => $history->comment ?: ($statusLabels[$history->new_status] ?? ucfirst((string) $history->new_status)),
                'title' => $history->comment ?: ($statusLabels[$history->new_status] ?? ucfirst((string) $history->new_status)),
                'dot' => $dot,
            ])->values(),
            'messages' => $serviceRequest->messages->map(function (Message $message) use ($serviceRequest) {
                $isStaff = $message->user_id !== $serviceRequest->customer?->user_id;
                return [
                    'id' => $message->id,
                    'user_id' => $message->user_id,
                    'nome' => $message->user?->name ?? ($isStaff ? 'Administração' : 'Cliente'),
                    'sender' => $message->user?->name ?? ($isStaff ? 'Administração' : 'Cliente'),
                    'message' => $message->message,
                    'text' => $message->message,
                    'data' => $message->created_at?->format('d/m/Y H:i') ?? '',
                    'is_staff' => $isStaff,
                    'fromUser' => !$isStaff,
                ];
            })->values(),
        ];
    }
}
