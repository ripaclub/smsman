<?php
namespace SmsManTest\Adapter\Skebby;


use SmsMan\Adapter\Skebby\SkebbyAdapter;
use SmsMan\Message\Message;
use SmsMan\Receiver\Receiver;
use SmsMan\Receiver\ReceiverList;
use Zend\Http\Client;
use Zend\Http\Request;
use Zend\Http\Response;

class SkebbyAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SkebbyAdapter
     */
    protected $adapter;

    protected function setUp()
    {
        $request = new Request();
        $adapter = new SkebbyAdapter($request);
        $this->adapter = $adapter;
    }


    public function testConstruct()
    {
        $request = new Request();
        $adapter = new SkebbyAdapter($request);
        $this->assertInstanceOf('SmsMan\Adapter\Skebby\SkebbyAdapter', $adapter);
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionPassword()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'checkAuthorization');
        $reflectionMethod->invoke($this->adapter);
    }

    /**
     * @expectedException \SmsMan\Exception\InvalidArgumentException
     */
    public function testGetBodyEmptyException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setBody');
        $reflectionMethod->setAccessible(true);

        $message = $this->getMock('SmsMan\Message\Message');

        $bodyMessage = null;
        $message->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue($bodyMessage));

        $reflectionMethod->invoke($this->adapter, $message);
    }

    /**
     * @expectedException \SmsMan\Exception\ValidationException
     */
    public function testGetBodyStringLengthException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setBody');
        $reflectionMethod->setAccessible(true);

        $message = $this->getMock('SmsMan\Message\Message');

        $bodyMessage = 'test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body test body';
        $message->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue($bodyMessage));

        $reflectionMethod->invoke($this->adapter, $message);
    }

    public function testGetBody()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setBody');
        $reflectionMethod->setAccessible(true);

        $message = $this->getMock('SmsMan\Message\Message');

        $bodyMessage = 'test body';
        $message->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue($bodyMessage));

        $this->assertSame($this->adapter,   $reflectionMethod->invoke($this->adapter, $message));
    }

    /**
     * @expectedException \SmsMan\Exception\RuntimeException
     */
    public function testCheckAuthorizationPasswordException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'checkAuthorization');
        $reflectionMethod->setAccessible(true);

        $reflectionMethod->invoke($this->adapter);
    }

    /**
     * @expectedException \SmsMan\Exception\RuntimeException
     */
    public function testCheckAuthorizationUsernameException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'checkAuthorization');
        $reflectionMethod->setAccessible(true);

        $this->adapter->setPassword('test');

        $reflectionMethod->invoke($this->adapter);
    }

    public function testCheckAuthorization()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'checkAuthorization');
        $reflectionMethod->setAccessible(true);

        $this->adapter->setPassword('test');
        $this->adapter->setUsername('test');

        $this->assertTrue($reflectionMethod->invoke($this->adapter));
    }

    /**
     * @expectedException \SmsMan\Exception\InvalidArgumentException
     */
    public function testGetReceiverListEmptyListException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setReceiverList');
        $reflectionMethod->setAccessible(true);

        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $receiverList = $this->getMock('SmsMan\Receiver\ReceiverList', [], [[0 => $receiver]]);

        $receiverList->expects($this->any())
            ->method('count')
            ->will($this->returnValue(0));

        $message = $this->getMock('SmsMan\Message\Message');

        $message->expects($this->any())
            ->method('getReceiverList')
            ->will($this->returnValue($receiverList));

        $reflectionMethod->invoke($this->adapter, $message);
    }

    /**
     * @depends testGetReceiverListEmptyListException
     */
    public function testGetReceiverList()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setReceiverList');
        $reflectionMethod->setAccessible(true);

        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $receiverList = $this->getMock('SmsMan\Receiver\ReceiverList', [], [[0 => $receiver]]);

        $receiverList->expects($this->any())
            ->method('count')
            ->will($this->returnValue(1));

        $receiverList->expects($this->at(2))
            ->method('valid')
            ->will($this->returnValue(true));

        $receiverList->expects($this->at(3))
            ->method('current')
            ->will($this->returnValue($receiver));

        $receiverList->expects($this->at(4))
            ->method('next');

        $message = $this->getMock('SmsMan\Message\Message');

        $message->expects($this->any())
            ->method('getReceiverList')
            ->will($this->returnValue($receiverList));

        $this->assertSame($this->adapter,   $reflectionMethod->invoke($this->adapter, $message));
    }

    /**
     * @depends testExceptionPassword
     * @expectedException SmsMan\Exception\RuntimeException
     */
    public function testExceptionUserName()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'checkAuthorization');
        $reflectionMethod->setAccessible(true);

        $this->adapter->setPassword('test');
        $reflectionMethod->invoke($this->adapter);
    }

    /**
     * @depends testConstruct
     */
    public function testPassword()
    {
        $password = 'test';
        $this->adapter->setPassword($password);
        $this->assertSame($password, $this->adapter->getPassword());
    }

    /**
     * @depends testConstruct
     */
    public function testUserName()
    {
        $userName = 'test';
        $this->adapter->setUsername($userName);
        $this->assertSame($userName, $this->adapter->getUsername());
    }

    /**
     * @depends testConstruct
     */
    public function testMethod()
    {
        $this->assertSame(SkebbyAdapter::SKEBBY_DEFAULT_SEND_METHOD, $this->adapter->getMethod());

        $method = 'test';
        $this->adapter->setMethod($method);
        $this->assertSame($method, $this->adapter->getMethod());
    }

    /**
     *
     */
    public function testDecodeResponse()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'decodeResponse');
        $reflectionMethod->setAccessible(true);

        $response = new Response();
        $response->setContent("test1=1&test2=2&test3=3");
        $this->assertCount(3, $reflectionMethod->invoke($this->adapter, $response));
    }

    public function testBuildResponse()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'buildResponse');
        $reflectionMethod->setAccessible(true);

        $responseDecode = ['status' => 'failed', 'code' => 32, 'message' => 'test'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(400, $response->getStatusCode());

        $responseDecode = ['status' => 'failed', 'code' => 31, 'message' => 'test'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(405, $response->getStatusCode());


        $responseDecode = ['status' => 'failed', 'code' => 12, 'message' => 'test'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(422, $response->getStatusCode());

        $responseDecode = ['status' => 'failed', 'code' => 21, 'message' => 'test'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(403   , $response->getStatusCode());

        $responseDecode = ['status' => 'failed', 'code' => 555, 'message' => 'test'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(500   , $response->getStatusCode());

        $responseDecode = ['remaining_sms' => '3'];
        $response = $reflectionMethod->invoke($this->adapter, $responseDecode);
        $this->assertInstanceOf('Zend\Http\Response', $response);
        /** @var $response \Zend\Http\Response */
        $this->assertSame(200   , $response->getStatusCode());
    }

    /**
     * @expectedException SmsMan\Exception\ValidationException
     */
    public function testSetSenderLenghtException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setSender');
        $reflectionMethod->setAccessible(true);

        $sender= $this->getMock('SmsMan\Sender\Sender');
        $sender->expects($this->any())
            ->method('getAlias')
            ->will($this->returnValue('testtesttest'));

        $sender->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('test'));

        $message = $this->getMock('SmsMan\Message\Message');

        $message->expects($this->any())
            ->method('getSender')
            ->will($this->returnValue($sender));

        $reflectionMethod->invoke($this->adapter, $message);
    }



    public function testSetSender()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Adapter\Skebby\SkebbyAdapter', 'setSender');
        $reflectionMethod->setAccessible(true);

        $sender= $this->getMock('SmsMan\Sender\Sender');
        $sender->expects($this->any())
            ->method('getAlias')
            ->will($this->returnValue('test'));

        $sender->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('test'));

        $message = $this->getMock('SmsMan\Message\Message');

        $message->expects($this->any())
            ->method('getSender')
            ->will($this->returnValue($sender));

        $this->assertSame($this->adapter,  $reflectionMethod->invoke($this->adapter, $message));
    }

    public function testSend()
    {
        /*
        $request = new Request();
        $adapter = new SkebbyAdapter($request);

        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('test'));

        $receiverList = $this->getMock('SmsMan\Receiver\ReceiverList', [], [[0 => $receiver]]);

        $receiverList->expects($this->any())
            ->method('count')
            ->will($this->returnValue(1));

        $receiverList->expects($this->at(2))
            ->method('valid')
            ->will($this->returnValue(true));

        $receiverList->expects($this->at(3))
            ->method('current')
            ->will($this->returnValue($receiver));

        $receiverList->expects($this->at(4))
            ->method('next');

        $message = $this->getMock('SmsMan\Message\Message');

        $message->expects($this->any())
            ->method('getReceiverList')
            ->will($this->returnValue($receiverList));
        $message->expects($this->any())
            ->method('getBody')
            ->will($this->returnValue('test body'));

      */
    }
} 