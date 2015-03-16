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

    function __construct(Sender $senderPrototype = null)
    {
        if ($senderPrototype) {
            $this->senderPrototype = $senderPrototype;
        }
    }


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

    public function getSender()
    {
        if (!$this->sender) {
            if ($this->senderPrototype) {
                $this->sender = clone $this->senderPrototype;
            } else {
                $this->sender = new Sender();
            }
        }
        return $this->sender;
    }


}