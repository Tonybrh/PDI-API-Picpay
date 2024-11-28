<?php

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findByCpfCnpj(string $cpfCnpj): ?User;

    public function findByEmail(string $email): ?User;


}