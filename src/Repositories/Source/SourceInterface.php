<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Supports\Config;

interface SourceInterface
{
    public function setConfig(Config $config);

    public function initialize();

    /**
     * @param int|null $surah Surah number
     *
     * @return array|object
     */
    public function surah($surah = null);

    // Get ayah
    public function ayah($surah, $ayah, $translation = 'ar');
}
