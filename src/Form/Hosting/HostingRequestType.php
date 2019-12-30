<?php

namespace App\Form\Hosting;

use App\Entity\Hosting\HostingRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HostingRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate',DateType::class,[
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'label'=>'Arrival',
                'attr'=>[
                    'autocomplete'=>"off",
                    'readonly'=>"readonly",
                ]
            ])
            ->add('endDate',DateType::class,[
                'widget' => 'single_text',
                'label'=>'Departure',
                'format' => 'dd/MM/yyyy',
                'attr'=>[
                    'autocomplete'=>"off",
                    'readonly'=>"readonly",
                ]
            ])
            ->add('numberOfPersons', ChoiceType::class, [
                'placeholder' => 'Number of persons',
                'required'=>true,
                'label'=>false,
                'choices'   => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                ),
            ])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HostingRequest::class,
        ]);
    }
}
