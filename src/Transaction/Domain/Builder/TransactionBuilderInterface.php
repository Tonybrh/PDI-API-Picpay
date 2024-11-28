<?php

namespace App\Transaction\Domain\Builder;

use App\Transaction\Domain\Entity\Transaction;
use App\Transaction\Domain\ValueObject\TransactionVO;

interface TransactionBuilderInterface
{
    public function build(TransactionVO $transactionVO): Transaction;
}