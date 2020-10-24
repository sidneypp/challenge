<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthExceptions;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            throw AuthExceptions::unauthorized();
        }

        return $next($request);
    }
}
