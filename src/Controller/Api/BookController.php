<?php

namespace App\Controller\Api;

use App\Repository\BookRepository;
use App\Repository\UserBookRepository;
use App\Serializer\BookArraySerializer;
use App\Serializer\UserBookArraySerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/api/books/search", name="api_book_search", options={"expose"=true})
     *
     * @param Request                 $request
     * @param BookRepository          $bookRepository
     * @param BookArraySerializer     $bookArraySerializer
     * @param UserBookRepository      $userBookRepository
     * @param UserBookArraySerializer $userBookArraySerializer
     *
     * @return JsonResponse
     */
    public function search(
        Request $request,
        BookRepository $bookRepository,
        BookArraySerializer $bookArraySerializer,
        UserBookRepository $userBookRepository,
        UserBookArraySerializer $userBookArraySerializer
    ) {
        $term = $request->get('q');
        $books = $bookRepository->searchLike($term);

        $serialisedUserBooks = [];
        $userLogged = false;
        if($user = $this->getUser()) {
            $userBooks = $userBookRepository->findBy(['user' => $user, 'book' => $books]);
            $serialisedUserBooks = $userBookArraySerializer->listToArray($userBooks);
            $userLogged = true;
        }

        return $this->json([
            'data' => [
                'books'       => $bookArraySerializer->listToArray($books),
                'user_books'  => $serialisedUserBooks,
                'user_logged' => $userLogged,
            ],
        ]);
    }
}
