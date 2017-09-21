<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute("all_posts");
    }


    /**
     * @Route("/profile/view/{id}", name="user_by_id")
     * @Template("@FOSUser/Profile/show.html.twig")
     */

    public function profileByIdAction(User $user)
    {
        return ["user" => $user];
    }
}