<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 26-03-17
 * Time: 15:52
 */

namespace ECAM\MyProjectBundle\Controller;


use ECAM\MyProjectBundle\Entity\Categorie;
use ECAM\MyProjectBundle\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



/**
 * @Route("/accueil/categorie")
 */
class CategorieController extends Controller
{
    /**
     * @Route("/list", name="notepad_category_list")
     */
    public function listAction()
    {
        $category_repository =
            $this->getDoctrine()->getRepository('ECAMMyProjectBundle:Categorie');

        $categories = $category_repository->findAll();

        return $this->render(
            'ECAMMyProjectBundle:Categorie:listecategorie.html.twig',
            array(
                'categories' => $categories,
            ));
    }

    /**
     * @Route("/new", name="notepad_category_new")
     */
    public function newAction(Request $request)
    {
        return $this->editAction($request, new Categorie());
    }

    /**
     * @Route("/edit/{categorie}", name="notepad_category_edit")
     */
    public function editAction(Request $request, Categorie $categorie)
    {
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('notepad_category_list');
        }

        return $this->render(
            'ECAMMyProjectBundle:Categorie:nouveaucategorie.html.twig',
            array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/delete/{categorie}", name="notepad_category_delete")
     */
    public function deleteAction(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();

        if ($categorie->getNotes()->isEmpty()) {
            $em->remove($categorie);
            $em->flush();
        } else {
            return new Response(
                '<html><body>Cannot delete this category. Notes are
                assigned to this category. Please delete all the
                associated note before trying again.</body></html>');
        }

        return $this->redirectToRoute('notepad_category_list');
    }
}