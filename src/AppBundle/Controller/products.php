<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 12.08.2016
 * Time: 12:57
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;




class products extends Controller
{
    /**
     * @Route("/products")
     */
    public function products(){
        return $this->render('wyglad/products.html.twig');
    }
}