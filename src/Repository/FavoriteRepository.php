<?php

namespace App\Repository;

use App\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Favorite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favorite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favorite[]    findAll()
 * @method Favorite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorite::class);
    }

    // /**
    //  * @return Favorite[] Returns an array of Favorite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Favorite
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAdByUser($id,$object)
    {
        return $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->andWhere('f.user = :id')
            ->andWhere('f.ad = :ad')
            ->setParameter('id', $id)
            ->setParameter('ad', $object)
            ->setParameter('type', 'ad')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findDealByUser($id, $object)
    {
        return $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->andWhere('f.user = :id')
            ->andWhere('f.deal = :deal')
            ->setParameter('id', $id)
            ->setParameter('deal', $object)
            ->setParameter('type', 'deal')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findHostingByUser($id, $object)
    {
        return $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->andWhere('f.user = :id')
            ->andWhere('f.hosting = :hosting')
            ->setParameter('id', $id)
            ->setParameter('hosting', $object)
            ->setParameter('type', 'hosting')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findMeetupByUser($id, $object)
    {
        return $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->andWhere('f.user = :id')
            ->andWhere('f.meetup = :meetup')
            ->setParameter('id', $id)
            ->setParameter('meetup', $object)
            ->setParameter('type', 'meetup')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findVoyageByUser($id, $object)
    {
        return $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->andWhere('f.user = :id')
            ->andWhere('f.voyage = :voyage')
            ->setParameter('id', $id)
            ->setParameter('voyage', $object)
            ->setParameter('type', 'voyage')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
