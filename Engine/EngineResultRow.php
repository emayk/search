<?php

namespace VR\Search\Engine;

class EngineResultRow
{
    protected $title = null;

    protected $link = null;

    protected $description = null;

    public function setTitle($title)
    {
        $this->title = htmlspecialchars($title);
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setDescription($description)
    {
        $this->description = htmlspecialchars($description);
    }

    public function getDescription()
    {
        return $this->description;
    }
}