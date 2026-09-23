<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    protected StockService $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    /**
     * Cria um novo pedido a partir dos itens do carrinho e desconta o estoque (RN008/RN010).
     */
    public function createOrder(int $customerId, int $businessUnitId, array $items, array $data): Order
    {
        return DB::transaction(function () use ($customerId, $businessUnitId, $items, $data) {
            $year = date('Y');
            $count = Order::whereYear('created_at', $year)->count() + 1;
            $number = sprintf('PED-%s-%06d', $year, $count);

            $subtotal = 0;
            $orderItemsData = [];

            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);

                if ($product->stock_quantity < $item['quantity']) {
                    throw new Exception("Estoque insuficiente para {$product->name}. Restam apenas {$product->stock_quantity} unidades.");
                }

                $itemTotal = $product->price * $item['quantity'];
                $subtotal += $itemTotal;

                $orderItemsData[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'total' => $itemTotal,
                ];
            }

            $discount = $data['discount'] ?? 0;
            $shipping = $data['shipping'] ?? 0;
            $total = max(0, ($subtotal - $discount) + $shipping);

            $order = Order::create([
                'number' => $number,
                'customer_id' => $customerId,
                'business_unit_id' => $businessUnitId,
                'status' => 'pending',
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $total,
                'shipping_address_id' => $data['shipping_address_id'] ?? null,
                'billing_address_id' => $data['billing_address_id'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($orderItemsData as $oi) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $oi['product']->id,
                    'name' => $oi['product']->name,
                    'sku' => $oi['product']->sku,
                    'quantity' => $oi['quantity'],
                    'unit_price' => $oi['unit_price'],
                    'total' => $oi['total'],
                ]);

                // Baixa no estoque
                $this->stockService->move(
                    $oi['product']->id,
                    'sale',
                    $oi['quantity'],
                    "Venda referente ao pedido {$order->number}",
                    auth()->id(),
                    $order
                );
            }

            // Cria o registro inicial de pagamento
            if (!empty($data['payment_method'])) {
                Payment::create([
                    'order_id' => $order->id,
                    'method' => $data['payment_method'],
                    'amount' => $order->total,
                    'status' => 'pending',
                ]);
            }

            return $order;
        });
    }

    /**
     * Confirmação de pagamento do pedido.
     */
    public function markAsPaid(Order $order, ?string $transactionId = null): Order
    {
        return DB::transaction(function () use ($order, $transactionId) {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);

            $payment = $order->payment;
            if ($payment) {
                $payment->update([
                    'status' => 'approved',
                    'transaction_id' => $transactionId,
                    'paid_at' => now(),
                ]);
            }

            return $order;
        });
    }
}
