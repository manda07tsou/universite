<?php

namespace App\Repository;

use App\Entity\Etablishments;
use App\Entity\Filieres;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Etablishments>
 */
class EtablishmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etablishments::class);
    }


    public function findByFiliere(Filieres $filiere){
        return $this->createQueryBuilder('e')
            ->join('\App\Entity\Formations', 'f', 'WITH', 'f.etablishment = e.id')
            ->join('\App\Entity\Departments','d', 'WITH', 'd.formation = f.id')
            ->where('d.filiere = :filiere')
            ->setParameter('filiere', $filiere->getId())
            ->getQuery()
            ->getResult();
    }
}
