<?php

namespace Virm\Search;

use Virm\Search\Engine\EngineInterface;

class Search implements \Iterator, \ArrayAccess
{
    protected $limit = null;
    /**
     * @var \Virm\Search\Engine\EngineInterface
     */
    protected $engine = null;

    protected $start = 0;

    protected $data = array();

    protected $position = 0;

    public function __construct(EngineInterface $engine, $limit = 10)
    {
        $this->engine = $engine;
        $this->limit = $limit;
    }

    public function valid()
    {
        return $this->position < min($this->limit, $this->engine->getCount());
    }

    public function next()
    {
        ++$this->position;
    }

    public function current()
    {
        if( ! isset($this->data[$this->position - $this->start])) {
            $this->data = $this->engine->getResultSet($this->position);
            $this->start = $this->position;
        }

        return $this->data[$this->position - $this->start];
    }

    public function key()
    {
        return $this->position;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function offsetExists ($offset)
    {
        return $offset < min($this->limit, $this->engine->getCount());
    }

    public function offsetGet($offset )
    {
        $this->position = $offset;
        return $this->current();
    }

    public function offsetUnset($offset) {}

    public function offsetSet($offset, $value){}
}