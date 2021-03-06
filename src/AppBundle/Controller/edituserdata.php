<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 06.09.2016
 * Time: 13:39
 */

namespace AppBundle\Controller;
use AppBundle\Entity\AddUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class edituserdata extends Controller
{
    /**
     * @route("edit_user_data", name="edituserdata")
     */
    public function edituserdata(Request $request){
        $session = new Session();
        $repository = $this->getDoctrine()->getRepository('AppBundle:AddUser');
        $user = $repository->find($session->get('id'));
        //pobieram dane z bazy aby wpisać je automatycznie w formularz
        $pass = $user->getPassword();
        $email = $user->getEmail();
        $address = $user->getAddress();
        $number = $user->getNumber();
        //dump($user);


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
            ->add('avatar', FileType::class, [
                'label' => 'Dodaj zdjęcie .jpg',
                'required' => false,
                'empty_data' => NULL
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zapisz zmiany'
            ])
            ->getForm()
        ;

        $form->handleRequest($request);
        //jeśli jest poprawny to wysyłam zmianę do bazy
        if($form->isValid() && $form->isSubmitted()){
            $user->setPassword($form->get('password')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setAddress($form->get('address')->getData());
            $user->setNumber($form->get('number')->getData());
            $user->setAvatar($form->get('avatar')->getData());
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $photo */
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            if($form->isValid() && $form->get("avatar")->getData() != NULL) {
                $avatar = $user->getAvatar();
                $avatarname = $user->getUser() . '.jpg';
                $avatar->move(
                    $this->getParameter('avatar_directory'),
                    $avatarname
                );
                $user->setAvatar($this->getParameter('avatar_directory').'/'.$avatarname);
                $em->flush();
            }
            return $this->redirectToRoute('account');
        }


        return $this->render('wyglad/edituserdata.html.twig', [
            'myForm' => $form->createView()
        ]);
    }


}