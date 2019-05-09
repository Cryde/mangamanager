<?php

namespace App\Builder;

use App\Entity\Book;
use App\Entity\Tome;
use App\Entity\User;
use App\Entity\UserTome;

class UserTomeDirector
{
    /**
     * @param User $user
     * @param Tome $tome
     * @param Book $book
     *
     * @return UserTome
     */
    public function create(User $user, Tome $tome, Book $book): UserTome
    {
        return (new UserTome())
            ->setTome($tome)
            ->setUser($user)
            ->setBook($book);
    }
}
