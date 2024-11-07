<?php

namespace App\Controller;

use App\Entity\Adresses;
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
        $filterByProvince = $request->query->get('province');
        $filiere = null;
        $query = $er->queryAll();
        $filters = [];

        //filtre par filiere
        if($filterByFiliere){
            $filiere = $fr->findOneBy(['id' => $filterByFiliere]);
            if(null == $filiere){
                throw new NotFoundHttpException();
            }
            $query = $query->where('d.filiere = :filiere')->setParameter('filiere', $filterByFiliere);
            $filters['filiere'] = $filiere->getFiliere();
        }

        //filtre par provinces
        if($filterByProvince){
            $query = $query->join('\App\Entity\Adresses', 'a', 'WITH', 'a.etablishment = e.id')
                ->andWhere('a.province = :province')
                ->setParameter('province', $filterByProvince);
            $filters['province'] = $filterByProvince;
        }

        $etablishments = $paginator->paginate(
            $query->getQuery(),
            $request->query->getInt('page', 1),
            12
        );
        
        return $this->render('etablishment/index.html.twig', [
            'page' => 'etablishment',
            'etablishments' => $etablishments,
            'filieres' => $fr->findAll(),
            'filiere_selected' => $filiere,
            'provinces' => Adresses::$provinces,
            'filters' => $filters
        ]);
    }
}
