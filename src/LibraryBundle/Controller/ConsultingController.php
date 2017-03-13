<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Books;
use LibraryBundle\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ConsultingController extends Controller
{
    /**
     * @Method ({"GET"})
     * @Route("/books2")
     */
    public function booksAction()
    {
        $entityManager = $this -> getDoctrine();
        $livres = $entityManager -> getRepository('LibraryBundle:Books') ->findAll();
      //  return $this->render('LibraryBundle:Consulting:books.html.twig', array(
      //      'livres' => $livres
       //
       // ));
        $tablivre = [];
        foreach ($livres as $livre) {
            $tablivre [] = [
                'id' => $livre->getId(),
                'titre' => $livre->getTitre(),
                'auteur' => $livre->getAuteur(),
            ];

        }

        return new JsonResponse($tablivre);

    }

    /**
     * @Method({"GET"})
     * @Route("/youpi")
     */
    public function catAction()
    {


            $entityManager = $this -> getDoctrine();
        $categories = $entityManager -> getRepository('LibraryBundle:Categories') ->findAll();
        foreach ($categories as $categorie) {
            $tabcat[] = [
                'id' => $categorie->getId(),
                'nom' => $categorie->getNom(),
            ];
        }
        return new JsonResponse($tabcat);
//        return $this->render('LibraryBundle:Consulting:cat.html.twig', array(
//            'categories' => $categories));

    }

    /**
     * @Method({"GET"})
     * @Route("/books/{id}")
     */
    public function bookAction(Books $book)
    {


       // return $this->render('LibraryBundle:Consulting:book.html.twig', array(
          //  'book' => $book,
      //  ));
        return new JsonResponse([
            'id' =>$book->getId(),
            'titre' =>$book->getTitre(),
            'auteur' => $book->getAuteur(),

        ]);
    }

}
