<?php
namespace SmsMan\Service;

use SmsMan\Adapter\AdapterAwareTrait;
use SmsMan\Adapter\AdapterInterface;
use SmsMan\Message\Message;
use SmsMan\Message\MessageInterface;

/**
 * Class Service
 */
class Service implements ServiceInterface
{
    use AdapterAwareTrait;

    /**
     * @var Message
     */
    protected $messagePrototype;

    /**
     * @param AdapterInterface $adapter
     * @param MessageInterface $messagePrototype
     */
    public function __construct(AdapterInterface $adapter, MessageInterface $messagePrototype = null)
    {
        $this->setAdapter($adapter);
        if ($messagePrototype) {
            $this->setMessagePrototype($messagePrototype);
        }
    }


    /**
     * @param MessageInterface $message
     * @return mixed
     */
    public function send(MessageInterface $message)
    {
        // TODO: Implement send() method.
    }

    /**
     * @return MessageInterface
     */
    public function getMessagePrototype()
    {
        return clone $this->messagePrototype;
    }

    /**
     * @param MessageInterface $message
     */
    protected function setMessagePrototype(MessageInterface $message)
    {
        $this->messagePrototype = $message;
    }

}
