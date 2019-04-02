<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 26/03/19
 * Time: 12:57
 */

namespace App\Form;


use App\Entity\City;
use App\Entity\Department;
use App\Entity\Region;
use App\Entity\User;
use App\Form\EventListener\AddCategoryFieldSubscriber;
use App\Form\EventListener\AddGeneralcategoryFieldSubscriber;
use App\Form\EventListener\AddOspecificationFieldSubscriber;
use App\Model\AdModel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class AdSearchType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('region', EntityType::class, [
                'class'       => 'App\Entity\Region',
                'placeholder' => 'Sélectionnez votre région',
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
            ->addEventSubscriber(new AddGeneralcategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddCategoryFieldSubscriber($category))
            ->addEventSubscriber(new AddOspecificationFieldSubscriber($category, $entityManager));


        $builder
            ->add('price', TextType::class, ['required' => false])
            ->add('title', TextType::class, ['required' => false])
            ->add('donate', CheckboxType::class, ['required' => false])
            ->add('withDriver', CheckboxType::class, ['required' => false])
/*            ->add('ville', EntityType::class, ['class' => City::class])*/
/*            ->add('user', EntityType::class, ['class' => User::class])*/
            ->add('submit', SubmitType::class,['label'=>'Search','attr'=>['class'=>'mt-4 btn-info']])
        ;
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
                'placeholder'     => $region ? 'Sélectionnez votre département' : 'Sélectionnez votre région',
                'required'        => false,
                'auto_initialize' => false,
                'label' =>'Département',
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
            'label' =>'Ville',
            'required' => false,
            'placeholder' => $department ? 'Sélectionnez votre ville' : 'Sélectionnez votre département',
            'choices'     => $department ? $department->getCitys() : []

        ]);
    }

}