<?php

namespace App\Builder;

use App\Entity\Book;
use App\Entity\Tome;

class TomeDirector
{
    public function build(
        string $title,
        string $description,
        Book $book,
        \DateTime $publicationDatetime,
        string $coverUrl,
        int $number
    ) {
        return (new Tome())
            ->setTitle($title)
            ->setDescription($description)
            ->setBook($book)
            ->setPublicationDatetime($publicationDatetime)
            ->setCoverUrl($coverUrl)
            ->setNumber($number);
    }
}
