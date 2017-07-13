<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Core\CSVExecutor;

/**
 * Class CSVDataImportCommand
 * @package AppBundle\Command
 */
class CSVDataImportCommand extends AbstractDataImportCommand
{
    const COMMAND_NAME        = 'import:data:csv';
    const COMMAND_DESCRIPTION = 'Import data from .csv-file into DB.';

    const OPTION_DEFAULT_FILE_PATH  = __DIR__ . DIRECTORY_SEPARATOR
                                      . '..' . DIRECTORY_SEPARATOR
                                      . '..' . DIRECTORY_SEPARATOR
                                      . '..' . DIRECTORY_SEPARATOR
                                      . 'upload' . DIRECTORY_SEPARATOR
                                      . 'stock.csv';

    /**
     * For flexibility of setting the transferred .csv-file format, we can define additional command line options:
     * import:data:csv --delimiter=";" --enclosure="'"
     * and process them by CSVCommandContext which extends BaseCommandContext.
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME)
             ->setDescription(self::COMMAND_DESCRIPTION)
             ->setDefinition([
                 new InputOption(
                     self::OPTION_NAME_MODE,
                     self::OPTION_SHORTCUT_MODE,
                     InputOption::VALUE_OPTIONAL,
                     self::OPTION_DESC_MODE
                 ),
                 new InputOption(
                     self::OPTION_NAME_FILE_PATH,
                     self::OPTION_SHORTCUT_FILE_PATH,
                     InputOption::VALUE_OPTIONAL,
                     self::OPTION_DESC_FILE_PATH,
                     self::OPTION_DEFAULT_FILE_PATH
                 ),
             ]);
    }

    /**
     * @param InputInterface         $input
     * @param OutputInterface        $output
     * @param EntityManagerInterface $em
     *
     * @return CSVExecutor
     */
    protected function getExecutor(InputInterface $input, OutputInterface $output, EntityManagerInterface $em)
    {
        return new CSVExecutor($input, $output, $em);
    }
}
