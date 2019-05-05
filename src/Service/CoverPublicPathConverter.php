<?php

namespace App\Service;

use App\Entity\Book;
use App\Entity\Tome;

class CoverPublicPathConverter
{
    /**
     * @var string
     */
    private $bookCoverPublicPath;
    /**
     * @var string
     */
    private $tomeCoverPublicPath;

    public function __construct(string $bookCoverPublicPath, string $tomeCoverPublicPath)
    {
        $this->bookCoverPublicPath = $bookCoverPublicPath;
        $this->tomeCoverPublicPath = $tomeCoverPublicPath;
    }

    /**
     * @param Book $book
     *
     * @return string|null
     */
    public function getCoverPathFromBook(Book $book)
    {
        if (!$book->getCoverUrl()) {
            return '';
        }

        if (!$book->getCoverPath()) {
            return $book->getCoverUrl();
        }

        return $this->removePublicDir($this->bookCoverPublicPath) . $book->getCoverPath();
    }

    /**
     * @param Tome $tome
     *
     * @return string|null
     */
    public function getCoverPathFromTome(Tome $tome)
    {
        if (!$tome->getCoverUrl()) {
            return '';
        }

        if (!$tome->getCoverPath()) {
            return $tome->getCoverUrl();
        }

        return $this->removePublicDir($this->tomeCoverPublicPath) . $tome->getCoverPath();
    }


    private function removePublicDir(string $publicPath)
    {
        return str_replace('public', '', $publicPath);
    }
}
