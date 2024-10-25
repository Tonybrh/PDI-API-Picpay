<?php

namespace App\Infrastructure\Builder;

use App\Domain\Entity\User;
use App\Domain\Entity\Wallet;
use App\Domain\ValueObject\WalletVO;

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