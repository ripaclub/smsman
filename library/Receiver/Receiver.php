<?php
namespace SmsMan\Receiver;

use SmsMan\AliasAwareTrait;
use SmsMan\CellPhoneAwareTrait;

/**
 * Class Receiver
 *
 *
 * @package SmsMan\Receiver
 */
class Receiver implements ReceiverInterface
{
    use CellPhoneAwareTrait;
    use AliasAwareTrait;
} 