<?php
namespace SmsMan\Sender;

use SmsMan\AliasAwareTrait;
use SmsMan\CellPhoneAwareTrait;

/**
 * Class Sender
 */
class Sender implements SenderInterface
{
    use CellPhoneAwareTrait;
    use AliasAwareTrait;

    /**
     * @param null $cellPhone
     * @param null $alias
     */
    public function __construct($cellPhone = null, $alias = null)
    {
        if ($cellPhone) {
            $this->setCellPhone($cellPhone);
        }

        if ($alias) {
            $this->setAlias($alias);
        }
    }
}
