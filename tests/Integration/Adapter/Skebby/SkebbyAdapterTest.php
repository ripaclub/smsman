<?php
namespace SmsManTest\Integration\Adapter\Skebby;

use SmsMan\Adapter\Skebby\SkebbyAdapter;
use SmsMan\Message\Message;
use SmsMan\Receiver\Receiver;
use SmsMan\Receiver\ReceiverList;
use Zend\Http\Client;
use Zend\Http\Request;

class SkebbyAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SkebbyAdapter
     */
    protected $adapter;

    public function setUp()
    {
        $uri = 'http://gateway.skebby.it/api/send/smseasy/advanced/http.php';
        $method = 'test_send_sms_classic';
        $userName = 'solodotsh';
        $userPassword = 'InnLab14';

        $request = new Request();
        $request->setUri($uri);
        $this->adapter = new SkebbyAdapter($request);
        $this->adapter->setPassword($userPassword);
        $this->adapter->setUsername($userName);
       // $this->adapter->setMethod($method);
    }

    public function testSend()
    {
        $message = new Message();
        $message->setBody('SmsMan test mess');

        $receiverList = new ReceiverList();
        $receiverList->add( (new Receiver())->setCellPhone('393338096472'));
       // $ReceiverList->add( (new Receiver())->getCellPhone('320'));
        $message->setReceiverList($receiverList);

        $response = $this->adapter->send($message);
    }
}