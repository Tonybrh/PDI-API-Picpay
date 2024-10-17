<?php

namespace App\Domain\Service;

use App\Infrastructure\Repository\WalletRepository;

readonly class WalletService
{
    public function __construct(private WalletRepository $walletRepository)
    {
    }
    public function spendBalance(int $senderWalletId, float $value): void
    {
        $wallet = $this->walletRepository->find($senderWalletId);
        $wallet->setBalance($wallet->getBalance() - $value);
        $this->walletRepository->persist($wallet);
        $this->walletRepository->flush();
    }

    public function addBalance(int $receiverWalletId, float $value): void
    {
        $wallet = $this->walletRepository->find($receiverWalletId);
        $wallet->setBalance($wallet->getBalance() + $value);
        $this->walletRepository->persist($wallet);
        $this->walletRepository->flush();
    }
}