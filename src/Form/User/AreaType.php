<?php

namespace App\Form\User;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Location\Region;
use App\Entity\Location\Department;
use App\Entity\Location\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityRepository;


class AreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('region', EntityType::class, [
                'class'       => Region::class,
                'placeholder' => 'Select region',
                'mapped'      => false,
                'required'    => false
            ]);

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {

                $form = $event->getForm();
                $this->addDepartmentField($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();

                // @var $city City
                if($data){
                    $city = $data->getCity();
                }
                else{
                    $city = null;
                }
                $form = $event->getForm();
                if ($city) {
                    // On récupère le département et la région
                    $department = $city->getDepartment();
                    $region = $department->getRegion();
                    // On crée les 2 champs supplémentaires
                    $this->addDepartmentField($form, $region);
                    $this->addVilleField($form, $department);
                    // On set les données
                    $form->get('region')->setData($region);
                    $form->get('department')->setData($department);
                } else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->addDepartmentField($form, null);
                    $this->addVilleField($form, null);
                }
            }
        );

    }

    /*
     * Rajout un champs department au formulaire
     * @param FormInterface $form
     * @param Region $region
     */
    private function addDepartmentField(FormInterface $form, ?Region $region)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'department',
            EntityType::class,
            null,
            [
                'class'           => Department::class,
                'placeholder'     => $region ? 'Select your department' : 'Select your region',
                'translation_domain'=> 'manual',
                'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
                'label' =>'Department',
                'choices'         => $region ? $region->getDepartments() : []
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addVilleField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }

    private function addVilleField(FormInterface $form, ?Department $department)
    {
        $form->add('city', EntityType::class, [
            'class'       => City::class,
            'label' =>'Ville',
            'translation_domain'=> 'manual',
            'placeholder' => $department ? 'Select city' : 'Select department',
            'choices'     => $department ? $department->getCitys() : []

        ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain'=> 'manual',
        ]);
    }


}
