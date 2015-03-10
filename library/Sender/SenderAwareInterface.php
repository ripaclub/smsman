<?php
namespace SmsMan\Sender;

/**
 * Interface SenderAwareInterface
 */
interface SenderAwareInterface
{
    /**
     * @return Sender|null
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     */
    public function setSender(SenderInterface $sender);
} 