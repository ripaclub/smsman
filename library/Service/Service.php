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
     * {@inheritdoc}
     */
    public function __construct(AdapterInterface $adapter, MessageInterface $messagePrototype = null)
    {
        $this->setAdapter($adapter);
        if ($messagePrototype) {
            $this->setMessagePrototype($messagePrototype);
        }
    }


    /**
     * {@inheritdoc}
     */
    public function send(MessageInterface $message)
    {
        return $this->adapter->send($message);
    }

    /**
     * @return MessageInterface
     */
    public function getMessagePrototype()
    {
        return clone $this->messagePrototype;
    }

    /**
     * {@inheritdoc}
     */
    protected function setMessagePrototype(MessageInterface $message)
    {
        $this->messagePrototype = $message;
    }

}
