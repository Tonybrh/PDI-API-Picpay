<?php

namespace App\Domain\Service;

use App\Domain\Entity\User;
use App\Domain\Enums\UserTypeEnum;
use App\Domain\Exceptions\Transaction\NotAllowedByShopmanException;
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
        private WalletService $walletService
    ) { }

    public function create(TransactionVO $transactionVO): void
    {
        $userSender = $this->userRepository->find($transactionVO->getSenderId());
        $userReceiver = $this->userRepository->find($transactionVO->getReceiverId());
        if ($this->userIsShopman($userSender)) {
            throw new NotAllowedByShopmanException();
        }
        $this->walletService->spendBalance($userSender->getWallet()->getId(), $transactionVO->getValue());
        $this->walletService->addBalance($userReceiver->getWallet()->getId(), $transactionVO->getValue());
        $transaction = $this->transactionBuilder->build($transactionVO);
        $this->transactionRepository->insert($transaction);
    }

    private function userIsShopman(User $user): bool
    {
        return $user->getUserType()->getId() == UserTypeEnum::SHOPMAN->value;
    }
}