<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionExpiredNotification;
use App\Notifications\SubscriptionRenewalNotification;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    protected $signature = 'app:check-subscriptions';

    protected $description = 'Send dunning notices for expiring or expired subscriptions';

    public function handle(): int
    {
        $now = now();
        $soon = $now->copy()->addDays(3);

        Subscription::with('tenant')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', $soon)
            ->each(function (Subscription $subscription) use ($now) {
                if ($subscription->ends_at->isPast()) {
                    $subscription->tenant?->notify(new SubscriptionExpiredNotification($subscription));
                } else {
                    $subscription->tenant?->notify(new SubscriptionRenewalNotification($subscription));
                }
            });

        return Command::SUCCESS;
    }
}
