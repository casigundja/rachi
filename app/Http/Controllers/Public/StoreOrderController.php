<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Role;
use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreOrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $raw = json_decode($request->getContent(), true);
        if (is_array($raw)) {
            $request->merge($raw);
        }

        $items = $request->input('items', []);
        if (empty($items) || !is_array($items)) {
            return response()->json([
                'success' => false,
                'message' => 'A sua sacola está vazia. Adicione produtos antes de finalizar.',
            ], 422);
        }

        $name = trim($request->input('customer_name', $request->input('name', '')));
        $email = trim($request->input('customer_email', $request->input('email', '')));
        $phone = trim($request->input('customer_phone', $request->input('phone', '')));
        $nif = trim($request->input('customer_nif', $request->input('nif', '')));
        $address = trim($request->input('delivery_address', $request->input('address', '')));

        if (auth()->check()) {
            $authUser = auth()->user();
            if (empty($name)) $name = $authUser->name;
            if (empty($email)) $email = $authUser->email;
            if (empty($phone)) $phone = $authUser->phone ?? '';
        }

        if (empty($name)) {
            return response()->json(['success' => false, 'message' => 'O nome do cliente ou empresa é obrigatório.'], 422);
        }

        if (empty($email)) {
            return response()->json(['success' => false, 'message' => 'O email para envio da factura/proforma é obrigatório.'], 422);
        }

        return DB::transaction(function () use ($name, $email, $phone, $nif, $address, $items, $request) {
            $unit = BusinessUnit::where('slug', 'tec')->first();
            $unitId = $unit ? $unit->id : 1;

            // 1. Identificar ou criar usuário
            $user = auth()->user();
            if (!$user) {
                $user = User::firstOrCreate(
                    ['email' => strtolower($email)],
                    [
                        'name' => $name,
                        'phone' => $phone,
                        'password' => bcrypt(Str::random(16)),
                        'role_id' => Role::where('slug', 'customer')->value('id') ?? 6,
                        'status' => 'active',
                    ]
                );
            }

            // 2. Identificar ou criar cliente
            $customer = Customer::where('user_id', $user->id)->first();
            if (!$customer) {
                $customer = Customer::create([
                    'user_id' => $user->id,
                    'type' => !empty($nif) ? 'company' : 'individual',
                    'company_name' => !empty($nif) ? $name : null,
                    'trade_name' => $name,
                    'document' => $nif ?: null,
                    'phone' => $phone,
                    'whatsapp' => $phone,
                    'status' => 'active',
                ]);
            } else {
                if (!empty($nif) && empty($customer->document)) {
                    $customer->update([
                        'document' => $nif,
                        'company_name' => $customer->company_name ?: $name,
                        'type' => 'company'
                    ]);
                }
            }

            // 3. Processar itens e descontar estoque
            $subtotal = 0;
            $processedItems = [];
            $updatedStock = [];

            foreach ($items as $item) {
                $qty = max(1, (int)($item['quantity'] ?? $item['qty'] ?? 1));
                $slug = $item['slug'] ?? '';
                $productId = $item['product_id'] ?? $item['id'] ?? null;
                $title = $item['title'] ?? $item['name'] ?? 'Produto';

                $product = null;
                if ($productId) {
                    $product = Product::find($productId);
                }
                if (!$product && $slug) {
                    $product = Product::where('slug', $slug)->first();
                }
                if (!$product && $title) {
                    $product = Product::where('name', $title)->first();
                }

                $price = $product ? (float)$product->price : (float)($item['priceNum'] ?? $item['price'] ?? 0);
                $itemTotal = $price * $qty;
                $subtotal += $itemTotal;

                if ($product) {
                    $prevStock = (int)$product->stock_quantity;
                    $newStock = max(0, $prevStock - $qty);
                    $product->update([
                        'stock_quantity' => $newStock,
                    ]);

                    StockMovement::create([
                        'product_id' => $product->id,
                        'user_id' => $user->id,
                        'type' => 'exit',
                        'quantity' => $qty,
                        'previous_quantity' => $prevStock,
                        'current_quantity' => $newStock,
                        'reason' => 'Venda Loja Online — ' . $title,
                        'created_at' => now(),
                    ]);

                    $updatedStock[] = [
                        'id' => $product->id,
                        'slug' => $product->slug,
                        'stock_quantity' => $newStock,
                        'status' => $product->status,
                    ];
                }

                $processedItems[] = [
                    'product_id' => $product?->id,
                    'name' => $product?->name ?? $title,
                    'sku' => $product?->sku ?? ('TEC-ITEM-' . rand(100, 999)),
                    'quantity' => $qty,
                    'unit_price' => $price,
                    'total' => $itemTotal,
                ];
            }

            $discount = (float)($request->input('discount', 0));
            $shipping = (float)($request->input('shipping', 0));
            $total = max(0, ($subtotal - $discount) + $shipping);

            // 4. Criar o pedido
            $year = date('Y');
            $count = Order::whereYear('created_at', $year)->count() + 1;
            $orderNumber = sprintf('PED-%s-%05d', $year, $count);

            $notes = "Solicitação de Factura Proforma via Loja Online RACHI Tec." .
                ($nif ? " | NIF: {$nif}" : "") .
                ($address ? " | Endereço de Entrega: {$address}" : "");

            $order = Order::create([
                'number' => $orderNumber,
                'customer_id' => $customer->id,
                'business_unit_id' => $unitId,
                'status' => 'pending',
                'payment_status' => 'pending',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $total,
                'notes' => $notes,
            ]);

            foreach ($processedItems as $pi) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $pi['product_id'],
                    'name' => $pi['name'],
                    'sku' => $pi['sku'],
                    'quantity' => $pi['quantity'],
                    'unit_price' => $pi['unit_price'],
                    'total' => $pi['total'],
                ]);
            }

            $formattedOrder = [
                'id' => $order->id,
                'numero' => $order->number,
                'cliente' => $customer->display_name,
                'total' => 'AOA ' . number_format($order->total, 2, ',', '.'),
                'status' => 'Pendente',
                'data' => $order->created_at->format('d/m/Y H:i'),
            ];

            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'order_number' => $order->number,
                'order' => $formattedOrder,
                'updated_stock' => $updatedStock,
                'message' => "Pedido {$order->number} finalizado com sucesso! Factura proforma registada em Pedidos de Venda.",
            ]);
        });
    }

    public function getTecOrders(): JsonResponse
    {
        $orders = Order::with(['customer.user', 'items.product'])
            ->where('business_unit_id', 1)
            ->latest()
            ->get()
            ->map(function ($o) {
                return [
                    'id' => $o->id,
                    'numero' => $o->number ?: ('PED-' . str_pad($o->id, 5, '0', STR_PAD_LEFT)),
                    'cliente' => $o->customer?->display_name ?? 'Cliente',
                    'total' => 'AOA ' . number_format($o->total, 2, ',', '.'),
                    'status' => ucfirst($o->status),
                    'data' => $o->created_at ? $o->created_at->format('d/m/Y H:i') : '—',
                ];
            });

        return response()->json(['orders' => $orders]);
    }
}
