<?php

use FaizShukri\Quran\Commands\SurahCommand;
use FaizShukri\Quran\Exceptions\SurahInvalid;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class QuranCommandTest extends TestCase
{
    private $surah_command;
    private $command_tester;

    public function __construct()
    {
        parent::__construct();
        $this->surah_command = new SurahCommand();
        $this->command_tester = new CommandTester($this->surah_command);
    }

    public function test_single_ayah()
    {
        $expected = "ٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n\n";

        $arguments = [
            'surah' => '2',
            'ayah' => '3'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_single_ayah_translation()
    {
        $expected = "Who believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";

        $arguments = [
            'surah' => '2',
            'ayah' => '3',
            'translation' => 'en'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_single_ayah_multi_translation()
    {
        $expected = "[ AR ]\tٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n" .
            "[ EN ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";

        $arguments = [
            'surah' => '2',
            'ayah' => '3',
            'translation' => 'ar,en'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_multi_ayah_single_translation()
    {
        $expected = "[ 3 ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n" .
            "[ 4 ]\tAnd who believe in what has been revealed to you, [O Muhammad], and what was revealed before you, and of the Hereafter they are certain [in faith].\n\n";

        $arguments = [
            'surah' => '2',
            'ayah' => '3,4',
            'translation' => 'en'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_multi_ayah_multi_translation()
    {
        $expected = "\nAR\n====\n\n" .
            "[ 2 ]\tذَٰلِكَ ٱلْكِتَٰبُ لَا رَيْبَ ۛ فِيهِ ۛ هُدًى لِّلْمُتَّقِينَ\n" .
            "[ 3 ]\tٱلَّذِينَ يُؤْمِنُونَ بِٱلْغَيْبِ وَيُقِيمُونَ ٱلصَّلَوٰةَ وَمِمَّا رَزَقْنَٰهُمْ يُنفِقُونَ\n\n" .
            "\nEN\n====\n\n" .
            "[ 2 ]\tThis is the Book about which there is no doubt, a guidance for those conscious of Allah -\n" .
            "[ 3 ]\tWho believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";

        $arguments = [
            'surah' => '2',
            'ayah' => '2,3',
            'translation' => 'ar,en'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_surah()
    {
        $expected = "/^(\\+|-)*\n" .
            "\\| All surah                                                                     \\|\n" .
            "(\\+|-)*\n" .
            "\\| 1. Al-Faatiha    \\| 30. Ar-Room       \\| 59. Al-Hashr       \\| 87. Al-A'laa      \\|\n" .
            '\\| 2. Al-Baqara     \\| 31. Luqman        \\| 60. Al-Mumtahana   \\| 88. Al-Ghaashiya  \\|/';

        $this->assertMatchesRegularExpression($expected, $this->getOutputFromSurahCommand([]));
    }

    public function test_surah_1()
    {
        $expected = "/^ =========== =========== \n" .
            "  Surah Al-Baqara        \n" .
            ' =========== =========== /';

        $arguments = [
            'surah' => '2'
        ];

        $this->assertMatchesRegularExpression($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_surah_2()
    {
        $expected = "Who believe in the unseen, establish prayer, and spend out of what We have provided for them,\n\n";

        $arguments = [
            'surah' => 'baqara',
            'ayah' => '3',
            'translation' => 'en'
        ];

        $this->assertEquals($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_surah_3()
    {
        $expected = "/^ =========== =========== \n" .
            "  Surah Al-Baqara        \n" .
            ' =========== =========== /';

        $arguments = [
            'surah' => 'baqara'
        ];

        $this->assertMatchesRegularExpression($expected, $this->getOutputFromSurahCommand($arguments));
    }

    public function test_ask_surah()
    {
        $arguments = [
            'surah' => 'bqr'
        ];

        $this->command_tester->setInputs(['0']);

        $output = $this->getOutputFromSurahCommand($arguments);

        $this->assertStringContainsString('No surah found. Did you mean one of the following?', $output);
        $this->assertStringContainsString('Surah Al-Baqara', $output);
        $this->assertStringContainsString('Index       2', $output);
        $this->assertStringContainsString('Name        Al-Baqara', $output);
        $this->assertStringContainsString('Name (ar)   البقرة', $output);
        $this->assertStringContainsString('Meaning     The Cow', $output);
    }

    public function test_surah_invalid()
    {
        $this->expectException(SurahInvalid::class);

        $arguments = [
            'surah' => 'abcdefgh'
        ];

        $this->getOutputFromSurahCommand($arguments);
    }

    private function getOutputFromSurahCommand($arguments)
    {
        $this->command_tester->execute(array_merge(
            [$this->surah_command->getName()],
            $arguments
        ));

        return $this->command_tester->getDisplay();
    }
}
