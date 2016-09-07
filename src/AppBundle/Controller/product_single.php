<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 07.09.2016
 * Time: 10:54
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class product_single extends Controller
{
    /**
     * @param $id
     * @Route("/products/{id}")
     */
    public function showProduct($id){

        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $product = $repository->find($id);

        return $this->render('wyglad/product_single.html.twig', [
            'id' => $id,
            'title' => $product->getTitle(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ]);
    }



}