<?php

namespace App\Controller\Api;

use App\Builder\UserBookDirector;
use App\Builder\UserTomeDirector;
use App\Entity\Book;
use App\Entity\Tome;
use App\Entity\UserBook;
use App\Entity\UserTome;
use App\Repository\UserBookRepository;
use App\Repository\UserTomeRepository;
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

    /**
     * @Route("/api/collection/tome/{id}/add", name="api_collection_tome_add", options={"expose"=true})
     *
     * @param Tome               $tome
     * @param UserTomeRepository $userTomeRepository
     * @param UserTomeDirector   $userTomeDirector
     *
     * @return JsonResponse
     */
    public function addTome(Tome $tome, UserTomeRepository $userTomeRepository, UserTomeDirector $userTomeDirector)
    {
        /** @var UserTome $userTome */
        if ($userTome = $userTomeRepository->findBy(['user' => $this->getUser(), 'tome' => $tome])) {
            return $this->json([
                'data' => [
                    'id'  => $userTome->getId(),
                    'url' => 'todo',
                ],
            ]);
        }

        $userTome = $userTomeDirector->create($this->getUser(), $tome, $tome->getBook());
        $this->getDoctrine()->getManager()->persist($userTome);
        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'data' => [
                'id'  => $userTome->getId(),
                'url' => 'todo',
            ],
        ]);
    }

    /**
     * @Route("/api/collection/book/{id}/tome/add-all", name="api_collection_book_add_all_tome", options={"expose"=true})
     *
     * @param Book               $book
     * @param UserTomeRepository $userTomeRepository
     * @param UserTomeDirector   $userTomeDirector
     *
     * @return JsonResponse
     */
    public function addAllTome(Book $book, UserTomeRepository $userTomeRepository, UserTomeDirector $userTomeDirector)
    {
        foreach ($book->getTomes() as $tome) {
            if (!$userTomeRepository->findBy(['user' => $this->getUser(), 'tome' => $tome])) {
                $userTome = $userTomeDirector->create($this->getUser(), $tome, $tome->getBook());
                $this->getDoctrine()->getManager()->persist($userTome);
            }
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'data' => [
                'sucess' => 1,
            ],
        ]);
    }
}
