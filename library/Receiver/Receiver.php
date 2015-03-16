<?php
namespace SmsMan\Receiver;

use SmsMan\AliasAwareTrait;
use SmsMan\CellPhoneAwareTrait;
use SmsMan\OptionsConstructTrait;

/**
 * Class Receiver
 *
 *
 * @package SmsMan\Receiver
 */
class Receiver implements ReceiverInterface
{
    use AliasAwareTrait;
    use CellPhoneAwareTrait;
    use OptionsConstructTrait;
}