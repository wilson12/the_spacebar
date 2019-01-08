<?php

/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/8/2019
 * Time: 11:34 PM
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
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
        $comments = [
            'I ate a normal rock',
            'I am still hungry',
            'I dont like asteroids'
        ];
//        dump($slug, $this);
        return $this->render('article/show.html.twig',[
            'title' =>ucwords(str_replace('-',' ',$slug)),
            'comments'=>$comments
        ]);
    }
}