<?php

namespace App\Controller\Api;

use App\Repository\BookRepository;
use App\Serializer\BookArraySerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/api/books/search", name="api_book_search", options={"expose"=true})
     *
     * @param Request             $request
     * @param BookRepository      $bookRepository
     * @param BookArraySerializer $bookArraySerializer
     *
     * @return JsonResponse
     */
    public function search(Request $request, BookRepository $bookRepository, BookArraySerializer $bookArraySerializer)
    {
        $term = $request->get('q');
        $books = $bookRepository->searchLike($term);

        return $this->json(['data' => $bookArraySerializer->listToArray($books)]);
    }
}
