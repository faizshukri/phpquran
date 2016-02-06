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
        $this->assertEquals('ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', $this->quran->get('1:3'));
    }

    public function test_single_ayah_translation()
    {
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $this->quran->translation('en.sahih')->get('1:3'));
    }

    public function test_single_ayah_translation_short()
    {
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $this->quran->translation('en')->get('1:3'));
    }

    public function test_single_ayah_multiple_translation()
    {
        $res = $this->quran->translation(['ar', 'en'])->get('1:3');

        $this->assertEquals('ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', $res['ar']);
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $res['en']);
    }

    public function test_single_ayah_multiple_translation_short()
    {
        $res = $this->quran->translation('ar,en')->get('1:3');

        $this->assertEquals('ٱلرَّحْمَٰنِ ٱلرَّحِيمِ', $res['ar']);
        $this->assertEquals('The Entirely Merciful, the Especially Merciful,', $res['en']);
    }

    public function test_multiple_ayah()
    {
        $this->assertCount(3, $this->quran->get('1:3,4,5'));
    }

    public function test_multiple_ayah_multiple_translation()
    {
        $res = $this->quran->translation('ar,en')->get('1:3,4,5');

        $this->assertCount(3, $res['ar']);
        $this->assertCount(3, $res['en']);
    }

    public function test_range_ayah()
    {
        $this->assertCount(3, $this->quran->get('1:3-5'));
    }

    public function test_range_ayah_translation()
    {
        $res = $this->quran->translation('ar,en')->get('1:3-5');

        $this->assertCount(3, $res['ar']);
        $this->assertCount(3, $res['en']);
    }

    public function test_mix_ayah()
    {
        $this->assertCount(4, $this->quran->get('1:2,4-6'));
    }

    public function test_mix_ayah_translation()
    {
        $res = $this->quran->translation('ar,en')->get('1:2, 4-6');

        $this->assertCount(4, $res['ar']);
        $this->assertCount(4, $res['en']);
    }

    public function test_mix_ayah_translation_sort()
    {
        $res = $this->quran->translation('ar,en')->get('2:4-6,8,11-13,2');

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

    public function test_multiple_ayah_mix_error()
    {
        $this->assertCount(4, $this->quran->get('1:s,2,a,4-6,b'));
    }

    public function test_get_chapters()
    {
        $chapters = $this->quran->chapters();

        // Make chapters is contain array of 114 element
        $this->assertCount(114, $chapters);

        // Make sure each element has another 9 variables
        $this->assertCount(9, (array) $chapters[3]);

        // Randomly check each variable
        // Variable return as object
        $this->assertEquals(3, $chapters[3]->index);
        $this->assertEquals(120, $chapters[5]->ayas);
        $this->assertEquals(954, $chapters[7]->start);
        $this->assertEquals("يونس", $chapters[10]->name);
        $this->assertEquals("Ibrahim", $chapters[14]->tname);
        $this->assertEquals("The Prophets", $chapters[21]->ename);
        $this->assertEquals("Medinan", $chapters[24]->type);
        $this->assertEquals(49, $chapters[28]->order);
        $this->assertEquals(9, $chapters[33]->rukus);
    }

    public function test_get_chapter()
    {
        $chapter = $this->quran->chapter(14);

        $this->assertCount(9, (array) $chapter);
        $this->assertEquals("Ibrahim", $chapter->tname);
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\TranslationNotExists
     */
    public function test_exception_translation_not_exists()
    {
        $this->quran->translation('ms')->get('1:3');
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\AyahNotProvided
     */
    public function test_exception_ayah_not_provided()
    {
        $this->quran->get("");
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\AyahNotProvided
     */
    public function test_exception_ayah_not_provided_2()
    {
        $this->quran->get("2");
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\WrongArgument
     */
    public function test_exception_wrong_argument()
    {
        $this->quran->get("w:a");
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\WrongArgument
     */
    public function test_exception_wrong_argument_2()
    {
        $this->quran->get("1:a");
    }

    /**
     * @expectedException \FaizShukri\Quran\Exceptions\WrongArgument
     */
    public function test_exception_wrong_argument_3()
    {
        $this->quran->get("a:1");
    }

}
