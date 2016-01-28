<?php

namespace FaizShukri\Quran;

use GuzzleHttp\Client;

class Downloader
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function sync()
    {
        // Download quran data
        foreach ($this->config['translations'] as $tr) {
            $type = 'xml';
            $file = $this->config['storage_path'] . '/' . $tr . '.' . $type;

            if (!file_exists($file)) {
                $url = 'http://tanzil.net/trans/?transID=' . $tr . '&type=' . $type;
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
