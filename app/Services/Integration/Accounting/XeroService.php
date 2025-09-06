<?php

namespace App\Services\Integration\Accounting;

/**
 * Xero implementation for syncing invoices and expenses.
 */
class XeroService implements AccountingService
{
    public function syncInvoice(array $invoice): bool
    {
        // TODO: integrate Xero API
        return true;
    }

    public function syncExpense(array $expense): bool
    {
        // TODO: integrate Xero API
        return true;
    }
}
