<?php


namespace App\Service;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Mailer\TwigSwiftMailer as BaseMailer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CustomUserMailer extends BaseMailer
{

    public function __construct(
        \Swift_Mailer $mailer,
        UrlGeneratorInterface $router,
        \Twig_Environment $twig,
        array $parameters
    )
    {
        parent::__construct($mailer, $router, $twig, $parameters);
    }

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {

        // Create a new mail message.
        $message = (new \Swift_Message());
        $context['logo'] = $message->embed(\Swift_Image::fromPath('assets/images/logo/face.png'));

        $context = $this->twig->mergeGlobals($context);
        $template = $this->twig->loadTemplate($templateName);
        $subject = $template->renderBlock('subject', $context);
        $textBody = '';

        $htmlBody = '';

        if ($template->hasBlock('body_html', $context)) {
            $htmlBody = $template->renderBlock('body_html', $context);
        }

        $message
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message
                ->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }
}