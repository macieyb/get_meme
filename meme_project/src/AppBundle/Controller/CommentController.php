<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CommentController extends Controller
{
    /**
     * @Route("/addComment")
     */
    public function addCommentAction()
    {
        return $this->render('AppBundle:Comment:add_comment.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showComment")
     */
    public function showCommentAction()
    {
        return $this->render('AppBundle:Comment:show_comment.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showAllComments")
     */
    public function showAllCommentsAction()
    {
        return $this->render('AppBundle:Comment:show_all_comments.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/editComment")
     */
    public function editCommentAction()
    {
        return $this->render('AppBundle:Comment:edit_comment.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deleteComment")
     */
    public function deleteCommentAction()
    {
        return $this->render('AppBundle:Comment:delete_comment.html.twig', array(
            // ...
        ));
    }

}
