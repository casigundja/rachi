<?php

namespace App\Services;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;
use Exception;

class StockService
{
    /**
     * Movimenta o estoque de um produto de forma auditável.
     */
    public function move(int $productId, string $type, int $quantity, ?string $reason = null, ?int $userId = null, $reference = null): StockMovement
    {
        return DB::transaction(function () use ($productId, $type, $quantity, $reason, $userId, $reference) {
            $product = Product::lockForUpdate()->findOrFail($productId);
            $previousQuantity = $product->stock_quantity;

            if (in_array($type, ['exit', 'sale'])) {
                if ($previousQuantity < $quantity) {
                    throw new Exception("Estoque insuficiente para o produto {$product->name}. Disponível: {$previousQuantity}");
                }
                $currentQuantity = $previousQuantity - $quantity;
            } elseif (in_array($type, ['entry', 'return'])) {
                $currentQuantity = $previousQuantity + $quantity;
            } elseif ($type === 'adjustment') {
                $currentQuantity = $quantity;
                $quantity = $currentQuantity - $previousQuantity;
            } else {
                throw new Exception("Tipo de movimentação inválido: {$type}");
            }

            $product->update(['stock_quantity' => $currentQuantity]);

            return StockMovement::create([
                'product_id' => $product->id,
                'user_id' => $userId,
                'type' => $type,
                'quantity' => $quantity,
                'previous_quantity' => $previousQuantity,
                'current_quantity' => $currentQuantity,
                'reason' => $reason,
                'reference_type' => $reference ? get_class($reference) : null,
                'reference_id' => $reference ? $reference->id : null,
                'created_at' => now(),
            ]);
        });
    }
}
