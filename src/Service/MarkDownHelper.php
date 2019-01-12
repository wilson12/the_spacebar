<?php
/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/10/2019
 * Time: 11:43 PM
 */

namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;

class MarkDownHelper
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;
    /**
     * @var bool
     */
    private $isDebug;

    public function __construct(MarkdownInterface $mardownParser,AdapterInterface $cache,LoggerInterface $markdownLogger,bool $isDebug)
    {
        $this->cache =  $cache;
        $this->markdownParser = $mardownParser;
        $this->logger = $markdownLogger;
        $this->isDebug = $isDebug;
    }
    public function parse(string $source): string
    {
//        dump($this->cache);die;
        if($this->isDebug){
            return $this->markdownParser->transform($source);
        }
        if(stripos($source,'bacon') != false) {
            $this->logger->info('They are talkin about bacon again');
        }
        $item = $this->cache->getItem('markdown_'.md5($source));
        if (!$item->isHit()) {
            $item->set($this->markdownParser->transform($source));
            $this->cache->save($item);
        }
        return $item->get();
    }
}