<?php

namespace App\Repository;

use App\Entity\UserBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBook[]    findAll()
 * @method UserBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserBook::class);
    }

    // /**
    //  * @return UserBook[] Returns an array of UserBook objects
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
    public function findOneBySomeField($value): ?UserBook
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
