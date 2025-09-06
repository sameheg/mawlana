<?php

use App\Http\Controllers\SlaController;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    /**
     * Retrieve the settings for a tenant using API keys.
     *
     * Headers:
     *  - X-Tenant-Domain: Tenant domain
     *  - X-Api-Key: Tenant API key
     */
    Route::get('/settings', function (Request $request) {
        $tenant = Tenant::where('domain', $request->header('X-Tenant-Domain'))
            ->where('api_key', $request->header('X-Api-Key'))
            ->firstOrFail();

        return $tenant->settings;
    });

    /**
     * SLA statistics for a tenant.
     */
    Route::get('/sla/{tenant}', [SlaController::class, 'index']);
});
