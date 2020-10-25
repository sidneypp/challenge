<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthExceptions
{
    public static function unauthorized()
    {
        return BuildException::new()
            ->setMessage(trans('exception.user_unauthorized'))
            ->setHttpCode(Response::HTTP_UNAUTHORIZED);
    }
}
