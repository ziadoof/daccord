<?php

namespace App\Service;

use App\Entity\Carpool\Carpool;
use App\Form\Carpool\CarpoolType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FormCarpoolType
{

    private $form;
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory, TokenStorageInterface $tokenStorage ) {

        $this->router = $router;

        $this->formFactory = $formFactory;

        $user = !$tokenStorage->getToken() || is_string($tokenStorage->getToken()->getUser()) ? null : $tokenStorage->getToken()->getUser();
        $carpool = $user ? $user->getCarpool() : new Carpool();

        $this->form = $this->formFactory->create(CarpoolType::class, $carpool,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('new_carpool'),
                    ),
            )
        );
    }

    public function getForm() {
        return $this->form;
    }

}