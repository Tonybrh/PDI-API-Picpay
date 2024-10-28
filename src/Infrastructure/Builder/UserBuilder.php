<?php

namespace App\Infrastructure\Builder;

use App\Domain\Entity\User;
use App\Domain\Enums\UserRoleEnum;
use App\Domain\ValueObject\UserVO;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


readonly class UserBuilder
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function build(UserVO $userVO): User
    {
        $user = new User();

        $role = [
            'role' => UserRoleEnum::getById($userVO->getUserType())->name,
        ];

        $user->setCpfCnpj($userVO->getCpfCnpj());
        $user->setEmail($userVO->getEmail());
        $user->setName($userVO->getName());
        $user->setRoles($role);

        $password = $this->passwordHasher->hashPassword(
            $user,
            $userVO->getPassword()
        );
        $user->setPassword($password);

        return $user;
    }
}