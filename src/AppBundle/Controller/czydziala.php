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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class czydziala extends Controller
{
    /**
     * @Route("/products")
     */
    public function products(){
        return $this->render('wyglad/products.html.twig');
    }
    /*
    public function register(Request $request){
        $user = new AddUser();
        $form = $this->createFormBuilder($user)
            ->add('user', TextType::class, [
                'label' => 'Użytkownik'])
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class, [
                'label' => 'Hasło'
            ])
            ->add('address', TextType::class, [
                'label' => 'Adres'
            ])
            ->add('zarejestruj', SubmitType::class)

            ->getForm()
        ;

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //dump($form->getData());

            $user->setLvl(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect('/test/web/app_dev.php');
        }

        return $this->render('wyglad/register.html.twig', [
            'myForm' => $form->createView()
        ]);
    }
*/



}