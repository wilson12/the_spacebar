<?php
/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/13/2019
 * Time: 12:21 AM
 */


namespace App\Helper;

use Psr\Log\LoggerInterface;

trait LoggerTrait
{

    /**
     * @var LoggerInterface|null
     */
    private $logger;
    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    private function logInfo(string $message, array $context = [])
    {
        if ($this->logger) {
            $this->logger->info($message, $context);
        }
    }
}