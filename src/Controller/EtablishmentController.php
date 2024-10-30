<?php

namespace App\Controller;

use App\Entity\Etablishments;
use App\Repository\EtablishmentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etablishment')]
class EtablishmentController extends AbstractController
{
    #[Route('/', name: 'etablishment_home')]
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

    #[Route('/{name}/{id<\d+>}', name: 'etablishment_show')]
    public function show(
        Etablishments $etablishment
    ){
        return $this->render('etablishment/show.html.twig', [
            'page' => 'etablishment',
            'etablishment' => $etablishment
        ]);
    }
}
