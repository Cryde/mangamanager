<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\UserBookRepository;
use App\Repository\UserTomeRepository;
use App\Service\UserTomeFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/books", name="app_book")
     */
    public function index()
    {
        return $this->render('book/index.html.twig');
    }

    /**
     * @Route("/books/{slug}", name="app_book_show")
     *
     * @param Book               $book
     * @param UserBookRepository $userBookRepository
     * @param UserTomeRepository $userTomeRepository
     * @param UserTomeFormatter  $userTomeFormatter
     *
     * @return Response
     */
    public function show(
        Book $book,
        UserBookRepository $userBookRepository,
        UserTomeRepository $userTomeRepository,
        UserTomeFormatter $userTomeFormatter
    ) {
        $userBook = null;
        $userTomes = [];
        if ($user = $this->getUser()) {
            $userBook = $userBookRepository->findOneBy(['user' => $user, 'book' => $book]);
            $userTomes = $userTomeRepository->findBy(['user' => $user, 'book' => $book]);
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'user_book' => $userBook,
            'user_tomes' => $userTomeFormatter->formatFromList($userTomes)
        ]);
    }
}
