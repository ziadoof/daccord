<?php

namespace App\Form\Ads;


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
            // all the ads category in the data base is from type offer for easy search
            ->addEventSubscriber(new AddGeneralcategoryFieldSubscriber($category, 'Offer'))
            ->addEventSubscriber(new AddCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddSpecificationFieldSubscriber($category, $entityManager, 'Demand'));

        ;
        $builder
            ->add('title')
            ->add('description');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');
        $resolver->setDefaults([
            'translation_domain'=> 'manual',
        ]);

    }

}
