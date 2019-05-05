<?php

namespace ZendSearchTest\Lucene;

use ZendSearch\Lucene;

class TestPriorityQueueClass extends Lucene\AbstractPriorityQueue
{
    /**
     * Compare elements
     *
     * Returns true, if $el1 is less than $el2; else otherwise
     *
     * @param mixed $el1
     * @param mixed $el2
     * @return boolean
     */
    protected function _less($el1, $el2)
    {
        return ($el1 < $el2);
    }
}
