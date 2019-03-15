<?php

namespace App\Repository;

use App\Entity\Ospecification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ospecification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ospecification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ospecification[]    findAll()
 * @method Ospecification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OspecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ospecification::class);
    }

    // /**
    //  * @return Ospecification[] Returns an array of Ospecification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ospecification
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
