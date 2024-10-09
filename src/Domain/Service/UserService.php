<?php

namespace App\Domain\Service;

use App\Domain\Exceptions\User\UserAlreadyExistsException;
use App\Domain\ValueObject\UserVO;
use App\Infrastructure\Builder\UserBuilder;
use App\Infrastructure\Repository\UserRepository;
use App\Infrastructure\Repository\UserTypeRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserBuilder $userBuilder,
        private readonly UserTypeRepository $userTypeRepository
    ){
    }

    public function findUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function insertUser(UserVO $userVO): void
    {

        if ($this->userRepository->findByCpfCnpj($userVO->getCpfCnpj())) {
            throw new UserAlreadyExistsException();
        }

        $userType = $this->userTypeRepository->find($userVO->getUserType());

        $user = $this->userBuilder->build($userVO, $userType);
        $this->userRepository->insertUser($user);
    }
}