<?php

namespace App\Form\Carpool;

use App\Controller\i18next;
use App\Entity\Carpool\Voyage;
use App\Entity\Location\City;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageSearchType extends AbstractType
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // use for translate tooltip
        $request = $this->requestStack->getCurrentRequest();
        $local = $request? $request->getLocale():'en';
        i18next::init($local, '../translations/translation.json');

        $builder
            ->add('date',DateTimeType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required'=> false,
                'label'=>'Date',
                'attr'=>[
                    'autocomplete'=> 'off',
                    'readonly'=> 'readonly',
                ]
            ])
            ->add('highway',CheckboxType::class,[
                'required'=> false,
                'help' => ' ',
                'help_attr'=> array(
                    'class'=> 'help-tooltip d-inline fas fa-question-circle',
                    'data-toggle'=> "tooltip",
                    'data-original-title'=>i18next::getTranslation('tooltip.autoroute')
                )
            ])
            ->add('mainDeparture', AutocompleteType::class, [
                'class' => City::class,
                'required'=> true,
                'label'=> 'Departure',
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
            ->add('mainArrival', AutocompleteType::class, [
                'class' => City::class,
                'label'=> 'Arrival',
                'required'=> true,
                'attr'=>[
                    'autocomplete'=> 'off',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'App\Model\VoyageModel',
            'translation_domain'=> 'manual',
        ]);
        $resolver->setRequired('entity_manager');
    }
}
