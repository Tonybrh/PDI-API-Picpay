<?php

namespace App\Domain\Service;

use App\Domain\Entity\Wallet;
use App\Domain\Exceptions\Wallet\NotEnoghBalanceException;
use App\Infrastructure\Repository\WalletRepository;

readonly class WalletService
{
    public function __construct(private WalletRepository $walletRepository)
    {
    }
    public function spendBalance(int $senderWalletId, float $value): void
    {
        $senderWallet = $this->walletRepository->find($senderWalletId);

        if (!$this->hasBalance($senderWallet, $value)) {
            throw new NotEnoghBalanceException();
        }

        $senderWallet->setBalance($senderWallet->getBalance() - $value);
        $this->walletRepository->insertUpdate($senderWallet);
    }

    public function addBalance(int $receiverWalletId, float $value): void
    {
        $wallet = $this->walletRepository->find($receiverWalletId);
        $wallet->setBalance($wallet->getBalance() + $value);
        $this->walletRepository->insertUpdate($wallet);
    }

    public function hasBalance(Wallet $wallet, float $value): bool
    {
        return $wallet->getBalance() >= $value;
    }
}