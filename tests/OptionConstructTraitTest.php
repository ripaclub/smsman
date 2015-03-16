<?php
namespace SmsManTest;

use SmsManTest\TestAsset\OptionConstruct;

/**
 * Class OptionConstructTraitTest
 */
class OptionConstructTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $params = [
            'test1' => 'test1',
            'test' => 'test',
            'myTest' => 'myTest'
        ];

        $optionConstruct = new OptionConstruct($params);

        $this->assertSame('test', $optionConstruct->getTest());
        $this->assertSame('test1', $optionConstruct->getTest1());
        $this->assertSame('myTest', $optionConstruct->getMyTest());
    }
} 