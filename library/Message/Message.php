<?php
namespace SmsMan\Message;

use SmsMan\Receiver\ReceiverList;
use SmsMan\Receiver\ReceiverListAwareInterface;
use SmsMan\Receiver\ReceiverListAwareTrait;
use SmsMan\Receiver\ReceiverListInterface;
use SmsMan\Sender\Sender;
use SmsMan\Sender\SenderAwareInterface;
use SmsMan\Sender\SenderAwareTrait;
use SmsMan\Sender\SenderInterface;

/**
 * Class Message
 */
class Message implements MessageInterface
{
    use ReceiverListAwareTrait;
    use SenderAwareTrait;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var
     */
    protected $senderPrototype;

    /**
     * @return ReceiverList
     */
    public function getReceiverList()
    {
        if (!$this->receiverList) {
            $this->receiverList = new ReceiverList();
        }
        return $this->receiverList;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return SenderInterface
     */
    public function getSenderPrototype()
    {
        return clone $this->senderPrototype;
    }

    /**
     * @param SenderInterface $sender
     * @return $this
     */
    public function setSenderPrototype(SenderInterface $sender)
    {
        $this->senderPrototype = $sender;
        return $this;
    }
}