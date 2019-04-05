<?php

namespace App\Repository;

use App\Entity\SOspecification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SOspecification|null find($id, $lockMode = null, $lockVersion = null)
 * @method SOspecification|null findOneBy(array $criteria, array $orderBy = null)
 * @method SOspecification[]    findAll()
 * @method SOspecification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SOspecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SOspecification::class);
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
