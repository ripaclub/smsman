<?php
namespace SmsMan\Adapter\Skebby;

use SmsMan\Adapter\AdapterInterface;
use SmsMan\Exception\InvalidArgumentException;
use SmsMan\Exception\RuntimeException;
use SmsMan\Exception\ValidationException;
use SmsMan\Message\MessageInterface;
use SmsMan\Receiver\ReceiverInterface;
use SmsMan\Sender\Sender;
use Zend\Http\Client;
use Zend\Http\Header\ContentType;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Json\Json;
use Zend\Stdlib\Parameters;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Validator\ValidatorChain;

/**
 * Class SkebbyAdapter
 *
 * @package SmsMan\Adapter\Skebby
 */
class SkebbyAdapter implements AdapterInterface
{
    const TEMPLATE_BODY = 'method=%s&username=%s&password=%s&%s&text=%s';
    const SKEBBY_DEFAULT_SEND_METHOD = 'test_send_sms_classic';
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Request $request
     */
    function __construct(Request $request)
    {
        $this->httpClient = new Client();
        $this->request = $request;
        $this->request->getHeaders()->addHeader(new ContentType('application/x-www-form-urlencoded')); // FIXME nella factory
    }

    /**
     * {@inheritdoc}
     */
    public function send(MessageInterface $message)
    {
        $this->checkAuthorization();
        $this->setBody($message);
        $this->setReceiverList($message);
        $this->setSender($message);

        $this->request->getPost()->set('password', $this->getPassword());
        $this->request->getPost()->set('username', $this->getUsername());
        $this->request->getPost()->set('method', $this->getMethod());
        $this->request->setMethod('POST');

        $response = $this->httpClient->send($this->request);
        $this->request->setPost(new Parameters());
        return $this->buildResponse($this->decodeResponse($response));
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

    /**
     * @return string
     */
    public function getMethod()
    {
        if (!$this->method) {
            $this->method = self::SKEBBY_DEFAULT_SEND_METHOD;
        }
        return $this->method;
    }

    /**
     * @param $method
     * @return $this
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @throws RuntimeException
     */
    protected function checkAuthorization()
    {
        if (!$this->getPassword()) {
            throw new RuntimeException('No password setting'); // FIXME message
        }
        if (!$this->getUsername()) {
            throw new RuntimeException('No username setting'); // FIXME message
        }
        return true;
    }

    /**
     * @param MessageInterface $message
     * @return string
     * @throws InvalidArgumentException
     */
    protected function setBody(MessageInterface $message)
    {
        if (!$message->getBody()) {
            throw new InvalidArgumentException("Message contain an empty body");
        }

        $validator = new StringLength(['min' => 1, 'max' => 1530]);
        if ($validator->isValid($message->getBody())) {
            $this->request->getPost()->set('text', $message->getBody());
            return $this;
        }
        $exception = new ValidationException('Invalid body message');
        $exception->setValidationMessage($validator->getMessages());
        throw $exception;
    }

    /**
     * @param MessageInterface $message
     * @return string
     */
    protected function setReceiverList(MessageInterface $message)
    {
        $receiverList = $message->getReceiverList();
        if ($receiverList->count() == 0) {
            throw new InvalidArgumentException('Message contain an empty list of recipients');
        }

        $listNumber =[];
        foreach ($message->getReceiverList() as $receiver) {
            /* @var $receiver ReceiverInterface */
            $listNumber[] =  $receiver->getCellPhone();
        }
        $this->request->getPost()->set('recipients', $listNumber);
        return $this;
    }

    protected function setSender(MessageInterface $message)
    {
        $sender = $message->getSender();
        if ($sender) {
            if ($sender->getCellPhone()) {
                $this->request->getPost()->set('sender_number', $sender->getCellPhone());
            }
            if ($sender->getAlias()) {
                if ($this->validateAliasSender($sender)) {
                    $this->request->getPost()->set('sender_string', $sender->getAlias());
                }
            }
        }
        return $this;
    }

    /**
     * @param Sender $sender
     * @return bool
     */
    protected function validateAliasSender(Sender $sender)
    {
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new StringLength(['min' => 1, 'max' => 11]));
        $validatorChain->attach(new Regex('([a-zA-Z0-9 .])'));
        if ($validatorChain->isValid($sender->getAlias())) {
            return true;
        }
        $exception = new ValidationException('Invalid alias sender');
        $exception->setValidationMessage($validatorChain->getMessages());
        throw $exception;
    }

    /**
     * @param Response $response
     * @return array
     */
    protected function decodeResponse(Response $response)
    {
        parse_str($response->getBody(), $return);
        return $return;
    }

    /**
     * @param array $decodeResponseBody
     * @return Response
     */
    protected function buildResponse(array $decodeResponseBody)
    {
        $response = new Response();
        $response->getHeaders()->addHeader(new ContentType('application/json'));
        if (isset($decodeResponseBody['status']) && $decodeResponseBody['status'] == 'failed') {
            if (isset($decodeResponseBody['code'])) {

                switch ($decodeResponseBody['code']) {
                    case 32:
                    case 33:
                    case 37:
                    case 11:
                        $response->setStatusCode(400);
                        break;
                    case 31:
                        $response->setStatusCode(405);
                        break;
                    case 21:
                        $response->setStatusCode(403);
                        break;
                    case 12:
                    case 20:
                    case 22:
                    case 23:
                    case 24:
                    case 25:
                    case 26:
                    case 27:
                    case 29:
                    case 30:
                    case 34:
                    case 35:
                    case 36:
                    case 38:
                    case 39:
                    case 40:
                    case 41:
                        $response->setStatusCode(422);
                        break;
                    default:
                        $response->setStatusCode(500);
                        break;
                 }
                $response->setContent(Json::encode(['validation_messages' => $decodeResponseBody['message']]));
            }
        } else {
            if (isset($decodeResponseBody['remaining_sms'])) {
                $response->setContent(Json::encode(['remaining_sms' => $decodeResponseBody['remaining_sms']]));
            }
        }
        return $response;
    }
}