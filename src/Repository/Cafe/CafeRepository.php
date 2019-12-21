<?php

namespace App\Repository\Cafe;

use App\Entity\Cafe\Cafe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cafe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cafe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cafe[]    findAll()
 * @method Cafe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CafeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cafe::class);
    }

    // /**
    //  * @return Cafe[] Returns an array of Cafe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cafe
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findActiveByUser($id)
    {
        return $this->createQueryBuilder('c')
            ->Where('c.createdBy = :id')
            ->andWhere('c.active = :online')
            ->setParameter('id', $id)
            ->setParameter('online', true)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findAreaCafe($id, $lat, $lng)
    {
        $minLat = $lat-0.012626;
        $maxLat = $lat+0.012626;
        $minLng = $lng-0.012626;
        $maxLng = $lng+0.012626;
        return $this->createQueryBuilder('c')
            ->Where('c.createdBy != :id')
            ->andWhere('c.gpsLat <= :maxLat')
            ->andWhere('c.gpsLat >= :minLat')
            ->andWhere('c.gpsLng <= :maxLng')
            ->andWhere('c.gpsLng >= :minLng')
            ->andWhere('c.active >= :active')
            ->setParameter('id', $id)
            ->setParameter('maxLat', $maxLat)
            ->setParameter('minLat', $minLat)
            ->setParameter('maxLng', $maxLng)
            ->setParameter('minLng', $minLng)
            ->setParameter('active', true)
            ->orderBy('c.expireAt', 'ASC')
            ->setMaxResults(40)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneById(int $id)
    {
        return $this->createQueryBuilder('c')
            ->Where('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findOneByUid($uid)
    {
        return $this->createQueryBuilder('c')
            ->Where('c.uid = :uid')
            ->setParameter('uid', $uid)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
