<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('picture')
            ->add('time')
            ->add('portions')
            ->add('danger_level')
            ->add('difficult')
            ->add('created_at')
            ->add('updated_at')
            ->add('categories')
            ->add('ingredients')
            ->add('countries')
            ->add('blog')
            ->add('user')
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
