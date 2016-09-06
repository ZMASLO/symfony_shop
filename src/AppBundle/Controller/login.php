<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 12.08.2016
 * Time: 11:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class login extends Controller
{
    /**
     * @Route("/login")
     */
    public function login(){
        $repository = $this -> getDoctrine()->getRepository('AppBundle:AddUser');
        $czlowiek = $repository->find(1);

        return $this->render('wyglad/login.html.twig');
    }
}