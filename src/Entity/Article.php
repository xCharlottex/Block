<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;


//on créer une classe (car route est pour les controllers) et on se sert de l'ORM
// pour que l'annotation soit prise en compte et création d'une entité => class entité
// ORM = mapping objet-relationnel ; outil qui va permettre de se mettre
// en interface entre le programme et la BDD
/**
 * @ORM\Entity()
 */

//on créer une classe

class Article {

    //on créer les annotations pour definir ce qu'il va etre créé dans la BDD

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */

    public $id;

    /**
     * @ORM\Column (type="string")
     */

    public $title;
    /**
     * @ORM\Column (type="string")
     */

    public $image;
    /**
     * @ORM\Column (type="string")
     */

    public $isPublished;
    /**
     * @ORM\Column (type="date")
     */

    public $author;
    /**
     * @ORM\Column (type="string")
     */

    // type string = chaine de caractere

    // Pour creer ta base de donnée dans le terminal
    // php bin/console doctrine:database:create
    // migration de fichier dans la BDD
    // php bin/console make:migration

}