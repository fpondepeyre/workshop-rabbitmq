<?php

namespace App\Message;

/**
 * Class Message
 */
class Message
{
    /**
     * @var string
     */
    private $message;

    /**
     * Message constructor.
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Message
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        
        return $this;
    }
}