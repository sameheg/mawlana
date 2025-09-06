<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function create()
    {
        return view('coupon.issue');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'discount' => 'required|integer',
        ]);

        $coupon = Coupon::create([
            'customer_id' => $data['customer_id'],
            'discount' => $data['discount'],
            'code' => Str::upper(Str::random(8)),
        ]);

        return redirect()->back()->with('status', 'Coupon issued: ' . $coupon->code);
    }
}
