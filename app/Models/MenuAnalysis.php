<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuAnalysis extends Model
{
    protected $fillable = [
        'product',
        'popularity',
        'profitability',
        'category',
    ];
}
