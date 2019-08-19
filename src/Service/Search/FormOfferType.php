<?php

namespace App\Service\Search;

use App\Form\Search\OfferSearchType;
use App\Model\AdModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
class FormOfferType
{

    private $form;

    private $router;

    private $formFactory;


    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager) {

        $this->router = $router;

        $this->formFactory = $formFactory;

        $offerSearch = new AdModel();
        $this->form = $this->formFactory->create(OfferSearchType::class, $offerSearch,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('add-offerType'),
                    ),
                'entity_manager' => $entityManager,
            )
        );
    }

    public function getForm() {
        return $this->form;
    }


}