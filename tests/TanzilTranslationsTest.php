<?php

use FaizShukri\Quran\Quran;
use FaizShukri\Quran\TanzilTranslations;
use PHPUnit\Framework\TestCase;

class TanzilTranslationsTest extends TestCase
{
    private $tanzilTranslations;

    /**
     * @before
     */
    protected function initialize()
    {
        $this->tanzilTranslations = new TanzilTranslations();
    }

    public function test_get()
    {
        $this->assertEquals([
            'id' => 'ms.basmeih',
            'language' => 'Malay',
            'name' => 'Basmeih',
            'translator' => 'Abdullah Muhammad Basmeih'
        ], $this->tanzilTranslations->get('ms.basmeih'));

        $this->assertTrue(sizeof($this->tanzilTranslations->get()) > 100);
        $this->assertEquals(null, $this->tanzilTranslations->get('notexist'));
    }
}
