<?php
namespace SmsManTest\Adapter\Skebby;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * Class SkebbyAdapterAbstractFactoryTest
 */
class SkebbyAdapterAbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function setUp()
    {
        $config = [
            'skebby-adapter' => [
                'TestService' => [
                    'uri' => 'http://test.it',
                    'password' => 'test',
                    'username' => 'test'
                ],
                'TestServiceEmpty' => [],
            ],
        ];
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Adapter\Skebby\SkebbyAdapterAbstractFactory',
                    ],
                ]
            )
        );
        $this->serviceManager->setService('Config', $config);
    }

    public function testHasServiceWithoutConfig()
    {
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Adapter\Skebby\SkebbyAdapterAbstractFactory',
                    ],
                ]
            )
        );
        $this->assertFalse($this->serviceManager->has('TestService'));
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Adapter\Skebby\SkebbyAdapterAbstractFactory',
                    ],
                ]
            )
        );
        $this->serviceManager->setService('Config', []);
        $this->assertFalse($this->serviceManager->has('TestService'));
    }


    public function testHasService()
    {
        $serviceLocator = $this->serviceManager;
        $this->assertTrue($serviceLocator->has('TestService'));
        $this->assertFalse($serviceLocator->has('TestServiceEmpty'));
    }


    /**
     * @depends testHasService
     */
    public function testGetService()
    {
        $serviceLocator = $this->serviceManager;
        $this->assertInstanceOf('SmsMan\Adapter\AdapterInterface', $serviceLocator->get('TestService'));
    }
} 