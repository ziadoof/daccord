<?php

namespace App\Form\User;

use App\Form\PhotoType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use App\Entity\Location\Region;
use App\Entity\Location\Department;
use App\Entity\Location\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use App\Entity\User;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityRepository;


class ProfileType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First name',
                'translation_domain'=> 'manual',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last name',
                'translation_domain'=> 'manual',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'translation_domain'=> 'manual',
                'disabled'=> true
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone number',
                'translation_domain'=> 'manual',
                 'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Sex',
                'translation_domain'=> 'manual',
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
                'expanded' => true,
                'required' => false,
            ])
            ->add('birthday', DateTimeType::class, [
                'required' => false,
                'label' => 'Birthday',
                'translation_domain'=> 'manual',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'html5' => true,
                'attr' => [
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                    ]
            ])
            ->add('genderStatus', CheckboxType::class, [
                'required' => false,
                'translation_domain'=> 'manual',
                'label'    => 'Visible',
            ])
            ->add('birthdayStatus', CheckboxType::class, [
                'required' => false,
                'translation_domain'=> 'manual',
                'label'    => 'Visible',
            ])
            ->add('phonNumberStatus', CheckboxType::class, [
                'required' => false,
                'translation_domain'=> 'manual',
                'label'    => 'Visible',
            ])
            ->add('emailStatus', CheckboxType::class, [
                'required' => false,
                'translation_domain'=> 'manual',
                'label'    => 'Visible',
            ])
            ->add('profileImage', PhotoType::class, [
                'data_class' => null,
                'label' => false,
                'required'=> false,
                'attr' => array(
                    'new_form' => false,
                    'profileImage'=> true,
                    'onchange'=>'window.viewProfileImage(this);'
                )
            ])
            ->add('maxDistance', ChoiceType::class, [
                'label' => 'Max distance',
                'choices' => [
                    '5 KM' => 5,
                    '10 KM' => 10,
                    '15 KM' => 15,
                    '20 KM' => 20,
                    '25 KM' => 25,
                    '30 KM' => 30,
                    '35 KM' => 35,
                    '40 KM' => 40,
                    '45 KM' => 45,
                    '50 KM' => 50,
                    '60 KM' => 60,
                    '70 KM' => 70,
                    '80 KM' => 80,
                    '90 KM' => 90,
                    '100 KM' => 100,
                    '120 KM' => 120,
                    '140 KM' => 140,
                    '150 KM' => 150,
                ]
            ]);
    }

    /**
     * {@inheritdoc}
     */

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
