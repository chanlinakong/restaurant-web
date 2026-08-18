<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display customer's orders.
     */
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->with([
                'customer',
                'orderDetails.menuItem',
            ])
            ->latest()
            ->get();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created order.
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        \Log::info('===== STORE ORDER REACHED =====');
        try {
            $order = $this->orderService->createOrder(
                $request->validated(),
               auth()->id(),//manually set the customer_id to 1 for now, replace with auth()->id() when authentication is implemented
            );

            $order->load([
                'customer',
                'orderDetails.menuItem',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'data' => new OrderResource($order),
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display a specific order.
     */
    public function show(Order $order)
    {
        // Make sure the customer can only see their own order
        if ($order->customer_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        $order->load([
            'customer',
            'orderDetails.menuItem',
        ]);

        return new OrderResource($order);
    }
}