<?php


namespace App\Form\Message;

use App\Entity\User;
use App\Service\IssueToNumberTransformer;
use App\Service\UserToIDTransformer;
use FOS\MessageBundle\FormType\NewThreadMessageFormType as BaseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Message form type for starting a new conversation.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class NewThreadMessageFormType extends BaseType
{
    private $transformer;

    public function __construct(UserToIDTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recipient',HiddenType::class)
            ->add('body', TextType::class, array(
                'label' => false,
            ));
        $builder->get('recipient')
            ->addModelTransformer($this->transformer);
    }


    /**
     * @deprecated To remove when supporting only Symfony 3
     */
    public function getName()
    {
        return 'app_message_new_thread';
    }
}
