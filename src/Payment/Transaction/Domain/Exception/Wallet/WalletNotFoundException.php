<?php

namespace App\Payment\Transaction\Domain\Exception\Wallet;

use DomainException;
use Throwable;

class WalletNotFoundException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Carteira não existente, atualize sua carteira!!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}