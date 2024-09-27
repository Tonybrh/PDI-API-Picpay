<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function insertUser(array $data): void
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setCpfCnpj($data['cpfCnpj']);
        $user->setUserType($data['userType']);

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
}