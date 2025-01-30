<?php

namespace App\Transaction\Domain\Repository;

use App\Transaction\Domain\Entity\Wallet;

interface WalletRepositoryInterface
{
    public function save(Wallet $wallet): void;
}