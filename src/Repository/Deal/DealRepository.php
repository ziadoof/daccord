<?php

namespace App\Repository\Deal;

use App\Entity\Ads\Ad;
use App\Entity\Deal\Deal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Deal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deal[]    findAll()
 * @method Deal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deal::class);
    }

    public function findOneById($id): ?Deal
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function findByDriver($driver)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.driverUser = :driver')
            ->setParameter('driver', $driver)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByOfferDemand(?Ad $offer, ?Ad $demand)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.offer = :offer')
            ->orWhere('d.demand = :demand')
            ->setParameter('offer', $offer)
            ->setParameter('demand', $demand)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByAd(Ad $ad)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.offer = :ad')
            ->orWhere('d.demand = :ad')
            ->setParameter('ad', $ad)
            ->getQuery()
            ->getResult()
            ;
    }

    public function dealCount()
    {
        return $this->createQueryBuilder('d')
            ->select('COUNT(d)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
