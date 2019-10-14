<?php

namespace App\Repository;

use App\Entity\Driver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Driver|null find($id, $lockMode = null, $lockVersion = null)
 * @method Driver|null findOneBy(array $criteria, array $orderBy = null)
 * @method Driver[]    findAll()
 * @method Driver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Driver::class);
    }

    /**
     * @param $latOffer
     * @param $lngOffer
     * @param $latDemand
     * @param $lngDemand
     * @param $offerUser
     * @param $demandUser
     * @return Driver[] Returns an array of Driver objects
     */
    public function findByArea($latOffer, $lngOffer, $latDemand, $lngDemand, $offerUser, $demandUser): array
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.gpsLat + 0.012626 * d.maxDistance > :latOffer')
            ->andWhere('d.gpsLat + 0.012626 * d.maxDistance > :latDemand')
            ->andWhere('d.gpsLat - 0.012626 * d.maxDistance < :latOffer')
            ->andWhere('d.gpsLat - 0.012626 * d.maxDistance < :latDemand')
            ->andWhere('d.gpsLng + 0.012626 * d.maxDistance > :lngOffer')
            ->andWhere('d.gpsLng + 0.012626 * d.maxDistance > :lngDemand')
            ->andWhere('d.gpsLng - 0.012626 * d.maxDistance < :lngOffer')
            ->andWhere('d.gpsLng - 0.012626 * d.maxDistance < :lngDemand')
            ->andWhere('d.active = :true')
            ->andWhere('d.user != :offerUser')
            ->andWhere('d.user != :demandUser')
            ->setParameter('latOffer', $latOffer)
            ->setParameter('latDemand', $latDemand)
            ->setParameter('lngOffer', $lngOffer)
            ->setParameter('lngDemand', $lngDemand)
            ->setParameter('offerUser', $offerUser)
            ->setParameter('demandUser', $demandUser)
           /* ->setParameter('km', $km)*/
            ->setParameter('true', true)
            ->orderBy('d.point', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneById($id): ?Driver
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
