<?php

namespace App\Form\Hosting;

use App\Entity\Hosting\Hosting;
use App\Form\PhotoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HostingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $age =[];
        for ($i=18;$i<=80;$i++){
            $age[$i.' Years']=$i;
        }
        $languages = ['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian'];
        $yourLanguage =[];
        foreach ($languages as $language){
            $yourLanguage[$language]=$language;
        }
        $builder
            ->add('numberOfPersons', ChoiceType::class, [
                'placeholder' => 'Number of persons',
                'label' => false,
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
            ->add('numberOfDays', ChoiceType::class, [
                'placeholder' => 'Max number of days',
                'label' => false,
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
            ->add('image',PhotoType::class, array(
                'data_class' => null,
                'label' => false,
                'required'=> false,
                'attr' => array(
                    'hosting'=> true,
                    'onchange'=>'window.viewHostingImage(this);'
                )
            ))
            ->add('languages', ChoiceType::class, [
                'placeholder' => 'Languages you can speak',
                'label' => false,
                'multiple'=> true,
                'choices'   => $yourLanguage,
            ])
            ->add('age', ChoiceType::class, [
                'placeholder' => 'Your age',
                'label' => false,
                'choices'   => $age,
            ])
            ->add('sex', ChoiceType::class, [
                'placeholder' => 'Your sex',
                'label' => false,
                'choices'   => array(
                    'Male' => 'Male',
                    'Female' => 'Female'
                ),
            ])
            ->add('aboutMe')
            ->add('hostingFor')
            ->add('animal')
            ->add('child')
            ->add('handicapped')
            ->add('food')
            ->add('conversation')
            ->add('cityTour')
            ->add('videoGame')
            ->add('movie')
            ->add('television')
            ->add('music')
            ->add('active', CheckboxType::class, [
                'label'    => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Hosting::class,
        ]);
    }
}
