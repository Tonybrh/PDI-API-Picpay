<?php

namespace App\Transaction\Application\Helper;

use App\Transaction\Domain\Entity\Wallet;

final class HasBalance
{
    public function __invoke(Wallet $wallet, float $value): bool
    {
        return $wallet->getBalance() >= $value;
    }
}