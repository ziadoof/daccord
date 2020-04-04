<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:57
 */

namespace App\Form\Meetup;


use App\Entity\Location\Department;
use App\Entity\Location\Region;
use App\Form\EventListener\AddSearchCategoryFieldSubscriber;
use App\Form\EventListener\AddSearchGeneralcategoryFieldSubscriber;
use App\Form\EventListener\AddSearchSpecificationFieldSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class MeetupSearchType extends  AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('maxParticipants', ChoiceType::class, [
                'placeholder' => 'Max Number of participants',
                'label' => false,
                'required'=>false,
                'choices'   => array(
                    '1' => 1,
                    '2' => 2,
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
                ),
            ])
            ->add('title',TextType::class,[
                'required'=>false,
                'label' => false,
                'attr'=>[
                    'placeholder' => 'Search by title'
                ]

            ])
            ->add('type',ChoiceType::class,[
                'placeholder' => 'Select type of meetup',
                'label' => false,
                'required' => true,
                'choices'     =>array(
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
            ]);

        $builder
            ->add('region', EntityType::class, [
                'class'       => 'App\Entity\Location\Region',
                'placeholder' => 'Région',
                'label' => false,
                'required'    => true
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
                $city = $data->getCity();
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'App\Model\MeetupModel'
        ]);
        $resolver->setRequired('entity_manager');
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
                'class'           => 'App\Entity\Location\Department',
                'placeholder'     => $region ? 'Département' : 'Select Region',
                'required'        => false,
                'auto_initialize' => false,
                'label' => false,
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

    /**
     * @param FormInterface $form
     * @param Department|null $department
     */
    private function addVilleField(FormInterface $form, ?Department $department)
    {
        $choice =[];
        $citys =[];
        if($department){
            $citys = $department->getCitys();
        }
        foreach ($citys as $city){
            $choice[$city->getName().' '.$city->getZipCode()]= $city;
        }
        $form->add('city', ChoiceType::class, [

            'label' => false,
            'required' => false,
            'expanded' => false,
            'multiple'=> true,
            'choices'     => $choice,
        ]);
    }

}