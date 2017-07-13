<?php

namespace AppBundle\Core\CommandContext\Definer;

use AppBundle\Command\AbstractDataImportCommand;

/**
 * Class FilePathDefiner defines the 'file-path' option value.
 * @package AppBundle\Core\CommandContext\Definer
 */
class FilePathDefiner extends AbstractDefiner
{
    /**
     * @return string
     */
    public function defineValue()
    {
        return $this->input->getOption(AbstractDataImportCommand::OPTION_NAME_FILE_PATH);
    }
}
