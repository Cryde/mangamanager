<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Entity\BookAuthor;
use App\Form\BookAuthorType;
use App\Form\BookType;
use App\Repository\BookAuthorRepository;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookAuthorController extends AbstractController
{
    /**
     *
     * @Route("/admin/authors", name="admin_author_list")
     *
     * @param BookAuthorRepository $bookAuthorRepository
     *
     * @return Response
     */
    public function index(BookAuthorRepository $bookAuthorRepository)
    {
        return $this->render('admin/author/index.html.twig', [
            'authors' => $bookAuthorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/authors/add", name="admin_author_add")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function add(Request $request)
    {
        $book = new BookAuthor();
        $form = $this->createForm(BookAuthorType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($book);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_author_list');
        }

        return $this->render('admin/author/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/authors/edit/{slug}", name="admin_author_edit")
     *
     * @param BookAuthor $author
     * @param Request    $request
     *
     * @return RedirectResponse|Response
     */
    public function edit(BookAuthor $author, Request $request)
    {
        $form = $this->createForm(BookAuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_author_list');
        }

        return $this->render('admin/author/edit.html.twig', ['form' => $form->createView()]);
    }
}
