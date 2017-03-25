<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 15-03-17
 * Time: 15:55
 */

// src/ECAM/MyProjectBundle/Controller/noteController.php

namespace ECAM\MyProjectBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

use Symfony\Component\Serializer\Serializer;

class noteController extends Controller
{
    /**
     *@Route("/ECAM/MyProjectBundle/")
     *@param Request $request
     *@return \Symfony\Component\HttpFoundation\Response
     */
    public function testAction()
    {
   /**     // On crée un objet note
        $note = new note();
   Request $request
    * @Route("/note/ajouter")
        // On crée le Form grâce au service form factory
        $form = $this->get('form.factory')->createBuilder(FormType::class, $note)
            ->add('date',      DateType::class)
            ->add('title',     TextType::class)
            ->add('content',   TextareaType::class)
            ->getForm()
        ;


        // Si la requête est en POST
        if ($request->isMethod('POST')) {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
            $form->handleRequest($request);

            // On vérifie que les valeurs entrées sont correctes
            // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
                // On enregistre notre objet $advert dans la base de données, par exemple
                $em = $this->getDoctrine()->getManager();
                $em->persist($note);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

                // On redirige vers la page de visualisation de l'annonce nouvellement créée
              #  return $this->redirectToRoute('oc_platform_view', array('id' => $note->getId()));
                return 0;
            }
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        return $this->render('note/ajouter.html.twig', array( #ECAMMyProjectBundle:note:
            'form' => $form->createView(),
        ));*/


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


        $content = $this ->get('templating')->render('ECAMMyProjectBundle:note:index.html.twig', array('nom' => 'winzou'));



        return new Response($content);
    }












    public function indexAction($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        // Ici, on récupérera la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        return $this->render('ECAMMyProjectBundle:note:index.html.twig');
    }

    public function viewAction($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id

        return $this->render('ECAMMyProjectBundle:note:view.html.twig', array(
            'id' => $id
        ));
    }

    public function addAction(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('project_note_view', array('id' => 5));
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('ECAMMyProjectBundle:note:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('project_note_view', array('id' => 5));
        }

        return $this->render('ECAMMyProjectBundle:note:edit.html.twig');
    }

    public function deleteAction($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('ECAMMyProjectBundle:note:delete.html.twig');
    }


}
