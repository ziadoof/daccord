<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageSecondType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('highway')
            ->add('numberOfPlaces',IntegerType::class,[
                'label'=>false,
                'attr' => array(
                    'min' => '1',
                    'max'=>5,
                    'placeholder'=>'Number of places'
                )
            ])
            ->add('mainPrice',IntegerType::class,[
                'label'=>false,
                'attr' => array(
                    'min' => '1',
                    'max'=>200,
                    'placeholder'=>'Price'
                    )
            ])
            ->add('description',TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'Writing more details about the trip will increase the chance of more passengers riding with you..'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }


}
