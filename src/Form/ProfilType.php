<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use App\Entity\Regions;
use App\Entity\Departments;
use App\Entity\Cities;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProfilType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => array('rows' => '4', 'cols' => '10'),
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email de contact',
                'disabled'=> true
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => array('rows' => '4', 'cols' => '10'),
                'required' => true,
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'attr' => array('rows' => '4', 'cols' => '10'),
                'required' => true,
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'nomeru de portable',
                'attr' => array('rows' => '4', 'cols' => '10'),
                 'required' => false,
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'gender',
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female',
                ],
                'expanded' => true,
                'required' => false,

            ])
            ->add('birthday', DateType::class, [
                'required' => false,
                'label' => 'Birthday',
                'widget' => 'single_text',
                'html5' => true,
                'attr' => ['placeholder' => 'AAAA-MM-JJ']
            ])
            ->add('genderStatus', CheckboxType::class, [
                'required' => false,
                'label'    => 'Votre gender est disponible au public ?',
            ])
            ->add('birthdayStatus', CheckboxType::class, [
                'required' => false,
                'label'    => 'Votre birthday est disponible au public ?',
            ])
            ->add('phonNumberStatus', CheckboxType::class, [
                'required' => false,
                'label'    => 'Votre phon number est disponible au public ?',
            ])
            ->add('emailStatus', CheckboxType::class, [
                'required' => false,
                'label'    => 'Votre email est disponible au public ?',
            ])
            ->add('car', TextType::class, [
                'label' => 'voiteur',
                'attr' => array('rows' => '4', 'cols' => '10'),
                 'required' => false,
            ])
            ->add('color', ColorType::class, [
                'label' => 'Couleur',
                'attr' => [
                    'class' => 'picker-size',
                ],
                 'required' => false,
            ])
            ->add('maxDistance', TextType::class, [
                'label' => 'Max distance',
                'attr' => array('rows' => '4', 'cols' => '10')
            ])
            ->add('carImage', TextType::class, [
                'label' => 'image de voiteur',
                'required' => false,
            ])
            ->add('department', EntityType::class, [
                'required' => true,
                'class' => Departments::class,
                'label' => 'Département',
                'placeholder' => 'Choisir un département',
                'choice_label' => function ($name) {
                    return $name->getName();
                }])
            ->add('regions', EntityType::class, [
                'required' => true,
                'class' => Regions::class,
                'label' => 'Region',
                'placeholder' => 'Choisir un Region',
                'choice_label' => function ($name) {
                    return $name->getName();
                }]);

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
