<?php

namespace App\Domain\Exceptions\Transaction;

use Throwable;
use DomainException;

class TransactionNotAllowedException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Transação não autorizada!!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}