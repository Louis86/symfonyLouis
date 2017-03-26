<?php

namespace ECAM\MyProjectBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/NoteWeb")
     */
    public function indexAction()
    {
        return $this->render('ECAMMyProjectBundle:Default:index.html.twig');
    }
}
