<?php

use FaizShukri\Quran\Supports\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    private $config;

    public function setUp()
    {
        $this->config = new Config([ 'level1' => 'yes', 'level2' => [ 'cool' => 'nice', 'great' => [ 'fantastic' => 'deep' ] ] ]);
    }

    public function test_get()
    {
        $this->assertEquals('yes', $this->config->get('level1'));
    }

    public function test_build_config()
    {
        $this->assertCount(5, $this->config->all() );
    }

    public function test_get_deep()
    {
        $this->assertEquals('nice', $this->config->get('level2.cool'));
        $this->assertEquals('deep', $this->config->get('level2.great.fantastic'));
    }
}