<?php

namespace AppBundle\Core\Report;

/**
 * Class Report generates a report of the products import results.
 * @package AppBundle\Core\Report
 */
class Report
{
    const PATTERN_MAIN_INFO   = 'Processed: %d | Successful: %d | Skipped: %d | Failed: %d';
    const PATTERN_FAILED_ROWS = 'Failed rows numbers in .csv-file: %s';
    const MSG_POSSIBLY_HEADER = ' (the header possibly)';
    const HEADER_ROW_NUMBER   = 1;

    const FAILED_ROWS_LIST_SEPARATOR = ', ';

    /**
     * @var $processedCount int
     */
    private $processedCount = 0;

    /**
     * @var $successfulCount int
     */
    private $successfulCount = 0;

    /**
     * @var $skippedCount int
     */
    private $skippedCount = 0;

    /**
     * @var $failedCount int
     */
    private $failedCount = 0;

    /**
     * @var $failedRows array
     */
    private $failedRows;

    /**
     * @return int
     */
    public function getProcessedCount()
    {
        return $this->processedCount;
    }

    /**
     * @return int
     */
    public function getSuccessfulCount()
    {
        return $this->successfulCount;
    }

    /**
     * @return int
     */
    public function getSkippedCount()
    {
        return $this->skippedCount;
    }

    /**
     * @return int
     */
    public function getFailedCount()
    {
        return $this->failedCount;
    }

    /**
     * @return void
     */
    public function increaseProcessed()
    {
        $this->processedCount++;

        return;
    }

    /**
     * @return void
     */
    public function increaseSuccessful()
    {
        $this->successfulCount++;

        return;
    }

    /**
     * @return void
     */
    public function increaseSkipped()
    {
        $this->skippedCount++;

        return;
    }

    /**
     * @return void
     */
    public function increaseFailed()
    {
        $this->failedCount++;

        return;
    }

    /**
     * @param int $rowNumber
     *
     * @return void
     */
    public function addFailedRow($rowNumber)
    {
        $this->failedRows[$rowNumber] = $rowNumber;
        if (self::HEADER_ROW_NUMBER === $rowNumber) {
            $this->failedRows[$rowNumber] .= self::MSG_POSSIBLY_HEADER;
        }

        return;
    }

    /**
     * @return string
     */
    public function toStringFailedRows()
    {
        return sprintf(
            self::PATTERN_FAILED_ROWS,
            implode(self::FAILED_ROWS_LIST_SEPARATOR, $this->failedRows)
        );
    }

    /**
     * @return string
     */
    public function toStringMainInfo()
    {
        return sprintf(
            self::PATTERN_MAIN_INFO,
            $this->getProcessedCount(),
            $this->getSuccessfulCount(),
            $this->getSkippedCount(),
            $this->getFailedCount()
        );
    }
}
