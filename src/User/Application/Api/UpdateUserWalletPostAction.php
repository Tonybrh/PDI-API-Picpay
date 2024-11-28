<?php

namespace App\User\Application\Api;

use App\Transaction\Domain\ValueObject\WalletVO;
use App\User\Application\Service\UpdateUserWalletHandler;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

readonly class UpdateUserWalletPostAction
{
    public function __construct(
        private UpdateUserWalletHandler $updateUserWallet,
    ){
    }

    #[Route('/api/user/update-wallet', name: 'user_update_wallet', methods: ['POST'])]
    #[OA\POST(
        summary: 'Post a User',
        requestBody: new OA\RequestBody(
            description: 'User data',
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'userId', type: 'string'),
                    new OA\Property(property: 'balance', type: 'number'),
                ],
                type: 'object'
            )
        ),
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'success',
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Erro inesperado',
            ),
        ]
    )]
    public function __invoke(#[MapRequestPayload(acceptFormat: "json")] WalletVO $walletVO): JsonResponse
    {
        ($this->updateUserWallet)($walletVO);

        return new JsonResponse("Carteira atualizada com sucesso!!", Response::HTTP_OK);
    }
}