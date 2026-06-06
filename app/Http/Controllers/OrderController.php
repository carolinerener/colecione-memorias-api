<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Listar pedidos do usuário autenticado
    public function index(Request $request)
    {
        $orders = Order::with(['items.product', 'address'])
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($orders);
    }

    // Criar novo pedido
    public function store(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'items'      => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            $items[] = [
                'product_id' => $product->id,
                'quantity'   => $item['quantity'],
                'unit_price' => $product->price,
                'subtotal'   => $subtotal,
            ];
        }

        $order = Order::create([
            'user_id'    => $request->user()->id,
            'address_id' => $request->address_id,
            'total'      => $total,
            'status'     => 'pending',
        ]);

        $order->items()->createMany($items);

        return response()->json($order->load(['items.product', 'address']), 201);
    }

    // Exibir um pedido
    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Não autorizado.'], 403);
        }

        return response()->json($order->load(['items.product', 'address']));
    }
}