<?php

namespace App\Infrastructure\Builder;

use App\Domain\Entity\User;
use App\Domain\Entity\UserType;
use App\Domain\ValueObject\UserVO;

class UserBuilder
{
    public function build(UserVO $userVO, UserType $userType): User
    {
        $user = new User();
        $user->setCpfCnpj($userVO->getCpfCnpj());
        $user->setEmail($userVO->getEmail());
        $user->setName($userVO->getName());
        $user->setPassword($userVO->getPassword());
        $user->setUserType($userType);

        return $user;
    }
}