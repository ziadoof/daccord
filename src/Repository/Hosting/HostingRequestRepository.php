<?php

namespace App\Repository\Hosting;

use App\Entity\Hosting\HostingRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HostingRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method HostingRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method HostingRequest[]    findAll()
 * @method HostingRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HostingRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HostingRequest::class);
    }

    // /**
    //  * @return HostingRequest[] Returns an array of HostingRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HostingRequest
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findBySender($id)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.sender = :id')
            ->setParameter('id', $id)
            ->orderBy('h.lastUpdate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByHostingNotRegected($id)
    {
        return $this->createQueryBuilder('h')
            ->where('h.hosting = :id')
            ->andWhere('h.treatment != :rejected')
            ->setParameter('id', $id)
            ->setParameter('rejected', 'rejected')
            ->orderBy('h.lastUpdate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function doneHostingCount()
    {
        return $this->createQueryBuilder('h')
            ->select('COUNT(h)')
            ->where('h.hostingStatus = TRUE')
            ->andWhere('h.senderStatus = TRUE')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function noDonsHostingCount()
    {
        return $this->createQueryBuilder('h')
            ->select('COUNT(h)')
            ->where('h.hostingStatus = FALSE')
            ->orWhere('h.senderStatus = FALSE')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
