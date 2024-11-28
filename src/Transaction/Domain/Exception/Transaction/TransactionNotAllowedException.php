<?php

namespace App\Transaction\Domain\Exception\Transaction;

use DomainException;
use Throwable;

class TransactionNotAllowedException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Transação não autorizada!!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}