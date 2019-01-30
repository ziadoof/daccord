<?php

namespace App\Form;

use App\Entity\Ad;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('imageOne', FileType::class, [ 'required' => false])
            ->add('imageTow', FileType::class, [ 'required' => false])
             ->add('imageThree',FileType::class, [ 'required' => false])
            ->add('price')
            ->add('donate')
            ->add('withDriver');
            /*->add('specification')*/

        $builder->add('category',EntityType::class, [
                    'required' => false,
                    'class' => Category::class,
                    'label' => 'Category',
                    'placeholder' => 'Choisir un Category',
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->andWhere('c.parent is null')
                            ->orderBy('c.id', 'ASC');
                    },
                    'choice_label' => 'name'
                 ]);
        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {

                $form = $event->getForm();
                $this->addSousField($form->getParent(), $form->getData());
            }
        );

        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();

                // @var $name Category
                $name= $data->getCategory();
                $form = $event->getForm();
                if ($name) {
                    // On récupère le département et la région
                    $sous = $name->getParent();
                    $category = $sous->getParent();
                    // On crée les 2 champs supplémentaires
                    $this->addSousField($form, $category);
                    $this->addCatoField($form, $sous);
                    // On set les données
                    $form->get('category')->setData($category);
                    $form->get('sous')->setData($sous);
                } else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->addSousField($form, null);
                    $this->addCatoField($form, null);
                }
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }

    /*
        * Rajout un champs department au formulaire
        * @param FormInterface $form
        * @param Region $region
        */
    private function addSousField(FormInterface $form, ?Category $parent)
    {
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'sous',
            EntityType::class,
            null,
            [
                'class'           => 'App\Entity\Category',
                'placeholder'     => $parent ? 'Sélectionnez votre Sous' : 'Sélectionnez votre Category',
                'mapped'          => false,
                'required'        => true,
                'auto_initialize' => false,
                'label' =>'Sous',
                'choices'         => $parent ? $parent->getChildren() : []
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->addCatoField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }

    private function addCatoField(FormInterface $form, ?Category $childe)
    {
       /* $form->add('name', EntityType::class, [
            'class'       => 'App\Entity\Category',
            'label' =>'Cato',
            'placeholder' => $childe ? 'Sélectionnez votre Cato' : 'Sélectionnez votre Sous',
            'choices'     => $childe ? $childe->getChildren() : []

        ]);*/
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'cato',
            EntityType::class,
            null,
            [
                'class'           => 'App\Entity\Category',
                'placeholder'     => $childe ? 'Sélectionnez votre Cato' : 'Sélectionnez votre Sous',
                'mapped'          => false,
                'required'        => true,
                'auto_initialize' => false,
                'label' =>'Cato',
                'choices'         => $childe ? $childe->getChildren() : []
            ]
        );
        $form->add($builder->getForm());
    }
}
