<?php
namespace SmsManTest\Sender;

use SmsMan\Receiver\ReceiverList;

/**
 * Class ReceiverListTest
 */
class ReceiverListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $receiverList;

    public function setUp()
    {
        $this->receiverList = new ReceiverList();
    }

    /**
     * @expectedException SmsMan\Exception\InvalidArgumentException
     */
    public function testConstructItemListException()
    {
        $list = ['test', 'test1'];
        $receiverList = new ReceiverList($list);
    }

    /**
     * @expectedException SmsMan\Exception\InvalidArgumentException
     */
    public function testCheckReceiverException()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Receiver\ReceiverList', 'checkReceiver');
        $reflectionMethod->setAccessible(true);

        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $reflectionMethod->invoke($this->receiverList, $receiver);
    }

    public function testCheckReceiver()
    {
        $reflectionMethod = new \ReflectionMethod('SmsMan\Receiver\ReceiverList', 'checkReceiver');
        $reflectionMethod->setAccessible(true);

        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));
        $this->assertTrue($reflectionMethod->invoke($this->receiverList, $receiver));
    }

    public function testConstruct()
    {
        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $list = [$receiver];
        $receiverList = new ReceiverList($list);
        $this->assertTrue($receiverList->has($receiver));
    }

    /**
     * @expectedException SmsMan\Exception\InvalidArgumentException
     */
    public function testHas()
    {
        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $this->assertFalse($this->receiverList->has($receiver));
        $this->receiverList->add($receiver);
        $this->assertTrue($this->receiverList->has($receiver));
        $this->receiverList->add($receiver);
    }

    /**
     * @depends testHas
     */
    public function testAdd()
    {
        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $this->receiverList->add($receiver);
        $this->assertTrue($this->receiverList->has($receiver));
    }

    /**
     * @depends testHas
     */
    public function testRemove()
    {
        $receiver= $this->getMock('SmsMan\Receiver\Receiver');
        $receiver->expects($this->any())
            ->method('getCellPhone')
            ->will($this->returnValue('333333333'));

        $this->receiverList->add($receiver);
        $this->receiverList->remove($receiver);
        $this->assertFalse($this->receiverList->has($receiver));

    }
} 