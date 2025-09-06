<?php

namespace App\Http\Controllers;

use App\Models\Tenant;

class SlaController extends Controller
{
    public function index(Tenant $tenant)
    {
        $stats = $tenant->slaLogs()
            ->selectRaw('AVG(response_time_ms) as avg_response_time, COUNT(*) as total_requests')
            ->first();

        return [
            'tenant' => $tenant->id,
            'average_response_time_ms' => (int) ($stats->avg_response_time ?? 0),
            'requests' => (int) ($stats->total_requests ?? 0),
        ];
    }
}
