<?php

namespace App\Controller\Admin\Api;

use App\Builder\TomeDirector;
use App\Repository\BookRepository;
use App\Repository\TomeRepository;
use App\Serializer\TomeArraySerializer;
use App\Service\Jsonizer;
use App\Service\TomeArrayValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TomeController extends AbstractController
{
    /**
     * @Route("/admin/api/tome/add", name="admin_api_tome_add", methods={"POST"})
     *
     * @param Request             $request
     * @param Jsonizer            $jsonizer
     * @param TomeRepository      $tomeRepository
     * @param TomeArraySerializer $tomeArraySerializer
     * @param BookRepository      $bookRepository
     * @param TomeDirector        $tomeDirector
     * @param TomeArrayValidator  $tomeArrayValidator
     *
     * @return JsonResponse
     */
    public function add(
        Request $request,
        Jsonizer $jsonizer,
        TomeRepository $tomeRepository,
        TomeArraySerializer $tomeArraySerializer,
        BookRepository $bookRepository,
        TomeDirector $tomeDirector,
        TomeArrayValidator $tomeArrayValidator
    ) {
        $data = $jsonizer->decodeRequest($request);

        $tomeArrayValidator->validate($data);

        $book = $bookRepository->find($data['book_id']);

        if ($tome = $tomeRepository->findOneBy(['title' => $data['title'], 'book' => $book])) {
            return $this->json($tomeArraySerializer->toArray($tome));
        }

        $publicationDatetime = \DateTime::createFromFormat(\DateTimeInterface::ISO8601, $data['publication_datetime']);

        $tome = $tomeDirector->build($data['title'], $data['description'], $book, $publicationDatetime, $data['cover_url'], $data['number']);

        $this->getDoctrine()->getManager()->persist($tome);
        $this->getDoctrine()->getManager()->flush();

        return $this->json($tomeArraySerializer->toArray($tome));
    }
}
