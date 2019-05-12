<?php

namespace App\Builder;

use App\Entity\Book;
use App\Entity\BookStatus;
use App\Entity\BookType;

class BookDirector
{
    /**
     * @param string     $title
     * @param string     $description
     * @param BookType   $bookType
     * @param string     $coverUrl
     * @param \DateTime  $publicationDatetime
     * @param BookStatus $bookStatus
     *
     * @return Book
     */
    public function create(
        string $title,
        string $description,
        BookType $bookType,
        string $coverUrl,
        \DateTime $publicationDatetime,
        BookStatus $bookStatus
    ): Book {
        return (new Book())
            ->setTitle($title)
            ->setDescription($description)
            ->setType($bookType)
            ->setCoverUrl($coverUrl)
            ->setPublicationDatetime($publicationDatetime)
            ->setStatus($bookStatus);
    }
}
