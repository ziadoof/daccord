<?php

namespace App\Repository\Meetup;

use App\Entity\Meetup\Meetup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Meetup|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meetup|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meetup[]    findAll()
 * @method Meetup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeetupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meetup::class);
    }

    // /**
    //  * @return Meetup[] Returns an array of Meetup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meetup
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findMeetupJoinByUser($user_id)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.participants','pu')
            ->andwhere('pu.id = :userId')
            ->setParameter('userId', $user_id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMeetupNearMe(float $maxLat, float $minLat, float $maxLng, float $minLng)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.city','mc')
            ->andwhere('mc.gpsLat <= :maxLat')
            ->andwhere('mc.gpsLat >= :minLat')
            ->andwhere('mc.gpsLng <= :maxLng')
            ->andwhere('mc.gpsLng >= :minLng')
            ->setParameter('maxLat', $maxLat)
            ->setParameter('minLat', $minLat)
            ->setParameter('maxLng', $maxLng)
            ->setParameter('minLng', $minLng)
            ->orderBy('m.startAt','ASC')
            ->getQuery()
            ->getResult()
            ;
    }
}
