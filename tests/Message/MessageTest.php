<?php
namespace SmsManTest\Message;

use SmsMan\Message\Message;

/**
 * Class MessageTest
 */
class MessageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ReceiverList
     */
    protected $message;

    public function setUp()
    {
        $this->message = new Message();
    }

    public function testGetReceiverList()
    {
        $this->assertInstanceOf('SmsMan\Receiver\ReceiverList', $this->message->getReceiverList());
    }

    public function testGetSetBody()
    {
        $body = 'test';
        $this->message->setBody($body);
        $this->assertSame($body,  $this->message->getBody());
    }


    public function testGetSenderFromPrototype()
    {
        $this->assertInstanceOf('SmsMan\Sender\SenderInterface',  $this->message->getSender());
    }

    public function testGetSenderNotSetBefore()
    {
        $alias = 'test1';
        $cell = 'test2';
        $sender  = $this->getMock('SmsMan\Sender\Sender');
        $sender->expects($this->any())
            ->method('getAlias')
            ->will($this->returnValue($alias));

        $sender->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue($cell));

        $message = new Message($sender);

        $senderReturn = $message->getSender();
        $this->assertInstanceOf('SmsMan\Sender\SenderInterface',  $this->message->getSender());
        $this->assertNotSame($sender,  $senderReturn);
        $this->assertSame($cell, $senderReturn->getCellPhone());
        $this->assertSame($alias, $senderReturn->getAlias());
    }

    public function testGetSetSender()
    {
        $sender= $this->getMock('SmsMan\Sender\Sender');
        $this->message->setSender($sender);
        $this->assertSame($sender,  $this->message->getSender());
    }
} 