<?php

namespace App\Infrastructure\Builder;

use App\Domain\Entity\User;
use App\Domain\Entity\UserType;
use App\Domain\Enums\UserRoleEnum;
use App\Domain\ValueObject\UserVO;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserBuilder
{

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function build(UserVO $userVO, UserType $userType): User
    {
        $user = new User();

        $role = [
            'role' => UserRoleEnum::getById($userVO->getUserType())->name,
        ];

        $user->setCpfCnpj($userVO->getCpfCnpj());
        $user->setEmail($userVO->getEmail());
        $user->setName($userVO->getName());
        $user->setUserType($userType);
        $user->setRoles($role);

        $password = $this->passwordHasher->hashPassword(
            $user,
            $userVO->getPassword()
        );
        $user->setPassword($password);

        return $user;
    }
}