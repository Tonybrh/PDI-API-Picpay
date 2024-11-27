<?php

namespace App\Payment\User\Infrastructure\Repository;

use App\Payment\User\Domain\Entity\User;
use App\Payment\User\Domain\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findByCpfCnpj(string $cpfCnpj): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.cpfCnpj = :cpfCnpj')
            ->setParameter('cpfCnpj', $cpfCnpj)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByEmail(string $email): ?User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}