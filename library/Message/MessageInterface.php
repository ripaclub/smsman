<?php
namespace SmsMan\Message;

use SmsMan\Receiver\ReceiverListAwareInterface;
use SmsMan\Sender\SenderAwareInterface;
use SmsMan\Sender\SenderInterface;

/**
 * Interface MessageInterface
 */
interface MessageInterface extends SenderAwareInterface, ReceiverListAwareInterface
{
    /**
     * @return SenderInterface
     */
    public function getSenderPrototype();

    /**
     * @param SenderInterface $sender
     * @return $this
     */
    public function setSenderPrototype(SenderInterface $sender);
} 