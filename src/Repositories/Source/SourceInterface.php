<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Supports\Config;

interface SourceInterface
{
    public function setConfig(Config $config);

    public function initialize();

    // Information of all surah
    public function chapters();

    // Information of a surah
    public function chapter($chapter);

    // Get ayah
    public function ayah($surah, $ayah, $translation = 'ar');
}
