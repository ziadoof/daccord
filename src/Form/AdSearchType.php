<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:57
 */

namespace App\Form;


use App\Model\AdModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class AdSearchType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', TextType::class, ['required' => false])
            ->add('title', TextType::class, ['required' => false])
            ->add('sSize', TextType::class, ['required' => false])
            ->add('manufacturingYear', TextType::class, ['required' => false])
            ->add('submit', SubmitType::class,['label'=>'Search','attr'=>['class'=>'mt-4 btn-info']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'App\Model\AdModel'
        ]);
    }

}