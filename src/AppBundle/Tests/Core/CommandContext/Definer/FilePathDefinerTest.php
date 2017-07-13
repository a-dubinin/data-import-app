<?php

namespace AppBundle\Tests\Core\CommandContext\Definer;

use AppBundle\Core\CommandContext\Definer\FilePathDefiner;

/**
 * Class FilePathDefinerTest
 * @package AppBundle\Tests\Core\CommandContext\Definer
 */
class FilePathDefinerTest extends AbstractDefinerTest
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->definer = new FilePathDefiner($this->inputMock);
    }
}
