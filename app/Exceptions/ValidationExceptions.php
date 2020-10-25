<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ValidationExceptions extends BuildException
{
    public static function invalid(string $message)
    {
        return self::new()
            ->setMessage($message)
            ->setHttpCode(Response::HTTP_BAD_REQUEST);
    }
}
