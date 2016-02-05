<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Supports\Config;

class SQLRepository implements SourceInterface
{
    private $config;

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function initialize()
    {

    }

    public function getAllSurah()
    {
        // TODO: Implement getAllSurah() method.
    }

    public function getSurah($surah)
    {
        // TODO: Implement getSurah() method.
    }

    public function getAyah($surah, $ayah, $translation = 'ar')
    {
        // TODO: Implement getAyah() method.
    }

}