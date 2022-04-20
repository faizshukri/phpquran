<?php

use FaizShukri\Quran\Supports\Levenshtein;
use PHPUnit\Framework\TestCase;

class LevenshteinTest extends TestCase
{
    private $words;

    private $l;

    /**
     * @before
     */
    protected function initialize()
    {
        $this->words = [
            'Al-Faatiha',
            'Al-Fath',
            'An-Nisaa',
            'An-Nahl',
            'An-Naml',
            'Al-Asr',
            'An-Nasr',
            'An-Naas',
            'Yunus',
            'Yusuf',
            'Al-Hajj',
            'Al-Hashr',
            'Ash-Shu\'araa',
            'Ash-Shura',
            'As-Saff',
            'As-Saaffaat',
        ];

        $this->l = new Levenshtein();
    }

    public function test_exact_match()
    {
        $result = $this->l->closest('Al-Faatiha', $this->words);
        $this->assertCount(1, $result);
        $this->assertContains('Al-Faatiha', $result);
    }

    public function test_closest_1()
    {
        $result = $this->l->closest('fathi', $this->words);
        $this->assertCount(1, $result);
        $this->assertContains('Al-Fath', $result);
    }

    public function test_closest_2()
    {
        $result = $this->l->closest('nass', $this->words);
        $this->assertCount(2, $result);
        $this->assertContains('An-Nasr', $result);
        $this->assertContains('An-Naas', $result);
    }

    public function test_closest_3()
    {
        $result = $this->l->closest('feve', $this->words);
        $this->assertCount(0, $result);
    }
}
