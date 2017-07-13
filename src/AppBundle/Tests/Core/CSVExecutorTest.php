<?php

namespace AppBundle\Tests\Core;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Core\CSVExecutor;
use AppBundle\Core\CommandContext\BaseCommandContext;

/**
 * Class CSVExecutorTest
 * @package AppBundle\Tests\Core
 */
class CSVExecutorTest extends KernelTestCase
{
    /**
     * @covers \AppBundle\Core\CSVExecutor::__construct()
     */
    public function testConstructor()
    {
        /**
         * @var $inputMock ArrayInput
         */
        $inputMock = $this->getMockBuilder(ArrayInput::class)
                          ->disableOriginalConstructor()
                          ->getMock();

        /**
         * @var $emMock EntityManager
         */
        $emMock = $this->getMockBuilder(EntityManager::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $csvExecutor = new CSVExecutor($inputMock, new NullOutput(), $emMock);

        $actualCommandContext = self::getObjectAttribute($csvExecutor, 'commandContext');
        $actualIo             = self::getObjectAttribute($csvExecutor, 'io');
        $actualEm             = self::getObjectAttribute($csvExecutor, 'em');

        self::assertInstanceOf(BaseCommandContext::class, $actualCommandContext);
        self::assertInstanceOf(SymfonyStyle::class, $actualIo);
        self::assertInstanceOf(EntityManagerInterface::class, $actualEm);
    }
}
