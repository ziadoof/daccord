<?php

namespace App\Repository\Ads;

use App\Entity\Ads\Specification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Specification|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specification|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specification[]    findAll()
 * @method Specification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Specification::class);
    }


    public function findCategoryById($id): ?Specification
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCategoryByType($type): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.type = :type')
            ->setParameter('type', $type)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
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
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findUniqueNames(): array
    {
        $names = $this->createQueryBuilder('s')
            ->select('MIN(s.name)')
            ->groupBy('s.name')
            ->getQuery()
            ->getResult()
        ;
        $list = [];
        foreach ($names as $name){
            $list[$name[1]] = $name[1];
        }

        return $list;
    }

    public function findUniqueTypes()
    {
        $names = $this->createQueryBuilder('s')
            ->select('MIN(s.type)')
            ->groupBy('s.type')
            ->getQuery()
            ->getResult()
        ;
        $list = [];
        foreach ($names as $name){
            $list[$name[1]] = $name[1];
        }

        return $list;
    }

    public function findUniqueTypeOfChoice()
    {
        $names = $this->createQueryBuilder('s')
            ->select('MIN(s.typeOfChoice)')
            ->where('s.typeOfChoice is not NULL')
            ->groupBy('s.typeOfChoice')
            ->getQuery()
            ->getResult()
        ;
        $list = [];
        foreach ($names as $name){
            $list[$name[1]] = $name[1];
        }
        return $list;
    }
}
