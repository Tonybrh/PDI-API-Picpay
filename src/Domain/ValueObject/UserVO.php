<?php

namespace App\Domain\ValueObject;

use App\Domain\Entity\UserType;

class UserVO
{
    private int $id;
    private string $name;
    private string $cpfCnpj;
    private string $email;
    private string $password;
    private UserType $userType;

    public function getId(): int
    {
        return $this->id;
    }

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

    public function getUserType(): UserType
    {
        return $this->userType;
    }
}