<?php

namespace App\Repository;

use App\Entity\UserTome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserTome|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTome|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTome[]    findAll()
 * @method UserTome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTome::class);
    }

    // /**
    //  * @return UserTome[] Returns an array of UserTome objects
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
    public function findOneBySomeField($value): ?UserTome
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
