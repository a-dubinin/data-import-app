<?php

namespace AppBundle\Tests\Core\CommandContext;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use AppBundle\Core\CommandContext\BaseCommandContext;
use AppBundle\Core\CommandContext\Definer\ModeDefiner;
use AppBundle\Command\CSVDataImportCommand;

/**
 * Class BaseCommandContextTest
 * @package AppBundle\Tests\Core\CommandContext
 */
class BaseCommandContextTest extends KernelTestCase
{
    /**
     * @var $commandContext BaseCommandContext
     */
    protected $commandContext;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        /**
         * @var $inputMock ArrayInput
         */
        $inputMock = $this->getMockBuilder(ArrayInput::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        $this->commandContext = new BaseCommandContext($inputMock);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->commandContext = null;
    }

    /**
     * @covers \AppBundle\Core\CommandContext\BaseCommandContext::__construct()
     */
    public function testConstructor()
    {
        $actualInput = self::getObjectAttribute($this->commandContext, 'input');

        self::assertInstanceOf(InputInterface::class, $actualInput);
        self::assertObjectHasAttribute('mode', $this->commandContext);
        self::assertObjectHasAttribute('filePath', $this->commandContext);
    }

    /**
     * @covers \AppBundle\Core\CommandContext\BaseCommandContext::isTestMode()
     *
     * @dataProvider isTestModeDataProvider
     *
     * @param string $mode
     */
    public function testIsTestMode($mode)
    {
        $this->commandContext->setMode($mode);

        self::assertTrue($this->commandContext->isTestMode());
        self::assertEquals(ModeDefiner::MODE_TEST, $this->commandContext->getMode());
    }

    /**
     * @covers \AppBundle\Core\CommandContext\BaseCommandContext::isTestMode()
     *
     * @dataProvider isDBModeDataProvider
     *
     * @param string $mode
     */
    public function testIsDBMode($mode)
    {
        $this->commandContext->setMode($mode);

        self::assertFalse($this->commandContext->isTestMode());
        self::assertNotEquals(ModeDefiner::MODE_TEST, $this->commandContext->getMode());
    }

    /**
     * @covers \AppBundle\Core\CommandContext\BaseCommandContext::existsFile()
     *
     * @dataProvider existsFileDataProvider
     *
     * @param string $filePath
     */
    public function testExistsFile($filePath)
    {
        $this->commandContext->setFilePath($filePath);

        self::assertTrue($this->commandContext->existsFile());
        self::assertFileExists($filePath);
        self::assertFileIsReadable($filePath);
    }

    /**
     * @covers \AppBundle\Core\CommandContext\BaseCommandContext::existsFile()
     *
     * @dataProvider notExistsFileDataProvider
     *
     * @param string $filePath
     */
    public function testNotExistsFile($filePath)
    {
        $this->commandContext->setFilePath($filePath);

        self::assertFalse($this->commandContext->existsFile());
        self::assertFileNotExists($filePath);
    }

    /**
     * @return array
     */
    public function isTestModeDataProvider()
    {
        return [
            ['test'],
            ['Test'],
            ['TEST'],
        ];
    }

    /**
     * @return array
     */
    public function isDBModeDataProvider()
    {
        return [
            [null],
            [''],
            ['mistake'],
            ['testing'],
            ['db'],
        ];
    }

    /**
     * @return array
     */
    public function existsFileDataProvider()
    {
        return [
            ['/var/www/html/upload/stock.csv'],
            [CSVDataImportCommand::OPTION_DEFAULT_FILE_PATH],
        ];
    }

    /**
     * @return array
     */
    public function notExistsFileDataProvider()
    {
        return [
            ['/unknown/path/to/file.csv'],
        ];
    }
}
