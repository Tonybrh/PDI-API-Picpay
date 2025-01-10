<?php

namespace App\Tests\Transaction\Application\Api;

use App\Tests\Factory\UserFactory;
use App\Tests\Factory\WalletFactory;
use App\Transaction\Domain\Entity\Transaction;
use App\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class SendTransactionPostActionTest extends WebTestCase
{
    use Factories;
    use ResetDatabase;

    private const string URI = '/api/transaction/send';

    private KernelBrowser $client;
    private UserRepositoryInterface $userRepository;
    private ?EntityManager $entityManager;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
        $this->userRepository = static::getContainer()->get(UserRepositoryInterface::class);
        $this->entityManager = static::getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function testCreateTransaction(): void
    {
        $userSender = UserFactory::createOne();
        $userReceiver = UserFactory::createOne();

        WalletFactory::createOne([
            'user' => $userSender,
            'balance' => 100
        ]);
        WalletFactory::createOne([
            'user' => $userReceiver,
            'balance' => 100
        ]);

        $userSender = $this->userRepository->findOneBy(['id' => $userSender->getId()]);
        $userReceiver = $this->userRepository->findOneBy(['id' => $userReceiver->getId()]);

        $this->client->loginUser($userSender);

        $body = [
            'senderId' => $userSender->getId(),
            'receiverId' => $userReceiver->getId(),
            'value' => 10
        ];

        $this->client->request(
            Request::METHOD_POST,
            self::URI,
            server: ['CONTENT_TYPE' => 'application/json'],
            content: json_encode($body)
        );

        $transaction = $this->entityManager->getRepository(Transaction::class)
            ->findOneBy(['senderId' => $userSender->getId(), 'receiverId' => $userReceiver->getId()]);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
        $this->assertNotNull($transaction);
        $this->assertEquals($userSender->getId(), $transaction->getSenderWallet()->getUser()->getId());
        $this->assertEquals($userReceiver->getId(), $transaction->getReceiverWallet()->getUser()->getId());
        $this->assertEquals(10, $transaction->getAmount());
        $this->assertEquals(90, $userSender->getWallet()->getBalance());
        $this->assertEquals(110, $userReceiver->getWallet()->getBalance());
    }
}