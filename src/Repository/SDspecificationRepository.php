<?php

namespace App\Repository;

use App\Entity\SDspecification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SDspecification|null find($id, $lockMode = null, $lockVersion = null)
 * @method SDspecification|null findOneBy(array $criteria, array $orderBy = null)
 * @method SDspecification[]    findAll()
 * @method SDspecification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SDspecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SDspecification::class);
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
