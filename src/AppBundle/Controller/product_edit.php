<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 08.09.2016
 * Time: 10:03
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class product_edit extends Controller
{
    /**
     * @Route("/product_edit/{id}", name="product_edit")
     */
    public function product_edit(Request $request, $id){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->find($id);
        $form = $this->createFormBuilder()
            ->add('title', TextType::class, [
                'label' => 'tytuł',
                'data' => $product->getTitle()
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis',
                'data' => $product->getDescription()
            ])
            ->add('old_price', MoneyType::class, [
                'label' => 'Stara Cena',
                'data' => $product->getPrice()
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Nowa Cena',
                'data' => $product->getPrice()
            ])
            ->add('recomended', ChoiceType::class, [
                'label' => "Polecane",
                'choices' => [
                    'Nie' => 0,
                    'Tak' => 1
                ],
                'data' => $product->getRecomended()
            ])
            ->add('photo', FileType::class, [
                'label' => 'plik w formacie .jpg',
                'required' => false,
                'empty_data' => NULL
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Edytuj produkt'
            ])

        ->getForm();

        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $product->setDescription($form->get('description')->getData());
            $product->setTitle($form->get('title')->getData());
            $product->setPrice($form->get('price')->getData());
            $product->setOldPrice($form->get('old_price')->getData());
            $product->setRecomended($form->get('recomended')->getData());
            $product->setPhoto($form->get('photo')->getData());
            if($form->get('photo')->getData() != NULL){
                $photo = $product->getPhoto();
                $photoname = $product->getId().'.jpg';
                $photo->move(
                    $this->getParameter('photo_directory'),
                    $photoname
                );
                $product->setPhoto($this->getParameter('photo_directory').'/'.$photoname);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('products');
        }

    return $this->render('wyglad/product_edit.html.twig', [
       'myForm' => $form->createView(),
        'id' => $id
    ]);
    }

}