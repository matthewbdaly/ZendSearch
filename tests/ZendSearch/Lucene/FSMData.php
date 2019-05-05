<?php

namespace ZendSearchTest\Lucene;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 */
class FSMData
{
    public $action1Passed = false;
    public $action2Passed = false;
    public $action3Passed = false;
    public $action4Passed = false;
    public $action5Passed = false;
    public $action6Passed = false;
    public $action7Passed = false;
    public $action8Passed = false;

    public function action1()
    {
        $this->action1Passed = true;
    }
    public function action2()
    {
        $this->action2Passed = true;
    }
    public function action3()
    {
        $this->action3Passed = true;
    }
    public function action4()
    {
        $this->action4Passed = true;
    }
    public function action5()
    {
        $this->action5Passed = true;
    }
    public function action6()
    {
        $this->action6Passed = true;
    }
    public function action7()
    {
        $this->action7Passed = true;
    }
    public function action8()
    {
        $this->action8Passed = true;
    }
}
