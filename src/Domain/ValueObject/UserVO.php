<?php

namespace App\Domain\ValueObject;

use App\Domain\Entity\UserType;
use Symfony\Component\Serializer\Attribute\Ignore;

class UserVO
{
    private string $name;
    private string $cpfCnpj;
    private string $email;
    private string $password;
    private int $userType;
    private ?float $balance = null;
    public function getName(): string
    {
        return $this->name;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUserType(): int
    {
        return $this->userType;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCpfCnpj(string $cpfCnpj): void
    {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setUserType(int $userType): void
    {
        $this->userType = $userType;
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