<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/addPost", name="add_post")
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded file
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $post->getFilePath();

            // Generate a unique name for the file before saving it
            $fileName = uniqid() . '.' . $file->guessExtension();


            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('uploads') . "/user_" . $this->getUser()->getId(),
                $fileName
            );

            // Update the 'post' property to store the img file name
            // instead of its contents
            $post->setFilePath($fileName);

            // ... persist the $post variable or any other work

            return $this->redirect($this->generateUrl('add_post'));
        }

        return $this->render('@App/Post/add_post.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/showPost", name="show_post")
     */
    public function showPostAction()
    {
        return $this->render('AppBundle:Post:show_post.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/showAllPosts")
     */
    public function showAllPostsAction()
    {
        return $this->render('AppBundle:Post:show_all_posts.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/editPost")
     */
    public function editPostAction()
    {
        return $this->render('AppBundle:Post:edit_post.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/deletePost")
     */
    public function deletePostAction()
    {
        return $this->render('AppBundle:Post:delete_post.html.twig', array(// ...
        ));
    }

}
