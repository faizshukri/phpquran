<?php

namespace FaizShukri\Quran\Supports;

use GuzzleHttp\Client;

class Downloader
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function sync($type = 'xml')
    {
        $translations = (array) $this->config->get('translations');

        // Download quran data
        foreach ($translations as $tr) {
            $file = $this->config->get('storage_path').'/'.$tr.'.'.$type;

            if (!file_exists($file)) {
                $url = 'http://tanzil.net/trans/?transID='.$tr.'&type='.$type;
                $this->download($url, $file);
            }
        }
    }

    public function download($url, $destination)
    {
        $client = new Client();
        $res = $client->get($url);
        file_put_contents($destination, $res->getBody());
    }
}
