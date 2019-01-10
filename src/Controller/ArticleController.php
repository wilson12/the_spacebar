<?php

/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/8/2019
 * Time: 11:34 PM
 */

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
    /**
     * @Route("/",name="app_homepage")
     * @return Response
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}",name="article_show")
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
            'comments'=>$comments,
            'slug'=>$slug
        ]);
    }

    /**
     * @param $slug
     * @Route("/news/{slug}/heart",name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug,LoggerInterface $logger)
    {

        // TODO - actually heart/unheart the article!
        $logger->info("Articles is being hearted");

        return new JsonResponse(['hearts' => rand(5, 100)]);

    }
}