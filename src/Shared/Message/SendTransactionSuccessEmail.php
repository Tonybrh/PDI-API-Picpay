<?php

namespace App\Shared\Message;

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