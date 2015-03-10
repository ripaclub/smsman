<?php
namespace SmsMan;

/**
 * Trait CellPhoneAwareTrait
 */
trait CellPhoneAwareTrait
{
    /**
     * @var string
     */
    protected $cellPhone;

    /**
     * @return string
     */
    public function getCellPhone()
    {
        return $this->cellPhone;
    }

    /**
     * @param string $cellPhone
     * @return $this
     */
    public function setCellPhone($cellPhone)
    {
        $this->cellPhone = $cellPhone;
        return $this;
    }
} 