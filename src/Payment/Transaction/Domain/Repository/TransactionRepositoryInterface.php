<?php

namespace App\Payment\Transaction\Domain\Repository;

use App\Payment\Transaction\Domain\Entity\Transaction;

interface TransactionRepositoryInterface
{
    public function save(Transaction $transaction): void;

    public function beginTransaction(): void;

    public function rollback(): void;

    public function commit(): void;
}