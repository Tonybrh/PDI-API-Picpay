<?php

namespace App\Payment\Transaction\Domain\Repository;

use App\Payment\Transaction\Domain\Entity\Wallet;

interface WalletRepositoryInterface
{
    public function save(Wallet $user): void;
}