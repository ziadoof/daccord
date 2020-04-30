<?php

namespace App\Controller\Meetup;

use App\Entity\Meetup\Comment;
use App\Entity\Meetup\Meetup;
use App\Entity\User;
use App\Form\Meetup\CommentType;
use App\Repository\Meetup\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/meetup/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/{id}", name="meetup_comment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meetup_show',['id'=>$comment->getMeetup()->getId()]);
    }
}
