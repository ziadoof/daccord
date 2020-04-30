<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageFirstType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>'Date',
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('time',TimeType::class,[
                'widget' => 'single_text',
                'label'=>'Time',
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
            ->add('placeMainDeparture',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Place Eg : Gare, Hotel..'
                ]
            ])
            ->add('placeMainArrival',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Place Eg : Gare, Hotel..'
                ]
            ])
            ->add('mainDeparture', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=>false,
                'attr'=>[
                    'autocomplete'=> 'off',
                    'placeholder'=>'Departure'
                ]
            ])
            ->add('mainArrival', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=>false,
                'attr'=>[
                    'autocomplete'=> 'off',
                    'placeholder'=>'Arrival'

                ]
            ])
            ->add('stations', StationCollectionType::class, [
                'entry_type' => StationType::class,
                'entry_options' => ['label' => false],
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
            ->add('duration',HiddenType::class,[
            ])
            ->add('distance',HiddenType::class,[
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
