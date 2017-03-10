<?php

namespace LibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ConsultingController extends Controller
{
    /**
     * @Route("/books2")
     */
    public function booksAction()
    {
        return $this->render('LibraryBundle:Consulting:books.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/categories/value/books")
     */
    public function catAction()
    {

            // ...
            $entityManager = $this -> getDoctrine();
        $categories = $entityManager -> getRepository('LibraryBundle:Categories') ->findAll();
        return $this->render('LibraryBundle:Consulting:cat.html.twig', array(
            'categories' => $categories));

    }

    /**
     * @Route("/books/id")
     */
    public function bookAction()
    {
        return $this->render('LibraryBundle:Consulting:book.html.twig', array(
            // ...
        ));
    }

}
