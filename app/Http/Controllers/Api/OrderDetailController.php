<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;
use App\Services\OrderDetailService;
use Illuminate\Http\JsonResponse;

class OrderDetailController extends Controller
{
    public function __construct(
        protected OrderDetailService $orderDetailService
    ) {
    }

    /**
     * Display a listing of order details.
     */
    public function index()
    {
        return OrderDetailResource::collection(
            $this->orderDetailService->getAll()
        );
    }

    /**
     * Store a newly created order detail.
     */
    public function store(StoreOrderDetailRequest $request): JsonResponse
    {
        $orderDetail = $this->orderDetailService->create(
            $request->validated()
        );

        $orderDetail->load([
            'order',
            'menuItem',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order detail created successfully.',
            'data' => new OrderDetailResource($orderDetail),
        ], 201);
    }

    /**
     * Display the specified order detail.
     */
    public function show(OrderDetail $orderDetail): JsonResponse
    {
        $orderDetail = $this->orderDetailService->find($orderDetail);

        $orderDetail->load([
            'order',
            'menuItem',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order detail retrieved successfully.',
            'data' => new OrderDetailResource($orderDetail),
        ]);
    }

    /**
     * Update the specified order detail.
     */
    public function update(
        UpdateOrderDetailRequest $request,
        OrderDetail $orderDetail
    ): JsonResponse {
        $orderDetail = $this->orderDetailService->update(
            $orderDetail,
            $request->validated()
        );

        $orderDetail->fresh()->load([
            'order',
            'menuItem',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order detail updated successfully.',
            'data' => new OrderDetailResource($orderDetail),
        ]);
    }

    /**
     * Remove the specified order detail.
     */
    public function destroy(OrderDetail $orderDetail): JsonResponse
    {
        $this->orderDetailService->delete($orderDetail);

        return response()->json([
            'success' => true,
            'message' => 'Order detail deleted successfully.',
        ]);
    }
}