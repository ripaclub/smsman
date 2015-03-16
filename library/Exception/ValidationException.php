<?php

namespace SmsMan\Exception;

use RuntimeException as BaseRuntimeException;

class ValidationException extends BaseRuntimeException
{
    /**
     * @var string
     */
    protected $validationMessage;

    /**
     * @return string
     */
    public function getValidationMessage()
    {
        return $this->validationMessage;
    }

    /**
     * @param string $validationMessage
     * @return $this
     */
    public function setValidationMessage($validationMessage)
    {
        $this->validationMessage = $validationMessage;
        return $this;
    }
} 