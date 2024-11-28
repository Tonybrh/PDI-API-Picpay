<?php

namespace App\User\Domain\Builder;

use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\UserVO;

interface UserBuilderInterface
{
    public function build(UserVO $userVO): User;
}