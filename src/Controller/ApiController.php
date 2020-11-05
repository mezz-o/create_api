<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="app_api", methods="GET")
     */
    public function index(PostRepository $postRepository): Response
    {
        //Serialize in one line via json function
        return $this->json(
            $postRepository->findAll(),
            200,
            [],
            ['groups' => 'post:read']
        );

        return $this->render('api/index.html.twig', compact('posts'));
    }
}
