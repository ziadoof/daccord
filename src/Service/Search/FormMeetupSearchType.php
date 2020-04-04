<?php

namespace App\Service\Search;

use App\Form\Meetup\MeetupSearchType;
use App\Model\MeetupModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
class FormMeetupSearchType
{

    private $form;

    private $router;

    private $formFactory;


    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory, EntityManagerInterface $entityManager) {

        $this->router = $router;

        $this->formFactory = $formFactory;

        $meetupSearch = new MeetupModel();
        $this->form = $this->formFactory->create(MeetupSearchType::class, $meetupSearch,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('add-meetupType'),
                    ),
                'entity_manager' => $entityManager,
            )
        );
    }

    public function getForm() {
        return $this->form;
    }
}