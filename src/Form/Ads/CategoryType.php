<?php

namespace App\Form\Ads;

use App\Entity\Ads\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $category = $options['data'];
        if($category->getParent() === null){
            $builder
                ->add('name');
        }
        else{
            $builder
                ->add('name')
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
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
