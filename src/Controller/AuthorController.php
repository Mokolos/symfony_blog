<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/new", name="author_new")
     */
    public function new(Request $request)
    {
        // redirect if not connected
        $user = $this->getUser();
        if (!$user) return $this->redirectToRoute('security_login');

        $author = new Author();
        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // connect author to connected user
            $author->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('author/new.html.twig', [
            'authorForm' => $form->createView(),
        ]);
    }
}
