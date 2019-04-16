<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\UserBookRepository;
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
     *
     * @return Response
     */
    public function show(Book $book, UserBookRepository $userBookRepository)
    {
        $userBook = null;
        if($user = $this->getUser()) {
            $userBook = $userBookRepository->findOneBy(['user' => $user, 'book' => $book]);
        }

        return $this->render('book/show.html.twig', ['book' => $book, 'user_book' => $userBook]);
    }
}
