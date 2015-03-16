<?php
namespace SmsManTest\Exception;

use SmsMan\Exception\ValidationException;

/**
 * Class ValidationExceptionTest
 */
class ValidationExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testValidationException()
    {
        try {
            $exception = new ValidationException();
            $exception->setValidationMessage(['test1', 'test2']);
            throw $exception;

        } catch (ValidationException $e) {
            $this->assertCount(2, $e->getValidationMessage());
        }
    }
} 