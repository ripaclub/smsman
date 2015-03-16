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
     * @return string
     */
    public function getBody();
} 