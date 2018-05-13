<?php

namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class MessageConsumer
 */
class MessageConsumer implements ConsumerInterface
{
    /**
     * @param AMQPMessage $message
     *
     * @return int
     */
    public function execute(AMQPMessage $message): int
    {
        $data = json_decode($message->getBody(), true);

        if (!isset($data['message'])) {
            return ConsumerInterface::MSG_REJECT;
        }

        echo "New message: ".$data['message']."\n";

        return ConsumerInterface::MSG_ACK;
    }
}