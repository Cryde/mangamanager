<?php

namespace App\Repository;

use App\Entity\BookStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookStatus[]    findAll()
 * @method BookStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookStatus::class);
    }

    // /**
    //  * @return BookStatus[] Returns an array of BookStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookStatus
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
