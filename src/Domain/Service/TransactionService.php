<?php

namespace App\Domain\Service;

use App\Domain\ValueObject\TransactionVO;
use App\Infrastructure\Builder\TransactionBuilder;
use App\Infrastructure\Repository\TransactionRepository;

class TransactionService
{
    public function __construct(
        private readonly TransactionBuilder $transactionBuilder,
        private readonly TransactionRepository $transactionRepository
    )
    {}
    public function createTransaction(TransactionVO $transactionVO): void
    {
        $transaction = $this->transactionBuilder->build($transactionVO);
        $this->transactionRepository->insertTransaction($transaction);
    }
}