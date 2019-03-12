<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 11/02/19
 * Time: 12:50
 */

namespace App\Form\EventListener;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Category;
use Symfony\Component\PropertyAccess\PropertyAccess;
class AddGeneralcategoryFieldSubscriber implements EventSubscriberInterface

{

    private $factory ;

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
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addCategoryForm($form, $generalcategory_id=null)
    {
        $formOptions = array(
            'class'         => Category::class,
            'mapped'        => false,
            'label'         => 'General Category',
            'placeholder' => 'Choisir un general Category',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->andWhere('c.parent is null')
                    ->orderBy('c.id', 'ASC');
            },
            'choice_label' => 'name',
            'attr'          => array(
                'class' => 'generalcategory_selector',
            ),
        );
        if ($generalcategory_id) {
            $formOptions['data'] = $generalcategory_id;
        }
        $form->add('generalcategory', EntityType::class, $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor = PropertyAccess::createPropertyAccessorBuilder()
            ->enableExceptionOnInvalidIndex()
            ->getPropertyAccessor();

        $category    = $accessor->getValue($data, $this->factory);
        $generalcategory_id = ($category) ? $category->getParent()->getParent() : null;
        $this->addCategoryForm($form, $generalcategory_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $this->addCategoryForm($form);
    }
}