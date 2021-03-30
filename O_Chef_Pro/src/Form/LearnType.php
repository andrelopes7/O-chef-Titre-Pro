<?php

namespace App\Form;

use App\Entity\Learn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class LearnType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            
            ->add('pictureFile', VichImageType::class, [
                'label' => 'Image de Recette',
                'required' => true,
            ]) 
            ->add('link')
            ->add('recipes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Learn::class,
        ]);
    }
}
