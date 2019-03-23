<?php

namespace App\Repository;

use App\Entity\Ad;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ad[]    findAll()
 * @method Ad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ad::class);
    }

     /**
      * @return Ad[] Returns an array of Ad objects
      */

    public function findByArea($min_x,$max_x,$min_y,$max_y)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.user','u')
            ->andWhere('a.user = u.id')
            ->andWhere('u.mapX < :max_x')
            ->andWhere('u.mapX > :min_x')
            ->andWhere('u.mapY < :max_y')
            ->andWhere('u.mapY > :min_y')
            ->setParameter('max_x', $max_x)
            ->setParameter('min_x', $min_x)
            ->setParameter('max_y', $max_y)
            ->setParameter('min_y', $min_y)
            ->orderBy('a.dateOfAd', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Ad
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
