<?php

namespace App\Services\Forecast;

class ForecastService
{
    /**
     * Calculate Simple Moving Average (SMA).
     *
     * @param array<int, float|int> $data
     * @return array<int, float>
     */
    public function simpleMovingAverage(array $data, int $period): array
    {
        $sma = [];
        $count = count($data);
        if ($period <= 0 || $count < $period) {
            return $sma;
        }

        for ($i = $period - 1; $i < $count; $i++) {
            $window = array_slice($data, $i - $period + 1, $period);
            $sma[] = array_sum($window) / $period;
        }

        return $sma;
    }

    /**
     * Calculate Exponential Moving Average (EMA).
     *
     * @param array<int, float|int> $data
     * @return array<int, float>
     */
    public function exponentialMovingAverage(array $data, int $period): array
    {
        $ema = [];
        $count = count($data);
        if ($period <= 0 || $count === 0) {
            return $ema;
        }

        $k = 2 / ($period + 1);
        $ema[0] = $data[0];
        for ($i = 1; $i < $count; $i++) {
            $ema[$i] = ($data[$i] * $k) + ($ema[$i - 1] * (1 - $k));
        }

        return $ema;
    }
}

