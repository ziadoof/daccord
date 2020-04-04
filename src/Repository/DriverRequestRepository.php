<?php

namespace App\Repository;

use App\Entity\DriverRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DriverRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method DriverRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method DriverRequest[]    findAll()
 * @method DriverRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DriverRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DriverRequest::class);
    }

    public function findByDriver($driver)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.driver = :driver')
            ->andWhere('d.status != :rejected')
            ->setParameter('driver', $driver)
            ->setParameter('rejected', 'rejected')
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByUser($user, $deal)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.user = :user')
            ->andWhere('d.deal = :deal')
            ->setParameter('user', $user)
            ->setParameter('deal', $deal)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByDeal($deal)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.deal = :deal')
            ->setParameter('deal', $deal)
            ->getQuery()
            ->getResult()
            ;
    }
}
