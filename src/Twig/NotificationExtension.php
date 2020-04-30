<?php

namespace App\Twig;

use App\Repository\Notification\NotifiedByRepository;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Mgilet\NotificationBundle\Entity\NotifiableEntity;
use Mgilet\NotificationBundle\Entity\NotificationInterface;
use Mgilet\NotificationBundle\Entity\Repository\NotifiableNotificationRepository;
use Mgilet\NotificationBundle\Manager\NotificationManager;
use Mgilet\NotificationBundle\NotifiableInterface;
use Symfony\Component\Routing\Router;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig_Extension;

/**
 * Twig extension to display notifications
 **/
class NotificationExtension extends \Mgilet\NotificationBundle\Twig\NotificationExtension
{
    protected $notificationManager;
    protected $storage;
    protected $twig;
    protected $router;
    protected $notifiedByRepository;


    public function __construct(NotificationManager $notificationManager, TokenStorageInterface $storage,
                                \Twig_Environment $twig, RouterInterface $router,NotifiedByRepository $notifiedByRepository)
    {
        parent::__construct($notificationManager,   $storage,  $twig,  $router);
        $this->notificationManager = $notificationManager;
        $this->storage = $storage;
        $this->twig = $twig;
        $this->router = $router;
        $this->notifiedByRepository = $notifiedByRepository;
    }

    /**
     * @return array available Twig functions
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('notification', array($this, 'render'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('mgilet_notification_render', array($this, 'render'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('mgilet_notification_count', array($this, 'countNotifications'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('mgilet_notification_unseen_count', array($this, 'countUnseenNotifications'), array(
                'is_safe' => array('html')
            )),
            new \Twig_SimpleFunction('mgilet_notification_generate_path', array($this, 'generatePath'), array(
                'is_safe' => array('html')
            ))
        );
    }

    /**
     * Rendering notifications in Twig
     *
     * @param NotifiableInterface $notifiable
     *
     * @param array $options
     * @return null|string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(NotifiableInterface $notifiable, array $options = array())
    {
        if (!array_key_exists('seen', $options)) {
            $options['seen'] = true;
        }

        return $this->renderNotificationsBy($notifiable, $options);
    }

    /**
     * Render notifications of the notifiable as a list
     *
     * @param NotifiableInterface $notifiable
     * @param array $options
     *
     * @param NotifiedByRepository $notifiedByRepository
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderNotificationsBy(NotifiableInterface $notifiable, array $options): string
    {

        $order = $options['order'] ?? null;
        $limit = $options['limit'] ?? null;
        $offset = $options['offset'] ?? null;

        if ($options['seen']) {
            $notifications = $this->notificationManager->getNotifications($notifiable, $order, $limit, $offset);
        } else {
            $notifications = $this->notificationManager->getUnseenNotifications($notifiable, $order, $limit, $offset);
        }

        $notifiedBy= $this->notifiedByRepository->findByReceiver($notifiable);
        $data = [];
        foreach ($notifiedBy as $item){
            $data[$item->getNotification()->getId()]['sender']= $item->getSender();
            $data[$item->getNotification()->getId()]['type']= $item->getType();
            $data[$item->getNotification()->getId()]['category']= $item->getCategory();
        }
        // if the template option is set, use custom template
        $notif = $notifiedBy?$notifiedBy[0]:null;
        $template = array_key_exists('template', $options) ? $options['template'] : '@MgiletNotification/notification_list.html.twig';
        return $this->twig->render($template,
            array(
                'notificationList' => $notifications,
                'data' => $data,
                'notifiedBy'=>$notif
            )
        );
    }

    /**
     * Render notifications of the notifiable as a list
     *
     * @param NotifiableInterface $notifiable
     * @param array $options
     *
     * @return string
     *
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderNotifications(NotifiableInterface $notifiable, array $options)
    {
        $order = array_key_exists('order', $options) ? $options['order'] : null;
        $limit = array_key_exists('limit', $options) ? $options['limit'] : null;
        $offset = array_key_exists('offset', $options) ? $options['offset'] : null;

        if ($options['seen']) {
            $notifications = $this->notificationManager->getNotifications($notifiable, $order, $limit, $offset);
        } else {
            $notifications = $this->notificationManager->getUnseenNotifications($notifiable, $order, $limit, $offset);
        }
        // if the template option is set, use custom template
        $template = array_key_exists('template', $options) ? $options['template'] : '@MgiletNotification/notification_list.html.twig';
        return $this->twig->render($template,
            array(
                'notificationList' => $notifications,
            )
        );
    }

    /**
     * Display the total count of notifications for the notifiable
     *
     * @param NotifiableInterface $notifiable
     *
     * @return int
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countNotifications(NotifiableInterface $notifiable)
    {
        return $this->notificationManager->getNotificationCount($notifiable);
    }

    /**
     * Display the count of unseen notifications for this notifiable
     *
     * @param NotifiableInterface $notifiable
     *
     * @return int
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function countUnseenNotifications(NotifiableInterface $notifiable)
    {
        return $this->notificationManager->getUnseenNotificationCount($notifiable);
    }

    /**
     * Returns the path to the NotificationController action
     *
     * @param                            $route
     * @param                            $notifiable
     * @param NotificationInterface|null $notification
     *
     * @return \InvalidArgumentException|string
     * @throws \RuntimeException
     * @throws \Doctrine\DBAL\Exception\InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \InvalidArgumentException
     */
    public function generatePath($route, $notifiable, NotificationInterface $notification = null)
    {
        if ($notifiable instanceof NotifiableInterface) {
            $notifiableId = $this->notificationManager->getNotifiableEntity($notifiable)->getId();
        } elseif ($notifiable instanceof NotifiableEntity) {
            $notifiableId = $notifiable->getId();
        } else {
            throw new InvalidArgumentException('You must provide a NotifiableInterface or NotifiableEntity object');
        }

        switch ($route) {
            case 'notification_list':
                return $this->router->generate(
                    'notification_list',
                    array('notifiable' => $notifiableId)
                );
                break;
            case 'notification_mark_as_seen':
                if (!$notification) {
                    throw new \InvalidArgumentException('You must provide a Notification Entity');
                }

                return $this->router->generate(
                    'notification_mark_as_seen',
                    array(
                        'notifiable' => $notifiableId,
                        'notification' => $notification->getId()
                    )
                );
                break;
            case 'notification_mark_as_unseen':
                if (!$notification) {
                    throw new \InvalidArgumentException('You must provide a Notification Entity');
                }

                return $this->router->generate(
                    'notification_mark_as_unseen',
                    array(
                        'notifiable' => $notifiableId,
                        'notification' => $notification->getId()
                    )
                );
                break;
            case 'notification_mark_all_as_seen':
                return $this->router->generate('notification_mark_all_as_seen', array('notifiable' => $notifiableId));
                break;
            default:
                return new \InvalidArgumentException('You must provide a valid route path. Paths availables : notification_list, notification_mark_as_seen, notification_mark_as_unseen, notification_mark_all_as_seen');
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mgilet_notification';
    }
}
