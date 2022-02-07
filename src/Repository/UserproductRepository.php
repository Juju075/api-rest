<?php

namespace App\Repository;

use App\Entity\Userproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Userproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Userproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Userproduct[]    findAll()
 * @method Userproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Userproduct::class);
    }




    // /**
    //  * @return Userproduct[] Returns an array of Userproduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Userproduct
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
