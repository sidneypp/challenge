<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class AuthorizationExceptions
{
    public static function unauthorized()
    {
        return BuildException::new()
            ->setMessage(trans('exception.action_unauthorized'))
            ->setHttpCode(Response::HTTP_UNAUTHORIZED);
    }

    public static function unavailable(string $message)
    {
        return BuildException::new()
            ->setMessage($message)
            ->setHttpCode(Response::HTTP_UNAUTHORIZED);
    }
}
