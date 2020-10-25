<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthorizationExceptions extends BuildException
{
    public static function unauthorized()
    {
        return self::new()
            ->setMessage(trans('exception.action_unauthorized'))
            ->setHttpCode(Response::HTTP_UNAUTHORIZED);
    }
}
