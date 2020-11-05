<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(
        PostRepository $postRepository,
        CommentRepository $commentRepository,
        EntityManagerInterface $em
    ): Response {
        // hardcoded data for API
        $post1 = new Post();
        $post1->setTitle('title');
        $post1->setDescription('desc');

        $post2 = new Post();
        $post2->setTitle('title2');
        $post2->setDescription('desc2');

        $comment1 = new Comment();
        $comment1->setContent('comment');
        $comment1->setPost($post1);
        
        $em->persist($post1);
        $em->persist($post2);
        $em->persist($comment1);

        $em->flush();

        $comments = $commentRepository->findAll();

        return $this->render('index/index.html.twig', compact('comments'));
    }
}
