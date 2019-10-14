<?php

namespace App\Form;

use App\Entity\Driver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('carImage',FileType::class, array(
                'data_class' => null,
                'label'=>false
            ))
            ->add('maxDistance', ChoiceType::class, [
                'placeholder' => '10 Km',
                'choices'   => array(
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
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Driver::class,
        ]);
    }
}
