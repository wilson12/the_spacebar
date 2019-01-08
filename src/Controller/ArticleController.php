<?php

/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/8/2019
 * Time: 11:34 PM
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function homepage()
    {
        return new Response('OmG we gonna go high now');
    }

    /**
     * @Route("/news/{slug}")
     */
    public function show($slug)
    {
        return new Response(sprintf('future article:"%s"',$slug));
    }
}