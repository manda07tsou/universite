<?php

namespace App\Controller;

use App\Entity\Etablishments;
use App\Repository\ContactsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id<\d+>}', name: 'profil_index')]
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
}
