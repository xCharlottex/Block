<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController {

    /**
     * @Route ("categories", name="categories")
     */
    public function showCategories(CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();

        return $this->render('categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route ("categories/{id}", name="all_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository){
        $category = $categoryRepository->find($id);

        return $this->render('all_category.html.twig', [
            'category' => $category
        ]);
    }


    // on creer sa route + sa fonction let's go
    /**
     * @Route("/insert-category", name="insert_category")
     */

    public function insertCategory(EntityManagerInterface $entityManager){

        // création d'une instance de la classe article
        $category = new Category();

        // se servir des setters et les remplir, insérer les données
        $category->setTitle("C'est l'histoire d'une orange");
        $category->setColor("Orange");
        $category->setIsPublished(true);
        $category->setDescription("Et j'en fais quoi ? du jus d'orange");

        // enregistrer
        $entityManager->persist($category);
        // envoyer dans la BDD
        $entityManager->flush();
        dump($category); die;

    }
}
