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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class login extends Controller
{
    /**
     * @Route("/login")
     */
    public function login(Request $request){

        $form = $this->createFormBuilder()
            ->add('user', TextType::class, [
                'label' => 'Użytkownik'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Hasło'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zaloguj'
            ])
            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isValid()){
            $repository = $this -> getDoctrine()->getRepository('AppBundle:AddUser');
            $user = $repository->findOneByUser($form->get('user')->getData());
            dump($user);
            $zalogowany = 0;
            //if($user('password')==$form->get('password')->getData()) $zalogowany = 1;
        }



        return $this->render('wyglad/login.html.twig',[
            'myForm' => $form->createView()
        ]);
    }
}