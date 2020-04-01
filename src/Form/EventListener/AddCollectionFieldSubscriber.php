<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 11/02/19
 * Time: 12:50
 */

namespace App\Form\EventListener;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddCollectionFieldSubscriber implements EventSubscriberInterface

{

    private $factory;

    public function __construct($factory)
    {
        $this->factory = $factory;
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
    public static function getSubscribedEvents(): array
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addCollectionForm($form, $choice): void
    {

        if ($choice!== null) {
            if($choice === 'TextOptions'){
                $options = array(
                );
                $form->add('textOptions',TextType::class,$options);
            }
            elseif ($choice === 'NumericOptions'){
                $options = array(
                );
                $form->add('numericOptions',TextType::class,$options);
            }
            else{
                $options = array(
                );

                $form->add('minOption',IntegerType::class,$options);
                $form->add('maxOption',IntegerType::class,$options);
            }

        }
    }

    public function preSetData(FormEvent $event): void
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor    = PropertyAccess::createPropertyAccessor();
        $typeOfChoice        = $accessor->getValue($data, $this->factory);
        $choice = ($typeOfChoice) ?: null;
        $this->addCollectionForm($form, $choice);
    }

    public function preSubmit(FormEvent $event): void
    {
        $data = $event->getData();
        $form = $event->getForm();
        $choice = $data['typeOfChoice'] ?? null;
        $this->addCollectionForm($form, $choice);
    }

}