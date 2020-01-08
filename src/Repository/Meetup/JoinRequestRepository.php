<?php


namespace App\Repository\Meetup;

use App\Entity\Meetup\JoinRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method JoinRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoinRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoinRequest[]    findAll()
 * @method JoinRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class JoinRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoinRequest::class);
    }

    // /**
    //  * @return Comment[] Returns an array of Comment objects
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
    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}