<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Repository\EtablishmentsRepository;
use App\Repository\FilieresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        EtablishmentsRepository $er,
        FilieresRepository $fr
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'page' => 'home',
            'etablishments' => $er->findBy([], [], 4),
            'provinces' => Adresses::$provinces
        ]);
    }
}
