<?php

namespace App\Repository\Hosting;

use App\Entity\Hosting\Hosting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Hosting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hosting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hosting[]    findAll()
 * @method Hosting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HostingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hosting::class);
    }

    // /**
    //  * @return Hosting[] Returns an array of Hosting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hosting
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneById($hostingId)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.id = :id')
            ->setParameter('id', $hostingId)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function hostingCount()
    {
        return $this->createQueryBuilder('h')
            ->select('COUNT(h)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
