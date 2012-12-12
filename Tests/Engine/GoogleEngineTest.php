<?php

namespace VR\Search\Tests\Engine;

use VR\Search\Engine\GoogleEngine;

class GoogleEngineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructor()
    {
        new GoogleEngine('');
    }

    public function testGet()
    {

    }

    public function testParseRow()
    {
        $googleEngine = new GoogleEngine('phpunit brutal ololo');
        $link = 'url?q=http://youtube.com';
        $title = 'mocking Question,<em>PHPUnit</em> - creating Mock objects to act as stubs <b>...</b>';
        $description = '<span class="f">21 Jul 2010 </span>I am trying to configure a Mock object in <em>PHPunit</em><br>';

        $nodeHTML = '
            <li class="g">
                <div sig="BSU" class="vsc">
                    <h3 class="r">
                        <a href="%s">%s</a>
                    </h3>
                    <div class="s">
                        <span class="st">%s</span>
                    </div>
                </div>
            </li>
        ';

        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->loadHTML(sprintf($nodeHTML, $link, $title, $description));

        $resultRow = new \VR\Search\Engine\EngineResultRow();
        $resultRow->setTitle(strip_tags($title));
        $resultRow->setLink($googleEngine->getDomain() . $link);
        $resultRow->setDescription(strip_tags($description));

        $this->assertEquals($resultRow, $googleEngine->parseRow($dom), '->parseRow() returns an EngineResultRow object');
    }
}
