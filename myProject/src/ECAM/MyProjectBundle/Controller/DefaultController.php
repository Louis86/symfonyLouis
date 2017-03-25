<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 09-02-17
 * Time: 23:46
 */



// src/ECAM/MyProjectBundle/DefaultController.php


namespace ECAM\MyProjectBundle\Controller;

// N'oubliez pas ce use :

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

use ECAM\MyProjectBundle\Entity\note;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

use Symfony\Component\Serializer\Serializer;



/**
class AdvertController
{
    public function indexAction()
    {
        return new Response("Notre propre Hello World !");
    }
}

 */



class DefaultController extends Controller

{

    /**
     * @return Response
     */
    public function indexAction(Request $request)

    {


        $note = new note();

        $note->setTitle('Titre');

        $note->setContent('Contenu');


        $note->setDate(new \DateTime('today'));


        $em = $this->getDoctrine()->getManager(); //entity manager

        //lien entre le doctrine et la base de donnée
        $em->persist($note);


        $em->flush();


       // return new Response('note créé avec id:'.$note->getId());


        /**
        $content = $this->get('templating')->render('ECAMMyProjectBundle:Default:index.html.twig');
        */


        $content = $this ->get('templating')->render('ECAMMyProjectBundle:Default:index.html.twig', array('nom' => 'winzou'));



        return new Response($content);

    }

}