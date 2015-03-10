<?php
namespace SmsMan\Sender;

use SmsMan\AliasInterface;
use SmsMan\CellPhoneInterface;

/**
 * Interface SenderInterface
 */
interface SenderInterface extends  AliasInterface, CellPhoneInterface
{
} 