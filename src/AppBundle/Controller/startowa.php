<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 10.08.2016
 * Time: 10:45
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class startowa extends Controller
{
    /**
     * @Route("/", name="startpage")
     */
    public function startpage(){

        return $this->render('wyglad/startpage.html.twig');

    }
}