<?php

namespace App\Transaction\Infrastructure\Builder;

use App\Transaction\Domain\Builder\WalletBuilderInterface;
use App\Transaction\Domain\Entity\Wallet;
use App\Transaction\Domain\ValueObject\WalletVO;
use App\User\Domain\Entity\User;

class WalletBuilder implements WalletBuilderInterface
{
    public function build(WalletVO $walletVO, User $user): Wallet
    {
        $wallet = new Wallet();
        $wallet->setBalance($walletVO->getBalance());
        $wallet->setUserId($user);

        return $wallet;
    }
}