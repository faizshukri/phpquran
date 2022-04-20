<?php

use FaizShukri\Quran\Supports\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    private $config;

    /**
     * @before
     */
    protected function initialize()
    {
        $this->config = new Config([
            'level1' => 'yes',
            'level2' => [
                'cool' => 'nice', 'great' => [
                    'fantastic' => 'deep',
                ],
            ],
            'limit' => [
                'ayah' => '5',
            ],
        ]);
    }

    public function test_get()
    {
        $this->assertEquals('yes', $this->config->get('level1'));
    }

    public function test_build_config()
    {
        $this->assertCount(5, $this->config->all());
    }

    public function test_get_deep()
    {
        $this->assertEquals('nice', $this->config->get('level2.cool'));
        $this->assertEquals('deep', $this->config->get('level2.great.fantastic'));
    }

    public function test_build_merge_deep()
    {
        $this->assertEquals(5, $this->config->get('limit.ayah'));
        $this->assertEquals(3, $this->config->get('limit.translation'));
    }

    public function test_add_translation()
    {
        $translationId = 'ms.basmeih';

        copy($this->config->configFile, "{$this->config->configFile}.bak");
        $this->config->addTranslation($translationId);
        $config = include $this->config->configFile;
        copy("{$this->config->configFile}.bak", $this->config->configFile);
        unlink("{$this->config->configFile}.bak");

        $this->assertContains($translationId, $config['translations']);
        $this->assertContains($translationId, $this->config->get('translations'));
    }
}
