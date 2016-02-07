<?php

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class QuranCommandTest extends PHPUnit_Framework_TestCase
{
    private $bin_path;

    public function __construct()
    {
        parent::__construct();
        $this->bin_path = 'bin';
    }

    public function test_single_ayah()
    {
        $expected = "ٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n\n";
        $this->assertEquals($expected, $this->exec('quran surah 2 3'));
    }

    public function test_single_ayah_translation()
    {
        $expected = "Who believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";
        $this->assertEquals($expected, $this->exec('quran surah 2 3 en'));
    }

    public function test_single_ayah_multi_translation()
    {
        $expected = "[ AR ]\tٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n".
                    "[ EN ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";
        $this->assertEquals($expected, $this->exec('quran surah 2 3 ar,en'));
    }

    public function test_multi_ayah_single_translation()
    {
        $expected = "[ 3 ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n".
                    "[ 4 ]\tAnd who believe in what has been revealed to you, [O Muhammad], and what was revealed before you, and of the Hereafter they are certain [in faith].\n\n";
        $this->assertEquals($expected, $this->exec('quran surah 2 3,4 en'));
    }

    public function test_multi_ayah_multi_translation()
    {
        $expected = "\nAR\n====\n\n".
                    "[ 2 ]\tذَٰلِكَ ٱلْكِتَٰبُ لَا رَيْبَ ۛ فِيهِ ۛ هُدًى لِّلْمُتَّقِينَ\n".
                    "[ 3 ]\tٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n\n".
                    "\nEN\n====\n\n".
                    "[ 2 ]\tThis is the Book about which there is no doubt, a guidance for those conscious of Allah -\n".
                    "[ 3 ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";

        $this->assertEquals($expected, $this->exec('quran surah 2 2,3 ar,en'));
    }

    public function test_surah()
    {
        $expected = "/^(\\+|-)*\n" .
                    "\\| All surah                                                                     \\|\n" .
                    "(\\+|-)*\n" .
                    "\\| 1. Al-Faatiha    \\| 30. Ar-Room       \\| 59. Al-Hashr       \\| 87. Al-A'laa      \\|\n" .
                    "\\| 2. Al-Baqara     \\| 31. Luqman        \\| 60. Al-Mumtahana   \\| 88. Al-Ghaashiya  \\|/";

        $this->assertRegExp($expected, $this->exec('quran surah'));
    }

    public function test_surah_1()
    {
        $expected = "/^ =========== =========== \n" .
                    "  Surah Al-Baqara        \n" .
                    " =========== =========== /";

        $this->assertRegExp($expected, $this->exec('quran surah 2'));
    }


    // Exec
    private function exec($cmd)
    {
        $process = new Process("./$this->bin_path/".$cmd);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}
