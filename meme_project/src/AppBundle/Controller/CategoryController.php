<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/addCategory")
     */
    public function addCategoryAction()
    {
        return $this->render('AppBundle:Category:add_category.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showCategory")
     */
    public function showCategoryAction()
    {
        return $this->render('AppBundle:Category:show_category.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/showAllCategories")
     */
    public function showAllCategoriesAction()
    {
        return $this->render('AppBundle:Category:show_all_categories.html.twig', array(
            // ...
        ));
    }

}
