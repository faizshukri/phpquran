<?php

namespace FaizShukri\Quran\Commands;

use FaizShukri\Quran\Quran;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;

class SurahCommand extends Command
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
            ->setName('surah')
            ->setDescription('Retrieve surah')
            ->addArgument(
                'surah',
                InputArgument::OPTIONAL,
                'Select surah'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $surah = $input->getArgument('surah');

        if($surah){
            $this->chapter($output, $surah);
        } else {
            $this->chapters($output);
        }
    }

    private function chapter($output, $verse)
    {
        $surah = $this->quran->getSource()->chapter($verse);

        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell('Surah ' . $surah->tname, array('colspan' => 2))]
            ])
            ->setRows([
                [ "Index",  $surah->index],
                [ "Name",  $surah->tname],
                [ "Name (ar)",  $surah->name],
                [ "Meaning",  $surah->ename],
                [ "No. Ayah",  $surah->ayas],
                [ "Start",  $surah->start],
                [ "Type",  $surah->type],
                [ "Order",  $surah->order],
                [ "Rukus",  $surah->rukus],
            ])
            ->setStyle('borderless')
        ;
        $table->render();
    }

    private function chapters($output)
    {
        $surah = $this->quran->getSource()->chapters();
        $surah = array_map(function($sura){ return "$sura->index. $sura->tname"; }, $surah);
        $surah = $this->array_chunk_vertical($surah, 4);

        $table = new Table($output);
        $table
            ->setHeaders([
                [new TableCell('All surah', array('colspan' => 4))]
            ])
            ->setRows($surah)
        ;
        $table->render();
    }

    private function array_chunk_vertical($data, $columns) {
        $n = count($data) ;
        $per_column = floor($n / $columns) ;
        $rest = $n % $columns ;

        // The map
        $per_columns = array( ) ;
        for ( $i = 0 ; $i < $columns ; $i++ ) {
            $per_columns[$i] = $per_column + ($i < $rest ? 1 : 0) ;
        }

        $tabular = array( ) ;
        foreach ( $per_columns as $rows ) {
            for ( $i = 0 ; $i < $rows ; $i++ ) {
                $tabular[$i][ ] = array_shift($data) ;
            }
        }

        return $tabular ;
    }
}
