<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    /**
     * @Route("/admin/books", name="admin_book_list")
     *
     * @param BookRepository $bookRepository
     *
     * @return Response
     */
    public function index(BookRepository $bookRepository)
    {
        return $this->render('admin/book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/books/add", name="admin_book_add")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function add(Request $request)
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($book);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_book_list');
        }

        return $this->render('admin/book/add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/books/edit/{slug}", name="admin_book_edit")
     *
     * @param Book    $book
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function edit(Book $book, Request $request)
    {
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($book);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_book_list');
        }

        return $this->render('admin/book/edit.html.twig', ['form' => $form->createView()]);
    }
}
