<?php

namespace ZendSearchTest\Lucene;

class DocHighlightingContainer
{
    public static function extendedHighlightingCallback($stringToHighlight, $param1, $param2)
    {
        return '<b ' . $param1 . '>' . $stringToHighlight . '</b>' . $param2;
    }
}
