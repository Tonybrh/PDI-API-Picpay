<?php

namespace App\User\Application\Service;

use App\User\Domain\Builder\UserBuilderInterface;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserVO;

final readonly class InsertUserHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepositoryInterface,
        private UserBuilderInterface $userBuilderInterface
    ) {
    }
    public function __invoke(UserVO $userVO): void
    {
        if (
            $this->userRepositoryInterface->findByCpfCnpj($userVO->getCpfCnpj())
            || $this->userRepositoryInterface->findByEmail($userVO->getEmail())
        ) {
            throw new UserAlreadyExistsException();
        }

        $user = $this->userBuilderInterface->build($userVO);
        $this->userRepositoryInterface->save($user);
    }
}