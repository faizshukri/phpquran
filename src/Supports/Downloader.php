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

                if ($type == 'xml') {
                    $this->cleanXML($file);
                }
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

    public function cleanXML($file)
    {
        $str = file_get_contents($file);
        $re = '/(^\s*\#.*?(?=-))(-{2,})/m';
        preg_match($re, $str, $matches);

        $newStr = str_replace('-', '=', $matches[2]);
        $str = preg_replace($re, '$1' . $newStr, $str);

        file_put_contents($file, $str);
    }
}
