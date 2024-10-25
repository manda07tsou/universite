<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WebpackController extends AbstractController
{
    #[Route('/webpack', name: 'app_webpack')]
    public function index(): Response
    {
        return $this->render('webpack/index.html.twig', [
            'controller_name' => 'WebpackController',
        ]);
    }
}
