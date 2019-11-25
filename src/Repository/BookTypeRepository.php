<?php

namespace App\Repository;

use App\Entity\BookType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookType[]    findAll()
 * @method BookType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookType::class);
    }

    // /**
    //  * @return BookType[] Returns an array of BookType objects
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
    public function findOneBySomeField($value): ?BookType
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
