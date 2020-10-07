<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Supports\Config;
use FaizShukri\Quran\Supports\Downloader;
use FaizShukri\Quran\TanzilTranslations;
use FaizShukri\Quran\Repositories\Source\XMLRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class TranslationAddCommand extends Command
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
            ->setName('translation:add')
            ->setDescription('Add new translation')
            ->addArgument(
                'translation',
                InputArgument::OPTIONAL,
                'Translation to add'
            )
            ->addUsage('ms.basmeih');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $translation = $input->getArgument('translation');

        if ($translation === null) {
            $this->translationTable($output, $this->allTranslations());
            $output->writeln("<info>Please specify a </info><comment>translation ID</comment><info>. You can refer to the table above.</info>\n");
        } else {
            $found = false;
            $translations = $this->allTranslations();
            foreach ($translations as $tr) {
                if ($translation == $tr['id']) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $this->translationTable($output, $translations);
                $output->writeln("<info>Invalid </info><comment>translation ID</comment><info>. Please refer to the available translation above.</info>\n");
                return 0;
            }

            $this->config->addTranslation($translation);
            $dw = new Downloader($this->config);
            $dw->sync();
            $output->writeln("<info>$translation</info> has been added successfully.\n");
        }

        return 0;
    }

    private function allTranslations()
    {
        $tanzil = new TanzilTranslations;
        return $tanzil->get();
    }

    private function translationTable($output, $translations)
    {
        $table = new Table($output);
        $table
            ->setHeaders(['ID', 'Language', 'Name', 'Translator'])
            ->setRows($translations);
        $table->render();
    }
}
