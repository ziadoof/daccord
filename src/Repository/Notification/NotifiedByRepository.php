<?php

namespace App\Repository\Notification;

use App\Entity\Notification\NotifiedBy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NotifiedBy|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotifiedBy|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotifiedBy[]    findAll()
 * @method NotifiedBy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotifiedByRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotifiedBy::class);
    }


    public function findByReceiver($id)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.receiver = :id')
            ->setParameter('id', $id)
            ->orderBy('n.date','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
}
