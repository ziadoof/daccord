<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Form\EventListener\AddCategoryFieldSubscriber;
use App\Form\EventListener\AddGeneralcategoryFieldSubscriber;
use App\Form\EventListener\AddSubcategoryFieldSubscriber;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use App\Controller\AdController;
use App\Form\EventListener\AddSpecificationFieldSubscriber;



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
            ->addEventSubscriber(new AddSubcategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddSpecificationFieldSubscriber($category, $entityManager));

        $builder
            ->add('title')
            ->add('description')
          /*  ->add('imageOne', FileType::class, [ 'required' => false])
            ->add('imageTow', FileType::class, [ 'required' => false])
             ->add('imageThree',FileType::class, [ 'required' => false])*/
            ->add('price')
            ->add('donate')
            ->add('withDriver');


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('entity_manager');
    }
}
