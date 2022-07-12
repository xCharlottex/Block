<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;

use App\Form\CategoryType;
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

//    /**
//     * @Route("/admin/insert-category", name="admin_insert_category")
//     */
//
//    public function insertCategory(EntityManagerInterface $entityManager)
//    {
//
//        // création d'une instance de la classe article
//        $category = new Category();
//
//        // se servir des setters et les remplir, insérer les données
//        $category->setTitle("C'est l'histoire d'une orange");
//        $category->setColor("Orange");
//        $category->setIsPublished(true);
//        $category->setDescription("Et j'en fais quoi ? du jus d'orange");
//
//        // enregistrer
//        $entityManager->persist($category);
//        // envoyer dans la BDD
//        $entityManager->flush();
//
//        $this->addFlash('sucess', 'Vous avez bien ajouté la categorie');
//        return new Response('ok');
//
//    }

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
    public function updateCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager, Request $request)
    {
        $category = $categoryRepository->find($id);

        $category->setTitle('update category');

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Category enregistré');
        }

        return$this->render('admin/update_category.html.twig', ['form'=>$form->createView()]);
    }


    // création de la route du nom de son url + son nom pour faire appel
//    /**
//     * @Route ("/admin/categories_insert", name="admin_insert_categories")
//     */
//    // craétion d'une methode + nom de la variable, création de l'instance + de la requete
//    public function insertCategories(EntityManagerInterface $entityManager, Request $request)
//    {
//        // création d'une variable, appel a la classe request et fonction query + get
//        $title= $request->query->get('title');
//        $color= $request->query->get('color');
//        $description = $request->query->get('description');
//
//        // si le form a été envoyé , englober les conditions de formulaire
//        if ($request->query->has('title') && $request->query->has('color') && $request->query->has('description')) {
//
//            // si il y a présence d'un titre+couleur+description on execute
//            if (!empty($title)&& !empty($color)&& !empty($description)) {
//
//                // informer la BDD que les requetes vont etre intégré a cette table
//                // instance de classe
//                $category = new Category();
//
//                // utiliser + remplir les setters pour insérer les données
//                $category->setTitle($title);
//                $category->setColor($color);
//                $category->setDescription($description);
//                $category->setisPublished('true');
//
//                $entityManager->persist($category);
//                // convertir + enregister, envoyer dans la BDD
//                $entityManager->flush();
//                // message flash
//                $this->addFlash("success","Vous avez réussi");
//                // route redirigé sur l'accueil des catégories
//                return $this->redirectToRoute("admin_categories");
//            } else {
//                $this->addFlash("error","eh non ..");
//            }
//        }
//        // la route mene vers ce lien twig ( mon formulaire)
//        return $this->render('admin/formulaire_category.html.twig');
//
//    }
    /**
     * @Route("/admin/category_insert", name="admin_insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager, Request $request){

        // creation d'une instance de la classe entité category
        // => pour une creation d'une category dans la BDD
        $category = new Category();


        // utiliser dans le terminal "bin/console make:form"
        // utiliser la methode $this->createForm pour creer un formulaire
        // utiliser le plan du formulaire (CategoryType) + une instance Category
        $form = $this->createForm(CategoryType::class, $category);

        // on donne a la variable qui contient le formulaire une instance de la classe request
        // pour que le formulaire puisse recuperer toutes les données
        //des inputs et faire les setters sur $category automatiquement
        $form->handleRequest($request);

        // si le formulaire a été posté et que les données sont valides (valeurs des inputs
        // correspondent a ce qui est attendu en bdd pour la table category
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Catégorie enregistré');
        }

        // afficher twig en lui passant une variable
        // form qui contient la vue du formulaire = le resultat de la methode createView de la variable $form
        return $this->render('admin/insertCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
