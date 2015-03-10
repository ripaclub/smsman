<?php
namespace SmsMan\Service;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ServiceAbstractFactory
 *
 *
 * @package SmsMan\Service
 */
class ServiceAbstractFactory implements AbstractFactoryInterface
{
    /**
     * Config Key
     * @var string
     */
    protected $configKey = 'smsman_services';

    /**
     * Default service class name
     *
     * @var string
     */
    protected $serviceName = 'SmsMan\Service\Service';

    /**
     * Config
     * @var array
     */
    protected $config;

    /**
     * Determine if we can create a service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return bool
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $this->getConfig($serviceLocator);
        if (empty($config)) {
            return false;
        }

        return (
            isset($config[$requestedName])  &&
            !empty($config[$requestedName]) &&
            // Check Storage
            isset($config[$requestedName]['adapter']) &&
            is_string($config[$requestedName]['adapter']) &&
            $serviceLocator->has($config[$requestedName]['adapter'])
        );
    }

    /**
     * Create service with name
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param $name
     * @param $requestedName
     * @return mixed
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $this->getConfig($serviceLocator)[$requestedName];
        // Construct params
        $adapter = $serviceLocator->get($config['adapter']);
        $message = null;
        // Message prototype
        if ($config['message_prototype']
            && is_string($config['message_prototype'])
            && $serviceLocator->has($config['message_prototype'])
        ) {
            $message = clone $serviceLocator->get($config['message_prototype']);
        }

        return new $this->serviceName($adapter, $message);
    }

    /**
     * Get model configuration, if any
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return array
     */
    protected function getConfig(ServiceLocatorInterface $serviceLocator)
    {
        if ($this->config !== null) {
            return $this->config;
        }

        if (!$serviceLocator->has('Config')) {
            $this->config = [];
            return $this->config;
        }

        $config = $serviceLocator->get('Config');
        if (!isset($config[$this->configKey]) || !is_array($config[$this->configKey])) {
            $this->config = [];
            return $this->config;
        }

        $this->config = $config[$this->configKey];
        return $this->config;
    }
}
