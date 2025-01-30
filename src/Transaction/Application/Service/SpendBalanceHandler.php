<?php

namespace App\Transaction\Application\Service;

use App\Transaction\Application\Helper\HasBalance;
use App\Transaction\Domain\Exception\Wallet\NotEnoghBalanceException;
use App\Transaction\Domain\Repository\WalletRepositoryInterface;
use Psr\Log\LoggerInterface;

final readonly class SpendBalanceHandler
{
    public function __construct(
        private WalletRepositoryInterface $walletRepositoryInterface
    ) {
    }

    public function __invoke(int $senderWalletId, float $value): void
    {
        $senderWallet = $this->walletRepositoryInterface->find($senderWalletId);

        if (!(new HasBalance())($senderWallet, $value)) {
            throw new NotEnoghBalanceException();
        }

        $senderWallet->setBalance($senderWallet->getBalance() - $value);
        $this->walletRepositoryInterface->save($senderWallet);
    }
}