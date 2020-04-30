<?php

namespace App\Form\Hosting;

use App\Entity\Hosting\HostingRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HostingRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>'Arrival',
                'attr'=>[
                    'autocomplete'=>"off",
                    'readonly'=>"readonly",
                ]
            ])
            ->add('endDate',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label'=>'Departure',
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
            'translation_domain'=> 'manual',
        ]);
    }
}
