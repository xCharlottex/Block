<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Routing\Annotation\Route;

//on créer une classe (car route est pour les controllers) et on se sert de l'ORM
// pour que l'annotation soit prise en compte et création d'une entité => class entité
// ORM = mapping objet-relationnel ; outil qui va permettre de se mettre
// en interface entre le programme et la BDD
/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */

//on créer une classe
class Article
{

    //on créer les annotations pour
    // definir ce qu'il va etre créé dans la BDD
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    // type string = chaine de caractere
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }


    // Pour creer ta base de donnée dans le terminal
    // php bin/console doctrine:database:create
    // migration de fichier dans la BDD
    // php bin/console make:migration
    // l'envoyer et le comparer de la BDD précédente pour le prendre en compte
    // php bin/console doctrine:migration:migrate


    //php bin/console make:entity
    //pour creer ta nvlle table directement

}
