<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Exceptions\SurahInvalid;
use FaizShukri\Quran\Quran;
use FaizShukri\Quran\Supports\Levenshtein;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class SurahCommand extends Command
{
    private $quran;

    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        $this->quran = new Quran();
    }

    /**
     * @codeCoverageIgnore
     */
    protected function configure()
    {
        $this
            ->setName('surah')
            ->setDescription('Retrieve surah')
            ->addArgument(
                'surah',
                InputArgument::OPTIONAL,
                'Specify surah'
            )
            ->addArgument(
                'ayah',
                InputArgument::OPTIONAL,
                'Specify ayah'
            )
            ->addArgument(
                'translation',
                InputArgument::OPTIONAL,
                'Specify ayah'
            )
            ->addUsage('2')
            ->addUsage('2 3')
            ->addUsage('2 3,5 en')
            ->addUsage('baqara 3-5')
            ->addUsage('baqara 3,5-6 ar,en')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $surah = $input->getArgument('surah');
        $ayah = $input->getArgument('ayah');
        $translation = $input->getArgument('translation');

        $surah = $this->confirmSurahNo($surah, $input, $output);

        if ($ayah) {
            if ($translation) {
                $this->quran->translation($translation);
            }

            $ayah = $this->quran->get($surah.':'.$ayah);
            $output->writeln($this->parseResult($ayah));
        } elseif ($surah) {
            $this->chapter($output, $surah);
        } else {
            $this->chapters($output);
        }

        return 0;
    }

    private function chapter($output, $verse)
    {
        $surah = $this->quran->getSource()->surah($verse);

        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell('Surah '.$surah['tname'], array('colspan' => 2))],
            ])
            ->setRows([
                ['Index',  $surah['index']],
                ['Name',  $surah['tname']],
                ['Name (ar)',  $surah['name']],
                ['Meaning',  $surah['ename']],
                ['No. Ayah',  $surah['ayas']],
                ['Start',  $surah['start']],
                ['Type',  $surah['type']],
                ['Order',  $surah['order']],
                ['Rukus',  $surah['rukus']],
            ])
            ->setStyle('borderless')
        ;
        $table->render();
        $output->writeln("");
    }

    private function chapters($output)
    {
        $surah = $this->quran->getSource()->surah();
        $surah = array_map(function ($sura) { return "$sura->index. $sura->tname"; }, $surah);
        $surah = $this->array_chunk_vertical($surah, 4);

        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell('All surah', array('colspan' => 4))],
            ])
            ->setRows($surah)
        ;
        $table->render();
    }

    private function array_chunk_vertical($data, $columns)
    {
        $n = count($data);
        $per_column = floor($n / $columns);
        $rest = $n % $columns;

        // The map
        $per_columns = array();
        for ($i = 0; $i < $columns; ++$i) {
            $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0);
        }

        $tabular = array();
        foreach ($per_columns as $rows) {
            for ($i = 0; $i < $rows; ++$i) {
                $tabular[$i][ ] = array_shift($data);
            }
        }

        return $tabular;
    }

    /**
     * @param int|string|null $surah
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|null
     *
     * @throws SurahInvalid
     */
    private function confirmSurahNo($surah, $input, $output)
    {
        if ($surah && !is_numeric($surah)) {
            $surah_list = $this->quran->surah();
            $surah_list_array = array_map(function ($surah) { return $surah->tname; }, (array) $surah_list);
            $closest_surah = $this->closestSurah($surah, $surah_list_array);

            if (sizeof($closest_surah) == 1) {
                $surah = $closest_surah[0];
            } elseif (sizeof($closest_surah) > 1) {
                $surah = $this->askSurah($closest_surah, $input, $output);
            } else {
                throw new SurahInvalid();
            }
            $surah = array_search($surah, $surah_list_array);
        }

        return ($surah === null) ? null : intval($surah);
    }

    /**
     * @param string $surah
     * @param array  $options
     *
     * @return array
     */
    private function closestSurah($surah, $options)
    {
        $l = new Levenshtein();

        return $l->closest($surah, $options);
    }

    /**
     * @param array           $options
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return mixed
     */
    private function askSurah($options, $input, $output)
    {
        $this->setHelperSet(new HelperSet([new QuestionHelper()]));
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion('No surah found. Did you mean one of the following?', $options, 0);
        $question->setErrorMessage('Surah %s is invalid.');

        return $helper->ask($input, $output, $question);
    }

    private function parseResult($args)
    {
        // Just a single ayah is return. No need to parse anything.
        if (is_string($args)) {
            return $args."\n";
        }

        // Multiple ayah/one surah or multiple surah/one ayah. Not both.
        if (is_string(current($args))) {
            return $this->buildAyah($args);
        }

        // Both multiple ayah and multiple surah.
        $count = 0;
        $result = "\n";

        foreach ($args as $translation => $aya) {
            $result .= strtoupper($translation)."\n".str_repeat('=', strlen($translation) + 2)."\n\n";
            $result .= $this->buildAyah($aya);

            ++$count;
            if ($count < sizeof($args)) {
                $result .= "\n\n";
            }
        }

        return $result;
    }

    private function buildAyah($ayah)
    {
        $result = '';
        foreach ($ayah as $num => $aya) {
            $result .= '[ '.strtoupper($num)." ]\t".$aya."\n";
        }

        return $result;
    }
}
