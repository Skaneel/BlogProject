<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\EditFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditFormController extends AbstractController
{
    /**
     * @Route("/edit/form", name="edit_form")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $posts = new Post();
        $form = $this->createForm(EditFormType::class, $posts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($posts);
            $entityManager->flush();
        }

        return $this->render('edit_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/form/{id}", name="edit_form_post")
     */
    public function edit(Post $post, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(EditFormType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
        $entityManager->persist($post);
        $entityManager->flush();
        }


        return $this->render('edit_form/editpost.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
