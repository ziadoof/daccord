<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Station;
use App\Entity\Location\City;
use phpDocumentor\Reflection\Types\Integer;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=>false,
                'attr'=>[
                    'autocomplete'=> 'off',
                    'placeholder'=>'City'
                ]
            ])
            ->add('place',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Place Eg : Gare, Hotel..'
                ]
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
            'data_class' => Station::class,
        ]);
    }
}
