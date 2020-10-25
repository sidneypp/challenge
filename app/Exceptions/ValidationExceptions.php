<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ValidationExceptions
{
    public static function invalid(string $message)
    {
        return BuildException::new()
            ->setMessage($message)
            ->setHttpCode(Response::HTTP_BAD_REQUEST);
    }
}
