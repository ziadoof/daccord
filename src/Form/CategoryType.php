<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
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
use App\Form\EventListener\AddSubcategoryFieldSubscriber;
use App\Repository\CategoryRepository;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /* $builder
            ->add('name')
            ->add('parent')
        ;*/
      /*  $factort = $builder->getFormFactory();
        $categorySubscriber = new AddCategoryFieldSubscriber($factort);
        $builder->addEventSubscriber($categorySubscriber);
        $subcategorySubscriber = new AddSubcategoryFieldSubscriber($factort);
        $builder->addEventSubscriber($subcategorySubscriber);
        $generalcategorySubscriber = new AddGeneralcategoryFieldSubscriber($factort);
        $builder->addEventSubscriber($generalcategorySubscriber);*/
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
