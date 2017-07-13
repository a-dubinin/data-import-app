<?php

namespace AppBundle\Tests\Core\ImportRule\Rule;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use AppBundle\Core\ImportRule\FilterInterface;

/**
 * Class AbstractCostRuleTest
 * @package AppBundle\Tests\Core\ImportRule\Rule
 */
abstract class AbstractCostRuleTest extends KernelTestCase
{
    /**
     * @var $costRule FilterInterface
     */
    protected $costRule;

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->costRule = null;
    }

    /**
     * @covers \AppBundle\Core\ImportRule\Rule\HighCostRule::__construct()
     * @covers \AppBundle\Core\ImportRule\Rule\LowCostAndLowStockRule::__construct()
     */
    public function testConstructor()
    {
        $actualConvertedCostValue = self::getObjectAttribute($this->costRule, 'convertedCostValue');

        self::assertGreaterThan(0, $actualConvertedCostValue);
        self::assertLessThan(1000000, $actualConvertedCostValue);
    }
}
