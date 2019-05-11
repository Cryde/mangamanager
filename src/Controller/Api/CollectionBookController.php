<?php

namespace App\Controller\Api;

use App\Entity\Book;
use App\Service\UserBookManager;
use App\Service\UserTomeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CollectionBookController extends AbstractController
{
    /**
     * @Route("/api/collection/book/{id}/add", name="api_collection_book_add", options={"expose"=true})
     *
     * @param Book            $book
     * @param UserBookManager $userBookManager
     *
     * @return JsonResponse
     */
    public function add(Book $book, UserBookManager $userBookManager)
    {
        $userBook = $userBookManager->addByUser($this->getUser(), $book);

        return $this->json([
            'data' => [
                'book'      => ['id' => $book->getId()],
                'user_book' => ['id' => $userBook->getId()],
            ],
        ]);
    }

    /**
     * @Route("/api/collection/book/{id}/remove", name="api_collection_book_remove", options={"expose"=true})
     *
     * @param Book            $book
     * @param UserBookManager $userBookManager
     * @param UserTomeManager $userTomeManager
     *
     * @return JsonResponse
     */
    public function remove(Book $book, UserBookManager $userBookManager, UserTomeManager $userTomeManager)
    {
        $userBookManager->removeByUser($this->getUser(), $book);
        $userTomeManager->removeByUserAndBook($this->getUser(), $book);

        return $this->json([
            'data' => [
                'book' => ['id' => $book->getId()],
            ],
        ]);
    }
}
