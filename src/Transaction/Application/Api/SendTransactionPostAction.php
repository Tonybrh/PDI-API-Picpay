<?php

namespace App\Transaction\Application\Api;

use App\Transaction\Application\Service\CreateHandler;
use App\Transaction\Domain\ValueObject\TransactionVO;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

readonly class SendTransactionPostAction
{
    public function __construct(
        private CreateHandler $createHandler
    ){
    }

    #[Route('/api/transaction/send', name: 'transaction_send', methods: ['POST'])]
    #[OA\POST(
        summary: 'Send a Transaction',
        requestBody: new OA\RequestBody(
            description: 'Transaction data',
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'senderId', type: 'string'),
                    new OA\Property(property: 'receiverId', type: 'string'),
                    new OA\Property(property: 'value', type: 'number'),
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
    public function __invoke(#[MapRequestPayload(acceptFormat: 'json')] TransactionVO $transactionVO): JsonResponse
    {
        ($this->createHandler)($transactionVO);

        return new JsonResponse(["message" => "Transação realizada com sucesso!!"], Response::HTTP_OK);
    }
}