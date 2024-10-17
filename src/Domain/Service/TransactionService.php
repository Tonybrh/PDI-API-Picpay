<?php

namespace App\Domain\Service;

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
        private UserRepository $userRepository
    ) { }

    public function create(TransactionVO $transactionVO): void
    {
        $userSender = $this->userRepository->find($transactionVO->getSenderId());

        if ($this->userIsShopman($transactionVO->getSenderId())) {
            throw new NotAllowedByShopmanException();
        }

        $transaction = $this->transactionBuilder->build($transactionVO);
        $this->transactionRepository->insert($transaction);
    }

    private function userIsShopman(int $userId): bool
    {
        $user = $this->userRepository->find($userId);
        return $user->getUserType()->getId() == UserTypeEnum::SHOPMAN->value;
    }
}