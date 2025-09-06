<?php

namespace App\Services\Integration\Delivery;

/**
 * Talabat delivery integration stub.
 */
class TalabatService implements DeliveryService
{
    public function sendOrder(array $order): bool
    {
        // TODO: send order to Talabat API
        return true;
    }

    public function fetchOrders(): array
    {
        // TODO: fetch orders from Talabat API
        return [];
    }
}
