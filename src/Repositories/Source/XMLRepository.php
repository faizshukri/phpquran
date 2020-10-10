<?php

namespace FaizShukri\Quran\Repositories\Source;

use FaizShukri\Quran\Exceptions\AyahInvalid;
use FaizShukri\Quran\Exceptions\SurahInvalid;
use FaizShukri\Quran\Exceptions\TranslationNotExists;
use FaizShukri\Quran\Supports\Config;
use FaizShukri\Quran\Supports\Downloader;
use FaizShukri\Quran\Supports\XML;

class XMLRepository implements SourceInterface
{
    private $config;

    public function setConfig(Config $config)
    {
        $this->config = $config;
    }

    public function surah($surah = null)
    {
        if (is_int($surah) && ($surah < 1 || $surah > 114)) {
            throw new SurahInvalid();
        }

        $xmlFile = $this->config->get('storage_path').'/quran-data.xml';
        $xml = new XML($xmlFile);

        $xpath = '//suras/sura';

        if ($surah != null) {
            $xpath .= "[@index={$surah}]";
        }

        $xpathResult = $xml->find($xpath);

        if ($surah != null) {
            $sura = (array) current($xpathResult);
            return $sura['@attributes'];
        }

        // If `$surah` is null, then get all chapters
        $result = [];

        foreach ($xpathResult as $node) {
            $node = (array) $node;
            $verse = $node['@attributes'];
            $result[$verse['index']] = (object) $verse;
        }

        return $result;
    }

    public function ayah($surah, $ayah, $translation = 'ar')
    {
        $xmlFile = $this->config->get('storage_path').'/'.$translation.'.xml';

        // If files not exist, get the first match
        if (!file_exists($xmlFile)) {
            $xmlFile = $this->firstMatchAvailableTranslation($translation);
        }

        if ($xmlFile === false) {
            throw new TranslationNotExists('Translation \''.$translation."' didn't exists. Add it to config first before use.");
        }

        $xml = new XML($xmlFile);
        $result = [];

        $max_ayah = intval($this->surah(intval($surah))['ayas']);
        $xpath = '//sura[@index='.$surah.']/aya['.implode(' or ', array_map(function ($a) use ($max_ayah) {
                if ($a > $max_ayah) {
                    throw new AyahInvalid();
                }

                return '@index='.$a;
            }, $ayah)).']';

        $xpathResult = $xml->find($xpath);

        foreach ($xpathResult as $node) {
            $node = (array) $node;
            $verse = $node['@attributes'];
            $result[$verse['index']] = $verse['text'];
        }

        return $result;
    }

    public function initialize()
    {
        // If original quran not exist in storage_path, copy one
        $quran_source = realpath(__DIR__.'/../../../data/ar.quran.xml');
        $quran_dest = $this->config->get('storage_path').'/ar.quran.xml';

        $meta_source = realpath(__DIR__.'/../../../data/quran-data.xml');
        $meta_dest = $this->config->get('storage_path').'/quran-data.xml';

        // If storage path didn't exist, create it
        if (!file_exists($this->config->get('storage_path'))) {
            mkdir($this->config->get('storage_path'));
        }

        // Copy quran
        if (!file_exists($quran_dest)) {
            copy($quran_source, $quran_dest);
        }

        // Copy metadata
        if (!file_exists($meta_dest)) {
            copy($meta_source, $meta_dest);
        }

        // Sync translation files to storage path
        $dw = new Downloader($this->config);
        $dw->sync();
    }

    /**
     * Get the first match xml from translation.
     *
     * @param string $translation Translation prefix or short form
     *
     * @return string|false String of path to the translation if exists, or false otherwise
     */
    private function firstMatchAvailableTranslation($translation)
    {
        $dir = new \DirectoryIterator($this->config->get('storage_path'));

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();

                // If match the first file with translation prefix, return it
                $yes = preg_match('/^'.$translation.'/', $filename);
                if ($yes === 1) {
                    return $this->config->get('storage_path').'/'.$filename;
                }
            }
        }

        return false;
    }


    public function translations()
    {
        $dir = scandir($this->config->get('storage_path'));
        $translations = array_filter($dir, function($a){
            return ($a !== "." && $a !== ".." && $a !== 'quran-data.xml');
        });

        return array_values(
            array_map(function($a){ return str_replace(".xml", "", $a); }, $translations)
        );
    }
}
