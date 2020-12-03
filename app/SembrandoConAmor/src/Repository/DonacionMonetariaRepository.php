<?php

namespace App\Repository;

use App\Entity\DonacionMonetaria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonacionMonetaria|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonacionMonetaria|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonacionMonetaria[]    findAll()
 * @method DonacionMonetaria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonacionMonetariaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonacionMonetaria::class);
    }

    // /**
    //  * @return DonacionMonetaria[] Returns an array of DonacionMonetaria objects
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
    public function findOneBySomeField($value): ?DonacionMonetaria
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getCantidadDonada()
    {
        return $this->createQueryBuilder('donacionMonetaria')
            ->select('SUM(donacionMonetaria.cantidad)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getCantidadBolsas()
    {
        return $this->createQueryBuilder('donacionMonetaria')
            ->select('SUM(donacionMonetaria.cantidadBolsas)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }
}
