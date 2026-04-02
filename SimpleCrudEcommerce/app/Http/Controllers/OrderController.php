<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    private function ensureOrderTablesExist(): ?JsonResponse
    {
        if (!Schema::hasTable('orders') || !Schema::hasTable('order_items')) {
            return response()->json([
                'message' => 'Orders tables are missing.',
            ], 503);
        }

        return null;
    }

    public function index(): JsonResponse
    {
        if ($response = $this->ensureOrderTablesExist()) {
            return $response;
        }

        $orders = DB::table('orders')
            ->orderByDesc('id')
            ->get();

        $orderItems = DB::table('order_items')
            ->orderBy('id')
            ->get()
            ->groupBy('order_id');

        return response()->json([
            'orders' => $orders,
            'items' => $orderItems,
        ]);
    }

    public function show(int $order): JsonResponse
    {
        if ($response = $this->ensureOrderTablesExist()) {
            return $response;
        }

        $orderData = DB::table('orders')->where('id', $order)->first();

        abort_if(!$orderData, 404);

        $items = DB::table('order_items')
            ->where('order_id', $order)
            ->orderBy('id')
            ->get();

        return response()->json([
            'order' => $orderData,
            'items' => $items,
        ]);
    }

    public function store(StoreOrderRequest $request): JsonResponse
    {
        if ($response = $this->ensureOrderTablesExist()) {
            return $response;
        }

        $validatedData = $request->validated();

        $orderId = DB::transaction(function () use ($validatedData) {
            $now = now();

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $validatedData['user_id'] ?? null,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'customer_name' => $validatedData['customer_name'],
                'customer_email' => $validatedData['customer_email'],
                'status' => $validatedData['status'],
                'subtotal' => 0,
                'total' => 0,
                'notes' => $validatedData['notes'] ?? null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $subtotal = 0;

            foreach ($validatedData['items'] as $item) {
                $lineTotal = round($item['quantity'] * $item['unit_price'], 2);
                $subtotal += $lineTotal;

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_name' => $item['product_name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'line_total' => $lineTotal,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            DB::table('orders')
                ->where('id', $orderId)
                ->update([
                    'subtotal' => $subtotal,
                    'total' => $subtotal,
                    'updated_at' => $now,
                ]);

            return $orderId;
        });

        return response()->json([
            'message' => 'Order created successfully.',
            'order_id' => $orderId,
        ], 201);
    }

    public function addItem(StoreOrderItemRequest $request, int $order): JsonResponse
    {
        if ($response = $this->ensureOrderTablesExist()) {
            return $response;
        }

        $validatedData = $request->validated();

        DB::transaction(function () use ($validatedData, $order) {
            $now = now();
            $lineTotal = round($validatedData['quantity'] * $validatedData['unit_price'], 2);

            DB::table('order_items')->insert([
                'order_id' => $order,
                'product_name' => $validatedData['product_name'],
                'quantity' => $validatedData['quantity'],
                'unit_price' => $validatedData['unit_price'],
                'line_total' => $lineTotal,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $subtotal = DB::table('order_items')
                ->where('order_id', $order)
                ->sum('line_total');

            DB::table('orders')
                ->where('id', $order)
                ->update([
                    'subtotal' => $subtotal,
                    'total' => $subtotal,
                    'updated_at' => $now,
                ]);
        });

        return response()->json([
            'message' => 'Order item added successfully.',
        ], 201);
    }
}
