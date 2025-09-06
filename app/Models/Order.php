<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'status',
    ];

    protected $dispatchesEvents = [
        'created' => \App\Events\OrderCreated::class,
        'updated' => \App\Events\OrderUpdated::class,
    ];
}
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

