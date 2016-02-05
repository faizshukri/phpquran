<?php

namespace FaizShukri\Quran\Repositories\Source;

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
        $xmlFile = $this->config->get('storage_path') . '/' . $translation . '.xml';

        // If files not exist, get the first match
        if (!file_exists($xmlFile)) {
            $xmlFile = $this->firstMatchAvailableTranslation($translation);
        }

        if ($xmlFile === false) {
            throw new TranslationNotExists("Translation " . $translation . " didn't exists. Please check your config.");
        }

        $xml = new XML($xmlFile);
        return $xml->find($surah, $ayah);
    }

    public function initialize()
    {
        // If original quran not exist in storage_path, copy one
        $source = realpath(__DIR__ . '/../../../data/ar.quran.xml');
        $dest = $this->config->get('storage_path') . '/ar.quran.xml';
        if (!file_exists($dest)) {

            // If storage path didn't exist, create it
            if (!file_exists($this->config->get('storage_path'))) {
                mkdir($this->config->get('storage_path'));
            }
            copy($source, $dest);
        }

        // Sync translation files to storage path
        $dw = new Downloader($this->config);
        $dw->sync();
    }

    private function firstMatchAvailableTranslation($translation)
    {
        $dir = new \DirectoryIterator($this->config->get('storage_path'));

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $filename = $fileinfo->getFilename();

                // If match the first file with translation prefix, return it
                $yes = preg_match('/^' . $translation . '/', $filename);
                if ($yes === 1) {
                    return $this->config->get('storage_path') . '/' . $filename;
                }
            }
        }

        return false;
    }

}