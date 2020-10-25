<?php

namespace App\Services;

use App\Exceptions\AuthorizationExceptions;
use App\Repositories\NotificationRepository;
use GuzzleHttp\Exception\ClientException;

class NotificationService
{
    private $repository;

    public function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function send()
    {
        try {
            $this->repository->execute('get', env('TRANSACTION_NOTIFICATION_API'));
        } catch (ClientException $exception) {
            throw AuthorizationExceptions::unavailable($exception->getMessage());
        }
    }
}
