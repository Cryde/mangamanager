<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function searchLike(string $title, $limit = 8)
    {
        return $this->createQueryBuilder('book')
            ->where('book.title LIKE :title')
            ->andWhere('book.coverPath is not null')
            ->setParameter('title', '%' . $title . '%')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $limit
     *
     * @return mixed
     */
    public function getRandom($limit = 4)
    {
        return $this->createQueryBuilder('book')
            ->where('book.coverPath is not null')
            ->addOrderBy('RAND()')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
