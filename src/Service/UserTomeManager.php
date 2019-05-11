<?php

namespace App\Service;

use App\Builder\UserTomeDirector;
use App\Entity\Book;
use App\Entity\Tome;
use App\Entity\User;
use App\Entity\UserTome;
use App\Repository\UserTomeRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserTomeManager
{
    /**
     * @var UserTomeRepository
     */
    private $userTomeRepository;
    /**
     * @var UserTomeDirector
     */
    private $userTomeDirector;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var UserBookManager
     */
    private $userBookManager;

    public function __construct(
        UserTomeRepository $userTomeRepository,
        UserTomeDirector $userTomeDirector,
        EntityManagerInterface $entityManager,
        UserBookManager $userBookManager
    ) {
        $this->userTomeRepository = $userTomeRepository;
        $this->userTomeDirector = $userTomeDirector;
        $this->entityManager = $entityManager;
        $this->userBookManager = $userBookManager;
    }

    /**
     * @param User $user
     * @param Tome $tome
     *
     * @return UserTome
     */
    public function addByUser(User $user, Tome $tome): UserTome
    {
        /** @var UserTome $userTome */
        if ($userTome = $this->userTomeRepository->findOneBy(['user' => $user, 'tome' => $tome])) {
            return $userTome;
        }

        $userBook = $this->userBookManager->addByUser($user, $tome->getBook());

        $userBook->setReadTomeNumber($this->countReadTomeByBook($user, $tome->getBook()) + 1);

        $userTome = $this->userTomeDirector->create($user, $tome, $tome->getBook());
        $this->entityManager->persist($userTome);
        $this->entityManager->flush();

        return $userTome;
    }

    private function countReadTomeByBook(User $user, Book $book)
    {
        return count($this->userTomeRepository->findBy(['user' => $user, 'book' => $book]));
    }
}
