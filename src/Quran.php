<?php

namespace FaizShukri\Quran;

use FaizShukri\Quran\Repositories\Source\SourceInterface;
use FaizShukri\Quran\Exceptions\AyahNotProvided;
use FaizShukri\Quran\Exceptions\WrongArgument;
use FaizShukri\Quran\Repositories\Source\XMLRepository;
use FaizShukri\Quran\Supports\Config;

class Quran
{
    private $config;

    private $translations = ['ar'];

    private $source;

    public function __construct(array $config = array())
    {
        $this->config = new Config($config);

        // By default, source is XML
        $this->setSource( new XMLRepository() );
    }

    /**
     * Set quran source either XML, Sql
     *
     * @param \FaizShukri\Quran\Repositories\Source\SourceInterface $source
     */
    public function setSource(SourceInterface $source)
    {
        $this->source = $source;
        $this->source->setConfig( $this->config );
        $this->source->initialize();
    }

    /**
     * Set translations to be used
     *
     * @param array $translations
     *
     * @return self
     */
    public function translation($translations)
    {
        if (is_array($translations)) {
            $this->translations = $translations;
        } else {
            $this->translations = explode(',', str_replace(' ', '', $translations));
        }

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

        if (sizeof($args) <= 1) {
            throw new AyahNotProvided("Ayah argument was not provided. Give at least one ayah from a surah.");
        }

        // Get text for all translation
        foreach ($this->translations as $translation) {

            // Parse ayah arguments into array of ayah
            $ayah = $this->parseSurah($args[1]);

            // Check if Surah and Ayah is in correct format
            if (!is_numeric($args[0]) || sizeof($ayah) === 0) {
                throw new WrongArgument("Surah / Ayah format was incorrect. Please try again.");
            }

            $result[$translation] = $this->source->ayah($args[0], $ayah, $translation);
        }

        return $this->minimize($result);
    }

    /**
     * Get array of chapters information
     *
     * @return array Array of object for each chapter
     */
    public function chapters()
    {
        return $this->source->chapters();
    }

    /**
     * Get single chapter information
     *
     * @return object Chapter information of a chapter
     */
    public function chapter($chapter)
    {
        return $this->source->chapter($chapter);
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
                for ($i = $dash[0]; $i <= $dash[1]; $i++) {
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

}
