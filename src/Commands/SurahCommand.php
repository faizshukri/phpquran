<?php

namespace FaizShukri\Quran\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SurahCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('surah')
            ->setDescription('Retrieve surah')
            ->addArgument(
                'index',
                InputArgument::OPTIONAL,
                'Surah index'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
