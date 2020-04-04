<?php


namespace App\Repository\Rating;

use App\Entity\Rating\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class RatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }

    public function findByTypeAndCandidate($type,$candidate_id)
    {
        return $this->createQueryBuilder('r')
            ->Where('r.type = :type')
            ->andWhere('r.candidate = :candidate_id')
            ->setParameter('type', $type)
            ->setParameter('candidate_id', $candidate_id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByTypeAndMeetup($type, $meetup_id)
    {
        return $this->createQueryBuilder('r')
            ->Where('r.type = :type')
            ->andWhere('r.meetup = :meetup_id')
            ->setParameter('type', $type)
            ->setParameter('meetup_id', $meetup_id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByUser(?int $id)
    {
        return $this->createQueryBuilder('r')
            ->Where('r.candidateId = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
            ;
    }

}