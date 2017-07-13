<?php

namespace AppBundle\Tests\Core\ImportRule\Rule;

use AppBundle\Core\ImportRule\Rule\LowCostAndLowStockRule;

/**
 * Class LowCostAndLowStockRuleTest
 * @package AppBundle\Tests\Core\ImportRule\Rule
 */
class LowCostAndLowStockRuleTest extends AbstractCostRuleTest
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->costRule = new LowCostAndLowStockRule();
    }
}
