<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'name' => $this->name,

            'price' => $this->price,

            'image_url' => $this->image_url,

            'is_available' => $this->is_available,

            'description' => $this->description,

            'preparation_time' => $this->preparation_time,

            'category_id' => $this->category_id,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}