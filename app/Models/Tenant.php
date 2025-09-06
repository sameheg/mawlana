<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class Tenant extends Model
{
    use HasFactory;
    use Notifiable;
    use Billable;

    protected $fillable = [
        'name',
        'domain',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}

