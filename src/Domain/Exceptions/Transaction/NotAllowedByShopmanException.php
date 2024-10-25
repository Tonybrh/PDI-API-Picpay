<?php

namespace App\Domain\Exceptions\Transaction;

use Throwable;
use DomainException;

class NotAllowedByShopmanException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Lojistas não podem realizar transferências !!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}