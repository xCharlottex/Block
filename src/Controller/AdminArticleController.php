<?php


namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseCookieValueSame;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    /**
     * @Route("/admin/article/{id}", name="admin_article")
     */
    public function showArticle(ArticleRepository $articleRepository, $id){

        // recupérer depuis la base de donnée un article en fonction d'un ID
        // donc SELECT * FROM article where id = xxx


        // la classe Repository me permet de faire des requetes select
        // dans la table associé
        // la methode permet de recuperer un element par rapport a son id

        $article = $articleRepository->find($id);
        //dd($article);

        return $this->render('admin/show_article.html.twig', [
           'article' => $article
        ]);
    }

    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function listArticles(ArticleRepository $articleRepository){
        $articles = $articleRepository->findAll();
        //dd($articles);

        return $this->render(('admin/list_articles.html.twig'), [
            'articles' => $articles
        ]);
    }




// on creer sa route & sa fonction
//    /**
//     * @Route("/articles", name="list_articles")
//     */
//    public function listArticles()
//    {
//        $articles = [
//            1 => [
//                'title' => 'Non, là c\'est sale',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Eric',
//                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
//                'id' => 1
//            ],
//            2 => [
//                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Maurice',
//                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
//                'id' => 2
//            ],
//            3 => [
//                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Didier',
//                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
//                'id' => 3
//            ],
//            4 => [
//                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Mbala',
//                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
//                'id' => 4
//            ],
//        ];
//        // mettre en lien avec la page twig
//        return $this->render('list_articles.html.twig', [
//            'articles' => $articles
//        ]);
//
//    }
//
//    /**
//     * @Route("/articles/{id}", name="show_article")
//     */
//    public function showArticle($id)
//    {
//        $articles = [
//            1 => [
//                'title' => 'Non, là c\'est sale',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Eric',
//                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
//                'id' => 1
//            ],
//            2 => [
//                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Maurice',
//                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
//                'id' => 2
//            ],
//            3 => [
//                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Didier',
//                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
//                'id' => 3
//            ],
//            4 => [
//                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Mbala',
//                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
//                'id' => 4
//            ],
//        ];
//
//        $article = $articles[$id];
//
//        return $this->render('show_article.html.twig', [
//            'article' => $article
//        ]);
//    }

    /**
     * @Route("/admin/insert-article", name="admin_insert-article")
     */

    public function insertArticle(EntityManagerInterface $entityManager){

        // je créé une instance de la classe article
        // c'est pour creer un nouvel article (table article) de ma BDD

        $article = new Article();

        // utiliser les setters, les remplir ,titre, contenu , isPublished
        // pour insérer les données pour le titre, le contenu etc etc

        $article->setTitle("Chat");
        $article->setContent("C'est un petit chat");
        $article->setIsPublished(true);
        $article->setAuthor("miaou");



        // j'utilise la classe EntityManagerInterface de Doctrine pour
        // enregistrer mon entité dans la bdd dans la table article (en
        // deux étapes avec le persist puis le flush)


        // surveiller
        $entityManager->persist($article);
        // convertir, enregistrer, l'envoyer dans la BDD
        $entityManager->flush();

        $this->addFlash('sucess', 'Vous avez bien ajouté l\'article');

        return $this->redirectToRoute('admin_articles');
    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_delete_article")
     */
    public function deleteArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager){

        // récupérer l'article en fonction de l'id dns l'url
        $article = $articleRepository->find($id);


        // verifier que la variable $article ne contient pas null
        // = que l'article existe en BDD
        if(!is_null($article)) {
            // utiliser l'entity manager pour supp l'article
            $entityManager->remove($article);
            $entityManager->flush();

            // retourner les messages suivant
            $this->addFlash('success', 'Vous avez bien supprimé l\'article');
        } else {
            $this->addFlash('error', 'Article introuvable');
        }
        return $this->redirectToRoute('admin_articles');
    }

        // on inclu le update, à la suite du nom url de la route, puis l'id pour cibler un article
    /**
     * @Route("admin/articles/update/{id}", name="admin_update_article")
     */
    // d'abord l'id () pour mettre la suite
    public function updateArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager) {

        $article = $articleRepository->find($id);
        // $article -> et non =
        $article->setTitle('update article');

        // persist puis flush
        $entityManager->persist($article);
        $entityManager->flush();

        // ne pas oublier le return new response !!
        return new Response('c\'est ok' );
    }

}