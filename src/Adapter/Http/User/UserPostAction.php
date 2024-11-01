<?php

namespace App\Adapter\Http\User;

use App\Domain\Service\UserService;
use App\Domain\ValueObject\UserVO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;


class UserPostAction
{
    public function __construct(
        private readonly UserService $userService,
    ){
    }

    #[Route('/api/user/post', name: 'user_post', methods: ['POST'])]
    #[OA\POST(
        summary: 'Post a User',
        requestBody: new OA\RequestBody(
            description: 'User data',
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'email', type: 'string'),
                    new OA\Property(property: 'password', type: 'string'),
                    new OA\Property(property: 'cpfCnpj', type: 'string'),
                    new OA\Property(property: 'userType', type: 'integer')
                ],
                type: 'object'
            )
        ),
        responses: [
            new OA\Response(
                response: Response::HTTP_NO_CONTENT,
                description: 'success',
            ),
            new OA\Response(
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
                description: 'Erro inesperado',
            ),
        ]
    )]
    public function __invoke(#[MapRequestPayload(acceptFormat: "json")] UserVO $userVO): JsonResponse
    {
        $this->userService->insertUser($userVO);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}