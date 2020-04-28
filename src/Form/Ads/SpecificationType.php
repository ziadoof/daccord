<?php

namespace App\Form\Ads;

use App\Entity\Ads\Specification;
use App\Form\EventListener\AddCollectionFieldSubscriber;
use App\Repository\Ads\SpecificationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecificationType extends AbstractType
{

    private $names;
    public function __construct(SpecificationRepository $repository)
    {
        $this->names = $repository->findUniqueNames();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', ChoiceType::class,[
                'label' => 'Name',
                'placeholder' => 'Select specification',
                'translation_domain'=> 'manual',
                'choices' => $this->names,
            ]);

        $builder->get('name')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $name = $event->getForm()->getData();
                $this->creatTypeField($event->getForm()->getParent(), $name);
            }
        );
        $builder->addEventListener(
            FormEvents::POST_SET_DATA,
            function (FormEvent $event) {
                $data = $event->getData();
                $form = $event->getForm();

                // @var $name
                // @var $type
                $name = $data ? $data->getName():null;
                $type = $data ? $data->getType(): null;
                if ($name) {
                    // On récupère le département et la région

                    // On crée les 2 champs supplémentaires
                    $this->creatTypeField($form, $name);
                    // On set les données
                    $form->get('name')->setData($name);
                }
                if($type){
                    $this->createTypeOfChoiceField($form, $type);
                    $form->get('type')->setData($type);
                }
                else {
                    // On crée les 2 champs en les laissant vide (champs utilisé pour le JavaScript)
                    $this->creatTypeField($form, null);
                    $this->createTypeOfChoiceField($form, null);

                }
            }
        );
        $typeOfChoice = 'typeOfChoice';
        $builder->addEventSubscriber(new AddCollectionFieldSubscriber($typeOfChoice));

    }

    private function creatTypeField(FormInterface $form, string $name=null): void
    {
        $types = null === $name ? [] : $this->getSpecificationType($name);
        $placeholder = null === $name ? 'Select specification':'Select type';
        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'type',
            ChoiceType::class,
            null,
            [
                'placeholder'     => $placeholder,
                'required'        => false,
                'auto_initialize' => false,
                'label' => 'Type',
                'choices'         => $types
            ]
        );
        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $this->createTypeOfChoiceField($form->getParent(), $form->getData());
            }
        );
        $form->add($builder->getForm());
    }

    private function createTypeOfChoiceField(FormInterface $form, string $type=null): void
    {
        $typeOfChoice = null === $type ? [] : $this->getTypeOfChoice($type);
        $placeholder = $type === 'ChoiceType' ? 'Select choice':'Select type';
        $status = $type !== 'ChoiceType';

        $builder = $form->getConfig()->getFormFactory()->createNamedBuilder(
            'typeOfChoice',
            ChoiceType::class,
            null,
            [
                'placeholder'     => $placeholder,
                'required'        => false,
                'auto_initialize' => false,
                'label' => 'Type of choice',
                'disabled' => $status,
                'choices'         => $typeOfChoice,
                'attr'=>array(
                    'class'=>'typeOfChoice_selector'
                )
            ]
        );

        $form->add($builder->getForm());
    }

    public function getSpecificationType(string $specification): array
    {

        $boolean = ['hdmi', 'cdRoom', 'wifi', 'usb', 'threeInOne', 'accessories', 'withFreezer', 'electricHead',
            'withOven', 'covered', 'withFurniture', 'withGarden', 'withVerandah', 'withElevator','donate'];
        $array =['languages'];
        $entity = ['city'];
        $date = ['dateOfEvent'];
        $integer = ['accuracy', 'weight', 'caliber', 'maxCaliber', 'minCaliber', 'number', 'width', 'height',
            'numberOfPersson', 'length', 'numberOfDrawer', 'numberOfStaging', 'numberOfHead', 'ability', 'floor',
            'area', 'minArea', 'maxArea', 'numberOfRooms', 'minNumberOfRooms', 'maxNumberOfRooms', 'numberOfFloors','experience',
            'levelOfStudent', 'generalSituation', 'paperSize', 'classEnergie', 'ges', 'salary', 'durationOfLesson', 'maxDistance',
            'manufacturingYear', 'maxManufacturingYear', 'minManufacturingYear', 'numberOfPassengers', 'numberOfDoors', 'kilometer',
            'maxKilometer', 'minKilometer', 'ram', 'screenSizeCm', 'screenSizeInch', 'capacity', 'minCapacity', 'maxCapacity','age',
            'iSize','price'];

        $string = ['sSize', 'acitvityArea', 'workHours', 'typeOfContract', 'levelOfStudy', 'language', 'typeOfTranslation', 'material',
            'placeOfLesson', 'brand', 'color', 'fuelType', 'model', 'changeGear', 'manufactureCompany', 'printingType', 'printingColor',
            'analogDigital', 'animalSpecies', 'dvdCd', 'originCountry', 'coverMaterial', 'shape', 'heating', 'heatingType', 'eventType',
            'subjectName', 'processor','mission','theType','secondLanguage'];

        if(in_array($specification,$boolean,true)){
            return ['CheckboxType'=>'CheckboxType'];
        }
        if(in_array($specification,$array,true)){
            return ['ChoiceType'=>'ChoiceType'];
        }
        if(in_array($specification,$entity,true)){
            return ['EntityType'=>'EntityType'];
        }
        if(in_array($specification,$date,true)){
            return ['DateType'=>'DateType'];
        }
        if(in_array($specification,$integer,true)){
            return ['TextType'=>'TextType','ChoiceType'=>'ChoiceType'];
        }
        if(in_array($specification,$string,true)){
            return ['TextType'=>'TextType','ChoiceType'=>'ChoiceType'];
        }
        return [];
    }

    public  function getTypeOfChoice(string $name): array
    {
        if ($name === 'ChoiceType'){
            return ['TextOptions'=>'TextOptions','NumericOptions'=>'NumericOptions','SequentialNumericOptions'=>'SequentialNumericOptions'];
        }
        return [];
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => false,
        ]);
    }


}
