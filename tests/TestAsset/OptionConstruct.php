<?php
namespace SmsManTest\TestAsset;

use SmsMan\OptionsConstructTrait;

/**
 * Class OptionConstruct
 */
class OptionConstruct
{
    use OptionsConstructTrait;

    protected $test1;

    protected $test;

    protected $myTest;

    /**
     * @param $test1
     * @return $this
     */
    public function isTest1($test1)
    {
        $this->test1 = $test1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTest1()
    {
        return $this->test1;
    }


    /**
     * @return mixed
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param $test
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;
        return$this;
    }

    /**
     * @param $myTest
     * @return $this
     */
    public function myTest($myTest)
    {
        $this->myTest = $myTest;
        return$this;
    }

    /**
     * @return mixed
     */
    public function getMyTest()
    {
        return $this->myTest;
    }


} 