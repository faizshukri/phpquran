<?php

namespace FaizShukri\Quran;

use FaizShukri\Quran\Exceptions\AyahNotProvided;
use FaizShukri\Quran\Exceptions\TranslationNotExists;
use FaizShukri\Quran\Exceptions\WrongArgument;

class Quran
{
    private $config;

    private $translations = ['ar'];

    public function __construct(array $config = array())
    {
        // Merge our config with user config
        $this->config = array_merge((include realpath(__DIR__ . '/../config/quran.php')), $config);

        // If function storage_path is exist (laravel), we update the path to laravel's storage path
        if (function_exists('storage_path') && php_sapi_name() !== 'cli') {
            $this->config['storage_path'] = storage_path('app' . DIRECTORY_SEPARATOR . $this->config['storage_path']);
        }

        $this->initialize();
    }

    private function initialize()
    {
        // If original quran not exist in storage_path, copy one
        $source = __DIR__ . '/../data/ar.quran.xml';
        $dest = $this->config('storage_path') . '/ar.quran.xml';
        if (!file_exists($dest)) {

            // If storage path didn't exist, create it
            if (!file_exists($this->config('storage_path'))) {
                mkdir($this->config('storage_path'));
            }
            copy($source, $dest);
        }

        // Sync translation files to storage path
        $dw = new Downloader($this->config);
        $dw->sync();
    }

    /**
     * Set translations to be used
     *
     * @param array $translation
     * @return $this
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

    public function get($args)
    {
        $args = explode(':', $args);
        $result = [];

        if (sizeof($args) <= 1) {
            throw new AyahNotProvided("Ayah argument was not provided. Give at least one ayah from a surah.");
        }

        // Get text for all translation
        foreach ($this->translations as $translation) {

            $xmlFile = $this->config('storage_path') . '/' . $translation . '.xml';

            // If files not exist, get the first match
            if (!file_exists($xmlFile)) {
                $xmlFile = $this->firstMatchAvailableTranslation($translation);
            }

            if (!$xmlFile) {
                throw new TranslationNotExists("Translation " . $translation . " didn't exists. Please check your config.");
            }

            // Parse ayah arguments into array of ayah
            $ayah = $this->parseSurah($args[1]);

            // Check if Surah and Ayah is in correct format
            if (!is_numeric($args[0]) || sizeof($ayah) === 0) {
                throw new WrongArgument("Surah / Ayah format was incorrect. Please try again.");
            }

            $xml = new XML($xmlFile);
            $res = $xml->find($args[0], $ayah);
            $result[$translation] = $res;
        }

        return $this->minimize($result);
    }

    public function config($val)
    {
        return $this->config[$val];
    }

    private function firstMatchAvailableTranslation($translation)
    {
        $dir = new \DirectoryIterator($this->config('storage_path'));

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();

                // If match the first file with translation prefix, return it
                $yes = preg_match('/^' . $translation . '/', $filename);
                if ($yes === 1) {
                    return $this->config('storage_path') . '/' . $filename;
                }
            }
        }

        return false;
    }

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

    private function sortArray(array $arr)
    {
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }

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
