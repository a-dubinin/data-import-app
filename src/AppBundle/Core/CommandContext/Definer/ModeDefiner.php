<?php

namespace AppBundle\Core\CommandContext\Definer;

use AppBundle\Command\AbstractDataImportCommand;

/**
 * Class ModeDefiner defines the 'mode' option value.
 * @package AppBundle\Core\CommandContext\Definer
 */
class ModeDefiner extends AbstractDefiner
{
    const MODE_TEST = 'test';

    /**
     * @return mixed
     */
    public function defineValue()
    {
        return $this->input->getOption(AbstractDataImportCommand::OPTION_NAME_MODE);
    }
}
