<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 07.09.2016
 * Time: 13:49
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class product_delete extends Controller
{
    /**
     * @Route("product_delete/{id}", name="product_delete")
     */
    public function product_delete($id){
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('products');
    }

}