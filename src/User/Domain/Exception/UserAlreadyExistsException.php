<?php

namespace App\User\Domain\Exception;

use DomainException;
use Throwable;

class UserAlreadyExistsException extends DomainException
{
    private const MENSAGEM_DEFAULT = 'Usuário já cadastrado !!';

    public function __construct($message = null, $code = null, Throwable $previous = null)
    {
        parent::__construct($message ?? self::MENSAGEM_DEFAULT, $code, $previous);
    }
}