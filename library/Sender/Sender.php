<?php
namespace SmsMan\Sender;

use SmsMan\AliasAwareTrait;
use SmsMan\CellPhoneAwareTrait;
use SmsMan\OptionsConstructTrait;

/**
 * Class Sender
 */
class Sender implements SenderInterface
{
    use CellPhoneAwareTrait;
    use AliasAwareTrait;
    use OptionsConstructTrait;
}
