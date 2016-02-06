<?php

namespace FaizShukri\Quran\Supports;

class XML
{
    private $xml;

    public function __construct($xmlPath)
    {
        $this->xml = $this->pathToXML($xmlPath);
    }

    public function find($xpath)
    {
        $xml = new \SimpleXMLElement($this->xml);

        return $xml->xpath($xpath);
    }

    public function pathToXML($xmlPath)
    {
        $xml = fopen($xmlPath, 'r');
        $res = fread($xml, filesize($xmlPath));
        fclose($xml);

        return $res;
    }
}
