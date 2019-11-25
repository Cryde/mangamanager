<?php

namespace App\Repository;

use App\Entity\BookStatus;
use App\Entity\User;
use App\Entity\UserBook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserBook|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBook|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBook[]    findAll()
 * @method UserBook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBook::class);
    }

    /**
     * @param User $user
     * @param      $excludedBooks
     *
     * @return mixed
     */
    public function findInProgressByUserAndExcluded(User $user, $excludedBooks)
    {
        $qb = $this->createQueryBuilder('user_book')
            ->select('user_book, book')
            ->join('user_book.book', 'book')
            ->andWhere('user_book.readTomeNumber <= book.tomeNumber')
            ->andWhere('user_book.user = :user')
            ->setParameter('user', $user);

        if ($excludedBooks) {
            $qb->andWhere('user_book not in (:excluded)')->setParameter('excluded', $excludedBooks);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param User       $user
     * @param BookStatus $bookStatus
     *
     * @return mixed
     */
    public function findAllReadAndEndedBookByUser(User $user, BookStatus $bookStatus)
    {
        return $this->createQueryBuilder('user_book')
            ->select('user_book, book')
            ->join('user_book.book', 'book')
            ->where('book.status = :status')
            ->andWhere('user_book.readTomeNumber = book.tomeNumber')
            ->andWhere('user_book.user = :user')
            ->setParameter('status', $bookStatus)
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }
}
