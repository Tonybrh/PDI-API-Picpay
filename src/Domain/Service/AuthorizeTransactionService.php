<?php

namespace App\Domain\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;


readonly class AuthorizeTransactionService
{
    public function __construct(
        private Client $client
    ) {
    }

    public function authorize(): array
    {
            $response = $this->client->request('GET', 'https://run.mocky.io/v3/c74cbbdb-584a-4ae1-9619-c6d84e335db1');
            $body = $response->getBody();
            $data = json_decode($body, true);

            return $data;
    }
}