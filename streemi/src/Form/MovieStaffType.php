<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieStaffType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom",
                ],
                'row_attr' => [
                    'class' => 'w-3/12',
                ],
            ])
            ->add('fonction', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Fonction",
                ],
                'row_attr' => [
                    'class' => 'w-3/12',
                ],
            ])
            ->add('image', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Image",
                ],
                'row_attr' => [
                    'class' => 'w-3/12',
                ],
            ])
            ->add('lien', null, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Lien",
                ],
                'row_attr' => [
                    'class' => 'w-3/12',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
