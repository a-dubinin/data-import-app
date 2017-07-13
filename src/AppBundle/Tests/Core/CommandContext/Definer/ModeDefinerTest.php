<?php

namespace AppBundle\Tests\Core\CommandContext\Definer;

use AppBundle\Core\CommandContext\Definer\ModeDefiner;

/**
 * Class ModeDefinerTest
 * @package AppBundle\Tests\Core\CommandContext\Definer
 */
class ModeDefinerTest extends AbstractDefinerTest
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->definer = new ModeDefiner($this->inputMock);
    }
}
