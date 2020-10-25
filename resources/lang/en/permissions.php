<?php

use App\Enumerators\TransactionPermission;
use App\Enumerators\UserPermission;

return [
    UserPermission::USER_VIEW_ANY => 'View user list',
    UserPermission::USER_VIEW => 'View a user',
    UserPermission::USER_CREATE => 'Create a user',
    UserPermission::USER_UPDATE => 'Update a user',
    UserPermission::USER_DELETE => 'Delete a user',
    TransactionPermission::TRANSACTION_VIEW_ANY => 'View transaction list',
    TransactionPermission::TRANSACTION_VIEW => 'View a transaction',
    TransactionPermission::TRANSACTION_CREATE => 'Create a transaction',
    TransactionPermission::TRANSACTION_UPDATE => 'Update a transaction',
    TransactionPermission::TRANSACTION_DELETE => 'Delete a transaction',
];
