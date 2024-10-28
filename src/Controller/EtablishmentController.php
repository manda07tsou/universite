<?php

namespace App\Controller;

use App\Repository\EtablishmentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EtablishmentController extends AbstractController
{
    #[Route('/etablishment', name: 'etablishment_home')]
    public function index(
        EtablishmentsRepository $er
    ): Response
    {
        $etabs = $er->findAll();
        return $this->render('etablishment/index.html.twig', [
            'page' => 'etablishment',
            'etablishments' => $etabs
        ]);
    }
}
