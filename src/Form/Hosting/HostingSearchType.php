<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:57
 */

namespace App\Form\Hosting;


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

class HostingSearchType extends  AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $languages = ['English','German','Italian','Spanish','Ukrainian','Polish','Dutch','Turkish','Romanian','Arabic','Austro-Bavarian','Russian','Hungarian','Greek','Czech','Portuguese','Swedish','Bulgarian','Albanian','Slovak','Chinese','Japanese','Indian','Vietnamese','Persian','Indonesian'];
        $yourLanguage =[];
        foreach ($languages as $language){
            $yourLanguage[$language]=$language;
        }
        $builder
            ->add('numberOfPersons', ChoiceType::class, [
                'placeholder' => 'Number of persons',
                'label' => false,
                'required'=>true,
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
                'required'=>false,
                'choices'   => array(
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                ),
            ]);
        $builder->add('languages',ChoiceType::class,[
                    'placeholder' => 'Languages you can speak',
                    'label' => false,
                    'multiple'=> true,
                    'required'=>false,
                    'choices'   => $yourLanguage
                    ])
            ->add('animal',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('child',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('handicapped',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('food',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('conversation',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('cityTour',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('videoGame',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('movie',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('television',CheckboxType::class,[
                'required'=>false,
            ])
            ->add('music',CheckboxType::class,[
                'required'=>false,
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
                $city = $data->getVille();
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
            'data_class' => 'App\Model\HostingModel'
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
        $form->add('ville', ChoiceType::class, [

            'label' => false,
            'required' => false,
            'expanded' => false,
            'multiple'=> true,
            'choices'     => $choice,
        ]);
    }

}