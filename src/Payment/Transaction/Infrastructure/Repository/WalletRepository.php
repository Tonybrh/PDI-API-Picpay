<?php

namespace App\Payment\Transaction\Infrastructure\Repository;

use App\Payment\Transaction\Domain\Entity\Wallet;
use App\Payment\Transaction\Domain\Repository\WalletRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class WalletRepository extends ServiceEntityRepository implements WalletRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wallet::class);
    }

    public function save(Wallet $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}