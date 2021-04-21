<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Ingredient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('introduction')
            ->add('content')
            ->add('media')
            ->add('mediaFile', VichImageType::class, [
                'label' => 'Image',
                'required' => true,
            ])
            ->add('recipes')
            ->add('utilisateur')
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,

                 'label' => 'Nom d\'ingredient :',
              
                 'multiple' => true,
                  'expanded' => true 
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
