<?php

namespace App\Form;

use App\Entity\Ospecification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OspecificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('label')
            ->add('type')
            ->add('textOptions')
            ->add('numericOptions')
            ->add('typeOfChoice')
            ->add('minOption')
            ->add('maxOption')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ospecification::class,
        ]);
    }
}
