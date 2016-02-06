<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Quran;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AyahCommand extends Command
{
    private $quran;

    public function __construct()
    {
        parent::__construct();
        $this->quran = new Quran();
    }

    protected function configure()
    {
        $this
            ->setName('ayah')
            ->setDescription('Retrieve ayah')
            ->addArgument(
                'surah',
                InputArgument::REQUIRED,
                'Select surah'
            )
            ->addArgument(
                'ayah',
                InputArgument::REQUIRED,
                'Select ayah. You can mix comma (,) and range (-)'
            )
            ->addArgument(
                'translation',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addUsage('2 3')
            ->addUsage('2 3,5 en')
            ->addUsage('2 3,5-6 ar,en')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $surah = $input->getArgument('surah');
        $ayah = $input->getArgument('ayah');
        $translation = $input->getArgument('translation');

        if ( $translation ) {
            $this->quran->translation( $translation );
        }

        $ayah = $this->quran->get($surah . ':' . $ayah);
        $output->writeln( $this->parseResult($ayah) );
    }

    private function parseResult($args)
    {
        // Just a single ayah is return. No need to parse anything.
        if (is_string($args)) {
            return $args . "\n";
        }

        // Multiple ayah/one surah or multiple surah/one ayah. Not both.
        if (is_string(current($args))) {
            return $this->buildAyah($args);
        }

        // Both multiple ayah and multiple surah.
        $count = 0;
        $result = "\n";

        foreach ($args as $translation => $aya) {

            $result .= strtoupper($translation) . "\n" . str_repeat('=', strlen($translation) + 2) . "\n\n";
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
        $result = "";
        foreach ($ayah as $num => $aya) {
            $result .= "[ " . strtoupper($num) . " ]\t" . $aya . "\n";
        }
        return $result;
    }
}
