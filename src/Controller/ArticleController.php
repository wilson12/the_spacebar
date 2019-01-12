<?php

/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/8/2019
 * Time: 11:34 PM
 */

namespace App\Controller;

use App\Service\MarkDownHelper;
use App\Service\SlackClient;
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

    public function __construct(bool $isDebug)
    {
//        dump($isDebug);die;
        $this->isDebug = $isDebug;
    }
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
     * @param $slug
     * @param MarkdownParserInterface $markdownParser
     * @return Response
     */
    public function show($slug,MarkDownHelper $markDownHelper,SlackClient $slackClient)
    {
//        dump($cache);die;
        if ($slug === 'khaaaaaan') {
            $slackClient->sendMessage('Kahn', 'Ah, Kirk, my old friend...');
        }
        $comments = [
            'I ate a normal rock',
            'I am still hungry',
            'I dont like asteroids'
        ];
        $articleContent = <<<EOF
            Spicy **jalapeno bacon** ipsum dolor amet veniam shank in dolore. Ham hock nisi landjaeger cow,
            lorem proident [beef ribs](https://baconipsum.com/) aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
            labore minim pork belly spare ribs cupim short loin in. Elit exercitation eiusmod dolore cow
            turkey shank eu pork belly meatball non cupimll.
            Laboris beef ribs fatback fugiat eiusmod jowl kielbasa alcatra dolore velit ea ball tip. Pariatur
            laboris sunt venison, et laborum dolore minim non meatball. Shankle eu flank aliqua shoulder,
            capicola biltong frankfurter boudin cupim officia. Exercitation fugiat consectetur ham. Adipisicing
            picanha shank et filet mignon pork belly ut ullamco. Irure velit turducken ground round doner incididunt
            occaecat lorem meatball prosciutto quis strip steak.
            Meatball adipisicing ribeye bacon strip steak eu. Consectetur ham hock pork hamburger enim strip steak
            mollit quis officia meatloaf tri-tip swine. Cow ut reprehenderit, buffalo incididunt in filet mignon
            strip steak pork belly aliquip capicola officia. Labore deserunt esse chicken lorem shoulder tail consectetur
            cow est ribeye adipisicing. Pig hamburger pork belly enim. Do porchetta minim capicola irure pancetta chuck
            fugiat.
EOF;
        $articleContent = $markDownHelper->parse($articleContent);
        return $this->render('article/show.html.twig',[
            'title' =>ucwords(str_replace('-',' ',$slug)),
            'comments'=>$comments,
            'slug'=>$slug,
            'articleContent'=>$articleContent
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