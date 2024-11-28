<?php

namespace App\Transaction\Domain\Builder;

use App\Transaction\Domain\Entity\Wallet;
use App\Transaction\Domain\ValueObject\WalletVO;
use App\User\Domain\Entity\User;

interface WalletBuilderInterface
{
    public function build(WalletVO $walletVO, User $user): Wallet;
}