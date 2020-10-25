<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->input('api_token')) {
                return User::where('api_token', $request->input('api_token'))->first();
            }
        });
    }
}
