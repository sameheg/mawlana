<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'api_key',
    ];

    public function settings(): HasOne
    {
        return $this->hasOne(TenantSetting::class);
    }

    public function slaLogs(): HasMany
    {
        return $this->hasMany(SlaLog::class);
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}

