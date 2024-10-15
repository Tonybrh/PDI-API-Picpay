<?php

namespace App\Domain\Service;

use App\Domain\Exceptions\User\UserAlreadyExistsException;
use App\Domain\Exceptions\User\UserNotFoundException;
use App\Domain\ValueObject\UserVO;
use App\Domain\ValueObject\WalletVO;
use App\Infrastructure\Builder\UserBuilder;
use App\Infrastructure\Builder\WalletBuilder;
use App\Infrastructure\Repository\UserRepository;
use App\Infrastructure\Repository\UserTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserRepository $userRepository,
        private readonly UserBuilder $userBuilder,
        private readonly UserTypeRepository $userTypeRepository,
        private readonly WalletBuilder $walletBuilder
    ){
    }

    public function findUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function insertUser(UserVO $userVO): void
    {

        if (
            $this->userRepository->findByCpfCnpj($userVO->getCpfCnpj())
            || $this->userRepository->findByEmail($userVO->getEmail())
        ) {
            throw new UserAlreadyExistsException();
        }

        $userType = $this->userTypeRepository->find($userVO->getUserType());
        $user = $this->userBuilder->build($userVO, $userType);
        $this->userRepository->insertUser($user);
    }

    public function updateUserWallet(WalletVO $walletVO): void
    {
        $user = $this->userRepository->find($walletVO->getUserId());

        if (!$user) {
            throw new UserNotFoundException();
        }

        $wallet = $user->getWallet();

        if (!$wallet) {
            $wallet = $this->walletBuilder->build($walletVO, $user);
        } else {
            $wallet->setBalance($walletVO->getBalance());
        }

        $user->setWallet($wallet);

        $this->entityManager->persist($user);
        $this->entityManager->persist($wallet);
        $this->entityManager->flush();
    }
}