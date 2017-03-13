<?php

namespace LibraryBundle\Controller;

use LibraryBundle\Entity\Categories;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/library")
     */
    public function indexAction()
    {

        return $this->render('LibraryBundle:Default:index.html.twig');
    }

    /**
     * @Route("/cat")
     * @Method({"POST"})
     */
    public function catAction(Request $request){
        //on definit un nouvelle objet
        $categories = new Categories();
        //on configure $categories pour qu'il recupere dans la requete la valeur 'nom'
        $categories->setNom($request ->get('nom'));
        //on crée un 'entity manager'
        $em = $this->getDoctrine()->getManager();
        //on se prepare a envoyer
        $em->persist($categories);
        //on envoie
        $em->flush();
        //on retourne la reponse au format json
        return new JsonResponse($categories ->getNom());
    }

    /**
     * @Route("/catedit")
     * @Method({"PUT"})
     */
    public function editAction(Request $request){
        //on cree un 'entity manager'
        $em = $this->getDoctrine()->getManager();
        //on recupere dans la table categorie celle avec l'id qu'on a defini dans l'url
        $categories = $em->getRepository('LibraryBundle:Categories')->find($request ->get('id'));
        //on configure $categories pour qu'il recupere dans la requete la valeur 'nom'
        $categories->setNom($request->get('nom'));
        //on se prepare a envoyer
        $em->persist($categories);
        //on envoie
        $em->flush();
        //on retourne la reponse au format json
        return new JsonResponse($categories->getNom());
        //c'est faut xd lol ptdr mdr jpp
    }

    /**
     * @Route("/catdel")
     * @Method({"DELETE"})
     */
    public function deletAction(Request $request) {
    //on cree un 'entity manager'
    $em = $this->getDoctrine()->getManager();
    //on recup' dans la table cat celle avec l'id qu'on a défini dans l'URLLLLLLLL
    $categories = $em->getRepository('LibraryBundle:Categories')->find($request ->get('id'));
//        On suprr
    $em->remove($categories);
//        On envoie
    $em->flush();
//        On Observe
    return new JsonResponse($categories);
}


}

