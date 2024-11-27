<?php

namespace App\Payment\User\Application\Service;

use App\Payment\User\Domain\Builder\UserBuilderInterface;
use App\Payment\User\Domain\Exception\UserAlreadyExistsException;
use App\Payment\User\Domain\Repository\UserRepositoryInterface;
use App\Payment\User\Domain\ValueObject\UserVO;

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