<?php

namespace App\Payment\Transaction\Domain\Exception\Transaction;

use DomainException;
use Throwable;

class NotAllowedByShopmanException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Lojistas não podem realizar transferências !!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}