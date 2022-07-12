<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('isPublished')
            ->add('content')
            // ajouter le champs category pour gerer la selection d'une categorie pour l'article
                // mettre le type "EntityType" car relation vers une entité
                // parametrer mon input pour qu'il affiche toutes les categories
                // de la BDD avec leur titre dans les options du select
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label'=> 'title'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
