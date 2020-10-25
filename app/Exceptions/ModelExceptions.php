<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ModelExceptions extends BuildException
{
    public static function notFound(int $id, string $model)
    {
        $replace = ['model' => $model, 'id' => $id];
        return self::new()
            ->setMessage(trans('exception.record_not_found', $replace))
            ->setHttpCode(Response::HTTP_NOT_FOUND);
    }
}
