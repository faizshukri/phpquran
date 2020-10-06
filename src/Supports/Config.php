<?php

namespace FaizShukri\Quran\Supports;

class Config
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $this->buildConfig($config);
        $this->config['translations'] = array_merge($this->config['translations'], $this->customTranslations());
    }

    /**
     * Build a config array. Merge user defined config with our default config.
     *
     * @param array $config User defined config
     * @return array New configuration array
     */
    private function buildConfig(array $config = [])
    {
        // Merge our config with user config
        $result = array_replace_recursive((include realpath(__DIR__.'/../../config/quran.php')), $config);

        // If function storage_path is exist (laravel), we update the path to laravel's storage path
        if (function_exists('storage_path') && php_sapi_name() !== 'cli') {
            $result['storage_path'] = storage_path('app/' . $result['storage_path']);
        } else {
            $result['storage_path'] = realpath(__DIR__ . '/../..') . '/' . $result['storage_path'];
        }

        // Merge translation with custom translation variable
        

        return $result;
    }

    /**
     * Get the config variable.
     *
     * @param string $val Variable name
     * @return array|string Variable value
     */
    public function get($val)
    {
        $configs = explode('.', $val);
        $first = $this->config[array_shift($configs)];

        foreach ($configs as $config) {
            $first = $first[$config];
        }

        return $first;
    }

    /**
     * Return all configurations.
     *
     * @return array
     */
    public function all()
    {
        return $this->config;
    }

    /**
     * Set/get custom translation
     *
     * @param string $id Translation ID
     * @return array|void
     */
    public function customTranslations($id = null)
    {
        $path = $this->config['storage_path'] . '/translation';
        if (!file_exists($this->config['storage_path'])) {
            mkdir($this->config['storage_path']);
        }

        if (!file_exists($path)) {
            touch($path);
        }

        $file = fopen($path, "a+");
        $contents = fread($file, filesize($path) ?: 1);

        $customTranslations = array_filter(explode(",", $contents));

        if ($id === null) {
            fclose($file);
            return $customTranslations;
        } else {
            if(!in_array($id, $customTranslations)){
                array_push($this->config['translations'], $id);
                fwrite($file, ",$id");
                fclose($file);
            }
        }
    }
}
