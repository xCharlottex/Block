<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController {

    /**
     * @Route ("admin/categories", name="admin_categories")
     */
    public function showCategories(CategoryRepository $categoryRepository){
        $categories = $categoryRepository->findAll();

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route ("admin/categories/{id}", name="admin_all_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository){
        $category = $categoryRepository->find($id);

        return $this->render('admin/all_category.html.twig', [
            'category' => $category
        ]);
    }


    // on creer sa route + sa fonction let's go
    /**
     * @Route("/admin/insert-category", name="admin_insert_category")
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

    /**
     * @Route("/admin/category/delete/{id}", name="admin_delete_category")
     */
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager) {
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admin_categories');
    }

    /**
     * @Route("admin/categories/update/{id}", name="admin_update_category")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager){
        $category = $categoryRepository->find($id);

        $category->setTitle('update category');

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('okay');
    }
}
