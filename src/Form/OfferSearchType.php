<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:57
 */

namespace App\Form;


use App\Entity\Department;
use App\Entity\Region;
use App\Form\EventListener\AddSearchCategoryFieldSubscriber;
use App\Form\EventListener\AddSearchGeneralcategoryFieldSubscriber;
use App\Form\EventListener\AddSearchSpecificationFieldSubscriber;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class OfferSearchType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('region', EntityType::class, [
                'class'       => 'App\Entity\Region',
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

        $category = 'category';
        $entityManager = $options['entity_manager'];


        $builder
            ->addEventSubscriber(new AddSearchGeneralcategoryFieldSubscriber($category,'Offer'))
            ->addEventSubscriber(new AddSearchCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddSearchSpecificationFieldSubscriber($category, $entityManager, 'SearchOffer'));
        $builder
            ->add('title', TextType::class, ['required' => false, 'label'=> false, 'attr' => array(
                'placeholder' => 'What are you looking for....',
            )]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'App\Model\AdModel'
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
                'class'           => 'App\Entity\Department',
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