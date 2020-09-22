<?php

namespace App\Repository;

use App\Entity\Visit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Visit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visit[]    findAll()
 * @method Visit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    public function allVisitCount()
    {
        return $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function monthVisitCount($date)
    {
        $from = new \DateTime($date->format("Y-m")."-1 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");
        return $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function allMonthVisitCount($date)
    {
        $from = new \DateTime($date->format("Y-m")."-1 00:00:00");
        $to   = new \DateTime($date->format("Y-m")."-31 23:59:59");
        return $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function dayVisitCount($date)
    {
        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");
        return $this->createQueryBuilder('v')
            ->select('COUNT(v)')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllByDay($date)
    {
        $from = new \DateTime($date->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");

        return $this->createQueryBuilder('v')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByIpToday($ip)
    {
        $today = new \DateTime('now');
        $from = new \DateTime($today->format("Y-m-d")." 00:00:00");
        $to   = new \DateTime($today->format("Y-m-d")." 23:59:59");
        return $this->createQueryBuilder('v')
            ->where('v.ip = :ip')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('ip',$ip)
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMonthVisits($date)
    {
        $from = new \DateTime($date->format("Y-m")."-1 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");

        return $this->createQueryBuilder('v')
            ->andWhere('v.date BETWEEN :from AND :to')
            ->setParameter('from', $from )
            ->setParameter('to', $to)
            ->orderBy('v.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findFirstVisits()
    {
        try {
            return $this->createQueryBuilder('v')
                ->orderBy('v.id', 'ASC')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
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
    /*public function findAdByUser($id,$object)
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
    }*/

}
