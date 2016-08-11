<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 10.08.2016
 * Time: 10:45
 */

namespace AppBundle\Controller;

use AppBundle\Entity\AddUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class czydziala extends Controller
{
    /**
     * @Route("/register/new")
     */
    public function RegisterNew(){
        $user = new AddUser();
        $user->setName($_POST['user']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('<html><body>Wpis dodany</body></html>');

    }


    /**
     * @Route("/products")
     */
    public function products(){
        return $this->render('wyglad/products.html.twig');
    }
    /**
     * @Route("/register")
     */
    public function register(){
        return $this->render('wyglad/register.html.twig');
    }
    /**
     * @Route("/login")
     */
    public function login(){
        return $this->render('wyglad/login.html.twig');
    }



}