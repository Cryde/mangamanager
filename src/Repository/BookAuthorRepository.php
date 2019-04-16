<?php

namespace App\Repository;

use App\Entity\BookAuthor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookAuthor|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookAuthor|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookAuthor[]    findAll()
 * @method BookAuthor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookAuthorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookAuthor::class);
    }

    // /**
    //  * @return BookAuthor[] Returns an array of BookAuthor objects
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
    public function findOneBySomeField($value): ?BookAuthor
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
