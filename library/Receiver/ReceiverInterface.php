<?php
namespace SmsMan\Receiver;

use SmsMan\AliasInterface;
use SmsMan\CellPhoneInterface;

/**
 * Interface ReceiverInterface
 */
interface ReceiverInterface extends  AliasInterface, CellPhoneInterface
{
} 