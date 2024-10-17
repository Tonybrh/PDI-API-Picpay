<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Wallet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WalletRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallet::class);
    }

    public function persist(Wallet $wallet): void
    {
        $this->getEntityManager()->persist($wallet);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}