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
        $user->setName('zmaslo');

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return new Response('<html><body>Wpis dodany</body></html>');

    }


    /**
     * @Route("/{imie}")
     */
    public function showAction($imie){

        $notes = [
            'Ta strona nie jest zaawansowana',
            'Ta strona ma potencjał',
            'Ta strona będzie działać'
        ];
    if($imie=='products'){
        return $this->render('wyglad/products.html.twig');
    }
    if($imie=='register'){
            return $this->render('wyglad/register.html.twig');
    }
    if($imie=='login'){
            return $this->render('wyglad/login.html.twig');
    }
    else
        return $this->render('wyglad/homepage.html.twig', [

            'name' => $imie,
            'notes' => $notes
        ]);

    }
}