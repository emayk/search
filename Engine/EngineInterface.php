<?php

namespace VR\Search\Engine;

interface EngineInterface
{
    /**
     * @abstract
     * @param $i
     * @return EngineResultRow[]
     */
    public function getResultSet($start);

    public function getCount();
}
