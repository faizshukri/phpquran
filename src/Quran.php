<?php

namespace FaizShukri\Quran;

class Quran
{
    private $config = [
        "storage_path" => 'data',
        "translations" => ["en.sahih"],
    ];

    private $translations = ['ar'];

    public function __construct(array $config = array())
    {
        $this->config = array_merge($this->config, $config);
        $this->initialize();
    }

    public function initialize()
    {
        // If original quran not exist in storage_path, copy one
        $source = __DIR__ . '/../data/ar.quran.xml';
        $dest = $this->config('storage_path').'/ar.quran.xml';
        if(!file_exists($dest)) {

            // If storage path didn't exist, create it
            if (!file_exists($this->config('storage_path'))) mkdir($this->config('storage_path'));
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
        if(is_array($translations))
            $this->translations = $translations;
        else
            $this->translations = [ $translations ];

        return $this;
    }

    public function text($args)
    {
        $args = explode(':', $args);
        $result = [];

        // Get text for all translation
        foreach($this->translations as $translation){

            $xmlFile = $this->config('storage_path') . '/' . $translation . '.xml';

            // If files not exist, get the first match
            if(!file_exists($xmlFile)){
                $xmlFile = $this->firstMatchAvailableTranslation($translation);
            }

            $xml = new XML( $xmlFile );
            $res = $xml->find($args[0], $this->parseSurah($args[1]));
            $result[$translation] = $res;
        }

        return (sizeof($result) > 1) ? $this->sortArray($result) : $this->sortArray($result[ key($result) ]) ;
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
                $yes = preg_match('/^'.$translation.'/', $filename);
                if($yes === 1) return $this->config('storage_path') . '/' . $filename;
            }
        }

        return false;
    }

    private function parseSurah($surah)
    {
        $result = [];

        foreach(explode(',', $surah) as $comma){

            $dash = explode('-', $comma);
            if(sizeof($dash) === 1) array_push($result, intval($dash[0]));
            else for($i = $dash[0]; $i <= $dash[1]; $i++) array_push($result, intval($i));
        }

        return $result;
    }

    private function sortArray(array $arr)
    {
        ksort($arr, SORT_NUMERIC);
        return $arr;
    }

}
