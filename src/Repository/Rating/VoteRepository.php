<?php


namespace App\Repository\Rating;

use App\Entity\Rating\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vote::class);
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('v')
            ->Where('v.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findByVoter($userId)
    {
        return $this->createQueryBuilder('v')
            ->Where('v.voter = :id')
            ->andWhere('v.type = :driver')
            ->setParameter('id', $userId)
            ->setParameter('driver', 'driver')
            ->getQuery()
            ->getResult()
            ;
    }

}