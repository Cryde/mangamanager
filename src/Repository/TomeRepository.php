<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Tome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tome|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tome|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tome[]    findAll()
 * @method Tome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tome::class);
    }

    /**
     * @param Book $book
     * @param int  $tomeNumber
     *
     * @return mixed
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getNextTome(Book $book, int $tomeNumber)
    {
        return $this->createQueryBuilder('tome')
            ->where('tome.coverPath is not null')
            ->andWhere('tome.number = :tomeNumber')
            ->andWhere('tome.book = :book')
            ->setParameter('tomeNumber', $tomeNumber + 1)
            ->setParameter('book', $book)
            ->getQuery()
            ->getSingleResult();
    }
}
