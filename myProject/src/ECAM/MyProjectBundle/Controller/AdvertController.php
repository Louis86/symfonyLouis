<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 22-03-17
 * Time: 01:39
 */

// src/ECAM/MyProjectBundle/Controller/AdvertController.php

namespace ECAM\MyProjectBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

use Symfony\Component\Serializer\Serializer;


class AdvertController extends Controller
{

        // On récupère tous les paramètres en arguments de la méthode
        public function viewSlugAction($slug, $year, $_format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$_format."."
        );


    }
        public function indexAction()
    {
        // On veut avoir l'URL de l'annonce d'id 5.
        $url = $this->get('router')->generate(
            'oc_platform_view', // 1er argument : le nom de la route
            array('id' => 5)    // 2e argument : les valeurs des paramètres
        );
        // $url vaut « /ecam/advert/5 »

        return new Response("L'URL de l'annonce d'id 5 est : ".$url);
    }



    public function viewAction($id, Request $request)
    {
        return $this->render('ECAMMyProjectBundle:Advert:view.html.twig', array(
            'id' => $id
        ));
      }


    // Ajoutez cette méthode :
    public function addAction(Request $request)
    {
        $session = $request->getSession();

        // Bien sûr, cette méthode devra réellement ajouter l'annonce

        // Mais faisons comme si c'était le cas
        $session->getFlashBag()->add('info', 'Annonce bien enregistrée');

        // Le « flashBag » est ce qui contient les messages flash dans la session
        // Il peut bien sûr contenir plusieurs messages :
        $session->getFlashBag()->add('info', 'Oui oui, elle est bien enregistrée !');

        // Puis on redirige vers la page de visualisation de cette annonce
        return $this->redirectToRoute('ecam_project_viewAdvert', array('id' => 5));
    }





public function view2Action()
    {
        $url = $this->get('router')->generate('test2');

        return new RedirectResponse($url);
    }




    // On injecte la requête dans les arguments de la méthode
    public function view($id)
    {
        // On récupère notre paramètre tag
        $tag = $request->query->get('tag');

        // On utilise le raccourci : il crée un objet Response
        // Et lui donne comme contenu le contenu du template
        return $this->get('templating')->renderResponse(
            'ECAMMyProjectBundle:Advert:view.html.twig',
            array('id'  => $id, 'tag' => $tag)
        );


    }


}