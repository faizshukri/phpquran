<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Supports\Config;

interface SourceInterface
{
    public function setConfig(Config $config);

    public function initialize();

    // Information of all surah
    public function getAllSurah();

    // Information of a surah
    public function getSurah($surah);

    // Get ayah
    public function getAyah($surah, $ayah, $translation = 'ar');
}