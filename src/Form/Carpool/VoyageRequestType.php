<?php

namespace App\Form\Carpool;

use App\Entity\Carpool\VoyageRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $voyageRequest = $options['data'];
        $voyage= $voyageRequest->getVoyage();
        $maxSeats = $voyage->getAvailableSeats($voyage);
        $builder
            ->add('description')
            ->add('numberOfSeats',IntegerType::class,[
                'attr' => array(
                    'min' => '1',
                    'max'=>$maxSeats,
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VoyageRequest::class,
        ]);
    }
}
