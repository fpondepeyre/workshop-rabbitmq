<?php

namespace App\MessageHandler;

use App\Message\Message;

/**
 * Class MessageHandler
 */
class MessageHandler
{
    /**
     * @param Message $message
     */
    public function __invoke(Message $message)
    {
        echo "New message: ".$message->getMessage()."\n";
    }
}