<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 06.09.2016
 * Time: 12:08
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class logout extends Controller
{
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        $session = new Session();
        $session->clear();
        return $this->redirectToRoute('startpage');
    }

}