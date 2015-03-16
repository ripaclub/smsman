<?php
namespace SmsMan\Service;

use SmsMan\Adapter\AdapterInterface;
use SmsMan\Message\MessageInterface;
use Zend\Http\Response;


/**
 * Class ServiceInterface
 *
 *
 * @package SmsMan\Service
 */
interface ServiceInterface
{
    /**
     * @param AdapterInterface $adapter
     * @param MessageInterface $messagePrototype
     */
    public function __construct(AdapterInterface $adapter, MessageInterface $messagePrototype = null);

    /**
     * @param MessageInterface $message
     * @return Response
     */
    public function send(MessageInterface $message);

    /**
     * @return MessageInterface
     */
    public function getMessagePrototype();
} 