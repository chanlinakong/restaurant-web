<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\PaymentMethod;
use Illuminate\Validation\Rules\Enum;


class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'order_type' => [
                'required',
                'string'
            ],

            'table_number' => [
                'nullable',
                'string'
            ],

            'payment_method' => [
            'required',
            new Enum(PaymentMethod::class),
        ],

            'items' => [
                'required',
                'array',
                'min:1'
            ],


            'items.*.menu_item_id' => [
                'required',
                'exists:menu_items,id'
            ],


            'items.*.quantity' => [
                'required',
                'integer',
                'min:1'
            ],


            'items.*.unit_price' => [
                'required',
                'numeric',
                'min:0'
            ],


            'items.*.notes' => [
                'nullable',
                'string',
                'max:255'
            ]

        ];
    }
}
