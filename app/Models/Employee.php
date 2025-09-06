<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $fillable = ['name', 'email', 'hourly_rate'];

    public function shiftSchedules(): HasMany
    {
        return $this->hasMany(ShiftSchedule::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function salaryFor(string $from, string $to): float
    {
        return (float) $this->attendances()
            ->whereBetween('clock_in_at', [$from, $to])
            ->sum('wage');
    }
}
