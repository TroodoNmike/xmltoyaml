<?php
use XmlToYaml\XmlToYaml;

class XmlToYamlTest extends PHPUnit_Framework_TestCase
{
    protected $xml;

    public function setUp()
    {
        $xmlString = '<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">

    <parameters>
        <!-- ... -->
        <parameter key="mailer.transport">sendmail</parameter>
        <parameter key="another.mailer">helloThere</parameter>
    </parameters>

    <services>
        <service id="mailer" class="Some\Mailer">
            <argument>%mailer.transport%</argument>
        </service>

        <service id="newsletter_manager" class="NewsletterManager">
            <call method="setMailer">
                 <argument type="service" id="mailer" />
            </call>
        </service>
    </services>
</container>';
        $this->xml = new \SimpleXMLElement($xmlString);
    }

    public function testInit()
    {
        $stack = array();

        $xml = new XmlToYaml;
        $output = $xml->convert($this->xml);
        $this->assertEquals(0, 0);
    }
}
