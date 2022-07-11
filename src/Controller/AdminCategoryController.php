<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route ("admin/categories", name="admin_categories")
     */
    public function showCategories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route ("admin/categories/{id}", name="admin_all_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        return $this->render('admin/all_category.html.twig', [
            'category' => $category
        ]);
    }


    // on creer sa route + sa fonction let's go

    /**
     * @Route("/admin/insert-category", name="admin_insert_category")
     */

    public function insertCategory(EntityManagerInterface $entityManager)
    {

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

        $this->addFlash('sucess', 'Vous avez bien ajouté la categorie');
        return new Response('ok');

    }

    /**
     * @Route("/admin/category/delete/{id}", name="admin_delete_category")
     */
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez bien supprimé la categorie');

        return $this->redirectToRoute('admin_categories');
    }

    /**
     * @Route("admin/categories/update/{id}", name="admin_update_category")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $category->setTitle('update category');

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('okay');
    }



    /**
     * @Route ("/admin/categories_insert", name="admin_insert_categories")
     */
    public function insertCategories(EntityManagerInterface $entityManager, Request $request)
    {
        $title= $request->query->get('title');
        $color= $request->query->get('color');
        $description = $request->query->get('description');

        // si le form a été envoyé //
        if ($request->query->has('title') && $request->query->has('color') && $request->query->has('description')) {

            if (!empty($title)&& !empty($color)&& !empty($description)) {

                $category = new Category();

                $category->setTitle($title);
                $category->setColor($color);
                $category->setDescription($description);
                $category->setisPublished('true');

                $entityManager->persist($category);
                // envoyer dans la BDD
                $entityManager->flush();

                $this->addFlash("success","Vous avez réussi");

                return $this->redirectToRoute("admin_categories");
            } else {
                $this->addFlash("error","eh non ..");
            }
        }

        return $this->render('admin/formulaire_category.html.twig');

    }

}
