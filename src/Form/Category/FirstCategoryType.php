<?php

namespace App\Form\Category;

use App\Entity\Ads\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FirstCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
            ->add('name')
            ->add('isParent',CheckboxType::class,array(
               'mapped'=>false,
               'required'=>false,
           ));
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
            'translation_domain'=> 'manual',
        ]);
    }
}
