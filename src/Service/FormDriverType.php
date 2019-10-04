<?php

namespace App\Service;

use App\Entity\Driver;
use App\Form\DriverType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FormDriverType
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
        $driver = $user ? $user->getDriver() : new Driver();

        $this->form = $this->formFactory->create(DriverType::class, $driver,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('new_driver'),
                    ),
            )
        );
    }

    public function getForm() {
        return $this->form;
    }

}