<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

    // on creer sa route + sa fonction let's go
    /**
     * @Route("/category", name="category")
     */

    public function insertCategory(EntityManagerInterface $entityManager){

        $category = new Category();

        $category->setTitle("C'est l'histoire d'une orange");
        $category->setColor("Orange");
        $category->setIsPublished(true);
        $category->setDescription("Et j'en fais quoi ? du jus d'orange");

        $entityManager->persist($category);
        $entityManager->flush();
        dump($category); die;

    }
}
