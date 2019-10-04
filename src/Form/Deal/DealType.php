<?php

namespace App\Form\Deal;

use App\Entity\Deal\Deal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('suggestionDate')
            ->add('offerUserStatus')
            ->add('demandUserStatus')
            ->add('driverStatus')
            ->add('offerUserDate')
            ->add('demandUserDate')
            ->add('driverDate')
            ->add('offerUser')
            ->add('demandUser')
            ->add('category')
            ->add('offer')
            ->add('demand')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Deal::class,
        ]);
    }
}
