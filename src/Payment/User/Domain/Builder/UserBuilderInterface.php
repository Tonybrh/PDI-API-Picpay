<?php

namespace App\Payment\User\Domain\Builder;

use App\Payment\User\Domain\Entity\User;
use App\Payment\User\Domain\ValueObject\UserVO;

interface UserBuilderInterface
{
    public function build(UserVO $userVO): User;
}