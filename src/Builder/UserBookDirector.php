<?php

namespace App\Builder;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\UserBook;

class UserBookDirector
{
    /**
     * @param User $user
     * @param Book $book
     *
     * @return UserBook
     */
    public function create(User $user, Book $book): UserBook
    {
        return (new UserBook())
            ->setBook($book)
            ->setUser($user);
    }
}
