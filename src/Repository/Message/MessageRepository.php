<?php

namespace App\Repository\Message;

use App\Entity\Message\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function findLastMessage($thread_id)
    {
        try {
            return $this->createQueryBuilder('m')
                ->andWhere('m.thread = :thread_id')
                ->orderBy('m.createdAt', 'DESC')
                ->setMaxResults(1)
                ->setParameter('thread_id', $thread_id)
                ->getQuery()
                ->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findOneById($id){
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function countUnreadMessageByUser($user_id,$thread_id)
    {
        $builder = $this->createQueryBuilder('m')
                        ->where('m.thread = :thread_id')
        ;
        return (int) $builder
        ->select($builder->expr()->count('mm.id'))
        ->innerJoin('m.metadata','mm')
        ->andWhere('mm.message = m.id')
        ->andWhere('mm.participant = :user_id')
        ->andWhere('mm.isRead = :isRead')
        ->setParameter('thread_id', $thread_id)
        ->setParameter('user_id', $user_id)
        ->setParameter('isRead', false, \PDO::PARAM_BOOL)
        ->getQuery()
        ->getSingleScalarResult();
    }

    public function findUnreadMessageByUser($user_id,$thread_id)
    {
        $builder = $this->createQueryBuilder('m')
            ->where('m.thread = :thread_id')
        ;
        return  $builder
            ->innerJoin('m.metadata','mm')
            ->andWhere('mm.message = m.id')
            ->andWhere('mm.participant = :user_id')
            ->andWhere('mm.isRead = :isRead')
            ->setParameter('thread_id', $thread_id)
            ->setParameter('user_id', $user_id)
            ->setParameter('isRead', false, \PDO::PARAM_BOOL)
            ->getQuery()
            ->getResult();
    }

    public function findAllUnreadMessage($user_id)
    {
        $builder = $this->createQueryBuilder('m');
        return (int) $builder
            ->select($builder->expr()->count('mm.id'))
            ->innerJoin('m.metadata','mm')
            ->andWhere('mm.message = m.id')
            ->andWhere('mm.participant = :user_id')
            ->andWhere('mm.isRead = :isRead')
            ->setParameter('user_id', $user_id)
            ->setParameter('isRead', false, \PDO::PARAM_BOOL)
            ->getQuery()
            ->getSingleScalarResult();
    }

}
