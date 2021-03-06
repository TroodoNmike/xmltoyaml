<?php
namespace XmlToYaml;

use Symfony\Component\Yaml\Yaml;

/*
 * Will convert xml format to yaml string
 */
class XmlToYaml
{
    /**
     * Options
     */
    protected $options = array(
        'parameters' => true,
        'services'   => true
        );

    /**
     * Will create object with options
     *
     * @param array $options pass options
     */
    public function __construct($options = array())
    {
        $this->options = array_merge($options, $this->options);
    }

    public function convert(\SimpleXMLElement $xml)
    {
        $data = array();

        if ($this->options['parameters']) {
            $data[] = $this->getParameters($xml);
        }

        if ($this->options['services']) {
            $data[] = $this->getServices($xml);
        }

        $string = '';

        foreach ($data as $value) {
            $string .= $value;
        }
        return $string;
    }

    /**
     * Will deal with parameter section
     *
     * @param object $xml
     *
     * @return string
     */
    protected function getParameters($xml)
    {
        $args = array();

        foreach ($xml->parameters->parameter as $argument) {
            $args[(string)$argument['key']] = (string)$argument;
        }

        $yaml = array('parameters' => $args);

        return Yaml::dump($yaml, 3);
    }

    /**
     * Will deal with service section
     *
     * @param object $xml
     * @return string
     */
    protected function getServices($xml)
    {
        $yaml = array('services' => array());

        foreach ($xml->services as $service) {

            $args = array();
            foreach ($service->service->argument as $argument) {
                $type = (string)$argument['type'];

                if ($type != '') {
                    $args[] = (string)"@" . (string)$argument['id'];
                } else {
                    $args[] = (string)$argument;
                }

            }

            $yaml['services'][(string)$service->service['id']] = array(
                'class' => (string)$service->service['class'],
                'arguments' => $args);
        }

        return Yaml::dump($yaml, 3);
    }
}
