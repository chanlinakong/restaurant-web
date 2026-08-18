<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'detail_id' => $this->id,

            'quantity' => $this->quantity,

            'unit_price' => $this->unit_price,

            'subtotal' => $this->quantity * $this->unit_price,

            'notes' => $this->notes,

            'menu_item' => [
                'id' => $this->menuItem?->id,
                'name' => $this->menuItem?->name,
                'price' => $this->menuItem?->price,
            ],

            'order' => [
                'id' => $this->order?->id,
                'status' => $this->order?->status?->value,
            ],

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}