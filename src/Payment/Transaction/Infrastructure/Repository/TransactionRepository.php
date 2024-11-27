<?php

namespace App\Payment\Transaction\Infrastructure\Repository;

use App\Payment\Transaction\Domain\Entity\Transaction;
use App\Payment\Transaction\Domain\Repository\TransactionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TransactionRepository extends ServiceEntityRepository implements TransactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function save(Transaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }

    public function beginTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    public function rollback(): void
    {
        $this->getEntityManager()->rollback();
    }

    public function commit(): void
    {
        $this->getEntityManager()->commit();
    }
}