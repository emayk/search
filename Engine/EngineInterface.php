<?php

namespace Virm\Search\Engine;

interface EngineInterface
{
    /**
     * @abstract
     * @param $start
     * @return EngineResultRow[]
     */
    public function getResultSet($start);

    /**
     * @abstract
     * @return int
     */
    public function getCount();
}
