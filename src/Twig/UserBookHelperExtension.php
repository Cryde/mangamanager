<?php

namespace App\Twig;

use App\Entity\Book;
use App\Entity\UserBook;
use App\Repository\TomeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class UserBookHelperExtension extends AbstractExtension
{
    /**
     * @var TomeRepository
     */
    private $tomeRepository;

    public function __construct(TomeRepository $tomeRepository)
    {
        $this->tomeRepository = $tomeRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('next_tome', [$this, 'getNextTome']),
        ];
    }

    /**
     * @param UserBook $userBook
     *
     * @return mixed
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function getNextTome(UserBook $userBook)
    {
        return $this->tomeRepository->getNextTome($userBook->getBook(), $userBook->getReadTomeNumber());
    }
}
