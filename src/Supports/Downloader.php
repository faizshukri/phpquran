<?php

namespace FaizShukri\Quran\Supports;

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
            $file = $this->config->get('storage_path') . '/' . $tr . '.' . $type;

            if (!file_exists($file)) {
                if (php_sapi_name() === 'cli') {
                    echo "Downloading translation \e[32m$tr\e[0m ...\n";
                }

                $url = 'http://tanzil.net/trans/?transID=' . $tr . '&type=' . $type;
                $this->download($url, $file);
            }
        }
    }

    public function download($url, $destination)
    {
        $fp = fopen($destination, 'w+');
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_FILE => $fp,
            CURLOPT_FOLLOWLOCATION => true
        ]);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
    }
}
