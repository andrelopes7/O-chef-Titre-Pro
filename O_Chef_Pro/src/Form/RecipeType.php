<?php

namespace App\Form;

use App\Entity\Diet;
use App\Entity\Ingredient;
use App\Entity\Post;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de recette',
                ])
            ->add('introduction', TextareaType::class, [
                    'label' => 'Quelques mots :'
                    ])
            ->add('description', TextareaType::class, [
                'label' => 'Etapes :'
                ])
            ->add('picture')

            /* ->add('pictureFile', VichImageType::class, [
                'label' => 'Image de Recette',
                'required' => true,
            ]) */
            ->add('time', TextType::class, [
                'label' => 'Temps Total  :'
            ])
            ->add('portions', TextType::class, [
                'label' => 'Portions',
            ])
            ->add('danger_level', TextType::class, [
                'label' => 'Niveau de Danger',
            ])
            ->add('posts')

            ->add('difficult', TextType::class, [
                'label' => 'Difficulté', 
                ])
            ->add('categories')
            ->add('diets', EntityType::class, [
                'class' => Diet::class,
                 'label' => 'Régime Alimentaire :',
                 'multiple' => true,
                  'expanded' => true 
            ])

            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                 'label' => 'Nom d\'ingredient :',
                 'multiple' => true,
                  'expanded' => true 
              ])

            ->add('countries')
            ->add('blog')
            ->add('utilisateur')
            ->add('learn')
            ->add('video_room')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
