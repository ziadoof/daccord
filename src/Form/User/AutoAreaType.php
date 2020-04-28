<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use function Sodium\add;

class AutoAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', AutocompleteType::class, [
                'class' => City::class,
                'attr'=>[
                    'placeholder'=>'Insert at least 2 character OR Zip code'
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain'=> 'manual',
        ]);
    }


}
