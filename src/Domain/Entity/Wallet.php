<?php

namespace App\Domain\Entity;

class Wallet
{
    private int $id;
    private User $userId;
    private ?float $balance = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): void
    {
        $this->userId = $userId;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }
}