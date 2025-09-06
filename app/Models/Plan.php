<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subscription;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'stripe_price_id',
        'price',
        'currency',
        'interval',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
