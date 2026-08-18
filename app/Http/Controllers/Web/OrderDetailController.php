<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Services\OrderDetailService;
use App\Services\OrderService;
use App\Services\MenuItemService;
use App\Http\Requests\StoreOrderDetailRequest; 
use App\Http\Requests\UpdateOrderDetailRequest;
class OrderDetailController extends Controller
{
    public function __construct(protected OrderDetailService $orderDetailService,
        protected OrderService $orderService,
        protected MenuItemService $menuItemService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderDetails = $this->orderDetailService->getAll();
        return view('pages.order-details.index', compact('orderDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orders = $this->orderService->getAllWithoutPagination();
        $menuItems = $this->menuItemService->getAllWithoutPagination();
        return view('pages.order-details.create', compact('orders', 'menuItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderDetailRequest $request)
    {
        $this->orderDetailService->create($request->validated());
        return redirect()->route('order-details.index')->with('success', 'Order detail created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetail $orderDetail)
    {
        $orderDetail = $this->orderDetailService->find($orderDetail);
        return view('pages.order-details.show', compact('orderDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $orderDetail)
    {
        $orders = $this->orderService->getAllWithoutPagination();
        $menuItems = $this->menuItemService->getAllWithoutPagination();
        return view('pages.order-details.edit', compact('orderDetail', 'orders', 'menuItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $this->orderDetailService->update($orderDetail, $request->validated());
        return redirect()->route('order-details.index')->with('success', 'Order detail updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        $this->orderDetailService->delete($orderDetail);
        return redirect()->route('order-details.index')->with('success', 'Order detail deleted successfully.');
    }
}
