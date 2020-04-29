<?php


namespace App\Controller;

use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Mgilet\NotificationBundle\Controller\NotificationController as Base;
use Mgilet\NotificationBundle\Entity\Notification;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/notifications")
 */
class NotificationController extends Base
{
    /**
     * Set a Notification as seen
     *
     * @Route("/{notifiable}/mark_as_seen/{notification}",methods={"POST"}, name="notification_mark_as_seen",options = { "expose" = true },)
     * @param int $notifiable
     * @param Notification $notification
     *
     * @return JsonResponse
     * @throws EntityNotFoundException
     * @throws NonUniqueResultException
     * @throws OptimisticLockException
     */
    public function markAsSeenAction($notifiable, $notification)
    {
        return Parent::markAsSeenAction($notifiable, $notification);
    }



}