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
use App\Entity\Region;
use App\Entity\Department;
use App\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use App\Entity\User;
use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityRepository;


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
            ]);
        $builder
            ->add('region', EntityType::class, [
                'class'       => 'App\Entity\Region',
                'placeholder' => 'Sélectionnez votre région',
                'mapped'      => false,
                'required'    => false,
            ]);

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
               /* $this->addDepartmentField($form->getParent(), $form->getData());*/
                $form->getParent()->add('department',EntityType::class,[
                    'class' => 'App\Entity\Department',
                    'placeholder'=>'Select departement',
                    'mapped'=> false,
                    'required'=> false,
                    'choices'=> $form->getData()->getDepartments()
                ]);

            }
        );

/*       $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();*/

                 /* @var $ville City */
         /*       $ville = $data->getVille();
                $form = $event->getForm();
                if ($ville) {
                    // On récupère le département et la région
                    $department = $ville->getDepartment();
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
        );*/

    }

    /*
     * Rajout un champs department au formulaire
     * @param FormInterface $form
     * @param Regions $region
     */
    private function addDepartmentField(FormInterface $form, ?Region $region)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'department',
            EntityType::class,
            null,
            [
                'class'           => 'App\Entity\Department',
                'placeholder'     => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'mapped'          => false,
                'required'        => false,
                'auto_initialize' => false,
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
        $form->add('ville', EntityType::class, [
            'class'       => 'App\Entity\City',
            'placeholder' => $department ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices'     => $department ? $department->getCitys() : []

        ]);

      /*  $builder->add('department', EntityType::class, [
                'required' => false,
                'class' => Departments::class,
                'label' => 'Département',
                'placeholder' => 'Choisir un département',
                'choice_label' => function ($name) {
                    return $name->getName();
                }])

            ->add('ville', EntityType::class, [
                'required' => false,
                'class' => Cities::class,
                'label' => 'Ville',
                'placeholder' => 'Choisir un Ville',
                'choice_label' => function ($name) {
                    return $name->getName();
                }]);*/

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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
