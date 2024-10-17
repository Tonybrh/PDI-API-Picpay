<?php

namespace App\Domain\Exceptions\Wallet;

use Throwable;
use DomainException;

class NotEnoghBalanceException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Usuário não possui saldo suficiente para realizar a transação !!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}