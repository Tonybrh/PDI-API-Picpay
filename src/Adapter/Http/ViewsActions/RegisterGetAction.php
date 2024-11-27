<?php

namespace App\Adapter\Http\ViewsActions;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterGetAction extends AbstractController
{
    #[Route('/register', name: 'register', methods: ['GET'])]
    public function __invoke(): Response
    {
        return $this->render('views/register.html.twig');
    }
}