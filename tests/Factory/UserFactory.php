<?php

namespace App\Tests\Factory;

use App\User\Domain\Entity\User;
use UserLoginHelperBundle\Enum\System\RoleEnum;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

class UserFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return User::class;
    }

    protected function defaults(): array|callable
    {
        return [
            '$cpfCnpj' => self::faker()->text(11),
            'email' => self::faker()->email(),
            'name' => self::faker()->name(),
            'password' => self::faker()->password(10),
            'roles' => [RoleEnum::class::ROLE_COMMON->name],
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(User $user): void {})
            ;
    }
}