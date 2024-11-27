<?php

namespace App\Payment\Transaction\Application\Helper;

use App\Payment\Transaction\Domain\Entity\Wallet;

final class HasBalance
{
    public function __invoke(Wallet $wallet, float $value): bool
    {
        return $wallet->getBalance() >= $value;
    }
}