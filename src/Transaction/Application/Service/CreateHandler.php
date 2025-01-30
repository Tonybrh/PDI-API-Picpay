<?php

namespace App\Transaction\Application\Service;

use App\Shared\Message\SendTransactionSuccessEmail;
use App\Transaction\Application\Helper\IsAuthorize;
use App\Transaction\Domain\Builder\TransactionBuilderInterface;
use App\Transaction\Domain\Exception\Transaction\TransactionNotAllowedException;
use App\Transaction\Domain\Exception\Wallet\WalletNotFoundException;
use App\Transaction\Domain\Repository\TransactionRepositoryInterface;
use App\Transaction\Domain\ValueObject\TransactionVO;
use App\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class CreateHandler
{
    public function __construct(
        private TransactionBuilderInterface $transactionBuilderInterface,
        private TransactionRepositoryInterface $transactionRepositoryInterface,
        private UserRepositoryInterface $userRepository,
        private AuthorizeTransactionHandler $authorizeTransactionHandler,
        private MessageBusInterface $bus,
        private SpendBalanceHandler $spendBalanceHandler,
        private AddBalanceHandler $addBalanceHandler
    ) {
    }

    public function __invoke(TransactionVO $transactionVO): void
    {
        $userSender = $this->userRepository->find($transactionVO->getSenderId());
        $userReceiver = $this->userRepository->find($transactionVO->getReceiverId());

        $this->transactionRepositoryInterface->beginTransaction();


        if (!$userSender->getWallet()) {
            throw new WalletNotFoundException();
        }


        ($this->spendBalanceHandler)($userSender->getWallet()->getId(), $transactionVO->getValue());

//        if (!(new IsAuthorize())(($this->authorizeTransactionHandler)())) {
//            $this->transactionRepositoryInterface->rollback();
//            throw new TransactionNotAllowedException();
//        }

        ($this->addBalanceHandler)($userReceiver->getWallet()->getId(), $transactionVO->getValue());
        $transaction = $this->transactionBuilderInterface->build($transactionVO);
        $this->transactionRepositoryInterface->save($transaction);
        $this->bus->dispatch(new SendTransactionSuccessEmail($userSender->getEmail()));
        $this->transactionRepositoryInterface->commit();
    }
}