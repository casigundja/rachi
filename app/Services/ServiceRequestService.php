<?php

namespace App\Services;

use App\Models\ServiceRequest;
use App\Models\ServiceRequestStatusHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class ServiceRequestService
{
    /**
     * Cria uma nova solicitação de serviço gerando protocolo único (RN003).
     * Exemplo: SOL-2026-000001
     */
    public function create(array $data, int $customerId, int $businessUnitId): ServiceRequest
    {
        return DB::transaction(function () use ($data, $customerId, $businessUnitId) {
            $year = date('Y');
            $count = ServiceRequest::whereYear('created_at', $year)->count() + 1;
            $protocol = sprintf('SOL-%s-%06d', $year, $count);

            $request = ServiceRequest::create([
                'protocol' => $protocol,
                'customer_id' => $customerId,
                'business_unit_id' => $businessUnitId,
                'service_id' => $data['service_id'] ?? null,
                'title' => $data['title'],
                'description' => $data['description'],
                'priority' => $data['priority'] ?? 'normal',
                'status' => 'new',
                'requested_date' => $data['requested_date'] ?? now()->toDateString(),
            ]);

            ServiceRequestStatusHistory::create([
                'service_request_id' => $request->id,
                'user_id' => auth()->id() ?? null,
                'old_status' => null,
                'new_status' => 'new',
                'comment' => 'Solicitação registrada pelo cliente.',
                'created_at' => now(),
            ]);

            return $request;
        });
    }

    /**
     * Um funcionário assume a solicitação (RN004).
     */
    public function assignToEmployee(ServiceRequest $request, int $employeeId, int $userId): ServiceRequest
    {
        return DB::transaction(function () use ($request, $employeeId, $userId) {
            $oldStatus = $request->status;
            $newStatus = 'in_analysis';

            $request->update([
                'assigned_to' => $employeeId,
                'status' => $newStatus,
            ]);

            ServiceRequestStatusHistory::create([
                'service_request_id' => $request->id,
                'user_id' => $userId,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'comment' => 'Técnico assumiu a solicitação para análise.',
                'created_at' => now(),
            ]);

            return $request;
        });
    }

    /**
     * Atualiza o status da solicitação com validação de regras de transição (RN006).
     */
    public function updateStatus(ServiceRequest $request, string $newStatus, ?string $comment = null, ?int $userId = null): ServiceRequest
    {
        return DB::transaction(function () use ($request, $newStatus, $comment, $userId) {
            if ($request->status === 'completed' && $newStatus === 'new') {
                $user = User::find($userId);
                if (!$user || !$user->isAdmin()) {
                    throw new Exception("Uma solicitação concluída não pode voltar para 'nova' sem permissão administrativa (RN006).");
                }
            }

            $oldStatus = $request->status;
            $updates = ['status' => $newStatus];

            if ($newStatus === 'completed') {
                $updates['completed_at'] = now();
            } elseif ($newStatus === 'cancelled') {
                $updates['cancelled_at'] = now();
            }

            $request->update($updates);

            ServiceRequestStatusHistory::create([
                'service_request_id' => $request->id,
                'user_id' => $userId,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'comment' => $comment ?? "Status alterado de {$oldStatus} para {$newStatus}.",
                'created_at' => now(),
            ]);

            return $request;
        });
    }
}
