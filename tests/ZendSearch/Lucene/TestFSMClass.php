<?php

namespace ZendSearchTest\Lucene;

use ZendSearch\Lucene;

/**
 * @category   Zend
 * @package    Zend_Search_Lucene
 * @subpackage UnitTests
 */
class TestFSMClass extends Lucene\AbstractFSM
{
    const OPENED            = 0;
    const CLOSED            = 1;
    const CLOSED_AND_LOCKED = 2;

    const OPENED_AND_LOCKED = 3; // Wrong state, should not be used


    const OPEN   = 0;
    const CLOSE  = 1;
    const LOCK   = 3;
    const UNLOCK = 4;

    /**
     * Object to trace FSM actions
     *
     * @var FSMData
     */
    public $actionTracer;

    public function __construct()
    {
        $this->actionTracer = new FSMData();

        $this->addStates(array(self::OPENED, self::CLOSED, self::CLOSED_AND_LOCKED));
        $this->addInputSymbols(array(self::OPEN, self::CLOSE, self::LOCK, self::UNLOCK));

        $unlockAction     = new Lucene\FSMAction($this->actionTracer, 'action4');
        $openAction       = new Lucene\FSMAction($this->actionTracer, 'action6');
        $closeEntryAction = new Lucene\FSMAction($this->actionTracer, 'action2');
        $closeExitAction  = new Lucene\FSMAction($this->actionTracer, 'action8');

        $this->addRules(array( array(self::OPENED,            self::CLOSE,  self::CLOSED),
                               array(self::CLOSED,            self::OPEN,   self::OPEN),
                               array(self::CLOSED,            self::LOCK,   self::CLOSED_AND_LOCKED),
                               array(self::CLOSED_AND_LOCKED, self::UNLOCK, self::CLOSED, $unlockAction),
                             ));

        $this->addInputAction(self::CLOSED_AND_LOCKED, self::UNLOCK, $unlockAction);

        $this->addTransitionAction(self::CLOSED, self::OPENED, $openAction);

        $this->addEntryAction(self::CLOSED, $closeEntryAction);

        $this->addExitAction(self::CLOSED, $closeExitAction);
    }
}
