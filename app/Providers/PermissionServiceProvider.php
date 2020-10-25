<?php

namespace App\Providers;

use App\Models\User;
use Database\Factories\PermissionFactory;
use Illuminate\Support\Facades\Gate;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        foreach (PermissionFactory::PERMISSIONS as $permission) {
            Gate::define($permission, function (User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
    }
}
