<?php

namespace App\Controller;

use App\Repository\BookStatusRepository;
use App\Repository\UserBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     * @Route("/collection", name="app_collection")
     *
     * @param UserBookRepository   $userBookRepository
     * @param BookStatusRepository $bookStatusRepository
     *
     * @return Response
     */
    public function index(UserBookRepository $userBookRepository, BookStatusRepository $bookStatusRepository)
    {
        $user = $this->getUser();

        $endedStatus = $bookStatusRepository->findOneBy(['slug' => 'termine']);
        $readAndFinishedBooks = $userBookRepository->findAllReadAndEndedBookByUser($user, $endedStatus);

        $userBooks = $userBookRepository->findInProgressByUserAndExcluded($user, $readAndFinishedBooks);

        return $this->render('collection/index.html.twig', [
            'user_books' => $userBooks,
            'user_books_read_finish' => $readAndFinishedBooks
        ]);
    }
}
