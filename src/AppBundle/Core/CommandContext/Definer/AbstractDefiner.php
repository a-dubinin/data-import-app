<?php

namespace AppBundle\Core\CommandContext\Definer;

use Symfony\Component\Console\Input\InputInterface;

/**
 * Class AbstractDefiner
 * @package AppBundle\Core\CommandContext\Definer
 */
abstract class AbstractDefiner implements DefinerInterface
{
    /**
     * @var $input InputInterface
     */
    protected $input;

    /**
     * AbstractDefiner constructor.
     *
     * @param InputInterface $input
     */
    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }
}
