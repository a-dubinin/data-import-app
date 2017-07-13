<?php

namespace AppBundle\Tests\Core\CommandContext\Definer;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use AppBundle\Core\CommandContext\Definer\DefinerInterface;

/**
 * Class AbstractDefinerTest
 * @package AppBundle\Tests\Core\CommandContext\Definer
 */
abstract class AbstractDefinerTest extends KernelTestCase
{
    /**
     * @var $inputMock ArrayInput
     */
    protected $inputMock;

    /**
     * @var $definer DefinerInterface
     */
    protected $definer;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->inputMock = $this->getMockBuilder(ArrayInput::class)
                                ->disableOriginalConstructor()
                                ->getMock();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->inputMock = null;
        $this->definer   = null;
    }

    /**
     * @covers \AppBundle\Core\CommandContext\Definer\AbstractDefiner::__construct()
     */
    public function testConstructor()
    {
        $actualInput = self::getObjectAttribute($this->definer, 'input');

        self::assertInstanceOf(InputInterface::class, $actualInput);
    }
}
