<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected OrderService $orderService;


    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->with('orderDetails.menuItem')
            ->latest()
            ->get();


        return view('pages.orders.index', compact('orders'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'pages.orders.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        \Log::info('===== STORE ORDER REACHED =====');
        try {

            $order = $this->orderService->createOrder(
                $request->validated(),
                auth()->id()
            );


            return response()->json([
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id,
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    //    public function show(Order $order)
//     {
//         $order = $this->orderService->find($order);

    //         return view(
//             'pages.orders.show',
//             compact('order')
//         );
//     }

    public function show(Order $order)
    {
        //For customer
        $order->load([
            'orderDetails.menuItem'
        ]);


        return view(
            'pages.orders.show',
            compact('order')
        );

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view(
            'pages.orders.edit',
            compact('order')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(
    //     UpdateOrderRequest $request,
    //     Order $order
    // ) {

    //     $this->orderService->update(
    //         $order,
    //         $request->validated()
    //     );


    //     return redirect()
    //         ->route('orders.index')
    //         ->with(
    //             'success',
    //             'Order updated successfully'
    //         );
    // }

    public function update(Request $request, Order $order)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {

        // $this->orderService->delete($order);


        // return redirect()
        //     ->route('orders.index')
        //     ->with(
        //         'success',
        //         'Order deleted successfully'
        //     );
    }
}
