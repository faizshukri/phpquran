<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Supports\Config;
use FaizShukri\Quran\Repositories\Source\XMLRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TranslationListCommand extends Command
{
    private $source;

    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = new Config;
        $this->source = new XMLRepository;
        $this->source->setConfig($this->config);
    }

    protected function configure()
    {
        $this
            ->setName('translation:list')
            ->setDescription('View available translations');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translations = $this->translations();

        $output->writeln("<info>Available translations. (For usage, you can use short form, example: </info>en <info>instead of</info> en.sahih <info>)</info>");
        foreach ($translations as $translation) {
            $output->writeln("  - <comment>$translation</comment>");
        }

        $output->writeln("");

        return 0;
    }

    private function translations()
    {
        return $this->config->get('translations');
    }
}
