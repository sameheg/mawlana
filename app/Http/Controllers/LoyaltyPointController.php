<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\LoyaltyPoint;
use App\Services\Loyalty\LoyaltyService;
use Illuminate\Http\Request;

class LoyaltyPointController extends Controller
{
    protected LoyaltyService $loyalty;

    public function __construct(LoyaltyService $loyalty)
    {
        $this->loyalty = $loyalty;
    }

    public function create()
    {
        return view('loyalty.add');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|integer',
            'points' => 'required|integer',
        ]);

        $customer = Customer::findOrFail($data['customer_id']);
        $customer->points += $data['points'];
        $customer->save();

        LoyaltyPoint::create([
            'customer_id' => $customer->id,
            'points' => $data['points'],
        ]);

        $this->loyalty->redeem($customer);

        return redirect()->back()->with('status', 'Points added');
    }
}
