<?php

namespace App\Controller;

use App\Repository\UserBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CollectionController extends AbstractController
{
    /**
     * @Route("/collection", name="app_collection")
     *
     * @param UserBookRepository $userBookRepository
     *
     * @return Response
     */
    public function index(UserBookRepository $userBookRepository)
    {
        $userBooks = $userBookRepository->findBy(['user' => $this->getUser()]);

        return $this->render('collection/index.html.twig', [
            'user_books' => $userBooks
        ]);
    }
}
