<?php

namespace App\Form;

use App\Entity\Diet;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôles',
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'Administrateur' => "ROLE_ADMIN",
                    'Utilisateur' => "ROLE_USER",
                ],
            ])
            ->add('password', PasswordType::class)
            ->add('picture')
            ->add('friend')
            ->add('diet', EntityType::class, [
                'class' => Diet::class,
                 'label' => 'Régime Alimentaire :',
                 'multiple' => true,
                  'expanded' => true 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
