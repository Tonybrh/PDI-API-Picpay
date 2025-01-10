<?php

namespace App\Tests\Factory;

use App\Transaction\Domain\Entity\Wallet;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

class WalletFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

        public static function class(): string
        {
            return Wallet::class;
        }

        protected function defaults(): array|callable
        {
            return [
                'balance' => self::faker()->randomFloat(2, 0, 1000)
            ];
        }

        protected function initialize(): static
        {
            return $this
                // ->afterInstantiate(function(Wallet $wallet): void {})
                ;
        }
}