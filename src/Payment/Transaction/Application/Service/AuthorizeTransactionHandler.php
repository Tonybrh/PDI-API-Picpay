<?php

namespace App\Payment\Transaction\Application\Service;

use GuzzleHttp\ClientInterface;

final readonly class AuthorizeTransactionHandler
{
    public function __construct(
        private ClientInterface $client
    ) {
    }

    public function __invoke(): array
    {
        $response = $this->client->request('GET', 'https://run.mocky.io/v3/c74cbbdb-584a-4ae1-9619-c6d84e335db1');
        $body = $response->getBody();
        return json_decode($body, true);
    }
}