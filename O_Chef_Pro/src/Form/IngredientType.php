<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'empty_data' => '',])
            ->add('picture')
            ->add('pictureFile',  VichImageType::class, [
                'label' => 'Image de Recette',
                'required' => true,
                /* 'mapped' => false, */
               
            ])
            ->add('description', null, [
                'empty_data' => '',])
            ->add('type')
            ->add('recipes')
            ->add('utilisateurs')
            ->add('blog')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
