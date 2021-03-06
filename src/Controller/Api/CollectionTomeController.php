<?php

namespace App\Controller\Api;

use App\Builder\UserTomeDirector;
use App\Entity\Book;
use App\Entity\Tome;
use App\Repository\UserTomeRepository;
use App\Service\UserTomeManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CollectionTomeController extends AbstractController
{
    /**
     * @Route("/api/collection/tome/{id}/add", name="api_collection_tome_add", options={"expose"=true})
     *
     * @param Tome            $tome
     * @param UserTomeManager $userTomeManager
     *
     * @return JsonResponse
     */
    public function add(Tome $tome, UserTomeManager $userTomeManager)
    {
        $userTome = $userTomeManager->addByUser($this->getUser(), $tome);

        return $this->json([
            'data' => [
                'tome'      => ['id' => $tome->getId()],
                'user_tome' => ['id' => $userTome->getId()],
            ],
        ]);
    }

    /**
     * @Route("/api/collection/book/{id}/tome/add-all", name="api_collection_book_add_all_tome", options={"expose"=true})
     *
     * @param Book            $book
     * @param UserTomeManager $userTomeManager
     *
     * @return JsonResponse
     */
    public function addAllTome(Book $book, UserTomeManager $userTomeManager)
    {
        foreach ($book->getTomes() as $tome) {
            $userTomeManager->addByUser($this->getUser(), $tome);
        }

        $this->getDoctrine()->getManager()->flush();

        return $this->json([
            'data' => [
                'sucess' => 1,
            ],
        ]);
    }
}
