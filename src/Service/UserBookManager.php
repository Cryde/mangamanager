<?php

namespace App\Service;

use App\Builder\UserBookDirector;
use App\Entity\Book;
use App\Entity\User;
use App\Entity\UserBook;
use App\Repository\UserBookRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserBookManager
{
    /**
     * @var UserBookRepository
     */
    private $userBookRepository;
    /**
     * @var UserBookDirector
     */
    private $userBookDirector;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(
        UserBookRepository $userBookRepository,
        UserBookDirector $userBookDirector,
        EntityManagerInterface $entityManager
    ) {
        $this->userBookRepository = $userBookRepository;
        $this->userBookDirector = $userBookDirector;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @param Book $book
     *
     * @return UserBook
     */
    public function addByUser(User $user, Book $book): UserBook
    {
        /** @var UserBook $userBook */
        if (!$userBook = $this->userBookRepository->findOneBy(['user' => $user, 'book' => $book])) {
            $userBook = $this->userBookDirector->create($user, $book);
            $this->entityManager->persist($userBook);
            $this->entityManager->flush();
        }

        return $userBook;
    }

    public function removeByUser(User $user, Book $book)
    {
        /** @var UserBook $userBook */
        if (!$userBook = $this->userBookRepository->findOneBy(['user' => $user, 'book' => $book])) {
            throw new \InvalidArgumentException('Ce manga n\'existe pas dans votre collection');
        }

        $this->entityManager->remove($userBook);
        $this->entityManager->flush();
    }
}
