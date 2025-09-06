<?php

namespace App\Services;

use App\Services\AuditLogService;

class TransactionService
{
    public function process(string $cardNumber, float $amount): array
    {
        $last4 = substr($cardNumber, -4);

        AuditLogService::log('transaction_processed', [
            'amount' => $amount,
            'card_last4' => $last4,
        ]);

        return [
            'amount' => $amount,
            'card_last4' => $last4,
        ];
    }
}
