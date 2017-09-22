<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/addCategory", name="add_category")
     * @Template("@App/Category/add_category.html.twig")
     */
    public function addCategoryAction(Request $request)
    {

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $category = $form->getData();
            $category->getCategoryName($category);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute("add_category", []);
        }

        return
            [
                'form' => $form->createView(),
            ];
    }

    /**
     * @Route("/showCategory")
     */
    public function showCategoryAction()
    {
        return $this->render('AppBundle:Category:show_category.html.twig', array(// ...
        ));
    }

    /**
     * @Route("/showAllCategories", name="show_all_cat")
     * @Template("@App/Category/show_all_categories.html.twig")
     */
    public function showAllCategoriesAction()
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();

        return ["categories" => $categories];
    }

}
