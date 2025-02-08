<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $request = Request::createFromGlobals();
        $test = $request->request;
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
