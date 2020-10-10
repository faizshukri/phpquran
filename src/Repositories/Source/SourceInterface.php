<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Supports\Config;

interface SourceInterface
{
    public function setConfig(Config $config);

    public function initialize();

    /**
     * @param int|null $surah Surah number
     * @return array
     */
    public function surah($surah = null);

    /**
     * Get surah
     *
     * @param int $surah
     * @param array $ayah
     * @param string $translation
     * @return mixed
     */
    public function ayah($surah, $ayah, $translation = 'ar');

    /**
     * Get translations
     *
     * @return array
     */
    public function translations();
}
