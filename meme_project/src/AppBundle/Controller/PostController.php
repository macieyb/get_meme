<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Form\PostType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{
    /**
     * @Route("/addPost", name="add_post")
     * @Template("@App/Post/add_post.html.twig")
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

            $post = $form->getData();
            $post->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

        return
            [
                'form' => $form->createView()
            ];
    }

    /**
     * @Route("/showPost/{id}", name="show_post")
     * @Template("@App/Post/show_post.html.twig")
     */
    public function showPostAction($id)
    {
        $post = $this
            ->getDoctrine()
            ->getEntityManager()
            ->getRepository('AppBundle:Post')
            ->find($id);

        return
            [
                "post" => $post
            ];
    }

    /**
     * @Route("/showAllPosts", name="all_posts")
     * @Template("@App/Post/show_all_posts.html.twig")
     */
    public function showAllPostsAction()
    {
        $posts = $this
            ->getDoctrine()
            ->getEntityManager()
            ->getRepository('AppBundle:Post')
            ->findAll();

        return ["posts" => $posts];
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
