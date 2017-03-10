<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * categories controller.
 *
 * @Route("categories")
 */
class CategoriesController extends Controller
{
    /**
     * Lists all categories entities.
     *
     * @Route("/", name="categories_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('LibraryBundle:Categories')->findAll();

        return $this->render('categories/index.html.twig', array(
            'categories' => $categories,
        ));
    }

    /**
     * Creates a new categories entity.
     *
     * @Route("/new", name="categories_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $categories = new Categories();
        $form = $this->createForm('LibraryBundle\Form\CategoriesType', $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categories);
            $em->flush($categories);

            return $this->redirectToRoute('categories_show', array('id' => $categories->getId()));
        }

        return $this->render('categories/new.html.twig', array(
            'categories' => $categories,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categories entity.
     *
     * @Route("/{id}", name="categories_show")
     * @Method("GET")
     */
    public function showAction(Categories $categories)
    {
        $deleteForm = $this->createDeleteForm($categories);

        return $this->render('categories/show.html.twig', array(
            'categories' => $categories,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categories entity.
     *
     * @Route("/{id}/edit", name="categories_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Categories $categories)
    {
        $deleteForm = $this->createDeleteForm($categories);
        $editForm = $this->createForm('LibraryBundle\Form\CategoriesType', $categories);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categories_edit', array('id' => $categories->getId()));
        }

        return $this->render('categories/edit.html.twig', array(
            'categories' => $categories,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categories entity.
     *
     * @Route("/{id}", name="categories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Categories $categories)
    {
        $form = $this->createDeleteForm($categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categories);
            $em->flush();
        }

        return $this->redirectToRoute('categories_index');
    }

    /**
     * Creates a form to delete a categories entity.
     *
     * @param Categories $categories The categories entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Categories $categories)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categories_delete', array('id' => $categories->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
