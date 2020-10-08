<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Supports\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConfigViewCommand extends Command
{
    private $config;

    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        $this->config = new Config();
    }

    /**
     * @codeCoverageIgnore
     */
    protected function configure()
    {
        $this
            ->setName('config:path')
            ->setDescription('View configuration path');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Config file: <info>{$this->config->configFile}</info>");
        $output->writeln("Data directory: <info>{$this->config->dataDir}</info>\n");

        return 0;
    }
}
