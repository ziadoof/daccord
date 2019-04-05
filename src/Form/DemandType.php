<?php

namespace App\Form;


use App\Form\EventListener\AddSpecificationFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\EventListener\AddCategoryFieldSubscriber;
use App\Form\EventListener\AddGeneralcategoryFieldSubscriber;


class DemandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = 'category';
        $entityManager = $options['entity_manager'];
        $builder
            ->addEventSubscriber(new AddGeneralcategoryFieldSubscriber($category, 'Demand'))
            ->addEventSubscriber(new AddCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddSpecificationFieldSubscriber($category, $entityManager));

        ;
        $builder
            ->add('title')
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');

    }

}
