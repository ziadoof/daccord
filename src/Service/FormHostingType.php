<?php

namespace App\Service;

use App\Entity\Hosting\Hosting;
use App\Form\Hosting\HostingType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class FormHostingType
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
        $hosting = $user ? $user->getHosting() : new Hosting();

        $this->form = $this->formFactory->create(HostingType::class, $hosting,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('new_hosting'),
                    ),
            )
        );
    }

    public function getForm() {
        return $this->form;
    }

}