<?php
namespace SmsMan\Adapter;

use SmsMan\Message\MessageInterface;

/**
 * Interface AdapterInterface
 * @package SmsMan\Adapter
 */
interface AdapterInterface
{
    /**
     * @param MessageInterface $message
     * @return mixed
     */
    public function send(MessageInterface $message);
}
