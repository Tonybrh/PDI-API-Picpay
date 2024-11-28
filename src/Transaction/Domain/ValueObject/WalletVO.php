<?php

namespace App\Transaction\Domain\ValueObject;

class WalletVO
{
    private int $userId;
    private ?float $balance = null;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(?float $balance): void
    {
        $this->balance = $balance;
    }
}