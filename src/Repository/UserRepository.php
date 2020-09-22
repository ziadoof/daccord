<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return User $user
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneById($id): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    ///**
     //* @return User[] Returns an array of User objects
     //*/

    /*public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }*/
    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function userCount()
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function activeUserCount()
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.enabled = TRUE')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function inactiveUserCount()
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where('u.enabled = FALSE')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findUserData()
    {
        return $this->createQueryBuilder('u')
            ->select('u.mapX','u.mapY', 'u.firstname', 'u.lastname','u.id','u.ville','u.lastLogin','u.lastActivityAt','u.enabled','u.profileImage')
            ->where('u.deleted = FALSE')
            ->getQuery()
            ->getResult();
    }
}
