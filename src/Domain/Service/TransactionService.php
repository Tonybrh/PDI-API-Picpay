<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Enums\UserRoleEnum;
use App\Domain\Exceptions\Transaction\NotAllowedByShopmanException;
use App\Domain\Exceptions\Transaction\TransactionNotAllowedException;
use App\Domain\Exceptions\Wallet\WalletNotFoundException;
use App\Domain\ValueObject\TransactionVO;
use App\Infrastructure\Builder\TransactionBuilder;
use App\Infrastructure\Repository\TransactionRepository;
use App\Infrastructure\Repository\UserRepository;

readonly class TransactionService
{
    public function __construct(
        private TransactionBuilder $transactionBuilder,
        private TransactionRepository $transactionRepository,
        private UserRepository $userRepository,
        private WalletService $walletService,
        private AuthorizeTransactionService $authorizeTransactionService
    ) { }

    public function create(TransactionVO $transactionVO): void
    {
        $userSender = $this->userRepository->find($transactionVO->getSenderId());
        $userReceiver = $this->userRepository->find($transactionVO->getReceiverId());

        $this->transactionRepository->beginTransaction();

        if ($userSender->getWallet()->getId()) {
            throw new WalletNotFoundException();
        }

        $this->walletService->spendBalance($userSender->getWallet()->getId(), $transactionVO->getValue());

        if (!$this->isAuthorized($this->authorizeTransactionService->authorize())) {
            $this->transactionRepository->rollback();
            throw new TransactionNotAllowedException();
        }

        $this->walletService->addBalance($userReceiver->getWallet()->getId(), $transactionVO->getValue());
        $transaction = $this->transactionBuilder->build($transactionVO);
        $this->transactionRepository->persist($transaction);

        $this->transactionRepository->commit();
    }

    private function isAuthorized(array $authorize): bool
    {
        return $authorize['authorize'] == true;
    }
}