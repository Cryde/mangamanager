<?php

namespace App\Controller\Admin\Api;

use App\Builder\BookDirector;
use App\Repository\BookRepository;
use App\Repository\BookStatusRepository;
use App\Repository\BookTypeRepository;
use App\Serializer\BookArraySerializer;
use App\Service\BookArrayValidator;
use App\Service\Jsonizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/admin/api/book/add", name="admin_api_book_add", methods={"POST"})
     *
     * @param Request              $request
     * @param Jsonizer             $jsonizer
     * @param BookRepository       $bookRepository
     * @param BookArraySerializer  $bookArraySerializer
     * @param BookDirector         $bookDirector
     * @param BookTypeRepository   $bookTypeRepository
     * @param BookStatusRepository $bookStatusRepository
     * @param BookArrayValidator   $bookArrayValidator
     *
     * @return JsonResponse
     */
    public function add(
        Request $request,
        Jsonizer $jsonizer,
        BookRepository $bookRepository,
        BookArraySerializer $bookArraySerializer,
        BookDirector $bookDirector,
        BookTypeRepository $bookTypeRepository,
        BookStatusRepository $bookStatusRepository,
        BookArrayValidator $bookArrayValidator
    ) {
        $data = $jsonizer->decodeRequest($request);

        $bookArrayValidator->validate($data);

        if ($book = $bookRepository->findOneBy(['title' => $data['title']])) {
            return $this->json($bookArraySerializer->toArray($book));
        }

        $type = $bookTypeRepository->find($data['type_id']);
        $status = $bookStatusRepository->find($data['status_id']);
        $publicationDatetime = \DateTime::createFromFormat(\DateTimeInterface::ISO8601, $data['publication_datetime']);

        $book = $bookDirector->create($data['title'], $data['description'], $type, $data['cover_url'], $publicationDatetime, $status);
        $this->getDoctrine()->getManager()->persist($book);
        $this->getDoctrine()->getManager()->flush();

        return $this->json($bookArraySerializer->toArray($book));
    }
}
