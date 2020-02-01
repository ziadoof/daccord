<?php

namespace App\Repository\Carpool;

use App\Entity\Carpool\VoyageRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method VoyageRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoyageRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoyageRequest[]    findAll()
 * @method VoyageRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoyageRequest::class);
    }

    // /**
    //  * @return VoyageRequest[] Returns an array of VoyageRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoyageRequest
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
