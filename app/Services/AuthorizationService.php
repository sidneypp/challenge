<?php

namespace App\Services;

use App\Exceptions\AuthorizationExceptions;
use App\Repositories\AuthorizationRepository;
use GuzzleHttp\Exception\ClientException;

class AuthorizationService
{
    private $repository;

    public function __construct(AuthorizationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function isAuthorized(): bool
    {
        try {
            $this->repository->execute('get', env('TRANSACTION_AUTHORIZATION_API'));
        } catch (ClientException $exception) {
            throw AuthorizationExceptions::unavailable($exception->getMessage());
        }
        return true;
    }
}
