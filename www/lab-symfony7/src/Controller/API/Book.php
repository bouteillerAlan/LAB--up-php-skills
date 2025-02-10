<?php

namespace App\Controller\API;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/api')]
class Book extends AbstractController
{
    #[Route(path: '/books', name: 'api_book')]
    public function getAll(BookRepository $bookRepository)
    {
        return $this->json($bookRepository->findAll(), 200, [], ['groups' => ['book.index', 'book.details']]);
    }
}