<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * form that create a new author
     * @param Request $request
     * @return Response
     */
    #[Route('/new', name: 'app_admin_author_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            #$data = $form->getData();
            #var_dump($data);
        }

        return $this->render('admin/author/new.html.twig', [
            'form' => $form,
        ]);
    }

}
