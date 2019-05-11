<?php

namespace App\Serializer;

use App\Entity\UserBook;

class UserBookArraySerializer
{
    /**
     * @param array|UserBook[] $userBooks
     *
     * @return array
     */
    public function listToArray(array $userBooks)
    {
        $result = [];

        foreach ($userBooks as $userBook) {
            $result[] = $this->toArray($userBook);
        }

        return $result;
    }

    /**
     * @param UserBook $userBook
     *
     * @return array
     */
    public function toArray(UserBook $userBook)
    {
        return [
            'id'               => $userBook->getId(),
            'book_id'          => $userBook->getBook()->getId(),
            'read_tome_number' => $userBook->getReadTomeNumber(),
        ];
    }
}
