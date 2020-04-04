<?php


namespace App\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use App\Entity\Ads\Category;
class AddSearchCategoryFieldSubscriber implements EventSubscriberInterface

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
            FormEvents::POST_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT     => 'preSubmit'
        );
    }

    private function addCategoryForm($form, $generalcategory_id)
    {

        $formOptions = array(
            'class'         => Category::class,
            'required' => false,
            'placeholder'     => 'All categorys',
            'label' => false,
            'attr'          => array(
                'class' => 'category_selector ',

            ),
            'query_builder' => function (EntityRepository $repository) use ($generalcategory_id) {
                $qb = $repository->createQueryBuilder('c')
                    ->where('c.parent = :generalcategory_id')
                    ->setParameter('generalcategory_id', $generalcategory_id)
                ;
                return $qb;
            }
        );

        $form->add($this->factory, EntityType::class, $formOptions);
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
        $generalcategory_id = ($category) ? $category->getParent()->getId() : null;
        $this->addCategoryForm($form, $generalcategory_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $generalcategory_id = array_key_exists('generalcategory', $data) ? $data['generalcategory'] : null;
        $this->addCategoryForm($form, $generalcategory_id);
    }
}