<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 12.08.2016
 * Time: 12:57
 */

namespace AppBundle\Controller;
use AppBundle\AppBundle;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;




class products extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function products(){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Product');
        $products = $repository->findAll();
        dump($products);
        return $this->render('wyglad/products.html.twig', [
            'products' => $products
        ]);
    }
}