<?php

namespace App\Services\Integration\Accounting;

interface AccountingService
{
    /**
     * Sync an invoice with the external accounting provider.
     */
    public function syncInvoice(array $invoice): mixed;

    /**
     * Sync an expense with the external accounting provider.
     */
    public function syncExpense(array $expense): mixed;
}
