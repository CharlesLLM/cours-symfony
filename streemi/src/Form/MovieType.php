<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Titre',
                ],
            ])
            ->add('coverImage', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'URL de l\'image de couverture',
                ],
            ])
            ->add('shortDescription', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Description courte',
                    'rows' => 3,
                ],
            ])
            ->add('longDescription', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Description longue',
                    'rows' => 10,
                ],
            ])
            ->add('releaseDate', null, [
                'label' => false,
                'widget' => 'single_text',
            ])
            ->add('staff', CollectionType::class, [
                'label' => false,
                'entry_type' => MovieStaffType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => [
                    'label' => false,
                    'attr' => [
                        'class' => 'flex gap-2 mb-2',
                    ],
                ],
            ])
            ->add('casting', CollectionType::class, [
                'label' => false,
                'entry_type' => MovieCastingType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => [
                    'label' => false,
                    'attr' => [
                        'class' => 'flex gap-2 mb-2',
                    ],
                ],
            ])
            ->add('score', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Note',
                ],
            ])
            ->add('duration', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Durée',
                ],
            ])
            ->add('categories', EntityType::class, [
                'placeholder' => 'Catégories',
                'label' => false,
                'class' => Category::class,
                'choice_label' => 'label',
                'multiple' => true,
            ])
            ->add('languages', EntityType::class, [
                'placeholder' => 'Langues',
                'label' => false,
                'class' => Language::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
            ->add('subtitles', EntityType::class, [
                'placeholder' => 'Sous-titres',
                'label' => false,
                'class' => Language::class,
                'choice_label' => 'nom',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,

        ]);
    }
}
