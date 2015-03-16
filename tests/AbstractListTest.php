<?php
namespace SmsManTest;

/**
 * Class AbstractListTest
 */
class AbstractListTest extends \PHPUnit_Framework_TestCase
{
    protected $list;

    public function setUp()
    {
        $this->list = $this->getMockForAbstractClass('SmsMan\AbstractList', [['key1' => 'test1','key2' => 'test2']]);
    }

    public function testKey()
    {
        $this->assertSame('key1', $this->list->key());
    }

    public function testCurrent()
    {
        $this->assertSame('test1', $this->list->current());
    }

    public function testCount()
    {
        $this->assertSame(2, $this->list->count());
    }

    public function testValid()
    {
        $this->assertTrue($this->list->valid());
    }

    /**
     * @depends testCurrent
     */
    public function testNext()
    {
        $this->list->next();
        $this->assertSame('test2', $this->list->current());
    }

    /**
     * @depends testNext
     */
    public function testRewind()
    {
        $this->list->next();
        $this->list->rewind();
        $this->assertSame('test1', $this->list->current());
    }

} 