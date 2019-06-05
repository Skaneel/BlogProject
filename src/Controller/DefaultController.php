<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();

        return $this->render('default/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/post/{id}", name="post")
     */
    public function post($id,PostRepository $postRepository)
    {
        $post = $postRepository->find($id);

        return $this->render('default/post.html.twig', [
            'post' => $post,
        ]);
    }
}
