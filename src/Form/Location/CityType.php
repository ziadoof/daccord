<?php

namespace App\Form\Location;


use App\Entity\Location\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('inseeCode')
            ->add('zipCode')
            ->add('name')
            ->add('slug')
            ->add('gpsLat')
            ->add('gpsLng')
            ->add('department')*/

                ->add('name', AutocompleteType::class, ['class' => 'App:City']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
