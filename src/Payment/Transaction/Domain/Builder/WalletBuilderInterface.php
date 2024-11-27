<?php

namespace App\Payment\Transaction\Domain\Builder;

use App\Payment\Transaction\Domain\Entity\Wallet;
use App\Payment\Transaction\Domain\ValueObject\WalletVO;
use App\Payment\User\Domain\Entity\User;

interface WalletBuilderInterface
{
    public function build(WalletVO $walletVO, User $user): Wallet;
}