<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'total',
        'payment_method',
    ];

    protected $casts = [
        'payment_method' => PaymentMethod::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}

