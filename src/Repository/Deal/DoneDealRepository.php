<?php

namespace App\Repository\Deal;

use App\Entity\Deal\DoneDeal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DoneDeal|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoneDeal|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoneDeal[]    findAll()
 * @method DoneDeal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoneDealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoneDeal::class);
    }

    // /**
    //  * @return DoneDeal[] Returns an array of DoneDeal objects
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
    public function findOneBySomeField($value): ?DoneDeal
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
