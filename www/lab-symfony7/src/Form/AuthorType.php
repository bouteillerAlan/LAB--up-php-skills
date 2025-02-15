<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de l\'auteur'
            ])
            ->add('dateOfBirth', DateType::class, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'label' => 'Date de naissance'
            ])
            ->add('dateOfDeath', DateType::class, [
                'input' => 'datetime_immutable',
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Date de mort'
            ])
            ->add('nationality', TextType::class, [
                'required' => false,
                'label' => 'Nationalité'
            ])
            ->add('books', EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false,
                'label' => 'Livres'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
