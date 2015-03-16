<?php
namespace SmsManTest\Service;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * Class ServiceAbstractFactoryTest
 */
class ServiceAbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function setUp()
    {
        $config = [
            'smsman_services' => [
                'TestService' => [
                    'message_prototype' => 'messagePrototypeTest',
                    'adapter' => 'adapterTest'
                ],
                'TestServiceEmpty' => [],
            ],
        ];
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Service\ServiceAbstractFactory',
                    ],
                    'services' => [
                        'messagePrototypeTest' => $this->getMock('SmsMan\Message\MessageInterface'),
                        'adapterTest' => $this->getMock('SmsMan\Adapter\AdapterInterface'),
                    ]
                ]
            )
        );
        $this->serviceManager->setService('Config', $config);
    }

    public function testHasService()
    {
        $serviceLocator = $this->serviceManager;
        $this->assertTrue($serviceLocator->has('TestService'));
        $this->assertFalse($serviceLocator->has('TestServiceEmpty'));
    }

    public function testHasServiceWithoutConfig()
    {
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Service\ServiceAbstractFactory',
                    ],
                ]
            )
        );
        $this->assertFalse($this->serviceManager->has('TestService'));
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Service\ServiceAbstractFactory',
                    ],
                ]
            )
        );
        $this->serviceManager->setService('Config', []);
        $this->assertFalse($this->serviceManager->has('TestService'));
    }

    /**
     * @depends testHasService
     */
    public function testGetService()
    {
        $serviceLocator = $this->serviceManager;
        $this->assertInstanceOf('SmsMan\Service\ServiceInterface', $serviceLocator->get('TestService'));
    }

} 