<?php

namespace App\Domain\Service;

use App\Domain\ValueObject\UserVO;
use App\Infrastructure\Repository\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ){}

    public function findUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function insertUser(UserVO $data): void
    {
        $cpfCpj = $data['cpfCnpj'];

        if ($this->userRepository->findByCpfCnpj($cpfCpj)) {
            throw new \Exception('CPF/CNPJ already exists');
        }

        $this->userRepository->insertUser($data);
    }
}