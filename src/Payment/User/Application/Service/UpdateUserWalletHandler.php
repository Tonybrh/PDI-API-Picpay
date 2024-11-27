<?php

namespace App\Payment\User\Application\Service;

use App\Payment\Transaction\Domain\Builder\WalletBuilderInterface;
use App\Payment\Transaction\Domain\Repository\WalletRepositoryInterface;
use App\Payment\Transaction\Domain\ValueObject\WalletVO;
use App\Payment\User\Domain\Exception\UserNotFoundException;
use App\Payment\User\Domain\Repository\UserRepositoryInterface;

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
        } else {
            $wallet->setBalance($walletVO->getBalance());
        }

        $user->setWallet($wallet);

        $this->userRepositoryInterface->save($user);
        $this->walletRepositoryInterface->save($wallet);
    }
}