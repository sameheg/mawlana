<?php

namespace App\Services;

use App\Exports\MetricsExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class ReportService
{
    /**
     * Gather metrics from orders and sales.
     */
    public function getMetrics(): Collection
    {
        $totalOrders = \App\Models\Order::count();
        $totalSales = \App\Models\Sale::sum('total');

        return collect([
            'total_orders' => $totalOrders,
            'total_sales' => $totalSales,
        ]);
    }

    /**
     * Export metrics as CSV or Excel.
     */
    public function export(string $format = 'csv')
    {
        $metrics = new MetricsExport($this->getMetrics());
        $filename = 'report.' . $format;

        return Excel::download($metrics, $filename, $format);
    }
}

