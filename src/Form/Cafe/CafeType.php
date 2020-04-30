<?php

namespace App\Form\Cafe;

use App\Entity\Cafe\Cafe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CafeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('duration', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'placeholder' => 'Select a period',
                'choices'   => array(
                    '30 Minutes' => 30,
                    '60 Minutes' => 60,
                    '90 Minutes' => 90,
                    '120 Minutes' => 120,
                ),
            ])
            ->add('type', ChoiceType::class, [
                'label' => false,
                'required' => true,
                'placeholder' => 'Select a type',
                'choices'   => array(
                    'Cafe' => 'Cafe',
                    'Promenade' => 'Promenade',
                    'Beer' => 'Beer',
                ),
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cafe::class,
            'translation_domain'=> 'manual',
        ]);
    }
}
