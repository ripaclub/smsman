<?php
namespace SmsManTest\Adapter\Skebby;


use SmsMan\Adapter\Skebby\SkebbyAdapter;
use Zend\Http\Client;

class SkebbyAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SkebbyAdapter
     */
    protected $adapter;

    protected function setUp()
    {
        $httpClient = new Client('http://gateway.skebby.it/api/send/smseasy/advanced/http.php');
        $adapter = new SkebbyAdapter($httpClient);
        $this->adapter = $adapter;
    }


    public function testConstruct()
    {
        $httpClient = new Client();
        $adapter = new SkebbyAdapter($httpClient);
        $this->assertInstanceOf('SmsMan\Adapter\Skebby\SkebbyAdapter', $adapter);
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
} 