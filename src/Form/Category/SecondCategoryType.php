<?php

namespace App\Form\Category;

use App\Entity\Ads\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityRepository;
use App\Form\EventListener\AddCategoryFieldSubscriber;
use App\Form\EventListener\AddGeneralcategoryFieldSubscriber;
use App\Repository\Ads\CategoryRepository;

class SecondCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->add('parent',EntityType::class, array(
                 'class' => Category::class,
                 'query_builder' => function (EntityRepository $er) {
                     return $er->createQueryBuilder('c')
                         ->where('c.parent is NULL')
                         ->andWhere('c.type = :type')
                         ->setParameter('type','Offer')
                         ;
                 }
             ));
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
