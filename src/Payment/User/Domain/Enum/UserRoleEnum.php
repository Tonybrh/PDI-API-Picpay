<?php

namespace App\Payment\User\Domain\Enum;

enum UserRoleEnum: int
{
     case ROLE_SHOPMAN = 1;
     case ROLE_COMMON = 2;

    public static function getById(int $id): UserRoleEnum
    {
        return match ($id) {
            self::ROLE_SHOPMAN->value => self::ROLE_SHOPMAN,
            self::ROLE_COMMON->value => self::ROLE_COMMON,
        };
    }
}
