<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Search
 */

namespace ZendSearchTest\Lucene;

use ZendSearch\Lucene;
use Zend\Search;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 * @group      Zend_Search_Lucene
 */
class AbstractFSMTest extends \PHPUnit\Framework\TestCase
{
    public function testCreate()
    {
        $doorFSM = new TestFSMClass();

        $this->assertTrue($doorFSM instanceof Lucene\AbstractFSM);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::OPENED);
    }

    public function testSetState()
    {
        $doorFSM = new TestFSMClass();

        $this->assertEquals($doorFSM->getState(), TestFSMClass::OPENED);

        $doorFSM->setState(TestFSMClass::CLOSED_AND_LOCKED);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::CLOSED_AND_LOCKED);

        $wrongStateExceptionCatched = false;
        try {
            $doorFSM->setState(TestFSMClass::OPENED_AND_LOCKED);
        } catch (\ZendSearch\Lucene\Exception\InvalidArgumentException $e) {
            $wrongStateExceptionCatched = true;
        }
        $this->assertTrue($wrongStateExceptionCatched);
    }

    public function testReset()
    {
        $doorFSM = new TestFSMClass();

        $doorFSM->setState(TestFSMClass::CLOSED_AND_LOCKED);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::CLOSED_AND_LOCKED);

        $doorFSM->reset();
        $this->assertEquals($doorFSM->getState(), TestFSMClass::OPENED);
    }

    public function testProcess()
    {
        $doorFSM = new TestFSMClass();

        $doorFSM->process(TestFSMClass::CLOSE);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::CLOSED);

        $doorFSM->process(TestFSMClass::LOCK);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::CLOSED_AND_LOCKED);

        $doorFSM->process(TestFSMClass::UNLOCK);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::CLOSED);

        $doorFSM->process(TestFSMClass::OPEN);
        $this->assertEquals($doorFSM->getState(), TestFSMClass::OPENED);

        $wrongInputExceptionCatched = false;
        try {
            $doorFSM->process(TestFSMClass::LOCK);
        } catch (\ZendSearch\Lucene\Exception\ExceptionInterface $e) {
            $wrongInputExceptionCatched = true;
        }
        $this->assertTrue($wrongInputExceptionCatched);
    }

    public function testActions()
    {
        $doorFSM = new TestFSMClass();

        $this->assertFalse($doorFSM->actionTracer->action2Passed /* 'closed' state entry action*/);
        $doorFSM->process(TestFSMClass::CLOSE);
        $this->assertTrue($doorFSM->actionTracer->action2Passed);

        $this->assertFalse($doorFSM->actionTracer->action8Passed /* 'closed' state exit action*/);
        $doorFSM->process(TestFSMClass::LOCK);
        $this->assertTrue($doorFSM->actionTracer->action8Passed);

        $this->assertFalse($doorFSM->actionTracer->action4Passed /* 'closed&locked' state +'unlock' input action */);
        $doorFSM->process(TestFSMClass::UNLOCK);
        $this->assertTrue($doorFSM->actionTracer->action4Passed);

        $this->assertFalse($doorFSM->actionTracer->action6Passed /* 'locked' -> 'opened' transition action action */);
        $doorFSM->process(TestFSMClass::OPEN);
        $this->assertTrue($doorFSM->actionTracer->action6Passed);
    }
}
