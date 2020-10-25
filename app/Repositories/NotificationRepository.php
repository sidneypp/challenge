<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class NotificationRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function execute(string $method, string $url = '', array $options = []): ResponseInterface
    {
        return $this->client->request($method, $url, $options);
    }
}
