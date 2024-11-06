<?php

namespace App\Controller;

use App\Entity\Etablishments;
use App\Repository\ContactsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/{id<\d+>}', name: 'profil_index')]
    public function index(
        Etablishments $etablishment,
        ContactsRepository $cr
    ): Response
    {
        $contact = $cr->findOneBy(['etablishment' => $etablishment->getId()]);

        return $this->render('profil/index.html.twig', [
            'page' => 'etablishment',
            'etablishment' => $etablishment,
            'contact' => $contact
        ]);
    }

    #[Route('/formation/{id<\d+>}', name:'profil_show_formation')]
    public function show_formation(
        Etablishments $etablishment
    ){

        return $this->render('profil/formations.html.twig',[
            'page' => 'etablishment',
            'etablishment' => $etablishment
        ]);
    }

    #[Route('/coordonner/{id<\d+>}', name: 'profil_show_coordinate')]
    public function show_coordinate(
        Etablishments $etablishment,
        ContactsRepository $cr
    ){

        return $this->render('profil/coordinate.html.twig', [
            'page' => 'etablishment',
            'etablishment' => $etablishment,
            'contact' => $cr->findOneBy(['etablishment' => $etablishment->getId()])
        ]);
    }
}
