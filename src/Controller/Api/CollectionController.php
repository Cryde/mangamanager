<?php

namespace App\Controller\Api;

use App\Builder\UserTomeDirector;
use App\Entity\Book;
use App\Entity\Tome;
use App\Repository\UserTomeRepository;
use App\Service\UserBookManager;
use App\Service\UserTomeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     * @Route("/api/collection/book/{id}/add", name="api_collection_book_add", options={"expose"=true})
     *
     * @param Book            $book
     * @param UserBookManager $userBookManager
     *
     * @return JsonResponse
     */
    public function addBook(Book $book, UserBookManager $userBookManager)
    {
        $userBook = $userBookManager->addByUser($this->getUser(),$book);

        return $this->json([
            'data' => [
                'id'  => $userBook->getId(),
            ],
        ]);
    }

    /**
     * @Route("/api/collection/tome/{id}/add", name="api_collection_tome_add", options={"expose"=true})
     *
     * @param Tome            $tome
     * @param UserTomeManager $userTomeManager
     *
     * @return JsonResponse
     */
    public function addTome(Tome $tome, UserTomeManager $userTomeManager)
    {
        $userTome = $userTomeManager->addByUser($this->getUser(), $tome);

        return $this->json([
            'data' => [
                'id' => $userTome->getId(),
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
