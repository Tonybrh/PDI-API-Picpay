<?php

namespace App\Payment\Transaction\Application\Service;

use App\Domain\Message\SendTransactionSuccessEmail;
use App\Payment\Transaction\Application\Helper\IsAuthorize;
use App\Payment\Transaction\Domain\Builder\TransactionBuilderInterface;
use App\Payment\Transaction\Domain\Exception\Transaction\TransactionNotAllowedException;
use App\Payment\Transaction\Domain\Exception\Wallet\WalletNotFoundException;
use App\Payment\Transaction\Domain\Repository\TransactionRepositoryInterface;
use App\Payment\Transaction\Domain\ValueObject\TransactionVO;
use App\Payment\User\Domain\Repository\UserRepositoryInterface;
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

        if (!$userSender->getWallet()->getId()) {
            throw new WalletNotFoundException();
        }

        $this->spendBalanceHandler->__invoke($userSender->getWallet()->getId(), $transactionVO->getValue());

        if (!(new IsAuthorize())->__invoke($this->authorizeTransactionHandler->__invoke())) {
            $this->transactionRepositoryInterface->rollback();
            throw new TransactionNotAllowedException();
        }

        $this->addBalanceHandler->__invoke($userReceiver->getWallet()->getId(), $transactionVO->getValue());
        $transaction = $this->transactionBuilderInterface->build($transactionVO);
        $this->transactionRepositoryInterface->save($transaction);
        $this->bus->dispatch(new SendTransactionSuccessEmail($userSender->getEmail()));
        $this->transactionRepositoryInterface->commit();
    }
}