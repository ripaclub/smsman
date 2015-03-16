<?php
namespace SmsManTest\Sender;

class SenderAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $mockTrait;

    public function setUp()
    {
        $this->mockTrait = $this->getMockForTrait('SmsMan\Sender\SenderAwareTrait');
    }

    public function testRoleAwareTraitGetSet()
    {
        $mock = $this->getMock('SmsMan\Sender\Sender');
        $this->mockTrait->setSender($mock);
        $this->assertSame($mock, $this->mockTrait->getSender());
    }
} 