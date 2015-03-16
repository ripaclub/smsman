<?php
namespace SmsManTest\Message;

use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\ServiceManager\ServiceManager;

/**
 * Class MessageAbstractFactoryTest
 */
class MessageAbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    public function setUp()
    {
        $config = [
            'smsman_messages' => [
                'TestService' => [
                    'sender' => [
                        'cell_phone' => 'test',
                        'alias' => 'test'
                    ]
                ],
                'TestServiceEmpty' => [],
            ],
        ];
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Message\MessageAbstractFactory',
                    ],
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
                        'SmsMan\Message\MessageAbstractFactory',
                    ],
                ]
            )
        );
        $this->assertFalse($this->serviceManager->has('TestService'));
        $this->serviceManager = new ServiceManager(
            new ServiceManagerConfig(
                [
                    'abstract_factories' => [
                        'SmsMan\Message\MessageAbstractFactory',
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
        $this->assertInstanceOf('SmsMan\Message\MessageInterface', $serviceLocator->get('TestService'));
    }

} 