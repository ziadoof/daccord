<?php


namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,[
                'required' =>true,
            ])
            ->add('lastname', TextType::class,[
                'required' =>true,
            ])
            ->add('email')
            ->add('plainPassword', TextType::class)
            ->add('admin', CheckboxType::class,[
                'mapped'=>false,
                'required' =>false,
            ])
            ->add('city', AutocompleteType::class, [
                'class' => City::class,
                'required' =>true,
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}