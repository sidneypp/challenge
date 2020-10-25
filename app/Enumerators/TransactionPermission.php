<?php

namespace App\Enumerators;

final class TransactionPermission
{
    public const TRANSACTION_VIEW_ANY = 'transaction.view_any';
    public const TRANSACTION_VIEW = 'transaction.view';
    public const TRANSACTION_CREATE = 'transaction.create';
    public const TRANSACTION_UPDATE = 'transaction.update';
    public const TRANSACTION_DELETE = 'transaction.delete';
}
