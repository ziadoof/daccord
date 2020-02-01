<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageSearchType extends AbstractType
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
            ->add('highway',CheckboxType::class,[
                'required'=> false,
            ])
            /*->add('departure', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
            ->add('arrival', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'App\Model\VoyageModel'
        ]);
        $resolver->setRequired('entity_manager');
    }
}
