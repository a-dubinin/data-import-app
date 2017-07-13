<?php

namespace AppBundle\Core\CommandContext\Definer;

/**
 * Interface DefinerInterface is the interface implemented by all definer classes.
 * @package AppBundle\Core\CommandContext\Definer
 */
interface DefinerInterface
{
    /**
     * Defines the command line option value.
     *
     * @return mixed
     */
    public function defineValue();
}
