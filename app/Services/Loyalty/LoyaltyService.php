<?php

namespace App\Services\Loyalty;

use App\Models\Customer;
use App\Models\Coupon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LoyaltyService
{
    protected int $threshold = 100;
    protected int $discount = 10;

    public function redeem(Customer $customer): void
    {
        while ($customer->points >= $this->threshold) {
            $customer->points -= $this->threshold;
            $coupon = Coupon::create([
                'customer_id' => $customer->id,
                'discount' => $this->discount,
                'code' => Str::upper(Str::random(8)),
            ]);
            $this->logRedemption($customer, $coupon);
        }
        $customer->save();
    }

    protected function logRedemption(Customer $customer, Coupon $coupon): void
    {
        $path = database_path('loyalty');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }
        $entry = now()->toDateTimeString() . " - Customer {$customer->id} redeemed for coupon {$coupon->code}" . PHP_EOL;
        File::append($path . '/redemptions.log', $entry);
    }
}
