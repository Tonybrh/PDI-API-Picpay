<?php

namespace App\User\Application\Service;

use App\Transaction\Domain\Builder\WalletBuilderInterface;
use App\Transaction\Domain\Repository\WalletRepositoryInterface;
use App\Transaction\Domain\ValueObject\WalletVO;
use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Repository\UserRepositoryInterface;

final readonly class UpdateUserWalletHandler
{
    public function __construct(
        private UserRepositoryInterface $userRepositoryInterface,
        private WalletBuilderInterface $walletBuilderInterface,
        private WalletRepositoryInterface $walletRepositoryInterface
    ) {
    }

    public function __invoke(WalletVO $walletVO): void
    {
        $user = $this->userRepositoryInterface->find($walletVO->getUserId());

        if (!$user) {
            throw new UserNotFoundException();
        }

        $wallet = $user->getWallet();

        if (!$wallet) {
            $wallet = $this->walletBuilderInterface->build($walletVO, $user);
        }

        $wallet->setBalance($walletVO->getBalance());

        $user->setWallet($wallet);

        $this->userRepositoryInterface->save($user);
        $this->walletRepositoryInterface->save($wallet);
    }
}