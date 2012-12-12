<?php

namespace Virm\Search\Tests;

use Virm\Search\Search;
use Virm\Search\Engine\GoogleEngine;

class SearchTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testConstructor()
    {
        new Search('test');
    }

    public function testOffsetGet()
    {
        $googleEngine = new GoogleEngine('phpunit brutal ololo');
        $search = new Search($googleEngine);

        $resultRow = new \Virm\Search\Engine\EngineResultRow();
        $resultRow->setTitle('[00:00:47] <gerrit-wm> New review: jenkins-bot; "Build Failed ...');
        $resultRow->setLink('http://bots.wmflabs.org/~wm-bot/logs/%2523mediawiki/20120528.txt');
        $resultRow->setDescription('28 May 2012... <MaxSem> ololo [13:18:58] <Reedy> I\'m planning on branching and making   up .... [15:03:54] <chughakshay16> Reedy: i m running a phpunit test. ...... I don\'t   even need a clean way, i jus want to put some brutal code in this ...');

        preg_match('#q=(.*)&sa.*#', $search[0]->getLink(), $match);

        $this->assertEquals($resultRow->getLink(), $match[1], '[0]->getLink() returns an EngineResultRow Link of first position');
        $this->assertEquals($resultRow->getTitle(), $search[0]->getTitle(), '[0]->getTitle() returns an EngineResultRow Link of first position');
        $this->assertEquals($resultRow->getDescription(), $search[0]->getDescription(), '[0]->getDescription() returns an EngineResultRow Link of first position');
    }


}
