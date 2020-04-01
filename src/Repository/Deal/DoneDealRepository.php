<?php

namespace App\Repository\Deal;

use App\Entity\Deal\DoneDeal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DoneDeal|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoneDeal|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoneDeal[]    findAll()
 * @method DoneDeal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoneDealRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoneDeal::class);
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

    public function findByUser($user)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.offerUser = :user')
            ->orWhere('d.demandUser = :user')
            ->setParameter('user', $user)
            ->orderBy('d.date', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function doneDealCount()
    {
        return $this->createQueryBuilder('d')
            ->select('COUNT(d)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
