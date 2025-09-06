<?php

namespace App\Services\Recommender;

use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class RecommenderService
{
    /**
     * Recommend top products based on order history.
     *
     * @return array<int, string>
     */
    public function recommend(int $limit = 5): array
    {
        return OrderItem::query()
            ->select('product', DB::raw('SUM(quantity) as total'))
            ->groupBy('product')
            ->orderByDesc('total')
            ->limit($limit)
            ->pluck('product')
            ->all();
    }
}
