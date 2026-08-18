<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'cate_id' => $this->id,

            'cate_name' => $this->name,

            'cate_description' => $this->description,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,
        ];
    }
}