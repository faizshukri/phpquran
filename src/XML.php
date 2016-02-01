<?php

namespace FaizShukri\Quran;

class XML
{
    private $xml;

    public function __construct($xmlPath)
    {
        $this->xml = $this->pathToXML($xmlPath);
    }

    public function find($surah, array $ayah)
    {
        $xml = new \SimpleXMLElement($this->xml);

        $xpath = '//sura[@index=' . $surah . ']/aya[' . implode(' or ', array_map(function ($a) {
                return '@index=' . $a;
            }, $ayah)) . ']';

        $xpathResult = $xml->xpath($xpath);
        $result = [];

        while (list(, $node) = each($xpathResult)) {
            $node = (array)$node;
            $verse = current($node);
            $result[$verse['index']] = $verse['text'];
        }

        return $result;
    }

    public function pathToXML($xmlPath)
    {
        $xml = fopen($xmlPath, "r");
        $res = fread($xml, filesize($xmlPath));
        fclose($xml);

        return $res;
    }
}