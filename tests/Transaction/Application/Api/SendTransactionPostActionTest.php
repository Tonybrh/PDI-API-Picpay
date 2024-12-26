<?php

namespace App\Tests\Transaction\Application\Api;

use App\User\Domain\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class SendTransactionPostActionTest extends WebTestCase
{
    public function testInvoke(): void
    {
        $client = static::createClient();

        $client->request('POST', 'http://localhost:8005/api/transaction/send', [
            'senderId' => 1,
            'receiverId' => 1,
            'value' => 20
        ]);

        $user = new User();
        $client->loginUser($user, 'main');
        if($client->getResponse()->getStatusCode() == 401) {
            $client->request('POST', 'http://localhost:8005/api/login_check', [
                'username' => 'admin',
                'password' => 'admin'
            ]);
        }

        $this->assertResponseIsSuccessful();

        static::ensureKernelShutdown();
    }
}