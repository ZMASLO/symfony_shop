<?php
/**
 * Created by PhpStorm.
 * User: Sylwa
 * Date: 11.08.2016
 * Time: 12:25
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
class test
{
    public function test(){
        /**
         * @Route("/test")
         */
        return new Response('elo hg cukiereczku');
    }
}