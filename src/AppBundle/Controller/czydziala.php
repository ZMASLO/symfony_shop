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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;

class czydziala extends Controller
{
    /**
     * @Route("/register/new")
     */
    public function RegisterNew(){
        $user = new AddUser();
        $user->setUser($_GET["user"]);
        $user->setPassword($_GET["password"]);
        $user->setEmail('sylwaker@gmail.com');
        $user->setAddress('Żwirki i Wigury 4');
        $user->setLvl(1);

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

        $form = $this->createFormBuilder($user)
            ->add('user', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->getForm();

        return $this->render('wyglad/register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/login")
     */
    public function login(){
        return $this->render('wyglad/login.html.twig');
    }



}