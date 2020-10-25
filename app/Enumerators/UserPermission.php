<?php

namespace App\Enumerators;

final class UserPermission
{
    public const USER_VIEW_ANY = 'user.view_any';
    public const USER_VIEW = 'user.view';
    public const USER_CREATE = 'user.create';
    public const USER_UPDATE = 'user.update';
    public const USER_DELETE = 'user.delete';
}
