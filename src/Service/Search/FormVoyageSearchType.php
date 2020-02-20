<?php

namespace App\Service\Search;

use App\Form\Carpool\VoyageSearchType;
use App\Model\VoyageModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
class FormVoyageSearchType
{

    private $form;

    private $router;

    private $formFactory;


    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager) {

        $this->router = $router;

        $this->formFactory = $formFactory;

        $meetupSearch = new VoyageModel();
        $this->form = $this->formFactory->create(VoyageSearchType::class, $meetupSearch,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('add-voyageType'),
                    ),
                'entity_manager' => $entityManager,
            )
        );
    }

    public function getForm() {
        return $this->form;
    }
}