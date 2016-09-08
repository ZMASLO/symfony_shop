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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Choice;


class product_add extends Controller
{
    /**
     * @Route("product_add", name="product_add")
     */
    public function addproduct(Request $request){
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('title', TextType::class, [
                'label' => 'Tytuł'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Opis'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Cena'
            ])
            ->add('recomended', ChoiceType::class, [
                'label' => "Polecane",
                'choices' => [
                    'Nie' => 0,
                    'Tak' => 1
                ]
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
            $em->flush();
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $photo */
            $photo = $product->getPhoto();
            $photoname = $product->getId().'.jpg';
            $photo->move(
                $this->getParameter('photo_directory'),
                $photoname
            );
            $product->setPhoto($this->getParameter('photo_directory').'/'.$photoname);
            $em->flush();
            return $this->redirect('products/'.$product->getId());        }

        return $this->render('wyglad/addproduct.html.twig', [
            'myForm' => $form->createView()
        ]);

    }

}