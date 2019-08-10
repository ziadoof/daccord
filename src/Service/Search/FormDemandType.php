<?php

namespace App\Service\Search;

use App\Form\Search\DemandSearchType;
use App\Model\AdModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;

class FormDemandType
{

    private $form;

    private $router;

    private $formFactory;


    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory,EntityManagerInterface $entityManager) {

        $this->router = $router;

        $this->formFactory = $formFactory;



        $demandSearch = new AdModel();
        $this->form = $this->formFactory->create(DemandSearchType::class, $demandSearch,
            array(

                'attr' =>
                    array(
                        'action' => $this->router->generate('add-DemandType')
                    ),
                'entity_manager' => $entityManager
            )
        );
    }

    public function getForm() {
        return $this->form;
    }
}