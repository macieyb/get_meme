<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends Controller
{
    /**
     * @Route("/addPost")
     */
    public function addPostAction()
    {
        return $this->render('AppBundle:Post:add_post.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showPost")
     */
    public function showPostAction()
    {
        return $this->render('AppBundle:Post:show_post.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showAllPosts")
     */
    public function showAllPostsAction()
    {
        return $this->render('AppBundle:Post:show_all_posts.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/editPost")
     */
    public function editPostAction()
    {
        return $this->render('AppBundle:Post:edit_post.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/deletePost")
     */
    public function deletePostAction()
    {
        return $this->render('AppBundle:Post:delete_post.html.twig', array(
            // ...
        ));
    }

}
