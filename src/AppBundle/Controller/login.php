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
use Symfony\Component\HttpFoundation\Session\Session;


class login extends Controller
{
    /**
     * @Route("/login")
     */
    public function login(Request $request){
        $wrongpass = '';
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
            dump($user->getPassword());
            $zalogowany = 0;
            if($user->getPassword()==$form->get('password')->getData()){
                $session = new Session();
                $session->set('loged', 1);
                //$_SESSION['loged'] = 1;
                $session->set('user', $user->getUser());
                //$_SESSION['user'] = $user->getUser();
                $session->set('lvl', $user->getLvl());
                //$_SESSION['lvl'] = $user->getLvl();
                $session->set('cart', 0);
                dump($session);
                return $this->redirectToRoute('startpage');
            }
            else{
                $wrongpass = 'Zły użytkownik lub hasło';
            }
            dump($zalogowany);

        }





        return $this->render('wyglad/login.html.twig',[
            'myForm' => $form->createView(),
            'wrongpass' => $wrongpass
        ]);
    }
}