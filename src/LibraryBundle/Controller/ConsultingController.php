<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Books;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ConsultingController extends Controller
{
    /**
     * @Route("/books2")
     */
    public function booksAction()
    {
        $entityManager = $this -> getDoctrine();
        $livres = $entityManager -> getRepository('LibraryBundle:Books') ->findAll();
        return $this->render('LibraryBundle:Consulting:books.html.twig', array(
            'livres' => $livres
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
     * @Route("/books/{id}")
     */
    public function bookAction(Books $book)
    {


        return $this->render('LibraryBundle:Consulting:book.html.twig', array(
            'book' => $book,
        ));
    }

}
