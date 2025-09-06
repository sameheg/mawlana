<?php

namespace App\Services\Menu;

use App\Models\MenuAnalysis;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MenuAnalysisService
{
    /**
     * Analyze products using a popularity/profitability matrix.
     *
     * @return Collection<int, MenuAnalysis>
     */
    public function analyze(): Collection
    {
        $stats = OrderItem::query()
            ->select('product',
                DB::raw('SUM(quantity) as popularity'),
                DB::raw('SUM(price * quantity) as profitability'))
            ->groupBy('product')
            ->get();

        $avgPopularity = (int) $stats->avg('popularity');
        $avgProfitability = (float) $stats->avg('profitability');

        return $stats->map(function ($row) use ($avgPopularity, $avgProfitability) {
            $category = $this->classify(
                (int) $row->popularity,
                (float) $row->profitability,
                $avgPopularity,
                $avgProfitability
            );

            return MenuAnalysis::updateOrCreate(
                ['product' => $row->product],
                [
                    'popularity' => (int) $row->popularity,
                    'profitability' => (float) $row->profitability,
                    'category' => $category,
                ]
            );
        });
    }

    private function classify(int $popularity, float $profitability, int $avgPopularity, float $avgProfitability): string
    {
        if ($popularity >= $avgPopularity && $profitability >= $avgProfitability) {
            return 'star';
        }

        if ($popularity >= $avgPopularity) {
            return 'plowhorse';
        }

        if ($profitability >= $avgProfitability) {
            return 'puzzle';
        }

        return 'dog';
    }
}
