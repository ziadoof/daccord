<?php

namespace App\Repository\Location;

use App\Entity\Location\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

    // /**
    //  * @return City[] Returns an array of City objects
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


    public function findOneByName($value): ?City
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $city
     *
     * @return array
     */
    public function findLike(String $city): ?array
    {
         return $this
          ->createQueryBuilder('c')
            ->where('c.name LIKE :city')
            ->orWhere('c.zipCode LIKE :city')
            ->setParameter( 'city', "%$city%")
            ->orderBy('c.name')
            ->setMaxResults(25)
            ->getQuery()
            ->execute()
            ;
    }

    /**
     * @param string $city
     *
     * @return array
     */
    public function findOneLike(String $city): ?array
    {

        $one =$this->createQueryBuilder('c')
            ->select ('MIN(c.id)')
            ->andWhere('c.name LIKE :city')
            ->setParameter( 'city', "%$city%")
            ->groupBy('c.name')
            ->orderBy('c.name')
            ->setMaxResults(15)
            ->getQuery()
            ->execute()
        ;
        return $this->createQueryBuilder('c')
            ->where('c.id IN (:one)')
            ->setParameter( 'one', $one)
            ->orderBy('c.name')
            ->setMaxResults(15)
            ->getQuery()
            ->execute();
    }

    public function findById($id)
    {
        return $this
            ->createQueryBuilder('c')
            ->select('c')
            ->where('c = :id')
            ->setParameter('id',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
