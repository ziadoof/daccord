<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class,[
                'widget' => 'single_text',
                'format' => 'YYYY-mm-dd',
                'label'=>'Date',
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('time',TimeType::class,[
                'widget' => 'single_text',
                'label'=>'Time',
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('highway')
            ->add('mainPrice',IntegerType::class,[
                'label'=>'Price',
                'attr' => array('min' => '1','max'=>200)
            ])
            ->add('priceToArrival',IntegerType::class,[
                'label'=>'Price to arrival',
                'required'=>false,
                'attr' => array('min' => '1','max'=>200)

            ])
            ->add('description')

            ->add('mainDeparture', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=>'Departure',
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
            ->add('mainArrival', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=>'Arrival',
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
            ->add('stations', StationCollectionType::class, [
                'entry_type' => StationType::class,
                'entry_options' => ['label' => false,],
                'block_name' => 'station',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                /*'by_reference' => false,*/
                'label' => false,
                'attr' => array(
                    'class' => 'carpooling-form',
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
            'translation_domain'=> 'manual',
        ]);
    }


}
