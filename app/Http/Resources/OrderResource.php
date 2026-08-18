<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
       return [

            'order_id' => $this->id,

            'order_type' => $this->order_type,

            'total_amount' => $this->total_amount,

            'status' => $this->status instanceof \BackedEnum
                ? $this->status->value
                : $this->status,
            
            'payment_method' => $this->payment_method instanceof \BackedEnum
                ? $this->payment_method->value
                : $this->payment_method,


            'customer' => [

                'id' => $this->customer->id,

                'name' => $this->customer->name,

            ],



            'items' => $this->orderDetails->map(function($detail){

                return [

                    'menu_id' => $detail->menuItem->id,

                    'menu_name' => $detail->menuItem->name,
                    
                    'image_url' => $detail->menuItem->image_url,

                    'quantity' => $detail->quantity,

                    'price' => $detail->unit_price,

                    'subtotal' =>
                        $detail->quantity * $detail->unit_price,

                ];

            }),


            'created_at' => $this->created_at,

        ];

    }
}