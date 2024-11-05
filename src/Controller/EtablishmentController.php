<?php

namespace App\Controller;

use App\Entity\Etablishments;
use App\Repository\EtablishmentsRepository;
use App\Repository\FilieresRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/etablishment')]
class EtablishmentController extends AbstractController
{
    #[Route('/', name: 'etablishment_home')]
    public function index(
        EtablishmentsRepository $er,
        FilieresRepository $fr,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $filterByFiliere = $request->query->get('filiere');
        $filiere = null;

        $filters = [];

        if($filterByFiliere){
            $filiere = $fr->findOneBy(['id' => $filterByFiliere]);
            if(null == $filiere){
                throw new NotFoundHttpException();
            }
            $etablishments = $er->queryAllByFiliere($filiere);
            $filters['filiere'] = $filiere->getFiliere();
        }else{
            $etablishments = $er->queryAll();
        }

        $etablishments = $paginator->paginate(
            $etablishments,
            $request->query->getInt('page', 1),
            12
        );
        dump($etablishments);
        
        return $this->render('etablishment/index.html.twig', [
            'page' => 'etablishment',
            'etablishments' => $etablishments,
            'filieres' => $fr->findAll(),
            'filiere_selected' => $filiere,
            'filters' => $filters
        ]);
    }
}
