<?php

namespace App\Service\Search;

use App\Form\Hosting\HostingSearchType;
use App\Model\HostingModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
class FormHostingSearchType
{

    private $form;

    private $router;

    private $formFactory;


    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager) {

        $this->router = $router;

        $this->formFactory = $formFactory;

        $hostingSearch = new HostingModel();
        $this->form = $this->formFactory->create(HostingSearchType::class, $hostingSearch,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('add-hostingType'),
                    ),
                'entity_manager' => $entityManager,
            )
        );
    }

    public function getForm() {
        return $this->form;
    }


}