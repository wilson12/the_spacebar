<?php

/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/8/2019
 * Time: 11:34 PM
 */

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkDownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
    /**
     * @var bool
     */
    private $isDebug;
    /**
     * @var Client
     */
    private $slack;

    /**
     * ArticleController constructor.
     * @param bool $isDebug
     */
    public function __construct(bool $isDebug)
    {
//        dump($isDebug);die;
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/",name="app_homepage")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function homepage(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAllPublishedOrderedByNewest();
        return $this->render('article/homepage.html.twig',[
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/news/{slug}",name="article_show")
     * @param Article $article
     * @param MarkDownHelper $markDownHelper
     * @param SlackClient $slackClient
     * @return Response
     */
    public function show(Article $article,MarkDownHelper $markDownHelper,SlackClient $slackClient)
    {

        if ($article->getSlug() === 'why-asteroids-taste-like-bacon-231') {
            $slackClient->sendMessage('Kahn', 'Ah, Kirke, my old friend...');
        }

        if(!$article){
            throw $this->createNotFoundException(sprintf('No article for slug "%s"',$article->getSlug()));
        }

//        $articleContent = $markDownHelper->parse($articleContent);
        return $this->render('article/show.html.twig',[
            'article'=>$article
        ]);
    }

    /**
     * @param Article $article
     * @param LoggerInterface $logger
     * @return JsonResponse
     * @Route("/news/{slug}/heart",name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart(Article $article,LoggerInterface $logger,EntityManagerInterface $em)
    {

        // TODO - actually heart/unheart the article!
        $article->incrementArticleCount();
        $em->flush();
        $logger->info("Articles is being hearted");

        return new JsonResponse(['hearts' => $article->getHeartCount()]);

    }
}