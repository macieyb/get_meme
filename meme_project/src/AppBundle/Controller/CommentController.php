<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Route("/addCommentToPostWithId/{id}", name="add_comment")
     * @Template("@App/Comment/add_comment.html.twig")
     */
    public function addCommentAction(Request $request, Post $post)
    {

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment, [
            'action' => $this->generateUrl('add_comment', ['id' => $post->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $comment = $form->getData();
            $comment->setPost($post);
            $comment->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute("show_post",
                [
                    'id' => $post->getId()
                ]);
        }

        return
            [
                'form' => $form->createView(),
            ];
    }

    /**
     * @Route("/showComment")
     */
    public function showCommentAction()
    {
        return $this->render('AppBundle:Comment:show_comment.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/showAllCommentsToPostWithId/{id}", name="show_all_comments")
     * @Template("@App/Comment/show_all_comments.html.twig")
     */
    public function showAllCommentsAction(Post $post)
    {
        $comments = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Comment')
            ->findAllAssignedToPostSortedByDate($post);

        return
            [
                "comments" => $comments,
                "id" => $post->getId()
            ];
    }

    /**
     * @Route("/editComment")
     */
    public function editCommentAction()
    {
        return $this->render('AppBundle:Comment:edit_comment.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/deleteComment")
     */
    public function deleteCommentAction()
    {
        return $this->render('AppBundle:Comment:delete_comment.html.twig', array(// ...
        ));
    }

}
