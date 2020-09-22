<?php

namespace App\Form\Meetup;

use App\Entity\Location\City;
use App\Entity\Location\Department;
use App\Entity\Location\Region;
use App\Entity\Meetup\Meetup;
use App\Form\PhotoType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class MeetupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxParticipants', ChoiceType::class, [
                'required'=>true,
                'choices'   => array(
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                    '13' => 13,
                    '14' => 14,
                ),
            ])
            ->add('place')
            ->add('address')
            ->add('title',TextType::class,[
                'required'=>true,
            ])
            ->add('startAt',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
                'label'=>'Start',
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('endAt',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm',
                'label'=>'End',
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('type', ChoiceType::class, [
                'required'=>true,
                'placeholder' => 'Select type of meetup',
                'choices'   => array(
                    'Sport'        => 'Sport',
                    'Dance'        => 'Dance',
                    'Visit'        => 'Visit',
                    'City tour'    => 'City tour',
                    'Playing cards'=> 'Playing cards' ,
                    'Cup'          => 'Cup',
                    'Hang around'  => 'Hang around',
                    'Bicycle'      => 'Bicycle',
                    'Picnic'       => 'Picnic',
                    'Museum'       => 'Museum',
                    'Cinema'       => 'Cinema',
                    'Cooking'      => 'Cooking',
                    'Music'        => 'Music',
                    'Movies'       => 'Movies',
                    'Informatics'  => 'Informatics',
                    'Lecture'      => 'Lecture',
                    'Travel'       => 'Travel',
                    'Other'       => 'Other',
                ),
            ])
            ->add('image',PhotoType::class, array(
                'data_class' => null,
                'label' => false,
                'required'=> false,
                'attr' => array(
                    'meetup'=> true,
                    'onchange'=>'window.viewMeetupImage(this);'
                )
            ))
            ->add('description',TextareaType::class,[
                'required' =>true,
                'constraints' => [new Length(['min' => 50])],
                'attr' => array('rows' => '10','cols' => '10')
            ])
        ;

        $builder
            ->add('city', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'new-password',
                ]
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meetup::class,
            'translation_domain'=> 'manual',
        ]);
    }
}
