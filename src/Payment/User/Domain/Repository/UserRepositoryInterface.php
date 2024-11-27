<?php

namespace App\Payment\User\Domain\Repository;

use App\Payment\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findByCpfCnpj(string $cpfCnpj): ?User;

    public function findByEmail(string $email): ?User;


}