<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function searchByWord($search){
        // recuperer le query builder
        // = un objet qui permet de creer des requetes sql, mais en php
        $qb = $this->createQueryBuilder('category');

        // utiliser le constructeur de requete pour faire un select sur la table article
        $query = $qb->select('category')

            // recuperer les articles dont le titre correspond a :word
            ->where('category.title LIKE :search')

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
