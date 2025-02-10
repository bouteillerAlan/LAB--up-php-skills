<?php

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('admin/book')]
final class BookController extends AbstractController
{
    #[Route('/', name: 'app_admin_book')]
    public function index(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();
        return $this->render('admin/book/index.html.twig', [
            'controller_name' => 'BookController',
            'books' => $books
        ]);
    }

    #[Route('/{id}', name: 'app_admin_book_detail', requirements: ['id' => Requirement::DIGITS], methods: ['GET'])]
    public function getOne(BookRepository $bookRepository, Request $request): Response
    {
        $book = $bookRepository->findOneById($request->get('id'));
        return $this->render('admin/book/detail.html.twig', [
            'book' => $book
        ]);
    }

    /**
     * form that create a new book
     * @param Book|null $book
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/new', name: 'app_admin_book_new', methods: ['GET', 'POST'])]
    #[Route('/{id}/edit', name: 'app_admin_book_edit', requirements: ['id' => Requirement::DIGITS], methods: ['GET', 'POST'])]
    public function new(?Book $book, Request $request, EntityManagerInterface $manager): Response
    {
        $book ??= new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            return $this->redirectToRoute('app_admin_book_new');
        }

        return $this->render('admin/book/new.html.twig', [
            'form' => $form,
        ]);
    }
}
