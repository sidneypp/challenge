<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthExceptions extends BuildException
{
    public static function unauthorized()
    {
        return self::new()
            ->setMessage(trans('exception.auth.unauthorized'))
            ->setHttpCode(Response::HTTP_UNAUTHORIZED);
    }
}
