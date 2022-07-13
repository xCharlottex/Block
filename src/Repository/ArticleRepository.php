<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

// creer une methode dans Article Repository afin de trouver grace a un mot dans son titre, l'article

public function searchByWord($search){
        // recuperer le query builder
    // = un objet qui permet de creer des requetes sql, mais en php
    $qb = $this->createQueryBuilder('article');

    // utiliser le constructeur de requete pour faire un select sur la table article
    $query = $qb->select('article')

    // recuperer les articles dont le titre correspond a :word
    ->where('article.title LIKE :search')

    // definir la valeur de :word
    // lui dire que le mot peut contenir des caracteres avant et apres, il sera trouvé
    // le faire en 2 étapes avec setParametre
    // ca permet à Doctrine et SF de sécuriser la variable $word
    ->setParameter('search', '%' .$search. '%')

        // recuperer la requette générée
    ->getQuery();

    // l'executer en bdd et recuperer les resultats
    return $query->getResult();

    }
}
