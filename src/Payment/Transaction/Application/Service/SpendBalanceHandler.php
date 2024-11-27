<?php

namespace App\Payment\Transaction\Application\Service;

use App\Payment\Transaction\Application\Helper\HasBalance;
use App\Payment\Transaction\Domain\Exception\Wallet\NotEnoghBalanceException;
use App\Payment\Transaction\Domain\Repository\WalletRepositoryInterface;

final readonly class SpendBalanceHandler
{
    public function __construct(
        private WalletRepositoryInterface $walletRepositoryInterface
    ) {
    }

    public function __invoke(int $senderWalletId, float $value): void
    {
        $senderWallet = $this->walletRepositoryInterface->find($senderWalletId);

        if (!(new HasBalance())->__invoke($senderWallet, $value)) {
            throw new NotEnoghBalanceException();
        }

        $senderWallet->setBalance($senderWallet->getBalance() - $value);
        $this->walletRepositoryInterface->save($senderWallet);
    }
}