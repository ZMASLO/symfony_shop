<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 06.09.2016
 * Time: 13:39
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class edituserdata extends Controller
{
    /**
     * @route("edit_user_data", name="edituserdata")
     */
    public function edituserdata(Request $request){
        $session = new Session();
        $repository = $this->getDoctrine()->getRepository('AppBundle:AddUser');
        $user = $repository->findOneByUser($session->get('user'));
        $pass = $user->getPassword();
        $email = $user->getEmail();
        $address = $user->getAddress();
        $number = $user->getNumber();
        dump($user);


        $form = $this->createFormBuilder()
            ->add('password', TextType::class, [
                'label' => 'Hasło',
                'data' => $pass
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'data' => $email
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres',
                'data' => $address
            ])
            ->add('number', TextType::class, [
                'label' => 'Numer telefonu',
                'data' => $number
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zapisz zmiany'
            ])
            ->getForm()
        ;

        $form->handleRequest($request);


        return $this->render('wyglad/edituserdata.html.twig', [
            'myForm' => $form->createView()
        ]);
    }


}