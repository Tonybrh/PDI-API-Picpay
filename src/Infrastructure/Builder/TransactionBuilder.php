<?php

namespace App\Infrastructure\Builder;

use App\Domain\Entity\Transaction;
use App\Domain\Entity\User;
use App\Domain\ValueObject\TransactionVO;

class TransactionBuilder
{
    public function build(TransactionVO $transactionVO): Transaction
    {
        $transaction = new Transaction();
        $transaction->setSenderId($transactionVO->getSenderId());
        $transaction->setReceiverId($transactionVO->getReceiverId());
        $transaction->setValue($transactionVO->getValue());
        $transaction->setStatus('pending');
        $transaction->setCreatedAt(date('Y-m-d H:i:s'));
        $transaction->setUpdatedAt(date('Y-m-d H:i:s'));

        return $transaction;
    }
}