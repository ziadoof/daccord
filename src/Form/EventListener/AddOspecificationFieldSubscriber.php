<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 11/02/19
 * Time: 12:50
 */

namespace App\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use App\Entity\Category;
use App\Entity\City;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;





class AddOspecificationFieldSubscriber implements EventSubscriberInterface

{

    private $factory;
    private $entityManager;

    public function __construct($factory, $entityManager)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;

    }


    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addOspecificationForm($form, $category)
    {

        if ($category!== null) {
            $specifications = $category->getOspecifications();
            foreach ($specifications as $specification){
                $type = $specification->getType();
                $name = $specification->getName();
                $label =  $specification->getLabel();
                if($type === 'TextType'){
                    $options = array('label' => $label, 'required' => false,);
                    $form->add($name, TextType::class, $options);
                }
                elseif($type === 'CheckboxType'){
                    $options = array('label' => $label, 'required' => false,);
                    $form->add($name, CheckboxType::class, $options);
                }
                elseif($type === 'ColorType'){
                    $options = array('label' => $label, 'required' => false);
                    $form->add($name, TextType::class, $options);
                }
                elseif($type === 'EntityType'){
                    $options = array('label' => $label, 'required' => false,'class' => City::class);
                    $form->add($name, AutocompleteType::class, $options);
                }
                elseif($type === 'DateType'){
                    $options = array('label' => $label, 'required' => false,'widget' => 'single_text',);
                    $form->add($name, DateType::class, $options);
                }
                elseif ($type === 'ChoiceType'){
                    $typeOfChoice = $specification->getTypeOfChoice();
                    if($typeOfChoice === 'TextOptions'){
                        $choiceOptions = [];
                        $textOptions = $specification->getTextOptions();
                        foreach ($textOptions as $textOption){
                            $choiceOptions[$textOption]= $textOption;
                        }
                        if($name === 'languages'){
                            $options = array('label' => $label, 'required' => false,
                                'choices' => $choiceOptions,
                                'placeholder' => 'Select'.' '.$label,
                                /*'expanded'  => true,*/
                                'multiple'  => true,
                            );
                        }
                        else{
                            $options = array('label' => $label, 'required' => false,
                                'choices' => $choiceOptions,
                                'placeholder' => 'Select'.' '.$label
                            );
                        }

                        $form->add($name, ChoiceType::class, $options);
                    }
                    elseif ($typeOfChoice === 'NumericOptions'){
                        $choiceOptions = [];
                        $numericOptions = $specification->getNumericOptions();
                        foreach ($numericOptions as $numericOption){
                            $choiceOptions[$numericOption]= $numericOption;
                        }
                        $options = array('label' => $label, 'required' => false,
                            'choices' => $choiceOptions,
                            'placeholder' => 'Select'.' '.$label
                        );
                        $form->add($name, ChoiceType::class, $options);
                    }
                    elseif ($typeOfChoice === 'SequentialNumericOptions'){
                        $min = $specification->getMinOption();
                        $max = $specification->getMaxOption();
                        $choiceOptions = [];
                            for ($i=$min;$i<=$max;$i++){
                                $choiceOptions [$i]= $i;
                            }
                        $options = array('label' => $label, 'required' => false,
                            'choices' => $choiceOptions,
                            'placeholder' => 'Select'.' '.$label
                        );
                        $form->add($name, ChoiceType::class, $options);
                    }
                }
            }
        }
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor    = PropertyAccess::createPropertyAccessor();
        $category        = $accessor->getValue($data, $this->factory);
        $category_id = ($category) ? $category->getId() : null;
        $this->addOspecificationForm($form, $category_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $category_id = array_key_exists('category', $data) ? $data['category'] : null;
        $category = ($category_id) ? $this->getCategory($category_id):null;
        $this->addOspecificationForm($form, $category);
    }

    public function getCategory ( $category_id){
        $em = $this->entityManager;
        return $em->getRepository(Category::class)->findCategoryById($category_id);
    }
}