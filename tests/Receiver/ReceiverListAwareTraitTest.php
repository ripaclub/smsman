<?php
namespace SmsManTest\Sender;

class ReceiverListAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $mockTrait;

    public function setUp()
    {
        $this->mockTrait = $this->getMockForTrait('SmsMan\Receiver\ReceiverListAwareTrait');
    }

    public function testRoleAwareTraitGetSet()
    {
        $mock = $this->getMock('SmsMan\Receiver\ReceiverList');
        $this->mockTrait->setReceiverList($mock);
        $this->assertSame($mock, $this->mockTrait->getReceiverList());
    }
} 