<?php

namespace App\Adapter\Http\System;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class TokenValidateGetAction extends AbstractController
{
    #[Route('/api/token/validate', name:'validate_token', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'valid']);
    }
}