<?php

namespace App\Repository;

use App\Entity\Tome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tome|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tome|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tome[]    findAll()
 * @method Tome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TomeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tome::class);
    }

    // /**
    //  * @return Tome[] Returns an array of Tome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tome
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
