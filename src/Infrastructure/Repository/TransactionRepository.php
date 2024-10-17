<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function insert(Transaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }
}