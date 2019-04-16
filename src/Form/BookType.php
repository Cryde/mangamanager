<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\BookAuthor;
use App\Entity\BookStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('coverUrl', UrlType::class)
            ->add('publicationDatetime')
            ->add('authors', EntityType::class, ['required' => false, 'class' => BookAuthor::class, 'choice_label' => 'name', 'multiple' => true])
            ->add('status', EntityType::class, ['class' => BookStatus::class, 'choice_label' => 'label'])
            ->add('type',EntityType::class, ['class' => \App\Entity\BookType::class, 'choice_label' => 'label'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
