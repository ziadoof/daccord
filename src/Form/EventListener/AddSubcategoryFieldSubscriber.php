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

class AddSubcategoryFieldSubscriber implements EventSubscriberInterface

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
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addSubcategoryForm($form, $generalcategory_id, $subcategory = null)
    {
        $formOptions = array(
            'class'         =>Category::class,
            'label'         => 'Sub category',
            'mapped'        => false,
            'placeholder'     => $generalcategory_id ? 'Sélectionnez votre Sub category' : 'Sélectionnez votre General category',
            'attr'          => array(
                'class' => 'subcategory_selector',
            ),

            'query_builder' => function (EntityRepository $repository) use ($generalcategory_id) {
                $qb = $repository->createQueryBuilder('c')
                    ->where('c.parent = :generalcategory_id')
                    ->setParameter('generalcategory_id', $generalcategory_id)
                ;
                return $qb;
            }
        );
        if ($subcategory) {
            $formOptions['data'] = $subcategory;
        }
        $form->add('subcategory',EntityType::class, $formOptions);
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
        $category        = $accessor->getValue($data, $this->factory);
        $subcategory    = ($category) ? $category->getParent() : null;
        $generalcategory_id  = ($subcategory) ? $subcategory->getParent()->getId() : null;
        $this->addSubcategoryForm($form, $generalcategory_id, $subcategory);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
        $generalcategory_id = array_key_exists('generalcategory', $data) ? $data['generalcategory'] : null;
        $this->addSubcategoryForm($form, $generalcategory_id);
    }
}