<?php

namespace App\Domain\Entity;

class User
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

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCpfCnpj(): string
    {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj(string $cpfCnpj): void
    {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function getUserType(): UserType
    {
        return $this->userType;
    }

    public function setUserType(UserType $userType): void
    {
        $this->userType = $userType;
    }

}