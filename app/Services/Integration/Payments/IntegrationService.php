<?php

namespace App\Services\Integration\Payments;

/**
 * IntegrationService provides a common contract for payment gateways.
 */
interface IntegrationService
{
    /**
     * Charge a payment amount through the gateway.
     */
    public function charge(float $amount, array $options = []): mixed;

    /**
     * Refund a transaction by its ID.
     */
    public function refund(string $transactionId, float $amount): mixed;
}
