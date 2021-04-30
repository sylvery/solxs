<?php

namespace App\Repository;

use App\Entity\DesignCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DesignCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DesignCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DesignCategory[]    findAll()
 * @method DesignCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesignCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DesignCategory::class);
    }

    // /**
    //  * @return DesignCategory[] Returns an array of DesignCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DesignCategory
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
