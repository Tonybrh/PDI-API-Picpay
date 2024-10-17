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
use App\Infrastructure\Repository\WalletRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class UserService
{
    public function __construct(
        private  UserRepository $userRepository,
        private  UserBuilder $userBuilder,
        private  UserTypeRepository $userTypeRepository,
        private  WalletBuilder $walletBuilder,
        private WalletRepository $walletRepository
    ) {
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
        $this->userRepository->insertUpdate($user);
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

        $this->userRepository->insertUpdate($user);
        $this->walletRepository->persist($wallet);
        $this->walletRepository->flush();
    }
}