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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\PropertyAccess\PropertyAccess;
use App\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AddSpecificationFieldSubscriber implements EventSubscriberInterface

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

    private function addSpecificationForm($form, $category)
    {
        $formToshiba = array('label' => 'Mission', 'required' => false,);
        $formHp = array('label' => 'withfrizer', 'required' => false,
        );
        if ($category!== null) {
            $name = $category->getName();
            switch ($name) {
                case 'Car':
                    $form->add('mission', TextType::class, $formToshiba);
                    break ;  /* Termine uniquement le switch. */
                case 'HP':

                    $form->add('withFreezer', TextType::class, $formHp);
                    break ;  /* Termine le switch et la boucle while. */
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
        $this->addSpecificationForm($form, $category_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $category_id = array_key_exists('category', $data) ? $data['category'] : null;
        $category = ($category_id) ? $this->getCategory($category_id):null;
        $this->addSpecificationForm($form, $category);
    }

    public function getCategory ( $category_id){
        $em = $this->entityManager;
        return $em->getRepository(Category::class)->findCategoryById($category_id);
    }
}