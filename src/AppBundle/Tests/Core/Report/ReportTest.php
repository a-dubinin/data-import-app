<?php

namespace AppBundle\Tests\Core\Report;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Core\Report\Report;

/**
 * Class ReportTest
 * @package AppBundle\Tests\Core\Report
 */
class ReportTest extends KernelTestCase
{
    /**
     * @var $report Report
     */
    protected $report;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->report = new Report();
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->report = null;
    }

    /**
     * @covers \AppBundle\Core\Report\Report::increaseProcessed()
     */
    public function testIncreaseProcessed()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->report->increaseProcessed();
            self::assertEquals($i, $this->report->getProcessedCount());
        }
        self::assertEquals(5, $this->report->getProcessedCount());
    }

    /**
     * @covers \AppBundle\Core\Report\Report::increaseSuccessful()
     */
    public function testIncreaseSuccessful()
    {
        self::assertEquals(0, $this->report->getSuccessfulCount());

        $this->report->increaseSuccessful();
        self::assertEquals(1, $this->report->getSuccessfulCount());

        $this->report->increaseSuccessful();
        self::assertEquals(2, $this->report->getSuccessfulCount());
    }

    /**
     * @covers \AppBundle\Core\Report\Report::increaseSkipped()
     */
    public function testIncreaseSkipped()
    {
        self::assertEquals(0, $this->report->getSkippedCount());

        for ($i = 1; $i <= 3; $i++) {
            $this->report->increaseSkipped();
            self::assertEquals($i, $this->report->getSkippedCount());
        }
    }

    /**
     * @covers \AppBundle\Core\Report\Report::increaseFailed()
     */
    public function testIncreaseFailed()
    {
        for ($i = 1; $i <= 4; $i++) {
            $this->report->increaseFailed();
            self::assertEquals($i, $this->report->getFailedCount());
        }
    }

    /**
     * @covers \AppBundle\Core\Report\Report::addFailedRow()
     */
    public function testAddFailedRow()
    {
        $this->report->addFailedRow(69);
        $actualFailedRows = self::getObjectAttribute($this->report, 'failedRows');

        self::assertArrayHasKey(69, $actualFailedRows);
        self::assertArrayNotHasKey(0, $actualFailedRows);
        self::assertEquals(69, $actualFailedRows[69]);
    }

    /**
     * @covers \AppBundle\Core\Report\Report::addFailedRow()
     */
    public function testAddHeaderRow()
    {
        $this->report->addFailedRow(1);
        $actualFailedRows = self::getObjectAttribute($this->report, 'failedRows');
        $msgPossiblyHeader = '1' . Report::MSG_POSSIBLY_HEADER;

        self::assertArrayHasKey(1, $actualFailedRows);
        self::assertArrayNotHasKey(0, $actualFailedRows);
        self::assertEquals($msgPossiblyHeader, $actualFailedRows[1]);
    }
}
