<?php
use XmlToYaml\XmlToYaml;

class XmlToYamlTest extends PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $stack = array();

        $xml = new XmlToYaml;
        $this->assertEquals(0, 0);
    }
}
