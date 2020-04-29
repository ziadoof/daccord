<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Carpool;
use App\Form\PhotoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarpoolType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carBrand')
            ->add('carColor')
            ->add('numberOfPassengers', ChoiceType::class, [
                'placeholder' => 'Number of passengers',
                'label' => false,
                'choices'   => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                ),
            ])
            ->add('bag')
            ->add('animal')
            ->add('baby')
            ->add('bankCard')
            ->add('conversation')
            ->add('music')
            ->add('carImage',PhotoType::class, array(
                'data_class' => null,
                'label' => false,
                'required'=> false,
                'attr' => array(
                    'carpool'=> true,
                    'onchange'=>'window.viewCarpoolImage(this);'
                )
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carpool::class,
            'translation_domain'=> 'manual',
        ]);
    }
}
