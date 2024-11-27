<?php

namespace App\Payment\Transaction\Infrastructure\Builder;

use App\Payment\Transaction\Domain\Builder\TransactionBuilderInterface;
use App\Payment\Transaction\Domain\Entity\Transaction;
use App\Payment\Transaction\Domain\ValueObject\TransactionVO;

class TransactionBuilder implements TransactionBuilderInterface
{
    public function build(TransactionVO $transactionVO): Transaction
    {
        $transaction = new Transaction();
        $transaction->setSenderId($transactionVO->getSenderId());
        $transaction->setReceiverId($transactionVO->getReceiverId());
        $transaction->setValue($transactionVO->getValue());
        $transaction->setStatus('Ok');
        $transaction->setCreatedAt(new \DateTime("now"));
        $transaction->setUpdatedAt(new \DateTime("now"));

        return $transaction;
    }
}