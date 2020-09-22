<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Form\PhotoType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DriverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('carBrand')
            ->add('carColor')
            ->add('carImage',PhotoType::class, array(
                'data_class' => null,
                'label' => false,
                'required'=> false,
                'attr' => array(
                    'driverImage'=> true,
                    'onchange'=>'window.viewCarImage(this);'
                )
            ))
            ->add('maxDistance', ChoiceType::class, [
                'placeholder' => 'Select max distance',
                'choices'   => array(
                    '10 Km' => 10,
                    '20 Km' => 20,
                    '30 Km' => 30,
                    '40 Km' => 40,
                    '50 Km' => 50,
                    '75 Km' => 75,
                    '100 Km' => 100,
                    '125 Km' => 125,
                    '150 Km' => 150
                ),
            ])
            ->add('active', CheckboxType::class, [
                'label'    => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
            'translation_domain'=> 'manual',
        ]);
    }
}
