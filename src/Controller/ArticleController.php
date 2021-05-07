<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;

class ArticleController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/article/new", name="article_create")
     * @Route ("/article/{id}/edit", name="article_edit")
     */
    public function form(Article $article = null, Request $request,EntityManagerInterface $manager)
    {
        // redirect if not connected
        $user = $this->getUser();
        if (!$user) return $this->redirectToRoute('security_login');

        if (!$article){
            $article = new Article();
        }

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            // set connected user as author
            $author = $article->getAuthor();

            if (!$author) {
                $author = new Author();
                $author->setUser($user);
                $author->setName($user->getUsername());
                $article->setAuthor($author);
            }

            // save changes
            $manager->persist($author);
            $manager->persist($article);
            $manager->flush();

            // redirect to article show page when successfull
            return $this->redirectToRoute('article_show',[
                'id' => $article->getId()
            ]);
        }

        return $this->render('article/create.html.twig',[
            'articleForm' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show($id)
    {
        $repo = $this->getdoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        // redirect to homepage if no article
        if (!$article) return $this->redirectToRoute('homepage');

        return $this->render('article/show.html.twig',[
            'article' => $article
        ]);
    }

}
