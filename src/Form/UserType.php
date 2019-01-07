<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('firstname')
            ->add('lastname')
            ->add('emailStatus')
            ->add('postalCode')
            ->add('phoneNumber')
            ->add('phonNumberStatus')
            ->add('createdAt')
            ->add('gender')
            ->add('genderStatus')
            ->add('birthday')
            ->add('birthdayStatus')
            ->add('mapX')
            ->add('mapY')
            ->add('driver')
            ->add('car')
            ->add('color')
            ->add('profileImage')
            ->add('carImage')
            ->add('maxDistance')
            ->add('point')
            ->add('ville')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
