<?php

namespace App\Payment\Transaction\Application\Service;

use App\Payment\Transaction\Domain\Repository\WalletRepositoryInterface;

final readonly class AddBalanceHandler
{
    public function __construct(
        private WalletRepositoryInterface $walletRepositoryInterface
    ) {
    }

    public function __invoke(int $receiverWalletId, float $value): void
    {
        $wallet = $this->walletRepositoryInterface->find($receiverWalletId);
        $wallet->setBalance($wallet->getBalance() + $value);
        $this->walletRepositoryInterface->save($wallet);
    }
}