<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;

class Order extends Model
{
    protected $fillable = [

        'order_type',
        'total_amount',
        'table_number',
        'status',
        'payment_method',
        'customer_id',
        'handled_by_id',

    ];

    protected $casts = [

        'total_amount' => 'decimal:2',
        'status' => OrderStatus::class,
        'payment_method' => PaymentMethod::class,

    ];  
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }


    public function handledBy()
    {
        return $this->belongsTo(User::class, 'handled_by_id');
    }


    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-900 dark:text-amber-300',
            'confirmed' => 'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
            'completed' => 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
            'cancelled' => 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
            default => 'bg-gray-100 text-gray-700 dark:bg-gray-900 dark:text-gray-300',
        };  
    }
}
