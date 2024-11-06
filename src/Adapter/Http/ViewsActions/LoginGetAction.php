<?php

namespace App\Adapter\Http\ViewsActions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginGetAction extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('views/login.html.twig');
    }
}