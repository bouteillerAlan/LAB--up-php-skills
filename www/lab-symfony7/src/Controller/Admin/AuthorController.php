<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Form\AuthorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

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
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[IsGranted('IS_AUTHENTICATED')]
    #[Route('/new', name: 'app_admin_author_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            return $this->redirectToRoute('app_admin_author_new');
        }

        return $this->render('admin/author/new.html.twig', [
            'form' => $form,
        ]);
    }

}
