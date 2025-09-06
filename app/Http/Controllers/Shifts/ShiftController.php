<?php

namespace App\Http\Controllers\Shifts;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;

class ShiftController extends Controller
{
    protected array $shift = [];

    public function open(): JsonResponse
    {
        $this->shift = [
            'opened_at' => Carbon::now(),
        ];

        return response()->json($this->shift);
    }

    public function close(): JsonResponse
    {
        $this->shift['closed_at'] = Carbon::now();

        return response()->json($this->shift);
    }

    public function reportX(): JsonResponse
    {
        return response()->json([
            'type' => 'X',
            'shift' => $this->shift,
        ]);
    }

    public function reportZ(): JsonResponse
    {
        return response()->json([
            'type' => 'Z',
            'shift' => $this->shift,
        ]);
    }
}

