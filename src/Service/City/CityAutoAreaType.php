<?php

namespace App\Service\City;

use App\Entity\Location\City;
use App\Entity\User;
use App\Form\User\AutoAreaType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CityAutoAreaType
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

        $this->form = $this->formFactory->create(AutoAreaType::class, new User,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('set_area'),
                    ),
            )
        );
    }

    public function getForm(): \Symfony\Component\Form\FormInterface
    {
        return $this->form;
    }


}