<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditLogService
{
    public static function log(string $event, array $payload = [], ?Request $request = null): void
    {
        $request = $request ?? request();

        AuditLog::create([
            'user_id' => optional(Auth::user())->id,
            'event' => $event,
            'payload' => $payload,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }
}
