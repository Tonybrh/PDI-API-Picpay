<?php

namespace App\Payment\Transaction\Infrastructure\Builder;

use App\Payment\Transaction\Domain\Entity\Wallet;
use App\Payment\Transaction\Domain\ValueObject\WalletVO;
use App\Payment\User\Domain\Entity\User;

class WalletBuilder
{
    public function build(WalletVO $walletVO, User $user): Wallet
    {
        $wallet = new Wallet();
        $wallet->setBalance($walletVO->getBalance());
        $wallet->setUserId($user);

        return $wallet;
    }
}