<?php

namespace FaizShukri\Quran\Supports;

class Config
{
    private $config;

    public $configFile;

    public $dataDir;

    public function __construct(array $config = [])
    {
        $this->config = $this->buildConfig($config);
    }

    /**
     * Build a config array. Merge user defined config with our default config.
     *
     * @param array $config User defined config
     * @return array New configuration array
     */
    private function buildConfig(array $config = [])
    {
        if (function_exists('config_path') && file_exists(config_path('quran.php'))) {
            $this->configFile = config_path('quran.php');
        } else {
            $this->configFile = realpath(__DIR__ . '/../../config/quran.php');
        }

        // Merge our config with user config
        $result = array_replace_recursive((include $this->configFile), $config);

        // If function storage_path is exist (laravel), we update the path to laravel's storage path
        if (function_exists('storage_path')) {
            $this->dataDir =  storage_path('app/' . $result['storage_path']);
        } else {
            $this->dataDir =  realpath(__DIR__ . '/../..') . '/' . $result['storage_path'];
        }

        $result['storage_path'] = $this->dataDir;
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

    public function addTranslation($id)
    {
        if (in_array($id, $this->config['translations'])) {
            return;
        }

        $configString = file_get_contents($this->configFile, true);
        $result = preg_replace('/([\'\"]translations[\'\"]\s+\=\>\s+\[[a-z\"\'\.\,\s]+)/i', "\\1, '$id'", $configString);
        file_put_contents($this->configFile, $result);
        array_push($this->config['translations'], $id);
    }
}
