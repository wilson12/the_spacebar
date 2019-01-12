<?php
/**
 * Created by PhpStorm.
 * User: Wilson-PC
 * Date: 1/13/2019
 * Time: 12:02 AM
 */

namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;

class SlackClient
{
    use LoggerTrait;
    /**
     * @var Client
     */
    private $slack;
    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct(Client $slack)
    {

        $this->slack = $slack;
    }
    public function sendMessage(string $from,string $message)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $message
        ]);
        $msg = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($msg);

    }

    /**
     * @param LoggerInterface $logger
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}