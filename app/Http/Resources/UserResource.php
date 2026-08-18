<?php
namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ['user_id' => $this->id, 'user_name' => $this->name, 'user_email' => $this->email, 'user_phone' => $this->phone, 'user_role' => $this->role->value, 'email_verified_at' => $this->email_verified_at, 'created_at' => $this->created_at, 'updated_at' => $this->updated_at,];
    }
}