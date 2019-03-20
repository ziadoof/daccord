<?php

namespace App\Repository;

use App\Entity\Dspecification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dspecification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dspecification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dspecification[]    findAll()
 * @method Dspecification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DspecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dspecification::class);
    }

    // /**
    //  * @return Dspecification[] Returns an array of Dspecification objects
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
    public function findOneBySomeField($value): ?Dspecification
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
