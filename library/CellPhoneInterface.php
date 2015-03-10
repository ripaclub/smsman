<?php
namespace SmsMan;

/**
 * Interface CellPhoneInterface
 */
interface CellPhoneInterface
{
    /**
     * @return string
     */
    public function getCellPhone();

    /**
     * @param $cellPhone
     * @return $this
     */
    public function setCellPhone($cellPhone);
} 