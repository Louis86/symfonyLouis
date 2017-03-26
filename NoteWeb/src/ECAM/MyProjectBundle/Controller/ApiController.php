<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 26-03-17
 * Time: 16:00
 */


namespace ECAM\MyProjectBundle\Controller;

use ECAM\MyProjectBundle\Entity\Categorie;
use ECAM\MyProjectBundle\Entity\Note;
use ECAM\MyProjectBundle\Form\NoteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/page/api")
 */
class ApiController extends Controller
{
    /*
         * Status code constant for http responses
         */
    const SC_BADREQ = 400;
    const SC_NOTFOUND = 404;

    /*
     * Notes API
     */

    /**
     * @Route("/notes")
     * @Method({"GET"})
     */
    public function allNotesAction()
    {
        $note_repository = $this->getDoctrine()
            ->getRepository('ECAMMyProjectBundle:Note');

        $notes = $note_repository->findBy(
            array(),
            array('date' => 'desc')
        );

        $notes_array = array();

        foreach ($notes as $note) {
            $notes_array[] = $note->toArray();
        }

        return new JsonResponse($notes_array);
    }

    /**
     * @Route("/tag/{search}/notes")
     * @Method({"GET"})
     */
    public function searchNotesAction($search)
    {
        $note_repository = $this->getDoctrine()
            ->getRepository('ECAMMyProjectBundle:Note');

        $notes = $note_repository->findBy(
            array(),
            array('date' => 'desc')
        );

        $notes_array = array();

        foreach ($notes as $note) {
            $dom = new \DOMDocument();
            $dom->loadXML($note->getXMLContent());
            $xpath = new \DOMXpath($dom);
            $elements = $xpath->evaluate("/note/tag");
            $added = false;
            foreach ($elements as $element) {
                if (trim(strtolower($element->nodeValue)) ===
                    trim(strtolower($search)) && !$added) {
                    $notes_array[] = $note->toArray();
                    $added = true;
                }
            }
        }

        return new JsonResponse($notes_array);
    }


    /**
     * @Route("/notes/{note}")
     * @Method({"GET"})
     */
    public function getNotesAction(Note $note)
    {
        return new JsonResponse($note->toArray());
    }

    /**
     * @Route("/categories/{categorie}/notes")
     * @Method({"POST"})
     */
    public function newNoteAction(Request $request, Categorie $categorie)
    {
        $contenu = $request->getContenu();
        $validator = $this->get('validator');

        if (empty($contenu)) {
            $msg = "Le contenu est vide";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $note_data = json_decode($contenu, true);
        if (!$note_data) {
            $msg = "Le contenu n'est pas un valide JSON";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $note = new Note();
        if (array_key_exists('titre', $note_data))
            $note->setTitre($note_data['titre']);
        if (array_key_exists('date', $note_data))
            $note->setDate(new \DateTime($note_data['date']));
        if (array_key_exists('contenu', $note_data))
            $note->setContenu($note_data['contenu']);
        $note->setCategorie($categorie);

        $errors = $validator->validate($note);

        if (count($errors) > 0) {
            $response_array['error'] = "La  note n'est pas valide ";
            return new JsonResponse($response_array, self::SC_BADREQ);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();

        return new JsonResponse($note->toArray());
    }

    /**
     * @Route("/notes/{note}")
     * @Method({"PATCH"})
     */
    public function editNoteAction(Request $request, Note $note)
    {
        $contenu = $request->getContenu();
        $validator = $this->get('validator');

        if (empty($contenu)) {
            $msg = "Le contenu est vide ";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $note_data = json_decode($contenu, true);
        if (!$note_data) {
            $msg = "Le contenu n'est pas un valide JSON";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $categorie_repository = $this->getDoctrine()
            ->getRepository('ECAMMyProjectBundle:Categorie');

        if (array_key_exists('titre', $note_data))
            $note->setTitre($note_data['titre']);
        if (array_key_exists('date', $note_data))
            $note->setDate(new \DateTime($note_data['date']));
        if (array_key_exists('contenu', $note_data))
            $note->setContenu($note_data['contenu']);
        if (array_key_exists('categorie', $note_data)) {
            if (array_key_exists('id', $note_data['categorie']))
                $categorie = $categorie_repository->find(
                    $note_data['categorie']['id']
                );
            if (!empty($categorie))
                $note->setCategorie($categorie);
        }

        $errors = $validator->validate($note);

        if (count($errors) > 0) {
            $response_array['error'] = "Note is not valid";
            return new JsonResponse($response_array, self::SC_BADREQ);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();

        return new JsonResponse($note->toArray());
    }

    /**
     * @Route("/notes/{note}")
     * @Method({"DELETE"})
     */
    public function deleteNotesAction(Note $note)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        return new JsonResponse(['sucess' => true]);
    }

    /*
     * Categories API
     */

    /**
     * @Route("/categories")
     * @Method({"GET"})
     */
    public function allCategoriesAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('ECAMMyProjectBundle:Categorie');

        $categories = $repository->findAll();

        $categories_array = array();

        foreach ($categories as $categorie) {
            $categories_array[] = $categorie->toArray();
        }

        return new JsonResponse($categories_array);
    }

    /**
     * @Route("/categories/{categorie}")
     * @Method({"GET"})
     */
    public function getCategoriesAction(Categorie $categorie)
    {
        return new JsonResponse($categorie->toArray());
    }

    /**
     * @Route("/categories")
     * @Method({"POST"})
     */
    public function newCategoriesAction(Request $request)
    {
        $contenu = $request->getContenu();
        $validator = $this->get('validator');

        if (empty($contenu)) {
            $msg = "Le contenu est vide";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $categorie_data = json_decode($contenu, true);
        if (!$categorie_data) {
            $msg = "Le contenu n'est pas un valide JSON";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $categorie = new Categorie();
        if (array_key_exists('nom', $categorie_data))
            $categorie->setNom($categorie_data['nom']);

        $errors = $validator->validate($categorie);

        if (count($errors) > 0) {
            $response_array['error'] = "Categorie is not valid";
            return new JsonResponse($response_array, self::SC_BADREQ);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        return new JsonResponse($categorie->toArray());
    }

    /**
     * @Route("/categories/{categorie}")
     * @Method({"PATCH"})
     */
    public function editCategoriesAction(Request $request, Categorie $categorie)
    {
        $contenu = $request->getContenu();
        $validator = $this->get('validator');

        if (empty($contenu)) {
            $msg = "Le contenu est vide";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        $categorie_data = json_decode($contenu, true);
        if (!$categorie_data) {
            $msg = "Le contenu n'est pas un valide JSON";
            return new JsonResponse(['error' => $msg], self::SC_BADREQ);
        }

        if (array_key_exists('nom', $categorie_data))
            $categorie->setNom($categorie_data['nom']);

        $errors = $validator->validate($categorie);

        if (count($errors) > 0) {
            $response_array['error'] = "Note is not valid";
            return new JsonResponse($response_array, self::SC_BADREQ);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->flush();

        return new JsonResponse($categorie->toArray());
    }

    /**
     * @Route("/categories/{categorie}")
     * @Method({"DELETE"})
     */
    public function deleteCategoriesAction(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        return new JsonResponse(['sucess' => true]);
    }
}

