<?php

namespace FaizShukri\Quran;

use FaizShukri\Quran\Repositories\Source\SourceInterface;
use FaizShukri\Quran\Repositories\Source\XMLRepository;
use FaizShukri\Quran\Exceptions\AyahNotProvided;
use FaizShukri\Quran\Exceptions\WrongArgument;
use FaizShukri\Quran\Exceptions\ExceedLimit;
use FaizShukri\Quran\Supports\Config;

class Quran
{
    /**
     * Quran application version.
     *
     * @var string
     */
    const VERSION = '1.0.1';

    private $config;

    private $translations = ['ar'];

    private $source;

    public function __construct(array $config = array())
    {
        $this->config = new Config($config);

        // By default, source is XML
        $this->setSource(new XMLRepository());
    }

    /**
     * Set quran source either XML, Sql.
     *
     * @param \FaizShukri\Quran\Repositories\Source\SourceInterface $source
     */
    public function setSource(SourceInterface $source)
    {
        $this->source = $source;
        $this->source->setConfig($this->config);
        $this->source->initialize();
    }

    /**
     * Get source variable.
     *
     * @return \FaizShukri\Quran\Repositories\Source\SourceInterface $source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set translations to be used.
     *
     * @param array|string $translations
     *
     * @return self
     */
    public function translation($translations)
    {
        if (is_string($translations)) {
            $translations = explode(',', str_replace(' ', '', $translations));
        }

        if (sizeof($translations) > $this->config->get('limit.translation')) {
            throw new ExceedLimit('Too much translation provided. Your limit is '.$this->config->get('limit.translation').' only.');
        }

        $this->translations = $translations;

        return $this;
    }

    /**
     * Get ayah.
     *
     * @param string $args String of supported format of ayah
     *
     * @return string|array Ayah
     *
     * @throws AyahNotProvided
     * @throws WrongArgument
     */
    public function get($args)
    {
        $args = explode(':', $args);
        $result = [];
        $surah = $args[0];

        if (sizeof($args) <= 1) {
            throw new AyahNotProvided();
        }

        // Parse ayah arguments into array of ayah
        $ayah = $this->parseSurah($args[1]);

        if (sizeof($ayah) > $this->config->get('limit.ayah')) {
            throw new ExceedLimit('Too much ayah provided. Your limit is '.$this->config->get('limit.ayah').' only.');
        }

        // Check if Surah and Ayah is in correct format
        if (!is_numeric($surah) || sizeof($ayah) === 0) {
            throw new WrongArgument();
        }

        // Get text for all translation
        foreach ($this->translations as $translation) {
            $result[$translation] = $this->source->ayah($surah, $ayah, $translation);
        }

        return $this->minimize($result);
    }

    /**
     * Get surah information.
     *
     * @return object Chapter information of a chapter
     */
    public function surah($surah = null)
    {
        return $this->source->surah($surah);
    }

    /**
     * Parse the ayah requested of a certain surah. The format of ayah will
     * be translated into an array or ayah.
     *
     * @param string $surah
     *
     * @return array Array of ayah
     */
    private function parseSurah($surah)
    {
        $result = [];

        foreach (explode(',', $surah) as $comma) {
            $dash = explode('-', $comma);

            // Skip any invalid ayah
            if (!is_numeric($dash[0]) || (isset($dash[1]) && !is_numeric($dash[1]))) {
                continue;
            }

            // Single ayah, just push it into array.
            if (sizeof($dash) === 1) {
                array_push($result, intval($dash[0]));
            } // Range ayah, so we create all ayah in between.
            else {
                for ($i = $dash[0]; $i <= $dash[1]; ++$i) {
                    array_push($result, intval($i));
                }
            }
        }

        return $result;
    }

    /**
     * Sort array in ascending by it's key.
     *
     * @param array $arr
     *
     * @return array
     */
    private function sortArray(array $arr)
    {
        ksort($arr, SORT_NUMERIC);

        return $arr;
    }

    /**
     * Reduce the array level by remove unnecessary parent.
     *
     * @param array $array
     *
     * @return array
     */
    private function minimize(array $array)
    {
        foreach ($array as $key => $translation) {

            // If one ayah is requested, we remove it's key
            if (sizeof($translation) === 1) {
                $array[$key] = $translation[key($translation)];
            } // Else we maintain current format, but in sorted form
            else {
                $array[$key] = $this->sortArray($translation);
            }
        }

        // If one translation is requested, we remove it's key.
        // Else just return the current format
        return (sizeof($array) > 1) ? $array : $array[key($array)];
    }

    /**
     * Get the Quran Application version.
     *
     * @return string
     */
    public static function version()
    {
        return 'v' . static::VERSION;
    }
}
