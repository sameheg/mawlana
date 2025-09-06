<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'shift_schedule_id',
        'clock_in_at',
        'clock_out_at',
        'wage',
    ];

    protected $casts = [
        'clock_in_at' => 'datetime',
        'clock_out_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function shiftSchedule(): BelongsTo
    {
        return $this->belongsTo(ShiftSchedule::class);
    }

    public function close(): void
    {
        $this->clock_out_at = now();
        $hours = $this->clock_in_at->diffInMinutes($this->clock_out_at) / 60;
        $this->wage = $hours * $this->shiftSchedule->hourly_rate;
        $this->save();
    }
}
