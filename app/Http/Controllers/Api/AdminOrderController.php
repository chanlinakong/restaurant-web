<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of all orders.
     */
    public function index(): JsonResponse
    {
        $orders = Order::with([
            'orderDetails.menuItem',
            'customer',
            'handledBy',
        ])
        ->latest()
        ->paginate(10);

        return response()->json([
            'success' => true,
            'message' => 'Order list retrieved successfully.',
            'data' => OrderResource::collection($orders),
            'pagination' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order): JsonResponse
    {
        $order->load([
            'orderDetails.menuItem',
            'customer',
            'handledBy',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order retrieved successfully.',
            'data' => new OrderResource($order),
        ]);
    }

    /**
     * Update the order status.
     */
    public function update(
        Request $request,
        Order $order
    ): JsonResponse {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::enum(OrderStatus::class),
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
            'handled_by_id' => auth()->id(),
        ]);

        $order->load([
            'orderDetails.menuItem',
            'customer',
            'handledBy',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully.',
            'data' => new OrderResource($order),
        ]);
    }
}