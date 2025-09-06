<?php

namespace App\Services\Integration\Payments;

/**
 * Example implementation of IntegrationService using Stripe.
 */
class StripeGateway implements IntegrationService
{
    public function charge(float $amount, array $options = []): array
    {
        // TODO: implement Stripe charge
        return [
            'status' => 'success',
            'transaction_id' => 'stripe_txn_123',
        ];
    }

    public function refund(string $transactionId, float $amount): array
    {
        // TODO: implement Stripe refund
        return [
            'status' => 'success',
        ];
    }
}
