<?php

namespace App\Form;

use App\Form\EventListener\AddCategoryFieldSubscriber;
use App\Form\EventListener\AddGeneralcategoryFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\EventListener\AddOspecificationFieldSubscriber;



class OfferType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = 'category';
        $entityManager = $options['entity_manager'];

        $builder
            ->addEventSubscriber(new AddGeneralcategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddOspecificationFieldSubscriber($category, $entityManager));

        $builder
            ->add('title')
            ->add('description')
            ->add('imageOne', FileType::class, [ 'required' => false, 'label'=>'Main photo'])
            ->add('imageTow', FileType::class, [ 'required' => false, 'label'=>'Photo 2'])
            ->add('imageThree',FileType::class, [ 'required' => false, 'label'=>'Photo 3']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');
    }
}
