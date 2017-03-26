<?php
/**
 * Created by PhpStorm.
 * User: Louis
 * Date: 25-03-17
 * Time: 14:09
 */

namespace ECAM\MyProjectBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/page")
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
