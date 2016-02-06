<?php

namespace FaizShukri\Quran\Supports;

class Config
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $this->buildConfig($config);
    }

    /**
     * Build a config array. Merge user defined config with our default config.
     *
     * @param array $config User defined config
     *
     * @return array New configuration array
     */
    private function buildConfig(array $config = [])
    {
        // Merge our config with user config
        $result = array_merge((include realpath(__DIR__ . '/../../config/quran.php')), $config);

        // If function storage_path is exist (laravel), we update the path to laravel's storage path
        if (function_exists('storage_path') && php_sapi_name() !== 'cli') {
            $result['storage_path'] = storage_path('app' . DIRECTORY_SEPARATOR . $result['storage_path']);
        }

        return $result;
    }

    /**
     * Get the config variable
     *
     * @param string $val Variable name
     *
     * @return mixed Variable value
     */
    public function get($val)
    {
        return $this->config[$val];
    }
}