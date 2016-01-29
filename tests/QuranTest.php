<?php

use FaizShukri\Quran\Quran;

class QuranTest extends PHPUnit_Framework_TestCase
{
    private $quran;

    public function setUp()
    {
        $this->quran = new Quran();
    }

    public function test_single_ayah()
    {
        $this->assertEquals('ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', $this->quran->text('1:3'));
    }

    public function test_single_ayah_translation()
    {
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $this->quran->translation('en.sahih')->text('1:3'));
    }

    public function test_single_ayah_translation_short()
    {
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $this->quran->translation('en')->text('1:3'));
    }

    public function test_single_ayah_multiple_translation()
    {
        $res = $this->quran->translation(['ar', 'en'])->text('1:3');

        $this->assertEquals('ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', $res['ar']);
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $res['en']);
    }

    public function test_multiple_ayah()
    {
        $this->assertCount(3, $this->quran->text('1:3,4,5'));
    }

    public function test_multiple_ayah_multiple_translation()
    {
        $res = $this->quran->translation(['ar', 'en'])->text('1:3,4,5');

        $this->assertCount(3, $res['ar']);
        $this->assertCount(3, $res['en']);
    }

    public function test_range_ayah()
    {
        $this->assertCount(3, $this->quran->text('1:3-5'));
    }

    public function test_range_ayah_translation()
    {
        $res = $this->quran->translation(['ar', 'en'])->text('1:3-5');

        $this->assertCount(3, $res['ar']);
        $this->assertCount(3, $res['en']);
    }

    public function test_mix_ayah()
    {
        $this->assertCount(4, $this->quran->text('1:2,4-6'));
    }

    public function test_mix_ayah_translation()
    {
        $res = $this->quran->translation(['ar', 'en'])->text('1:2, 4-6');

        $this->assertCount(4, $res['ar']);
        $this->assertCount(4, $res['en']);
    }

    public function test_mix_ayah_translation_sort()
    {
        $res = $this->quran->translation(['ar', 'en'])->text('2:4-6,8,11-13,2');

        $this->assertCount(8, $res['ar']);
        $this->assertCount(8, $res['en']);

        $res = $res['en'];

        $this->assertEquals('2', key($res)); next($res);
        $this->assertEquals('4', key($res)); next($res);
        $this->assertEquals('5', key($res)); next($res);
        $this->assertEquals('6', key($res)); next($res);
        $this->assertEquals('8', key($res)); next($res);
        $this->assertEquals('11', key($res)); next($res);
        $this->assertEquals('12', key($res)); next($res);
        $this->assertEquals('13', key($res));
    }
}
