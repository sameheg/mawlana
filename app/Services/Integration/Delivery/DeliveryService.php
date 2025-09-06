<?php

namespace App\Services\Integration\Delivery;

interface DeliveryService
{
    /**
     * Send an order to the delivery provider.
     */
    public function sendOrder(array $order): mixed;

    /**
     * Fetch new orders from the provider.
     *
     * @return array<int, mixed>
     */
    public function fetchOrders(): array;
}
