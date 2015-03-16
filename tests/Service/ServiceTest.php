<?php
namespace SmsManTest\Service;

use SmsMan\Service\Service;
use Zend\Http\Response;

/**
 * Class ServiceTest
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected  $service;

    public function setUp()
    {
        $adapter = $this->getMock('SmsMan\Adapter\AdapterInterface');
        $message_prototype = $this->getMock('SmsMan\Message\MessageInterface');

        $this->service = new Service($adapter, $message_prototype);
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('SmsMan\Service\Service', $this->service);
    }

    public function testGetSetMessagePrototype()
    {
        $adapter = $this->getMock('SmsMan\Adapter\AdapterInterface');
        $message_prototype = $this->getMock('SmsMan\Message\MessageInterface');

        $service = new Service($adapter, $message_prototype);
        $this->assertInstanceOf('SmsMan\Message\MessageInterface', $service->getMessagePrototype());
        $this->assertNotSame('SmsMan\Message\MessageInterface', $service->getMessagePrototype());
    }


    public function testSend()
    {
        $response = new Response();
        $response->setStatusCode('200');

        $adapter = $this->getMock('SmsMan\Adapter\AdapterInterface');
        $adapter->expects($this->any())
            ->method('send')
            ->will($this->returnValue($response));

        $message_prototype = $this->getMock('SmsMan\Message\MessageInterface');

        $service = new Service($adapter);
        $this->assertInstanceOf('Zend\Http\Response', $service->send($message_prototype));
    }


} 