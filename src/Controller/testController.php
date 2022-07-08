<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController {

    /**
     * @Route("/articles/update/{id}", name="update_article")
     */
    public function articleUpdate($id, ArticleRepository $articleRepository ,EntityManagerInterface $entityManager) {
        $article = $articleRepository->find($id);
        // ARTICLE ICI
        $article->setTitle('update article')

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('OKAY');
    }
}
