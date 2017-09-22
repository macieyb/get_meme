<?php

namespace AppBundle\Controller;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
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
            $text = $post->getImageText();
            $uniqueId = uniqid();
            $this->createMem($file->getPathname(), $file->guessExtension(), $uniqueId, $text);

            // Generate a unique name for the file before saving it
            $fileName = $uniqueId . "." . $file->guessExtension();

            // Update the 'post' property to store the img file name
            // instead of its contents
            $post->setFilePath($fileName);

            $post = $form->getData();
            $post->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute("all_posts",
                [

                ]);
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
            ->getRepository('AppBundle:Post')
            ->findAllSortedByDate();

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

    public function createMem($filename, $extension, $uniqueId, $text)
    {

        if (!in_array($extension, ['jpeg', 'png'])) {
            throw new \Exception("Not recognized extension");
        }

        $width = 500;
        $height = 500;
        $dest = "uploads/user_" . $this->getUser()->getId() . "/" . $uniqueId;

        $fs = new Filesystem();
        $fs->mkdir("uploads/user_" . $this->getUser()->getId());

        // Get new dimensions
        list($width_orig, $height_orig) = getimagesize($filename);

        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        $pathToFont = $this->getParameter('kernel.root_dir') . "/Resources/private/arial.ttf";


        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        if ($extension === "jpeg") {
            $image = imagecreatefromjpeg($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            if ($text != null) {
                $black = imagecolorallocate($image_p, 0, 0, 0);
                $white = imagecolorallocate($image_p, 255, 255, 255);
                imagettftext($image_p, 20, 0, 22, 52, $black, $pathToFont, $text);
                imagettftext($image_p, 20, 0, 20, 50, $white, $pathToFont, $text);
            }
            imagejpeg($image_p, $dest . '.jpeg', 100);
        } else {
            $image = imagecreatefrompng($filename);
            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            if ($text != null) {
                $black = imagecolorallocate($image_p, 0, 0, 0);
                $white = imagecolorallocate($image_p, 255, 255, 255);
                imagettftext($image_p, 20, 0, 22, 52, $black, $pathToFont, $text);
                imagettftext($image_p, 20, 0, 20, 50, $white, $pathToFont, $text);
            }
            imagepng($image_p, $dest . '.png', 8);
        }
        return $image_p;
    }
}
