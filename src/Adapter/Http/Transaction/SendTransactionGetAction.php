<?php

namespace App\Adapter\Http\Transaction;

use App\Domain\Service\TransactionService;
use App\Domain\ValueObject\TransactionVO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

class SendTransactionGetAction
{
    public function __construct(private readonly TransactionService $transactionService)
    {
    }

    #[Route('/transaction/send', name: 'transaction_send', methods: ['POST'])]
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
        $this->transactionService->createTransaction(1, 2, 100);

        return new JsonResponse("Transação realizada com sucesso!!", Response::HTTP_OK);
    }
}