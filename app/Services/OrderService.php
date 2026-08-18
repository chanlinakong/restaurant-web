<?php

namespace App\Services;

use App\Models\Order;

use Illuminate\Support\Facades\DB;
use App\Enums\OrderStatus;
use App\Models\MenuItem;

class OrderService
{

    public function getAll()
    {
        return Order::with([
            'customer',
            'handledBy'
        ])
            ->latest()
            ->paginate(10);
    }

    public function getAllWithoutPagination()
    {
        return Order::with([
            'customer',
            'handledBy'
        ])
            ->latest();
    }


    public function create(array $data)
    {
        return Order::create($data);
    }


    public function find(Order $order)
    {
        return $order->load([
            'customer',
            'handledBy'
        ]);
    }


    public function update(
        Order $order,
        array $data
    ) {

        $order->update($data);

        return $order;
    }


    public function delete(Order $order)
    {
        return $order->delete();
    }

    // public function createOrder(array $data, $customerId)
    // {

    //     return DB::transaction(function () use ($data, $customerId) {


    //         $total = 0;


    //         foreach ($data['items'] as $item) {

    //             $total += $item['unit_price'] * $item['quantity'];

    //         }



    //         $order = Order::create([

    //             'order_type' => $data['order_type'],

    //             'total_amount' => $total,

    //             'table_number' => $data['table_number'] ?? null,

    //             'status' => OrderStatus::Pending,

    //             'payment_method' => $data['payment_method'],

    //             'customer_id' => $customerId,

    //         ]);



    //         foreach ($data['items'] as $item) {


    //             $order->orderDetails()->create([

    //                 'menu_item_id' => $item['menu_item_id'],

    //                 'quantity' => $item['quantity'],

    //                 'unit_price' => $item['unit_price'],

    //                 'notes' => $item['notes'] ?? null,

    //             ]);

    //         }


    //         return $order;

    //     });

    // }
 public function createOrder(array $data, $customerId)
    {
        return DB::transaction(function () use ($data, $customerId) {

            $total = 0;

            $orderItems = [];

            foreach ($data['items'] as $item) {

                $menuItem = MenuItem::findOrFail(
                    $item['menu_item_id']
                );

                $quantity = (int) $item['quantity'];

                // Get the REAL price from database
                $unitPrice = (float) $menuItem->price;

                $subtotal = $unitPrice * $quantity;

                $total += $subtotal;

                $orderItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'notes' => $item['notes'] ?? null,
                ];
            }

            $order = Order::create([
                'order_type' => $data['order_type'],
                'total_amount' => $total,
                'table_number' => $data['table_number'] ?? null,
                'status' => OrderStatus::Pending,
                'payment_method' => $data['payment_method'],
                'customer_id' => $customerId,
            ]);

            foreach ($orderItems as $item) {

                $order->orderDetails()->create($item);
            }

            return $order;
        });
    }
}