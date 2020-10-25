<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof AuthorizationException) {
            throw AuthorizationExceptions::unauthorized();
        } elseif ($exception instanceof ModelNotFoundException) {
            $id = Arr::first($exception->getIds());
            $model = Arr::last(explode("\\", $exception->getModel()));
            throw ModelExceptions::notFound($id, $model);
        } elseif ($exception instanceof ValidationException) {
            throw ValidationExceptions::invalid($exception->validator->errors()->first());
        }

        return parent::render($request, $exception);
    }
}
