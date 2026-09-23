<?php

namespace App\Services;

use App\Models\Quote;
use App\Models\QuoteItem;
use App\Models\ServiceRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class QuoteService
{
    /**
     * Cria um novo orçamento vinculado ou não a uma solicitação.
     */
    public function create(array $data, array $items, int $userId): Quote
    {
        return DB::transaction(function () use ($data, $items, $userId) {
            $year = date('Y');
            $count = Quote::whereYear('created_at', $year)->count() + 1;
            $number = sprintf('ORC-%s-%04d', $year, $count);

            $subtotal = 0;
            foreach ($items as $item) {
                $subtotal += ($item['quantity'] * $item['unit_price']);
            }

            $discount = $data['discount'] ?? 0;
            $total = max(0, $subtotal - $discount);

            $quote = Quote::create([
                'number' => $number,
                'service_request_id' => $data['service_request_id'] ?? null,
                'customer_id' => $data['customer_id'],
                'business_unit_id' => $data['business_unit_id'],
                'created_by' => $userId,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'valid_until' => $data['valid_until'] ?? now()->addDays(15)->toDateString(),
                'status' => 'sent',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($items as $item) {
                QuoteItem::create([
                    'quote_id' => $quote->id,
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            // Atualiza status da solicitação se houver
            if ($quote->service_request_id) {
                $sr = ServiceRequest::find($quote->service_request_id);
                if ($sr && in_array($sr->status, ['new', 'in_analysis'])) {
                    app(ServiceRequestService::class)->updateStatus(
                        $sr,
                        'quoted',
                        "Orçamento {$quote->number} emitido no valor de " . number_format($quote->total, 2, ',', '.') . " AOA.",
                        $userId
                    );
                }
            }

            return $quote;
        });
    }

    /**
     * Cliente aprova o orçamento (RN007).
     */
    public function approve(Quote $quote, int $customerId): Quote
    {
        if ($quote->customer_id !== $customerId) {
            throw new Exception("Não autorizado a aprovar este orçamento.");
        }

        if ($quote->isExpired()) {
            $quote->update(['status' => 'expired']);
            throw new Exception("Este orçamento expirou e não pode mais ser aprovado.");
        }

        $quote->update(['status' => 'approved']);

        if ($quote->service_request_id) {
            $sr = ServiceRequest::find($quote->service_request_id);
            if ($sr) {
                app(ServiceRequestService::class)->updateStatus(
                    $sr,
                    'approved',
                    "Orçamento {$quote->number} aprovado pelo cliente.",
                    auth()->id()
                );
            }
        }

        return $quote;
    }
}
