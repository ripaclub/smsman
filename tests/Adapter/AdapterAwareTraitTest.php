<?php
namespace SmsManTest\Adapter;

class AdapterAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $mockTrait;

    public function setUp()
    {
        $this->mockTrait = $this->getMockForTrait('SmsMan\Adapter\AdapterAwareTrait');
    }

    public function testRoleAwareTraitGetSet()
    {
        $mock = $this->getMock('SmsMan\Adapter\AdapterInterface');
        $this->mockTrait->setAdapter($mock);
        $this->assertSame($mock, $this->mockTrait->getAdapter());
    }
} 