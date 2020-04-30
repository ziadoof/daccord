<?php

namespace App\Repository\Ads;

use App\Entity\Ads\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }


    public function findCategoryById($id): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findCategoryByParentId($id): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.parent = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult()
            ;
    }

    public function findCategoryByParent($id): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.parent = :id')
            ->setParameter('id', $id)
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCategoryByName($name, $type, $parentName): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->andWhere('c.type = :type')
            ->innerJoin('c.parent','p')
            ->andWhere('p.name = :parentName')
            ->setParameter('name', $name)
            ->setParameter('type', $type)
            ->setParameter('parentName', $parentName)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

    public function findParentCategoryByName($name, $type): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->andWhere('c.type = :type')
            ->andWhere('c.parent is NULL')
            ->setParameter('name', $name)
            ->setParameter('type', $type)
            ->getQuery()
            ->getOneOrNullResult()
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

    public function categoryCount(string $type =null)
    {
        if($type === null){
            return $this->createQueryBuilder('c')
                ->select('COUNT(c)')
                ->where('c.parent is NULL')
                ->getQuery()
                ->getSingleScalarResult();
        }
        return $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->where('c.parent is not NULL')
            ->getQuery()
            ->getSingleScalarResult();


    }

    public function findAllOfferCategory()
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.type = :type')
            ->setParameter('type', 'Offer')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCategoryRelated(Category $category)
    {
        if($category->getParent() === null){
            return $this->createQueryBuilder('c')
                ->Where('c.name = :name')
                ->andWhere('c.parent is NULL')
                ->setParameter('name', $category->getName())
                ->getQuery()
                ->getResult()
                ;
        }
        return $this->createQueryBuilder('c')
            ->Where('c.name = :name')
            ->innerJoin('c.parent','p')
            ->andWhere('p.name = :parentName')
            ->setParameter('name', $category->getName())
            ->setParameter('parentName', $category->getParent()->getName())
            ->getQuery()
            ->getResult()
            ;
    }
}
