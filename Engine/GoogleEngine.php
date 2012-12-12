<?php

namespace Virm\Search\Engine;

use Virm\Search\Http\Curl;
use Virm\Search\Engine\EngineResultRow;
use Symfony\Component\DomCrawler\Crawler;

class GoogleEngine implements EngineInterface
{
    protected $term = null;

    protected $domain = 'http://www.google.com/';

    protected $query = 'search?q=%s&start=%d';

    protected $count = null;

    public function __construct($term)
    {
        if( ! $term) {
            throw new \InvalidArgumentException('Term can\'t be empty');
        }

        $this->term = urlencode($term);
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getCount()
    {
        if( ! $this->count) {
            $crawler = new Crawler($this->get(0));
            $countText = $crawler->filter('div#resultStats')->text();
            $this->count = (int)preg_replace('#\D#', '', $countText);
        }

        return $this->count;
    }

    /**
     * @param $start
     * @return EngineResultRow[]
     */
    public function getResultSet($start)
    {
        $crawler = new Crawler($this->get($start));

        $self = $this;
        $nodeValues = $crawler->filter('#search ol > li')->each(function ($node, $i) use ($self) {
            return $self->parseRow($node);
        });

        return $nodeValues;
    }

    /**
     * @param \DOMNode $node
     * @return EngineResultRow
     */
    public function parseRow(\DOMNode $node)
    {
        $nodeCrawler = new Crawler($node, $this->domain);
        $result = new EngineResultRow();

        $result->setTitle($nodeCrawler->filter('h3.r a')->text());
        $result->setLink($nodeCrawler->filter('h3.r a')->link()->getUri());

        $description = $nodeCrawler->filter('span.st');
        if( ! $description->count() == 0) {
            $result->setDescription($description->text());
        }

        return $result;
    }

    protected function get($start)
    {
        return Curl::get(sprintf($this->getDomain().$this->query, $this->term, $start));
    }
}