<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Core\RunnableInterface;

/**
 * Class AbstractDataImportCommand
 * @package AppBundle\Command
 */
abstract class AbstractDataImportCommand extends ContainerAwareCommand
{
    const OPTION_NAME_MODE     = 'mode';
    const OPTION_SHORTCUT_MODE = 'm';
    const OPTION_DESC_MODE     = 'Sets DB work mode (if the option is set to \'test\''
                                 .'then data will not be inserted into the DB)';

    const OPTION_NAME_FILE_PATH     = 'file-path';
    const OPTION_SHORTCUT_FILE_PATH = 'f';
    const OPTION_DESC_FILE_PATH     = 'Full file path with data';

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /**
         * @var $em EntityManagerInterface
         */
        $em = $this->getContainer()->get('doctrine.entity_manager');

        $executor = static::getExecutor($input, $output, $em);
        $executor->run();
    }

    /**
     * Returns the Executor object.
     *
     * There is only CSVExecutor currently. But we can extend the class to (for example) JsonDataImportCommand
     * ('import:data:json') with its JsonExecutor which implements the RunnableInterface.
     *
     * @param InputInterface         $input
     * @param OutputInterface        $output
     * @param EntityManagerInterface $em
     *
     * @return RunnableInterface
     */
    abstract protected function getExecutor(InputInterface $input, OutputInterface $output, EntityManagerInterface $em);
}
