<?php

namespace App\Domain\Message;

readonly class SendTransactionSuccessEmail
{
    public function __construct(
        private string $email
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}