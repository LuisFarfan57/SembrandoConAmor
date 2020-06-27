<?php

namespace App\Repository;

use App\Entity\Donador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Donador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Donador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Donador[]    findAll()
 * @method Donador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Donador::class);
    }

    // /**
    //  * @return Donador[] Returns an array of Donador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Donador
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
