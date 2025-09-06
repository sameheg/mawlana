<?php

namespace App\Services\Integration\Accounting;

/**
 * QuickBooks implementation for syncing invoices and expenses.
 */
class QuickBooksService implements AccountingService
{
    public function syncInvoice(array $invoice): bool
    {
        // TODO: integrate QuickBooks API
        return true;
    }

    public function syncExpense(array $expense): bool
    {
        // TODO: integrate QuickBooks API
        return true;
    }
}
