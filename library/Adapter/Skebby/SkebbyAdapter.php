<?php
namespace SmsMan\Adapter\Skebby;

use SmsMan\Adapter\AdapterInterface;
use SmsMan\Message\MessageInterface;
use Zend\Http\Client;

/**
 * Class SkebbyAdapter
 *
 * @package SmsMan\Adapter\Skebby
 */
class SkebbyAdapter implements AdapterInterface
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @param Client $httpClient
     */
    function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function send(MessageInterface $message)
    {
        $receiver = $message->getReceiverList();
        if ($receiver->count() <= 0) {
            // TODO Exception
        }

    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
}