<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class MetricsExport implements FromCollection
{
    public function __construct(private Collection $metrics)
    {
    }

    public function collection(): Collection
    {
        return $this->metrics->map(fn ($value, $key) => ['metric' => $key, 'value' => $value]);
    }
}

