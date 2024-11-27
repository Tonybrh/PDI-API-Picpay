<?php

namespace App\Payment\Transaction\Domain\Builder;

use App\Payment\Transaction\Domain\Entity\Transaction;
use App\Payment\Transaction\Domain\ValueObject\TransactionVO;

interface TransactionBuilderInterface
{
    public function build(TransactionVO $transactionVO): Transaction;
}