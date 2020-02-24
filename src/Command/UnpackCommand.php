<?php


namespace App\Command;


use App\Service\PackerService;
use Domain\Archiver\Archive;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UnpackCommand extends Command
{
    protected static $defaultName = "app:unpack";

    protected function configure()
    {
        $this
            ->addArgument('archive', InputArgument::REQUIRED, 'Archive file to unpack.')
            ->setDescription('Unpacks archived file')
            ->setHelp('')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $archive = $input->getArgument('archive');
        $file = new Archive($archive);

        $archiver = PackerService::concretePacker($file->info()->getExtension());
        $archiver->unpack($file, getcwd().'/'.$file->info()->getBasename('.'.$file->info()->getExtension()));

        return 0;
    }
}