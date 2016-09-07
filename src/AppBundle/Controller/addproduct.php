<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 07.09.2016
 * Time: 09:18
 */

namespace AppBundle\Controller;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class addproduct extends Controller
{
    /**
     * @Route("add_product", name="add_product")
     */
    public function addproduct(Request $request){
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('title', TextType::class, [
                'label' => 'Tytuł'
            ])
            ->add('description', TextType::class, [
                'label' => 'Opis'
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Cena'
            ])
            ->add('recomended', IntegerType::class, [
                'label' => 'Polecane'
            ])
            ->add('photo', FileType::class, [
                'label' => 'Zdjęcie jako JPG'
            ])
            ->add('submit', SubmitType::class,[
                'label' => 'Dodaj produkt'
            ])
            ->getForm();
        ;
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            dump($em);
            $em->flush();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $photo */
            $photo = $product->getPhoto();
            $photoname = $product->getId().'.jpg';
            $photo->move(
                $this->getParameter('photo_directory'),
                $photoname
            );
            $product->setPhoto($photoname);
        }

        return $this->render('wyglad/addproduct.html.twig', [
            'myForm' => $form->createView()
        ]);

    }

}