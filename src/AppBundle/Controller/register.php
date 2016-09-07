<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 12.08.2016
 * Time: 11:25
 */

namespace AppBundle\Controller;
use AppBundle\Entity\AddUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class register extends Controller
{
    /**
     * @param Request $request
     * @Route("/register", name="register")
     */
    public function register(Request $request){
        $user = new AddUser();
        $form = $this->createFormBuilder($user)
            ->add('user', TextType::class, [
                'label' => 'Użytkownik'
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-Mail'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Hasło'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres'
            ])
            ->add('number', TextType::class, [
                'label' => 'Numer telefonu'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zarejestruj'
            ])
            ->getForm()
        ;
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //jeśli formularz jest zatwierdzony i hasła się zgadzają
            $user->setLvl(1);

            //wysyłam do bazy danych
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('startpage');
        }
        return $this->render('wyglad/register.html.twig', [
            'myForm' => $form->createView()
        ]);
    }
}