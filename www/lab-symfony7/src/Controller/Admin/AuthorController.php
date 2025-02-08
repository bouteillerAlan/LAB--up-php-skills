<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/author')]
final class AuthorController extends AbstractController
{
    #[Route('', name: 'app_admin_author')]
    public function index(): Response
    {
        return $this->render('admin/author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/new', name: 'app_admin_author_new', methods: ['GET'])]
    public function new(): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        return $this->render('admin/author/new.html.twig', [
            'form' => $form,
        ]);
    }

}
