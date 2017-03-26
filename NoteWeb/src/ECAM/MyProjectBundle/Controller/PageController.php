<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 26-03-17
 * Time: 15:36
 */

namespace ECAM\MyProjectBundle\Controller;

namespace ECAM\MyProjectBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/accueil")
 */
class PageController   extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('notepad_note_list');
    }
}