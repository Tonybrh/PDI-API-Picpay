<?php

namespace App\Adapter\Http\User;

use App\Domain\Service\UserService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UsersGetAction
{

    public function __construct(
        private readonly UserService $userService
    ){

    }
    #[Route('/users', name: 'users_get', methods: ['GET'])]
    #[OA\Post(
        summary: 'Get Users',
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'success',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'users', type: 'array')
                    ],
                    type: 'object'
                )
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Erro inesperado',
            ),
        ]
    )]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->userService->findUsers());
    }
}