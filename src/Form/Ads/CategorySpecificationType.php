<?php

namespace App\Form\Ads;

use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorySpecificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specifications', SpecificationCollectionType::class, [
                'entry_type' => SpecificationType::class,
                'entry_options' => ['label' => false],
                'block_name' => 'specification',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                /*'by_reference' => false,*/
                'label' => false,
                'mapped'=>false,
                'attr' => array(
                    'class' => 'specification-form',
                ),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
