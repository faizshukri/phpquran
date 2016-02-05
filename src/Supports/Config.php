<?php

namespace FaizShukri\Quran\Supports;

class Config
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $this->buildConfig($config);
    }

    private function buildConfig(array $config = [], $sapi = "")
    {
        if(strlen($sapi) == 0) $sapi = php_sapi_name();

        // Merge our config with user config
        $result = array_merge((include realpath(__DIR__ . '/../../config/quran.php')), $config);

        // If function storage_path is exist (laravel), we update the path to laravel's storage path
        if (function_exists('storage_path') && $sapi !== 'cli') {
            $result['storage_path'] = storage_path('app' . DIRECTORY_SEPARATOR . $result['storage_path']);
        }

        return $result;
    }

    public function get($val)
    {
        return $this->config[$val];
    }
}