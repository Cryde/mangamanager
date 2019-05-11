<?php

namespace App\Serializer;

use App\Entity\Book;
use App\Service\CoverPublicPathConverter;
use Symfony\Component\Routing\RouterInterface;

class BookArraySerializer
{
    /**
     * @var CoverPublicPathConverter
     */
    private $coverPublicPathConverter;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * BookArraySerialize constructor.
     *
     * @param CoverPublicPathConverter $coverPublicPathConverter
     */
    public function __construct(CoverPublicPathConverter $coverPublicPathConverter, RouterInterface $router)
    {
        $this->coverPublicPathConverter = $coverPublicPathConverter;
        $this->router = $router;
    }

    /**
     * @param array $books
     *
     * @return array
     */
    public function listToArray(array $books)
    {
        $result = [];
        foreach ($books as $book) {
            $result[] = $this->toArray($book);
        }

        return $result;
    }

    /**
     * @param Book $book
     *
     * @return array
     */
    public function toArray(Book $book): array
    {
        return [
            'id'        => $book->getId(),
            'title'     => $book->getTitle(),
            'url'       => $this->router->generate('app_book_show', ['slug' => $book->getSlug()]),
            'cover_url' => $this->coverPublicPathConverter->getCoverPathFromBook($book),
        ];
    }
}
