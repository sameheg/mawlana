<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
