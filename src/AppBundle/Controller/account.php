<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 06.09.2016
 * Time: 12:25
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class account extends Controller
{
    /**
     * @Route("account", name="account")
     */
    public function account(){
        $session = new Session();
        if($session->get('loged')==1){
            $repository = $this->getDoctrine()->getRepository('AppBundle:AddUser');
            $user = $repository->findOneByUser($session->get('user'));
            $email = $user->getEmail();
            $address = $user->getAddress();
            $number = $user->getNumber();

            return $this->render(':wyglad:account.html.twig', [
                'email' => $email,
                'address' => $address,
                'number' => $number,
                'user' => $user
            ]);
        }









        else return $this->redirectToRoute('startpage');
    }


}