<?php

namespace App\Domain\Exceptions\Wallet;

use Throwable;
use DomainException;

class WalletNotFoundException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Carteira não existente, atualize sua carteira!!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}