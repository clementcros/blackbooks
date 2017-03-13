<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Books;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


/**
 * Book controller.
 *
 * @Route("books")
 */
class BooksController extends Controller
{
    /**
     * Lists all book entities.
     *
     * @Route("/", name="books_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $books = $em->getRepository('LibraryBundle:Books')->findAll();

        return $this->render('books/index.html.twig', array(
            'books' => $books,
        ));
    }

    /**
     * @Route("/bookdelet")
     * @Method({"DELETE"})
     */
    public function deletbookAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('LibraryBundle:Books')->find($request->get('id'));
        $em->remove($book);
        $em->flush();
        return new JsonResponse($book);
    }
}

