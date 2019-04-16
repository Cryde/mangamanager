<?php

namespace App\Controller\Api;

use App\Builder\UserBookDirector;
use App\Entity\Book;
use App\Entity\UserBook;
use App\Repository\UserBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     * @Route("/api/collection/book/{id}/add", name="api_collection_book_add", options={"expose"=true})
     *
     * @param Book               $book
     * @param UserBookRepository $userBookRepository
     * @param UserBookDirector   $userBookDirector
     *
     * @return JsonResponse
     */
    public function add(Book $book, UserBookRepository $userBookRepository, UserBookDirector $userBookDirector)
    {
        /** @var UserBook $userBook */
        if ($userBook = $userBookRepository->findBy(['user' => $this->getUser(), 'book' => $book])) {
            return $this->json([
                'data' => [
                    'id'  => $userBook->getId(),
                    'url' => 'todo',
                ],
            ]);
        }

        $userBook = $userBookDirector->create($this->getUser(), $book);
        $this->getDoctrine()->getManager()->persist($userBook);
        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'data' => [
                'id'  => $userBook->getId(),
                'url' => 'todo',
            ],
        ]);
    }
}
