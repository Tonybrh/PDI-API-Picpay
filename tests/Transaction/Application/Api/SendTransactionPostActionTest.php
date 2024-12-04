<?php

namespace App\Tests\Transaction\Application\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendTransactionPostActionTest extends WebTestCase
{
    public function testInvoke(): void
    {
        $client = static::createClient();

        $crawler = $client->request('POST', 'http://localhost:8005/api/transaction/send', [
            'senderId' => 1,
            'receiverId' => 1,
            'value' => 20
        ]);

        $this->assertResponseIsSuccessful();
    }
}